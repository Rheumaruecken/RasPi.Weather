#!/usr/bin/python
# filename: weatherDSP.py 
# Wetter-Daten auf mini-Display 128x64

import MySQLdb
import time
import Adafruit_GPIO.SPI as SPI
import Adafruit_SSD1306

from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont

db = MySQLdb.connect(host="localhost", user="phpUser", passwd="phpUser", db="Wetter")
#create a cursor for the select
cur = db.cursor()
#execute an sql query
cur.execute("SELECT time, temp01, humi01, press01 FROM Daten ORDER BY id DESC LIMIT 0,1 ")
# loop to iterate
for row in cur.fetchall() :
      #data from rows
      dbTime  = str(row[0])
      dbTemp  = str(row[1])
      dbHumi  = str(row[2])
      dbPress = str(row[3])

# Raspberry Pi pin configuration:
RST = 24

# 128x32 or 128x64 display with hardware I2C:
disp = Adafruit_SSD1306.SSD1306_128_32(rst=RST)
# disp = Adafruit_SSD1306.SSD1306_128_64(rst=RST)
disp.begin()
disp.clear()
disp.display()

# Create blank image for drawing.
# Make sure to create image with mode '1' for 1-bit color.
width = disp.width
height = disp.height
image = Image.new('1', (width, height))

# Get drawing object to draw on image.
draw = ImageDraw.Draw(image)
draw.rectangle((0,0,width,height), outline=0, fill=0)

# Draw some shapes.
padding = 2

# shape_width = 20
top = padding
bottom = height-padding

# Move left to right keeping track of the current x position for drawing shapes.
x = padding

# Load default font.
font = ImageFont.load_default()

# Write text.
draw.text((x, top), dbTime,   font=font, fill=255)
draw.text((x, top+10), 'Temp.: ' + dbTemp + ' C', font=font, fill=255)
draw.text((x, top+20), 'Humi.: ' + dbHumi + ' %',  font=font, fill=255)

# Display image.
disp.image(image)
disp.display()
