# Simulador para el envio de datos
import sys
from socket import socket, AF_INET, SOCK_DGRAM

UDP_IP = "132.248.29.124"
UDP_PORT = 5005
MESSAGE = "{'temperatura':'50','ritmo_cardiaco':'333','pulso':'150'}"
print ("Test client sending packets to IP {0}, via port {1}\n".format(UDP_IP, UDP_PORT))
print "UDP target IP:", UDP_IP
print "UDP target port:", UDP_PORT
print "message:", MESSAGE

sock = socket( AF_INET, SOCK_DGRAM)
sock.sendto(MESSAGE, (UDP_IP, UDP_PORT))
sys.exit()
