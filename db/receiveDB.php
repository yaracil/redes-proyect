<?php
/*
  Posgrado en Ciencias de la Computacion e Ingenieria Electrica
  Redes y Servicios Integrados
  Profesor: Dr. Victor Rangel Licea
  Proyecto: Graficacion de datos enviados por un arduino remotamente
  Alumnos
  Claudia Liset Stincer Torres
  Enrique Palacios Boneta
  Yoelkys Hernandez Aracil
  Resendiz Tolentino Gibran Joel
 */
/* Variable para habilitar el debug */
$debug = 0;

if ($_GET && $_GET['a'] != 0) {
    $a = (int)$_GET['a'];
    $b = (int)$_GET['b'];
    $c = (int)$_GET['c'];
    $d = (int)$_GET['d'];
    ini_set('date.timezone', 'America/Mexico_City');
    $dia = date("d");
    $mes = date("m");
    $year = date("Y");
    $hora = date("H");
    $min = date("i");
    $seg = date("s");
    $date = $dia . $mes . $year . $hora . $min . $seg;
    if ($debug) {
        print "Var set<p>\n";
        print "Formato de fecha DiaMesA~oHoraMinSeg<p>\n";
        print "Fecha de recibido[" . $dia . $mes . $year . $hora . $min . $seg . "]<p>\n";
    }

    try {
        /* BD
           La ruta donde esta la base de datos */
        $db_path = 'sqlite:/db/arduino.db';
        /* Para conectarse o crear la base de datos
           Se crea el objeto PDO para controlar la conexion de la base de datos */
        $db = new PDO($db_path) or die("error");
        //$stmt = $db -> prepare("CREATE TABLE IF NOT EXISTS arduino (id INTEGER, heart_rate INTEGER, temperature INTEGER, humidity INTEGER, date TEXT);");
        /* Se ejecuta el query */
        //if ( $stmt -> execute() ) { if(debug){echo "<p>Table is created.<p>\n";}}

        //Se crea la consulta en lenguaje SQL
        //$query =  "SELECT * FROM arduino";
        //echo "\n<P>";

        /* Metodo del objeto PDO para ejecutar el select
           regresa un hash $row, con cada columna de la tabla */
        /*
        foreach ($db->query($query) as $row)
          {
            print_r($row);
            echo "<p>\n";
            print $row['heart_rate'] . "\t";
            print $row['temperature'] . "\t";
            print $row['humidity'] . "\n";
            print $row['date'] . "\n";
            echo "<p>\n";
          }
        */

        /* Se crea la cadena para insertar un valor a la base de datos */
        $stmt = $db->prepare("INSERT INTO arduino (id, heart_rate, temperature, humidity, date) VALUES (:id, :heart_rate, :temperature, :humidity, :date)");
        /* Se imprime el query */
        //print "Query[".$query."]<P>\n";

        /* bind params */
        $stmt->bindParam(':id', $a, PDO::PARAM_INT);
        $stmt->bindParam(':heart_rate', $b, PDO::PARAM_INT);
        $stmt->bindParam(':temperature', $c, PDO::PARAM_INT);
        $stmt->bindParam(':humidity', $d, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        /* Se ejecuta el query */
        if ($stmt->execute()) {
            if ($debug) {
                echo "Se ejecuto el query de insert.<p>\n";
                echo "Se insertaron los datos:<p>";
                echo "<p>variable a : $a\n";
                echo "<p>variable b : $b\n";
                echo "<p>variable c : $c\n";
                echo "<p>variable d : $d\n";
                echo "<p>variable date : $date<p>\n";
            }
        }
        //Se crea el string de SQL
        $query = "SELECT * FROM arduino";
        print "id\t heart_rate\t temperature\t humidity\t date\t <p>\n";
        foreach ($db->query($query) as $row) {
            //print_r($row);
            echo "<p>\n";
            print $row['id'] . "\t";
            print $row['heart_rate'] . "\t";
            print $row['temperature'] . "\t";
            print $row['humidity'] . "\n";
            print $row['date'] . "<p>\n";
        }
        // Para cerrar la conexion a la base de datos
        $db = null;
    } catch (PDOExecption $e) {
        echo $e->getMessage();
    }
} else {
    print "Las variables GET no estan definidas<p>\n";
}
/*
  Posgrado en Ciencias de la Computacion e Ingenieria Electrica
  Redes y Servicios Integrados
  Profesor: Dr. Victor Rangel Licea
  Proyecto: Graficacion de datos enviados por un arduino remotamente
  Alumnos
  Claudia Liset Stincer Torres
  Enrique Palacios Boneta
  Yoelkys Hernandez Aracil
  Resendiz Tolentino Gibran Joel
 */
/* Variable para habilitar el debug */
$debug = 0;

if ($_GET && $_GET['a'] != 0) {
    $a = (int)$_GET['a'];
    $b = (int)$_GET['b'];
    $c = (int)$_GET['c'];
    $d = (int)$_GET['d'];
    ini_set('date.timezone', 'America/Mexico_City');
    /*  $dia = date("d");
      $mes = date("m");
      $year = date("Y");
      $hora = date("H");
      $min = date("i");
      $seg = date("s");
      $date=$dia.$mes.$year.$hora.$min.$seg;  */
    $now = date("Y-m-d H:i:s");
    if ($debug) {
        print "Var set<p>\n";
        print "Formato de fecha AMesDia~oHoraMinSeg<p>\n";
        print "Fecha de recibido['$now']<p>\n";
    }

    try {
        /* BD
           La ruta donde esta la base de datos */
        $db_path = 'sqlite:/db/arduino.db';
        /* Para conectarse o crear la base de datos
           Se crea el objeto PDO para controlar la conexion de la base de datos */
        $db = new PDO($db_path) or die("error");
        $stmt = $db->prepare("CREATE TABLE IF NOT EXISTS arduino (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, heart_rate TEXT, temperature TEXT, humidity TEXT, date TEXT);");
        /* Se ejecuta el query */
        if ($stmt->execute()) {
            if (debug) {
                echo "<p>Table is created.<p>\n";
            }
        }

        //Se crea la consulta en lenguaje SQL
        //$query =  "SELECT * FROM arduino";
        //echo "\n<P>";

        /* Metodo del objeto PDO para ejecutar el select
           regresa un hash $row, con cada columna de la tabla */
        /*
        foreach ($db->query($query) as $row)
          {
            print_r($row);
            echo "<p>\n";
            print $row['heart_rate'] . "\t";
            print $row['temperature'] . "\t";
            print $row['humidity'] . "\n";
            print $row['date'] . "\n";
            echo "<p>\n";
          }
        */

        /* Se crea la cadena para insertar un valor a la base de datos */
        $stmt = $db->prepare("INSERT INTO arduino (id, heart_rate, temperature, humidity, date) VALUES (:id, :heart_rate, :temperature, :humidity, :date)");
        /* Se imprime el query */
        //print "Query[".$query."]<P>\n";

        /* bind params */
        $stmt->bindParam(':id', $a, PDO::PARAM_STR);
        $stmt->bindParam(':heart_rate', $b, PDO::PARAM_STR);
        $stmt->bindParam(':temperature', $c, PDO::PARAM_STR);
        $stmt->bindParam(':humidity', $d, PDO::PARAM_STR);
        $stmt->bindParam(':date', $now, PDO::PARAM_STR);

        /* Se ejecuta el query */
        if ($stmt->execute()) {
            if ($debug) {
                echo "Se ejecuto el query de insert.<p>\n";
                echo "Se insertaron los datos:<p>";
                echo "<p>variable a : $a\n";
                echo "<p>variable b : $b\n";
                echo "<p>variable c : $c\n";
                echo "<p>variable d : $d\n";
                echo "<p>variable date : $date<p>\n";
            }
        }
        //Se crea el string de SQL
        $query = "SELECT * FROM arduino";
        print "id\t heart_rate\t temperature\t humidity\t date\t <p>\n";
        foreach ($db->query($query) as $row) {
            //print_r($row);
            echo "<p>\n";
            print $row['id'] . "\t";
            print $row['heart_rate'] . "\t";
            print $row['temperature'] . "\t";
            print $row['humidity'] . "\n";
            print $row['date'] . "<p>\n";
        }
        // Para cerrar la conexion a la base de datos
        $db = null;
    } catch (PDOExecption $e) {
        echo $e->getMessage();
    }
} else {
    print "Las variables GET no estan definidas<p>\n";
}
?>
