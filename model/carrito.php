<?php

require_once "conexion.php";

class Carrito
{

    // Conecta a la base de datos, este método puede variar según cómo manejas la conexión en tu proyecto
    protected static function conectar()
    {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=dbgbugrafge90d', 'uqoksoigmvtky', 'zpw5ffyf2l04');
            return $conexion;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function agregarProducto($idSesion, $idProducto, $cantidad, $idUser)
    {
        $conexion = self::conectar();

        // Verificar si el producto ya está en el carrito para esa sesión
        $stmt = $conexion->prepare("SELECT * FROM carrito WHERE id_sesion = :id_sesion AND id_producto = :id_producto AND id_user = :idUser");
        $stmt->execute(['id_sesion' => $idSesion, 'id_producto' => $idProducto, 'id_user' => $idUser]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($producto) {
            // Si el producto ya está en el carrito, actualiza la cantidad
            $nuevaCantidad = $producto['cantidad'] + $cantidad;
            $stmt = $conexion->prepare("UPDATE carrito SET cantidad = :cantidad WHERE id = :id");
            $exito = $stmt->execute(['cantidad' => $nuevaCantidad, 'id' => $producto['id']]);
        } else {
            // Si el producto no está en el carrito, lo añade
            $stmt = $conexion->prepare("INSERT INTO carrito (id_user, id_sesion, id_producto, cantidad) VALUES (:id_user, :id_sesion, :id_producto, :cantidad)");
            $exito = $stmt->execute(['id_user' => $idUser, 'id_sesion' => $idSesion, 'id_producto' => $idProducto, 'cantidad' => $cantidad]);
        }

        return $exito;
    }


    // Obtiene la cantidad de productos en el carrito para la sesión actual
    public static function obtenerCantidadProductosCarrito()
    {
        $conexion = self::conectar();
        $sql = "SELECT COUNT(*) AS cantidad FROM carrito WHERE id_sesion = :session_id";
        $query = $conexion->prepare($sql);
        $query->execute(['session_id' => session_id()]);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado['cantidad'] ?? 0;
    }

    public static function obtenerProductosCarrito($idSesion)
    {
        $conexion = self::conectar();
        $stmt = $conexion->prepare("SELECT * FROM carrito c INNER JOIN products p ON c.id_producto = p.id_product WHERE c.id_sesion like :idSesion ORDER BY fecha_agregado DESC");
        $stmt->bindParam(':idSesion', $idSesion);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultados); // Solo para depuración, quitar después
        // echo "sesion: ".$idSesion;
        return $resultados;
    }

    // Limpiar carrito después de guardar pedido
    public static function limpiarCarrito($idSesion)
    {
        try {
            $conexion = self::conectar();
            $stmt = $conexion->prepare("DELETE FROM carrito WHERE id_sesion = :id_sesion");
            $stmt->bindParam(':id_sesion', $idSesion);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
