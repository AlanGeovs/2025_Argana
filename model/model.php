<?php

require_once "conexion.php";

class Consultas  extends Conexion
{

	public static function validarLogin($correo, $password)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo=:correo AND confirmPass=:password");
		$stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public static function enviarCorreoInicioSesion($usuario, $tipoUsuario, $fechaInicio)
	{
		$to = "abraham@tradexmexico.com.mx, alan@genesysapp.com";
		$subject = "Nuevo inicio de sesión en el sistema";

		// Cuerpo del mensaje en HTML
		$message = "
            <html>
            <head>
                <title>Nuevo inicio de sesión</title>
            </head>
            <body>
                <h3>Nuevo inicio de sesión</h3>
                <p><strong>Usuario:</strong> $usuario</p>
                <p><strong>Tipo de usuario:</strong> $tipoUsuario</p>
                <p><strong>Fecha y hora:</strong> $fechaInicio</p>
            </body>
            </html>
        ";

		// Encabezados del correo
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: no-reply@tradexmexico.com.mx" . "\r\n";

		// Enviar el correo y verificar el resultado
		if (mail($to, $subject, $message, $headers)) {
			return 'ok';
		} else {
			error_log("Error al enviar correo.");
			return 'error';
		}
	}
	public static function enviarCorreoOperaciones($usuario,  $comprador, $vendedor,   $monto, $fechaInicio, $producto)
	{
		$to = "abraham@tradexmexico.com.mx, alan@genesysapp.com";
		$subject = "Nueva operación en el sistema";

		// Cuerpo del mensaje en HTML
		$message = "
            <html> 
            <head>
                <title>Nueva operación registrada</title>
            </head>
            <body>
                <h3>Nueva operación registrada</h3>
                <p><strong>Usuario:</strong> $usuario</p>
                <p><strong>Producto / Servicio:</strong> $producto</p>
                <p><strong>Fecha y hora:</strong> $fechaInicio</p>
				<p><strong>Monto: $</strong> $monto</p>
				<p><strong>Vendedor:</strong> $vendedor</p>
				<p><strong>Comprador:</strong> $comprador</p>
            </body>
            </html>
        ";

		// Encabezados del correo
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: no-reply@tradexmexico.com.mx" . "\r\n";

		// Enviar el correo y verificar el resultado
		if (mail($to, $subject, $message, $headers)) {
			return 'ok';
		} else {
			error_log("Error al enviar correo.");
			return 'error';
		}
	}


	public static function validarLoginUsuario($usuario, $password)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND confirmPass=:password");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function listarClases()
	{
		$stmt = Conexion::conectar()->prepare("SELECT ID, TAG FROM categorias");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	// ---------------------------------------------------------------------------------------------------------------------------------------
	// NUevas clases TRADEX

	//Esta función se encargará de obtener el último username registrado y calcular el nuevo username
	public static function calcularNuevoUsername()
	{
		// Consultar el último username registrado
		$stmt = Conexion::conectar()->prepare("SELECT username FROM clients ORDER BY username DESC LIMIT 1");
		$stmt->execute();
		$ultimoUsername = $stmt->fetch(PDO::FETCH_ASSOC);

		// Si no hay registros previos, asigna un username inicial
		if (!$ultimoUsername) {
			return '00001'; // Valor inicial si no hay registros
		}

		// Incrementar el último username en 1
		$nuevoUsername = str_pad(intval($ultimoUsername['username']) + 1, 5, '0', STR_PAD_LEFT);
		return $nuevoUsername;
	}

	// Guardar Clientes
	public static function guardarCliente($data)
	{
		try {
			$stmt = Conexion::conectar()->prepare("INSERT INTO clients 
            (name, last_name, last_name_second, email, phone, mobile, trading_name, legal_name, address, town, city, state, cp, notes, username, status) 
            VALUES (:name, :last_name, :last_name_second, :email, :phone, :mobile, :trading_name, :legal_name, :address, :town, :city, :state, :cp, :notes, :username, :status)");

			// Vinculamos los parámetros
			$stmt->bindParam(":name", $data['name']);
			$stmt->bindParam(":last_name", $data['last_name']);
			$stmt->bindParam(":last_name_second", $data['last_name_second']);
			$stmt->bindParam(":email", $data['email']);
			$stmt->bindParam(":phone", $data['phone']);
			$stmt->bindParam(":mobile", $data['mobile']);
			$stmt->bindParam(":trading_name", $data['trading_name']);
			$stmt->bindParam(":legal_name", $data['legal_name']);
			$stmt->bindParam(":address", $data['address']);
			$stmt->bindParam(":town", $data['town']);
			$stmt->bindParam(":city", $data['city']);
			$stmt->bindParam(":state", $data['state']);
			$stmt->bindParam(":cp", $data['cp']);
			$stmt->bindParam(":notes", $data['notes']);
			$stmt->bindParam(":username", $data['username']);
			$stmt->bindParam(":status", $data['status']);

			if ($stmt->execute()) {
				// Realizar una nueva consulta para obtener el id_user en función del username
				$stmt = Conexion::conectar()->prepare("SELECT id_user FROM clients WHERE username = :username");
				$stmt->bindParam(":username", $data['username']);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_ASSOC);

				// Verificar si se obtuvo el id_user
				if ($result) {
					return $result['id_user']; // Retornar el id_user obtenido
				} else {
					throw new PDOException("Error al obtener el ID del usuario recién creado.");
				}
			} else {
				throw new PDOException("Error al ejecutar la consulta de inserción.");
			}
		} catch (PDOException $e) {
			error_log('Error al guardar cliente: ' . $e->getMessage()); // Registrar en log
			return false;
		}
	}




	//inserte un nuevo registro en la tabla balances para el usuario recién creado:
	public static function registrarNuevoUsuarioEnBalance($id_user, $username)
	{
		try {
			$stmt = Conexion::conectar()->prepare("INSERT INTO balances 
            (id_user, username, type_operation, name_transaction, trade_sales, cash_sales, trade_purchases, cash_purchases, trade_commission, cash_commission, trade_balance, cash_balance, date_transaction) 
            VALUES (:id_user, :username, 'Nuevo usuario', 'Registro de nuevo usuario', 0, 0, 0, 0, 0, 0, 0, 0, NOW())");

			$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);

			return $stmt->execute();
		} catch (PDOException $e) {
			error_log('Error al insertar balance para el nuevo usuario: ' . $e->getMessage());
			return false;
		}
	}


	//Crear Productos

	public static function guardarProducto($data)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO products 
							(product_name, author, description, SKU, price_public, price_supplier, stock) 
					VALUES (:product_name, :author, :description, :SKU, :price_public, :price_supplier, :stock)");

		$stmt->bindParam(":product_name", $data['product_name']);
		$stmt->bindParam(":author", $data['author']);
		$stmt->bindParam(":description", $data['description']);
		$stmt->bindParam(":SKU", $data['SKU']);
		$stmt->bindParam(":price_public", $data['price_public']);
		$stmt->bindParam(":price_supplier", $data['price_supplier']);
		$stmt->bindParam(":stock", $data['stock']);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public static function actualizarCliente($id_user, $data)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE clients
												SET 
													name = :name,
													last_name = :last_name,
													last_name_second = :last_name_second,
													email = :email,
													phone = :phone,
													mobile = :mobile,
													address = :address,
													town = :town,
													city = :city,
													state = :state,
													cp = :cp,
													notes = :notes
												WHERE id_user = :id;								");
		$stmt->bindParam(":name", $data['name']);
		$stmt->bindParam(":last_name", $data['last_name']);
		$stmt->bindParam(":last_name_second", $data['last_name_second']);
		$stmt->bindParam(":email", $data['email']);
		$stmt->bindParam(":phone", $data['phone']);
		$stmt->bindParam(":mobile", $data['mobile']);
		$stmt->bindParam(":address", $data['address']);
		$stmt->bindParam(":town", $data['town']);
		$stmt->bindParam(":city", $data['city']);
		$stmt->bindParam(":state", $data['state']);
		$stmt->bindParam(":cp", $data['cp']);
		$stmt->bindParam(":notes", $data['notes']);
		$stmt->bindParam(':id', $id_user);

		return $stmt->execute();
	}

	//obtenerClientePorId
	// public static function obtenerClientePorId($id_user)
	// {
	// 	try {
	// 		$conexion = Conexion::conectar();
	// 		$stmt = $conexion->prepare("SELECT id_user, name, last_name, last_name_second, email, phone, mobile, address, num_int, num_ext, town, city, state, cp, discounts_books, discounts_bibles, discounts_gifts, notifications, type_user, notes, gender, position FROM clients WHERE id_user = :id_user");
	// 		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	// 		$stmt->execute();
	// 		return $stmt->fetch(PDO::FETCH_ASSOC);
	// 	} catch (PDOException $e) {
	// 		// Manejo de la excepción
	// 		echo "Error: " . $e->getMessage();
	// 		return null;
	// 	}
	// }


	// Obtener clientes
	// public static function obtenerClientes($pagina = 1, $numItems = 10)
	// {
	// 	$inicio = ($pagina - 1) * $numItems;
	// 	$stmt = Conexion::conectar()->prepare("SELECT name, last_name, last_name_second, email, phone, mobile, address, num_int, num_ext, town, city, state, cp, discounts_books, discounts_bibles, discounts_gifts, notifications, type_user FROM clients LIMIT :inicio, :numItems");
	// 	$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
	// 	$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll();
	// }


	// Obtener total de clientes registrados
	public static function obtenerNumeroTotalClientes()
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM clients");
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	// public static function obtenerClientes($pagina = 1, $numItems = 10, $filtro = '')
	// {
	// 	$inicio = ($pagina - 1) * $numItems;
	// 	// $consulta = "SELECT * FROM clients WHERE username LIKE :filtro OR trading_name LIKE :filtro OR legalname LIKE :filtro OR name LIKE :filtro OR last_name LIKE :filtro OR last_name_second LIKE :filtro OR email LIKE :filtro OR phone = :filtro OR address LIKE :filtro LIMIT :inicio, :numItems";
	// 	$consulta = "SELECT * FROM clients  LIMIT :inicio, :numItems";
	// 	$stmt = Conexion::conectar()->prepare($consulta);
	// 	$filtro = "%$filtro%";
	// 	$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
	// 	$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
	// 	$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll();
	// }


	// Función para obtener clientes - anterior
	// public static function obtenerClientes($pagina = 1, $numItems = 10, $filtro = '')
	// {
	// 	$inicio = ($pagina - 1) * $numItems;
	// 	$filtro = "%$filtro%";
	// 	$consulta = "SELECT * FROM clients WHERE 
	//             username LIKE :filtro OR 
	//             trading_name LIKE :filtro OR 
	//             legal_name LIKE :filtro OR 
	//             name LIKE :filtro OR 
	//             last_name LIKE :filtro OR 
	//             last_name_second LIKE :filtro OR 
	//             email LIKE :filtro OR 
	//             phone LIKE :filtro OR 
	//             address LIKE :filtro 
	// 			AND status LIKE '1' 
	//             LIMIT :inicio, :numItems";

	// 	$stmt = Conexion::conectar()->prepare($consulta);
	// 	$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
	// 	$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
	// 	$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(); 
	// }

	//Nueva función para obtener clientes:
	public static function obtenerClientes($pagina = 1, $numItems = 10, $filtro = '')
	{
		$inicio = ($pagina - 1) * $numItems;
		$filtro = "%$filtro%";

		// La consulta ahora incluye un LEFT JOIN con la tabla balances
		$consulta = " SELECT   c.*,
            IFNULL(SUM(b.cash_balance), 0) AS cash_balance,  
            IFNULL(SUM(b.trade_balance), 0) AS trade_balance  
				FROM 
					clients c
				LEFT JOIN 
					balances b ON c.id_user = b.id_user
				WHERE 
					(c.username LIKE :filtro OR 
					c.trading_name LIKE :filtro OR 
					c.legal_name LIKE :filtro OR 
					c.name LIKE :filtro OR 
					c.last_name LIKE :filtro OR 
					c.last_name_second LIKE :filtro OR 
					c.email LIKE :filtro OR 
					c.phone LIKE :filtro OR 
					c.address LIKE :filtro)
					AND c.status LIKE '1'
				GROUP BY 
					c.id_user
				LIMIT 
            :inicio, :numItems";

		$stmt = Conexion::conectar()->prepare($consulta);
		$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
		$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}


	public static function obtenerNumeroTotalClientesConFiltro($filtro = '')
	{
		$consulta = "SELECT COUNT(*) FROM clients WHERE name LIKE :filtro OR last_name LIKE :filtro OR last_name_second LIKE :filtro OR email LIKE :filtro OR phone LIKE :filtro OR address LIKE :filtro";
		$stmt = Conexion::conectar()->prepare($consulta);
		$filtro = "%$filtro%";
		$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	// Obtener total de Productos registrados
	public static function obtenerNumeroTotalProductos()
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM products");
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	public static function obtenerProductos($pagina = 1, $numItems = 20, $filtro = '')
	{
		$inicio = ($pagina - 1) * $numItems;
		$consulta = "SELECT * FROM products WHERE description LIKE :filtro OR author LIKE :filtro OR category LIKE :filtro OR SKU LIKE :filtro OR ISBN LIKE :filtro OR publisher LIKE :filtro  LIMIT :inicio, :numItems";
		$stmt = Conexion::conectar()->prepare($consulta);
		$filtro = "%$filtro%";
		$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
		$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public static function obtenerNumeroTotalProductosConFiltro($filtro = '')
	{
		$consulta = "SELECT COUNT(*) FROM products WHERE description LIKE :filtro OR author LIKE :filtro OR category LIKE :filtro OR SKU LIKE :filtro OR ISBN LIKE :filtro OR publisher LIKE :filtro ";
		$stmt = Conexion::conectar()->prepare($consulta);
		$filtro = "%$filtro%";
		$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	//OPERACIONES
	public static function obtenerOperaciones($pagina = 1, $numItems = 20, $filtro = '')
	{
		$inicio = ($pagina - 1) * $numItems;
		$consulta = "SELECT * FROM operations o ORDER BY o.operation_id DESC LIMIT :inicio, :numItems";
		$stmt = Conexion::conectar()->prepare($consulta);

		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
		$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);

		$stmt->execute();
		$operaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Agregar nombres de comprador y vendedor
		foreach ($operaciones as &$operacion) {
			$operacion['buyer_info'] = Consultas::obtenerNombreCliente($operacion['buyer_id']);
			$operacion['seller_info'] = Consultas::obtenerNombreCliente($operacion['seller_id']);
		}

		return $operaciones;
	}

	// Cambiar Status 
	public static function actualizarEstadoOperacion($operationId, $newStatus)
	{
		try {
			$sql = "UPDATE operations SET status = :newStatus WHERE operation_id = :operationId";
			$stmt = self::conectar()->prepare($sql);
			$stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
			$stmt->bindParam(':operationId', $operationId, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->rowCount() > 0;
		} catch (PDOException $e) {
			error_log('Error actualizando el estado de la operación: ' . $e->getMessage());
			return false;
		}
	}

	//Mostrar datos del Site.php Dashboard
	public static function obtenerClientesActivos()
	{
		try {
			$sql = "SELECT COUNT(*) as total FROM clients WHERE status = 1";
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['total'];
		} catch (PDOException $e) {
			error_log('Error obteniendo clientes activos: ' . $e->getMessage());
			return 0;
		}
	}

	public static function obtenerTotalClientesRegistrados()
	{
		try {
			$sql = "SELECT COUNT(*) as total FROM clients";
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['total'];
		} catch (PDOException $e) {
			error_log('Error obteniendo el total de clientes registrados: ' . $e->getMessage());
			return 0;
		}
	}

	//Operaciones Realizadas
	public static function obtenerTotalOperaciones()
	{
		try {
			$sql = "SELECT COUNT(*) as total FROM operations";
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute();
			$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
			return $resultado['total'];
		} catch (PDOException $e) {
			error_log('Error obteniendo el total de operaciones: ' . $e->getMessage());
			return 0;
		}
	}



	// Obtener BALANCE
	// public static function obtenerBalancesPorUsuario($id_user)
	// {
	// 	try {
	// 		$sql = "SELECT * FROM balances WHERE id_user = :id_user";
	// 		$stmt = self::conectar()->prepare($sql);
	// 		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
	// 		$stmt->execute();
	// 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	} catch (PDOException $e) {
	// 		error_log('Error obteniendo balances por usuario: ' . $e->getMessage());
	// 		return [];
	// 	}
	// }
	// Obtener BALANCE
	public static function obtenerBalancesPorUsuario($id_user)
	{
		try {
			$sql = "SELECT b.*, c.trading_name, c.legal_name, c.email 
	            FROM balances b 
	            JOIN clients c ON b.id_user = c.id_user 
	            WHERE b.id_user = :id_user";
			$stmt = self::conectar()->prepare($sql);
			$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log('Error obteniendo balances por usuario: ' . $e->getMessage());
			return [];
		}
	}

	//obtenga los datos necesarios de todas las operaciones por cliente: 

	public static function obtenerBalancesAgrupadosTotales()
	{
		try {
			$sql = "
				SELECT 
					c.id_user,
					c.username,
					c.trading_name,
					c.legal_name,
					c.email,
					SUM(b.trade_sales) AS total_trade_sales,
					SUM(b.cash_sales) AS total_cash_sales,
					SUM(b.trade_purchases) AS total_trade_purchases,
					SUM(b.cash_purchases) AS total_cash_purchases,
					SUM(b.trade_commission) AS total_trade_commission,
					SUM(b.cash_commission) AS total_cash_commission,
					SUM(b.trade_balance) AS total_trade_balance,
					SUM(b.cash_balance) AS total_cash_balance
				FROM balances b
				JOIN clients c ON b.id_user = c.id_user 
				GROUP BY c.id_user
				ORDER BY total_trade_balance DESC"; // Ordenar por Balance en Intercambio de mayor a menor
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log('Error obteniendo balances agrupados: ' . $e->getMessage());
			return [];
		}
	}




	// insertar los datos en la tabla balances:
	public static function insertarBalance($balanceData)
	{
		try {
			$sql = "INSERT INTO balances (id_user, username, type_operation, name_transaction, date_transaction, trade_sales, cash_sales, trade_purchases, cash_purchases, trade_commission, cash_commission, trade_balance, cash_balance, operation_id)
					VALUES (:id_user, :username, :type_operation, :name_transaction, :date_transaction, :trade_sales, :cash_sales, :trade_purchases, :cash_purchases, :trade_commission, :cash_commission, :trade_balance, :cash_balance, :operation_id)";
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute([
				':id_user' => $balanceData['id_user'],
				':username' => $balanceData['username'],
				':type_operation' => $balanceData['type_operation'],
				':name_transaction' => $balanceData['name_transaction'],
				':date_transaction' => $balanceData['date_transaction'],
				':trade_sales' => $balanceData['trade_sales'],
				':cash_sales' => $balanceData['cash_sales'],
				':trade_purchases' => $balanceData['trade_purchases'],
				':cash_purchases' => $balanceData['cash_purchases'],
				':trade_commission' => $balanceData['trade_commission'],
				':cash_commission' => $balanceData['cash_commission'],
				':trade_balance' => $balanceData['trade_balance'],
				':cash_balance' => $balanceData['cash_balance'],
				':operation_id' => $balanceData['operation_id']
			]);
			return $stmt->rowCount() > 0;
		} catch (PDOException $e) {
			error_log('Error insertando balance: ' . $e->getMessage());
			return false;
		}
	}

	//Agrega la función reversaBalance para revbertir una operación en la tabla balances:
	public static function reversaBalance($operation_id)
	{
		try {
			$stmt = self::conectar()->prepare("DELETE FROM balances WHERE operation_id = :operation_id");
			$stmt->bindParam(':operation_id', $operation_id, PDO::PARAM_INT);
			return $stmt->execute();
		} catch (PDOException $e) {
			error_log("Error en reversaBalance: " . $e->getMessage());
			return false;
		}
	}




	//Obtener el Username
	public static function obtenerUsername($id_user)
	{
		try {
			$sql = "SELECT username FROM clients WHERE id_user = :id_user";
			$stmt = self::conectar()->prepare($sql);
			$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result ? $result['username'] : '';
		} catch (PDOException $e) {
			error_log('Error obteniendo username: ' . $e->getMessage());
			return '';
		}
	}


	//Comisión mensual
	public static function obtenerClientesSinComision()
	{
		try {
			$sql = "SELECT id_user, username FROM clients WHERE m_commision = 0";
			$stmt = self::conectar()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log('Error obteniendo clientes sin comisión: ' . $e->getMessage());
			return [];
		}
	}






	// PEDIDOS
	public static function obtenerPedidos($pagina = 1, $numItems = 20)
	{
		$inicio = ($pagina - 1) * $numItems;
		// Ajusta esta consulta para seleccionar los campos que necesitas de la tabla orders y posiblemente joins con otras tablas si es necesario
		$consulta = "SELECT * FROM orders o   ORDER BY o.order_date DESC LIMIT :inicio, :numItems";
		$stmt = Conexion::conectar()->prepare($consulta);

		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_INT);
		$stmt->bindParam(":numItems", $numItems, PDO::PARAM_INT);

		$stmt->execute();
		return $stmt->fetchAll();
	}

	public static function obtenerNombresUsuario($id_user)
	{
		$sql = "SELECT nick_user, first_name_user, last_name_user, mail_user FROM users WHERE id_user= :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado) {
			return $resultado; // Retorna el array con nick_user, first_name_user, y last_name_user
		} else {
			// Regresa un array vacío o con valores predeterminados si no hay resultados
			return ['nick_user' => '', 'first_name_user' => '', 'last_name_user' => ''];
		}
	}

	public static function obtenerNombreCliente($id_user)
	{

		$sql = "SELECT * FROM clients WHERE id_user = :id_user";
		$stmt = self::conectar()->prepare($sql);
		$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		if ($resultado) {
			return $resultado; // Retorna el array con nick_user, first_name_user, y last_name_user
		} else {
			// Regresa un array vacío o con valores predeterminados si no hay resultados
			// return ['nick_user' => '', 'first_name_user' => '', 'last_name_user' => ''];
			return ['name' => '', 'last_name' => '', 'last_name_second' => '', 'email' => ''];
		}
	}




	// ---------------------------------------------------------------------------------------------------------------------------------------


	//Listado de Asociados
	public function listarAsociados()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, tipo FROM usuarios WHERE tipo like 'asociado'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Listado de Combustibles
	public function listarCombustible()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, combustible  FROM combustible WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//Listado de Tipo de Autos
	public function listarTipo()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, tipo  FROM tipo WHERE 1");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


	public static function registraEncuesta($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla  ( note,  observaciones, id_usuario, geoloc, encuesta_code,  id_asociado, alc, calle, next,  nint, col, sec,  cred,  gen,  p_1,  p_2, p_2_a, p_2_b, p_2_c,  p_3,  p_4,  p_5,  p_6,       p_6_a,p_6_b,p_6_c,p_6_d,p_6_e,p_6_f,p_6_g,p_6_h,      p_7,  p_7_a, p_7_b, p_7_c, p_7_d, p_7_e, p_7_f, p_7_g, p_7_h, p_7_i, p_7_j, p_7_k, p_7_l, p_7_m, p_7_n, p_7_o,           p_8, p_8_a, p_8_b, p_8_c, p_8_d, p_8_e, p_8_f, p_8_g, p_8_h, p_8_i, p_8_j, p_8_k, p_8_l, p_8_m, p_8_n, p_8_o,   p_9,  p_10, p_11,         p_12,     p_13, p_13_a, p_13_b, p_13_c, p_13_d,  p_14, p_14_a, p_14_b, p_14_c, p_14_d,  p_15, p_15_a, p_15_b, p_15_c, p_15_d,  p_16, p_16_a, p_16_b, p_16_c, p_16_d,   p_17, p_17_a, p_17_b, p_17_c, p_17_d,   p_18, p_18_a, p_18_b, p_18_c, p_18_d,  p_19, p_19_a, p_19_b, p_19_c, p_19_d,  p_20, p_21, p_22, p_23   ) "
			. "                               VALUES (:note, :observaciones,:id_usuario,:geoloc,:encuesta_code, :id_asociado,:alc,:calle,:next, :nint, :col,:sec, :cred, :gen, :p_1, :p_2,  :p_2_a,  :p_2_b,  :p_2_c, :p_3, :p_4, :p_5, :p_6,:p_6_a,:p_6_b,:p_6_c,:p_6_d,:p_6_e,:p_6_f,:p_6_g,:p_6_h,    :p_7,:p_7_a,:p_7_b,:p_7_c,:p_7_d,:p_7_e,:p_7_f,:p_7_g,:p_7_h,:p_7_i,:p_7_j, :p_7_k, :p_7_l, :p_7_m, :p_7_n,:p_7_o,   :p_8,:p_8_a,:p_8_b,:p_8_c,:p_8_d,:p_8_e,:p_8_f,:p_8_g,:p_8_h,:p_8_i,:p_8_j, :p_8_k, :p_8_l, :p_8_m, :p_8_n, :p_8_o,          :p_9, :p_10, :p_11, :p_12,   :p_13,:p_13_a,:p_13_b,:p_13_c,:p_13_d, :p_14,:p_14_a,:p_14_b,:p_14_c,:p_14_d,  :p_15,:p_15_a,:p_15_b,:p_15_c,:p_15_d, :p_16,:p_16_a,:p_16_b,:p_16_c,:p_16_d,  :p_17,:p_17_a,:p_17_b,:p_17_c,:p_17_d, :p_18,:p_18_a,:p_18_b,:p_18_c,:p_18_d, :p_19,:p_19_a,:p_19_b,:p_19_c,:p_19_d, :p_20, :p_21, :p_22, :p_23   )");
		$stmt->bindParam(":note", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":geoloc", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":encuesta_code", $datosModel[4], PDO::PARAM_STR);
		$stmt->bindParam(":id_asociado", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":alc",  $datosModel[6], PDO::PARAM_INT);
		$stmt->bindParam(":calle", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":next", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":nint", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":col",  $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":sec",  $datosModel[11], PDO::PARAM_INT);
		$stmt->bindParam(":cred", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":gen",  $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":p_1", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":p_2", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_a", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_b", $datosModel[17], PDO::PARAM_STR);
		$stmt->bindParam(":p_2_c", $datosModel[18], PDO::PARAM_STR);
		$stmt->bindParam(":p_3", $datosModel[19], PDO::PARAM_STR);
		$stmt->bindParam(":p_4", $datosModel[20], PDO::PARAM_STR);
		$stmt->bindParam(":p_5", $datosModel[21], PDO::PARAM_STR);
		$stmt->bindParam(":p_6", $datosModel[22], PDO::PARAM_STR);
		$stmt->bindParam(":p_6_a", $datosModel[23], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_b", $datosModel[24], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_c", $datosModel[25], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_d", $datosModel[26], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_e", $datosModel[27], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_f", $datosModel[28], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_g", $datosModel[29], PDO::PARAM_INT);
		$stmt->bindParam(":p_6_h", $datosModel[30], PDO::PARAM_INT);
		$stmt->bindParam(":p_7", $datosModel[31], PDO::PARAM_STR);
		$stmt->bindParam(":p_7_a", $datosModel[32], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_b", $datosModel[33], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_c", $datosModel[34], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_d", $datosModel[35], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_e", $datosModel[36], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_f", $datosModel[37], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_g", $datosModel[38], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_h", $datosModel[39], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_i", $datosModel[40], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_j", $datosModel[41], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_k", $datosModel[42], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_l", $datosModel[43], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_m", $datosModel[44], PDO::PARAM_INT);
		$stmt->bindParam(":p_7_n", $datosModel[45], PDO::PARAM_INT);
		$stmt->bindParam(":p_8",  $datosModel[46], PDO::PARAM_STR);
		$stmt->bindParam(":p_8_a", $datosModel[47], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_b", $datosModel[48], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_c", $datosModel[49], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_d", $datosModel[50], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_e", $datosModel[51], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_f", $datosModel[52], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_g", $datosModel[53], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_h", $datosModel[54], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_i", $datosModel[55], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_j", $datosModel[56], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_k", $datosModel[100], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_l", $datosModel[101], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_m", $datosModel[102], PDO::PARAM_INT);
		$stmt->bindParam(":p_8_n", $datosModel[103], PDO::PARAM_INT);
		$stmt->bindParam(":p_9", $datosModel[57], PDO::PARAM_STR);
		$stmt->bindParam(":p_10", $datosModel[58], PDO::PARAM_STR);
		$stmt->bindParam(":p_11", $datosModel[59], PDO::PARAM_STR);
		$stmt->bindParam(":p_12", $datosModel[60], PDO::PARAM_STR);
		$stmt->bindParam(":p_13", $datosModel[61], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_a", $datosModel[62], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_b", $datosModel[63], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_c", $datosModel[64], PDO::PARAM_STR);
		$stmt->bindParam(":p_13_d", $datosModel[65], PDO::PARAM_STR);
		$stmt->bindParam(":p_14", $datosModel[66], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_a", $datosModel[67], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_b", $datosModel[68], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_c", $datosModel[69], PDO::PARAM_STR);
		$stmt->bindParam(":p_14_d", $datosModel[70], PDO::PARAM_STR);
		$stmt->bindParam(":p_15", $datosModel[71], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_a", $datosModel[72], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_b", $datosModel[73], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_c", $datosModel[74], PDO::PARAM_STR);
		$stmt->bindParam(":p_15_d", $datosModel[75], PDO::PARAM_STR);
		$stmt->bindParam(":p_16", $datosModel[76], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_a", $datosModel[77], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_b", $datosModel[78], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_c", $datosModel[79], PDO::PARAM_STR);
		$stmt->bindParam(":p_16_d", $datosModel[80], PDO::PARAM_STR);
		$stmt->bindParam(":p_17", $datosModel[81], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_a", $datosModel[82], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_b", $datosModel[83], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_c", $datosModel[84], PDO::PARAM_STR);
		$stmt->bindParam(":p_17_d", $datosModel[85], PDO::PARAM_STR);
		$stmt->bindParam(":p_18", $datosModel[86], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_a", $datosModel[87], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_b", $datosModel[88], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_c", $datosModel[89], PDO::PARAM_STR);
		$stmt->bindParam(":p_18_d", $datosModel[90], PDO::PARAM_STR);
		$stmt->bindParam(":p_19", $datosModel[91], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_a", $datosModel[92], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_b", $datosModel[93], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_c", $datosModel[94], PDO::PARAM_STR);
		$stmt->bindParam(":p_19_d", $datosModel[95], PDO::PARAM_STR);
		$stmt->bindParam(":p_20", $datosModel[96], PDO::PARAM_STR);
		$stmt->bindParam(":p_21", $datosModel[97], PDO::PARAM_STR);
		$stmt->bindParam(":p_22", $datosModel[98], PDO::PARAM_STR);
		$stmt->bindParam(":p_23", $datosModel[99], PDO::PARAM_STR);
		$stmt->bindParam(":p_7_o", $datosModel[100], PDO::PARAM_STR);
		$stmt->bindParam(":p_8_o", $datosModel[101], PDO::PARAM_STR);

		// $stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function registrarInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo, version, ano, precio, transmision, combustible, kilometraje, color_int, color_ext, tam_motor, cilindros, note, observaciones, img, id_usuario) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo, :version, :ano, :precio, :transmision, :combustible, :kilometraje, :color_int, :color_ext, :tam_motor, :cilindros, :note, :observaciones, :img, :idUser)");
		//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code, id_asociado, condicion, tipo, marca, modelo) VALUES (:car_code, :asociado, :condicion, :tipo, :marca, :modelo)");
		//		$stmt=Conexion::conectar()->prepare("INSERT INTO $tabla (car_code ) VALUES (:car_code )");
		$stmt->bindParam(":car_code", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":asociado", $datosModel[1], PDO::PARAM_INT);
		$stmt->bindParam(":condicion", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datosModel[4], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datosModel[5], PDO::PARAM_STR);
		$stmt->bindParam(":version", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":ano", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datosModel[8], PDO::PARAM_INT);
		$stmt->bindParam(":transmision", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":combustible", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje", $datosModel[11], PDO::PARAM_INT);
		$stmt->bindParam(":color_int", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":color_ext", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":tam_motor", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":cilindros", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":note", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datosModel[17], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[18], PDO::PARAM_STR);
		$stmt->bindParam(":idUser", $datosModel[19], PDO::PARAM_INT);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function registrarMarcas($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (DENOM,CLASE,TITULAR,NO_REG,NO_SOL,ULTIMA_CERT_NOTARIAL,VIGENCIA,PAIS_ORI,C_LINK,C_TEL,C_FAX,C_EMAIL,PROD_SERV,AUTORIZADOS,URL_FUENTE,OBS,IMG,ID_USUARIO) VALUES (:denom, :clase, :titular, :no_reg, :no_sol, :ultima_cert, :vigencia, :pais, :link, :tel, :fax, :correo, :servicio, :autorizados, :fuente, :obs, :img, :idUser)");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":ultima_cert", $datosModel[16], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":idUser", $datosModel[17], PDO::PARAM_INT);

		//$stmt->execute();

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function registrarUsuarios($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, correo, password, confirmPass, tipo) VALUES (:usuario, :correo, :password, :confirmPass, :tipo)");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":confirmPass", md5($datosModel[2]), PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[3], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function validarRegistroUsuario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT usuario, correo FROM $tabla WHERE usuario = :usuario AND correo = :correo");
		$stmt->bindParam(":usuario", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[1], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	//        Inventario
	public static function listarEncuesta()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas ORDER BY id DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}



	public static function listarEncuestaCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id_usuario=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	// Define total de usaurios Aosciados
	public static function listarCapturistas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM `usuarios` WHERE `tipo` LIKE 'capturista'");
		//		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public function sumaInventario()
	{
		$stmt = Conexion::conectar()->prepare("SELECT sum(`precio`) FROM `inventario` WHERE 1 ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function encuestadosGenero()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `gen`, count(*) TOTAL FROM `encuestas` GROUP BY `gen` ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function encuestaP1()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `p_1` P1, count(*) TOTAL FROM `encuestas` GROUP BY `p_1` ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	// Función genérica
	public static function encuestaPreguntas($var)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $var, count(*) TOTAL FROM `encuestas` GROUP BY $var ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function encuestaResultados()
	{
		$stmt = Conexion::conectar()->prepare("SELECT SUM(`p_1`) P2_A, SUM(`p_2_a`) P2_B, SUM(`p_2_b`) P2_C, SUM(`p_2_c`) P2_C FROM `encuestas` ");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	public static function cuentaEncuestas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM `encuestas` GROUP BY ID");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function detalleInventario($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM inventario WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	public function detalleEncuesta($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public static function listarEncuestasCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM encuestas WHERE id_usuario=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function modificarInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":ultima", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[17], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarInventario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function eliminarCliente($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_user = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function obtenerClientePorId($id_user)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM clients WHERE id_user = :id");
		$stmt->bindParam(":id", $id_user, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


	public static function eliminarEncuesta($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	//filtrado de Inventario por 
	static public function filtroInventario($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE marca LIKE :marca1 OR modelo LIKE :modelo1 OR version LIKE :version1 OR ano LIKE :ano1 OR car_code LIKE :car_code1 ");
		//		$stmt->bindValue(2, '%'.trim($datosModel[0]).'%', PDO::PARAM_STR);
		$stmt->bindValue(':marca1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':modelo1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':version1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':ano1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->bindValue(':car_code1', '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//        Marcas
	public function listarMarcas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public function listarMarcasCapturista($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE ID_USUARIO=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


	public static function tagCategorias($clases)
	{
		$stmt = Conexion::conectar()->prepare("SELECT tag FROM categorias WHERE id IN (:clases)");
		$stmt->bindParam(":clases", $clases, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		//return $clases;
		$stmt->close();
	}

	public function detalleMarca($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM marcas WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	public function modificarMarca($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET DENOM=:denom,CLASE=:clase,TITULAR=:titular,NO_REG=:no_reg,NO_SOL=:no_sol, ULTIMA_CERT_NOTARIAL=:ultima,VIGENCIA=:vigencia,PAIS_ORI=:pais,C_LINK=:link,C_TEL=:tel,C_FAX=:fax,C_EMAIL=:correo,PROD_SERV=:servicio,AUTORIZADOS=:autorizados,URL_FUENTE=:fuente,OBS=:obs,IMG=:img WHERE ID=:id");
		$stmt->bindParam(":denom", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":clase", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":no_reg", $datosModel[4], PDO::PARAM_INT);
		$stmt->bindParam(":no_sol", $datosModel[5], PDO::PARAM_INT);
		$stmt->bindParam(":vigencia", $datosModel[6], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":link", $datosModel[11], PDO::PARAM_STR);
		$stmt->bindParam(":tel", $datosModel[9], PDO::PARAM_STR);
		$stmt->bindParam(":fax", $datosModel[10], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel[8], PDO::PARAM_STR);
		$stmt->bindParam(":servicio", $datosModel[13], PDO::PARAM_STR);
		$stmt->bindParam(":autorizados", $datosModel[7], PDO::PARAM_STR);
		$stmt->bindParam(":fuente", $datosModel[12], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datosModel[14], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datosModel[15], PDO::PARAM_STR);
		$stmt->bindParam(":ultima", $datosModel[16], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[17], PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public static function eliminarMarca($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function listarUsuarios()
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, correo, tipo, telefono FROM usuarios");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function actualizarTipoUsuario($id, $nuevoTipo)
	{
		try {
			$stmt = self::conectar()->prepare("UPDATE usuarios SET tipo = :tipo WHERE id = :id");
			$stmt->bindParam(':tipo', $nuevoTipo, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			return $stmt->execute();
		} catch (PDOException $e) {
			error_log('Error actualizando tipo de usuario: ' . $e->getMessage());
			return false;
		}
	}


	public function detalleUsuario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public function datosUsuario($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM  usuarios WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarUsuario($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public function listarCategorias()
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM categorias ORDER BY ID");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//        Listar TIPO Autos para gráfica
	public function listarTipoAutos()
	{
		$stmt = Conexion::conectar()->prepare("SELECT `tipo`, COUNT(*) FROM `inventario` GROUP BY `tipo`");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function registrarCategoria($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (CLASE, TIPO, TAG, DESCRIPCION) VALUES (:clase, :tipo, :tag, :descripcion)");
		$stmt->bindParam(":clase", $datosModel[3], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":tag", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
	}

	public function nuevaCategoria($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ID DESC LIMIT 1");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function eliminarCategoria($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function modificarCategoria($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET TIPO=:tipo, TAG=:tag, DESCRIPCION=:descripcion WHERE ID=:id");
		$stmt->bindParam(":tipo", $datosModel[0], PDO::PARAM_STR);
		$stmt->bindParam(":tag", $datosModel[1], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel[2], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel[3], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public function estadisticasPorCategorias()
	{
		$stmt = Conexion::conectar()->prepare("SELECT b.tag, COUNT(CASE WHEN a.CLASE = b.ID THEN 1 ELSE null END) AS total FROM marcas a INNER JOIN categorias b GROUP BY b.TAG");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function listarMarcasPorCapturistas()
	{
		$stmt = Conexion::conectar()->prepare("SELECT a.*, b.usuario FROM marcas a INNER JOIN usuarios b WHERE a.ID_USUARIO=b.id AND b.tipo='capturista'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function registrarBitacora($usuario, $tabla, $accion)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, accion) VALUES (:usuario, :accion)");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":accion", $accion, PDO::PARAM_STR);
		//$stmt->execute()
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
	}

	public static function bitacoraInicio($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC LIMIT 1,10");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	public static function bitacora($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC ");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function bitacoraFechas($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(substring(fecha,1,10)) AS fechas FROM $tabla ORDER BY fechas DESC");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public function bitacoraPerfil($tabla, $usuario)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario=:usuario ORDER BY fecha DESC");
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function filtroMarcas($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE denom LIKE ?");
		$stmt->bindValue(1, '%' . trim($datosModel[0]) . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	static public function datosPerfil($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	static public function actualizarUsuario($datosModel, $tabla)
	{
		if (count($datosModel) <= 2) {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario WHERE id=:id");
			$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam("usuario", $datosModel[1], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
		} else {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario, password=:nuevoPassword, confirmPass=:confirmNuevoPass WHERE id=:id");
			$stmt->bindParam(":id", $datosModel[0], PDO::PARAM_INT);
			$stmt->bindParam(":usuario", $datosModel[1], PDO::PARAM_STR);
			$stmt->bindParam(":nuevoPassword", $datosModel[2], PDO::PARAM_STR);
			$stmt->bindParam("confirmNuevoPass", $datosModel[3], PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
			$stmt->close();
		}
	}
}
