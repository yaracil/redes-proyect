<?php

$option = $_GET['option'];
$bd = new SQLite3('arduino.db');
$data_points = array();
ini_set('date.timezone', 'America/Mexico_City');
$now = date("Y-m-d H:i:s");


if (strcmp($option, "update") == 0) {
    $results = $bd->query('SELECT heart_rate, temperature, humidity, date FROM arduino ORDER BY date DESC LIMIT 1');
    $row = $results->fetchArray();
    $point = array("ritmo_cardiaco" => $row[0], "temperatura" => $row[1], "humedad" => $row[2], "fecha" => $row[3]);
    array_push($data_points, $point);
} else if(strcmp($option, "tables") == 0) {
        $results = $bd->query('SELECT  heart_rate, temperature, humidity, date FROM arduino ORDER BY date ');
        while ($row = $results->fetchArray()) {
            $point = array("ritmo_cardiaco" => $row[0], "temperatura" => $row[1], "humedad" => $row[2], "fecha" => $row[3]);
            array_push($data_points, $point);
        }
}

header("Content-type:application/json");
echo json_encode($data_points);

?>