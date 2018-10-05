<?php
  function updateLocalita($Via, $FK_Comune, $db_conn){
    if (is_numeric(getLocalita(null, $Via, $FK_Comune, $db_conn))){
      return;
    }else{
      $sql = "UPDATE t_localita SET Via='$Via', FK_Comune='$FK_Comune' ";
      $updateLocalita = mysqli_query($db_conn, $sql);
      if ($updateLocalita==null){
        echo "
        <script>
        alert('Errore nell\'aggiornamento della localita : contatta l\'amministratore');
        //window.location.href = '../index.php';
        </script>";
      }
    }
  }
  function updateGeneralitaColpito($Nome, $Cognome, $DataDiNascita, $Residenza, $Telefono, $NCartaIdentita, $Altro, $db_conn){
    $sql = "UPDATE t_generalitacolpiti SET Nome='$Nome', Cognome='$Cognome', DataDiNascita='$DataDiNascita', Residenza='$Residenza', Telefono='$Telefono', NCartaIdentita='$NCartaIdentita', Altro='$Altro' ";
    try {
      $addColpito = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
      alert('Errore nell\'aggiornamento del colpito : contatta l\'amministratore');
      alert('$e');
      //window.location.href = '../index.php';
      </script>";
    }
  }
?>
