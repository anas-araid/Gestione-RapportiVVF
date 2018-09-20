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
      $report['OraUscita'] = date('H:i', strtotime($ris['OraUscita']);
      $report['OraRientro'] = date('H:i', strtotime($ris['OraRientro']);
      $report['Password'] = $ris['Password'];
      $report['Data'] = date('d-m-Y', strtotime($ris['Data']);
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
      $report['UltimoAccesso'] = date('d-m-Y', strtotime($ris['UltimoAccesso']));
    }
    return $report;
  }
?>
