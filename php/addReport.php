<?php
  session_start();
  include "dbConnection.php";
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
