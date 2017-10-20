
echo "Simulcion de 100 consultas";

for i in `seq 1 50`;do 
    wget -O - http://132.248.29.124/redes-proyect/db/receiveDB.php?a=$i\&b=$(($i + RANDOM % 50))\&c=$(($i + RANDOM % 30))\&d=$(($i + RANDOM % 20));
sleep 1s;
done

