<div style="max-height:600px;min-height:500px;overflow:auto">
  <div class="mdl-grid" style="width:95%">
    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
               onclick="location.href='newReport.php'">
               Nuovo
             <i class="material-icons">note_add</i>
      </button>
    </div>
    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
               onclick="location.href='core/logout.php'">
               Esci
             <i class="material-icons">account_circle</i>
      </button>
    </div>
  </div>
  <div>
    <form action="core/search.php" method="POST" style="text-align:center">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%;">
        <input class="mdl-textfield__input style-gradient-text" style="border-bottom:1px solid #c5003e;color:grey" type="text" id="find" name="find" required="">
        <label class="mdl-textfield__label style-gradient-text" for="find">Cerca</label>
      </div>
      <button id="btn-search" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
        <i class="material-icons style-gradient-text">search</i>
      </button>
      <button id="btn-download"
              type="reset"
              class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white"
              onclick="location.href='core/exportCSV.php'">
        <i class="material-icons style-gradient-text">save</i>
      </button>
    </form>
  </div>

  <script>
    <?php
      if ($_SESSION['warning']){
        $_SESSION['warning'] = false;
        echo "flatAlert('Attenzione', 'L\'applicazione è ancora instabile: eventuali malfunzionamenti verranno risolti il più presto possibile.', 'warning', '#')";
      }
    ?>
  </script>
  <div style="overflow:auto">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
      <thead>
        <tr style="text-align:left">
          <th>ID</th>
          <th>Data</th>
          <th>Evento</th>
          <th>Responsabile</th>
          <th></th>
          <th></th
        </tr>
      </thead>
      <tbody>
        <?php
          include "core/getData.php";
          if (isset($_SESSION['search'])){
            if ($_SESSION['search'] == array()){
              echo "<script>flatAlert('Attenzione', 'La ricerca non ha prodotto risultati.', 'warning', '#')</script>";
            }else{
              $_SESSION['include'] = 'core/searchReports.php';
              echo "
              <script>
                location.reload();
              </script>";
            }
          }
          $reportQuery = "SELECT * FROM t_rapportiVVF ORDER BY Data DESC";
          $getAllReports = mysqli_query($db_conn, $reportQuery);
          if ($getAllReports != false){
            $reportExists = false;
            while($ris=mysqli_fetch_array($getAllReports)){
              $reportExists = true;
              // onclick=" '.'location.href='."'showReport.php?id=".$ris["ID"]."'".' "
              echo '<tr>
                  <td>'.$ris['ID_Rapporto'].'</td>
                  <td>'.date('d-m-Y', strtotime($ris['Data'])).'</td>
                  <td>'.getCallType($ris['FK_TipoChiamata'], $db_conn).'</td>
                  <td>'.getFiremanData($ris['FK_Responsabile'], $db_conn)['Nome']." ".getFiremanData($ris['FK_Responsabile'], $db_conn)['Cognome'].'</td>
                  <td><a href="showReport.php?id='.$ris['ID'].'">Dettagli</a></td>
                  <td><a href="editReport.php?id='.$ris['ID'].'">Modifica</a></td>
                  <td><a href="#" onclick="alertDeleteReport('.$ris['ID'].')" style="color:red">Elimina</a></td>
                </tr>';
            }
          }
         ?>
      </tbody>
    </table>
  </div>
  <div style="text-align:center">
    <?php
    if(!$reportExists){
      echo "<h5 class='style-gradient-text'>Nessun rapporto d'intervento</h5>";
    }
    ?>
  </div>
<div>
