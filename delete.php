<?php
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: index.php");
    exit();
}

// Incluir el archivo de conexión
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM tienda WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirigir al usuario de vuelta a la página principal
    header("Location: products.php");
    exit();
}
?>
