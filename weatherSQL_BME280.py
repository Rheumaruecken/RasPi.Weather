#!/usr/bin/python
# filename: weatherDSP.py 
# reading temp humidity and pressure from a BME280

from Adafruit_BME280 import *
import MySQLdb as my

sensor = BME280(mode=BME280_OSAMPLE_8)

degrees = sensor.read_temperature()
pascals = sensor.read_pressure()
hpa = pascals / 100
humidity = sensor.read_humidity()

print 'Timestamp = {0:0.3f}'.format(sensor.t_fine)
print 'Temp      = {0:0.3f} deg C'.format(degrees)
print 'Pressure  = {0:0.2f} hPa'.format(hpa)
print 'Humidity  = {0:0.2f} %'.format(humidity)
 
db = my.connect(host="127.0.0.1",
user="xxxxx",
passwd="xxxxx",
db="Wetter"
)
 
cursor = db.cursor()

sql = "INSERT INTO Daten(temp, press, humi)  VALUES('%s', '%s', '%s')" % \
 (degrees, hpa, humidity)
 
number_of_rows = cursor.execute(sql)
db.commit()
 
db.close()
