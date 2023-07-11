<?php

session_start();

ob_start();

require "../../config/inc.all.php";



require "../../template/main_layout.php";

$title='Inventory Home Page';





  if($_GET['PBI_ID']>0){

      $_SESSION['employee_selected']=$_GET['PBI_ID'];

	  header('Location:../hrm/employee_essential_information.php');

  }

  

   $today_date = date('Y-m-d');

  $select = 'select * from transfer_detail where status=0 and TRANSFER_AFFECT_DATE<="'.$today_date.'"';

  $query = mysql_query($select);

  while($dd = mysql_fetch_object($query )){

     

	  if($dd->PBI_ID>0){

      //$up = 'INSERT INTO `transfer_detail`(`TRANSFER_ORDER_NO`, `TRANSFER_ORDER_DATE`, `TRANSFER_AFFECT_DATE`, `TRANSFER_NEW_REPORTING_AUTH`, `TRANSFER_PAST_REPORTING_AUTH`, `TRANSFER_NEW_DEPT`, `TRANSFER_PRESENT_DEPT`, `TRANSFER_NEW_PROJECT`, `TRANSFER_PAST_PROJECT`, `ESSENTIAL_REPORTING`,`PBI_ID`) VALUES ("'.$dd->TRANSFER_ORDER_NO.'","'.$dd->TRANSFER_ORDER_DATE.'","'.$dd->TRANSFER_AFFECT_DATE.'","'.$dd->TRANSFER_NEW_REPORTING_AUTH.'","'.$dd->TRANSFER_PAST_REPORTING_AUTH.'","'.$dd->TRANSFER_NEW_DEPT.'","'.$dd->TRANSFER_PRESENT_DEPT.'","'.$dd->TRANSFER_NEW_PROJECT.'","'.$dd->TRANSFER_PAST_PROJECT.'","'.$dd->ESSENTIAL_REPORTING.'","'.$dd->PBI_ID.'")';

	 // mysql_query($up);

	  



$updatee1 = 'update personnel_basic_info set PBI_DEPARTMENT="'.$dd->TRANSFER_NEW_DEPT.'",JOB_LOCATION="'.$dd->TRANSFER_NEW_PROJECT.'" where PBI_ID="'.$dd->PBI_ID.'"';

mysql_query($updatee1);





$updatee2 = 'update essential_info set ESS_DEPARTMENT="'.$dd->TRANSFER_NEW_DEPT.'",ESSENTIAL_PROJECT="'.$dd->TRANSFER_NEW_PROJECT.'",ESSENTIAL_REPORTING="'.$dd->TRANSFER_NEW_REPORTING_AUTH.'" where PBI_ID="'.$dd->PBI_ID.'"';

mysql_query($updatee2);





$updatee3 = 'update transfer_detail set status=1 where PBI_ID="'.$dd->PBI_ID.'" and TRANSFER_AFFECT_DATE="'.$dd->TRANSFER_AFFECT_DATE.'"';

mysql_query($updatee3);



/*$update4 = 'update hrm_leave_info set PBI_IN_CHARGE="'.$dd->TRANSFER_NEW_REPORTING_AUTH.'", reporting_auth="'.$dd->TRANSFER_NEW_REPORTING_AUTH.'" where incharge_status in ("Not Approve","Pending") and leave_status in ("Pending","PENDING") and PBI_ID="'.$dd->PBI_ID.'"';

mysql_query($update4); 

*/

	  }

  }





?>







<?php /*?>require "../../template/header.php";

require "../../template/sidebar.php";<?php */?>







<?php

 

$dataPoints1 = array(

	array("label"=> "january", "y"=> 36.12),

	array("label"=> "February", "y"=> 34.87),

	array("label"=> "March", "y"=> 40.30),

	array("label"=> "April", "y"=> 35.30),

	array("label"=> "May", "y"=> 39.50),

	array("label"=> "June", "y"=> 50.82),

	array("label"=> "July", "y"=> 74.70),

	array("label"=> "Aguest", "y"=> 84.70),

	array("label"=> "September", "y"=> 21.70)

);

$dataPoints2 = array(

	array("label"=> "january", "y"=> 64.61),

	array("label"=> "February", "y"=> 70.55),

	array("label"=> "March", "y"=> 72.50),

	array("label"=> "April", "y"=> 81.30),

	array("label"=> "May", "y"=> 63.60),

	array("label"=> "June", "y"=> 69.38),

	array("label"=> "July", "y"=> 98.70),

	array("label"=> "Aguest", "y"=> 38.70),

	array("label"=> "September", "y"=> 14.70)

);

	

?>



 

  <script>

window.onload = function () {

 

var chart = new CanvasJS.Chart("chartContainer", {

	animationEnabled: true,

	theme: "light2",

	title:{

		text: ""

	},

	legend:{

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

	},{

		type: "column",

		name: "Total Emp",

		indexLabel: "{y}",

		yValueFormatString: "$#0.##",

		showInLegend: true,

		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>

	}]

});

chart.render();

 

function toggleDataSeries(e){

	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {

		e.dataSeries.visible = false;

	}

	else{

		e.dataSeries.visible = true;

	}

	chart.render();

}

 

}

</script>











        <!-- page content -->

        <div class="right_col" role="main">

          <!-- top tiles -->

		  

          <div class="row tile_count">

		  

		  <div style="background:#17A2B8; height:auto; width:100%;">

		 

		  

		   <?

		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';

			 $pro_query = mysql_query($pro);

			



			 

		   ?>

		    

			 <div style="color:white; font-size:15px; font-weight:bold; text-align:center">Probation Period Notification</div>

	
		  
		  
		  
		  
		  
		 
		  
		  
		  
		  	  <marquee  onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">

		    <?  while($pro_data = mysql_fetch_object($pro_query)){

			    

				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));
				
				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 

	

		      $interval->format("%Y Year, %M Months, %d Days");

		      $total_service_days = $interval->format('%a'); 

		     if($total_service_days>150  && $total_service_days<=180 ){

			 ?>

		  <a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#fff; font-size:14px; font-weight:bold;" name="probation"><?=$pro_data->PBI_NAME?>-<?=$desg?>&nbsp;&nbsp;&nbsp;&nbsp;</a>

		  <? } }?>

		  </marquee>
		  
		  
		  
		  
		  
		  
		  

		  </div>
		  
		  
		  
		  
		  <div style="background:#17A2B8; height:auto; width:100%;">

		 

		  

		   <?

		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';

			 $pro_query = mysql_query($pro);

			



			 

		   ?>

		    

			 <div style="color:white; font-size:15px; font-weight:bold; text-align:center">Probation Period Complete</div>

	
		  
		  
		  
		  
		  
		 
		  
		  
		  
		  	  <marquee  onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">

		    <?  while($pro_data = mysql_fetch_object($pro_query)){

			    

				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));
				
				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 

	

		      $interval->format("%Y Year, %M Months, %d Days");

		      $total_service_days = $interval->format('%a'); 

		     if($total_service_days>=180  ){

			 ?>

		  <a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#fff; font-size:14px; font-weight:bold;" name="probation"><?=$pro_data->PBI_NAME?>-<?=$desg?>&nbsp;&nbsp;&nbsp;&nbsp;</a>

		  <? } }?>

		  </marquee>
		  
		  
		  
		  
		  
		  
		  

		  </div>
		  
		  
		  <div style="background:#17A2B8; height:auto; width:100%;">

		 

		  

		   <?

		      $pro = 'select e.EMPLOYMENT_TYPE,a.PBI_ID,a.PBI_DOJ,a.PBI_NAME,a.PBI_DESIGNATION from essential_info e, personnel_basic_info a where 1 and e.PBI_ID=a.PBI_ID and a.PBI_JOB_STATUS="In Service" and e.EMPLOYMENT_TYPE="Probationary"';

			 $pro_query = mysql_query($pro);

			



			 

		   ?>

		    

			 <div style="color:white; font-size:15px; font-weight:bold; text-align:center">3 Months Completion Notification</div>
             <marquee  onmouseover="this.stop();" onmouseout="this.start();" align="right" width="100%">

		    <?  while($pro_data = mysql_fetch_object($pro_query)){

			    

				$interval = date_diff(date_create(date('Y-m-d')), date_create($pro_data->PBI_DOJ));
				
				$desg = find_a_field('designation','DESG_DESC','DESG_ID="'.$pro_data->PBI_DESIGNATION.'"'); 

	

		      $interval->format("%Y Year, %M Months, %d Days");

		      $total_service_days = $interval->format('%a'); 

		     if($total_service_days>80 && $total_service_days<=100 ){

			 ?>

		  <a href="?PBI_ID=<?=$pro_data->PBI_ID?>" style="color:#fff; font-size:14px; font-weight:bold;" name="probation"><?=$pro_data->PBI_NAME?>-<?=$desg?>&nbsp;&nbsp;&nbsp;&nbsp;</a>

		  <? } }?>

		  </marquee>
		  </div>

		  

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Employees</span>

<div class="count"><? 

$sql = "SELECT count(PBI_ID) as total FROM personnel_basic_info".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['total']; 

echo $num_rows;?>



</div>

             

			  

			

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i><a href="btrc_report.php" target="_blank">Btrc Report</a> </span>

           

			

			

            </div>

			

			

			

			 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> In Service</span>

              <div class="count"><? 

$sql = "SELECT count(ESS_JOB_STATUS) FROM essential_info WHERE ESS_JOB_STATUS='In Service' ".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['count(ESS_JOB_STATUS)']; 

echo $num_rows;?></div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i><a href="dashboard_report.php" target="_blank">Employee Password Info</a> </span>

            </div>

			

			

			

			

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-clock-o"></i> Not in Service</span>

              <div class="count"><? 

$sql = "SELECT count(ESS_JOB_STATUS) FROM essential_info WHERE ESS_JOB_STATUS='Not In Service' ".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['count(ESS_JOB_STATUS)']; 

echo $num_rows;?></div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>

              <div class="count green"><? 

$sql = "SELECT count(PBI_SEX) FROM personnel_basic_info WHERE PBI_SEX='Male' and PBI_JOB_STATUS='In Service' ".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['count(PBI_SEX)']; 

echo $num_rows;?></div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>

              <div class="count"><? 

$sql = "SELECT count(PBI_SEX) FROM personnel_basic_info WHERE PBI_SEX='Female' and PBI_JOB_STATUS='In Service' ".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['count(PBI_SEX)']; 

echo $num_rows;?></div>

              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>

            </div>

			

			

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Probationary Period</span>

              

			  <div class="count"><? 

$sql = "SELECT count(ESSENTIAL_JOINING_DATE) FROM essential_info WHERE `ESSENTIAL_JOINING_DATE` > '2022-06-00' ".$con;



$result = mysql_query($sql);

$values = mysql_fetch_assoc($result); 

$num_rows = $values['count(ESSENTIAL_JOINING_DATE)']; 

echo $num_rows;?></div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> <a href="dash_report.php" target="_blank">Employee Info</a></span>

            </div>

			

			

			

			

           

          </div>

		  

		  

		  

		 <div class="row">

              <div class="col-md-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>Weekly Summary <small>Activity shares</small></h2>

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



                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">

                   









<div id="chartContainer" style="height: 370px; width: 100%;"></div>















                    

                    </div>

                  </div>

                </div>

              </div>

            </div>  

		  

		  

		  

		  

		  

		  

		  

		  

		  

		  

		  

       

              </div>

            </div>

          </div>

        </div>

        <!-- /page content -->



        <!-- footer content -->

      

      </div>

    </div>

	

	

	





    



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



<?php include_once("../../template/footer.php"); ?>

