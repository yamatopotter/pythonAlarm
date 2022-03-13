from pydub.playback import play
from pydub import AudioSegment
from os import path
import RPi.GPIO as gpio
import mysql.connector
import datetime
import logging

def getTime():
    horaAux = datetime.datetime.now()
    return horaAux

def getScriptFolder():
    scriptPath = path.split(path.realpath(__file__))
    return scriptPath[0]

def enablePins(pin):
    gpio.setmode(gpio.BOARD)
    gpio.setup(pin, gpio.OUT)
    gpio.output(pin, gpio.HIGH)

def disablePins(pin):
    gpio.output(pin, gpio.LOW)
    gpio.cleanup()

def connectMysql():
    global mydb
    global mycursor
    time = getTime()

    mydb = mysql.connector.connect(
        host="localhost",
        user="alarm",
        passwd="12345678",
        database="alarm"
    )

    if (mysql):
        print('[INFO] [{time}] Sucesso na conexão ao banco de dados')
        mycursor = mydb.cursor()

def createLog(case):
    logging.basicConfig(
    filename='pythonAlarm.log',
    format='[%(levelname)s] - %(asctime)s - %(message)s',
    datefmt='%d/%m/%Y %I:%M:%S %p',
    encoding='utf-8',
    level=logging.DEBUG
    )


mydb = 0
mycursor = 0
ROOT_FOLDER = getScriptFolder()
WEB_FOLDER = "/web/"
VIEW_SQL = "SELECT a.name as nomeAlarme, a.startTime as horaDoAlarme, aa.Nome as area, aa.GPIO_PORT as porta, also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout, s.path as path FROM Alarm as a INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID INNER JOIN Song as s ON s.songID = also.songID HAVING "

connectMysql()

hora = getTime()
hora = hora.strftime("%H:%M")

sql = VIEW_SQL + ("horaDoAlarme='{hora}'".format(hora=hora))
print('[INFO] [{hora}] Realizando pesquisa no banco de dados')

mycursor.execute(sql)
aux=mycursor.fetchall()


rc = mycursor.rowcount

if (rc>=1):
    hora = getTime()
    print('[INFO] [{hora}] Processando dados do alarme')
    nome_alarme = aux[0][0]
    arquivo = aux[0][7] #listar aqui o local do arquivo
    song_time = aux[0][4]*1000 #tempo da música
    fadein_time = aux[0][5]*1000
    fadeout_time = aux[0][6]*1000
    area = aux[0][2]
    porta = aux[0][3]

    pathSong = ROOT_FOLDER + WEB_FOLDER + arquivo
    hora = getTime()
    print('[INFO] [{hora}] Preparando música para reprodução')
    song = AudioSegment.from_mp3(pathSong)
    hora = getTime()
    print("[EXEC] [{hora}] Há um alarme sendo executado agora")
    print("""[INFO] Dados do alarme
        Alarm: {nameAlarm}
        Song: {songName}
        Path: {pathSong}
        Time: {timeAlarm}
    """.format(nameAlarm = nome_alarme, songName = arquivo, pathSong = pathSong, timeAlarm = song_time))
    enablePins(porta)
    cut_song = song[:song_time]
    cut_song_with_effect = cut_song.fade_in(fadein_time).fade_out(fadeout_time)
    play(cut_song_with_effect)
    disablePins(porta)
else:
    print("[INFO] Não há alarme para ser executado no momento")

mycursor.close()
mydb.close()
