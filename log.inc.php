﻿<?php
include ("./exit.php");

/********** This function is logging the visits **************/

function myLog($filename) {
  // Exclusion : on écrit dans le fichier seulement si : (possibilité de combiner les conditions d'exclusion).
  if (substr(gethostbyaddr($_SERVER['REMOTE_ADDR']), -8) !== ".bbox.fr" || FALSE || FALSE || FALSE) {
    // Si on peut ouvrir celui-ci en écriture (permission suffisante de l'acteur).
    if (!$handle = fopen($filename, 'a')) {
      exit ("Unable to open this file with 'append' mode.");
    } else {
      $lignes = file($filename);            
      $nbLignes = count ($lignes);
      $nbLignes +=1;
      // Si l'écriture dans le fichier s'est bien passé.
      if (fwrite($handle,  "$nbLignes"." : connected at ".date("H\hi"). " by " . $_SERVER['REMOTE_ADDR'] . "\n")) {
        // Si on a à écrire dans le fichier, 
        // et que l'on peut l'ouvrir en écriture, 
        // et que l'écriture s'est bien passée,
        // et que le fichier est appelé directement.
        if($_SERVER['PHP_SELF'] === "/log.inc.php")  
        { 
          echo "<!doctype html>\n<html>\n<head>\n<meta charset=\"utf-8\">\n<link href=\"style.css\" rel=\"stylesheet\" media=\"all\" type=\"text/css\">\n<link rel=\"icon\" href=\"/Images/favicon.ico\" />\n</head>\n<body>\n";
          echo "Write to the end of <b>" . $filename . "</b> file.\n";
          echo "<p class=src><a href=\"/FichiersTexte/log.inc.txt\">source php de la page</a></p>\n</body>\n</html>";
        }
      } else {
        exit ("Unable to write inside it.");
      } // fin de : si l'écriture s'est bien passée.
    fclose($handle);
    } // fin de : si on peut ouvrir celui-ci en écriture.
  } else {
    // Si l'on a rien à écrire dans le fichier,
    // et que ce fichier est appelé directement.
    if($_SERVER['PHP_SELF'] === "/log.inc.php") {
      echo "<!doctype html>\n<html>\n<head>\n<meta charset=\"utf-8\">\n<link href=\"style.css\" rel=\"stylesheet\" media=\"all\" type=\"text/css\">\n<link rel=\"icon\" href=\"/Images/favicon.ico\" />\n</head>\n<body>\nNothing to write in <b>" .$filename ."</b> file.\n";
      echo "<p class=src><a href=\"/FichiersTexte/log.inc.txt\">source php de la page</a></p>\n</body>\n</html>";
    }
  } // fin de : si on écrit dans celui-ci
}
/*****************************************************************/
myLog('./FichiersTexte/log.txt');
?>
