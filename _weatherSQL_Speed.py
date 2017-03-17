#!/usr/bin/python
# filename: weatherSQL_Speed.py.py 
# reading wind speed from anemometer with RTC/CNT

from ....
import MySQLdb as my



 # connecting DB
db = my.connect(host="127.0.0.1",
user="xxxxx",
passwd="xxxxx",
db="Wetter"
)
 
cursor = db.cursor()

sql = "INSERT INTO Daten(speed)  VALUES('%s')" % \
 (speed)
 
number_of_rows = cursor.execute(sql)
db.commit()
 
db.close()
