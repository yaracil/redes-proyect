<?php
   $a=$_GET['a'];
   $b=$_GET['b'];
   $c=$_GET['c'];
   $d=$_GET['d'];
   echo "<p>variable a : $a";
   echo "<p>variable b : $b";
   echo "<p>variable c : $c";
   echo "<p>variable d : $d";
   ini_set('date.timezone','America/Mexico_City');
   echo date("<p>j/m/Y G:i:s");
   $f=date("j/m/Y G:i:s");
   if($a== '0'){
   $fp = fopen('texto.txt', 'w');
   fwrite($fp, "$a,$b,$c,$d,$f\n");
   fclose($fp);
   }else{$fp = fopen('texto.txt', 'a');
   fwrite($fp, "$a,$b,$c,$d,$f\n");
   fclose($fp);
   }
?>

