from venv import create
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
    createLog(1, """Porta {pin} habilitada""")
    gpio.setup(pin, gpio.OUT)
    gpio.output(pin, gpio.HIGH)

def disablePins(pin):
    createLog(1, """Porta {pin} desabilitada""")
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
        createLog(1, 'Database connection success!')
        mycursor = mydb.cursor()
    else:
        createLog(3, 'Error on DB connection.')

def createLog(case, message):
    logging.basicConfig(
    filename='pythonAlarm.log',
    format='[%(levelname)s] - %(asctime)s - %(message)s',
    datefmt='%d/%m/%Y %I:%M:%S %p',
    encoding='utf-8',
    level=logging.DEBUG
    )

    switch = {
        1: logging.info(message),
        2: logging.warning(message),
        3: logging.error(message)
    }

    switch.get(case, "Opção inválida")

#Script Folder
ROOT_FOLDER = getScriptFolder()
#Webfiles folder
WEB_FOLDER = "/web/"
#SQL View - I used this method because when I imported the db from docker it broke the view, so I decided to use this. I think it is not elegant but it works.
VIEW_SQL = "SELECT a.name as nomeAlarme, a.startTime as horaDoAlarme, aa.Nome as area, aa.GPIO_PORT as porta, also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout, s.path as path FROM Alarm as a INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID INNER JOIN Song as s ON s.songID = also.songID HAVING "

# Starting RPi Ports
gpio.setmode(gpio.BOARD)

# Starting DB vars
mydb = 0
mycursor = 0

connectMysql()

# Get time to search on DB
hora = getTime()
hora = hora.strftime("%H:%M")

# Creating SQL instruction
sql = VIEW_SQL + ("horaDoAlarme='{hora}'".format(hora=hora))
createLog(1, 'Realizando pesquisa no banco de dados')

mycursor.execute(sql)
aux=mycursor.fetchall()

rc = mycursor.rowcount

if (rc>=1):
    createLog(1, 'Processando dados do alarme')
    nome_alarme = aux[0][0]
    arquivo = aux[0][7] #listar aqui o local do arquivo
    song_time = aux[0][4]*1000 #tempo da música
    fadein_time = aux[0][5]*1000
    fadeout_time = aux[0][6]*1000
    area = aux[0][2]
    porta = aux[0][3]

    pathSong = ROOT_FOLDER + WEB_FOLDER + arquivo
    createLog(1, 'Preparando música para reprodução')
    song = AudioSegment.from_mp3(pathSong)
    createLog(1, 'Há um alarme sendo executado agora')
    createLog(1,"""[INFO] Dados do alarme
        Alarm: {nome_alarme}
        Song: {arquivo}
        Path: {pathSong}
        Time: {song_time}
    """ )
    enablePins(porta)
    cut_song = song[:song_time]
    cut_song_with_effect = cut_song.fade_in(fadein_time).fade_out(fadeout_time)
    play(cut_song_with_effect)
    disablePins(porta)
else:
    print("[INFO] Não há alarme para ser executado no momento")

mycursor.close()
mydb.close()
