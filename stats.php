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


            <section class="mdl-cell mdl-cell--middle mdl-cell--9-col">
              <div class="mdl-card mdl-shadow--8dp style-card" style="width:100%">
                <div style="text-align:center">
                  <!--
                  <canvas id="myChart" style="max-height:300px;max-width:300px"></canvas>
                  <script>
                    // lista colori
                    chartColors = {
                    	1: 'rgb(255, 99, 132)',
                    	2: 'rgb(255, 159, 64)',
                    	3: 'rgb(255, 205, 86)',
                    	4: 'rgb(75, 192, 192)',
                    	5: 'rgb(54, 162, 235)',
                    	6: 'rgb(153, 102, 255)',
                    	7: 'rgb(201, 203, 207)'
                    };
                    var data = [10, 20, 30]
                    console.log(data.length);
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var data = {
                      labels: ["Red", "Blue", "Yellow"],
                      datasets: [{
                        data: [10, 20, 30],
                        backgroundColor: [

                          ],
                       }],
                    }
                    var myDoughnutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: data,
                        options: {
                  				responsive: true
                  			}
                    });
                  </script>
                -->
                
                </div>

              </div>
            </section>
          </div>
          <?php include "core/_footer.php" ?>
        </div>
      </main>
    </div>
  </body>

</html>
