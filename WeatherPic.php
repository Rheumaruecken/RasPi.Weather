<?php
header("Content-type: image/png");

// VARIABLEN
   $_db_host = "localhost";	// Server
   $_db_user = "xxxxxxx";	  // User
   $_db_pswd = "xxxxxxx";	  // PW
   $_db_data = "Wetter";	  // Datenbank
   $_db_tabl = "Daten";	    // Tabelle
   $temp[0] = 0;		        // Temperatur
   $i = 0;			            // Schleife
   $zeilen = 0;		          // 4Tage Vertikalanzeige

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
   $sql = "SELECT * FROM Daten ORDER BY id DESC LIMIT 480;";
   $result = mysqli_query($conn, $sql);

// Datenausgabe
   $i = 0;
   if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
         imageline ($bild, 490-$i,  50, 490-$i,  50-$row["temp"], $red);
         imageline ($bild, 490-$i, 152, 490-$i, 152-$row["humi"], $blue);
         $x = ($row["press"]-850)/2;
         imageline ($bild, 490-$i, 278, 490-$i, 278-$x, $green);
         $i++;
      }
   $posYblack = 400;
   $sql = "SELECT * FROM Daten ORDER BY id DESC LIMIT 0,1 ";
   $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
         imageFilledRectangle ($bild, 360, $posYblack + 190, 490, $posYblack + 5, $black); // Digitaanzeige

         ImageString ($bild, 4, 370,$posYblack +  10, "Aktuelle Daten", $white);
         ImageString ($bild, 2, 370,$posYblack +  30, "INNEN", $white);
         ImageString ($bild, 2, 375,$posYblack +  50, "Temp.: ". $row["temp" ] . " C", $white);
         ImageString ($bild, 2, 375,$posYblack +  60, "Humi.: ". $row["humi" ] . " %", $white);
         ImageString ($bild, 2, 375,$posYblack +  70, "Druck: ". $row["press"] . " hPa", $white);
         ImageString ($bild, 2, 370,$posYblack + 100, "AUSSEN:", $white);
         ImageString ($bild, 2, 375,$posYblack + 120, "Temp.: ". $row["tempA" ] . " C", $white);
         ImageString ($bild, 2, 375,$posYblack + 130, "Humi.: ". $row["humiA" ] . " %", $white);
         ImageString ($bild, 2, 375,$posYblack + 145, "Speed: ". $row["windSpeed" ] . " m/s", $white);
         ImageString ($bild, 2, 375,$posYblack + 155, "Dir.:  ". $row["sindDir" ] . " ", $white);

         $i = 0;
         imageFilledRectangle ($bild, 10, $posYblack + 190, 80, $posYblack + 5, $black); //Temp
         imageFilledRectangle ($bild, 44, $posYblack + 185, 55, $posYblack + 55, $yellow);// Innen
         imageFilledRectangle ($bild, 64, $posYblack + 185, 75, $posYblack + 55, $yellow);// Aussen

         ImageString ($bild, 4, 15, $posYblack +  10, "Temp.", $white);
         ImageString ($bild, 4, 45, $posYblack +  30,  "I  A", $white);
         ImageString ($bild, 4, 22, $posYblack +  50,  "75", $white);
         ImageString ($bild, 4, 22, $posYblack +  75,  "50", $white);
         ImageString ($bild, 4, 22, $posYblack + 100,  "25", $white);
         ImageString ($bild, 4, 22, $posYblack + 125,  " 0", $white);
         ImageString ($bild, 4, 15, $posYblack + 150, "-25", $white);
         ImageString ($bild, 4, 15, $posYblack + 175, "-50", $white);

         imageFilledRectangle ($bild,  90, $posYblack + 190, 160, $posYblack + 5, $black); //Humi
         imageFilledRectangle ($bild, 124, $posYblack + 155, 135, $posYblack + 55, $yellow); //Innen
         imageFilledRectangle ($bild, 144, $posYblack + 155, 155, $posYblack + 55, $yellow); //Aussen
         ImageString ($bild, 4,  95, $posYblack +  10, "Humi.", $white);
         ImageString ($bild, 4, 125, $posYblack +  30, "I  A", $white);
         ImageString ($bild, 4,  95, $posYblack +  50, "100", $white);
         ImageString ($bild, 4,  95, $posYblack +  75, " 75", $white);
         ImageString ($bild, 4,  95, $posYblack + 100, " 50", $white);
         ImageString ($bild, 4,  95, $posYblack + 125, " 25", $white);
         ImageString ($bild, 4,  95, $posYblack + 150, "  0", $white);

         imageFilledRectangle ($bild, 170, $posYblack + 190, 220, $posYblack + 5, $black); //Druck
         imageFilledRectangle ($bild, 204, $posYblack + 155, 215, $posYblack + 55, $yellow);
         ImageString ($bild, 4, 175,  $posYblack +  10, "Druck", $white);
         ImageString ($bild, 2, 175,  $posYblack +  48, "1100", $white);
         ImageString ($bild, 4, 168,  $posYblack + 195, " 975", $white);
         ImageString ($bild, 4, 168,  $posYblack + 145, " 850", $white);

         imageFilledRectangle ($bild, 230, $posYblack + 190, 280, $posYblack + 5, $black); // WindSpeed
         imageFilledRectangle ($bild, 264, $posYblack + 155, 275, $posYblack + 55, $yellow);
         ImageString ($bild, 4, 235,  $posYblack +  10, "Wind", $white);
         ImageString ($bild, 4, 245,  $posYblack +  25, "m/s", $white);
         ImageString ($bild, 4, 235,  $posYblack +  48, " 50", $white);
         ImageString ($bild, 4, 235,  $posYblack +  95, " 25", $white);
         ImageString ($bild, 4, 235,  $posYblack + 145, "  0", $white);

         imageFilledRectangle ($bild, 280, $posYblack + 190, 350, $posYblack + 5, $black); // WindSpeed
         imageFilledRectangle ($bild, 264, $posYblack + 155, 275, $posYblack + 55, $yellow);
         ImageString ($bild, 4, 280,  $posYblack +  25, "Richtung", $white);
         ImageString ($bild, 4, 310,  $posYblack +  57, "N", $yellow);
         ImageString ($bild, 4, 278,  $posYblack +  90, "W", $yellow);
         ImageString ($bild, 4, 341,  $posYblack +  90, "O", $yellow);
         ImageString ($bild, 4, 310,  $posYblack + 127, "S", $yellow);
         imageellipse ($bild, 313, $posYblack + 100, 50, 50, $yellow);

         while ($i<10) {
            imageline ($bild,  45+$i, ($posYblack + 185)-($row["temp"] +50),  45+$i, $posYblack +185, $red);  // Temp Innen
            imageline ($bild,  65+$i, ($posYblack + 185)-($row["tempA"]+50),  65+$i, $posYblack + 185, $red);  // Temp Aussen

            imageline ($bild, 125+$i, ($posYblack + 155)-$row["humi"],  125+$i, $posYblack + 155, $blue);
            imageline ($bild, 145+$i, ($posYblack + 155)-$row["humiA"], 145+$i, $posYblack + 155, $blue);

            $x = ($row["press"]-850)/2;
            imageline ($bild, 205+$i, $posYblack + 155-$x, 205+$i, $posYblack + 155, $green);

            imageline ($bild, 265+$i, $posYblack + 155-$row["windSpeed"], 265+$i, $posYblack + 155, $blue);

            $i++;
         }
      }
   }
// Verbindung beenden
   mysqli_close($conn);

// Ausgabe des Bildes
   imagepng($bild);
?>
