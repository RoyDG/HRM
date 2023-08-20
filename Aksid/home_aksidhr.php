<?php



session_start();



ob_start();



require "../../config/inc.all.php";



require "../../template/main_layout.php";



$title = 'Inventory Home Page';







if ($_GET['PBI_ID'] > 0) {



	$_SESSION['employee_selected'] = $_GET['PBI_ID'];



	header('Location:../hrm/employee_essential_information.php');







}











$today_date = date('Y-m-d');







$select = 'select * from transfer_detail where status=0 and TRANSFER_AFFECT_DATE<="' . $today_date . '"';







$query = mysql_query($select);







while ($dd = mysql_fetch_object($query)) {







	if ($dd->PBI_ID > 0) {







		//$up = 'INSERT INTO `transfer_detail`(`TRANSFER_ORDER_NO`, `TRANSFER_ORDER_DATE`, `TRANSFER_AFFECT_DATE`, `TRANSFER_NEW_REPORTING_AUTH`, `TRANSFER_PAST_REPORTING_AUTH`, `TRANSFER_NEW_DEPT`, `TRANSFER_PRESENT_DEPT`, `TRANSFER_NEW_PROJECT`, `TRANSFER_PAST_PROJECT`, `ESSENTIAL_REPORTING`,`PBI_ID`) VALUES ("'.$dd->TRANSFER_ORDER_NO.'","'.$dd->TRANSFER_ORDER_DATE.'","'.$dd->TRANSFER_AFFECT_DATE.'","'.$dd->TRANSFER_NEW_REPORTING_AUTH.'","'.$dd->TRANSFER_PAST_REPORTING_AUTH.'","'.$dd->TRANSFER_NEW_DEPT.'","'.$dd->TRANSFER_PRESENT_DEPT.'","'.$dd->TRANSFER_NEW_PROJECT.'","'.$dd->TRANSFER_PAST_PROJECT.'","'.$dd->ESSENTIAL_REPORTING.'","'.$dd->PBI_ID.'")';



		// mysql_query($up);







		$updatee1 = 'update personnel_basic_info set PBI_DEPARTMENT="' . $dd->TRANSFER_NEW_DEPT . '",JOB_LOCATION="' . $dd->TRANSFER_NEW_PROJECT . '" where PBI_ID="' . $dd->PBI_ID . '"';







		mysql_query($updatee1);



		$updatee2 = 'update essential_info set ESS_DEPARTMENT="' . $dd->TRANSFER_NEW_DEPT . '",ESSENTIAL_PROJECT="' . $dd->TRANSFER_NEW_PROJECT . '",ESSENTIAL_REPORTING="' . $dd->TRANSFER_NEW_REPORTING_AUTH . '" where PBI_ID="' . $dd->PBI_ID . '"';



		mysql_query($updatee2);







		$updatee3 = 'update transfer_detail set status=1 where PBI_ID="' . $dd->PBI_ID . '" and TRANSFER_AFFECT_DATE="' . $dd->TRANSFER_AFFECT_DATE . '"';







		mysql_query($updatee3);







		/*$update4 = 'update hrm_leave_info set PBI_IN_CHARGE="'.$dd->TRANSFER_NEW_REPORTING_AUTH.'", reporting_auth="'.$dd->TRANSFER_NEW_REPORTING_AUTH.'" where incharge_status in ("Not Approve","Pending") and leave_status in ("Pending","PENDING") and PBI_ID="'.$dd->PBI_ID.'"'



			mysql_query($update4);*/



		}



	}



?>







	<?php 



		/*?>require "../../template/header.php";



		require "../../template/sidebar.php";<?php */



	?>























<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">







<script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>







<script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>







<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



















<style>

	body .container.body .right_col {

		background: #ffffff !important;

	}



	.tile_count {

		margin-top: 85px !important;

	}





	.tile_stats_count {

		background-color: #51cda0 !important;

		transition: transform 0.3s ease-in-out;

		/*background-color:#1defbe !important;*/



	}

	.tile_stats_count:hover {

	  transform: scale(1.1);

	}



	.card_animation {

		transition: transform 0.3s ease-in-out;

	}

	.card_animation:hover {

	  transform: scale(1.1);

	}



	.count_top {

		text-align: center;

	}





	a {

		color: #333;

	}



	.tile_count .tile_stats_count {

		padding: 5px 5px 5px 5px;

		margin: 0px;

		border-radius: 10px;

	}



	.font {

		font-size: 14px;

	}



	.bold {

		font-weight: bold;

	}



	.big-font {

		font-size: 35px !important;

		/*font-weight:bold !important;*/

	}



	.fa-users,

	.fa-user-check,

	.fa-users-slash,

	.fa-male,

	.fa-female,





	.fa-users-cog {

		color: #fefffe;

		font-size: 25px;

		line-height: 0px;

		vertical-align: middle;

	}



	.x_panel {

		background-color: #f9f9f9;

	}



	.turnover .left {

		float: left;

		width: 33%;

		background-color: #4f81bc;

		color:#fff;

		padding: 5px;

	}



	.turnover .mid {

		float: left;

		width: 34%;

		background-color: #c0504e;

		padding: 5px;

	}



	.turnover .right {

		float: right;

		width: 33%;

		background-color: #b9d08a;

		color:#fff;

		padding: 5px;

	}



	.x_content {

		padding: 0px;

	}



	#barVertical .canvasjs-chart-container canvas {

		height: 350px !important;

		width: 100% !important;

	}



	@import "compass/css3";





	body {

		font-family: Tahoma, Arial, Verdana;

		font-size: 12px;

		color: black;

	}





	#chartdiv {

		width: 100%;

	/*	width: 640px;	*/

		height: 400px;



	}



		.notification{

		background:#f9f9f9;

		}



		.row-notifi{

			padding:10px;

		}



		.canvasjs-chart-credit{ 

			display:none;

		}

	

	.dp{

		height: 400px !important;

		margin-bottom: 1px !important;

	}





    #myChart {

		height: 335px !important;

        width: 100%;

        max-width: 600px; /* Adjust the maximum width as needed */

    }

    .chart-label {

        word-wrap: break-word;

        text-align: center;

    }

	

	

	

	



.button-style {

  font-weight: bold;

  width: 30%;

  height: 30px;

  background-color: #0e9e69;

  color: #ffffff;

  transition: background-color 0.3s, transform 0.3s;

  border: none; 

  outline: none;

  border-radius: 5px;

}



.button-style:hover {

  background-color: #087a50;

  transform: scale(1.1);

}



	



</style>





<style media="screen">

    /**************************************************************************/

    /* GENERIC                                                                */

    /**************************************************************************/

    *{

      margin: 0;

      padding: 0;

    }

    

    *,

    *:before,

    *:after{

      box-sizing: border-box;

    }



    body{

      font-family: Helvetica, Arial, Sans-Serif;

      font-weight: normal;

      line-height: 1.4em;

      font-size: 1.2em;

      color: #000;

    }



    

    /**************************************************************************/

    /* DESKTOP                                                                */

    /**************************************************************************/

    

    /* FIGURE */

    figure{

      min-width: 200px;

      max-width: 780px;

/*      max-width: 600px;                     /**/

      margin: 2rem;

      padding: 1.5rem 2rem 2rem;

      border: 1px solid #000;

    }

    

    /* TABLE */

    .barChart_h{

      display: block;

      height: auto;                         /* Do I need this? */

      width: 100%;

      overflow-wrap: break-word;

      border-spacing: 0;

    }

    

    /* CAPTION */

    .barChart_h caption{

      display: block;

      padding: 0 0 1rem 0;

      line-height: 1.1;

      font-size: 1.1rem;

      font-weight: bold;

      text-align: left;

    }

    

    /* TBODY */    

    .barChart_h tbody{

      display: block;                        

      content: "";

      display: block;

      clear: both;

      height: 0;

    }

    

    /* TH+TD */

    .barChart_h tbody tr.firstRow th,

    .barChart_h tbody tr.firstRow td{

      padding: 1rem 0 0.5rem 0;             /* Add extra vertical padding. */

    }

    

    .barChart_h tbody th,

    .barChart_h tbody td{

      padding: 0.5rem 0 0.4rem 0;           /* Space around Bars. */

    }

                                            

    .barChart_h tbody tr.lastRow th,

    .barChart_h tbody tr.lastRow td{

      padding: 0.5rem 0 1rem 0;             /* Add extra vertical padding. */

    }

    

    /* TH */

    .barChart_h tbody th{

/*      width: 25%;     /**/

      font-weight: bolder;

      text-align: left;
	  padding-left: 5px;

    }



    /* TD */

    .barChart_h tbody td{

      border-left: 2px solid #F00;          /* X-AXIS. (vertical) */

      

      border-right: 1px solid #DDD;         /* Finish out repeating vertical-gridlines. */

      

      background-image: linear-gradient(to right, #DDD 1px, transparent 1px);

                                            /* Create grey-transparent gradient for 1px, then remainder of gradient is transparent.

                                               This creates the illusion of a 1px vertical-line. */

      background-size: 10% 100%;            /* Go right in 10% increments. */

    }



    /* BARS */

    .barChart_h tbody td span{

      position: relative;                   /* Needed for absolute-positioning of Bar-value. */

      display: block;                       /* Expands <span> to fill <td> */

      height: 20px;

      background: #cd5151;                  /* Aqua (default) */

      box-shadow: 5px 0px 5px rgba(0, 0, 0, 0.3);

    }

    

    /* BAR-VALUES */

    .barChart_h tbody td span b{

      position: absolute;

      left: 100%;

      top: 0;

      right: auto;

      bottom: 0;

      display: block;

      padding: 0 0 0 0.5rem;

      font-weight: bolder;

    }



    /* Y-AXIS */

    .barChart_h tbody th.blankCell{

      width: 25%;

    }



    .barChart_h tbody th.y-axis{

      position: relative;                   /* New */

      padding-bottom: 1.4rem;

      border-bottom: 2px solid #F00;        /* Y-AXIS. (horizontal) */

      background-color: #FFF;

    }

    

    /* Y-AXIS TITLE */

    .barChart_h tbody div.y-axis-title{

      display: block;

      text-align: center;

      font-weight: bold;

    }    

    

    /* Y-AXIS LABELS */

    .barChart_h tbody ol.y-axis-labels{

      position: absolute;

      top: auto;

      bottom: 0;

      right: 0;

      left: 0;

      display: flex;                        /* Create Flexbox (Flex-Container). */

      flex-direction: row;

      margin: 0;                            /* New */

      padding: 0;                           /* New */

      list-style: none;                     /* New */

      font-size: 0.9rem;

    }



    .barChart_h tbody ol.y-axis-labels li.zero{

      position: absolute;                   /* Remove 0 from Flexbox flow. */ /* New */

      left: 0;

      right: auto;

      bottom: auto;

      top: 0;

    }



    .barChart_h tbody ol.y-axis-labels li.zero b{

      transform: translate(-50%, 0%);

    }



    .barChart_h tbody ol.y-axis-labels li{

      flex: 1 0 0;

      text-align: right;

    }



    .barChart_h tbody ol.y-axis-labels li b{

      display: inline-flex;

      transform: translate(50%, 0%);

      font-weight: normal;

    }

    

    

    /**************************************************************************/

    /* MOBILE                                                                 */

    /**************************************************************************/

    @media screen and (max-width: 414px){

      body{

        font-size: 0.8em;

      }

      

      /* CAPTION */

      .barChart_h caption{

        font-size: 1rem;

      }



      /* FIGURE */

      figure{

        margin: 0;

        padding: 1rem;

      }

      

      /* TD */

      .barChart_h tbody td{

        width: 100%;

      }

    }

        

  </style>

















<!-- Main page content -->





<div class="right_col" role="main">



	<div class="row tile_count">



		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a href="btrc_report.php" target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">







					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> Total Employees </p>







					<div class="count big-font" align="center"> <i class="fa fa-users"></i>







						<?



						$sql = "SELECT count(PBI_ID) as total FROM personnel_basic_info" . $con;







						$result = mysql_query($sql);







						$values = mysql_fetch_assoc($result);







						$num_rows = $values['total'];







						echo $num_rows; 



						?>







					</div>



				</div>



			</a>



		</div>







		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a href="dashboard_report.php" target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">



					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> In Service </p>



					<div class="count big-font" align="center"> <i class="fas fa-user-check fa-xs"></i>







					<?



						$sql = "SELECT count(ESS_JOB_STATUS) FROM essential_info WHERE ESS_JOB_STATUS='In Service' " . $con;



						$result = mysql_query($sql);



						$values = mysql_fetch_assoc($result);



						$num_rows = $values['count(ESS_JOB_STATUS)'];



						echo $num_rows;



					?>







					</div>



				</div>



			</a>



		</div>







		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">



					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> Not in Service </p>



					<div class="count big-font" align="center"> <i class="fas fa-users-slash"></i>







					<?



						$sql = "SELECT count(ESS_JOB_STATUS) FROM essential_info WHERE ESS_JOB_STATUS='Not In Service' " . $con;



						$result = mysql_query($sql);



						$values = mysql_fetch_assoc($result);



						$num_rows = $values['count(ESS_JOB_STATUS)'];



						echo $num_rows;



					?>



					</div>



				</div>



			</a>



		</div>







		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">



					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> Total Males </p>







					<div class="count big-font" align="center"> <i class="fas fa-male"></i>







						<?



						$sql = "SELECT count(PBI_SEX) FROM personnel_basic_info WHERE PBI_SEX='Male' and PBI_JOB_STATUS='In Service' " . $con;



						$result = mysql_query($sql);



						$values = mysql_fetch_assoc($result);



						$num_rows = $values['count(PBI_SEX)'];



						echo $num_rows;



						?>



					</div>



				</div>



			</a>



		</div>











		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">



					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> Total Females </p>



					<div class="count big-font" align="center"> <i class="fas fa-female"></i>











						<?



						$sql = "SELECT count(PBI_SEX) FROM personnel_basic_info WHERE PBI_SEX='Female' and PBI_JOB_STATUS='In Service' " . $con;



						$result = mysql_query($sql);



						$values = mysql_fetch_assoc($result);



						$num_rows = $values['count(PBI_SEX)'];



						echo $num_rows;



						?>



					</div>



				</div>



			</a>



		</div>











		<div class="col-md-2 col-sm-4 col-xs-6" style="padding-left:5px; padding-right:5px;">



			<a href="dash_report.php" target="_blank">



				<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tile_stats_count pt-2 pb-2">



					<p class="font bold" style="margin:0px;" align="center"><!--<i class="fa fa-user"></i>--> Probationary Period </p>



					<div class="count big-font" align="center"> <i class="fa fa-users-cog"></i>



						



					<?



						$sql = "SELECT count(ESSENTIAL_JOINING_DATE) FROM essential_info WHERE `ESSENTIAL_JOINING_DATE` > '2022-06-00' " . $con;



						$result = mysql_query($sql);



						$values = mysql_fetch_assoc($result);



						$num_rows = $values['count(ESSENTIAL_JOINING_DATE)'];



						echo $num_rows;



					?>



					</div>



				</div>



			</a>



		</div>



	</div>















<div class="row row-notifi">



	<h5 style="text-align:center; font-weight:bold; background-color:#c3b72f; color:#333; padding-bottom:5px; padding-top:5px;">



		Probation Period Notification



	</h5>







	<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 ">



		<div style="font-weight:bold; width:100%; margin: 0px; text-align:center; color: #874725">



			Probation Period Notification 



			<span style="color:#FF0000;"></span>



		</div>







		<div class="notification" style= "height:100px; padding: 10px;">







			<?



		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';



			 $pro_query = mysql_query($pro);



		   	?>



			



				<marquee scrollamount="4"  onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">







		    <?  



				while($pro_data = mysql_fetch_object($pro_query)){



				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));



				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 



				  $interval->format("%Y Year, %M Months, %d Days");



				  $total_service_days = $interval->format('%a'); 



				 if($total_service_days>150  && $total_service_days<=180 ){



			 ?>







		  	<a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#d16a45; font-size:12px; font-weight:bold;" name="probation">







				<?=$pro_data->PBI_NAME?>-<?=$desg?>



				&nbsp;&nbsp;&nbsp;&nbsp;



			</a>



		  <? } }?>



		  </marquee>



		</div>



	</div>















	<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 ">



		<div style="font-weight:bold; width:100%;  margin: 0px; text-align:center; color: #874725">



			Probation Period Completion 



			<span style="color:#FF0000;"></span>



		</div>







		<div class="notification" style= "height:100px; padding: 10px">







			<?



		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';



			 $pro_query = mysql_query($pro);



		   	?>



			



		  <marquee scrollamount="4" onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">



	      	



			<? 



			  while($pro_data = mysql_fetch_object($pro_query)){



				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));



				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 



		      	$interval->format("%Y Year, %M Months, %d Days");



		      	$total_service_days = $interval->format('%a'); 



		     	if($total_service_days>=180  ){



			 ?>







		  <a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#d16a45; font-size:12px; font-weight:bold;" name="probation"><?=$pro_data->PBI_NAME?>-<?=$desg?>&nbsp;&nbsp;&nbsp;&nbsp;</a>







		  <? } }?>







		  </marquee>



		</div>



	</div>











	<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">



		<div style="font-weight:bold; width:100%; margin: 0px; text-align:center; color: #874725">



			3 Months Notification 



			<span style="color:#FF0000;"></span>



		</div>







		<div class="notification" style= "height:100px; padding: 10px";>







		   <?



		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';



			 $pro_query = mysql_query($pro);



		   ?>







		<marquee scrollamount="4"  onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">







		    <?  while($pro_data = mysql_fetch_object($pro_query)){



				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));



				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 



		      	$interval->format("%Y Year, %M Months, %d Days");



		      	$total_service_days = $interval->format('%a'); 



		     	if($total_service_days>80 && $total_service_days<=100 ){



			 ?>







		  <a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#d16a45; font-size:12px; font-weight:bold;" name="probation"><?=$pro_data->PBI_NAME?>-<?=$desg?>&nbsp;&nbsp;&nbsp;&nbsp;</a>







		  <? } }?>



		  </marquee>



		</div>



	</div>



</div>















	



	



	<!--	Upcoming Birthday	-->



	



	<div class="row">







		<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">







			<div class="x_panel ">







				<div class="x_title">







					<h2 style="text-align:center;">Upcoming Birthday </h2>







					<ul class="nav navbar-right panel_toolbox">







						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>







						</li>







						<li class="dropdown">







							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>







							<ul class="dropdown-menu" role="menu">







								<li><a href="#">Settings 1</a>







								</li>







								<li><a href="#">Settings 2</a>







								</li>







							</ul>







						</li>







						<li><a class="close-link"><i class="fa fa-close"></i></a>







						</li>







					</ul>







					<div class="clearfix"></div>







				</div>







															







				<?php



					$query = "SELECT PBI_REAL_BIRTH, PBI_NAME, PBI_ID



					  FROM personnel_basic_info



					  WHERE DATE_FORMAT(PBI_REAL_BIRTH, '%m-%d') >= DATE_FORMAT(CURRENT_DATE(), '%m-%d')



					  and PBI_JOB_STATUS='In Service'



					  ORDER BY DATE_FORMAT(PBI_REAL_BIRTH, '%m-%d') ASC



					  LIMIT 8";



					$queryd = mysql_query($query);



				?>



	



									



				<div class="x_content">







					<div class="container">







						<div class="row" style="margin:0; padding:0;">







							



			 			 <? while($data = mysql_fetch_object($queryd)){ ?>



						



							<div class="col-sm-3 col-lg-3 col-md-3 card_animation" style=" margin-bottom: 10px; ">



								



								<?







								$imgJPG = "../../pic/staff/" . $data->PBI_ID . ".JPG";







								$imgjpg = "../../pic/staff/" . $data->PBI_ID . ".jpg";







								$imgPNG = "../../pic/staff/" . $data->PBI_ID . ".PNG";







								$imgJPEG = "../../pic/staff/" . $data->PBI_ID . ".jpeg";







								$imgpng2 = "../../pic/staff/" . $data->PBI_ID . ".png";











								if (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgJPG)) {







									$link = $imgJPG;







								} elseif (file_exists($imgjpg)) {







									$link = $imgjpg;







								} elseif (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgpng2)) {







									$link = $imgpng2;







								} else $link = '';







								if (file_exists($link)) { ?>







								<img src="<?=$link?>" style="border-radius: 50%;height:60px;width: 100%;padding: 0px 20px;" />







								<? } else { ?>







								<img src="images.png" style="border-radius: 50%;height: 60px;width: 100%;padding: 0px 20px;"/>











								<? } ?>



								



																										<!--echo substr_replace($str, ".......", 12);-->



								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:11px;"><?=substr_replace($data->PBI_NAME, "...", 12);?><br />







								<span style="font-size:10px;"><?=date("F j", strtotime($data->PBI_REAL_BIRTH));?></span>







								</h5>







							</div>	







						<? } ?> 								







						</div>







						







						<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">







							<a>

								<form action="../report/master_report.php" target="_blank" method="post"> 

									<button name="report" value="2454" class="button-style" >View All </button>

								</form>



							</a>



						</div>



					</div>



				</div>







			</div>







		</div>







		







		



		<!--  Joining Anniversary  -->











		<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">







			<div class="x_panel ">







				<div class="x_title">







					<h2 style="text-align:center;">Joining Anniversary </h2>







					<ul class="nav navbar-right panel_toolbox">







						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>







						</li>







						<li class="dropdown">







							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>







							<ul class="dropdown-menu" role="menu">







								<li><a href="#">Settings 1</a>







								</li>







								<li><a href="#">Settings 2</a>







								</li>







							</ul>







						</li>







						<li>







							<a class="close-link"><i class="fa fa-close"></i></a>







						</li>







					</ul>







					<div class="clearfix"></div>







				</div>



				



				



				



				



				



				<?php



				$query = "SELECT e.ESSENTIAL_JOINING_DATE, p.PBI_ID, p.PBI_NAME



						  FROM essential_info e



						  JOIN personnel_basic_info p ON e.PBI_ID = p.PBI_ID



						  WHERE DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) <= CURDATE() and

						  DATE_FORMAT(e.ESSENTIAL_JOINING_DATE, '%m-%d') >= DATE_FORMAT(CURRENT_DATE(), '%m-%d')



						  and PBI_JOB_STATUS='In Service'



						  ORDER BY DATE_FORMAT(e.ESSENTIAL_JOINING_DATE, '%m-%d') ASC



						  LIMIT 8";







				$queryd = mysql_query($query);



				?>



				



				



				



				







				<div class="x_content">







					<div class="container">







						<div class="row" style="margin:0; padding:0;">







							<? while($data = mysql_fetch_object($queryd)){ ?>



						



							<div class="col-sm-3 col-lg-3 col-md-3 card_animation" style=" margin-bottom: 10px; ">



								



								<?







								$imgJPG = "../../pic/staff/" . $data->PBI_ID . ".JPG";







								$imgjpg = "../../pic/staff/" . $data->PBI_ID . ".jpg";







								$imgPNG = "../../pic/staff/" . $data->PBI_ID . ".PNG";







								$imgJPEG = "../../pic/staff/" . $data->PBI_ID . ".jpeg";







								$imgpng2 = "../../pic/staff/" . $data->PBI_ID . ".png";











								if (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgJPG)) {







									$link = $imgJPG;







								} elseif (file_exists($imgjpg)) {







									$link = $imgjpg;







								} elseif (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgpng2)) {







									$link = $imgpng2;







								} else $link = '';







								if (file_exists($link)) { ?>







								<img src="<?=$link?>" style="border-radius: 50%;height:60px;width: 100%;padding: 0px 20px;" />







								<? } else { ?>







								<img src="images.png" style="border-radius: 50%;height:60px;width: 100%;padding: 0px 20px;"/>











								<? } ?>



								



																										



								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:11px;"><?=substr_replace($data->PBI_NAME, "...", 12);?>



								<br />







								<span style="font-size:10px;"><?=date("F j", strtotime($data->ESSENTIAL_JOINING_DATE));?></span>







								</h5>







							</div>	







						<? } ?> 								







						</div>







						<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">







							<a href="#">







								<button class="button-style">View All </button>

							</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>





	

	

	

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="dp" style="background-color: #f9f9f9;" >			
				<table class="barChart_h" style="width:100%; overflow-x:hidden; height:90%;">
      				<h2>Employee by Department & Project</h2>



					<tbody>
						<!-- Y-axis -->
						<tr>
						  	<th class="blankCell"></th>
						  	<th class="y-axis" style="width:350px;">

								<ol class="y-axis-labels">
							  		<li class="zero"><b>0</b></li>

							  		<li><b>20</b></li>

							  		<li><b>40</b></li>

							  		<li><b>60</b></li>

							  		<li><b>80</b></li>

							  		<li><b>100</b></li>
								</ol>

						  	</th>
						</tr>

        

        <?
			$count_total_emp = find_a_field('personnel_basic_info','count(PBI_ID)','PBI_JOB_STATUS = "In Service"');

			$sqld = "SELECT p.PBI_DEPARTMENT,p.JOB_LOCATION,d.dep_sort_name_chart,proj.PROJECT_SHORT_NAME, count(p.PBI_ID) as tot_emp

			FROM personnel_basic_info p left join project proj on proj.PROJECT_ID=p.JOB_LOCATION left join department d on d.DEPT_ID=p.PBI_DEPARTMENT

			WHERE p.PBI_JOB_STATUS = 'In Service' GROUP BY p.PBI_DEPARTMENT,p.JOB_LOCATION order by p.PBI_DEPARTMENT asc";

			$qry = mysql_query($sqld);

			while($data=mysql_fetch_object($qry)){

			$percent = ($data->tot_emp/$count_total_emp)*200;

			$type = $data->dep_sort_name_chart;

			if($data->PROJECT_SHORT_NAME!=''){

			$type = $data->PROJECT_SHORT_NAME;

			}

		?>

						<tr>
							<th scope="row">
								<?=$type?>
							</th>
							<td title="<?=number_format($percent/2,0);?>%">
								<span style="width:<?=$percent?>%">
									<b><?=$data->tot_emp?></b>
								</span>
							</td>
						</tr>

					   <? } ?>

					</tbody>
				</table>				
			</div>
		</div>













		<!-- Recruitment Progress -->















		<div class="col-md-6 col-sm-6 col-xs-12">

			<div class="x_panel dp">

				<div class="x_title">

					<h2 style="text-align:center;">Recruitment Progress</h2>

					

					<ul class="nav navbar-right panel_toolbox">

						<li>

							<a class="collapse-link">

								<i class="fa fa-chevron-up"></i>

							</a>

						</li>



						<li class="dropdown">

							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

								<i class="fa fa-wrench"></i>

							</a>

							<ul class="dropdown-menu" role="menu">

								<li>

									<a href="#">Settings 1</a>

								</li>

								<li>

									<a href="#">Settings 2</a>

								</li>

							</ul>

						</li>						

						<li>

							<a class="close-link">

								<i class="fa fa-close"></i>

							</a>

						</li>

					</ul>

					<div class="clearfix">

					</div>

				</div>





				<div class="x_content">

					<table class="table table-bordered" style="margin:0px; margin-bottom:3px; height: 280px !important;">

						<thead>

							<tr bgcolor="#51cda0">

								<th align="center">Position</th>

								<th align="center">Department / Project</th>

								<th align="center">Job Post</th>

								<th align="center">CV Collection</th>

								<th align="center">CV Sorting</th>

								<th align="center">Interview Date </th>

							</tr>

						</thead>

					<tbody>



				<?  				 



					$sqld = 'select a.*,e.DESG_DESC



					from employee_requisition a,



					designation e



					where  e.DESG_ID=a.DESIGNATION order by REQUISITION_ID desc LIMIT 3';



					$queryd=mysql_query($sqld);



					while($data = mysql_fetch_object($queryd)){						 



				?>					







							<tr>







								<td><?=$data->DESG_DESC?></td>







								<? if($data->JOB_LOCATION>0){  ?>







									<td>



										<?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$data->JOB_LOCATION);?>



									</td>







								<? }else{ ?>







									<td>



										<?=find_a_field('department','DEPT_DESC','DEPT_ID='.$data->DEPARTMENT);?>

									</td>

								 <?	}?>

								<td><?=$data->JOB_POST?> </td>

								<td><?=$data->CV_COLLECTION?></td>

								<td><?=$data->CV_SORTING?></td>

								<td><?=$data->INTERVIEW_PROCESS_DATE?></td>

							</tr>

						 <? }?>	



					</tbody>

					</table>				

					<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">

							<a href="#">

								<button class="button-style">View All </button>

							</a>

					</div>

				</div>

			</div>

		</div>

	</div>









	<!--	Staff Turnover	-->









	<div class="row" style="margin-top: 20px;">

	<div class="col-md-6 col-sm-6 col-xs-12">

			<div style="background-color: #f9f9f9; height: 380px" >

				<div class="x_title">

					<h2 style="text-align:center;">Staff Turnover </h2>



					<ul class="nav navbar-right panel_toolbox">

						

						<li>

							<a class="collapse-link">

								<i class="fa fa-chevron-up"></i>

							</a>

						</li>

						

						<li class="dropdown">

							<a 

							   href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

								<i class="fa fa-wrench"></i>

							</a>

							

							<ul class="dropdown-menu" role="menu">

								<li>

									<a href="#">Settings 1</a>

								</li>

								<li>

									<a href="#">Settings 2</a>

								</li>

							</ul>

							

						</li>

						

						<li>

							<a class="close-link">

								<i class="fa fa-close"></i>

							</a>

						</li>

						

					</ul>

					<div class="clearfix"></div>

				</div>





				

				

				<div class="x_content">



					<div class="container turnover ">



						<div class="left">

							<h6 class="bold" style="text-align:center">

								New Hire

							</h6>

						</div>

						

						<div class="mid">

							<h6 class="bold" style="text-align:center;">

								Turnover Rate

							</h6>

						</div>



						<div class="right">

							<h6 class="bold" style="text-align:center;">

								Relieved

							</h6>

						</div>

						

					</div>

					

					<div class="container">

						<div id="barVertical" style="height: 300px; width: 100%;"></div>				

					</div>

					

				</div>

			</div>

		</div>







		

		<!--	Compensation	-->

		

		

		

		<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">

			<div class="x_panel fixed_height_400">		

					<div class="x_title">

						<h2 style="text-align: center !important;">Compensation </h2>

						<ul class="nav navbar-right panel_toolbox">

							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

							</li>

							<li class="dropdown">

								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

								<ul class="dropdown-menu" role="menu">



									<li><a href="#">Settings 1</a>



									</li>



									<li><a href="#">Settings 2</a>



									</li>



								</ul>



							</li>



							<li><a class="close-link"><i class="fa fa-close"></i></a>



							</li>



						</ul>



						<div class="clearfix"></div>



					</div>



					<div class="x_content">



						<div id="chartdiv"></div>



					</div>



				</div>



			</div>		









					<!-- slot 1, 2, 3 sql -->

		



					<?



						$current_year = date('Y');

						$start_date = $current_year . '-01-01';

						$end_date = $current_year . '-04-30';



						$query = 'SELECT a.PBI_ID, a.PBI_CODE, e.ESSENTIAL_JOINING_DATE, a.PBI_NAME, a.PBI_DESIGNATION, a.PBI_DEPARTMENT, a.JOB_LOCATION, DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked, a.PBI_MOBILE, e.ESSENTIAL_REPORTING



						FROM personnel_basic_info a, essential_info e



						WHERE a.PBI_ID NOT IN (SELECT i.PBI_ID FROM increment_detail i)



						AND a.PBI_JOB_STATUS = "In Service"



						AND DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$start_date.'" AND "'.$end_date.'"



						AND e.PBI_ID = a.PBI_ID



						GROUP BY a.PBI_ID



						ORDER BY e.ESSENTIAL_JOINING_DATE ASC



					  	LIMIT 9';



						$queryd = mysql_query($query);		



					?>		



						



					<? 



						$current_year = date('Y');

						$start_date = $current_year . '-05-01';

						$end_date = $current_year . '-08-30';



						$query2 = 'SELECT a.PBI_ID, a.PBI_CODE, e.ESSENTIAL_JOINING_DATE, a.PBI_NAME, a.PBI_DESIGNATION, a.PBI_DEPARTMENT, a.JOB_LOCATION, DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked, a.PBI_MOBILE, e.ESSENTIAL_REPORTING



						FROM personnel_basic_info a, essential_info e



						WHERE a.PBI_ID NOT IN (SELECT i.PBI_ID FROM increment_detail i)



						AND a.PBI_JOB_STATUS = "In Service"



						AND DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$start_date.'" AND "'.$end_date.'"



						AND e.PBI_ID = a.PBI_ID



						GROUP BY a.PBI_ID



						ORDER BY e.ESSENTIAL_JOINING_DATE ASC



					  	LIMIT 9';



						$queryd2 = mysql_query($query2);



					?>



					



					<?



						$current_year = date('Y');

						$start_date = $current_year . '-09-01';

						$end_date = $current_year . '-12-30';



						$query3 = 'SELECT a.PBI_ID, a.PBI_CODE, e.ESSENTIAL_JOINING_DATE, a.PBI_NAME, a.PBI_DESIGNATION, a.PBI_DEPARTMENT, a.JOB_LOCATION, DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked, a.PBI_MOBILE, e.ESSENTIAL_REPORTING



						FROM personnel_basic_info a, essential_info e



						WHERE a.PBI_ID NOT IN (SELECT i.PBI_ID FROM increment_detail i)



						AND a.PBI_JOB_STATUS = "In Service"



						AND DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$start_date.'" AND "'.$end_date.'"



						AND e.PBI_ID = a.PBI_ID



						GROUP BY a.PBI_ID



						ORDER BY e.ESSENTIAL_JOINING_DATE ASC



					  	LIMIT 9';



						$queryd3 = mysql_query($query3);	

					?>



					<!-- sql End -->







	<div class="col-md-12 col-sm-12 col-xs-12">



		<div  style="background-color: #f9f9f9; height: 400px ">



			<div class="x_title">



				<h2>Increment Notification </h2>



					<ul class="nav navbar-right panel_toolbox">



						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>



						</li>



						<li class="dropdown">



							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>



							<ul class="dropdown-menu" role="menu">



								<li><a href="#">Settings 1</a>



								</li>



								<li><a href="#">Settings 2</a>



								</li>



							</ul>



						</li>



						<li><a class="close-link"><i class="fa fa-close"></i></a>



						</li>



					</ul>



					<div class="clearfix"></div>



				</div>















					



				<div class="x_content" style=" border: 0 1px solid green 0 1px solid green">







				<div class="col-sm-12 col-md-12 col-lg-12">



					<div class="row">



					  <div class="col-sm-4">



						<h2 style="text-align: center">SLOT-I</h2>



					  </div>



					  <div class="col-sm-4">



						<h2 style="text-align: center">SLOT-II</h2>



					  </div>



					  <div class="col-sm-4">



						<h2 style="text-align: center">SLOT-III</h2>



					  </div>







					



																		



				<!-- slot 1  -->



					



				<div class="col-sm-4">



					  <div class="container" style="border: 1px solid green; background-color: #ffff; border-radius: 5px; padding: 5px;">



						<div class="row" style="margin: 0; padding: 0;">



						  <?php while ($data = mysql_fetch_object($queryd)) { ?>



							<div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1 card_animation">



							  <?php



							  $imgJPG = "../../pic/staff/" . $data->PBI_ID . ".JPG";



							  $imgjpg = "../../pic/staff/" . $data->PBI_ID . ".jpg";



							  $imgPNG = "../../pic/staff/" . $data->PBI_ID . ".PNG";



							  $imgJPEG = "../../pic/staff/" . $data->PBI_ID . ".jpeg";



							  $imgpng2 = "../../pic/staff/" . $data->PBI_ID . ".png";







							  if (file_exists($imgJPEG)) {



								$link = $imgJPEG;



							  } elseif (file_exists($imgJPG)) {



								$link = $imgJPG;



							  } elseif (file_exists($imgjpg)) {



								$link = $imgjpg;



							  } elseif (file_exists($imgJPEG)) {



								$link = $imgJPEG;



							  } elseif (file_exists($imgpng2)) {



								$link = $imgpng2;



							  } else {



								$link = '';



							  }



							  if (file_exists($link)) { ?>



								<img src="<?=$link?>" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;" />



							  <?php } else { ?>



								<img src="images.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;"/>



							  <?php } ?>



							  <h5 class="bold" style="margin: 0px; padding: 0px; text-align: center; font-size: 9px;"><?=substr_replace($data->PBI_NAME, "..", 10);?>



							  <br />



								<span style="font-size: 8px;"><?=date("F j", strtotime($data->ESSENTIAL_JOINING_DATE));?></span>



							  </h5>



							</div>



						  <?php } ?>



							



						  <?php if (mysql_num_rows($queryd) < 9) { ?>



							<?php for ($i = mysql_num_rows($queryd); $i < 9; $i++) { ?>



							  <div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1">



								<img src="null.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;"/>



								<h5 class="bold" style="margin: 0px; padding: 5px; text-align: center; font-size: 9px;">NULL</h5>



							  </div>



							<?php } ?>



							



						  <?php } ?>



						</div>



						  



						<div class="col-sm-12" align="center" style="padding-top: 10px; padding-bottom: 10px;">

							

						<form action="../report/master_report.php" target="_blank" method="post">

						  <input type="hidden" name="month" value="<?= date('n') ?>">

						  <input type="hidden" name="year" value="<?= date('Y') ?>">

						  <a>

							<button name="report" value="1446" style="font-size: 8px;" class="button-style">View All</button>

						  </a>

						</form>



						</div>



					  </div>



					</div>



















			<!-- slot 2  -->



					



						



					



			<div class="col-sm-4">



			  <div class="container"  style="border: 1px solid green; background-color: #ffff; border-radius: 5px; padding: 5px;">



				<div class="row" style="margin: 0; padding: 0;">



				  <?php while ($data = mysql_fetch_object($queryd2)) { ?>



					<div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1 card_animation">



					  <?php



					  $imgJPG = "../../pic/staff/" . $data->PBI_ID . ".JPG";



					  $imgjpg = "../../pic/staff/" . $data->PBI_ID . ".jpg";



					  $imgPNG = "../../pic/staff/" . $data->PBI_ID . ".PNG";



					  $imgJPEG = "../../pic/staff/" . $data->PBI_ID . ".jpeg";



					  $imgpng2 = "../../pic/staff/" . $data->PBI_ID . ".png";







					  if (file_exists($imgJPEG)) {



						$link = $imgJPEG;



					  } elseif (file_exists($imgJPG)) {



						$link = $imgJPG;



					  } elseif (file_exists($imgjpg)) {



						$link = $imgjpg;



					  } elseif (file_exists($imgJPEG)) {



						$link = $imgJPEG;



					  } elseif (file_exists($imgpng2)) {



						$link = $imgpng2;



					  } else {



						$link = '';



					  }



					  if (file_exists($link)) { ?>



						<img src="<?=$link?>" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;" />



					  <?php } else { ?>



						<img src="images.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;"/>



					  <?php } ?>



					  <h5 class="bold" style="margin: 0px; padding: 0px; text-align: center; font-size: 9px;">



						<?=substr_replace($data->PBI_NAME, "..", 10);?>



						<br />



						<span style="font-size: 8px;"><?=date("F j", strtotime($data->ESSENTIAL_JOINING_DATE));?></span>



					  </h5>



					</div>



				  <?php } ?>







				  <?php if (mysql_num_rows($queryd2) < 9) { ?>



					<?php for ($i = mysql_num_rows($queryd2); $i < 9; $i++) { ?>



					  <div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1">



						<img src="null.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;" />



						<h5 class="bold" style="margin: 0px; padding: 5px; text-align: center; font-size: 9px;">NULL</h5>



					  </div>



					<?php } ?>



				  <?php } ?>



				</div>







				<div class="col-sm-12" align="center" style="padding-top: 10px; padding-bottom: 10px;">



					<form action="../report/master_report.php" target="_blank" method="post">

						<input type="hidden" name="month" value="<?= date('n') ?>">

						<input type="hidden" name="year" value="<?= date('Y') ?>">

						  <a>

							<button name="report" value="1447" style="font-size: 8px;" class="button-style">View All</button>

						  </a>

					</form>



				</div>



			  </div>



			</div>







							







					



			<!-- slot 3  -->



						











				<div class="col-sm-4" >



					<div class="container" style="border: 1px solid green; background-color: #ffff; border-radius: 5px; padding: 5px;">



						<div class="row" style="margin:0; padding:0;">



							



							



							<? while($data = mysql_fetch_object($queryd3)){ ?>



						



							<div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1 card_animation">



								



								<?







								$imgJPG = "../../pic/staff/" . $data->PBI_ID . ".JPG";







								$imgjpg = "../../pic/staff/" . $data->PBI_ID . ".jpg";







								$imgPNG = "../../pic/staff/" . $data->PBI_ID . ".PNG";







								$imgJPEG = "../../pic/staff/" . $data->PBI_ID . ".jpeg";







								$imgpng2 = "../../pic/staff/" . $data->PBI_ID . ".png";











								if (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgJPG)) {







									$link = $imgJPG;







								} elseif (file_exists($imgjpg)) {







									$link = $imgjpg;







								} elseif (file_exists($imgJPEG)) {







									$link = $imgJPEG;







								} elseif (file_exists($imgpng2)) {







									$link = $imgpng2;







								} else $link = '';







								if (file_exists($link)) { ?>







								<img src="<?=$link?>" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;" />







								<? } else { ?>







								<img src="images.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;"/>











								<? } ?>



								



																		



								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:9px;">



								<?=substr_replace($data->PBI_NAME, "...", 12);?>



								<br />







								<span style="font-size:8px;"><?=date("F j", strtotime($data->ESSENTIAL_JOINING_DATE));?></span>







								</h5>







							</div>	







							<? } ?> 								







							<?php if (mysql_num_rows($queryd3) < 9) { ?>



							<?php for ($i = mysql_num_rows($queryd3); $i < 9; $i++) { ?>



							  <div class="col-sm-4 col-lg-4 col-md-4 pt-1 pb-1">



								<img src="null.png" style="border-radius: 50%;height:60px;width: 100%; padding: 0px 10px;" />



								<h5 class="bold" style="margin: 0px; padding: 5px; text-align: center; font-size: 9px;">NULL</h5>



							  </div>



							<?php } ?>



						  <?php } ?>



						</div>



							







						<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">



						<form action="../report/master_report.php" target="_blank" method="post">

							

						  	<input type="hidden" name="month" value="<?= date('n') ?>">

						  	<input type="hidden" name="year" value="<?= date('Y') ?>">

							  <a>

								<button name="report" value="1448" style="font-size: 8px;" class="button-style">View All</button>

							  </a>

						</form>



						</div>



						



					</div>



				</div>



			</div>



			</div>				



		</div>



	





<!-- Employee By Department & Project  -->







	<?php			



		$sqld = "SELECT PBI_DEPARTMENT, count(PBI_ID) as tot_emp

		FROM personnel_basic_info 

		WHERE PBI_JOB_STATUS = 'In Service' GROUP BY PBI_DEPARTMENT order by PBI_DEPARTMENT asc";



		$queryd = mysql_query($sqld);

		 // Array to store labels for the chart

		$_COOKIE[] = []; // Array to store data for the chart





		while ($dataRow = mysql_fetch_object($queryd)) {



			

			

				$label = find_a_field('department', 'dep_sort_name_chart', 'DEPT_ID='.$dataRow->PBI_DEPARTMENT);

			

			

			

				$name[] = $label; 

				$data[] = $dataRow->tot_emp;

			

			

		}



	?>













<script>

	

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

		   labels: <?=json_encode($name) ?>,

            

            datasets: [{

			    

                label: 'Employee',

                data: <?=json_encode($data)?>,

                borderWidth: 5

            }]

        },

			  

			  



        options: {

            indexAxis: 'y', // Display labels on the y-axis

            plugins: {

                legend: {

                    display: false // Hide the legend

                }

            },



            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        stepSize: 2 // Adjust the step size of the y-axis as needed

                    }

                },



                x: {

                    maxBarThickness: 20, // Adjust the maximum bar thickness as needed

                }

            },



            layout: {

                padding: {

                    left: 30, // Adjust the left padding as needed

                    right: 30 // Adjust the right padding as needed

                }

            }

        }

    });

	



</script>



























<!--  Staff Turnover  -->















<script>



    window.onload = function() {



        var chart = new CanvasJS.Chart("barVertical", {



            animationEnabled: true,



            toolTip: {



                shared: true



            },



            legend: {



                cursor: "pointer",



                itemclick: toggleDataSeries



            },



            data: [



                {



                    type: "column",



                    name: "New Hire",



                    legendText: "New Hire",



                    showInLegend: true,



                    dataPoints: <?php echo json_encode(fetchDataPoints("join")); ?>



                },



                {



                    type: "column",



                    name: "Turnover Rate",



                    legendText: "Turnover",



                    axisYType: "secondary",



                    showInLegend: true,



                    dataPoints: <?php echo json_encode(fetchTurnoverDataPoints()); ?>



                },



                {



                    type: "column",



                    name: "Relieved",



                    legendText: "Relieved",



                    axisYType: "secondary",



                    showInLegend: true,



                    dataPoints: <?php echo json_encode(fetchDataPoints("resign")); ?>



                }



            ]



        });







        chart.render();







        function toggleDataSeries(e) {



            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {



                e.dataSeries.visible = false;



            } else {



                e.dataSeries.visible = true;



            }



            chart.render();



        }



    }



</script>







<?php

	function fetchDataPoints($type) {

		// Get the current year

		$currentYear = date('Y');

		// Initialize an array to store the data

		$dataPoints = array();

		

		// Fetch data for joining or resigning based on the type

		$columnName = ($type == "join") ? "ESSENTIAL_JOINING_DATE" : "ESSENTIAL_RESIG_DATE";

		$dataField = ($type == "join") ? "New Hire" : "Relieved";

		

		$query = "SELECT MONTH($columnName) AS month, COUNT(*) AS total

				  FROM essential_info

				  WHERE YEAR($columnName) = $currentYear

				  GROUP BY MONTH($columnName)";

		

		$result = mysql_query($query);

		// Initialize an array to store the monthly data

		$monthlyData = array_fill(1, 12, 0);

		

		while ($row = mysql_fetch_assoc($result)) {

			$month = $row['month'];

			$data = $row['total'];

			// Store the data in the monthly array

			$monthlyData[$month] = $data;

		}

		

		// Generate the dataPoints array

		foreach ($monthlyData as $month => $data) {

			$dataPoints[] = array(

				'label' => date('M', mktime(0, 0, 0, $month, 1)),

				'y' => $data

			);

		}

		return $dataPoints;

	}

			

			



	function fetchTurnoverDataPoints() {

		// Get the current year

		$currentYear = date('Y');

		// Initialize an array to store the data

		$dataPoints = array();

		

		// Fetch data for joining and resigning

		$query = "SELECT MONTH(ESSENTIAL_JOINING_DATE) AS month, COUNT(*) AS total_joining

				  FROM essential_info

				  WHERE YEAR(ESSENTIAL_JOINING_DATE) = $currentYear

				  GROUP BY MONTH(ESSENTIAL_JOINING_DATE)";

		

		$result = mysql_query($query);

		// Initialize an array to store the joining data

		$joiningData = array_fill(1, 12, 0);

		while ($row = mysql_fetch_assoc($result)) {

			$month = $row['month'];

			$totalJoining = $row['total_joining'];

			// Store the data in the joining array

			$joiningData[$month] = $totalJoining;

		}

		

		// Fetch data for resigning

		$query = "SELECT MONTH(ESSENTIAL_RESIG_DATE) AS month, COUNT(*) AS total_resign

				  FROM essential_info

				  WHERE YEAR(ESSENTIAL_RESIG_DATE) = $currentYear

				  GROUP BY MONTH(ESSENTIAL_RESIG_DATE)";

		

		$result = mysql_query($query);

		while ($row = mysql_fetch_assoc($result)) {

			$month = $row['month'];

			$totalResign = $row['total_resign'];

			

			// Calculate the turnover rate for the month

			if (isset($joiningData[$month])) {

				$turnoverRate = ($totalResign / $joiningData[$month]) * 100;

				$turnoverRate = round($turnoverRate, 2);

			} else {

				$turnoverRate = 0;

			}

			

			// Store the data in the array

			$dataPoints[] = array(

				'label' => date('M', mktime(0, 0, 0, $month, 1)),

				'y' => $turnoverRate

			);

		}

		return $dataPoints;

	}

?>



















<!--  Compensation  -->







<?



	$jan_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=1 and pay>0 and  year="'.date("Y").'" ');



	$feb_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=2 and pay>0 and  year="'.date("Y").'" ');



	$mar_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=3 and pay>0 and  year="'.date("Y").'" ');



	$apr_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=4 and pay>0 and  year="'.date("Y").'" ');



	$may_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=5 and pay>0 and  year="'.date("Y").'" ');



	$jun_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=6 and pay>0 and  year="'.date("Y").'" ');



	$jul_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=7 and pay>0 and  year="'.date("Y").'" ');



	$aug_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=8 and pay>0 and  year="'.date("Y").'" ');



	$sep_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=9 and pay>0 and  year="'.date("Y").'" ');



	$oct_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=10 and pay>0 and  year="'.date("Y").'" ');



	$nov_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=11 and pay>0 and  year="'.date("Y").'" ');



	$dec_pay = find_a_field('salary_attendence_lock','sum(total_earning)','mon=12 and pay>0 and  year="'.date("Y").'" ');



?>











<script>



 var chart;



	var graph;



	var categoryAxis;



	var chartData = [{







			"country": "Jan",



			"visits": <? if($jan_pay>0) {echo $jan_pay;}



						else {echo $jan_pay=0;}?>,



			"color": "#FF0F00"



		},



		{



			"country": "Feb",



			"visits": <? if($feb_pay>0) {echo $feb_pay;}



						else {echo $feb_pay=0;}?>,



			"color": "#FF6600"



		},



		{



			"country": "Mar",



			"visits": <? if($mar_pay>0) {echo $mar_pay;}



						else {echo $mar_pay=0;}?>,



			"color": "#FF9E01"



		},



		{



			"country": "Apr",



			"visits": <? if($apr_pay>0) {echo $apr_pay;}



						else {echo $apr_pay=0;}?>,



			"color": "#FCD202"



		},



		{



			"country": "May",



			"visits": <? if($may_pay>0) {echo $may_pay;}



						else {echo $may_pay=0;}?>,



			"color": "#F8FF01"



		},



		{



			"country": "Jun",



			"visits": <? if($jun_pay>0) {echo $jun_pay;}



						else {echo $jun_pay=0;}?>,



			"color": "#B0DE09"



		},



		{



			"country": "Jul",



			"visits": <? if($jul_pay>0) {echo $jul_pay;}



						else {echo $jul_pay=0;}?>,



			"color": "#04D215"



		},



		{



			"country": "Aug",



			"visits": <? if($aug_pay>0) {echo $aug_pay;}



						else {echo $aug_pay=0;}?>,



			"color": "#0D8ECF"



		},



		{



			"country": "Sep",



			"visits": <? if($sep_pay>0) {echo $sep_pay;}



						else {echo $sep_pay=0;}?>,



			"color": "#0D52D1"



		},



		{



			"country": "Oct",



			"visits": <? if($oct_pay>0) {echo $oct_pay;}



						else {echo $oct_pay=0;}?>,



			"color": "#2A0CD0"



		},



		{



			"country": "Nov",



			"visits": <? if($nov_pay>0) {echo $nov_pay;}



						else {echo $nov_pay=0;}?>,



			"color": "#8A0CCF"



		},



			



		{



			"country": "Dec",



			"visits": <? if($dec_pay>0) {echo $dec_pay;}



						else {echo $dec_pay=0;}?>,



			"color": "#CD0D74"







		}



	];



    







  AmCharts.ready(function() {



    chart = new AmCharts.AmSerialChart();



    chart.dataProvider = chartData;



    chart.categoryField = "country";



    chart.position = "left";



    chart.angle = 30;



    chart.depth3D = 15;



    chart.startDuration = 1;



    categoryAxis = chart.categoryAxis;



    categoryAxis.labelRotation = 45;



    categoryAxis.dashLength = 5;



    categoryAxis.gridPosition = "start";



    categoryAxis.autoGridCount = false;



    categoryAxis.gridCount = chartData.length;



    graph = new AmCharts.AmGraph();



    graph.valueField = "visits";



    graph.type = "column";



    graph.colorField = "color";



    graph.lineAlpha = 0;



    graph.fillAlphas = 0.8;



    graph.balloonText = "[[category]]: <b>[[value]]</b>";



    chart.addGraph(graph);



    chart.write('chartdiv');



  });



</script>



















<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>







<?php include_once("../../template/footer.php"); ?>



