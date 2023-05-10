<?php
if(!isset($_SESSION))
session_start();
require_once "../../../engine/configure/default_values.php";
$level=$_SESSION['user']['level'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Sales ERP -AKSID</title>
<link href="../../css/style.css" type="text/css" rel="stylesheet"/>
<link href="../../css/menu.css" type="text/css" rel="stylesheet"/>
<link href="../../css/table.css" type="text/css" rel="stylesheet"/>
<link href="../../css/input.css" type="text/css" rel="stylesheet"/>
<link href="../../css/form.css" type="text/css" rel="stylesheet"/>
<link href="../../css/pagination.css" rel="stylesheet" type="text/css" />
<link href="../../css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
<meta name="Developer" content="Md. Mhafuzur Rahman Cell:01815-224424 email:mhafuz@yahoo.com" />
<link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/paging.js"></script>
<script type="text/javascript" src="../../js/ddaccordion.js"></script>
<script type="text/javascript" src="../../js/js.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 20px}
-->
</style>
</head>
<body>
<div class="wrapper">
			
			<div class="top_bar">
			
			
			
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td><div class="heading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=POWERED_BY?></div></td>
					<td>&emsp;</td>
					<td>
					<? 
					  if($_SESSION['user']['depot']>0)
					  echo find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);
					  else
					  {unset($_SESSION);
					  }?>
					
					</td>
					<td style="border-left:1px solid #666666;" width="200px;"> 
					
					
					<div class="srabon">
  
<div class="dropdown">
  <button class="dropbtn">&emsp; Howdy, <?=$_SESSION['user']['fname']?> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
  <div class="dropdown-content">
    <a href="../main/logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
  </div>
</div>
</div>



</td>
				  </tr>
				</table>
  </div>
			<div class="body_box">
					    <div class="body_middlebox_bar">
						<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td valign="top" style="background: #272c33;">
							<?
					if($_SESSION['mhafuz'])
					{
					?>
							<div class="menu">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
								  </tr>
								  <tr>
									<td valign="top">
									<? include("../../template/main_layout_menu.php");?>
									</td>
								  </tr>
								</table>

							</div><? }?></td>
							
							
							
							<td valign="top" align="center" class="sr_main_content">
	
							<div class="sr_main_content_directory">
							
							<!--this is for main content message start-->
					<?=$title?> 
					<br />
<? if(isset($msg)){?>	
  <?=$msg?>
<? } ?>

<!--this is for main content message end-->

							
							
							
							
							</div>
	
							<div class="right_main" >
							
							
							<?=$main_content?>
							</div>
							</td>
							
							
						  </tr>
						</table>
						</div>		
			</div>
</div>


</body>
</html>
