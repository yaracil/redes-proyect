<?php
//$db = new SQLite3('/db/arduino.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
$db_path = 'sqlite:/db/arduino.db';
/* Para conectarse o crear la base de datos
   Se crea el objeto PDO para controlar la conexion de la base de datos */
$db = new PDO($db_path) or die("error");
if (true) {
    //datos de prueba
    ini_set('date.timezone', 'America/Mexico_City');
    $now = date("Y-m-d H:i:s");
    $i = 0;
    $resul = 0;
    //$db->exec("CREATE TABLE IF NOT EXISTS arduino (id INTEGER, heart_rate TEXT, temperature TEXT, humidity TEXT, date TEXT);");
    $stmt = $db -> prepare("CREATE TABLE IF NOT EXISTS arduino (id INTEGER, heart_rate TEXT, temperature TEXT, humidity TEXT, date TEXT);");
    $stmt -> execute()
    while ($i < 50) {
    	$id=$i;
        $temp = rand(3, 40);
        $ritm = rand(1, 5);
        $hum = rand(10, 100);

        if ($db->exec("INSERT INTO arduino (id, heart_rate, temperature, humidity, date) VALUES ('$id', '$ritm', '$temp', '$hum', '$now')") == 1)
            $resul++;
        $now = date("Y-m-d H:i:s", mktime(date('s') + $i));
        $i++;
        sleep(1);
    }
}
$db->close();
echo $resul;
?>
