from pydub.playback import play
from pydub import AudioSegment
from os import path
import RPi.GPIO as gpio
import mysql.connector
import datetime

print ("Olá, Esse é o Teste de Alarme do PythonAlarm, será usado para listar os alarmes e testar a velocidade de reprodução das músicas.")

def getTime():
    return datetime.datetime.now()

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

mydb = 0
mycursor = 0
ROOT_FOLDER = getScriptFolder()
WEB_FOLDER = "/web/"
VIEW_SQL = "SELECT a.name as nomeAlarme, a.startTime as horaDoAlarme, aa.Nome as area, aa.GPIO_PORT as porta, also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout, s.path as path FROM Alarm as a INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID INNER JOIN Song as s ON s.songID = also.songID"

connectMysql()
hora = getTime()

sql = VIEW_SQL
print('[INFO] [{hora}] Realizando pesquisa no banco de dados')

mycursor.execute(sql)
result=mycursor.fetchall()

rc = mycursor.rowcount

hora = getTime()
print('[INFO] [{hora}] Listando dados dos alarmes cadastrados')

i=0

if(rc>0):    
    for(aux in result):
        nome_alarme = aux[0]
        arquivo = aux[7] #listar aqui o local do arquivo
        song_time = aux[4]*1000 #tempo da música
        fadein_time = aux[5]*1000
        fadeout_time = aux[6]*1000
        area = aux[2]
        porta = aux[3]

        print("Numero: {i}")
        print("Alarme: {nome_alarme}")
        print("Arquivo: {arquivo}")
        print("Tempo da Musica: {song_time}")
        print("Fade In: {fadein_time}")
        print("Fade Out: {nome_alarme}")
        print("Area de execução: {area}")
        print("GPIO: {porta}")
        print("-----------------------------")

    op = input("Escolha uma opção para executar: ")

    if(op>=result.length):
        print('[INFO] [{hora}] Processando dados do alarme')
        nome_alarme = result[op][0]
        arquivo = result[op][7] #listar aqui o local do arquivo
        song_time = result[op][4]*1000 #tempo da música
        fadein_time = result[op][5]*1000
        fadeout_time = result[op][6]*1000
        area = result[op][2]
        porta = result[op][3]

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
    print("[INFO] Não há alarmes cadastrados no sistema")
