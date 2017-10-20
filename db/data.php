<?php
//$db = new SQLite3('/db/arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
$db = new SQLite3('arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
/* Para conectarse o crear la base de datos
   Se crea el objeto PDO para controlar la conexion de la base de datos */
$i = 0;
$resul = 0;
$db->exec("CREATE TABLE IF NOT EXISTS arduino (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, heart_rate TEXT, temperature TEXT, humidity TEXT, date TEXT);");
while ($i < 30) {
    while ($i < 50) {
        $temp = rand(3, 40);
        $ritm = rand(1, 5);
        $hum = rand(10, 100);

        if ($db->exec("INSERT INTO arduino (heart_rate, temperature, humidity, date) VALUES ('$ritm', '$temp', '$hum', '$now')") == 1)
            $resul++;
        $now = date("Y-m-d H:i:s", mktime(date('s') + $i));
        $i++;
        +sleep(1);
    }
}
echo $resul;
?>