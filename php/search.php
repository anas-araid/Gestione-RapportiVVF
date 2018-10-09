<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  include "functions.php";

  if (isset($_POST['find'])){
    $searchKeyword = $_POST['find'];
    $reportsID = array();
    $reportsIndex = 0;

    // cerca nei rapportini
    $reportSQL = "SELECT * FROM `t_rapportivvf`
                  WHERE Concat(ID_Rapporto, ' ', OraUscita, ' ',  OraRientro, ' ', Data, ' ', Urgente, ' ', OperazioniEseguite) LIKE "."'%$searchKeyword%'"."";
    echo $reportSQL;
    $risultato = mysqli_query($db_conn, $reportSQL);
    if ($risultato == false){
      die("error cerca rapportini");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reportsID[$reportsIndex] = $ris['ID'];
      $reportsIndex++;
    }
    print_r($reportsID);



    // cerca tra i comuni
    $comuniID = array();
    $comuniIndex = 0;
    $comuniSQL = "SELECT * FROM `t_comuni` WHERE Comune LIKE "."'%$searchKeyword%'"."";
    echo $comuniSQL;
    $risultato = mysqli_query($db_conn, $comuniSQL);
    if ($risultato == false){
      die("error cerca comuni");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $comuniID[$comuniIndex] = $ris['ID'];
      $comuniIndex++;
    }
    print_r($comuniID);



    // cerca tra i colpiti
    $colpitiID = array();
    $colpitiIndex = 0;
    $colpitiSQL = "SELECT * FROM `t_generalitacolpiti`
                  WHERE Concat(Nome, ' ', Cognome, ' ', DataDiNascita, ' ', Residenza, ' ', Telefono, ' ', NCartaIdentita, ' ', Altro) LIKE "."'%$searchKeyword%'"."";
    echo $colpitiSQL;
    $risultato = mysqli_query($db_conn, $colpitiSQL);
    if ($risultato == false){
      die("error cerca generalita colpiti");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $colpitiID[$colpitiIndex] = $ris['ID'];
      $colpitiIndex++;
    }
    print_r($colpitiID);


      // cerca tra le localita
      $localitaID = array();
      $localitaIndex = 0;
      $localitaSQL = "SELECT * FROM `t_localita` WHERE Via LIKE "."'%$searchKeyword%'"."";
      echo $localitaSQL;
      $risultato = mysqli_query($db_conn, $localitaSQL);
      if ($risultato == false){
        die("error cerca localita");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $localitaID[$localitaIndex] = $ris['ID'];
        $localitaIndex++;
      }
      print_r($localitaID);



      // cerca tra i mezzi
      $mezziID = array();
      $mezziIndex = 0;
      $mezziSQL = "SELECT * FROM `t_mezzi` WHERE Descrizione LIKE "."'%$searchKeyword%'"."";
      echo $mezziSQL;
      $risultato = mysqli_query($db_conn, $mezziSQL);
      if ($risultato == false){
        die("error cerca mezzi");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $mezziID[$mezziIndex] = $ris['ID'];
        $mezziIndex++;
      }
      print_r($mezziID);



      // cerca tra i soccorsi
      $soccorsiID = array();
      $soccorsiIndex = 0;
      $soccorsiSQL =  "SELECT * FROM `t_soccorsiesterni` WHERE Descrizione LIKE  "."'%$searchKeyword%'"."";
      echo $soccorsiSQL;
      $risultato = mysqli_query($db_conn, $soccorsiSQL);
      if ($risultato == false){
        die("error cerca soccorsi");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $soccorsiID[$soccorsiIndex] = $ris['ID'];
        $soccorsiIndex++;
      }
      print_r($soccorsiID);



      // cerca tra le chiamate
      $chiamataID = array();
      $chiamataIndex = 0;
      $chiamataSQL =  "SELECT * FROM `t_tipochiamata` WHERE Tipologia LIKE "."'%$searchKeyword%'"."";
      echo $chiamataSQL;
      $risultato = mysqli_query($db_conn, $chiamataSQL);
      if ($risultato == false){
        die("error ricerca tra le chiamate");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $chiamataID[$chiamataIndex] = $ris['ID'];
        $chiamataIndex++;
      }
      print_r($chiamataID);



      // cerca tra i vigili
      $vigiliID = array();
      $vigiliIndex = 0;
      $vigiliSQL =  "SELECT * FROM `t_vigili` WHERE Concat(Nome, ' ', Cognome, ' ', Matricola) LIKE "."'%$searchKeyword%'"."";
      echo $vigiliSQL;
      $risultato = mysqli_query($db_conn, $vigiliSQL);
      if ($risultato == false){
        die("error ricerca tra i vigili");
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $vigiliID[$vigiliIndex] = $ris['ID'];
        $vigiliIndex++;
      }
      print_r($vigiliID);
  }


?>
