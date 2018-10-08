<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  include "functions.php";
  include "updateData.php";
  include "addData.php";

  if (isset($_POST['btnSave'])){
    $IdRapportoDB = $_SESSION['rapporto']['ID'];
    $idRapporto = $_POST['rapporto'];
    if (isset($_POST['urgente'])){
      $urgente = $_POST['urgente'];
      $urgente = 1;
    }else{
      $urgente = 0;
    }

    $FK_ProvChiamata = $_POST['provChiamata'];

    $FK_TipoChiamata = $_POST['intervento'];
    $data = $_POST['data'];
    $via = $_POST['via'];
    $comune = $_POST['comune'];
    $oraUscita = $_POST['oraUscita'];
    $oraRientro = $_POST['oraRientro'];

    //generalita colpito
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $residenza = $_POST['residenza'];
    $dataDiNascita = $_POST['dataDiNascita'];
    if ($dataDiNascita == ''){
      $dataDiNascita = date_create('1900-01-01')->format('Y-m-d');
    }
    $telefono = $_POST['telefono'];
    $cartaIdentita = $_POST['cartaIdentita'];
    $altro = $_POST['altro'];

    $operazioniEseguite = text_filter(removeAccents(removeQuotes($_POST['operazioni'])));
    $osservazioni = text_filter(removeAccents(removeQuotes($_POST['osservazioni'])));

    // arrayMezzi contiene gli id dei mezzi selezionati
    $arrayMezzi = array();
    $mezzi = getMezzi(null, $db_conn);
    $nMezzi = count($mezzi);
    $j=0;
    for ($i=0; $i < $nMezzi; $i++){
      if (isset($_POST['mezzo_'.$i])){
        $arrayMezzi[$j] = $_POST['mezzo_'.$i];
        $j++;
      }
    }

    // arraySoccorsi contiene gli id dei mezzi selezionati
    $arraySoccorsi = array();
    $soccorsi = getSoccorsi(null, $db_conn);
    $nSoccorsi = count($soccorsi);
    $j=0;
    for ($i=0; $i < $nSoccorsi; $i++){
      if (isset($_POST['soccorsi_'.$i])){
        $arraySoccorsi[$j] = $_POST['soccorsi_'.$i];
        $j++;
      }
    }
    //print_r($arraySoccorsi);

    // arrayVigili contiene gli id dei mezzi selezionati
    $arrayVigili = array();
    $vigili = getFiremanData(null, $db_conn);
    $nVigili = count($vigili);
    $j=0;
    for ($i=0; $i < $nVigili; $i++){
      if (isset($_POST['vigile_'.$i])){
        $arrayVigili[$j] = $_POST['vigile_'.$i];
        $j++;
      }
    }
    //print_r($arrayVigili);

    $FK_Responsabile = $_POST['ros'];
    $FK_Compilatore = $_POST['compilatore'];


    updateLocalita($via, $comune, $db_conn);
    $FK_Localita = getLocalita(null, $via, $comune, $db_conn);

    updateGeneralitaColpito($nome, $cognome, $dataDiNascita, $residenza, $telefono, $cartaIdentita, $altro, $db_conn);
    $FK_GeneralitaColpito = getColpito(null, $nome, $cognome, $dataDiNascita, $cartaIdentita, $db_conn);
    if ($FK_GeneralitaColpito == null || $FK_GeneralitaColpito == "" || !isset($FK_GeneralitaColpito)){
      $FK_GeneralitaColpito = $_SESSION['rapporto']['FK_GeneralitaColpito'];
    }
    sleep(2);

    // Section that send data to addData.php
    $updateReport = "UPDATE t_rapportiVVF SET ID_Rapporto='$idRapporto', OraUscita='$oraUscita', OraRientro='$oraRientro', Data='$data', Urgente='$urgente', OperazioniEseguite='$operazioniEseguite', Osservazioni='$osservazioni', FK_Localita='$FK_Localita', FK_GeneralitaColpito='$FK_GeneralitaColpito', FK_ProvChiamata='$FK_ProvChiamata', FK_TipoChiamata='$FK_TipoChiamata', FK_Responsabile='$FK_Responsabile', FK_Compilatore='$FK_Compilatore'
                     WHERE (ID = '$IdRapportoDB') ";
    try {
      $saveReport = mysqli_query($db_conn, $updateReport);
      if ($saveReport == null){
        throw new Exception("Errore salvataggio rapporto", 1);
      }
      // aggiorno mezzi
      deleteFromMezziIntervenuti($IdRapportoDB, $db_conn);
      for($i=0; $i < count($arrayMezzi); $i++){
        addMezziToRapporto($IdRapportoDB, $arrayMezzi[$i], $db_conn);
      }
      // aggiorno soccorsi
      deleteSoccorsiIntervenuti($IdRapportoDB, $db_conn);
      for($i=0; $i < count($arraySoccorsi); $i++){
        addSoccorsiToRapporto($IdRapportoDB, $arraySoccorsi[$i], $db_conn);
      }
      // aggiorno vigili
      deleteVigiliIntervenuti($IdRapportoDB, $db_conn);
      for($i=0; $i < count($arrayVigili); $i++){
        addVigileToRapporto($IdRapportoDB, $arrayVigili[$i], $db_conn);
      }
    } catch (Exception $e) {
      echo "
        <script>
        alert('Errore relativo all\'aggiornamento del rapporto: contatta l\'amministratore');
        alert('$e');
        //window.location.href = '../index.php';
        </script>";
    }
    echo "<script>window.location.href = '../index.php';</script>";
    }else{
    echo "<script>alert('Errore sconosciuto')</script>";
    }

    ?>
