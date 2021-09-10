<?php
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}
if (!empty($_GET['id']) && $_GET['accion'] == 'delete') {
  $id = $_GET['id'];
  $result = $conn->query("DELETE FROM experiencias WHERE id = $id");
  if ($result) {
    header('Location: ../../view/User/Experiencias.php?rst=yes');
  } else {
    header('Location: ../../view/User/Experiencias.php?rst=not');
  }
  
} else if (!empty($_GET['id']) && $_GET['accion'] == 'update') {

  $id = $_GET['id'];
  $query = "SELECT count(*) as cant FROM experiencias WHERE id = $id";// conteo de todas las expericiencias que tiene el usuario 
  $cont = $conn->prepare($query);
  $cont->execute();
  $cont = $cont->fetch(PDO::FETCH_ASSOC);

  if ($cont['cant'] > 0) {//si es mayor a cero es por que hay entonces dependiendo de la cantidad borra y actualiza o permanece en la pagina

    $result = $conn->query("DELETE FROM experiencias WHERE id = $id");
    if ($result) {
      header('Location: ../../view/User/Experiencias.php?rst=yes');//actualiza la pagina
    } else {
      header('Location: ../../view/User/Experiencias.php?rst=not');//mientras no
    }
  }
}
