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

<?php /*?>require "../../template/header.php";
require "../../template/sidebar.php";<?php */ ?>

<?php
$dataPoints1 = array(
	array("label" => "january", "y" => 36.12),
	array("label" => "February", "y" => 34.87),
	array("label" => "March", "y" => 40.30),
	array("label" => "April", "y" => 35.30),
	array("label" => "May", "y" => 39.50),
	array("label" => "June", "y" => 50.82),
	array("label" => "July", "y" => 74.70),
	array("label" => "Aguest", "y" => 84.70),
	array("label" => "September", "y" => 21.70)
);
$dataPoints2 = array(
	array("label" => "january", "y" => 64.61),
	array("label" => "February", "y" => 70.55),
	array("label" => "March", "y" => 72.50),
	array("label" => "April", "y" => 81.30),
	array("label" => "May", "y" => 63.60),
	array("label" => "June", "y" => 69.38),
	array("label" => "July", "y" => 98.70),
	array("label" => "Aguest", "y" => 38.70),
	array("label" => "September", "y" => 14.70)
);
?>

<script>
	window.onload = function() {
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light2",
			title: {
				text: ""
			},
			legend: {
				cursor: "pointer",
				verticalAlign: "center",
				horizontalAlign: "right",
				itemclick: toggleDataSeries
			},
			data: [{
				type: "column",
				name: "Total Salary",
				indexLabel: "{y}",
				yValueFormatString: "$#0.##",
				showInLegend: true,
				dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
			}, {
				type: "column",
				name: "Total Emp",
				indexLabel: "{y}",
				yValueFormatString: "$#0.##",
				showInLegend: true,
				dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
			}]
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


<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css">
<script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>


<style>
	body .container.body .right_col {
		background: #ffffff !important;
	}

	.tile_count {
		margin-top: 85px !important;
	}

	.tile_stats_count {
		background-color: #51cda0 !important;
		/*background-color:#1defbe !important;*/
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
		font-size: 16px;
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
		background-color: #72db97;
		padding: 5px;
	}

	.turnover .mid {
		float: right;
		width: 33%;
		background-color: #c3b72f;
		padding: 5px;
	}

	.turnover .right {
		float: right;
		width: 33%;
		background-color: #ed2251;
		padding: 5px;
	}

	.x_content {
		padding: 0px;
	}

	#barVertical .canvasjs-chart-container canvas {
		height: 200px !important;
		width: 100% !important;
	}


	@import "compass/css3";

	body {
		font-family: Tahoma, Arial, Verdana;
		font-size: 12px;
		color: black;
	}

	#chartdiv {
		width: 640px;
		height: 400px;
	}
</style>

<!-- page content -->
<div class="right_col" role="main">
	<!-- top1 tiles start -->

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
						echo $num_rows; ?>
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

	<div class="row">
		<div class="col-md-5 col-sm-5 col-xs-12">
			<div class="x_panel fixed_height_320">
				<div class="x_title">
					<h2>Upcoming Birthday </h2>
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
					<div class="container">
						<div class="row" style="margin:0; padding:0;">
							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Tanvir
									<br />
									<span style="font-size:10px;"> Today</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Rahul
									<br />
									<span style="font-size:10px;"> Next day</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Ruhi
									<br />
									<span style="font-size:10px;"> May 15</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Runa
									<br />
									<span style="font-size:10px;"> May 19</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Tanvir
									<br />
									<span style="font-size:10px;"> Today</span>
								</h5>
							</div>


							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Rahul
									<br />
									<span style="font-size:10px;"> Next day</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Ruhi
									<br />
									<span style="font-size:10px;"> May 15</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Runa
									<br />
									<span style="font-size:10px;"> May 19</span>
								</h5>
							</div>
						</div>
						<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">
							<button style="font-weight:bold; width:40%;">View All </button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
			<div class="x_panel fixed_height_320">
				<div class="x_title">
					<h2>Joining Anniversary </h2>
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
					<div class="container">
						<div class="row" style="margin:0; padding:0;">
							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Tanvir
									<br />
									<span style="font-size:10px;"> Today</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Rahul
									<br />
									<span style="font-size:10px;"> Next day</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Ruhi
									<br />
									<span style="font-size:10px;"> May 15</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Runa
									<br />
									<span style="font-size:10px;"> May 19</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Tanvir
									<br />
									<span style="font-size:10px;"> Today</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Rahul
									<br />
									<span style="font-size:10px;"> Next day</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Ruhi
									<br />
									<span style="font-size:10px;"> May 15</span>
								</h5>
							</div>

							<div class="col-sm-3">
								<img src="images.png" width="100%" height="100%" style="border-radius: 50%;" />
								<h5 class="bold" style="margin:0px; padding:0px; text-align:center; font-size:14px;">Runa
									<br />
									<span style="font-size:10px;"> May 19</span>
								</h5>
							</div>
						</div>
						<div class="col-sm-12" align="center" style="padding-top:10px; padding-bottom:10px;">
							<button style="font-weight:bold; width:40%;">View All </button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Notification </h2>
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
					<button style="font-weight:bold; width:100%;">Probation Period Notification </br> <span style="color:#FF0000;">(3)</span></button>
					<button style="font-weight:bold; width:100%;">Probation Period Completion </br> <span style="color:#FF0000;">(4)</span></button>
					<button style="font-weight:bold; width:100%;">3 Months Notification </br> <span style="color:#FF0000;">(1)</span></button>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel">

				<div class="x_title">
					<h2>Employee by Department & Project</h2>
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
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>



		<!--<div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                	<div class="x_title">

						<h2>Employee by Department & Project</h2>
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
						<canvas id="myChart"></canvas>					                
        			</div>
    		</div>
		</div>

-->

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel fixed_height_320">

				<div class="x_title">
					<h2>Recruitment Progress</h2>
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
					<div class="clearfix">
					</div>
				</div>

				<div class="x_content">
					<table class="table table-bordered">
						<thead>
							<tr bgcolor="#51cda0">
								<th align="center">Department</th>
								<th align="center">Position </th>
								<th align="center">Interview Date </th>
								<th align="center">Status </th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>Audit </td>
								<td>Executive, Audit </td>
								<td>10/29/2022 </td>
								<td>Active </td>
							</tr>
							<tr>
								<td>Marketing & Barnd </td>
								<td>Graphic Designer </td>
								<td>10/30/2022 </td>
								<td>Pending </td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>







	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel fixed_height_320">

				<div class="x_title">
					<h2>Staff Turnover </h2>
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
								New Hire (2)
							</h6>
						</div>
						<div class="mid">
							<h6 class="bold" style="text-align:center;">
								Turnover Rate %
							</h6>
						</div>
						<div class="right">
							<h6 class="bold" style="text-align:center;">
								Relieved (3)
							</h6>
						</div>
					</div>
					<div class="container">
						<div id="barVertical" style="height: 300px; width: 100%;"></div>
					</div>
				</div>
			</div>



			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Compensation </h2>
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
		</div>
	</div>
</div>




<!--///////////////////////////3//////////////////////-->
<script>
	var chart;
	var graph;
	var categoryAxis;

	var chartData = [{
			"country": "USA",
			"visits": 4252,
			"color": "#FF0F00"
		},
		{
			"country": "China",
			"visits": 1882,
			"color": "#FF6600"
		},
		{
			"country": "Japan",
			"visits": 1809,
			"color": "#FF9E01"
		},
		{
			"country": "Germany",
			"visits": 1322,
			"color": "#FCD202"
		},
		{
			"country": "UK",
			"visits": 1122,
			"color": "#F8FF01"
		},
		{
			"country": "France",
			"visits": 1114,
			"color": "#B0DE09"
		},
		{
			"country": "India",
			"visits": 984,
			"color": "#04D215"
		},
		{
			"country": "Spain",
			"visits": 711,
			"color": "#0D8ECF"
		},
		{
			"country": "Netherlands",
			"visits": 665,
			"color": "#0D52D1"
		},
		{
			"country": "Russia",
			"visits": 580,
			"color": "#2A0CD0"
		},
		{
			"country": "South Korea",
			"visits": 443,
			"color": "#8A0CCF"
		},
		{
			"country": "Canada",
			"visits": 441,
			"color": "#CD0D74"
		},
		{
			"country": "Brazil",
			"visits": 395,
			"color": "#754DEB"
		},
		{
			"country": "Italy",
			"visits": 386,
			"color": "#DDDDDD"
		},
		{
			"country": "Australia",
			"visits": 384,
			"color": "#999999"
		},
		{
			"country": "Taiwan",
			"visits": 338,
			"color": "#333333"
		},
		{
			"country": "Poland",
			"visits": 328,
			"color": "#000000"
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
		categoryAxis.dashLength = 5; //
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






<!--///////////////////////////2////////////////////// -->





<!--///////////////////////////3nd//////////////////////-->
<script>
	window.onload =
		function() {
			var
				chart =
				new
			CanvasJS.Chart("barVertical", {
				animationEnabled: true,
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					itemclick: toggleDataSeries
				},
				data: [{
						type: "column",
						name: "New
						Hire ",
						legendText: "New
						Hire ",
						showInLegend: true,
						dataPoints: [{
								label: "Jan",
								y: 2
							},
							{
								label: "Feb",
								y: 2
							},
							{
								label: "Mar",
								y: 3
							},
							{
								label: "Apr",
								y: 5
							},
							{
								label: "May",
								y: 6
							},
							{
								label: "Jun",
								y: 8
							},
							{
								label: "Jul",
								y: 6
							},
							{
								label: "Aug",
								y: 4
							},
							{
								label: "Sep",
								y: 5
							},
							{
								label: "Oct",
								y: 6
							},
							{
								label: "Nov",
								y: 5
							},
							{
								label: "Dec",
								y: 6
							}
						]
					},
					{
						type: "column",
						name: "Relieved",
						legendText: "Relieved",
						axisYType: "secondary",
						showInLegend: true,
						dataPoints: [{
								label: "Jan",
								y: 2
							},
							{
								label: "Feb",
								y: 1
							},
							{
								label: "Mar",
								y: 0
							},
							{
								label: "Apr",
								y: 1
							},
							{
								label: "May",
								y: 0
							},
							{
								label: "Jun",
								y: 1
							},
							{
								label: "Jul",
								y: 0
							},
							{
								label: "Aug",
								y: 2
							},
							{
								label: "Sep",
								y: 0
							},
							{
								label: "Oct",
								y: 3
							},
							{
								label: "Nov",
								y: 1
							},
							{
								label: "Dec",
								y: 0
							}
						]
					}
				]
			});
			chart.render();

			function
			toggleDataSeries(e) {
				if (typeof(e.dataSeries.visible) ===
					"undefined" ||
					e.dataSeries.visible) {
					e.dataSeries.visible =
						false;
				} else {
					e.dataSeries.visible =
						true;
				}
				chart.render();
			}
		}
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php include_once("../../template/footer.php"); ?>