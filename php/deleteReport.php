<?php
  include "dbConnection.php";
  session_start();
  $reportID = $_GET['id'];
  $sql = "DELETE FROM t_rapportiVVF WHERE ID='$reportID'";
  $deleteQuery = mysqli_query($db_conn, $sql);
  if ($deleteQuery == null){
    die("error");
  }
  header("location:../index.php");
?>
