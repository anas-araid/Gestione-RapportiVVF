<?php
  function getInterventi($db_conn){
    $report = array();
    $sql = "SELECT FK_TipoChiamata as Intervento, count(FK_TipoChiamata) as n_inter FROM t_rapportiVVF group by FK_TipoChiamata";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $report[$i] = array(getCallType($ris['Intervento'], $db_conn), $ris['n_inter']);
      $i++;
    }
    return $report;
  }
  //$report['Intervento'] = getCallType($ris['Intervento'], $db_conn);
  //$report['N_intervento'] = $ris['n_inter'];
?>
