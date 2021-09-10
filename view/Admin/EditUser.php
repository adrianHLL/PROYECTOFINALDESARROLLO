<?php
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}
if (!empty($_POST['idU']) && !empty($_POST['nomb'])) {
  $sql = "UPDATE usuario  SET nombres = :nombres ,apellidos = :apellidos, telefono = :telefono,
                                       email = :email, direccion = :direccion WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $_POST['idU']);
  $stmt->bindParam(':nombres', $_POST['nomb']);
  $stmt->bindParam(':apellidos', $_POST['apell']);
  $stmt->bindParam(':telefono', $_POST['tel']);
  $stmt->bindParam(':email', $_POST['ema']);
  $stmt->bindParam(':direccion', $_POST['dir']);
  $message = "";
  if ($stmt->execute()) {
    echo "<script>alert('Datos ACtualizados ✅'); location='./AdminUser.php'</script>";
  } else {
    $message = 'Error al actualizar los datos';
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <link rel="icon" type="image/png" href="../../src/assets/img/icono.png" />

  <title>RtsWeb</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/">

  <!-- Bootstrap core CSS -->
  <link href="../../src/assets/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/0ee106494a.js" crossorigin="anonymous"></script>


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    html,
    body {
      height: 100%;
      background-color: white;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      color: #fff;
    }


    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="../../src/assets/css/home.css" rel="stylesheet">
  <script src="../../src/assets/js/jquery.js"></script>
  <script src="../../src/assets/js/loader.js"></script>
  <link href="../../src/assets/css/loader.css" rel="stylesheet">
</head>

<body class="">
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <img class="img-fluid imagen" src="../../src/assets/img/logo3.png" alt="">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-item nav-link" href="Home.php"><i class="fas fa-home"></i> Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-item nav-link active" href="AdminUser.php"> <i class="fas fa-database"></i> Base de Datos</a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-user-circle"></i> <?= $user['nombres']; ?> <?= $user['apellidos']; ?></a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="Acount.php"> <i class="fas fa-user-cog"></i> Mi cuenta</a>
                <a class="dropdown-item" href="../../config/close.php"> <i class="fas fa-sign-out-alt"></i> Cerra Sesion</a>
              </div>

            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="loader_bg">
    <div class="loader"></div>
  </div>
  <div class="container cont">
    <div class="row">
      <div class="col-md-12 order-md-1"><br><br><br><br>
        <h4 class="mb-3">Editar Usuario</h4>
        <hr>
        <br>
        <form class="needs-validation" action="EditUser.php" method="POST" novalidate>
          <div class="mb-3">

            <input type="hidden" class="form-control" id="address" name="idU" placeholder="" value="<?php echo $_POST['id'] ?>" required>
            <div class="invalid-feedback">
              Please enter your shipping address.
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 mb-3">
              <label for="firstName">Nombres</label>
              <input type="text" class="form-control" id="firstName" name="nomb" placeholder="" value="<?php echo $_POST['nombres'] ?>" required>

            </div>
            <div class="col-md-8 mb-8">
              <label for="lastName">Apellido</label>
              <input type="text" class="form-control" id="lastName" name="apell" placeholder="" value="<?php echo $_POST['apellidos'] ?>" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-8 mb-8">
              <label for="lastName">Telefono</label>
              <input type="text" class="form-control" id="lastName" name="tel" placeholder="" value="<?php echo $_POST['telefono'] ?>" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-8 mb-8">
              <label for="lastName">Email</label>
              <input type="text" class="form-control" id="lastName" name="ema" placeholder="" value="<?php echo $_POST['email'] ?>" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
            <div class="col-md-8 mb-8">
              <label for="lastName">Direccion</label>
              <input type="text" class="form-control" id="lastName" name="dir" placeholder="" value="<?php echo $_POST['direccion'] ?>" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          </div>
          <br><br>
          <a href="AdminUser.php" class="btn btn-danger">Cancelar</a>
          <button class="btn btn-success" type="submit">Guardar</button>

          <br>

        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; Copyright RtsWeb 2021 </p>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../../src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../src/assets/js/form-validation.js"></script>
  <script src="../../src/assets/js/bootstrap.min.js"></script>
  <script src="../../src/assets/js/jquery-3.2.1.min.js"></script>
</body>

</html>