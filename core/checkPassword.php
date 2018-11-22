<h1 class="style-gradient-text">Ciao <?php echo $_SESSION['Nome']?></h1>
<h6 class="style-gradient-text">Se non sei <?php echo $_SESSION['Nome']?> <?php echo $_SESSION['Cognome'] ?>, clicca <a href="core/logout.php">qua</a></h6>

<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
    <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
  <br>
  <div>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Entra</button>
    <br>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>

<?php
  if(isset($_POST['password'])){
    include 'core/functions.php';
    $password = text_filter_encrypt($_POST["password"]);
    $id=$_SESSION['ID'];
    $selectQuery = "SELECT * FROM t_vigili WHERE ID='$id' AND Password='$password'";
    $select = mysqli_query($db_conn, $selectQuery);
    if ($select==null){
      die('error');
        //throw new exception ("Impossibile aggiornare l'utente");
    }
    $esistenzaUtente = false;
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      $esistenzaUtente = true;
      $_SESSION['include'] = 'core/reports.php';
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'index.php');
      </script>";
    }
    if (!$esistenzaUtente){
      echo "
      <script>
      flatAlert('Password errata', '', 'error', 'index.php');
      </script>";
    }

  }

 ?>
