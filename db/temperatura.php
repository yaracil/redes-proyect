<?php

$option = $_GET['option'];
$bd = new SQLite3('arduino.db');
$data_points = array();
//date_default_timezone_set('UTC');
$now = date("Y-m-d H:i:s");

if (strcmp($option, "update") == 0) {
    $results = $bd->query('SELECT Date,temperature FROM temperature ORDER BY date DESC LIMIT 1');
    $row = $results->fetchArray();
    $data_points = array("fecha" => $row['0'], "temperatura" => $row['1']);
} else {
    $results = $bd->query('SELECT Date,temperature FROM temperature ORDER BY date DESC LIMIT 10');
    while ($row = $results->fetchArray()) {
        $point = array("fecha" => $row['0'], "temperatura" => $row['1']);
        array_push($data_points, $point);
        $i++;
    }
}
header("Content-type:application/json");
echo json_encode($data_points);

/*echo json_encode([
    "one" => "Singular sensation",
    "two" => "Beady little eyes",
    "three" => "Little birds pitch by my doorstep"
]);*/

?>