<?php


$bd = new SQLite3('example.db');
$data_points = array();
$results = $bd->query('SELECT * FROM arduino');

while ($row = $results->fetchArray()) {
    $point = array("fecha"=> $row['3'], "temperatura" => $row['1']);
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