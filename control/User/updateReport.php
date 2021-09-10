<?php
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}

$idR = $_POST['idR'];
$sintomas = $_POST['sintomas'];
$fechaActual = date('Y-m-d');
if (!empty($sintomas) && !empty($idR)) {
    $sql = "UPDATE reporte SET sintomas = :sintomas, fecha = :fecha WHERE id = :idR";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idR', $idR);
    $stmt->bindParam(':fecha', $fechaActual);
    $stmt->bindParam(':sintomas', $sintomas);
    if ($stmt->execute()) {
        header('Location: ../../view/User/Report.php?rst=yesup');
    } else {
        header('Location: ../../view/User/Report.php?rst=notup');
    }
}else{
    // header('Location: ../../view/User/Report.php');
}
