<?php

session_start();

ob_start();

require "../../config/inc.all.php";



require "../../template/main_layout.php";

$title='Inventory Home Page';

echo $_SESSION['user']['module'];



//Mail function start





    $to_date =  date("Y-m-d");

    $found=find_a_field('mail_forwarding','kpi','mail_date>="'.$to_date.'"');

   

	 //$start_date = date("Y-m-d",time()-(7*24*60*60));

	 //$end_date =  date("Y-m-d",time()-(1*24*60*60));

	

if($found==10){ 

  $start_date = date("Y-m-d",time()-(7*24*60*60));

  $end_date =  date("Y-m-d",time()-(1*24*60*60));

  $cdate = strtotime($start_date);

  $edate = strtotime($end_date);

  $week_name = find_a_field('hrm_weeks','week_name','s_date between "'.$start_date.'" and "'.$end_date.'"');

		  

		  $str.='<table width="50%" border="1" cellspacing="0" cellpadding="0" style="font-family:cambria;">

		  <tr align="center">

           <td>SL</td>

		   <td>ID</td>

		   <td>Name</td>

		   <td>Designation</td>

		   <td>Joining Date</td>

		   <td>Grade</td>

		  </tr>

		 </table>';

		  

		  

		  $check = 'select k.*,p.PBI_ID,p.PBI_NAME,p.PBI_DESIGNATION,p.PBI_DOJ from hrm_final_score k, personnel_basic_info p where k.PBI_ID=p.PBI_ID and k.week="1ST WEEK" and k.year="'.date('Y').'"';

		  $query = mysql_query($check);

		 

		  while($data=mysql_fetch_object($query)){

		

		  

		  $str.= '<tr align="center">';

		    $str.= '<td>'.++$i.'</td>';

            $str.= '<td>'.$data->PBI_ID.'</td>';

			$str.= '<td>'.$data->PBI_NAME.'</td>';

			$str.= '<td>'.find_a_field('designation','DESG_DESC','DESG_ID='.$data->PBI_DESIGNATION).'</td>';

			$str.= '<td>'.date('d-M-Y',strtotime($data->PBI_DOJ)).'</td>';

			$str.= '<td>A</td>';

          $str.= '</tr>';

		  

		  }

		  

		  $str.= '</table>';



$mail = find_a_field('personnel_basic_info','PBI_EMAIL','PBI_ID="'.$_GET['id'].'"');

$headers = "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$to = $mail.',bimolerp@gmail.com,tanvir@aksidcorp.com';

$subject = "Weekly KPI Summary Report";

$headers .= "From: AKSID HUMAN RESOURCES<hr@aksidcorp.com>";

mail($to,$subject,$str,$headers);

		

		}

		//Mail function end



?>





<style type="text/css">







.oe_app .oe_app_icon{



display:block;



float: left;



height: 48px;



position: relative;



width: 48px;



}







.oe_app .oe_app_icon img{



display:block;



height: 100%;



width: 100%;



}







.oe_app .oe_app_descr{



font-family:"Open Sans";



margin-left: 64px;



font-weight: 300;



font-size: 17px;



text-decoration:none;



color:#959494;



}







.oe_app_descr{







font-family:"Open Sans";



}











.oe_app .oe_app_name {



    font-size: 18px;



    /*font-weight: 400;*/



	/*text-align:center;*/



    margin-left: 64px;



    margin-top: -4px;



	/*font-family:"Open Sans";*/



	color:#646464;



	



}



.home_table td {



    padding: 2px;



}



.home_table_title {



    color: #617a03;



    font-weight: bold;



}



.home_box1 {



    background: url("../images/h_box_01.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 249px;



}



.home_box2 {



    background: url("../images/h_box_02.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 266px;



}



.home_box3 {



    background: url("../images/h_box_03.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 241px;



}



.home_box4 {



    background: url("../images/h_box_04.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 249px;



}



.home_box5 {



    background: url("../images/h_box_05.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 266px;



}



.home_box6 {



    background: url("../images/h_box_06.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);



    height: 212px;



    width: 241px;



}



.left_report {



    overflow: auto;



}



.oe_app {



    background: none repeat scroll 0 0 whitesmoke;



    border: 1px solid transparent;



    border-radius: 2px;



    box-shadow: 0 0 white;



    box-sizing: border-box;



    color: inherit !important;



    cursor: pointer;



    display: block;



    float: left;



    height: 76px;



    margin: 16px;



    overflow: hidden;



    padding: 16px;



    position: relative;



    text-align: left;



    top: 0;



    transition: all 150ms linear 0s;



    width: 276px;



}



.oe_app:hover {



    border: 1px solid rgba(0, 0, 0, 0.1);



    box-shadow: 0 4px #dddddd, 0 4px 4px rgba(0, 0, 0, 0.1);



    top: -4px;



}



.style1 {font-size: 24px; color:#fff; font-weight:bold; margin-top:5px;}



.style2 {



	color: #FFFFFF;



	font-weight: bold;



}



</style>

<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->

          <div class="">

		  

		  

           

        <div class="clearfix"></div>



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2></h2>

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

                  </div><?=$check?>

				  

				  	 <div class="openerp openerp_webclient_container">

                    <table class="oe_webclient">

                    <tbody>

   

                      <tr>

			

				  

				  

                

				  





        <table width="96%" border="0" align="center" cellpadding="10" cellspacing="0" style="margin:20px;">



  <tr>



    <td><?



//session_start();



//require "../../classes/check.php";



//require "../../config/db_connect.php";



//require "../../classes/all_functions.php";



//require "../../classes/scb.php";



//require "../../classes/my.php";



$leave_id = $_SESSION['user']['id'];

$welcome = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$leave_id);





if($leave_id>0)



{







$g_s_date=date('Y-01-01');



$g_e_date=date('Y-12-31');







$hrm_leave_info=find_all_field('hrm_leave_info','','PBI_ID='.$leave_id);







$leave_days_casual=find_a_field('hrm_leave_info','sum(total_days)','type=1 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);







$leave_days_sick=find_a_field('hrm_leave_info','sum(total_days)','type=2 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);







$leave_days_annual=find_a_field('hrm_leave_info','sum(total_days)','type=3 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_marrige=find_a_field('hrm_leave_info','sum(total_days)','type=4 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_maternity=find_a_field('hrm_leave_info','sum(total_days)','type=5 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_paternity=find_a_field('hrm_leave_info','sum(total_days)','type=6 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_Hajj=find_a_field('hrm_leave_info','sum(total_days)','type=7 and leave_status="GRANTED" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_half=find_a_field('hrm_leave_info','sum(total_days)','type="Short Leave (SHL)" and leave_status="Granted" and half_leave_date>="'.$g_s_date.'" and half_leave_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);



$leave_days_EOL=find_a_field('hrm_leave_info','sum(total_days)','type=8 and leave_status="Granted" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);







$leave_days_compensatory=find_a_field('hrm_leave_info','sum(total_days)','type="Compensatory Off" and leave_status="Granted" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);







$leave_days_lwp=find_a_field('hrm_leave_info','sum(total_days)','type=9 and leave_status="Granted" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);


$dayoff=find_a_field('hrm_leave_info','sum(total_days)','type=10 and leave_status="Granted" and s_date>="'.$g_s_date.'" and e_date<="'.$g_e_date.'"   and PBI_ID='.$hrm_leave_info->PBI_ID);







$personnel_basic_info=find_all_field('personnel_basic_info','','PBI_ID='.$leave_id);







$designation=find_all_field('designation','DESG_DESC','DESG_ID='.$personnel_basic_info->PBI_DESIGNATION);







$department=find_all_field('department','DEPT_DESC','DEPT_ID='.$personnel_basic_info->PBI_DEPARTMENT);







$hrm_leave_rull_manage=find_all_field('hrm_leave_rull_manage','','id='.$personnel_basic_info->LEAVE_RULE_ID);



}







?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Details Staff Report</title>







<style type="text/css">



body { font-family:Tahoma, Geneva, sans-serif;



font-size:12px; }



table{ border:solid; border:#99C; padding:5px; margin-bottom:5px;}



td{



text-align:center;



}



.style4 {font-size: 14px}



.style9 {color: #FFFFFF}



.style10 {font-size: 14px; color: #000; margin-top:10px }



.style14 {font-size: 16px; font-weight: bold; }



.style16 {font-size: 12}



</style>

<body>

















<form action="" method="post" enctype="multipart/form-data">



<div class="row">

		<div class="col-md-12">

			<div class="panel panel-primary">

				<div class="panel-heading">

					<h3 class="panel-title" align="center">Employee Basic Information</h3>

				</div>

				<div class="panel-body">

				



<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" eight="790" style="border-color:#CCCCCC">



  <tr>



    <td width="8%" height="30" align="center" valign="middle" bordercolor="#F0F0F0" bgcolor="#FFFFFF"><div align="center" class="style14">ID</div></td>



    <td width="8%" height="30" align="center" valign="middle" bordercolor="#F0F0F0" bgcolor="#FFFFFF" style="font-size:15px"><div align="center" class="style14">Name</div></td>



    <td width="8%" height="30" align="center" valign="middle" bordercolor="#F0F0F0" bgcolor="#FFFFFF" style="font-size:15px"><div align="center" class="style14">



      Designation     </div></td>



    <td width="8%" height="30" align="center" valign="middle" bordercolor="#F0F0F0" bgcolor="#FFFFFF"><div align="center" class="style14">Gender</div></td>



    <td width="8%" height="30" align="center" valign="middle" bordercolor="#F0F0F0" bgcolor="#FFFFFF"><div align="center" class="style14">



      Department</div></td>

  </tr>



  <tr align="center" valign="middle" bgcolor="#FFFFFF">



    <td width="8%" height="30"><div align="center" class="style4">



      <?=$personnel_basic_info->PBI_CODE?>



    </div></td>



    <td width="8%" height="30"><div align="center" class="style4"><?=$personnel_basic_info->PBI_NAME?></div></td>



    <td width="8%" height="30"><div align="center" class="style4"><?php echo $designation->DESG_DESC?></div></td>



    <td width="8%" height="30"><div align="center" class="style4">



      <?=$personnel_basic_info->PBI_SEX?>



    </div></td>



    <td width="10%" height="30"><div align="center" class="style4"><?php echo $department->DEPT_DESC?></div></td>

  </tr>



  <tr align="center" valign="middle" bgcolor="#FFFFFF">



    <td width="8%" height="30"><div align="center" class="style14">Date  of Joining</div></td>



    <td width="8%" height="30"><div align="center" class="style14">Date of Confirmation</div></td>



    <td width="8%" height="30">&nbsp;</td>



    <td width="8%" height="30"><div align="center" class="style14">Job Location</div></td>



    <td width="8%" height="30"><div align="center" class="style14">



      Total Sevice Length</div></td>

  </tr>



  



  



  



  <tr align="center" valign="middle" bgcolor="#FFFFFF">

		<td width="8%" height="30">
			<div align="center" class="style4">
				<?= date('d-M-Y', strtotime($personnel_basic_info->PBI_DOJ)) ?>
			</div>
		</td>

		<td width="8%" height="30">
			<div align="center" class="style4">
				<?= date('d-M-Y', strtotime($personnel_basic_info->PBI_DOC)) ?>
			</div>
		</td>




    <td width="8%" height="30">&nbsp;</td>



    <td width="8%" height="30"><div align="center" class="style4">



      <?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$personnel_basic_info->JOB_LOCATION)?>



    </div></td>



    <td width="8%" height="30"><div align="center" class="style4">



     

	  <?php

										  

		  $interval = date_diff(date_create(date('Y-m-d')), date_create($personnel_basic_info->PBI_DOJ));

		echo $interval->format("%Y Year, %M Months, %d Days");

		  ?>



    </div></td>

  </tr>

</table>



  



  

  

  

  

  <p>&nbsp;</p>

  

  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#ccc">



    



    <tr>



      <td colspan="11"  bgcolor="#FFFFFF" style="background:#2299C3; color:#FFFFFF;"><div align="center" class="style1">Individual Leave Status <?php echo date('Y')?></div></td>

    </tr>



    <!--<tr style="background:#0099FF" height="60">



      <td width="68" align="center" valign="middle" bgcolor="#666666"><strong><span class="style10">

      <div align="center" style="margin-top:15px">Type</div></span></strong></td>



      <td width="46" align="center" valign="middle" bgcolor="#666666"><strong><span class="style10">

      <div align="center">Casual Leave (CL)</div></span></strong></td>



      <td width="101" align="center" valign="middle" bgcolor="#666666"><div align="center" style="margin-top:15px"><strong><span class="style10"><div align="center">Sick Leave (SL)</div></span></strong></div></td>



      <td width="64" align="center" valign="middle" bgcolor="#666666"><div align="center" style="margin-top:13px"><strong><span class="style10"><div align="center">Annual Leave (AL)</div></span></strong></div></td>



      <td width="71" align="center" valign="middle" bgcolor="#666666"><strong><span class="style10">

      <div align="center" style="margin-top:15px">Short Leave (SHL)</div></span></strong></td>



      <td width="67" align="center" valign="middle" bgcolor="#666666"><div align="center"><strong><span class="style10"><div align="center">Leave <br> 



      Without Pay (LWP)</div></span></strong></div></td>





          	   

	   

      <td width="83" align="center" valign="middle" bgcolor="#666666"><div align="center" style="margin-top:15px"><strong><span class="style10"><div align="center">Paternity Leave (PL)</div>  </span></strong></div></td>

	  

	  

      <td width="82" align="center" valign="middle" bgcolor="#666666"><div align="center" style="margin-top:15px"><strong><span class="style10">Hajj Leave </span></strong></div></td>



      <td width="82" align="center" valign="middle" bgcolor="#666666"><div align="center" style="margin-top:15px"><strong><span class="style10">Marrige Leave</span></strong></div> </td>



      <td width="82" align="center" valign="middle" bgcolor="#666666"><div align="center"><strong><span class="style10"><div align="center" style="margin-top:10px">Extra Ordinary Leave (EOL)</div></span></strong></div></td>

    </tr>-->

	

	<tr style="background:#f1f1f0" height="60">



      <td width="8%" align="center" valign="middle"><strong><span class="style10">

      <div align="center" style="margin-top:15px">Type</div></span></strong></td>



      <td width="8%" align="center" valign="middle"><strong><span class="style10">

      <div align="center" style="margin-top:15px">Casual Leave (CL)</div></span></strong></td>



      <td width="8%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10"><div align="center">Sick Leave (SL)</div></span></strong></div></td>



      <td width="8%" align="center" valign="middle"><div align="center" style="margin-top:13px"><strong><span class="style10"><div align="center">Annual Leave (AL)</div></span></strong></div></td>



      <td width="8%" align="center" valign="middle"><strong><span class="style10">

      <div align="center" style="margin-top:15px">Short Leave (SHL)</div></span></strong></td>

	  

	   <td width="8%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10"><div align="center"><strong>Marriage Leave</strong></div>  

      </span></strong></div></td>

	  

	  

	  <?

	      if($personnel_basic_info->PBI_SEX=="Female"){

	      ?>

	   <td width="10%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Maternity Leave (ML)</span></strong></div> </td>

	   <? } else{?>

	   <td width="10%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Paternity Leave (PL)</span></strong></div> </td>

	   <? } ?>

	  

	   <td width="10%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Hajj Leave </span></strong></div></td>
	   
	   <td width="3%" align="center" valign="middle"><div align="center" style="margin-top:15px"><strong><span class="style10">Dayoff</span></strong></div></td>
	   


	  





      <td width="10%" align="center" valign="middle"><div align="center"><strong><span class="style10"><div align="center">Leave <br> 



      Without Pay (LWP)</div></span></strong></div></td>







      <td width="11%" align="center" valign="middle"><div align="center"><strong><span class="style10"><div align="center" style="margin-top:10px">Extra Ordinary Leave (EOL)</div></span></strong></div></td>

    </tr>

	

	

    <tr align="center">



      <td width="8%" height="10" align="center"  bgcolor="#FFFFFF"><div align="center" style="margin-top:15px;"><span class="style4"><strong>Entitlement</strong></span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF" ><div align="center" style="margin-top:20px;"><?=$casual=find_a_field('hrm_leave_type','yearly_leave_days','id=1');?></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"><?=$sick_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=2');?></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><div align="center" style="margin-top:15px;">


<?=$annual=find_a_field('hrm_leave_type','yearly_leave_days','id=3');?></div>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:15px;"><span class="style4">



        24



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"><?=$marrage=find_a_field('hrm_leave_type','yearly_leave_days','id=4');?></div></td>

 

  



      <?

	      if($personnel_basic_info->PBI_SEX=="Female"){

	      ?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"><?=$Maternity=find_a_field('hrm_leave_type','yearly_leave_days','id=5');?></div></td>

   <? }else{?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"><?=$paternity=find_a_field('hrm_leave_type','yearly_leave_days','id=6');?></div></td>

   <? } ?>

   

   <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"><?=$hajj=find_a_field('hrm_leave_type','yearly_leave_days','id=7');?></div></td>

   <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" style="margin-top:20px;"></div></td>
   <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"></span></div></td>
   <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center">As per Management Approval </div></td>
   
    

    </tr>



    <tr>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4"><strong>Availed</strong></span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">



        <?=$leave_days_casual?>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">



        <?=$leave_days_sick?>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">

        <?=$leave_days_annual?>

      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><?=$leave_days_half?></div></td>

	         <td width="125" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><?=$leave_days_marrige?></div></td>

			  <?

	      if($personnel_basic_info->PBI_SEX=="Female"){

	      ?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><?=$leave_days_maternity?></div></td>

     <? }else{ ?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><?=$leave_days_paternity?></div></td>

	  <? } ?>

      

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><?=$leave_days_Hajj?></div></td>


      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><?=$dayoff?></div></td>


      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><?=$leave_days_lwp?></div></td>

     

   



      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><?=$leave_days_EOL?></span></div></td>

    </tr>



    <tr style="font-weight:bold;">



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><strong>Balance</strong></span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">



        <?=$casual-$leave_days_casual?>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">



        <?=$sick_leave-$leave_days_sick?>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">



        <?=$annual-$leave_days_annual?>



      </span></div></td>



      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4"><?=24-$leave_days_half?></span></div></td>

	  

	  <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center" ><span class="style4">

        <?=$marrage-$leave_days_marrige?>

      </div></td>

	  

	   <?

	      if($personnel_basic_info->PBI_SEX=="Female"){

	      ?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><?=$Maternity-$leave_days_maternity?></span></div></td>

   <? }else{ ?>

      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><?=$paternity-$leave_days_paternity?></span></div></td>

	  

	  <? } ?>

	  

	        <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><?=$hajj-$leave_days_Hajj?></span></div></td>





      <td width="8%" height="25" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"></span></div></td>





  

      

    

      



      <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"></span></div></td>
	  
	   <td width="8%" align="center" valign="middle"  bgcolor="#FFFFFF"><div align="center"><span class="style4"><? //$leave_days_EOL?></span></div></td>

    </tr>



	



	<tr bgcolor="#2299C3">



      <td width="8%" height="23" align="center" valign="middle"><div align="center"></div></td>



      <td width="8%" align="center" valign="middle"><div align="center"><span class="style9"></span></div></td>



      <td width="8%"  ><div align="center"><span class="style9"></span></div></td>



      <td width="8%"  ><span class="style9"></span></td>



      <td width="8%" ><span class="style9"></span></td>



      <td width="8%"  ><span class="style9"></span></td>



      <td width="8%"  >&nbsp;</td>



      <td width="8%"  >&nbsp;</td>



      <td width="8%" >&nbsp;</td>



      <td width="8%"  >&nbsp;</td>
	  <td width="8%"  >&nbsp;</td>

    </tr>



	



	



   



  



  



  <? 



$res = "select o.*, a.EMP_ID, a.PBI_NAME from personnel_basic_info a, hrm_leave_info o where  a.PBI_ID=o.PBI_ID and leave_status='GRANTED' and o.s_date>='".$g_s_date."' and o.e_date<='".$g_e_date."'   and o.PBI_ID=".$hrm_leave_info->PBI_ID;







$sqll=mysql_query($res);







while ($data=mysql_fetch_object($sqll)){?>

















<? } ?>

</table>

</form>

</td>



  

</table>



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







<?













include_once("../../template/footer.php");







?>

                    