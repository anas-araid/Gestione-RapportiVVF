<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  include "functions.php";

  if (isset($_POST['find'])){
    $searchKeyword = $_POST['find'];
    $reportsID = array();
    $index = 0;

    // cerca nei rapportini
    $reportSQL = "SELECT * FROM `t_rapportivvf`
                  WHERE Concat(ID_Rapporto, ' ', OraUscita, ' ',  OraRientro, ' ', Data, ' ', Urgente, ' ', OperazioniEseguite) LIKE "."%$searchKeyword%"."";
    echo $reportSQL;
    $risultato = mysqli_query($db_conn, $reportSQL);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reportsID[$index] = $ris['ID'];
      $index++;
    }
    print_r($reportsID);

    // cerca tra i comuni
    $comuniSQL = "SELECT * FROM `t_comuni` WHERE Comune LIKE "."%$keyword%"."";
    echo $comuniSQL;
    $risultato = mysqli_query($db_conn, $comuniSQL);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reportsID[$index] = $ris['ID'];
      $index++;
    }
    print_r($reportsID);
  }


?>
