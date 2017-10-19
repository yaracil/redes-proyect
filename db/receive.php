<?php

//$number = $_GET['a'];
$heart_rate = $_GET['b'];
$temperature = $_GET['c'];
$humidity = $_GET['d'];

ini_set('date.timezone', 'America/Mexico_City');
$now = date("Y-m-d H:i:s");
$result = 0;
//$query = $bd->exec("INSERT INTO arduino(number,date,heart_rate,temperature,humidity) VALUES ('$number','$now','$heart_rate','$temperature','$humidity');");

$db = new SQLite3('arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
if ($db->exec("INSERT INTO temperature (temperature, date) VALUES ('$temperature', '$now')") == false)
    $result++;
if ($db->exec("INSERT INTO heart_rate (heart_rate, date) VALUES ('$heart_rate', '$now')") == false)
    $result++;
if ($db->exec("INSERT INTO humidity (humidity, date) VALUES ('$humidity', '$now')") == false)
    $result++;

echo($result);

//echo date("INSERT INTO arduino(number,date,heart_rate,temperature,humidity) VALUES ('$number','$now','$heart_rate','$temperature','$humidity');");


