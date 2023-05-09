<?php

session_start();

ob_start();

require "../../config/inc.all.php";


do_calander("#m_date");
$head ='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
$table = "hrm_inout";

$unique = "id";
$fix_intime = "05:00:00";
$fix_outtime = "11:59:00";


if ($_POST["mon"] != "") {
$mon = $_POST["mon"];
} else {
$mon = date("n");
}


if (isset($_POST["upload"])) {
$year = $_POST["year"];
$mon = $_POST["mon"];
$current_mon_date = $_POST["year"] . "-" . $_POST["mon"] . "-01";


if ($mon == 1) {

//$syear = $year - 1;
$syear = $_POST["year"];
$smon = 12;
} else {

$syear = $year;
$smon = $mon - 1;
}

$emp_id_new = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="' . $_POST['emp_id'] . '"');


$emp_id = $emp_id_new;//$_POST["emp_id"];
$PBI_ORG = $_POST["PBI_ORG"];

$datetime = date("Y-m-d H:i:s");

$start_date = $syear . "-" . $mon . "-01";
$startTime = $days1 = strtotime($start_date);
$days_in_month = date('t',$startTime);
$days_mon = date("t", $startTime);
$end_date = $year . "-" . $mon . "-".$days_in_month;
$endTime = $days2 = mktime(23, 59, 59, $mon, $days_in_month, $year);
$m_s_date = $year . "-" . $mon . "-01";
$m_e_date = $year . "-" . $mon . "-" . $days_mon;







    $holy_day = find_a_field(



        "salary_holy_day",



        "count(holy_day)",



        'holy_day between "' . $start_date . '" and "' . $end_date . '"'



    );







    for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {



        $day = date("l", $i);







        ${"day" . date("N", $i)}++;



    }







    // ------------------------------------------------------------------------------ Manually Set Friday days







    //$r_count=${'day5'};







    $r_count = find_a_field(



        "hrm_payroll_setup",



        "friday_of_month",



        ' `year` = "' . $year . '" and `mon` = "' . $mon . '" '



    );






 $sql ="SELECT h.emp_id,sum(h.leave_duration) lv
FROM `hrm_att_summary` h, personnel_basic_info p
WHERE h.emp_id=p.PBI_ID and h.att_date BETWEEN '" .$start_date ."' AND '" .$end_date ."'  And h.leave_id>0 AND h.dayname = 'Friday' group by h.emp_id";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {

$total_lv_fri[$data->emp_id] = $data->lv;

}

// OFF DAY LEAVE COUNT
 $sql ="SELECT h.emp_id,sum(h.leave_duration) lv
FROM `hrm_att_summary` h, personnel_basic_info p
WHERE h.emp_id=p.PBI_ID and h.att_date BETWEEN '" .$start_date ."' AND '" .$end_date ."'  And h.leave_id>0 AND h.dayname = 'Friday' group by h.emp_id";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {

$total_lv_fri[$data->emp_id] = $data->lv;

}


//holyday leave count 
  $sql ="SELECT h.emp_id,sum(leave_duration) lv FROM `hrm_att_summary` h, salary_holy_day d, personnel_basic_info p
WHERE h.emp_id=p.PBI_ID and h.att_date=d.holy_day and `att_date` BETWEEN '" .$start_date ."' AND '" .$end_date ."'  And leave_id>'0' and  h.dayname != 'Friday'
group by h.emp_id";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
$total_holyday_leave[$data->emp_id] = $data->lv;
}


//holyday OD count 
  $sql ="SELECT h.emp_id,sum(h.od_duration) od_count 
  FROM `hrm_att_summary` h, salary_holy_day d, personnel_basic_info p
WHERE h.emp_id=p.PBI_ID and h.att_date=d.holy_day and `att_date` BETWEEN '" .$start_date ."' AND '" .$end_date ."'  And h.od_id>'0' and  h.dayname != 'Friday'
group by h.emp_id";
$query = mysql_query($sql);
while ($data = mysql_fetch_object($query)) {
$total_holyday_od[$data->emp_id] = $data->od_count;
}



if ($emp_id > 0) {
$emp_con = " and p.PBI_ID='" . $emp_id . "'";
}


if ($PBI_ORG > 0) {
$ORG_con = " and p.PBI_ORG='" . $PBI_ORG . "'";
}

//AND `dayname` != 'Friday' and h.holyday=0 
  $sql = "SELECT h.emp_id,(count(1)-sum(h.leave_duration)) pre, sum(h.final_late_min) l_min,sum(h.final_late_status) l_status,
sum(h.iom_total_hrs) as total_hourly_leave,p.PBI_DOJ,p.PBI_ID,sum(h.final_early_out_status) as early_out ,h.dayname

FROM hrm_att_summary h,personnel_basic_info p
WHERE 1 and p.PBI_ID=h.emp_id and h.att_date BETWEEN '" .$start_date ."' AND '" .$end_date ."'   " .$emp_con .$ORG_con ." 

group by h.emp_id";



$query = mysql_query($sql);

while ($data = mysql_fetch_object($query)) {

$pi++;







        //echo $startTime; echo '<br>'.strtotime($data->PBI_DOJ);

		

		  //$firday_deffine = "Friday";

		 $friday_count = find_a_field('hrm_att_summary','count(dayname)','dayname="Friday" and emp_id="'.$data->emp_id.'" and  att_date BETWEEN "'.$start_date .'" AND "' .$end_date .'"  ');







        $values[$pi]["emp_id"] = $data->emp_id;







        $late_panelty = 0;







        $leave_days_lv = 0;







        $leave_days_lwp = 0;







        $new_emp_days = 0;







        $new_emp_off = 0;







        $new_emp_holy_day = 0;







        $late_panelty =



            (int) (@($data->l_min / 30) > @($data->l_status / 3)



                ? @($data->l_min / 30)



                : @($data->l_status / 3));







        if (strtotime($data->PBI_DOJ) > $startTime) {



            //get friday







            $no = 0;







            $start = new DateTime($data->PBI_DOJ);







            $end = new DateTime($end_date);







            $interval = DateInterval::createFromDateString("1 day");







            $period = new DatePeriod($start, $interval, $end);







            foreach ($period as $dt) {



                if ($dt->format("N") == 5) {



                    $no++;



                }



            }







            $no;







            //get friday







             $new_emp_days = ceil(



                ($endTime - strtotime($data->PBI_DOJ)) / (3600 * 24)



            );







            $new_emp_holy_day = find_a_field(



                "salary_holy_day",



                "count(holy_day)",



                'holy_day between "' .



                    $data->PBI_DOJ .



                    '" and "' .



                    $year .



                    "-" .



                    $mon .



                    "-" .



                    $days_mon .



                    '"'



            );







              $data->PBI_DOJ;







             ${"day5"} = 0;







            for (



                $i = strtotime($data->PBI_DOJ);



                $i <= $endTime;



                $i = $i + 86400



            ) {



                $day = date("l", $i);



                if ($day == "Friday") {



                    ${"day" . date("N", $i)}++;



                }



            }







             $new_emp_off = ${"day5"};



        } else {



            $new_emp_days = $days_mon;







            $new_emp_off = $r_count;







            $new_emp_holy_day = $holy_day;



        }







        // leave







 'PBI_ID="' .



                    $data->PBI_ID .



                    '" and leave_type=1 and leave_id>0 and att_date between "' .



                    $start_date .



                    '" and "' .



                    $end_date .



                    '" ';



  $leave_days_lv = find_a_field(



                "hrm_att_summary",



                "count(1)",



                'emp_id="' .



                    $data->PBI_ID .



                    '" and leave_type IN (1,2,3,4,5,6,7,8,10) and  leave_id>0 and att_date between "' .



                    $start_date .



                    '" and "' .



                    $end_date .



                    '" '



            );







            $leave_days_lwp = find_a_field(



                "hrm_att_summary",



                "count(1)",



                'emp_id="' .



                    $data->PBI_ID .



                    '" and leave_type=9 and leave_id>0 and att_date between "' .



                    $start_date .



                    '" and "' .



                    $end_date .



                    '" '



            );















        $values[$pi]["td"] = $new_emp_days;



          $joing_date = strtotime($data->PBI_DOJ) ;    

		 

		 $cur_mon_date = strtotime($_POST["year"] . "-" . $_POST["mon"] . "-01");



        if ($joing_date > $cur_mon_date) {



            $values[$pi]["od"] = $new_emp_off - $total_lv_fri[$data->PBI_ID];

            $values[$pi]["hd"] = $new_emp_holy_day - $total_holyday_leave[$data->PBI_ID];

            //$values[$pi]["pre"] =  $new_emp_days - ($leave_days_lv + $leave_days_lwp + $new_emp_holy_day + $values[$pi]["od"]);



            $values[$pi]["pre"] =  $data->pre - $friday_count;
             


        } else {



            $values[$pi]["od"] = find_a_field(



                "month_fridays",



                "fridays",



                'mon="' . $mon . '" and year="' . $year . '"'



            );

			

			







            $values[$pi]["hd"] = find_a_field(



                "salary_holy_day",



                "count(id)",



                'holy_day between "' . $m_s_date . '" and "' . $m_e_date . '"'



            );







            $values[$pi]["pre"] = ($data->pre - ($friday_count+$total_holyday_leave[$data->emp_id]+$total_holyday_od[$data->emp_id])); 

    





            $values[$pi]["hourly_leave"] = $data->total_hourly_leave;







            //$data->absent_count;



        }







        //$values[$pi]['lt'] = $late_panelty*.5;

		

		$values[$pi]['lt'] = $late_panelty;







       $values[$pi]["lt"] = $data->l_status;







        $values[$pi]["lv"] = $leave_days_lv;







        $values[$pi]["lwp"] = $leave_days_lwp;







        $values[$pi]["total_over_time"] = $data->total_over_time;







        //$values[$pi]['pay'] = $values[$pi]['pre']  + $values[$pi]['hd'] + $values[$pi]['od'] - $values[$pi]['lt'];











    $values[$pi]["early_out"] = $data->early_out;

    $values[$pi]['pay'] = $values[$pi]['pre'] + $values[$pi]['lv'] + $values[$pi]['hd'] + $values[$pi]['od'];



    $values[$pi]['ab'] = (($values[$pi]['td'])-($values[$pi]['pre'] + $values[$pi]['lv'] + $values[$pi]['lwp'] + $values[$pi]['hd'] + $values[$pi]['od']));



    }







    for ($y = 1; $y <= $pi; $y++) {



        $found = find_a_field("hrm_attendence_final","1",'PBI_ID="' .$values[$y]["emp_id"] .'" and mon="' .$mon .'" and year="' .$year .'"');

       if ($found == 0) {

   $sql = "INSERT INTO `hrm_attendence_final` (`mon`, `year`, `PBI_ID`, `td`, `od`, `hd`, `lt`, `eo`,`ab`, `lv`,`lwp`, `pre`, `pay`,`overtime_hour`,`hourly_leave`, `entry_at`, `entry_by`) 
 values('" .$mon ."','" . $year . "','" .$values[$y]["emp_id"] ."','" .$values[$y]["td"] ."','" .$values[$y]["od"] . "', '" .$values[$y]["hd"] ."',
 '" . $values[$y]["lt"]."', '" .$values[$y]["early_out"] ."', '" .$values[$y]["ab"] ."','" .$values[$y]["lv"] . "','" . $values[$y]["lwp"] . "','" . $values[$y]["pre"] ."',
 '" . $values[$y]["pay"] . "','" .$values[$y]["total_over_time"] ."','" .$values[$y]["hourly_leave"] ."','" .date("Y-m-d H:i:s") ."','" .$_SESSION["user"]["id"] ."')";
mysql_query($sql);
} else {

 $sql ="Update `hrm_attendence_final` set  td='" .



                $values[$y]["td"] .



                "', od='" .



                $values[$y]["od"] .



                "',hd='" .



                $values[$y]["hd"] .



                "', lt='" .



                $values[$y]["lt"] .



                "',  eo='" .



                $values[$y]["early_out"] .



                "',







ab='" .



                $values[$y]["ab"] .



                "',lv='" .



                $values[$y]["lv"] .



                "',lwp='" .



                $values[$y]["lwp"] .



                "',pre='" .



                $values[$y]["pre"] .



                "',pay='" .



                $values[$y]["pay"] .



                "',



overtime_hour='" .



                $values[$y]["total_over_time"] .



                "',hourly_leave='" .



                $values[$y]["hourly_leave"] .



                "',entry_at='" .



                date("Y-m-d H:i:s") .



                "', entry_by='".$_SESSION["user"]["id"]."' where mon='".$mon."' and year='" .$year."' and PBI_ID='".$values[$y]["emp_id"]."' and att_type!='manual'";

          mysql_query($sql);



        }



    }







    $msg =  "Complete";







    //echo $sql;



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

            <h2>ATTENDANCE FINAL SYNC SYSTEM <?=$msg;?></h2>

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

      <div class="oe_view_manager_view_form">

        <div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

          <div class="oe_form_buttons"></div>

          <div class="oe_form_sidebar"></div>

          <div class="oe_form_pager"></div>

          <div class="oe_form_container">

            <div class="oe_form">

              <div class="">

                <div class="oe_form_sheetbg">

                  <div class="oe_form_sheet oe_form_sheet_width">

                    <div  class="oe_view_manager_view_list">

                      <div  class="oe_list oe_view">

                        <table width="80%" border="1" align="center">

                          <tr>

                            <td height="40" colspan="4" bgcolor="#66cdaa"><div align="center" class="style1">ATTENDANCE FINAL SYNC SYSTEM </div></td>

                          </tr>

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

                            <td colspan="3"><span class="oe_form_group_cell">

                              <select name="PBI_ORG" style="width:250px;" id="PBI_ORG">
								<option selected>AKSID CORPORATION</option>

                               <?php /*?> <? foreign_relation('user_group','id','group_name',$PBI_ORG);?><?php */?>

                              </select>

                              </span></td>

                          </tr>

                          <tr>

                            <td style="padding-left:10px" width="20%">Month :</td>

                            <td colspan="3"><span class="oe_form_group_cell">

                              <select name="mon" style="width:250px;" id="mon" required="required">

                                <option value="1" <?= $mon == "01" ? "selected" : "" ?>>Jan</option>

                                <option value="2" <?= $mon == "02" ? "selected" : "" ?>>Feb</option>

                                <option value="3" <?= $mon == "03" ? "selected" : "" ?>>Mar</option>

                                <option value="4" <?= $mon == "04" ? "selected" : "" ?>>Apr</option>

                                <option value="5" <?= $mon == "05" ? "selected" : "" ?>>May</option>

                                <option value="6" <?= $mon == "06" ? "selected" : "" ?>>Jun</option>

                                <option value="7" <?= $mon == "07" ? "selected" : "" ?>>Jul</option>

                                <option value="8" <?= $mon == "08" ? "selected" : "" ?>>Aug</option>

                                <option value="9" <?= $mon == "09" ? "selected" : "" ?>>Sep</option>

                                <option value="10" <?= $mon == "10" ? "selected" : "" ?>>Oct</option>

                                <option value="11" <?= $mon == "11" ? "selected" : "" ?>>Nov</option>

                                <option value="12" <?= $mon == "12" ? "selected" : "" ?>>Dec</option>

                              </select>

                              </span></td>

                          </tr>

                          <tr>

                            <td style="padding-left:10px">Year :</td>

                            <td colspan="3"><select name="year" style="width:250px;" id="year" required="required">

                              

                                <option <?= $year == "2023" ? "selected" : "" ?>>2023</option>

                                <option <?= $year == "2021" ? "selected" : "" ?>>2024</option>

                              </select></td>

                          </tr>

                          <tr>

                            <td colspan="4"><div align="center">

                                <input name="upload" type="submit" class="btn btn-success" id="upload" value="Sync All Data" />

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

                <div class="oe_chatter">

                  <div class="oe_followers oe_form_invisible">

                    <div class="oe_follower_list"></div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </form>

</div>





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

