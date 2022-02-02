from pydub import AudioSegment
from pydub.playback import play
import mysql.connector
import datetime

# mydb = 0
# mycursor = 0

# def connectMysql():
#     global mydb
#     global mycursor

#     mydb = mysql.connector.connect(
#         host="localhost",
#         user="efrequency",
#         passwd="123456",
#         database="eFrequencyAlarm"
#     )

#     if (mysql):
#         print('Conectado ao banco de dados.')
#         mycursor = mydb.cursor(buffered=True)

#connectMysql()

horaAux = datetime.datetime.now()
hora = horaAux.strftime("%H:%M")

#sql = "SELECT * FROM alarme WHERE hora='{hora}'".format(hora=hora)
#mycursor.execute(sql)

#rc = mycursor.rowcount
rc = 1
print(rc)

if (rc>=1):
    #aux = mycursor.fetchone()
    #arquivo = aux[x] #listar aqui o local do arquivo
    #song_time = aux[x] #tempo da música
    #fadein_time = aux[x]
    #fadeout_time = aux[x]

    arquivo = "/Users/matheusbarreto/Documents/python/alarm/test.mp3"
    song_time = 10000
    fadein_time = 2000
    fadeout_time = 2000
    song = AudioSegment.from_mp3(arquivo)
    cut_song = song[:song_time]
    cut_song_with_effect = cut_song.fade_in(fadein_time).fade_out(fadeout_time)
    play(cut_song_with_effect)
