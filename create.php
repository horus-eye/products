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
    $article = $_POST["articulo"];
    $description = $_POST["descripcion"];
    $price = $_POST["precio"];

    // Insertar el nuevo producto en la base de datos
    $sql = "INSERT INTO tienda (articulo, descripcion, precio) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $article, $description, $price);
    $stmt->execute();
    $stmt->close();

    // Redirigir al usuario de vuelta a la página principal
    header("Location: products.php");
    exit();
}
?>
