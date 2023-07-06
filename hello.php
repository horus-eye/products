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

// Obtener registros de la base de datos
$sql = "SELECT * FROM tienda";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portafolio web con html, css, jQuery y bootstrap 5">
  <meta name="keywords" content="Portafolio web, desarrollador web,portafolio con html css jQuery bootstrap v5">
  <title>Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="css/products.css">
</head>

<body style="background-image: url('background-image.jpg'); background-size: cover;">

  <div class="container-fluid">
    <div class="row header mt-3">
      <div class="col-12">
        <h1 class="text-center text-muted">LISTA DE PRODUCTOS  <span><i class="fa-solid fa-basket-shopping"></i></span></h1>
      </div>
      <div class="addProduct col-12 col-md-8 mx-auto mt-5">
        <h2 class="add text-center text-muted">Agregar producto <i class="fas fa-plus-circle"></i></h2>
      </div>
      <div class="col-12 col-md-8 mx-auto mt-3 ">
        <form class="form " action="create.php" method="POST">
          <div class="mb-3">
            <input id="art"  class="form-control" type="text" name="articulo" placeholder="Articulo" maxlength="20" required >
          </div>
          <div class="mb-3">
            <input class="form-control" type="text" name="descripcion" placeholder="Descripcion" maxlength="100" required>
          </div>
          <div class="mb-3">
            <input class="form-control" type="number" step="0.01" min="0" name="precio" placeholder="$ Precio" required>
          </div>
          <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Agregar</button>
        </form>
      </div>
    </div>

    <div class="row d-flex">
      <div class="col-12 mt-5">
        <div class="search-container mb-3">
          <div class="input-group">
            <input name="search" type="text" id="search-input" class="form-control" placeholder="Buscar por artículo o precio">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
        </div>

        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-center">
              <th>Id</th>
              <th>Articulo</th>
              <th>Descripcion</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='text-center'>" . $row["id"] . "</td>";
                echo "<td class='article '>" . $row["articulo"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td class='price text-center'>"."$" . number_format($row["precio"], 2, '.', ',') . "</td>";
                echo "<td class='text-center'>";
                echo "<form class='d-inline' action='update.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                echo "<button class='btn btn-primary ms-2 mt-1' type='submit'><i class='fas fa-edit'></i> Editar</button>";
                echo "</form>";
                echo "<form class='d-inline' action='delete.php' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
                echo "<button class='btn btn-danger ms-2 mt-1' type='submit'><i class='fas fa-trash'></i> Eliminar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='5' class='text-center'>No se encontraron productos</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
 <!-- Confirm Delete Modal -->
 <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de eliminar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form class="d-inline" action="delete.php" method="POST">
            <input type="hidden" name="id" value="">
            <button class="btn btn-danger" type="submit">Eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteSuccessModalLabel">Producto eliminado con éxito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>El producto ha sido eliminado exitosamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</div>
  <div class="col-12 text-center mt-2 mb-3"><a class="logout" href="logout.php">Cerrar Sesion</a></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="scripts/functions.js"></script>
</body>

</html>
