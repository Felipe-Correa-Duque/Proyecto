<?php
require '../PHPExcel/Classes/PHPExcel.php';
require '../conexionbd.php';
$conn = conexion();
$archivo = 'counties.xlsx';

// carga el excel
$excel = PHPExcel_IOFactory::load($archivo);

// carga la hoja de cálculo
$excel->setActiveSheetIndex(0);

// obtiene el número de filas
$numerofila = $excel->getActiveSheet()->getHighestRow();

for ($i = 2; $i <= $numerofila; $i++) {
   $codestate = $excel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
   $codecounty = preg_replace('/[^A-Za-z0-9]/', '', $excel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());
   $county = preg_replace('/[^A-Za-z0-9]/', '', $excel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue());
   $population = preg_replace('/[^0-9]/', '', $excel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue());
   $area = $excel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();

   $consulta = "INSERT INTO country (id, code_country, county, population, area) VALUES ('$codestate', '$codecounty', '$county', '$population', '$area')
   ON DUPLICATE KEY UPDATE code_country = VALUES(code_country), county = VALUES(county), population = VALUES(population), area = VALUES(area)";

   $resultado = $conn->query($consulta);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Counties successful upload</title>
</head>
<body>
    <h1>Counties successfully uploaded</h1>
</body>
</html>
