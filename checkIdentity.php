<html>
<?php
  session_start();
  include "core/_header.php";
?>
<body>
  <script>
  var identity = new tingle.modal({
            closeMethods: ['button'],
            closeLabel: "Chiudi",
            onOpen: function() {
                console.log('modal open');
            },
            onClose: function() {
                console.log('modal closed');
            },
            beforeClose: function() {
                return true; // close the modal
                return false; // nothing happens
            }
        });
    identity.setContent(
      '<h2 class="style-gradient-text">Password di sicurezza<h2>'+
      '<form action="" method="POST" style="text-align:center">'+
      '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
      '<input class="mdl-textfield__input" type="password" id="conferma" name="conferma" required=""></input>'+
      '</div>'+
      '<br>'+
      '<button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">Continua</button>'+
      '<br>'+
      '<button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="location.href=' + "'core/logout.php'" + '">Indietro</button>'+
      '</form>'
    );
    identity.open();
   </script>

   <?php
     include 'core/functions.php';
     include "core/dbConnection.php";

     if (!$error_message) {
       if (isset($_POST['conferma'])){
         $conferma = $_POST['conferma'];
         if (text_filter_encrypt($conferma) == "b65959845f63d31058e1319f724bcaff"){
           $_SESSION['include'] = 'core/createPassword.php';
           echo "
           <script>
           flatAlert('Password corretta', '', 'success', 'index.php');
           </script>";
         }else{
           echo "
           <script>
           flatAlert('Password non corretta', '', 'error', '#');
           </script>";
         }
       }
     }
   ?>
 </body>
 </html>
