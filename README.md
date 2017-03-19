# RasPi.Weather
#
# Hardware
# - RaspberryPi 2B+
# - BME280 (Temp-Humity-Pressur)
# - DHT22  (Temp-Humity)
# - Spare part Anemometer for Froggit WH1080
# - PCF8583P (Counter)
# - GY-271 (Triple Axis Kompass-Magnetometer)
# - BH 1750 FVI
# - Regensensor
# - 0,96 Zoll I2C 128 x 64 OLED-Display-Modul
#
# - RJ11 6P4C Buchse
# - Lochrasterplatine
# - 40x 20cm female-female jumper wire cable
# - Gehäuse für Raspberry Pi B+/Pi 2/Pi 3 
#
# Software
# - Raspian     OS
# - Apachee2    Webserver
# - mySQL       Database
# - OpenVPN     Virtual Privat Network
# - Adafruit    Driver
#
#
# Description
# - BME280     I2C   Outdoor  for Temperature, Humity, Air Pressur
# - BME280     I2C   Indoor  for Temperature, Humity, Air Pressur
# - Anemometer I2C   Outdoor for Wind Speed
#     Radius 7cm => ~50cm measure, 2 reed-relay included => 25cm each pulse
#     connected to a PFC8583 to count pulses and transmit via I2C
#     fixed on a 2cm-cable-conduit and a header for the circuit board
# - Compass    Outdoor for Wind Direction
#     GY271 fixt in the Cale Conuit and a magnet in the wind van 
# - DHT22      GPIO  Indoor for Temperature, Humity (in addition if necessary)
