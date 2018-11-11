<?php
  function getInterventi($db_conn, $isFrequent){
    $frequent = "";
    if ($isFrequent){
      $frequent = " ORDER BY n_inter DESC LIMIT 5";
    }
    $report = array();
    $sql = "SELECT FK_TipoChiamata AS Intervento, COUNT(FK_TipoChiamata) AS n_inter FROM t_rapportiVVF GROUP BY FK_TipoChiamata".$frequent;
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
