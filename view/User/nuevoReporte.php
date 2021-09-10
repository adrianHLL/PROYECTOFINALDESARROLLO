<?php
require '../../config/v_session.php';
require '../../config/Conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
if (isset($_POST['texto'])) {
    if (!empty($user['id']) && !empty($_POST['texto'])) {
        $fechaActual = date('Y-m-d');
        $sql = "INSERT INTO reporte (idU, fecha, sintomas) VALUES (:id_u, :fecha, :resumen)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_u', $user['id']);
        $stmt->bindParam(':fecha', $fechaActual);
        $stmt->bindParam(':resumen', $_POST['texto']);
        if ($stmt->execute()) {

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: RtsWeb\r\n" .
                        "Reply-To: ".$user['email']." " . "\r\n" .
                        "X-Mailer: PHP/" . phpversion();

            $mensaje = '<html>
                        <head>
                        <title>RtsWeb</title>
                        <style>

                            body {
                                background-color: #FCF9F8;
                            }

                            header .container {
                                width: 100%;
                                align-items: center;
                                justify-content: center;
                                border-bottom: 1px solid #DCD8D8;
                            }
                            .icon{
                                color: #F18A8A;
                                font-size: 4em;
                                text-shadow: 0px 0px 1px #E8E7E7;;
                            }
                            .logo{
                                color: white;
                                font-size: 4em;
                                text-shadow: 0px 0px  3px #454242;
                                letter-spacing: 2px;
                                font-weight: bold;
                            }
                            .eslogan{
                                color: black;
                                text-shadow: 0px 0px  3px #CAC9C9;
                                letter-spacing: 2px;
                                font-weight: bold;
                            }

                            header .container img {
                                 width: 40%;
                            }

                            .container {
                                width: 100%;
                                text-align: center;
                                border-left: 1px solid #DCD8D8;
                                border-right: 1px solid #DCD8D8;
                            }

                            .container .email {
                                font-family: Cambria, Cochin, Georgia, Times, serif;
                                min-height: 30vh;
                                width: 80%;
                                margin: auto;
                            }

                            .container .email .email-header {
                              text-align: left;
                            }

                            .container .email .email-body {
                                text-align: justify;
                                font-family: monospace;
                            }

                        </style>
                        </head>

                        <body>
                        <header>
                            <div class="container">
                            <h1>RtsWeb</h1>
                            </div>
                        </header>
                        <div class="container">
                            <br>
                            <h5>Nuevo Reporte</h5>
                            <div class="email">
                            <div class="email-header">
                                <strong>De: </strong><a>' . $user['nombres'] . ' ' . $user['apellidos'] . '</a><br>
                                <strong>Fecha: </strong><a>' . date('d/m/Y', time()) . '</a>
                            </div>
                            <br>
                            <div class="email-body">
                                <strong>Sintomas: <br> </strong>
                                <a>' . $_POST['texto'] . '</a>
                            </div>
                            <br>
                            </div>
                        </div>    
                    </body>
                </html>';

                $para = "rtsweb123@gmail.com";
                $asunto = "Nuevo reporte";
                mail($para, $asunto, utf8_decode($mensaje), $headers);

                 //profe aqui estamos probando para que notifique a un correo---------------------------------------------------------------------------------


                $headers2 = "MIME-Version: 1.0" . "\r\n";
                $headers2 .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                $headers2 .= "From: RtsWeb \r\n" .
                            "Reply-To:Rtsweb123@gmail.com \r\n" .
                        "X-Mailer: PHP/" . phpversion();
                $mensaje2 = '<html>
                <head>
                <title>RtsWeb</title>
                <style>

                    body {
                        background-color: #FCF9F8;
                    }

                    header .container {
                        width: 100%;
                        align-items: center;
                        justify-content: center;
                        border-bottom: 1px solid #DCD8D8;
                    }
                    .icon{
                        color: #F18A8A;
                        font-size: 4em;
                        text-shadow: 0px 0px 1px #E8E7E7;;
                    }
                    .logo{
                        color: white;
                        font-size: 4em;
                        text-shadow: 0px 0px  3px #454242;
                        letter-spacing: 2px;
                        font-weight: bold;
                    }
                    .eslogan{
                        color: black;
                        text-shadow: 0px 0px  3px #CAC9C9;
                        letter-spacing: 2px;
                        font-weight: bold;
                    }

                    header .container img {
                         width: 40%;
                    }

                    .container {
                        width: 100%;
                        text-align: center;
                        border-left: 1px solid #DCD8D8;
                        border-right: 1px solid #DCD8D8;
                    }

                    .container .email {
                        font-family: Cambria, Cochin, Georgia, Times, serif;
                        min-height: 30vh;
                        width: 80%;
                        margin: auto;
                    }

                    .container .email .email-header {
                      text-align: left;
                    }

                    .container .email .email-body {
                        text-align: justify;
                        font-family: monospace;
                    }

                </style>
                </head>

                <body>
                <header>
                    <div class="container">
                        <h1>RtsWeb</h1>
                    </div>
                </header>
                <div class="container">
                    <br>
                    <h5>Notificacion</h5>
                    <div class="email">
                    <div class="email-header">
                        <p>Te Notificamos que nos acaba de llegar un nuevo reporte desde est Correo electronico</p>
                        <hr>  
                        <strong>Informacion</strong> <br>
                        <strong>De: </strong><a>' . $user['nombres'] . ' ' . $user['apellidos'] . '</a><br>
                        <strong>Fecha: </strong><a>' . date('d/m/Y', time()) . '</a>
                    </div>
                    <br>
                    <div class="email-body">
                        <strong>Sintomas: <br> </strong>
                        <a>' . $_POST['texto'] . '</a><br><br>

                        <a>Nota: </a><i>Si no fue usted quien envio este Esa informacion, Porfavor Comuniquese con nostros</i>
                    </div>
                    <br>
                    </div>
                </div>    
            </body>
        </html>';

            $para2 = $user['email'];
            $asunto2 = "Notificacion RtsWeb";
            mail($para2, $asunto2, utf8_decode($mensaje2), $headers2);

            header('location: Report.php?rst=yesIn');
        } else {
            $message =  "Error, No se Envio el reporte";
        }
    } else {
        $message =  "El campo Resumen es obligatorio";
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
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
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
    <div class="loader_bg">
        <div class="loader"></div>
    </div>
    <div class="container cont">
        <br>
        
        <div class="modal-content animate__animated animate__zoomIn">
          
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="exampleModalLabel">Nuevo Reporte</h5>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <form action="nuevoReporte.php" method="POST">
                            <div class="form-group">
                                <a class="btn btn-link btnaAyudaO" id="btnaAyudaO">
                                    Ayuda<i class="far fa-question-circle text-primary"></i>
                                    <br>
                                </a>
                                <a class="btn btn-link active btnaAyudaC" id="btnaAyudaC">
                                    Ayuda<i class="far fa-question-circle text-primary"></i><i class="fas fa-sort-up"></i>
                                    <br>
                                </a>
                                <div class=" animate__animated animate__zoomIn bg-light rounded-top rounded-bottom text-justify p-2 ayuda" id="ayuda">
                                    <strong>Reporte con Microfono:</strong><br>
                                    <strong>1.</strong><em> Encienda el microfono dando clic sobre el boton de color azul. </em><br>
                                    <strong>2.</strong><em> Hablar claro y pausado. </em><br>
                                    <strong>3.</strong><em> Si termino de hablar espere unos segundos a que se redacte su mensaje en el campo resumen. </em>
                                    <br> <strong>4.</strong><em> Finalice la grabacion dando clic sobre el boton de color rojo. </em><br>
                                    <strong>5.</strong><em> Solo falta enviar su reporte, por favor seleccione enviar. </em><br><br>
                                    <strong>Reporte Manual:</strong><br>
                                    <strong>1.</strong><em> Ubiquese en el campo resumen y acontinuacion redacte su mensaje. </em><br>
                                    <strong>2.</strong><em> Solo falta enviar su reporte, por favor seleccione enviar</em>
                                </div>
                                <br>
                                <br>
                                <a class="btn btn-primary rounded-circle" id="botongrabar">
                                    <i class="fas fa-microphone-alt"> </i>
                                </a>
                                <a class="btn btn-danger rounded-circle" id="botonpausar">
                                    <i class="fas fa-microphone-alt"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Resume:</label><i class="text-danger">*</i>
                                <?php if (!empty($message)) : ?>
                                    <p class="text-danger" id="msg"> <?= $message ?></p>
                                <?php endif; ?>
                                <i class="fa fa-circle text-danger Blink float-right" id="Blink">&nbsp; Grabando.. </i>
                                <textarea class="form-control" id="texto" name="texto" rows="10" cols="50"></textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="Report.php" class="btn btn-danger" id="saves">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-info" id="saves">
                                    <i class="fas fa-share-square"></i>
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm text-right">
                        <br> <br>
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