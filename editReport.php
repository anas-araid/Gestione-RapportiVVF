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
        $_SESSION['rapporto'] = $rapporto;
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
                <form action="php/updateReport.php" method="post" style="text-align:center;max-height:650px;overflow:auto">
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
                         <input class="mdl-textfield__input" type="text" id="IdRapporto" name="rapporto" required="" value="<?php echo getLastReportId($db_conn)?>">
                         <label class="mdl-textfield__label" for="IdRapporto">Inserisci id del rapporto</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idUrgente" id="lblUrgente">
                        <?php
                          $urgente = $rapporto['Urgente'];

                        ?>
                        <input type="checkbox" id="idUrgente" class="mdl-checkbox__input" name="urgente" value="<?php echo $urgente ?>">
                        <span class="mdl-checkbox__label">Urgente</span>
                      </label>
                    </div>
                  </div>
                  <h6 class="style-gradient-text">Segnalazione pervenuta da:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $prov = getProvChiamata(null, $db_conn);
                      $rows = count($prov) / 2;
                      if(!is_int($rows)){
                        $rows = (int)$rows + 1;
                      }
                      $index = 0;
                      for ($i=0; $i < $rows;$i++){
                        for($j=0;$j < 2; $j++){
                          if ($index < count($prov)){
                            $checked = "";
                            if ($rapporto['FK_ProvChiamata'] == $prov[$index][0]){
                              $checked = "checked";
                            }
                            echo '
                            <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="prov_'.$index.'" id="radioProv_'.$prov[$index][0].'" ">
                                <input type="radio" id="prov_'.$index.'" class="mdl-radio__button" name="provChiamata" value="'.$prov[$index][0].'" '.$checked.'>
                                <span class="mdl-radio__label">'.$prov[$index][1].'</span>
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
                        <select id="IdIntervento" class="mdl-textfield__input" name="intervento" required="">
                          <?php
                            $interventi = getCallType(null, $db_conn);
                            for ($i =0; $i < count($interventi); $i++){
                              $selected = "";
                              if ($rapporto['FK_TipoChiamata'] == $interventi[$i][0]){
                                $selected = "selected";
                              }
                              echo '<option value="'.$interventi[$i][0].'"'.$selected.'>'.$interventi[$i][1].'</option>';
                            }
                           ?>
                        </select>
                        <label class="mdl-textfield__label" for="IdIntervento">Evento</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
                         <input class="mdl-textfield__input" type="date" id="IdData" name="data" required="" value="<?php echo date_create($rapporto['Data'])->format('Y-m-d'); ?>">
                      </div>
                    </div>
                    <br>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col">
                      <?php
                        $localita = getLocalita($rapporto['FK_Localita'], null, null, $db_conn);
                      ?>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idVia" name="via" required="" value="<?php echo $localita['via'] ?>">
                         <label class="mdl-textfield__label" for="idVia">Via</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                        <select id="IdComune" class="mdl-textfield__input" name="comune" required="">
                          <?php
                            $comuni = getComuni(null, $db_conn);
                            for ($i =0; $i < count($comuni); $i++){
                              $selected = "";
                              if ($comuni[$i][1] == $localita['via']){
                                $selected = "selected";
                              }
                              echo '<option value="'.$comuni[$i][0].'"'.$selected.' >'.$comuni[$i][1].'</option>';
                            }
                           ?>
                        </select>
                        <label class="mdl-textfield__label" for="IdComune">Comune</label>
                      </div>
                    </div>
                    <br>

                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <span>Ora di partenza &nbsp</span>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:50%">
                         <input class="mdl-textfield__input" type="time" id="IdOraUscita" name="oraUscita" required="" value="<?php echo $rapporto['OraUscita'] ?>">
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <span>Ora di rientro &nbsp</span>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:50%">
                         <input class="mdl-textfield__input" type="time" id="IdOraRientro" name="oraRientro" required="" value="<?php echo $rapporto['OraRientro'] ?>">
                      </div>
                    </div>
                  </div>

                  <h6 class="style-gradient-text">Generalità del colpito:</h6>
                  <?php
                    $colpito = getColpito($rapporto['FK_GeneralitaColpito'], null, null, null, null, $db_conn);
                    //print_r($colpito);
                   ?>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idNome" name="nome" value="<?php echo $colpito['Nome'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idNome">Nome</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idCognome" name="cognome" value="<?php echo $colpito['Cognome'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idCognome">Cognome</label>
                      </div>
                    </div>
                    <br>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="text" id="idResidenza" name="residenza" value="<?php echo $colpito['Residenza'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idResidenza">Residenza</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--3-col">
                      <?php
                        $dataDiNascita = '';
                        if($colpito['DataDiNascita'] != date_create('1900-01-01')->format('Y-m-d')){
                          $dataDiNascita = $colpito['DataDiNascita'];
                        }
                      ?>
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:80%">
                         <input class="mdl-textfield__input" type="date" id="idDataDiNascita" name="dataDiNascita" value="<?php echo date_create($dataDiNascita)->format('Y-m-d'); ?>">
                      </div>
                    </div>
                    <br>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--8-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:90%">
                         <input class="mdl-textfield__input" type="number" id="idTelefono" name="telefono" value="<?php echo $colpito['Telefono'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idTelefono">Telefono</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
                         <input class="mdl-textfield__input" type="text" id="idCartaIdentita" name="cartaIdentita" value="<?php echo $colpito['CartaIdentita'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idCartaIdentita">Carta d'identità</label>
                      </div>
                    </div>
                    <br>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:95%">
                         <input class="mdl-textfield__input" type="text" id="idAltro" name="altro" value="<?php echo $colpito['Altro'] ?>">
                         <label class="mdl-textfield__label style-gradient-text" for="idAltro">Altro</label>
                      </div>
                    </div>
                  </div>

                  <h6 class="style-gradient-text">Dettagli:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                      <div class="mdl-textfield mdl-js-textfield" style="width:90%">
                        <textarea class="mdl-textfield__input" type="text" rows= "4" id="idOperazioni" name="operazioni"><?php echo $rapporto['OperazioniEseguite'] ?></textarea>
                        <label class="mdl-textfield__label style-gradient-text" for="idOperazioni">Operazioni eseguite</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                      <div class="mdl-textfield mdl-js-textfield" style="width:90%">
                        <textarea class="mdl-textfield__input " type="text" rows= "4" id="idOsservazioni" name="osservazioni"><?php echo $rapporto['Osservazioni'];?></textarea>
                        <label class="mdl-textfield__label style-gradient-text" for="idOsservazioni">Osservazioni</label>
                      </div>
                    </div>
                  </div>



                  <h6 class="style-gradient-text">Mezzi intervenuti:</h6>
                  <div class="mdl-grid mdl-card mdl-shadow--8dp style-card" style="width:90%">
                    <?php
                      $mezzi = getMezzi(null, $db_conn);
                      //print_r($mezzi);
                      $rows = count($mezzi) / 2;
                      if(!is_int($rows)){
                        $rows = (int)$rows + 1;
                      }
                      $index = 0;
                      for ($i=0; $i < $rows;$i++){
                        for($j=0;$j < 2; $j++){
                          if ($index < count($mezzi)){
                            echo '
                            <div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">
                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idMezzi_'.$index.'" id="lblMezzi_'.$mezzi[$index][0].'">
                                <input type="checkbox" id="idMezzi_'.$index.'" class="mdl-checkbox__input" name="mezzo_'."$index".'" value="'.$mezzi[$index][0].'">
                                <span class="mdl-checkbox__label">'.$mezzi[$index][1].'</span>
                              </label>
                            </div> ';
                            $index++;
                          }
                        }
                        echo "<br>";
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
                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idSoccorsi_'.$index.'" id="lblSoccorsi_'.$soccorsi[$index][0].'">
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
                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idVigile_'.$index.'" id="lblVigili_'.$vigili[$index][0].'">
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
                              $selected = "";
                              if ($rapporto['FK_Responsabile'] == $ros[$i][0]){
                                $selected = "selected";
                              }
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
                              $selected = "";
                              if ($rapporto['FK_Compilatore'] == $compilatore[$i][0]){
                                $selected = "selected";
                              }
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
          <script>
            window.onload = function(){
              <?php
                // attiva la checkbox urgente
                if ($urgente == 1){
                  echo "
                    document.getElementById('lblUrgente').classList.add('is-checked');
                  ";
                }
                // attiva il radio button della provenienza della chiamata
                $radioBtn = $rapporto['FK_ProvChiamata'];
                if ($radioBtn != null){
                  $radioProv = "'radioProv_$radioBtn'";
                  echo "
                    document.getElementById($radioProv).classList.add('is-checked');
                  ";
                }
                // attiva le checkbox dei mezzi
                $arrayMezzi = getMezziByReport($rapporto['ID'], $db_conn);
                for ($i=0; $i < count($arrayMezzi); $i++){
                  $mezzo = $arrayMezzi[$i];
                  echo "
                    document.getElementById('lblMezzi_$mezzo').classList.add('is-checked');
                  ";
                }
                // attiva le checkbox dei soccorsi
                $arraySoccorsi = getSoccorsiByReport($rapporto['ID'], $db_conn);
                for ($i=0; $i < count($arraySoccorsi); $i++){
                  $soccorsi = $arraySoccorsi[$i];
                  echo "
                    document.getElementById('lblSoccorsi_$soccorsi').classList.add('is-checked');
                  ";
                }
                // attiva le checkbox dei vigili intervenuti
                $arrayVigili = getVigiliByReport($rapporto['ID'], $db_conn);
                for ($i=0; $i < count($arrayVigili); $i++){
                  $vigili = $arrayVigili[$i];
                  echo "
                    document.getElementById('lblVigili_$vigili').classList.add('is-checked');
                  ";
                }
               ?>
          }
         </script>
         <?php
          include "php/_footer.php";
         ?>
        </div>
      </main>
    </div>
  </body>

</html>
