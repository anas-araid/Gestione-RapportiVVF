<?php
  session_start();
  $ipaddress = $_SERVER['REMOTE_ADDR'];
  $timestamp = date('d/m/Y h:i:s');
  $browser = $_SERVER['HTTP_USER_AGENT'];
  $line = "Connessione: [".$timestamp."] - ".$_SESSION['Nome']." ".$_SESSION['Cognome']." - ".$ipaddress." - ".$browser."\n";
  $filename = "log.txt";
  $filedir = "../$filename";
  if (!file_exists($filedir)){
    $log = fopen($filedir, "w");
  }else{
    $log = fopen($filedir, "a+");
  }
  fwrite($log, $line);
  fclose($log);
  header("location:../index.php");
?>
