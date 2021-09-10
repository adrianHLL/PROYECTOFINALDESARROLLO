<?php
     function AdminExp(string $accion, int $id){
        require '../../config/Conn.php';//el archvio de la conexion de la BD
        if($accion =="filter"){// buscar por cc
            $records = $conn->prepare('SELECT * FROM experiencias where idU = "'.$id.'" ');
            $records->execute();
        }else{ //mostrar todas las experiencias
            $records = $conn->prepare('SELECT * FROM experiencias');
            $records->execute();
        }
       return $records;// valor con opcion elegida 
     }
     function deleteExp(int $id){ //borrar las experiencias
        require '../../config/Conn.php';
        $records = $conn->prepare('DELETE FROM experiencias WHERE  id = "'.$id.'"');
        $records->execute();
     }
    
?>