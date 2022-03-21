from pydub.playback import play
from pydub import AudioSegment
from time import sleep
from os import path
import mysql.connector
import datetime

def getScriptFolder():
    scriptPath = path.split(path.realpath(__file__))
    return (scriptPath[0])

def connectMysql():
    global mydb
    global mycursor

    mydb = mysql.connector.connect(
        host="localhost",
        port="3306",
        user="alarm",
        password="12345678",
        database="alarm"
    )

    if (mysql):
        print('Conectado ao banco de dados.')
        mycursor = mydb.cursor(buffered=True)
    else:
        print("[ERROR] Sem conexão ao BD")
    

mydb = 0
mycursor = 0
ROOT_FOLDER = getScriptFolder()
WEB_FOLDER = "web/"
VIEW_SQL = "SELECT a.name as nomeAlarme, a.startTime as horaDoAlarme, a.enabled as active, aa.Nome as area, aa.GPIO_PORT as porta, also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout, s.path as path FROM Alarm as a INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID INNER JOIN Song as s ON s.songID = also.songID HAVING active=1 AND "

connectMysql()

horaAux = datetime.datetime.now()
hora = horaAux.strftime("%H:%M")
hora = '10:05'

sql = VIEW_SQL + ("horaDoAlarme='{hora}'".format(hora=hora))

print(sql)
mycursor.execute(sql)

rc = mycursor.rowcount
# rc = 1
print(rc)

if (rc>=1):
    aux = mycursor.fetchone()
    arquivo = aux['path'] #listar aqui o local do arquivo
    song_time = aux['tempoMusica'] #tempo da música
    fadein_time = aux['fadeIn']
    fadeout_time = aux['fadeout']
    area = aux['area']

    arquivo = ROOT_FOLDER + WEB_FOLDER + arquivo
    song = AudioSegment.from_mp3(arquivo)
    cut_song = song[:song_time]
    cut_song_with_effect = cut_song.fade_in(fadein_time).fade_out(fadeout_time)
    play(cut_song_with_effect)
else:
    print("[INFO] Sem alarme programado")
