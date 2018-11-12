<html>
  <head>
    <?php
      include "core/_header.php";
      session_start();
      //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
      // error_reporting per togliere il notice quando non trova isLogged
      //error_reporting(0);
      include "core/dbConnection.php";
      include "core/getData.php";
      include "core/getStats.php";
      include "core/functions.php";

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
              <div class="mdl-cell mdl-cell--middle mdl-cell--12-col">
                <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                        style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                        type="reset"
                         onclick="location.href='index.php?back=true'">
                         Indietro
                       <i class="material-icons">cancel</i>
                </button>
              </div>
            </section>


            <section class="mdl-cell mdl-cell--middle mdl-cell--9-col" style="max-height:650px;overflow:auto">
              <div class="mdl-card mdl-shadow--8dp style-card" style="width:100%;text-align:center">
                <div>
                  <h3 style="text-align:center" class="style-gradient-text">Statistiche</h3>
                  <br>
                  <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                          style="width:200px;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                          type="reset"
                           onclick="allInterventi.open()">
                           Tutti gli interventi
                         <i class="material-icons">cancel</i>
                  </button>
                  <?php
                    $interventi = getInterventi(2018, $db_conn, true);
                    $chartData = array();
                    $chartLabel = array();
                    // creo due array contenenti uno il nome dell'intervento, e l'altro il numero
                    for ($i=0; $i<count($interventi);$i++){
                      $chartData[$i] = $interventi[$i][1];
                      $chartLabel[$i] = $interventi[$i][0];
                    }
                    // conversione da array php a qullo javscript
                    $chartLabel = json_encode($chartLabel);
                    $chartData = json_encode($chartData);
                   ?>


                   <!-- ###      GRAFICO INTERVENTI FREQUENTI         ### -->
                  <canvas id="chartInterventiFrequenti" style="max-height:300px;max-width:300px"></canvas>
                  <script>
                    // lista colori
                    chartColors = {
                      1: '#e74c3c',
                      2: '#e67e22',
                      3: '#2ecc71',
                      4: '#f1c40f',
                      5: '#3498db',
                      6: '#9b59b6',
                      7: '#34495e'
                    };
                    var colors = Array();
                    for (var i=0; i < <?php echo $chartData ?>.length;i++){
                      colors[i]= chartColors[i+1];
                    }
                    var ctx = document.getElementById("chartInterventiFrequenti").getContext('2d');
                    var data = {
                      labels: <?php echo $chartLabel ?>,
                      datasets: [{
                        data: <?php echo $chartData ?>,
                        backgroundColor: colors,
                       }],
                    }
                    var chartFrequenti = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                        options: {
                  				responsive: true
                  			}
                    });
                  </script>

                  <!-- ###      GRAFICO INTERVENTI ANNUALI         ### -->

                  <?php
                    $anno = getInterventiAnnuali(2018, $db_conn);
                    $chartMese = array();
                    $chartInterventi = array();
                    // creo due array contenenti uno il nome dell'intervento, e l'altro il numero
                    for ($i=0; $i<count($anno);$i++){
                      $chartMese[$i] = $anno[$i][0];
                      $chartInterventi[$i] = $anno[$i][1];
                    }
                    // conversione da array php a qullo javscript
                    $maxInterventiAlMese = max($chartInterventi);
                    $chartMese = json_encode($chartMese);
                    $chartInterventi = json_encode($chartInterventi);
                   ?>

                  <canvas id="chartInterventiAnnuali" style="max-height:auto;max-width:100%"></canvas>
                  <script>
                  var ctx = document.getElementById("chartInterventiAnnuali").getContext('2d');
                  var chartAnnuali = new Chart(ctx, {
                      type: 'line',
                      data: {
                          datasets: [{
                              label: 'Interventi: ',
                              data: <?php echo $chartInterventi ?>,
                              backgroundColor: "rgba(231, 77, 60, 0.49)",
                              borderColor: "#e74c3c",
                          }],
                          labels: <?php echo $chartMese ?>
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      suggestedMin: 0,
                                      suggestedMax: <?php echo $maxInterventiAlMese ?>
                                  }
                              }]
                          }
                      }
                  });

                  </script>


                </div>
                <br>
                <div class="mdl-cell mdl-cell--middle mdl-cell--12-col mdl-cell--hide-desktop" style="100%">
                  <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
                  style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
                  type="reset"
                  onclick="location.href='index.php?back=true'">
                  Indietro
                  <i class="material-icons">cancel</i>
                </button>
              </div>
              </div>
            </section>
          </div>
          <?php include "core/_footer.php" ?>
        </div>
        <?php
          $tuttiInterventi = "'";
          for ($i=0; $i < sizeOf($interventi); $i++){
            if($interventi[$i][1]==1){
              $inter = "intervento";
            }else{
              $inter = "interventi";
            }
            //print_r($interventi);
            $tipoIntervento = $interventi[$i][0];
            $totInterventi = $interventi[$i][1];
            $tuttiInterventi .= "<b>$tipoIntervento: </b> $totInterventi $inter <br>";
          }
          $tuttiInterventi .= "'";
        ?>
        <script>
        var allInterventi = new tingle.modal({
                  closeMethods: ['overlay', 'button', 'escape'],
                  closeLabel: "Chiudi",
                  cssClass: ['custom-class-1', 'custom-class-2'],
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
            '<h2 class="style-gradient-text">Tutti gli interventi<h2>'+
            '<div>'+
            '<ul class="mdl-list">'+
            <?php echo $tuttiInterventi ?> +
            '</ul>'+
            '</div>'
          );
        </script>
      </main>
    </div>
  </body>

</html>
