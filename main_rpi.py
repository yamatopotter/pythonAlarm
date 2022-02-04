from pydub.playback import play
from pydub import AudioSegment
from time import sleep
from os import path
import RPi.GPIO as gpio
import mysql.connector
import datetime

mydb = 0
mycursor = 0
ROOT_FOLDER = getScriptFolder()
WEB_FOLDER = "web/"

def getScriptFolder():
    scriptPath = path.split(path.realpath(__file__))
    return scriptPath[0]

def enablePins(pin):
    gpio.setmode(gpio.BOARD)
    gpio.setup(pin, gpio.out)
    gpio.output(pin, gpio.HIGH)

def disablePins(pin):
    gpio.output(pin, gpio.LOW)
    gpio.cleanup()

def connectMysql():
    global mydb
    global mycursor

    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="123456",
        database="alarm"
    )

    if (mysql):
        print('Conectado ao banco de dados.')
        mycursor = mydb.cursor(buffered=True)

connectMysql()

horaAux = datetime.datetime.now()
hora = horaAux.strftime("%H:%M")

sql = "SELECT * FROM listAlarm WHERE horaDoAlarme='{hora}'".format(hora=hora)
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
    enablePins(area)
    cut_song = song[:song_time]
    cut_song_with_effect = cut_song.fade_in(fadein_time).fade_out(fadeout_time)
    play(cut_song_with_effect)
    sleep(song_time+5)
    disablePins(area)
