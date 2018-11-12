<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  include "functions.php";
  $reportQuery = "SELECT * FROM t_rapportiVVF ORDER BY Data DESC";
  $getAllReports = mysqli_query($db_conn, $reportQuery);
  if ($getAllReports != false){
    $reports = array();
    $i=0;
    while($ris=mysqli_fetch_array($getAllReports)){
      $report[$i] = getReportFullData($ris['ID'], $db_conn);
      $i++;
    }
    $date = date('Y-m-d-H:i');
    $filename = "Rapporti.csv";
    $filedir = "../$filename";
    if (!file_exists($filedir)){
      $csv = fopen($filedir, "w");
    }else{
      unlink($filedir);
      $csv = fopen($filedir, "w");
    }
    fwrite($csv, "sep=,");
    fwrite($csv, "\n");
    fwrite($csv, "ID,");
    fwrite($csv, "ID_Rapporto,");
    fwrite($csv, "Provenienza,");
    fwrite($csv, "Tipologia,");
    fwrite($csv, "Ora uscita,");
    fwrite($csv, "Ora rientro,");
    fwrite($csv, "Data,");
    fwrite($csv, "Urgente,");
    fwrite($csv, "Via,");
    fwrite($csv, "Comune,");
    fwrite($csv, "Nome,");
    fwrite($csv, "Cognome,");
    fwrite($csv, "Data di nascita,");
    fwrite($csv, "Residenza,");
    fwrite($csv, "Telefono,");
    fwrite($csv, "Carta identita,");
    fwrite($csv, "Altro,");
    fwrite($csv, "Operazioni eseguite,");
    fwrite($csv, "Osservazioni,");
    fwrite($csv, "Responsabile,");
    fwrite($csv, "Compilatore");
    for ($i=0; $i<count($report); $i++){
      $currentReport = $report[$i];
      fwrite($csv, "\n");
      fwrite($csv, $currentReport['ID'].",");
      fwrite($csv, $currentReport['ID_Rapporto'].",");
      fwrite($csv, $currentReport['FK_ProvChiamata'].",");
      fwrite($csv, $currentReport['FK_TipoChiamata'].",");
      fwrite($csv, $currentReport['OraUscita'].",");
      fwrite($csv, $currentReport['OraRientro'].",");
      fwrite($csv, $currentReport['Data'].",");
      fwrite($csv, $currentReport['Urgente'] ? "Non urgente," : "urgente,");
      fwrite($csv, $currentReport['FK_Localita']['via'].",");
      fwrite($csv, $currentReport['Comune'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['Nome'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['Cognome'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['DataDiNascita'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['Residenza'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['Telefono'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['CartaIdentita'].",");
      fwrite($csv, $currentReport['FK_GeneralitaColpito']['Altro'].",");
      fwrite($csv, $currentReport['OperazioniEseguite'].",");
      fwrite($csv, $currentReport['Osservazioni'].",");
      fwrite($csv, $currentReport['FK_Responsabile']['Nome']." ".$currentReport['FK_Responsabile']['Cognome'].",");
      fwrite($csv, $currentReport['FK_Compilatore']['Nome']." ".$currentReport['FK_Compilatore']['Cognome'].",");
    }
    fclose($csv);
    $_SESSION['include'] = 'core/reports.php';
    $_SESSION['reportCSV'] = true;
    header("location:../index.php?back=true");
  }


 ?>
