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
$vista1=0;
$vista2=1;
try{
  /* BD
     La ruta donde esta la base de datos */
  $db_path = 'sqlite:/db/arduino.db';
  /* Para conectarse o crear la base de datos
     Se crea el objeto PDO para controlar la conexion de la base de datos */
  $db = new PDO($db_path) or die("error");

  if($vista1){
    $query =  "SELECT * FROM arduino";    
    while($i=10){
      //Se crea la consulta en lenguaje SQL
      
      /* Metodo del objeto PDO para ejecutar el select
	 regresa un hash $row, con cada columna de la tabla */
      
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
      $i++;
    }
  }

  if($vista2)
    {
      //Se crea el string de SQL
      $query =  "SELECT * FROM arduino";
      while($i=10){
	print "id\t heart_rate\t temperature\t humidity\t date\t <p>\n";
	foreach ($db->query($query) as $row)
	  {
	    //print_r($row);
	    echo "<p>\n";
	    print $row['id'] . "\t";      
	    print $row['heart_rate'] . "\t";
	    print $row['temperature'] . "\t";
	    print $row['humidity'] . "\n";
	    print $row['date'] . "<p>\n";        
	  }
	$i++;
      }
    }
	  // Para cerrar la conexion a la base de datos
  $db = null;
}
catch (PDOExecption $e){ echo $e->getMessage(); }
?>
