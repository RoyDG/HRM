<?php
session_start();
ob_start();
require "../../config/inc.all.php";


$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
do_calander('#start_date');
do_calander('#end_date');

//$PBI_ID = $_POST['PBI_ID'];

$PBI_ID = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['PBI_CODE'].'"');


?>
<style type="text/css">
<!--
.style2 {color: #FFFFFF; }
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
            <h2>ATTENDENCE PAGE</h2>
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





       
		  
		  
		  
		  
		  <form action="?"  method="post">
<table width="100%" border="0" class="oe_list_content"><thead>
<tr class="oe_list_header_columns">
  <th colspan="4"><div align="center"><span>Payroll Calculation Report </span></div></th>
  </tr>
<tr class="oe_list_header_columns">
  <th colspan="4"><div align="center"><span>Select Options</span></div></th>
  </tr>
</thead><tfoot>
</tfoot><tbody>

  <tr  >
    <td width="5%" align="right">&nbsp;</td>
    <td width="18%" align="right"><strong>Employee Code  :</strong></td>
    <td width="31%" align="right"><div align="left">
	
      <input name="PBI_CODE" list='eip_ids' type="text" id="PBI_CODE" size="30" onblur="" tabindex="1"  class="form-control"  required="required" value="<?=$_POST['PBI_CODE']?>" />
	  
	   <datalist id='eip_ids'>
  <option></option>
   <?
		
		foreign_relation('personnel_basic_info','PBI_CODE','concat(PBI_CODE," - ",PBI_NAME)',$emp_id,'PBI_JOB_STATUS="In Service" order by PBI_NAME');
		
	?>
  </datalist>
	  
	  
	  
    </div></td>
    <td width="23%" align="right">&nbsp;</td>
  </tr>
	  
	  <tr >
	    <td align="right">&nbsp;</td>
        <td align="right"><strong> Date  :</strong></td>
        <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type="date"  name="start_date" id="start_date"  class="form-control" required="required" value="<? if(isset($_POST['start_date'])){ echo $_POST['start_date']; } ?>" /></td>
            <td>TO</td>
            <td><input type="date"  name="end_date" id="end_date"  class="form-control" value="<? if(isset($_POST['end_date'])){ echo $_POST['end_date']; } ?>" required="required" 
	/></td>
          </tr>
        </table></td>
        <td align="right">&nbsp;</td>
    </tr>
	

	
	
	
	
	
	


  </tbody></table>
  <div align="center">
  <br /><br />
    <input name="create" type="submit" id="create" value="Show Report" style="width:230px" class="btn btn-info" />
  </div>
          </form>
<br /><? if($PBI_ID>0){

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$begin = new DateTime($start_date);
$end = new DateTime($end_date);
$end->modify('+1 day');

$startTime = $days1=mktime(1,1,1,date('m',strtotime($start_date)),26,date('y',strtotime($start_date)));

$endTime = $days2=mktime(1,1,1,date('m',strtotime($end_date)),25,date('y',strtotime($end_date)));

$days_mon=($endTime - $startTime)/(3600*24);

for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
$day   = date('l',$i);
${'day'.date('N',$i)}++;

//if(isset($$day))
//$$day .= ',"'.date('Y-m-d', $i).'"';
//else
//$$day .= '"'.date('Y-m-d', $i).'"';
}


$ab="SELECT 
a.PBI_NAME as name,
desi.DESG_DESC as designation, 
d.DEPT_DESC as department

FROM 
personnel_basic_info a, 
department d, 
designation desi

WHERE 
a.PBI_DEPARTMENT=d.DEPT_ID and 
a.PBI_DESIGNATION=desi.DESG_ID and 
a.PBI_ID='".$PBI_ID."'";
$abb = mysql_query($ab);
$pbi=mysql_fetch_object($abb);


?>
<div style="text-align:center">
<table width="100%" class="oe_list_content">
  <thead>


<?php /*?><tr><td colspan="4">

<span id="id_view"></span>          

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Name: </td>
    <td>&nbsp;<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$_POST['PBI_ID']);?></td>
    <td>Company:</td>
    <td>&nbsp;<?=$pbi->company?>,<?=$pbi->LOCATION_NAME?></td>
  </tr>
  <tr>
    <td>Designation:</td>
    <td>&nbsp;<?=$pbi->designation?></td>
    <td>Department:</td>
    <td>&nbsp;<?=$pbi->department?></td>
  </tr>
</table></td></tr><?php */?>




<tr><td colspan="4">

<span id="id_view">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="50" bgcolor="#303435"><div align="center" class="style2">
  <p>ATTENDANCE REPORT</p>
  <p>DATE INTERVAL :   <?=date('d-M-Y',strtotime($_POST['start_date']))?>  To <?=date('d-M-Y',strtotime($_POST['end_date']))?>   </p>
</div></td>
</tr>
<tr>
<td>


				<?

				

				 $directory = "../../pic/staff/".$PBI_ID.".jpeg";

				 //Employee Pic

								$imgJPG = "../../pic/staff/".$PBI_ID.".JPG";

								$imgjpg = "../../pic/staff/".$PBI_ID.".jpg";

								$imgPNG = "../../pic/staff/".$PBI_ID.".PNG";

								$imgJPEG = "../../pic/staff/".$PBI_ID.".jpeg";

								$imgpng2 = "../../pic/staff/".$PBI_ID.".png";

								if(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								}elseif(file_exists($imgJPG)){

								  $link = $imgJPG;

								}elseif(file_exists($imgjpg)){

								  $link = $imgjpg;

								}elseif(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								}elseif(file_exists($imgpng2)){

								  $link = $imgpng2;

								}

				 

				 

				

				

				if(file_exists($link)) {?>

<div align="center">
<img src="<?=$link?>" class="img-circle profile_img modal-content" style="width:130px; height:auto; margin:10px; margin-top: 7px; margin-left:7px;"  vspace="0" hspace="5" height="auto">

</div>

				<? }else{?>

<div align="center">
<img src="../../pic/staff/default.png" class="img-circle profile_img modal-content" style="width: 100px; margin:10px; margin-top: 7px; margin-left:7px;" width="120" vspace="0" hspace="5" height="100">

</div>

				

				<? } ?>








</td>
</tr>

<div class="row">
  <div class="col-4"></div>

<div class="col-4">
<tr>
<td><div align="center" class="cell_fonts_grant_total style7"><strong><em>Employee Code  : <?php echo $_POST['PBI_CODE'];?></em></strong></div></td>
</tr>

<tr>
<td><div align="center" class="cell_fonts_grant_total style6"><strong><em>Employee Name  : <?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$PBI_ID);?> </em></strong></div></td>
</tr>


<tr>
<td><div align="center" class="cell_fonts_grant_total style6"><strong><em>Designation  : <?=$pbi->designation;?>  </em></strong></div></td>
</tr>

<tr>
<td><div align="center" class="cell_fonts_grant_total style6"><strong><em>Department  : <?=$pbi->department;?> </em></strong></div></td>
</tr>
</div>
  
  <div class="col-4"></div>
</div>

</table>
</span>          

</td>
</tr>








<tr class="oe_list_header_columns">
  <th colspan="4" style="text-align:center"><table width="100%" border=""  cellspacing="0" cellpadding="0" id="grp">
   <thead> <tr bgcolor="#D6D8D9">
      <th><div align="center">Date</div></th>
      <th><div align="center">Day Name</div></th>
      <th><div align="center">Office Time In</div></th>
	  <th><div align="center">IN Grace Time (Min)</div></th>
      <th><div align="center">Office Time Out</div></th>
      <th><div align="center">IN</div></th>
      <th><div align="center"><span>OUT</span></div></th>
    <!--  <th><span class="style2">Grace</span></th>
      <th>Late(Min)</th>
      <th>Final Late (Min)</th>
	  <th>Total Time</th>-->
      <th><div align="center">Status</div></th>
      </tr></thead>
	  <? 



$sql  = 'select * from hrm_att_summary where emp_id="'.$PBI_ID.'" and  att_date between "'.$start_date.'" and "'.$end_date.'" order by att_date asc';
$query = mysql_query($sql);
while($data=mysql_fetch_object($query)){
$val[$data->att_date]['in_time'] = $data->in_time;
$val[$data->att_date]['out_time'] = $data->out_time;

$val[$data->att_date]['leave_type'] = $data->leave_type;

$val[$data->att_date]['sch_in_time'] = $data->sch_in_time;
$val[$data->att_date]['sch_out_time'] = $data->sch_out_time;

$val[$data->att_date]['iom'] = $data->iom_sl_no	;
$val[$data->att_date]['leave'] = $data->leave_id;
$val[$data->att_date]['dayname'] = $data->dayname;

$val[$data->att_date]['od_id'] = $data->od_id;
$val[$data->att_date]['od_start_time'] = $data->od_start_time;
$val[$data->att_date]['od_end_time'] = $data->od_end_time;
$val[$data->att_date]['iom_start_time'] = $data->iom_start_time;
//office time
$sac_formated = date("H:i",strtotime($data->sch_in_time));

//od start time
$od_start_timee = date("H:i",strtotime($data->od_start_time));

$od_end_timee = date("H:i",strtotime($data->od_end_time));

if($data->iom_start_time>0){
//iom start time
$sort_leave_start_timee = date("H:i",strtotime($data->iom_start_time));

}else{$sort_leave_start_timee = '';}


//$endTime = strtotime('+15 minutes', strtotime($data->iom_start_time));
if($data->in_time>0){
 $late_punch=  date('H:i:s', strtotime($data->in_time));
}else{
$late_punch =  '';
}

$val[$data->att_date]['final_late_min'] = $data->final_late_min;
$val[$data->att_date]['late_min'] = $data->late_min;
$val[$data->att_date]['final_late_status'] = $data->final_late_status;
$val[$data->att_date]['grace_no'] = $data->grace_no;
$val[$data->att_date]['holyday'] = $data->holyday;

if($data->leave_id>0 && $data->leave_type!=10)
$val[$data->att_date]['final_status'] = 'LEAVE';

elseif($data->leave_type==10)
$val[$data->att_date]['final_status'] = 'DAYOFF';


//elseif($data->late_min>0)
//$val[$data->att_date]['late_status'] = 'LATE';


elseif( $data->in_time=='' && $data->leave_id==0 && $data->od_id==0 && $data->iom_sl_no==0 )
$val[$data->att_date]['final_status'] = 'Absent';


elseif( $late_punch>='12:00:00' && $data->od_id==0 && $data->iom_sl_no==0   )
$val[$data->att_date]['final_status'] = 'Absent';



//elseif( $data->final_late_status>0 && $data->od_id>0 && $fromserver_formated < $sac_formated )
//$val[$data->att_date]['final_status'] = 'OD';

elseif($data->final_late_status==0 && $data->od_id>0 && $od_start_timee < $sac_formated )
$val[$data->att_date]['final_status'] = 'OD';

elseif($data->final_late_status==0 && $data->od_id>0 && $data->in_time=='')
$val[$data->att_date]['final_status'] = 'OD';


elseif( $data->final_late_status>0 && $data->od_id>0 && $od_start_timee > $sac_formated  )
$val[$data->att_date]['final_status'] = 'LATE';

//elseif( $data->final_late_status>0 && $data->od_id>0 && $fromserver_formated < $sac_formated )
//$val[$data->att_date]['final_status'] = 'OD';




//elseif( $data->final_late_status>0 && $data->od_id>0 && $fromserver_formated > $sac_formated  )
//$val[$data->att_date]['final_status'] = 'LATE';

elseif( $data->iom_sl_no>0 && $sort_leave_start_timee <= $sac_formated )
$val[$data->att_date]['final_status'] = 'SHL';


elseif( $data->final_late_status>0 && $data->iom_sl_no>0 && $sort_leave_start_timee >= $sac_formated  )
$val[$data->att_date]['final_status'] = 'LATE';


elseif($data->holyday>0)
$val[$data->att_date]['final_status'] = 'HOLIDAY';

elseif($data->dayname=='Friday')
$val[$data->att_date]['final_status'] = 'HOLIDAY';

elseif($data->final_late_status>0||$data->final_late_min>0)
$val[$data->att_date]['final_status'] = 'LATE';

elseif($data->id>0)
$val[$data->att_date]['final_status'] = 'REGULAR';




$dteStart = new DateTime($data->in_time);
$dteEnd   = new DateTime($data->out_time);
$dteDiff  = $dteStart->diff($dteEnd);








}



$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);
//echo $off_day;
foreach ( $period as $dt ){
++$days;



$this_date = $dt->format( "Ymd" );

$day_date = $dt->format( "Y-m-d" );


$holysql = "select * from salary_holy_day where holy_day = '".$day_date."'";
$holy_query = mysql_query($holysql);
$holy = mysql_fetch_object($holy_query);
$holy_reson=$holy->reason;

$val[$day_date]['grace_no'];



if($holy>0){
$bgcolor = '#F7E7CE';
$val[$day_date]['final_status']= $holy_reson;
$public_holy++;
}

elseif($dt->format("l")=='Friday')
{$bgcolor = '#FFCBA4';$off_days++;}

elseif($val[$day_date]['final_status']=='LEAVE')     
{$bgcolor = '#D1ECF1'; $leave++;}

elseif($val[$day_date]['final_status']=='DAYOFF')     
{$bgcolor = '#D1ECF1'; $Dayoff++;}


elseif($dt->format("l")=='Friday')
{$bgcolor = '#CCCCCC';$off_days++;}

elseif($val[$day_date]['final_status']=='SHL')
{$bgcolor = '#D5D6EA'; $shl++;}

elseif($val[$day_date]['final_status']=='OD')
{$bgcolor = '#9FE2BF'; $od++;}


elseif($val[$day_date]['final_status']=='ABSENT')
{$bgcolor = '#F70D1A'; $absent_leave_ck++;}


elseif($val[$day_date]['final_status']=='LATE')
{$bgcolor = '#FAF884';$late++;$late_min_total = $late_min_total + $val[$day_date]['final_late_min'];}


elseif($val[$day_date]['final_status']=='REGULAR')
{$bgcolor = '#66CDAA';$regular++;}
else
{$bgcolor = '#F70D1A';  $regular++; $absent++;
$val[$day_date]['final_status']='ABSENT';
}

?>     
    
     
    <tr bgcolor="<?=$bgcolor?>">
      <td><div align="center"><?=$dt->format( "d-M-Y" );?></div></td>
      <td><div align="center"><?=$dt->format("l");?></div></td>
      <td><div align="center"><? //=$val[$day_date]['sch_in_time'];?>  <?   if ($val[$day_date]['sch_in_time']>0){  ?> 8:30 <? } ?></div></td>
	  <td><div align="center"> <?   if ($val[$day_date]['sch_in_time']>0){  ?> 15 <? } ?></div></td>
      <td><div align="center"><? //=$val[$day_date]['sch_out_time'];?> <?   if ($val[$day_date]['sch_in_time']>0){  ?> 5:00 <? } ?></div></td>
	  
	  <?php  if ($val[$day_date]['in_time'] >0 && $data->od_id==0){  ?>
	  
      <td><div align="center"><?=date("h:i a",strtotime($val[$day_date]['in_time']));?></div></td>
      <td><div align="center"><? if($val[$day_date]['out_time']>0) echo date("h:i a",strtotime($val[$day_date]['out_time']));?></div></td>
	  
	  <?php }else{  ?>
	   
	   <? if($val[$day_date]['in_time']==0 && $val[$day_date]['od_start_time']>0 ){?>
	  <td><div align="center"><?=date("h:i a",strtotime($val[$day_date]['od_start_time']));?></div></td>
	  <td><div align="center"><?=date("h:i a",strtotime($val[$day_date]['od_end_time']));?></div></td>
	  <? }else{?>
	  
	  <td></td>
	  <td></td><? } ?>
	  
	  <? }?>

	  
	  
      <?php /*?><td><?=($val[$day_date]['grace_no']>0&&$val[$day_date]['iom']==0)?$val[$day_date]['grace_no']:'';?></td>
      <td><?=($val[$day_date]['iom']==0&&$val[$day_date]['late_min']>0)?$val[$day_date]['late_min']:'';?></td>
      <td><?=($val[$day_date]['iom']==0&&$val[$day_date]['final_late_min']>0)?$val[$day_date]['final_late_min']:'';?></td>
	  <td><?=$hourdiff = round((strtotime($val[$day_date]['sch_out_time']) - strtotime($val[$day_date]['sch_in_time']))/3600, 1); ?></td><?php */?> 
      <td width="25%"><div align="center"><?=$val[$day_date]['final_status'];?></div></td>
	  
      

	 
	  
	  
   
	  
	  
      </tr>
<? }?>
    <tr bgcolor="#FFFFFF">
      <td colspan="11"><br />
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-striped">
      <tr>
        <th bgcolor="#666666"><div align="center" class="style2">TOTAL DAYS</div></th>
        <th bgcolor="#FFCBA4"><div align="center">HOLYDAYS</div></th>
		<th bgcolor="#F7E7CE"><div align="center">PUBLIC HOLYDAYS</div></th>
        <th bgcolor="#66CDAA"><div align="center">PRESENT</div></th>
        <th bgcolor="#F70D1A"><div align="center" class="style2">ABSENT</div></th>
		<th bgcolor="#D1ECF1">LEAVE</th>
		<th bgcolor="#9FE2BF">OD</th>
		<th bgcolor="#D5D6EA"><div align="center"> SHL </div></th>
		<th bgcolor="#FAF884"><div align="center">LATE IN DAYS</div></th>
        <th bgcolor="#78B4BF"><div align="center" class="style2">DAYOFF</div></th>
        
      </tr>

      <tr >
        <td bgcolor="#CCCCCC"><div align="center">
          <?=$days;?>
        </div></td>
        <td bgcolor="#FFCBA4"><div align="center"><?=$off_days;?></div></td>
        <td bgcolor="#F7E7CE"><div align="center"><?=$public_holy;?></div></td>
        <td bgcolor="#66CDAA"><div align="center"><?=$regular+$late+$od-$absent;?></div></td>
        <td bgcolor="#F70D1A"><div align="center"><?=$absent+$absent_leave_ck;?></div></td>
		<td bgcolor="#D1ECF1"><div align="center"><?=$leave?></div>    <? //=$late_min_total ?></td>
		<td bgcolor="#9FE2BF"><div align="center"><?=$od;?></div></td>
		<td bgcolor="#D5D6EA"><div align="center"><?=$shl?>     <? //if($late_min_p>$late_day_p) echo $late_min_p*.5; else echo $late_day_p*.5;?></div></td>
        <td bgcolor="#FAF884"><div align="center"> <?=$late;?></div></td>
        <td bgcolor="#33CCFF"><div align="center"><?=$Dayoff;?></div></td>
        
      </tr>
    </table>
	</td>
      </tr>
  </table>
  </th>
  </tr>
  </thead>
  <tfoot>
  </tfoot>
  <tbody>
  </tbody>
</table>
  </div><? }?>
  
  
 
	
	
	
	
	</div>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");
include_once("../../template/footer.php");


?>