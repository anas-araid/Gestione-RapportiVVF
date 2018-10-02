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
        $callType["$i"] = array($ris['ID'], $ris['Tipologia']);
        $i++;
      }else{
        $callType = $ris['Tipologia'];
      }
    }
    return $callType;
  }

  function getFiremanData($ID, $db_conn){
    $fireman = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_vigili";
    }else{
      $sql = "SELECT * FROM t_vigili WHERE (ID='$ID')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $fireman["$i"] = array($ris['ID'], $ris['Nome']." ".$ris['Cognome']);
        $i++;
      }else{
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
      }
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
        $prov["$i"] = array($ris['ID'], $ris['Provenienza']);
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
        $prov["$i"] = array($ris['ID'], $ris['Comune']);
        $i++;
      }else{
        $prov = $ris['Comune'];
      }
    }
    return $prov;
  }
  function getMezzi($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_mezzi";
      $mezzi = array();
    }else{
      $sql = "SELECT * FROM t_mezzi WHERE (ID='$ID')";
      $mezzi = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getMezzi");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $mezzi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $mezzi = $ris['Descrizione'];
      }
    }
    return $mezzi;
  }
  function getSoccorsi($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_soccorsiesterni";
      $soccorsi = array();
    }else{
      $sql = "SELECT * FROM t_soccorsiesterni WHERE (ID='$ID')";
      $soccorsi = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $soccorsi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $soccorsi = $ris['Descrizione'];
      }
    }
    return $soccorsi;
  }
  function getLocalita($id, $via, $comune, $db_conn){
    if ($id == null){
      $sql = "SELECT * FROM t_localita WHERE (Via='$via') and (FK_Comune='$comune')";
    }else{
      $sql = "SELECT * FROM t_localita WHERE (ID = '$id')";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($id == null){
        $idLocalita = null;
        $idLocalita = $ris['ID'];
        return $idLocalita;
      }else{
        $localita = array();
        $localita['via']= $ris['Via'];
        $localita['comune']=$ris['FK_Comune'];
        return $localita;
      }
    }
  }
  function getColpito($id, $nome, $cognome, $dataDiNascita, $cartaIdentita, $db_conn){
    if ($id == null){
      $sql = "SELECT * FROM t_generalitacolpiti WHERE (Nome='$nome') and (Cognome='$cognome') and (dataDiNascita='$dataDiNascita') and (NCartaIdentita='$cartaIdentita')";
    }else{
      $sql ="SELECT * FROM t_generalitacolpiti WHERE (ID=$id)";
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($id == null){
        $id = $ris['ID'];
        return $id;
      }else{
        $colpito = array();
        $colpito['Nome']= $ris['Nome'];
        $colpito['Cognome']=$ris['Cognome'];
        $colpito['DataDiNascita']=$ris['DataDiNascita'];
        $colpito['Residenza']=$ris['Residenza'];
        $colpito['Telefono']=$ris['Telefono'];
        $colpito['CartaIdentita']=$ris['NCartaIdentita'];
        $colpito['Altro']=$ris['Altro'];
        return $colpito;
      }
    }
  }
  function getRapporto($ID_Rapporto, $db_conn){
    $sql = "SELECT * FROM t_rapportiVVF WHERE (ID_Rapporto=$ID_Rapporto)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $id=null;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $id = $ris['ID'];
    }
    return $id;
  }
  function getMezziByReport($ID_Rapporto, $db_conn){
    $sql = "SELECT * FROM t_mezziintervenuti WHERE (FK_RapportoVVF=$ID_Rapporto)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("errore getData.php: getMezziByReport");
    }
    $idMezzi = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $idMezzi[$i] = $ris['FK_Mezzo'];
      $i++;
    }
    return $idMezzi;
  }
  function getSoccorsiByReport($ID_Rapporto, $db_conn){
    $sql = "SELECT * FROM t_soccorsiintervenuti WHERE (FK_RapportoVVF=$ID_Rapporto)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("errore getData.php: getSoccorsiByReport");
    }
    $idSoccorsi = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $idSoccorsi[$i] = $ris['FK_SoccorsiEsterni'];
      $i++;
    }
    return $idSoccorsi;
  }
  function getVigiliByReport($ID_Rapporto, $db_conn){
    $sql = "SELECT * FROM t_vigiliintervenuti WHERE (FK_RapportoVVF=$ID_Rapporto)";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("errore getData.php: getVigiliByReport");
    }
    $idVigili = array();
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $idVigili[$i] = $ris['FK_Vigile'];
      $i++;
    }
    return $idVigili;
  }
?>
