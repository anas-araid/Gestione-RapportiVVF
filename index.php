<html>
  <head>
    <?php
      include "php/_header.php";
      session_start();
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova isLogged
        //error_reporting(0);
        if (!$_SESSION['include']){
          $_SESSION = array();
          $_SESSION['include'] = 'php/checkPassword.php';
        }
      }catch(Exception $e){
      }
      include "php/dbConnection.php";
      if ($error_message) {
        echo "
        <script>
            flatAlert('Accesso', 'Impossibile connettersi al database', 'error', 'index.php');
        </script>";
      }
     ?>
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout">
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="mdl-grid">
            <section class="mdl-cell mdl-cell--middle mdl-cell--4-col mdl-cell--hide-phone mdl-cell--hide-tablet">
              <div style="padding:5px">
                <h1>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">Rapporti</span>
                  </mark>
                </h1>
                <h1>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">d'intervento</span>
                  </mark>
                </h1>
                <h3 class="style-gradient-text">
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">vvf Pergine Valsugana</span>
                  </mark>
                </h3>
              </div>
            </section>
            <section class="mdl-cell mdl-cell--middle mdl-cell--8-col">
              <div class="mdl-card mdl-shadow--8dp style-card" style="width:100%">
                <?php include $_SESSION['include'] ?>
              </div>
            </section>
          </div>
          <?php include "php/_footer.php" ?>
        </div>
      </main>
    </div>
  </body>

</html>
