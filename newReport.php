<html>
  <head>
    <?php
      include "php/_header.php";
      session_start();
      //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
      // error_reporting per togliere il notice quando non trova isLogged
      //error_reporting(0);
      include "php/dbConnection.php";
      include "php/getData.php";

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
                <form action="" method="post" style="text-align:center;max-height:650px;overflow:auto">
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
                         <input class="mdl-textfield__input" type="text" id="IdRapporto" name="rapporto" required="">
                         <label class="mdl-textfield__label" for="IdRapporto">Inserisci id del rapporto</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idUrgente" name="urgente">
                        <input type="checkbox" id="idUrgente" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Urgente</span>
                      </label>
                    </div>
                  </div>
                  <h6 class="style-gradient-text">Segnalazione pervenuta da:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $prov = getProvChiamata(null, $db_conn);
                      //print_r($prov);
                      $rows = count($prov) / 2;
                      if(!is_int($rows)){
                        $rows = (int)$rows + 1;
                        echo $rows;
                      }
                      $index = 0;
                      for ($i=0; $i < $rows;$i++){
                        for($j=0;$j < 2; $j++){
                          if ($index < count($prov)){
                            echo '
                            <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="prov_'.$index.'">
                                <input type="radio" id="prov_'.$index.'" class="mdl-radio__button" name="prov_'.$index.'" value="1">
                                <span class="mdl-radio__label">'.$prov[$index].'</span>
                              </label>
                            </div> ';
                            $index++;
                          }
                        }
                        echo "<br>";
                      }
                     ?>
                  </div>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idChiamata" name="chiamata" required="">
                         <label class="mdl-textfield__label" for="idChiamata">Evento segnalato dalla chiamata</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
                         <input class="mdl-textfield__input" type="date" id="IdData" name="data" required="">
                      </div>
                    </div>
                    <br>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idVia" name="via" required="">
                         <label class="mdl-textfield__label" for="idVia">Via</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idComune" name="comune" required="">
                         <label class="mdl-textfield__label" for="idComune">Comune</label>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>
          <?php include "php/_footer.php" ?>
        </div>
      </main>
    </div>
  </body>

</html>
