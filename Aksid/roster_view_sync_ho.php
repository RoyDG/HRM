<?php
session_start();
ob_start();
require "../../config/inc.all.php";

function auto_dropdown($sql){
$res=mysql_query($sql);
while($data=mysql_fetch_row($res)){
if($value==$data[0]) echo '<option value="'.$data[0].'" selected>'.$data[1].'</option>';
else echo '<option value="'.$data[0].'">'.$data[1].'</option>';
}}

do_calander('#m_date');
$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';

$table='hrm_inout';
$unique='id';

if($_POST['mon']!=''){
$mon=$_POST['mon'];}
else{
$mon=date('n');
}

if($_POST['year']!=''){
$year=$_POST['year'];}
else{
$year=date('Y');
}


if(isset($_POST["upload"]))
{
$year = $_POST['year'];
$mon = $_POST['mon'];
if($mon == 0)
{
$syear = $year - 1;
$smon = 12;
}
else
{
$syear = $year;
//$smon =  $mon - 1;
$smon =  $mon;
}

$datetime = date('Y-m-d H:i:s');

$start_date = $syear.'-'.($smon).'-01';
//$start_date = '2018-02-26';

$startTime = $days1 = strtotime($start_date);
$days_mon = date('t',$startTime);

$end_date   = $year.'-'.($mon).'-31';
//$end_date   = '2018-03-25';

$emp_id_new = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="'.$_POST['emp_id'].'"');

$endTime = $days2=mktime(0,0,0,$mon,26,$year);

for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
$day   = date('l',$i);
${'day'.date('N',$i)}++;} 
$r_count=${'day5'};
$PBI_ORG = $_POST['PBI_ORG'];

if($_POST['emp_id']>0) 	$emp_id= $emp_id_new;

if(isset($emp_id)){$emp_id_con=" and p.PBI_ID IN (".$emp_id.")";}

if($PBI_ORG>0) $ORG_con = " and p.PBI_ORG='".$PBI_ORG."'";


//START 1 Deleting All Previous Data
$sql = "delete h.* FROM hrm_att_summary h, personnel_basic_info p
WHERE p.PBI_ID=h.emp_id 
and h.att_date BETWEEN '".$start_date."' AND '".$end_date."' 
and iom_sl_no = 0 and leave_id = 0 
".$ORG_con.$emp_id_con."";
$query = mysql_query($sql);
// END 1


//START 1 Deleting All Previous Data
 $sql = "update hrm_att_summary h, personnel_basic_info p set h.deleted=0, h.panalty_leave_duration=0
WHERE p.PBI_ID=h.emp_id 
and h.att_date BETWEEN '".$start_date."' AND '".$end_date."' 
and (iom_sl_no > 0 or leave_id > 0)
".$ORG_con.$emp_id_con."";
$query = mysql_query($sql);
// END 1



	
	
//  FOR NON ROSTER EMP   ////-------------============>>>>>>>>>>>>>>>>>>>>>>>>Comment by KAWSAR for NON ROSTER OR GENERAL DUITY type 07-11-2020 start <<<<<<<<<<<<<<<===============---------------\\\\	
	
	
	// START 3 Calculating In & Out Time // , h.EMP_CODE -- hrm_machice_type m,  -- and sc.schedule_type = 'Regular' and h.xmechineid=m.mac_id  and m.mac_type!='Out'
   $sql = "SELECT xenrollid , xdate , min(ztime) in_time, max(ztime) out_time,
    sc.office_start_time,
	sc.office_end_time
	
FROM `hrm_attdump` h, personnel_basic_info p ,office_timing sc
WHERE 
sc.department=p.PBI_DEPARTMENT 

and p.PBI_ID=h.xenrollid 
and xdate BETWEEN '".$start_date."' AND '".$end_date."' 

 ".$ORG_con.$emp_id_con."
GROUP BY xenrollid , xdate ";

	$query = mysql_query($sql);
	while($data = mysql_fetch_object($query))
	{
	$sl++;


	$late_min[$sl] = 0;
	$grace_no[$sl] = 0;
	$final_late_min[$sl] = 0;
	$final_late_status[$sl] = 0;
	$process_time[$sl] = date('Y-m-d H:i:s');
	
	
	$shedule_no[$sl] = $data->shedule_1;
	$EMP_CODE[$sl] = $data->EMP_CODE;
	
	$emp_ids[$sl] = $emp_id = $data->xenrollid;
	$att_date[$sl] = $data->xdate;
	$next_att_date[$sl] = date('Y-m-d',(strtotime($data->xdate) + 86400));
//------------------------------------------------------------------------------------>>>>>>>---------------------------//	
	if($data->office_start_time>$data->office_end_time){
	   $stTime=$data->xdate.' '.($data->office_start_time-3);
	$in_time[$sl] = find_a_field('hrm_attdump','ztime','ztime>"'.$stTime.'" and xdate="'.$data->xdate.'"');
	}else{
	   $in_time[$sl] = $data->in_time;
	}
//------------------------------------------------------------------------------------<<<<<<<<---------------------------//	
	$grace_type_name[$sl] = $data->grace_type;
	
//---------===========>>>>>>-----------------================>>>>>>>>>----------------------//	
   if($data->office_start_time>$data->office_end_time){
	   $stTime=date('Y-m-d',(strtotime($data->xdate) + 86400)).' '.($data->office_end_time+4);
	 $e_out_time[$sl] = find_a_field('hrm_attdump','ztime','ztime<"'.$stTime.'" and xdate="'.$next_att_date[$sl].'"');
	}else{
	$e_out_time[$sl] = $data->out_time;
	}
//---------===========>>>>>>-----------------================>>>>>>>>>----------------------//	
	$office_start_time[$sl] = $data->office_start_time; 
	$office_end_time[$sl] = $data->office_end_time;
	$att_date[$sl].' '.$office_start_time[$sl];
	$in_time[$sl];
	
	$e_out_time[$sl];

	
	
	$from_time  = strtotime($att_date[$sl].' '.$office_start_time[$sl]);
	$entry_time = strtotime($in_time[$sl]);
	
	

	
	
	$panalty_leave_duration[$sl] = '0.0';
	
	if((($entry_time - $from_time)/60)>0) {
	$late_min[$sl] = (($entry_time - $from_time)/60);
	$late_grace_no [$sl] = 1;
	}
	else {
	$late_min[$sl] = 0;
	$late_grace_no [$sl] = 0;
	}
	
	if((($entry_time - $from_time)/60)<0) {
	$in_grace_min[$sl] = (($from_time - $entry_time)/60);
	}
	else {
	$in_grace_min[$sl] = 0;
	}
	


	
	   	if($late_min[$sl]>0){
	         $final_late_status[$sl] = 1;
	         $final_late_min[$sl] = ($late_min[$sl]);
	     }
	

		
	}
	
	


 //out time query.
	
    $sql = "SELECT xenrollid , xdate , max(xtime) out_time  
	FROM `hrm_attdump` h, personnel_basic_info p
	
	WHERE p.PBI_ID=h.xenrollid 
	
	and xdate BETWEEN '".$start_date."' AND '".$end_date."' 
	
	".$ORG_con.$emp_id_con."
	GROUP BY xenrollid,xdate";
	
	$query = mysql_query($sql);
	while($data = mysql_fetch_object($query))
	{
	$out_time[$data->xenrollid][$data->xdate] = $data->out_time;
	}
	
	
	
	$sql = "SELECT xenrollid , xdate , max(xtime) out_time  
	FROM hrm_attdump h, personnel_basic_info p
	
	WHERE 
	p.PBI_ID=h.xenrollid 
	
	and xdate BETWEEN '".$start_date."' AND '".$end_date."' 
	
	".$ORG_con.$emp_id_con."
	GROUP BY xenrollid ,xdate ";
	
	$query = mysql_query($sql);
	while($data = mysql_fetch_object($query))
	{
	
	
//---------===========>>>>>>-----------------================>>>>>>>>>----------------------//	
   if($data->office_start_time>$data->office_end_time){
   
	   $stTime=date('Y-m-d',(strtotime($data->xdate) + 86400)).' '.($data->office_end_time+4);
	   $out_time2[$data->xenrollid][$date] = find_a_field('hrm_attdump','ztime','ztime<"'.$stTime.'" and xdate="'.date('Y-m-d',(strtotime($data->xdate) + 86400)).'"');
	   
	}
	
	else{
	   $date = date('Y-m-d',(strtotime($data->xdate) - 86400));
	   $out_time2[$data->xenrollid][$date] = $data->out_time;
	}
//---------===========>>>>>>-----------------================>>>>>>>>>----------------------//
	}
//	
//	
//		
//      $sql = "SELECT xenrollid , xdate , max(ztime) out_time  
//	FROM hrm_attdump h, hrm_machice_type m,personnel_basic_info p, hrm_schedule_info sc, hrm_roster_allocation ro
//	
//	WHERE 
//	p.PBI_ID=h.xenrollid 
//	and h.xenrollid=ro.PBI_ID
//	and p.employee_type = 'Roster'
//	and h.xdate=ro.roster_date
//	and sc.id=ro.shedule_1 
//	and ztime < concat(h.xdate,' ',sc.office_start_time)
//	and xdate BETWEEN '".$start_date."' AND '".$end_date."' 
//	and h.xmechineid=m.mac_id 
//	and m.mac_type!='In' 
//	".$ORG_con.$emp_id_con."
//	GROUP BY xenrollid ,xdate ";
//	
//	$query = mysql_query($sql);
//	while($data = mysql_fetch_object($query))
//	{
//	$date = date('Y-m-d',(strtotime($data->xdate) - 86400));
//	$out_time2[$data->xenrollid][$date] = $data->out_time;
//	}
	
	
//=========----->>>>>>>>>Comment by karmul dated: 07-11-2020 END<<<<<<<<<<<<-------============//	
	
	
	
	
	
for($x=1;$x<=$sl;$x++)
{

if($office_end_time[$x]>$office_start_time[$x])
{
$exit_time = $out_time[$emp_ids[$x]][$att_date[$x]];
$sch_out   = $att_date[$x].' '.$office_end_time[$x];
//if($sch_out>$exit_time) {$deleted[$x] = 1;}


		
  $sql="INSERT INTO hrm_att_summary 
	(emp_id, att_date, in_time,out_time, sch_in_time, sch_out_time,  dayname, 
	panalty_leave_duration, deleted, late_min, grace_no, final_late_min, final_late_status, process_time, shedule_no, EMP_CODE, early_out_min, early_grace_no, late_grace_no, in_grace_min, out_grace_min, dd_sl_no,
	dd_shedule_no, duty_type, dd_duration,dd_entry_by,dd_entry_at,
	tr_sl_no,from_company,to_company,tr_shedule_no,tr_duration,tr_entry_by,tr_entry_at)
	VALUES 
('".$emp_ids[$x]."','".$att_date[$x]."', '".$in_time[$x]."','".$out_time[$emp_ids[$x]][$att_date[$x]]."','".$office_start_time[$x]."','".$office_end_time[$x]."', dayname('".$att_date[$x]."'), '".$panalty_leave_duration[$x]."','".$deleted[$x]."','".$late_min[$x]."','".$grace_no[$x]."','".$final_late_min[$x]."','".$final_late_status[$x]."','".$process_time[$x]."','".$shedule_no[$x]."','".$EMP_CODE[$x]."',
'".$early_out_min[$x]."','".$early_grace_no[$x]."','".$late_grace_no[$x]."' ,'".$in_grace_min[$x]."','".$out_grace_min[$x]."','".$dd_sl_no[$emp_ids[$x]][$att_date[$x]]."',
'".$dd_shedule_no[$emp_ids[$x]][$att_date[$x]]."',
'".$duty_type[$emp_ids[$x]][$att_date[$x]]."',
'".$dd_duration[$emp_ids[$x]][$att_date[$x]]."','".$dd_entry_by[$emp_ids[$x]][$att_date[$x]]."','".$dd_entry_at[$emp_ids[$x]][$att_date[$x]]."',

'".$tr_sl_no[$emp_ids[$x]][$att_date[$x]]."','".$from_company[$emp_ids[$x]][$att_date[$x]]."','".$to_company[$emp_ids[$x]][$att_date[$x]]."','".$tr_shedule_no[$emp_ids[$x]][$att_date[$x]]."',
'".$tr_duration[$emp_ids[$x]][$att_date[$x]]."','".$tr_entry_by[$emp_ids[$x]][$att_date[$x]]."','".$tr_entry_at[$emp_ids[$x]][$att_date[$x]]."')";



  //$att_update_sql = "update hrm_att_summary h, personnel_basic_info p set h.in_time='".$in_time[$x]."', h.out_time='".$out_time[$emp_ids[$x]][$att_date[$x]]."',
//h.sch_in_time='".$office_start_time[$x]."', h.sch_out_time='".$office_end_time[$x]."', 
// h.late_min='".$late_min[$x]."', h.grace_no='".$grace_no[$x]."', h.final_late_status='".$final_late_status[$x]."',
//  h.early_out_min='".$early_out_min[$x]."', h.early_grace_no='".$early_grace_no[$x]."', h.late_grace_no='".$late_grace_no[$x]."',
//   h.in_grace_min='".$in_grace_min[$x]."', h.out_grace_min='".$out_grace_min[$x]."'
//WHERE p.PBI_ID=h.emp_id 
//and h.att_date='".$att_date[$x]."'
//and (dd_sl_no > 0 or tr_sl_no > 0)
//".$ORG_con.$emp_id_con."";



}
else
{
$exit_time = $out_time2[$emp_ids[$x]][$att_date[$x]];
$sch_out   = $next_att_date[$x].' '.$office_end_time[$x];



//echo '<br>';
		//if($sch_out>$exit_time) {$deleted[$x] = 1;}
	
	 $sql="INSERT INTO hrm_att_summary 
	(emp_id, att_date, in_time,out_time, sch_in_time, sch_out_time,  dayname, 
	panalty_leave_duration, deleted, late_min, grace_no, final_late_min, final_late_status, process_time, shedule_no, EMP_CODE,early_out_min,early_grace_no, late_grace_no, in_grace_min, out_grace_min, dd_sl_no,
	dd_shedule_no, duty_type, dd_duration,dd_entry_by,dd_entry_at,
tr_sl_no,from_company,to_company,tr_shedule_no,tr_duration,tr_entry_by,tr_entry_at)
	VALUES 
('".$emp_ids[$x]."','".$att_date[$x]."', '".$in_time[$x]."','".$out_time2[$emp_ids[$x]][$att_date[$x]]."','".$office_start_time[$x]."','".$office_end_time[$x]."', dayname('".$att_date[$x]."'), '".$panalty_leave_duration[$x]."','".$deleted[$x]."','".$late_min[$x]."','".$grace_no[$x]."','".$final_late_min[$x]."','".$final_late_status[$x]."','".$process_time[$x]."', '".$shedule_no[$x]."','".$EMP_CODE[$x]."',
'".$early_out_min[$x]."','".$early_grace_no[$x]."','".$late_grace_no[$x]."','".$in_grace_min[$x]."','".$out_grace_min[$x]."','".$dd_sl_no[$emp_ids[$x]][$att_date[$x]]."',
'".$dd_shedule_no[$emp_ids[$x]][$att_date[$x]]."',
'".$duty_type[$emp_ids[$x]][$att_date[$x]]."',
'".$dd_duration[$emp_ids[$x]][$att_date[$x]]."','".$dd_entry_by[$emp_ids[$x]][$att_date[$x]]."','".$dd_entry_at[$emp_ids[$x]][$att_date[$x]]."',

'".$tr_sl_no[$emp_ids[$x]][$att_date[$x]]."','".$from_company[$emp_ids[$x]][$att_date[$x]]."','".$to_company[$emp_ids[$x]][$att_date[$x]]."','".$tr_shedule_no[$emp_ids[$x]][$att_date[$x]]."',
'".$tr_duration[$emp_ids[$x]][$att_date[$x]]."','".$tr_entry_by[$emp_ids[$x]][$att_date[$x]]."','".$tr_entry_at[$emp_ids[$x]][$att_date[$x]]."')";



 // $att_update_sql = "update hrm_att_summary h, personnel_basic_info p set h.in_time='".$in_time[$x]."', 
//  h.out_time='".$out_time2[$emp_ids[$x]][$att_date[$x]]."',
//h.sch_in_time='".$office_start_time[$x]."', h.sch_out_time='".$office_end_time[$x]."', 
// h.late_min='".$late_min[$x]."', h.grace_no='".$grace_no[$x]."', h.final_late_status='".$final_late_status[$x]."',
//  h.early_out_min='".$early_out_min[$x]."', h.early_grace_no='".$early_grace_no[$x]."', h.late_grace_no='".$late_grace_no[$x]."',
//   h.in_grace_min='".$in_grace_min[$x]."', h.out_grace_min='".$out_grace_min[$x]."'
//WHERE p.PBI_ID=h.emp_id 
//and h.att_date='".$att_date[$x]."'
//and (dd_sl_no > 0 or tr_sl_no > 0)
//".$ORG_con.$emp_id_con."";



}
	//echo $sql;
	$query=mysql_query($sql);

	$msz= 'IN OUT SYNC SUCCESSFULLY COMPLETED';
	
	//$att_query = mysql_query($att_update_sql);

}


}
?>


<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {
	color: #FF66CC;
	font-weight: bold;
}
-->
</style>

<div class="right_col" role="main">
  <!-- Must not delete it ,this is main design header-->
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>IN OUT SYNC <? echo '<span style="color:#2A3F54">'.$msz.'</span> ';?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a> </li>
                  <li><a href="#">Settings 2</a> </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="openerp openerp_webclient_container">
            <div class="x_content">
			
			
			

<div class="oe_view_manager oe_view_manager_current">
<form action=""  method="post" enctype="multipart/form-data">
<div class="oe_view_manager_body">
<div  class="oe_view_manager_view_list"></div>
<div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
<div class="oe_form_buttons"></div>
<div class="oe_form_sidebar"></div>
<div class="oe_form_pager"></div>
<div class="oe_form_container"><div class="oe_form">
<div class="">
<div class="oe_form_sheetbg">
<div class="oe_form_sheet oe_form_sheet_width">
<div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

<table width="80%" border="1" align="center">
<tr><td height="40" colspan="4" bgcolor="#66cdaa"><div align="center" class="style1">IN OUT SYNC SYSTEM</div></td></tr>

<tr>
  <td style="padding-left:10px">Employee Code </td>
  <td colspan="3">
 
 	 <?
		
		//auto_complete_from_db('personnel_basic_info','concat(PBI_ID," - ",PBI_NAME)','concat(PBI_ID)','','emp_id');
		
	?>
  
  <input type="text"  list='eip_ids' name="emp_id" id="emp_id" style="width:250px;" value="<?=$_POST['emp_id']?>" />
  <datalist id='eip_ids'>
  <option></option>
   <?
		
		foreign_relation('personnel_basic_info','PBI_CODE','concat(PBI_NAME," - ",PBI_CODE)',$emp_id,'PBI_JOB_STATUS="In Service"');
		
	?>
  </datalist>
  
  </td>
</tr>
<tr>
  <td style="padding-left:10px">Company:</td>
  <td colspan="3">
<!--  <span class="oe_form_group_cell">
    <select name="PBI_ORG" style="width:160px;" id="PBI_ORG">
      <? foreign_relation('user_group','id','group_name',$PBI_ORG,'1 and id="'.$_SESSION['user']['group'].'"');?>
    </select>
  </span>-->

  	<select name="PBI_ORG" id="PBI_ORG" style="width:250px;">
	<option>AKSID CORPORATION</option>
	
	<? //=foreign_relation('domai','DOMAIN_CODE','DOMAIN_DESC',$PBI_DOMAIN);?>
	</select>
  
  </td>
</tr>
<tr>
<td style="padding-left:10px" width="20%">Month :</td>
<td colspan="3"><span class="oe_form_group_cell">
<select name="mon" style="width:250px;" id="mon" required="required">


<option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>
<option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>
<option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>
<option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>
<option value="5" <?=($mon=='5')?'selected':''?>>May</option>
<option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>
<option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>
<option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>
<option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>
<option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>
<option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>
<option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>

          </select>
                </span></td>
                </tr>
              <tr>
                <td style="padding-left:10px">Year :</td>
                <td colspan="3"><select name="year" style="width:250px;" id="year" required="required">
				<option <?=($year=='2019')?'selected':''?>>2019</option>
				 
                 <option <?=($year=='2020')?'selected':''?>>2020</option>
				 <option <?=($year=='2021')?'selected':''?>>2021</option>
				 
				 <option <?=($year=='2022')?'selected':''?>>2022</option>



                                  <option <?=($year=='2023')?'selected':''?>>2023</option>



                                  <option <?=($year=='2024')?'selected':''?>>2024</option>



                                  <option <?=($year=='2025')?'selected':''?>>2025</option>
								   <option <?=($year=='2026')?'selected':''?>>2026</option>



                                  <option <?=($year=='2027')?'selected':''?>>2027</option>
								  
								  
								  <option <?=($year=='2028')?'selected':''?>>2028</option>



                                  <option <?=($year=='2029')?'selected':''?>>2029</option>



                                  <option <?=($year=='2030')?'selected':''?>>2030</option>
				  
                </select></td>
                </tr>
              
              <tr>

                <td colspan="4">
                  <div align="center">
                    <input name="upload" type="submit" id="upload" value="Sync All Data" />
                  </div></td>
                </tr>


              <tr>

                <td colspan="4"><label>

                    <div align="center">
                      <p>&nbsp;</p>
                      </div>

                    </label></td>
              </tr>
            </table>

            <br />
          </div>
          </div>

          </div>

    </div>

<div class="oe_chatter"><div class="oe_followers oe_form_invisible">
<div class="oe_follower_list"></div>
</div></div></div></div></div>
</div></div>
</div>
</form></div>

   </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /End page content -->





<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
include_once("../../template/footer.php");


?>