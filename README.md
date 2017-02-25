# RasPi.Weather
#
# Hardware:
# - RaspberryPi 2B
# - BME280 (Temp-Humity-Pressur)
# - DHT22  (Temp-Humity)
# - Ersatz Sensor Windgeschwindigkeit für Froggit WH1080 WH3080 WH1090 (Anemometer for wind speed)
#     PCF8583P (Counter)
# - GY-271 (Triple Axis Kompass-Magnetometer)
# - 0,96 Zoll I2C 128 x 64 Display-Modul
#
# Software
# - Raspian     OS
# - Apachee     Webserver
# - MySQL       Database
# - OpenVPN     Virtual Privat Network
# - Adafruit    Driver
#
# Description
# - BME280     I2C   Indoor  for Temperature, Humity, Air Pressur
# - DHT22      GPIO  Outdoor for Temperature, Humity
# - Anemometer I2C   Outdoor for Wind Speed
#     Radius 7cm => ~50cm measure, 2 reed-relay included => 25cm each pulse
#     connected to a PFC8583 to count pulses and transmit via I2C
#     fixed on a 2cm-cable-conduit and a header for the circuit board
# - Kopmpass   Outdoor for Wind Direction
