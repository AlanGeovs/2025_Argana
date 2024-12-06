<?php
require_once "conexion.php";

class Order
{
    private $id_order;

    public function __construct($id_order)
    {
        $this->id_order = $id_order;
    }

    // Conecta a la base de datos, este método puede variar según cómo manejas la conexión en tu proyecto
    protected static function conectar()
    {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=dbi6bdhoqxrrng', 'uqnnskgagovis', 'kqgsgdipj2vs');
            return $conexion;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function crearPedido($idUsuario, $productosCarrito)
    {
        try {
            $conexion = self::conectar();
            $conexion->beginTransaction();

            // Inserta el pedido sin total primero
            $stmt = $conexion->prepare("INSERT INTO orders (id_user, order_date, status) VALUES (:id_user, NOW(), 'Pendiente')");
            $stmt->bindParam(':id_user', $idUsuario);
            $stmt->execute();
            $idPedido = $conexion->lastInsertId();

            $totalPedido = 0; // Inicializa el total del pedido

            // Inserta cada detalle y actualiza el total del pedido
            foreach ($productosCarrito as $producto) {
                $subtotalProducto = $producto['cantidad'] * $producto['price_public'];
                $totalPedido += $subtotalProducto; // Acumula el total

                $stmt = $conexion->prepare("INSERT INTO order_details (id_order, id_product, quantity, price) VALUES (:id_order, :id_product, :quantity, :price)");
                $stmt->bindParam(':id_order', $idPedido);
                $stmt->bindParam(':id_product', $producto['id_product']);
                $stmt->bindParam(':quantity', $producto['cantidad']);
                $stmt->bindParam(':price', $producto['price_public']);
                $stmt->execute();
            }

            // Actualiza el total del pedido
            $stmt = $conexion->prepare("UPDATE orders SET total = :total WHERE id_order = :id_order");
            $stmt->bindParam(':total', $totalPedido);
            $stmt->bindParam(':id_order', $idPedido);
            $stmt->execute();

            $conexion->commit();
            return ['success' => true, 'message' => 'Pedido generado con éxito.'];
        } catch (Exception $e) {
            $conexion->rollBack();
            return ['success' => false, 'message' => 'Error al generar el pedido: ' . $e->getMessage()];
        }
    }


    // Listar detalles de pedido
    public static function listarPedido($idPedido)
    {
        $consulta = "SELECT * FROM `orders` o JOIN clients c ON o.`id_user` = c.id_user  WHERE id_order = :id_order";
        $stmt = Conexion::conectar()->prepare($consulta);
        $stmt->bindParam(":id_order", $idPedido, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); //
    }

    public static function ObtenDetallesPedido($idPedido)
    {
        $conexion = self::conectar();
        $stmt = $conexion->prepare("SELECT od.*, p.* FROM order_details od JOIN products p ON od.id_product = p.id_product WHERE od.id_order = :id_order");
        $stmt->bindParam(":id_order", $idPedido, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Guardar los datos de la Solicitud Editados por equipode Beraca   ':price_shipment' => $producto['price_shipment']
    public static function saveOrderDetails($idOrder, $productos)
    {
        $conexion = self::conectar();
        try {
            $conexion->beginTransaction();
            $query = "INSERT INTO order_details_edit (id_order, SKU, description, price_public, quantity, discount, total, publisher, reservation_code, note, price_shipment) 
                      VALUES (:id_order, :SKU, :description, :price_public, :quantity, :discount, :total, :publisher, :reservation_code, :note, :price_shipment)";
            $stmt = $conexion->prepare($query);

            foreach ($productos as $producto) {
                $stmt->execute([
                    ':id_order' => $idOrder,
                    ':SKU' => $producto['SKU'],
                    ':description' => $producto['description'],
                    ':price_public' => $producto['price_public'],
                    ':quantity' => $producto['quantity'],
                    ':discount' => $producto['discount'],
                    ':total' => $producto['total'],
                    ':publisher' => $producto['publisher'],
                    ':reservation_code' => $producto['reservation_code'],
                    ':note' => $producto['note'],
                    ':price_shipment' => $producto['shipment']
                ]);
            }
            $conexion->commit();
            return true;
        } catch (PDOException $e) {
            $conexion->rollBack();
            error_log('Order::saveOrderDetails - ' . $e->getMessage());
            return false;
        }
    }


    public function changeStatusOrder($status)
    {
        $conexion = self::conectar();
        try {
            $query = "UPDATE orders SET status = :status WHERE id_order = :id_order";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id_order', $this->id_order, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Order::changeStatusOrder - ' . $e->getMessage());
            return false;
        }
    }


    public static function consultOrderDetailsEdit($id_pedido)
    {
        $conexion = self::conectar();
        try {
            $query = "SELECT * FROM order_details_edit WHERE id_order = :id_order";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id_order', $id_pedido, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Order::consultOrderDetailsEdit - ' . $e->getMessage());
            return false;
        }
    }


    public static function changeStatusByOrder($idOrder, $status)
    {
        $conexion = self::conectar();
        try {
            $query = "UPDATE orders SET status = :status WHERE id_order = :id_order";
            $stmt = $conexion->prepare($query);
            $stmt->execute([
                ':status' => $status,
                ':id_order' => $idOrder
            ]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Order::changeStatusOrder - ' . $e->getMessage());
            return false;
        }
    }

    public static function registerOperation($comprador, $comprador_comision, $vendedor, $vendedor_comision, $intercambio, $efectivo, $fecha_transaccion, $fecha_deposito, $nota)
    {
        // Conexión a la base de datos
        $conexion = self::conectar();
        if ($conexion === null) {
            error_log('Order::registerOperation - Error de conexión');
            return false;
        }

        try {
            $query = "INSERT INTO operations (buyer_id, buyer_commission, seller_id, seller_commission, exchange_amount, cash_amount, transaction_date, deposit_date, note) 
                      VALUES (:comprador, :comprador_comision, :vendedor, :vendedor_comision, :intercambio, :efectivo, :fecha_transaccion, :fecha_deposito, :nota)";
            $stmt = $conexion->prepare($query);
            $stmt->execute([
                ':comprador' => $comprador,
                ':comprador_comision' => $comprador_comision,
                ':vendedor' => $vendedor,
                ':vendedor_comision' => $vendedor_comision,
                ':intercambio' => $intercambio,
                ':efectivo' => $efectivo,
                ':fecha_transaccion' => $fecha_transaccion,
                ':fecha_deposito' => $fecha_deposito,
                ':nota' => $nota
            ]);

            // Obtener el último ID insertado
            $operation_id = $conexion->lastInsertId();

            return $operation_id;
        } catch (PDOException $e) {
            error_log('Order::registerOperation - ' . $e->getMessage());
            return false;
        }
    }



    public static function searchClients($query)
    {
        $conexion = self::conectar();

        try {
            $sql = "SELECT id_user, username, name, last_name, legal_name, trading_name, email
                    FROM clients WHERE username LIKE :query OR CONCAT(name, ' ', last_name) LIKE :query 
                    OR name LIKE :query OR last_name LIKE :query OR legal_name LIKE :query OR trading_name LIKE :query OR email LIKE :query
                    LIMIT 10";
            $stmt = $conexion->prepare($sql);
            // Agregar los '%' al establecer el valor del parámetro
            $likeQuery = "%" . $query . "%";
            $stmt->bindParam(':query', $likeQuery, PDO::PARAM_STR);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        } catch (PDOException $e) {
            error_log('Order::searchClients - ' . $e->getMessage());
            return [];
        }
    }
}
