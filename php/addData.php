<?php
  function addLocalita($Via, $FK_Comune, $db_conn){
    $sql = "INSERT INTO t_localita (Via, FK_Comune) VALUES ('$Via', '$FK_Comune')";
    $addLocalita = mysqli_query($db_conn, $sql);
    if ($addLocalita==null){
      echo "
        <script>
        alert('Errore nell\'aggiunta della localita : contatta l\'amministratore');
        window.location.href = '../index.php';
        </script>";
    }
  }
  function addGeneralitaColpito($Nome, $Cognome, $DataDiNascita, $Residenza, $Telefono, $NCartaIdentita, $Altro, $db_conn){
    $sql = "INSERT INTO t_generalitacolpiti (Nome, Cognome, DataDiNascita, Residenza, Telefono, NCartaIdentita, Altro)
            VALUES ('$Nome', '$Cognome', '$DataDiNascita', '$Residenza', '$Telefono', '$NCartaIdentita', '$Altro')";
    $addColpito = mysqli_query($db_conn, $sql);
    if ($addColpito==null){
      echo "
        <script>
        alert('Errore nell\'aggiunta del colpito : contatta l\'amministratore');
        //window.location.href = '../index.php';
        </script>";
    }
  }


 ?>
