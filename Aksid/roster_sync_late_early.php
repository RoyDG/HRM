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

$emp_id_new = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="' . $_POST['emp_id'] . '"');


$endTime = $days2=mktime(0,0,0,$mon,26,$year);

for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
$day   = date('l',$i);
${'day'.date('N',$i)}++;} 
$r_count=${'day5'};
$PBI_ORG = $_POST['PBI_ORG'];

if($_POST['emp_id']>0) 	$emp_id = $emp_id_new;

if($emp_id>0) $emp_con = " and h.emp_id='".$emp_id."'";

if(isset($emp_id)){$emp_id_con= " and p.PBI_ID IN (".$emp_id.")";}

if($PBI_ORG>0) $ORG_con = " and p.PBI_ORG='".$PBI_ORG."'";


//START 1 Deleting All Previous Data
$sql = "delete h.* FROM hrm_att_summary_final h, personnel_basic_info p
WHERE p.PBI_ID=h.emp_id 
and h.att_date BETWEEN '".$start_date."' AND '".$end_date."' 

".$ORG_con.$emp_id_con."";
$query = mysql_query($sql);
// END 1


//START 1 Deleting All Previous Data
// $sql = "update hrm_att_summary h, personnel_basic_info p set h.deleted=0, h.panalty_leave_duration=0
//WHERE p.PBI_ID=h.emp_id 
//and h.att_date BETWEEN '".$start_date."' AND '".$end_date."' 
//and (iom_sl_no > 0 or leave_id > 0)
//".$ORG_con.$emp_id_con."";
//$query = mysql_query($sql);
// END 1





//....................	** For Sort LEAVE // IOM   COMMENT BY KAWSAR 3.28.2021 ..............//  l.leave_apply_date=h.att_date and

/* $sql2 = "SELECT 
h.emp_id,h.att_date,l.id,l.type,l.reason,l.total_hrs,l.PBI_IN_CHARGE,l.entry_at,l.PBI_ID,l.s_time,l.e_time,l.total_hrs,l.half_leave_date

FROM hrm_att_summary h, personnel_basic_info p,hrm_leave_info l
WHERE 
h.emp_id=p.PBI_ID and 
h.emp_id=l.PBI_ID and
l.type = 'Short Leave (SHL)' and
l.leave_status = 'Granted' and
l.half_leave_date=h.att_date and
h.att_date BETWEEN '".$start_date."' AND '".$end_date."' ".$ORG_con.$emp_id_con."
GROUP BY l.PBI_ID,l.half_leave_date";

	$query2 = mysql_query($sql2); $sl=1;
	while($data2 = mysql_fetch_object($query2))
	{
	 $sl++;
	
    $PBI_IDD[$sl] = $data2->emp_id;
	$att_datee[$sl] = $data2->att_date;
	$iom_sl_no[$sl] = $data2->id;
	$iom_type[$sl] = $data2->type;
	$iom_reason[$sl] = $data2->reason;
	$iom_duration[$sl] = $data2->total_hrs;
	$iom_approved_by[$sl] = $data2->PBI_IN_CHARGE;
	$iom_entry_at[$sl] = $data2->entry_at;
	$iom_entry_by[$sl] = $data2->PBI_ID;
	$iom_start_time[$sl] = date("H:i",strtotime($data2->s_time));
	$iom_end_time[$sl] = date("H:i",strtotime($data2->e_time));
	$iom_total_hrs[$sl] = $data2->total_hrs;
	$final_late_status[$sl] = 0;
	
	
	
} for($x=1;$x<=$sl;$x++)
{

 $att_update_sql = "update hrm_att_summary h, personnel_basic_info p set  
h.iom_sl_no='".$iom_sl_no[$x]."',  
h.iom_type='".$iom_type[$x]."', 
h.iom_reason='".mysql_real_escape_string($iom_reason[$x])."',
h.iom_approved_by='".$iom_approved_by[$x]."',  
h.iom_entry_at='".$iom_entry_at[$x]."', 
h.iom_entry_by='".$iom_entry_by[$x]."',
h.iom_duration='".$iom_duration[$x]."',
h.iom_start_time='".$iom_start_time[$x]."', 
h.iom_end_time='".$iom_end_time[$x]."',
h.iom_total_hrs='".$iom_total_hrs[$x]."',
h.final_late_status='".$final_late_status[$x]."'


WHERE 
p.PBI_ID=h.emp_id and 
p.PBI_ID='".$PBI_IDD[$x]."' and
h.att_date='".$att_datee[$x]."' ".$ORG_con."";


$att_query = mysql_query($att_update_sql);

}
*/
//....................	** For LEAVE SECTION   COMMENT BY KAWSAR 3.28.2021 ..............//




/*
 $sql22 = "SELECT 
h.emp_id,h.att_date,l.id,l.type,l.reason,l.total_days,l.PBI_IN_CHARGE,l.entry_at,l.PBI_ID,l.leave_apply_date,l.s_date,l.e_date

FROM hrm_att_summary h, personnel_basic_info p,hrm_leave_info l
WHERE 
h.emp_id=p.PBI_ID and 
h.emp_id=l.PBI_ID and


l.type NOT IN ('Short Leave (SHL)') and
l.leave_status = 'GRANTED' and

h.att_date BETWEEN '".$start_date."' AND '".$end_date."' ".$ORG_con.$emp_id_con."
GROUP BY l.PBI_ID, l.s_date ";


    $query3 = mysql_query($sql22); $sl=1;
	while($data3 = mysql_fetch_object($query3))
	{
	
	 $sl++;
	
$from_dates = $data3->s_date;

$to_dates = $data3->e_date;

$diff = date_diff(date_create($data3->s_date),date_create($data3->e_date)); $total_days = $diff->format("%a")+1;
for($i=strtotime($from_dates); $i<=strtotime($to_dates); $i=$i+86400)

{

  $att_datee=date('Y-m-d',$i);



$found = find_a_field('hrm_att_summary','1','emp_id="'.$data3->emp_id.'" and att_date="'.$att_datee.'"');

//values
$leave_reason = mysql_real_escape_string($data3->reason);



if($found==0)

{

  $sql="INSERT INTO hrm_att_summary (emp_id, att_date,leave_id, leave_type,leave_reason,leave_duration,leave_approved_by,leave_entry_at,leave_entry_by, dayname)

VALUES ('".$data3->emp_id."','".$att_datee."' ,'".$data3->id."', '".$data3->type."', '".$leave_reason."', '".$data3->total_days."', '".$data3->PBI_IN_CHARGE."', '".$data3->entry_at."','".$data3->PBI_ID."', 
dayname('".$att_datee."'))";

$query=mysql_query($sql);

}

else

{

 $sql='update hrm_att_summary set

leave_type="'.$data3->type.'", leave_id="'.$data3->id.'", leave_reason="'.$leave_reason.'",leave_duration="'.$data3->total_days.'", leave_approved_by="'.$data3->PBI_IN_CHARGE.'", 
dayname=dayname("'.$att_datee.'") ,leave_entry_at="'.$data3->entry_at.'",leave_entry_by="'.$data3->PBI_IN_CHARGE.'"

where emp_id="'.$data3->emp_id.'" and att_date="'.$att_datee.'" ';

$query=mysql_query($sql);

}

}
	
	
	
} 
*/


//....................  END	** For LEAVE SECTION   COMMENT BY KAWSAR 3.28.2021 ..............//








//....................	** For OD SECTION   COMMENT BY KAWSAR 4.5.2021 ..............//



/* $sql4 = "SELECT 
h.emp_id,h.att_date,l.id,l.PBI_IN_CHARGE,l.type,l.s_date,l.e_date,l.total_days,l.s_time_int,l.e_time_int,l.total_hrs,l.reason,l.entry_at,l.PBI_ID,l.od_date

FROM hrm_att_summary h, personnel_basic_info p,hrm_od_info l
WHERE 
h.emp_id=p.PBI_ID and 
h.emp_id=l.PBI_ID and
l.s_date BETWEEN '".$start_date."' AND '".$end_date."' and
l.od_status = 'Granted' and

h.att_date BETWEEN '".$start_date."' AND '".$end_date."' ".$ORG_con.$emp_id_con."
GROUP BY l.PBI_ID, l.s_date ";


    $query4 = mysql_query($sql4); $sl=1;
	while($data4 = mysql_fetch_object($query4))
	{
	
	 $sl++;
	
$from_dates = $data4->s_date;

$to_dates = $data4->e_date;

$diff = date_diff(date_create($data4->s_date),date_create($data4->e_date)); $total_days = $diff->format("%a")+1;
for($i=strtotime($from_dates); $i<=strtotime($to_dates); $i=$i+86400)

{

$att_date2=date('Y-m-d',$i);



$found = find_a_field('hrm_att_summary','1','emp_id="'.$data4->emp_id.'" and att_date="'.$att_date2.'"');



if($found==0)

{

$reason = mysql_real_escape_string($data4->reason);
$office_in='08:45';
$office_out='17:00';


  $sql4="INSERT INTO hrm_att_summary (
emp_id,att_date,sch_in_time,sch_out_time,od_id,od_type,od_reason,od_duration,od_approved_by,od_entry_at,od_entry_by,od_start_time,od_end_time,od_total_hrs)

VALUES ('".$data4->emp_id."', '".$att_date2."','".$office_in."', '".$office_out."' ,'".$data4->id."','".$data4->type."', '".$reason."', '".$data4->total_days."', '".$data4->PBI_IN_CHARGE."', '".$data4->entry_at."','".$data4->PBI_ID."','".$data4->s_time_int."',
'".$data4->e_time_int."','".$data4->total_hrs."')";

$query=mysql_query($sql4);

}

else

{

$sql2='update hrm_att_summary set
od_type="'.$data4->type.'", od_id="'.$data4->id.'",od_reason="'.$reason.'", od_duration="'.$data4->total_days.'" , od_approved_by="'.$data4->PBI_IN_CHARGE.'" , od_entry_at="'.$data4->entry_at.'" ,
od_entry_by="'.$data4->PBI_ID.'", od_start_time="'.$data4->s_time_int.'", od_end_time="'.$data4->e_time_int.'" ,od_total_hrs="'.$data4->total_hrs.'" , 
dayname=dayname("'.$att_date2.'") 
where emp_id="'.$data4->emp_id.'" and att_date="'.$att_date2.'" ';

$query=mysql_query($sql2);

}

}
	
	
	
} */



//....................  END	** For OD SECTION   COMMENT BY KAWSAR 3.28.2021 ..............//


// START 2 Calculating In & Out Time
  $sql = "SELECT h.id,h.emp_id,h.in_time,h.out_time,h.att_date,h.sch_in_time,h.sch_out_time,h.leave_id,h.od_start_time,h.od_end_time,h.leave_id,h.od_id,h.od_type,h.iom_start_time,h.iom_sl_no



FROM hrm_att_summary h,personnel_basic_info p

WHERE p.PBI_ID=h.emp_id

and h.att_date BETWEEN '".$start_date."' AND '".$end_date."'

 and h.holyday=0

 ".$emp_con.$ORG_con."

order by emp_id,att_date";


$query = mysql_query($sql);

while($data = mysql_fetch_object($query)){
	
	
//////////////// UPDATE DATA	
$emp_id = $data->emp_id;
$in_time = strtotime($data->in_time);
$out_time = strtotime($data->out_time);
$from_time = strtotime($data->att_date.' '.$data->sch_in_time);
$late_min = round(abs($in_time - $from_time) / 60,2);


// for late calculation
//$office_intimes  = date("h:i",strtotime($data->sch_in_time));

$office_intimes = strtotime($data->sch_in_time);

$office_outtimes = $data->sch_out_time;

$punch_intimess  = date("H:i",strtotime($data->in_time));
$punch_outtimes = date("H:i",strtotime($data->out_time));

$punch_intimes  = strtotime($punch_intimess);


//$od_intimes = date("h:i",strtotime($data->od_start_time));
//$iom_intimes = date("h:i",strtotime($data->iom_start_time));


$od_intimes = strtotime($data->od_start_time);
$iom_intimes = strtotime($data->iom_start_time);


//$office_outtimes>$punch_outtimes ||

if($data->in_time!='' && $data->leave_id==0 && $data->od_id==0 && $data->iom_sl_no==0 && $punch_intimes>$office_intimes ){
$final_late_status = 1;
//od with blank office time
}elseif($data->od_type!=4 && $data->leave_id==0  && $data->iom_sl_no==0 && $data->in_time=='' && $od_intimes>$office_intimes){
$final_late_status = 1;
//od and office time
}elseif($data->od_type!=4 &&  $data->leave_id==0 && $data->iom_sl_no==0 && $punch_intimes>$office_intimes  && $od_intimes>$office_intimes){
$final_late_status = 1;

//iom with blank office time
}elseif($data->leave_id==0 && $data->od_id==0 && $data->iom_sl_no>0 && $data->in_time=='' && $iom_intimes>$office_intimes){
$final_late_status = 1;

//iom & office time
}elseif($data->leave_id==0 && $data->od_id==0 && $data->iom_sl_no>0 && $punch_intimes>$office_intimes  && $iom_intimes>$office_intimes){
$final_late_status = 1;

//iom & od both
}elseif($data->leave_id==0 && $data->iom_sl_no>0 && $data->od_id>0  && $data->in_time=='' && $iom_intimes>$office_intimes && $od_intimes>$office_intimes){
$final_late_status = 1;


}elseif($data->od_id>0 && $data->iom_sl_no>0  && $od_intimes>$office_intimes && $iom_intimes <= $office_intimes){
$final_late_status = 0;

}elseif($punch_intimes<=$office_intimes){
$final_late_status = 0;

}else{

$final_late_status = 0;
}





if( $data->leave_id>0){
$final_early_out_status = 0;
}elseif($punch_outtimes<=$office_outtimes || $data->in_time==$data->out_time ){
$final_early_out_status = 1;
}else{
$final_early_out_status = 0;
}





 $update_sql = "update hrm_att_summary



set late_min='".$late_min."',

final_late_min='".$final_late_min."',

final_late_status='".$final_late_status."',

final_early_out_status='".$final_early_out_status."' ,

process_time='".$datetime."'





where id=".$data->id;



mysql_query($update_sql);






	
	
	
	
}




// END 1

$msz= 'LATE/EARLY SYNC SUCCESSFULLY COMPLETED';
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
            <h2>LATE/EARLY SYNC <? echo '<span style="color:#2A3F54">'.$msz.'</span> ';?></h2>
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
<tr><td height="40" colspan="4" bgcolor="#66cdaa"><div align="center" class="style1"> LATE/EARLY SYNC SYSTEM </div></td></tr>

<tr>
  <td style="padding-left:10px">Employee Code </td>
  <td colspan="3">
 
 	 <?
		
		//auto_complete_from_db('personnel_basic_info','concat(PBI_ID," - ",PBI_NAME)','concat(PBI_ID)','','emp_id');
		
	?>
  
  <input type="text" list='eip_ids' name="emp_id" id="emp_id" style="width:250px;" value="<?=$_POST['emp_id']?>" /></td>
  
 <datalist id='eip_ids'>
  <option></option>
   <?
		
   foreign_relation('personnel_basic_info','PBI_CODE','concat(PBI_NAME," - ",PBI_CODE)',$emp_id, 'PBI_JOB_STATUS="In Service"');
		
	?>
  </datalist>
  
  
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
		
	<?php auto_dropdown("select id,group_name from user_group where 1 "); ?>
		
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