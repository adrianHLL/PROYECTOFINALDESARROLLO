<?php
error_reporting(0);
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
if (!empty($user['id']) && !empty($_POST['texto'])) {
    $fechaActual = date('Y-m-d');
    $sql = "INSERT INTO reporte (idU, fecha, sintomas) VALUES (:id_u, :fecha, :resumen)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_u', $user['id']);
    $stmt->bindParam(':fecha', $fechaActual);
    $stmt->bindParam(':resumen', $_POST['texto']);
    if ($stmt->execute()) {
    //enviar reportes al correo de los usuarios
    
    
        $to = "Rtsweb123@gmail.com"; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "RtsWeb Reporte:  Nuevo reporte";
        $email_body = $user['nombres'] . $user['apellidos'] . ".\n\n" . "Reporte estado de salud
        \n\nReporte:" . $_POST['texto'];
        $headers = "From:" . $user['email'] . "\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To:" . $user['email'];
        mail($to, $email_subject, $email_body, $headers);
        //-------------------------------------
        $to = $user['email']; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "RtsWeb Reporte:  Notificacion";
        $email_body = $user['nombres'] . $user['apellidos'] . ".\n\n" . "Relizastes un nuevo reporte en nuesta plataforma
        :\n\nReporte:" . $_POST['texto'];
        $headers = "From: no@replay.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To:" . $user['email'];
        mail($to, $email_subject, $email_body, $headers);
        echo "<script>alert('Reporte enviado');Location:'./Report.php'</script>";
    } else {
        echo "<scrip>alert('Algo salio mal, verifique ⚠️');</scrip>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- Bootstrap core CSS -->
    <link href="../../src/assets/css/bootstrap.min.css" rel="stylesheet">
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
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
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
    <div class="loader_bg">
        <div class="loader"></div>
    </div>
    <div class="container cont">
        <br>
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="exampleModalLabel">Modificar Reporte N° <?php echo $_POST['idR'] ?> </h5>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <form action="../../control/User/updateReport.php" method="POST">
                            <div class="form-group">
                                <br>
                                <a class="btn btn-primary rounded-circle" id="botongrabar">
                                    <i class="fas fa-microphone-alt"> </i>
                                </a>
                                <a class="btn btn-danger rounded-circle" id="botonpausar">
                                    <i class="fas fa-microphone-alt"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Resume: </label>
                                <i class="fa fa-circle text-danger Blink float-right" id="Blink">&nbsp; Grabando.. </i>
                                <input type="hidden" name="idR" value="<?php echo $_POST['idR'] ?>">
                                <textarea class="form-control" id="texto" name="sintomas" rows="10" cols="50"><?php echo $_POST['sintomas'] ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <a  href="Report.php" class="btn btn-danger" id="saves">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-info" id="saves">
                                    <i class="fas fa-share-square"></i>
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm text-right">
                        <img src="../../src/assets/img/doctora.png" alt="">
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