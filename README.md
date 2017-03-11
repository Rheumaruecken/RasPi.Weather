# RasPi.Weather
#
# Hardware
# - RaspberryPi 2B
# - BME280 (Temp-Humity-Pressur)
# - DHT22  (Temp-Humity)
# - Spare part Anemometer for Froggit WH1080
# - PCF8583P (Counter)
# - GY-271 (Triple Axis Kompass-Magnetometer)
# - 0,96 Zoll I2C 128 x 64 OLED-Display-Modul
#
# Software
# - Raspian     OS
# - Apachee2    Webserver
# - mySQL       Database
# - OpenVPN     Virtual Privat Network
# - Adafruit    Driver
#
# Description
# - BME280     I2C   Outdoor  for Temperature, Humity, Air Pressur
# - BME280     I2C   Indoor  for Temperature, Humity, Air Pressur
# - Anemometer I2C   Outdoor for Wind Speed
#     Radius 7cm => ~50cm measure, 2 reed-relay included => 25cm each pulse
#     connected to a PFC8583 to count pulses and transmit via I2C
#     fixed on a 2cm-cable-conduit and a header for the circuit board
# - Compass   Outdoor for Wind Direction
# - DHT22      GPIO  Indoor for Temperature, Humity (in addition if necessary)
