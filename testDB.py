import mysql.connector

mydb = mysql.connector.connect(
    host="localhost",
    user="alarm",
    passwd="12345678",
    database="alarm"
)

print(mydb)