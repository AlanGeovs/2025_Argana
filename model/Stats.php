<?php
require_once "conexion.php";

class Stats
{
    protected static function conectar()
    {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=dbi6bdhoqxrrng', 'uqnnskgagovis', 'kqgsgdipj2vs');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getTotalArticulos()
    {
        $db = self::conectar();
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public static function getTotalArticulosPorCategoria($categoria)
    {
        $db = self::conectar();
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM products WHERE category = :category");
        $stmt->bindParam(':category', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
