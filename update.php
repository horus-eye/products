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

    // Obtener el producto de la base de datos
    $sql = "SELECT * FROM tienda WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portafolio web con html, css, jQuery y bootstrap 5">
  <meta name="keywords" content="Portafolio web, desarrollador web,portafolio con html css jQuery bootstrap v5">
  <title>Editar Producto</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="css/products.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row header mx-auto">
      <div class="col-12 mx-auto justify-content-center">
        <h1 class="text-center text-muted mt-2">EDITAR PRODUCTO <span><i class="fa-solid fa-basket-shopping"></i></span>
        </h1>
      </div>
    </div>

    <div class="row">
      <div class="form col-12 col-md-8 mx-auto mt-3  justify-content-center">
        <form class="form justify-content center text-muted" action="update_product.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
          <input class="form-control mt-2 mb-2" type="text" name="articulo" placeholder="articulo" maxlength="20" required
            value="<?php echo $product['articulo']; ?>" />
          <input class="form-control mt-2 mb-2" type="text" name="descripcion" placeholder="descripcion"
            maxlength="100" required value="<?php echo $product['descripcion']; ?>" />
          <input class="form-control mt-2 mb-2" type="number" step="0.01" min="0" name="precio" placeholder="$ precio"
            required value="<?php echo $product['precio']; ?>" />
          <button class="btn btn-success" type="submit">Actualizar</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/Wcn6cR4ojDK8a0mvP3r92BrMoFuKUq9Myc8W6G6J51HKIbNNENWd7ltBbdXdpBG" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
    $("input[name='articulo']").focus();
    })
   </script>

</body>

</html>
