<h1 class="style-gradient-text">Accedi</h1>

<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="matricola" name="matricola" length="4" required="">
    <label class="mdl-textfield__label" for="matricola">Matricola</label>
    <span class="mdl-textfield__error">Inserisci un carattere numerico</span>
  </div>
  <br>
  <div>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Entra</button>
    <br>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="flatAlert('', 'Funzionalità ancora non disponibile', 'warning', '')">Accedi come ospite</button>
  </div>
</form>
<?php
  include 'functions.php';
  include "db_connection.php";

  if (!$error_message) {
    if (isset($_POST['matricola'])){
      $matricola = text_filter_lowercase($_POST['matricola']);
      $sql = "SELECT * FROM t_vigili WHERE Matricola='$matricola'";
      $risultato = mysqli_query($db_conn, $sql);
      if ($risultato == false){
        die('error');
      }
      $esistenzaMatricola = false;
      while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
        $esistenzaMatricola = true;
        $_SESSION['ID'] = $ris['ID'];
        $_SESSION['Nome'] = $ris['Nome'];
        $_SESSION['Cognome'] = $ris['Cognome'];
        $_SESSION['Password'] = $ris['Password'];
        $nome = $_SESSION['Nome'];
        if($_SESSION['Password'] != NULL){
          $_SESSION['include'] = 'php/checkPassword.php';
        }else{
          $_SESSION['include'] = 'php/createPassword.php';
        }
        echo "
        <script>
          flatAlert('Matricola esistente', '', 'success', '');
        </script>";
      }
      if(!$esistenzaMatricola){
        echo "
          <script>
              flatAlert('Matricola inesistente', '', 'error', '');
          </script>";
      }
      //mysqli_close($conn);
    }
  }else{
    echo "
    <script>
        flatAlert('Accesso', 'Impossibile connettersi al database', 'error', 'index.php');
    </script>";
  }
?>
