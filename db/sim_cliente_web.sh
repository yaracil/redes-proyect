
echo "Simulcion de 100 consultas";

for i in `seq 1 100`;do 
    wget -O - http://132.248.29.124/redes-proyect/db/receiveDB.php?a=$i\&b=$(($i + RANDOM % 50))\&c=$(($i + RANDOM % 50))\&d=$(($i + RANDOM % 50));
done

