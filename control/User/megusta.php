<?php
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}

$post = $_POST['id'];
$usuario = $user['id'];

///accion like
$comprobar = "SELECT count(*) as cant FROM likes WHERE post =  $post AND usuario = $usuario ";
$result = $conn->prepare($comprobar);
$result->execute();
$count = $result->fetch(PDO::FETCH_ASSOC);
$count = $count['cant'];
if ($count == 0) {

    $sql = "INSERT INTO likes (usuario,post) VALUES ($usuario,$post)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql = "UPDATE experiencias SET likes = likes+1 WHERE id = $post";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} else { //eliminar like

    $sql = "DELETE FROM likes WHERE post = $post AND usuario = $usuario";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql = "UPDATE experiencias SET likes = likes-1 WHERE id = $post";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

$contar = "SELECT * FROM experiencias WHERE id = $post";
$rts = $conn->prepare($contar);
$rts->execute();
$rts = $rts->fetch(PDO::FETCH_ASSOC);
$likes = $rts['likes'];

if ($count >= 1) {
    $likes = $likes++;//numero de likes
    $megusta = '<button class="animate__animated animate__jello btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="' . $rts['id'] . '">
                    <i class="fa fa-thumbs-o-up"></i> 
                    <span> 
                    ' . $likes . '
                    </span>
                </button>
                <audio src=""></audio>
                <button class="btn float-right stopText" id="' . $rts['id'] . '">
                     <i class="far fa-stop-circle text-danger"></i>
                </button>
                <button class="btn float-right playText" id="' . $rts['id'] . '">
                     <i class="far fa-play-circle text-primary"></i>
                </button>
                ';
} else {//ciando se quita el like
    $likes = $likes--;
    $megusta = '<button class="animate__animated animate__jello btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="' . $rts['id'] . '">
                    <i class="fa fa-thumbs-up text-primary"></i>
                    <span> 
                    ' . $likes . '
                    </span>
                </button>
                <audio src=""></audio>
                <button class="btn float-right stopText" id="' . $rts['id'] . '">
                <i class="far fa-stop-circle text-danger"></i>
                </button>
                <button class="btn float-right playText" id="' . $rts['id'] . '">
                        <i class="far fa-play-circle text-primary"></i>
                </button>
                ';
}

echo $megusta;

?>


<script src="../../src/assets/js/likes.js"></script>
<script src="../../src/assets/js/ReproTex.js"></script>