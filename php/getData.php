<?php
  function getReportData($ID, $db_conn){
    $report = array();
    $sql = "SELECT * FROM t_rapportiVVF WHERE (ID='$ID')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report['ID'] = $ris['ID'];
      $report['ID_Rapporto'] = $ris['ID_Rapporto'];
      $report['OraUscita'] = date('H:i', strtotime($ris['OraUscita']));
      $report['OraRientro'] = date('H:i', strtotime($ris['OraRientro']));
      $report['Password'] = $ris['Password'];
      $report['Data'] = date('d-m-Y', strtotime($ris['Data']));
      $report['Urgente'] = $ris['Urgente'];
      $report['OperazioniEseguite'] = $ris['OperazioniEseguite'];
      $report['Osservazioni'] = $ris['Osservazioni'];
      $report['FK_Localita'] = $ris['FK_Localita'];
      $report['FK_GeneralitaColpito'] = $ris['FK_GeneralitaColpito'];
      $report['FK_ProvChiamata'] = $ris['FK_ProvChiamata'];
      $report['FK_TipoChiamata'] = $ris['FK_TipoChiamata'];
      $report['FK_Responsabile'] = $ris['FK_Responsabile'];
      $report['FK_Compilatore'] = $ris['FK_Compilatore'];
      $report['Password'] = $ris['Password'];
    }
    return $report;
  }

  function getCallType($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_tipochiamata";
      $callType = array();
    }else{
      $sql = "SELECT * FROM t_tipochiamata WHERE (ID='$ID')";
      $callType = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $callType["$i"] = $ris['Tipologia'];
        $i++;
      }else{
        $callType = $ris['Tipologia'];
      }
    }
    return $callType;
  }

  function getFiremanData($ID, $db_conn){
    $sql = "SELECT * FROM t_vigili WHERE (ID='$ID')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $fireman = array();
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $fireman['ID'] = $ris['ID'];
      $fireman['Nome'] = $ris['Nome'];
      $fireman['Cognome'] = $ris['Cognome'];
      $fireman['Matricola'] = $ris['Matricola'];
    }
    return $fireman;
  }
  function getProvChiamata($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_provchiamata";
      $prov = array();
    }else{
      $sql = "SELECT * FROM t_provchiamata WHERE (ID='$ID')";
      $prov = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $prov["$i"] = $ris['Provenienza'];
        $i++;
      }else{
        $prov = $ris['Provenienza'];
      }
    }
    return $prov;
  }
  function getComuni($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_comuni";
      $prov = array();
    }else{
      $sql = "SELECT * FROM t_comuni WHERE (ID='$ID')";
      $prov = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $prov["$i"] = $ris['Comune'];
        $i++;
      }else{
        $prov = $ris['Comune'];
      }
    }
    return $prov;
  }
?>
