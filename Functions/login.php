<?php
// Incluir el archivo de conexión a la base de datos
require '../conexionbd.php';
 $conn=conexion();
 $usuarios =$conn->query("SELECT email,password FROM coordinador WHERE email='".$_POST['email']."'AND password='".$_POST['password']."'");

 if($usuarios->num_rows == 1){
    $datos = $usuarios->fetch_assoc();
    echo json_encode(array('error'=>false,'tipo'=> $datos['email']));
    $_SESSION['email']= $datos['email'];

 }else{
    echo json_encode(array('error'=> true));
 }

 $conn->close();
?>
