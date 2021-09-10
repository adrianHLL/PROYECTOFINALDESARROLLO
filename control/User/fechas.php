<?php
error_reporting(0);
require '../../config/v_session.php';
require '../../config/Conn.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
}

 if(isset($_POST["from_date"], $_POST["to_date"]))  ///dato de la fecha ingresada from_date=desde y to_date= hasta 
 {  
      $connect = mysqli_connect("localhost", "root", "", "rtsweb");  
      $output = '';  
      $query = "  
                SELECT e.id, e.idU, u.nombres, u.apellidos, e.experiencia, e.fecha, e.likes FROM experiencias as e 
                INNER JOIN usuario as u ON e.idU = u.id WHERE fecha BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  ORDER BY fecha asc
      ";  
      $result = mysqli_query($connect, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
             
              if($user['id'] ==$row['idU']){
                    $sql = "
                    SELECT * FROM likes WHERE post = '" . $row['id'] . "' AND usuario = " . $user['id'] . "
                  ";
                  $cont = mysqli_query($connect, $sql);
                  if(mysqli_num_rows($cont) == 0){
                      $output .= '  
                        <div class="card card-outline-secondary my-4 animate__animated animate__zoomIn">
                          <div class="card-header text-info text-uppercase"><i class="fas fa-user-circle"></i> '
                            . $row['nombres'].' '.$row['apellidos'].'
                            <a class="btn btn-outline-danger float-right" href="../../control/User/eliminarEpx.php?id='.$row['id'].'&accion=delete"> <i class="fas fa-trash-alt"></i></a>
                          </div>
                          <div class="card-body">
                              <em>'. $row['experiencia'].'</em>
                              <input type="hidden" id="ReadExpe'.$row['id'].'" value="'.$row['experiencia'].'">
                              <small class="float-right text-muted">'. $row['fecha']. '</small>
                          </div>
                          <div class="col-12 react'.$row['id'].'">
                                <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="'.$row['id'].'">
                                  <i class="fa fa-thumbs-o-up"></i> 
                                  <span id="likes_'.$row['id'].'"> 
                                  '.$row['likes'].'
                                </span>
                               </button>
                               <audio src=""></audio>
                              <button class="btn float-right stopText" id="'.$row['id'].'">
                              <i class="far fa-stop-circle text-danger"></i>
                              </button>
                              <button class="btn float-right playText" id="'.$row['id'].'">
                                      <i class="far fa-play-circle text-primary"></i>
                              </button>
                          </div>
                            <br>
                        </div>';
                  }else{
                    $output .= '  
                        <div class="card card-outline-secondary my-4 animate__animated animate__zoomIn">
                          <div class="card-header text-info text-uppercase"><i class="fas fa-user-circle"></i> '
                            . $row['nombres'].' '.$row['apellidos'].'
                            <a class="btn btn-outline-danger float-right" href="../../control/User/eliminarEpx.php?id='.$row['id'].'&accion=delete"> <i class="fas fa-trash-alt"></i></a>
                          </div>
                          <div class="card-body">
                              <em>'. $row['experiencia'].'</em>
                              <input type="hidden" id="ReadExpe'.$row['id'].'" value="'.$row['experiencia'].'">
                              <small class="float-right text-muted">'. $row['fecha']. '</small>
                          </div>
                          <div class="col-12 react'.$row['id'].'">
                                <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="'.$row['id'].'">
                                  <i class="fa fa-thumbs-up text-primary"></i> 
                                  <span id="likes_'.$row['id'].'"> 
                                  '.$row['likes'].'
                                </span>
                                </button>
                                <audio src=""></audio>
                                <button class="btn float-right stopText" id="'.$row['id'].'">
                                <i class="far fa-stop-circle text-danger"></i>
                                </button>
                                <button class="btn float-right playText" id="'.$row['id'].'">
                                        <i class="far fa-play-circle text-primary"></i>
                                </button>
                          </div>
                            <br>
                        </div>';
                      }
              } else{//experiencias de otros 
                $sql = "
                SELECT * FROM likes WHERE post = '" . $row['id'] . "' AND usuario = " . $user['id'] . "
              ";
              $cont = mysqli_query($connect, $sql);
              if(mysqli_num_rows($cont) == 0){
                  $output .= '  
                    <div class="card card-outline-secondary my-4">
                      <div class="card-header text-info text-uppercase"><i class="fas fa-user-circle"></i> '
                        . $row['nombres'].' '.$row['apellidos'].'
                      </div>
                      <div class="card-body">
                          <em>'. $row['experiencia'].'</em>
                          <input type="hidden" id="ReadExpe'.$row['id'].'" value="'.$row['experiencia'].'">
                          <small class="float-right text-muted">'. $row['fecha']. '</small>
                      </div>
                      <div class="col-12 react'.$row['id'].'">
                                <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="'.$row['id'].'">
                                  <i class="fa fa-thumbs-o-up"></i> 
                                  <span id="likes_'.$row['id'].'"> 
                                  '.$row['likes'].'
                                </span>
                                </button>
                                <audio src=""></audio>
                                <button class="btn float-right stopText" id="'.$row['id'].'">
                                <i class="far fa-stop-circle text-danger"></i>
                                </button>
                                <button class="btn float-right playText" id="'.$row['id'].'">
                                        <i class="far fa-play-circle text-primary"></i>
                                </button>
                        </div>
                        <br>
                    </div>';
              }else{// experiencias de otros usuarios
                $output .= '  
                    <div class="card card-outline-secondary my-4">
                      <div class="card-header text-info text-uppercase"><i class="fas fa-user-circle"></i> '
                        . $row['nombres'].' '.$row['apellidos'].'
                      </div>
                      <div class="card-body">
                          <em>'. $row['experiencia'].'</em> 
                          <input type="hidden" id="ReadExpe'.$row['id'].'" value="'.$row['experiencia'].'">
                          <small class="float-right text-muted">'. $row['fecha']. '</small>
                      </div>
                      <div class="col-12 react'.$row['id'].'">
                                <button class="btn bg-light like" style=" border-radius:15px;box-shadow:0px 0px 5px #dcdcdc;" id="'.$row['id'].'">
                                  <i class="fa fa-thumbs-up text-primary"></i> 
                                  <span id="likes_'.$row['id'].'"> 
                                  '.$row['likes'].'
                                </span>
                                </button>
                                <audio src=""></audio>
                              <button class="btn float-right stopText" id="'.$row['id'].'">
                              <i class="far fa-stop-circle text-danger"></i>
                              </button>
                              <button class="btn float-right playText" id="'.$row['id'].'">
                                      <i class="far fa-play-circle text-primary"></i>
                              </button>
                      </div>
                        <br>
                    </div>';
                  }
            }
          }
      }  
      else  // no hay ninguna experiencia que mostrar
      {  
           $output .= '  
              <p class="lead"> 0 resultados</p>
           ';  
      }  
    
      echo $output;  
 }


?>
  <script src="../../src/assets/js/jquery-3.2.1.min.js"></script>
  <script src="../../src/assets/js/likes.js"></script>
  <script src="../../src/assets/js/ReproTex.js"></script>


