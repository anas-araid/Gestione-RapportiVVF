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
  function getReportYears($db_conn){
    $sql = "SELECT YEAR(Data) as anno FROM t_rapportiVVF GROUP BY anno DESC";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $years = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $years[$i] = $ris["anno"];
      $i++;
    }
    return $years;
  }
  function getHours($anno, $db_conn){
      if ($anno != ""){
        $anno = "WHERE YEAR(Data) = '$anno'";
      }
      $sql = "SELECT HOUR(OraUscita) as ora, count(FK_TipoChiamata) as n_inter FROM `t_rapportivvf` $anno GROUP BY ora";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die("error");
      }
      $hours = array();
      for ($i=0; $i < 24; $i++){
        $hours[$i] = 0;
      }
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $hours[$ris['ora']] = $ris['n_inter'];
      }
      return $hours;
  }
?>
