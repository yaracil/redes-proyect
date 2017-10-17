## Version final, con hilos. Uno escribe y otro recibe.
import socket
import ast
import sqlite3
import threading
from Queue import Queue
import time

queue_event = Queue()

'''Capture UDP packages'''
def get_udp_package():
  hostName = socket.gethostbyname('0.0.0.0')
  UDP_IP = "132.248.29.124"
  #UDP_IP = "127.0.0.1"
  UDP_PORT = 5005
  sock = socket.socket(socket.AF_INET, # Internet
                     socket.SOCK_DGRAM) # UDP
  sock.bind((hostName, UDP_PORT))
  print ("Test server listening on port {0}\n".format(UDP_PORT))
  while True:
	data, addr = sock.recvfrom(1024) # buffer size is 1024 bytes
	queue_event.put(data,False)
	print data

'''Save UDP information'''
def save_information():
  conn = sqlite3.connect('example.db')
  c = conn.cursor() 
  c.execute('''CREATE TABLE IF NOT EXISTS arduino (heart_rate text, temperature text, humidity text)''')
  while True:
	conn = sqlite3.connect('arduino.db')
	c = conn.cursor()
	while queue_event.empty() is False:
		data=queue_event.get()
		result = ast.literal_eval(data) #convirtiendo string a dict
		keys = result.keys() #obteniendo las propiedades
        	values = result.values()
        	c.execute("INSERT INTO arduino("+', '.join(keys)+") VALUES ("+', '.join(values)+")") #Salvar en DB
        	conn.commit()
	conn.close()
	time.sleep(9)


threading.Thread(target=get_udp_package).start()
threading.Thread(target=save_information).start()
