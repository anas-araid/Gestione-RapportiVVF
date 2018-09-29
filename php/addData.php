<?php
  function addLocalita($Via, $FK_Comune, $db_conn){
    $sql = "INSERT INTO t_localita (Via, FK_Comune) VALUES ('$Via', '$FK_Comune')";
    $addLocalita = mysqli_query($db_conn, $sql);
    if ($addLocalita==null){
      echo "
        <script>
        alert('Errore nell\'aggiunta della localita : contatta l\'amministratore');
        //window.location.href = '../index.php';
        </script>";
    }
  }
  function addGeneralitaColpito($Nome, $Cognome, $DataDiNascita, $Residenza, $Telefono, $NCartaIdentita, $Altro, $db_conn){
    $sql = "INSERT INTO t_generalitacolpiti (Nome, Cognome, DataDiNascita, Residenza, Telefono, NCartaIdentita, Altro)
            VALUES ('$Nome', '$Cognome', '$DataDiNascita', '$Residenza', '$Telefono', '$NCartaIdentita', '$Altro')";
    try {
      $addColpito = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
      alert('Errore nell\'aggiunta del colpito : contatta l\'amministratore');
      alert('$e');
      //window.location.href = '../index.php';
      </script>";
    }
  }
  function addMezziToRapporto($ID_Rapporto, $FK_Mezzo, $db_conn){
    $sql = "INSERT INTO t_mezziintervenuti (FK_RapportoVVF, FK_Mezzo)
            VALUES ('$ID_Rapporto', '$FK_Mezzo')";
    try {
      $addMezzi = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
      alert('Errore nell\'aggiunta del mezzo : contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }
  function addSoccorsiToRapporto($ID_Rapporto, $FK_Soccorsi, $db_conn){
    $sql = "INSERT INTO t_soccorsiintervenuti (FK_RapportoVVF, FK_SoccorsiEsterni)
            VALUES ('$ID_Rapporto', '$FK_Soccorsi')";
    try {
      $addMezzi = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
      alert('Errore nell\'aggiunta del soccorso : contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }
  function addVigileToRapporto($ID_Rapporto, $FK_Vigile, $db_conn){
    $sql = "INSERT INTO t_vigiliIntervenuti (FK_RapportoVVF, FK_Vigile)
            VALUES ('$ID_Rapporto', '$FK_Vigile')";
    echo $sql;
    try {
      $addVigile = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      echo "
      <script>
      alert('Errore nell\'aggiunta del vigile al rapporto: contatta l\'amministratore');
      //window.location.href = '../index.php';
      </script>";
      echo $e;
    }
  }

 ?>
