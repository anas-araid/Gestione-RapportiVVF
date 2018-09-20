<div style="max-height:600px;min-height:500px;overflow:auto">
  <div class="mdl-grid" style="width:95%">
    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
               onclick="modal.open()">
               Nuovo
             <i class="material-icons">note_add</i>
      </button>
    </div>
    <div class="mdl-cell mdl-cell--middle mdl-cell--6-col">
      <button class="mdl-button mdl-js-button mdl-button--raised style-gradient style-button"
              style="width:100%;height:35px;color:white;border:none;border-radius:20px;;text-align:center;margin-bottom:15px"
               onclick="location.href='php/logout.php'">
               Esci
             <i class="material-icons">account_circle</i>
      </button>
    </div>
  </div>
  <div>
    <form action="" method="POST" style="text-align:center">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">
        <input class="mdl-textfield__input" type="text" id="find" name="find">
        <label class="mdl-textfield__label" for="find">Cerca</label>
      </div>
      <button id="btn-search" type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-color--white ">
        <i class="material-icons style-gradient-text">search</i>
      </button>
    </form>
  </div>
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
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
        include "php/getData.php";
        $reportQuery = "SELECT * FROM t_rapportiVVF ORDER BY Data DESC";
        $getAllReports = mysqli_query($db_conn, $reportQuery);
        if ($getAllReports != false){
          $reportExists = false;
          while($ris=mysqli_fetch_array($getAllReports)){
            $reportExists = true;
            echo '<tr onclick="">
                <td>'.$ris['ID_Rapporto'].'</td>
                <td>'.date('d-m-Y', strtotime($ris['Data'])).'</td>
                <td>'.getCallType($ris['FK_TipoChiamata']).'</td>
                <td>'.getFiremanData($ris['FK_Responsabile']).'</td>
                <td><a href="details.php?id='.$ris['ID'].'">Dettagli</a></td>
                <td><a href="deleteReport.php?id='.$ris['ID'].'">Elimina</a></td>
              </tr>';
          }
        }
       ?>
    </tbody>
  </table>
  <div style="text-align:center">
    <?php
    if(!$reportExists){
      echo "<h5 class='style-gradient-text'>Nessun rapporto d'intervento</h5>";
    }
    ?>
  </div>
<div>
