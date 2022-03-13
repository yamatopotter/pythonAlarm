# import mysql.connector

# mydb = mysql.connector.connect(
#     host="localhost",
#     user="alarm",
#     passwd="12345678",
#     database="alarm"
# )
# mycursor = mydb.cursor()
# print(mycursor)

import datetime

horaAux = datetime.datetime.now()
hora = horaAux.strftime("%H:%M")

print ("horaDoAlarme='{hora}'".format(hora=hora))