<?php
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}
if(!empty($_GET['id'] && $_GET['accion'])){ //lomismo que eliminar experiencia 
  if($_GET['accion'] == 'delete'){
    $id = $_GET['id'];
    $result = $conn->query("DELETE FROM reporte WHERE id = $id");
    if ($result) {
      header('Location: ../../view/User/Report.php?rst=yes');
    } else {
      header('Location: ../../view/User/Report.php?rst=not');
    }
  }
}

