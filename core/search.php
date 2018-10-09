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
    $risultato = mysqli_query($db_conn, $reportSQL);
    if ($risultato == false){
      die("error cerca rapportini");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reportsID[$reportsIndex] = $ris['ID'];
      $reportsIndex++;
    }



    // cerca tra i comuni
    $comuniID = array();
    $comuniIndex = 0;
    $comuniSQL = "SELECT * FROM `t_comuni` WHERE Comune LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $comuniSQL);
    if ($risultato == false){
      die("error cerca comuni");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $comuniID[$comuniIndex] = $ris['ID'];
      $comuniIndex++;
    }



    // cerca tra i colpiti
    $colpitiID = array();
    $colpitiIndex = 0;
    $colpitiSQL = "SELECT * FROM `t_generalitacolpiti`
                  WHERE Concat(Nome, ' ', Cognome, ' ', DataDiNascita, ' ', Residenza, ' ', Telefono, ' ', NCartaIdentita, ' ', Altro) LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $colpitiSQL);
    if ($risultato == false){
      die("error cerca generalita colpiti");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $colpitiID[$colpitiIndex] = $ris['ID'];
      $colpitiIndex++;
    }


    // cerca tra le localita
    $localitaID = array();
    $localitaIndex = 0;
    $localitaSQL = "SELECT * FROM `t_localita` WHERE Via LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $localitaSQL);
    if ($risultato == false){
      die("error cerca localita");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $localitaID[$localitaIndex] = $ris['ID'];
      $localitaIndex++;
    }



    // cerca tra i mezzi
    $mezziID = array();
    $mezziIndex = 0;
    $mezziSQL = "SELECT * FROM `t_mezzi` WHERE Descrizione LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $mezziSQL);
    if ($risultato == false){
      die("error cerca mezzi");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $mezziID[$mezziIndex] = $ris['ID'];
      $mezziIndex++;
    }



    // cerca tra i soccorsi
    $soccorsiID = array();
    $soccorsiIndex = 0;
    $soccorsiSQL =  "SELECT * FROM `t_soccorsiesterni` WHERE Descrizione LIKE  "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $soccorsiSQL);
    if ($risultato == false){
      die("error cerca soccorsi");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $soccorsiID[$soccorsiIndex] = $ris['ID'];
      $soccorsiIndex++;
    }



    // cerca tra le chiamate
    $chiamataID = array();
    $chiamataIndex = 0;
    $chiamataSQL =  "SELECT * FROM `t_tipochiamata` WHERE Tipologia LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $chiamataSQL);
    if ($risultato == false){
      die("error ricerca tra le chiamate");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $chiamataID[$chiamataIndex] = $ris['ID'];
      $chiamataIndex++;
    }



    // cerca tra i vigili
    $vigiliID = array();
    $vigiliIndex = 0;
    $vigiliSQL =  "SELECT * FROM `t_vigili` WHERE Concat(Nome, ' ', Cognome, ' ', Matricola) LIKE "."'%$searchKeyword%'"."";
    $risultato = mysqli_query($db_conn, $vigiliSQL);
    if ($risultato == false){
      die("error ricerca tra i vigili");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $vigiliID[$vigiliIndex] = $ris['ID'];
      $vigiliIndex++;
    }
    //-----------------------------------------------------------------------------------

    // COLPITI
    // Restituisce l'id del rapporto in base all'id del colpito
    for ($i=0; $i < count($colpitiID); $i++){
      $reportsByGeneralita[$i] = getReportsByGeneralita($colpitiID[$i], $db_conn);
    }
    //print_r($reportsByGeneralita);



    // COMUNE
    // Restituisce l'id della/e localita in base all'id del comune per poi risalire agli id dei rapportini
    // $reportByLocalita è una matrice per ogni via contiene gli id dei rapporti di riferimento
    $localitaByComune = array();
    for ($i=0; $i < count($comuniID); $i++){
      $localitaByComune[$i] = getLocalitaByComune($comuniID[$i], $db_conn);
    }
    //print_r($localitaByComune);
    $reportByComune = array();
    for ($i=0; $i < count($localitaByComune); $i++){
      for ($j=0; $j < count($localitaByComune[$i]); $j++){
        $reportByComune[$j] = getReportsByLocalita($localitaByComune[$i][$j], $db_conn);
      }
    }
    //print_r($reportByLocalita);

    // LOCALITA
    // $reportByLocalita è un array che contiene gli id dei rapporti nella specifica localita
    $reportByLocalita = array();
    for ($i=0; $i < count($localitaID); $i++){
      $reportByLocalita[$i] = getReportsByLocalita($localitaID[$i], $db_conn);
    }
    //print_r($reportByLocalita);


    // MEZZI
    // $reportByMezzi -> matrice: per ogni mezzo contiene la lista degli id dei rapportini
    $reportByMezzi = array();
    for ($i=0; $i<count($mezziID); $i++){
      $reportByMezzi[$i] = getReportsByMezzi($mezziID[$i], $db_conn);
    }
    //print_r($reportByMezzi);


    // SOCCORSI
    // $reportBySoccorsi -> matrice: per ogni soccorritore esterno contiene la lista degli id dei rapportini
    $reportBySoccorsi = array();
    for ($i=0; $i < count($soccorsiID); $i++){
      $reportBySoccorsi[$i] = getReportsBySoccorsi($soccorsiID[$i], $db_conn);
    }
    //print_r($reportBySoccorsi);


    // TIPO CHIAMATA
    // $reportByChiamata -> matrice: per ogni tipologia di intervento contiene la lista degli id dei rapportini
    $reportByChiamata = array();
    for ($i=0; $i < count($chiamataID); $i++){
      $reportByChiamata[$i] = getReportsByTipologia($chiamataID[$i], $db_conn);
    }
    //print_r($reportByChiamata);


    // VIGILI
    // $reportByVigili -> matrice: per ogni vigile contiene la lista degli id dei rapporto
    $reportByVigili = array();
    for ($i=0; $i < count($vigiliID); $i++){
      $reportByVigili[$i] = getReportsByVigili($vigiliID[$i], $db_conn);
    }
    print_r($reportByVigili);

  }




?>
