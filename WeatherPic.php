<?php
header("Content-type: image/png");

// VARIABLEN
   $_db_host = "localhost";	// Server
   $_db_user = "phpUser";	// User
   $_db_pswd = "phpUser";	// PW
   $_db_data = "Wetter";	// Datenbank
   $_db_tabl = "Daten";	// Tabelle
   $temp[0] = 0;		// Temperatur
   $i = 0;			// Schleife
   $zeilen = 0;		// 4Tage Vertikalanzeige
   $xDB = 5;
   $yDB = 405;

// erstellen eines leeren Bildes mit 500px Breite und 50px Hoehe
   $bild = imagecreatetruecolor(500, 600);

// Farben festlegen
   $white = imagecolorallocate($bild, 255, 255, 255);
   $blue  = imagecolorallocate($bild,   0,   0, 255);
   $black = imagecolorallocate($bild,   0,   0,   0);
   $green = imagecolorallocate($bild,   0, 155,   0);
   $red   = imagecolorallocate($bild, 255,   0,   0);
   $white = imagecolorallocate($bild, 255, 255, 255);
   $yellow= imagecolorallocate($bild, 255, 255,   0);

// Hintergrund
   imagefill($bild, 0, 0, $white);

// Gitter
   $i = 0;
   while ($i < 450) {
      imageline ($bild, 490-$i, 0, 490-$i, 279, $black);
      $i=$i+96;
   }
   imageline ($bild, 10,   0, 490,   0, $black);	// Temp  50
   imageline ($bild, 10,  25, 490,  25, $black);	// Temp	 25
   imageline ($bild, 10,  51, 490,  51, $black);	// Temp   0
   imageline ($bild, 10,  52, 490,  52, $black);	// Humi 100
   imageline ($bild, 10, 103, 490, 103, $black);	// Humi	 50
   imageline ($bild, 10, 153, 490, 153, $black);	// Humi   0
   imageline ($bild, 10, 154, 490, 154, $black); 	// Press 1100
   imageline ($bild, 10, 216, 490, 216, $black);	// Press  975
   imageline ($bild, 10, 279, 490, 279, $black); 	// Press  850

   imageline ($bild, 10, 0, 10, 279, $black);

   ImageString ($bild, 2, 15,   5, "Temperatur", $black);
   ImageString ($bild, 2, 15,  55, "Feuchtigkeit", $black);
   ImageString ($bild, 2, 15, 155, "Luftdruck", $black);
   ImageString ($bild, 2, 487, 280,  "0", $black);
   ImageString ($bild, 2, 391, 280, "24", $black);
   ImageString ($bild, 2, 295, 280, "36", $black);
   ImageString ($bild, 2, 199, 280, "48", $black);
   ImageString ($bild, 2, 103, 280, "72", $black);
   ImageString ($bild, 2,   8, 280, "96 Stunden", $black);


// VERBINDUNG
   $conn = mysqli_connect($_db_host,$_db_user,$_db_pswd,$_db_data);
   if (!$conn) {
      die('Could not connect: ' . mysqli_error());
   }

// Datenausgabe
//   Temperatur
   imageFilledRectangle ($bild, $xDB+ 0, $yDB+0, $xDB+70, $yDB+190, $black);
   imageFilledRectangle ($bild, $xDB+39, $yDB+50, $xDB+50, $yDB+175,  $yellow);
   imageFilledRectangle ($bild, $xDB+53, $yDB+50, $xDB+64, $yDB+175,  $yellow);
   ImageString ($bild, 4, $xDB+ 5, $yDB+ 5, "Temp.", $white);
   ImageString ($bild, 4, $xDB+41, $yDB+25, "I A", $white);
   ImageString ($bild, 4, $xDB+18, $yDB+50, "75", $white);
   ImageString ($bild, 4, $xDB+18, $yDB+75, "50", $white);
   imageline ($bild, $xDB+39, $yDB+75,$xDB+65, $yDB+75, $black);
   ImageString ($bild, 4, $xDB+18, $yDB+100, "25", $white);
   imageline ($bild, $xDB+39, $yDB+100,$xDB+65, $yDB+100, $black);
   ImageString ($bild, 4, $xDB+18, $yDB+125, " 0", $white);
   imageline ($bild, $xDB+39, $yDB+125,$xDB+50, $yDB+125, $black);
   ImageString ($bild, 4, $xDB+10, $yDB+150, "-25", $white);
   imageline ($bild, $xDB+39, $yDB+150,$xDB+65, $yDB+150, $black);
   ImageString ($bild, 4, $xDB+10, $yDB+175, "-50", $white);

//   Feuchtigkeit
   imageFilledRectangle ($bild, $xDB+ 75, $yDB+ 0, $xDB+145, $yDB+190, $black);
   imageFilledRectangle ($bild, $xDB+109, $yDB+50, $xDB+120, $yDB+150, $yellow);
   imageFilledRectangle ($bild, $xDB+124, $yDB+50, $xDB+135, $yDB+150, $yellow);
   ImageString ($bild, 4, $xDB+ 80, $yDB+  5, "Humi.", $white);
   ImageString ($bild, 4, $xDB+110, $yDB+ 25, "I A", $white);
   ImageString ($bild, 4, $xDB+ 80, $yDB+ 50, "100", $white);
   ImageString ($bild, 4, $xDB+ 80, $yDB+ 75, " 75", $white);
   imageline ($bild, $xDB+109, $yDB+75,$xDB+145, $yDB+75, $black);
   ImageString ($bild, 4, $xDB+ 80, $yDB+100, " 50", $white);
   imageline ($bild, $xDB+109, $yDB+100,$xDB+145, $yDB+100, $black);
   ImageString ($bild, 4, $xDB+ 80, $yDB+125, " 25", $white);
   imageline ($bild, $xDB+109, $yDB+125,$xDB+145, $yDB+125, $black);
   ImageString ($bild, 4, $xDB+ 80, $yDB+150, "  0", $white);

//   Luftdruck
   imageFilledRectangle ($bild, $xDB+150, $yDB+  0, $xDB+220, $yDB+190, $black);
   imageFilledRectangle ($bild, $xDB+184, $yDB+ 50, $xDB+195, $yDB+150, $yellow);
   imageFilledRectangle ($bild, $xDB+198, $yDB+ 50, $xDB+210, $yDB+150, $yellow);
   ImageString ($bild, 4, $xDB+155, $yDB+  5, "Druck", $white);
   ImageString ($bild, 4, $xDB+185, $yDB+ 25, "I A", $white);
   ImageString ($bild, 2, $xDB+155, $yDB+ 50, "1100", $white);
   ImageString ($bild, 2, $xDB+155, $yDB+100, " 975", $white);
   imageline ($bild, $xDB+184, $yDB+100,$xDB+210, $yDB+100, $black);
   ImageString ($bild, 2, $xDB+155, $yDB+150, " 850", $white);

//   Windgeschwindigkeit
   imageFilledRectangle ($bild, $xDB+225, $yDB+0, $xDB+275, $yDB+190, $black);
   imageFilledRectangle ($bild, $xDB+258, $yDB+50, $xDB+270, $yDB+150, $yellow);
   ImageString ($bild, 4, $xDB+230, $yDB+  5, "Wind", $white);
   ImageString ($bild, 4, $xDB+235, $yDB+ 25, "m/s", $white);
   ImageString ($bild, 4, $xDB+230, $yDB+ 50, " 50", $white);
   ImageString ($bild, 4, $xDB+230, $yDB+100, " 25", $white);
   imageline ($bild, $xDB+258, $yDB+100,$xDB+270, $yDB+100, $black);
   ImageString ($bild, 4, $xDB+230, $yDB+150, "  0", $white);
//   Windrichtung
   imageFilledRectangle ($bild, $xDB+275, $yDB+0, $xDB+355, $yDB+190, $black);
   ImageString ($bild, 4, $DB+280, $yDB+ 20, "Richtung", $white);
   imageellipse ($bild, $xDB+313, $yDB+ 100, 50, 50, $yellow);
   ImageString ($bild, 4, $xDB+310, $yDB+ 57, "N", $yellow);
   ImageString ($bild, 4, $xDB+278, $yDB+ 90, "W", $yellow);
   ImageString ($bild, 4, $xDB+341, $yDB+ 90, "O", $yellow);
   ImageString ($bild, 4, $xDB+310, $yDB+127, "S", $yellow);

// Werte 4-Tages-Diagramm

   $sql = "SELECT * FROM Daten ORDER BY id DESC LIMIT 480;";
   $result = mysqli_query($conn, $sql);
   $i = 0;
   if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
         imageline ($bild, 490-$i,  50, 490-$i,  50-$row["temp01"], $red);
         imageline ($bild, 490-$i, 152, 490-$i, 152-$row["humi01"], $blue);
         $x = ($row["press01"]-850)/2;
         imageline ($bild, 490-$i, 278, 490-$i, 278-$x, $green);
         $i++;
      }
    }

// Werte Aktuell
   if (mysqli_num_rows($result) > 0) {
      $sql = "SELECT * FROM Daten ORDER BY id DESC LIMIT 0,1 ";
      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_assoc($result)) {
	imageFilledRectangle ($bild, $xDB+360, $yDB+ 0, $xDB+490, $yDB+190, $black);

	ImageString ($bild, 4, $xDB+365,$yDB+ 5, "Aktuelle Daten", $white);
	ImageString ($bild, 2, $xDB+365,$yDB+20, $row["time" ], $white);

	ImageString ($bild, 2, $xDB+365,$yDB+40, "INNEN", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+ 55, "Temp.: ". $row["temp01" ] . " C", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+ 65, "Humi.: ". $row["humi01" ] . " %", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+ 75, "Druck: ". $row["press01"] . " hPa", $white);
	ImageString ($bild, 2, $xDB+365,$yDB+100, "AUSSEN:", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+120, "Temp.: ". $row["temp02" ] . " C", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+130, "Humi.: ". $row["humi02" ] . " %", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+145, "Speed: ". $row["windSpeed" ] . " m/s", $white);
	ImageString ($bild, 2, $xDB+370,$yDB+155, "Dir.:  ". $row["sindDir" ] . " ", $white);
	$i = 0;
	while ($i<10) {
          imageline ($bild,  $xDB+40+$i, ($yDB+175)-($row["temp01"]+50),  $xDB+40+$i, $yDB+175, $red);
          imageline ($bild,  $xDB+54+$i, ($yDB+175)-($row["temp02"]+50),  $xDB+54+$i, $yDB+175, $red);

          imageline ($bild, $xDB+110+$i, ($yDB+150)-$row["humi01"], $xDB+110+$i, $yDB+150, $blue);
          imageline ($bild, $xDB+125+$i, ($yDB+150)-$row["humi02"], $xDB+125+$i, $yDB+150, $blue);

	  $x = ($row["press01"]-850)/2;
	  imageline ($bild, $xDB+185+$i, $yDB+150-$x, $xDB+185+$i, $yDB+150, $green);
	  $x = ($x-850)/2;
	  imageline ($bild, $xDB+200+$i, $yDB+150-$x, $xDB+200+$i, $yDB+150, $green);
	  imageline ($bild, $xDB+260+$i, $yDB+150-$row["windSpeed"], $xDB+260+$i, $yDB+150, $blue);

          $i++;
        }
     }
  }
// Verbindung beenden
   mysqli_close($conn);

// Ausgabe des Bildes
   imagepng($bild);
?>
