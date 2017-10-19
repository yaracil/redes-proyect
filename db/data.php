<?php

$db = new SQLite3('arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
$db->exec("CREATE TABLE IF NOT EXISTS temperature (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, temperature TEXT, Date TEXT)");
$db->exec("CREATE TABLE IF NOT EXISTS heart_rate (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, heart_rate TEXT, Date TEXT)");
$db->exec("CREATE TABLE IF NOT EXISTS humidity (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, humidity TEXT, Date TEXT)");

if (true) {
    //datos de prueba
    ini_set('date.timezone', 'America/Mexico_City');
    $now = date("Y-m-d H:i:s");
    $i = 0;
    $resul = 0;
    while ($i < 30) {
        $temp = rand(3, 40);
        $ritm = rand(0, 5);
        $hum = rand(10, 100);

        if ($db->exec("INSERT INTO temperature (temperature, date) VALUES ('$temp', '$now')") == 1)
            $resul++;
        $db->exec("INSERT INTO heart_rate (heart_rate, date) VALUES ('$ritm', '$now')");
        $db->exec("INSERT INTO humidity (humidity, date) VALUES ('$hum', '$now')");
        $now = date("Y-m-d H:i:s", mktime(date('s') + $i));
        $i++;
    }
}
$db->close();
echo $resul;
?>