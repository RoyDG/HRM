<?php
session_start();
ob_start();
require_once "../../../assets/support/inc.all.php";
$title = "Human Resource Management Dashboard";
 $today = date('Y-m-d');
 $lastdays = 	date("Y-m-d", strtotime("-7 days", strtotime($today)));
?>



<!DOCTYPE html>

<html lang="en">


<body>
  <h1>ERP</h1>
</body>


</html>

<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
?>