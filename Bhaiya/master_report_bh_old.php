<?
session_start();
require_once "../../../assets/template/layout.top.php";

require_once "class.numbertoword.php";

date_default_timezone_set('Asia/Dhaka');



//function convertNumberMhafuz(){}























if (isset($_POST['submit']) && isset($_POST['report']) && $_POST['report'] > 0) {







  if ($_POST['name'] != '')







    $con .= ' and a.PBI_NAME like "%' . $_POST['name'] . '%"';























  /*	if($_POST['PBI_ORG']!=''){







	if($_POST['report']==64&&$_POST['PBI_ORG']=='2') { $con.=' and a.PBI_ORG IN (1,2)'; }







	elseif($_POST['report']==78) { $con.=' and t.pbi_organization = "'.$_POST['PBI_ORG'].'"'; }







	else $con.=' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';







	}*/















  if ($_POST['department'] != '') {
    $con .= ' and a.DEPT_ID = "' . $_POST['department'] . '"';
    $DEPARTMENT_con = ' and a.PBI_DEPARTMENT = "' . $_POST['department'] . '"';
  }







  if ($_POST['project'] != '')







    $con .= ' and a.PBI_PROJECT = "' . $_POST['project'] . '"';







  if ($_POST['PBI_DESIGNATION'] != '')







    $con .= ' and a.DESG_ID= "' . $_POST['PBI_DESIGNATION'] . '"';















  if ($_POST['zone'] != '')







    $con .= ' and a.PBI_ZONE = "' . $_POST['zone'] . '"';























  if ($_POST['JOB_LOCATION'] != '') {







    if ($_POST['JOB_LOCATION'] == '1') {







      $con .= ' and a.JOB_LOCATION IN (1,88)';
    } else {







      $con .= ' and a.JOB_LOCATION = "' . $_POST['JOB_LOCATION'] . '"';







      $PBI_LOCATION_con = ' and a.JOB_LOCATION = "' . $_POST['JOB_LOCATION'] . '"';
    }
  }















  if ($_POST['PBI_GROUP'] != '') {







    $con .= ' and a.PBI_GROUP = "' . $_POST['PBI_GROUP'] . '"';







    $PBI_GROUP_con = ' and a.PBI_GROUP = "' . $_POST['PBI_GROUP'] . '"';
  }















  if ($_POST['area'] != '')







    $con .= ' and a.PBI_AREA = "' . $_POST['area'] . '"';















  if ($_POST['report'] != 778 && $_POST['report'] != 79 && $_POST['report'] != 1) {







    if ($_POST['branch'] != '') $con .= ' and t.pbi_region ="' . $_POST['branch'] . '"';
  } else {







    if ($_POST['branch'] != '') $con .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';
  }























  if ($_POST['PBI_DOMAIN'] != '')  $con .= " and PBI_DOMAIN = '" . $_POST['PBI_DOMAIN'] . "'";















  if ($_POST['job_status'] != '' && $_POST['report'] != 7811 && $_POST['report'] != 60 && $_POST['report'] != 61)







    $con .= ' and a.PBI_JOB_STATUS = "' . $_POST['job_status'] . '"';















  if ($_POST['gender'] != '')







    $con .= ' and a.PBI_SEX = "' . $_POST['gender'] . '"';















  if ($_POST['ijdb'] != '')







    $con .= ' and a.PBI_DOJ < "' . $_POST['ijdb'] . '"';







  if ($_POST['ppjdb'] != '')







    $con .= ' and a.PBI_DOJ_PP < "' . $_POST['ppjdb'] . '"';















  if ($_POST['ijda'] != '')







    $con .= ' and a.PBI_DOJ > "' . $_POST['ijda'] . '"';







  if ($_POST['ppjda'] != '')







    $con .= ' and a.PBI_DOJ_PP > "' . $_POST['ppjda'] . '"';















  if ($_POST['start_date'] != '')







    $start_date = $_POST['start_date'];







  if ($_POST['end_date'] != '')







    $end_date = $_POST['end_date'];















  if ($_POST['pbi_id_in'] != '')  $con .= " and a.PBI_ID in (" . $_POST['pbi_id_in'] . ")";















  switch ($_POST['report']) {























    case 1:


      $report = "Employee Basic Information";







      if ($_REQUEST['PBI_SEX'] != '') {

        $con .= "and a.PBI_SEX='" . $_REQUEST['PBI_SEX'] . "'";
      }


      $sql = "select 


a.PBI_CODE as Employee_Id,a.PBI_NAME as Name,



a.MACHINE_ID as MACHINE_ID,



(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,


(select DEPT_DESC from department where DEPT_ID = a.DEPT_ID) as department,


DATE_FORMAT(a.PBI_DOJ,'%d-%m-%Y') as joining_date,


DATE_FORMAT(a.PBI_DOC2,'%d-%m-%Y') as confirmation_date,

CONCAT(TIMESTAMPDIFF(YEAR, `PBI_DOJ`, CURDATE()),' Year,',

TIMESTAMPDIFF(MONTH, `PBI_DOJ`, CURDATE()) % 12,' mon') as service,

PBI_SEX as gender,PBI_RELIGION as religion,PBI_BLOOD_GROUP as blood_group,

(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,a.PBI_MOBILE as mobile,a.PBI_EMAIL as email,

a.nid as nid,


a.PBI_BANK_ACC_NO as Bank_Account,

EMPLOYMENT_TYPE


from personnel_basic_info a 


where	1 " . $con . " order by a.PBI_ID asc";























      // DATE_FORMAT(a.PBI_DOC,'%d-%m-%Y') as due_confirmation_date,







      // (select DESG_DESC from designation where DESG_SHORT_NAME=a.PBI_DESIGNATION) as designation,







      //  schedule_type,punch_type,define_offday,define_schedule,general_schedule,grace_type,employee_type















      break;























    case 22:







      $report = "Employee Payroll Information For Recruitment";















      break;























    case 23:







      $report = "Employee Payroll Information";























      $sql = "select 







(select group_name from user_group where id = a.PBI_ORG) as company,







(select LOCATION_NAME from office_location where ID=a.job_location) as location,







(select dept_desc from department where DEPT_SHORT_NAME = a.PBI_DEPARTMENT) as department,















a.PBI_ID as CODE,







a.PBI_NAME as Name,







(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,















a.PBI_GROUP as `Group`,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,















a.PBI_MOBILE as mobile,







s.basic_salary,







s.special_allowance as sp_Allow,







s.incentive_allowance as inc_allow,







s.ta as ta_da,







s.food_allowance as food_allow,







s.mobile_allowance as mobile_allow,







s.house_rent,







s.cash_bank as bank,s.cash as bank_code,s.branch_info,























(select pbi_held_up from salary_attendence where PBI_ID=a.PBI_ID order by id desc limit 1) as held_up















from personnel_basic_info a , salary_info s







where	







a.PBI_ID=s.PBI_ID 







" . $con . "







order by a.PBI_ID";















      break;























    case 201:







      $report = "Employee Leave Information";







      break;























    case 203:







      $report = "Leave Encashment Report-2020";







      break;















    case 22222:







      $report = "HRM Roaster Summary report";







      break;















    case 777:







      $report = "Employee Bonus Report";







      if ($_POST['branch'] != '')







        $con .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';















      $sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name, (select DESG_DESC from designation where DESG_SHORT_NAME=a.PBI_DESIGNATION) as designation,







		date_format(a.PBI_DOJ,'%d-%m-%Y') as joining_date, 







		if(s.bonus_mode!='Bank','',s.cash) as bank_AC, 







		b.basic_salary, 







		if((bonus_days<180 && job_status!='Permanent'), bonus_days, '') as payable_days,







		b.bonus_amt as Bonus_amount, 







		b.bank_paid, 







		if(s.cash_bank='DBBL', b.bank_paid, '') as DBBL , 







		if(s.cash_bank='IBBL', b.bank_paid, '') as IBBL , 







		b.cash_paid, 







		' ' as Signature  







		







		from personnel_basic_info a, salary_bonus b, salary_info s 







		







		where 







		1 and a.PBI_ID=b.PBI_ID and 







		s.PBI_ID=b.PBI_ID and b.bonus_type=" . $_POST['bonus_type'] . " and 







		b.year=" . $_POST['year'] . " " . $con . " 







		and b.pbi_held_up = 0







		order by a.pbi_grade desc,b.bonus_amt desc,a.PBI_DESG_GRADE asc







		";







      // a.PBI_JOB_STATUS= 'In Service'















      break;















    case 64:







      $report = "Employee Bonus Summery Report";















      if ($_POST['branch'] != '') $con .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';























      $sql = "







select d.DEPT_DESC as department, 







sum(b.basic_salary) as basic_salary, 







sum(b.bonus_amt) as Bonus_amount, 







sum(b.bank_paid) as bank_paid, 







if(s.cash_bank='DBBL', sum(b.bank_paid), '') as DBBL , 







if(s.cash_bank='IBBL', sum(b.bank_paid), '') as IBBL , 







sum(b.cash_paid) as cash_paid, 







sum(b.bonus_amt) as net_payable, 







' ' as Remarks 















from personnel_basic_info a, salary_bonus b, salary_info s,department d















where 1 







and b.PBI_ID=a.PBI_ID







and b.pbi_department=d.DEPT_SHORT_NAME







and s.PBI_ID=b.PBI_ID







and b.bonus_type=" . $_POST['bonus_type'] . " 







and b.year=" . $_POST['year'] . " " . $con . " 







		







group by d.DEPT_DESC







order by d.DEPT_DESC







";















      break;















    case 65:







      $report = "Employee Bonus Sales Summery Report";























      break;































    case 778:















      $report = "Employee Bonus Report (Sales)";







      if ($_POST['branch'] != '')







        $con .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';























      $sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation, date_format(a.PBI_DOJ,'%d-%m-%Y') as joining_date,







		 if(b.cash_paid>0 && a.PBI_AREA!='',(select concat('[',d.dealer_code,'] - ',d.dealer_name_e,' - ',aa.AREA_NAME) from  dealer_info d, area aa where d.dealer_code=b.dealer_code and d.area_code=aa.AREA_CODE),'') as dealer_name,







		if(s.bonus_mode!='Bank','',s.cash) as bank_AC, 







		b.basic_salary, 







		if((bonus_days<180 && job_status!='Permanent'), bonus_days, '') as payable_days, 







		b.bonus_amt as Bonus_amount, 







		b.bank_paid, 







		if(s.cash_bank='DBBL', b.bank_paid, '') as DBBL ,







		if(s.cash_bank='ROCKET', b.bank_paid, '') as ROCKET , 







		if(s.cash_bank='IBBL', b.bank_paid, '') as IBBL , 







		b.cash_paid, ' ' as Signature  







		from personnel_basic_info a, salary_bonus b, salary_info s 







		where 







		1 and a.PBI_ID=b.PBI_ID and 







		s.PBI_ID=b.PBI_ID and b.bonus_type=" . $_POST['bonus_type'] . " and 







		b.year=" . $_POST['year'] . " " . $con . " 







		







		order by b.bonus_amt desc,a.PBI_DESG_GRADE asc







		";















      // 		and b.pbi_held_up = 0







      break;























    case 10001:















      $report = "Employee Details Information";















      $sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,







(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,







a.PBI_DEPARTMENT as department,







a.incharge_id,a.PBI_DOMAIN Section, a.PBI_GROUP as `Group`,







DATE_FORMAT(a.PBI_DOJ,'%d-%m-%Y') as joining_date,







DATE_FORMAT(a.PBI_DOJ_PP,'%d-%m-%Y') as PP_joining_date,















DATE_FORMAT(a.PBI_DOC,'%d-%m-%Y') as doc,







DATE_FORMAT(a.PBI_DOC2,'%d-%m-%Y') as doc2,















(select group_name from user_group where id=a.PBI_ORG) as Company ,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







a.PBI_EDU_QUALIFICATION as qualification,a.PBI_MOBILE as mobile,PBI_JOB_STATUS job_status,







(select LOCATION_NAME from office_location where id=a.JOB_LOCATION) JOB_LOCATION,a.PBI_POB as home_dist, PBI_PERMANENT_ADD as permanent_address,PBI_PRESENT_ADD as present_address, a.PBI_EMAIL email







from personnel_basic_info a 







where	1 " . $con;































      break;























    case 2:



      $report = "Employee Salary & Benefits Information";



      $sql = "select a.PBI_CODE as EMP_CODE,a.PBI_NAME as Name,

(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,

(select DEPT_DESC from department where DEPT_ID = a.DEPT_ID) as department,

b.cash as AC_NO,

b.basic_salary,b.house_rent,

b.ta conveyance,b.mobile_allowance,b.entertainment,b.food_allowance,

b.medical_allowance,

b.gross_salary as total_salary



from personnel_basic_info a,salary_info b where	a.PBI_ID=b.PBI_ID " . $con . " order by (b.consolidated_salary+b.basic_salary) desc";







      break;































    case 3:







      $report = "Monthly Attendence Report";















      if ($_POST['PBI_ORG'] != '') {
        $con_3 .= ' and a.PBI_ORG = "' . $_POST['PBI_ORG'] . '"';
      }







      if ($_POST['department'] != '') {
        $con_3 .= ' and a.PBI_DEPARTMENT = "' . $_POST['department'] . '"';
      }







      if ($_POST['JOB_LOCATION'] != '') {
        $con_3 .= ' and a.JOB_LOCATION = "' . $_POST['JOB_LOCATION'] . '"';
      }







      if ($_POST['PBI_GROUP'] != '') {
        $con_3 .= ' and a.PBI_GROUP = "' . $_POST['PBI_GROUP'] . '"';
      }







      if ($_POST['branch'] > 0) {
        $con_3 .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';
      }







      if ($_POST['zone'] > 0) {
        $con_3 .= ' and a.PBI_ZONE ="' . $_POST['zone'] . '"';
      }







      if ($_POST['area'] > 0) {
        $con_3 .= ' and a.PBI_AREA ="' . $_POST['area'] . '"';
      }







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {















        $mon = $_POST['mon'];







        $year = $_POST['year'];















        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,







(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,







a.PBI_DEPARTMENT as department, b.td as total_day,b.od as off_day,b.hd as holy_day, b.lt as late_days, 	b.ab as absent_days,b.lv as leave_days,b.pre as present_days, b.pay as payable_days,b.ot as over_time_hour 







FROM personnel_basic_info a, salary_attendence b 







where a.PBI_ID=b.PBI_ID 







and b.mon='" . $mon . "' 







and b.year='" . $year . "'







" . $con_3;
      }







      break;































    case 80:







      $report = "Attendance Summary Portal";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];















        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,







(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,







a.PBI_DEPARTMENT as department, b.td,b.od,b.hd,b.lt, b.ab,b.lv,b.pre,b.pay,b.remarks







FROM personnel_basic_info a,hrm_attendence_final b 







where a.PBI_ID=b.PBI_ID 







and b.remarks !=''







and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con . "







order by CODE







";
      }







      break;















    case 81:

      $report = "Attendance Summary Portal";

      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {
        $mon = $_POST['mon'];

        $year = $_POST['year'];


        if ($_POST['PBI_ID'] != '') {
          $id_con .= ' and a.PBI_ID = "' . $_POST['PBI_ID'] . '"';
        }

        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,

(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,

a.PBI_DEPARTMENT as department, b.td,b.od,b.hd,b.lt, b.ab,b.lv,b.pre,b.pay,b.ot,b.status as held_up,b.remarks

FROM personnel_basic_info a,hrm_attendence_final b 

where a.PBI_ID=b.PBI_ID 

and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con . $id_con . "

order by CODE";
      }
      break;






    case 788:

      $report = "Attendance Summary Portal";

      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {
        $mon = $_POST['mon'];

        $year = $_POST['year'];


        if ($_POST['PBI_ID'] != '') {
          $id_con .= ' and a.PBI_ID = "' . $_POST['PBI_ID'] . '"';
        }

        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,

(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,

a.PBI_DEPARTMENT as department, b.td,b.od,b.hd,b.lt, b.ab,b.lv,b.pre,b.pay,b.ot,b.status as held_up,b.remarks

FROM personnel_basic_info a,hrm_attendence_final b 

where a.PBI_ID=b.PBI_ID 

and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con . $id_con . "

order by CODE";
      }
      break;







    case 888:

      $report = "Attendance Summary Portal";

      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {
        $mon = $_POST['mon'];

        $year = $_POST['year'];


        if ($_POST['PBI_ID'] != '') {
          $id_con .= ' and a.PBI_ID = "' . $_POST['PBI_ID'] . '"';
        }

        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,

(select DESG_DESC from designation where DESG_ID = a.DESG_ID) as designation,

a.PBI_DEPARTMENT as department, b.td,b.od,b.hd,b.lt, b.ab,b.lv,b.pre,b.pay,b.ot,b.status as held_up,b.remarks

FROM personnel_basic_info a,hrm_attendence_final b 

where a.PBI_ID=b.PBI_ID 

and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con . $id_con . "

order by CODE";
      }
      break;
















    case 4:







      $report = "Over Time Report";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department, b.ot as over_time_hour,(b.total_salary/208) as rate,b.over_time_amount FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
      }







      break;







    case 5:







      $report = "Salary Payroll Report (Detail)";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,







	b.od,b.hd,b.lt,b.ab,b.lv,b.pre,b.pay,







	b.over_time_amount,







	b.basic_salary,b.total_salary as consolidated_salary,b.house_rent,b.medical_allowance,b.other_allowance,b.special_allowance,b.ta_da as TA_DA, b.food_allowance as fooding, b.mobile_allowance,b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.total_benefits,b.total_payable*(1.00) as total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
      }







      break;















    case 6:







      $report = "Salary Payroll Report (Summary)";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,







	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.total_benefits,b.total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
      }







      break;















    case 60:







      $report = "IOM Report";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        $totalDays = date('t', mktime(0, 0, 0, $mon, 01, $year));







        $startDate = $year . '-' . $mon . '-01';







        $endDate = $year . '-' . $mon . '-' . $totalDays;















        $sql = "SELECT id, PBI_DEPT_HEAD, dept_head_status, dept_head_aprv_at, PBI_ID, type, iom_dur, s_date, e_date, total_days, reason, note 



	 FROM hrm_iom_info where s_date>='" . $startDate . "' and e_date<='" . $endDate . "'  order by id desc";
      }







      break;















    case 61:







      $report = "Leave Report";







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        $totalDays = date('t', mktime(0, 0, 0, $mon, 01, $year));







        $startDate = $year . '-' . $mon . '-01';







        $endDate = $year . '-' . $mon . '-' . $totalDays;















        $sql = "SELECT id, PBI_ID, type, lv_dur, s_date, e_date, total_days, half_or_full, reason, paid_status, leave_join_date, leave_address, leave_mobile_number, leave_responsibility_name, leave_status, note 







FROM hrm_leave_info where s_date>='" . $startDate . "' and e_date<='" . $endDate . "' " . $con . " order by id desc";
      }







      break;















    case 7:







      $report = "Salary Payroll Report";







      break;















    case 77:







      $report = "Salary Payroll Report Final (Sales)";







      break;







    case 78:







      $report = "Salary Payroll Report Final";







      break;























    case 82:







      $report = "Group Salary Payroll Report";







      break;















      /*case 79:







	$report="Salary Pay Slip";







	if($_POST['mon']>0&&$_POST['year']>0)







	{







	$mon = $_POST['mon'];







	$year = $_POST['year'];







	}







break;







*/







    case 8:







      $report = "Staff Mobile Information(Changable)";







      break;







    case 66:







      $report = "Bill of Salary for the month of " . date('M', $_POST['mon']) . '-' . $_POST['year'];







      if ($_POST['mon'] > 0 && $_POST['year'] > 0) {







        $mon = $_POST['mon'];







        $year = $_POST['year'];







        echo  $sql = "SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as desg ,a.PBI_DEPARTMENT as dept,a.PBI_DOJ joining_date,b.pre,b.od,b.hd,b.lv,b.lwp,b.ab,b.pay,







	  b.total_salary,b.special_allowance,(b.total_salary+b.special_allowance) actual_amount,







	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction, (b.total_salary-b.total_deduction) as actual_salary, b.total_benefits,b.total_payable FROM 







	







	personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='" . $mon . "' and b.year='" . $year . "'" . $con;
      }







      break;







    case 11:







      $report = "OutStanding Dues";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and d.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }







      $sql = "select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no and rcv_status=0 " . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";







      break;







    case 12:







      $report = "Expected Collection";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and d.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }







      $sql = "select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no " . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";







      break;































    case 13:







      $report = "Payment Schedule";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and d.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.inst_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }







      $sql = "SELECT e.pay_desc,a.inst_no, c.proj_name AS project_name,a.flat_no AS allot_no,  a.inst_date, a.inst_amount AS payable_amt, a.rcv_date AS receive_date, a.rcv_amount AS receive_amt







FROM 







tbl_flat_cost_installment a, 







tbl_party_info b, 







tbl_project_info c, 







tbl_flat_info d,







tbl_payment_head e







WHERE a.proj_code = c.proj_code







AND d.party_code = b.party_code







AND a.proj_code = d.proj_code







AND a.build_code = d.build_code







AND a.flat_no = d.flat_no







AND a.pay_code = e.pay_code" . $proj_con . $date_con . $flat_con . $party_con . " order by a.inst_date";







      break;







    case 14:







      $report = "Party Rent Agreement Terms";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and a.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      $sql = "SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`monthly_rent`,a.`effective_date`,a.`expire_date`,a.`notice_period`,a.discontinue_term,a.`witness1`,a.`witness1_address` FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;







      break;







    case 15:







      $report = "Party Rent Payment Terms";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and a.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      $sql = "SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`security_money`,a.`monthly_rent`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,(a.`monthly_rent`++a.`electricity_bill`+a.`other_bill`+a.`wasa_bill`+a.`gas_bill`) as total_payable FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;







      break;







    case 16:







      $report = "Party Rent Payment Terms";







      if (isset($party_code)) {
        $client_name = find_a_field('tbl_party_info', 'party_name', 'party_code=' . $party_code);
        $party_con = ' and a.party_code=' . $party_code;
      }







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }















      $sql = "SELECT a.jv_no as Invoice_no,a.mon as period,b.`proj_name`,a.`flat_no`,c.`party_name`,a.`rent_amt`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,total_amt as total_amt FROM `tbl_rent_receive` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code " . $proj_con . $flat_con . $party_con;







      break;















    case 24:







      $report = "Collection Statement(Cash)";







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }







      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.rec_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }







      $sql = "select a.rec_date as tr_date,b.proj_name" . $flat_show . ",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=0 and a.proj_code=b.proj_code " . $proj_con . $date_con . $flat_con . " order by a.rec_date";







      break;







    case 25:







      $report = "Collection Statement(Chaque)";







      if (isset($proj_code))







        if (!isset($flat_no)) {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
          $proj_con = ' and a.proj_code=' . $proj_code;
        } else {
          $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);







          $allotment_no = $flat_no;
          $flat_show = ',a.flat_no as allot_no';
          $flat_con = ' and a.proj_code=' . $proj_code . ' and a.flat_no=\'' . $flat_no . '\' ';
        }







      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.rec_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }







      $sql = "select a.rec_date as tr_date,a.cheq_no,b.proj_name" . $flat_show . ",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=1 and a.proj_code=b.proj_code " . $proj_con . $date_con . $flat_con . " order by a.rec_date";







      break;























      // COMMISION REPORTS







    case 31:







      $report = "Share Holder Investment Amount";







      if (isset($proj_code)) {
        $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
        $proj_con = ' and a.proj_code=' . $proj_code;
      }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }















      $sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`status`,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code`" . $date_con . $proj_con . " order by a.proj_code,a.agent_code";







      break;















    case 33:







      $report = "Running Share Holder Information";







      if (isset($proj_code)) {
        $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
        $proj_con = ' and a.proj_code=' . $proj_code;
      }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }















      $sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Running' " . $date_con . $proj_con . " order by a.proj_code,a.agent_code";







      break;















    case 34:







      $report = "Withdrawn Share Holder Information";







      if (isset($proj_code)) {
        $project_name = find_a_field('tbl_project_info', 'proj_name', 'proj_code=' . $proj_code);
        $proj_con = ' and a.proj_code=' . $proj_code;
      }















      if (isset($t_date)) {
        $to_date = $t_date;
        $fr_date = $f_date;
        $date_con = ' and a.opening_date between \'' . $fr_date . '\' and \'' . $to_date . '\'';
      }















      $sql = "SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`status_date` as withdrawn_date,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Withdrawn' " . $date_con . $proj_con . " order by a.proj_code,a.agent_code";







      break;















    case 35:







      $report = "Agent Information";















      $sql = "SELECT `emp_id`,`emp_name`,`emp_designation`,`emp_joining_date`,`emp_contact_no`, (select count(1) from tbl_director_info where agent_code=a.emp_id) as total_member, (select sum(invested) from tbl_director_info where agent_code=a.emp_id) as total_invested, (select sum(withdraw) from tbl_director_info where agent_code=a.emp_id)  as total_withdrawn FROM `tbl_employee_info` as a WHERE 1";







      break;















    case 101:







      $report = "APR Information";







      if ($_POST['markb'] != '')







        $con .= ' and b.APR_MARKS < "' . $_POST['markb'] . '"';















      if ($_POST['marka'] != '')







        $con .= ' and b.APR_MARKS > "' . $_POST['marka'] . '"';







      $year = $_POST['year'];







      $con .= ' and b.APR_YEAR = "' . $year . '"';







      $sql = "select a.PBI_ID as ID,a.PBI_NAME as Name,a.PBI_SEX as Gender,a.PBI_DOMAIN as Domain,a.PBI_DEPARTMENT as department,a.PBI_PROJECT as project	,a.PBI_DESIGNATION as designation ,a.PBI_DESG_GRADE as grade,a.PBI_ZONE as zone,a.PBI_AREA as area,t.pbi_region PBI_BRANCH as branch,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,b.APR_YEAR,b.APR_MARKS,(select avg(APR_MARKS) from apr_detail where APR_YEAR in (" . $year . "," . ($year - 1) . "," . ($year - 2) . ") and PBI_ID=a.PBI_ID) as avg_marks,b.APR_STATUS,b.APR_RESULT  from personnel_basic_info a,apr_detail b where a.PBI_ID=b.PBI_ID " . $con;







      break;























    case 1001:







      $report = "Distributor Dealer Information";







      if ($_POST['dealer_name_e'] != '')







        $con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';







      if ($_POST['dealer_code'] != '')







        $con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';















      if ($_POST['division_code'] != '')







        $con .= ' and a.division_code = "' . $_POST['division_code'] . '"';







      elseif ($_POST['district_code'] != '')







        $con .= ' and a.district_code = "' . $_POST['district_code'] . '"';







      elseif ($_POST['thana_code'] != '')







        $con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';























      if ($_POST['region_code'] != '')







        $con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['region_code'] . '") ';







      elseif ($_POST['zone_code'] != '')







        $con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['area_code'] != '')







        $con .= ' and a.area_code = "' . $_POST['area_code'] . '"';























      if ($_POST['canceled'] != '')







        $con .= ' and a.canceled = "' . $_POST['canceled'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.depot = "' . $_POST['depot'] . '"';















      if ($_POST['product_group'] != '')







        $con .= ' and a.product_group = "' . $_POST['product_group'] . '"';







      if ($_POST['mobile_no'] != '')







        $con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';















      $sql = "select a.dealer_code as code,concat(a.account_code,'-') as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.product_group as GRP,b.AREA_NAME as area,z.ZONE_NAME as zone,r.BRANCH_NAME as region,a.propritor_name_e as propritor_name ,a.address_e as address,a.mobile_no ,a.app_date, a.canceled as active,w.warehouse_name as depot from dealer_info a,area b,zon z,branch r,warehouse w 







		 where z.region_id =r.BRANCH_ID and b.ZONE_ID =z.ZONE_CODE and a.dealer_type='Distributor' and a.area_code = b.AREA_CODE and w.warehouse_id=a.depot " . $con . " order by a.dealer_code desc";







      break;















    case 1002:







      $report = "Super Shop Dealer Information";







      if ($_POST['dealer_name_e'] != '')







        $con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';







      if ($_POST['dealer_code'] != '')







        $con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';















      if ($_POST['division_code'] != '')







        $con .= ' and a.division_code = "' . $_POST['division_code'] . '"';







      elseif ($_POST['district_code'] != '')







        $con .= ' and a.district_code = "' . $_POST['district_code'] . '"';







      elseif ($_POST['thana_code'] != '')







        $con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';























      if ($_POST['region_code'] != '')







        $con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['zone_code'] != '')







        $con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['area_code'] != '')







        $con .= ' and a.area_code = "' . $_POST['area_code'] . '"';























      if ($_POST['canceled'] != '')







        $con .= ' and a.canceled = "' . $_POST['canceled'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.depot = "' . $_POST['depot'] . '"';















      if ($_POST['product_group'] != '')







        $con .= ' and a.product_group = "' . $_POST['product_group'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';































      $sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.product_group as GRP,a.propritor_name_e as propritor_name ,a.address_e as address,a.mobile_no ,a.app_date, a.canceled as active,w.warehouse_name as depot from dealer_info a,warehouse w where a.dealer_type='SuperShop' and w.warehouse_id=a.depot " . $con . " order by a.dealer_code desc";















      break;







    case 1003:







      $report = "Corporate Dealer Information";







      if ($_POST['dealer_name_e'] != '')







        $con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';







      if ($_POST['dealer_code'] != '')







        $con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';















      if ($_POST['division_code'] != '')







        $con .= ' and a.division_code = "' . $_POST['division_code'] . '"';







      elseif ($_POST['district_code'] != '')







        $con .= ' and a.district_code = "' . $_POST['district_code'] . '"';







      elseif ($_POST['thana_code'] != '')







        $con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';























      if ($_POST['region_code'] != '')







        $con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['zone_code'] != '')







        $con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['area_code'] != '')







        $con .= ' and a.area_code = "' . $_POST['area_code'] . '"';























      if ($_POST['canceled'] != '')







        $con .= ' and a.canceled = "' . $_POST['canceled'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.depot = "' . $_POST['depot'] . '"';















      if ($_POST['product_group'] != '')







        $con .= ' and a.product_group = "' . $_POST['product_group'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';















      $sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.product_group as GRP,a.propritor_name_e as propritor_name ,a.address_e as address,a.mobile_no ,a.app_date, a.canceled as active,w.warehouse_name as depot from dealer_info a,warehouse w where a.dealer_type='Corporate' and w.warehouse_id=a.depot " . $con . " order by a.dealer_code desc";







      break;















    case 1004:







      $report = "TradeFair Dealer Information";







      if ($_POST['dealer_name_e'] != '')







        $con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';







      if ($_POST['dealer_code'] != '')







        $con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';















      if ($_POST['division_code'] != '')







        $con .= ' and a.division_code = "' . $_POST['division_code'] . '"';







      elseif ($_POST['district_code'] != '')







        $con .= ' and a.district_code = "' . $_POST['district_code'] . '"';







      elseif ($_POST['thana_code'] != '')







        $con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';























      if ($_POST['region_code'] != '')







        $con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['zone_code'] != '')







        $con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['area_code'] != '')







        $con .= ' and a.area_code = "' . $_POST['area_code'] . '"';























      if ($_POST['canceled'] != '')







        $con .= ' and a.canceled = "' . $_POST['canceled'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.depot = "' . $_POST['depot'] . '"';















      if ($_POST['product_group'] != '')







        $con .= ' and a.product_group = "' . $_POST['product_group'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';















      $sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.product_group as GRP,a.propritor_name_e as propritor_name ,a.address_e as address,a.mobile_no ,a.app_date, a.canceled as active,w.warehouse_name as depot from dealer_info a,warehouse w where a.dealer_type='TradeFair' and w.warehouse_id=a.depot " . $con . " order by a.dealer_code desc";







      break;







    case 1005:







      $report = "BulkBuyer Dealer Information";







      if ($_POST['dealer_name_e'] != '')







        $con .= ' and a.dealer_name_e like "%' . $_POST['dealer_name_e'] . '%"';







      if ($_POST['dealer_code'] != '')







        $con .= ' and a.dealer_code = "' . $_POST['dealer_code'] . '"';















      if ($_POST['division_code'] != '')







        $con .= ' and a.division_code = "' . $_POST['division_code'] . '"';







      elseif ($_POST['district_code'] != '')







        $con .= ' and a.district_code = "' . $_POST['district_code'] . '"';







      elseif ($_POST['thana_code'] != '')







        $con .= ' and a.thana_code = "' . $_POST['thana_code'] . '"';























      if ($_POST['region_code'] != '')







        $con .= ' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['zone_code'] != '')







        $con .= ' and a.area_code in (select AREA_CODE from area where ZONE_ID="' . $_POST['zone_code'] . '") ';







      elseif ($_POST['area_code'] != '')







        $con .= ' and a.area_code = "' . $_POST['area_code'] . '"';























      if ($_POST['canceled'] != '')







        $con .= ' and a.canceled = "' . $_POST['canceled'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.depot = "' . $_POST['depot'] . '"';















      if ($_POST['product_group'] != '')







        $con .= ' and a.product_group = "' . $_POST['product_group'] . '"';







      if ($_POST['depot'] != '')







        $con .= ' and a.mobile_no = "' . $_POST['mobile_no'] . '"';















      $sql = "select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.product_group as GRP,a.propritor_name_e as propritor_name ,a.address_e as address,a.mobile_no ,a.app_date, a.canceled as active,w.warehouse_name as depot from dealer_info a,warehouse w where a.dealer_type='BulkBuyer' and w.warehouse_id=a.depot and a.group_for='" . $_SESSION['user']['group'] . "' " . $con . " order by a.dealer_code desc";







      break;























    case 7841:







      $report = "Summary of Salary ";







      break;







    case 7842:







      $report = "Summary of Salary ";







      break;
  }
}















?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>
    <?= $report ?>
  </title>
  <script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
  <script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>
  <script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>
  <script type="text/javascript" src="../../js/jquery.validate.js"></script>
  <script type="text/javascript" src="../../js/paging.js"></script>
  <script type="text/javascript" src="../../js/ddaccordion.js"></script>
  <script type="text/javascript" src="../../js/js.js"></script>
  <script type="text/javascript" src="../../js/pg.js"></script>
  <link href="../../css/report.css" type="text/css" rel="stylesheet" />
  <style>
    /*.vertical-text div {







	transform: rotate(-90deg);







	transform-origin: left top 1;







	float: left;







	width: 2px;







	padding: 1px;







	







	







}*/







    @media print {

      thead {
        display: table-header-group;
      }

    }







    .vertical-text div {















      float: left;







    }
  </style>
  <script type="text/javascript">
    function hide()







    {







      document.getElementById('pr').style.display = 'none';







    }















    function update_value(id)







    {







      var mobile = document.getElementById('mobile#' + id).value;







      var sim = document.getElementById('sim#' + id).value;







      getData2('rd_issue_ajax.php', 'po' + id, id, mobile + '#>' + sim);







    }















    function Pager(tableName, itemsPerPage) {







      this.tableName = tableName;







      this.itemsPerPage = itemsPerPage;







      this.currentPage = 1;







      this.pages = 0;







      this.inited = false;















      this.showRecords = function(from, to) {







        var rows = document.getElementById(tableName).rows;







        // i starts from 1 to skip table header row







        for (var i = 1; i < rows.length; i++) {







          if (i < from || i > to) rows[i].style.display = 'none';







          else rows[i].style.display = '';







        }







      }















      this.showPage = function(pageNumber) {







        if (!this.inited) {







          alert("not inited");







          return;







        }















        var oldPageAnchor = document.getElementById('pg' + this.currentPage);







        oldPageAnchor.className = 'pg-normal';















        this.currentPage = pageNumber;







        var newPageAnchor = document.getElementById('pg' + this.currentPage);







        newPageAnchor.className = 'pg-selected';















        var from = (pageNumber - 1) * itemsPerPage + 1;







        var to = from + itemsPerPage - 1;







        this.showRecords(from, to);







      }















      this.prev = function() {







        if (this.currentPage > 1)







          this.showPage(this.currentPage - 1);







      }















      this.next = function() {







        if (this.currentPage < this.pages) {







          this.showPage(this.currentPage + 1);







        }







      }















      this.init = function() {







        var rows = document.getElementById(tableName).rows;







        var records = (rows.length - 1);







        this.pages = Math.ceil(records / itemsPerPage);







        this.inited = true;







      }















      this.showPageNav = function(pagerName, positionId) {







        if (!this.inited) {







          alert("not inited");







          return;







        }







        var element = document.getElementById(positionId);















        var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal">Prev</span>';







        for (var page = 1; page <= this.pages; page++)







          pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';







        pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">Next</span>';















        element.innerHTML = pagerHtml;







      }







    }







    var XMLHttpRequestObject = false;















    if (window.XMLHttpRequest)







      XMLHttpRequestObject = new XMLHttpRequest();







    else if (window.ActiveXObject)







    {







      XMLHttpRequestObject = new







      ActiveXObject("Microsoft.XMLHTTP");







    }







    function getData(dataSource, divID, data)







    {







      if (XMLHttpRequestObject)







      {







        var obj = document.getElementById(divID);







        XMLHttpRequestObject.open("POST", dataSource);







        XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');















        XMLHttpRequestObject.onreadystatechange = function()







        {







          if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)







            obj.innerHTML = XMLHttpRequestObject.responseText;







        }







        XMLHttpRequestObject.send("ledger=" + data);







      }







    }







    function getData2(dataSource, divID, data1, data2)







    {







      if (XMLHttpRequestObject)







      {







        var obj = document.getElementById(divID);







        XMLHttpRequestObject.open("POST", dataSource);







        XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');















        XMLHttpRequestObject.onreadystatechange = function()







        {







          if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)







            obj.innerHTML = XMLHttpRequestObject.responseText;







        }







        XMLHttpRequestObject.send("data=" + data1 + "##" + data2);















      }







    }







    function getflatData3()







    {







      var b = document.getElementById('category_to').value;







      var a = document.getElementById('proj_code_to').value;







      $.ajax({







        url: '../../common/flat_option_new3.php',







        data: "a=" + a + "&b=" + b,







        success: function(data) {







          $('#fid3').html(data);







        }







      });







    }







    function getflatData2()







    {







      var b = document.getElementById('category_from').value;







      var a = document.getElementById('proj_code_from').value;







      $.ajax({







        url: '../../common/flat_option_new2.php',







        data: "a=" + a + "&b=" + b,







        success: function(data) {







          $('#fid2').html(data);







        }







      });







    }
  </script>
  <?
  require_once "../../../assets/support/inc.exporttable.php";
  ?>
</head>

<body>
  <form action="?" method="post">
    <!--<div align="center" id="pr">







<input type="button" value="Print" onclick="hide();window.print();"/>







</div>-->
    <div class="main">
      <?







      //echo $sql;







      $str   .= '<div class="header">';







      if ($_POST['PBI_ORG'] != '')







        $str   .= '<h2 style="font-size:24px;">' . find_a_field('user_group', 'group_name', 'id=' . $_POST['PBI_ORG']) . '</h2>';







      if (isset($report))







        $str   .= '<h2>' . $report . '</h2>';







      if ($_POST['mon'] != '') {







        if ($_POST['report'] == 777 || $_POST['report'] == 778 || $_POST['report'] == 64) {







          if ($_POST['bonus_type'] == 1) {







            $str   .= '<h2>Bonus of Eid-Ul-Fitre ' . date('Y', mktime(1, 1, 1, $_POST['mon'], 1, $_POST['year'])) . '</h2>';
          } else {







            $str   .= '<h2>Bonus of Eid-Ul-Adha ' . date('Y', mktime(1, 1, 1, $_POST['mon'], 1, $_POST['year'])) . '</h2>';
          }
        } else {







          if ($_POST['report'] != 203)







            $str   .= '<h2>Report of Month: ' . date('F-Y', mktime(1, 1, 1, $_POST['mon'], 1, $_POST['year'])) . '</h2>';
        }
      }















      if ($_POST['department'] != '' || $_POST['JOB_LOCATION'] != '')







        $str   .= '<h2>';















      if ($_POST['department'] != '')







        $str   .= 'Department Name: ' . find_a_field('department', 'DEPT_DESC', 'DEPT_ID="' . $_POST['department'] . '"') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';















      if ($_POST['JOB_LOCATION'] != '')







        $str   .= 'Location: ' . find_a_field('office_location', 'LOCATION_NAME', 'ID="' . $_POST['JOB_LOCATION'] . '"');















      if ($_POST['PBI_DOMAIN'] != '')







        $str   .= '&nbsp;&nbsp; Section: ' . $_POST['PBI_DOMAIN'];















      if ($_POST['department'] != '' || $_POST['JOB_LOCATION'] != '')







        $str   .= '</h2>';







      $str   .= '</div>';







      //if(isset($_SESSION['company_logo'])) 







      //$str 	.= '<div class="logo"><img height="60" src="'.$_SESSION['company_logo'].'"</div>';







      $str   .= '<div class="left">';







      if (($_POST['PBI_GROUP'] != ''))







        $str   .= '<p>Product Group: ' . $_POST['PBI_GROUP'] . '</p>';







      if (($_POST['branch'] > 0))







        $str   .= '<p>Region Name: ' . find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID="' . $_POST['branch'] . '"') . '</p>';







      if (($_POST['area_code'] > 0))







        $str   .= '<p>Area Name: ' . find_a_field('area', 'AREA_NAME', 'AREA_CODE="' . $_POST['area_code'] . '"') . '</p>';







      if (($_POST['zone_code'] > 0))







        $str   .= '<p>Zone Name: ' . find_a_field('zon', 'ZONE_NAME', 'ZONE_CODE="' . $_POST['zone_code'] . '"') . '</p>';







      if (($_POST['region_code'] > 0))







        $str   .= '<p>Region Name: ' . find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID="' . $_POST['region_code'] . '"') . '</p>';







      if (isset($project_name))







        $str   .= '<p>Project Name: ' . $project_name . '</p>';















      if (isset($allotment_no))







        $str   .= '<p>Allotment No.: ' . $allotment_no . '</p>';







      $str   .= '</div>';







      $str   .= '<div class="right">';







      if (isset($client_name))







        $str   .= '<p>Client Name: ' . $client_name . '</p>';







      if (isset($start_date))







        $str   .= '<p>Schedule Duration: ' . $start_date . ' to ' . $end_date . '</p>';







      //$str 	.= '</div><span>Bonus Cut-Off Date:'.find_a_field('salary_bonus','cut_off_date','bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year']).'</span><div class="date">Reporting Time: '.date("h:i A d-m-Y").'</div>';







      $str   .= '</div>';







      $str   .= '<div class="date">Reporting Time: ' . date("h:i A d-m-Y") . '</div>';































































      if ($_POST['report'] == 7) // payroll information







      {















        $sql1 = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,a.PBI_GROUP,















(select pbi_held_up from salary_attendence where PBI_ID=a.PBI_ID order by id desc limit 1) as held,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







a.PBI_JOB_STATUS as job_status















from personnel_basic_info a where 1 " . $con;















        $query = mysql_query($sql1);







      ?>
        <table border="0" id="ExportTable">
          <thead>
            <tr>
              <td style="border:0px;" colspan="13"><?= $str ?></td>
            </tr>
            <tr>
              <th>S/L</th>
              <th>CODE</th>
              <th>Name</th>
              <th>Desg</th>
              <th>Dept</th>
              <th>GRP</th>
              <th>Region</th>
              <th>Zone</th>
              <th>Area</th>
              <th>Held-up</th>
              <th>Status</th>
              <th>Salary Type</th>
              <th>Basic</th>
              <th>C.Salary</th>
              <th>SL</th>
              <th>HR</th>
              <th>TA/DA</th>
              <th>FA</th>
              <th>MA</th>
              <th>Sal By </th>
              <th>A/C#</th>
              <th>Branch</th>
              <th>SM</th>
            </tr>
          </thead>
          <tbody>
            <?







            while ($datas = mysql_fetch_row($query)) {
              $s++;







              $sqld = 'select * from salary_info where PBI_ID=' . $datas[0];







              $data = mysql_fetch_object(mysql_query($sqld));







            ?>
              <tr>
                <td><?= $s ?></td>
                <td><?= $datas[0] ?></td>
                <td><?= $datas[1] ?></td>
                <td><?= $datas[2] ?></td>
                <td><?= $datas[3] ?></td>
                <td><?= $datas[4] ?></td>
                <td><?= $datas[8] ?></td>
                <td><?= $datas[7] ?></td>
                <td><?= $datas[6] ?></td>
                <td><?= ($datas[5] > 0) ? 'Y' : 'N'; ?></td>
                <td><?= $datas[9] ?></td>
                <td><?= $data->salary_type ?></td>
                <td><?= $data->basic_salary ?></td>
                <td><?= $data->consolidated_salary ?></td>
                <td style="text-align:right"><?= $data->special_allowance ?></td>
                <td style="text-align:right"><?= $data->house_rent ?></td>
                <td><?= $data->ta ?></td>
                <td><?= $data->food_allowance ?></td>
                <td><?= $data->medical_allowance ?>
                  &nbsp;</td>
                <td><?= $data->cash_bank ?>
                  &nbsp;</td>
                <td><?= $data->cash ?></td>
                <td><?= $data->branch_info ?></td>
                <td><?= $data->security_amount ?></td>
              </tr>
            <?







            }







            ?>
          </tbody>
        </table>
      <?







      }















      if ($_POST['report'] == 770) {







        $sqll = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department from 







personnel_basic_info a, salary_info s where a.PBI_ID=s.PBI_ID  " . $con . " order by (s.consolidated_salary+s.basic_salary) desc";







        $query = mysql_query($sqll);







      ?>
        <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
          <thead>
            <tr>
              <td style="border:0px;" colspan="23"><?= $str ?></td>
            </tr>
            <tr>
              <th rowspan="2">S/L</th>
              <th rowspan="2">CODE</th>
              <th rowspan="2">Name</th>
              <th rowspan="2">Desg</th>
              <th rowspan="2">Group</th>
              <th rowspan="2">Joining Date </th>
              <th rowspan="2">DBBL Acc. </th>
              <th rowspan="2">Working Place </th>
              <th rowspan="2">Sales Point </th>
              <th colspan="5" align="center"><?php echo date('F', mktime(0, 0, 0, $_POST['mon'], 01, $_POST['year'])) ?>'<?php echo date('y', mktime(0, 0, 0, $_POST['mon'], 01, $_POST['year'])) ?></th>
              <th colspan="2">Present Gross Amount </th>
              <th colspan="2">Actual Amount </th>
              <th rowspan="2">Special Commission </th>
              <th rowspan="2">Mobile Allowance </th>
              <th rowspan="2">Advance/Bill Payment </th>
              <th rowspan="2">H/Up or Advance Salary </th>
              <th rowspan="2">Co-OP Fund Inst. </th>
              <th rowspan="2">M/cycle Install </th>
              <th rowspan="2">Mobile Bill <?php echo date('M', mktime(0, 0, 0, $_POST['mon'], 01, $_POST['year'])) ?>'<?php echo date('y', mktime(0, 0, 0, $_POST['mon'], 01, $_POST['year'])) ?> </th>
              <th rowspan="2">Security Deposit </th>
              <th rowspan="2">Panalty</th>
              <th rowspan="2">Transfer to DBBL </th>
              <th rowspan="2">Net Payable (Taka) </th>
              <th rowspan="2">Signature</th>
            </tr>
            <tr>
              <th>Present</th>
              <th>Absent</th>
              <th>Leave</th>
              <th>W/Days</th>
              <th>Off Day </th>
              <th>Salary (Taka)</th>
              <th>TA/DA (Taka) </th>
              <th>Salary (Taka) </th>
              <th>TA/DA (Taka)</th>
            </tr>
          </thead>
          <tbody>
            <?







            while ($datas = mysql_fetch_row($query)) {
              $s++;







              $sqld = 'select * from salary_info where PBI_ID=' . $datas[0];







              $data = mysql_fetch_object(mysql_query($sqld));







            ?>
              <tr>
                <td><?= $s ?></td>
                <td><?= $datas[0] ?></td>
                <td><?= $datas[1] ?></td>
                <td><?= $datas[2] ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= $datas[3] ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= $data->salary_type ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?= $data->basic_salary ?></td>
                <td><?= $data->consolidated_salary ?></td>
                <td style="text-align:right"><?= $data->special_allowance ?></td>
                <td style="text-align:right"><?= $data->house_rent ?></td>
                <td><?= $data->ta ?></td>
                <td><?= $data->food_allowance ?></td>
                <td><?= $data->medical_allowance ?>
                  &nbsp;</td>
                <td><?= $data->cash_bank ?>
                  &nbsp;</td>
                <td><?= $data->cash ?></td>
                <td><?= $data->branch_info ?></td>
                <td><?= $data->security_amount ?></td>
                <td>&nbsp;</td>
              </tr>
            <?







            }







            ?>
          </tbody>
        </table>
      <?







      }















      if ($_POST['report'] == 77) {







      ?>
        <table border="0" cellpadding="2" cellspacing="0" id="ExportTable">
          <thead>
            <tr>
              <th style="border:0px;" colspan="38"><?= $str ?></th>
            </tr>
            <tr>
              <th rowspan="3">S/L-88</th>
              <th rowspan="3">CODE</th>
              <th rowspan="3">
                <div>Full Name</div>
              </th>
              <th rowspan="3"><img src="images/desgnation.jpg" /></th>
              <th rowspan="3"><img src="images/joining_date.jpg" alt="" /></th>
              <th rowspan="3">Inc Days </th>
              <th rowspan="3">Bank AC#</th>
              <th rowspan="3">Work Place</th>
              <th colspan="6">
                <div>Monthly Attendence Record</div>
              </th>
              <th colspan="3">Basic Information </th>
              <th colspan="5">
                <div>Accrued Salary and Allowance (At Actual) Taka </div>
              </th>
              <th colspan="6">
                <div>Deduction </div>
              </th>
              <th colspan="6">
                <div>Payable Amount (Taka) </div>
              </th>
              <th colspan="3">
                <div>View Only </div>
              </th>
              <th rowspan="3">Remarks</th>
            </tr>
            <tr class="vertical-text">
              <th rowspan="2"><img src="images/present.jpg" /></th>
              <th rowspan="2"><img src="images/weekend.jpg" /></th>
              <th rowspan="2"><img src="images/leave.JPG" /></th>
              <th rowspan="2"><img src="images/lwp.jpg" /></th>
              <th rowspan="2"><img src="images/absent.JPG" /></th>
              <th rowspan="2"><img src="images/payable_days.JPG" /></th>
              <th rowspan="2"><img src="images/salary.jpg" /></th>
              <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
              <th rowspan="2"><img src="images/ta_da.JPG" /></th>
              <th rowspan="2"><img src="images/salary.jpg" /></th>
              <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
              <th rowspan="2"><img src="images/ta_da.JPG" /></th>
              <th rowspan="2"><img src="images/arear.JPG" /></th>
              <th rowspan="2"><img src="images/other.JPG" /></th>
              <th rowspan="2"><img src="images/ait.JPG" /></th>
              <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
              <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
              <th rowspan="2"><img src="images/bike.JPG" /></th>
              <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
              <th rowspan="2"><img src="images/administrative.JPG" /></th>
              <th rowspan="2">H-Up</th>
              <th rowspan="2"><img src="images/cash.JPG" /></th>
              <th colspan="3">BANK</th>
              <th rowspan="2"><img src="images/total_salary.JPG" /></th>
              <th rowspan="2"><img src="images/last_salary.JPG" /></th>
              <th rowspan="2"><img src="images/diff.JPG" /></th>
              <th rowspan="2"><img src="images/absent_lwp.JPG" /></th>
            </tr>
            <tr class="vertical-text">
              <th>DBBL</th>
              <th>Rocket</th>
              <th>IBBL</th>
            </tr>
          </thead>
          <tbody>
            <?







            $sqld = 'select 







t.basic_salary actual_basic_salary,







t.special_allowance actual_special_allawance, 







t.*,a.PBI_ID,a.PBI_NAME,d.DESG_DESC PBI_DESIGNATION ,a.PBI_DEPARTMENT, a.PBI_DOJ,  t.pbi_held_up held_up_status,s.cash_bank,s.cash















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID ' . $con . ' 







order by a.PBI_ID';







            $queryd = mysql_query($sqld);







            while ($data = mysql_fetch_object($queryd)) {







              $entry_by = $data->entry_by;







            ?>
              <tr>
                <td><?= ++$s ?></td>
                <td><?= $data->PBI_ID ?></td>
                <td><?= $data->PBI_NAME ?></td>
                <td><?= $data->PBI_DESIGNATION ?></td>
                <td><?= date('d-m-Y', strtotime($data->PBI_DOJ)); ?></td>
                <td><? echo $data->incentive_days != 0 ? $data->incentive_days . ' Days' : ''; ?></td>
                <td>
                  <font color="#FFFFFF">'</font>
                  <?= $data->cash ?>
                </td>
                <td><? $res = "select concat(a.AREA_NAME,'-',d.dealer_code,'-',d.dealer_name_e) dealer from area a, dealer_info d where a.AREA_CODE=d.area_code and d.dealer_code=" . $data->dealer_code;







                    $resq = @mysql_query($res);







                    $res_data = @mysql_fetch_object($resq);
                    echo $res_data->dealer; ?></td>
                <td><?= $data->pre ?></td>
                <td><?= $data->od ?></td>
                <td><?= $data->lv ?></td>
                <td><?= $data->lwp ?></td>
                <td><?= $data->ab ?></td>
                <td><?= $data->pay ?></td>
                <td><?= number_format($data->actual_basic_salary) ?>
                  <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                <td><?= number_format($data->spl_alw_data) ?>
                  <? $total_spl_alw_data = $total_spl_alw_data + $data->spl_alw_data; ?></td>
                <td><?= number_format($data->ta_da_data) ?>
                  <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                <td><?= number_format($data->basic_salary_payable) ?>
                  <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                <td><?= round($data->actual_special_allawance); ?>
                  <? $total_actual_special_allawance = $total_actual_special_allawance + round($data->actual_special_allawance); ?></td>
                <td><?= number_format($data->ta_da) ?>
                  <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                <td><?= number_format($data->benefits) ?>
                  <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                <td><?= number_format($data->other_benefits) ?>
                  <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                <td><?= number_format($data->income_tax) ?>
                  <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                <td><?= number_format(($data->advance_install + $data->other_install)) ?>
                  <? $total_advance_install = $total_advance_install + ($data->advance_install + $data->other_install); ?></td>
                <td><?= number_format($data->cooperative_share) ?>
                  <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                <td><?= number_format($data->motorcycle_install) ?>
                  <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                <td><?= number_format($data->deduction) ?>
                  <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                <td><?= number_format($data->administrative_deduction) ?>
                  <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                <td><? if ($data->held_up_status == '1') {
                      echo $data->total_payable;
                      $total_held_up = $total_held_up + $data->total_payable;
                    } ?></td>
                <td><? if ($data->held_up_status == '0') {
                      $cash_payment = $data->total_payable - $data->bank_paid;
                      echo number_format($cash_payment);
                      $total_cash_payment = $total_cash_payment + $cash_payment;
                    } ?></td>
                <td><? if ($data->held_up_status == '0') {
                      if ($data->bank_name == 'DBBL') {
                        echo number_format($data->bank_paid);
                        $total_bank_payment_dbbl = $total_bank_payment_dbbl + $data->bank_paid;
                      }
                    } ?></td>
                <td><? if ($data->held_up_status == '0') {
                      if ($data->bank_name == 'ROCKET') {
                        echo number_format($data->bank_paid);
                        $total_bank_payment_rocket = $total_bank_payment_rocket + $data->bank_paid;
                      }
                    } ?></td>
                <td><? if ($data->held_up_status == '0') {
                      if ($data->bank_name == 'IBBL') {
                        echo number_format($data->bank_paid);
                        $total_bank_payment_ibbl = $total_bank_payment_ibbl + $data->bank_paid;
                      }
                    } ?></td>
                <td><span style="text-align:right; font-weight:bold;">
                    <?php if ($data->held_up_status == '0') {
                      echo number_format($data->total_payable);
                      $total_cash = $total_cash + $data->total_payable;
                    } ?>
                  </span></td>
                <td><?php







                    if ($_POST['mon'] == 1) {
                      $p_mon = 12;
                    } else {
                      $p_mon = ($_POST['mon'] - 1);
                    }







                    if ($_POST['mon'] == 1) {
                      $p_yr = ($_POST['year'] - 1);
                    } else {
                      $p_yr = $_POST['year'];
                    }







                    echo $pre_salry = find_a_field('salary_attendence', 'total_payable', 'PBI_ID="' . $data->PBI_ID . '" and mon="' . $p_mon . '" and year="' . $p_yr . '" ');







                    ?></td>
                <td><? echo $differ_last = ($data->total_payable - $pre_salry);
                    $differ_last_all = $differ_last_all + $differ_last; ?></td>
                <td><span style="text-align:right">
                    <?= (int)$data->absent_deduction ?>
                  </span></td>
                <td style="color:#FF0000; font-weight:bold"><?= ($data->held_up_status == '1') ? 'Held-Up' : '' ?></td>
              </tr>
            <?







            }







            ?>
            <tr>
              <td colspan="14"><?= convertNumberMhafuz($total_cash); ?></td>
              <td><strong>
                  <?= $total_actual_basic_salary; ?>
                </strong></td>
              <td><strong>
                  <?= $total_spl_alw_data; ?>
                </strong></td>
              <td><strong>
                  <?= $total_ta_da_data; ?>
                </strong></td>
              <td><strong>
                  <?= (int)$total_basic_salary_payable; ?>
                </strong></td>
              <td><strong>
                  <?= round($total_actual_special_allawance); ?>
                </strong></td>
              <td><strong>
                  <?= $total_ta_da; ?>
                </strong></td>
              <td><strong>
                  <?= $total_benefits; ?>
                </strong></td>
              <td><strong>
                  <?= $total_other_benefits; ?>
                </strong></td>
              <td><strong>
                  <?= $total_income_tax; ?>
                </strong></td>
              <td><strong>
                  <?= $total_advance_install; ?>
                </strong></td>
              <td><strong>
                  <?= $total_cooperative_share; ?>
                </strong></td>
              <td><strong>
                  <?= $total_motorcycle_install; ?>
                </strong></td>
              <td><strong>
                  <?= $total_deduction; ?>
                </strong></td>
              <td><strong>
                  <?= $total_administrative_deduction; ?>
                </strong></td>
              <td><?= $total_held_up ?></td>
              <td><strong>
                  <?= $total_cash_payment ?>
                </strong></td>
              <td><? echo (int)$total_bank_payment_dbbl; ?></td>
              <td><? echo (int)$total_bank_payment_rocket; ?></td>
              <td><? echo (int)$total_bank_payment_ibbl; ?></td>
              <td><strong>
                  <?= $total_cash ?>
                </strong></td>
              <td>&nbsp;</td>
              <td><strong>
                  <?= $differ_last_all ?>
                </strong></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <style type="text/css">
          #new td {







            border-bottom: 0px solid #000000;







            border-left: 0px solid #000000;







            border-right: 0px solid #000000;







            text-align: center;







            padding: 2px 10px;







          }
        </style>
        <br />
      <?







      }































      if ($_POST['report'] == 781) {







      ?>
        <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
          <thead>
            <tr>
              <th style="border:0px;" colspan="7"><?= $str ?></th>
            </tr>
            <tr>
              <th>S/L</th>
              <th>CODE</th>
              <th>Full Name</th>
              <th>Designation</th>
              <th>Group</th>
              <th><?= $_POST['cash_bank'] ?>
                AC#</th>
              <th>Transfer to
                <?= $_POST['cash_bank'] ?></th>
            </tr>
          </thead>
          <tbody>
            <?







            $bank = $_POST['cash_bank'];







            $sqld = 'select 







s.basic_salary actual_basic_salary,







s.special_allowance actual_special_allawance, 







t.*,a.PBI_ID,a.PBI_NAME,a.PBI_GROUP,d.DESG_SHORT_NAME PBI_DESIGNATION ,a.PBI_DEPARTMENT, a.PBI_DOJ,







t.pbi_held_up held_up_status,s.cash_bank,s.cash















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s 







where t.pbi_held_up=0 and s.cash_bank="' . $bank . '" and d.DESG_ID=t.pbi_designation 







and t.mon=' . $_POST['mon'] . ' 







and t.year=' . $_POST['year'] . ' 







and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID ' . $con . ' 







order by (t.consolidated_salary+t.basic_salary) desc';























            $queryd = mysql_query($sqld);







            while ($data = mysql_fetch_object($queryd)) {







              $entry_by = $data->entry_by;







            ?>
              <tr>
                <td><?= ++$s ?></td>
                <td><?= $data->PBI_ID ?></td>
                <td><?= $data->PBI_NAME ?></td>
                <td><?= $data->PBI_DESIGNATION ?></td>
                <td><?= $data->PBI_GROUP ?></td>
                <td><?= $data->cash ?></td>
                <td><? if ($data->held_up_status == '0') {
                      if ($data->cash_bank == $bank) {
                        echo number_format($data->bank_paid);







                        $total_bank_payment_dbbl = $total_bank_payment_dbbl + $data->bank_paid;
                      }
                    } ?></td>
              </tr>
            <?







            }







            ?>
            <tr>
              <td colspan="6"><?= convertNumberMhafuz($total_bank_payment_dbbl); ?></td>
              <td><? echo (int)$total_bank_payment_dbbl; ?></td>
            </tr>
          </tbody>
        </table>
        <style type="text/css">
          #new td {







            border-bottom: 0px solid #000000;







            border-left: 0px solid #000000;







            border-right: 0px solid #000000;







            text-align: center;







            padding: 2px 10px;







          }
        </style>
        <br />
      <?







      }























      if ($_POST['report'] == 65) {







        if ($_POST['branch'] != '') $con .= ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';















      ?>
        <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
          <thead>
            <tr>
              <th style="border:0px;" colspan="12"><?= $str ?></th>
            </tr>
            <tr>
              <th>S/L</th>
              <th>Region</th>
              <th>No of Employee </th>
              <th>Basic Salary</th>
              <th>Bonus Amount</th>
              <th>Bank Paid</th>
              <th>DBBL</th>
              <th>Rocket</th>
              <th>IBBL</th>
              <th>Cash Paid </th>
              <th>Net Payable </th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?







            $sqld = "







select br.BRANCH_NAME as region, br.BRANCH_ID as region_id, count(b.id) as man,







sum(b.basic_salary) as basic_salary, 







sum(b.bonus_amt) as Bonus_amount, 







sum(b.bank_paid) as bank_paid, 







sum(b.cash_paid) as cash_paid, 







sum(b.bonus_amt) as net_payable, ' ' as Remarks 







from personnel_basic_info a, salary_bonus b, salary_info s, branch br







where a.PBI_BRANCH=br.BRANCH_ID







and b.PBI_ID=a.PBI_ID







and s.PBI_ID=b.PBI_ID







and a.PBI_ID=s.PBI_ID







and a.PBI_DEPARTMENT = 'Sales'







and b.bonus_type=" . $_POST['bonus_type'] . " 







and b.year=" . $_POST['year'] . " 







" . $con . " 	







group by br.BRANCH_NAME 







order by br.BRANCH_NAME







";















            $queryd = mysql_query($sqld);







            while ($data = mysql_fetch_object($queryd)) {























              $dbbl_taka = 'SELECT sum(b.bank_paid) FROM  salary_bonus b, salary_info s







where b.PBI_ID=s.PBI_ID and b.pbi_region="' . $data->region_id . '" and b.bonus_type="' . $_POST['bonus_type'] . '"







and b.year="' . $_POST['year'] . '" AND s.cash_bank = "DBBL"';







              $dbbl = find_a_field_sql($dbbl_taka);















              $r_taka = 'SELECT sum(b.bank_paid) FROM  salary_bonus b, salary_info s







where b.PBI_ID=s.PBI_ID and b.pbi_region="' . $data->region_id . '" and b.bonus_type="' . $_POST['bonus_type'] . '" 







and b.year="' . $_POST['year'] . '" AND s.cash_bank = "ROCKET"';







              $rocket = find_a_field_sql($r_taka);















              $ibbl_taka = 'SELECT sum(b.bank_paid) FROM  salary_bonus b, salary_info s







where b.PBI_ID=s.PBI_ID and b.pbi_region="' . $data->region_id . '" and b.bonus_type="' . $_POST['bonus_type'] . '" 







and b.year="' . $_POST['year'] . '" AND s.cash_bank = "IBBL"';







              $ibbl = find_a_field_sql($ibbl_taka);















              $t_man += $data->man;







              $t_basic += $data->basic_salary;







              $t_bonus += $data->Bonus_amount;







              $t_bank += $data->bank_paid;







              $t_dbbl += $dbbl;







              $t_rocket += $rocket;







              $t_ibbl += $ibbl;







              $t_cash += $data->cash_paid;







              $t_net += $data->net_payable;























            ?>
              <tr>
                <td><?= ++$s ?></td>
                <td><?= $data->region ?></td>
                <td><?= $data->man ?></td>
                <td><?= $data->basic_salary; ?></td>
                <td><?= $data->Bonus_amount ?></td>
                <td><?= $data->bank_paid ?></td>
                <td><?= $dbbl; ?></td>
                <td><?= $rocket; ?></td>
                <td><?= $ibbl; ?></td>
                <td><?= $data->cash_paid ?></td>
                <td><?= $data->net_payable ?></td>
                <td></td>
              </tr>
            <? } ?>
            <tr>
              <td>&nbsp;</td>
              <td><strong>Total</strong></td>
              <td><strong>
                  <?= $t_man ?>
                </strong></td>
              <td><strong>
                  <?= $t_basic ?>
                </strong></td>
              <td><strong>
                  <?= $t_bonus ?>
                </strong></td>
              <td><strong>
                  <?= $t_bank ?>
                </strong></td>
              <td><strong>
                  <?= $t_dbbl ?>
                </strong></td>
              <td><strong>
                  <?= $t_rocket ?>
                </strong></td>
              <td><strong>
                  <?= $t_ibbl ?>
                </strong></td>
              <td><strong>
                  <?= $t_cash ?>
                </strong></td>
              <td><strong>
                  <?= $t_net ?>
                </strong></td>
              <td></td>
            </tr>
          </tbody>
        </table>
        In word:
        <?= convertNumberMhafuz($t_net); ?>
      <?







      } // end 65 report























      if ($_POST['report'] == 22) {







      ?>
        <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
          <thead>
            <tr>
              <th style="border:0px;" colspan="30"><?= $str ?></th>
            </tr>
            <tr>
              <th>S/L</th>
              <th>CODE</th>
              <th>Company</th>
              <th>Location</th>
              <th>Department</th>
              <th> Name</th>
              <th>Designation</th>
              <th>Father</th>
              <th>DOJ</th>
              <th>DOC1</th>
              <th>Confirmation</th>
              <th>Resign Date </th>
              <th>Service</th>
              <th>Education</th>
              <th>Group</th>
              <th>Region</th>
              <th>Zone</th>
              <th>Area</th>
              <th>Mobile</th>
              <th>Basic Salary </th>
              <th>Sp Allow </th>
              <th>Inc Allow </th>
              <th>Ta Da </th>
              <th>Food Allow </th>
              <th>Mobile Allow </th>
              <th>House Rent </th>
            </tr>
          </thead>
          <tbody>
            <?















            $sqld = "select a.PBI_ID as code,a.PBI_ORG,a.PBI_NAME as name,a.PBI_FATHER_NAME as father,







a.JOB_LOCATION,a.PBI_DEPARTMENT as department,a.DESG_ID as designation,a.JOB_STATUS_DATE reg_date,







a.PBI_AREA as area,a.PBI_ZONE as zone,a.PBI_BRANCH as region,







DATE_FORMAT(a.PBI_DOJ,'%d-%m-%Y') as DOJ,







DATE_FORMAT(a.PBI_DOC,'%d-%m-%Y') as DOC1,







DATE_FORMAT(a.PBI_DOC2,'%d-%m-%Y') as confirmation,















a.PBI_EDU_QUALIFICATION as qualification,a.PBI_GROUP,a.PBI_MOBILE as mobile,s.basic_salary,







s.special_allowance as sp_Allow,s.ta as ta_da,s.food_allowance as food_allow,s.mobile_allowance as mobile_allow,s.house_rent







from personnel_basic_info a , salary_info s







where a.PBI_ID=s.PBI_ID 







" . $con . " order by a.PBI_ID";















            // CONCAT(TIMESTAMPDIFF(YEAR, PBI_DOJ, CURDATE()),' Year,',TIMESTAMPDIFF(MONTH, PBI_DOJ, CURDATE()) % 12,' mon') as service,























            $queryd = mysql_query($sqld);







            while ($data = mysql_fetch_object($queryd)) {







              $entry_by = $data->entry_by;







            ?>
              <tr>
                <td><?= ++$s ?></td>
                <td><?= $data->code ?></td>
                <td><?= find_a_field('user_group', 'group_name', 'id="' . $data->PBI_ORG . '"'); ?></td>
                <td><?= find_a_field('office_location', 'LOCATION_NAME', 'ID="' . $data->JOB_LOCATION . '"'); ?></td>
                <td><?= find_a_field('department', 'DEPT_DESC', 'DEPT_SHORT_NAME="' . $data->department . '"'); ?></td>
                <td><?= $data->name ?></td>
                <td><?= find_a_field('designation', 'DESG_DESC', 'DESG_ID="' . $data->designation . '"'); ?></td>
                <td><?= $data->father ?></td>
                <td><?= $data->DOJ ?></td>
                <td><?= $data->DOC1 ?></td>
                <td><?= $data->confirmation ?></td>
                <td><?= $data->reg_date ?></td>
                <td><?







                    if ($data->reg_date > 0) {
                      $date2 = $data->reg_date;
                    } else {







                      $date2 = date('Y-m-d');
                    }







                    echo $servicel = find_a_field('personnel_basic_info', 'CONCAT( TIMESTAMPDIFF(YEAR, PBI_DOJ, "' . $date2 . '")," Year,",







TIMESTAMPDIFF(MONTH, PBI_DOJ, "' . $date2 . '") % 12," mon")', '1 and PBI_ID="' . $data->code . '"');







                    ?></td>
                <td><?= $data->qualification ?></td>
                <td><?= $data->PBI_GROUP ?></td>
                <td><?= find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID="' . $data->region . '"'); ?></td>
                <td><?= find_a_field('zon', 'ZONE_NAME', 'ZONE_CODE="' . $data->zone . '"'); ?></td>
                <td><?= find_a_field('area', 'AREA_NAME', 'AREA_CODE="' . $data->area . '"'); ?></td>
                <td><?= $data->mobile ?></td>
                <td><?= $data->basic_salary ?></td>
                <td><?= $data->sp_Allow ?></td>
                <td><?= $data->inc_allow ?></td>
                <td><?= $data->ta_da ?></td>
                <td><?= $data->food_allow ?></td>
                <td><?= $data->mobile_allow ?></td>
                <td><?= $data->house_rent ?></td>
              </tr>
            <?







            }







            ?>
          </tbody>
        </table>
        <style type="text/css">
          #new td {







            border-bottom: 0px solid #000000;







            border-left: 0px solid #000000;







            border-right: 0px solid #000000;







            text-align: center;







            padding: 2px 10px;







          }
        </style>

        <br />


        <!-- ***************************** Salary Summary Sheet (Department) Start From Here    ******************************************** -->

      <? } elseif ($_POST['report'] == 85) { ?>

        <table style="width:auto;margin: 0 auto; padding:0px;">

          <tr>
            <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong><? //=$str
                                                                                                                                      ?></strong></td>
          </tr>

          <tr>
            <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet (Department)</strong></td>
          </tr>

          <tr>
            <td style="text-align: center;border:0px solid white;"><?
                                                                    $test = new DateTime('01-' . $_POST['mon'] . '-' . $_POST['year'] . ' ');
                                                                    $_SESSION['year'] = $_POST['year'];

                                                                    echo date_format($test, 'M-Y');
                                                                    if ($_POST['mon'] == 1) {

                                                                      $last_m = 12;
                                                                      $last_y = $_POST['year'] - 1;
                                                                    } else {
                                                                      $last_m = $_POST['mon'] - 1;
                                                                      $last_y = $_POST['year'];
                                                                    } ?>
            </td>
          </tr>
        </table>


        <table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
          <input name="mon" value="<?= $_POST['mon'] ?>" type="hidden" />
          <input name="year" value="<?= $_POST['year'] ?>" type="hidden" />

          <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; font-size:16px">
            <tr>
              <th width="10px" style="text-align:center">SL NO</th>
              <th width="80%" style="text-align:center">Department</th>
              <th width="10px" style="text-align:center">Total Employee</th>
              <th width="10%" style="text-align:center">Net Payable (TK.)</th>
            </tr>

            <?

            $jl_sql1 = 'select u.DEPT_ID,u.DEPT_DESC,sum(a.bank_amt) as bank_pay,sum(a.cash_amt) as cash_pay,sum(a.total_payable) as total_payment,
  count(a.PBI_ID) as total_employee
  from
  salary_attendence a,
  personnel_basic_info b,
  salary_info i,
  department u

  where
  a.PBI_ID = b.PBI_ID and
  a.HoldPay != "hold" and
  a.PBI_ID = i.PBI_ID and
  b.DEPT_ID = u.DEPT_ID and
  a.mon in ("' . $_POST['mon'] . '") and
  a.year in ("' . $_POST['year'] . '")
  GROUP BY u.DEPT_ID';


            $jl_query1 = mysql_query($jl_sql1);
            while ($jl1_result1 = mysql_fetch_object($jl_query1)) { ?>

              <tr style="margin:0px;">
                <td style="margin:0px; width:5%"><?= ++$s; ?></td>
                <td style="margin:0px; width:40%"><?= $jl1_result1->DEPT_DESC; ?></td>
                <td style="margin:0px; width:10%" ; align="center"><?= $jl1_result1->total_employee;
                                                                    $tot_emp += $jl1_result1->total_employee; ?></td>
                <td style="text-align:right;width:20%;"><?= number_format($jl1_result1->total_payment, 0);
                                                        $tot_payment += $jl1_result1->total_payment; ?></td>
              </tr>

            <?  } ?>


            <td style="text-align:right"><strong></strong></td>
            <td align="right"><strong>Grand Total </strong></td>
            <td style="text-align:right"><strong><?= number_format($tot_emp, 0) ?></strong></td>
            <td style="text-align:right;width:20%;"><strong><?= number_format($tot_payment); ?></strong></td>


            </tr>
          </table><br>



          <p></p>
          <p></p>
          <center>
            <div style="font-size:15px; font-weight:bold; width:60%;"> In Word :


              <?
              //echo convertNumberMhafuz($grandTotal);
              //echo taka_to_words(1234567890); 
              $num = $tot_payment;
              $test = convertNumberMhafuz($num);
              echo $test;
              ?>


            </div>
          </center>


          <br>
          </br>
          <br>
          </br>
          <br>
          </br>
          <br>
          </br>


          <div style="width:80%; margin:0 auto">

            <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
              HR Department</div>


            <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
              Accounts Department</div>


            <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
              CEO</div>

            <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
              Chairman</div>
          </div>

          <p>&nbsp; </p>
          <p>&nbsp;</p>


          <!-- cash allowncess summary sheet -->




          <!-- ***************************** Salary Summary Sheet (Designation) Start From Here    ******************************************** -->

        <?
      } elseif ($_POST['report'] == 86) {  ?>

          <table style="width:auto;margin: 0 auto; padding:0px;">
            <tr>
              <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong><? //=$str
                                                                                                                                        ?></strong></td>
            </tr>
            <tr>
              <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet (Designation)</strong></td>
            </tr>
            <tr>
              <td style="text-align: center;border:0px solid white;"><?
                                                                      $test = new DateTime('01-' . $_POST['mon'] . '-' . $_POST['year'] . ' ');
                                                                      $_SESSION['year'] = $_POST['year'];

                                                                      echo date_format($test, 'M-Y');
                                                                      if ($_POST['mon'] == 1) {

                                                                        $last_m = 12;
                                                                        $last_y = $_POST['year'] - 1;
                                                                      } else {
                                                                        $last_m = $_POST['mon'] - 1;
                                                                        $last_y = $_POST['year'];
                                                                      } ?>

              </td>
            </tr>
          </table>


          <table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
            <input name="mon" value="<?= $_POST['mon'] ?>" type="hidden" />
            <input name="year" value="<?= $_POST['year'] ?>" type="hidden" />

            <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; font-size:16px">
              <tr>
                <th width="10px" style="text-align:center">SL NO</th>
                <th width="80%" style="text-align:center">Designation</th>
                <th width="10px" style="text-align:center">Total Employee</th>
                <th width="10%" style="text-align:center">Net Payable (TK.)</th>
              </tr>

              <?

              $jl_sql1 = 'select u.DESG_ID,u.DESG_DESC,sum(a.bank_amt) as bank_pay,sum(a.cash_amt) as cash_pay,sum(a.total_payable) as total_payment,
count(a.PBI_ID) as total_employee
from
salary_attendence a,
personnel_basic_info b,
salary_info i,
designation u

where
a.PBI_ID = b.PBI_ID and
a.HoldPay != "hold" and
a.PBI_ID = i.PBI_ID and
b.DESG_ID = u.DESG_ID and
a.mon in ("' . $_POST['mon'] . '") and
a.year in ("' . $_POST['year'] . '")
GROUP BY u.DESG_ID';


              $jl_query1 = mysql_query($jl_sql1);
              while ($jl1_result1 = mysql_fetch_object($jl_query1)) { ?>
                <tr style="margin:0px;">
                  <td style="margin:0px; width:5%"><?= ++$s; ?></td>
                  <td style="margin:0px; width:40%"><?= $jl1_result1->DESG_DESC; ?></td>
                  <td style="margin:0px; width:10%" ; align="center"><?= $jl1_result1->total_employee;
                                                                      $tot_emp += $jl1_result1->total_employee; ?></td>
                  <td style="text-align:right;width:20%;"><?= number_format($jl1_result1->total_payment, 0);
                                                          $tot_payment += $jl1_result1->total_payment; ?></td>
                </tr>


              <?  } ?>


              <td style="text-align:right"><strong></strong></td>
              <td align="right"><strong>Grand Total </strong></td>
              <td style="text-align:right"><strong><?= number_format($tot_emp, 0) ?></strong></td>
              <td style="text-align:right;width:20%;"><strong><?= number_format($tot_payment); ?></strong></td>


              </tr>
            </table>



            <p></p>
            <p></p>
            <center>
              <div style="font-size:15px; font-weight:bold; width:60%;"> In Word :


                <?
                //echo convertNumberMhafuz($grandTotal);
                //echo taka_to_words(1234567890); 
                $num = $tot_payment;
                $test = convertNumberMhafuz($num);
                echo $test;
                ?>


              </div>
            </center>


            <br>
            </br>
            <br>
            </br>
            <br>
            </br>
            <br>
            </br>


            <div style="width:80%; margin:0 auto">

              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                HR Department</div>


              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                Accounts Department</div>


              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                CEO</div>

              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                Chairman</div>
            </div>

            <p>&nbsp; </p>
            <p>&nbsp;</p>


            <!-- END  -->









            <!-- **************************** Salary Summary Sheet (Designation) Start From Here    ******************************************* -->


          <?
        }

        if ($_POST['report'] == 87) {


          ?>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <thead>
                <tr>

                  <td style="border:0px; padding-right:100px" colspan="29" align="center"><?= $str ?></td>
                </tr>
                <tr>
                  <th width="2%" rowspan="3" align="center">S/L</th>
                  <th width="5%" rowspan="3">
                    <div align="center">ID</div>
                  </th>
                  <th width="4%" rowspan="3">
                    <div align="center">Name</div>
                  </th>
                  <th width="8%" rowspan="3">
                    <div align="center">Designation</div>
                  </th>
                  <th width="7%" rowspan="3" nowrap="nowrap">
                    <div align="center">Joining Date</div>
                  </th>
                  <th width="8%" rowspan="3">
                    <div align="center">Job Period</div>
                  </th>
                  <th colspan="2" align="center">
                    <div align="center">Salary</div>
                  </th>
                  <th width="10%" rowspan="3">
                    <div align="center">Bonus (Basic) %</div>
                  </th>
                  <th width="11%" rowspan="3">
                    <div align="center">Bonus Amount</div>
                  </th>
                  <th width="7%" rowspan="3">
                    <div align="center">Bank Acc.</div>
                  </th>
                  <th width="12%" rowspan="3">
                    <div align="center">Payroll Card No</div>
                  </th>
                  <th width="7%" rowspan="3">
                    <div align="center">Remarks</div>
                  </th>
                </tr>
                <tr>
                  <th width="4%">
                    <div align="center">Gross</div>
                  </th>
                  <th width="4%">
                    <div align="center">Basic</div>
                  </th>
                </tr>
                <tr>
                  <th>
                    <div align="center">100%</div>
                  </th>
                  <th>
                    <div align="center">50%</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?

                if ($_POST['branch'] != '')



                  $cons = ' and a.PBI_BRANCH ="' . $_POST['branch'] . '"';



                if ($_POST['JOB_LOCATION'] != '')



                  $cons .= ' and b.pbi_job_location ="' . $_POST['JOB_LOCATION'] . '"';




                if ($_POST['department'] != '')



                  $cons .= ' and b.pbi_department ="' . $_POST['department'] . '"';
                $found = find_a_field('salary_bonus', 'lock_status', 'bonus_type="' . $_POST['bonus_type'] . '" and year="' . $_POST['year'] . '"');

                if ($found == 0) {
                  $sqld = "select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
b.job_period,
b.gross_salary,
b.basic_salary,
b.bonus_percent,
b.bonus_amt,
b.remarks,
s.cash as bank_ac,
s.card_no
from
personnel_basic_info a, salary_bonus b, salary_info s, designation d
where
1 and b.pbi_designation=d.DESG_ID and b.PBI_ID=a.PBI_ID and
s.PBI_ID=b.PBI_ID and b.bonus_type=" . $_POST['bonus_type'] . " and
b.bonus_amt>0 and
b.year=" . $_POST['year'] . " " . $cons . "
order by b.bonus_amt desc";
                } else {
                  $sqld = "select a.PBI_ID,a.PBI_CODE,a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
b.job_period,b.gross_salary,b.basic_salary,b.bonus_percent,b.bonus_amt,b.remarks,
s.cash as bank_ac,
s.card_no
from
personnel_basic_info a, salary_bonus_lock b, salary_info s, designation d
where
1 and b.pbi_designation=d.DESG_ID and a.PBI_ID=b.PBI_ID and
s.PBI_ID=b.PBI_ID and b.bonus_type=" . $_POST['bonus_type'] . " and
b.bonus_percent not like 0 and
b.year=" . $_POST['year'] . " " . $cons . "
order by b.bonus_amt desc";
                }


                $queryd = mysql_query($sqld);
                while ($data = mysql_fetch_object($queryd)) {
                  $entry_by = $data->entry_by;

                ?>
                  <tr>
                    <td align="center"><?= ++$s ?></td>
                    <td align="center"><?= $data->PBI_CODE ?></td>
                    <td nowrap="nowrap"><?= $data->PBI_NAME ?></td>
                    <td nowrap="nowrap"><?= $data->designation ?></td>
                    <td align="center"><?= $data->joining_date ?></td>
                    <td nowrap="nowrap" align="center"><?= $data->job_period ?></td>
                    <td align="right"><?= (number_format($data->gross_salary, 0) > 0) ? number_format($data->gross_salary, 0) : '';
                                      $tot_gross += $data->gross_salary; ?></td>
                    <td align="right"><?= (number_format($data->basic_salary, 0) > 0) ? number_format($data->basic_salary, 0) : '';
                                      $tot_basic += $data->basic_salary; ?></td>
                    <td align="center"><?= $data->bonus_percent ?></td>
                    <td align="right"><?= number_format($data->bonus_amt, 0);
                                      $totalBonus += $data->bonus_amt; ?></td>
                    <td align="center"><?= $data->bank_ac; ?></td>
                    <td align="center"><?= $data->card_no; ?></td>
                    <td><?= $data->remarks; ?></td>
                  </tr>
                <?




                }



                ?>
                <tr>
                  <td colspan="6" align="right">Total:</td>
                  <td align="right"><strong>
                      <?= number_format($tot_gross, 0) ?>
                    </strong></td>
                  <td align="right"><strong>
                      <?= number_format($tot_basic, 0) ?>
                    </strong></td>
                  <td>&nbsp;</td>
                  <td align="right"><strong>
                      <?= number_format($totalBonus, 0) ?>
                    </strong></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>
            In Words:
            <?
            echo convertNumberMhafuz($totalBonus);

            ?>
            <br>
            <br>
            <br>
            <div style="width:100%; margin:60px auto">
              <div style="float:left; width:25%; text-align:center">-------------------<br>
                Prepared By</div>
              <div style="float:left; width:25%; text-align:center">-------------------<br>
                Audit</div>
              <div style="float:left; width:25%; text-align:center">-------------------<br>
                Managing Director</div>
              <div style="float:left; width:25%; text-align:center">-------------------<br>
                Chairman</div>
            </div>
            <br>
            <br>
            <br>





            <!-- END bonus report Bkash -->














          <?



        }


        if ($_POST['report'] == 785) {















          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
              <thead>
                <tr>
                  <th style="border:0px;" colspan="7"><?= $str ?></th>
                </tr>
                <tr>
                  <th>S/L</th>
                  <th>CODE</th>
                  <th>Full Name</th>
                  <th>Designation</th>
                  <th>Group</th>
                  <th><?= $_POST['cash_bank'] ?>
                    AC#</th>
                  <th>Transfer to
                    <?= $_POST['cash_bank'] ?></th>
                </tr>
              </thead>
              <tbody>
                <?







                $bank = $_POST['cash_bank'];















                $sqld = 'select 







t.*,t.pbi_held_up held_up_status,







a.PBI_ID,a.PBI_NAME,a.PBI_GROUP,d.DESG_SHORT_NAME PBI_DESIGNATION ,a.PBI_DEPARTMENT,s.cash_bank,s.cash















from  salary_bonus t, personnel_basic_info a, designation d, salary_info s 







where 







t.PBI_ID=a.PBI_ID 







and t.PBI_ID=s.PBI_ID 







and d.DESG_SHORT_NAME=a.pbi_designation 







and d.DESG_SHORT_NAME=t.pbi_designation 















and t.pbi_held_up=0 







and s.cash_bank="' . $bank . '" 







and t.bonus_type=' . $_POST['bonus_type'] . ' 







and t.year=' . $_POST['year'] . ' 







and t.bank_paid>0















' . $con . ' 







group by a.PBI_ID







order by a.PBI_ID';























                $queryd = mysql_query($sqld);







                while ($data = mysql_fetch_object($queryd)) {







                  $entry_by = $data->entry_by;







                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td><?= $data->PBI_ID ?></td>
                    <td><?= $data->PBI_NAME ?></td>
                    <td><?= $data->PBI_DESIGNATION ?></td>
                    <td><?= $data->PBI_GROUP ?></td>
                    <td><?= $data->cash ?></td>
                    <td><? if ($data->held_up_status == '0') {







                          if ($data->cash_bank == $bank) {
                            echo number_format($data->bank_paid);







                            $total_bank_payment_dbbl = $total_bank_payment_dbbl + $data->bank_paid;
                          }
                        }















                        ?></td>
                  </tr>
                <?







                }







                ?>
                <tr>
                  <td colspan="6"><?= convertNumberMhafuz($total_bank_payment_dbbl); ?></td>
                  <td><strong><? echo (int)$total_bank_payment_dbbl; ?></strong></td>
                </tr>
              </tbody>
            </table>
            <style type="text/css">
              #new td {







                border-bottom: 0px solid #000000;







                border-left: 0px solid #000000;







                border-right: 0px solid #000000;







                text-align: center;







                padding: 2px 10px;







              }
            </style>
            <br />
          <?







        }







































        if ($_POST['report'] == 786) {















          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
              <thead>
                <tr>
                  <th style="border:0px;" colspan="7"><?= $str ?></th>
                </tr>
                <tr>
                  <th>S/L</th>
                  <th>CODE</th>
                  <th>Full Name</th>
                  <th>Designation</th>
                  <th>Group</th>
                  <th>IBBL AC#</th>
                  <th>Transfer to IBBL</th>
                </tr>
              </thead>
              <tbody>
                <?







                $bank = 'IBBL';















                $sqld = 'select 







t.*,t.pbi_held_up held_up_status,







a.PBI_ID,a.PBI_NAME,a.PBI_GROUP,d.DESG_SHORT_NAME PBI_DESIGNATION ,a.PBI_DEPARTMENT,s.cash_bank,s.cash















from  salary_bonus t, personnel_basic_info a, designation d, salary_info s 







where 







t.PBI_ID=a.PBI_ID 







and t.PBI_ID=s.PBI_ID 







and d.DESG_SHORT_NAME=a.pbi_designation 







and d.DESG_SHORT_NAME=t.pbi_designation 















and t.pbi_held_up=0 







and s.cash_bank="' . $bank . '" 







and t.bonus_type=' . $_POST['bonus_type'] . ' 







and t.year=' . $_POST['year'] . ' 







and t.bank_paid>0















' . $con . ' 







group by a.PBI_ID







order by a.PBI_ID';























                $queryd = mysql_query($sqld);







                while ($data = mysql_fetch_object($queryd)) {







                  $entry_by = $data->entry_by;







                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td><?= $data->PBI_ID ?></td>
                    <td><?= $data->PBI_NAME ?></td>
                    <td><?= $data->PBI_DESIGNATION ?></td>
                    <td><?= $data->PBI_GROUP ?></td>
                    <td><?= $data->cash ?></td>
                    <td><? if ($data->held_up_status == '0') {







                          if ($data->cash_bank == $bank) {
                            echo number_format($data->bank_paid);







                            $total_bank_payment_dbbl = $total_bank_payment_dbbl + $data->bank_paid;
                          }
                        }















                        ?></td>
                  </tr>
                <?







                }







                ?>
                <tr>
                  <td colspan="6"><?= convertNumberMhafuz($total_bank_payment_dbbl); ?></td>
                  <td><strong><? echo (int)$total_bank_payment_dbbl; ?></strong></td>
                </tr>
              </tbody>
            </table>
            <style type="text/css">
              #new td {







                border-bottom: 0px solid #000000;







                border-left: 0px solid #000000;







                border-right: 0px solid #000000;







                text-align: center;







                padding: 2px 10px;







              }
            </style>
            <br />
          <?







        }































        if ($_POST['report'] == 7811) {







          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
              <thead>
                <tr>
                  <th style="border:0px;" colspan="7"><?= $str ?></th>
                </tr>
                <tr>
                  <th>S/L</th>
                  <th>CODE</th>
                  <th>Full Name</th>
                  <th>Designation</th>
                  <th>Group</th>
                  <th>Co-Operative Code </th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?







                $sqld = 'select a.co_operative_code, t.*, a.PBI_ID, a.PBI_NAME, a.PBI_GROUP, d.DESG_SHORT_NAME PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ















from  salary_attendence t, personnel_basic_info a, designation d 







where t.cooperative_share>0 and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID ' . $con . ' order by (t.consolidated_salary+t.basic_salary) desc';







                $queryd = mysql_query($sqld);







                while ($data = mysql_fetch_object($queryd)) {







                  $entry_by = $data->entry_by;







                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td><?= $data->PBI_ID ?></td>
                    <td><?= $data->PBI_NAME ?></td>
                    <td><?= $data->PBI_DESIGNATION ?></td>
                    <td><?= $data->PBI_GROUP ?></td>
                    <td><?= $data->co_operative_code ?></td>
                    <td><?= $data->cooperative_share;
                        $total += $data->cooperative_share; ?></td>
                  </tr>
                <?







                }







                ?>
                <tr>
                  <td colspan="6"><?= convertNumberMhafuz($total); ?></td>
                  <td><? echo $total; ?></td>
                </tr>
              </tbody>
            </table>
            <style type="text/css">
              #new td {







                border-bottom: 0px solid #000000;







                border-left: 0px solid #000000;







                border-right: 0px solid #000000;







                text-align: center;







                padding: 2px 10px;







              }
            </style>
            <br />
          <?







        }







        if ($_POST['report'] == 782) {







          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
              <thead>
                <tr>
                  <th style="border:0px;" colspan="8"><?= $str ?></th>
                </tr>
                <tr>
                  <th>S/L</th>
                  <th>AC#</th>
                  <th>CODE</th>
                  <th>Full Name</th>
                  <th>IBBL AC#</th>
                  <th>Branch</th>
                  <th>Branch Code</th>
                  <th>Transfer to IBBL</th>
                </tr>
              </thead>
              <tbody>
                <?







                $sqld = 'select 







s.basic_salary actual_basic_salary,







s.special_allowance actual_special_allawance, 







t.*,a.PBI_ID,a.PBI_NAME,a.PBI_GROUP,d.DESG_SHORT_NAME PBI_DESIGNATION ,a.PBI_DEPARTMENT, a.PBI_DOJ,  t.pbi_held_up held_up_status,s.cash_bank,s.cash,s.branch_info















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s 







where t.pbi_held_up=0 and s.cash_bank="IBBL" and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID ' . $con . ' order by (t.consolidated_salary+t.basic_salary) desc';







                $queryd = mysql_query($sqld);







                while ($data = mysql_fetch_object($queryd)) {







                  $entry_by = $data->entry_by;







                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td>
                      <font color="#FFFFFF">'</font>
                      <?= $data->cash ?>
                    </td>
                    <td><?= $data->PBI_ID ?></td>
                    <td><?= $data->PBI_NAME ?></td>
                    <td>
                      <font color="#FFFFFF">'</font>
                      <?= $data->cash ?>
                    </td>
                    <td><?= $data->branch_info ?></td>
                    <td>&nbsp;</td>
                    <td><? echo number_format($data->bank_paid);
                        $total_bank_payment_dbbl = $total_bank_payment_dbbl + $data->bank_paid; ?></td>
                  </tr>
                <?







                }







                ?>
                <tr>
                  <td colspan="5"><?= convertNumberMhafuz($total_bank_payment_dbbl); ?></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><? echo (int)$total_bank_payment_dbbl; ?></td>
                </tr>
              </tbody>
            </table>
            <style type="text/css">
              #new td {







                border-bottom: 0px solid #000000;







                border-left: 0px solid #000000;







                border-right: 0px solid #000000;







                text-align: center;







                padding: 2px 10px;







              }
            </style>
            <br />
          <?







        }




        if ($_POST['report'] == 78) {

          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <thead>
                <tr>
                  <th style="border:0px;" width="10%" align="left"><img src="../../../logo/<?= $_SESSION['proj_id'] ?>.png" width="100%"></th>
                  <th style="border:0px;" width="90%" align="center"><?= $str ?></th>
                </tr>
              </thead>
            </table>
            <table width="100%" cellspacing="0" cellpadding="2" border="1" id="ExportTable">
              <thead>
                <tr>
                  <th rowspan="2">S/L</th>
                  <th rowspan="2">
                    <div align="center">Employee ID</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Name</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Designation</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Branch</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Department</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Grade</div>
                  </th>
                  <th rowspan="2" nowrap="nowrap">
                    <div align="center"> Joining Date </div>
                  </th>
                  <th rowspan="2" align="center">
                    <div align="center">Total Days Works</div>
                  </th>
                  <th colspan="8">
                    <div align="center">Salary and Allowance </div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Arrear</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Total Payment</div>
                  </th>
                  <th colspan="8" align="center">
                    <div align="center">Deduction</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Total Deduction </div>
                  </th>
                  <th rowspan="2" align="center">
                    <div align="center">Net Payable Salary </div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Bank A/C</div>
                  </th>
                </tr>
                <tr>
                  <th>
                    <div align="center">Gross </div>
                  </th>
                  <th>
                    <div align="center">Basic</div>
                  </th>
                  <th>
                    <div align="center">House Rent </div>
                  </th>
                  <th>
                    <div align="center">Medical</div>
                  </th>
                  <th>
                    <div align="center">Conveyance</div>
                  </th>
                  <th>
                    <div align="center">Entertainment</div>
                  </th>
                  <th>
                    <div align="center">Food</div>
                  </th>
                  <th>
                    <div align="center">Mobile</div>
                  </th>
                  <th>
                    <div align="center">Tax</div>
                  </th>
                  <th>
                    <div align="center">Provident Fund</div>
                  </th>
                  <th>
                    <div align="center">PF Loan</div>
                  </th>
                  <th>
                    <div align="center">Advance</div>
                  </th>
                  <th>
                    <div align="center">Late</div>
                  </th>
                  <th>
                    <div align="center">Absent</div>
                  </th>
                  <th>
                    <div align="center">LWP</div>
                  </th>
                  <th>
                    <div align="center">Others</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?

                if ($_POST['PBI_ORG'] != '')
                  $salaryConn = ' and a.PBI_ORG = "' . $_POST['PBI_ORG'] . '"';

                if ($_POST['department'] != '')
                  $salaryConn .= ' and t.department=' . $_POST['department'];

                if ($_POST['PBI_DESIGNATION'] != '')
                  $salaryConn .= ' and t.designation=' . $_POST['PBI_DESIGNATION'];

                if ($_POST['job_status'] != '')
                  $salaryConn .= ' and a.PBI_JOB_STATUS="' . $_POST['job_status'] . '"';


                $m_s_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '01';
                $m_e_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '31';

                $sqld = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ, (select DESG_DESC from designation where DESG_ID=t.designation) as Designation,(select DEPT_DESC from department where DEPT_ID=t.department) as department from salary_attendence t, personnel_basic_info a where t.pay>0  and  t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID ' . $salaryConn . ' order by (a.PBI_CODE) asc';

                $queryd = mysql_query($sqld);
                while ($data = mysql_fetch_object($queryd)) {
                  $m_s_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '01';
                  $m_e_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '31';
                  $tot_ded = $data->other_deduction + $data->hr_action_amt;

                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td><?= $data->PBI_CODE ?></td>
                    <td nowrap="nowrap"><?= $data->PBI_NAME ?></td>
                    <td nowrap="nowrap"><?= $data->Designation ?></td>
                    <td nowrap="nowrap"><?= $data->branch ?></td>
                    <td nowrap="nowrap"><?= $data->department ?></td>
                    <td nowrap="nowrap"><?= $data->grade ?></td>
                    <td><?= date('d-M-Y', strtotime($data->PBI_DOJ)) ?></td>
                    <td align="center"><?= ($data->pay > 0) ? $data->pay : ''; ?></td>
                    <td align="right"><?= ($data->gross_salary > 0) ? $data->gross_salary : '';
                                      $totGross += $data->gross_salary ?></td>
                    <td align="right"><?= ($data->basic_salary > 0) ? $data->basic_salary : '';
                                      $totBasic += $data->basic_salary ?></td>
                    <td align="right"><?= ($data->house_rent > 0) ? $data->house_rent : '';
                                      $totHouse += $data->house_rent ?></td>
                    <td align="right"><?= ($data->medical_allowance > 0) ? $data->medical_allowance : '';
                                      $totMedical += $data->medical_allowance ?></td>
                    <td align="right"><?= ($data->ta_da_data > 0) ? $data->ta_da_data : '';
                                      $totspecial += $data->ta_da_data ?></td>
                    <td align="right"><?= ($data->entertainment > 0) ? $data->entertainment : '';
                                      $totEntertainment += $data->entertainment ?></td>
                    <td align="right"><?= ($data->food_allowance > 0) ? $data->food_allowance : '';
                                      $totFood += $data->food_allowance ?></td>
                    <td align="right"><?= ($data->mobile_allowance > 0) ? $data->mobile_allowance : '';
                                      $totMobile += $data->mobile_allowance ?></td>
                    <td align="right"><?= ($data->salary_arrear > 0) ? $data->salary_arrear : '';
                                      $totArrear += $data->salary_arrear ?></td>
                    <td align="right"><?= ($data->total_salary > 0) ? $data->total_salary : '';
                                      $totSalary += $data->total_salary ?></td>
                    <td align="right"><?= ($data->income_tax > 0) ? $data->income_tax : '';
                                      $totIincomeTax += $data->income_tax ?></td>
                    <td align="right"><?= ($data->pf > 0) ? $data->pf : '';
                                      $totPfDeduct += $data->pf ?></td>
                    <td align="right"><?= ($data->pf_loan > 0) ? $data->pf_loan : '';
                                      $totPfLoan += $data->pf_loan ?></td>

                    <td align="right"><?= ($data->advance_install > 0) ? $data->advance_install : '';
                                      $totAdvance += $data->advance_install ?></td>
                    <td align="right"><?= ($data->late_deduction > 0) ? $data->late_deduction : '';
                                      $totLate += $data->late_deduction ?></td>

                    <td align="right"><?= ($data->absent_deduction > 0) ? $data->absent_deduction : '';
                                      $totAbsentDeduct += $data->absent_deduction ?></td>
                    <td align="right"><?= ($data->lwp_deduction > 0) ? $data->lwp_deduction : '';
                                      $totLwpDeduct += $data->lwp_deduction ?></td>
                    <td align="right"><?= ($data->other_deduction > 0) ? $data->other_deduction : '';
                                      $totOtherDeduct += $data->other_deduction ?></td>
                    <td align="right"><?= ($data->total_deduction > 0) ? $data->total_deduction : '';
                                      $totTotalDeduct += $data->total_deduction ?></td>
                    <td align="right"><? echo ($data->total_payable > 0) ? $data->total_payable : '';
                                      $total_cash = $total_cash + $data->total_payable; ?></td>
                    <td><?= ($data->card_no > 0) ? $data->card_no : ''; ?></td>
                  </tr>
                <?  } ?>
                <tr>
                  <td colspan="9" align="right" style="font-weight:bold;">Total:</td>
                  <td align="right"><strong><?= ($totGross > 0) ? number_format($totGross, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totBasic > 0) ? number_format($totBasic, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totHouse > 0) ? number_format($totHouse, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totMedical > 0) ? number_format($totMedical, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totspecial > 0) ? number_format($totspecial, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totEntertainment > 0) ? number_format($totEntertainment, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totFood > 0) ? number_format($totFood, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totMobile > 0) ? number_format($totMobile, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totArrear > 0) ? number_format($totArrear, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totSalary > 0) ? number_format($totSalary, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totIincomeTax > 0) ? number_format($totIincomeTax, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totPfDeduct > 0) ? number_format($totPfDeduct, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totPfLoan > 0) ? number_format($totPfLoan, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totAdvance > 0) ? number_format($totAdvance, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totLate > 0) ? number_format($totLate, 0) : ''; ?></strong></td>

                  <td align="right"><strong> <?= ($totAbsentDeduct > 0) ? number_format($totAbsentDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totLwpDeduct > 0) ? number_format($totLwpDeduct, 0) : ''; ?> </strong></td>
                  <td align="right"><strong><?= ($totOtherDeduct > 0) ? number_format($totOtherDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totTotalDeduct > 0) ? number_format($totTotalDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($total_cash > 0) ? number_format($total_cash, 0) : ''; ?></strong></td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>




            <!--<table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">
	<thead>
	  <tr>

	    <th>test</th>

		<th>test</th>

		<th>test</th>

	  </tr>

	</thead>

	</table>

<div style="width:100px"><? //include('PrintFormat.php');
                          ?></div>

  <div id="reporting">

  <table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">

   <thead>

  <tr>

  <td style="border:0px;">&nbsp;</td>

  </tr>

  </thead>
  </table>

</div>-->


            In Words:
            <?
            echo convertNumberMhafuz($total_cash);


            /*$approval = find_all_field('salary_approval','','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'" and business_unit="'.$_POST['JOB_LOCATION'].'"');

$entry_by =  $approval->entry_by;

$checked_by = $approval->checked_by;

$approved_by = $approval->approved_by;

$status =  $approval->status;

$file_path_c = '../../pic/signature/'.$checked_by.'.png';

$file_path_a = '../../pic/signature/'.$approved_by.'.png';

if($checked_by>0){

if(file_exists($file_path_c)){

$signature_c = '<img src="'.$file_path_c.'" style="margin-left:35px; margin-top:-40px;">';

}else{

$signature_c = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$checked_by);

}

}else{

$signature_c = '';

}

if($approved_by>0){

if(file_exists($file_path_a)){

$signature_a = '<img src="'.$file_path_a.'" style="margin-left:35px; margin-top:-40px;">';

}else{

$signature_a = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$approved_by);

}

}else{

$signature_a = '';

}*/

            ?>
            <!--<div style="width:100%; margin:60px auto">

      <div style="float:left; width:20%; text-align:center"><strong><?= find_a_field('user_activity_management', 'fname', 'user_id=' . $entry_by) ?></strong><br>-------------------<br>

        Prepared By</div>

      <div style="float:left; width:20%; text-align:center"><strong><?= $signature_c ?></strong><br>-------------------<br>

        Checked By</div>

      <div style="float:left; width:20%; text-align:center"><strong><?= $signature_a ?></strong><br>-------------------<br>
        Approved By</div>

    </div>-->


            <!-- Bhaiya Housing salary report start -->

          <?
        }
        if ($_POST['report'] == 789) {

          ?>
            <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <thead>
                <tr>
                  <th style="border:0px;" width="10%" align="left"><img src="../../../logo/<?= $_SESSION['proj_id'] ?>.png" width="100%">
                  </th>
                  <th style="border:0px;" width="90%" align="center"><?= $str ?></th>
                </tr>
              </thead>
            </table>
            <table width="100%" cellspacing="0" cellpadding="2" border="1" id="ExportTable">
              <thead>
                <tr>
                  <th rowspan="2">S/L</th>
                  <th rowspan="2">
                    <div align="center">Employee ID</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Name</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Designation</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Payment Type</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Department</div>
                  </th>

                  <!--<th rowspan="2" nowrap="nowrap"><div align="center"> Joining Date </div></th>-->
                  <th rowspan="2" align="center">
                    <div align="center">Total Days Works</div>
                  </th>
                  <th colspan="5">
                    <div align="center">Salary and Allowance </div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Arrear</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Total Payment</div>
                  </th>
                  <th colspan="8" align="center">
                    <div align="center">Deduction</div>
                  </th>
                  <th rowspan="2">
                    <div align="center">Total Deduction </div>
                  </th>
                  <th rowspan="2" align="center">
                    <div align="center">Net Payable Salary </div>
                  </th>
                  <!--<th rowspan="2"><div align="center">Bank A/C</div></th>-->
                </tr>
                <tr>
                  <th>
                    <div align="center">Gross </div>
                  </th>
                  <th>
                    <div align="center">Basic</div>
                  </th>
                  <th>
                    <div align="center">House Rent </div>
                  </th>
                  <th>
                    <div align="center">Medical</div>
                  </th>
                  <th>
                    <div align="center">Conveyance</div>
                  </th>



                  <th>
                    <div align="center">Tax</div>
                  </th>
                  <th>
                    <div align="center">Provident Fund</div>
                  </th>
                  <th>
                    <div align="center">PF Loan</div>
                  </th>
                  <th>
                    <div align="center">Advance</div>
                  </th>
                  <th>
                    <div align="center">Late</div>
                  </th>
                  <th>
                    <div align="center">Absent</div>
                  </th>
                  <th>
                    <div align="center">LWP</div>
                  </th>
                  <th>
                    <div align="center">Others</div>
                  </th>
                </tr>
              </thead>
              <tbody>

                <?

                if ($_POST['PBI_ID'] != '') {
                  $id_con .= ' and a.PBI_ID = "' . $_POST['PBI_ID'] . '"';
                }

                if ($_POST['PBI_ORG'] != '')
                  $salaryConn = ' and a.PBI_ORG = "' . $_POST['PBI_ORG'] . '"';

                if ($_POST['department'] != '')
                  $salaryConn .= ' and t.department=' . $_POST['department'];

                if ($_POST['PBI_DESIGNATION'] != '')
                  $salaryConn .= ' and t.designation=' . $_POST['PBI_DESIGNATION'];

                if ($_POST['job_status'] != '')
                  $salaryConn .= ' and a.PBI_JOB_STATUS="' . $_POST['job_status'] . '"';

                if ($_POST['PBI_GROUP'] != '')
                  $PBI_GRP .= ' and a.PBI_GROUP="' . $_POST['PBI_GROUP'] . '"';


                $m_s_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '01';
                $m_e_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '31';

                $sqld = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ, 
                (select DESG_DESC from designation where DESG_ID=t.designation) as Designation,
                (select DEPT_DESC from department where DEPT_ID=t.department) as department 
                from salary_attendence t, personnel_basic_info a where t.pay>0  and  t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID ' . $salaryConn . $PBI_GRP . $id_con . ' order by (a.PBI_CODE) asc';

                $queryd = mysql_query($sqld);
                while ($data = mysql_fetch_object($queryd)) {
                  $m_s_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '01';
                  $m_e_date = $_POST['year'] . '-' . $_POST['mon'] . '-' . '31';
                  $tot_ded = $data->other_deduction + $data->hr_action_amt;

                ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td><?= $data->PBI_CODE ?></td>
                    <td nowrap="nowrap"><?= $data->PBI_NAME ?></td>
                    <td nowrap="nowrap"><?= $data->Designation ?></td>
                    <td nowrap="nowrap"><?= $data->bank_or_cash ?></td>
                    <td nowrap="nowrap"><?= $data->department ?></td>

                    <!--<td><? //=date('d-M-Y',strtotime($data->PBI_DOJ))
                            ?></td>-->
                    <td align="center"><?= ($data->pay > 0) ? $data->pay : ''; ?></td>
                    <td align="right"><?= ($data->gross_salary > 0) ? $data->gross_salary : '';
                                      $totGross += $data->gross_salary ?></td>
                    <td align="right"><?= ($data->basic_salary > 0) ? $data->basic_salary : '';
                                      $totBasic += $data->basic_salary ?></td>
                    <td align="right"><?= ($data->house_rent > 0) ? $data->house_rent : '';
                                      $totHouse += $data->house_rent ?></td>
                    <td align="right"><?= ($data->medical_allowance > 0) ? $data->medical_allowance : '';
                                      $totMedical += $data->medical_allowance ?></td>
                    <td align="right"><?= ($data->ta_da_data > 0) ? $data->ta_da_data : '';
                                      $totspecial += $data->ta_da_data ?></td>



                    <td align="right"><?= ($data->salary_arrear > 0) ? $data->salary_arrear : '';
                                      $totArrear += $data->salary_arrear ?></td>
                    <td align="right"><?= ($data->total_salary > 0) ? $data->total_salary : '';
                                      $totSalary += $data->total_salary ?></td>
                    <td align="right"><?= ($data->income_tax > 0) ? $data->income_tax : '';
                                      $totIincomeTax += $data->income_tax ?></td>
                    <td align="right"><?= ($data->pf > 0) ? $data->pf : '';
                                      $totPfDeduct += $data->pf ?></td>
                    <td align="right"><?= ($data->pf_loan > 0) ? $data->pf_loan : '';
                                      $totPfLoan += $data->pf_loan ?></td>

                    <td align="right"><?= ($data->advance_install > 0) ? $data->advance_install : '';
                                      $totAdvance += $data->advance_install ?></td>
                    <td align="right"><?= ($data->late_deduction > 0) ? $data->late_deduction : '';
                                      $totLate += $data->late_deduction ?></td>

                    <td align="right"><?= ($data->absent_deduction > 0) ? $data->absent_deduction : '';
                                      $totAbsentDeduct += $data->absent_deduction ?></td>
                    <td align="right"><?= ($data->lwp_deduction > 0) ? $data->lwp_deduction : '';
                                      $totLwpDeduct += $data->lwp_deduction ?></td>
                    <td align="right"><?= ($data->other_deduction > 0) ? $data->other_deduction : '';
                                      $totOtherDeduct += $data->other_deduction ?></td>
                    <td align="right"><?= ($data->total_deduction > 0) ? $data->total_deduction : '';
                                      $totTotalDeduct += $data->total_deduction ?></td>
                    <td align="right"><? echo ($data->total_payable > 0) ? $data->total_payable : '';
                                      $total_cash = $total_cash + $data->total_payable; ?></td>
                    <!--<td><? //=($data->card_no>0)? $data->card_no : '';
                            ?></td>-->
                  </tr>
                <?  } ?>
                <tr>
                  <td colspan="7" align="right" style="font-weight:bold;">Total:</td>
                  <td align="right"><strong><?= ($totGross > 0) ? number_format($totGross, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totBasic > 0) ? number_format($totBasic, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totHouse > 0) ? number_format($totHouse, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totMedical > 0) ? number_format($totMedical, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totspecial > 0) ? number_format($totspecial, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totArrear > 0) ? number_format($totArrear, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totSalary > 0) ? number_format($totSalary, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totIincomeTax > 0) ? number_format($totIincomeTax, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totPfDeduct > 0) ? number_format($totPfDeduct, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totPfLoan > 0) ? number_format($totPfLoan, 0) : ''; ?></strong></td>

                  <td align="right"><strong><?= ($totAdvance > 0) ? number_format($totAdvance, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totLate > 0) ? number_format($totLate, 0) : ''; ?></strong></td>

                  <td align="right"><strong> <?= ($totAbsentDeduct > 0) ? number_format($totAbsentDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totLwpDeduct > 0) ? number_format($totLwpDeduct, 0) : ''; ?> </strong></td>
                  <td align="right"><strong><?= ($totOtherDeduct > 0) ? number_format($totOtherDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($totTotalDeduct > 0) ? number_format($totTotalDeduct, 0) : ''; ?></strong></td>
                  <td align="right"><strong><?= ($total_cash > 0) ? number_format($total_cash, 0) : ''; ?></strong></td>

                </tr>
              </tbody>






            </table>




            <!--<table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">
	<thead>
	  <tr>

	    <th>test</th>

		<th>test</th>

		<th>test</th>

	  </tr>

	</thead>

	</table>

<div style="width:100px"><? //include('PrintFormat.php');
                          ?></div>

  <div id="reporting">

  <table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">

   <thead>

  <tr>

  <td style="border:0px;">&nbsp;</td>

  </tr>

  </thead>
  </table>

</div>-->


            In Words:
            <?
            echo convertNumberMhafuz($total_cash);


            /*$approval = find_all_field('salary_approval','','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'" and business_unit="'.$_POST['JOB_LOCATION'].'"');

$entry_by =  $approval->entry_by;

$checked_by = $approval->checked_by;

$approved_by = $approval->approved_by;

$status =  $approval->status;

$file_path_c = '../../pic/signature/'.$checked_by.'.png';

$file_path_a = '../../pic/signature/'.$approved_by.'.png';

if($checked_by>0){

if(file_exists($file_path_c)){

$signature_c = '<img src="'.$file_path_c.'" style="margin-left:35px; margin-top:-40px;">';

}else{

$signature_c = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$checked_by);

}

}else{

$signature_c = '';

}

if($approved_by>0){

if(file_exists($file_path_a)){

$signature_a = '<img src="'.$file_path_a.'" style="margin-left:35px; margin-top:-40px;">';

}else{

$signature_a = find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$approved_by);

}

}else{

$signature_a = '';

}*/

            ?>




            <br>
            </br>
            <br>
            </br>
            <br>
            </br>
            <br>
            </br>


            <div style="width:80%; margin:0 auto">

              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                HR Department</div>


              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                Accounts Department</div>


              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                CEO</div>

              <div style="float:left; width:25%; text-align:center; font-size:18px;">-----------------<br>
                Chairman</div>
            </div>

            <p>&nbsp; </p>
            <p>&nbsp;</p>








            <!--<div style="width:100%; margin:60px auto">

      <div style="float:left; width:20%; text-align:center"><strong><?= find_a_field('user_activity_management', 'fname', 'user_id=' . $entry_by) ?></strong><br>-------------------<br>

        Prepared By</div>

      <div style="float:left; width:20%; text-align:center"><strong><?= $signature_c ?></strong><br>-------------------<br>

        Checked By</div>

      <div style="float:left; width:20%; text-align:center"><strong><?= $signature_a ?></strong><br>-------------------<br>
        Approved By</div>

    </div>


<!-- Bhaiya Housing salary report start -->

            <br>

          <?

        }
        if ($_POST['report'] == 82) { // Salary Payroll Report Final-- Group

          if ($_POST['PBI_ORG'] != '') {
            $PBI_ORG_con = ' and t.pbi_organization = "' . $_POST['PBI_ORG'] . '"';
          }

          if ($_POST['department'] != '') {
            $department_con = ' and DEPT_ID = "' . $_POST['department'] . '"';
          }

          if ($_POST['JOB_LOCATION'] != '') {
            $job_location_con = ' and t.pbi_job_location = "' . $_POST['JOB_LOCATION'] . '"';
          }

          if ($_POST['pbi_id_in'] != '')  $pbi_id_con = " and t.PBI_ID in (" . $_POST['pbi_id_in'] . ")";

          if ($_POST['PBI_DOMAIN'] != '') {
            $section_con = ' and a.PBI_DOMAIN = "' . $_POST['PBI_DOMAIN'] . '"';
          }


          ?>
            <center>
              <tr>
                <th style="border:0px;" colspan="41"><?= $str ?></th>
              </tr>
            </center>
            <?































            $sql2 = 'select DEPT_ID as dept_id from personnel_basic_info 







where PBI_ORG=1 and PBI_JOB_STATUS="In Service" and DEPT_ID>0 







group by DEPT_ID order by DEPT_ID desc';







            $query2 = mysql_query($sql2);







            while ($data2 = mysql_fetch_object($query2)) {







            ?>
              <h2>Department:
                <?= find_a_field('department', 'DEPT_DESC', 'DEPT_ID="' . $data2->dept_id . '"'); ?>
              </h2>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th rowspan="2">S/L-82</th>
                    <th rowspan="2">CODE</th>
                    <th rowspan="2">
                      <div>Full Name</div>
                    </th>
                    <th rowspan="2"><img src="images/desgnation.jpg" /></th>
                    <th rowspan="2"><img src="images/joining_date.jpg" alt="" /></th>
                    <th rowspan="2">Bank AC#</th>
                    <th colspan="8">
                      <div>Monthly Attendence Record</div>
                    </th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Accrued Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="4">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th colspan="4">
                      <div>View Only </div>
                    </th>
                    <th rowspan="2">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th><img src="images/present.jpg" /></th>
                    <th><img src="images/weekend.jpg" /></th>
                    <th><img src="images/festival.jpg" /></th>
                    <th><img src="images/leave.JPG" /></th>
                    <th><img src="images/late.JPG" /></th>
                    <th><img src="images/lwp.jpg" /></th>
                    <th><img src="images/absent.JPG" /></th>
                    <th><img src="images/payable_days.JPG" /></th>
                    <th><img src="images/salary.jpg" /></th>
                    <th><img src="images/special_allowance.JPG" /></th>
                    <th><img src="images/ta_da.JPG" /></th>
                    <th><img src="images/salary.jpg" /></th>
                    <th><img src="images/special_allowance.JPG" /></th>
                    <th><img src="images/ta_da.JPG" /></th>
                    <th><img src="images/house_rent.JPG" /></th>
                    <th><img src="images/car.JPG" /></th>
                    <th><img src="images/food.JPG" /></th>
                    <th><img src="images/mobile.JPG" /></th>
                    <th><img src="images/arear.JPG" /></th>
                    <th><img src="images/other.JPG" /></th>
                    <th><img src="images/ait.JPG" /></th>
                    <th><img src="images/advance_salary.JPG" /></th>
                    <th><img src="images/co-op-fund.JPG" /></th>
                    <th><img src="images/bike.JPG" /></th>
                    <th><img src="images/excess_mobile.JPG" /></th>
                    <th><img src="images/administrative.JPG" /></th>
                    <th>H-Up</th>
                    <th><img src="images/cash.JPG" /></th>
                    <th><img src="images/bank_payment.JPG" /></th>
                    <th><img src="images/total_salary.JPG" /></th>
                    <th><img src="images/last_salary.JPG" /></th>
                    <th><img src="images/diff.JPG" /></th>
                    <th><img src="images/late_attendence.JPG" /></th>
                    <th><img src="images/absent_lwp.JPG" /></th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select 







t.basic_salary actual_basic_salary,







t.spl_alw_data actual_special_allawance, 







t.*,a.PBI_ID,a.PBI_NAME,d.DESG_DESC PBI_DESIGNATION ,a.PBI_DEPARTMENT, a.PBI_DOJ,  t.pbi_held_up held_up_status,s.cash_bank,s.cash















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s 















where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' 







and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID 







and a.DEPT_ID="' . $data2->dept_id . '"







' . $job_location_con . $pbi_id_con . $section_con . '







ORDER BY a.pbi_grade desc, (t.consolidated_salary+t.basic_salary) desc







';







                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= $data->PBI_ID ?></td>
                      <td><?= $data->PBI_NAME ?></td>
                      <td><?= $data->PBI_DESIGNATION ?></td>
                      <td><?= date('d-m-Y', strtotime($data->PBI_DOJ)); ?></td>
                      <td><?= $data->cash ?></td>
                      <td><?= $data->pre ?></td>
                      <td><?= $data->od ?></td>
                      <td><?= $data->hd ?></td>
                      <td><?= $data->lv ?></td>
                      <td><?= $data->lt ?></td>
                      <td><?= $data->lwp ?></td>
                      <td><?= $data->ab ?></td>
                      <td><?= $data->pay ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent) ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= ($data->advance_install + $data->other_install) ?>
                        <? $total_advance_install = $total_advance_install + ($data->advance_install + $data->other_install); ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? if ($data->held_up_status == '1') {
                            echo $data->total_payable;
                            $total_held_up = $total_held_up + $data->total_payable;
                          } ?></td>
                      <td><? if ($data->held_up_status == '0') {
                            $cash_payment = $data->total_payable - $data->bank_paid;
                            echo number_format($cash_payment);
                            $total_cash_payment = $total_cash_payment + $cash_payment;
                          } ?></td>
                      <td><? if ($data->held_up_status == '0') {
                            echo number_format($data->bank_paid);
                            $total_bank_payment = $total_bank_payment + $data->bank_paid;
                          } ?></td>
                      <td><span style="text-align:right; font-weight:bold;">
                          <?php if ($data->held_up_status == '0') {
                            echo $data->total_payable;
                            $total_cash = $total_cash + $data->total_payable;
                          } ?>
                        </span></td>
                      <td><?php







                          if ($_POST['mon'] == 1) {
                            $p_mon = 12;
                          } else {
                            $p_mon = ($_POST['mon'] - 1);
                          }







                          if ($_POST['mon'] == 1) {
                            $p_yr = ($_POST['year'] - 1);
                          } else {
                            $p_yr = $_POST['year'];
                          }







                          echo $pre_salry = find_a_field('salary_attendence', 'total_payable', 'PBI_ID="' . $data->PBI_ID . '" and mon="' . $p_mon . '" and year="' . $p_yr . '" ');







                          ?></td>
                      <td><? echo $differ_last = ($data->total_payable - $pre_salry);
                          $differ_last_all = $differ_last_all + $differ_last; ?></td>
                      <td><span style="text-align:right">
                          <?= (int)$data->late_deduction ?>
                        </span></td>
                      <td><span style="text-align:right">
                          <?= (int)$data->absent_deduction ?>
                        </span></td>
                      <td style="color:#FF0000; font-weight:bold"><?= ($data->held_up_status == '1') ? 'Held-Up' : '' ?></td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="14"><?= convertNumberMhafuz($total_cash); ?></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_administrative_deduction; ?>
                      </strong></td>
                    <td><?= $total_held_up ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_bank_payment ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cash ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><strong>
                        <?= $differ_last_all ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <p><br>
              <?







              $total_actual_basic_salary = 0;







              $total_actual_special_allawance = 0;







              $total_ta_da_data = 0;







              $total_basic_salary_payable = 0;







              $total_spl_alw_data = 0;







              $total_ta_da = 0;







              $total_house_rent = 0;







              $total_vehicle_allowance = 0;







              $total_food_allowance = 0;







              $total_mobile_allowance = 0;







              $total_benefits = 0;







              $total_other_benefits = 0;







              $total_income_tax = 0;







              $total_advance_install = 0;







              $total_cooperative_share = 0;







              $total_motorcycle_install = 0;







              $total_deduction = 0;







              $total_administrative_deduction = 0;







              $total_held_up = 0;







              $total_cash_payment = 0;







              $total_bank_payment = 0;







              $total_cash = 0;







              $differ_last_all = 0;
            } // end while







              ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          } //end report 82































































          if ($_POST['report'] == 783) { // Zone Wise Sales Salary Brief Report















            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,count(a.PBI_ID) nos,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $queryd = mysql_query($sqld);







            while ($i = mysql_fetch_object($queryd)) {







              $nos[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->nos;







              $actual_basic_salary[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->actual_basic_salary;







              $actual_special_allawance[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->actual_special_allawance;







              $basic_salary_payable[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->basic_salary_payable;







              $special_allowance[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->special_allowance;







              $ta_da_data[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->ta_da_data;







              $ta_da[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->ta_da;







              $house_rent[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->house_rent;







              $vehicle_allowance[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->vehicle_allowance;







              $food_allowance[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->food_allowance;







              $mobile_allowance[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->mobile_allowance;







              $benefits[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->benefits;







              $other_benefits[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->other_benefits;







              $income_tax[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->income_tax;







              $total_install[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->total_install;







              $cooperative_share[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->cooperative_share;







              $motorcycle_install[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->motorcycle_install;







              $deduction[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->deduction;







              $absent_deduction[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->absent_deduction;







              $held_up_status[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->held_up_status;







              $cash_bank[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->cash_bank;
            }







            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,







sum(t.total_payable) held_up_paid















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where t.pbi_held_up=1 and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $q = mysql_query($sqld);







            while ($i = mysql_fetch_object($q)) {







              $held_up_paid[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->held_up_paid;
            }







            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,







sum(t.total_payable-t.bank_paid) cash_paid















from salary_attendence t, personnel_basic_info a, designation d, salary_info s where t.pbi_held_up=0 and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $q = mysql_query($sqld);







            while ($i = mysql_fetch_object($q)) {







              $cash_paid[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->cash_paid;
            }







            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,







sum(t.bank_paid) dbbl_paid















from salary_attendence t, personnel_basic_info a, designation d, salary_info s where t.pbi_held_up=0 and s.cash_bank="DBBL" and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $q = mysql_query($sqld);







            while ($i = mysql_fetch_object($q)) {







              $dbbl_paid[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->dbbl_paid;
            }















            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,







sum(t.bank_paid) ibbl_paid















from salary_attendence t, personnel_basic_info a, designation d, salary_info s where t.pbi_held_up=0 and s.cash_bank="IBBL" and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $q = mysql_query($sqld);







            while ($i = mysql_fetch_object($q)) {







              $ibbl_paid[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->ibbl_paid;
            }







            $sqld = 'select t.pbi_region PBI_BRANCH,a.PBI_ZONE,







sum(t.total_payable) total_payable















from salary_attendence t, personnel_basic_info a, designation d, salary_info s where t.pbi_held_up=0 and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 ' . $PBI_GROUP_con . ' group by t.pbi_region ,a.PBI_ZONE';







            $q = mysql_query($sqld);







            while ($i = mysql_fetch_object($q)) {







              $total_payable[$i->PBI_BRANCH][$i->PBI_ZONE] = $i->total_payable;
            }























            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="31"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Region-Zone</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th colspan="4">
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/diff.JPG" /></th>
                    <th rowspan="2"><img src="images/late_attendence.JPG" /></th>
                    <th rowspan="2"><img src="images/absent_lwp.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqls = "select * from branch";







                  $query = mysql_query($sqls);







                  while ($info = mysql_fetch_object($query)) {







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><strong>
                          <?= $info->BRANCH_NAME ?>
                          RSM/ASM</strong></td>
                      <td><?= $nos[$info->BRANCH_ID][''] ?>
                        <? $total_nos = $total_nos + $nos[$info->BRANCH_ID]['']; ?></td>
                      <td><?= (int)$actual_basic_salary[$info->BRANCH_ID][''] ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $actual_basic_salary[$info->BRANCH_ID]['']; ?></td>
                      <td><?= (int)$actual_special_allawance[$info->BRANCH_ID][''] ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $actual_special_allawance[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $ta_da_data[$info->BRANCH_ID][''] ?>
                        <? $total_ta_da_data = $total_ta_da_data + $ta_da_data[$info->BRANCH_ID]['']; ?></td>
                      <td><?= (int)$basic_salary_payable[$info->BRANCH_ID][''] ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $basic_salary_payable[$info->BRANCH_ID]['']; ?></td>
                      <td><?= (int)$special_allowance[$info->BRANCH_ID][''] ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $special_allowance[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $ta_da[$info->BRANCH_ID][''] ?>
                        <? $total_ta_da = $total_ta_da + $ta_da[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $house_rent[$info->BRANCH_ID][''] ?>
                        <? $total_house_rent = $total_house_rent + $house_rent[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $vehicle_allowance[$info->BRANCH_ID][''] ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $vehicle_allowance[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $food_allowance[$info->BRANCH_ID][''] ?>
                        <? $total_food_allowance = $total_food_allowance + $food_allowance[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $mobile_allowance[$info->BRANCH_ID][''] ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $mobile_allowance[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $benefits[$info->BRANCH_ID][''] ?>
                        <? $total_benefits = $total_benefits + $benefits[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $other_benefits[$info->BRANCH_ID][''] ?>
                        <? $total_other_benefits = $total_other_benefits + $other_benefits[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $income_tax[$info->BRANCH_ID][''] ?>
                        <? $total_income_tax = $total_income_tax + $income_tax[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $total_install[$info->BRANCH_ID][''] ?>
                        <? $total_advance_install = $total_advance_install + $total_install[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $cooperative_share[$info->BRANCH_ID][''] ?>
                        <? $total_cooperative_share = $total_cooperative_share + $cooperative_share[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $motorcycle_install[$info->BRANCH_ID][''] ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $motorcycle_install[$info->BRANCH_ID]['']; ?></td>
                      <td><?= $deduction[$info->BRANCH_ID][''] ?>
                        <? $total_deduction = $total_deduction + $deduction[$info->BRANCH_ID]['']; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $held_up_paid[$info->BRANCH_ID][''];
                          $total_help_up_paid = $total_help_up_paid + $held_up_paid[$info->BRANCH_ID]['']; ?></td>
                      <td><? echo $cash_paid[$info->BRANCH_ID][''];
                          $total_cash_payment = $total_cash_payment + $cash_paid[$info->BRANCH_ID]['']; ?></td>
                      <td><? echo $dbbl_paid[$info->BRANCH_ID][''];
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid[$info->BRANCH_ID]['']; ?></td>
                      <td><? echo $ibbl_paid[$info->BRANCH_ID][''];
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid[$info->BRANCH_ID]['']; ?></td>
                      <td><? echo $total_payable[$info->BRANCH_ID][''];
                          $total_net_payable = $total_net_payable + $total_payable[$info->BRANCH_ID]['']; ?></span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                    <?







                    $zsql = "select * from zon where REGION_ID=" . $info->BRANCH_ID;







                    $zquery = mysql_query($zsql);







                    while ($zinfo = mysql_fetch_object($zquery)) {







                    ?>
                      <tr>
                        <td><?= ++$s ?></td>
                        <td><?= $zinfo->ZONE_NAME ?></td>
                        <td><?= $nos[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_nos = $total_nos + $nos[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= (int)$actual_basic_salary[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_actual_basic_salary = $total_actual_basic_salary + $actual_basic_salary[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= (int)$actual_special_allawance[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_actual_special_allawance = $total_actual_special_allawance + $actual_special_allawance[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $ta_da_data[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_ta_da_data = $total_ta_da_data + $ta_da_data[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= (int)$basic_salary_payable[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_basic_salary_payable = $total_basic_salary_payable + $basic_salary_payable[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= (int)$special_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_spl_alw_data = $total_spl_alw_data + $special_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $ta_da[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_ta_da = $total_ta_da + $ta_da[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $house_rent[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_house_rent = $total_house_rent + $house_rent[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $vehicle_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_vehicle_allowance = $total_vehicle_allowance + $vehicle_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $food_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_food_allowance = $total_food_allowance + $food_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $mobile_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_mobile_allowance = $total_mobile_allowance + $mobile_allowance[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $benefits[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_benefits = $total_benefits + $benefits[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $other_benefits[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_other_benefits = $total_other_benefits + $other_benefits[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $income_tax[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_income_tax = $total_income_tax + $income_tax[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $total_install[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_advance_install = $total_advance_install + $total_install[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $cooperative_share[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_cooperative_share = $total_cooperative_share + $cooperative_share[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $motorcycle_install[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_motorcycle_install = $total_motorcycle_install + $motorcycle_install[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= $deduction[$info->BRANCH_ID][$zinfo->ZONE_CODE] ?>
                          <? $total_deduction = $total_deduction + $deduction[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><?= number_format($data->administrative_deduction) ?>
                          <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                        <td><? echo $held_up_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE];
                            $total_help_up_paid = $total_help_up_paid + $held_up_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><? echo $cash_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE];
                            $total_cash_payment = $total_cash_payment + $cash_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><? echo $dbbl_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE];
                            $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><? echo $ibbl_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE];
                            $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></td>
                        <td><? echo $total_payable[$info->BRANCH_ID][$zinfo->ZONE_CODE];
                            $total_net_payable = $total_net_payable + $total_payable[$info->BRANCH_ID][$zinfo->ZONE_CODE]; ?></span></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                      </tr>
                    <?







                    }







                    ?>
                    <tr bgcolor="#3399CC">
                      <td colspan="2"><?= $info->BRANCH_NAME ?>
                        Total: </td>
                      <td><?= $total_nos ?></td>
                      <td><strong>
                          <?= $total_actual_basic_salary; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_actual_special_allawance; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_ta_da_data; ?>
                        </strong></td>
                      <td><strong>
                          <?= (int)$total_basic_salary_payable; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_spl_alw_data; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_ta_da; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_house_rent; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_vehicle_allowance; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_food_allowance; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_mobile_allowance; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_benefits; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_other_benefits; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_income_tax; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_advance_install; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_cooperative_share; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_motorcycle_install; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_deduction; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_administrative_deduction; ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_help_up_paid ?>
                        </strong></td>
                      <td><strong>
                          <?= $total_cash_payment ?>
                        </strong></td>
                      <td><?= $total_bank_payment_dbbl ?></td>
                      <td><?= $total_bank_payment_ibbl ?></td>
                      <td><strong>
                          <?= $total_net_payable ?>
                        </strong></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  <?























                    $total_total_actual_basic_salary = $total_total_actual_basic_salary + $total_actual_basic_salary;







                    $total_total_actual_special_allawance = $total_total_actual_special_allawance + $total_actual_special_allawance;







                    $total_total_ta_da_data = $total_total_ta_da_data + $total_ta_da_data;







                    $total_total_basic_salary_payable = $total_total_basic_salary_payable + $total_basic_salary_payable;







                    $total_total_spl_alw_data = $total_total_spl_alw_data + $total_spl_alw_data;







                    $total_total_ta_da = $total_total_ta_da + $total_ta_da;







                    $total_total_house_rent = $total_total_house_rent + $total_house_rent;







                    $total_total_vehicle_allowance = $total_total_vehicle_allowance + $total_vehicle_allowance;







                    $total_total_food_allowance = $total_total_food_allowance + $total_food_allowance;







                    $total_total_mobile_allowance = $total_total_mobile_allowance + $total_mobile_allowance;







                    $total_total_benefits = $total_total_benefits + $total_benefits;







                    $total_total_other_benefits = $total_total_other_benefits + $total_other_benefits;







                    $total_total_income_tax = $total_total_income_tax + $total_income_tax;







                    $total_total_advance_install = $total_total_advance_install + $total_advance_install;







                    $total_total_cooperative_share = $total_total_cooperative_share + $total_cooperative_share;







                    $total_total_motorcycle_install = $total_total_motorcycle_install + $total_motorcycle_install;







                    $total_total_deduction = $total_total_deduction + $total_deduction;







                    $total_total_help_up_paid = $total_total_help_up_paid + $total_help_up_paid;







                    $total_total_cash_payment = $total_total_cash_payment + $total_cash_payment;







                    $total_total_bank_payment_dbbl = $total_total_bank_payment_dbbl + $total_bank_payment_dbbl;







                    $total_total_bank_payment_ibbl = $total_total_bank_payment_ibbl + $total_bank_payment_ibbl;







                    $total_total_net_payable = $total_total_net_payable + $total_net_payable;







                    $total_total_nos = $total_total_nos + $total_nos;























                    $total_actual_basic_salary = 0;







                    $total_actual_special_allawance = 0;







                    $total_ta_da_data = 0;







                    $total_basic_salary_payable = 0;







                    $total_spl_alw_data = 0;







                    $total_ta_da = 0;







                    $total_house_rent = 0;







                    $total_vehicle_allowance = 0;







                    $total_food_allowance = 0;







                    $total_mobile_allowance = 0;







                    $total_benefits = 0;







                    $total_other_benefits = 0;







                    $total_income_tax = 0;







                    $total_advance_install = 0;







                    $total_cooperative_share = 0;







                    $total_motorcycle_install = 0;







                    $total_deduction = 0;







                    $total_help_up_paid = 0;







                    $total_cash_payment = 0;







                    $total_bank_payment_dbbl = 0;







                    $total_bank_payment_ibbl = 0;







                    $total_net_payable = 0;







                    $total_nos = 0;
                  }







                  ?>
                  <tr bgcolor="#FFCC99">
                    <td colspan="2"><?= $info->BRANCH_NAME ?>
                      National: </td>
                    <td><?= $total_total_nos; ?></td>
                    <td><strong>
                        <?= $total_total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_vehicle_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_total_deduction; ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= $total_total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_total_bank_payment_dbbl ?></td>
                    <td><?= $total_total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }







          if ($_POST['report'] == 780) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="30"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Region Name</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th colspan="4">
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/diff.JPG" /></th>
                    <th rowspan="2"><img src="images/late_attendence.JPG" /></th>
                    <th rowspan="2"><img src="images/absent_lwp.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary/4) actual_basic_salary,







sum(s.special_allowance/4) actual_special_allawance, 







sum(t.basic_salary_payable/4) basic_salary_payable, 







sum(t.special_allowance/4) special_allowance,







sum(t.ta_da_data/4) ta_da_data,







sum(t.ta_da/4) ta_da,







sum(t.house_rent/4) house_rent,







sum(t.vehicle_allowance/4) vehicle_allowance,







sum(t.food_allowance/4) food_allowance,







sum(t.mobile_allowance/4) mobile_allowance,







sum(t.benefits/4) benefits,







sum(t.other_benefits/4) other_benefits,







sum(t.income_tax/4) income_tax,







sum((t.advance_install+ t.other_install)/4) total_install,







sum(t.cooperative_share/4) cooperative_share,







sum(t.motorcycle_install/4) motorcycle_install,







sum(t.deduction/4) deduction,















sum(t.absent_deduction/4) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales" group by t.pbi_region ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_ta_da = $total_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_house_rent = $total_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_benefits = $total_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_income_tax = $total_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_advance_install = $total_advance_install + $total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_deduction = $total_deduction + $data->deduction; ?>
                    <? //echo number_format(0);
                    ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)/4', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)/4', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_cash_payment = $total_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)/4', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)/4', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)/4', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_net_payable = $total_net_payable + $net_payable; ?>
                  <?







                  }







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(t.spl_alw_data) actual_special_allawance, 















sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  ' . $PBI_GROUP_con . ' group by t.pbi_region ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?>
                    <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?>
                    <? $total_ta_da = $total_ta_da + $data->ta_da; ?>
                    <? $total_house_rent = $total_house_rent + $data->house_rent; ?>
                    <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?>
                    <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?>
                    <? $total_benefits = $total_benefits + $data->benefits; ?>
                    <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?>
                    <? $total_income_tax = $total_income_tax + $data->income_tax; ?>
                    <? $total_advance_install = $total_advance_install + $total_install; ?>
                    <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?>
                    <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?>
                    <? $total_deduction = $total_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ' . $PBI_GROUP_con);
                    $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ' . $PBI_GROUP_con);
                    $total_cash_payment = $total_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ' . $PBI_GROUP_con);
                    $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ' . $PBI_GROUP_con);
                    $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ' . $PBI_GROUP_con);
                    $total_net_payable = $total_net_payable + $net_payable; ?>
                  <?







                  }







                  ?>
                  <tr>
                    <td><?= ++$s ?></td>
                    <td>Head Office</td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_vehicle_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <?







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(t.spl_alw_data) actual_special_allawance,  















sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region >0 and t.pbi_department="Sales"  ' . $PBI_GROUP_con . ' group by t.pbi_region ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID=' . $data->PBI_BRANCH) ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= $data->house_rent ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= $data->vehicle_allowance ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_vehicle_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }















          if ($_POST['report'] == 7809) {







            $year = $_POST['year'];







            $mon = $_POST['mon'];















            if ($mon == 1) {







              $syear = $year - 1;







              $smon = 12;
            } else {







              $syear = $year;







              $smon =  $mon - 1;
            }







            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="12"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Name of Unit</th>
                    <th colspan="2">Previous Month</th>
                    <th colspan="6">
                      <div>
                        <?= date('F', mktime(0, 0, 0, $mon, 10)); ?>
                        -
                        <?= $year ?>
                      </div>
                    </th>
                    <th rowspan="3">Difference</th>
                    <th rowspan="3">Remark</th>
                  </tr>
                  <tr>
                    <th rowspan="2">Man Power</th>
                    <th rowspan="2">Total Amount</th>
                    <th rowspan="2">Man Power</th>
                    <th colspan="3">BANK</th>
                    <th rowspan="2">Cash Tk</th>
                    <th rowspan="2">Total Tk</th>
                  </tr>
                  <tr>
                    <th>DBBL</th>
                    <th>IBBL</th>
                    <th>Other</th>
                  </tr>
                </thead>
                <tbody>
                  <?















                  echo $sqld = 'select t.pbi_organization, count(t.PBI_ID) manpower,s.cash_bank







from  salary_attendence t, personnel_basic_info a, salary_info s where t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location in (1,79,80) and t.pbi_held_up=0  ' . $PBI_GROUP_con . ' group by t.pbi_organization ';







                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;























                    $cash_paid[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80)  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);























                    $dbbl_paid[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80)  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);















                    $ibbl_paid[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80)  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);















                    $ncc_paid[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="NCC" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80)  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);















                    $net_payable[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80)  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);























                    $smanpower[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a ', 'count(t.PBI_ID) manpower', 't.pbi_job_location in (1,79,80) and t.PBI_ID=a.PBI_ID and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);























                    $snet_payable[$data->pbi_organization] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location in (1,79,80) and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_held_up=0 and t.pbi_organization = "' . $data->pbi_organization . '" ' . $PBI_GROUP_con);















                    $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid[$data->pbi_organization];







                    $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid[$data->pbi_organization];







                    $total_cash_payment = $total_cash_payment + $cash_paid[$data->pbi_organization];







                    $total_bank_payment_ncc = $total_bank_payment_ncc + $ncc_paid[$data->pbi_organization];







                    $total_net_payable = $total_net_payable + $net_payable[$data->pbi_organization];







                    $stotal_smanpower = $stotal_smanpower + $smanpower[$data->pbi_organization];







                    $stotal_net_payable = $stotal_net_payable + $snet_payable[$data->pbi_organization];







                    ++$s;















                    $manpower[$data->pbi_organization] = $data->manpower;







                    $total_manpower = $total_manpower + $manpower[$data->pbi_organization];
                  }































                  $sqld = 'select count(t.PBI_ID) manpower,s.cash_bank







from  salary_attendence t, personnel_basic_info a, salary_info s where t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO") and t.pbi_held_up=0  ' . $PBI_GROUP_con . ' ';







                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;























                    $cash_paid[100] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);























                    $dbbl_paid[100] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);















                    $ibbl_paid[100] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);















                    $ncc_paid[100] = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="NCC" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);















                    $net_payable[100] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);























                    $smanpower[100] = find_a_field('salary_attendence t,personnel_basic_info a ', 'count(t.PBI_ID) manpower', 't.PBI_ID=a.PBI_ID and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);























                    $snet_payable[100] = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_held_up=0 and t.pbi_department in ("Admin (Support Service Section)","Store (Transport)","STO")  ' . $PBI_GROUP_con);















                    $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid[100];







                    $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid[100];







                    $total_cash_payment = $total_cash_payment + $cash_paid[100];







                    $total_bank_payment_ncc = $total_bank_payment_ncc + $ncc_paid[100];







                    $total_net_payable = $total_net_payable + $net_payable[100];







                    $stotal_smanpower = $stotal_smanpower + $smanpower[100];







                    $stotal_net_payable = $stotal_net_payable + $snet_payable[100];







                    ++$s;















                    $manpower[100] = $data->manpower;







                    $total_manpower = $total_manpower + $manpower[100];
                  }







                  ?>
                  <tr>
                    <td>1</td>
                    <td>Sajeeb Corporation</td>
                    <td><span style="text-align:left; font-weight:bold;">
                        <?= $smanpower[1] + $smanpower[2] + $smanpower[100] ?>
                      </span></td>
                    <td><span style="text-align:left; font-weight:bold;">
                        <?= $snet_payable[1] + $snet_payable[2] + $snet_payable[100] ?>
                      </span></td>
                    <td><?= $manpower[1] + $manpower[2] + $manpower[100] ?></td>
                    <td><?= $dbbl_paid[1] + $dbbl_paid[2] + $dbbl_paid[100] ?></td>
                    <td><?= $ibbl_paid[1] + $ibbl_paid[2] + $ibbl_paid[100] ?></td>
                    <td><?= $ncc_paid[1] + $ncc_paid[2] + $ncc_paid[100] ?></td>
                    <td><strong>
                        <?= $cash_paid[1] + $cash_paid[2] + $cash_paid[100] ?>
                      </strong></td>
                    <td><strong>
                        <?= $net_payable[1] + $net_payable[2] + $net_payable[100] ?>
                      </strong></td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <?







                  ++$j;







                  $sqld = 'select id, group_name







from  user_group where id>2 and status>0 order by id';







                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <tr>
                      <td><?= ++$j ?></td>
                      <td><?= $data->group_name; ?></td>
                      <td><span style="text-align:left; font-weight:bold;">
                          <?= $smanpower[$data->id]; ?>
                        </span></td>
                      <td><span style="text-align:left; font-weight:bold;">
                          <?= $snet_payable[$data->id]; ?>
                        </span></td>
                      <td><?= $manpower[$data->id] ?></td>
                      <td><?= $dbbl_paid[$data->id] ?></td>
                      <td><?= $ibbl_paid[$data->id] ?></td>
                      <td><?= $ncc_paid[$data->id] ?></td>
                      <td><strong>
                          <?= $cash_paid[$data->id] ?>
                        </strong></td>
                      <td><strong>
                          <?= $net_payable[$data->id] ?>
                        </strong></td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">Sub Total (A)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">Sales Department:</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <?







                  $sqld = 'select t.pbi_region PBI_BRANCH, count(t.PBI_ID) manpower, s.cash_bank







from  salary_attendence t, personnel_basic_info a, salary_info s where t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region > 0 and t.pbi_department="Sales"  ' . $PBI_GROUP_con . ' group by t.pbi_region ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$ws ?></td>
                      <td><?= find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID=' . $data->PBI_BRANCH) ?></td>
                      <td><span style="text-align:left; font-weight:bold;"><?php echo $smanpower = find_a_field('salary_attendence t,personnel_basic_info a ', 'count(t.PBI_ID) manpower', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                                                                            $stotal_smanpower = $stotal_smanpower + $smanpower; ?></span></td>
                      <td><span style="text-align:left; font-weight:bold;"><?php echo $snet_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $smon . ' and t.year=' . $syear . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                                                                            $stotal_net_payable = $stotal_net_payable + $snet_payable; ?></span></td>
                      <td><?= $data->manpower ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td>&nbsp;</td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><span style="text-align:left; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region ="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con);
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">Sub Total (B)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">Sub Total (A+B)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td>&nbsp;</td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }















          if ($_POST['report'] == 7804) { // Group Wise HO Sales Report















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="30"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Group Name</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th colspan="4">
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/diff.JPG" /></th>
                    <th rowspan="2"><img src="images/late_attendence.JPG" /></th>
                    <th rowspan="2"><img src="images/absent_lwp.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary/5) actual_basic_salary,







sum(s.special_allowance/5) actual_special_allawance, 







sum(t.basic_salary_payable/5) basic_salary_payable, 







sum(t.special_allowance/5) special_allowance,







sum(t.ta_da_data/5) ta_da_data,







sum(t.ta_da/5) ta_da,







sum(t.house_rent/5) house_rent,







sum(t.vehicle_allowance/5) vehicle_allowance,







sum(t.food_allowance/5) food_allowance,







sum(t.mobile_allowance/5) mobile_allowance,







sum(t.benefits/5) benefits,







sum(t.other_benefits/5) other_benefits,







sum(t.income_tax/5) income_tax,







sum((t.advance_install+ t.other_install)/5) total_install,







sum(t.cooperative_share/5) cooperative_share,







sum(t.motorcycle_install/5) motorcycle_install,







sum(t.deduction/5) deduction,















sum(t.absent_deduction/5) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.PBI_ID="3364"';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_14_actual_basic_salary = $total_14_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_14_actual_special_allawance = $total_14_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_14_ta_da_data = $total_14_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_14_basic_salary_payable = $total_14_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_14_spl_alw_data = $total_14_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_14_ta_da = $total_14_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_14_house_rent = $total_14_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_14_vehicle_allowance = $total_14_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_14_food_allowance = $total_14_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_14_mobile_allowance = $total_14_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_14_benefits = $total_14_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_14_other_benefits = $total_14_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_14_income_tax = $total_14_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_14_advance_install = $total_14_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_14_cooperative_share = $total_14_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_14_motorcycle_install = $total_14_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_14_deduction = $total_14_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)/5', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_14_help_up_paid = $total_14_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)/5', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_14_cash_payment = $total_14_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)/5', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_14_bank_payment_dbbl = $total_14_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)/5', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_14_bank_payment_ibbl = $total_14_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)/5', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_region =0 and a.PBI_GROUP="" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_14_net_payable = $total_14_net_payable + $net_payable; ?>
                  <?







                  }















                  ////A







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_A_actual_basic_salary = $total_A_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_A_actual_special_allawance = $total_A_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_A_ta_da_data = $total_A_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_A_basic_salary_payable = $total_A_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_A_spl_alw_data = $total_A_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_A_ta_da = $total_A_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_A_house_rent = $total_A_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_A_vehicle_allowance = $total_A_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_A_food_allowance = $total_A_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_A_mobile_allowance = $total_A_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_A_benefits = $total_A_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_A_other_benefits = $total_A_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_A_income_tax = $total_A_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_A_advance_install = $total_A_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_A_cooperative_share = $total_A_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_A_motorcycle_install = $total_A_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_A_deduction = $total_A_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_A_help_up_paid = $total_A_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_A_cash_payment = $total_A_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_A_bank_payment_dbbl = $total_A_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_A_bank_payment_ibbl = $total_A_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="A" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_A_net_payable = $total_A_net_payable + $net_payable; ?>
                  <?







                  }















                  //B















                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_B_actual_basic_salary = $total_B_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_B_actual_special_allawance = $total_B_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_B_ta_da_data = $total_B_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_B_basic_salary_payable = $total_B_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_B_spl_alw_data = $total_B_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_B_ta_da = $total_B_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_B_house_rent = $total_B_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_B_vehicle_allowance = $total_B_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_B_food_allowance = $total_B_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_B_mobile_allowance = $total_B_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_B_benefits = $total_B_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_B_other_benefits = $total_B_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_B_income_tax = $total_B_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_B_advance_install = $total_B_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_B_cooperative_share = $total_B_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_B_motorcycle_install = $total_B_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_B_deduction = $total_B_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_B_help_up_paid = $total_B_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_B_cash_payment = $total_B_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_B_bank_payment_dbbl = $total_B_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_B_bank_payment_ibbl = $total_B_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="B" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_B_net_payable = $total_B_net_payable + $net_payable; ?>
                  <?







                  }















                  //C















                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_C_actual_basic_salary = $total_C_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_C_actual_special_allawance = $total_C_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_C_ta_da_data = $total_C_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_C_basic_salary_payable = $total_C_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_C_spl_alw_data = $total_C_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_C_ta_da = $total_C_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_C_house_rent = $total_C_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_C_vehicle_allowance = $total_C_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_C_food_allowance = $total_C_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_C_mobile_allowance = $total_C_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_C_benefits = $total_C_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_C_other_benefits = $total_C_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_C_income_tax = $total_C_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_C_advance_install = $total_C_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_C_cooperative_share = $total_C_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_C_motorcycle_install = $total_C_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_C_deduction = $total_C_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_C_help_up_paid = $total_C_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_C_cash_payment = $total_C_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_C_bank_payment_dbbl = $total_C_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_C_bank_payment_ibbl = $total_C_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="C" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_C_net_payable = $total_C_net_payable + $net_payable; ?>
                  <?







                  }















                  //D















                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_D_actual_basic_salary = $total_D_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_D_actual_special_allawance = $total_D_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_D_ta_da_data = $total_D_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_D_basic_salary_payable = $total_D_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_D_spl_alw_data = $total_D_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_D_ta_da = $total_D_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_D_house_rent = $total_D_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_D_vehicle_allowance = $total_D_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_D_food_allowance = $total_D_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_D_mobile_allowance = $total_D_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_D_benefits = $total_D_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_D_other_benefits = $total_D_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_D_income_tax = $total_D_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_D_advance_install = $total_D_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_D_cooperative_share = $total_D_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_D_motorcycle_install = $total_D_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_D_deduction = $total_D_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_D_help_up_paid = $total_D_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_D_cash_payment = $total_D_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_D_bank_payment_dbbl = $total_D_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_D_bank_payment_ibbl = $total_D_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="D" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_D_net_payable = $total_D_net_payable + $net_payable; ?>
                  <?







                  }















                  // E







                  $sqld = 'select t.pbi_region PBI_BRANCH,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  ';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <? $data->actual_basic_salary ?>
                    <? $total_E_actual_basic_salary = $total_E_actual_basic_salary + $data->actual_basic_salary; ?>
                    <? (int)$data->actual_special_allawance ?>
                    <? $total_E_actual_special_allawance = $total_E_actual_special_allawance + $data->actual_special_allawance; ?>
                    <? $data->ta_da_data ?>
                    <? $total_E_ta_da_data = $total_E_ta_da_data + $data->ta_da_data; ?>
                    <? (int)$data->basic_salary_payable ?>
                    <? $total_E_basic_salary_payable = $total_E_basic_salary_payable + $data->basic_salary_payable; ?>
                    <? (int)$data->special_allowance ?>
                    <? $total_E_spl_alw_data = $total_E_spl_alw_data + $data->special_allowance; ?>
                    <? $data->ta_da ?>
                    <? $total_E_ta_da = $total_E_ta_da + $data->ta_da; ?>
                    <? $data->house_rent ?>
                    <? $total_E_house_rent = $total_E_house_rent + $data->house_rent; ?>
                    <? $data->vehicle_allowance ?>
                    <? $total_E_vehicle_allowance = $total_E_vehicle_allowance + $data->vehicle_allowance; ?>
                    <? $data->food_allowance ?>
                    <? $total_E_food_allowance = $total_E_food_allowance + $data->food_allowance; ?>
                    <? $data->mobile_allowance ?>
                    <? $total_E_mobile_allowance = $total_E_mobile_allowance + $data->mobile_allowance; ?>
                    <? $data->benefits ?>
                    <? $total_E_benefits = $total_E_benefits + $data->benefits; ?>
                    <? $data->other_benefits ?>
                    <? $total_E_other_benefits = $total_E_other_benefits + $data->other_benefits; ?>
                    <? $data->income_tax ?>
                    <? $total_E_income_tax = $total_E_income_tax + $data->income_tax; ?>
                    <? $total_install ?>
                    <? $total_E_advance_install = $total_E_advance_install + $data->total_install; ?>
                    <? $data->cooperative_share ?>
                    <? $total_E_cooperative_share = $total_E_cooperative_share + $data->cooperative_share; ?>
                    <? $data->motorcycle_install ?>
                    <? $total_E_motorcycle_install = $total_E_motorcycle_install + $data->motorcycle_install; ?>
                    <? $data->deduction ?>
                    <? $total_E_deduction = $total_E_deduction + $data->deduction; ?>
                    <? $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_E_help_up_paid = $total_E_help_up_paid + $help_up_paid; ?>
                    <? $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_E_cash_payment = $total_E_cash_payment + $cash_paid; ?>
                    <? $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_E_bank_payment_dbbl = $total_E_bank_payment_dbbl + $dbbl_paid; ?>
                    <? $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID t.PBI_ID=s.PBI_ID and and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_E_bank_payment_ibbl = $total_E_bank_payment_ibbl + $ibbl_paid; ?>
                    <?php $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="1" and t.pbi_Group="E" and t.pbi_department="Sales"  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                    $total_E_net_payable = $total_E_net_payable + $net_payable; ?>
                  <?







                  }















                  ?>
                  <tr>
                    <td>1</td>
                    <td>Group-A</td>
                    <td><strong>
                        <?= $total_14_actual_basic_salary + $total_A_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_actual_special_allawance + $total_A_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_ta_da_data + $total_A_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)($total_14_basic_salary_payable + $total_A_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_spl_alw_data + $total_A_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da + $total_A_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_house_rent + $total_A_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_vehicle_allowance + $total_A_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_food_allowance + $total_A_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_mobile_allowance + $total_A_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_benefits + $total_A_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_other_benefits + $total_A_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_income_tax + $total_A_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_advance_install + $total_A_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_cooperative_share + $total_A_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_motorcycle_install + $total_A_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_deduction + $total_A_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= ($total_14_help_up_paid + $total_A_help_up_paid) ?></td>
                    <td><strong>
                        <?= ($total_14_cash_payment + $total_A_cash_payment) ?>
                      </strong></td>
                    <td><?= ($total_14_bank_payment_dbbl + $total_A_bank_payment_dbbl) ?></td>
                    <td><?= ($total_14_bank_payment_ibbl + $total_A_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= ($total_14_net_payable + $total_A_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Group-B</td>
                    <td><strong>
                        <?= $total_14_actual_basic_salary + $total_B_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_actual_special_allawance + $total_B_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_ta_da_data + $total_B_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)($total_14_basic_salary_payable + $total_B_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_spl_alw_data + $total_B_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da + $total_B_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_house_rent + $total_B_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_vehicle_allowance + $total_B_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_food_allowance + $total_B_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_mobile_allowance + $total_B_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_benefits + $total_B_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_other_benefits + $total_B_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_income_tax + $total_B_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_advance_install + $total_B_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_cooperative_share + $total_B_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_motorcycle_install + $total_B_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_deduction + $total_B_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= ($total_14_help_up_paid + $total_B_help_up_paid) ?></td>
                    <td><strong>
                        <?= ($total_14_cash_payment + $total_B_cash_payment) ?>
                      </strong></td>
                    <td><?= ($total_14_bank_payment_dbbl + $total_B_bank_payment_dbbl) ?></td>
                    <td><?= ($total_14_bank_payment_ibbl + $total_B_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= ($total_14_net_payable + $total_B_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Group-C</td>
                    <td><strong>
                        <?= $total_14_actual_basic_salary + $total_C_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_actual_special_allawance + $total_C_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_ta_da_data + $total_C_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)($total_14_basic_salary_payable + $total_C_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_spl_alw_data + $total_C_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da + $total_C_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_house_rent + $total_C_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_vehicle_allowance + $total_C_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_food_allowance + $total_C_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_mobile_allowance + $total_C_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_benefits + $total_C_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_other_benefits + $total_C_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_income_tax + $total_C_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_advance_install + $total_C_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_cooperative_share + $total_C_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_motorcycle_install + $total_C_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_deduction + $total_C_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= ($total_14_help_up_paid + $total_C_help_up_paid) ?></td>
                    <td><strong>
                        <?= ($total_14_cash_payment + $total_C_cash_payment) ?>
                      </strong></td>
                    <td><?= ($total_14_bank_payment_dbbl + $total_C_bank_payment_dbbl) ?></td>
                    <td><?= ($total_14_bank_payment_ibbl + $total_C_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= ($total_14_net_payable + $total_C_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Group-D</td>
                    <td><strong>
                        <?= $total_14_actual_basic_salary + $total_D_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_actual_special_allawance + $total_D_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_ta_da_data + $total_D_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)($total_14_basic_salary_payable + $total_D_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_spl_alw_data + $total_D_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da + $total_D_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_house_rent + $total_D_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_vehicle_allowance + $total_D_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_food_allowance + $total_D_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_mobile_allowance + $total_D_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_benefits + $total_D_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_other_benefits + $total_D_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_income_tax + $total_D_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_advance_install + $total_D_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_cooperative_share + $total_D_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_motorcycle_install + $total_D_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_deduction + $total_D_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= ($total_14_help_up_paid + $total_D_help_up_paid) ?></td>
                    <td><strong>
                        <?= ($total_14_cash_payment + $total_D_cash_payment) ?>
                      </strong></td>
                    <td><?= ($total_14_bank_payment_dbbl + $total_D_bank_payment_dbbl) ?></td>
                    <td><?= ($total_14_bank_payment_ibbl + $total_D_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= ($total_14_net_payable + $total_D_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Group-E</td>
                    <td><strong>
                        <?= $total_14_actual_basic_salary + $total_E_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_actual_special_allawance + $total_E_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_14_ta_da_data + $total_E_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)($total_14_basic_salary_payable + $total_E_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_spl_alw_data + $total_E_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da + $total_E_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_house_rent + $total_E_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_vehicle_allowance + $total_E_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_food_allowance + $total_E_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_mobile_allowance + $total_E_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_benefits + $total_E_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_other_benefits + $total_E_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_income_tax + $total_E_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_advance_install + $total_E_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_cooperative_share + $total_E_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_motorcycle_install + $total_E_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_deduction + $total_E_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= ($total_14_help_up_paid + $total_E_help_up_paid) ?></td>
                    <td><strong>
                        <?= ($total_14_cash_payment + $total_E_cash_payment) ?>
                      </strong></td>
                    <td><?= ($total_14_bank_payment_dbbl + $total_E_bank_payment_dbbl) ?></td>
                    <td><?= ($total_14_bank_payment_ibbl + $total_E_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= ($total_14_net_payable + $total_E_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= ($total_14_actual_basic_salary * 5) + $total_A_actual_basic_salary + $total_B_actual_basic_salary + $total_C_actual_basic_salary + $total_D_actual_basic_salary + $total_E_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_actual_special_allawance * 5) + $total_A_actual_special_allawance + $total_B_actual_special_allawance + $total_C_actual_special_allawance + $total_D_actual_special_allawance + $total_E_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= ($total_14_ta_da_data * 5) + $total_A_ta_da_data + $total_B_ta_da_data + $total_C_ta_da_data + $total_D_ta_da_data + $total_E_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= ((int)($total_14_basic_salary_payable * 5) + $total_A_basic_salary_payable + $total_B_basic_salary_payable + $total_C_basic_salary_payable + $total_D_basic_salary_payable + $total_E_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_spl_alw_data * 5) + $total_A_spl_alw_data + $total_B_spl_alw_data + $total_C_spl_alw_data + $total_D_spl_alw_data + $total_E_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_ta_da * 5) + $total_A_ta_da + $total_B_ta_da + $total_C_ta_da + $total_D_ta_da + $total_E_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_house_rent * 5) + $total_A_house_rent + $total_B_house_rent + $total_C_house_rent + $total_D_house_rent + $total_E_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_vehicle_allowance * 5) + $total_A_vehicle_allowance + $total_B_vehicle_allowance + $total_C_vehicle_allowance + $total_D_vehicle_allowance + $total_E_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_food_allowance * 5) + $total_A_food_allowance + $total_B_food_allowance + $total_C_food_allowance + $total_D_food_allowance + $total_E_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_mobile_allowance * 5) + $total_A_mobile_allowance + $total_B_mobile_allowance + $total_C_mobile_allowance + $total_D_mobile_allowance + $total_E_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_benefits * 5) + $total_A_benefits + $total_B_benefits + $total_C_benefits + $total_D_benefits + $total_E_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_other_benefits * 5) + $total_A_other_benefits + $total_B_other_benefits + $total_C_other_benefits + $total_D_other_benefits + $total_E_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_income_tax * 5) + $total_A_income_tax + $total_B_income_tax + $total_C_income_tax + $total_D_income_tax + $total_E_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_advance_install * 5) + $total_A_advance_install + $total_B_advance_install + $total_C_advance_install + $total_D_advance_install + $total_E_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_cooperative_share * 5) + $total_A_cooperative_share + $total_B_cooperative_share + $total_C_cooperative_share + $total_D_cooperative_share + $total_E_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_motorcycle_install * 5) + $total_A_motorcycle_install + $total_B_motorcycle_install + $total_C_motorcycle_install + $total_D_motorcycle_install + $total_E_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= (($total_14_deduction * 5) + $total_A_deduction + $total_B_deduction + $total_C_deduction + $total_D_deduction + $total_E_deduction); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= (($total_14_help_up_paid * 5) + $total_A_help_up_paid + $total_B_help_up_paid + $total_C_help_up_paid + $total_D_help_up_paid + $total_E_help_up_paid) ?></td>
                    <td><strong>
                        <?= (($total_14_cash_payment * 5) + $total_A_cash_payment + $total_B_cash_payment + $total_C_cash_payment + $total_D_cash_payment + $total_E_cash_payment) ?>
                      </strong></td>
                    <td><?= (($total_14_bank_payment_dbbl * 5) + $total_A_bank_payment_dbbl + $total_B_bank_payment_dbbl + $total_C_bank_payment_dbbl + $total_D_bank_payment_dbbl + $total_E_bank_payment_dbbl) ?></td>
                    <td><?= (($total_14_bank_payment_ibbl * 5) + $total_A_bank_payment_ibbl + $total_B_bank_payment_ibbl + $total_C_bank_payment_ibbl + $total_D_bank_payment_ibbl + $total_E_bank_payment_ibbl) ?></td>
                    <td><strong>
                        <?= (($total_14_net_payable * 5) + $total_A_net_payable + $total_B_net_payable + $total_C_net_payable + $total_D_net_payable + $total_E_net_payable) ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }























          if ($_POST['report'] == 7801) { // Region Wise Sales Salary Brief Report(Without HO)















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="32"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L-</th>
                    <th rowspan="3">Region Name</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="6">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th colspan="4">
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="3">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/diff.JPG" /></th>
                    <th rowspan="2"><img src="images/late_attendence.JPG" /></th>
                    <th rowspan="2"><img src="images/absent_lwp.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>Rocket</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select t.pbi_region PBI_BRANCH,count(1) nos,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.administrative_deduction) administrative_deduction,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.spl_alw_data) actual_special_allawance,















sum(t.absent_deduction) absent_deduction,







t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region>0 and t.pbi_department="Sales" ' . $PBI_GROUP_con . ' group by t.pbi_region';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('branch', 'BRANCH_NAME', 'BRANCH_ID=' . $data->PBI_BRANCH) ?></td>
                      <td><?= $data->nos ?>
                        <? $total_nos = $total_nos + $data->nos; ?></td>
                      <td><?= round($data->actual_basic_salary) ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= round($data->actual_special_allawance) ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= round($data->ta_da_data) ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= round($data->basic_salary_payable) ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= $data->special_allowance; ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= round($data->ta_da) ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent) ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= round($data->food_allowance) ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= round($data->mobile_allowance) ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= round($data->benefits) ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= round($data->other_benefits) ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= round($data->income_tax) ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= round($data->total_install) ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= round($data->cooperative_share) ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= round($data->motorcycle_install) ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= round($data->deduction) ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= round($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = round(find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up="1" and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = round(find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up="0" and t.PBI_ID=a.PBI_ID  and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = round(find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up="0" and t.bank_name="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $rocket_paid = round(find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up="0" and t.bank_name="ROCKET" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                          $total_bank_payment_rocket = $total_bank_payment_rocket + $rocket_paid; ?></td>
                      <td><? echo $ibbl_paid = round(find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up="0" and t.bank_name="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = round(find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up="0" and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.pbi_region="' . $data->PBI_BRANCH . '" ' . $PBI_GROUP_con));
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">Grand Total: </td>
                    <td><strong>
                        <?= round($total_nos); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_actual_basic_salary); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_actual_special_allawance); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_ta_da_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_basic_salary_payable); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_spl_alw_data); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_ta_da); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_food_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_mobile_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_other_benefits); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_income_tax); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_advance_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_cooperative_share); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_motorcycle_install); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_deduction); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_administrative_deduction); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_help_up_paid); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_cash_payment); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_bank_payment_dbbl); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_bank_payment_rocket); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_bank_payment_ibbl); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_net_payable); ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }















          if ($_POST['report'] == 7800) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="28"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Store Name</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select count(1) nos,a.JOB_LOCATION,o.LOCATION_NAME,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction, 















sum(t.absent_deduction) absent_deduction,t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s,office_location o where o.ID=a.JOB_LOCATION and d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and a.PBI_DEPARTMENT like "%STO%" 







AND a.PBI_ORG=' . $_POST['PBI_ORG'] . '







' . $DEPARTMENT_con . ' group by a.JOB_LOCATION';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= $data->LOCATION_NAME ?></td>
                      <td><?= $data->nos ?>
                        <? $total_nos = $total_nos + $data->nos ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent); ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= $data->vehicle_allowance ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and a.JOB_LOCATION="' . $data->JOB_LOCATION . '" ' . $DEPARTMENT_con);
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and a.JOB_LOCATION="' . $data->JOB_LOCATION . '" ' . $DEPARTMENT_con);
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and a.JOB_LOCATION="' . $data->JOB_LOCATION . '" ' . $DEPARTMENT_con);
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and a.JOB_LOCATION="' . $data->JOB_LOCATION . '" ' . $DEPARTMENT_con);
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and a.JOB_LOCATION="' . $data->JOB_LOCATION . '" ' . $DEPARTMENT_con);
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_vehicle_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_administrative_deduction; ?>
                      </strong></td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }







          if ($_POST['report'] == 784) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="28"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Department</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select a.PBI_DEPARTMENT,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,















sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank, count(1) nos















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID  and PBI_ORG in (1,2) and t.pbi_region =0 group by a.PBI_DEPARTMENT';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('department', 'DEPT_DESC', 'DEPT_SHORT_NAME="' . $data->PBI_DEPARTMENT . '"') ?></td>
                      <td><?= $data->nos ?>
                        <? $total_nos = $total_nos + $data->nos ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= $data->house_rent ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '"  and PBI_ORG in (1,2) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }































          if ($_POST['report'] == 7840) {







            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="30"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L-7840</th>
                    <th rowspan="3">Department</th>
                    <th rowspan="3">Section</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="6">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="3">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>Prime</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select a.PBI_DEPARTMENT,a.PBI_DOMAIN,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction,















sum(t.absent_deduction) absent_deduction,







t.pbi_held_up held_up_status,s.cash_bank, count(1) nos















from  salary_attendence t, personnel_basic_info a, salary_info s 







where t.pbi_job_location !=1 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' 







and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID  and PBI_ORG="' . $_POST['PBI_ORG'] . '" 







group by t.pbi_department,a.PBI_DOMAIN';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;







                    $department = find_a_field('department', 'DEPT_DESC', 'DEPT_SHORT_NAME="' . $data->PBI_DEPARTMENT . '"');







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= ($P_DEPA == $data->PBI_DEPARTMENT) ? '' : $department; ?></td>
                      <td><?= $data->PBI_DOMAIN ?></td>
                      <td><?= $data->nos ?>
                        <? $total_nos = $total_nos + $data->nos ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= $data->house_rent ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and t.pbi_region =0 and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '"  







  and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" 







  and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $prime_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 







and s.cash_bank="Prime" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" 







and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');







                          $total_bank_payment_prime = $total_bank_payment_prime + $prime_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" 







  and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and a.PBI_DEPARTMENT="' . $data->PBI_DEPARTMENT . '" 







  and PBI_ORG in ("' . $_POST['PBI_ORG'] . '") and a.PBI_DOMAIN = "' . $data->PBI_DOMAIN . '" and t.pbi_job_location !=1 and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                    $P_DEPA = $data->PBI_DEPARTMENT;
                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong>
                        <?= $total_nos; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_administrative_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_help_up_paid ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_bank_payment_dbbl ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_bank_payment_prime ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_bank_payment_ibbl ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          } elseif ($_POST['report'] == 7841) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="28"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Department</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select a.pbi_department PBI_DEPARTMENT,







count(1) nos,







sum(s.basic_salary) actual_basic_salary,







sum(t.spl_alw_data) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction,







sum(t.absent_deduction) absent_deduction,







t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s 







where 







d.DESG_ID=a.DESG_ID and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' 







and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and PBI_ORG in (1,2) 























group by a.pbi_department';















                  //and t.pbi_department not in ("STO", "Store (Transport)","Admin (Support Service Section)","CR")







                  //and t.pbi_region =0 







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;















                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('department', 'DEPT_DESC', 'DEPT_SHORT_NAME="' . $data->PBI_DEPARTMENT . '"') ?></td>
                      <td><?= (int)$data->nos ?>
                        <? $total_nos = $total_nos + $data->nos; ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent) ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_department not in ("STO", "Store (Transport)") and t.pbi_department !="Admin (Support Service Section)" and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '"  and PBI_ORG in (1,2) and t.pbi_department not in ("STO", "Store (Transport)") and t.pbi_department !="Admin (Support Service Section)" and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_department not in ("STO", "Store (Transport)") and t.pbi_department !="Admin (Support Service Section)" and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_department not in ("STO", "Store (Transport)") and t.pbi_department !="Admin (Support Service Section)" and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and PBI_ORG in (1,2) and t.pbi_department not in ("STO", "Store (Transport)") and t.pbi_department !="Admin (Support Service Section)" and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_administrative_deduction); ?>
                      </strong></td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }







          if ($_POST['report'] == 78411) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="30"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Department</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="7">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="4">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>EBL</th>
                    <th>NCC</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  if ($_POST['PBI_ORG'] > 0) $org_con = ' and PBI_ORG ="' . $_POST['PBI_ORG'] . '" ';







                  if ($_POST['JOB_LOCATION'] != '') {
                    $location_con = ' and t.pbi_job_location = "' . $_POST['JOB_LOCATION'] . '"';
                  }















                  $sqld = 'select a.pbi_department PBI_DEPARTMENT, a.JOB_LOCATION as job_location,







count(1) nos,







sum(t.basic_salary) actual_basic_salary,







sum(t.spl_alw_data) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction,







sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=a.DESG_ID 







and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID 







' . $org_con . $location_con . ' group by t.pbi_department';















                  //and t.pbi_region =0 















                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;















                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('department', 'DEPT_DESC', 'DEPT_SHORT_NAME="' . $data->PBI_DEPARTMENT . '"') ?></td>
                      <td><?= (int)$data->nos ?>
                        <? $total_nos = $total_nos + $data->nos; ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent); ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID 







  and t.pbi_department="' . $data->PBI_DEPARTMENT . '" ' . $org_con . ' 







  and t.pbi_job_location="' . $data->job_location . '"







  and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?> </td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '"  ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ebl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="EBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ebl = $total_bank_payment_ebl + $ebl_paid; ?></td>
                      <td><? echo $ncc_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="NCC" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ncc = $total_bank_payment_ncc + $ncc_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_department="' . $data->PBI_DEPARTMENT . '" and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_administrative_deduction); ?>
                      </strong></td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ebl ?></td>
                    <td><?= $total_bank_payment_ncc ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }































          if ($_POST['report'] == 78412) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="30"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Location</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="7">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="4">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>EBL</th>
                    <th>NCC</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  if ($_POST['PBI_ORG'] > 0) $org_con = ' and PBI_ORG ="' . $_POST['PBI_ORG'] . '" ';







                  $sqld = 'select t.pbi_job_location job_location ,







count(1) nos,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction,







sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and t.pbi_region =0 ' . $org_con . ' group by t.pbi_job_location';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;















                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= find_a_field('office_location', 'LOCATION_NAME', 'ID="' . $data->job_location . '"') ?></td>
                      <td><?= (int)$data->nos ?>
                        <? $total_nos = $total_nos + $data->nos; ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= $data->house_rent ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= round($data->vehicle_allowance) ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '"  ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ebl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="EBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ebl = $total_bank_payment_ebl + $ebl_paid; ?></td>
                      <td><? echo $ncc_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="NCC" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ncc = $total_bank_payment_ncc + $ncc_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and t.pbi_job_location="' . $data->job_location . '" ' . $org_con . ' and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_house_rent; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_vehicle_allowance); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_administrative_deduction); ?>
                      </strong></td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ebl ?></td>
                    <td><?= $total_bank_payment_ncc ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }







          if ($_POST['report'] == 7842) {















            ?>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="29"><?= $str ?></th>
                  </tr>
                  <tr>
                    <th rowspan="3">S/L</th>
                    <th rowspan="3">Department</th>
                    <th rowspan="3">Location</th>
                    <th rowspan="3">Nos</th>
                    <th colspan="3">Basic Information </th>
                    <th colspan="9">
                      <div>Salary and Allowance (At Actual) Taka </div>
                    </th>
                    <th colspan="6">
                      <div>Deduction</div>
                    </th>
                    <th colspan="5">
                      <div>Payable Amount (Taka) </div>
                    </th>
                    <th>
                      <div>View Only </div>
                    </th>
                    <th rowspan="3">Remarks</th>
                  </tr>
                  <tr class="vertical-text">
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/salary.jpg" /></th>
                    <th rowspan="2"><img src="images/special_allowance.JPG" /></th>
                    <th rowspan="2"><img src="images/ta_da.JPG" /></th>
                    <th rowspan="2"><img src="images/house_rent.JPG" /></th>
                    <th rowspan="2"><img src="images/car.JPG" /></th>
                    <th rowspan="2"><img src="images/food.JPG" /></th>
                    <th rowspan="2"><img src="images/mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/arear.JPG" /></th>
                    <th rowspan="2"><img src="images/other.JPG" /></th>
                    <th rowspan="2"><img src="images/ait.JPG" /></th>
                    <th rowspan="2"><img src="images/advance_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/co-op-fund.JPG" /></th>
                    <th rowspan="2"><img src="images/bike.JPG" /></th>
                    <th rowspan="2"><img src="images/excess_mobile.JPG" /></th>
                    <th rowspan="2"><img src="images/administrative.JPG" /></th>
                    <th rowspan="2">H-Up</th>
                    <th rowspan="2"><img src="images/cash.JPG" /></th>
                    <th colspan="2">BANK</th>
                    <th rowspan="2"><img src="images/total_salary.JPG" /></th>
                    <th rowspan="2"><img src="images/last_salary.JPG" /></th>
                  </tr>
                  <tr class="vertical-text">
                    <th>DBBL</th>
                    <th>IBBL</th>
                  </tr>
                </thead>
                <tbody>
                  <?







                  $sqld = 'select t.pbi_department,t.pbi_job_location,







count(1) nos,







sum(s.basic_salary) actual_basic_salary,







sum(s.special_allowance) actual_special_allawance, 







sum(t.basic_salary_payable) basic_salary_payable, 







sum(t.special_allowance) special_allowance,







sum(t.ta_da_data) ta_da_data,







sum(t.ta_da) ta_da,







sum(t.house_rent) house_rent,







sum(t.vehicle_allowance) vehicle_allowance,







sum(t.food_allowance) food_allowance,







sum(t.mobile_allowance) mobile_allowance,







sum(t.benefits) benefits,







sum(t.other_benefits) other_benefits,







sum(t.income_tax) income_tax,







sum((t.advance_install+ t.other_install)) total_install,







sum(t.cooperative_share) cooperative_share,







sum(t.motorcycle_install) motorcycle_install,







sum(t.deduction) deduction,







sum(t.administrative_deduction) administrative_deduction,







sum(t.absent_deduction) absent_deduction,







 t.pbi_held_up held_up_status,s.cash_bank















from  salary_attendence t, personnel_basic_info a, designation d, salary_info s where d.DESG_ID=t.pbi_designation and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' and t.PBI_ID=a.PBI_ID and t.PBI_ID=s.PBI_ID and pbi_organization in (1,2,12) and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) )   group by t.pbi_job_location';







                  $queryd = mysql_query($sqld);















                  while ($data = mysql_fetch_object($queryd)) {







                    $entry_by = $data->entry_by;















                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td>Admin (Support Service Section)</td>
                      <td><?= find_a_field('office_location', 'LOCATION_NAME', 'id="' . $data->pbi_job_location . '"') ?></td>
                      <td><?= (int)$data->nos ?>
                        <? $total_nos = $total_nos + $data->nos; ?></td>
                      <td><?= (int)$data->actual_basic_salary ?>
                        <? $total_actual_basic_salary = $total_actual_basic_salary + $data->actual_basic_salary; ?></td>
                      <td><?= (int)$data->actual_special_allawance ?>
                        <? $total_actual_special_allawance = $total_actual_special_allawance + $data->actual_special_allawance; ?></td>
                      <td><?= $data->ta_da_data ?>
                        <? $total_ta_da_data = $total_ta_da_data + $data->ta_da_data; ?></td>
                      <td><?= (int)$data->basic_salary_payable ?>
                        <? $total_basic_salary_payable = $total_basic_salary_payable + $data->basic_salary_payable; ?></td>
                      <td><?= (int)$data->special_allowance ?>
                        <? $total_spl_alw_data = $total_spl_alw_data + $data->special_allowance; ?></td>
                      <td><?= $data->ta_da ?>
                        <? $total_ta_da = $total_ta_da + $data->ta_da; ?></td>
                      <td><?= round($data->house_rent) ?>
                        <? $total_house_rent = $total_house_rent + $data->house_rent; ?></td>
                      <td><?= $data->vehicle_allowance ?>
                        <? $total_vehicle_allowance = $total_vehicle_allowance + $data->vehicle_allowance; ?></td>
                      <td><?= $data->food_allowance ?>
                        <? $total_food_allowance = $total_food_allowance + $data->food_allowance; ?></td>
                      <td><?= $data->mobile_allowance ?>
                        <? $total_mobile_allowance = $total_mobile_allowance + $data->mobile_allowance; ?></td>
                      <td><?= $data->benefits ?>
                        <? $total_benefits = $total_benefits + $data->benefits; ?></td>
                      <td><?= $data->other_benefits ?>
                        <? $total_other_benefits = $total_other_benefits + $data->other_benefits; ?></td>
                      <td><?= $data->income_tax ?>
                        <? $total_income_tax = $total_income_tax + $data->income_tax; ?></td>
                      <td><?= $data->total_install ?>
                        <? $total_advance_install = $total_advance_install + $data->total_install; ?></td>
                      <td><?= $data->cooperative_share ?>
                        <? $total_cooperative_share = $total_cooperative_share + $data->cooperative_share; ?></td>
                      <td><?= $data->motorcycle_install ?>
                        <? $total_motorcycle_install = $total_motorcycle_install + $data->motorcycle_install; ?></td>
                      <td><?= $data->deduction ?>
                        <? $total_deduction = $total_deduction + $data->deduction; ?></td>
                      <td><?= number_format($data->administrative_deduction) ?>
                        <? $total_administrative_deduction = $total_administrative_deduction + $data->administrative_deduction; ?></td>
                      <td><? echo $help_up_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=1 and t.PBI_ID=a.PBI_ID and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) )  and t.pbi_job_location ="' . $data->pbi_job_location . '" and pbi_organization in (1,2,12) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_help_up_paid = $total_help_up_paid + $help_up_paid; ?></td>
                      <td><? echo $cash_paid = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(t.total_payable-t.bank_paid)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) )   and t.pbi_job_location ="' . $data->pbi_job_location . '"  and pbi_organization in (1,2,12) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . '');
                          $total_cash_payment = $total_cash_payment + $cash_paid; ?></td>
                      <td><? echo $dbbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="DBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID  and t.pbi_job_location ="' . $data->pbi_job_location . '" and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) )  and pbi_organization in (1,2,12) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_dbbl = $total_bank_payment_dbbl + $dbbl_paid; ?></td>
                      <td><? echo $ibbl_paid = find_a_field('salary_attendence t,personnel_basic_info a,salary_info s ', 'sum(t.bank_paid)', 't.pbi_held_up=0 and s.cash_bank="IBBL" and t.PBI_ID=a.PBI_ID and s.PBI_ID=a.PBI_ID  and t.pbi_job_location ="' . $data->pbi_job_location . '" and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) ) and pbi_organization in (1,2,12) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                          $total_bank_payment_ibbl = $total_bank_payment_ibbl + $ibbl_paid; ?></td>
                      <td><span style="text-align:right; font-weight:bold;"><?php echo $net_payable = find_a_field('salary_attendence t,personnel_basic_info a ', 'sum(total_payable)', 't.pbi_held_up=0 and t.PBI_ID=a.PBI_ID  and t.pbi_job_location ="' . $data->pbi_job_location . '" and ( t.pbi_department  = "Admin (Support Service Section)" or( t.pbi_department  = "ADM" and  t.pbi_job_location in (24,22,68)) )  and pbi_organization in (1,2,12) and t.pbi_region =0 and t.mon=' . $_POST['mon'] . ' and t.year=' . $_POST['year'] . ' ');
                                                                            $total_net_payable = $total_net_payable + $net_payable; ?></span></td>
                      <td>&nbsp;</td>
                      <td style="color:#FF0000; font-weight:bold">&nbsp;</td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td><strong>
                        <?= $total_nos ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_basic_salary; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_actual_special_allawance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= (int)$total_basic_salary_payable; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_spl_alw_data; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_ta_da; ?>
                      </strong></td>
                    <td><strong>
                        <?= round($total_house_rent); ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_vehicle_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_food_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_mobile_allowance; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_other_benefits; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_income_tax; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_advance_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_cooperative_share; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_motorcycle_install; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_deduction; ?>
                      </strong></td>
                    <td><strong>
                        <?= $total_administrative_deduction; ?>
                      </strong></td>
                    <td><?= $total_help_up_paid ?></td>
                    <td><strong>
                        <?= $total_cash_payment ?>
                      </strong></td>
                    <td><?= $total_bank_payment_dbbl ?></td>
                    <td><?= $total_bank_payment_ibbl ?></td>
                    <td><strong>
                        <?= $total_net_payable ?>
                      </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
              In words:
              <?= convertNumberMhafuz($total_net_payable); ?>
              <style type="text/css">
                #new td {







                  border-bottom: 0px solid #000000;







                  border-left: 0px solid #000000;







                  border-right: 0px solid #000000;







                  text-align: center;







                  padding: 2px 10px;







                }
              </style>
              <br />
            <?







          }







          /*elseif($_POST['report']==79){ // salary payslip view















if($_POST['branch']!='') $con.=' and a.PBI_BRANCH ="'.$_POST['branch'].'"';















echo $sql22="SELECT a.*,b.*







FROM personnel_basic_info a, salary_attendence b







WHERE a.PBI_ID = b.PBI_ID















and b.mon='".$mon."' and b.year='".$year."' ".$con." 







order by b.total_payable desc";















$res = mysql_query($sql22);







	$ig=-1; while($data=mysql_fetch_object($res)){







?>







<div <? if(($ig%4)==0&&($ig>2)) echo 'style="position:relative;display:block; width:100%; float: none; page-break-after:always; page-break-inside:avoid"'; ?>>







<? $ig++;?>







<table  width="100%" cellspacing="0" cellpadding="2" border="0">







    <thead>







      <tr>







        <th width="5%">&nbsp;</th>







        <th width="30%">Employee Information</th>







        <th width="20%">Attendence Info</th>







        <th width="20%">Payable Salary</th>







        <th width="25%">Signature</th>







      </tr>







    </thead>







    <tbody>







      <tr style="height:130px;">







        <td rowspan="2" align="center">&nbsp;</td>







        <td rowspan="2" align="center">ID: <strong><?=$data->PBI_ID?></strong><br />







          Name: <strong><?=$data->PBI_NAME ?></strong><br />







          Designation: <strong><?=$data->DESG_SHORT_NAME?></strong><br />







          Department: <strong><?=$data->DEPT_DESC?></strong></td>







        <td rowspan="2" align="right">







		<?php if($data->pre>0){?>







		Present Days:<strong><?=$data->pre?></strong><br />







		   <?php }?>







		   







		   







		   <?php if($data->od>0){?>







          Off Days:<strong><?=$data->od?></strong><br />







			 <?php }?>







			 







			 <?php if($data->hd>0){?>







          Holy Days:<strong><?=$data->hd?></strong><br />







			 <?php }?>







		  







		  <?php if($data->lv>0){?>







          Leave Days:<strong><?=$data->lv?></strong><br />







			 <?php }?>







		







		 <?php if($data->lt>0){?>	







          Late Days:<strong><?=$data->lt?></strong><br />







			 <?php }?>







		







		<?php if($data->ab>0){?>







          Absent Days:<strong><?=$data->ab?></strong><br />







			 <?php }?>







		<?php if($data->td>0){?>	







          Total Days:<strong><?=$data->td?></strong><br />







			<?php }?>







			







			<?php if($data->pay>0){?>	







          Payable Days:<strong><?=$data->pay?></strong>







		  <?php }?>		  </td>







        <td align="center" style="text-align:right">







		<?php if($data->total_salary>0){?>







		Gross:<strong><?=number_format($data->total_salary,2)?></strong><br />







		  <?php }?>







		  







		  <?php if($data->total_benefits>0){?>







          Total Benf:<strong><?=number_format($data->total_benefits,2)?></strong><br />







			 <?php }?>







			







			<?php if($data->total_deduction>0){?>







          Total Ded:<strong><?=number_format($data->total_deduction,2)?></strong><br />







		    <?php }?>







			<?php if($data->bank_paid>0){?>







          Total Bank Payment:<strong><?=number_format($data->bank_paid,2)?></strong><br />







		    <?php }?>	







			







			







		  </td>







        <td rowspan="2" align="center" style="text-align:center">...........................<br />







          (<strong><?=$data->PBI_NAME ?></strong>)</td>







      </tr>







      







      <tr>







        <?php if($data->DEPT_DESC=='Sales Marketing'){?>







        <?php }?>







        <td align="center" style="text-align:right">Cash Payment:<strong><?=number_format($data->cash_paid,2); $n_p_total+=$data->total_payable;?></strong></td>







      </tr>







      <br /><br />







	  <? } ?>







  </table>







</div>







<br /><br /><br /><br />















<? }*/ elseif ($_POST['report'] == 79) {







            if ($_POST['pbi_id_in'] != '') {
              $pay_con = ' and p.PBI_CODE="' . $_POST['pbi_id_in'] . '"';
            }


            if ($_POST['mon'] != '') {
              $pay_con .= ' and s.mon="' . $_POST['mon'] . '"';
            }



            if ($_POST['year'] != '') {
              $pay_con .= ' and s.year="' . $_POST['year'] . '"';
            }


            $pay = 'select s.*,p.PBI_NAME,p.PBI_CODE,p.PBI_EMAIL,(select DESG_DESC from designation where DESG_ID=s.designation) as designation,
(select DEPT_DESC from department where DEPT_ID=s.department) as department 
from salary_attendence s,personnel_basic_info p where s.PBI_ID=p.PBI_ID ' . $pay_con . ' ';



            $qry = mysql_query($pay);
            $paySlip = mysql_fetch_object($qry);


            //while($paySlip = mysql_fetch_object($qry)){



            ?>
              <table width="600" border="0" cellpadding="0" cellspacing="0" id="ExportTable" align="center" style="font-size:16px;" class="tabledesign">
                <!--    <tr>-->
                <!--      <td style="border:0px;">&nbsp;-->
                <!--        <button type="button" id="print" onClick="hide();window.print();">Print</button></td>-->
                <!--    </tr>-->
                <tr style="line-height:0px;">
                  <td style="border:0px; font-size:15px; font-weight:bold;"><?= $_SESSION['company_name'] ?></td>
                  <td style="border:0px;" rowspan="5" align="right"><img src="../../../logo/demo7.png" style="height:110px; width:120px;"></td>
                </tr>
                <tr style="line-height:0px;">
                  <td style="border:0px; font-size:15px; font-weight:bold;">Pay Slip</td>
                </tr>
                <tr style="line-height:0px;">
                  <td style="border:0px; font-size:15px; font-weight:bold;"><span style="font-size:15px; font-weight:bold;">Period :
                      <? $test = new DateTime('01-' . $_POST['mon'] . '-' . $_POST['year'] . ' ');







                      $_SESSION['year'] = $_POST['year'];







                      echo date_format($test, 'M-Y'); ?>
                    </span></td>
                </tr>
                <tr style="line-height:0px;">
                  <td style="border:0px; font-size:15px; font-weight:bold;">Issued by HR Division</td>
                </tr>
                <!--<tr style="line-height:0px;">







	    <td style="border:0px;"><button id="print" onClick="hide(),window.print();">PRINT/PDF</button></td>







	 </tr>-->
              </table>
              <!-- <table width="600" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:16px;">







 







  







  







    <tr>







      <td  align="left" style="border:0px;"><span style="font-size:18px; font-weight:bold;"><?= $_SESSION['company_name'] ?></span></td>







	  <td rowspan="4" style="border:0px;"  align="right"><img src="../../../logo/upay.PNG" style="height:155px; width:155px; margin-left:-80%;"></td>







    </tr>















    <tr style="line-height:3px;">















      <td style="border:0px;" align="left"><span style="font-size:16px; font-weight:bold;">Pay Slip</span></td>







	  







    </tr>















    <tr>















      <td style="border:0px;" align="left"  ><span style="font-size:16px; font-weight:bold;">Period :























        <? $test = new DateTime('01-' . $_POST['mon'] . '-' . $_POST['year'] . ' ');







































            $_SESSION['year'] = $_POST['year'];















            echo date_format($test, 'M-Y'); ?>































        </span></td>







		































    </tr>







	







	<tr style="line-height:3px;">































      <td style="border:0px;" align="left"><span style="font-size:16px; font-weight:bold;">Issued by HR Division</span></td>







	 







	  







 







    </tr>







	







	<tr style="line-height:3px;">































      <td style="border:0px;" align="left"><button id="print" onClick="hide(),window.print();">PRINT/PDF</button></td>







	 







	  







 







    </tr>















  </table>-->
              <table width="600" border="1" cellpadding="0" cellspacing="0" id="ExportTable" align="center" style="font-size:15px;" class="tabledesign">
                <tr>
                  <td style="border:0px;">
                    <table width="600" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:15px;">
                      <tr>
                        <td>Name</td>
                        <td align="center">:</td>
                        <td colspan="3"><?= $paySlip->PBI_NAME ?></td>
                      </tr>
                      <tr>
                        <td>Employee ID</td>
                        <td align="center">:</td>
                        <td colspan="3"><?= $paySlip->PBI_CODE ?></td>
                      </tr>
                      <tr>
                        <td>Designation</td>
                        <td align="center">:</td>
                        <td colspan="3"><?= $paySlip->designation ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td align="center">:</td>
                        <td colspan="3"><?= $paySlip->PBI_EMAIL ?></td>
                      </tr>
                      <tr>
                        <td colspan="5">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left"><strong>Pay Component Description</strong></td>
                        <td><strong>Amount (BDT)</strong></td>
                        <td colspan="2"><strong>Subtotal Amount (BDT)</strong></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="left" style="font-size:15px;"><strong>Addition (A)</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">Basic Salary</td>
                        <td align="right"><? if ($paySlip->basic_salary > 0) echo number_format($paySlip->basic_salary, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">House Rent</td>
                        <td align="right"><? if ($paySlip->house_rent > 0) echo number_format($paySlip->house_rent, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">Medical Allowance</td>
                        <td align="right"><? if ($paySlip->medical_allowance > 0) echo number_format($paySlip->medical_allowance, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">Conveyance</td>
                        <td align="right"><? if ($paySlip->ta_da_data > 0) echo number_format($paySlip->ta_da_data, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>

                      <tr>
                        <td colspan="2" align="left">Mobile Bill</td>
                        <td align="right"><? if ($paySlip->mobile_allowance > 0) echo number_format($mobile_bill = $paySlip->mobile_allowance, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>

                      <tr>
                        <td colspan="2" align="left"><strong>Gross</strong></td>
                        <td align="right"><? if ($paySlip->gross_salary > 0) echo number_format($gross = $paySlip->gross_salary, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">Arrears</td>
                        <td align="right"><? if ($paySlip->salary_arrear > 0) echo number_format($arrear = $paySlip->salary_arrear, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>

                      <tr>
                        <td colspan="2" align="left">Bonus Amount</td>
                        <td align="right">&nbsp;</td>
                        <td colspan="2" align="right">-</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">LFA</td>
                        <td align="right">&nbsp;</td>
                        <td colspan="2" align="right">-</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" style="font-size:15px; font-weight:bold;"><strong>Total Gross</strong></td>
                        <td align="right"></td>
                        <td colspan="2" align="right">
                          <? $total_gross = $gross + $arrear;
                          if ($total_gross > 0) echo number_format($total_gross, 2);
                          else echo '-'; ?></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="left" style="font-size:15px;"><strong>Deduction (B)</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">PF (Employee Contribution)</td>
                        <td align="right"><? if ($paySlip->pf_deduction > 0) echo number_format($pf = $paySlip->pf_deduction, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">Income Tax</td>
                        <td align="right"><? if ($paySlip->income_tax > 0) echo number_format($income_tax = $paySlip->income_tax, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>

                      <tr>
                        <td colspan="2" align="left">Advance</td>
                        <td align="right"><? if ($paySlip->advance_install > 0) echo number_format($advance_tot = $paySlip->advance_install, 0);
                                          else echo '-'; ?></td>
                        <td colspan="2" align="right"></td>
                      </tr>


                      <tr>
                        <td colspan="2" align="left" style="font-size:15px; font-weight:bold;"><strong>Deductions Subtotal</strong></td>
                        <td align="right"></td>
                        <td colspan="2" align="right"><? $total_deduction = $income_tax + $pf;
                                                      if ($paySlip->total_deduction > 0)
                                                        echo number_format($paySlip->total_deduction, 2);
                                                      else echo '-'; ?></td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border:0px;">
                    <table width="600" align="center" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="border:0px;" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="border:0px;" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="border:0px; font-size:15px; font-weight:bold;" align="left">Net Payment (BDT) = </td>
                        <td style="border:0px; font-size:15px; font-weight:bold;" align="center">Payments(A) - Deductions(B)</td>
                        <td style="border:0px; font-size:15px;" align="right"><input type="text" value="<? if (($paySlip->total_payable) > 0)
                                                                                                          echo number_format($paySlip->total_payable, 0);
                                                                                                        else echo '-'; ?>" readonly="readonly" style="text-align:right; height:30px; width:120px; font-weight:bold;"></td>
                      </tr>
                      <tr>
                        <td style="border:0px;" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="border:0px;" colspan="3">&nbsp;</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border:0px;">
                    <table width="600" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:15px;">
                      <tr>
                        <td style="border:0px" colspan="5">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="border:0px; font-size:12px;" align="left" colspan="5">Note: <br>
                          • This is a system generated copy and therefore no authorized signature is required.<br>
                          • Net salary payable amount has been transferred to your respective bank account. Please check the above salary statement and inform HR immediately if you detect any error for necessary correction. </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border:0px;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="border:0px;">&nbsp;</td>
                </tr>
              </table>
              <!--<div style="width:100px"><? //include('PrintFormat.php');
                                            ?></div>







  <div id="reporting">







  <table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">







   <thead>







  <tr>







  <td style="border:0px;">&nbsp;</td>







  </tr>







  </thead>







  </table>-->
              <? //} 
              ?>
            <?































































          } elseif ($_POST['report'] == 201) { // Leave Encashment Report















            $company = find_a_field('user_group', 'group_name', 'id=' . $_POST['PBI_ORG']);







            ?>
              <center>
                <h1>
                  <?= $company ?>
                </h1>
                <strong>Leave Encashment Report-2019</strong><br>
                Department:
                <?= $_POST['department'] ?>
                <br>
              </center>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="7"></th>
                  </tr>
                  <tr>
                    <th>S/L-201</th>
                    <th>CODE</th>
                    <th>Full Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Joining Date</th>
                    <th>Due Conf Date</th>
                    <th>Conf Date</th>
                    <th>Bank Acc </th>
                    <th>Salary</th>
                    <th>Sp</th>
                    <th>TA/DA</th>
                    <th>Leave Quota</th>
                    <th>Leave Consume(Salary Table)</th>
                    <th>Balance</th>
                    <th>Cash</th>
                    <th>Bank</th>
                    <th>Payable</th>
                  </tr>
                </thead>
                <tbody>
                  <?























                  $sqld = "select 







a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,a.PBI_GROUP as `Group`,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







(select cash from salary_info where PBI_ID=a.PBI_ID) as bank,







(select basic_salary from salary_info where PBI_ID=a.PBI_ID) as bsalary,







(select sum(special_allowance+incentive_allowance) from salary_info where PBI_ID=a.PBI_ID) as ssalary,







(select ta from salary_info where PBI_ID=a.PBI_ID) as ta,















DATE_FORMAT(a.PBI_DOJ,'%d-%m-%Y') as joining_date,







DATE_FORMAT(a.PBI_DOC,'%d-%m-%Y') as due_confirmation_date,







DATE_FORMAT(a.PBI_DOC2,'%d-%m-%Y') as confirmation_date,







a.PBI_DOJ joining_date1,







a.PBI_DOC due_confirmation_date1,







a.PBI_DOC2 confirmation_date1,







sum(t.lv)as leave_consumed







FROM personnel_basic_info a, salary_attendence t















WHERE a.PBI_ID=t.PBI_ID and t.year='2019' AND a.PBI_JOB_STATUS != 'Not In Service'







" . $con . "group by a.PBI_ID";























                  $d22 = date("2019-12-31");







                  $d2 = new DateTime($d22);















                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= $data->CODE ?></td>
                      <td><?= $data->Name ?></td>
                      <td><?= $data->designation ?></td>
                      <td><?= $data->department ?></td>
                      <td><?= $data->joining_date ?></td>
                      <td><?= $data->due_confirmation_date ?></td>
                      <td><?= $data->confirmation_date ?></td>
                      <td><?= $data->bank ?></td>
                      <td><?= $data->bsalary ?></td>
                      <td><?= $data->ssalary ?></td>
                      <td><?= $data->ta ?></td>
                      <td><?php























                          /*if($data->confirmation_date1 > date("2018-12-25") &&  $data->confirmation_date1 !='0000-00-00'){







$string = $data->confirmation_date1;







$timestamp = strtotime($string);







$tdate = date("d", $timestamp);







$cd =new DateTime($data->confirmation_date1);







$interval = date_diff($cd, $d2);















if($tdate<16){







$total_leave=$interval->format('%m')*2.5+2.5;







echo $total_leave;







}else{







$total_leave=$interval->format('%m')*2.5;







echo $total_leave;







}















}elseif($data->confirmation_date1 < date("2018-12-26") &&  $data->confirmation_date1 !='0000-00-00'){







$total_leave = 30; echo $total_leave;







}elseif($data->confirmation_date1 ='0000-00-00'){$total_leave=0; echo $total_leave;







}*/























                          // Leave quota calculation







                          $r_date = find_a_field('personnel_basic_info', 'JOB_STATUS_DATE', 'PBI_ID=' . $data->CODE);







                          if ($r_date != '0000-00-00') {
                            $last_date = $r_date;
                          } else {
                            $last_date = date("2019-12-26");
                          }















                          $last_date2 = strtotime($last_date);







                          $cdate = find_a_field('personnel_basic_info', 'PBI_DOC2', 'PBI_ID=' . $data->CODE);







                          if ($cdate < $last_date &&  $cdate != '0000-00-00') {















                            $ww = date("2019") - 1;







                            $start_date = date('' . $ww . '-12-26');







                            if ($start_date > $cdate) {
                              $cdate = $start_date;
                            }







                            $doc2 = strtotime($cdate);







                            $datediff = $last_date2 - $doc2;







                            $total_d = round($datediff / (60 * 60 * 24));







                            $total_leave = number_format(((30 * $total_d) / 365), 1);







                            if ($total_leave > 30) {
                              $total_leave = 30;
                            } elseif ($total_leave < 0) {
                              $total_leave = 0;
                            }
                          } else {







                            $total_leave = 0;
                          }







                          echo $total_leave;







                          // leave consume calculation























                          ?></td>
                      <td><?= $data->leave_consumed ?></td>
                      <td><?php $lc = ($total_leave - ($data->leave_consumed));
                          echo $lc; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><?php $pay = ($lc * ($data->bsalary / 30));
                          $tpay += $pay;
                          echo round($pay, 0); ?></td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="16"><?= convertNumberMhafuz($tpay); ?></td>
                    <td><strong>Total</strong></td>
                    <td><strong> <?php echo round($tpay, 0); ?> </strong></td>
                  </tr>
                </tbody>
              </table>
            <?







          } elseif ($_POST['report'] == 301) { // Leave Encashment Report















            $company = find_a_field('user_group', 'group_name', 'id=' . $_POST['PBI_ORG']);







            $year = $_POST['year'];







            ?>
              <center>
                <h1>
                  <?= $company ?>
                </h1>
                <strong>Leave Report-
                  <?= $year; ?>
                </strong><br>
                Department:
                <?= $_POST['department'] ?>
                <br>
              </center>
              <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                <thead>
                  <tr>
                    <th style="border:0px;" colspan="7"></th>
                  </tr>
                  <tr>
                    <th>S/L-301</th>
                    <th>CODE</th>
                    <th>Full Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Joining Date</th>
                    <th>Due Conf Date</th>
                    <th>Conf Date</th>
                    <th>Bank Acc </th>
                    <th>Salary</th>
                    <th>Sp</th>
                    <th>TA/DA</th>
                    <th>Leave Quota</th>
                    <th>Leave Consume(Salary Table)</th>
                    <th>Balance</th>
                    <th>Cash</th>
                    <th>Bank</th>
                    <th>Payable</th>
                  </tr>
                </thead>
                <tbody>
                  <?























                  $sqld = "select 







a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,a.PBI_GROUP as `Group`,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







(select cash from salary_info where PBI_ID=a.PBI_ID) as bank,







(select basic_salary from salary_info where PBI_ID=a.PBI_ID) as bsalary,







(select sum(special_allowance+incentive_allowance) from salary_info where PBI_ID=a.PBI_ID) as ssalary,







(select ta from salary_info where PBI_ID=a.PBI_ID) as ta,















DATE_FORMAT(a.PBI_DOJ,'%d-%m-%Y') as joining_date,







DATE_FORMAT(a.PBI_DOC,'%d-%m-%Y') as due_confirmation_date,







DATE_FORMAT(a.PBI_DOC2,'%d-%m-%Y') as confirmation_date,







a.PBI_DOJ joining_date1,







a.PBI_DOC due_confirmation_date1,







a.PBI_DOC2 confirmation_date1,







sum(t.lv)as leave_consumed







FROM personnel_basic_info a, salary_attendence t















WHERE a.PBI_ID=t.PBI_ID and t.year='$year' AND a.PBI_JOB_STATUS != 'Not In Service'







and a.JOB_LOCATION not in(1)







" . $con . "group by a.PBI_ID";























                  $d22 = date("$year-12-31");







                  //$d1 = new DateTime('2017-03-20');







                  $d2 = new DateTime($d22);







                  //$interval = date_diff($d1, $d2);







                  //echo $interval->format('%m months');















                  $queryd = mysql_query($sqld);







                  while ($data = mysql_fetch_object($queryd)) {







                  ?>
                    <tr>
                      <td><?= ++$s ?></td>
                      <td><?= $data->CODE ?></td>
                      <td><?= $data->Name ?></td>
                      <td><?= $data->designation ?></td>
                      <td><?= $data->department ?></td>
                      <td><?= $data->joining_date ?></td>
                      <td><?= $data->due_confirmation_date ?></td>
                      <td><?= $data->confirmation_date ?></td>
                      <td><?= $data->bank ?></td>
                      <td><?= $data->bsalary ?></td>
                      <td><?= $data->ssalary ?></td>
                      <td><?= $data->ta ?></td>
                      <td><?php







                          // --------- leave calcualtion process







                          /*if($data->confirmation_date1 > date("2018-12-25") &&  $data->confirmation_date1 !='0000-00-00'){







$string = $data->confirmation_date1;







$timestamp = strtotime($string);







$tdate = date("d", $timestamp);







$cd =new DateTime($data->confirmation_date1);







$interval = date_diff($cd, $d2);















if($tdate<16){







$total_leave=$interval->format('%m')*2.5+2.5;







echo $total_leave;







}else{







$total_leave=$interval->format('%m')*2.5;







echo $total_leave;







}















}elseif($data->confirmation_date1 < date("2018-12-26") &&  $data->confirmation_date1 !='0000-00-00'){







$total_leave = 30; echo $total_leave;







}elseif($data->confirmation_date1 ='0000-00-00'){







$total_leave=0; echo $total_leave;







}*/







                          // ---------------























                          // Leave quota calculation







                          $r_date = find_a_field('personnel_basic_info', 'JOB_STATUS_DATE', 'PBI_ID=' . $data->CODE);







                          if ($r_date != '0000-00-00') {
                            $last_date = $r_date;
                          } else {
                            $last_date = date("$year-12-26");
                          }















                          $last_date2 = strtotime($last_date);







                          $cdate = find_a_field('personnel_basic_info', 'PBI_DOC2', 'PBI_ID=' . $data->CODE);







                          if ($cdate < $last_date &&  $cdate != '0000-00-00') {















                            $ww = date("$year") - 1;







                            $start_date = date('' . $ww . '-12-26');







                            if ($start_date > $cdate) {
                              $cdate = $start_date;
                            }







                            $doc2 = strtotime($cdate);







                            $datediff = $last_date2 - $doc2;







                            $total_d = round($datediff / (60 * 60 * 24));







                            $total_leave = number_format(((30 * $total_d) / 365), 1);







                            if ($total_leave > 30) {
                              $total_leave = 30;
                            } elseif ($total_leave < 0) {
                              $total_leave = 0;
                            }
                          } else {







                            $total_leave = 0;
                          }







                          echo $total_leave;







                          // leave consume calculation















                          ?>
                      </td>
                      <td><?= $data->leave_consumed ?></td>
                      <td><?php $lc = ($total_leave - ($data->leave_consumed));
                          echo $lc; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><?php $pay = ($lc * ($data->bsalary / 30));
                          $tpay += $pay;
                          echo round($pay, 0); ?></td>
                    </tr>
                  <?







                  }







                  ?>
                  <tr>
                    <td colspan="16"><?= convertNumberMhafuz($tpay); ?></td>
                    <td><strong>Total</strong></td>
                    <td><strong> <?php echo round($tpay, 0); ?> </strong></td>
                  </tr>
                </tbody>
              </table>
            <?







          } elseif ($_POST['report'] == 208) {       // sajeeb group Leave Consumption Report{















            //$f_date = $_REQUEST['f_date'];







            //$t_date = $_REQUEST['t_date'];















            if ($_POST['PBI_ORG']) {
              $com_con = ' and p.PBI_ORG=' . $_POST['PBI_ORG'];
            }







            //$date_con = ' and j.ji_date between "'.$f_date.'" and "'.$t_date.'" ';















            // leave table







            $sqlleave = 'SELECT PBI_ID as code, SUM( total_days) as leave1







FROM hrm_leave_info







WHERE type not in("LWP (Leave Without Pay)","Compensatory Off")







and s_date between "2019-12-26" and "2020-12-25"







GROUP BY PBI_ID';















            $res = mysql_query($sqlleave);







            while ($row = mysql_fetch_object($res)) {







              $leave1[$row->code] = $row->leave1;
            }















            // salary table	







            $sqlsalary = "SELECT PBI_ID as code, SUM(lv) as leave1







FROM salary_attendence a







WHERE year = 2020 and mon between 1 and 12







GROUP BY PBI_ID";















            $res = mysql_query($sqlsalary);







            while ($row = mysql_fetch_object($res)) {







              $salary[$row->code] = $row->leave1;
            }







            ?>
              <center>
                <h1>Leave Consumption Report 2020</h1>
                <h2>Sajeeb Group</h2>
                <table width="100%" border="0" cellspacing="0" cellpadding="2" id="ExportTable">
                  <thead>
                    <tr>
                      <th>S/L</th>
                      <th bgcolor="#009999">Company</th>
                      <th bgcolor="#009999">Department</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th bgcolor="#FF6699">Date Of Join </th>
                      <th bgcolor="#FF6699">Leave</th>
                      <th bgcolor="#FF6699">Salary</th>
                      <th>Diff</th>
                      <th>Remarks </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?















                    $sqlview = "SELECT a.PBI_ID as code,a.PBI_NAME,a.PBI_DESIGNATION,a.PBI_DEPARTMENT,u.group_name as company,a.PBI_DOJ







FROM  personnel_basic_info a, user_group u







where a.PBI_ORG=u.id and a.PBI_JOB_STATUS = 'In Service'







" . $com_con . $con . "







order by u.id,a.PBI_DEPARTMENT,a.PBI_ID";















                    ?>
                    <?php







                    $query = mysql_query($sqlview);







                    while ($data = mysql_fetch_object($query)) { ?>
                      <tr>
                        <td><?= ++$op; ?></td>
                        <td><?= $data->company ?></td>
                        <td><?= $data->PBI_DEPARTMENT ?></td>
                        <td><?= $data->code ?></td>
                        <td><?= $data->PBI_NAME ?></td>
                        <td><?= $data->PBI_DESIGNATION ?></td>
                        <td><?= $data->PBI_DOJ ?></td>
                        <td><?= $leave1[$data->code] ?></td>
                        <td><?= $salary[$data->code] ?></td>
                        <td><?= ($leave1[$data->code] - $salary[$data->code]); ?></td>
                        <td>&nbsp;</td>
                      </tr>
                    <? } ?>
                  </tbody>
                </table>
                <br>
              <?







            }







            // end leave report







































            elseif ($_POST['report'] == 202) {       // sajeeb group Leave Consumption Report{















              //$f_date = $_REQUEST['f_date'];







              //$t_date = $_REQUEST['t_date'];















              if ($_POST['PBI_ORG']) {
                $com_con = ' and p.PBI_ORG=' . $_POST['PBI_ORG'];
              }







              //$date_con = ' and j.ji_date between "'.$f_date.'" and "'.$t_date.'" ';















              // leave table







              $sqlleave = 'SELECT PBI_ID as code, SUM( total_days) as leave1







FROM hrm_leave_info







WHERE type not in("LWP (Leave Without Pay)","Compensatory Off")







and s_date between "2018-12-26" and "2019-12-25"







GROUP BY PBI_ID';















              $res = mysql_query($sqlleave);







              while ($row = mysql_fetch_object($res)) {







                $leave1[$row->code] = $row->leave1;
              }















              // salary table	







              $sqlsalary = "SELECT PBI_ID as code, SUM(lv) as leave1







FROM salary_attendence a







WHERE year = 2019 and mon between 1 and 12







GROUP BY PBI_ID";















              $res = mysql_query($sqlsalary);







              while ($row = mysql_fetch_object($res)) {







                $salary[$row->code] = $row->leave1;
              }







              ?>
                <center>
                  <h1>Leave Consumption Report 2019</h1>
                  <h2>Sajeeb Group</h2>
                  <table width="100%" border="0" cellspacing="0" cellpadding="2" id="ExportTable">
                    <thead>
                      <tr>
                        <th>S/L</th>
                        <th bgcolor="#009999">Company</th>
                        <th bgcolor="#009999">Department</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th bgcolor="#FF6699">Date Of Join </th>
                        <th bgcolor="#FF6699">Leave</th>
                        <th bgcolor="#FF6699">Salary</th>
                        <th>Diff</th>
                        <th>Remarks </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?















                      $sqlview = "SELECT p.PBI_ID as code,p.PBI_NAME,p.PBI_DESIGNATION,p.PBI_DEPARTMENT,u.group_name as company,p.PBI_DOJ







FROM  personnel_basic_info p, user_group u







where p.PBI_ORG=u.id and p.PBI_JOB_STATUS = 'In Service'







" . $com_con . "







order by u.id,p.PBI_DEPARTMENT,p.PBI_ID";















                      ?>
                      <?php







                      $query = mysql_query($sqlview);







                      while ($data = mysql_fetch_object($query)) { ?>
                        <tr>
                          <td><?= ++$op; ?></td>
                          <td><?= $data->company ?></td>
                          <td><?= $data->PBI_DEPARTMENT ?></td>
                          <td><?= $data->code ?></td>
                          <td><?= $data->PBI_NAME ?></td>
                          <td><?= $data->PBI_DESIGNATION ?></td>
                          <td><?= $data->PBI_DOJ ?></td>
                          <td><?= $leave1[$data->code] ?></td>
                          <td><?= $salary[$data->code] ?></td>
                          <td><?= ($leave1[$data->code] - $salary[$data->code]); ?></td>
                          <td>&nbsp;</td>
                        </tr>
                      <? } ?>
                    </tbody>
                  </table>
                  <br>
                <?







              }







              // end leave report























              // 2017 leave encashment report 11 january 2018







              elseif ($_POST['report'] == 203) {















                ?>
                  <?= $str ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <th>S/L</th>
                        <th>Code</th>
                        <th>Full Name</th>
                        <th>Designation</th>
                        <th>Joining Date</th>
                        <th>Conf. Date</th>
                        <th>Bank Acc No</th>
                        <th>Basic Salary</th>
                        <th>Leave Quota</th>
                        <th>Leave Consumed</th>
                        <th>Leave Balance</th>
                        <th>Cash</th>
                        <th>Bank</th>
                        <th>Net Deduction</th>
                        <th>Net Payable </th>
                        <th>Signature</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?















                      $sqld = "select 







t.PBI_ID as code,a.PBI_NAME as name,t.pbi_designation as designation,















(select cash from salary_info where PBI_ID=a.PBI_ID) as bank,







t.basic_salary as bsalary,















a.PBI_GROUP as `Group`,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







DATE_FORMAT(t.pbi_doj,'%d-%m-%Y') as joining_date,







DATE_FORMAT(t.pbi_doc,'%d-%m-%Y') as confirmation_date,







t.leave_quota,t.leave_consumed,t.leave_balance,







(Case when t.cash_paid>0 then t.cash_paid else 0 end) as cash_paid,







(Case when t.bank_paid>0 then t.bank_paid else 0 end) as bank_paid,







(Case when t.amount>0 then t.amount else 0 end) as pamount,







(Case when t.amount<0 then t.amount else 0 end) as damount







FROM personnel_basic_info a, salary_leave_cash20 t







WHERE	







a.PBI_ID=t.PBI_ID







and t.year='2020'







" . $con . "







order by bsalary desc";























                      $queryd = mysql_query($sqld);







                      while ($data = mysql_fetch_object($queryd)) {







                      ?>
                        <tr>
                          <td><?= ++$s ?></td>
                          <td><?= $data->code ?></td>
                          <td><?= $data->name ?></td>
                          <td><?= $data->designation ?></td>
                          <td><?= $data->joining_date ?></td>
                          <td><?= $data->confirmation_date ?></td>
                          <td><?= $data->bank ?></td>
                          <td><?php echo round($data->bsalary, 0);
                              $tbsalary += $data->bsalary; ?></td>
                          <td><?= $data->leave_quota ?></td>
                          <td><?= $data->leave_consumed ?></td>
                          <td><?= $data->leave_balance ?></td>
                          <td><?php echo round($data->cash_paid, 0);
                              $tcash_paid += round($data->cash_paid); ?></td>
                          <td><?php echo round($data->bank_paid, 0);
                              $tbank_paid += round($data->bank_paid); ?></td>
                          <td><?php echo round($data->damount, 0);
                              $tdamount += round($data->damount); ?></td>
                          <td><?php echo round($data->pamount, 0);
                              $tpamount += round($data->pamount); ?></td>
                          <td>&nbsp;</td>
                        </tr>
                      <? } ?>
                      <tr>
                        <td colspan="6" bgcolor="#FFFFCC"><strong><? echo convertNumberMhafuz(round($tpamount, 0)); ?></strong></td>
                        <td bgcolor="#FFFFCC"><strong>Total</strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= $tbsalary ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tcash_paid, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tbank_paid, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tdamount, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tpamount, 0) ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <?







              } elseif ($_POST['report'] == 204) { // --------------- Friday Working Bill















                if ($_POST['pbi_id_in'] != '')  $con .= " and a.PBI_ID in (" . $_POST['pbi_id_in'] . ")";















                //$company=find_a_field('user_group','group_name','id='.$_POST['PBI_ORG']);







                ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <th style="border:0px;" colspan="16"><?= $str ?></th>
                      </tr>
                      <tr>
                        <th>S/L</th>
                        <th>Code</th>
                        <th>Full Name</th>
                        <th>Designation</th>
                        <th>Joining Date</th>
                        <th>Conf. Date</th>
                        <th>Bank Acc No</th>
                        <th>Basic Salary</th>
                        <th>Leave Quota</th>
                        <th>Leave Consumed</th>
                        <th>Leave Balance</th>
                        <th>Cash</th>
                        <th>Bank</th>
                        <th>Net Deduction</th>
                        <th>Net Payable </th>
                        <th>Signature</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?















                      $sqld = "select 







t.PBI_ID as code,a.PBI_NAME as name,t.pbi_designation as designation,















(select cash from salary_info where PBI_ID=a.PBI_ID) as bank,







t.basic_salary as bsalary,















a.PBI_GROUP as `Group`,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







DATE_FORMAT(t.pbi_doj,'%d-%m-%Y') as joining_date,







DATE_FORMAT(t.pbi_doc,'%d-%m-%Y') as confirmation_date,







t.leave_quota,t.leave_consumed,t.leave_balance,







(Case when t.cash_paid>0 then t.cash_paid else 0 end) as cash_paid,







(Case when t.bank_paid>0 then t.bank_paid else 0 end) as bank_paid,







(Case when t.amount>0 then t.amount else 0 end) as pamount,







(Case when t.amount<0 then t.amount else 0 end) as damount







FROM personnel_basic_info a, salary_leave_cash t







WHERE	







a.PBI_ID=t.PBI_ID







and t.year='2017'







" . $con . "







order by bsalary desc";























                      $queryd = mysql_query($sqld);







                      while ($data = mysql_fetch_object($queryd)) {







                      ?>
                        <tr>
                          <td><?= ++$s ?></td>
                          <td><?= $data->code ?></td>
                          <td><?= $data->name ?></td>
                          <td><?= $data->designation ?></td>
                          <td><?= $data->joining_date ?></td>
                          <td><?= $data->confirmation_date ?></td>
                          <td><?= $data->bank ?></td>
                          <td><?php echo round($data->bsalary, 0);
                              $tbsalary += $data->bsalary; ?></td>
                          <td><?= $data->leave_quota ?></td>
                          <td><?= $data->leave_consumed ?></td>
                          <td><?= $data->leave_balance ?></td>
                          <td><?php echo round($data->cash_paid, 0);
                              $tcash_paid += $data->cash_paid; ?></td>
                          <td><?php echo round($data->bank_paid, 0);
                              $tbank_paid += $data->bank_paid; ?></td>
                          <td><?php echo round($data->damount, 0);
                              $tdamount += $data->damount; ?></td>
                          <td><?php echo round($data->pamount, 0);
                              $tpamount += $data->pamount; ?></td>
                          <td>&nbsp;</td>
                        </tr>
                      <? } ?>
                      <tr>
                        <td colspan="6" bgcolor="#FFFFCC"><strong><? echo convertNumberMhafuz(round($tpamount, 0)); ?></strong></td>
                        <td bgcolor="#FFFFCC"><strong>Total</strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= $tbsalary ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tcash_paid, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tbank_paid, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tdamount, 0); ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC"><strong>
                            <?= round($tpamount, 0) ?>
                          </strong></td>
                        <td bgcolor="#FFFFCC">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <?







              } elseif ($_POST['report'] == 205) {















                if ($_POST['pbi_id_in'] != '')  $con .= " and a.PBI_ID in (" . $_POST['pbi_id_in'] . ")";















                //$company=find_a_field('user_group','group_name','id='.$_POST['PBI_ORG']);







                ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <th style="border:0px;" colspan="16"><?= $str ?></th>
                      </tr>
                      <tr>
                        <th>S/L</th>
                        <th>Name Of Store</th>
                        <th>Number Of Employee</th>
                        <th>Basic Salary</th>
                        <th>Cash</th>
                        <th>Bank</th>
                        <th>Net Deduction</th>
                        <th>Net Payable</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?















                      $sqld = "select l.id,l.LOCATION_NAME,count(PBI_ID) as number_of_employee,sum(basic_salary) as basic_salary,







sum(cash_paid) as cash, sum(bank_paid) as bank, SUM(CASE WHEN s.amount < 0 THEN s.amount ELSE 0 END) AS Negative ,







SUM(CASE WHEN s.amount > 0 THEN s.amount ELSE 0 END) AS Positive  







from salary_leave_cash2 s, office_location l 







where 1 and s.pbi_job_location=l.id 







and s.pbi_job_location in ('10','11','12','13','14','43','6','85','9','8') 







and s.pbi_department not in ('Store (Transport)')







group by s.pbi_job_location order by l.id";















                      $s = 0;















                      $queryd = mysql_query($sqld);







                      while ($data = mysql_fetch_object($queryd)) {







                      ?>
                        <tr>
                          <td><?= ++$s ?></td>
                          <td><?= $data->LOCATION_NAME ?></td>
                          <td><?= $data->number_of_employee ?></td>
                          <td><?= $data->basic_salary ?></td>
                          <td><?= round($data->cash) ?></td>
                          <td><?= round($data->bank) ?></td>
                          <td><?= round($data->Negative); ?></td>
                          <td><?= round($data->Positive); ?></td>
                        </tr>
                      <?







                        $g_t_e += $data->number_of_employee;







                        $g_t_b += $data->basic_salary;







                        $g_t_cash += $data->cash;







                        $g_t_bank += $data->bank;







                        $g_t_negetive += $data->Negative;







                        $_g_t_positive += $data->Positive;
                      } ?>
                      <tr>
                        <td colspan="2"><strong>Total :</strong></td>
                        <td><strong>
                            <?= round($g_t_e) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_b) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_cash) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_bank) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_negetive) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($_g_t_positive) ?>
                          </strong></td>
                      </tr>
                    </tbody>
                  </table>
                <?







              } elseif ($_POST['report'] == 207) {







                if ($_POST['pbi_id_in'] != '')  $con .= " and a.PBI_ID in (" . $_POST['pbi_id_in'] . ")";







                //$company=find_a_field('user_group','group_name','id='.$_POST['PBI_ORG']);







                ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <th style="border:0px;" colspan="16"><?= $str ?></th>
                      </tr>
                      <tr>
                        <th>S/L</th>
                        <th>Name Of Store</th>
                        <th>Number Of Employee</th>
                        <th>Basic Salary</th>
                        <th>Cash</th>
                        <th>Bank</th>
                        <th>Net Deduction</th>
                        <th>Net Payable</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?







                      $sqld = "select s.pbi_department,count(s.PBI_ID) as number_of_employee,sum(s.basic_salary) as basic_salary,







sum(s.cash_paid) as cash, 







sum(s.bank_paid) as bank, 







SUM(CASE WHEN s.amount < 0 THEN s.amount ELSE 0 END) AS Negative ,







SUM(CASE WHEN s.amount > 0 THEN s.amount ELSE 0 END) AS Positive  















from salary_leave_cash2 s 







where 1 







and s.pbi_job_location in ('1') 







and s.pbi_organization = '" . $_POST['PBI_ORG'] . "'







group by s.pbi_department







order by s.pbi_department";















                      $s = 0;















                      $queryd = mysql_query($sqld);







                      while ($data = mysql_fetch_object($queryd)) {







                      ?>
                        <tr>
                          <td><?= ++$s ?></td>
                          <td><? $dept_sql = "select DEPT_DESC from department where DEPT_SHORT_NAME='$data->pbi_department'";







                              echo find_a_field_sql($dept_sql); ?></td>
                          <td><?= $data->number_of_employee ?></td>
                          <td><?= $data->basic_salary ?></td>
                          <td><?= round($data->cash) ?></td>
                          <td><?= round($data->bank) ?></td>
                          <td><?= round($data->Negative); ?></td>
                          <td><?= round($data->Positive); ?></td>
                        </tr>
                      <?







                        $g_t_e += $data->number_of_employee;







                        $g_t_b += $data->basic_salary;







                        $g_t_cash += round($data->cash);







                        $g_t_bank += round($data->bank);







                        $g_t_negetive += round($data->Negative);







                        $g_t_positive += round($data->Positive);
                      } ?>
                      <tr>
                        <td colspan="2"><strong>Total :</strong></td>
                        <td><strong>
                            <?= round($g_t_e) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_b) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_cash) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_bank) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_negetive) ?>
                          </strong></td>
                        <td><strong>
                            <?= round($g_t_positive) ?>
                          </strong></td>
                      </tr>
                    </tbody>
                  </table>
                <?







              } elseif ($_POST['report'] == 206) { // --------------- Friday Working Bill















                if ($_POST['pbi_id_in'] != '')  $con .= " and a.PBI_ID in (" . $_POST['pbi_id_in'] . ")";















                //$company=find_a_field('user_group','group_name','id='.$_POST['PBI_ORG']);







                ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <th style="border:0px;" colspan="16"><?= $str ?></th>
                      </tr>
                      <tr>
                        <th>S/L</th>
                        <th>Name Of Store</th>
                        <th>Number Of Employee</th>
                        <th>Basic Salary</th>
                        <th>Bank</th>
                        <th>DBBL</th>
                        <th>ROCKET</th>
                        <th>IBBL</th>
                        <th>Cash</th>
                        <th>Net Deduction</th>
                        <th>Net Payable</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?















                      $sqld = "select b.BRANCH_ID,b.BRANCH_NAME,count(s.PBI_ID) as number_of_employee,sum(s.basic_salary) as basic_salary, sum(s.cash_paid) as cash, sum(s.bank_paid) as bank, SUM(CASE WHEN s.amount < 0 THEN s.amount ELSE 0 END) AS Negative ,SUM(CASE WHEN s.amount > 0 THEN s.amount ELSE 0 END) AS Positive  from salary_leave_cash2 s, branch b where 1 and s.pbi_region=b.BRANCH_ID  group by s.pbi_region order by b.BRANCH_NAME";















                      $s = 0;















                      $queryd = mysql_query($sqld);







                      while ($data = mysql_fetch_object($queryd)) {







                      ?>
                        <tr>
                          <td><?= ++$s ?></td>
                          <td><?= $data->BRANCH_NAME ?></td>
                          <td><?= $data->number_of_employee ?></td>
                          <td><?= round($data->basic_salary) ?></td>
                          <td><?= round($data->bank) ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><?= round($data->cash) ?></td>
                          <td><?= round($data->Negative); ?></td>
                          <td><?= round($data->Positive); ?></td>
                        </tr>
                      <?







                        $g_t_e += $data->number_of_employee;







                        $g_t_b += $data->basic_salary;







                        $g_t_cash += $data->cash;







                        $g_t_bank += $data->bank;







                        $g_t_negetive += $data->Negative;







                        $_g_t_positive += $data->Positive;
                      } ?>
                      <tr>
                        <td colspan="2">Total :</td>
                        <td><?= round($g_t_e) ?></td>
                        <td><?= round($g_t_b) ?></td>
                        <td><?= round($g_t_bank) ?></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td><?= round($g_t_cash) ?></td>
                        <td><?= round($g_t_negetive) ?></td>
                        <td><?= round($_g_t_positive) ?></td>
                      </tr>
                    </tbody>
                  </table>
                <?







              }























              if ($_POST['report'] == 8) { // mobile number update report























                $sql = "select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,







a.PBI_GROUP as `Group`,







a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,







(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,







(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,







(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,







a.PBI_EDU_QUALIFICATION as qualification,







a.PBI_MOBILE as mobile,a.PBI_INTERNET as modem







from personnel_basic_info a 







where 1 " . $con;







                $query = mysql_query($sql);







                ?>
                  <table width="100%" cellspacing="0" cellpadding="2" border="0" id="ExportTable">
                    <thead>
                      <tr>
                        <td style="border:0px;" colspan="11"><?= $str ?></td>
                      </tr>
                      <tr>
                        <th>S/L</th>
                        <th>CODE</th>
                        <th>Name</th>
                        <th>Desg</th>
                        <th>Dept</th>
                        <th>Group</th>
                        <th>Join_date</th>
                        <th>Area</th>
                        <th>Zone</th>
                        <th>Region</th>
                        <th>Internet Sim</th>
                        <th>Mobile No </th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?







                      while ($datas = mysql_fetch_row($query)) {
                        $s++;







                      ?>
                        <tr>
                          <td><?= $s ?></td>
                          <td><?= $datas[0] ?></td>
                          <td><?= $datas[1] ?></td>
                          <td><?= $datas[2] ?></td>
                          <td><?= $datas[3] ?></td>
                          <td><?= $datas[4] ?></td>
                          <td><?= $datas[5] ?></td>
                          <td style="text-align:right"><?= $datas[7] ?></td>
                          <td style="text-align:right"><?= $datas[8] ?></td>
                          <td><?= $datas[9] ?></td>
                          <td><input name="sim#<?= $datas[0] ?>" type="text" id="sim#<?= $datas[0] ?>" value="<?= $datas[12] ?>" /></td>
                          <td><input type="hidden" name="PBI_ID#<?= $datas[0] ?>" id="PBI_ID#<?= $datas[0] ?>" value="<?= $datas[0] ?>" />
                            <input name="mobile#<?= $datas[0] ?>" type="text" id="mobile#<?= $datas[0] ?>" value="<?= $datas[11] ?>" />
                          </td>
                          <td>
                            <div id="po<?= $datas[0] ?>">
                              <input type="button" name="Change" value="Change" onClick="update_value(<?= $datas[0] ?>)" />
                            </div>
                          </td>
                        </tr>
                      <?







                      }







                      ?>
                    </tbody>
                  </table>
                <?







              } elseif ($_POST['report'] == 22222) {







                ?>
                  <table width="100%" cellpadding="0" cellspacing="0" border="1" id="ExportTable" bordercolor="#000000">
                    <thead>
                      <tr>
                        <td style="border:0px;" colspan="13"><?= $str ?></td>
                      </tr>
                    </thead>
                    <?







                    $begin = new DateTime($start_date);







                    $end   = new DateTime($end_date);







                    $x = 0;







                    for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                      $x++;







                      $date_ymd[$x] = $i->format("Y-m-d");







                      $date_stamp[$x] = strtotime($date[$x]);
                    }















                    $sql = "select a.PBI_NAME,a.PBI_ID,a.PBI_DESIGNATION,a.PBI_DEPARTMENT,a.JOB_LOCATION from 







		personnel_basic_info a







		where  1 " . $con . "  and a.PBI_JOB_STATUS='In Service' order by a.PBI_ID ";







                    $query = mysql_query($sql);







                    while ($info = mysql_fetch_object($query)) {















                      $sql_sks = 'SELECT id, point_short_name,job_location FROM `hrm_roster_point` ';







                      $sks_query = mysql_query($sql_sks);







                      while ($sks_r = mysql_fetch_object($sks_query)) {







                    ?>
                        <tr>
                          <td rowspan="2">SL</td>
                          <td rowspan="2"><?= $sks_r->point_short_name; ?></td>
                          <td rowspan="2">Cell No </td>
                          <?







                          for ($p = 1; $p >= $x; $p++) {







                          ?>
                            <td><?







                                echo date('M-d', $date_stamp[$p]);







                                ?></td>
                          <?







                          }







                          ?>
                        </tr>
                        <tr>
                          <?







                          for ($pp = 1; $pp >= $x; $pp++) {







                          ?>
                            <td><?







                                echo date('D', $date_stamp[$pp]);







                                ?></td>
                          <?







                          }







                          ?>
                        </tr>
                        <?







                        $sqlss = "select a.PBI_NAME,a.PBI_ID,a.PBI_DESIGNATION,a.PBI_DEPARTMENT,a.PBI_MOBILE from 







personnel_basic_info a,hrm_roster_allocation r







where " . $con . " r.PBI_ID=a.PBI_ID and r.roster_date between '" . $start_date . "' and '" . $end_date . "' and a.JOB_LOCATION = '" . $sks_r->job_location . "'  and a.PBI_JOB_STATUS='In Service' order by a.PBI_ID ";







                        $querys = mysql_query($sqlss);







                        while ($datas = mysql_fetch_array($querys)) {







                        ?>
                          <tr>
                            <td><?= ++$s ?></td>
                            <td><?= $datas->PBI_NAME ?></td>
                            <td><?= $datas->PBI_MOBILE ?></td>
                            <?







                            for ($ppp = 1; $ppp >= $x; $ppp++) {







                            ?>
                              <td><?= find_a_field('hrm_roster_allocation r,hrm_schedule_info s', 's.schedule_name', 'r.PBI_ID ="' . $info->PBI_ID . '" and r.shedule_1=s.id and r.roster_date = "' . date('Y-m-d', $date_stamp[$ppp]) . '"') ?></td>
                            <? } ?>
                          </tr>
                    <?







                        }
                      }
                    }







                    ?>
                  </table>
                <?







              } elseif (isset($sql) && $sql != '') {
                echo report_create($sql, 1, $str);
              }







                ?>
                <!--<table width="100%"  border="0" id="No CSS Style">







<tr>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







</tr>







<tr>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







  <td style="border-color:#FFFFFF">&nbsp;</td>







</tr>







<tr>







    <td style="border-color:#FFFFFF">...............................</td>







    <td style="border-color:#FFFFFF">...............................</td>







    <td style="border-color:#FFFFFF">...............................</td>







    <td style="border-color:#FFFFFF">...............................</td>







    <td style="border-color:#FFFFFF">...............................</td>







  </tr>







  <tr>







    <td style="border-color:#FFFFFF">Prepared By</td>







    <td style="border-color:#FFFFFF">Checked By</td>







    <td style="border-color:#FFFFFF">Audited By</td>







    <td style="border-color:#FFFFFF">Forwarded By</td>







    <td style="border-color:#FFFFFF">Approved By</td>







    </tr>







</table>-->
    </div>
    </div>
  </form>
</body>

</html>