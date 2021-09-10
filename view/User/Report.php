<?php
// error_reporting(0);
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}

$message_succ = '';
$message = '';

//------------------------------------
if (isset($_GET['rst']) && !empty($_GET['rst'])) {
  $rst = $_GET['rst'];
  if ($rst == 'yes') {
    $message_succ = "Reporte Eliminado";
  } elseif ($rst == 'not') {
    $message = "Error, No se elimino su Reporte";
  } elseif ($rst == 'yesup') {
    $message_succ = "Reporte Modificado";
  } elseif ($rst == 'notup') {
    $message = "Error, No se Realizo cambios";
  } elseif ($rst == 'yesIn') {
    $message_succ = "Reporte Agregado";
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

  <link href="../../src/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../src/assets/css/loader.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/0ee106494a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="../../src/assets/js/jquery.js"></script>
  <script src="../../src/assets/js/loader.js"></script>

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
      background-color: #F9F9F9;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      color: #fff;
    }

    .cont {
      margin-top: 100px;
      height: 100%;
      max-width: 960px;
      color: black;
      position: relative;
    }

    .lead {
      font-style: italic;
    }

    .hora {
      color: #85AFFE;
      float: right;

    }

    .name {
      margin-top: -2rem;

      font-weight: bold;

    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="../../src/assets/css/home.css" rel="stylesheet">
</head>

<body class="">
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container animate__animated animate__zoomIn">
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
              <a class="nav-item nav-link" href="Experiencias.php"><i class="fas fa-file-medical"></i> Experiencias</a>
            </li>
            <li class="nav-item">
              <a class="nav-item nav-link active" href="Report.php"><i class="fas fa-file-medical-alt"></i> Reportes</a>
            </li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-user-circle"></i> <?= $user['nombres']; ?> <?= $user['apellidos']; ?> </a>
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
  </header>
  <div class="loader_bg">
    <div class="loader"></div>
  </div>
  <div class="container cont rounded-top ">
    <br><br>
    <h5 class="mb-3">Nuevo Reporte</h5>
    <a href="./nuevoReporte.php" class="btn btn-info"><i class="fas fa-plus-circle"></i></a>
    <hr>
    <?php if (!empty($message)) : ?>
      <p class="msg" id="msg"> <?= $message ?></p>
    <?php endif; ?>
    <?php if (!empty($message_succ)) : ?>
      <p class="msg-succ" id="msg"> <?= $message_succ ?></p>
    <?php endif; ?>
    <br><br>
    <h5 class="mb-3">Tus Reportes</h5>
    <hr>
    <div class="col-md-12 order-md-1 ">
      <?php
      $id_U = $user['id'];
      foreach ($conn->query("SELECT r.id, u.nombres, u.apellidos, r.fecha, r.sintomas FROM reporte as r 
                                 INNER JOIN usuario as u ON r.idU = u.id WHERE r.idU = $id_U") as $row) { ?>
        <div class="card card-outline-secondary my-4 animate__animated animate__zoomIn">
          <div class="card-header text-info text-uppercase">
            <?php
            echo $row['nombres'];
            echo $row['apellidos']
            ?>
            <a class="btn text-danger float-right" href="../../control/User/eliminarReport.php?id=<?php echo $row['id'] ?>&accion=delete"> <i class="fas fa-trash-alt"></i></a>
            <form action="editarReport.php" method="post" class="float-right">
              <input type="hidden" name="idR" value="<?php echo $row['id']; ?> "></input>
              <textarea hidden name="sintomas"><?php echo $row['sintomas']; ?></textarea>
              <button type="submit" class="btn text-info"> <i class="fas fa-pencil-alt"></i></button>
            </form>
          </div>
          <div class="card-body">
            <em><?php echo $row['sintomas'] ?></em><br>
            <small class="float-right text-muted"><?php echo $row['fecha'] ?></small>
          </div>
        </div>

      <?php
      }
      ?>
    </div>

    <!-- ventana modal -->


    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; Copyright RtsWeb 2021 </p>
    </footer>
  </div>

  <script src="../../src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../src/assets/js/form-validation.js"></script>
  <script src="../../src/assets/js/bootstrap.min.js"></script>
  <script src="../../src/assets/js/jquery-3.2.1.min.js"></script>
  <script src="../../src/assets/js/main.js"></script>


</body>

</html>