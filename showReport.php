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
      include "php/functions.php";

      if ($error_message) {
        echo "
        <script>
            flatAlert('Accesso', 'Impossibile connettersi al database', 'error', 'index.php');
        </script>";
      }
      if (isset($_GET['id'])){
        $rapporto = getReportData($_GET['id'], $db_conn);
        print_r($rapporto);
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
                <form action="php/addReport.php" method="post" style="text-align:center;max-height:650px;overflow:auto">
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col" style="text-align:left;padding:0px;margin:0px">
                      <h6 class="style-gradient-text">ID Rapporto: <span class="mdl-color-text--black"><?php echo $rapporto['ID_Rapporto'] ?></span></h6>
                      <h6 class="style-gradient-text">Segnalazione pervenuta da:
                        <span class="mdl-color-text--black">
                          <?php
                            $provAllerta = getProvChiamata($rapporto['FK_ProvChiamata'], $db_conn);
                            if ($provAllerta != null){
                              echo $provAllerta;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                       </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col" style="text-align:left;padding:0px;margin:0px">
                      <?php
                        $urg = ($rapporto['Urgente'] == 0) ? "Intervento non urgente" :"Intervento urgente";
                        echo "<h6 class='mdl-color-text--black'>$urg</h6>";
                      ?>
                    </div>
                  </div>

                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col" style="text-align:left">
                      <h6 class="style-gradient-text">Evento:
                        <span class="mdl-color-text--black">
                          <?php
                            $chiamata = getCallType($rapporto['FK_TipoChiamata'], $db_conn);
                            if ($chiamata != null){
                              echo $chiamata;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">In via:
                        <span class="mdl-color-text--black">
                          <?php
                            $localita = getLocalita($rapporto['FK_Localita'], null, null, $db_conn);
                            if ($localita['via'] != null){
                              echo $localita['via'];
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Ora partenza:
                        <span class="mdl-color-text--black">
                          <?php
                            $orarioUscita = $rapporto['OraUscita'];
                            if ($orarioUscita != null){
                              echo $orarioUscita;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col" style="text-align:left">
                      <h6 class="style-gradient-text">il:
                        <span class="mdl-color-text--black">
                          <?php
                            $data = $rapporto['Data'];
                            if ($data != null){
                              echo $data;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Comune:
                        <span class="mdl-color-text--black">
                          <?php
                            $comune = getComuni($localita['comune'], $db_conn);
                            if ($comune != null){
                              echo $comune;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Ora di rientro:
                        <span class="mdl-color-text--black">
                          <?php
                            $orarioRientro = $rapporto['OraRientro'];
                            if ($orarioRientro != null){
                              echo $orarioRientro;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                  </div>

                  <h6 class="style-gradient-text">Generalità del colpito:</h6>
                  <?php
                    $colpito = getColpito($rapporto['FK_GeneralitaColpito'], null, null, null, null, $db_conn);
                    //print_r($colpito);
                   ?>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Nome:
                        <span class="mdl-color-text--black">
                          <?php
                            $nome = $colpito['Nome'];
                            if ($nome != null){
                              echo $nome;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Residenza:
                        <span class="mdl-color-text--black">
                          <?php
                            $residenza = $colpito['Residenza'];
                            if ($residenza != null){
                              echo $residenza;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Telefono:
                        <span class="mdl-color-text--black">
                          <?php
                            $telefono = $colpito['Telefono'];
                            if ($telefono != 0 && $telefono != null){
                              echo $telefono;
                            }else{
                              echo "Dato non disponibile";
                            }
                           ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <h6 class="style-gradient-text">Cognome:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $cognome = $colpito['Cognome'];
                              if ($cognome != null){
                                echo $cognome;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Data di nascita:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $dataDiNascita = $colpito['DataDiNascita'];
                              if ($dataDiNascita != null){
                                echo date_create($dataDiNascita)->format('d-m-Y');;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Carta d'identita:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                            $cartaIdentita = $colpito['CartaIdentita'];
                              if ($cartaIdentita != null){
                                echo $cartaIdentita;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col" style="text-align:left">
                      <h6 class="style-gradient-text">Altro:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $altro = $colpito['Altro'];
                              if ($altro != null){
                                echo $altro;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                  </div>


                  <h6 class="style-gradient-text">Dettagli:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col" style="text-align:left">
                      <h6 class="style-gradient-text">Operazioni eseguite:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $opEseguite = $rapporto['OperazioniEseguite'];
                              if ($opEseguite != null){
                                echo $opEseguite;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                      <h6 class="style-gradient-text">Osservazioni:
                        <span class="mdl-color-text--black">
                          <span class="mdl-color-text--black">
                            <?php
                              $osservazioni = $rapporto['Osservazioni'];
                              if ($osservazioni != null){
                                echo $osservazioni;
                              }else{
                                echo "Dato non disponibile";
                              }
                             ?>
                         </span>
                      </h6>
                    </div>
                  </div>



                  <h6 class="style-gradient-text">Mezzi intervenuti:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $idMezzi = getMezziByReport($rapporto['ID'], $db_conn);
                      if ($idMezzi != null){
                        echo '<ul class="mdl-list">';
                        for ($i=0; $i < count($idMezzi); $i++){

                          ?>
                            <li class="mdl-list__item">
                              <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">commute</i>
                                <?php echo getMezzi($idMezzi["$i"], $db_conn);?>
                              </span>
                            </li>
                          <?php
                        }
                        echo '</ul>';
                      }else{
                        echo "<div style='width:100%;text-align:center'>";
                        echo "<h6 class='mdl-color-text--black'>Nessun mezzo intervenuto</h6>";
                        echo "</div>";
                      }
                     ?>
                  </div>


                  <h6 class="style-gradient-text">Altri soccorsi:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $soccorsi = getSoccorsi(null, $db_conn);
                      //print_r($prov);
                      $rows = count($soccorsi) / 2;
                      if(!is_int($rows)){
                        $rows = (int)$rows + 1;
                      }
                      $index = 0;
                      for ($i=0; $i < $rows;$i++){
                        for($j=0;$j < 2; $j++){
                          if ($index < count($soccorsi)){
                            echo '
                            <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idSoccorsi_'.$index.'">
                                <input type="checkbox" id="idSoccorsi_'.$index.'" class="mdl-checkbox__input" name="soccorsi_'."$index".'" value="'.$soccorsi[$index][0].'">
                                <span class="mdl-checkbox__label">'.$soccorsi[$index][1].'</span>
                              </label>
                            </div> ';
                            $index++;
                          }
                        }
                        echo "<br>";
                      }
                     ?>
                  </div>

                  <h6 class="style-gradient-text">Vigili intervenuti:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $vigili = getFiremanData(null, $db_conn);
                      //print_r($prov);
                      $rows = count($vigili) / 2;
                      if(!is_int($rows)){
                        $rows = (int)$rows + 1;
                      }
                      $index = 0;
                      for ($i=0; $i < $rows;$i++){
                        for($j=0;$j < 2; $j++){
                          if ($index < count($vigili)){
                            echo '
                            <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idVigile_'.$index.'">
                                <input type="checkbox" id="idVigile_'.$index.'" class="mdl-checkbox__input" name="vigile_'."$index".'" value="'.$vigili[$index][0].'">
                                <span class="mdl-checkbox__label">'.$vigili[$index][1].'</span>
                              </label>
                            </div> ';
                            $index++;
                          }
                        }
                        echo "<br>";
                      }
                     ?>
                  </div>

                  <br>

                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                        <select id="IdRos" class="mdl-textfield__input" name="ros" required="">
                          <?php
                            $ros = getFiremanData(null, $db_conn);
                            for ($i =0; $i < count($ros); $i++){
                              echo '<option value="'.$ros[$i][0].'">'.$ros[$i][1].'</option>';
                            }
                           ?>
                        </select>
                        <label class="mdl-textfield__label" for="IdRos">Responsabile Operazioni</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                        <select id="IdCompilatore" class="mdl-textfield__input" name="compilatore" required="">
                          <?php
                            $compilatore = getFiremanData(null, $db_conn);
                            for ($i =0; $i < count($compilatore); $i++){
                              echo '<option value="'.$compilatore[$i][0].'">'.$compilatore[$i][1].'</option>';
                            }
                           ?>
                        </select>
                        <label class="mdl-textfield__label" for="IdCompilatore">Compilatore</label>
                      </div>
                    </div>
                  </div>

                  <br>

                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                              type="reset"
                               onclick="location.href='index.php?back=true'">
                               Indietro
                             <i class="material-icons">cancel</i>
                      </button>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                              type="submit"
                              id="btnSave"
                              name="btnSave">
                               Salva
                             <i class="material-icons">save</i>
                      </button>
                    </div>
                  </div>

                  <br>
                  <br>
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
