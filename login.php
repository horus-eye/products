<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Crear una conexión
    $conn = new mysqli("localhost", "root", "", "productos");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }

    // Escapar los valores de usuario y contraseña para evitar ataques de inyección SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Aplicar el hash SHA1 a la contraseña ingresada
    $password = sha1($password);

    // Realizar la consulta para verificar las credenciales de username y password
    $query = "SELECT * FROM administracion WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
          // Iniciar sesión
    $_SESSION["logged_in"] = true;
        // Credenciales de username y password válidas
        header("Location: products.php");
        exit();
        } else {
            // Credenciales de username y password válidas
            header("Location: login.php");
            exit();
        }
    } else {
        // Credenciales inválidas, mostrar un mensaje de error o realizar alguna acción adicional
        header("Location: index.php?error=Usuario o contraseña incorrectos");
        exit();
    }

    // Cerrar la conexión
    $conn->close();

?>
