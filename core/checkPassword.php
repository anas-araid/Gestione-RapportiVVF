<h1 class="style-gradient-text">Accedi</h1>

<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
    <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
  <br>
  <div>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Entra</button>
  </div>
</form>

<?php
if (!$error_message) {
  $_SESSION['warning'] = true;
  if(isset($_POST['password'])){
      include 'core/functions.php';
      $password = text_filter_encrypt($_POST["password"]);
      // caserma
      if ($password == 'b65959845f63d31058e1319f724bcaff'){
        $_SESSION['include'] = 'core/reports.php';
        echo "
        <script>
        flatAlert('Accesso eseguito con successo', '', 'success', 'index.php');
        </script>";
      }else{
        echo "
        <script>
        flatAlert('Password errata', '', 'error', 'index.php');
        </script>";
      }
  }
}

?>
