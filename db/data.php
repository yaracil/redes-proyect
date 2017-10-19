<?php

$db = new SQLite3('arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
if (true) {
    //datos de prueba
    ini_set('date.timezone', 'America/Mexico_City');
    $now = date("Y-m-d H:i:s");
    $i = 0;
    $resul = 0;
    $db->exec("CREATE TABLE IF NOT EXISTS arduino (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, heart_rate TEXT, temperature TEXT, humidity TEXT, date TEXT);");
    while ($i < 30) {
        $temp = rand(3, 40);
        $ritm = rand(0, 5);
        $hum = rand(10, 100);

        if ($db->exec("INSERT INTO arduino (heart_rate, temperature, humidity, date) VALUES ('$ritm', '$temp', '$hum', '$now')") == 1)
            $resul++;
        $now = date("Y-m-d H:i:s", mktime(date('s') + $i));
        $i++;
    }
}
$db->close();
echo $resul;
?>