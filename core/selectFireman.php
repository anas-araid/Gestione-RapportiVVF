<h1 class="style-gradient-text">Accedi</h1>

<form action="#" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty is-upgraded" style="width:60%" data-upgraded=",MaterialTextfield">
    <select id="idUser" name="user" class="mdl-textfield__input" style="outline:none">
      <?php
        $vigili = getFiremanData(null, $db_conn);
        for ($i=0; $i < count($vigili); $i++){
          if ($vigili[$i][3] == 1){
            echo "<option value='".$vigili[$i][0]."'>".$vigili[$i][1]."</option>";
          }
        }
       ?>
    </select>
    <div>
      <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Entra</button>
      <br>
      <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="flatAlert('', 'Funzionalità ancora non disponibile', 'warning', '')">Accedi come ospite</button>
    </div>
  </div>
</form>
<?php
  include 'functions.php';
  include "dbConnection.php";

  if (!$error_message) {
    if (isset($_POST['user'])){
      $id = $_POST['user'];
      $vigile = getFiremanData($id, $db_conn);
      $_SESSION['ID'] = $vigile['ID'];
      $_SESSION['Nome'] = $vigile['Nome'];
      $_SESSION['Cognome'] = $vigile['Cognome'];
      if ($vigile['Password'] != null){
        $_SESSION['include'] = 'core/checkPassword.php';
      }else{
        echo "<script>location.href='checkIdentity.php'</script>";
      }
      echo "<script>location.href='index.php'</script>";
    }
  }

?>
