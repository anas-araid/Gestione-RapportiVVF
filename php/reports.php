<div style="max-height:600px;overflow:auto">
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
