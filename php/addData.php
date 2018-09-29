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



 ?>
