<?php
error_reporting(0);
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}
if (!empty($_POST['id_u']) && !empty($_POST['resumen'])) {
  $fechaActual = date('Y-m-d');
  $sql = "INSERT INTO experiencias (idU, experiencia, fecha, likes) VALUES (:id_u, :resumen, :fecha, 0)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_u', $_POST['id_u']);
  $stmt->bindParam(':resumen', $_POST['resumen']);
  $stmt->bindParam(':fecha', $fechaActual);

  if ($stmt->execute()) {
    $message_succ = "Experiencia Guardada ";
  } else {
    $message = "Error, No se Guardo su experiencia";
  }
}

if (isset($_GET['rst']) && !empty($_GET['rst'])) {
  if ($_GET['rst'] == 'yes') {
    $message_succ = "Experiencia Eliminada";
  } else {
    $message = "Error, No se elimino su experiencia";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="../../src/assets/css/anime.css" rel="stylesheet">

  <script src="https://kit.fontawesome.com/0ee106494a.js" crossorigin="anonymous"></script>
  <style>
    .box {

      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 25px;
    }


    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;

    }

    #botonpausar {
      display: none;
    }

    .ayuda {
      display: none;
    }

    .btnaAyudaC {
      display: none;
    }

    .Blink {
      animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;
      display: none;
    }

    @keyframes blinker {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
      }
    }

    html,
    body {
      height: 100%;
      background-color: #F9F7F7;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      color: black;
    }

    .cont {
      margin-top: 100px;
      min-height: calc(100% - 81px);
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

    .ic {
      background-color: rgba(15, 15, 15, 0.74);
      padding: 10px;
      border-radius: 10px;
    }

    .is {
      background-color: rgba(15, 15, 15, 0.74);
    }


    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link href="../../src/assets/css/home.css" rel="stylesheet">
  <script src="../../src/assets/js/jquery.js"></script>
  <script src="../../src/assets/js/loader.js"></script>
  <link href="../../src/assets/css/loader.css" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">
      <div class="container animate__animated animate__zoomIn">
        <img class="img-fluid imagen " src="../../src/assets/img/logo3.png" alt="">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarResponsive">
          <ul class="navbar-nav ml-auto ">
            <li class="nav-item">
              <a class="nav-item nav-link" href="Home.php"><i class="fas fa-home"></i> Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-item nav-link active" href="Experiencias.php"><i class="fas fa-file-medical"></i> Experiencias</a>
            </li>
            <li class="nav-item">
              <a class="nav-item nav-link" href="Report.php"><i class="fas fa-file-medical-alt"></i> Reportes</a>
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
  <div class="loader_bg">
    <div class="loader"></div>
  </div>
  <div class="container cont">
    <br>

    <h5>Nueva Experiencia</h5>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle"></i></button>
    <hr>
    <?php if (!empty($message)) : ?>
      <p class="msg" id="msg"> <?= $message ?></p>
    <?php endif; ?>
    <?php if (!empty($message_succ)) : ?>
      <p class="msg-succ" id="msg"> <?= $message_succ ?></p>
    <?php endif; ?>
    <h5 class="mb-3">Experiencias de otros usuarios</h5>
    <?php
    $sql = "SELECT count(*) as cant FROM experiencias";
    $result = $conn->prepare($sql);
    $result->execute();
    $cantidad = $result->fetch(PDO::FETCH_ASSOC);
    if ($cantidad['cant'] != 0) {
    ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="">Desde</label>
              <input type="date" name="from_date" id="from_date" class="form-control" required />
            </div>
            <div class="col-md-4 mb-3">
              <label for="">Hasta</label>
              <input type="date" name="to_date" id="to_date" class="form-control" required />
            </div>
            <div class="col-md-4 mb-3"><br>
              <button type="submit" name="filter" id="filter" value="Buscar" class="btn btn-info">
                <i class="fas fa-search"></i>
              </button>
              <a href="Experiencias.php" class="btn btn-info"><i class="fas fa-sync-alt"></i></a>
            </div>
          </div>
          <br>
        </div>
      </div>
      <div id="order_table">
        <?php
        $sql = "SELECT e.id, e.idU, u.nombres, u.apellidos, e.experiencia, e.fecha, e.likes FROM experiencias as e 
         INNER JOIN usuario as u ON e.idU = u.id ORDER BY fecha desc";
        $result = $conn->prepare($sql);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          if ($user['id'] == $row['idU']) {
        ?>
            <div class="card card-outline-secondary my-4 animate__animated animate__zoomIn">
              <div class="card-header text-info text-uppercase">
                <i class="fas fa-user-circle"></i>
                <?php
                echo $row['nombres'] . ' ';
                echo $row['apellidos'] . ' ';
                ?>
                &nbsp;<i class="fa fa-volume-up text-danger Blink" id="Blink<?php echo $row['id'] ?>"></i>
                <a class="btn text-danger float-right" href="../../control/User/eliminarEpx.php?id=<?php echo $row['id'] ?>&accion=delete"> <i class="fas fa-trash-alt"></i></a>
              </div>
              <div class="card-body">
                <em><?php echo $row['experiencia'] ?></em><br>
                <input type="hidden" id="ReadExpe<?php echo $row['id'] ?>" value="<?php echo $row['experiencia'] ?>">
                <small class="float-right text-muted"><?php echo $row['fecha'] ?></small>
              </div>
              <?php
              $query = "SELECT count(*) as cant FROM likes WHERE post = '" . $row['id'] . "' AND usuario = " . $user['id'] . "";
              $cont = $conn->prepare($query);
              $cont->execute();
              $contLike = $cont->fetch(PDO::FETCH_ASSOC);

              if ($contLike['cant'] == 0) { ?>
                <div class="col-12 react<?php echo $row['id'] ?>">
                  <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="<?php echo $row['id']; ?>">
                    <i class="fa fa-thumbs-o-up"></i>
                    <span> <?php echo $row['likes']; ?>
                    </span>
                  </button>
                  <audio src=""></audio>
                  <button class="btn float-right stopText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-stop-circle text-danger"></i>
                  </button>
                  <button class="btn float-right playText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-play-circle text-primary"></i>
                  </button>
                </div>
                <br>

              <?php } else { ?>
                <div class="col-12 react<?php echo $row['id'] ?>">
                  <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="<?php echo $row['id']; ?>">
                    <i class="fa fa-thumbs-up text-primary"></i>
                    <span> <?php echo $row['likes']; ?>
                    </span>
                  </button>
                  <audio src=""></audio>
                  <button class="btn float-right stopText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-stop-circle text-danger"></i>
                  </button>
                  <button class="btn float-right playText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-play-circle text-primary"></i>
                  </button>
                </div>
                <br>
              <?php } ?>
            </div>
          <?php
          } else {
          ?>
            <div class="card card-outline-secondary my-4 animate__animated animate__zoomIn">
              <div class="card-header text-info text-uppercase">
                <i class="fas fa-user-circle"></i>
                <?php
                echo $row['nombres'] . ' ';
                echo $row['apellidos'];
                ?>
              </div>
              <div class="card-body">
                <em><?php echo $row['experiencia'] ?></em>
                <input type="hidden" id="ReadExpe<?php echo $row['id'] ?>" value="<?php echo $row['experiencia'] ?>">
                <small class="float-right text-muted"><?php echo $row['fecha'] ?></small>
              </div>
              <?php
              $query = "SELECT count(*) as cant FROM likes WHERE post = '" . $row['id'] . "' AND usuario = " . $user['id'] . "";
              $cont = $conn->prepare($query);
              $cont->execute();
              $contLike = $cont->fetch(PDO::FETCH_ASSOC);

              if ($contLike['cant'] == 0) { ?>
                <div class="col-12 react<?php echo $row['id'] ?>">
                  <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="<?php echo $row['id']; ?>">
                    <i class="fa fa-thumbs-o-up"></i>
                    <span> <?php echo $row['likes']; ?>
                    </span>
                  </button>
                  <audio src=""></audio>
                  <button class="btn float-right stopText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-stop-circle text-danger"></i>
                  </button>
                  <button class="btn float-right playText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-play-circle text-primary"></i>
                  </button>
                </div>
                <br>
              <?php } else { ?>

                <div class="col-12 react<?php echo $row['id'] ?> ">
                  <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="<?php echo $row['id']; ?>">
                    <i class="fa fa-thumbs-up text-primary"></i>
                    <span> <?php echo $row['likes']; ?> </span>
                  </button>
                  <audio src=""></audio>
                  <button class="btn float-right stopText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-stop-circle text-danger"></i>
                  </button>
                  <button class="btn float-right playText" id="<?php echo $row['id']; ?>">
                    <i class="far fa-play-circle text-primary"></i>
                  </button>
                </div>
                <br>
              <?php } ?>
            </div>
        <?php
          }
        }
      } else {
        ?>
        <p>¡No hay Experiencias de otos usuario!, Se tu el primero en Redactar una</p>
      <?php
      }
      ?>
      </div>
      <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white" id="exampleModalLabel">Nueva Experiencia</h5>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <a class="btn btn-link btnaAyudaO" id="btnaAyudaO">
                Ayuda<i class="far fa-question-circle text-primary"></i>
                <br>
              </a>
              <a class="btn btn-link active btnaAyudaC" id="btnaAyudaC">
                Ayuda<i class="far fa-question-circle text-primary"></i><i class="fas fa-sort-up"></i>
                <br>
              </a>
              <div class=" animate__animated animate__zoomIn bg-light rounded-top rounded-bottom text-justify p-2 ayuda" id="ayuda">
                <strong>
                  <h4>Ayuda para Publicar tu Experiencia <i class="far fa-question-circle"></i></h4>
                </strong>
                <strong>Experiencia con Microfono:</strong><br>
                <strong>1.</strong><em> Encienda el microfono dando clic sobre el boton de color azul. </em>
                <strong>2.</strong><em> Hablar claro y pausado. </em>
                <strong>3.</strong><em> Si termino de hablar espere unos segundos a que se redacte su mensaje en el campo resumen. </em>
                <br> <strong>4.</strong><em> Finalice la grabacion dando clic sobre el boton de color rojo. </em>
                <strong>5.</strong><em> Solo falta enviar su reporte, por favor seleccione enviar. </em><br><br>
                <strong>Experiencia Manual:</strong>
                <strong>1.</strong><em> Ubiquese en el campo resumen y acontinuacion redacte su mensaje. </em>
                <strong>2.</strong><em> Solo falta enviar su Experiencia, por favor seleccione enviar</em>
              </div>
              <br>
              <br>
              <form action="Experiencias.php" method="POST">
                <div class="form-group">
                  <a class="btn btn-primary rounded-circle" id="botongrabar">
                    <i class="fas fa-microphone-alt"> </i>
                  </a>
                  <a class="btn btn-danger rounded-circle" id="botonpausar">
                    <i class="fas fa-microphone-alt"></i>
                  </a>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Resume: </label> <i class="fa fa-circle text-danger Blink float-right" id="Blink">&nbsp; Grabando.. </i>
                  <textarea class="form-control" id="texto" name="resumen" rows="10" cols="50"></textarea>
                  <input type="hidden" name="id_u" class="form-control" id="texto" value="<?php echo $user['id'] ?>"></input>
                  <input type="hidden" name="fecha" value="<?php echo  date('d/m/Y') ?>">
                </div>
                <div class="modal-footer">
                  <button type="submit" id="enviar" class="btn btn-info">Enviar</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; Copyright RtsWeb 2021 </p>
      </footer>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="../../src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../src/assets/js/form-validation.js"></script>
  <script src="../../src/assets/js/bootstrap.min.js"></script>
  <script src="../../src/assets/js/jquery-3.2.1.min.js"></script>
  <script src="../../src/assets/js/main.js"></script>
  <script src="../../src/assets/js/likes.js"></script>
  <script src="../../src/assets/js/index.js"></script>



</body>

</html>