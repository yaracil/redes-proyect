<?php


$bd = new SQLite3('example.db');
$data_points = array();
$results = $bd->query('SELECT date,heart_rate FROM arduino ORDER BY date DESC LIMIT 10  ');

while ($row = $results->fetchArray()) {
    $point = array("fecha"=> $row['0'], "ritmo_cardiaco" => $row['1']);
    array_push($data_points, $point);
}
header("Content-type:application/json");
echo json_encode($data_points);


/*echo json_encode([
    "one" => "Singular sensation",
    "two" => "Beady little eyes",
    "three" => "Little birds pitch by my doorstep"
]);*/

?>