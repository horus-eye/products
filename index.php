<?php
session_start();

// Verificar si la sesión está activa
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    // Redirigir al usuario a la página de inicio después de iniciar sesión
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="products.css">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Inicio de sesión</h5>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label" for="username"><i class="text-muted fas fa-user mt-2"></i> Usuario</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password"><i class="fas fa-lock mt-2 text-muted"></i> Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control mt-2" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                        </form>
                        <?php
                        if (isset($_GET['error'])) {
                            $error_message = $_GET['error'];
                            echo '<div id="error-alert" class="alert alert-danger mt-3" style="display: none;">';
                            echo $error_message;
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="text-center text-muted mt-5 mb-2">Develope by Juan Perez Martinez &copy;2023</h5>

    </div>

    <script src="scripts/query.js"></script>
    <script>
        $(document).ready(function() {
            $("#username").focus();
            const errorAlert = $("#error-alert");
            if (errorAlert.length) {
                errorAlert.fadeIn().delay(1000).fadeOut();
            }

            $("#forgot_password").change(function() {
                if ($(this).is(":checked")) {
                    $("#validation_code").show();
                } else {
                    $("#validation_code").hide();
                }
            });
        });
    </script>
</body>
</html>
