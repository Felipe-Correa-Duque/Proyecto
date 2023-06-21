<?php
require '../conexionbd.php';
$conn = conexion();

$year = $_POST['year'];
$political = $_POST['political'];
$country = $_POST['contry'];
$votos = $_POST['votos'];

// Utiliza sentencias preparadas con parámetros vinculados para evitar ataques de inyección SQL
$insercion = "INSERT INTO election (year, vote_Count, polotical_Party, code_count) VALUES ('{$year}','{$country}','{$political}','{$votos}')";

if($conn->query($insercion)){
    echo json_encode(array('error' => false));
} else {
    echo json_encode(array('error' => true));
}
$conn->close();
?>
