<?php
      define("HOSTNAME","localhost"); 
      define("UserNAME","root");
      define("PASSWORD","");
      define("DBNAME","crud_app");

      $con = mysqli_connect(HOSTNAME,UserNAME,PASSWORD,DBNAME); 

      if ($con)
      {
      //     echo "You are Connected.";
      }
?>