<?php
require '../conexionbd.php';
$conn = conexion();
$json = file_get_contents('elections.json');
$data = json_decode($json);

$conn->begin_transaction();

try {
    foreach ($data as $key) {
        $year = $key->year;
        $democrat = $key->democrat;
        $republic = $key->republic;
        $other = $key->other;
        $codecounty = $key->codecounty;

        // Utiliza sentencias preparadas para evitar ataques de inyección SQL
        $consulta = "INSERT INTO election (year, vote_Count, polotical_Party, code_count) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($consulta);
        $stmt->bind_param("ssss", $year, $democrat, $republic, $codecounty);
        $stmt->execute();

        // Verifica si hubo errores en la ejecución de las consultas
        if ($stmt->errno) {
            throw new Exception("Error en la inserción de datos: " . $stmt->error);
        }
    }

    $conn->commit();
    echo "<h1>Elections uploaded successfully</h1>";
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}


?>
