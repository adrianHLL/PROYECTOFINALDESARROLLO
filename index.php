<?php
error_reporting(0);
session_start(); //compartir variables entre paginas para que estas puedan ser identificadas en cualquier frm
require './config/Conn.php';
if (isset($_SESSION['user_id'])) {//verificar que se halla declarado una variable isset
  if($_SESSION['user_tipo']==1){
    header('Location: ./view/Admin/Home.php');//redireccionar y entra en modo admin 
	  }else{
      header('Location: ./view/User/Home.php');//redireccionar y entra en modo usuario 
	  }
}


if (!empty($_POST['cedula']) && !empty($_POST['password'])) { // es diferente de vacio 
  $records = $conn->prepare('SELECT * FROM usuario WHERE id = :cedula');// realizamos la consulta en La BD  admite una sentencia sql prepare devuelve un objeto pdo
  $records->bindParam(':cedula', $_POST['cedula']);//records se encuentra almacenado la consulta
  $records->execute();//permite por parametros el juego de caracteres
  $results = $records->fetch(PDO::FETCH_ASSOC);//PDO es la api que ofrece php para la interaccion de la bd con php
  $message = '';
  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {//permite comprobar autenticidad de un hash con el password que se le suministre y así decidir que el password es válido o no.
    $_SESSION['user_id'] = $results['id'];//post es de lo que recibimos y results es lo de la bd
		$_SESSION['user_tipo'] = $results['Tipo'];
		if($_SESSION['user_tipo'] == 1){
		  header("Location: ./view/Admin/Home.php");//redireccionar y entra al home admin 
		}else{
      header("Location: ./view/User/Home.php");//redireccionar y entra al home user 
		}
  } else {
    $message = 'Usuario / contraseña incorrectos';
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
  <link rel="icon" type="image/png" href="./src/assets/img/icono.png" />
  <title>RtsWeb-Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

  <!-- Bootstrap core CSS -->
  <link href="./src/assets/css/bootstrap.min.css" rel="stylesheet">
  <script src="./src/assets/js/jquery.js"></script>
  <script src="./src/assets/js/loader.js"></script>
  <link href="./src/assets/css/loader.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- styles  -->
  <link href="./src/assets/css/login.css" rel="stylesheet">
</head>

<body>
  <div class="loader_bg">
    <div class="loader"></div>   <!--lodeader es el simbolo de cargando-->
  </div>
  <form class="form-signin" action="index.php" method="POST">
    <div class="text-center mb-4">
      <a href="index.php"><img class="mb-4" src="./src/assets/img/logo3.png" alt="" width="350" height="110"></a>
      <hr>
      <h1 class="h3 mb-3 font-weight-normal">Inicia Sesión</h1>
      <p>Inicia sesion o registrate en nuestra plataforma</p>
      <br>
      <?php if (!empty($message)) : ?>
        <p class="msg" id="msg"> <?= $message ?></p>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <input type="text" id="" class="form-control" name="cedula" value="<?php echo $_POST['cedula'] ?>" required autofocus>
      <label for="inputEmail">Cedula</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="" class="form-control" name="password"  required>
      <label for="inputPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <a href="./view/User/Register.php">Registrate</a>
      </label>
      <label>|
        <a href="./view/User/Recuperar-Pass.php">Olvidaste tu Contraseña</a>
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login in</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; Copyright RtsWeb 2021 </p>
  </form>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="./src/assets/js/form-validation.js"></script>
  <script src="./src/assets/js/bootstrap.min.js"></script>
  <script src="./src/assets/js/jquery-3.2.1.min.js"></script>
  <script src="./src/assets/js/bootstrap.bundle.min.js"></script>
  <script src="./src/assets/js/main.js"></script>
</body>

</html>