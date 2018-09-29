<!--
<script>

  var modal = new tingle.modal({
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
  var content = '<form action="php/asdf.php" method="POST" style="text-align:center">'+
   '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">' +
      '<input class="mdl-textfield__input" type="text" id="IdRapporto" name="IdRapporto" required="">'+
      '<label class="mdl-textfield__label" for="IdRapporto">Inserisci id del rapporto</label>'+
    '</div>'+
    '<br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">' +
       '<input class="mdl-textfield__input" type="text" id="data" name="data" required="">'+
       '<label class="mdl-textfield__label" for="data">Data</label>'+
    '</div>'+

    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">' +
       '<input class="mdl-textfield__input" type="text" id="localita" name="localita" required="">'+
       '<label class="mdl-textfield__label" for="localita">Località</label>'+
    '</div>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%">' +
       '<input class="mdl-textfield__input" type="text" id="oraRientro" name="oraRientro" required="">'+
       '<label class="mdl-textfield__label" for="oraRientro">Ora di rientro</label>'+
    '</div>'+
    '<div>'+
      '<button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="submit">INVIA</button>'+
      '<br>'+
      '<button class="style-button style-gradient" style="color:white;margin:10px;width:40%" type="reset" onclick="modal.close()">Indietro</button>'+
    '</div>'+
  '</form>';
  // set content
  modal.setContent(
    content
  );
</script>
-->
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
               onclick="location.href='php/logout.php'">
               Esci
             <i class="material-icons">account_circle</i>
      </button>
    </div>
  </div>
  <div>
    <form action="" method="POST" style="text-align:center">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:60%;">
        <input class="mdl-textfield__input style-gradient-text" style="border-bottom:1px solid #c5003e;color:grey" type="text" id="find" name="find">
        <label class="mdl-textfield__label style-gradient-text" for="find">Cerca</label>
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
            // SISTEMARE ONCLICK
            echo '<tr onclick="">
                <td>'.$ris['ID_Rapporto'].'</td>
                <td>'.date('d-m-Y', strtotime($ris['Data'])).'</td>
                <td>'.getCallType($ris['FK_TipoChiamata'], $db_conn).'</td>
                <td>'.getFiremanData($ris['FK_Responsabile'], $db_conn)['Nome']." ".getFiremanData($ris['FK_Responsabile'], $db_conn)['Cognome'].'</td>
                <td><a href="edit.php?id='.$ris['ID'].'">Modifica</a></td>
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
