import socket
import ast
import sqlite3
import threading
from Queue import Queue
import time
from datetime import datetime

queue_event = Queue()

'''Capture UDP packages'''
def get_udp_package():
  hostName = socket.gethostbyname('0.0.0.0')
<<<<<<< HEAD
  #hostName = "127.0.0.1"
=======
  #UDP_IP = "132.248.29.124"
  UDP_IP = "127.0.0.1"
>>>>>>> 778c7b234ca05b2d6942acb2013aa50fbd3a1041
  UDP_PORT = 5005
  sock = socket.socket(socket.AF_INET, # Internet
                     socket.SOCK_DGRAM) # UDP
  sock.bind((hostName, UDP_PORT))
  while True:
	data, addr = sock.recvfrom(1024) # buffer size is 1024 bytes
	queue_event.put(data,False)
	print data

'''Save UDP information'''
def save_information():
<<<<<<< HEAD
  conn = sqlite3.connect('/db/arduino.db')
  c = conn.cursor() 
  c.execute('''CREATE TABLE IF NOT EXISTS arduino (id integer,heart_rate integer, temperature integer, humidity integer, date text)''')
=======
  conn = sqlite3.connect('arduino.db')
  c = conn.cursor() 
  c.execute('''CREATE TABLE IF NOT EXISTS temperature (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, temperature TEXT, Date TEXT''')
  c.execute('''CREATE TABLE IF NOT EXISTS heart_rate (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, heart_rate TEXT, Date TEXT''')
  c.execute('''CREATE TABLE IF NOT EXISTS humidity (PatternID INTEGER PRIMARY KEY AUTOINCREMENT, humidity TEXT, Date TEXT''')
>>>>>>> 778c7b234ca05b2d6942acb2013aa50fbd3a1041
  while True:
        conn = sqlite3.connect('/db/arduino.db')
        c = conn.cursor()
        while queue_event.empty() is False:
		data=queue_event.get()
		result = ast.literal_eval(data) #convirtiendo string a dict
		keys = result.keys() #obteniendo las propiedades
        	values = result.values()
<<<<<<< HEAD
        	c.execute("INSERT INTO arduino("+', '.join(keys)+",date) VALUES ("+', '.join(values)+",'"+datetime.now().strftime('%Y-%m-%d %H:%M:%S')+"')") #Salvar en DB
=======
        	c.execute("INSERT INTO arduino("+', '.join(keys)+") VALUES ("+', '.join(values)+")") #Salvar en DB

            #asi seria en php las variables son las que tienen el $ :P
        	#c.execute("INSERT INTO temperature (temperature, date) VALUES ('$temperature', '$now')
        	#c.execute("INSERT INTO heart_rate (heart_rate, date) VALUES ('$heart_rate', '$now')
        	#c.execute("INSERT INTO humidity (humidity, date) VALUES ('$humidity', '$now')
>>>>>>> 778c7b234ca05b2d6942acb2013aa50fbd3a1041
        	conn.commit()
		print "guardado"
	conn.close()
	
threading.Thread(target=get_udp_package).start()
threading.Thread(target=save_information).start()
