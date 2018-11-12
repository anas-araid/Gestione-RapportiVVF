<?php
  function getInterventi($anno, $db_conn, $isFrequent){
    $frequent = "";
    if ($isFrequent){
      $frequent = " ORDER BY n_inter DESC LIMIT 5";
    }
    if ($anno != ""){
      $anno = "WHERE YEAR(Data) = '$anno'";
    }
    $report = array();
    $sql = "SELECT FK_TipoChiamata AS Intervento, COUNT(FK_TipoChiamata) AS n_inter FROM t_rapportiVVF $anno GROUP BY FK_TipoChiamata".$frequent;
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report[$i] = array(getCallType($ris['Intervento'], $db_conn), $ris['n_inter']);
      $i++;
    }
    return $report;
  }
  function getInterventiAnnuali($anno, $db_conn){
    if ($anno != ""){
      $anno = "WHERE YEAR(Data) = '$anno'";
    }
    $report = array();
    $sql = "SELECT COUNT(FK_TipoChiamata) AS num_inter, MONTH(Data) as mese  FROM t_rapportiVVF $anno GROUP BY MONTH(Data)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $month = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
    for ($i=0; $i < 12; $i++){
      $report[$i] = array($month[$i], 0);
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report[$ris["mese"]-1][1] = $ris["num_inter"];
      $i++;
    }
    return $report;
  }

  //$report['Intervento'] = getCallType($ris['Intervento'], $db_conn);
  //$report['N_intervento'] = $ris['n_inter'];
?>
