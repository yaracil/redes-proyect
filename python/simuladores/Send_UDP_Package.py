import socket
import random
import time

UDP_IP = "127.0.0.1"
UDP_PORT = 5005

while True:

	MESSAGE = "{'heart_rate': '"+str(random.randint(1,15))+"','temperature': '"+str(random.randint(0,40))+"','humidity': '"+str(random.randint(0,100))+"'}"
	print MESSAGE
	sock = socket.socket(socket.AF_INET, # Internet
                      socket.SOCK_DGRAM) # UDP
	sock.sendto(MESSAGE, (UDP_IP, UDP_PORT))

	time.sleep(1)
