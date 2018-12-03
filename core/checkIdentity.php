<?php
  session_start();

?>
  <script>
  var identity = new tingle.modal({
            closeMethods: ['overlay', 'button', 'escape'],
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
    allInterventi.setContent(
      '<h2 class="style-gradient-text">Password di sicurezza<h2>'+
      '<form action="" method="POST" style="text-align:center">'+
      '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
      '<input class="mdl-textfield__input" type="password" id="conferma" name="conferma" required="">'+
      '<label class="mdl-textfield__label" for="password">Password</label>'+
      '</div>'+
      '</form>'
    );

   </script>

<?php

?>
