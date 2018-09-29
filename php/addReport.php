<?php
  session_start();
  include "dbConnection.php";
  include "getData.php";
  include "addData.php";
  include "functions.php";
  if (isset($_POST['btnSave'])){
    $idRapporto = $_POST['rapporto'];
    if (isset($_POST['urgente'])){
      $urgente = $_POST['urgente'];
      $urgente = ($urgente == 'on');
    }else{
      $urgente = false;
    }

    $segnalataDa = $_POST['prov'];

    $intervento = $_POST['intervento'];
    $data = $_POST['data'];
    $via = $_POST['via'];
    $comune = $_POST['comune'];
    $oraUscita = $_POST['oraUscita'];
    $oraRientro = $_POST['oraRientro'];


    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $residenza = $_POST['residenza'];
    $dataDiNascita = $_POST['dataDiNascita'];
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
    //print_r($arrayMezzi);

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

    // arrayMezzi contiene gli id dei mezzi selezionati
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

    $IdRos = $_POST['ros'];
    $IdCompilatore = $_POST['compilatore'];


    addLocalita($via, $comune, $db_conn);
    $FK_Localita = getLocalita($via, $comune, $db_conn);
    


    /*
    $insertReport = "INSERT INTO t_rapportiVVF (ID_Rapporto, OraUscita, OraRientro, Data, Urgente, OperazioniEseguite, Osservazioni, FK_Localita, FK_GeneralitaColpito, FK_ProvChiamata, FK_TipoChiamata, FK_Responsabile, FK_Compilatore)
                     VALUES ('$date', '$message', '$userID')";
     $saveReport = mysqli_query($db_conn, $insertQuery);
     if ($saveReport!=null){
       header("location:../index.php");
     }else{
       echo "
         <script>
         alert('Errore relativo all\'invio dei messaggi: contatta l\'amministratore');
         window.location.href = '../index.php';
         </script>";
     }*/
  }else{
    echo "<script>alert('lol')</script>";
  }

 ?>
