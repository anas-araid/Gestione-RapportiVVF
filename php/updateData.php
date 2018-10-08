<?php
  function updateLocalita($Via, $FK_Comune, $db_conn){
    $id = getLocalita(null, $Via, $FK_Comune, $db_conn);
    if (!is_numeric($id)){
      return;
    }else{
      $sql = "UPDATE t_localita SET Via='$Via', FK_Comune='$FK_Comune' WHERE (ID='$id')";
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
    $id = getColpito(null, $Nome, $Cognome, $DataDiNascita, $NCartaIdentita, $db_conn);
    if (!is_numeric($id)){
      return;
    }
    $sql = "UPDATE t_generalitacolpiti SET Nome='$Nome', Cognome='$Cognome', DataDiNascita='$DataDiNascita', Residenza='$Residenza', Telefono='$Telefono', NCartaIdentita='$NCartaIdentita', Altro='$Altro'
            WHERE (ID='$id')";
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
  function deleteFromMezziIntervenuti($ID_Rapporto, $db_conn){
    try{
      $sql = "DELETE FROM t_mezziintervenuti WHERE FK_RapportoVVF='$ID_Rapporto'";
      $deleteQuery = mysqli_query($db_conn, $sql);
      if ($deleteQuery == null){
        die("error");
      }
    }catch(Exception $e){
      echo "
      <script>
      alert('Errore nell\'aggiornamento dei mezzi intervenuti 2: contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }
  function deleteSoccorsiIntervenuti($ID_Rapporto, $db_conn){
    try{
      $sql = "DELETE FROM t_soccorsiintervenuti WHERE FK_RapportoVVF='$ID_Rapporto'";
      $deleteQuery = mysqli_query($db_conn, $sql);
      if ($deleteQuery == null){
        die("error");
      }
    }catch(Exception $e){
      echo "
      <script>
      alert('Errore nell\'aggiornamento dei soccorsi intervenuti 2: contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }
  function deleteVigiliIntervenuti($ID_Rapporto, $db_conn){
    try{
      $sql = "DELETE FROM t_vigiliIntervenuti WHERE FK_RapportoVVF='$ID_Rapporto'";
      $deleteQuery = mysqli_query($db_conn, $sql);
      if ($deleteQuery == null){
        die("error");
      }
    }catch(Exception $e){
      echo "
      <script>
      alert('Errore nell\'aggiornamento dei vigili intervenuti 2: contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }
?>
