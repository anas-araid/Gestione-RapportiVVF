<html>
  <head>
    <?php
      include "core/_header.php";
      include "core/getData.php";
      session_start();
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova isLogged
        error_reporting(0);
        include "core/dbConnection.php";
        if (isset($_GET['back'])) {
          $_SESSION['include'] = 'core/reports.php';
          $_SESSION['search'] = null;
        }
        if (!$_SESSION['include']){
          $_SESSION = array();
          $_SESSION['include'] = 'core/selectFireman.php';
        }
        if ($_SESSION['reportCSV']){
          $_SESSION['reportCSV'] = false;
          echo "
          <script>
            location.href='Rapporti.csv';
            setTimeout(function(){
              location.reload();
            }, 100);
          </script>";
        }
      }catch(Exception $e){
      }
     ?>
  </head>
  <body>
    <div id="loading-div">
      <div  class="style-parent" style="height:100%;background-color:white;z-index:10000">
        <div class="style-child">
          <img src="loading.gif"></img>
        </div>
      </div>
    </div>
    <div class="mdl-layout mdl-js-layout">
      <main class="mdl-layout__content" id="main">
        <div class="page-content">
          <div class="mdl-grid">
            <section class="mdl-cell mdl-cell--middle mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet">
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
                      <span class="style-gradient-text">vvf Pergine</span>
                  </mark>
                  <br>
                  <br>
                  <mark style="background-color:white;border:none;border-radius:10px;padding:5px;">
                      <span class="style-gradient-text">Valsugana</span>
                  </mark>
                </h3>
              </div>
            </section>
            <section class="mdl-cell mdl-cell--middle mdl-cell--9-col">
              <div class="mdl-card mdl-shadow--8dp style-card" style="width:100%">
                <?php
                if ($error_message) {
                  echo "
                    <script>
                      window.onload = function(){
                        flatAlertClose('Accesso', 'Impossibile connettersi al database', 'error');
                      }
                    </script>";
                  }
                  include $_SESSION['include'];
                 ?>
              </div>
            </section>
          </div>
          <?php include "core/_footer.php" ?>
        </div>

      </main>
    </div>
  </body>
  <script>
  // nasconde il contenuto della pagina per 2 secondi per mostrare il loading
    document.getElementById("main").style.display = "none";
    setTimeout(function(){
      document.getElementById("loading-div").remove();
      document.getElementById("main").style.display = "block";
    }, 1500);
    // nasconde il contenuto della pagina per 2 secondi per mostrare il loading
    /*
    var loading  = document.getElementById("loading-div");
    loading.style.display = "none";
    loading.setAttribute('style', 'display:none !important')
    function loadingFX(){
      window.onload= function(){
        loading.style.display = "block";
        loading.setAttribute('style', 'display:block !important')

        document.getElementById("main").style.display = "none";
        setTimeout(function(){
          loading.remove();
          document.getElementById("main").style.display = "block";
        }, 1000);
      };
    }
    loadingFX();
    */
  </script>

</html>
