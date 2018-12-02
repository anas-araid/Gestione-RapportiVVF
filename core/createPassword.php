
<h1 class="style-gradient-text">Ciao <?php echo $_SESSION['Nome']?></h1>
<h4 class="style-gradient-text">Aggiungi una nuova password</h4>
<h6 class="style-gradient-text">Se non sei <?php echo $_SESSION['Nome']?> <?php echo $_SESSION['Cognome'] ?>, clicca <a href="core/logout.php">qua</a></h6>

<form action="" method="POST" style="text-align:center">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
  <br>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="confermaPassword" name="confermaPassword" required="">
    <label class="mdl-textfield__label" for="confermaPassword">Conferma password</label>
  </div>
  <div>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Crea profilo</button>
    <br>
    <button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="location.href='core/logout.php'">Indietro</button>
  </div>
</form>

<script>
   var password          = document.getElementById("password");
   var conferma_password = document.getElementById("confermaPassword");
   //var registrati        = document.getElementById("signup");
   function validaPassword() {
       if (password.value != conferma_password.value){
         conferma_password.setCustomValidity("Le password non corrispondono o la lunghezza è insufficiente");
       }else{
         conferma_password.setCustomValidity("");
       }
   }
   password.onchange         = validaPassword;
   conferma_password.onkeyup = validaPassword;
  </script>


  <?php
    if(isset($_POST['password'])){
      include 'core/functions.php';
      $password = text_filter_encrypt($_POST["password"]);
      $id=$_SESSION['ID'];
      $updateQuery = "UPDATE t_vigili SET Password='$password' WHERE ID='$id'";
      $update = mysqli_query($db_conn, $updateQuery);
      if ($update==null){
          //throw new exception ("Impossibile aggiornare l'utente");
      }
      $_SESSION['include'] = 'core/reports.php';
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'core/log.php');
      </script>";
    }

   ?>
