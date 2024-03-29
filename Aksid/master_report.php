<?

session_start();

require "../../config/inc.all.php";

require "../../classes/report.class.php";

require_once ('../../../acc_mod/common/class.numbertoword.php');
date_default_timezone_set('Asia/Dhaka');

require "../../../engine/tools/inc.exporttable.php";

if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)

{


	if($_POST['name']!='')


	$con.=' and a.PBI_NAME like "%'.$_POST['name'].'%"';


	if($_POST['PBI_ORG']!='')

	$con.=' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';

	if($_POST['department']!='')


	$con.=' and a.PBI_DEPARTMENT = "'.$_POST['department'].'"';































	if($_POST['project']!='')































































	$con.=' and a.PBI_PROJECT = "'.$_POST['project'].'"';































	if($_POST['designation']!='')































	$con.=' and a.PBI_DESIGNATION = "'.$_POST['designation'].'"';































































	if($_POST['zone']!='')































	$con.=' and a.PBI_ZONE = "'.$_POST['zone'].'"';































































	if($_POST['JOB_LOCATION']!='')































	$con.=' and a.JOB_LOCATION = "'.$_POST['JOB_LOCATION'].'"';































	if($_POST['PBI_GROUP']!='')































































	$con.=' and a.PBI_GROUP = "'.$_POST['PBI_GROUP'].'"';































































































































	if($_POST['area']!='')































































	$con.=' and a.PBI_AREA = "'.$_POST['area'].'"';































































	if($_POST['branch']!='')































































	$con.=' and a.PBI_BRANCH = "'.$_POST['branch'].'"';































































































	if($_POST['job_status']!='')































































	$con.=' and a.PBI_JOB_STATUS = "'.$_POST['job_status'].'"';































































	if($_POST['gender']!='')































































	$con.=' and a.PBI_SEX = "'.$_POST['gender'].'"';































































































































	if($_POST['ijdb']!='')































































	$con.=' and a.PBI_DOJ < "'.$_POST['ijdb'].'"';































































	if($_POST['ppjdb']!='')































































	$con.=' and a.PBI_DOJ_PP < "'.$_POST['ppjdb'].'"';































































































































	if($_POST['ijda']!='')































































	$con.=' and a.PBI_DOJ > "'.$_POST['ijda'].'"';































































	if($_POST['ppjda']!='')































































	$con.=' and a.PBI_DOJ_PP > "'.$_POST['ppjda'].'"';































































	if($_POST['department']!='')































































	$depts = find_a_field('department','DEPT_DESC','DEPT_ID='.$_POST['department'] );































































	if($_POST['bonus_type']!=''){































































		if($_POST['bonus_type']==2)































































			$bonusName = 'Eid-Ul Adha';































































		else































































			$bonusName = 'Eid-Ul Fitre';































































	}































































switch ($_POST['report']) {































	case 1:































	$report="Employee Basic Information";































	break;































































































































	case 10001:































































	$report="Employee Details Information";































































































































	$sql="select a.PBI_ID as CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,a.PBI_DEPARTMENT as department,a.PBI_GROUP as `Group`,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,(select group_name from user_group where id=a.PBI_ORG) as Company ,(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,a.PBI_EDU_QUALIFICATION as qualification,a.PBI_MOBILE as mobile,PBI_JOB_STATUS job_status,JOB_LOCATION from personnel_basic_info a where	1 ".$con." order by a.PBI_DOJ asc";































































	break;































































































































	case 2:

$report="Employee Salary Information";
 $sql="select a.PBI_ID as CODE, a.PBI_NAME as Name,
(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,

(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,

 DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,

 b.gross_salary, b.basic_salary, b.house_rent, b.medical_allowance, b.special_allowance as conveyance, b.food_allowance,
 b.transport_allowance,b.card_no as payroll_card_no,b.cash as Bank_account_no from personnel_basic_info a,salary_info b
 where	a.PBI_ID=b.PBI_ID ".$con." order by a.PBI_DOJ";

	break;



















































































































































































































    case 3:































































    $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);































        $monthName = $dateObj->format('F');















































	$report="Monthly Attendence Report";































	$report .="<br>";































	$report .= $monthName ."-". $_POST['year'];















































		break;















































    case 4:































































		$report="Over Time Report";































































if($_POST['mon']>0&&$_POST['year']>0)































































{































































	$mon = $_POST['mon'];































































	$year = $_POST['year'];































































	$sql="SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department, b.ot as over_time_hour,(b.total_salary/208) as rate,b.over_time_amount FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='".$mon."' and b.year='".$year."'".$con." order by a.PBI_DOJ asc";































































}































































		break;































































	    case 5:































































		$report="Salary Payroll Report (Detail)";































































if($_POST['mon']>0&&$_POST['year']>0)































































{































































	$mon = $_POST['mon'];































































	$year = $_POST['year'];































































	$sql="SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,































































	b.od,b.hd,b.lt,b.ab,b.lv,b.pre,b.pay,































































	b.over_time_amount,































































	b.basic_salary,b.total_salary as consolidated_salary,b.house_rent,b.medical_allowance,b.other_allowance,b.special_allowance,b.ta_da as TA_DA, b.food_allowance as fooding, b.mobile_allowance,b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.total_benefits,b.total_payable*(1.00) as total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='".$mon."' and b.year='".$year."'".$con." order by a.PBI_DOJ asc";































































}































































		break;































































































































    case 6:































































				$report="Salary Payroll Report (Summary)";































































if($_POST['mon']>0&&$_POST['year']>0)































































{































































	$mon = $_POST['mon'];































































	$year = $_POST['year'];































































	$sql="SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,































































	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction,b.total_benefits,b.total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='".$mon."' and b.year='".$year."'".$con." order by a.PBI_DOJ asc";































































}































































break;































































	case 7:































































	$report="Salary Payroll Report";































































	break;































































































































	case 77:































































	$report="Salary Payroll Report Final (Field)";































































	break;































































































































	case 78:































































	$report="Salary Sheet for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;































































	break;















































	case 283544:































































	$report="Salary Sheet for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;































































	break;















































case 776:
$report="Salary Sheet for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;
break;


case 782:
$report="Salary Sheet for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;
break;







case 783:
$report="Salary Sheet for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;
break;
































































































































	case 788:































































	$report="Salary Advice Bank Account for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;































































	break;































































































































	case 789:































































	$report="Salary Advice Payroll Card for the Month of ".date('F Y',mktime(0,0,0,$_POST['mon'],01,$_POST['year']))." <br> ".$depts;































































	break;

















































case 777:
$report="Festival Bonus  of ".$bonusName . " " .$_POST['year']." <br> ".$depts;
break;


case 21215:
$report="Festival Bonus  of ".$bonusName . " " .$_POST['year']." <br> ".$depts;
break;

case 21216:
$report="Festival Bonus of ".$bonusName. " " .$_POST['year']." <br> Bkash Advice <br>".$depts;
break;










































case 778:
$report="Festival Bonus Bank Account of ".$bonusName." <br> ".$depts;



break;







case 779:
$report="Festival Bonus of ".$bonusName. " " .$_POST['year']." <br> Bank Advice <br>".$depts;
break;































































































































	case 780:































































	$report="Festival Bonus  of ".$bonusName."-".$_POST['year']." <br> ".$depts;































































	break;































































































































	case 781:































































	$report="".$depts;































































	break;































































































































	case 8:































































	$report="Staff Mobile Information(Changable)";































































	break;































































































































case 66:































































$report="Salary Payroll Report (Final)";































































if($_POST['mon']>0&&$_POST['year']>0)































































{































































	$mon = $_POST['mon'];































































	$year = $_POST['year'];































































	  $sql="SELECT a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,b.od,b.hd,b.lt,b.ab,b.lv,b.pre,b.pay,































































	b.over_time_amount,b.absent_deduction,b.advance_install,b.other_install,b.bonus_amt,b.deduction,b.benefits,b.total_salary,b.total_deduction, (b.total_salary-b.total_deduction) as actual_salary, b.total_benefits,b.total_payable FROM personnel_basic_info a,salary_attendence b where	a.PBI_ID=b.PBI_ID and b.mon='".$mon."' and b.year='".$year."'".$con." order by a.PBI_DOJ asc";































































}































































		break;































































	case 11:































































        $report="OutStanding Dues";































































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and d.party_code='.$party_code;}































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































































































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.inst_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































































		$sql="select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no and rcv_status=0 ".$proj_con.$date_con.$flat_con.$party_con." order by a.inst_date";































































		break;































































	case 12:































































        $report="Expected Collection";































































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and d.party_code='.$party_code;}































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































































































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.inst_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































































		$sql="select c.proj_name as project_name,a.flat_no as allot_no,b.party_name as client_name,a.inst_date,a.inst_amount as payable_amt,a.rcv_amount as received_amt from tbl_flat_cost_installment a, tbl_party_info b, tbl_project_info c,tbl_flat_info d where a.proj_code=c.proj_code and d.party_code=b.party_code and a.proj_code=d.proj_code and a.build_code=d.build_code and a.flat_no=d.flat_no ".$proj_con.$date_con.$flat_con.$party_con." order by a.inst_date";































































		break;































































	case 13:















































        $report="Payment Schedule";















































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and d.party_code='.$party_code;}































		if(isset($proj_code))















































		if(!isset($flat_no))















































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































































		if(isset($t_date))















































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.inst_date between \''.$fr_date.'\' and \''.$to_date.'\'';}















































		$sql="SELECT e.pay_desc,a.inst_no, c.proj_name AS project_name,a.flat_no AS allot_no,  a.inst_date, a.inst_amount AS payable_amt, a.rcv_date AS receive_date, a.rcv_amount AS receive_amt































































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































































AND a.pay_code = e.pay_code".$proj_con.$date_con.$flat_con.$party_con." order by a.inst_date";































































		break;































































		case 14:































































        $report="Party Rent Agreement Terms";































































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and a.party_code='.$party_code;}































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































		$sql="SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`monthly_rent`,a.`effective_date`,a.`expire_date`,a.`notice_period`,a.discontinue_term,a.`witness1`,a.`witness1_address` FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code ".$proj_con.$flat_con.$party_con;































































		break;































































 case 551010:































 $report = "Yearly Department Wise Salary Statement ".$_POST['year'];































 break;































































		case 15:































































        $report="Party Rent Payment Terms";































































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and a.party_code='.$party_code;}































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































		$sql="SELECT b.`proj_name`,a.`flat_no`,c.`party_name`,a.`security_money`,a.`monthly_rent`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,(a.`monthly_rent`++a.`electricity_bill`+a.`other_bill`+a.`wasa_bill`+a.`gas_bill`) as total_payable FROM `tbl_rent_info` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code ".$proj_con.$flat_con.$party_con;































































		break;































































		case 16:































































        $report="Party Rent Payment Terms";































































if(isset($party_code))































































{$client_name=find_a_field('tbl_party_info','party_name','party_code='.$party_code); $party_con=' and a.party_code='.$party_code;}































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































		$sql="SELECT a.jv_no as Invoice_no,a.mon as period,b.`proj_name`,a.`flat_no`,c.`party_name`,a.`rent_amt`,a.`electricity_bill`,a.`other_bill`,a.`wasa_bill`,a.`gas_bill`,total_amt as total_amt FROM `tbl_rent_receive` a,tbl_party_info c,tbl_project_info b WHERE a.party_code=c.party_code and a.proj_code=b.proj_code ".$proj_con.$flat_con.$party_con;































































		break;































	case 24:































































	$report="Collection Statement(Cash)";































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.rec_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































































		$sql="select a.rec_date as tr_date,b.proj_name".$flat_show.",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=0 and a.proj_code=b.proj_code ".$proj_con.$date_con.$flat_con." order by a.rec_date";































































		break;































































	case 25:































































	$report="Collection Statement(Chaque)";































































		if(isset($proj_code))































































		if(!isset($flat_no))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































		else































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code);































































$allotment_no=$flat_no; $flat_show=',a.flat_no as allot_no'; $flat_con=' and a.proj_code='.$proj_code.' and a.flat_no=\''.$flat_no.'\' ';}































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.rec_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































































		$sql="select a.rec_date as tr_date,a.cheq_no,b.proj_name".$flat_show.",a.rec_amount as total_amt from tbl_receipt a,tbl_project_info b where a.pay_mode=1 and a.proj_code=b.proj_code ".$proj_con.$date_con.$flat_con." order by a.rec_date";































































		break;































































































































































































// COMMISION REPORTS































































		case 31:































































	$report="Share Holder Investment Amount";































































		if(isset($proj_code))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.opening_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































		$sql="SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`status`,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code`".$date_con.$proj_con ." order by a.proj_code,a.agent_code";































































		break;































































































































		case 33:































































	$report="Running Share Holder Information";































































		if(isset($proj_code))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.opening_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































		$sql="SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Running' ".$date_con.$proj_con ." order by a.proj_code,a.agent_code";































































		break;































































































































		case 34:































































	$report="Withdrawn Share Holder Information";































































		if(isset($proj_code))































































{$project_name=find_a_field('tbl_project_info','proj_name','proj_code='.$proj_code); $proj_con=' and a.proj_code='.$proj_code;}































































































































		if(isset($t_date))































































{$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.opening_date between \''.$fr_date.'\' and \''.$to_date.'\'';}































		$sql="SELECT a.`member_no`,a.`party_name` as share_holder,b.proj_name,a.`agent_code`,c.`emp_name` as agent_name,a.`opening_date` as invest_date,a.`invested`,a.`status_date` as withdrawn_date,a.`withdraw` FROM `tbl_director_info` AS a,tbl_project_info as b,tbl_employee_info as c WHERE a.proj_code=b.proj_code and c.emp_id=a.`agent_code` and a.status='Withdrawn' ".$date_con.$proj_con ." order by a.proj_code,a.agent_code";































































		break;































































































































		case 35:































































	$report="Agent Information";































































































































		$sql="SELECT `emp_id`,`emp_name`,`emp_designation`,`emp_joining_date`,`emp_contact_no`, (select count(1) from tbl_director_info where agent_code=a.emp_id) as total_member, (select sum(invested) from tbl_director_info where agent_code=a.emp_id) as total_invested, (select sum(withdraw) from tbl_director_info where agent_code=a.emp_id)  as total_withdrawn FROM `tbl_employee_info` as a WHERE 1";































































		break;































































































































    case 101:































































	$report="APR Information";































































			if($_POST['markb']!='')































































	$con.=' and b.APR_MARKS < "'.$_POST['markb'].'"';































































































































		if($_POST['marka']!='')































































	$con.=' and b.APR_MARKS > "'.$_POST['marka'].'"';































































	$year=$_POST['year'];































































	$con.=' and b.APR_YEAR = "'.$year.'"';































































         $sql="select a.PBI_ID as ID,a.PBI_NAME as Name,a.PBI_SEX as Gender,a.PBI_DOMAIN as Domain,a.PBI_DEPARTMENT as department,a.PBI_PROJECT as project	,a.PBI_DESIGNATION as designation ,a.PBI_DESG_GRADE as grade,a.PBI_ZONE as zone,a.PBI_AREA as area,a.PBI_BRANCH as branch,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,b.APR_YEAR,b.APR_MARKS,(select avg(APR_MARKS) from apr_detail where APR_YEAR in (".$year.",".($year-1).",".($year-2).") and PBI_ID=a.PBI_ID) as avg_marks,b.APR_STATUS,b.APR_RESULT  from personnel_basic_info a,apr_detail b where a.PBI_ID=b.PBI_ID ".$con." order by a.PBI_DOJ asc";































































		break;































































































case 1001:































































$report="Sales Channel Parter(SCP) Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['region_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['mobile_no']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































    $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, sr.SUB_REGION_NAME as sub_region, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, sub_region sr, branch r































































		 where a.area_code=ar.AREA_CODE and ar.ZONE_ID=z.ZONE_CODE and z.REGION_ID=sr.SUB_REGION_CODE and sr.REGION_ID=r.BRANCH_ID and a.dealer_type='Sales Channel Parter(SCP)'  ".$con." order by a.PBI_DOJ asc"." order by a.dealer_code desc";































































































































































































		break;































































































































case 1002:































































$report="Project Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































































		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, branch r































































		 where ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID and a.dealer_type='Project'  ".$con." order by a.PBI_DOJ asc";































































































































		break;































































































































































































case 1003:















































$report="Corporate Customer Information";































if($_POST['dealer_name_e']!='')































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as customer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,(select sum(dr_amt-cr_amt) from journal where ledger_id=a.account_code) as closing_balance,a.mobile_no as mobile_no,a.dealer_name_b as designation , a.propritor_name_b as contact_person , a.address_e as address, a.canceled as active, a.commission from dealer_info a































































		 where a.dealer_type='Corporate'  ".$con."  order by a.dealer_code asc";































































		// , area ar, zon z, branch r;































		 //,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region;















		 //ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID;































		break;































































		case 10044:































































$report="Direct Sales(DS) Customer Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































































































		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as customer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.dealer_name_b as designation , a.propritor_name_b as contact_person , a.address_e as address, a.canceled as active, a.commission from dealer_info a































































		 where a.dealer_type='Direct Sales(DS)'  ".$con." order by a.dealer_code asc";































































































































































































		// , area ar, zon z, branch r;































































		 //,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region;































































		 //ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID;































































		break;































































































































				case 1005:































































$report="Retailer Partner(RP) Customer Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































































































		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as customer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.dealer_name_b as designation , a.propritor_name_b as contact_person , a.address_e as address, a.canceled as active, a.commission from dealer_info a































































		 where a.dealer_type='Retailer Partner(RP)'  ".$con."  order by a.dealer_code asc";































































































































































































		// , area ar, zon z, branch r;































































		 //,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region;































































		 //ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID;































































		break;































































































































						case 1006:































































$report="RMC Customer Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































































































		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as customer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.dealer_name_b as designation , a.propritor_name_b as contact_person , a.address_e as address, a.canceled as active, a.commission from dealer_info a































































		 where a.dealer_type='RMC'  ".$con."  order by a.dealer_code asc";































































































































































































		// , area ar, zon z, branch r;































































		 //,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region;































































		 //ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID;































































		break;































































































































case 1004:































































$report="Personal Sales Information";































































if($_POST['dealer_name_e']!='')































































$con.=' and a.dealer_name_e like "%'.$_POST['dealer_name_e'].'%"';































































if($_POST['dealer_code']!='')































































$con.=' and a.dealer_code = "'.$_POST['dealer_code'].'"';































if($_POST['division_code']!='')































































$con.=' and a.division_code = "'.$_POST['division_code'].'"';































































elseif($_POST['district_code']!='')































































$con.=' and a.district_code = "'.$_POST['district_code'].'"';































































elseif($_POST['thana_code']!='')































































$con.=' and a.thana_code = "'.$_POST['thana_code'].'"';































































if($_POST['region_code']!='')































































$con.=' and a.area_code in (select p.AREA_CODE from area p,zon z where p.ZONE_ID=z.ZONE_CODE and z.REGION_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['zone_code']!='')































































$con.=' and a.area_code in (select AREA_CODE from area where ZONE_ID="'.$_POST['zone_code'].'") ';































































elseif($_POST['area_code']!='')































































$con.=' and a.area_code = "'.$_POST['area_code'].'"';































































if($_POST['canceled']!='')































































$con.=' and a.canceled = "'.$_POST['canceled'].'"';































































if($_POST['depot']!='')































































$con.=' and a.depot = "'.$_POST['depot'].'"';































if($_POST['product_group']!='')































































$con.=' and a.product_group = "'.$_POST['product_group'].'"';































































if($_POST['depot']!='')































































$con.=' and a.mobile_no = "'.$_POST['mobile_no'].'"';































































if($_POST['team_name']!='')































































$con.=' and a.team_name = "'.$_POST['team_name'].'"';































































































































		 		  $sql="select a.dealer_code as code,a.account_code as ledger_code,a.dealer_name_e as dealer_name ,(select ledger_name from accounts_ledger where ledger_id=a.account_code) as ledger_name,a.mobile_no as mobile_no,a.propritor_name_e as propritor_name ,a.team_name as team, ar.AREA_NAME as area, z.ZONE_NAME as zone, r.BRANCH_NAME as region, a.canceled as active, a.commission from dealer_info a, area ar, zon z, branch r































































		 where ar.AREA_CODE=a.area_code and z.ZONE_CODE=ar.ZONE_ID and r.BRANCH_ID=z.REGION_ID and a.dealer_type='Personal'  ".$con." order by a.dealer_code desc";































































break;































































































































































































}































































}































?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>
<?=$report?>
</title>
<link href="../../css/report.css" type="text/css" rel="stylesheet" />
<script language="javascript">































































function hide()































































{































































document.getElementById('pr').style.display='none';































































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































































            if(i < from || i > to) rows[i].style.display = 'none';































































            else rows[i].style.display = '';































































        }































































    }































































































































    this.showPage = function(pageNumber) {































































    	if (! this.inited) {































































    		alert("not inited");































































    		return;































































    	}































        var oldPageAnchor = document.getElementById('pg'+this.currentPage);































































        oldPageAnchor.className = 'pg-normal';































































































































        this.currentPage = pageNumber;































































        var newPageAnchor = document.getElementById('pg'+this.currentPage);































































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































































    	if (! this.inited) {































































    		alert("not inited");































































    		return;































































    	}































































    	var element = document.getElementById(positionId);































































































































    	var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal">Prev</span>';































































        for (var page = 1; page <= this.pages; page++)































































            pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';































































        pagerHtml += '<span onclick="'+pagerName+'.next();" class="pg-normal">Next</span>';































































































































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































































	  if(XMLHttpRequestObject)































































		  {































































				var obj = document.getElementById(divID);































































				XMLHttpRequestObject.open("POST", dataSource);































































				XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');































































































































				XMLHttpRequestObject.onreadystatechange = function()































































					{































































						if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)































































							obj.innerHTML =   XMLHttpRequestObject.responseText;































































					}































































				XMLHttpRequestObject.send("ledger=" + data);































































		  }































































	}































































function getData2(dataSource, divID, data1, data2)































































	{































































	  if(XMLHttpRequestObject)































































		  {































































				var obj = document.getElementById(divID);































































				XMLHttpRequestObject.open("POST", dataSource);































































				XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');































































































































				XMLHttpRequestObject.onreadystatechange = function()































































					{































































						if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)































































							obj.innerHTML =   XMLHttpRequestObject.responseText;































































					}































































				XMLHttpRequestObject.send("data=" + data1+"##" + data2);































		  }































































	}































































	function getflatData3()































































{































































	var b=document.getElementById('category_to').value;































































	var a=document.getElementById('proj_code_to').value;































































			$.ajax({































































		  url: '../../common/flat_option_new3.php',































































		  data: "a="+a+"&b="+b,































































		  success: function(data) {































































				$('#fid3').html(data);































































			 }































































		});































































}































































	function getflatData2()































































{































































	var b=document.getElementById('category_from').value;































































	var a=document.getElementById('proj_code_from').value;































































			$.ajax({































































		  url: '../../common/flat_option_new2.php',































































		  data: "a="+a+"&b="+b,































































		  success: function(data) {































































				$('#fid2').html(data);































































			 }































































		});































































}































































</script>
</head>
<body>
<form action="advance_report.php" method="post">
<div align="center" id="pr">
  <?php /*?>  <input type="button" value="Print" onclick="hide();window.print();"/>     <?php */?>
</div>
<div class="main">
<?































































		//echo $sql;



























$str 	.= '<div class="header">';
if(isset($_SESSION['company_name']))

$str 	.= '<h2 style="font-size:24px; font-family:bankgothic; transform: uppercase;">AKSID CORPORATION LIMITED</h2>';


if(isset($report))
$str 	.= '<h2>'.$report.'</h2>';

if($_POST['JOB_LOCATION']!='')
$str 	.= '<h2>'.find_a_field('project','PROJECT_DESC','PROJECT_ID='.$_POST['JOB_LOCATION']).'</h2>';
if(isset($to_date))
$str 	.= '<h2>'.$fr_date.' To '.$to_date.'</h2>';
$str 	.= '</div>';













































if(isset($_SESSION['company_logo']))































































		//$str 	.= '<div class="logo"><img height="60" src="'.$_SESSION['company_logo'].'"</div>';































































		$str 	.= '<div class="center">';































































































































		if(($_POST['area_code']>0))































































		$str 	.= '<p>Area Name: '.find_a_field('area','AREA_NAME','AREA_CODE="'.$_POST['area_code'].'"').'</p>';































































		if(($_POST['zone_code']>0))































































		$str 	.= '<p>Zone Name: '.find_a_field('zon','ZONE_NAME','ZONE_CODE="'.$_POST['zone_code'].'"').'</p>';































































		if(($_POST['region_code']>0))































































		$str 	.= '<p>Region Name: '.find_a_field('branch','BRANCH_NAME','BRANCH_ID="'.$_POST['region_code'].'"').'</p>';































































		if(isset($project_name))































































		$str 	.= '<p>Project Name: '.$project_name.'</p>';































































		if(isset($allotment_no))































































		$str 	.= '<p>Allotment No.: '.$allotment_no.'</p>';































































		$str 	.= '</div><div class="right">';































































		if(isset($client_name))































































		$str 	.= '<p>Client Name: '.$client_name.'</p>';































































		$str 	.= '</div><div class="date" style="">Reporting Time: '.date("h:i A d-m-Y").'</div>';































































































































if($_POST['report']==7)































































{




$sql="select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department from





personnel_basic_info a where 1 ".$con." order by a.PBI_DOJ asc";




$query = mysql_query($sql);





?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="11"><?=$str?></td>
    </tr>
    <tr>
      <th>S/L</th>
      <th>CODE</th>
      <th>Name</th>
      <th>Desg</th>
      <th>Dept</th>
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































































while($datas=mysql_fetch_row($query)){$s++;































































$sqld = 'select * from salary_info where PBI_ID='.$datas[0];































































$data = mysql_fetch_object(mysql_query($sqld));































































?>
    <tr>
      <td><?=$s?></td>
      <td><?=$datas[0]?></td>
      <td><?=$datas[1]?></td>
      <td><?=$datas[2]?></td>
      <td><?=$datas[3]?></td>
      <td><?=$data->salary_type?></td>
      <td><?=$data->basic_salary?></td>
      <td><?=$data->consolidated_salary?></td>
      <td style="text-align:right"><?=$data->special_allowance ?></td>
      <td style="text-align:right"><?=$data->house_rent?></td>
      <td><?=$data->ta?></td>
      <td><?=$data->food_allowance?></td>
      <td><?=$data->medical_allowance?>
        &nbsp;</td>
      <td><?=$data->cash_bank?>
        &nbsp;</td>
      <td><?=$data->cash?></td>
      <td><?=$data->branch_info?></td>
      <td><?=$data->security_amount?></td>
    </tr>
    <?































































}





?>
  </tbody>
</table>




<!-- **************  Experience Certificate start ************************  -->
<?

} if($_POST['report']==5312023) {

if($_POST['id_no']!=''){

$emp_id = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['id_no'].'"');

$pay_con = ' and p.PBI_ID="'.$emp_id.'"'; }
//if($_POST['mon']!=''){
//$pay_con .= ' and s.mon="'.$_POST['mon'].'"';}
//if($_POST['year']!=''){ $pay_con .= ' and s.year="'.$_POST['year'].'"';  }
if($_POST['department']!=''){$pay_con .= ' and s.department="'.$_POST['department'].'"';}
if($_POST['job_status']!=''){ $pay_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"'; }

 $pay = 'select p.PBI_ID,p.PBI_CODE,p.PBI_SEX,p.PBI_DOJ,p.PBI_NAME,(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,
(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,p.PBI_MARITAL_STA

from personnel_basic_info p
where 1 '.$pay_con.' ';
$qry = mysql_query($pay);
while($paySlip = mysql_fetch_object($qry)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div width="60%"> <br>
    <br>
    <br>
    <br>
    <br>

	<br>
    <br>
    <br>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-lg-10">
        <div>
          <!-- <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">
						Ref: AK/HR/SC/
            <?=date("M-j");?>
          </h3> -->
          <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">
            <?=date("l, F j, Y");?>
          </h3>
        </div>
        </br>
        </br>
        </br>
        </br>
        <br>
        <br>
        <main>

         <?
				$reg_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','PBI_ID="'.$paySlip->PBI_ID.'"');
        if($reg_date >0){

         ?>
				 <div id="details" class="clearfix">
           <div>
             <h2 style="font-family: Cambria, Georgia, serif; font-size:35px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">
               <center>
               TO WHOM IT MAY CONCERN
               <hr >
               <center>
             </h2>
           </div></br>


           <div style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 36px;">
           <div style="text-align:justify;">

 			This is to certify that <b>
 			<? if($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Married") { ?>
               Mrs.
 			  <?  }elseif($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Unmarried"){?>
               Ms.
               <?  }else{?>
               Mr.
						 <? } ?> <?=$paySlip->PBI_NAME;?>, ID: <?=$paySlip->PBI_CODE;?></b> had been employed with<b>
 				AKSID Corporation Limited</b> from <?=date('F j, Y',strtotime($paySlip->PBI_DOJ))?> to  <?=date('F j, Y',strtotime($reg_date))?>,
				as  <b>“<?=$paySlip->designation;?>”</b>.
 			  <?if($paySlip->PBI_SEX=="Female"){?> She <?}else{  ?> He <? } ?> was a permanent associate of this company.
 			</div>

 		  </br>
 		  <div style="text-align:justify;">
 		  <b><? if($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Married") { ?>
               Mrs.
 			  <?  }elseif($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Unmarried"){?>
               Ms.

               <?  }else{?>
               Mr.<? } ?> <?=$paySlip->PBI_NAME;?></b>, besides having a pleasing personality, bears a good moral character and
 			  <?if($paySlip->PBI_SEX=="Female"){?> she <?}else{  ?> he <? } ?> had relentlessly worked to the satisfaction of the management
				during her tenure of service.
 			  </div>
 			  </br>

 			  <div style="text-align:justify;">
                We wish <?if($paySlip->PBI_SEX=="Female"){?> her <?}else{  ?> him <? } ?>every success in the days to come.
 			  </div>

 			</div>
       </div>

        <? }else{ 	 ?>



        <div id="details" class="clearfix">
          <div>
            <h2 style="font-family: Cambria, Georgia, serif; font-size:35px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">
              <center>
              TO WHOM IT MAY CONCERN
              <hr >
              <center>
            </h2>
          </div></br>


          <div style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 36px;">
          <div style="text-align:justify;">

			This is to certify that <b>
			<? if($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Married") { ?>
              Mrs.
			  <?  }elseif($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Unmarried"){?>
              Ms.
              <?  }else{?>
              Mr.
              <? } ?> <?=$paySlip->PBI_NAME;?>, ID: <?=$paySlip->PBI_CODE;?></b> is working with<b>
				AKSID Corporation Limited</b> from <?=date('F j, Y',strtotime($paySlip->PBI_DOJ))?> to till now as  <b>“<?=$paySlip->designation;?>”</b>.
			  <?if($paySlip->PBI_SEX=="Female"){?> She <?}else{  ?> He <? } ?> is a permanent associate of this company.
			</div>

		  </br>
		  <div style="text-align:justify;">
		  <b><? if($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Married") { ?>
              Mrs.
			  <?  }elseif($paySlip->PBI_SEX=="Female" && $paySlip->PBI_MARITAL_STA=="Unmarried"){?>
              Ms.

              <?  }else{?>
              Mr.<? } ?> <?=$paySlip->PBI_NAME;?></b>, besides having a pleasing personality, bears a good moral character and
			  <?if($paySlip->PBI_SEX=="Female"){?> she <?}else{  ?> he <? } ?>is relentlessly working to the satisfaction of the management.
			  </div>
			  </br>

			  <div style="text-align:justify;">
               We wish <?if($paySlip->PBI_SEX=="Female"){?> her <?}else{  ?> him <? } ?>every success in the days to come.
			  </div>

			</div>
      </div>

  <? }  ?>



			<br>

			<br>
			<br>
			<br>
        <div>
          <tr>
            <td>___________________________________________</td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;"><b>Mohammad Tanvir Gias</b></strong></td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;">Senior Manager, HR</strong></td>
          </tr>
        </div>
        <br>
        <br>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</div>
</body>
</html>
<!-- end new style -->
<? } ?>


<!-- **************  Experience Certificate End ************************  -->











<!-- **************  NEW Salary certificate start ************************  -->
<?

} if($_POST['report']==5312021)





{

if($_POST['id_no']!=''){

$PBI_ID = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['id_no'].'"');
$pay_con = ' and s.PBI_ID="'.$PBI_ID.'"'; }
//if($_POST['mon']!=''){
//$pay_con .= ' and s.mon="'.$_POST['mon'].'"';}
//if($_POST['year']!=''){ $pay_con .= ' and s.year="'.$_POST['year'].'"';  }


if($_POST['department']!=''){$pay_con .= ' and s.department="'.$_POST['department'].'"';}
if($_POST['job_status']!=''){ $pay_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"'; }

 $pay = 'select s.*,p.PBI_ID,p.PBI_CODE,p.PBI_SEX,p.PBI_DOJ,p.PBI_NAME,(select DESG_DESC from designation where DESG_ID=s.designation) as designation,
(select DEPT_DESC from department where DEPT_ID=s.department) as department,p.PBI_MARITAL_STA as marital_status,
(select PROJECT_DESC from project where PROJECT_ID=s.job_location) as project,s.bank_or_cash
from salary_attendence s,personnel_basic_info p where
s.PBI_ID=p.PBI_ID '.$pay_con.' order by s.id desc LIMIT 1 ';
$qry = mysql_query($pay);
while($paySlip = mysql_fetch_object($qry)){

	//$fiscal_year = explode("-",$_POST['year']);
  //$year_1 = $fiscal_year[0]-1;
  //$year_2 = $fiscal_year[1]-1;
//  $f_date = $year_1.'-07-01';
  //$t_date = $year_2.'-06-30';



	if($paySlip->PBI_SEX=='Male'){
	$MrMs = 'Mr.';
	$HisHer = 'his';
	}elseif($paySlip->PBI_SEX=='Female'){
	if($paySlip->marital_status=='Married'){
	$MrMs = 'Mrs.';
	$HisHer = 'her';
	}else{
	$MrMs = 'Ms.';
	$HisHer = 'her';
	}}





?>

<!-- new style -->

		<table width="600" align="center" border="0" style="font-family:Cambria;">
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr style="margin-top:20px;">
		    <td style="border:0px;" align="left" ><span style="font-size:14px; font-weight:bold;"><?=date("l, F j, Y");?></span></td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="border:0px;" align="center" ><span style="font-size:18px; font-weight:bold; text-decoration:underline;">LETTER OF INTRODUCTION</span></td>
		  </tr>
		  <tr>
		    <td style="border:0px;">&nbsp;</td>
		  </tr>
		  <tr>
		    <?
				//echo $reg_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','ESSENTIAL_RESIG_DATE between "'.$f_date.'" and  "'.$t_date.'" and
				//PBI_ID="'.$paySlip->PBI_ID.'"');

				 $reg_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','PBI_ID="'.$paySlip->PBI_ID.'"');

			   if($reg_date >0){

			  ?>
		    <td style="border:0px; font-size:16px; font-family:Cambria; text-align:justify;" align="left" >This is to certify that<strong>
		      <?=$MrMs?>
		      <?=$paySlip->PBI_NAME?>,
				  <?=$paySlip->designation?>
				</strong>had been in employment with the<strong> AKSID Corporation Limited</strong> from
		      <?=date('F d, Y',strtotime($paySlip->PBI_DOJ))?>
		      to
		      <?=date('F d, Y',strtotime($reg_date))?>.
					<?if($paySlip->PBI_SEX=="Female"){?>
						She
						<?}else{  ?>
						He
					<? } ?> was a permanent employee of the company. <br><br>

					<strong>
					 <?if($paySlip->PBI_SEX=="Female"){?>
							 Her
							 <?}else{  ?>
							 His
						<? } ?> Monthly salary structure is as follows:</strong></td>

		    <? }else{ ?>
		    <td style="border:0px; font-size:16px; font-family:Cambria; text-align:justify;" align="left" >This is to certify that<strong>
		      <?=$MrMs?>
		      <?=$paySlip->PBI_NAME?>,
		      <?=$paySlip->designation?>,
					ID:<?=$paySlip->PBI_CODE;?></b>
		      </strong>has been in employment with the<strong> AKSID Corporation Limited</strong> since
		      <?=date('F d, Y',strtotime($paySlip->PBI_DOJ))?>.

					<?if($paySlip->PBI_SEX=="Female"){?>
						She
						<?}else{  ?>
						He
					<? } ?> is a permanent employee of the company. <br><br>

						<strong>
		 				 <?if($paySlip->PBI_SEX=="Female"){?>
		             Her
		             <?}else{  ?>
		             His
		 					<? } ?> Monthly salary structure is as follows:</strong>

		      </td>
		    <? }  ?>
		  </tr> <br>

			<tr>
			 <td style="border:0px;">&nbsp;</td>
		 </tr>


		</table>
		<table width="600" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:14px; font-family:Cambria;" id="grp">
		  <thead>
		    <tr style="background:#ccc;">
		      <td style="width:80%; text-align:center;"><strong>Description</strong></td>
		      <td style="width:20%;" align="right"><strong>Amount (BDT)</strong></td>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
		      <td>Basic Salary</td>
		      <td colspan="3" align="right"><?=number_format($paySlip->basic_salary);?></td>

		    </tr>
		    <tr>
		      <td>House Allowance</td>
		      <td colspan="3" align="right"><?=number_format($paySlip->house_rent);?></td>
		    </tr>
		    <tr>
		      <td>Medical Allowance</td>
		      <td colspan="3" align="right"><?=number_format($paySlip->medical_allowance);?></td>
		    </tr>
		    <tr>
		      <td>Conveyance</td>
		      <td colspan="3" align="right"><?=number_format($paySlip->special_allowance);?></td>
		    </tr>

		    <tr style="background:#ccc;">
		      <td><strong>Gross Total</strong></td>
		      <td colspan="3" align="right"><strong>
		        <?=number_format($paySlip->gross_salary);?>
		        </strong></td>
		    </tr>

		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>


				<tr>
		      <td style="border:0px;font-size:16px; font-family:Cambria; "><b>In words : </b><? echo convertNumberMhafuz($paySlip->gross_salary);?></p></td>
		    </tr>

				<tr>
					 <? if($paySlip->bank_or_cash==5){ ?>
		      <td style="border:0px;font-size:16px; font-family:Cambria; "><b>Note:</b> Bank Account ( <?=$paySlip->cash;?> ) <?=number_format($paySlip->bank_amt);?> BDT  <br>
						&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; Cash Amount BDT <?=number_format($paySlip->cash_amt);?> </p></td>
				<? }elseif ($paySlip->bank_or_cash==2) { ?>
					 <td style="border:0px;font-size:16px; font-family:Cambria; "><b>Note:</b> Bank Account ( <?=$paySlip->cash;?> ) <?=number_format($paySlip->gross_salary);?> BDT </p></td>
				<? }else{} ?>
		    </tr>






		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td colspan="2" style="border:0px; font-size:16px; font-family:Cambria; text-align:justify" align="left">This certificate has been issued at the request
						 from<strong>
		        <?=$MrMs?>
		        <?=$paySlip->PBI_NAME?>.
		        </strong></td>
		    </tr>
		    <tr>
		      <td style="border:0px;text-align:justify; font-size:16px;">For any further clarification, please contact to the undersigned.</td>
		    </tr>
		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="border:0px; font-size:16px;">Thanking You,</td>
		    </tr>
		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="border:0px;">______________________________________
		        <!--<img src="../../pic/signature/210.jpg" style="width:20%;">--></td>
		    </tr>
		    <tr>
		      <td style="border:0px;  font-size:16px;">Mohammad Tanvir Gias</td>
		    </tr>
		    <tr>
		      <td style="border:0px; font-size:16px;"><? $desg_id = find_a_field('personnel_basic_info','PBI_DESIGNATION','PBI_ID=101656');$desg_name = find_a_field('designation','DESG_DESC','DESG_ID="'.$desg_id.'"'); echo $desg_name?></td>
		    </tr>
		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="border:0px;">&nbsp;</td>
		    </tr>
		  </tbody>
		</table>
		</div>



<!-- end new style -->
<? } ?>
<!-- **********   END  NEW Salary certificate END  **************** -->
<!-- ************** Tax  Salary certificate start ************************  -->
<?




}  if($_POST['report']==5312029) {
if($_POST['id_no']!=''){
$PBI_ID = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['id_no'].'"');
$pay_con = ' and p.PBI_ID="'.$PBI_ID.'"';
}

$pay = 'select s.*,p.PBI_NAME,p.PBI_CODE,p.PBI_EMAIL,p.PBI_ID,p.ESSENTIAL_TIN_NO as PBI_TIN_NO,p.PBI_SEX,p.PBI_MARITAL_STA as marital_status,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation, p.PBI_DOJ as joining_date,s.cash_bank

from salary_info s,personnel_basic_info p where s.PBI_ID=p.PBI_ID '.$pay_con.' ';

$qry = mysql_query($pay);
$salary_certificate = mysql_fetch_object($qry);

if($_POST['tax_calculate_type']!=''){
$calculate_type = $_POST['tax_calculate_type'];
if($calculate_type=='Assessment Year'){



$fiscal_year = explode("-",$_POST['financial_year']);
$year_1 = $fiscal_year[0]-1;
$year_2 = $fiscal_year[1]-1;
$f_date = $year_1.'-07-01';
$t_date = $year_2.'-06-30';

//Assesment Year
$assesment_start_year = $fiscal_year[0];
$assesment_end_year = $fiscal_year[1];




//TAX INVESMENT AMOUNT


  $sqldd = 'select t.PBI_ID,
sum(t.jan_com) as jan_com,sum(t.feb_com) as feb_com,sum(t.mar_com) as mar_com,sum(t.apr_com) as apr_com,sum(t.may_com) as may_com,
sum(t.jun_com) as jun_com,
sum(t.jul_com) as jul_com,sum(t.aug_com) as aug_com,sum(t.sep_com) as sep_com,sum(t.oct_com) as oct_com,sum(t.nov_com) as nov_com,
sum(t.dec_com) as dec_com,sum(t.special_consideration) as special_consideration,
sum(t.tax_deduction) as tax_deduction,sum(t.advance_deduction) as advance_deduction

from
monthly_sales_commission t

where
t.PBI_ID="'.$salary_certificate->PBI_ID.'" and
t.financial_year between "'.$f_date.'" and  "'.$t_date.'"
group by t.PBI_ID';

$querydd=mysql_query($sqldd);


while($conData = mysql_fetch_object($querydd)){

 $net_convaince = $conData->jan_com+$conData->feb_com+$conData->mar_com+$conData->apr_com+$conData->may_com+$conData->jun_com+$conData->jul_com+
$conData->aug_com+$conData->sep_com+$conData->oct_com+$conData->nov_com+$conData->dec_com+$conData->special_consideration;

//$net_deduction = $conData->tax_deduction+$conData->advance_deduction;
//$net_payment = $net_convaince-$net_deduction;
 //$total_payment = $total_payment+$net_payment;
}

//END TAX INVESMENT AMOUNT







    $sql_1 = 'select sum(basic_salary) as basic_salary,sum(house_rent) as house_rent,sum(medical_allowance) as medical_allowance, sum(special_allowance) as conveyance_allowance,
sum(food_allowance) as arrear, sum(income_tax) as income_tax,bank_or_cash,sum(bank_amt) as bank_amt from salary_attendence
where salary_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"';



$year_1_salary = mysql_query($sql_1);



 $year_1_data = mysql_fetch_object($year_1_salary);

 $salary_given_status= $salary_certificate->cash_bank;


  $bonus_1 = find_a_field('salary_bonus','sum(bonus_amt)','bonus_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');

 $bonus_1_for_status_5 = find_a_field('salary_bonus','sum(bank_paid)','bonus_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');

 $total_tax_amt = find_a_field('emp_taxchalan_no','sum(chalan_amt)','chalan_start_date>="'.$f_date.'" and chalan_end_date<="'.$t_date.'" and
PBI_ID="'.$salary_certificate->PBI_ID.'"');

$other_allowances = find_a_field('monthly_addition_deduction','sum(consolidated+mobile_allowance)','tr_date between "'.$f_date.'" and  "'.$t_date.'" and
PBI_ID="'.$salary_certificate->PBI_ID.'"');

$monthName_1 = 'July';
$monthName_2 = 'June';



}elseif($calculate_type=='Date'){


$year_1 = date('Y',strtotime($_POST['f_date']));
$year_2 = date('Y',strtotime($_POST['t_date']));
$mon_1 = date('m',strtotime($_POST['f_date']));
$mon_2 = date('m',strtotime($_POST['t_date']));
echo $f_date = $_POST['f_date'];
$t_date = $_POST['t_date'];

 $sql_1 = 'select sum(basic_salary) as basic_salary,sum(house_rent) as house_rent,sum(medical_allowance) as medical_allowance,
 sum(special_allowance) as conveyance_allowance,
sum(salary_arrear) as arrear, sum(pf_deduction) as pf, sum(income_tax) as income_tax,bank_or_cash
from salary_attendence where salary_date between "'.$f_date.'" and  "'.$t_date.'" and
PBI_ID="'.$salary_certificate->PBI_ID.'"';

$year_1_salary = mysql_query($sql_1);
$year_1_data = mysql_fetch_object($year_1_salary);

//$salary_given_status= $year_1_data->bank_or_cash; //find_a_field('salary_attendence','bank_or_cash','year="'.$assesment_end_year.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');

$bonus_1 = find_a_field('salary_bonus','sum(bonus_amt)','bonus_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');

$other_allowances = find_a_field('monthly_addition_deduction','sum(consolidated+mobile_allowance)','tr_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');


$monthNum  = $mon_1;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName_1 = $dateObj->format('F');
$monthNum  = $mon_2;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName_2 = $dateObj->format('F');

}

}



if($salary_given_status==5){

	$total_basic = $year_1_data->bank_amt/100*50;
	$total_house = $year_1_data->bank_amt/100*25;
	$total_medical = $year_1_data->bank_amt/100*15;
	$total_conveyance = $year_1_data->bank_amt/100*10;
	$total_bonus = $bonus_1_for_status_5;
}else{

	$total_basic = $year_1_data->basic_salary;
	$total_house = $year_1_data->house_rent;
	$total_medical = $year_1_data->medical_allowance;
	$total_conveyance = $year_1_data->conveyance_allowance;
	$total_bonus = $bonus_1;

}


$total_arrear = $year_1_data->arrear;
$total_pf = $year_1_data->pf;
$total_tax = $year_1_data->income_tax;
$total_other_allowance = $other_allowances;
$total_gross = $total_basic+$total_house+$total_medical+$total_conveyance+$total_arrear+$total_pf+$total_bonus+$total_other_allowance;



if($salary_certificate->PBI_SEX=='Male'){
$MrMs = 'Mr.';
$HisHer = 'his';
}elseif($salary_certificate->PBI_SEX=='Female'){

if($salary_certificate->marital_status=='Married'){
$MrMs = 'Mrs.';
$HisHer = 'her';
}else{
$MrMs = 'Ms.';
$HisHer = 'her';
}



}







?>
<table width="600" align="center" border="0" style="font-family:Cambria;">
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr style="margin-top:20px;">
    <td style="border:0px;" align="right" ><span style="font-size:14px; font-weight:bold;">Date :
      <?=$test = date('d M Y');?>
      </span></td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="border:0px;" align="center" ><span style="font-size:18px; font-weight:bold; text-decoration:underline;">LETTER OF INTRODUCTION</span></td>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <?  $reg_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','
		ESSENTIAL_RESIG_DATE between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');



	   if($reg_date >0){

	  ?>
    <td style="border:0px; font-size:16px; font-family:Cambria; text-align:justify;" align="left" >This is to certify that<strong>
      <?=$MrMs?>
      <?=$salary_certificate->PBI_NAME?>, TIN:
      <?=$salary_certificate->PBI_TIN_NO?>,
      <?=$salary_certificate->designation?>
      </strong>had been employed with the<strong> AKSID Corporation Limited</strong> from
      <?=date('F d, Y',strtotime($salary_certificate->joining_date))?>
      to
      <?=date('F d, Y',strtotime($reg_date))?>
      and
      <?=$HisHer?>
      remuneration during the year
      <?=$monthName_1.' 01, '.$year_1?>
      to
      <?=$monthName_2.' 30, '.$year_2?>
      are shown below:</td>
    <? }else{ ?>
    <td style="border:0px; font-size:16px; font-family:Cambria; text-align:justify;" align="left" >This is to certify that<strong>
      <?=$MrMs?>
      <?=$salary_certificate->PBI_NAME?>, TIN:
      <?=$salary_certificate->PBI_TIN_NO?>,
      <?=$salary_certificate->designation?>
      </strong>has been in employment with the<strong> AKSID Corporation Limited</strong> since
      <?=date('F d, Y',strtotime($salary_certificate->joining_date))?>
      and
      <?=$HisHer?>
      remuneration during the year
      <?=$monthName_1.' 01, '.$year_1?>
      to
      <?=$monthName_2.' 30, '.$year_2?>
      are shown below:</td>
    <? }  ?>
  </tr>
  <tr>
    <td style="border:0px;">&nbsp;</td>
  </tr>
  <!--<tr>



    <td style="border:0px;"><button id="print" onClick="hide(),window.print();" style="width:100px; height:20px; font-size:14px; font-weight:bold">PRINT/PDF</button></td>



   </tr>-->
</table>
<table width="600" border="1" cellpadding="0" cellspacing="0" align="center" style="font-size:14px; font-family:Cambria;" id="grp">
  <thead>
    <tr style="background:#ccc;">
      <td style="width:80%; text-align:center;"><strong>Description</strong></td>
      <td style="width:20%;" align="right"><strong>Amount (BDT)</strong></td>
    </tr>
  </thead>



  <tbody>
    <tr>
      <td>Basic Salary</td>
      <td colspan="3" align="right"><?=number_format($total_basic,0)?></td>
    </tr>
    <tr>
      <td>House Allowance</td>
      <td colspan="3" align="right"><?=number_format($total_house,0)?></td>
    </tr>
    <tr>
      <td>Medical Allowance</td>
      <td colspan="3" align="right"><?=number_format($total_medical,0)?></td>
    </tr>
    <tr>
      <td>Conveyance</td>
      <td colspan="3" align="right"><?=number_format($total_conveyance,0)?></td>
    </tr>
    <tr>
      <td>Bonus</td>
      <td colspan="3" align="right"><?=number_format($total_bonus,0)?></td>
    </tr>


   <? if($net_convaince>0) { ?>
    <tr>
      <td>Total Incentive</td>
      <td colspan="3" align="right"><?=number_format($net_convaince,0);?></td>
    </tr>
     <?   } ?>

    <tr style="background:#ccc;">
      <td><strong>Gross Total</strong></td>
      <td colspan="3" align="right"><strong>
        <?=number_format($total_gross+$net_convaince,0)?>
        </strong></td>
    </tr>


    <? if($total_tax>0 || $total_tax_amt>0){?>
    <tr>
      <td colspan="2" style="border:0px;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="border:0px; font-size:16px; font-family:Cambria; text-align:justify" align="left" >We hereby also certify that the amount of BDT<strong>
        <?=number_format(find_a_field('emp_taxchalan_no','sum(chalan_amt)','PBI_ID="'.$salary_certificate->PBI_ID.'" and assesment_s_year="'.$assesment_start_year.'" and assesment_e_year="'.$assesment_end_year.'"'),2)?>
        </strong>was duly deducted at source on monthly basis considering the actual investment under the Income Tax Law and deposited through Treasury Challan(s) along with all employee’s tax liability as mentioned below:</td>
    </tr>
    <? } ?>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
    <? if($total_tax>0 || $total_tax_amt>0){?>
    <tr>
      <td colspan="4" style="border:0px;"><table width="100%" border="1" cellpadding="0" cellspacing="0" style="font-size:14px; font-family:cambria;">
          <tr style="background:#ccc; height:30px;">
            <td width="10%" align="center"><strong>SL</strong></td>
            <td width="25%" align="center"><strong>Challan Number</strong></td>
            <td width="25%" align="center"><strong>Challan Date</strong></td>
            <td width="25%" align="center"><strong>Amount (BDT)</strong></td>
          </tr>
          <?



	  $tsql = 'select * from emp_taxchalan_no where assesment_s_year="'.$assesment_start_year.'" and assesment_e_year="'.$assesment_end_year.'" and
		PBI_ID="'.$salary_certificate->PBI_ID.'" order by chalan_start_date';



	  $tqr = mysql_query($tsql);



	  while($tdata1 = mysql_fetch_object($tqr)){





	?>
          <tr style="height:30px;">
            <td align="center"><?=++$k;



		/*$monthNum  = $tdata1->s_mon;



        $dateObj   = DateTime::createFromFormat('!m', $monthNum);



        $monthName = $dateObj->format('F');



		echo $monthName.'-'.$tdata1->s_year*/;



		?></td>
            <td align="center"><?=$tdata1->tax_chalan_no?></td>
            <td align="center"><?=date('d-M-Y',strtotime($tdata1->chalan_start_date))?></td>
            <td align="right"><?=number_format($tdata1->chalan_amt,2)?></td>
          </tr>
          <? } ?>
        </table></td>
    </tr>
    <? } ?>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="border:0px; font-size:16px; font-family:Cambria; text-align:justify" align="left" >This certificate has been issued at the request from<strong>
        <?=$MrMs?>
        <?=$salary_certificate->PBI_NAME?>
        </strong></td>
    </tr>
    <tr>
      <td style="border:0px;text-align:justify; font-size:16px;">For any further clarification, please contact to the undersigned.</td>
    </tr>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border:0px; font-size:16px;">Thanking You,</td>
    </tr>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>


	  <? if ($salary_certificate->PBI_ID==101656) { ?>
			<tr>
				<td style="border:0px;">_________________________
					<!--<img src="../../pic/signature/210.jpg" style="width:20%;">--></td>
			</tr>

			<tr>
        <td style="border:0px;  font-size:16px;">Arsh Anwar</td>
      </tr>
      <tr>
        <td style="border:0px; font-size:16px;"><? $desg_id = find_a_field('personnel_basic_info','PBI_DESIGNATION','PBI_ID=921638');$desg_name = find_a_field('designation','DESG_DESC','DESG_ID="'.$desg_id.'"'); echo $desg_name?></td>
      </tr>

		<? }else {  ?>

			<tr>
				<td style="border:0px;">______________________________________
					<!--<img src="../../pic/signature/210.jpg" style="width:20%;">--></td>
			</tr>

    <tr>
      <td style="border:0px;  font-size:16px;">Mohammad Tanvir Gias</td>
    </tr>
    <tr>
      <td style="border:0px; font-size:16px;"><? $desg_id = find_a_field('personnel_basic_info','PBI_DESIGNATION','PBI_ID=101656');$desg_name = find_a_field('designation','DESG_DESC','DESG_ID="'.$desg_id.'"'); echo $desg_name?></td>
    </tr>

  	<?  } ?>

    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
    <tr>
      <td style="border:0px;">&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
<!-- <div style="width:100px"><? //include('PrintFormat.php');?></div>



  <div id="reporting">



  <table cellspacing="0" cellpadding="0" border="0" id="grp" width="100%">



   <thead>



  <tr>



  <td style="border:0px;">&nbsp;</td>



  </tr>



  </thead>



  </table>



</div>-->









<? //



}











 if($_POST['report']==5312022)















{















//$sqll='select * from salary_attendence where year=2021';







//$qr = mysql_query($sqll);







//while($dt=mysql_fetch_object($qr)){







//$date = $dt->year.'-'.$dt->mon.'-01';







//$update = 'update salary_attendence set salary_date="'.$date.'" where mon="'.$dt->mon.'" and year="'.$dt->year.'"';







//mysql_query($update);







//}























  if($_POST['id_no']!=''){







  $pay_con = ' and s.PBI_ID="'.$_POST['id_no'].'"'; }















        $this_year = $_POST['year'];







        $this_mon  = $_POST['mon'];























        $next_year = $_POST['year']-1;







        $increment_start_date = $next_year.'-07-01';







        $increment_end_date = $this_year.'-06-30';











        $check_increment=find_a_field('increment_detail','INCREMENT_D_ID','PBI_ID="'.$_POST['id_no'].'" and INCREMENT_EFFECT_DATE between "'.$increment_start_date.'" and "'.$increment_end_date.'"');







        //$check_increment=find_a_field('increment_detail','INCREMENT_D_ID','PBI_ID="'.$_POST['id_no'].'"');















        if($check_increment>0)















        {































       $pay = 'select s.*, p.PBI_ID,p.PBI_DOJ,p.PBI_NAME,p.PBI_SEX,p.PBI_DESIGNATION,(select INCREMENT_EFFECT_DATE from increment_detail where INCREMENT_EFFECT_DATE=s.salary_date and PBI_ID=s.PBI_ID) as inc_date from personnel_basic_info p,salary_attendence s where







       s.salary_date between "'.$increment_start_date.'" and "'.$increment_end_date.'" and s.PBI_ID=p.PBI_ID '.$pay_con.' group by s.gross_salary order by s.id asc';







       $qry = mysql_query($pay);







       $count = mysql_num_rows($qry);







       $max_row=find_a_field('increment_detail','max(INCREMENT_D_ID)','PBI_ID="'.$_POST['id_no'].'" and INCREMENT_EFFECT_DATE between "'.$increment_start_date.'" and "'.$increment_end_date.'"');







	   $min_row=find_a_field('increment_detail','min(INCREMENT_D_ID)','PBI_ID="'.$_POST['id_no'].'" and INCREMENT_EFFECT_DATE between "'.$increment_start_date.'" and "'.$increment_end_date.'"');







	   /*if($count>1){*/







       $date1 = $next_year.'-07-01';



	   $date_last = $this_year.'-06-30';



       $resign_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','PBI_ID="'.$_POST['id_no'].'"');



	   if($resign_date!='0000-00-00' && $date_last>$resign_date){



	   $date_last = $resign_date;



	   }else{



	   $date_last = $this_year.'-06-30';



	   }







	   $start_mon = 7;







	   $begin = 0;







  while($paySlip = mysql_fetch_object($qry)){







	    $total_rows++;







		$increment_year = $paySlip->year;







        $increment_month = $paySlip->mon;







        $salary_date= $salary_year.'-'.$salary_month;







        $salary_mon = $paySlip->mon;







        $salary_year = $paySlip->year;







		$salary_all = find_all_field('salary_attendence','','PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"');























		if($salary_all->gross_salary>$old_gross){







	    $old_gross = $salary_all->gross_salary;







		$inc_id = find_a_field('increment_detail','min(INCREMENT_D_ID)','PBI_ID="'.$_POST['id_no'].'" and INCREMENT_EFFECT_DATE between "'.$increment_start_date.'" and "'.$increment_end_date.'" and INCREMENT_D_ID>"'.$begin.'"');















		$inc_all = find_all_field('increment_detail','','INCREMENT_D_ID="'.$inc_id.'"');















      $fmonthName =  date('F',strtotime($salary_year.'-'.$start_mon.'-01'));







	  $fyear = $salary_year;// date('Y',strtotime($increment_start_date));







	  $bonus_s_date = $salary_year.'-'.$start_mon.'-01';







	  if($inc_id>0){







	  $tomonthName = date('F',strtotime("$inc_all->INCREMENT_EFFECT_DATE-1 month"));







	  $toYear = date('Y',strtotime($inc_all->INCREMENT_EFFECT_DATE));







	  $ts1 = strtotime($salary_year.'-'.$start_mon.'-01');







      $ts2 = strtotime($inc_all->INCREMENT_EFFECT_DATE);







	  $bonus_e_date = date('Y-m-30',strtotime("$inc_all->INCREMENT_EFFECT_DATE-1 month"));







	  }else{



     echo $date_last;



	  $tomonthName = date('F',strtotime($date_last));







	  $toYear = date('Y',strtotime($date_last));







	  $ts1 = strtotime($salary_year.'-'.$start_mon.'-01');







      $ts2 = strtotime("$date_last+ 1 months");







	  $bonus_e_date = $bonus_e_date = date('Y-m-30',strtotime($date_last));







	  }











      $year1 = date('Y', $ts1);







      $year2 = date('Y', $ts2);















      $month1 = date('m', $ts1);







      $month2 = date('m', $ts2);















      $diffff = (($year2 - $year1) * 12) + ($month2 - $month1);























       $start_mon = date('n',strtotime($inc_all->INCREMENT_EFFECT_DATE));;







        // echo 'select * from salary_attendnece where PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"';







       $begin = $inc_id;











          $tot_bonuss = find_a_field('salary_bonus_lock','sum(bonus_amt)','PBI_ID="'.$salary_all->PBI_ID.'" and cut_off_date between "'.$bonus_s_date.'" and "'.$bonus_e_date.'"');











			 $tax=find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$paySlip->PBI_ID.'"  and salary_date between "'.$bonus_s_date.'" and "'.$bonus_e_date.'"');















      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div width="60%"> <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-lg-10">
        <div>
          <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Ref: AK/HR/SC/
            <?=date("M-j");?>
          </h3>
          <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">
            <?=date("l, F j, Y");?>
          </h3>
        </div>
        </br>
        </br>
        </br>
        </br>
        <br>
        <br>
        <main>
        <div id="details" class="clearfix">
          <div>
            <h2 style="font-family: Cambria, Georgia, serif; font-size: 29px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">
              <center>
              LETTER OF INTRODUCTION
              <hr >
              <center>
            </h2>
          </div>
          <div style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 45px;">
            <div style="text-align:justify;">This is to certify that <b>
              <? if($paySlip->PBI_SEX=="Female") { ?>
              Mrs.
              <?  }else{?>
              Mr.
              <? } ?>
              <?=$paySlip->PBI_NAME;?>
              , “
              <?=find_a_field('designation','DESG_DESC','DESG_ID="'.$paySlip->PBI_DESIGNATION.'"');?>
              ”















              of AKSID Corporation Limited.</b> The Company paid his  remuneration from
              <?















            echo $fmonthName;







            echo " ";







            echo $fyear;







            ?>
              To
              <?















            echo $tomonthName;







            echo " ";







            echo $toYear;















            ?>
              BDT <b>
              <?=number_format(($salary_all->gross_salary*$diffff)+$tot_bonuss);?>
              </b> (
              <?=convertNumberMhafuz(($salary_all->gross_salary*$diffff)+$tot_bonuss);?>
              ) as per following breakup. </div>
          </div>
        </div>
        <br>
        <div>
          <h4 style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">His monthly remuneration structure is as follows:</h4>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-borderless table-sm" style="font-family: Cambria, Georgia, serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 24px;">
              <tbody>
                <tr>
                  <td>Monthly Basic</td>
                  <td>50% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($salary_all->basic_salary,2);?></td>
                  <td>x</td>
                  <td><?=$diffff?>
                    = </td>
                  <td align="right"><?=number_format($salary_all->basic_salary*$diffff,2);?></td>
                </tr>
                <tr>
                  <td>House Rent</td>
                  <td>25% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($salary_all->house_rent,2);?></td>
                  <td>x</td>
                  <td><?=$diffff?>
                    = </td>
                  <td align="right"><?=number_format($salary_all->house_rent*$diffff,2);?></td>
                </tr>
                <tr>
                  <td>Medical Allowance</td>
                  <td>15% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($salary_all->medical_allowance,2);?></td>
                  <td>x</td>
                  <td><?=$diffff?>
                    = </td>
                  <td align="right"><?=number_format($salary_all->medical_allowance*$diffff,2);?></td>
                </tr>
                <tr >
                  <td>Conveyance Allowance</td>
                  <td>10% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($salary_all->special_allowance,2);?></td>
                  <td>x</td>
                  <td><?=$diffff?>
                    = </td>
                  <td align="right"><?=number_format($salary_all->special_allowance*$diffff,2);?></td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding: 10px 0;







      margin-bottom: 22px;">
                  <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding:10px 0;margin-bottom:22px;font-weight:bold;">
                  <td>Monthly Gross</td>
                  <td>100%:</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($salary_all->gross_salary,2);?></td>
                  <td>x</td>
                  <td><?=$diffff?>
                    = </td>
                  <td align="right"><?=number_format($salary_all->gross_salary*$diffff,2);?></td>
                </tr>
                <tr>
                  <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                  <td><? echo $fmonthName; echo"-"; echo $fyear; ?> To
                    <?  echo $tomonthName; echo"-";  echo $toYear; ?>
                    Paid Total BDT</td>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>=</td>
                  <td align="right"><b>
                    <?=number_format($salary_all->gross_salary*$diffff,2);?>
                    </b></td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding: 10px 0;margin-bottom: 22px;">
                  <td>Festival Allowances Paid BDT</td>
                  <td></td>
                  <td></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>=</td>
                  <td align="right"><b>
                    <?=number_format($bonus= find_a_field('salary_bonus','sum(bonus_amt)','PBI_ID="'.$salary_all->PBI_ID.'" and cut_off_date between "'.$bonus_s_date.'" and "'.$bonus_e_date.'"'),2);?>
                    </b></td>
                </tr>
                <tr style="padding:10px 0;margin-bottom:22px;font-weight:bold;">
                  <td>Total Paid</td>
                  <td>:</td>
                  <td>BDT.</td>
                  <td></td>
                  <td></td>
                  <td>=</td>
                  <td align="right"><?=number_format($salary_all->gross_salary*$diffff+$bonus,2);?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </br>
        <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;"> <b>In words : </b><? echo convertNumberMhafuz($salary_all->gross_salary*$diffff+$bonus);?>.</p>
        <? $tax_chalan_amt=find_a_field('emp_taxchalan_no','sum(chalan_amt)','PBI_ID="'.$paySlip->PBI_ID.'" and chalan_end_date between "'.$bonus_s_date.'" and "'.$bonus_e_date.'"');







	    if($tax_chalan_amt!=''){







      ?>
        <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height:30px; text-align:justify;"> We Certify that BDT
          <?=number_format($tax_chalan_amt/*$tax*$diffff*/);?>
          is deducted and submitted as TDS from his remuneration







          through <b>challan no:
          <?







	   $tax_sql = 'select * from emp_taxchalan_no where PBI_ID="'.$paySlip->PBI_ID.'" and chalan_end_date between "'.$bonus_s_date.'" and "'.$bonus_e_date.'" ';







      $tax_qry = mysql_query($tax_sql);







	  while($tax_data = mysql_fetch_object($tax_qry)){







	   $t++;







	  if($t>1){







      echo ', ';







	  }







      echo $tax_data->tax_chalan_no;























	   } $t=0; } ?>
          </b></p>
        <footer style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px;"> This certificate has been issued at the request from <b>
          <? if($paySlip->PBI_SEX=="Female") { ?>
          Mrs.
          <?  }else{?>
          Mr.
          <? } ?>
          <?=$paySlip->PBI_NAME;?>
          .</b></br>
          <br>
          For any further clarification, please contact to the undersigned. </footer>
        <br>
        <br>
        <br>
        <div id="thanks" style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 22px;">Thanking You,</div>
        <br>
        <br>
        <br>
        <br>
        <div>
          <tr>
            <td>----------------------------------------</td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Mohammad Tanvir Gias</strong></td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;">Manager, HR</strong></td>
            <br>
            </td>
          </tr>
        </div>
        <br>
        <br>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</div>
<br />
<br />
</body>
</html>
<!-- end new style -->
<? } }







  /*}else{  $total_rows = $count+1;







       while($paySlip = mysql_fetch_object($qry)){







































             $increment_year = date('Y', strtotime($paySlip->INCREMENT_EFFECT_DATE));







             $increment_month = date("m",strtotime($paySlip->INCREMENT_EFFECT_DATE));























              ////////////  dynamic date /////////////////







              $salary_month = $paySlip->mon;







              $salary_year  = $paySlip->year;







              $salary_date = $salary_year.'-'.$salary_month;















              //$date1 = $next_year.'-06-30';







              //$date2 = $increment_year.'-'.$increment_month.'-01';























                $date1 = $next_year.'-07-01';







                $date2 = $increment_year.'-'.$increment_month.'-01';















               $salary_mon = $this_mon;







               $salary_year = $next_year;







               $pbi_id = $paySlip->PBI_ID;















      for($i=1; $i<=$total_rows; $i++){







	  echo 'bimol';















      $salary_all = find_all_field('salary_attendence','','PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"');







     echo 'select * from salary_attendnece where PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"';















     // $salary_bonus_amt = find_all_field('salary_bonus','','PBI_ID="'.$salary_all->PBI_ID.'" and cut_off_date between "'.$increment_start_date.'" and "'.$increment_end_date.'"');















      $tax=find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"');































      $salary_mon = $increment_month;







       $salary_year = $increment_year;















      $ts1 = strtotime($date1);







      $ts2 = strtotime($date2);















      $year1 = date('Y', $ts1);







      $year2 = date('Y', $ts2);















      $month1 = date('m', $ts1);







      $month2 = date('m', $ts2);















      $diffff = (($year2 - $year1) * 12) + ($month2 - $month1);























      $date1 = $increment_year.'-'.$increment_month.'-01';







      //echo "<br>" ;







      $date2 = $this_year.'-07-01';















      //date for front







      $date11 = date("m", strtotime("$date1-1 months"));







      $date22 = $this_year.'-06-30';























        if($salary_all->year==$next_year){















             $monthname = date('m', strtotime($increment_start_date));







             $month_name = date("F", mktime(0, 0, 0, $monthname, 10));















             $yearname = date("Y",strtotime($increment_start_date));







			}else{















			 $monthname = date('m', strtotime($date1));















             $month_name = date("F", mktime(0, 0, 0, $monthname, 10));















             $yearname = date("Y",strtotime($date1));







			}































         $new_mon_year =$monthname.$yearname;







		if($new_mon_year!=200){















        // echo 'select * from salary_attendnece where PBI_ID="'.$paySlip->PBI_ID.'" and mon="'.$salary_mon.'" and year="'.$salary_year.'"';























      ?>















          <!DOCTYPE html>







          <html lang="en">







          <head>







          <title>Bootstrap Example</title>







          <meta charset="utf-8">







          <meta name="viewport" content="width=device-width, initial-scale=1">







          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">















































          </head>







          <body>















































  <div class="container">















    <div width="60%">







































          <br><br><br><br><br>































          <div class="row">







          <div class="col-sm-1"></div>







          <div class="col-lg-10">























           <div>







           <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Ref: AK/HR/SC/<?=date("M-j");?></h3>







           <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;"><?=date("l, F j, Y");?></h3>







           </div> </br></br> </br></br>  <br><br>































































    <main>







    <div id="details" class="clearfix">







    <div><h2 style="font-family: Cambria, Georgia, serif; font-size: 29px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">







    <center>LETTER OF INTRODUCTION<hr ><center></h2></div>































      <div style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 45px;">







        <div>This is to certify that <b>







        <? if($paySlip->PBI_SEX=="Female") { ?>  Mrs.







        <?  }else{?> Mr. <? } ?> <?=$paySlip->PBI_NAME;?>, “<?=find_a_field('designation','DESG_DESC','DESG_ID="'.$paySlip->PBI_DESIGNATION.'"');?>”















        of AKSID Corporation Limited.</b>







        The Company paid his  remuneration from















          <? if($salary_all->year==$next_year){   ?>















            <?















            $monthname = date('m', strtotime($increment_start_date));







            echo $month_name = date("F", mktime(0, 0, 0, $monthname, 10));







            echo "-";







            echo $yearname = date("Y",strtotime($increment_start_date));







            ?>







            To







            <?







            //$date11 = date("m", strtotime("$date1-1 months"));















            $tomonthname = date('m', strtotime("$date1 - 1 months"));







            echo $tomonth_name = date("F", mktime(0, 0, 0, $tomonthname, 10));







            echo "-";







            echo $toyearname = date("Y",strtotime($date1));







            ?>























          <? }else{ ?>























            <?















            $monthname = date('m', strtotime($date1));















            echo $month_name = date("F", mktime(0, 0, 0, $monthname, 10));







            echo "-";







            echo $yearname = date("Y",strtotime($date1));







            ?>







            To







            <?







            $tomonthname2 = date('m', strtotime($date22));







            echo $tomonth_name2 = date("F", mktime(0, 0, 0, $tomonthname2, 10));







            echo "-";







            echo $toyearname2 = date("Y",strtotime($date2));







            ?>























            <? } $old_mon_year =$monthname.$yearname;  ?>















           BDT <b><?=number_format($salary_all->gross_salary*$diffff);?></b> (<?=convertNumberMhafuz($salary_all->gross_salary*$diffff);?>) as per following breakup.















          </div>















      </div>







      </div><br>























      <div>















        <h4 style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">His monthly remuneration structure is as follows:</h4>















      </div>















      <br>















      <div class="row">







      <div class="col-lg-12">















      <table class="table table-borderless table-sm" style="font-family: Cambria, Georgia, serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 24px;">















        <tbody>















          <tr>







            <td>Monthly Basic</td>







            <td>50% :</td>







            <td>BDT.</td>







            <td align="right"><?=number_format($salary_all->basic_salary,2);?></td>







            <td>x</td>







            <td><?=$diffff?> = </td>







            <td align="right"><?=number_format($salary_all->basic_salary*$diffff,2);?></td>







         </tr>







          <tr>







          <td>House Rent</td>







            <td>25% :</td>







            <td>BDT.</td>







            <td align="right"><?=number_format($salary_all->house_rent,2);?></td>







            <td>x</td>







            <td><?=$diffff?> = </td>







            <td align="right"><?=number_format($salary_all->house_rent*$diffff,2);?></td>







          </tr>















          <tr>







          <td>Medical Allowance</td>







            <td>15% :</td>







            <td>BDT.</td>







            <td align="right"><?=number_format($salary_all->medical_allowance,2);?></td>







            <td>x</td>







            <td><?=$diffff?> = </td>







            <td align="right"><?=number_format($salary_all->medical_allowance*$diffff,2);?></td>







          </tr>















          <tr style="border-bottom: 1px solid #AAAAAA;padding: 10px 0;







      margin-bottom: 22px;">







          <td>Conveyance Allowance</td>







            <td>10% :</td>







            <td>BDT.</td>







            <td align="right"><?=number_format($salary_all->special_allowance,2);?></td>







            <td>x</td>







            <td><?=$diffff?> = </td>















            <td align="right"><?=number_format($salary_all->special_allowance*$diffff,2);?></td>







          </tr>























              <tr style="border-bottom: 1px solid #AAAAAA;padding:10px 0;margin-bottom:22px;font-weight:bold;">







                <td>Monthly Gross</td>







                <td>100%:</td>







                <td>BDT.</td>







                <td align="right"><?=number_format($salary_all->gross_salary,2);?></td>







                <td>x</td>







                <td><?=$diffff?> = </td>







                <td align="right"><?=number_format($salary_all->gross_salary*$diffff,2);?></td>







              </tr>























        <tr>























        <?if($salary_all->year==$next_year){   ?>







        <td> <?echo $month_name; echo"-"; echo $yearname; ?> To <?  echo $tomonth_name; echo"-";  echo $toyearname; ?>   Paid Total BDT</td>







        <? }else{ ?>







        <td> <?echo $month_name; echo"-";  echo $yearname; ?> To <?   echo $tomonth_name2; echo"-";  echo$toyearname2; ?>    Paid Total BDT</td>







       <? }?>















          <td></td>







          <td>&nbsp;</td>







          <td>&nbsp;</td>







          <td>&nbsp;</td>















          <td>=</td>







          <td align="right"><b><?=number_format($salary_all->gross_salary*$diffff,2);?></b></td>















          </tr>































          <tr style="border-bottom: 1px solid #AAAAAA;padding: 10px 0;margin-bottom: 22px;">







          <td>Festival Allowances Paid BDT</td>







          <td></td>







          <td></td>







          <td>&nbsp;</td>







          <td>&nbsp;</td>







          <td>=</td>















           <? if($salary_all->year==$next_year){ ?>







           <td align="right"><b><?=number_format($bonus=find_a_field('salary_bonus','sum(bonus_amt)','PBI_ID="'.$salary_all->PBI_ID.'" and mon>6 and year="'.$next_year.'"'),2);?></b></td>







            <?  }else{  ?>







           <td align="right"><b><?=number_format($bonus=find_a_field('salary_bonus','sum(bonus_amt)','PBI_ID="'.$salary_all->PBI_ID.'" and mon<6 and year="'.$this_year.'"'),2);?></b></td>







           <?  }   ?>















          </tr>















          <tr style="padding:10px 0;margin-bottom:22px;font-weight:bold;">







                <td>Total Paid</td>







                <td>:</td>







                <td>BDT.</td>







                <td></td>







                <td></td>







                <td>=</td>







                <td align="right"><?=number_format($salary_all->gross_salary*$diffff+$bonus,2);?></td>







              </tr>







































        </tbody>







      </table>















      </div>















      </div>    </br>































      <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">







      <b>In words : </b><? echo convertNumberMhafuz($salary_all->gross_salary*$diffff+$bonus);?>.</p>























      <? $tax_chalan_no=find_a_field('emp_taxchalan_no','tax_chalan_no','PBI_ID="'.$paySlip->PBI_ID.'"');















       if(empty($tax_chalan_no)){}else{















      ?>







      <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height:30px;">







      We Certify that BDT <?=number_format($tax*$diffff);?> is deducted and submitted as TDS from his remuneration







      through <b>challan no:<?=$tax_chalan_no;?>.</b></p>















      <?  } ?>















































      <footer style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px;">







      This certificate has been issued at the request from <b>







        <? if($paySlip->PBI_SEX=="Female") { ?>  Mrs.







        <?  }else{?> Mr. <? } ?> <?=$paySlip->PBI_NAME;?>.</b></br> <br>







      For any further clarification, please contact to the undersigned.







      </footer>































 <br><br><br>















<div id="thanks" style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 22px;">Thanking You,</div><br><br><br><br>























    <div>







    <tr><td>----------------------------------------</td></tr><br>







    <tr>







    <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Mohammad Tanvir Gias</strong></td>







    </tr><br>







    <tr><td>







      <strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;">Manager, HR</strong></td>







      <br>







        <strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;">







        Mobile: 01844541234</strong></td>







      </tr>















    </div>















<br><br>















          </div>







          <div class="col-sm-1"></div>







          </div>























</div> </div>















































































</body>







</html>















































       <!-- end new style -->







































































































































































  <? } } } }*/ }  else{























    $salary_start_date = $next_year.'-07-1';



	$salary_end_date = $this_year.'-06-30';



	$resign_date = find_a_field('essential_info','ESSENTIAL_RESIG_DATE','PBI_ID="'.$_POST['id_no'].'"');



     if($resign_date!='0000-00-00' && $salary_end_date>$resign_date){



	   $salary_end_date = $resign_date;



	   }else{



	   $salary_end_date = $this_year.'-06-30';



	   }















    $pay = 'select p.PBI_ID,p.PBI_DOJ,p.PBI_NAME,p.PBI_SEX,count(s.mon) as total_month,s.year,s.mon as first_month,s.gross_salary,s.basic_salary,s.house_rent,







    s.medical_allowance,s.special_allowance,sum(s.income_tax) as tax_amount,p.PBI_DESIGNATION







    from personnel_basic_info p,salary_attendence s where







       s.entry_at between "'.$salary_start_date.'" and "'.$salary_end_date.'" and s.PBI_ID=p.PBI_ID '.$pay_con.' group by p.PBI_ID ';







       $qry = mysql_query($pay);







       $count = mysql_num_rows($qry);















       while($paySlip = mysql_fetch_object($qry)){































              ////////////  dynamic date /////////////////







              $month_count= $paySlip->total_month;







              $first_month= $paySlip->first_month;







              $salary_year  = $paySlip->year;











               $salary_mon = $this_mon;







               $salary_year = $next_year;











     $bonus= find_all_field('salary_bonus','','PBI_ID="'.$paySlip->PBI_ID.'" and cut_off_date between "'.$salary_start_date.'" and "'.$salary_end_date.'"');











      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div width="60%"> <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-lg-10">
        <div>
          <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Ref: AK/HR/SC/
            <?=date("M-j");?>
          </h3>
          <h3 style="font-family: Cambria, Georgia, serif; font-size: 25px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">
            <?=date("l, F j, Y");?>
          </h3>
        </div>
        </br>
        </br>
        </br>
        </br>
        <br>
        <br>
        <main>
        <div id="details" class="clearfix">
          <div>
            <h2 style="font-family: Cambria, Georgia, serif; font-size: 29px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">
              <center>
              LETTER OF INTRODUCTION
              <hr >
              <center>
            </h2>
          </div>
          <div style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 45px; text-align:justify;">
            <div style="text-align:justify;">This is to certify that <b>
              <? if($paySlip->PBI_SEX=="Female") { ?>
              Mrs.
              <?  }else{?>
              Mr.
              <? } ?>
              <?=$paySlip->PBI_NAME;?>
              , “
              <?=find_a_field('designation','DESG_DESC','DESG_ID="'.$paySlip->PBI_DESIGNATION.'"');?>
              ”















              of AKSID Corporation Limited.</b> The Company paid his  remuneration from
              <?















            //$monthname = date('m', strtotime($increment_start_date));







            echo $month_name = date("F", mktime(0, 0, 0, $first_month, 10));







            echo"-";







            echo $yearname = date("Y",strtotime($salary_start_date));







            ?>
              To
              <?







            $tomonthname = date('m', strtotime($salary_end_date));







            echo $tomonth_name = date("F", mktime(0, 0, 0, $tomonthname, 10));







            echo"-";







            echo $toyearname = date("Y",strtotime($salary_end_date));







            ?>
              BDT <b>
              <?=number_format(($paySlip->gross_salary*$month_count)+$bonus->bonus_amt);?>
              </b> (
              <?=convertNumberMhafuz(($paySlip->gross_salary*$month_count)+$bonus);?>
              ) as per following breakup. </div>
          </div>
        </div>
        <br>
        <div>
          <h4 style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px;">His monthly remuneration structure is as follows:</h4>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-borderless table-sm" style="font-family: Cambria, Georgia, serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 24px;">
              <tbody>
                <tr>
                  <td>Monthly Basic</td>
                  <td>50% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($paySlip->basic_salary,2);?></td>
                  <td>x</td>
                  <td><?=$month_count?>
                    = </td>
                  <td align="right"><?=number_format($paySlip->basic_salary*$month_count,2);?></td>
                </tr>
                <tr>
                  <td>House Rent</td>
                  <td>25% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($paySlip->house_rent,2);?></td>
                  <td>x</td>
                  <td><?=$month_count?>
                    = </td>
                  <td align="right"><?=number_format($paySlip->house_rent*$month_count,2);?></td>
                </tr>
                <tr>
                  <td>Medical Allowance</td>
                  <td>15% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($paySlip->medical_allowance,2);?></td>
                  <td>x</td>
                  <td><?=$month_count?>
                    = </td>
                  <td align="right"><?=number_format($paySlip->medical_allowance*$month_count,2);?></td>
                </tr>
                <tr>
                  <td>Conveyance Allowance</td>
                  <td>10% :</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($paySlip->special_allowance,2);?></td>
                  <td>x</td>
                  <td><?=$month_count?>
                    = </td>
                  <td align="right"><?=number_format($paySlip->special_allowance*$month_count,2);?></td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding: 10px 0;







      margin-bottom: 22px;">
                  <td colspan="7">&nbsp;</td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding:10px 0;margin-bottom:22px;">
                  <td>Monthly Gross</td>
                  <td>100%:</td>
                  <td>BDT.</td>
                  <td align="right"><?=number_format($paySlip->gross_salary,2);?></td>
                  <td>x</td>
                  <td><?=$month_count?>
                    = </td>
                  <td align="right"><?=number_format($paySlip->gross_salary*$month_count,2);?></td>
                </tr>
                <tr>
                  <td><?







            echo $month_name = date("F", mktime(0, 0, 0, $first_month, 10));







            echo" ";







            echo $yearname = date("Y",strtotime($salary_start_date));















            ?>
                  </td>
                  <td>TO</td>
                  <td><?$tomonthname = date('m', strtotime($salary_end_date));







          echo $tomonth_name = date("F", mktime(0, 0, 0, $tomonthname, 10));







          echo"-";







          echo $toyearname = date("Y",strtotime($salary_end_date));?>
                  </td>
                  <td>Paid Total BDT</td>
                  <td>&nbsp;</td>
                  <td>=</td>
                  <td align="right"><b>
                    <?=number_format($paySlip->gross_salary*$month_count,2);?>
                    </b></td>
                </tr>
                <tr style="border-bottom: 2px solid #000;padding: 10px 0;margin-bottom: 22px;">
                  <td>Festival Allowances</td>
                  <td>Paid BDT</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>=</td>
                  <td align="right"><b>
                    <?=number_format($bonus->bonus_amt,2);?>
                    </b></td>
                </tr>
                <tr style="padding:10px 0;margin-bottom:22px;font-weight:bold;">
                  <td>Total Paid</td>
                  <td>:</td>
                  <td>BDT.</td>
                  <td></td>
                  <td></td>
                  <td>=</td>
                  <td align="right"><?=number_format($paySlip->gross_salary*$month_count+$bonus->bonus_amt,2);?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </br>
        <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;"> <b>In words : </b><? echo convertNumberMhafuz($paySlip->gross_salary*$month_count+$bonus->bonus_amt);?>.</p>
        <? $tax_chalan_no=find_a_field('emp_taxchalan_no','tax_chalan_no','PBI_ID="'.$paySlip->PBI_ID.'"');















       if(empty($tax_chalan_no)){}else{















      ?>
        <p style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height:30px;"> We Certify that BDT
          <?=number_format($paySlip->tax_amount,2);?>
          is deducted and submitted as TDS from his remuneration







          through <b>challan no:
          <?=$tax_chalan_no; ?>
          .</b></p>
        <?  } ?>
        <footer style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px;"> This certificate has been issued at the request from <b>
          <? if($paySlip->PBI_SEX=="Female") { ?>
          Mrs.
          <?  }else{?>
          Mr.
          <? } ?>
          <?=$paySlip->PBI_NAME;?>
          .</b></br>
          <br>
          For any further clarification, please contact to the undersigned. </footer>
        <br>
        <br>
        <br>
        <div id="thanks" style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 22px;">Thanking You,</div>
        <br>
        <br>
        <br>
        <br>
        <div>
          <tr>
            <td>----------------------------------------</td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px;">Mohammad Tanvir Gias</strong></td>
          </tr>
          <br>
          <tr>
            <td><strong style="font-family: Cambria, Georgia, serif; font-size: 26px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 25px;">Manager, HR</strong></td>
            <td><br>
            </td>
          </tr>
        </div>
        <br>
        <br>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
</div>
</body>
</html>
<!-- end new style -->
<? }} ?>
<!-- **************  end Tax  Salary certificate  ************************  -->
<?















}























if($_POST['report']==45963214){

	$PBI_ID = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['id_no'].'"');

 if($_POST['id_no']!=''){
 $pay_con = ' and s.PBI_ID="'.$PBI_ID.'"';

}





  if($_POST['mon']!=''){
  $pay_con .= ' and s.mon="'.$_POST['mon'].'"';

  }




  if($_POST['year']!=''){
  $pay_con .= ' and s.year="'.$_POST['year'].'"';

   }


if($_POST['department']!=''){
$pay_con .= ' and s.department="'.$_POST['department'].'"';
 }





  if($_POST['job_status']!=''){
  $pay_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';



  }


   $pay = 'select s.*,p.PBI_NAME,p.PBI_CODE,(select DESG_DESC from designation where DESG_ID=s.designation) as designation,(select DEPT_DESC from department where DEPT_ID=s.department) as department,
  (select PROJECT_DESC from project where PROJECT_ID=s.job_location) as project from salary_attendence s,personnel_basic_info p where s.PBI_ID=p.PBI_ID '.$pay_con.' ';

  $qry = mysql_query($pay);



 while($paySlip = mysql_fetch_object($qry)){



?>


<table width="100%" align="center">
  <tr>
    <td style="border:0px;" align="center" ><span style="font-size:18px;font-family:bankgothic; transform: uppercase; font-weight:bold;">AKSID CORPORATION LIMITED</span></td>
  </tr>
  <tr>
    <td style="border:0px;" align="center" ><span style="font-size:16px; font-weight:bold;">Pay Slip</span></td>
  </tr>
  <tr>
    <td style="border:0px;" align="center" ><span style="font-size:12px; font-weight:bold;">Period :
      <? $test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');





$_SESSION['year'] = $_POST['year'] ;




 echo date_format($test, 'M-Y');?>
      </span></td>
  </tr>
</table>
<table width="600" border="1" cellpadding="2" cellspacing="0" align="center" style="font-size:normal 12px  thoma;">
  <tr >
    <td colspan="5" align="center"><strong>Basic Info</strong></td>
  </tr>
  <tr>
    <td><strong>ID</strong></td>
    <td colspan="2" ><?=$paySlip->PBI_CODE?></td>
    <td><strong>Name</strong></td>
    <td ><?=$paySlip->PBI_NAME?></td>
  </tr>
  <tr>
    <td><strong>Designation</strong></td>
    <td colspan="2"><?=$paySlip->designation?></td>
    <td><strong>Department</strong></td>
    <td><?=$paySlip->department?></td>
  </tr>
  <tr >
    <td ><strong>Project/Job Location</strong></td>
    <td colspan="4" ><?=$paySlip->project?></td>
  </tr>
  <tr >
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="2" align="center"><strong>Description</strong></td>
    <td ><strong>Amount</strong></td>
    <td colspan="2"><strong>Deduction</strong></td>
  </tr>
  <tr >
    <td >Basic</td>
    <td align="right">50%</td>
    <td align="right"><?=number_format($paySlip->basic_salary)?></td>
    <td >Mobile Bill</td>
    <td align="right"><?=($paySlip->mobile_deduction>0)? number_format($paySlip->mobile_deduction) : '';?></td>
  </tr>
  <tr >
    <td >House Rent</td>
    <td align="right">25%</td>
    <td align="right"><?=number_format($paySlip->house_rent)?></td>
    <td >Tax</td>
    <td align="right"><?=($paySlip->income_tax>0)? number_format($paySlip->income_tax) : '';?></td>
  </tr>
  <tr >
    <td >Medical</td>
    <td align="right">15%</td>
    <td align="right"><?=number_format($paySlip->medical_allowance)?></td>
    <td >Food</td>
    <td align="right" ><?=($paySlip->food_deduction>0)? number_format($paySlip->food_deduction) : '';?></td>
  </tr>
  <tr >
    <td >Conveyance</td>
    <td align="right">10%</td>
    <td align="right"><?=number_format($paySlip->special_allowance)?></td>
    <td >Loan/Advance</td>
    <td align="right"><?=($paySlip->advance_install>0)? number_format($paySlip->advance_install) : '';?></td>
  </tr>
  <tr >
    <td colspan="2" >Gross</td>
    <td align="right"><?=number_format($paySlip->gross_salary)?></td>
    <td >Absent Amount</td>
    <td align="right"><?=($paySlip->absent_deduction>0)? number_format($paySlip->absent_deduction) : '';?></td>
  </tr>
  <tr >
    <td  colspan="2" align="center"><strong>Extra Allowance</strong></td>
    <td >&nbsp;</td>
    <td >LWP Amount</td>
    <td align="right"><?=($paySlip->lwp_deduction>0)? number_format($paySlip->lwp_deduction) : '';?></td>
  </tr>
  <tr >
    <td  colspan="2">Food</td>
    <td align="right"><?=($paySlip->food_allowance>0)? number_format($paySlip->food_allowance) : '';?></td>
    <td >Late Deduction</td>
    <td align="right"><?=($paySlip->late_deduction>0)? number_format($paySlip->late_deduction) : '';?></td>
  </tr>
  <tr  >
    <td  colspan="2">Transport</td>
    <td align="right"><?=($paySlip->transport_allowance>0)? number_format($paySlip->transport_allowance) : '';?></td>
	<td >HR Action</td>
    <td align="right"><?=($paySlip->hr_action_amt>0)? number_format($paySlip->hr_action_amt) : '';?></td>




  </tr>
  <tr >
    <td  colspan="2">Offday</td>
    <td align="right"><?=($paySlip->offday_allowance>0)? number_format($paySlip->offday_allowance) : '';?></td>
    <td >Joining Deduction</td>
    <td align="right"><?=($paySlip->joining_deduction>0)? number_format($paySlip->joining_deduction) : '';?></td>
  </tr>
  <tr >
    <td  colspan="2">Site Visit</td>
    <td align="right"><?=($paySlip->sitevisit_allowance>0)? number_format($paySlip->sitevisit_allowance) : '';?></td>
    <td >Others</td>
    <td align="right"><?=($paySlip->other_deduction>0)? number_format($paySlip->other_deduction) : '';?></td>


  </tr>
  <tr >
    <td  colspan="2">Others</td>
    <td align="right"><?=($paySlip->other_allowance>0)? number_format($paySlip->other_allowance) : '';?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <?

       $start = ''.$_POST['year'].'-'.$_POST['mon'].'-01';
       $end = ''.$_POST['year'].'-'.$_POST['mon'].'-31';

      $bonus1 = find_a_field('salary_bonus','bonus_amt','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1 and PBI_ID='.$paySlip->PBI_ID);
      $bonus2 = find_a_field('salary_bonus','bonus_amt','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 2 and PBI_ID='.$paySlip->PBI_ID);


			$Cash_bonus1 = find_a_field('salary_bonus','cash_paid','bonus_date between "'.$start.'" and "'.$end.'"  and PBI_ID='.$paySlip->PBI_ID);
			$Bank_bonus2 = find_a_field('salary_bonus','bank_paid','bonus_date between "'.$start.'" and "'.$end.'"  and PBI_ID='.$paySlip->PBI_ID);

 if($bonus1>0){







	   ?>
  <tr>
    <td  colspan="2" align="center"><strong>Festival Bonus</strong></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td  colspan="2">EID-UL-Fitre</td>
    <td align="right"><?=number_format($bonus1);?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <? }elseif($bonus2>0){  ?>
  <tr>
    <td  colspan="2" align="center"><strong>Festival Bonus</strong></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td  colspan="2">EID-UL-Adha</td>
    <td align="right"><?=number_format($bonus2);?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
<? }else{} ?>
  <tr >
    <td  colspan="2" align="center"><strong>Adjustment</strong></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td  colspan="2">Salary Adjustment</td>
    <td align="right"><?=($paySlip->adjustment_amount>0)? number_format($paySlip->adjustment_amount) : '';?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td colspan="2"><strong>Total Earning</strong></td>
    <td align="right"><strong>
	<? $total_earning=$paySlip->gross_salary+$paySlip->food_allowance+$paySlip->transport_allowance+$paySlip->offday_allowance+
$paySlip->sitevisit_allowance+$paySlip->other_allowance+$paySlip->adjustment_amount+$bonus1+$bonus2; echo number_format($total_earning,0);?>
      </strong></td>
    <td><strong>Total Deduction</strong></td>
    <td align="right"><strong>
      <?=number_format($total_deduction=$paySlip->mobile_deduction+$paySlip->food_deduction+$paySlip->advance_install+$paySlip->income_tax+$paySlip->other_deduction+
	  $paySlip->late_deduction+$paySlip->lwp_deduction+$paySlip->absent_deduction+$paySlip->joining_deduction+$paySlip->hr_action_amt);?>
      </strong></td>
  </tr>
  <tr >
    <td><strong>Net Pay</strong></td>
    <td align="right"><strong>
      <? $net_pay=$paySlip->total_payable+$bonus1+$bonus2;echo number_format($net_pay,0);?>
      </strong></td>
    <td colspan="3"><strong>
      <?=convertNumberMhafuz($net_pay);?>
      </strong></td>
  </tr>
  <tr >
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="5" align="center"><strong>Payment Details</strong></td>
  </tr>
  <tr >
    <td><strong>Payment Mode</strong></td>
    <td><strong>
      <?



	     if($paySlip->bank_or_cash==1){
         echo 'Cash';
		 }elseif($paySlip->bank_or_cash==5){
         echo 'Bank/Cash';

			 }else{
				    echo 'Bank';
			 }

?>
      </strong></td>
    <td><strong>Payroll Card / Bank A/C </strong></td>
    <td><strong>

			<?
			if($paySlip->bank_or_cash==3){
				echo $paySlip->card_no;
			}else{
				echo $paySlip->cash;
			}



				?>

      </strong></td>


			<td align="center"><strong>
				<? if($paySlip->bank_or_cash!=1){
				 echo 'Eastern Bank Limited';
				}?>
	      </strong></td>



  </tr>
  <tr >
    <td><strong>Cash Amount BDT</strong></td>
    <td align="center"><strong>
      <? //=$paySlip->card_no;?>  <?=number_format($paySlip->cash_amt+$Cash_bonus1);?>
      </strong></td>
    <td><strong>Bank Amount BDT</strong></td>
    <td colspan="2" align="center">
			<strong>
      <?
      if($paySlip->bank_or_cash==2){
				echo number_format($paySlip->total_payable+$Bank_bonus2);
			}elseif ($paySlip->bank_or_cash==5){
				echo number_format($paySlip->bank_amt+$Bank_bonus2-$total_deduction);
			}else{
				echo number_format($paySlip->total_payable+$Bank_bonus2);
			}



				?>


			</strong><strong>

      </strong></td>
  </tr>
</table>
<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="font-size:normal 12px  thoma; border: 0px;">
  <tr>
    <td colspan="5" style="border: 0px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="border: 0px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="border: 0px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" style="border: 0px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="border: 0px;">______________________</td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="border: 0px;"><strong>Mohammad Tanvir Gias</strong></td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="border: 0px;"><strong>Senior Manager, HR</strong></td>
  </tr>
</table>
<? } ?>
<?































































}































if($_POST['report']==77)































































{































































$sqll="select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department from































































personnel_basic_info a, salary_info s where a.PBI_ID=s.PBI_ID  ".$con." order by a.PBI_DOJ asc, (s.consolidated_salary+s.basic_salary) desc";































































$query = mysql_query($sqll);
?>


<?
}

if($_POST['report']==777)































{















































?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <thead>
    <tr>
      <td  colspan="0" align="left" style="border:0px;"></td>
      <td  colspan="0" align="left" style="border:0px;"><img src="../../img/company_logo.png" style="height:100px; width:65px; margin-left:-27px;"  /></td>
      <td style="border:0px; padding-right:100px" colspan="29" align="center"><?=$str?></td>
    </tr>
    <tr>
      <th width="2%" rowspan="3" align="center" >S/L</th>
      <th width="5%" rowspan="3"><div align="center">ID</div></th>
      <th width="4%" rowspan="3"><div align="center">Name</div></th>
      <th width="8%" rowspan="3"><div align="center">Designation</div></th>
      <th width="7%" rowspan="3" nowrap="nowrap"><div align="center">Joining Date</div></th>
      <th width="8%" rowspan="3"><div align="center">Job Period</div></th>
      <th colspan="2" align="center"><div align="center">Salary</div></th>
      <th width="10%" rowspan="3"><div align="center">Bonus (Basic) %</div></th>
      <th width="11%" rowspan="3"><div align="center">Bonus Amount</div></th>
      <th width="7%" rowspan="3"><div align="center">Bank Acc.</div></th>
      <th width="12%" rowspan="3"><div align="center">Payroll Card No</div></th>
      <th width="7%" rowspan="3"><div align="center">Remarks</div></th>
    </tr>
    <tr>
      <th width="4%"><div align="center">Gross</div></th>
      <th width="4%"><div align="center">Basic</div></th>
    </tr>
    <tr>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
    </tr>
  </thead>
  <tbody>
    <?































































if($_POST['branch']!='')



$cons=' and a.PBI_BRANCH ="'.$_POST['branch'].'"';



if($_POST['JOB_LOCATION']!='')



$cons.=' and b.pbi_job_location ="'.$_POST['JOB_LOCATION'].'"';




if($_POST['department']!='')



$cons.=' and b.pbi_department ="'.$_POST['department'].'"';
$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){
$sqld="select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
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
s.PBI_ID=b.PBI_ID and b.bonus_type=".$_POST['bonus_type']." and
b.bonus_amt>0 and
b.year=".$_POST['year']." ".$cons."
order by b.bonus_amt desc";


}else{
$sqld="select a.PBI_ID,a.PBI_CODE,a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
b.job_period,b.gross_salary,b.basic_salary,b.bonus_percent,b.bonus_amt,b.remarks,































		s.cash as bank_ac,































		s.card_no































		from































		personnel_basic_info a, salary_bonus_lock b, salary_info s, designation d































		where































		1 and b.pbi_designation=d.DESG_ID and a.PBI_ID=b.PBI_ID and































		s.PBI_ID=b.PBI_ID and b.bonus_type=".$_POST['bonus_type']." and































































































		b.bonus_percent not like 0 and































		b.year=".$_POST['year']." ".$cons."































		order by b.bonus_amt desc";































































}































$queryd=mysql_query($sqld);































while($data = mysql_fetch_object($queryd)){































$entry_by=$data->entry_by;































































?>
    <tr>
      <td align="center"><?=++$s?></td>
      <td align="center"><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->designation?></td>
      <td align="center"><?=$data->joining_date?></td>
      <td nowrap="nowrap" align="center"><?=$data->job_period?></td>
      <td align="right"><?=(number_format($data->gross_salary,0)>0)? number_format($data->gross_salary,0) : ''; $tot_gross+=$data->gross_salary;?></td>
      <td align="right"><?=(number_format($data->basic_salary,0)>0)? number_format($data->basic_salary,0) : ''; $tot_basic+=$data->basic_salary;?></td>
      <td align="center"><?=$data->bonus_percent?></td>
      <td align="right"><?=number_format($data->bonus_amt,0); $totalBonus+=$data->bonus_amt;?></td>
      <td align="center"><?=$data->bank_ac;?></td>
      <td align="center"><?=$data->card_no;?></td>
      <td><?=$data->remarks;?></td>
    </tr>
    <?































































}































?>
    <tr>
      <td colspan="6" align="right">Total:</td>
      <td align="right"><strong>
        <?=number_format($tot_gross,0)?>
        </strong></td>
      <td align="right"><strong>
        <?=number_format($tot_basic,0)?>
        </strong></td>
      <td>&nbsp;</td>
      <td align="right"><strong>
        <?=number_format($totalBonus,0)?>
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

<?php /*?>
<a href="../../../acc_mod/pages/export_bonus.php?export=yes&year=<?=$_REQUEST['year']?>&mon=<?=$_POST['mon']?>&department=<?=$_REQUEST['department']?>&bonus_type=<?=$_POST['bonus_type']?>


&JOB_LOCATION=<?=$_REQUEST['JOB_LOCATION']?>" target="_blank">Export</a>
<?php */?>

<br>




<!-- bonus report Bkash -->


<?
}

if($_POST['report']==21215)


{



?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <thead>
    <tr>
      <td  colspan="0" align="left" style="border:0px;"></td>
      <td  colspan="0" align="left" style="border:0px;"><img src="../../img/company_logo.png" style="height:100px; width:65px; margin-left:-27px;"  /></td>
      <td style="border:0px; padding-right:100px" colspan="29" align="center"><?=$str?></td>
    </tr>
    <tr>
      <th width="2%" rowspan="3" align="center" >S/L</th>
      <th width="5%" rowspan="3"><div align="center">ID</div></th>
      <th width="4%" rowspan="3"><div align="center">Name</div></th>
      <th width="8%" rowspan="3"><div align="center">Designation</div></th>
      <th width="7%" rowspan="3" nowrap="nowrap"><div align="center">Joining Date</div></th>
      <th width="8%" rowspan="3"><div align="center">Job Period</div></th>
      <th colspan="2" align="center"><div align="center">Salary</div></th>
      <th width="10%" rowspan="3"><div align="center">Bonus (Basic) %</div></th>
      <th width="11%" rowspan="3"><div align="center">Bonus Amount</div></th>

      <th width="12%" rowspan="3"><div align="center">Bkash No</div></th>
      <th width="7%" rowspan="3"><div align="center">Remarks</div></th>
    </tr>
    <tr>
      <th width="4%"><div align="center">Gross</div></th>
      <th width="4%"><div align="center">Basic</div></th>
    </tr>
    <tr>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
    </tr>
  </thead>
  <tbody>
    <?

if($_POST['branch']!='')



$cons=' and a.PBI_BRANCH ="'.$_POST['branch'].'"';



if($_POST['JOB_LOCATION']!='')



$cons.=' and b.pbi_job_location ="'.$_POST['JOB_LOCATION'].'"';




if($_POST['department']!='')



$cons.=' and b.pbi_department ="'.$_POST['department'].'"';
$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){
$sqld="select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
b.job_period,
b.gross_salary,
b.basic_salary,
b.bonus_percent,
b.bonus_amt,
b.remarks,
s.cash as bank_ac,
s.bkash_no
from
personnel_basic_info a, salary_bonus b, salary_info s, designation d
where
1 and b.pbi_designation=d.DESG_ID and b.PBI_ID=a.PBI_ID and
s.PBI_ID=b.PBI_ID and b.bonus_type=".$_POST['bonus_type']." and
b.bonus_amt>0 and b.bank_or_cash=6 and
b.year=".$_POST['year']." ".$cons."
order by b.bonus_amt desc";


}else{
$sqld="select a.PBI_ID,a.PBI_CODE,a.PBI_NAME, d.DESG_SHORT_NAME as designation, date_format(a.PBI_DOJ,'%d-%b-%y') as joining_date,
b.job_period,b.gross_salary,b.basic_salary,b.bonus_percent,b.bonus_amt,b.remarks,


s.cash as bank_ac,
s.bkash_no
from
personnel_basic_info a, salary_bonus_lock b, salary_info s, designation d

where
1 and b.pbi_designation=d.DESG_ID and a.PBI_ID=b.PBI_ID and b.bank_or_cash=6 and
s.PBI_ID=b.PBI_ID and b.bonus_type=".$_POST['bonus_type']." and
b.bonus_percent not like 0 and
b.year=".$_POST['year']." ".$cons."
order by b.bonus_amt desc";


}


$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
$entry_by=$data->entry_by;



?>
    <tr>
      <td align="center"><?=++$s?></td>
      <td align="center"><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->designation?></td>
      <td align="center"><?=$data->joining_date?></td>
      <td nowrap="nowrap" align="center"><?=$data->job_period?></td>
      <td align="right"><?=(number_format($data->gross_salary,0)>0)? number_format($data->gross_salary,0) : ''; $tot_gross+=$data->gross_salary;?></td>
      <td align="right"><?=(number_format($data->basic_salary,0)>0)? number_format($data->basic_salary,0) : ''; $tot_basic+=$data->basic_salary;?></td>
      <td align="center"><?=$data->bonus_percent?></td>
      <td align="right"><?=number_format($data->bonus_amt,0); $totalBonus+=$data->bonus_amt;?></td>

      <td align="center"><?=$data->bkash_no;?></td>
      <td><?=$data->remarks;?></td>
    </tr>


<?
}

?>
    <tr>
      <td colspan="6" align="right">Total:</td>
      <td align="right"><strong>
        <?=number_format($tot_gross,0)?>
        </strong></td>
      <td align="right"><strong>
        <?=number_format($tot_basic,0)?>
        </strong></td>
      <td>&nbsp;</td>
      <td align="right"><strong>
        <?=number_format($totalBonus,0)?>
        </strong></td>
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



<!-- End bonus report Bkash-->






<?
}if($_POST['report']==79)
{
?>
<div>
  <button>
  <strong><a href="../../../acc_mod/pages/export_new.php?export=yes&year=<?=$_REQUEST['year']?>&mon=<?=$_POST['mon']?>&department=<?=$_REQUEST['department']?>
&JOB_LOCATION=<?=$_REQUEST['JOB_LOCATION']?>" target="_blank">Salary Sheet Export</a></strong >
  </button>
</div>
<br>


<div>
  <button>
  <strong><a href="../../../acc_mod/pages/export_bonus.php?export=yes&year=<?=$_REQUEST['year']?>&mon=<?=$_POST['mon']?>&department=<?=$_REQUEST['department']?>&bonus_type=<?=$_POST['bonus_type']?>
&JOB_LOCATION=<?=$_REQUEST['JOB_LOCATION']?>" target="_blank">Salary Bonus Sheet  Export</a></strong >
  </button>
</div>
<br>
<div>
  <button>
		<strong><a href="../../../acc_mod/pages/salary_cash.php?export=yes&year=<?=$_REQUEST['year']?>&mon=<?=$_POST['mon']?>&department=<?=$_REQUEST['department']?>
	&JOB_LOCATION=<?=$_REQUEST['JOB_LOCATION']?>" target="_blank">Salary Sheet (CASH) Export</a></strong >
  </button>
</div>
<?















}















if($_POST['report']==78)















{















?>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">































 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>































































 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>































































 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>































































 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>































































 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>































 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>































 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>































































 <script>































































$(document).ready(function() {































    $('#example').DataTable( {































    	paging: false,































    	searching: false,































        dom: 'Bfrtip',































        buttons: [































            'copyHtml5',































            'excelHtml5',































            'csvHtml5',































































            {































                extend: 'pdfHtml5',































                orientation: 'landscape',































                pageSize: 'TABLOID',































                customize : function(doc){































            var colCount = new Array();































            $(tbl).find('tbody tr:first-child td').each(function(){































                if($(this).attr('colspan')){































                    for(var i=1;i<=$(this).attr('colspan');$i++){































                        colCount.push('*');































                    }































                }else{ colCount.push('*'); }































            });































































        }































    }































































































        ]































    } );































} );































</script>-->
<table width="100%"   cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="4" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px;"><div align="center" style="margin-left: -20%;">
          <?=$str?>
        </div></td>
    </tr>
  </thead>
</table>
<table  width="100%" id="ExportTable" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <th rowspan="3">S/L</th>
      <th rowspan="3"><div align="center">ID</div></th>
      <th rowspan="3"><div align="center">Name</div></th>
      <th rowspan="3"><div align="center">Designation</div></th>
      <th rowspan="3" nowrap="nowrap"><div align="center">
        Joining Date</th>
      <th colspan="13" align="center"><div align="center">Attendance</div></th>
      <th colspan="5"><div align="center">Salary and Allowance</div></th>
			<!--
      <th colspan="5"><div align="center">Extra Allowance</div></th>
      <th rowspan="3"><div align="center">Total Allowances</div></th>
		   -->

      <th rowspan="3"><div align="center">OT. Hrs.</div></th>
      <th rowspan="3"><div align="center">OT. Amt.</div></th>
      <th rowspan="3"><div align="center">Salary Adjustment</div></th>
      <th colspan="10" align="center"><div align="center">Deduction</div></th>
      <th rowspan="3"><div align="center">Total Deduction</div></th>
      <th rowspan="3" align="center"><div align="center">Net Salary</div></th>
      <th rowspan="3" align="center"><div align="center">Net Payable Salary</div></th>
      <th rowspan="3"><div align="center">Bank A/C</div></th>
      <th rowspan="3"><div align="center">Payroll Card No</div></th>
      <th rowspan="3"><div align="center">Remarks</div></th>
    </tr>
    <tr>
      <th colspan="9"><div align="center">No of Leave's</div></th>
      <th rowspan="2"><div align="center">LP</div></th>
      <th rowspan="2"><div align="center">LWP</div></th>
      <th rowspan="2"><div align="center">AB</div></th>
      <th rowspan="2"><div align="center">Total Days Works</div></th>
      <th><div align="center">Gross</div></th>
      <th><div align="center">Basic</div></th>
      <th><div align="center">House Rent</div></th>
      <th><div align="center">Medical</div></th>
      <th><div align="center">Conveyance</div></th>

			<!--
      <th rowspan="2"><div align="center">Food</div></th>
      <th rowspan="2"><div align="center">Transport</div></th>
      <th rowspan="2"><div align="center">Offday</div></th>
      <th rowspan="2"><div align="center">Site visit</div></th>
      <th rowspan="2"><div align="center">Others</div></th>
		  -->

      <th rowspan="2"><div align="center">Mobile</div></th>
      <th rowspan="2"><div align="center">Tax</div></th>
      <th rowspan="2"><div align="center">Food</div></th>
      <th rowspan="2"><div align="center">Loan /ADV IOU</div></th>
      <th rowspan="2"><div align="center">Absent</div></th>
      <th rowspan="2"><div align="center">LWP</div></th>
      <th rowspan="2"><div align="center">Late</div></th>
      <th rowspan="2"><div align="center">HR Action</div></th>
      <th rowspan="2"><div align="center">Joining Deduction</div></th>
      <th rowspan="2"><div align="center">Others</div></th>
    </tr>
    <tr>
      <th>CL</th>
      <th>SL</th>
      <th>AL</th>
      <th>SHL</th>
      <th>ML</th>
      <th>PL</th>
      <th>EOL</th>
      <th>HL</th>
      <th>MLV</th>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
      <th><div align="center">25%</div></th>
      <th><div align="center">15%</div></th>
      <th><div align="center">10%</div></th>
    </tr>
  </thead>
  <tbody>
    <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($found==0){

if($_POST['PBI_ORG']!='')
$salaryCon =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')




 $salaryCon .= ' and t.job_location='.$_POST['JOB_LOCATION'];































































if ($_POST['department'] !='')















































	$salaryCon .= ' and t.department='.$_POST['department'];































































if ($_POST['job_status'] !='')















































$salaryCon .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';















   $sqld = 'select t.*, a.PBI_ID,a.PBI_CODE,a.PBI_NAME, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation































 from salary_attendence t,designation d, personnel_basic_info a































































 where t.designation = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and  t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryCon.' order by (t.total_payable) desc';































}else{































































 if($_POST['PBI_ORG']!='')















































	$salaryConn =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';































































if ($_POST['JOB_LOCATION'] !='')















































	$salaryConn .= ' and t.job_location='.$_POST['JOB_LOCATION'];































































if ($_POST['department'] !='')















































	$salaryConn .= ' and t.department='.$_POST['department'];































































            $m_s_date = $_POST['year'].'-'.$_POST['mon'].'-'.'01';















































		   $m_e_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';










$sqld = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ
from salary_attendence_lock t, personnel_basic_info a
where  t.pay>0 and t.remarks_details!="hold" and  t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID '.$salaryConn.' order by (t.total_payable) desc';



}















































$queryd=mysql_query($sqld);































































while($data = mysql_fetch_object($queryd)){































































$m_s_date = $_POST['year'].'-'.$_POST['mon'].'-'.'01';















































$m_e_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';















































$entry_by=$data->entry_by;















































  //$slq = 'select sum(total_days) from hrm_leave_info where PBI_ID="'.$data->PBI_ID.'" and type=1 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED"';















 $tot_ded = $data->other_deduction+$data->other_deductions;























//for joining  deduction































 //$join_date_diff = date('Y-m-d', strtotime($data->PBI_DOJ. ' -2 day'));















 $join_date_org = date('Y-m-d', strtotime($data->PBI_DOJ));















 $join_date_diff = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($data->PBI_DOJ) ) ));























$joindate = date_parse_from_format("Y-m-d", $data->PBI_DOJ);







$joining_month =  $joindate["month"];







$joining_year =  $joindate["year"];















$deduction_days =$data->mtd-$data->pay;







$deduction_amt  =$data->gross_salary/$data->mtd;







$deduction_amttotal=$deduction_days*$deduction_amt;























































?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <!-- <td nowrap="nowrap"><? //=$data->
      Designation ?>
      </td>
      -->
      <td nowrap="nowrap"><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID="'.$data->designation.'"');?></td>
      <td><?=date('d-M-Y',strtotime($data->PBI_DOJ))?></td>
      <td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (1)';
$dumping = mysql_query($dd);
$day_count = '';
$last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';















































				while($leave_d = mysql_fetch_object($dumping)){































































































				 $d = date_parse_from_format("Y-m-d", $leave_d->e_date);















































                  $next_m =  $d["month"];































































































				   if($_POST['mon']<$next_m){































































































				   $e_date = $last_date;































































































				   }else{















































				   $e_date = $leave_d->e_date;















































				   }















































				$s_date = $leave_d->s_date;















































				$e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));































































































		 $begin = new DateTime($s_date);















































        $end = new DateTime($e_date);































































      $interval = DateInterval::createFromDateString('1 day');















































      $period = new DatePeriod($begin, $interval, $end);















































































































    foreach ($period as $dt) {































































































     $dt->format("l Y-m-d H:i:s\n");















































    $today = $dt->format("Y-m-d");















































    if($dt->format("l")!='Friday')















































    {















































       $found = 0;















































       $found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');















































       if($found==0)















































       $day_count++;































































































       }















































}































































































}















































  echo $day_count;















































?></td>
      <td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (2)';































































































				$dumping = mysql_query($dd);















































				$day_count = '';















































				$last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';















































				while($leave_d = mysql_fetch_object($dumping)){































































































				 $d = date_parse_from_format("Y-m-d", $leave_d->e_date);















































                  $next_m =  $d["month"];































































































				   if($_POST['mon']<$next_m){































































































				   $e_date = $last_date;































































































				   }else{















































				   $e_date = $leave_d->e_date;















































				   }















































































































































































































































				$s_date = $leave_d->s_date;















































































































































































































































				$e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));































































































		 $begin = new DateTime($s_date);















































        $end = new DateTime($e_date);































































      $interval = DateInterval::createFromDateString('1 day');















































      $period = new DatePeriod($begin, $interval, $end);















































































































    foreach ($period as $dt) {































































































     $dt->format("l Y-m-d H:i:s\n");















































    $today = $dt->format("Y-m-d");















































    if($dt->format("l")!='Friday')















































    {















































       $found = 0;















































       $found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');















































       if($found==0)















































       $day_count++;































































































       }















































}































































































}















































  echo $day_count;















































?></td>
      <td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (3)';































































































				$dumping = mysql_query($dd);















































				$day_count = '';















































				$last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';















































				while($leave_d = mysql_fetch_object($dumping)){































































































				 $d = date_parse_from_format("Y-m-d", $leave_d->e_date);















































                  $next_m =  $d["month"];































































































				   if($_POST['mon']<$next_m){































































































				   $e_date = $last_date;































































































				   }else{















































				   $e_date = $leave_d->e_date;















































				   }































				$s_date = $leave_d->s_date;























         $e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));































































































		 $begin = new DateTime($s_date);















































        $end = new DateTime($e_date);































































      $interval = DateInterval::createFromDateString('1 day');















































      $period = new DatePeriod($begin, $interval, $end);















































































































    foreach ($period as $dt) {































































































     $dt->format("l Y-m-d H:i:s\n");















































    $today = $dt->format("Y-m-d");















































    if($dt->format("l")!='Friday')















































    {















































       $found = 0;















































       $found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');















































       if($found==0)















































       $day_count++;































































































       }















































}































































































}















































  echo $day_count;















































?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type="Short Leave (SHL)" and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'') ?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=4 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=6 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=8 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=7 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=5 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td align="center"><?=($data->lt>0)? $data->lt : '';?></td>
      <td align="center"><?=($data->lwp>0)? $data->lwp : '';?></td>
      <td align="center"><?=($data->ab>0)? $data->ab : '';?></td>
      <td align="center"><?=($data->pay>0)? $data->pay : '';?></td>
      <td align="right"><?=($data->gross_salary>0)? $data->gross_salary : '';               $totGross += $data->gross_salary?></td>
      <td align="right"><?=($data->basic_salary>0)? $data->basic_salary : '';               $totBasic += $data->basic_salary?></td>
      <td align="right"><?=($data->house_rent>0)? $data->house_rent : '';                   $totHouse += $data->house_rent?></td>
      <td align="right"><?=($data->medical_allowance>0)? $data->medical_allowance : '';     $totMedical += $data->medical_allowance?></td>
      <td align="right"><?=($data->special_allowance>0)? $data->special_allowance : '';     $totspecial += $data->special_allowance?></td>
			<?php /*?>
      <td align="right"><?=($data->food_allowance>0)? $data->food_allowance : '';           $totFood += $data->food_allowance?></td>
      <td align="right"><?=($data->transport_allowance>0)? $data->transport_allowance :''; $totTransport += $data->transport_allowance?></td>
      <td align="right"><?=($data->offday_allowance>0)? $data->offday_allowance :''; $totOffday += $data->offday_allowance?></td>
      <td align="right"><?=($data->sitevisit_allowance>0)? $data->sitevisit_allowance :''; $totSitevisit += $data->sitevisit_allowance?></td>
      <td align="right"><?=($data->other_allowance>0)? $data->other_allowance :'';        $totOther += $data->other_allowance?></td>
      <td align="right"><? if($data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance>0)
			{echo $data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance;
      $totAllowance +=$data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance;
      }?></td>
      <?php */?>

      <td align="right"><?=($data->over_time_hour>0)? $data->over_time_hour : '';           $totOverTimeHr += $data->over_time_hour?></td>
      <td align="right"><?=($data->over_time_amount>0)? $data->over_time_amount : '';       $totOverTimeAmt += $data->over_time_amount?></td>
      <td align="right"><?=($data->adjustment_amount>0)? number_format($data->adjustment_amount,0) : '';       $totAdjustmentAmt += $data->adjustment_amount?></td>
      <td align="right"><?=($data->mobile_deduction>0)? $data->mobile_deduction : '';       $totMobileDeduct += $data->mobile_deduction?></td>
      <td align="right"><?=($data->income_tax>0)? $data->income_tax : '';                   $totIincomeTax += $data->income_tax?></td>
      <td align="right"><?=($data->food_deduction>0)? $data->food_deduction : '';           $totFoodDeduct += $data->food_deduction?></td>
      <td align="right"><?=($data->advance_install || $data->other_install>0)? $data->advance_install+$data->other_install : '';         $totAdvInstall += $data->advance_install+$data->other_install?></td>
      <td align="right"><?=($data->absent_deduction>0)? $data->absent_deduction : '';       $totAbsentDeduct += $data->absent_deduction?></td>
      <td align="right"><?=($data->lwp_deduction>0)? $data->lwp_deduction : '';             $totLwpDeduct += $data->lwp_deduction?></td>
      <td align="right"><?=($data->late_deduction>0)? $data->late_deduction : '';           $totLateDeduct += $data->late_deduction?></td>
      <td align="right"><?=($data->hr_action_amt>0)? $data->hr_action_amt : '';           $totHrAcDeduct += $data->hr_action_amt?></td>
      <td align="right"><?=($data->joining_deduction>0)? $data->joining_deduction : '';           $deduction_total_amount += $data->joining_deduction?></td>
      <td align="right"><?=($tot_ded>0)? $tot_ded : '';       $totOtherDeduct += $tot_ded?></td>
      <td align="right"><? echo ($data->total_deduction || $data->joining_deduction >0)? $data->total_deduction+$data->joining_deduction: '';   $totTotalDeduct += $data->total_deduction+$data->joining_deduction?></td>
      <td align="right"><? echo ($data->total_earning>0)? $data->total_earning : '';        $total_cash_earning = $total_cash_earning + $data->total_earning;?></td>
      <td align="right"><? echo ($data->total_payable>0)? $data->total_payable : '';        $total_cash = $total_cash + $data->total_payable;?></td>
      <td><?=($data->cash>0)? $data->cash : '';?></td>
      <td nowrap="nowrap" style="width:110px;">&nbsp;&nbsp;&nbsp;<?=($data->card_no>0)? $data->card_no : '';?>&nbsp;&nbsp;&nbsp;</td>
    <?
$hr_action_remarks = find_a_field('admin_action_detail','ADMIN_ACTION_SUBJECT','EFFECT_MON="'.$_POST['mon'].'" and EFFECT_YEAR="'.$_POST['year'].'" and PBI_ID="'.$data->PBI_ID.'" ');
  ?>
      <? if($data->remarks_details!=''){ ?>
      <td nowrap="nowrap" style="width:150px;"><?=$data->remarks_details?></td>
      <? } else{?>
      <td nowrap="nowrap" style="width:150px;"><?=$hr_action_remarks?></td>
      <? } ?>
    </tr>
    <? } ?>


    <tr>
      <td align="right" colspan="18" style="font-weight:bold;">Total:</td>
      <td align="right"><strong>
        <?=($totGross>0)? number_format($totGross,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totBasic>0)? number_format($totBasic,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHouse>0)? number_format($totHouse,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMedical>0)? number_format($totMedical,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totspecial>0)? number_format($totspecial,0) : '';?>
        </strong></td>

			<?php /*?>
      <td align="right"><strong><?=($totFood>0)? number_format($totFood,0) : '';?></strong></td>
      <td align="right"><strong><?=($totTransport>0)? number_format($totTransport,0) : '';?></strong></td>
      <td align="right"><strong><?=($totOffday>0)? number_format($totOffday,0) : '';?></strong></td>
      <td align="right"><strong><?=($totSitevisit>0)? number_format($totSitevisit,0) : '';?></strong></td>
      <td align="right"><strong><?=($totOther>0)? number_format($totOther,0) : '';?></strong></td>
      <td align="right"><strong><?=($totAllowance>0)? number_format($totAllowance,0) : '';?></strong></td>
			<?php */?>
      <td align="right"><strong>
        <?=($totOverTimeHr>0)? number_format($totOverTimeHr,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeAmt>0)? number_format($totOverTimeAmt,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdjustmentAmt>0)? number_format($totAdjustmentAmt,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMobileDeduct>0)? number_format($totMobileDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totIincomeTax>0)? number_format($totIincomeTax,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFoodDeduct>0)? number_format($totFoodDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdvInstall>0)? number_format($totAdvInstall,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAbsentDeduct>0)? number_format($totAbsentDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totLwpDeduct>0)? number_format($totLwpDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totLateDeduct>0)? number_format($totLateDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHrAcDeduct>0)? number_format($totHrAcDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($deduction_total_amount>0)? number_format($deduction_total_amount,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOtherDeduct>0)? number_format($totOtherDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totTotalDeduct>0)? number_format($totTotalDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($total_cash_earning>0)? number_format($total_cash_earning,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($total_cash>0)? number_format($total_cash,0) : '';?>
        </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?
echo convertNumberMhafuz($total_cash);
?>
<br>
<br>
<br>
<div class="table-responsive"></div>
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



<?
}
if($_POST['report']==776){
?>
<table width="1800px" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="6" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px;" colspan="30"><?=$str?></td>
    </tr>
    <tr>
      <th rowspan="3"><div align="center">S/L</div></th>
      <th rowspan="3"><div align="center">ID</div></th>
      <th rowspan="3"><div align="center">Name</div></th>
      <th rowspan="3"><div align="center">Designation</div></th>
      <th rowspan="3" nowrap="nowrap">Joining Date</th>
      <th colspan="13" align="center"><div align="center">Attendance</div></th>
      <th colspan="5"><div align="center">Salary and Allowance</div></th>
			<!--
      <th colspan="3">Extra Allowance</th>
			-->
      <th rowspan="3">OT. Hrs.</th>
      <th rowspan="3">OT. Amt.</th>

      <th rowspan="3"><div align="center">Salary Adjustment</div></th>
      <th colspan="10" align="center"><div align="center">Deduction</div></th>
      <th rowspan="3"><div align="center">Total Deduction</div></th>
      <th rowspan="3" align="center"><div align="center">Net Salary</div></th>
      <th rowspan="3" align="center"><div align="center">Net Payable Salary</div></th>
      <th rowspan="3"><div align="center">Bank A/C</div></th>
      <th rowspan="3"><div align="center">Payroll Card No</div></th>
      <th rowspan="3" style="width:20%;text-align:center">Remarks</th>
    </tr>
    <tr>
      <th colspan="9"><div align="center">No of Leave's</div></th>

      <th rowspan="2"><div align="center">LP</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2">AB</th>


      <th rowspan="2"><div align="center">Total Days Works</div></th>

      <th>Gross</th>
      <th>Basic</th>
      <th><div align="center">House Rent</div></th>
      <th>Medical</th>
      <th>Conveyance</th>
			<!--
      <th rowspan="2">Food</th>
      <th rowspan="2">Transport</th>
      <th rowspan="2">Other</th>
      -->

      <th rowspan="2">Mobile</th>
      <th rowspan="2">Tax</th>
      <th rowspan="2">Food</th>
      <th rowspan="2"><div align="center">Loan /Advance</div></th>
      <th rowspan="2"><div align="center">Absent</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2"><div align="center">Late</div></th>
      <th rowspan="2"><div align="center">HR Action</div></th>
      <th rowspan="2"><div align="center">Joining Deduction</div></th>
      <th rowspan="2">Others</th>
    </tr>
    <tr>
      <th>CL</th>
      <th>SL</th>
      <th>AL</th>
      <th>SHL</th>
      <th>ML</th>
      <th>PL</th>
      <th>EOL</th>
      <th>HL</th>
      <th>MLV</th>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
      <th><div align="center">25%</div></th>
      <th><div align="center">15%</div></th>
      <th><div align="center">10%</div></th>
    </tr>
  </thead>
  <tbody>
    <?



$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');



 if($found==0){



if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];
if ($_POST['job_status'] !='')
$salaryConCash .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
  from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash like "Cash" order by t.gross_salary desc';
} else{

$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID '.$con.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash IN ("1","5")   order by t.total_payable desc';
}
 }else{

if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];


 $sqld = 'select t.*,i.*,a.PBI_ID, a.PBI_NAME, a.PBI_DOJ,a.PBI_CODE, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND
t.bank_or_cash like "Cash" order by t.gross_salary desc';

} else{


  $sqld = 'select t.*,a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION ,a.PBI_CODE, a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.'
 AND t.bank_or_cash IN ("1","5")  order by t.total_payable desc';


}


}


$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
 $entry_by=$data->entry_by;



 //for salary condition



 $salary_given_status=find_a_field('salary_attendence','bank_or_cash','PBI_ID='.$data->PBI_ID.' and mon='.$_POST['mon'].' and year='.$_POST['year'].'');



 //Total deductions
 //$mobile_deductions = $data->mobile_deduction;

 $mobile_deductions= find_a_field('salary_attendence','mobile_deduction','PBI_ID='.$data->PBI_ID.' and bank_or_cash=1 and mon='.$_POST['mon'].' and year='.$_POST['year'].'');

//$food_deductions = $data->food_deduction;




?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->Designation?></td>
      <td><?=date('d-M-Y',strtotime($data->PBI_DOJ))?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=1 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=2 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=3 and
      leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>

      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type="Short Leave (SHL)" and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=4 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=6 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=8 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=7 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=5 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td align="center"><?=($data->lt>0)? $data->lt : '';?></td>
      <td align="center"><?=($data->lwp>0)? $data->lwp : '';?></td>
      <td align="center"><?=($data->ab>0)? $data->ab : '';?></td>


      <td align="center"><?=($data->pay>0)? $data->pay : '';?></td>

      <!--FOR TAX -->
      <?php  if($salary_given_status==5){ ?>
      <td align="right"><?=($data->cash_amt>0)? $data->cash_amt : '';               $totGross += $data->cash_amt?></td>
      <td align="right"><?=($data->cash_amt>0)? $data->cash_amt/100*50 : '';     $totBasic += $data->cash_amt/100*50?></td>
      <td align="right"><?=($data->cash_amt>0)? $data->cash_amt/100*25: '';         $totHouse += $data->cash_amt/100*25?></td>
      <td align="right"><?=($data->cash_amt>0)? $data->cash_amt/100*15: ''; $totMedical += $data->cash_amt/100*15?></td>
      <td align="right"><?=($data->cash_amt>0)? $data->cash_amt/100*10 : ''; $totspecial += $data->cash_amt/100*10?></td>
      <?php  }else{  ?>
      <td align="right"><?=($data->gross_salary>0)? $data->gross_salary : '';               $totGross += $data->gross_salary?></td>
      <td align="right"><?=($data->basic_salary>0)? $data->basic_salary : '';               $totBasic += $data->basic_salary?></td>
      <td align="right"><?=($data->house_rent>0)? $data->house_rent : '';                   $totHouse += $data->house_rent?></td>
      <td align="right"><?=($data->medical_allowance>0)? $data->medical_allowance : '';     $totMedical += $data->medical_allowance?></td>
      <td align="right"><?=($data->special_allowance>0)? $data->special_allowance : '';     $totspecial += $data->special_allowance?></td>
      <?php  } ?>
      <!--END FOR TAX -->
      <?php  if($salary_given_status==5){ ?>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td>
			<!--
      <td align="right"></td>
      <td align="right"></td>
      <td align="right"></td> -->
      <?php  }else{  ?>

			<?php /*?>
      <td align="right"><?=($data->food_allowance>0)? $data->food_allowance : '';           $totFood += $data->food_allowance?></td>
      <td align="right" style="font-weight:bold;"><?=($data->transport_allowance>0)? $data->transport_allowance : ''; $totTransport += $data->transport_allowance?></td>
      <td align="right"><?=($data->other_allowance>0)? $data->other_allowance : '';           $totOther += $data->other_allowance?></td>
      <?php */?>

      <td align="right"><?=($data->over_time_hour>0)? $data->over_time_hour : '';           $totOverTimeHr += $data->over_time_hour?></td>
      <td align="right"><?=($data->over_time_amount>0)? $data->over_time_amount : '';       $totOverTimeAmt += $data->over_time_amount?></td>
      <td align="right"><?=($data->adjustment_amount>0)? $data->adjustment_amount : '';       $totAdjustment += $data->adjustment_amount?></td>
      <td align="right"><?=($mobile_deductions>0)? $mobile_deductions : '';       $totMobileDeduct += $mobile_deductions?></td>
      <td align="right"><?=($data->income_tax>0)? $data->income_tax : '';                   $totIincomeTax += $data->income_tax?></td>
      <td align="right"><?=($data->food_deduction>0)? $data->food_deduction : '';           $totFoodDeduct += $data->food_deduction?></td>
      <td align="right"><?=($data->advance_install>0)? $data->advance_install : '';         $totAdvInstall += $data->advance_install?></td>
      <td align="right"><?=($data->absent_deduction>0)? $data->absent_deduction : '';       $totAbsentDeduct += $data->absent_deduction?></td>
      <td align="right"><?=($data->lwp_deduction>0)? $data->lwp_deduction : '';             $totLwpDeduct += $data->lwp_deduction?></td>
      <td align="right"><?=($data->late_deduction>0)? $data->late_deduction : '';           $totLateDeduct += $data->late_deduction?></td>
      <td align="right"><?=($data->hr_action_amt>0)? $data->hr_action_amt : '';           $totHrActionDeduct += $data->hr_action_amt?></td>
      <td align="right"><?=($data->joining_deduction>0)? $data->joining_deduction : '';   $totJoiningDeduct += $data->joining_deduction?></td>
      <td align="right"><?=($data->other_deductions>0)? $data->other_deductions : '';       $totOtherDeduct += $data->other_deductions?></td>
      <td align="right"><?=($data->total_deduction>0 ||$data->joining_deduction>0)? $data->total_deduction+$data->joining_deduction : '';         $totTotalDeduct += $data->total_deduction+$data->joining_deduction?></td>
      <?php  } ?>
<?php
$total_cash = $total_cash+$data->transport_allowance;
?>
      <?php  if($salary_given_status==5){ ?>
      <td align="right"><? echo ($data->cash_amt>0)? $data->cash_amt : '';        $total_cash_earning = $total_cash_earning + $data->cash_amt;?></td>
      <?php  }else{  ?>
      <td align="right"><? echo ($data->total_earning>0)? $data->total_earning : '';        $total_cash_earning = $total_cash_earning + $data->total_earning;?></td>
      <?php  } ?>
      <?php  if($salary_given_status==5){ ?>
      <td align="right"><? echo ($data->cash_amt>0)? $data->cash_amt : '';        $total_cash = $total_cash + $data->cash_amt;?></td>
      <?php  }else{  ?>
      <td align="right"><? echo ($data->total_payable>0)? $data->total_payable : '';        $total_cash = $total_cash + $data->total_payable;?></td>
      <?php  } ?>
      <td><?=($data->cash>0)? $data->cash : '';?></td>
      <td><?=($data->card_no>0)? $data->card_no : '';?></td>
      <td nowrap="nowrap" style="">&nbsp;</td>
    </tr>
    <? } ?>
    <tr>
      <td colspan="10" align="right" style="font-weight:bold;">Total:</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><strong>
        <?=($totGross>0)? $totGross : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totBasic>0)? $totBasic : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHouse>0)? $totHouse : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMedical>0)? $totMedical : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totspecial>0)? $totspecial : '';?>
        </strong></td>
			<?php /*?>
      <td align="right"><strong><?=($totFood>0)? $totFood : '';?></strong></td>
      <strong><td align="right"><?=($totTransport>0)? $totTransport : '';?></td></strong>
      <td align="right"><strong><?=($totOther>0)? $totOther : '';?></strong></td>
      <?php */?>


      <td align="right"><strong>
        <?=($totOverTimeHr>0)? $totOverTimeHr : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeAmt>0)? $totOverTimeAmt : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdjustment>0)? $totAdjustment : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMobileDeduct>0)? $totMobileDeduct : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totIincomeTax>0)? number_format($totIincomeTax) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFoodDeduct>0)? number_format($totFoodDeduct) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdvInstall>0)? number_format($totAdvInstall) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAbsentDeduct>0)? number_format($totAbsentDeduct) : '';?>
        </strong></td>
      <td align="right"><b>
        <?=($totLwpDeduct>0)? number_format($totLwpDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totLateDeduct>0)? number_format($totLateDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totHrActionDeduct>0)? number_format($totHrActionDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totJoiningDeduct>0)? number_format($totJoiningDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totOtherDeduct>0)? number_format($totOtherDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=number_format($totTotalDeduct);?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash_earning>0)? number_format($total_cash_earning) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash>0)? number_format($total_cash) : '';?>
        </b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?
echo convertNumberMhafuz($total_cash);
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>



<!--Salary report Bkash portion  -->



<?
}
if($_POST['report']==782){
?>
<table width="1800px" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="6" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px;" colspan="30"><?=$str?></td>
    </tr>
    <tr>
      <th rowspan="3"><div align="center">S/L</div></th>
      <th rowspan="3"><div align="center">ID</div></th>
      <th rowspan="3"><div align="center">Name</div></th>
      <th rowspan="3"><div align="center">Designation</div></th>
      <th rowspan="3" nowrap="nowrap">Joining Date</th>
      <th colspan="13" align="center"><div align="center">Attendance</div></th>
      <th colspan="5"><div align="center">Salary and Allowance</div></th>
			<!--
      <th colspan="3">Extra Allowance</th>
			-->
      <th rowspan="3">OT. Hrs.</th>
      <th rowspan="3">OT. Amt.</th>

      <th rowspan="3"><div align="center">Salary Adjustment</div></th>
      <th colspan="10" align="center"><div align="center">Deduction</div></th>
      <th rowspan="3"><div align="center">Total Deduction</div></th>
      <th rowspan="3" align="center"><div align="center">Net Salary</div></th>
      <th rowspan="3" align="center"><div align="center">Net Payable Salary</div></th>
      <th rowspan="3"><div align="center">Bkash No</div></th>

      <th rowspan="3" style="width:20%;text-align:center">Remarks</th>
    </tr>
    <tr>
      <th colspan="9"><div align="center">No of Leave's</div></th>

      <th rowspan="2"><div align="center">LP</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2">AB</th>


      <th rowspan="2"><div align="center">Total Days Works</div></th>

      <th>Gross</th>
      <th>Basic</th>
      <th><div align="center">House Rent</div></th>
      <th>Medical</th>
      <th>Conveyance</th>
			<!--
      <th rowspan="2">Food</th>
      <th rowspan="2">Transport</th>
      <th rowspan="2">Other</th>
      -->

      <th rowspan="2">Mobile</th>
      <th rowspan="2">Tax</th>
      <th rowspan="2">Food</th>
      <th rowspan="2"><div align="center">Loan /Advance</div></th>
      <th rowspan="2"><div align="center">Absent</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2"><div align="center">Late</div></th>
      <th rowspan="2"><div align="center">HR Action</div></th>
      <th rowspan="2"><div align="center">Joining Deduction</div></th>
      <th rowspan="2">Others</th>
    </tr>
    <tr>
      <th>CL</th>
      <th>SL</th>
      <th>AL</th>
      <th>SHL</th>
      <th>ML</th>
      <th>PL</th>
      <th>EOL</th>
      <th>HL</th>
      <th>MLV</th>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
      <th><div align="center">25%</div></th>
      <th><div align="center">15%</div></th>
      <th><div align="center">10%</div></th>
    </tr>
  </thead>
  <tbody>
    <?



$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');



 if($found==0){



if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];
if ($_POST['job_status'] !='')
$salaryConCash .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
  from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash IN ("6") order by t.gross_salary desc';
} else{

$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,
d.DESG_SHORT_NAME as Designation
from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID '.$con.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash IN ("6")  order by t.total_payable desc';
}
 }else{

if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];


 $sqld = 'select t.*,i.*,a.PBI_ID, a.PBI_NAME, a.PBI_DOJ,a.PBI_CODE, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND
t.bank_or_cash IN ("6") order by t.gross_salary desc';

} else{


  $sqld = 'select t.*,a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION ,a.PBI_CODE, a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.'
 AND t.bank_or_cash IN ("6")  order by t.total_payable desc';


}


}


$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
 $entry_by=$data->entry_by;



$salary_given_status=find_a_field('salary_attendence','bank_or_cash','PBI_ID='.$data->PBI_ID.' and mon='.$_POST['mon'].' and year='.$_POST['year'].'');

$mobile_deductions= find_a_field('salary_attendence','mobile_deduction','PBI_ID='.$data->PBI_ID.' and bank_or_cash=6 and mon='.$_POST['mon'].' and year='.$_POST['year'].'');


?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->Designation?></td>
      <td><?=date('d-M-Y',strtotime($data->PBI_DOJ))?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=1 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=2 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=3 and
      leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>

      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type="Short Leave (SHL)" and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=4 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=6 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=8 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=7 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=5 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td align="center"><?=($data->lt>0)? $data->lt : '';?></td>
      <td align="center"><?=($data->lwp>0)? $data->lwp : '';?></td>
      <td align="center"><?=($data->ab>0)? $data->ab : '';?></td>


      <td align="center"><?=($data->pay>0)? $data->pay : '';?></td>

      <!--FOR TAX -->

      <td align="right"><?=($data->gross_salary>0)? $data->gross_salary : '';               $totGross += $data->gross_salary?></td>
      <td align="right"><?=($data->basic_salary>0)? $data->basic_salary : '';               $totBasic += $data->basic_salary?></td>
      <td align="right"><?=($data->house_rent>0)? $data->house_rent : '';                   $totHouse += $data->house_rent?></td>
      <td align="right"><?=($data->medical_allowance>0)? $data->medical_allowance : '';     $totMedical += $data->medical_allowance?></td>
      <td align="right"><?=($data->special_allowance>0)? $data->special_allowance : '';     $totspecial += $data->special_allowance?></td>

      <!--END FOR TAX -->


			<?php /*?>
      <td align="right"><?=($data->food_allowance>0)? $data->food_allowance : '';           $totFood += $data->food_allowance?></td>
      <td align="right" style="font-weight:bold;"><?=($data->transport_allowance>0)? $data->transport_allowance : ''; $totTransport += $data->transport_allowance?></td>
      <td align="right"><?=($data->other_allowance>0)? $data->other_allowance : '';           $totOther += $data->other_allowance?></td>
      <?php */?>

      <td align="right"><?=($data->over_time_hour>0)? $data->over_time_hour : '';           $totOverTimeHr += $data->over_time_hour?></td>
      <td align="right"><?=($data->over_time_amount>0)? $data->over_time_amount : '';       $totOverTimeAmt += $data->over_time_amount?></td>
      <td align="right"><?=($data->adjustment_amount>0)? $data->adjustment_amount : '';       $totAdjustment += $data->adjustment_amount?></td>
      <td align="right"><?=($mobile_deductions>0)? $mobile_deductions : '';       $totMobileDeduct += $mobile_deductions?></td>
      <td align="right"><?=($data->income_tax>0)? $data->income_tax : '';                   $totIincomeTax += $data->income_tax?></td>
      <td align="right"><?=($data->food_deduction>0)? $data->food_deduction : '';           $totFoodDeduct += $data->food_deduction?></td>
      <td align="right"><?=($data->advance_install>0)? $data->advance_install : '';         $totAdvInstall += $data->advance_install?></td>
      <td align="right"><?=($data->absent_deduction>0)? $data->absent_deduction : '';       $totAbsentDeduct += $data->absent_deduction?></td>
      <td align="right"><?=($data->lwp_deduction>0)? $data->lwp_deduction : '';             $totLwpDeduct += $data->lwp_deduction?></td>
      <td align="right"><?=($data->late_deduction>0)? $data->late_deduction : '';           $totLateDeduct += $data->late_deduction?></td>
      <td align="right"><?=($data->hr_action_amt>0)? $data->hr_action_amt : '';           $totHrActionDeduct += $data->hr_action_amt?></td>
      <td align="right"><?=($data->joining_deduction>0)? $data->joining_deduction : '';   $totJoiningDeduct += $data->joining_deduction?></td>
      <td align="right"><?=($data->other_deductions>0)? $data->other_deductions : '';       $totOtherDeduct += $data->other_deductions?></td>
      <td align="right"><?=($data->total_deduction>0 ||$data->joining_deduction>0)?
      $data->total_deduction+$data->joining_deduction : ''; $totTotalDeduct += $data->total_deduction+$data->joining_deduction?></td>

<?php
$total_cash = $total_cash+$data->transport_allowance;
?>

      <td align="right"><? echo ($data->total_earning>0)? $data->total_earning : '';
      $total_cash_earning = $total_cash_earning + $data->total_earning;?></td>


      <td align="right"><? echo ($data->bkash_amt>0)? $data->bkash_amt : '';        $total_cash = $total_cash + $data->bkash_amt;?></td>

      <td>&nbsp;&nbsp;&nbsp;<?=($data->bkash_no>0)? $data->bkash_no : '';?>&nbsp;&nbsp;&nbsp;</td>

      <td nowrap="nowrap">&nbsp;</td>
    </tr>
    <? } ?>
    <tr>
      <td colspan="10" align="right" style="font-weight:bold;">Total:</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><strong>
        <?=($totGross>0)? $totGross : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totBasic>0)? $totBasic : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHouse>0)? $totHouse : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMedical>0)? $totMedical : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totspecial>0)? $totspecial : '';?>
        </strong></td>
			<?php /*?>
      <td align="right"><strong><?=($totFood>0)? $totFood : '';?></strong></td>
      <strong><td align="right"><?=($totTransport>0)? $totTransport : '';?></td></strong>
      <td align="right"><strong><?=($totOther>0)? $totOther : '';?></strong></td>
      <?php */?>


      <td align="right"><strong>
        <?=($totOverTimeHr>0)? $totOverTimeHr : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeAmt>0)? $totOverTimeAmt : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdjustment>0)? $totAdjustment : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMobileDeduct>0)? $totMobileDeduct : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totIincomeTax>0)? number_format($totIincomeTax) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFoodDeduct>0)? number_format($totFoodDeduct) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdvInstall>0)? number_format($totAdvInstall) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAbsentDeduct>0)? number_format($totAbsentDeduct) : '';?>
        </strong></td>
      <td align="right"><b>
        <?=($totLwpDeduct>0)? number_format($totLwpDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totLateDeduct>0)? number_format($totLateDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totHrActionDeduct>0)? number_format($totHrActionDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totJoiningDeduct>0)? number_format($totJoiningDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totOtherDeduct>0)? number_format($totOtherDeduct) : '';?>
        </b></td>
      <td align="right"><b>
       <?=($totTotalDeduct>0)? number_format($totTotalDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash_earning>0)? number_format($total_cash_earning) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash>0)? number_format($total_cash) : '';?>
        </b></td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?
echo convertNumberMhafuz($total_cash);
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>






<!--Salary report NAGAD portion  -->



<?
}
if($_POST['report']==783){
?>
<table width="1800px" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="6" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px;" colspan="30"><?=$str?></td>
    </tr>
    <tr>
      <th rowspan="3"><div align="center">S/L</div></th>
      <th rowspan="3"><div align="center">ID</div></th>
      <th rowspan="3"><div align="center">Name</div></th>
      <th rowspan="3"><div align="center">Designation</div></th>
      <th rowspan="3" nowrap="nowrap">Joining Date</th>
      <th colspan="13" align="center"><div align="center">Attendance</div></th>
      <th colspan="5"><div align="center">Salary and Allowance</div></th>
			<!--
      <th colspan="3">Extra Allowance</th>
			-->
      <th rowspan="3">OT. Hrs.</th>
      <th rowspan="3">OT. Amt.</th>

      <th rowspan="3"><div align="center">Salary Adjustment</div></th>
      <th colspan="10" align="center"><div align="center">Deduction</div></th>
      <th rowspan="3"><div align="center">Total Deduction</div></th>
      <th rowspan="3" align="center"><div align="center">Net Salary</div></th>
      <th rowspan="3" align="center"><div align="center">Net Payable Salary</div></th>
      <th rowspan="3"><div align="center">Nagad No</div></th>

      <th rowspan="3" style="width:20%;text-align:center">Remarks</th>
    </tr>
    <tr>
      <th colspan="9"><div align="center">No of Leave's</div></th>

      <th rowspan="2"><div align="center">LP</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2">AB</th>


      <th rowspan="2"><div align="center">Total Days Works</div></th>

      <th>Gross</th>
      <th>Basic</th>
      <th><div align="center">House Rent</div></th>
      <th>Medical</th>
      <th>Conveyance</th>
			<!--
      <th rowspan="2">Food</th>
      <th rowspan="2">Transport</th>
      <th rowspan="2">Other</th>
      -->

      <th rowspan="2">Mobile</th>
      <th rowspan="2">Tax</th>
      <th rowspan="2">Food</th>
      <th rowspan="2"><div align="center">Loan /Advance</div></th>
      <th rowspan="2"><div align="center">Absent</div></th>
      <th rowspan="2">LWP</th>
      <th rowspan="2"><div align="center">Late</div></th>
      <th rowspan="2"><div align="center">HR Action</div></th>
      <th rowspan="2"><div align="center">Joining Deduction</div></th>
      <th rowspan="2">Others</th>
    </tr>
    <tr>
      <th>CL</th>
      <th>SL</th>
      <th>AL</th>
      <th>SHL</th>
      <th>ML</th>
      <th>PL</th>
      <th>EOL</th>
      <th>HL</th>
      <th>MLV</th>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
      <th><div align="center">25%</div></th>
      <th><div align="center">15%</div></th>
      <th><div align="center">10%</div></th>
    </tr>
  </thead>
  <tbody>
    <?



$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');



 if($found==0){



if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];
if ($_POST['job_status'] !='')
$salaryConCash .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
  from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash IN ("7") order by t.gross_salary desc';
} else{

$sqld = 'select t.*,i.*, a.PBI_ID, a.PBI_NAME,a.PBI_CODE, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,
d.DESG_SHORT_NAME as Designation
from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID '.$con.' and i.PBI_ID = t.PBI_ID AND t.bank_or_cash IN ("7")  order by t.total_payable desc';
}
 }else{

if($_POST['mon']<10 && $_POST['year']<=2017){
if($_POST['PBI_ORG']!='')
$salaryConCash =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConCash .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryConCash .= ' and t.department='.$_POST['department'];


 $sqld = 'select t.*,i.*,a.PBI_ID, a.PBI_NAME, a.PBI_DOJ,a.PBI_CODE, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i
where t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$salaryConCash.' and i.PBI_ID = t.PBI_ID AND
t.bank_or_cash IN ("7") order by t.gross_salary desc';

} else{


  $sqld = 'select t.*,a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION ,a.PBI_CODE, a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a
where a.PBI_DESIGNATION = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.'
 AND t.bank_or_cash IN ("7")  order by t.total_payable desc';


}


}


$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
 $entry_by=$data->entry_by;



$salary_given_status=find_a_field('salary_attendence','bank_or_cash','PBI_ID='.$data->PBI_ID.' and mon='.$_POST['mon'].' and
	year='.$_POST['year'].'');

$mobile_deductions= find_a_field('salary_attendence','mobile_deduction','PBI_ID='.$data->PBI_ID.' and
	bank_or_cash=7 and mon='.$_POST['mon'].' and year='.$_POST['year'].'');


?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->Designation?></td>
      <td><?=date('d-M-Y',strtotime($data->PBI_DOJ))?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=1 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=2 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=3 and
      leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>

      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type="Short Leave (SHL)" and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=4 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=6 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=8 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=7 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=5 and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'')?></td>


      <td align="center"><?=($data->lt>0)? $data->lt : '';?></td>
      <td align="center"><?=($data->lwp>0)? $data->lwp : '';?></td>
      <td align="center"><?=($data->ab>0)? $data->ab : '';?></td>


      <td align="center"><?=($data->pay>0)? $data->pay : '';?></td>

      <!--FOR TAX -->

      <td align="right"><?=($data->gross_salary>0)? $data->gross_salary : '';               $totGross += $data->gross_salary?></td>
      <td align="right"><?=($data->basic_salary>0)? $data->basic_salary : '';               $totBasic += $data->basic_salary?></td>
      <td align="right"><?=($data->house_rent>0)? $data->house_rent : '';                   $totHouse += $data->house_rent?></td>
      <td align="right"><?=($data->medical_allowance>0)? $data->medical_allowance : '';     $totMedical += $data->medical_allowance?></td>
      <td align="right"><?=($data->special_allowance>0)? $data->special_allowance : '';     $totspecial += $data->special_allowance?></td>

      <!--END FOR TAX -->




      <td align="right"><?=($data->over_time_hour>0)? $data->over_time_hour : '';           $totOverTimeHr += $data->over_time_hour?></td>
      <td align="right"><?=($data->over_time_amount>0)? $data->over_time_amount : '';       $totOverTimeAmt += $data->over_time_amount?></td>
      <td align="right"><?=($data->adjustment_amount>0)? $data->adjustment_amount : '';       $totAdjustment += $data->adjustment_amount?></td>
      <td align="right"><?=($mobile_deductions>0)? $mobile_deductions : '';       $totMobileDeduct += $mobile_deductions?></td>
      <td align="right"><?=($data->income_tax>0)? $data->income_tax : '';                   $totIincomeTax += $data->income_tax?></td>
      <td align="right"><?=($data->food_deduction>0)? $data->food_deduction : '';           $totFoodDeduct += $data->food_deduction?></td>
      <td align="right"><?=($data->advance_install>0)? $data->advance_install : '';         $totAdvInstall += $data->advance_install?></td>
      <td align="right"><?=($data->absent_deduction>0)? $data->absent_deduction : '';       $totAbsentDeduct += $data->absent_deduction?></td>
      <td align="right"><?=($data->lwp_deduction>0)? $data->lwp_deduction : '';             $totLwpDeduct += $data->lwp_deduction?></td>
      <td align="right"><?=($data->late_deduction>0)? $data->late_deduction : '';           $totLateDeduct += $data->late_deduction?></td>
      <td align="right"><?=($data->hr_action_amt>0)? $data->hr_action_amt : '';           $totHrActionDeduct += $data->hr_action_amt?></td>
      <td align="right"><?=($data->joining_deduction>0)? $data->joining_deduction : '';   $totJoiningDeduct += $data->joining_deduction?></td>
      <td align="right"><?=($data->other_deductions>0)? $data->other_deductions : '';       $totOtherDeduct += $data->other_deductions?></td>
      <td align="right"><?=($data->total_deduction>0 ||$data->joining_deduction>0)?
      $data->total_deduction+$data->joining_deduction : ''; $totTotalDeduct += $data->total_deduction+$data->joining_deduction?></td>

<?php
$total_cash = $total_cash+$data->transport_allowance;
?>

      <td align="right"><? echo ($data->total_earning>0)? $data->total_earning : '';
      $total_cash_earning = $total_cash_earning + $data->total_earning;?></td>


      <td align="right"><? echo ($data->nagad_amt>0)? $data->nagad_amt : '';        $total_cash = $total_cash + $data->nagad_amt;?></td>

      <td>&nbsp;&nbsp;&nbsp;<?=($data->nagad_no>0)? $data->nagad_no : '';?>&nbsp;&nbsp;&nbsp;</td>

      <td nowrap="nowrap" style="height:100px;">&nbsp;</td>
    </tr>
    <? } ?>
    <tr>
      <td colspan="10" align="right" style="font-weight:bold;">Total:</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><strong>
        <?=($totGross>0)? $totGross : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totBasic>0)? $totBasic : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHouse>0)? $totHouse : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMedical>0)? $totMedical : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totspecial>0)? $totspecial : '';?>
        </strong></td>
			<?php /*?>
      <td align="right"><strong><?=($totFood>0)? $totFood : '';?></strong></td>
      <strong><td align="right"><?=($totTransport>0)? $totTransport : '';?></td></strong>
      <td align="right"><strong><?=($totOther>0)? $totOther : '';?></strong></td>
      <?php */?>


      <td align="right"><strong>
        <?=($totOverTimeHr>0)? $totOverTimeHr : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeAmt>0)? $totOverTimeAmt : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdjustment>0)? $totAdjustment : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMobileDeduct>0)? $totMobileDeduct : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totIincomeTax>0)? number_format($totIincomeTax) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFoodDeduct>0)? number_format($totFoodDeduct) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdvInstall>0)? number_format($totAdvInstall) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAbsentDeduct>0)? number_format($totAbsentDeduct) : '';?>
        </strong></td>
      <td align="right"><b>
        <?=($totLwpDeduct>0)? number_format($totLwpDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totLateDeduct>0)? number_format($totLateDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totHrActionDeduct>0)? number_format($totHrActionDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totJoiningDeduct>0)? number_format($totJoiningDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totOtherDeduct>0)? number_format($totOtherDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($totTotalDeduct>0)? number_format($totTotalDeduct) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash_earning>0)? number_format($total_cash_earning) : '';?>
        </b></td>
      <td align="right"><b>
        <?=($total_cash>0)? number_format($total_cash) : '';?>
        </b></td>

      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?
echo convertNumberMhafuz($total_cash);
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>





<?

}

if($_POST['report']==283544){


?>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

 <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>



 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>



 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>


 <script>



$(document).ready(function() {



    $('#example').DataTable( {



    	paging: false,































    	searching: false,































        dom: 'Bfrtip',































        buttons: [































            'copyHtml5',































            'excelHtml5',































            'csvHtml5',































































            {































                extend: 'pdfHtml5',































                orientation: 'landscape',































                pageSize: 'TABLOID',































                customize : function(doc){































            var colCount = new Array();































            $(tbl).find('tbody tr:first-child td').each(function(){































                if($(this).attr('colspan')){































                    for(var i=1;i<=$(this).attr('colspan');$i++){































                        colCount.push('*');































                    }































                }else{ colCount.push('*'); }































            });































































        }































    }































































































        ]































    } );































} );































</script>-->
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="4" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px;"><div align="center" style="margin-left: -20%;">
          <?=$str?>
        </div></td>
    </tr>
  </thead>
</table>
<table id="" width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <th rowspan="3">S/L</th>
      <th rowspan="3"><div align="center">ID</div></th>
      <th rowspan="3"><div align="center">Name</div></th>
      <th rowspan="3"><div align="center">Designation</div></th>

			<th rowspan="3"><div align="center">DEPARTMENT</div></th>

			<th rowspan="3"><div align="center">PROJECT</div></th>

      <th rowspan="3" nowrap="nowrap"><div align="center">
        Joining Date</th>
      <th colspan="13" align="center"><div align="center">Attendance</div></th>
      <th colspan="5"><div align="center">Salary and Allowance</div></th>
      <th colspan="5"><div align="center">Extra Allowance</div></th>
      <th rowspan="3"><div align="center">Total Allowances</div></th>
      <th rowspan="3"><div align="center">OT. Hrs.</div></th>
      <th rowspan="3"><div align="center">OT. Amt.</div></th>
      <th rowspan="3"><div align="center">Salary Adjustment</div></th>
      <th colspan="10" align="center"><div align="center">Deduction</div></th>
      <th rowspan="3"><div align="center">Total Deduction</div></th>
      <th rowspan="3" align="center"><div align="center">Net Salary</div></th>
      <th rowspan="3" align="center"><div align="center">Net Payable Salary</div></th>
      <th rowspan="3"><div align="center">Bank A/C</div></th>
      <th rowspan="3"><div align="center">Payroll Card No</div></th>
      <th rowspan="3"><div align="center">Remarks</div></th>
    </tr>
    <tr>
      <th colspan="9"><div align="center">No of Leave's</div></th>
      <th rowspan="2"><div align="center">LP</div></th>
      <th rowspan="2"><div align="center">LWP</div></th>
      <th rowspan="2"><div align="center">AB</div></th>
      <th rowspan="2"><div align="center">Total Days Works</div></th>
      <th><div align="center">Gross</div></th>
      <th><div align="center">Basic</div></th>
      <th><div align="center">House Rent</div></th>
      <th><div align="center">Medical</div></th>
      <th><div align="center">Conveyance</div></th>
      <th rowspan="2"><div align="center">Food</div></th>
      <th rowspan="2"><div align="center">Transport</div></th>
      <th rowspan="2"><div align="center">Offday</div></th>
      <th rowspan="2"><div align="center">Site visit</div></th>
      <th rowspan="2"><div align="center">Others</div></th>
      <th rowspan="2"><div align="center">Mobile</div></th>
      <th rowspan="2"><div align="center">Tax</div></th>
      <th rowspan="2"><div align="center">Food</div></th>
      <th rowspan="2"><div align="center">Loan /Advance</div></th>
      <th rowspan="2"><div align="center">Absent</div></th>
      <th rowspan="2"><div align="center">LWP</div></th>
      <th rowspan="2"><div align="center">Late</div></th>
      <th rowspan="2"><div align="center">HR Action</div></th>
			<th rowspan="2"><div align="center">Joining Deduction</div></th>
      <th rowspan="2"><div align="center">Others</div></th>
    </tr>
    <tr>
      <th>CL</th>
      <th>SL</th>
      <th>AL</th>
      <th>SHL</th>
      <th>ML</th>
      <th>PL</th>
      <th>EOL</th>
      <th>HL</th>
      <th>MLV</th>
      <th><div align="center">100%</div></th>
      <th><div align="center">50%</div></th>
      <th><div align="center">25%</div></th>
      <th><div align="center">15%</div></th>
      <th><div align="center">10%</div></th>
    </tr>
  </thead>
  <tbody>
<?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){
if($_POST['PBI_ORG']!='')

$salaryCon =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryCon .= ' and t.job_location='.$_POST['JOB_LOCATION'];
if ($_POST['department'] !='')
$salaryCon .= ' and t.department='.$_POST['department'];




if ($_POST['job_status'] !='')
$salaryCon .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';
$sqld = 'select t.*,s.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,
s.basic_salary_bank,s.house_rent_bank,s.medical_allowance_bank,s.special_allowance_bank
from salary_attendence t,designation d, personnel_basic_info a,salary_info s
where t.PBI_ID=s.PBI_ID and t.designation = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and  t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID '.$salaryCon.' order by (t.total_payable) desc';

}else{

if($_POST['PBI_ORG']!='')


$salaryConn =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$salaryConn .= ' and t.job_location='.$_POST['JOB_LOCATION'];

if ($_POST['department'] !='')
$salaryConn .= ' and t.department='.$_POST['department'];

$m_s_date = $_POST['year'].'-'.$_POST['mon'].'-'.'01';
$m_e_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';

  $sqld = 'select t.*, a.PBI_ID,a.PBI_CODE,a.PBI_NAME, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,
s.basic_salary_bank,s.house_rent_bank,s.medical_allowance_bank,s.special_allowance_bank,dept.DEPT_DESC
from salary_attendence_lock t,designation d, personnel_basic_info a,salary_info s,department dept

where t.PBI_ID=s.PBI_ID and t.designation = d.DESG_ID and t.pay>0 and t.remarks_details!="hold" and  t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
a.PBI_DEPARTMENT=dept.DEPT_ID  and

t.PBI_ID=a.PBI_ID '.$salaryConn.' order by (t.total_payable) desc,dept.DEPT_DESC';


}

$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
$m_s_date = $_POST['year'].'-'.$_POST['mon'].'-'.'01';
$m_e_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';
$entry_by=$data->entry_by;
//$slq = 'select sum(total_days) from hrm_leave_info where PBI_ID="'.$data->PBI_ID.'" and type=1 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED"';
$tot_ded = $data->other_deduction+$data->other_deductions;
//for salary condition
 $salary_given_status=$data->bank_or_cash; // find_a_field('salary_info','cash_bank','PBI_ID="'.$data->PBI_ID.'"');  //

?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->Designation?></td>

			<td nowrap="nowrap"><?=$data->DEPT_DESC?></td>
			<td nowrap="nowrap"><?=find_a_field('project','PROJECT_DESC','PROJECT_ID="'.$data->job_location.'"'); ?></td>


      <td><?=date('d-M-Y',strtotime($data->PBI_DOJ))?></td>
      <td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (1)';
      $dumping = mysql_query($dd);
      $day_count = '';
      $last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';
      while($leave_d = mysql_fetch_object($dumping)){
     $d = date_parse_from_format("Y-m-d", $leave_d->e_date);
     $next_m =  $d["month"];
     if($_POST['mon']<$next_m){

			$e_date = $last_date;
			}else{
			$e_date = $leave_d->e_date;
			}
      $s_date = $leave_d->s_date;
      $e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));

		  $begin = new DateTime($s_date);
			$end = new DateTime($e_date);
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end);
			foreach ($period as $dt) {
			$dt->format("l Y-m-d H:i:s\n");
			$today = $dt->format("Y-m-d");
			if($dt->format("l")!='Friday')
			{

			$found = 0;
			$found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');
			if($found==0)

			 $day_count++;

			 }}


			}

			echo $day_count;
			?></td>
			<td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (2)';
			$dumping = mysql_query($dd);
			$day_count = '';
			$last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';
			while($leave_d = mysql_fetch_object($dumping)){
			$d = date_parse_from_format("Y-m-d", $leave_d->e_date);
			$next_m =  $d["month"];
			if($_POST['mon']<$next_m){
			$e_date = $last_date;
			}else{

		 $e_date = $leave_d->e_date;
		  }

      $s_date = $leave_d->s_date;

$e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));
$begin = new DateTime($s_date);
$end = new DateTime($e_date);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);
foreach ($period as $dt) {
$dt->format("l Y-m-d H:i:s\n");
$today = $dt->format("Y-m-d");
if($dt->format("l")!='Friday')
{
$found = 0;
$found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');
if($found==0)
$day_count++;
 }}}
echo $day_count;
?>

</td>
<td><?  $dd = 'select s_date,e_date from hrm_leave_info where s_date>="'.$m_s_date.'" and PBI_ID="'.$data->PBI_ID.'" and leave_status="GRANTED" and type in (3)';
		$dumping = mysql_query($dd);
		$day_count = '';
		$last_date = $_POST['year'].'-'.$_POST['mon'].'-'.'31';
		while($leave_d = mysql_fetch_object($dumping)){
		$d = date_parse_from_format("Y-m-d", $leave_d->e_date);

		  $next_m =  $d["month"];
		 if($_POST['mon']<$next_m){

		 $e_date = $last_date;
		 }else{
		 $e_date = $leave_d->e_date;
		 }
		$s_date = $leave_d->s_date;
    $e_date = date('Y-m-d H:i:s', strtotime($e_date . ' +1 day'));


		$begin = new DateTime($s_date);
		$end = new DateTime($e_date);
		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		foreach ($period as $dt) {
		$dt->format("l Y-m-d H:i:s\n");
		$today = $dt->format("Y-m-d");
		if($dt->format("l")!='Friday')

		{
		$found = 0;

		$found = find_a_field('salary_holy_day','1',' holy_day="'.$today.'" ');
		if($found==0)
		$day_count++;

		}

		}


		}
		echo $day_count;

?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type="Short Leave (SHL)" and leave_status="GRANTED" and mon='.$_POST['mon'].' and year='.$_POST['year'].'') ?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=4 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=6 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=8 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=7 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td><?=find_a_field('hrm_leave_info','sum(total_days)','PBI_ID='.$data->PBI_ID.' and type=5 and s_date>="'.$m_s_date.'" and e_date<="'.$m_e_date.'" and  leave_status="GRANTED" ')?></td>
      <td align="center"><?=($data->lt>0)? $data->lt : '';?></td>
      <td align="center"><?=($data->lwp>0)? $data->lwp : '';?></td>
      <td align="center"><?=($data->ab>0)? $data->ab : '';?></td>
      <td align="center"><?=($data->pay>0)? $data->pay : '';?></td>
      <!--salary statetment -->
      <?php  if($salary_given_status==5){ ?>




			<td align="right"><?=($data->bank_amt>0)? $data->bank_amt : '';                   $totGross += $data->bank_amt?></td>
			<td align="right"><?=($data->bank_amt>0)? round($data->bank_amt/100*50) : '';            $totBasic += $data->bank_amt/100*50?></td>
			<td align="right"><?=($data->bank_amt>0)? round($data->bank_amt/100*25) : '';            $totHouse += $data->bank_amt/100*25?></td>
			<td align="right"><?=($data->bank_amt>0)? round($data->bank_amt/100*15) : '';             $totMedical += $data->bank_amt/100*15?></td>
			<td align="right"><?=($data->bank_amt>0)? round($data->bank_amt/100*10) : '';           $totspecial += $data->bank_amt/100*10?></td>


      <?php  }else{  ?>
      <td align="right"><?=($data->gross_salary>0)? $data->gross_salary : '';               $totGross += $data->gross_salary?></td>
      <td align="right"><?=($data->basic_salary>0)? $data->basic_salary : '';               $totBasic += $data->basic_salary?></td>
      <td align="right"><?=($data->house_rent>0)? $data->house_rent : '';                   $totHouse += $data->house_rent?></td>
      <td align="right"><?=($data->medical_allowance>0)? $data->medical_allowance : '';     $totMedical += $data->medical_allowance?></td>
      <td align="right"><?=($data->special_allowance>0)? $data->special_allowance : '';     $totspecial += $data->special_allowance?></td>
      <?php  } ?>
      <!--salary end statetment -->
      <td align="right"><?=($data->food_allowance>0)? $data->food_allowance : '';           $totFood += $data->food_allowance?></td>
      <td align="right"><?=($data->transport_allowance>0)? $data->transport_allowance :''; $totTransport += $data->transport_allowance?></td>
      <td align="right"><?=($data->offday_allowance>0)? $data->offday_allowance :''; $totOffday += $data->offday_allowance?></td>
      <td align="right"><?=($data->sitevisit_allowance>0)? $data->sitevisit_allowance :''; $totSitevisit += $data->sitevisit_allowance?></td>
      <td align="right"><?=($data->other_allowance>0)? $data->other_allowance :'';        $totOther += $data->other_allowance?></td>
      <td align="right"><? if($data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance>0){echo $data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance;
      $totAllowance +=$data->offday_allowance+$data->sitevisit_allowance+$data->food_allowance+$data->transport_allowance+$data->other_allowance;

      }?></td>
      <td align="right"><?=($data->over_time_hour>0)? $data->over_time_hour : '';           $totOverTimeHr += $data->over_time_hour?></td>
      <td align="right"><?=($data->over_time_amount>0)? $data->over_time_amount : '';       $totOverTimeAmt += $data->over_time_amount?></td>
      <td align="right"><?=($data->adjustment_amount>0)? number_format($data->adjustment_amount,0) : '';       $totAdjustmentAmt += $data->adjustment_amount?></td>
      <td align="right"><?=($data->mobile_deduction>0)? $data->mobile_deduction : '';       $totMobileDeduct += $data->mobile_deduction?></td>
      <td align="right"><?=($data->income_tax>0)? $data->income_tax : '';                   $totIincomeTax += $data->income_tax?></td>
      <td align="right"><?=($data->food_deduction>0)? $data->food_deduction : '';           $totFoodDeduct += $data->food_deduction?></td>
			<td align="right"><?=($data->advance_install || $data->other_install>0)? $data->advance_install+$data->other_install : ''; $totAdvInstall += $data->advance_install+$data->other_install?></td>

      <td align="right"><?=($data->absent_deduction>0)? $data->absent_deduction : '';       $totAbsentDeduct += $data->absent_deduction?></td>
      <td align="right"><?=($data->lwp_deduction>0)? $data->lwp_deduction : '';             $totLwpDeduct += $data->lwp_deduction?></td>
      <td align="right"><?=($data->late_deduction>0)? $data->late_deduction : '';           $totLateDeduct += $data->late_deduction?></td>
      <td align="right"><?=($data->hr_action_amt>0)? $data->hr_action_amt : '';             $totHrAcDeduct += $data->hr_action_amt?></td>
			<td align="right"><?=($data->joining_deduction>0)? $data->joining_deduction : '';     $joining_deduction_total_amount += $data->joining_deduction?></td>

      <td align="right"><?=($tot_ded>0)? $tot_ded : '';       $totOtherDeduct += $tot_ded?></td>
      <td align="right"><?=($data->total_deduction>0)? $data->total_deduction : '';         $totTotalDeduct += $data->total_deduction?></td>

			<?php  if($salary_given_status==5){ ?>
				<td align="right"><? echo ($data->bank_amt>0)? $data->bank_amt-$data->total_deduction : '';        $total_cash_earning = $total_cash_earning + $data->bank_amt-$data->total_deduction;?></td>
				<td align="right"><? echo ($data->bank_amt>0)? $data->bank_amt-$data->total_deduction : '';        $total_cash = $total_cash + $data->bank_amt-$data->total_deduction;?></td>

			<?php  }else{ ?>

      <td align="right"><? echo ($data->total_earning>0)? $data->total_earning : '';        $total_cash_earning = $total_cash_earning + $data->total_earning;?></td>
      <td align="right"><? echo ($data->total_payable>0)? $data->total_payable : '';        $total_cash = $total_cash + $data->total_payable;?></td>
      <?  } ?>

      <td><?=($data->cash>0)? $data->cash : '';?></td>
      <td><?=($data->card_no>0)? $data->card_no : '';?></td>
      <?




 $hr_action_remarks = find_a_field('admin_action_detail','ADMIN_ACTION_SUBJECT','EFFECT_MON="'.$_POST['mon'].'" and EFFECT_YEAR="'.$_POST['year'].'" and PBI_ID="'.$data->PBI_ID.'" ');


 ?>
      <? if($data->remarks_details!=''){ ?>
      <td nowrap="nowrap" style="width:150px;"><?=$data->remarks_details?></td>
      <? } else{?>
      <td nowrap="nowrap" style="width:150px;"><?=$hr_action_remarks?></td>
      <? } ?>
    </tr>
    <?





}




?>
    <tr>
      <td align="right" colspan="20" style="font-weight:bold;">Total:</td>
      <td align="right"><strong>
        <?=($totGross>0)? number_format($totGross,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totBasic>0)? number_format($totBasic,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHouse>0)? number_format($totHouse,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMedical>0)? number_format($totMedical,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totspecial>0)? number_format($totspecial,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFood>0)? number_format($totFood,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totTransport>0)? number_format($totTransport,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOffday>0)? number_format($totOffday,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totSitevisit>0)? number_format($totSitevisit,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOther>0)? number_format($totOther,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAllowance>0)? number_format($totAllowance,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeHr>0)? number_format($totOverTimeHr,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOverTimeAmt>0)? number_format($totOverTimeAmt,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdjustmentAmt>0)? number_format($totAdjustmentAmt,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totMobileDeduct>0)? number_format($totMobileDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totIincomeTax>0)? number_format($totIincomeTax,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totFoodDeduct>0)? number_format($totFoodDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAdvInstall>0)? number_format($totAdvInstall,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totAbsentDeduct>0)? number_format($totAbsentDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totLwpDeduct>0)? number_format($totLwpDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totLateDeduct>0)? number_format($totLateDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totHrAcDeduct>0)? number_format($totHrAcDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($totOtherDeduct>0)? number_format($totOtherDeduct,0) : '';?>
        </strong></td>

				<td align="right"><strong>
	        <?=($totOtherDeduct>0)? number_format($joining_deduction_total_amount,0) : '';?>
	        </strong></td>

      <td align="right"><strong>
        <?=($totTotalDeduct>0)? number_format($totTotalDeduct,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($total_cash_earning>0)? number_format($total_cash_earning,0) : '';?>
        </strong></td>
      <td align="right"><strong>
        <?=($total_cash>0)? number_format($total_cash,0) : '';?>
        </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?































echo convertNumberMhafuz($total_cash);































?>
<br>
<br>
<br>
<div style="width:100%; margin:60px auto">
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Chairman</div>
</div>
<?































































}































if($_POST['report']==1333){































































	 $report="Yearly Promotion Report";































































	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Promotion List of
      <?= $_POST['year']?>
      </strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>SL</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>Employee Name</strong></td>
      <td><strong>Ref No</strong></td>
      <td><strong>Department</strong></td>
      <td><strong>Job Location/Project</strong></td>
      <td><strong>Previous Designation</strong></td>
      <td><strong>New Designation</strong></td>
      <td><strong>Salary Increment</strong></td>
      <td><strong>Reporting Authority</strong></td>
      <td><strong>Issue Date</strong></td>
      <td><strong>Effected Date</strong></td>
    </tr>
  </thead>
  <?



	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';








	  $basic_sql='select p.PBI_ID,a.PBI_CODE, p.PROMOTION_REF as referance,p.increment_amt, p.PROMOTION_ISSUE_DATE as issue_date, p.PROMOTION_DATE as effec_date,(select DESG_DESC
		from designation where DESG_ID=p.PROMOTION_PRESENT_DESG) as designation,(select DESG_DESC from designation
		where DESG_ID=p.PROMOTION_PAST_DESG) as  pre_designation,p.PROMOTION_REPORTING_AUTH,a.PBI_NAME,a.PBI_DEPARTMENT,a.JOB_LOCATION from promotion_detail p,
		personnel_basic_info a where 1 and p.PBI_ID=a.PBI_ID '.$tr_con.'  and PROMOTION_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-30" ';































































	 $basic_query = mysql_query($basic_sql);































































































      $s=1;































































































	 while($r = mysql_fetch_object($basic_query)){































































		 ?>
  <tr>
    <td><?=$s++?></td>
    <td><?=$r->PBI_CODE?></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=$r->referance?></td>
    <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$r->PBI_DEPARTMENT);?></td>
    <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
    <td><?=$r->pre_designation?></td>
    <td><?=$r->designation?></td>
    <td><div align="center">
        <?=$r->increment_amt?>
      </div></td>
    <td><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$r->PROMOTION_REPORTING_AUTH);?></td>
    <td><?=date('d-M-Y',strtotime($r->issue_date))?></td>
    <td><?=date('d-M-Y',strtotime($r->effec_date))?></td>
  </tr>
  <?































































		 }































































































































		 ?>
</table>
<?































}















































if($_POST['report']==2019){



	 $report="";

	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <p>&nbsp;</p>
    <td style="border:0px solid white;">Monthly Joining New Employee Status</td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2" align="center"><div align="center">Designation</div></th>
      <th colspan="2" style=""><div align="center">Salary</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Project/Job Location</div></th>
      <th rowspan="2"><div align="center">Mobile No</div></th>
      <th rowspan="2"><div align="center">Email No</div></th>
    </tr>
    <tr class="oe_list_header_columns" style="font-size:10px;padding:3px; border-top:#ccc; ">
      <th style="border:1px solid #000;">Gross</th>
      <th  style="border:1px solid #000;">Food Allowances</th>
    </tr>
  </thead>
  <tbody>
    <?

      if($_POST['year']!="" && $_POST['mon']!=""){

	  $join_con = ' and a.PBI_DOJ between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-30"';}
	
	else{
		$join_con = ' and a.PBI_DOJ between "'.$_POST['year'].'-01-1" and 
		"'.$_POST['year'].'-12-30"';
	}

	  $basic_sql='select i.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT,
	  a.PBI_DOJ,a.JOB_LOCATION, d.DESG_SHORT_NAME as Designation,
	  
		e.DEPT_SHORT_NAME as Department,a.PBI_MOBILE as mobile,
		
		a.PBI_EMAIL as email, a.JOB_LOCATION
		
      	from designation d, department e, personnel_basic_info a, salary_info i

           where a.PBI_DESIGNATION = d.DESG_ID and a.PBI_DEPARTMENT=e.DEPT_ID and i.PBI_ID=a.PBI_ID '.$join_con.' group by a.PBI_ID';

	 $basic_query = mysql_query($basic_sql);































































	 $s2 = 1;































































































































	 while($r = mysql_fetch_object($basic_query)){































































		 ?>
    <tr align="center">
      <td><?=$s2++;?></td>
      <td><?=$r->PBI_CODE?></td>
      <td><?=$r->PBI_NAME?></td>
      <td><?=$r->Designation?></td>
      <td><?=$r->gross_salary?></td>
      <td><?=$r->food_allowance?></td>
      <td><?=$r->PBI_DOJ?></td>
      <td><?=$r->Department?></td>
      <td><? echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
      <td><?=$r->mobile?></td>
      <td><?=$r->email?></td>
    </tr>
    <?































































		 }































































































































		 ?>
</table>
<?































}















































if($_POST['report']==20191){































































	 $report="";































































	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <td style="border:0px solid white;">Monthly Separation List</td>
  </tr>
  <tr>
    <p>&nbsp;</p>
    <?php































     if($_POST['mon']>0){















	   $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);























       $monthName = $dateObj->format('F');















  }























	  ?>
    <td style="border:0px solid white;"><?= $monthName.'-'.$_POST['year']?></td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2" align="center"><div align="center">Designation</div></th>
      <th colspan="2" style=""><div align="center">Salary</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">Relieving Date</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Project/Job Location</div></th>
      <th rowspan="2"><div align="center">Mobile No</div></th>
      <th rowspan="2"><div align="center">Email No</div></th>
			<th rowspan="2"><div align="center">Relieving Cause</div></th>
			<th rowspan="2"><div align="center">Job Status</div></th>
    </tr>
    <tr class="oe_list_header_columns" style="font-size:10px;padding:3px; border-top:#ccc; ">
      <th style="border:1px solid #000;">Gross</th>
      <th  style="border:1px solid #000;">Food Allowances</th>
    </tr>
  </thead>
  <tbody>
    <?





if($_POST['year']!="" && $_POST['mon']!=""){
$join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}

if($_POST['year']!="" && $_POST['mon']==""){
$join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-31"';}


if($_POST['department']!='')
$join_con .= ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';



if($_POST['JOB_LOCATION']!='')
$join_con .= ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



	  $basic_sql='select i.*,j.ESSENTIAL_RESIG_DATE, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,a.JOB_LOCATION,
		d.DESG_SHORT_NAME as Designation, e.DEPT_SHORT_NAME as Department,a.PBI_MOBILE as mobile,a.PBI_JOB_STATUS,j.relieving_cause,
    a.PBI_EMAIL as email from  designation d, department e, personnel_basic_info a,essential_info j, salary_info i
    where j.PBI_ID=a.PBI_ID and a.PBI_DESIGNATION = d.DESG_ID and a.PBI_DEPARTMENT=e.DEPT_ID and i.PBI_ID=a.PBI_ID  '.$join_con.'';


	 $basic_query = mysql_query($basic_sql);


	 $s3 = 1;




	 while($r = mysql_fetch_object($basic_query)){

		 ?>
    <tr align="center">
      <td><?=$s3++;?></td>
      <td><?=$r->PBI_CODE?></td>
      <td><?=$r->PBI_NAME?></td>
      <td><?=$r->Designation?></td>
      <td><?=$r->gross_salary?></td>
      <td><?=$r->food_allowance?></td>
      <td><?=date('d-M-Y', strtotime($r->PBI_DOJ));?></td>
      <td><?=date('d-M-Y', strtotime($r->ESSENTIAL_RESIG_DATE));?></td>
      <td><?=$r->Department?></td>
      <td><? echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
      <td><?=$r->mobile?></td>
      <td><?=$r->email?></td>
			<td><?=$r->relieving_cause?></td>
			<td><?=$r->PBI_JOB_STATUS?></td>
    </tr>
    <?































		 }































































		 ?>
</table>
<?















































}































































if($_POST['report']==54673){































	 $report="";















































	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <td style="border:0px solid white;">Monthly Re-Joining List</td>
  </tr>
  <tr>
    <p>&nbsp;</p>
    <?php















































	   $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);































        $monthName = $dateObj->format('F');















































	  ?>
    <td style="border:0px solid white;"><?= $monthName.'-'.$_POST['year']?></td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2" align="center"><div align="center">Designation</div></th>
      <th colspan="2" style=""><div align="center">Salary</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">Re-Join Date</div></th>
      <th rowspan="2"><div align="center">Relieving Date</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Project/Job Location</div></th>
      <th rowspan="2"><div align="center">Mobile No</div></th>
      <th rowspan="2"><div align="center">Email No</div></th>
    </tr>
    <tr class="oe_list_header_columns" style="font-size:10px;padding:3px; border-top:#ccc; ">
      <th style="border:1px solid #000;">Gross</th>
      <th  style="border:1px solid #000;">Food Allowances</th>
    </tr>
  </thead>
  <tbody>
    <?















































      if($_POST['year']!="" && $_POST['mon']!=""){































































	  $join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}































	  $basic_sql='select i.*,j.ESSENTIAL_RESIG_DATE,j.RE-JOIN_DATE, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,a.JOB_LOCATION, d.DESG_SHORT_NAME as Designation, e.DEPT_SHORT_NAME as Department,a.PBI_MOBILE as mobile,















































	 a.PBI_EMAIL as email















































 from  designation d, department e, personnel_basic_info a,essential_info j, salary_info i















































 where j.PBI_ID=a.PBI_ID and a.PBI_DESIGNATION = d.DESG_ID and a.PBI_DEPARTMENT=e.DEPT_ID and i.PBI_ID=a.PBI_ID  '.$join_con.' group by a.PBI_ID';















































	 $basic_query = mysql_query($basic_sql);















































	 $s3 = 1;































































	 while($r = mysql_fetch_object($basic_query)){































































		 ?>
    <tr align="center">
      <td><?=$s3++;?></td>
      <td><?=$r->PBI_CODE?></td>
      <td><?=$r->PBI_NAME?></td>
      <td><?=$r->Designation?></td>
      <td><?=$r->gross_salary?></td>
      <td><?=$r->food_allowance?></td>
      <td><?=$r->PBI_DOJ?></td>
      <td><?=$r->RE-JOIN_DATE?></td>
      <td><?=$r->ESSENTIAL_RESIG_DATE?></td>
      <td><?=$r->Department?></td>
      <td><? echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
      <td><?=$r->mobile?></td>
      <td><?=$r->email?></td>
    </tr>
    <?































































		 }















































		 ?>
</table>
<?















































}































































if($_POST['report']==3){































































	 $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);































        $monthName = $dateObj->format('F');















































     if($_POST['mon']!='')































     	$att_con = ' and d.mon="'.$_POST['mon'].'"';































































     if($_POST['year']!='')































     	$att_con .= ' and d.year="'.$_POST['year'].'"';













































if($_POST['department']!='')
$b_con .= ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';



if($_POST['JOB_LOCATION']!='')
$b_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';


 if($_POST['PBI_ID']!='')
$att_con .= ' and d.bizid="'.$_POST['PBI_ID'].'"';































     $sdate = $_POST['year'].'-'.$_POST['mon'].'-01';































     $edate = $_POST['year'].'-'.$_POST['mon'].'-31';















































	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <td style="border:0px solid white;"><?=$str?></td>
  </tr>
</table>
<table style="width:300px;margin: 0 auto;  font-size: 20px;text-align:center;" cellpadding="0" cellspacing="0" border="1">
  <tr>
    <td colspan="2">Monthly Summery</td>
  </tr>
  <tr>
    <td colspan="2"><?=$monthName.' '.$_POST['year']?></td>
  </tr>
  <tr>
    <td>Absent</td>
    <td></td>
  </tr>
  <tr>
    <td>LWP</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','s_date>="'.$sdate.'" and e_date<="'.$edate.'" and type=9 and leave_status="GRANTED"');?></td>
  </tr>
  <tr>
    <td>Leave</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','s_date>="'.$sdate.'" and e_date<="'.$edate.'" and type not in ("Short Leave (SHL)") and leave_status="GRANTED"');?></td>
  </tr>
  <tr>
    <td>SHL</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','half_leave_date>="'.$sdate.'" and half_leave_date<="'.$edate.'" and type="Short Leave (SHL)" and leave_status="Granted"');?></td>
  </tr>
  <tr>
    <td>Late In</td>
    <td><?=find_a_field('hrm_attdump','count(bizid)','xdate>="'.$sdate.'" and xdate<="'.$edate.'"  and late_in=1');?></td>
  </tr>
</table>
<table style="width: 80%; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th>S/L</th>
      <th style=""><div align="center">Attendance Date</div></th>
      <th><div align="center">Employee ID</div></th>
      <th><div align="center">Employee Name</div></th>
      <th align="center"><div align="center">Designation</div></th>
      <th align="center"><div align="center">Department</div></th>
      <th align="center"><div align="center">Job Location/Project</div></th>
      <th><div align="center">Check in</div></th>
      <th><div align="center">Check out</div></th>
      <th><div align="center">Total Working Time</div></th>
      <th><div align="center">Late in days</div></th>
      <th><div align="center">OD</div></th>
      <th><div align="center">SHL</div></th>
      <th><div align="center">Leave</div></th>
    </tr>
  </thead>
  <tbody>
    <?















































      if($_POST['year']!="" && $_POST['mon']!=""){































































	  $join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}































































































































	 $all = 'select p.PBI_NAME,p.PBI_ID,desg.DESG_DESC as designation, dept.DEPT_DESC as department from personnel_basic_info p, designation desg,
	  department dept where p.PBI_DESIGNATION=desg.DESG_ID and p.PBI_DEPARTMENT=dept.DEPT_ID


	  and p.PBI_JOB_STATUS="In Service" '.$b_con.' order by p.PBI_ID';































































































































	 $att_query = mysql_query($all);















































	 $s3 = 1;































    while($basic_data = mysql_fetch_object($att_query)){































    for($i=1;$i<=31;$i++){































       $all_date = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$i.'';































































          $att_sql='select DATE_FORMAT(d.xdate,"%d-%b-%Y") as xdate,d.ztime,d.xtime,d.bizid,d.od,d.late_in,d.early_out,d.mon,d.year,d.leave_id,d.od_id,d.shl  from































       hrm_attdump d where d.xdate="'.$all_date.'" and d.bizid="'.$basic_data->PBI_ID.'" '.$att_con.' order by d.bizid,d.xdate';































































	$nquery = mysql_query($att_sql);































	$att_data = mysql_fetch_object($nquery);































	 $leave_info = find_a_field('hrm_leave_info','type','id="'.$att_data->leave_id.'"');































	 $leave_infoSHORT = find_a_field('hrm_leave_info','type','id="'.$att_data->shl.'"');















































































































































    $leave_name = find_a_field('hrm_leave_type','leave_type_name','id="'.$leave_info.'"');































    $f = date('D',strtotime($all_date));































    $att_status = find_a_field('hrm_attdump','attendence','bizid="'.$basic_data->PBI_ID.'" and xdate="'.$all_date.'"');































    $holiday = find_a_field('salary_holy_day','reason','holy_day="'.$all_date.'"');















    $odAbsent = find_a_field('hrm_od_info','id','s_date="'.$all_date.'" and PBI_ID="'.$basic_data->PBI_ID.'"');















		 ?>
    <tr align="center">
      <td><?=++$j;?></td>
      <td><?=date('d-M-Y',strtotime($all_date))?></td>
      <td><?=$basic_data->PBI_ID?></td>
      <td><?=$basic_data->PBI_NAME?></td>
      <td><?=$basic_data->designation?></td>
      <td><?=$basic_data->department?></td>
      <td><?=$basic_data->project?></td>
      <td><? if($att_data->ztime!='0000-00-00 00:00:00' && $att_data->ztime!='') {































			 echo $ztime = date('h:i',strtotime($att_data->ztime));































			 }else{































































































					 if($f=='Fri'){































					echo '<span style="font-weight:bold;">Friday</span>';































					} elseif($att_status==3){































					echo '<span style="font-weight:bold;">Dayoff</span>';































					}elseif($holiday!=''){































					echo '<span style="font-weight:bold;">'.$holiday.'</span>';































					}elseif($att_status==4){































					echo '<span style="font-weight:bold;">Leave</span>';































					}elseif($att_status==2){































					echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































					}elseif($att_status==1){































					echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';































					}elseif($shl>0){































					echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';































					}elseif($odAbsent>0){































					echo '<span style="font-weight:bold; color:#000;"></span>';































					}else{































					echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































						}































			 } ?></td>
      <td><? if($att_data->xtime!='0000-00-00 00:00:00' && $att_data->xtime!='') {































			 echo $xtime = date('h:i',strtotime($att_data->xtime));































			 }else{































		     $friday = find_a_field('friday','status','date="'.$all_date.'"');































































					 if($f=='Fri'){































					echo '<span style="font-weight:bold;">Friday</span>';































					} elseif($holiday!=''){































					echo '<span style="font-weight:bold;">'.$holiday.'</span>';































					}elseif($att_status==3){































					echo '<span style="font-weight:bold;">Dayoff</span>';































					}elseif($att_status==4){































					echo '<span style="font-weight:bold;">Leave</span>';































					}elseif($att_status==2){































					echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































					}elseif($att_status==1){































					echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';































					}elseif($shl>0){































					echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';































					}elseif($odAbsent>0){































					echo '<span style="font-weight:bold; color:#000;"></span>';































					}else{































					echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































						}































			 } ?></td>
      <td><? $datetime1 = new DateTime($xtime);































            $datetime2 = new DateTime($ztime);































            $interval = $datetime1->diff($datetime2);































            $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";































        ?></td>
      <td><?  if($att_data->late_in>0){































				 echo '<span style="font-weight:bold;">Late</span>';































				 }else{































































				 if($f=='Fri'){































				 echo '<span style="font-weight:bold;">Friday</span>';































				 } elseif($holiday!=''){































					echo '<span style="font-weight:bold;">'.$holiday.'</span>';































					}elseif($att_status==4){































					echo '<span style="font-weight:bold;">Leave</span>';































					}elseif($att_status==3){































					echo '<span style="font-weight:bold;">Dayoff</span>';































					}elseif($att_status==2){































					echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































					}elseif($shl>0){































					echo '<span style="font-weight:bold; color:#FF0000;">Short Leave</span>';































					}































































				 }































		         ?></td>
      <td><? if($odAbsent>0){































					echo '<span style="font-weight:bold; color:#000;"><a href="od_view.php?od_id='.$odAbsent.'" target="_blank">OD</span>';































					}?></td>
      <td><? echo $leave_infoSHORT   ?></td>
      <td><? if($leave_name) echo '<span style="font-weight:bold;">'.$leave_name.'</span>';?></td>
    </tr>
    <?































	 }































































		 }















































		 ?>
</table>
<br />
<br />
<?























   }























   if($_POST['report']==39){






    $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);
    $monthName = $dateObj->format('F');















































       //if($_POST['mon']!='')







       //$att_con = ' and d.mon="'.$_POST['mon'].'"';















       //if($_POST['year']!='')







       //$att_con .= ' and d.year="'.$_POST['year'].'"';















       //if($_POST['mon']!='' && $_POST['year']!='')























       $start = ''.$_POST['year'].'-'.$_POST['mon'].'-01';















       $mon_days = date('t',strtotime($start));







       $end = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$mon_days.'';















     	  $att_con .= ' and d.att_date between "'.$start.'" and "'.$end.'"';















































      if($_POST['department']!='')































        $b_con .= ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';































































      if($_POST['JOB_LOCATION']!='')































        $b_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';































































      if($_POST['PBI_ID']!='')































        $att_con .= ' and d.bizid="'.$_POST['PBI_ID'].'"';































      $sdate = $_POST['year'].'-'.$_POST['mon'].'-01';






      $edate = $_POST['year'].'-'.$_POST['mon'].'-31';















































   ?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <td style="border:0px solid white;"><?=$str?></td>
  </tr>
</table>
<table style="width:300px;margin: 0 auto;  font-size: 20px;text-align:center;" cellpadding="0" cellspacing="0" border="1">
  <tr>
    <td colspan="2">Monthly Summery</td>
  </tr>
  <tr>
    <td colspan="2"><?=$monthName.' '.$_POST['year']?></td>
  </tr>
  <tr>
    <td>Absent</td>
    <td></td>
  </tr>
  <tr>
    <td>LWP</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','s_date>="'.$sdate.'" and e_date<="'.$edate.'" and type=9 and leave_status="GRANTED"');?></td>
  </tr>
  <tr>
    <td>Leave</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','s_date>="'.$sdate.'" and e_date<="'.$edate.'" and type not in ("Short Leave (SHL)") and leave_status="GRANTED"');?></td>
  </tr>
  <tr>
    <td>SHL</td>
    <td><?=find_a_field('hrm_leave_info','sum(total_days)','half_leave_date>="'.$sdate.'" and half_leave_date<="'.$edate.'" and type="Short Leave (SHL)" and leave_status="Granted"');?></td>
  </tr>
  <tr>
    <td>Late In</td>
    <td><?=find_a_field('hrm_attdump','count(bizid)','xdate>="'.$sdate.'" and xdate<="'.$edate.'"  and late_in=1');?></td>
  </tr>
</table>
<table style="width: 80%; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th>S/L</th>
      <th style=""><div align="center">Attendance Date</div></th>
      <th><div align="center">Employee ID</div></th>
      <th><div align="center">Employee Name</div></th>
      <th align="center"><div align="center">Designation</div></th>
      <th align="center"><div align="center">Department</div></th>
      <th align="center"><div align="center">Job Location/Project</div></th>
      <th><div align="center">Check in</div></th>
      <th><div align="center">Check out</div></th>
      <th><div align="center">Total Working Time</div></th>
      <th><div align="center">Late in days</div></th>
      <th><div align="center">OD</div></th>
      <th><div align="center">SHL</div></th>
      <th><div align="center">Leave</div></th>
    </tr>
  </thead>
  <tbody>
    <?







       if($_POST['year']!="" && $_POST['mon']!=""){





     $join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}



     $all = 'select p.PBI_NAME,p.PBI_ID,p.PBI_CODE,desg.DESG_DESC as designation, dept.DEPT_DESC as department from personnel_basic_info p, designation desg, department dept
	where p.PBI_DESIGNATION=desg.DESG_ID and
     p.PBI_DEPARTMENT=dept.DEPT_ID and p.PBI_JOB_STATUS="In Service" '.$b_con.' order by p.PBI_ID';
     $att_query = mysql_query($all);



















    $s3 = 1;

  //DYNAMIC DAYS COUNT
   $days=cal_days_in_month(CAL_GREGORIAN,$_POST['mon'],$_POST['year']);







     while($basic_data = mysql_fetch_object($att_query)){































     for($i=1;$i<=$days;$i++){































        $all_date = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$i.'';































































           //echo $att_sql='select DATE_FORMAT(d.xdate,"%d-%b-%Y") as xdate,d.ztime,d.xtime,d.bizid,d.od,d.late_in,d.early_out,d.mon,d.year,d.leave_id,d.od_id,d.shl  from







           //hrm_attdump d where d.xdate="'.$all_date.'" and d.bizid="'.$basic_data->PBI_ID.'" '.$att_con.' order by d.bizid,d.xdate';























            $att_sql='select DATE_FORMAT(d.att_date,"%d-%b-%Y") as att_date,d.in_time,d.out_time,d.emp_id,d.sch_in_time,d.sch_out_time,d.final_late_status,d.iom_sl_no,d.leave_id,d.od_id,d.od_start_time,







           d.iom_start_time,d.dayname from hrm_att_summary d where d.att_date="'.$all_date.'" and d.emp_id="'.$basic_data->PBI_ID.'" '.$att_con.' order by d.emp_id,d.att_date';























     $nquery = mysql_query($att_sql);







     $att_data = mysql_fetch_object($nquery);































     $leave_info = find_a_field('hrm_leave_info','type','id="'.$att_data->leave_id.'"');







     $leave_infoSHORT = find_a_field('hrm_leave_info','type','id="'.$att_data->iom_sl_no.'"');







     $leave_name = find_a_field('hrm_leave_type','leave_type_name','id="'.$leave_info.'"');















     $f = date('D',strtotime($all_date));















     $att_status = find_a_field('hrm_attdump','attendence','bizid="'.$basic_data->PBI_ID.'" and att_date="'.$all_date.'"');















     $leave_status = find_a_field('hrm_att_summary','leave_id','emp_id="'.$basic_data->PBI_ID.'" and att_date="'.$all_date.'"');















     $holiday = find_a_field('salary_holy_day','reason','holy_day="'.$all_date.'"');















     $odAbsent = find_a_field('hrm_od_info','id','s_date="'.$all_date.'" and PBI_ID="'.$basic_data->PBI_ID.'"');















     //comparision between od iom intime and office start time







     $office_sac_time = date("H:i",strtotime($att_data->sch_in_time));







     $od_start_time = date("h:i",strtotime($att_data->od_start_time));







     $sort_leave_start_time = date("H:i",strtotime($att_data->iom_start_time));







































      ?>
    <tr align="center">
      <td><?=++$j;?></td>
      <td><?=date('d-M-Y',strtotime($all_date))?></td>
      <td><?=$basic_data->PBI_CODE?></td>
      <td><?=$basic_data->PBI_NAME?></td>
      <td><?=$basic_data->designation?></td>
      <td><?=$basic_data->department?></td>
      <td><?=$basic_data->project?></td>
      <td><?















           if($att_data->in_time!='0000-00-00 00:00:00' && $att_data->in_time!='') {







           echo $ztime = date('h:i',strtotime($att_data->in_time));















           }elseif($att_data->in_time!='' && $leave_status>0 || $att_data->od_id>0){







           echo '<span style="font-weight:bold;">LEAVE</span>';















           }elseif($f=='Fri'){







            echo '<span style="font-weight:bold;">Friday</span>';















          } elseif($att_status==3){







            echo '<span style="font-weight:bold;">Dayoff</span>';















          }elseif($holiday!=''){







            echo '<span style="font-weight:bold;">'.$holiday.'</span>';















           }elseif($leave_status>0){















           echo '<span style="font-weight:bold;">Leave</span>';























           }elseif($att_status==2){







           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';















           }elseif($att_status==1){







            echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';















           }elseif($shl>0){







           echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';















            }elseif($odAbsent>0){







             echo '<span style="font-weight:bold; color:#000;"></span>';























             }else{







              echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';







             }























































/*







           if($att_data->in_time!='0000-00-00 00:00:00' && $att_data->in_time!='') {







           echo $ztime = date('h:i',strtotime($att_data->in_time));















           }else{























            if($f=='Fri'){







            echo '<span style="font-weight:bold;">Friday</span>';







             } elseif($att_status==3){







            echo '<span style="font-weight:bold;">Dayoff</span>';















            }elseif($holiday!=''){







            echo '<span style="font-weight:bold;">'.$holiday.'</span>';















           }elseif($leave_status>0){















           echo '<span style="font-weight:bold;">Leave</span>';































           }elseif($att_status==2){































           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































           }elseif($att_status==1){































           echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';































           }elseif($shl>0){































           echo '<span style="font-weight:bold; color:#000;">'.$ztime.'</span>';































           }elseif($odAbsent>0){































           echo '<span style="font-weight:bold; color:#000;"></span>';































           }else{































           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































             }































        } */























        ?></td>
      <td><?























if($att_data->in_time!='0000-00-00 00:00:00' && $att_data->in_time!='') {







  echo $xtime = date('h:i',strtotime($att_data->in_time));















  }elseif($att_data->in_time!='' && $leave_status>0 || $att_data->od_id>0){







  echo '<span style="font-weight:bold;">LEAVE</span>';















  }elseif($f=='Fri'){







   echo '<span style="font-weight:bold;">Friday</span>';















 } elseif($att_status==3){







   echo '<span style="font-weight:bold;">Dayoff</span>';















 }elseif($holiday!=''){







   echo '<span style="font-weight:bold;">'.$holiday.'</span>';















  }elseif($leave_status>0){















  echo '<span style="font-weight:bold;">Leave</span>';























  }elseif($att_status==2){







  echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';















  }elseif($att_status==1){







   echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';















  }elseif($shl>0){







  echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';















   }elseif($odAbsent>0){







    echo '<span style="font-weight:bold; color:#000;"></span>';























    }else{







     echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';







    }























































         /*







          if($att_data->out_time!='0000-00-00 00:00:00' && $att_data->out_time!='') {







          echo $xtime = date('h:i',strtotime($att_data->out_time));















          }else{































          $friday = find_a_field('friday','status','date="'.$all_date.'"');































            if($f=='Fri'){







            echo '<span style="font-weight:bold;">Friday</span>';







            } elseif($holiday!=''){















            echo '<span style="font-weight:bold;">'.$holiday.'</span>';































           }elseif($att_status==3){







           echo '<span style="font-weight:bold;">Dayoff</span>';















           }elseif($leave_status>0){







           echo '<span style="font-weight:bold;">Leave</span>';















           }elseif($att_status==2){







           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';















           }elseif($att_status==1){







           echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';















           }elseif($shl>0){







            echo '<span style="font-weight:bold; color:#000;">'.$xtime.'</span>';































           }elseif($odAbsent>0){







           echo '<span style="font-weight:bold; color:#000;"></span>';















           }else{







           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';







           }































        }







         */















         ?></td>
      <td><? $datetime1 = new DateTime($xtime);































             $datetime2 = new DateTime($ztime);































             $interval = $datetime1->diff($datetime2);































             $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";































         ?></td>
      <td><?































         if($att_data->final_late_status>0 && $att_data->dayname=='Friday'){







          echo '<span style="font-weight:bold;">Friday</span>';























         }elseif($att_data->final_late_status>0 && $att_data->od_id==0 && $att_data->iom_sl_no==0){







          echo '<span style="font-weight:bold;">Late</span>';























          }elseif($att_data->final_late_status>0 && $att_data->od_id>0 && $od_start_time>$office_sac_time){







          echo '<span style="font-weight:bold;">Late</span>';















          }elseif($att_data->final_late_status>0 && $att_data->iom_sl_no>0 && $sort_leave_start_time >$office_sac_time){







          echo '<span style="font-weight:bold;">Late</span>';















          }elseif($att_data->final_late_status>0 && $att_data->od_id>0 && $od_start_time<$office_sac_time){







          echo '<span style="font-weight:bold;"></span>';















          }elseif($att_data->final_late_status>0 && $att_data->iom_sl_no>0 && $sort_leave_start_time<$office_sac_time){







          echo '<span style="font-weight:bold;"></span>';















































          }else{















            if($f=='Fri'){







            echo '<span style="font-weight:bold;">Friday</span>';















            }elseif($holiday!=''){







            echo '<span style="font-weight:bold;">'.$holiday.'</span>';















            }elseif($leave_status>0){







            echo '<span style="font-weight:bold;">Leave</span>';































           }elseif($att_status==3){































           echo '<span style="font-weight:bold;">Dayoff</span>';































           }elseif($att_status==2){































           echo '<span style="font-weight:bold; color:#FF0000;">Absent</span>';































           }elseif($shl>0){































           echo '<span style="font-weight:bold; color:#FF0000;">Short Leave</span>';































           }































































          }































              ?></td>
      <td><? if($att_data->od_id>0){































           echo '<span style="font-weight:bold; color:#000;"><a href="od_view.php?od_id='.$odAbsent.'" target="_blank">OD</span>';































           }?></td>
      <td><? echo $leave_infoSHORT   ?></td>
      <td><? if($leave_name) echo '<span style="font-weight:bold;">'.$leave_name.'</span>';?></td>
    </tr>
    <?































    }































































      }















































      ?>
</table>
<br />
<br />
<?


  }


   //new section start

   if($_POST['report']==22){
  $dateObj   = DateTime::createFromFormat('!m', $_POST['mon']);

   $monthName = $dateObj->format('F');



     if($_POST['mon']!='' && $_POST['year']!='')
     $start = ''.$_POST['year'].'-'.$_POST['mon'].'-01';
     $mon_days = date('t',strtotime($start));
     $end = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$mon_days.'';
     $att_con .= ' and d.att_date between "'.$start.'" and "'.$end.'"';



//if($_POST['mon']!='')
// $att_con = ' and d.mon="'.$_POST['mon'].'"';
//if($_POST['year']!='')
//$att_con .= ' and d.year="'.$_POST['year'].'"';

if($_POST['department']!='')
$b_con .= ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';
if($_POST['JOB_LOCATION']!='')
$b_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';
if($_POST['PBI_ID']!='')
$att_con .= ' and d.emp_id="'.$_POST['PBI_ID'].'"';



$sdate = $_POST['year'].'-'.$_POST['mon'].'-01';
$edate = $_POST['year'].'-'.$_POST['mon'].'-31';




	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Absent Report</strong></td>
  </tr>
  
</table>

<table style="width: 80%; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
	
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th>S/L</th>
      <th><div align="center">Employee ID</div></th>
      <th><div align="center">Employee Name</div></th>
      <th align="center"><div align="center">Designation</div></th>
      <th align="center"><div align="center">Department</div></th>
      <th align="center"><div align="center">Job Location/Project</div></th>
      <th><div align="center">Absent in days</div></th>
    </tr>
  </thead>
  <tbody>
    <?

//and  p.PBI_DOJ < "'.$sdate.'"


      if($_POST['year']!="" && $_POST['mon']!=""){

       $join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}

 $all = 'select p.PBI_NAME,p.PBI_ID,p.PBI_CODE,desg.DESG_DESC as designation,p.PBI_DOJ, dept.DEPT_DESC as department
from personnel_basic_info p, designation desg, department dept,essential_info e
where p.PBI_ID=e.PBI_ID and p.PBI_DESIGNATION=desg.DESG_ID and p.PBI_DEPARTMENT=dept.DEPT_ID and e.ATTENDENCE_TYPE = "Auto" 
and p.PBI_JOB_STATUS="In Service" '.$b_con.' order by p.PBI_ID';




 $att_query = mysql_query($all);


     $s3 = 1;


		 //DYNAMIC DAYS COUNT
	    $days=cal_days_in_month(CAL_GREGORIAN,$_POST['mon'],$_POST['year']);



    while($basic_data = mysql_fetch_object($att_query)){

    for($i=1;$i<=$days;$i++){

$all_date = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$i.'';




$att_sql='select DATE_FORMAT(d.att_date,"%d-%b-%Y") as xdate,d.in_time,d.out_time,d.emp_id,d.final_late_status,d.leave_id,d.od_id,d.iom_sl_no,d.absent_status,d.iom_sl_no,d.iom_start_time
  from
hrm_att_summary d where d.att_date="'.$all_date.'" and d.emp_id="'.$basic_data->PBI_ID.'" '.$att_con.' order by d.emp_id,d.att_date';




$nquery = mysql_query($att_sql);
$att_data = mysql_fetch_object($nquery);
$leave_info = find_a_field('hrm_leave_info','type','id="'.$att_data->leave_id.'"');
$leave_name = find_a_field('hrm_leave_type','leave_short_name','id="'.$leave_info.'"');
$f = date('D',strtotime($all_date));
$att_status = find_a_field('hrm_attdump','attendence','bizid="'.$basic_data->PBI_ID.'" and xdate="'.$all_date.'"');
$holiday = find_a_field('salary_holy_day','reason','holy_day="'.$all_date.'"');
//late punch
/*if($att_data->in_time>0){
$late_punch = date('H:i:s', strtotime($att_data->in_time));
}else{
$late_punch =  '';
}*/


if($att_data->in_time>0){
  $late_punch = date('H:i:s', strtotime($att_data->in_time));
}else{
$late_punch =  '';
}

$iom_in_time = date('h:i:s', strtotime($att_data->iom_start_time));



if($late_punch<'11:59:00'  && $att_data->leave_id ==0 && $att_data->od_id ==0 && $att_data->iom_sl_no==0 && $att_data->in_time!='0000-00-00 00:00:00'
	&& $att_data->in_time!=''){


}elseif($late_punch<='12:00:00'  && $att_data->in_time!='0000-00-00 00:00:00' && $att_data->in_time!='' &&
	$att_data->leave_id==0 && $att_data->od_id==0 ) {


}elseif($late_punch>'12:00:00'   && $att_data->leave_id>0 || $att_data->iom_sl_no>0) {

}elseif($att_data->in_time!='' && $att_data->leave_id>0 || $att_data->od_id>0){

}elseif($att_data->in_time!='' && $att_data->leave_id>0){

}elseif($f=='Fri'){

}elseif($holiday!=''){
}elseif($att_data->leave_id>0){


}else{


/*  if($att_data->ztime!='0000-00-00 00:00:00' && $att_data->ztime!='') {
}else{
if($f=='Fri'){
} elseif($att_status==3){
}elseif($holiday!=''){
}elseif($att_status==4){
}elseif($att_status==2){
}elseif($att_status==1){
}else{ */
//   $sac = strtotime($check_joinig_date);
//   $sac2 = strtotime($att_data->xdate);



		 ?>





    <tr align="center">
      <td><?=++$j;?></td>
      <td><?=$basic_data->PBI_CODE?></td>
      <td><?=$basic_data->PBI_NAME?></td>
      <td><?=$basic_data->designation?></td>
      <td><?=$basic_data->department?></td>
      <td><?=$basic_data->project?></td>
      <td><?=date('d-M-Y',strtotime($all_date));?></td>
    </tr>
  <? } } } ?>
</table>
</br>
<?


}




//end section




//new section start

if($_POST['report']==21){










 if($_POST['mon']!='' && $_POST['year']!='')























       $start = ''.$_POST['year'].'-'.$_POST['mon'].'-01';















       $mon_days = date('t',strtotime($start));







       $end = ''.$_POST['year'].'-'.$_POST['mon'].'-'.$mon_days.'';















     	$att_con .= ' and d.att_date between "'.$start.'" and "'.$end.'"';















	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Employee Late Present Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>Sl</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>NAME</strong></td>
      <td><strong>DESIGNATION</strong></td>
      <td><strong>DEPARTMENT</strong></td>
      <td><strong>PROJECT</strong></td>
      <td><strong>Late in days</strong></td>
      <td><strong>Check in</strong></td>
      <td><strong>Check out</strong></td>
    </tr>
  </thead>
  <?



$basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,
(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC)
from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,
d.emp_id,d.att_date,d.in_time,d.out_time,d.od_id,
d.od_start_time,d.od_end_time,d.sch_in_time,d.iom_sl_no,d.iom_start_time,d.final_late_min,d.final_late_status,d.dayname,d.leave_id
from hrm_att_summary d,personnel_basic_info a where d.emp_id=a.PBI_ID ".$att_con."".$con." order by d.emp_id,d.att_date ";
$basic_query = mysql_query($basic_sql);



	 $sl = 1;



	 while($r = mysql_fetch_object($basic_query)){




$emp_in_time = date("g:i",strtotime($r->in_time));
//comparision between od iom intime and office start time
$office_sac_timee = date("H:i",strtotime($r->sch_in_time));
$od_start_timee = date("h:i",strtotime($r->od_start_time));
$sort_leave_start_timee = date("h:i",strtotime($r->iom_start_time));

if($r->in_time>0){
 $late_punch=  date('H:i:s', strtotime($r->in_time));
}else{
$late_punch =  '';
}




if($r->final_late_status>0 && $r->dayname=='Friday'){
$lete_status = 'Ok';

}elseif($r->final_late_status==0 && $r->leave_id>0){
$lete_status = 'Ok';

//}elseif($r->final_late_status==0 && $r->od_id==1 && $r->iom_sl_no==1 && $od_start_timee<$office_sac_timee && $sort_leave_start_timee <$office_sac_timee) {
//$lete_status = 'Ok';

}elseif($r->final_late_status>0 && $late_punch>='12:00:00' && $r->od_id==0 && $r->iom_sl_no==0) {
$lete_status = 'Ok';

//}elseif($r->final_late_status>0 && $r->od_id>0 && $od_start_timee>$office_sac_timee){
//$lete_status = 'Late';

}elseif($r->final_late_status>0 && $r->leave_id==0) {
$lete_status = 'Late';

//}elseif($r->final_late_status>0 && $r->iom_sl_no>0 && $sort_leave_start_timee >=$office_sac_timee){
//$lete_status = 'Late';

}else{
$lete_status = 'Ok';

}



//holyday
$holysql = "select * from salary_holy_day where holy_day = '".$r->att_date."'";
$holy_query = mysql_query($holysql);
$holy = mysql_fetch_object($holy_query);

if($holy>0){

}else{




if($lete_status=='Late'){

?>
  <tr>
    <td><?=$sl++;?></td>
    <td><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td><?=$r->department?></td>
    <td><?=$r->project_name?></td>
    <td><?=date('d-M-Y',strtotime($r->att_date))?></td>
    <td><? if($r->in_time>0){  echo date('h:i a',strtotime($r->in_time));}
		else
		{ echo date('h:i a',strtotime($r->od_start_time));};

		?></td>
    <td><? if($r->out_time>0){ echo date('h:i a',strtotime($r->out_time));}
		else
		{ echo date('h:i a',strtotime($r->od_end_time));};


		?></td>
  </tr>
  <? } }} ?>
</table>
<br />
<br />
<?































































	}















































//end section































































































































































































if($_POST['report']==226655)































































{































































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Leave Report Of
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2">S/L</th>
      <th rowspan="2">ID</th>
      <th rowspan="2">Name</th>
      <th rowspan="2">Designation</th>
      <th rowspan="2">Joining Date</th>
      <th align="center" rowspan="2">Department</th>
      <th rowspan="2">Employee Type</th>
      <th colspan="10"><div align="center">LEAVE AVAIL</div></th>
      <th colspan="10"><div align="center">LEAVE SUMMARY</div></th>
    </tr>
    <tr>
      <th><div align="center">SL</div></th>
      <th><div align="center">CL</div></th>
      <th><div align="center">AL</div></th>
      <th><div align="center">MLV</div></th>
      <th><div align="center">SHL</div></th>
      <th><div align="center">PL</div></th>
      <th><div align="center">ML</div></th>
      <th><div align="center">HL</div></th>
      <th><div align="center">LWP</div></th>
      <th><div align="center">EOL</div></th>
      <th><div align="center">SL</div></th>
      <th><div align="center">CL</div></th>
      <th><div align="center">AL</div></th>
      <th><div align="center">MLV</div></th>
      <th><div align="center">SHL</div></th>
      <th><div align="center">PL</div></th>
      <th><div align="center">ML</div></th>
      <th><div align="center">HL</div></th>
      <th><div align="center">LWP</div></th>
      <th><div align="center">EOL</div></th>
    </tr>
  </thead>
  <tbody>
    <?



























































if($_POST['designation'] !='')

$leave_con = ' and p.PBI_DESIGNATION ="'.$_POST['designation'].'"';




if($_POST['department'] !='')

$leave_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';


if($_POST['JOB_LOCATION'] !='')
$leave_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



if($_POST['year'] !='')
$leave_con .= ' and l.year="'.$_POST['year'].'"';





   $sqldd = 'select l.PBI_ID,p.PBI_NAME,p.PBI_CODE,p.PBI_DEPARTMENT,proj.PROJECT_DESC,p.PBI_SEX,p.PBI_DOJ,p.PBI_DESIGNATION,dept.DEPT_DESC,desg.DESG_DESC,e.EMPLOYMENT_TYPE
	 from hrm_leave_info l,personnel_basic_info p,essential_info e,department dept,designation desg,project proj where l.PBI_ID=p.PBI_ID and l.PBI_ID=e.PBI_ID and
	 p.PBI_DEPARTMENT=dept.DEPT_ID and  l.leave_status="Granted" AND p.PBI_DESIGNATION=desg.DESG_ID '.$leave_con.' group by l.PBI_ID';































































$querydd=mysql_query($sqldd);































































while($leaveData = mysql_fetch_object($querydd)){































































$entry_by=$data->entry_by;















































$year = date('Y');















































$annual_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=3');















































$casual_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=1');















































$sick_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=2');































































$marriage_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=4');















































$matternity_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=5');















































$patternity_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=6');































































$hajj_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=7');















































$eol_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=8');















































$lwp_leave=find_a_field('hrm_leave_type','yearly_leave_days','id=9');















































?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$leaveData->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$leaveData->PBI_NAME?></td>
      <td><?=$leaveData->DESG_DESC?></td>
      <td><?=$leaveData->PBI_DOJ?></td>
      <td><?=$leaveData->DEPT_DESC?></td>
      <td><?=$leaveData->EMPLOYMENT_TYPE?></td>
      <td><a href="leave_details_view.php?type=2&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$sick_lost=find_a_field('hrm_leave_info','sum(total_days)','type=2  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><a href="leave_details_view.php?type=1&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$casual_lost=find_a_field('hrm_leave_info','sum(total_days)','type=1  and leave_status="Granted" and year="'.$_POST['year'].'" and  PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><a href="leave_details_view.php?type=3&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$annual_lost=find_a_field('hrm_leave_info','sum(total_days)','type=3  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <?php















































	     if($leaveData->PBI_SEX == 'Female'){































































































	  ?>
      <td><a href="leave_details_view.php?type=5&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$matternity_lost=find_a_field('hrm_leave_info','sum(total_days)','type=5  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <? }else{ ?>
      <td><div align="center" style="color:red;">x</div></td>
      <? } ?>
      <td><a href="leave_details_view.php?type=Short Leave (SHL)&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$short_lost=find_a_field('hrm_leave_info','sum(total_days)','type="Short Leave (SHL)"  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <?php















































	     if($leaveData->PBI_SEX == 'Male'){































































































	  ?>
      <td><a href="leave_details_view.php?type=6&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$paternity_lost=find_a_field('hrm_leave_info','sum(total_days)','type=6  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <? } else{ ?>
      <td><div align="center" style="color:red;">x</div></td>
      <? } ?>
      <td><a href="leave_details_view.php?type=4&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$marriage_lost=find_a_field('hrm_leave_info','sum(total_days)','type=4  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><a href="leave_details_view.php?type=7&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$hajj_lost=find_a_field('hrm_leave_info','sum(total_days)','type=7  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><a href="leave_details_view.php?type=9&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$lwp_lost=find_a_field('hrm_leave_info','sum(total_days)','type=9  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><a href="leave_details_view.php?type=8&year=<?=$_POST['year']?>&PBI_ID=<?=$leaveData->PBI_ID?>" target="_blank">
        <?=$eol_lost=find_a_field('hrm_leave_info','sum(total_days)','type=8  and leave_status="Granted" and year="'.$_POST['year'].'" and PBI_ID='.$leaveData->PBI_ID)?>
        </a></td>
      <td><?=$sick_leave-$sick_lost?></td>
      <td><?=$casual_leave-$casual_lost?></td>
      <td><?=$annual_leave-$annual_lost?></td>
      <?php















































	     if($leaveData->PBI_SEX == 'Female'){































































































	  ?>
      <td><?=$matternity_leave-$matternity_lost?></td>
      <? } else{?>
      <td><div align="center" style="color:red;">x</div></td>
      <? } ?>
      <td><?=24-$short_lost?></td>
      <?php















































	     if($leaveData->PBI_SEX == 'Male'){































































































	  ?>
      <td><?=$patternity_leave-$paternity_lost?></td>
      <? } else{?>
      <td><div align="center" style="color:red;">x</div></td>
      <? } ?>
      <td><?=$marriage_leave-$marriage_lost?></td>
      <td><?=$hajj_leave-$hajj_lost?></td>
      <td><?=$lwp_leave-$lwp_lost?></td>
      <td><?=$eol_leave-$eol_lost?></td>
    </tr>
    <?































}































































?>
  </tbody>
</table>
<br>
<br>
<br>
<?































































}































































if($_POST['report']==201912)































































{































































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">OD Report of
          <? $test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');















































 echo date_format($test, 'M-Y');















































 ?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">S/L</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Job Location/Project</div></th>
      <th rowspan="2"><div align="center">Submission Date</div></th>
      <th colspan="2"><div align="center">Date Interval</div></th>
      <th rowspan="2"><div align="center">Total Days</div></th>
      <th colspan="2"><div align="center">Time Interval</div></th>
      <th rowspan="2"><div align="center">Total Hours</div></th>
      <th rowspan="2"><div align="center">OD Type</div></th>
      <th colspan="3"><div align="center">Description</div></th>
      <th rowspan="2"><div align="center">Reason</div></th>
    </tr>
    <tr>
      <th><div align="center">Start Date</div></th>
      <th><div align="center">End Date</div></th>
      <th><div align="center">Start Time</div></th>
      <th><div align="center">End Time</div></th>
      <th><div align="center">Company Name</div></th>
      <th><div align="center">Place/Address</div></th>
      <th><div align="center">Project Name</div></th>
    </tr>
  </thead>
  <tbody>
    <?































































if($_POST['department'] !='')















































$od_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';































































if($_POST['JOB_LOCATION'] !='')















































$od_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';































































/*if($_POST['year'] !='')















































$od_con .= ' and l.year="'.$_POST['year'].'"';*/































































if($_POST['mon'] !='')















































$od_con .= ' and l.s_date between "'.$_POST['year'].'-'.$_POST['mon'].'-01" and "'.$_POST['year'].'-'.$_POST['mon'].'-30"';















































//$tr_con .= ' and t.TRANSFER_ORDER_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-30"';































   $sqldd = 'select l.PBI_ID,p.PBI_NAME,p.PBI_CODE,p.PBI_DEPARTMENT,(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,
	 p.PBI_SEX,p.PBI_DOJ,p.PBI_DESIGNATION,dept.DEPT_DESC,desg.DESG_DESC,DATE_FORMAT(l.od_date,"%d-%b-%Y") as od_date,l.total_days,l.total_hrs ,
	 l.type,l.reason,l.s_time,l.e_time,l.place4,l.organization,l.company_name,l.s_time_format,l.e_time_format,l.project_name,l.organization2,
	 l.place,l.place2,l.place3,DATE_FORMAT(l.s_date,"%d-%b-%Y") as s_date,DATE_FORMAT(l.e_date,"%d-%b-%Y") as e_date

	 from hrm_od_info l,personnel_basic_info p,essential_info e,department dept,designation desg where l.PBI_ID=p.PBI_ID and l.PBI_ID=e.PBI_ID and
	 p.PBI_DEPARTMENT=dept.DEPT_ID and l.od_status="Granted" and  p.PBI_DESIGNATION=desg.DESG_ID '.$od_con.' order by s_date desc';















































$querydd=mysql_query($sqldd);















































while($leaveData = mysql_fetch_object($querydd)){































$entry_by=$data->entry_by;















































$year = date('Y');































































?>
    <tr>
      <td><?=++$s?></td>
      <td><?=$leaveData->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$leaveData->PBI_NAME?></td>
      <td><?=$leaveData->DESG_DESC?></td>
      <td><div align="center">
          <?=$leaveData->DEPT_DESC?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->project?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->od_date?>
        </div></td>
      <td><?=$leaveData->s_date?></td>
      <td><?=$leaveData->e_date?></td>
      <td><div align="center">
          <?=$leaveData->total_days?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->s_time.' '.$leaveData->s_time_format?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->e_time.' '.$leaveData->e_time_format?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->total_hrs?>
        </div></td>
      <td><div align="center">
          <?=find_a_field('od_type','type_name','id='.$leaveData->type)?>
        </div></td>
      <td><div align="center">
          <?































































   if($leaveData->organization!='')































   {































    echo $leaveData->organization;































   }elseif($leaveData->organization2!=''){































    echo $leaveData->organization2;































   }else{































    echo $leaveData->company_name;































   }































   ?>
        </div></td>
      <td><div align="center">
          <?































    if($leaveData->place4!='')































	{































	   echo $leaveData->place4;































	}elseif($leaveData->place!=''){































	   echo $leaveData->place;































	}































	elseif($leaveData->place2!=''){































	   echo $leaveData->place2;































	}elseif($leaveData->place3!=''){































	   echo $leaveData->place3;































	}































































   ?>
        </div></td>
      <td><div align="center">
          <?=$leaveData->project_name?>
        </div></td>
      <td><?=$leaveData->reason?></td>
    </tr>
    <?































}































































?>
  </tbody>
</table>
<br>
<br>

<?



}




if($_POST['report']==1445)


{

$report="Yearly Increment Report";

?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LIMITED.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Salary Review <?= $_POST['year']?></strong></td>

  </tr>

    <tr>
    <td style="border:0px solid white;"><strong>
    <?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$_POST['JOB_LOCATION']);?>
    <?=find_a_field('department','DEPT_DESC','DEPT_ID='.$_POST['department']);?>
    </strong></td>

  </tr>




</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1" id="ExportTable">
  <thead>
    <tr>
    <th rowspan="2"><div align="center">S/L</div></th>
    <th rowspan="2"><div align="center">EMP ID</div></th>

    <th rowspan="2"><div align="center">Employee Name</div></th>
    <th rowspan="2"><div align="center">Designation</div></th>
    <th rowspan="2" nowrap="nowrap"><div align="center">Joining Date</div></th>
    <th rowspan="2"><div align="center">Service Length</div></th>
    <th rowspan="2"><div align="center">Current Salary</div></th>
    <th rowspan="2"><div align="center">Last Increment</div></th>
    <th rowspan="2"><div align="center">Last Increment Date</div></th>
    <th rowspan="2"><div align="center">Last Promotion</div></th>
    <th rowspan="2"><div align="center">Last Promotion Date</div></th>

    <th colspan="2" align="center"><div align="center">Performance Appraisal</div></th>

    <th colspan="2" align="center"><div align="center">Proposed Salary</div></th>
    <th rowspan="2"><div align="center">Proposed Designation</div></th>
    <th rowspan="2"><div align="center">Remarks</div></th>


  </tr>
  <tr>

  	<th><div align="center">Marks</div></th>
    <th><div align="center">Category</div></th>

    <th><div align="center">Percentage</div></th>
    <th><div align="center">Amount</div></th>

  </tr>




  </thead>
  <?

	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

    if($_POST['job_status'] !='')
	$job_con = ' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';

	$previous_year = $_POST['year']-1;


   $basic_sql='select a.PBI_ID,a.PBI_CODE,a.PBI_NAME ,a.PBI_DESIGNATION ,a.PBI_DEPARTMENT,a.JOB_LOCATION,
DATE_FORMAT(a.PBI_DOJ,"%d-%b-%Y") as joining_date,b.gross_salary
from personnel_basic_info a,salary_info b

where a.PBI_ID=b.PBI_ID and b.gross_salary>0 '.$tr_con.$job_con.'   group by a.PBI_ID order by a.PBI_DOJ';


$basic_query = mysql_query($basic_sql);
$s1=1;
while($r = mysql_fetch_object($basic_query)){

 $pa_point = find_a_field('performance_appraisal','AVG(total_score)','PBI_ID="'.$r->PBI_ID.'" and year="'.$_POST['year'].'"
 	and EMPLOYMENT_TYPE="Permanent" and  status="Done"');


 $promotion = find_all_field('promotion_detail','','PBI_ID="'.$r->PBI_ID.'" and
  PROMOTION_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-31" order by PROMOTION_D_ID desc');

 $last_promotion = find_all_field('promotion_detail','','PBI_ID="'.$r->PBI_ID.'" order by PROMOTION_D_ID desc');

 $increment = find_all_field('increment_detail','','PBI_ID="'.$r->PBI_ID.'" and
  INCREMENT_EFFECT_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-31" order by INCREMENT_D_ID desc');

 $increment_previouse = find_all_field('increment_detail','','PBI_ID="'.$r->PBI_ID.'" and
  INCREMENT_EFFECT_DATE between "'.$previous_year.'-01-1" and "'.$previous_year.'-12-31" order by INCREMENT_D_ID desc');


	$increment_amount = find_a_field('increment_detail','SUM(INCREMENT_AMT)','PBI_ID="'.$r->PBI_ID.'" and
  INCREMENT_EFFECT_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-31"');

  $increment_pre_amount = find_a_field('increment_detail','SUM(INCREMENT_AMT)','PBI_ID="'.$r->PBI_ID.'" and
  INCREMENT_EFFECT_DATE between "'.$previous_year.'-01-1" and "'.$previous_year.'-12-31"');

  $inc_date = $_POST['year'].'-12-'.'31';


//SCORE

 $avg_score = round($pa_point);

if($avg_score>=87 && $avg_score<=100){

  $status = 'Outstanding';

}elseif($avg_score>=73 && $avg_score<=86){

 $status = 'Very Good';

}elseif($avg_score>=59 && $avg_score<=72){

 $status = 'Good';

}elseif($avg_score>=45 && $avg_score<=58){

 $status = 'Fair';

}elseif($avg_score>=31 && $avg_score<=44){

 $status = 'Needs Improvement';

}elseif($avg_score>=0 && $avg_score<=30){

 $status = 'Unsatisfactory';

}


?>
  <tr>
    <td><?=$s1++;?></td>
    <td><div align="center"><?=$r->PBI_CODE?></div></td>

    <td><?=$r->PBI_NAME?></td>
    <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$r->PBI_DESIGNATION);?></td>
    <td><?=$r->joining_date?></td>

    <td><?

	$interval = date_diff(date_create(date($inc_date)), date_create($r->joining_date));
    echo $interval->format("%Y Y, %M M, %d D");?></td>

    <? //=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?>

    <td><div align="center"><?=$gross_salary = find_a_field('salary_info','gross_salary','PBI_ID='.$r->PBI_ID);

    //=$increment->PRESENT_SALARY+$increment->INCREMENT_AMT?></div></td>

    <td><div align="center"><?
		if($increment_amount>0){
			echo $increment_amount;     $total_increment_amount +=$increment_amount;
		}else{
			echo $increment_pre_amount; $total_increment_amount +=$increment_pre_amount;
		}

		?></div></td>

    <td><div align="center">
			<?
    if($increment->INCREMENT_EFFECT_DATE>0){
		echo date('d-M-Y',strtotime($increment->INCREMENT_EFFECT_DATE));
	}else {
		if($increment_previouse->INCREMENT_EFFECT_DATE>0){ echo date('d-M-Y',strtotime($increment_previouse->INCREMENT_EFFECT_DATE));}
	}

		?>


	 </div></td>





     <td><div align="center"><?

		if($promotion->PROMOTION_PRESENT_DESG>0){
		echo find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$promotion->PROMOTION_PRESENT_DESG);
		}else {
		echo find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$last_promotion->PROMOTION_PRESENT_DESG);
		}

		?> </div></td>



    <td><div align="center"><?

		if($promotion->PROMOTION_DATE>0){
		echo date('d-M-Y',strtotime($promotion->PROMOTION_DATE));
		}else {
			if($last_promotion->PROMOTION_DATE>0){ echo date('d-M-Y',strtotime($last_promotion->PROMOTION_DATE));}
		}

		?> </div></td>

    <td><div align="center"><? if($pa_point>0){ echo round($pa_point);}?></div></td>

    <td><div align="center"><? if($pa_point>0){ echo $status;}?></div></td>

    <td><div align="center"></div></td>

    <td><div align="center"></div></td>


    <td></td>
    <td></td>


  </tr>
  <?

//$total_inc = $total_inc+$increment_amount;
$total_previous = $total_previous+$r->PRESENT_SALARY;
$total_present = $total_present+$gross_salary;

//Avarage Calculate
$percentage_total = ($total_inc *100)/$total_previous;

//$percentage_total = $percentage_total+$percentage;

		 }


		 ?>
  <tr>
    <td colspan="5"></td>
    <td><div align="center"><strong>TOTAL INCREMENT</strong></div></td>

    <td><div align="center"><strong><?=number_format($total_present) ?></strong></div></td>

	<td><div align="center"><strong><?=number_format($total_increment_amount)?></strong></div></td>


    <td colspan="9"></td>
  </tr>
</table>

<br>
<?



}




if($_POST['report']==1444)


{

$report="Yearly Increment Report";

?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Increment List of
      <?= $_POST['year']?>
      </strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>SL</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>Ref No</strong></td>
      <td><strong>Employee Name</strong></td>
      <td><strong>
        <div align="center">Designation</div>
        </strong></td>
      <td><strong>
        <div align="center">Department</div>
        </strong></td>
      <td><strong>Project/Job Location</strong></td>
      <td><strong>
        <div align="center">Previous Salary</div>
        </strong></td>
      <td><strong>
        <div align="center">Increment Amount</div>
        </strong></td>
      <td><strong>
        <div align="center">Present Salary</div>
        </strong></td>
      <td><strong>
        <div align="center">Percentage</div>
        </strong></td>
      <td><strong>
        <div align="center">Increment Type</div>
        </strong></td>
      <td><strong>Issue Date</strong></td>
      <td><strong>Effected Date</strong></td>
    </tr>
  </thead>
  <?

	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



  $basic_sql='select p.PBI_ID,a.PBI_CODE,p.INCREMENT_REF as referance, p.INCREMENT_ISSUE_DATE as issue_date,p.INCREMENT_EFFECT_DATE as effec_date,
p.INCREMENT_TYPE,p.PRESENT_SALARY,p.INCREMENT_AMT,a.PBI_NAME ,a.PBI_DESIGNATION ,a.PBI_DEPARTMENT,a.JOB_LOCATION,s.gross_salary
from increment_detail p,personnel_basic_info a,
salary_info s where  a.PBI_ID=p.PBI_ID and s.PBI_ID=p.PBI_ID '.$tr_con.' and  INCREMENT_EFFECT_DATE between "'.$_POST['year'].'-01-1" and "'.$_POST['year'].'-12-30" order
by p.INCREMENT_REF ASC ';


$basic_query = mysql_query($basic_sql);
$s1=1;
while($r = mysql_fetch_object($basic_query)){
?>
  <tr>
    <td><?=$s1++;?></td>
    <td><div align="center">
        <?=$r->PBI_CODE?>
      </div></td>
    <td><?=$r->referance?></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$r->PBI_DESIGNATION);?></td>
    <?php

 if($r->PBI_DEPARTMENT == 13){ ?>
    <td></td>
    <?php } else{ ?>
    <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$r->PBI_DEPARTMENT);?></td>
    <?php } ?>
    <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
    <td><div align="center"><?=$r->PRESENT_SALARY?></div></td>
    <td><div align="center"><?=$r->INCREMENT_AMT?></div></td>
    <td><?=$r->PRESENT_SALARY+$r->INCREMENT_AMT?></td><?php $percentage = ($r->INCREMENT_AMT*100)/$r->PRESENT_SALARY;?>
    <td><div align="center"><?=number_format($percentage,2);?>%</div></td>
    <td><?=$r->INCREMENT_TYPE?></td>
    <td><div align="center"><?=date('d-M-Y',strtotime($r->issue_date))?></div></td>
    <td><div align="center"><?=date('d-M-Y',strtotime($r->effec_date))?></div></td>
  </tr>
  <?

$total_inc = $total_inc+$r->INCREMENT_AMT;
$total_previous = $total_previous+$r->PRESENT_SALARY;
$total_present = $total_present+$r->PRESENT_SALARY+$r->INCREMENT_AMT;

//Avarage Calculate
$percentage_total = ($total_inc *100)/$total_previous;

//$percentage_total = $percentage_total+$percentage;

		 }


		 ?>
  <tr>
    <td colspan="6"></td>
    <td><div align="center"><strong>TOTAL INCREMENT</strong></div></td>

		<td><div align="center"><strong><?=number_format($total_previous)?></strong></div></td>
    <td><div align="center"><strong><?=number_format($total_inc)?></strong></div></td>
		<td><div align="center"><strong><?=number_format($total_present) ?></strong></div></td>
		<td><div align="center"><strong><?=number_format($percentage_total,2) ?>%</strong></div></td>
    <td colspan="3"></td>
  </tr>
</table>






<?
}



if($_POST['report']==1446)


{

$report="Yearly Increment Report";

?>

<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white; font-family: bangothic;"><strong>AKSID CORPORATION LIMITED.</strong></td>
  </tr>
  <tr>
  <td style="border:0px solid white;"><strong>Increment List of <?= $_POST['year']?></strong></td>
  </tr>
</table>


   <div align="center" style="font-size:17px"><strong>Slot 1 (January- April)</strong></div>

  <table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  

   


  
    <tr>
      <td><strong>SL</strong></td>
      <td><strong>EMP ID</strong></td>
     
      <td><strong>Employee Name</strong></td>
      <td><strong><div align="center">Designation</div></strong></td>
      <td><strong><div align="center">Department</div></strong></td>
      <td><strong>Project/Job Location</strong></td>
      <td><strong><div align="center">Joining Date</div></strong></td>
      <td><strong><div align="center">TOTAL SERVICE LENGTH</div></strong></td>
      <td><strong><div align="center">MOBILE</div></strong></td>
      <td><strong><div align="center">REPORTING AUTH</div></strong></td>

    </tr>
  </thead>
  <?

	


	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



	     $basic_sql='select a.PBI_ID,a.PBI_CODE,e.ESSENTIAL_JOINING_DATE,

		a.PBI_NAME ,a.PBI_DESIGNATION ,a.PBI_DEPARTMENT,a.JOB_LOCATION,
		DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked,a.PBI_MOBILE,e.ESSENTIAL_REPORTING
		
		from personnel_basic_info a,essential_info e

		where 
       a.PBI_ID NOT IN (SELECT i.PBI_ID FROM  increment_detail i) and a.PBI_JOB_STATUS="In Service" and

		DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$_POST['year'].'-01-01" AND "'.$_POST['year'].'-04-30"   
		and e.PBI_ID=a.PBI_ID '.$tr_con.' group by a.PBI_ID order by e.ESSENTIAL_JOINING_DATE';




		


	$basic_query = mysql_query($basic_sql);
	$s1=1;
	while($r = mysql_fetch_object($basic_query)){
    
    $interval = date_diff(date_create(date('Y-m-d')), date_create($r->ESSENTIAL_JOINING_DATE));
?>
  <tr>
    <td><?=$s1++;?></td>
    <td><div align="center"><?=$r->PBI_CODE?></div></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$r->PBI_DESIGNATION);?></td> 
    <?php

 if($r->PBI_DEPARTMENT == 13){ ?>
    <td></td>
    <?php } else{ ?>
    <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$r->PBI_DEPARTMENT);?></td>
    <?php } ?>

    <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>

    <td><div align="center"><?=date('d-M-Y',strtotime($r->ESSENTIAL_JOINING_DATE))?></div></td>
    <td><div align="center"><?=$interval->format("%Y Y, %M M, %d D");?></div></td>
    <td><?=$r->PBI_MOBILE?></td>
    <td><div align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$r->ESSENTIAL_REPORTING);?></div></td>
 
  </tr>
  <? } ?>




</table>


<br>








 


<br>








<?
}



if($_POST['report']==1447)


{

$report="Yearly Increment Report";

?>

<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white; font-family: bangothic;"><strong>AKSID CORPORATION LIMITED.</strong></td>
  </tr>
  <tr>
  <td style="border:0px solid white;"><strong>Increment List of <?= $_POST['year']?></strong></td>
  </tr>
</table>


 

   <div align="center" style="font-size:17px"><strong>Slot 2 (May- August)</strong></div>
 
  <table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  
  
    <tr>
      <td><strong>SL</strong></td>
      <td><strong>EMP ID</strong></td>
     
      <td><strong>Employee Name</strong></td>
      <td><strong><div align="center">Designation</div></strong></td>
      <td><strong><div align="center">Department</div></strong></td>
      <td><strong>Project/Job Location</strong></td>
      <td><strong><div align="center">Joining Date</div></strong></td>
      <td><strong><div align="center">TOTAL SERVICE LENGTH</div></strong></td>
      <td><strong><div align="center">MOBILE</div></strong></td>
      <td><strong><div align="center">REPORTING AUTH</div></strong></td>

    </tr>
 
  <?

	


	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



	    $basic_sql='select a.PBI_ID,a.PBI_CODE,e.ESSENTIAL_JOINING_DATE,

		a.PBI_NAME ,a.PBI_DESIGNATION ,a.PBI_DEPARTMENT,a.JOB_LOCATION,
		DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked,e.ESSENTIAL_REPORTING,a.PBI_MOBILE
		
		from personnel_basic_info a,essential_info e

		where 
		a.PBI_ID NOT IN (SELECT i.PBI_ID FROM  increment_detail i) and a.PBI_JOB_STATUS="In Service" and
		DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$_POST['year'].'-05-01" AND "'.$_POST['year'].'-08-30"   
		and e.PBI_ID=a.PBI_ID '.$tr_con.' group by a.PBI_ID order by e.ESSENTIAL_JOINING_DATE';






		

	$basic_query = mysql_query($basic_sql);
	$s1=1;
	while($r = mysql_fetch_object($basic_query)){
    
    $interval = date_diff(date_create(date('Y-m-d')), date_create($r->ESSENTIAL_JOINING_DATE));
?>
  <tr>
    <td><?=$s1++;?></td>
    <td><div align="center"><?=$r->PBI_CODE?></div></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$r->PBI_DESIGNATION);?></td>
    <?php

 if($r->PBI_DEPARTMENT == 13){ ?>
    <td></td>
    <?php } else{ ?>
    <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$r->PBI_DEPARTMENT);?></td>
    <?php } ?>

    <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>

    <td><div align="center"><?=date('d-M-Y',strtotime($r->ESSENTIAL_JOINING_DATE))?></div></td>
    <td><div align="center"><?=$interval->format("%Y Y, %M M, %d D");?></div></td>
   <td><?=$r->PBI_MOBILE?></td>
    <td><div align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$r->ESSENTIAL_REPORTING);?></div></td>
 
  </tr>
  <? } ?>









</table>


<br>








<?
}



if($_POST['report']==1448)


{

$report="Yearly Increment Report";

?>

<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white; font-family: bangothic;"><strong>AKSID CORPORATION LIMITED.</strong></td>
  </tr>
  <tr>
  <td style="border:0px solid white;"><strong>Increment List of <?= $_POST['year']?></strong></td>
  </tr>
</table>


 

   <div align="center" style="font-size:17px"><strong>Slot 3 (September-December)</strong></div>
 
  <table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  
  
  
  
    <tr>
      <td><strong>SL</strong></td>
      <td><strong>EMP ID</strong></td>
     
      <td><strong>Employee Name</strong></td>
      <td><strong><div align="center">Designation</div></strong></td>
      <td><strong><div align="center">Department</div></strong></td>
      <td><strong>Project/Job Location</strong></td>
      <td><strong><div align="center">Joining Date</div></strong></td>
      <td><strong><div align="center">TOTAL SERVICE LENGTH</div></strong></td>
      <td><strong><div align="center">MOBILE</div></strong></td>
      <td><strong><div align="center">REPORTING AUTH</div></strong></td>

    </tr>
 
  <?

	


	if($_POST['department'] !='')
	$tr_con = ' and a.PBI_DEPARTMENT="'.$_POST['department'].'"';

	if($_POST['JOB_LOCATION'] !='')
	$tr_con = ' and a.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';



	    $basic_sql='select a.PBI_ID,a.PBI_CODE,e.ESSENTIAL_JOINING_DATE,

		a.PBI_NAME ,a.PBI_DESIGNATION ,a.PBI_DEPARTMENT,a.JOB_LOCATION,
		DATEDIFF(NOW(), e.ESSENTIAL_JOINING_DATE) AS days_worked,e.ESSENTIAL_REPORTING,a.PBI_MOBILE
		
		from personnel_basic_info a,essential_info e

		where 
		a.PBI_ID NOT IN (SELECT i.PBI_ID FROM  increment_detail i) and a.PBI_JOB_STATUS="In Service" and
		DATE_ADD(e.ESSENTIAL_JOINING_DATE, INTERVAL 1 YEAR) BETWEEN "'.$_POST['year'].'-09-01" AND "'.$_POST['year'].'-12-30"   
		and e.PBI_ID=a.PBI_ID '.$tr_con.' group by a.PBI_ID order by e.ESSENTIAL_JOINING_DATE';



	$basic_query = mysql_query($basic_sql);
	$s1=1;
	while($r = mysql_fetch_object($basic_query)){
    
    $interval = date_diff(date_create(date('Y-m-d')), date_create($r->ESSENTIAL_JOINING_DATE));
?>
  <tr>
    <td><?=$s1++;?></td>
    <td><div align="center"><?=$r->PBI_CODE?></div></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$r->PBI_DESIGNATION);?></td>
    <?php

 if($r->PBI_DEPARTMENT == 13){ ?>
    <td></td>
    <?php } else{ ?>
    <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$r->PBI_DEPARTMENT);?></td>
    <?php } ?>

    <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>

    <td><div align="center"><?=date('d-M-Y',strtotime($r->ESSENTIAL_JOINING_DATE))?></div></td>
    <td><div align="center"><?=$interval->format("%Y Y, %M M, %d D");?></div></td>
    <td><?=$r->PBI_MOBILE?></td>
    <td><div align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$r->ESSENTIAL_REPORTING);?></div></td>
 
  </tr>
  <? } ?>












</table>


<br>













<?
}





	if($_POST['report']==322){































	 $report="Transfer_Report";































































	?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Transfer Report of
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">Reference No</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th colspan="2"><div align="center">Transfer To</div></th>
      <th colspan="2"><div align="center">Transfer From</div></th>
      <th rowspan="2"><div align="center">Issue Date</div></th>
      <th rowspan="2"><div align="center">Effect Date</div></th>
    </tr>
    <tr>
      <th><div align="center">Department</div></th>
      <th><div align="center">Job Location/Project</div></th>
      <th><div align="center">Department</div></th>
      <th><div align="center">Job Location/Project</div></th>
    </tr>
  </thead>
  <tbody>
    <?































if($_POST['department'] !='')















































$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';































































if($_POST['JOB_LOCATION'] !='')















































$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';































































if($_POST['mon'] !='')















































$tr_con .= ' and t.TRANSFER_AFFECT_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-30"';































 $basic_sql='select p.PBI_NAME,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
 p.PBI_CODE,







 (select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation, t.TRANSFER_ORDER_NO,p.PBI_ID,(select PROJECT_DESC from project







 where PROJECT_ID=p.JOB_LOCATION) as project,(select DEPT_DESC from department where DEPT_ID=t.TRANSFER_PRESENT_DEPT) as old_department,







 (select PROJECT_DESC from project where PROJECT_ID=t.TRANSFER_PAST_PROJECT) as old_project,







 (select PROJECT_DESC from project where PROJECT_ID=t.TRANSFER_NEW_PROJECT) as new_project,















 date_format(t.TRANSFER_ORDER_DATE,"%d-%b-%Y") as issue_date,







 date_format(t.TRANSFER_AFFECT_DATE,"%d-%b-%Y") as affect_date from personnel_basic_info p, transfer_detail t where p.PBI_ID=t.PBI_ID '.$tr_con.' ' ;















































$basic_query = mysql_query($basic_sql);































































	 $sl = 1;















































    while($tf = mysql_fetch_object($basic_query)){















































	 $entry_by=$data->entry_by;















































     $year = date('Y');















































		 ?>
    <tr>
      <td><?=$sl++;?></td>
      <td><?=$tf->TRANSFER_ORDER_NO?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <? if($tf->department=='NO DEPARTMENT'){?>
      <td></td>
      <? }else{?>
      <td><?=$tf->department?></td>
      <? } ?>
      <td><?=$tf->new_project?></td>
      <? if($tf->old_department=='NO DEPARTMENT'){?>
      <td></td>
      <? }else{?>
      <td><?=$tf->old_department?></td>
      <? } ?>
      <td><?=$tf->old_project?></td>
      <td><?=$tf->issue_date?></td>
      <td><?=$tf->affect_date?></td>
    </tr>
    <?































































		 }































































































































		 ?>
  </tbody>
</table>
<br>
<br>
<br>
<?
  }




if($_POST['report']==133331){
$report="Transfer_Report";
$next_year = $_POST['year']-1;

?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Salary Tax Statement For the Financial Year
          <?=$_POST['year']-1;?>
          -
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">TIN No</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Job Location/Project</div></th>
      <th rowspan="2"><div align="center">July<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">August<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">September<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">October<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">November<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">December<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">January<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">February<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">March<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">April<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">May<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">June<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">Total</div></th>
    </tr>
  </thead>
  <tbody>
<?
if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';

if($_POST['JOB_LOCATION'] !='')
$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

/*if($_POST['year'] !='')

$tr_con .= ' and s.year="'.$_POST['year'].'"';*/

$basic_sql='select p.ESSENTIAL_TIN_NO,p.PBI_DOJ, p.PBI_ID,p.PBI_CODE, p.PBI_NAME,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,
(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project
from personnel_basic_info p, salary_info i
where p.PBI_ID=i.PBI_ID  '.$tr_con.' order by i.income_tax desc ' ;

$basic_query = mysql_query($basic_sql);



	 $sl = 1;

   while($tf = mysql_fetch_object($basic_query)){

	 $entry_by=$data->entry_by;
   $year = date('Y');
   $tax = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and  year="'.$_POST['year'].'"');
   $total_tax = find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and year in ("'.$_POST['year'].'","'.$next_year.'")');

  ?>
<?

if($total_tax>0){


	//Calculate total Tax
  $july   = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');
	$august = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');
	$sept   = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');
	$oct    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');
	$nov    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');
	$dec    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');
	$jan    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');
	$feb    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');
	$march  = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');
	$april  = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');
	$may    = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');
	$june   = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');

	$grand_total_amount = $july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june;
  if($grand_total_amount>0){
  ?>
    <tr>
      <td><?=$sl++;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td><?=$tf->PBI_DOJ?></td>
      <td><?=$tf->ESSENTIAL_TIN_NO?></td>
      <? if($tf->department=='NO DEPARTMENT'){?>
      <td></td>
      <? }else{?>
      <td><?=$tf->department?></td>
      <? } ?>
      <td><?=$tf->project?></td>
      <td align="right"><?=($july>0)? number_format($july,0) : '';           $totJuly += $july;?></td>
      <td align="right"><?=($august>0)? number_format($august,0) : '';       $totAugust += $august;?></td>
      <td align="right"><?=($sept>0)? number_format($sept,0) : '';           $totSept += $sept;?></td>
      <td align="right"><?=($oct>0)? number_format($oct,0) : '';             $totOct += $oct;?></td>
      <td align="right"><?=($nov>0)? number_format($nov,0) : '';             $totNov += $nov;?></td>
      <td align="right"><?=($dec>0)? number_format($dec,0) : '';             $totDec += $dec;?></td>
      <td align="right"><?=($jan>0)? number_format($jan,0) : '';             $totJan += $jan;?></td>
      <td align="right"><?=($feb>0)? number_format($feb,0) : '';             $totFeb += $feb;?></td>
      <td align="right"><?=($march>0)? number_format($march,0) : '';         $totMarch += $march;?></td>
      <td align="right"><?=($april>0)? number_format($april,0) : '';         $totApril += $april;?></td>
      <td align="right"><?=($may>0)? number_format($may,0) : '';             $totMay += $may;?></td>
      <td align="right"><?=($june>0)? number_format($june,0) : '';           $totJune += $june;?></td>
      <td align="right"><?=number_format($grand_total=$july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june,0)?></td>
    </tr>
    <?
    //$totJuly = $totJuly+$july;
    //$totAugust = $totAugust+$august;
    //$totSept = $totSept+$sept;
    //$totOct = $totOct+$oct;
    //$totNov = $totNov+$nov;
    //$totDec = $totDec+$dec;
    //$totJan = $totJan+$jan;
    //$totFeb = $totFeb+$feb;
    //$totMarch = $totMarch+$march;
    //$totApril = $totApril+$april;
    //$totMay = $totMay+$may;
    //$totJune = $totJune+$june;
    $grandTotal = $grandTotal+$grand_total;

   } } }

 ?>
    <tr>
      <td colspan="8"><strong>Grand Total</strong></td>
      <td><strong>
        <?=number_format($totJuly,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totAugust,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totSept,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totOct,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totNov,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totDec,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totJan,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totFeb,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totMarch,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totApril,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totMay,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($totJune,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($grandTotal,0);?>
        </strong></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<br>

<!-- Tx Investment Report Start *********************  -->

<?  }
if($_POST['report']==144659){
$report="Transfer_Report";
$next_year = $_POST['year']-1;

$fiscal_year = explode("-",$_POST['financial_year']);
$year_1 = $fiscal_year[0]-1;
$year_2 = $fiscal_year[1]-1;
$f_date = $year_1.'-07-01';
$t_date = $year_2.'-06-30';

//Assesment Year
$assesment_start_year = $fiscal_year[0];
$assesment_end_year = $fiscal_year[1];



?>

<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Tax Investment Report
          <?=$assesment_start_year;?>
          -
          <?=$assesment_end_year?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
			<th rowspan="2"><div align="center">Department</div></th>
			<th rowspan="2"><div align="center">Job Location/Project</div></th>
			<th rowspan="2"><div align="center">TIN No</div></th>
			<th rowspan="2"><div align="center">Total Salary</div></th>
			<th rowspan="2"><div align="center">Basic Salary</div></th>
			<th rowspan="2"><div align="center">House Allowance</div></th>
			<th rowspan="2"><div align="center">Medical Allowance</div></th>
			<th rowspan="2"><div align="center">Conveyance Allowance</div></th>
			<th rowspan="2"><div align="center">Festival Bonus</div></th>
			<th rowspan="2"><div align="center">Tax deducted</div></th>

			<th colspan="4"><div align="center">Investment for Rebate</div></th>

	</tr>
  <tr>
	 <th rowspan="2"><div align="center">Life Insurance</div></th>
 	 <th rowspan="2"><div align="center">DPS/FDR</div></th>
 	 <th rowspan="2"><div align="center">Saving Certificate</div></th>
 	 <th rowspan="2"><div align="center">Debenture, Share, Stock</div></th>


  </tr>
  </thead>
  <tbody>
<?
if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';

if($_POST['JOB_LOCATION'] !='')
$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

/*if($_POST['year'] !='')

$tr_con .= ' and s.year="'.$_POST['year'].'"';*/



//investment_start_date
$basic_sql='select p.ESSENTIAL_TIN_NO,p.PBI_DOJ, p.PBI_ID,p.PBI_CODE, p.PBI_NAME,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,
t.life_insurance,t.dps_amt,t.saving_certificate,t.debenture
from personnel_basic_info p,tax_investment t
where t.investment_start_date between "'.$f_date.'" and  "'.$t_date.'" and p.PBI_ID=t.PBI_ID '.$tr_con.' order by p.PBI_ID' ;

$basic_query = mysql_query($basic_sql);

	 $sl = 1;

   while($tf = mysql_fetch_object($basic_query)){

	 $entry_by=$data->entry_by;
   $year = date('Y');
   //$tax = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and  year="'.$_POST['year'].'"');
   //$total_tax = find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and year in ("'.$_POST['year'].'","'.$next_year.'")');




	   $sql_1 = 'select sum(gross_salary) as gross_salary,sum(basic_salary) as basic_salary,sum(house_rent) as house_rent,sum(medical_allowance) as medical_allowance, sum(special_allowance) as conveyance_allowance,
	 sum(food_allowance) as arrear, sum(income_tax) as income_tax,bank_or_cash,sum(bank_amt) as bank_amt from salary_attendence
	 where salary_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$tf->PBI_ID.'"';


	 $year_1_salary = mysql_query($sql_1);
	 $year_1_data = mysql_fetch_object($year_1_salary);
	 //$salary_given_status= $salary_certificate->cash_bank;

	 $bonus_1 = find_a_field('salary_bonus','sum(bonus_amt)','bonus_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$tf->PBI_ID.'"');
	 $bonus_1_for_status_5 = find_a_field('salary_bonus','sum(bank_paid)','bonus_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$tf->PBI_ID.'"');
	 //$total_tax_amt = find_a_field('emp_taxchalan_no','sum(chalan_amt)','chalan_start_date>="'.$f_date.'" and chalan_end_date<="'.$t_date.'" and PBI_ID="'.$tf->PBI_ID.'"');
	 //$other_allowances = find_a_field('monthly_addition_deduction','sum(consolidated+mobile_allowance)','tr_date between "'.$f_date.'" and  "'.$t_date.'" and PBI_ID="'.$salary_certificate->PBI_ID.'"');

  ?>
    <tr>
      <td><?=$sl++;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>

			<? if($tf->department=='NO DEPARTMENT'){?>
      <td></td>
      <? }else{?>
      <td><?=$tf->department?></td>
      <? } ?>
      <td><?=$tf->project?></td>
      <td><?=$tf->ESSENTIAL_TIN_NO?></td>
      <td align="right"><?=number_format($year_1_data->gross_salary);           $total_gross +=$year_1_data->gross_salary?></td>
			<td align="right"><?=number_format($year_1_data->basic_salary);           $total_basic +=$year_1_data->basic_salary?></td>
			<td align="right"><?=number_format($year_1_data->house_rent);             $total_house +=$year_1_data->house_rent?></td>
      <td align="right"><?=number_format($year_1_data->medical_allowance);      $total_medical +=$year_1_data->medical_allowance?></td>
			<td align="right"><?=number_format($year_1_data->conveyance_allowance);   $total_conveyance_allowance +=$year_1_data->conveyance_allowance?></td>
			<td align="right"><?=number_format($bonus_1);                             $total_bonus +=$bonus_1?></td>
			<td align="right"><?=number_format($year_1_data->income_tax);             $total_tax_amt +=$year_1_data->income_tax?></td>


			<td align="right"><?=number_format($tf->life_insurance);      $total_life_insurance +=$tf->life_insurance;?></td>
			<td align="right"><?=number_format($tf->dps_amt);             $total_dps_amt  +=$tf->dps_amt;?></td>
			<td align="right"><?=number_format($tf->saving_certificate);  $total_saving_certificate +=$tf->saving_certificate;?></td>
			<td align="right"><?=number_format($tf->debenture);           $total_debenture +=$tf->debenture;?></td>

    </tr>
    <?

    $grandTotal = $grandTotal+$grand_total;

    }

 ?>
    <tr>
      <td colspan="7"><strong>Grand Total</strong></td>
      <td align="center"><strong><?=number_format($total_gross,0);?></strong></td>
			<td align="center"><strong><?=number_format($total_basic,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_house,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_medical,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_conveyance_allowance,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_bonus,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_tax_amt,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_life_insurance,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_dps_amt,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_saving_certificate,0);?></strong></td>
      <td align="center"><strong><?=number_format($total_debenture,0);?></strong></td>

    </tr>
  </tbody>
</table>
<br>
<br>
<br>


<?
}

if($_POST['report']==144657){
$report="Transfer_Report";
$next_year = $_POST['year']-1;































































	?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Statement regarding the payment of salary
          <?=$next_year; ?>
          To
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">NAME</div></th>
      <th rowspan="2"><div align="center">DESIG.</div></th>
      <th rowspan="2"><div align="center">ETIN</div></th>
      <th rowspan="2"><div align="center">Total amount of salary, wages, bonus, annuities, pensions, gratuities, commission, fees or profits in lieu of salary and wages including payments made at or in connection with the termination of the employmnt and advance of salary, etc.</div></th>
      <th rowspan="2"><div align="center">Basic</div></th>
      <th rowspan="2"><div align="center">House Rent</div></th>
      <th rowspan="2"><div align="center">Medical</div></th>
      <th rowspan="2"><div align="center">Conveyance</div></th>
      <th rowspan="2"><div align="center">OT</div></th>
      <th rowspan="2"><div align="center">ARREAR</div></th>
      <th rowspan="2"><div align="center">PF</div></th>
      <th rowspan="2"><div align="center">Festival Bonus</div></th>
      <th rowspan="2"><div align="center">Commission</div></th>
      <th rowspan="2"><div align="center">Total amount liable to tax under section 21</div></th>
      <th rowspan="2"><div align="center">Tax payable on the amount in column 18</div></th>
      <th rowspan="2"><div align="center">Eligible amount for tax credit, if any, u/s 44(2)(b) of the Ordiance for tax credit</div></th>
      <th rowspan="2"><div align="center">Amount of tax credit u/s 44(2)(b) of the Ordiance</div></th>
      <th rowspan="2"><div align="center">Net amount of tax payable</div></th>
      <th rowspan="2"><div align="center">Tax deducted</div></th>
      <th rowspan="2"><div align="center">Tax paid to the credit of the Government</div></th>
    </tr>
  </thead>
  <tbody>
    <?































if($_POST['department'] !='')















































$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';































































if($_POST['JOB_LOCATION'] !='')















































$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';































if($_POST['job_status'] !='')































$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';































/*if($_POST['year'] !='')















































$tr_con .= ' and s.year="'.$_POST['year'].'"';*/































































$basic_sql='select p.ESSENTIAL_TIN_NO,p.PBI_DOJ, p.PBI_ID,p.PBI_CODE, p.PBI_NAME,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,
i.gross_salary,i.basic_salary*12 as basic_salary,i.house_rent*12 as house_rent,i.medical_allowance*12 as medical_allowance,i.pf,i.special_allowance*12 as conveyance,
i.food_allowance,i.transport_allowance
from personnel_basic_info p,salary_info i where i.basic_salary>0 and  p.PBI_ID=i.PBI_ID  '.$tr_con.' order by i.income_tax desc ' ;















































$basic_query = mysql_query($basic_sql);































































	 $sl = 1;















































    while($tf = mysql_fetch_object($basic_query)){















































	 $entry_by=$data->entry_by;















































































     $year = date('Y');















































	 $tax = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and  year="'.$_POST['year'].'"');







   $fastivel1 = find_a_field('salary_bonus','bonus_amt','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=1 and  year="'.$_POST['year'].'"');







   $fastivel2 = find_a_field('salary_bonus','bonus_amt','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=2 and  year="'.$next_year.'"');







   $total_tax = find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and year in ("'.$_POST['year'].'","'.$next_year.'")');































	   //for total salary















	   $salary=$tf->basic_salary;















	   $house=$tf->house_rent;































	   $total_amount_of_salary = $july_basic+$august_basic+$sept_basic+$oct_basic+$nov_basic+$dec_basic+$jan_basic+$feb_basic+$march_basic+$april_basic+$may_basic+$june_basic+$july_house+$august_house+$sept_house+$oct_house+$nov_house+$dec_house+$jan_house+$feb_house+$march_house+$april_house+$may_house+$june_house+$july_medical+$august_medical+$sept_medical+$oct_medical+$nov_medical+$dec_medical+$jan_medical+$feb_medical+$march_medical+$april_medical+$may_medical+$june_medical+$july_allowance+$august_allowance+$sept_allowance+$oct_allowance+$nov_allowance+$dec_allowance+$jan_allowance+$feb_allowance+$march_allowance+$april_allowance+$may_allowance+$june_allowance+$fastivel1+$fastivel2;















     $sum_total_tax_deduct+=$july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june;































































	   //































	   //for all tax deduct fiscal year wise































	   $july = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















	   $august =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















	   $sept =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















     $oct =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















	   $nov =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















	   $dec =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















	   $jan =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















	   $feb =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















	   $march =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















	   $april =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















	   $may =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















	   $june =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');































 //for all Basic salary deduct fiscal year wise















 $july_basic = find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















 $august_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















 $sept_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















 $oct_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















 $nov_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















 $dec_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















 $jan_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















 $feb_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















 $march_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















 $april_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















 $may_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















 $june_basic =find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');























 //for all Basic house_rent deduct fiscal year wise















 $july_house = find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















 $august_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















 $sept_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















 $oct_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















 $nov_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















 $dec_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















 $jan_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















 $feb_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















 $march_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















 $april_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















 $may_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















 $june_house =find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');























 //for all medical_allowance  deduct fiscal year wise















 $july_medical = find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















 $august_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















 $sept_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















 $oct_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















 $nov_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















 $dec_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















 $jan_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















 $feb_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















 $march_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















 $april_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















 $may_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















 $june_medical =find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');































//for all special_allowance  deduct fiscal year wise















$july_allowance = find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















$august_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















$sept_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















$oct_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















$nov_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















$dec_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















$jan_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















$feb_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















$march_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















$april_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















$may_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















$june_allowance =find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');







































































		 ?>
    <?































































































  ?>
    <tr>
      <td><?=$sl++;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td><?=$tf->ESSENTIAL_TIN_NO?></td>
      <td align="center"><?=number_format($july_basic+$august_basic+$sept_basic+$oct_basic+$nov_basic+$dec_basic+$jan_basic+$feb_basic+$march_basic+$april_basic+$may_basic+$june_basic+$july_house+$august_house+$sept_house+$oct_house+$nov_house+$dec_house+$jan_house+$feb_house+$march_house+$april_house+$may_house+$june_house+$july_medical+$august_medical+$sept_medical+$oct_medical+$nov_medical+$dec_medical+$jan_medical+$feb_medical+$march_medical+$april_medical+$may_medical+$june_medical+$july_allowance+$august_allowance+$sept_allowance+$oct_allowance+$nov_allowance+$dec_allowance+$jan_allowance+$feb_allowance+$march_allowance+$april_allowance+$may_allowance+$june_allowance+$fastivel1+$fastivel2); ?></td>
      <td align="center"><?=number_format($july_basic+$august_basic+$sept_basic+$oct_basic+$nov_basic+$dec_basic+$jan_basic+$feb_basic+$march_basic+$april_basic+$may_basic+$june_basic,0)?></td>
      <td align="center"><?=number_format($july_house+$august_house+$sept_house+$oct_house+$nov_house+$dec_house+$jan_house+$feb_house+$march_house+$april_house+$may_house+$june_house,0)?></td>
      <td align="center"><?=number_format($july_medical+$august_medical+$sept_medical+$oct_medical+$nov_medical+$dec_medical+$jan_medical+$feb_medical+$march_medical+$april_medical+$may_medical+$june_medical,0)?></td>
      <td align="center"><?=number_format($july_allowance+$august_allowance+$sept_allowance+$oct_allowance+$nov_allowance+$dec_allowance+$jan_allowance+$feb_allowance+$march_allowance+$april_allowance+$may_allowance+$june_allowance,0)?></td>
      <td></td>
      <td></td>
      <td align="center"><?=number_format($tf->pf)?></td>
      <td align="center"><? echo number_format($fastivel1+$fastivel2); ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center"><?=number_format($july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june,0)?></td>
      <td align="center"><?=number_format($july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june,0)?></td>
      <td align="center"><?=number_format($july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june,0)?></td>
    </tr>
    <?































$sum_total_amount_of_salary += $july_basic+$august_basic+$sept_basic+$oct_basic+$nov_basic+$dec_basic+$jan_basic+$feb_basic+$march_basic+$april_basic+$may_basic+$june_basic+$july_house+$august_house+$sept_house+$oct_house+$nov_house+$dec_house+$jan_house+$feb_house+$march_house+$april_house+$may_house+$june_house+$july_medical+$august_medical+$sept_medical+$oct_medical+$nov_medical+$dec_medical+$jan_medical+$feb_medical+$march_medical+$april_medical+$may_medical+$june_medical+$july_allowance+$august_allowance+$sept_allowance+$oct_allowance+$nov_allowance+$dec_allowance+$jan_allowance+$feb_allowance+$march_allowance+$april_allowance+$may_allowance+$june_allowance+$fastivel1+$fastivel2;























$sum_of_tax_deduct +=$sum_total_tax_deduct;































$salarysum  += $july_basic+$august_basic+$sept_basic+$oct_basic+$nov_basic+$dec_basic+$jan_basic+$feb_basic+$march_basic+$april_basic+$may_basic+$june_basic;







$housesum   += $july_house+$august_house+$sept_house+$oct_house+$nov_house+$dec_house+$jan_house+$feb_house+$march_house+$april_house+$may_house+$june_house;







$medicalSUM += $july_medical+$august_medical+$sept_medical+$oct_medical+$nov_medical+$dec_medical+$jan_medical+$feb_medical+$march_medical+$april_medical+$may_medical+$june_medical;







$conSUM     += $july_allowance+$august_allowance+$sept_allowance+$oct_allowance+$nov_allowance+$dec_allowance+$jan_allowance+$feb_allowance+$march_allowance+$april_allowance+$may_allowance+$june_allowance;







$fastivelsum +=$fastivel1+$fastivel2;















































		  }















































		 ?>
    <tr>
      <td colspan="4"></td>
      <td>Total</td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_amount_of_salary,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($salarysum,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($housesum,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($medicalSUM,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($conSUM,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($fastivelsum,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_tax_deduct,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_tax_deduct,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_tax_deduct,0)?>
          </strong></div></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<br>
<!--  for tax report   -->
<?















  } if($_POST['report']==144658){















    $report="Transfer_Report";







    $next_year = $_POST['year']-1;







    ?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Statement of Tax Deducted from Salaries  For the month of
          <? $month_name = date("F", mktime(0, 0, 0, $_POST['mon'], 10)); ?>
          <?=$month_name?>
          -
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <td style="border-left:0px; border-right:0px;" colspan="28"><div align="center" style="font-size:20px;">under section 50 of the Income Tax Ordiance, 1984 (XXXVI of 1984)</div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">Particulars of the employee from whom the deduction is made</div></td>
      <td colspan="9"><div align="center">Particulars of salaries</div></td>
      <td colspan="5"><div align="center">Payment of deducted tax to the credit of the Government</div></td>
      <td colspan="3"><div align="center"></div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">NAME</div></th>
      <th rowspan="2"><div align="center">DESIG.</div></th>
      <th rowspan="2"><div align="center">ETIN</div></th>
      <th rowspan="2"><div align="center">Basic salary including arrear or advance</div></th>
      <th rowspan="2"><div align="center">House Rent</div></th>
      <th rowspan="2"><div align="center">Medical</div></th>
      <th rowspan="2"><div align="center">Conveyance</div></th>
      <th rowspan="2"><div align="center">Festival Bonus</div></th>
      <th rowspan="2"><div align="center">Allowances and benefits paid in cash</div></th>
      <th rowspan="2"><div align="center">Value of benefit not paid in cash</div></th>
      <th rowspan="2"><div align="center">Any other amount falling under the head "Salaries"</div></th>
      <th rowspan="2"><div align="center">Total</div></th>
      <th rowspan="2"><div align="center">Amount of Tax deducted</div></th>
      <th rowspan="2"><div align="center">Challan* No</div></th>
      <th rowspan="2"><div align="center">Challan Date</div></th>
      <th rowspan="2"><div align="center">Bank Name</div></th>
      <th rowspan="2"><div align="center">Amount</div></th>
      <th rowspan="2"><div align="center">Cumulative deduction in this month of current year</div></th>
      <th rowspan="2"><div align="center">Remarks</div></th>
    </tr>
  </thead>
  <tbody>
    <?































        if($_POST['department'] !='')







        $tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';







        if($_POST['JOB_LOCATION'] !='')







        $tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';







        if($_POST['job_status'] !='')







        $tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';































/*if($_POST['year'] !='')







$tr_con .= ' and s.year="'.$_POST['year'].'"';*/































































        $basic_sql='select p.ESSENTIAL_TIN_NO,p.PBI_DOJ, p.PBI_ID,p.PBI_CODE, p.PBI_NAME,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,







        (select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,







        i.gross_salary,i.basic_salary,i.house_rent,i.medical_allowance,i.pf,i.special_allowance,i.food_allowance,







        i.transport_allowance,i.basic_salary_bank,i.house_rent_bank,i.medical_allowance_bank,i.special_allowance_bank







        from personnel_basic_info p,salary_info i where i.basic_salary>0 and i.income_tax>0 and  p.PBI_ID=i.PBI_ID  '.$tr_con.' order by i.income_tax desc ';















































       $basic_query = mysql_query($basic_sql);







       $sl = 1;







       while($tf = mysql_fetch_object($basic_query)){







       $entry_by=$data->entry_by;







       $year = date('Y');







       $tax = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and  year="'.$_POST['year'].'"');















       $fastivel1 = find_a_field('salary_bonus','bonus_amt','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=1 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







       $fastivel2 = find_a_field('salary_bonus','bonus_amt','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=2 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');















       $fastivel1_bank = find_a_field('salary_bonus','bank_paid','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=1 and mon="'.$_POST['mon'].'" and  year="'.$_POST['year'].'"');







       $fastivel2_bank = find_a_field('salary_bonus','bank_paid','PBI_ID="'.$tf->PBI_ID.'" and bonus_type=2 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');















       $total_tax = find_a_field('salary_attendence','sum(income_tax)','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and year in ("'.$_POST['year'].'","'.$next_year.'")');























        //for salary condition







       //$salary_given_status=find_a_field('salary_attendence','bank_or_cash','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon="'.$_POST['mon'].'" and  year="'.$_POST['year'].'"');















       $salary_given_status=find_a_field('salary_info','cash_bank','PBI_ID="'.$tf->PBI_ID.'"');































       //for total salary







       $salary=$tf->basic_salary;















	     $house=$tf->house_rent;































        //for all tax deduct fiscal year wise















        $july = find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=7 and year="'.$next_year.'"');















        $august =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=8 and year="'.$next_year.'"');















        $sept =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=9 and year="'.$next_year.'"');















        $oct =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=10 and year="'.$next_year.'"');















        $nov =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=11 and year="'.$next_year.'"');















        $dec =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=12 and year="'.$next_year.'"');















        $jan =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=1 and year="'.$_POST['year'].'"');















        $feb =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=2 and year="'.$_POST['year'].'"');















        $march =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=3 and year="'.$_POST['year'].'"');















        $april =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0  and mon=4 and year="'.$_POST['year'].'"');















        $may =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=5 and year="'.$_POST['year'].'"');















        $june =find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon=6 and year="'.$_POST['year'].'"');















       //for all tax deduct fiscal year wise







        $tax=find_a_field('salary_attendence','income_tax','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







        //for all Basic salary deduct fiscal year wise







        $basic_salary=find_a_field('salary_attendence','basic_salary','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







        //for all Basic house_rent deduct fiscal year wise







        $house_rent=find_a_field('salary_attendence','house_rent','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







        //for all medical_allowance  deduct fiscal year wise







        $medical_allowance=find_a_field('salary_attendence','medical_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







        //for all special_allowance  deduct fiscal year wise







        $special_allowance=find_a_field('salary_attendence','special_allowance','PBI_ID="'.$tf->PBI_ID.'" and pay>0 and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');























   ?>
    <?







      ?>
    <tr>
      <td><?=$sl++;?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td><?=$tf->ESSENTIAL_TIN_NO?></td>
      <?php  if($salary_given_status==5){ ?>
      <td align="center"><?=($tf->basic_salary_bank>0)? $tf->basic_salary_bank : '';               $totBasic += $tf->basic_salary_bank?></td>
      <td align="center"><?=($tf->house_rent_bank>0)? $tf->house_rent_bank : '';                   $totHouse += $tf->house_rent_bank?></td>
      <td align="center"><?=($tf->medical_allowance_bank>0)? $tf->medical_allowance_bank : '';     $totMedical += $tf->medical_allowance_bank?></td>
      <td align="center"><?=($tf->special_allowance_bank>0)? $tf->special_allowance_bank : '';     $totspecial += $tf->special_allowance_bank?></td>
      <?php  }else{  ?>
      <td align="center"><?=($basic_salary>0)? $basic_salary : '';              $totBasic +=$basic_salary?></td>
      <td align="center"><?=($house_rent>0)? $house_rent : '';                  $totHouse +=$house_rent?></td>
      <td align="center"><?=($medical_allowance>0)? $medical_allowance : '';    $totMedical +=$medical_allowance?></td>
      <td align="center"><?=($special_allowance>0)? $special_allowance : '';    $totspecial +=$special_allowance?></td>
      <?php  } ?>
      <?php  if($salary_given_status==5){ ?>
      <td align="center"><? echo number_format($festivel_gross_total=$fastivel1_bank+$fastivel2_bank); ?></td>
      <?php  }else{  ?>
      <td align="center"><? echo number_format($festivel_gross_total=$fastivel1+$fastivel2); ?></td>
      <?php  } ?>
      <td></td>
      <td></td>
      <td align="center"></td>
      <?php  if($salary_given_status==5){ ?>
      <td><?=number_format($gross_total=$totBasic+$totHouse+$totMedical+$totspecial +$fastivel1_bank+$fastivel2_bank,0)?></td>
      <?php  }else{  ?>
      <td><?=number_format($gross_total=$basic_salary+$house_rent+$medical_allowance+$special_allowance+$fastivel1+$fastivel2,0)?></td>
      <?php  } ?>
      <td align="center"><?=($tax>0)? number_format($tax,0) : ''; ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td align="center"></td>
      <td align="center"><?=($july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june>0)? number_format($july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june,0) : ''; ?></td>
      <td align="center"></td>
    </tr>
    <?































      $sum_total_amount_of_salary +=$gross_total;















      $sum_total_tax_deduct+=$july+$august+$sept+$oct+$nov+$dec+$jan+$feb+$march+$april+$may+$june;























      $sum_of_tax_deduct +=$tax;







































      $fastivelsum +=$festivel_gross_total;















































		  }















































		 ?>
    <tr>
      <td colspan="3"></td>
      <td>Total</td>
      <td><div align="center"><strong>
          <?=number_format($totBasic,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($totHouse,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($totMedical,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($totspecial,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($fastivelsum,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_amount_of_salary,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_of_tax_deduct,0)?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong>
          <? ?>
          </strong></div></td>
      <td><div align="center"><strong></strong></div></td>
      <td><div align="center"><strong>
          <?=number_format($sum_total_tax_deduct,0)?>
          </strong></div></td>
      <td><div align="center"><strong></strong></div></td>
    </tr>
  </tbody>
</table>
<br>
<?































 }















































if($_POST['report']==551010){



?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">Job Location/Department</div></th>

      <?  for ($i = 1; $i <= 12; $i++) {
		$timestamp = mktime(0, 0, 0, $i);
		$label = date("F", $timestamp);
		echo  '<th colspan="2"><div align="center">' . $label . '</div></th>';
		} ?>


      <th colspan="2">Eid-ul-Fitre</th>
      <th colspan="2">Eid-ul-Adha</th>
      <th rowspan="2">Total</th>




    </tr>

    <tr>


        <?  for ($i = 1; $i <= 12; $i++) {
		$timestamp = mktime(0, 0, 0, $i);
		$label = date("F", $timestamp);
		echo  '<th><div align="center">No oF Employee</div></th>';
		echo  '<th><div align="center">Salary</div></th>';
		} ?>


      <th><div align="center">No oF Employee</div></th>
      <th><div align="center">Bonus</div></th>


      <th><div align="center">No oF Employee</div></th>
      <th><div align="center">Bonus</div></th>




    </tr>
  </thead>
  <tbody>
    <?

$proj_sql = 'select p.PROJECT_ID,p.PROJECT_DESC,sum(s.total_payable) as total_pay
from project p,salary_attendence_lock s where 1 and s.job_location=p.PROJECT_ID and s.year="'.$_POST['year'].'" group by s.job_location';
$proj_query = mysql_query($proj_sql);


while($proj_data = mysql_fetch_object($proj_query )){
if($proj_data->total_pay>0){ ?>
    <tr>
   <td><?=$proj_data->PROJECT_DESC?></td>


      <?
    for ($i = 1; $i <= 12; $i++) { ?>


      <td style="text-align: right;"><?
      $pro_emp = find_a_field('salary_attendence_lock','count(PBI_ID)','mon="'.$i.'" and year="'.$_POST['year'].'" and
      job_location="'.$proj_data->PROJECT_ID.'" and pay>0 and remarks_details!="hold"');
      echo number_format($pro_emp,0); $pro_emp_total+=$pro_emp;?></td>

      <td style="text-align: right;">
      <? $prow = find_a_field('salary_attendence_lock','sum(total_earning)','mon="'.$i.'" and year="'.$_POST['year'].'" and
      job_location="'.$proj_data->PROJECT_ID.'" and pay>0 and remarks_details!="hold"'); echo number_format($prow,0); $prow_total+=$prow;?>
      </td>





      <? } ?>


       <td align="right"><?=(number_format($eid_ul_fitre_emp =find_a_field('salary_bonus','count(PBI_ID)', 'bonus_type=1 and pbi_job_location="'.$proj_data->PROJECT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)?
       number_format($eid_ul_fitre_emp,0) : '';$fitre_emp += $eid_ul_fitre_emp;?></td>


      <td align="right"><?=(number_format($eid_ul_fitre =find_a_field('salary_bonus','sum(bonus_amt)', 'bonus_type=1 and pbi_job_location="'.$proj_data->PROJECT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)? number_format($eid_ul_fitre,0) : '';$fitre += $eid_ul_fitre;?></td>


     <td align="right"><?=(number_format($eid_ul_adha_emp =find_a_field('salary_bonus','count(PBI_ID)', 'bonus_type=2 and pbi_job_location="'.$proj_data->PROJECT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)?
     number_format($eid_ul_adha_emp,0) : '';$adha_emp +=$eid_ul_adha_emp;?></td>


      <td align="right"><?=(number_format($eid_ul_adha =find_a_field('salary_bonus','sum(bonus_amt)', 'bonus_type=2 and pbi_job_location="'.$proj_data->PROJECT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)? number_format($eid_ul_adha,0) : '';$adha+=$eid_ul_adha;?></td>

      <td style="text-align: right;"><?=$pgrand_row_tot= number_format($prow_total+$eid_ul_fitre+$eid_ul_adha,0);$pgrand_row_tot_all+=$prow_total;$prow_total=0;?></td>
    </tr>
    <? } } ?>
    <?
     $dept_sql = 'select d.DEPT_ID,d.DEPT_DESC, sum(s.total_earning) as total_pay from department d,salary_attendence_lock s
     where 1 and s.department=d.DEPT_ID and s.year="'.$_POST['year'].'" and s.department not in (13) group by s.department';
        $dept_query = mysql_query($dept_sql);
       while($dept_data = mysql_fetch_object($dept_query )){
       if($dept_data->total_pay>0){

    ?>
    <tr>
      <td><?=$dept_data->DEPT_DESC?></td>
      <?

      for ($i = 1; $i <= 12; $i++) { ?>

      <td style="text-align: right;"><? $drow_emp = find_a_field('salary_attendence_lock','count(PBI_ID)','mon="'.$i.'" and
      year="'.$_POST['year'].'" and department="'.$dept_data->DEPT_ID.'" and pay>0 and remarks_details!="hold"');
      echo number_format($drow_emp,0); $drow_emp_total += $drow_emp?></td>

      <td style="text-align: right;"><? $drow = find_a_field('salary_attendence_lock','sum(total_earning)','mon="'.$i.'" and
      year="'.$_POST['year'].'" and department="'.$dept_data->DEPT_ID.'" and pay>0 and remarks_details!="hold"');
      echo number_format($drow,0); $drow_total += $drow?></td>

      <? } ?>


     <td align="right"><?=(number_format($deid_ul_fitre_emp =find_a_field('salary_bonus','count(PBI_ID)', 'bonus_type=1 and
     pbi_department="'.$dept_data->DEPT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)?
     number_format($deid_ul_fitre_emp,0) : '';$dfitre_emp +=$deid_ul_fitre_emp;?></td>


      <td align="right"><?=(number_format($deid_ul_fitre =find_a_field('salary_bonus','sum(bonus_amt)', 'bonus_type=1 and pbi_department="'.$dept_data->DEPT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)?
      number_format($deid_ul_fitre,0) : '';$dfitre+=$deid_ul_fitre;?></td>


      <td align="right"><?=(number_format($deid_ul_adha_em =find_a_field('salary_bonus','count(PBI_ID)', 'bonus_type=2 and
      pbi_department="'.$dept_data->DEPT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)?
      number_format($deid_ul_adha_em,0) : ''; $dadha_emp +=$deid_ul_adha_em;?></td>


      <td align="right"><?=(number_format($deid_ul_adha =find_a_field('salary_bonus','sum(bonus_amt)', 'bonus_type=2 and pbi_department="'.$dept_data->DEPT_ID.'"  and year="'.$_POST['year'].'"'),0)>0)? number_format($deid_ul_adha,0) : '';$dadha+=$deid_ul_adha;?></td>


      <td style="text-align: right;"><?=$dgrand_row_tot = number_format($drow_total+$deid_ul_fitre+$deid_ul_adha,0);
      $dgrand_row_tot_all+=$drow_total;$drow_total=0;?></td>

    </tr>
    <? } } ?>


    <tr>

      <td><strong>Total</strong></td>
      <?

      for ($i = 1; $i <= 12; $i++) { ?>

      	 <td style="text-align: right;"><strong>
        <? $rowColmTotal = find_a_field('salary_attendence_lock','count(PBI_ID)','year="'.$_POST['year'].'" and mon="'.$i.'"  and pay>0');
         echo number_format($rowColmTotal,0);?>
        </strong></td>


      <td style="text-align: right;"><strong>
        <? $rowColmTotal = find_a_field('salary_attendence_lock','sum(total_earning)','year="'.$_POST['year'].'" and mon="'.$i.'"  and pay>0');
         echo number_format($rowColmTotal,0);?>
        </strong></td>
      <? } ?>


       <td style="text-align: right;"><strong>
        <?=number_format($fitre_emp+$dfitre_emp,0)?>
        </strong></td>


      <td style="text-align: right;"><strong>
        <?=number_format($dfitre+$fitre,0)?>
        </strong></td>

         <td style="text-align: right;"><strong>
        <?=number_format($adha_emp+$dadha_emp,0)?>
        </strong></td>


      <td style="text-align: right;"><strong>
        <?=number_format($dadha+$adha,0)?>
        </strong></td>


      <td style="text-align: right;"><strong>
        <?=number_format($dgrand_row_tot_all+$pgrand_row_tot_all,0) ?>
        </strong></td>
    </tr>
  </tbody>
</table>

<br>
<br>


<? }


if($_POST['report']==21211212){

$report="Individual fiscal salary statement";



 $next_year = $_POST['year']-1;











 $m = find_a_field('salary_bonus','bonus_date','bonus_type=1 and year="'.$next_year.'"');



 $m2 = find_a_field('salary_bonus','bonus_date','bonus_type=2 and year="'.$next_year.'"');































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Individual Fiscal Salary Statement
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">July<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">August<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">September<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">October<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">November<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">December<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">January<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">February<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">March<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">April<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">May<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">June<br>
          <?=$_POST['year']?>
        </div></th>
      <?











				$start = $next_year.'-07-01';



				$end =  $_POST['year'].'-06-30';







				$bonus1 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1');











				$bonus2 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 2');















				//$m = find_a_field('salary_bonus','mon','cut_off_date between "'.$start.'" and "'.$end.'" and bonus_type = 1');



				//$m2 = find_a_field('salary_bonus','mon','cut_off_date between "'.$start.'" and "'.$end.'" and bonus_type = 2');











				//$m = find_a_field('salary_bonus','cut_off_date','bonus_type=1 and year="'.$next_year.'"');



				//$m2 = find_a_field('salary_bonus','cut_off_date','bonus_type=2 and year="'.$next_year.'"');































			?>
      <th rowspan="2"><div align="center">Eid-Ul-Adha<br>
          <?  if($bonus2>0){    ?>
          <?=$bonus2?>
          -
          <?=date('F',strtotime($m2))?>
          <? }  ?>
        </div></th>
      <th rowspan="2"><div align="center">Eid-Ul-Fitre<br>
          <?  if($bonus1>0){    ?>
          <?=$bonus1?>
          -
          <?=date('F',strtotime($m))?>
          <? }  ?>
        </div></th>
      <th rowspan="2"><div align="center">Total</div></th>
    </tr>
  </thead>
  <tbody>
    <?































if($_POST['department'] !='')































































$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';















































if($_POST['JOB_LOCATION'] !='')















































$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';































































if($_POST['job_status'] !='')































































$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';















































$salary_sql = 'select p.PBI_ID, p.PBI_CODE,
p.PBI_NAME,p.PBI_DOJ,(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation from personnel_basic_info p where 1 '.$tr_con.' order by p.PBI_DOJ ';































































$s_query = mysql_query($salary_sql);































































while($tf = mysql_fetch_object($s_query)){















































$final_sql = 'select sum(total_payable) as total_amt from salary_attendence where year="'.$_POST['year'].'" and PBI_ID="'.$tf->PBI_ID.'" order by total_payable desc';































































$final_query = mysql_query($final_sql);































































while($final = mysql_fetch_object($final_query)){















































if($final->total_amt>0){















































?>
    <tr>
      <td><?=++$j;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td width="6%"><?=date('d-M-Y',strtotime($tf->PBI_DOJ))?></td>
      <?php /*?><td><?=$tf->ESSENTIAL_TIN_NO?></td><?php */?>
      <?php /*?><td><?=$tf->project?></td><?php */?>
      <td align="right"><?=(number_format($july =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=7 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($july,0) : '';?></td>
      <td align="right"><?=(number_format($august =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=8 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($august,0) : '';?></td>
      <td align="right"><?=(number_format($sept =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=9 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($sept,0) : '';?></td>
      <td align="right"><?=(number_format($oct =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=10 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($oct,0) : '';?></td>
      <td align="right"><?=(number_format($nov =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=11 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($nov,0) : '';?></td>
      <td align="right"><?=(number_format($dec =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=12 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($dec,0) : '';?></td>
      <td align="right"><?=(number_format($jan =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=1 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($jan,0) : '';?></td>
      <td align="right"><?=(number_format($feb =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=2 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($feb,0) : '';?></td>
      <td align="right"><?=(number_format($march =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=3 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($march,0) : '';?></td>
      <td align="right"><?=(number_format($april =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=4 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($april,0) : '';?></td>
      <td align="right"><?=(number_format($may =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=5 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($may,0) : '';?></td>
      <td align="right"><?=(number_format($june =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=6 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($june,0) : '';?></td>
      <?







		     $start = $next_year.'-07-01';



             $end =  $_POST['year'].'-06-30';























       ?>
      <td align="right"><?=(number_format($eid_ul_fitre =find_a_field('salary_bonus','SUM(bonus_amt)','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 2 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_fitre,0) : '';?></td>
      <td align="right"><?=(number_format($eid_ul_adha =find_a_field('salary_bonus','SUM(bonus_amt)','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_adha,0) : '';?></td>
      <td align="right"><?=number_format($tot = $jan+$feb+$march+$april+$may+$june+$july+$august+$sept+$oct+$nov+$dec+$eid_ul_adha+$eid_ul_fitre,0)?></td>
    </tr>
    <?































































































































		  $july_total = $july_total+$july;































































		 $august_total = $august_total+$august;































































		 $sept_total = $sept_total+$sept;































































		 $oct_total = $oct_total+$oct;































































		 $nov_total = $nov_total+$nov;































































		 $dec_total = $dec_total+$dec;































































































































































		 $jan_total = $jan_total+$jan;































































		 $feb_total = $feb_total+$feb;































































		 $march_total = $march_total+$march;































































		 $april_total = $april_total+$april;































































		 $may_total = $may_total+$may;































































		 $june_total = $june_total+$june;































		 $eid_ul_adha_total = $eid_ul_adha_total+$eid_ul_adha;



         $eid_ul_fitre_total = $eid_ul_fitre_total+$eid_ul_fitre;















       $grand_total = $grand_total+$tot;































































          }















































		  }































































          }















































































































		 ?>
    <tr>
      <td colspan="5" align="right"><strong>Total</strong></td>
      <td><strong>
        <?=number_format($july_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($august_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($sept_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($oct_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($nov_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($dec_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($jan_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($feb_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($march_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($april_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($may_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($june_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_fitre_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_adha_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($grand_total,0);?>
        </strong></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<br>








<!-- Fiscal year report new for tax exampted -->



<? }


if($_POST['report']==21231212){

$report="Individual fiscal salary statement";

$next_year = $_POST['year']-1;
$m = find_a_field('salary_bonus','bonus_date','bonus_type=1 and year="'.$next_year.'"');
$m2 = find_a_field('salary_bonus','bonus_date','bonus_type=2 and year="'.$next_year.'"');

?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Individual Fiscal Salary Statement
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">July<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">August<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">September<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">October<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">November<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">December<br>
          <?=$next_year?>
        </div></th>
      <th rowspan="2"><div align="center">January<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">February<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">March<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">April<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">May<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">June<br>
          <?=$_POST['year']?>
        </div></th>
      <?

$start = $next_year.'-07-01';
$end =  $_POST['year'].'-06-30';
$bonus1 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1');
$bonus2 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 2');



?>
      <th rowspan="2"><div align="center">Eid-Ul-Adha<br>
          <?  if($bonus2>0){    ?>
          <?=$bonus2?>
          -
          <?=date('F',strtotime($m2))?>
          <? }  ?>
        </div></th>
      <th rowspan="2"><div align="center">Eid-Ul-Fitre<br>
          <?  if($bonus1>0){    ?>
          <?=$bonus1?>
          -
          <?=date('F',strtotime($m))?>
          <? }  ?>
        </div></th>
        <th rowspan="2"><div align="center">Sales Commission</div></th>
        <th rowspan="2"><div align="center">Total</div></th>
    </tr>
  </thead>
  <tbody>
    <?



    


if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';
if($_POST['JOB_LOCATION'] !='')
$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';
if($_POST['job_status'] !='')
$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$salary_sql = 'select p.PBI_ID, p.PBI_CODE,
p.PBI_NAME,p.PBI_DOJ,(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation
from personnel_basic_info p,salary_info s where s.PBI_ID=p.PBI_ID '.$tr_con.' order by s.gross_salary desc';

$s_query = mysql_query($salary_sql);

while($tf = mysql_fetch_object($s_query)){








$final_sql = 'select sum(gross_salary) as total_amt,bank_or_cash
from salary_attendence where year="'.$_POST['year'].'" and PBI_ID="'.$tf->PBI_ID.'" order by (gross_salary) desc';
$final_query = mysql_query($final_sql);
while($final = mysql_fetch_object($final_query)){
if($final->total_amt>0){








?>
    <tr>
      <td><?=++$j;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td width="6%"><?=date('d-M-Y',strtotime($tf->PBI_DOJ))?></td>

      <? if($final->bank_or_cash==5){ ?>

      <td align="right"><?=(number_format($july =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=7 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($july,0) : '';?></td>


      <td align="right"><?=(number_format($august =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=8 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($august,0) : '';?></td>
      <td align="right"><?=(number_format($sept =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=9 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($sept,0) : '';?></td>
      <td align="right"><?=(number_format($oct =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=10 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($oct,0) : '';?></td>
      <td align="right"><?=(number_format($nov =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=11 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($nov,0) : '';?></td>
      <td align="right"><?=(number_format($dec =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=12 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($dec,0) : '';?></td>
      <td align="right"><?=(number_format($jan =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=1 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($jan,0) : '';?></td>
      <td align="right"><?=(number_format($feb =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=2 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($feb,0) : '';?></td>
      <td align="right"><?=(number_format($march =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=3 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($march,0) : '';?></td>
      <td align="right"><?=(number_format($april =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=4 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($april,0) : '';?></td>
      <td align="right"><?=(number_format($may =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=5 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($may,0) : '';?></td>
      <td align="right"><?=(number_format($june =find_a_field('salary_attendence','bank_amt','PBI_ID="'.$tf->PBI_ID.'" and mon=6 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($june,0) : '';?></td>

  <? }else{ ?>


  	 <td align="right"><?=(number_format($july =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=7 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($july,0) : '';?></td>


      <td align="right"><?=(number_format($august =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=8 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($august,0) : '';?></td>
      <td align="right"><?=(number_format($sept =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=9 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($sept,0) : '';?></td>
      <td align="right"><?=(number_format($oct =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=10 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($oct,0) : '';?></td>
      <td align="right"><?=(number_format($nov =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=11 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($nov,0) : '';?></td>
      <td align="right"><?=(number_format($dec =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=12 and year="'.$next_year.'" and remarks_details!="hold"'),0)>0)? number_format($dec,0) : '';?></td>
      <td align="right"><?=(number_format($jan =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=1 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($jan,0) : '';?></td>
      <td align="right"><?=(number_format($feb =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=2 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($feb,0) : '';?></td>
      <td align="right"><?=(number_format($march =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=3 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($march,0) : '';?></td>
      <td align="right"><?=(number_format($april =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=4 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($april,0) : '';?></td>
      <td align="right"><?=(number_format($may =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=5 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($may,0) : '';?></td>
      <td align="right"><?=(number_format($june =find_a_field('salary_attendence','gross_salary','PBI_ID="'.$tf->PBI_ID.'" and mon=6 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($june,0) : '';?></td>

      <? } ?>


      <?
$start = $next_year.'-07-01';
$end =  $_POST['year'].'-06-30';

?>    

  <? if($final->bank_or_cash==5){ ?>

  	 <td align="right"><?=(number_format($eid_ul_fitre =find_a_field('salary_bonus','SUM(bank_paid)','bonus_date between "'.$start.'" and
      "'.$end.'" and bonus_type = 2 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_fitre,0) : '';?></td>


      <td align="right"><?=(number_format($eid_ul_adha =find_a_field('salary_bonus','SUM(bank_paid)','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_adha,0) : '';?></td>


  	<? }else{ ?>

      <td align="right"><?=(number_format($eid_ul_fitre =find_a_field('salary_bonus','SUM(bonus_amt)','bonus_date between "'.$start.'" and
      "'.$end.'" and bonus_type = 2 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_fitre,0) : '';?></td>


      <td align="right"><?=(number_format($eid_ul_adha =find_a_field('salary_bonus','SUM(bonus_amt)','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1 and PBI_ID='.$tf->PBI_ID),0)>0)? number_format($eid_ul_adha,0) : '';?></td>

  <? } ?>



  <td align="right">


  <?


//TAX INVESMENT AMOUNT
 $sqldd = 'select t.PBI_ID,
sum(t.jan_com) as jan_com,sum(t.feb_com) as feb_com,sum(t.mar_com) as mar_com,sum(t.apr_com) as apr_com,sum(t.may_com) as may_com,
sum(t.jun_com) as jun_com,
sum(t.jul_com) as jul_com,sum(t.aug_com) as aug_com,sum(t.sep_com) as sep_com,sum(t.oct_com) as oct_com,sum(t.nov_com) as nov_com,
sum(t.dec_com) as dec_com,sum(t.special_consideration) as special_consideration,
sum(t.tax_deduction) as tax_deduction,sum(t.advance_deduction) as advance_deduction

from
monthly_sales_commission t

where
t.PBI_ID="'.$tf->PBI_ID.'" and
t.financial_year between "'.$start.'" and  "'.$end.'"
group by t.PBI_ID';

$querydd=mysql_query($sqldd);


while($conData = mysql_fetch_object($querydd)){

 $net_convaince = $conData->jan_com+$conData->feb_com+$conData->mar_com+$conData->apr_com+$conData->may_com+$conData->jun_com+$conData->jul_com+
$conData->aug_com+$conData->sep_com+$conData->oct_com+$conData->nov_com+$conData->dec_com+$conData->special_consideration;


echo number_format($tot_net_convaince = $net_convaince ,0);


$grand_net_convaincee += $tot_net_convaince;

}

//END TAX INVESMENT AMOUNT



  ?>







  	</td>
 


  <td align="right">
  	<?=number_format($tot = $jan+$feb+$march+$april+$may+$june+$july+$august+$sept+$oct+$nov+$dec+$eid_ul_adha+$eid_ul_fitre+$tot_net_convaince,0)?></td>
    </tr>
    <?
$july_total = $july_total+$july;
$august_total = $august_total+$august;
$sept_total = $sept_total+$sept;
$oct_total = $oct_total+$oct;
$nov_total = $nov_total+$nov;

$dec_total = $dec_total+$dec;



$jan_total = $jan_total+$jan;
$feb_total = $feb_total+$feb;
$march_total = $march_total+$march;
$april_total = $april_total+$april;
$may_total = $may_total+$may;
$june_total = $june_total+$june;
$eid_ul_adha_total = $eid_ul_adha_total+$eid_ul_adha;
$eid_ul_fitre_total = $eid_ul_fitre_total+$eid_ul_fitre;
$grand_net_convaince = $grand_net_convaincee;

$grand_total = $grand_total+$tot;



}


}

}


?>
    <tr>
      <td colspan="5" align="right"><strong>Total</strong></td>
      <td><strong>
        <?=number_format($july_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($august_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($sept_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($oct_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($nov_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($dec_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($jan_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($feb_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($march_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($april_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($may_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($june_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_fitre_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_adha_total,0);?>
        </strong></td>
         <td><strong>
        <?=number_format($grand_net_convaince,0);?>
        </strong></td>

      <td><strong>
        <?=number_format($grand_total,0);?>
        </strong></td>

        
    </tr>
  </tbody>
</table>
<br>
<br>
<br>










<?

}if($_POST['report']==233332){



$report="Yearly_Salary_Statement";

$next_year = $_POST['year']-1;


?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Yearly Salary Statement Report of
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">January<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">February<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">March<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">April<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">May<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">June<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">July<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">August<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">September<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">October<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">November<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">December<br>
          <?=$_POST['year']?>
        </div></th>
      <?







		        $start = $_POST['year'].'-01-01';



				$end =  $_POST['year'].'-12-30';







				$bonus1 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 1');











				$bonus2 = find_a_field('salary_bonus','year','bonus_date between "'.$start.'" and "'.$end.'" and bonus_type = 2');















				//$m = find_a_field('salary_bonus','mon','cut_off_date between "'.$start.'" and "'.$end.'" and bonus_type = 1');



				//$m2 = find_a_field('salary_bonus','mon','cut_off_date between "'.$start.'" and "'.$end.'" and bonus_type = 2');











				$m = find_a_field('salary_bonus','bonus_date','bonus_type=1 and year="'.$_POST['year'].'"');



				$m2 = find_a_field('salary_bonus','bonus_date','bonus_type=2 and year="'.$_POST['year'].'"');



















		 ?>
      <?php /*?>











         <th rowspan="2"><div align="center">Eid-Ul-Fitre<br>



         <?=$_POST['year']?>



         </div></th>











         <th rowspan="2"><div align="center">Eid-Ul-Adha<br>



         <?=$_POST['year']?>



          </div></th>







		  <?php */?>
      <th rowspan="2"><div align="center">Eid-Ul-Fitre<br>
          <?  if($bonus1>0){    ?>
          <?=$bonus1?>
          -
          <?=date('F',strtotime($m))?>
          <? }  ?>
        </div></th>
      <th rowspan="2"><div align="center">Eid-Ul-Adha<br>
          <?  if($bonus2>0){    ?>
          <?=$bonus2?>
          -
          <?=date('F',strtotime($m2))?>
          <? }  ?>
        </div></th>
      <th rowspan="2"><div align="center">Total</div></th>
    </tr>
  </thead>
  <tbody>
    <?

if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';
if($_POST['JOB_LOCATION'] !='')

$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

if($_POST['job_status'] !='')




$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';



$salary_sql = 'select p.PBI_ID, p.PBI_NAME,p.PBI_CODE,p.PBI_DOJ,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation
from personnel_basic_info p where 1 '.$tr_con.' order by p.PBI_DOJ ';




$s_query = mysql_query($salary_sql);




while($tf = mysql_fetch_object($s_query)){




$final_sql = 'select sum(total_payable) as total_amt from salary_attendence_lock where year="'.$_POST['year'].'" and PBI_ID="'.$tf->PBI_ID.'"
 order by total_payable desc';

$final_query = mysql_query($final_sql);
while($final = mysql_fetch_object($final_query)){


if($final->total_amt>0){


?>
    <tr>
      <td><?=++$j;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td width="6%"><?=date('d-M-Y',strtotime($tf->PBI_DOJ))?></td>
      <?php /*?><td><?=$tf->ESSENTIAL_TIN_NO?></td><?php */?>
      <?php /*?><td><?=$tf->project?></td><?php */?>
      <td align="right"><?=(number_format($jan =find_a_field('salary_attendence_lock','total_payable','PBI_ID="'.$tf->PBI_ID.'" and
       mon=1 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($jan,0) : '';?></td>

      <td align="right"><?=(number_format($feb =find_a_field('salary_attendence_lock','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=2 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($feb,0) : '';?></td>

      <td align="right"><?=(number_format($march =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=3 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($march,0) : '';?></td>
      <td align="right"><?=(number_format($april =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=4 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($april,0) : '';?></td>
      <td align="right"><?=(number_format($may =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=5 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($may,0) : '';?></td>
      <td align="right"><?=(number_format($june =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=6 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($june,0) : '';?></td>
      <td align="right"><?=(number_format($july =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=7 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($july,0) : '';?></td>
      <td align="right"><?=(number_format($august =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=8 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($august,0) : '';?></td>
      <td align="right"><?=(number_format($sept =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=9 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($sept,0) : '';?></td>
      <td align="right"><?=(number_format($oct =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=10 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($oct,0) : '';?></td>
      <td align="right"><?=(number_format($nov =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=11 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($nov,0) : '';?></td>
      <td align="right"><?=(number_format($dec =find_a_field('salary_attendence','total_payable','PBI_ID="'.$tf->PBI_ID.'" and mon=12 and year="'.$_POST['year'].'" and remarks_details!="hold"'),0)>0)? number_format($dec,0) : '';?></td>
      <td align="right"><?=(number_format($eid_ul_adha =find_a_field('salary_bonus','bonus_amt', 'bonus_type=1 and PBI_ID="'.$tf->PBI_ID.'"  and year="'.$_POST['year'].'"'),0)>0)? number_format($eid_ul_adha,0) : '';?></td>
      <td align="right"><?=(number_format($eid_ul_fitre =find_a_field('salary_bonus','bonus_amt', 'bonus_type=2 and PBI_ID="'.$tf->PBI_ID.'"  and year="'.$_POST['year'].'"'),0)>0)? number_format($eid_ul_fitre,0) : '';?></td>
      <td align="right"><?=number_format($tot = $jan+$feb+$march+$april+$may+$june+$july+$august+$sept+$oct+$nov+$dec+$eid_ul_adha+$eid_ul_fitre,0)?></td>
    </tr>
    <?
$jan_total = $jan_total+$jan;
$feb_total = $feb_total+$feb;
$march_total = $march_total+$march;
$april_total = $april_total+$april;
$may_total = $may_total+$may;































































		 $june_total = $june_total+$june;































































		 $july_total = $july_total+$july;































































		 $august_total = $august_total+$august;































































		 $sept_total = $sept_total+$sept;































































		 $oct_total = $oct_total+$oct;































































		 $nov_total = $nov_total+$nov;































































		 $dec_total = $dec_total+$dec;































































		 $eid_ul_fitre_total = $eid_ul_fitre_total+$eid_ul_fitre;































































		 $eid_ul_adha_total = $eid_ul_adha_total+$eid_ul_adha;































































       $grand_total = $grand_total+$tot;































































          }















































		  }































































          }















































































































		 ?>
    <tr>
      <td colspan="5" align="right"><strong>Total</strong></td>
      <td><strong>
        <?=number_format($jan_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($feb_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($march_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($april_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($may_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($june_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($july_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($august_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($sept_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($oct_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($nov_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($dec_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_adha_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($eid_ul_fitre_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($grand_total,0);?>
        </strong></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<br>
<?















































	}































































if($_POST['report']==4763){































































	 $report="Advance Salary Report";















































































































	?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="28"><?=$str?></td>
    </tr>
    <tr>
      <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Advance Salary Report of
          <?=$_POST['year']?>
        </div></td>
    </tr>
    <tr>
      <th rowspan="2"><div align="center">SL</div></th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">January<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">February<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">March<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">April<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">May<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">June<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">July<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">August<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">September<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">October<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">November<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">December<br>
          <?=$_POST['year']?>
        </div></th>
      <th rowspan="2"><div align="center">Total</div></th>
    </tr>
  </thead>
  <tbody>
    <?































if($_POST['department'] !='')















































$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';































































if($_POST['JOB_LOCATION'] !='')















































$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';















































if($_POST['job_status'] !='')















































$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';































































$salary_sql = 'select p.PBI_ID,p.PBI_CODE, p.PBI_NAME,p.PBI_DOJ,(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation from personnel_basic_info p
where 1 '.$tr_con.' order by p.PBI_DOJ ';































$s_query = mysql_query($salary_sql);































































while($tf = mysql_fetch_object($s_query)){















































$final_sql = 'select advance_amt as total_amt from salary_advance where current_year="'.$_POST['year'].'" and PBI_ID="'.$tf->PBI_ID.'" group  by PBI_ID desc';































































$final_query = mysql_query($final_sql);































































while($final = mysql_fetch_object($final_query)){































































if($final->total_amt>0){































































?>
    <tr>
      <td><?=++$j;?></td>
      <td><?=$tf->PBI_CODE?></td>
      <td><?=$tf->PBI_NAME?></td>
      <td><?=$tf->designation?></td>
      <td width="6%"><?=date('d-M-Y',strtotime($tf->PBI_DOJ))?></td>
      <?php /*?><td><?=$tf->ESSENTIAL_TIN_NO?></td><?php */?>
      <?php /*?><td><?=$tf->project?></td><?php */?>
      <td align="right"><?=(number_format($jan =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=1 and current_year="'.$_POST['year'].'"'),0)>0)? number_format($jan,0) : '';?></td>
      <td align="right"><?=(number_format($feb =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=2 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($feb,0) : '';?></td>
      <td align="right"><?=(number_format($march =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=3 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($march,0) : '';?></td>
      <td align="right"><?=(number_format($april =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=4 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($april,0) : '';?></td>
      <td align="right"><?=(number_format($may =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=5 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($may,0) : '';?></td>
      <td align="right"><?=(number_format($june =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=6 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($june,0) : '';?></td>
      <td align="right"><?=(number_format($july =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=7 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($july,0) : '';?></td>
      <td align="right"><?=(number_format($august =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=8 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($august,0) : '';?></td>
      <td align="right"><?=(number_format($sept =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=9 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($sept,0) : '';?></td>
      <td align="right"><?=(number_format($oct =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=10 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($oct,0) : '';?></td>
      <td align="right"><?=(number_format($nov =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=11 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($nov,0) : '';?></td>
      <td align="right"><?=(number_format($dec =find_a_field('salary_advance','payable_amt','PBI_ID="'.$tf->PBI_ID.'" and current_mon=12 and current_year="'.$_POST['year'].'" '),0)>0)? number_format($dec,0) : '';?></td>
      <td align="right"><?=number_format($tot = $jan+$feb+$march+$april+$may+$june+$july+$august+$sept+$oct+$nov+$dec,0)?></td>
    </tr>
    <?































































		 $jan_total = $jan_total+$jan;































































		 $feb_total = $feb_total+$feb;































































		 $march_total = $march_total+$march;































































		 $april_total = $april_total+$april;































































		 $may_total = $may_total+$may;































































		 $june_total = $june_total+$june;































































		 $july_total = $july_total+$july;































































		 $august_total = $august_total+$august;































































		 $sept_total = $sept_total+$sept;































































		 $oct_total = $oct_total+$oct;































































		 $nov_total = $nov_total+$nov;































































		 $dec_total = $dec_total+$dec;































































































       $grand_total = $grand_total+$tot;































































          }















































		  }































































          }















































































































		 ?>
    <tr>
      <td colspan="5" align="right"><strong>Total</strong></td>
      <td><strong>
        <?=number_format($jan_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($feb_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($march_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($april_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($may_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($june_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($july_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($august_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($sept_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($oct_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($nov_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($dec_total,0);?>
        </strong></td>
      <td><strong>
        <?=number_format($grand_total,0);?>
        </strong></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<br>
<?















































	}































































if($_POST['report']==144441){































































	 $report="Salary Comparison Report";















































	 $year = $_POST['year'];































































	?>
<table style="width: auto; margin: 0 auto; font-size:15px;text-align:center;" border="0" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px;" colspan="28"><?=$str?></td>
  </tr>
  <tr>
    <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;"></div></td>
  </tr>
</table>
<table width="100%" cellspacing="0" cellpadding="2" border="1">
  <thead>
    <tr align="center">
      <td><strong>January</strong></td>
      <td><strong>February</strong></td>
      <td><strong>Difference</strong></td>
      <td><strong>March</strong></td>
      <td><strong>April</strong></td>
      <td><strong>Difference</strong></td>
      <td><strong>May</strong></td>
      <td><strong>June</strong></td>
      <td><strong>Difference</strong></td>
      <td><strong>July</strong></td>
      <td><strong>August</strong></td>
      <td><strong>Difference</strong></td>
      <td><strong>September</strong></td>
      <td><strong>October</strong></td>
      <td><strong>Difference</strong></td>
      <td><strong>November</strong></td>
      <td><strong>December</strong></td>
      <td><strong>Difference</strong></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="right"><?=$jan = find_a_field('salary_attendence','sum(total_payable)','mon=1 and year="'.$year.'"');?></td>
      <td align="right"><?=$feb = find_a_field('salary_attendence','sum(total_payable)','mon=2 and year="'.$year.'"');?></td>
      <td align="right"><?=$jan-$feb?></td>
      <td align="right"><?=$mar = find_a_field('salary_attendence','sum(total_payable)','mon=3 and year="'.$year.'"');?></td>
      <td align="right"><?=$apr = find_a_field('salary_attendence','sum(total_payable)','mon=4 and year="'.$year.'"');?></td>
      <td align="right"><?=$mar-$apr?></td>
      <td align="right"><?=$may = find_a_field('salary_attendence','sum(total_payable)','mon=5 and year="'.$year.'"');?></td>
      <td align="right"><?=$jun = find_a_field('salary_attendence','sum(total_payable)','mon=6 and year="'.$year.'"');?></td>
      <td align="right"><?=$may-$jun?></td>
      <td align="right"><?=$jul = find_a_field('salary_attendence','sum(total_payable)','mon=7 and year="'.$year.'"');?></td>
      <td align="right"><?=$aug = find_a_field('salary_attendence','sum(total_payable)','mon=8 and year="'.$year.'"');?></td>
      <td align="right"><?=$jul-$aug?></td>
      <td align="right"><?=$sept = find_a_field('salary_attendence','sum(total_payable)','mon=9 and year="'.$year.'"');?></td>
      <td align="right"><?=$oct = find_a_field('salary_attendence','sum(total_payable)','mon=10 and year="'.$year.'"');?></td>
      <td align="right"><?=$sept-$oct?></td>
      <td align="right"><?=$nov = find_a_field('salary_attendence','sum(total_payable)','mon=11 and year="'.$year.'"');?></td>
      <td align="right"><?=$dec = find_a_field('salary_attendence','sum(total_payable)','mon=12 and year="'.$year.'"');?></td>
      <td align="right"><?=$nov-$dec?></td>
    </tr>
  </tbody>
</table>
<?















































	}































































if($_POST['report']==323){
$report="Probationary Period Report";
?>
<tr>
  <td style="border:0px;" colspan="28"><?=$str?></td>
</tr>
<tr>
  <td style="border:0px;" colspan="28"><div align="center" style="font-size:20px;">Probationary Period Report of
      <?=$_POST['year']?>
    </div></td>
</tr>
<table style="width: auto; margin: 0 auto; font-size:15px;text-align:center;" border="0" bordercolor="#FFFFFF"></table>
<table style="width:auto;margin:0 auto; text-align:center; background-color:#9ed5cd;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr style="background-color:#525252; color:#5ebcd2">
      <td><strong>Sl</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>NAME</strong></td>
      <td><strong>designation</strong></td>
      <td><strong>DEPARTMENT</strong></td>
      <td><strong>PROJECT</strong></td>
      <td><strong>Joining Date</strong></td>
      <td><strong>MOBILE</strong></td>
    </tr>
  </thead>
  <?
$basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE,a.PBI_DOJ,a.pass,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,a.PBI_GROUP as `Group`, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,a.PBI_MOBILE as mobile  from personnel_basic_info a, essential_info e where a.PBI_ID=e.PBI_ID ".$con." order by a.PBI_DOJ asc";

$basic_query = mysql_query($basic_sql);
$sl = 1;
$entry_by=$data->entry_by;
$year = date('Y');
while($r = mysql_fetch_object($basic_query)){
?>
  <?















































		       $date_dfrnc = date_diff(date_create(date('Y-m-d')), date_create($r->PBI_DOJ));















































                  $total_job_days = $date_dfrnc->format('%a');















































				 if($total_job_days<180){















































		 ?>
  <tr>
    <td style="background-color:#525252; color:#5ebcd2"><?=$sl++;?></td>
    <td style="background-color:#525252; color:#5ebcd2"><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td><?=$r->department?></td>
    <td><?=$r->project_name?></td>
    <td style="background-color:#525252; color:#5ebcd2"><? $interval = date_diff(date_create(date('Y-m-d')), date_create($r->joining_date));































































 	echo $interval->format("%Y Year, %M Months, %d Days");































































	?></td>
    <td><?=$r->mobile?></td>
  </tr>
  <?































































		 }















































}






























 ?>
</table>
<br>
<br>
<br>




<?

}

if($_POST['report']==1){
$report="Employee Basic Information";
?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;font-family:bankgothic; font-size:20px"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Employee Basic Information</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>EMP ID</strong></td>

      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
      <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>PROJECT</strong></td>
			<td align="center"><strong>TERRITORY</strong></td>
      <td align="center"><strong>JOINING DATE</strong></td>
      <td align="center"><strong>TOTAL SERVICE LENGTH</strong></td>
      <td align="center"><strong>MOBILE</strong></td>
      <td align="center"><strong>MOBILE LIMIT</strong></td>
      <td align="center"><strong>EMAIL</strong></td>
      <td align="center"><strong>REPORTING AUTH</strong></td>
    </tr>
  </thead>
  <?
$basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE as PBI_CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,
e.ESSENTIAL_REPORTING as reporting,
(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC
from project where PROJECT_ID=a.JOB_LOCATION) as project_name, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,
a.PBI_MOBILE as mobile,a.PBI_EMAIL,e.ESSENTIAL_RESIG_DATE,a.PBI_JOB_STATUS,e.territory as territory_emp  from personnel_basic_info a,essential_info e where a.PBI_ID=e.PBI_ID ".$con." group by a.PBI_ID order by a.PBI_DOJ asc";

$basic_query = mysql_query($basic_sql);


$sl = 1;
while($r = mysql_fetch_object($basic_query)){

?>
  <tr>
    <td><?=$sl++;?></td>

		<td align="center"><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project_name?></td>
		<td align="center"><?=$r->territory_emp?></td>
    <td align="center"><?=$r->joining_date?></td>
    <td align="center">


			<?

		$interval = date_diff(date_create(date('Y-m-d')), date_create($r->joining_date));
    $past_interval = date_diff(date_create($r->ESSENTIAL_RESIG_DATE), date_create($r->joining_date));

		if($r->ESSENTIAL_RESIG_DATE>0){
			echo $past_interval->format("%Y Y, %M M, %d D");
		}else{
    echo $interval->format("%Y Y, %M M, %d D");
	}


		?>

		</td>
    <td align="center"><?=$r->mobile?></td>
     <td align="center"><?=find_a_field('salary_info','mobile_allowance','PBI_ID="'.$r->Emp_ID.'"'); ?></td>
    <td align="center"><?=$r->PBI_EMAIL?></td>

    <td align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID="'.$r->reporting.'"'); ?></td>
  </tr>
<?

}
?>


</table>


<!-- New Report tax information -->




<?

}

if($_POST['report']==155){
$report="Employee Basic Information";
?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;font-family:bankgothic; font-size:20px"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Employee NID Information</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>ID</strong></td>

      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
      <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>PROJECT</strong></td>
			<td align="center"><strong>TERRITORY</strong></td>
      <td align="center"><strong>JOINING DATE</strong></td>
      <td align="center"><strong>TOTAL SERVICE LENGTH</strong></td>
      <td align="center"><strong>MOBILE</strong></td>
      <td align="center"><strong>MOBILE LIMIT</strong></td>
      <td align="center"><strong>EMAIL</strong></td>
      <td align="center"><strong>REPORTING AUTH</strong></td>
      <td align="center"><strong>NID NO</strong></td>
      <td align="center"><strong>NID IMAGE</strong></td>
    </tr>
  </thead>
  <?
$basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE as PBI_CODE,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,a.ESSENTIAL_VOTER_ID,
e.ESSENTIAL_REPORTING as reporting,
(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC
from project where PROJECT_ID=a.JOB_LOCATION) as project_name, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,
a.PBI_MOBILE as mobile,a.PBI_EMAIL,e.ESSENTIAL_RESIG_DATE,a.PBI_JOB_STATUS,e.territory as territory_emp  
from personnel_basic_info a,essential_info e where a.PBI_ID=e.PBI_ID ".$con." group by a.PBI_ID order by a.PBI_DOJ asc";

$basic_query = mysql_query($basic_sql);


$sl = 1;
while($r = mysql_fetch_object($basic_query)){

?>
  <tr>
    <td><?=$sl++;?></td>

		<td align="center"><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project_name?></td>
		<td align="center"><?=$r->territory_emp?></td>
    <td align="center"><?=$r->joining_date?></td>
    <td align="center">


			<?

		$interval = date_diff(date_create(date('Y-m-d')), date_create($r->joining_date));
    $past_interval = date_diff(date_create($r->ESSENTIAL_RESIG_DATE), date_create($r->joining_date));

		if($r->ESSENTIAL_RESIG_DATE>0){
			echo $past_interval->format("%Y Y, %M M, %d D");
		}else{
    echo $interval->format("%Y Y, %M M, %d D");
	}


		?>

		</td>
    <td align="center"><?=$r->mobile?></td>
     <td align="center"><?=find_a_field('salary_info','mobile_allowance','PBI_ID="'.$r->Emp_ID.'"'); ?></td>
    <td align="center"><?=$r->PBI_EMAIL?></td>

    <td align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID="'.$r->reporting.'"'); ?></td>

    <td align="center"><?=$r->ESSENTIAL_VOTER_ID;?></td>


		                  <?

				

			    	          //$directory = "../../pic/staff/".$r->Emp_ID.".jpeg";
							  
							

				       //Employee Pic

								$imgJPG = "../../pic/nid/".$r->Emp_ID.".JPG";

								$imgjpg = "../../pic/nid/".$r->Emp_ID.".jpg";

								$imgPNG = "../../pic/nid/".$r->Emp_ID.".PNG";

								$imgJPEG = "../../pic/nid/".$r->Emp_ID.".jpeg";

								$imgpng2 = "../../pic/nid/".$r->Emp_ID.".png";

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

								}else $link = '';

				 

				 

				

			if(file_exists($link)) {?>

<td>

<a href="<?=$link?>" target="_blank">
  <img src="<?=$link?>" width="60" height="60"/>
</a>

</td>

				<? }else{?>
				
<td><img src="../../pic/staff/default.png" width="60" height="60"/></td>

				<? } ?>
    
  </tr>
<?

}
?>


</table>


<!-- New Report tax information -->


<br>
<br>
<?

}

if($_POST['report']==133332){
$report="Employee Basic Information";
?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;font-family:bankgothic; font-size:20px"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>TAX Information Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>ID</strong></td>
      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
			<td align="center"><strong>JOINING DATE</strong></td>
			<td align="center"><strong>TIN No</strong></td>
			<td align="center"><strong>Tax Circle & Tax Zone</strong></td>
			<td align="center"><strong>Basic Salary</strong></td>

			<td align="center"><strong>Mobile No</strong></td>
			<td align="center"><strong>Email</strong></td>

			<td align="center"><strong>Bank Account No</strong></td>

      <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>JOB LOCATION/PROJECT</strong></td>
			<td align="center"><strong>TIN Image</strong></td>


    </tr>
  </thead>
  <?
/*$basic_sql="select a.PBI_ID as Emp_ID,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,
e.ESSENTIAL_REPORTING as reporting,
(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC
from project where PROJECT_ID=a.JOB_LOCATION) as project_name, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,
a.PBI_MOBILE as mobile,a.PBI_EMAIL,e.ESSENTIAL_RESIG_DATE,a.PBI_JOB_STATUS,e.territory as territory_emp
from personnel_basic_info a,essential_info e where a.PBI_ID=e.PBI_ID ".$con." group by a.PBI_ID order by a.PBI_DOJ asc"; */


if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';


if($_POST['JOB_LOCATION'] !='')
$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

if($_POST['job_status'] !='')
$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$basic_sql= 'select p.ESSENTIAL_TIN_NO, DATE_FORMAT(p.PBI_DOJ,"%d-%b-%Y") as joining_date,i.cash,p.tax_zone,
CONCAT(p.tax_circle,", ",p.tax_zone) as tax_info,
 p.PBI_ID,p.PBI_CODE,p.PBI_NAME,i.basic_salary,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,
(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,p.PBI_EMAIL_ALT,p.PBI_MOBILE_ALTR
from personnel_basic_info p, salary_info i
where p.PBI_ID=i.PBI_ID   '.$tr_con.' order by i.income_tax desc ' ;


$basic_query = mysql_query($basic_sql);


$sl = 1;
while($r = mysql_fetch_object($basic_query)){

?>
  <tr>
    <td><?=$sl++;?></td>
    <td align="center"><?=$r->PBI_CODE?></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=$r->designation?></td>
		<td align="center"><?=$r->joining_date?></td>
		<td align="center"><?=$r->ESSENTIAL_TIN_NO?></td>
		<td align="center"><? if($r->tax_zone!="") {echo $r->tax_info;}?></td>
		<td align="center"><?=$r->basic_salary?></td>

		<td align="center"><?=$r->PBI_MOBILE_ALTR?></td>
		<td align="center"><?=$r->PBI_EMAIL_ALT?></td>

		<td align="center"><?=$r->cash?></td>

    <td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project?></td>


    <td align="center">
     <? if($r->ESSENTIAL_TIN_NO>0){?>
			<a href="../../pic/tin/<?=$r->PBI_ID?>.jpg" target="_blank"> <img src="../../pic/tin/<?=$r->PBI_ID?>.jpg"  width="20" height="20"> </a>
		<? } ?>
		</td>


  </tr>
<?

}
?>


</table>

</br>
</br>


<!--End tax information  -->






<!-- New Report tax information -->


<br>
<br>
<?

}

if($_POST['report']==177332){
$report="Employee Basic Information";
?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;font-family:bankgothic; font-size:20px"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>TDS Challan Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>ID</strong></td>
      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
	  <td align="center"><strong>JOINING DATE</strong></td>
	  <td align="center"><strong>TIN No</strong></td>
	  <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>JOB LOCATION/PROJECT</strong></td>
      <td align="center"><strong>Tax Challan No</strong></td>
      <td align="center"><strong>Tax Challan Date</strong></td>
      <td align="center"><strong>TAX Year</strong></td>
	  <td align="center"><strong>Assesment Year</strong></td>
	  <td align="center"><strong>Challan Amount</strong></td>


    </tr>
  </thead>
  <?

if($_POST['department'] !='')
$tr_con = ' and p.PBI_DEPARTMENT="'.$_POST['department'].'"';


if($_POST['JOB_LOCATION'] !='')
$tr_con .= ' and p.JOB_LOCATION="'.$_POST['JOB_LOCATION'].'"';

if($_POST['job_status'] !='')
$tr_con .= ' and p.PBI_JOB_STATUS="'.$_POST['job_status'].'"';



$fiscal_year = explode("-",$_POST['financial_year']);
$year_1 = $fiscal_year[0]-1;
$year_2 = $fiscal_year[1]-1;
$f_date = $year_1.'-07-01';
$t_date = $year_2.'-06-30';

//Assesment Year
$assesment_start_year = $fiscal_year[0];
$assesment_end_year = $fiscal_year[1];


$basic_sql= 'select p.ESSENTIAL_TIN_NO, DATE_FORMAT(p.PBI_DOJ,"%d-%b-%Y") as joining_date,i.cash,p.tax_zone,
CONCAT(p.tax_circle,", ",p.tax_zone) as tax_info,
 p.PBI_ID,p.PBI_CODE,p.PBI_NAME,i.basic_salary,(select DEPT_DESC from department where DEPT_ID=p.PBI_DEPARTMENT) as department,
(select DESG_DESC from designation where DESG_ID=p.PBI_DESIGNATION) as designation,
(select PROJECT_DESC from project where PROJECT_ID=p.JOB_LOCATION) as project,t.tax_chalan_no,t.assesment_s_year,
t.assesment_e_year,t.chalan_amt,t.s_mon,t.e_mon,t.s_year,t.e_year,t.chalan_start_date


from personnel_basic_info p, salary_info i,emp_taxchalan_no t
where p.PBI_ID=i.PBI_ID  and p.PBI_ID=t.PBI_ID and t.assesment_s_year='.$assesment_start_year.' and  t.assesment_e_year='.$assesment_end_year.'

  '.$tr_con.' order by t.PBI_ID,t.chalan_start_date' ;


$basic_query = mysql_query($basic_sql);


$sl = 1;
while($r = mysql_fetch_object($basic_query)){

?>
  <tr>
    <td><?=$sl++;?></td>
    <td align="center"><?=$r->PBI_CODE?></td>
    <td><?=$r->PBI_NAME?></td>
    <td><?=$r->designation?></td>
    <td align="center"><?=$r->joining_date?></td>
	<td align="center"><?=$r->ESSENTIAL_TIN_NO?></td>
	<td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project?></td>
    <td align="center"><?=$r->tax_chalan_no;?></td>
		

		
    <td align="center"><? echo date('d-M-Y',strtotime($r->chalan_start_date))?></td>
	<td align="center"><?=$r->s_year?>-<?=$r->e_year?></td>
	<td align="center"><?=$r->assesment_s_year?>-<?=$r->assesment_e_year?></td>
	<td align="center"><?=$r->chalan_amt;  $tot_amount +=$r->chalan_amt;?></td>





  </tr>


     

<?

}
?>



     <tr>
      <td colspan="12" align="right"><strong>Total</strong></td>
      <td align="right"><strong><?=number_format($tot_amount);?></strong></td>
   
    </tr>


</table>

</br>
</br>


<!--End tax information  -->



<?

}

if($_POST['report']==202){
$report="Employee Salary Information";
?>


<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;font-family:bankgothic; font-size:20px"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;">Employee Salary Information</td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>Sl</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>NAME</strong></td>
      <td><strong>DESIGNATION</strong></td>
      <td><strong>DEPARTMENT</strong></td>
      <td><strong>PROJECT</strong></td>
      <td><strong>JOINING DATE</strong></td>
      <td><strong>TOTAL SERVICE LENGTH</strong></td>
      <td><strong>Gross Salary</strong></td>
      <td><strong>Basic Salary</strong></td>
      <td><strong>House Rent</strong></td>
			<td><strong>Medical Allowance</strong></td>
			<td><strong>Conveyance</strong></td>
			<td><strong>Tax</strong></td>
			<td><strong>TIN No</strong></td>

			<td><strong>Payroll Card No</strong></td>
			<td><strong>Bank Account No</strong></td>

			<td><strong>Bkash No</strong></td>
			<td><strong>Nagad No</strong></td>
    </tr>
  </thead>
  <?

  if ($_POST['cash_bank'] !='')
  $cashbank .= ' and b.cash_bank='.$_POST['cash_bank'];


 $basic_sql="select a.PBI_ID,a.PBI_CODE as Emp_ID,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,a.ESSENTIAL_TIN_NO as tin_no,
e.ESSENTIAL_REPORTING as reporting,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC
from project where PROJECT_ID=a.JOB_LOCATION) as project_name, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,
a.PBI_MOBILE as mobile,a.PBI_EMAIL,e.ESSENTIAL_RESIG_DATE,a.PBI_JOB_STATUS,
b.gross_salary, b.basic_salary, b.house_rent, b.medical_allowance, b.special_allowance as conveyance, b.food_allowance,
b.transport_allowance,b.card_no as payroll_card_no,b.cash as Bank_account_no,b.income_tax,b.bkash_no,b.nagad_no

from personnel_basic_info a,essential_info e,salary_info b

where a.PBI_ID=b.PBI_ID and a.PBI_ID=e.PBI_ID ".$con.$cashbank." group by a.PBI_ID order by a.PBI_DOJ asc";

$basic_query = mysql_query($basic_sql);


$sl = 1;
while($r = mysql_fetch_object($basic_query)){

?>
  <tr>
    <td><?=$sl++;?></td>
    <td><?=$r->Emp_ID?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td align="center"><?=$r->department?></td>
    <td><?=$r->project_name?></td>
    <td><?=$r->joining_date?></td>



    <td align="center"><?

		$interval = date_diff(date_create(date('Y-m-d')), date_create($r->joining_date));
    $past_interval = date_diff(date_create($r->ESSENTIAL_RESIG_DATE), date_create($r->joining_date));

		if($r->ESSENTIAL_RESIG_DATE>0){
			echo $past_interval->format("%Y Y, %M M, %d D");
		}else{
    echo $interval->format("%Y Y, %M M, %d D");
	}


		?></td>


		<td align="right"><?=$r->gross_salary;      $tot_gross +=$r->gross_salary;?></td>
    <td align="right"><?=$r->basic_salary;      $tot_basic +=$r->basic_salary;?></td>
    <td align="right"><?=$r->house_rent;        $tot_house +=$r->house_rent;?></td>
    <td align="right"><?=$r->medical_allowance; $tot_medical+=$r->medical_allowance;?></td>
    <td align="right"><?=$r->conveyance;        $tot_conveyance+=$r->conveyance;?></td>
		<td align="right"><?=$r->income_tax;        $tot_income_tax +=$r->income_tax;?></td>
    <td align="right"><?=$r->tin_no;?></td>

    <td><?=$r->payroll_card_no?></td>
    <td><?=$r->Bank_account_no?></td>

		<td><?=$r->bkash_no?></td>
    <td><?=$r->nagad_no?></td>
  </tr>
<?

}
?>


<tr>
	<td colspan="8" align="right">Total:</td>

	<td align="right"><strong><?=number_format($tot_gross,0)?></strong></td>
	<td align="right"><strong><?=number_format($tot_basic,0)?></strong></td>
	<td align="right"><strong><?=number_format($tot_house,0)?></strong></td>
	<td align="right"><strong><?=number_format($tot_medical,0)?></strong></td>
	<td align="right"><strong><?=number_format($tot_conveyance,0)?></strong></td>
	<td align="right"><strong><?=number_format($tot_income_tax,0)?></strong></td>


	<td colspan="5"></td>
</tr>


</table>





<?
  }
  if($_POST['report']==2454){
  $report="Employee Birthday Report";

?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Employee Birthday Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>Sl</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>NAME</strong></td>
      <td><strong>DESIGNATION</strong></td>
      <td><strong>DEPARTMENT</strong></td>
      <td><strong>PROJECT</strong></td>
      <td><strong>JOINING DATE</strong></td>
      <td><strong>BIRTH DATE</strong></td>
      <td><strong>MOBILE</strong></td>
    </tr>
  </thead>
  <?

$to_d = date('Y-m-d');
 $basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE,  a.PBI_REAL_BIRTH + INTERVAL (YEAR(CURRENT_DATE) - YEAR(a.PBI_REAL_BIRTH))     YEAR AS currbirthday,
a.PBI_REAL_BIRTH + INTERVAL (YEAR(CURRENT_DATE) - YEAR(a.PBI_REAL_BIRTH)) + 1 YEAR AS nextbirthday   ,DATE_FORMAT(a.PBI_REAL_BIRTH,'%d-%b-%Y') as birth_date,a.PBI_NAME as Name,
(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,
(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,a.PBI_GROUP as `Group`, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,a.PBI_MOBILE as mobile  from personnel_basic_info a where 1 and a.PBI_ID not in (8,9,10,11,20,23,25,31) ".$con." ORDER BY CASE
WHEN currbirthday >= CURRENT_DATE THEN currbirthday
ELSE nextbirthday END";


   $basic_query = mysql_query($basic_sql);
   $sl = 1;


   while($r = mysql_fetch_object($basic_query)){

   ?>
  <tr>
    <td><?=$sl++;?></td>
    <td><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?=$r->designation?></td>
    <td><?=$r->department?></td>
    <td><?=$r->project_name?></td>
    <td><?=$r->joining_date?></td>
    <td><?=$r->birth_date?></td>
    <td><?=$r->mobile?></td>
  </tr>
  <?





 }






 ?>
</table>








<?
  }
  if($_POST['report']==2456){
  $report="Employee Blood Group Report";

?>
<table style="width: auto; margin: 0 auto; text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
  <td style="border:0px solid white; font-size: 25px; font-family: bankgothic;">AKSID CORPORATION LIMITED</td>
  </tr>
  <tr>
    <td style="border:0px solid white; font-size: 17px; "><strong>Employee Blood Group Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>EMP ID</strong></td>
      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
      <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>PROJECT</strong></td>
	  <td align="center"><strong>JOINING DATE</strong></td>
      <td align="center"><strong>Blood Group</strong></td>

      <td align="center"><strong>MOBILE</strong></td>
	  <td align="center"><strong>Emergency Contact</strong></td>
    </tr>
  </thead>
  <?

$to_d = date('Y-m-d');
 $basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE,
a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC)
from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,a.PBI_GROUP as `Group`,
 DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,a.PBI_MOBILE as mobile,a.ESSENTIAL_BLOOD_GROUP,DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.EMR_MOBILE

from personnel_basic_info a where a.PBI_JOB_STATUS='In Service' and a.PBI_ID not in (8,9,10,11,20,23,25,31,35,41,42,47,53,54,55,59,60) ".$con." ORDER BY a.PBI_ID";


   $basic_query = mysql_query($basic_sql);
   $sl = 1;


   while($r = mysql_fetch_object($basic_query)){

   ?>
  <tr>
    <td><?=$sl++;?></td>
    <td align="center"><?=$r->PBI_CODE?></td>
    <td align="center"><?=$r->Name?></td>
    <td align="center"><?=$r->designation?></td>
    <td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project_name?></td>
	<td align="center"><?=$r->joining_date?></td>
    <td align="center"><?=$r->ESSENTIAL_BLOOD_GROUP?></td>
    <td align="center"><?=$r->mobile?></td>
	<td align="center"><?=$r->EMR_MOBILE?></td>
  </tr>
  <?





 }






 ?>
</table>
<br/><br/>









<?
  }
  if($_POST['report']==2457){
  $report="Employee Blood Group Report";

?>
<table style="width: auto; margin: 0 auto; text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
  <td style="border:0px solid white; font-size: 25px; font-family: bankgothic;">AKSID CORPORATION LIMITED</td>
  </tr>
  <tr>
    <td style="border:0px solid white; font-size: 17px; "><strong>Probation Extension Report</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td align="center"><strong>Sl</strong></td>
      <td align="center"><strong>EMP ID</strong></td>
      <td align="center"><strong>NAME</strong></td>
      <td align="center"><strong>DESIGNATION</strong></td>
      <td align="center"><strong>DEPARTMENT</strong></td>
      <td align="center"><strong>PROJECT</strong></td>
	  <td align="center"><strong>JOINING DATE</strong></td>
      <td align="center"><strong>Extension Date</strong></td>
			<td align="center"><strong>Reporting Authority</strong></td>

      <td align="center"><strong>MOBILE</strong></td>

    </tr>
  </thead>
  <?

$to_d = date('Y-m-d');
 $basic_sql="select b.PBI_ID as Emp_ID,a.PBI_CODE,
a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC)
from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,a.PBI_DOJ as total_service_length,
a.PBI_MOBILE as mobile,DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.EMR_MOBILE,a.PBI_MOBILE as mobile,DATE_FORMAT(b.extension_date,'%d-%b-%Y') as extension_date,b.entry_by

from personnel_basic_info a,performance_appraisal b

where a.PBI_ID=b.PBI_ID and b.EMPLOYMENT_TYPE='Probationary' and a.PBI_JOB_STATUS='In Service' and b.extension_date>0 ".$con."  ORDER BY b.PBI_ID";


   $basic_query = mysql_query($basic_sql);
   $sl = 1;


   while($r = mysql_fetch_object($basic_query)){

   ?>
  <tr>
    <td><?=$sl++;?></td>
    <td align="center"><?=$r->PBI_CODE?></td>
    <td align="center"><?=$r->Name?></td>
    <td align="center"><?=$r->designation?></td>
    <td align="center"><?=$r->department?></td>
    <td align="center"><?=$r->project_name?></td>
	  <td align="center"><?=$r->joining_date?></td>
    <td align="center"><?=$r->extension_date?></td>
		<td align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$r->entry_by);?></td>
    <td align="center"><?=$r->mobile?></td>

  </tr>
  <?





 }






 ?>
</table>
<br/><br/>




<?	 }

 if($_POST['report']==2455){
 $report="Employee Final Settlement";
 ?>


<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><strong>Employee Final Settlement</strong></td>
  </tr>
</table>
<table style="width:auto;margin:0 auto;" cellpadding="0" cellspacing="0" border="1">
  <thead>
    <tr>
      <td><strong>Sl</strong></td>
      <td><strong>EMP ID</strong></td>
      <td><strong>NAME</strong></td>
      <td><strong>A/C Number</strong></td>
      <td><strong>Mobile No</strong></td>
      <td><strong>Reason Of Employment Discontinuation</strong></td>
      <td><strong>Effective Date(Discontinuation Of Employment)</strong></td>
    </tr>
  </thead>
  <?















































    $to_d = date('Y-m-d');




	  $basic_sql="select a.PBI_ID as Emp_ID,a.PBI_CODE,DATE_FORMAT(a.PBI_REAL_BIRTH,'%d-%b-%Y') as birth_date,a.PBI_NAME as Name,

	DATE_FORMAT(e.ESSENTIAL_RESIG_DATE,'%d-%b-%Y') as effective_date,a.PBI_DOJ as total_service_length,a.PBI_MOBILE as mobile,s.cash,s.card_no,s.cash_bank

	from personnel_basic_info a,salary_info s,essential_info e 

	where a.PBI_ID=s.PBI_ID and a.PBI_ID=e.PBI_ID and e.ESSENTIAL_RESIG_DATE>0  and a.PBI_ID not in (8,9,10,11,20,23,25,31) ".$con." GROUP BY e.ESSENTIAL_RESIG_DATE ";































































    $basic_query = mysql_query($basic_sql);































































    $sl = 1;































































































































    while($r = mysql_fetch_object($basic_query)){























      $cash = $r->cash;







      $bank = $r->card_no;







      $status = $r->cash_bank;































































      ?>
  <tr>
    <td><?=$sl++;?></td>
    <td><?=$r->PBI_CODE?></td>
    <td><?=$r->Name?></td>
    <td><?















       if($status=='4'){







           echo $cash;























       }elseif($status=='3'){















        echo $bank;















       }else{







        echo $cash;







       }







































           ?></td>
    <td><?=$r->mobile?></td>
    <td></td>
    <td><?=$r->effective_date?></td>
  </tr>
  <?































































      }































































































































      ?>
</table>
</br>
<?























































	}















  if($_POST['report']==132){















































$monthNum  = $_POST['mon'];































$dateObj   = DateTime::createFromFormat('!m', $monthNum);































$monthName = $dateObj->format('F');















































	?>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr>
    <td style="border:0px solid white; font-family: bankgothic;">AKSID CORPORATION LTD</td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><span style="font-size: 14px;">Monthly Employee Report</span></td>
  </tr>
  <tr>
    <td style="border:0px solid white;"><div style="margin-left: 80px;">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?=$monthName?>
          -
          <?=$_POST['year']?>
        </p>
      </div></td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <p>&nbsp;</p>
    <td style="border:0px solid white;">Monthly Joining New Employee Status</td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2" align="center"><div align="center">Designation</div></th>
      <th colspan="2" style=""><div align="center">Salary</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Project/Job Location</div></th>
      <th rowspan="2"><div align="center">Mobile No</div></th>
      <th rowspan="2"><div align="center">Email No</div></th>
    </tr>
    <tr class="oe_list_header_columns" style="font-size:10px;padding:3px; border-top:#ccc; ">
      <th style="border:1px solid #000;">Gross</th>
      <th  style="border:1px solid #000;">Food Allowances</th>
    </tr>
  </thead>
  <tbody>
    <?















































      if($_POST['year']!="" && $_POST['mon']!=""){































































	  $join_con = ' and a.PBI_DOJ between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-30"';}































































	  $basic_sql='select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,a.JOB_LOCATION, d.DESG_SHORT_NAME as Designation, e.DEPT_SHORT_NAME as Department,a.PBI_MOBILE as mobile,i.gross_salary,i.food_allowance,















































	 a.PBI_EMAIL as email, a.JOB_LOCATION















































 from designation d, department e, personnel_basic_info a, salary_info i















































 where  a.PBI_DESIGNATION = d.DESG_ID and a.PBI_DEPARTMENT=e.DEPT_ID  '.$join_con.' and i.PBI_ID = a.PBI_ID  group by a.PBI_ID';















































	 $basic_query = mysql_query($basic_sql);















































	 $s2 = 1;















































	 while($r = mysql_fetch_object($basic_query)){















































		 ?>
    <tr>
      <td><?=$s2++;?></td>
      <td><?=$r->PBI_CODE?></td>
      <td align="left"><?=$r->PBI_NAME?></td>
      <td align="left"><?=$r->Designation?></td>
      <td><?=$r->gross_salary?></td>
      <td><?=$r->food_allowance?></td>
      <td><?=date('d-M-Y', strtotime($r->PBI_DOJ))?></td>
      <td><?=$r->Department?></td>
      <td><? echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
      <td><?=$r->mobile?></td>
      <td><?=$r->email?></td>
    </tr>
    <?















































		 }































































		 ?>
</table>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <p>&nbsp;</p>
    <td style="border:0px solid white;">Monthly Separation List</td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2"><div align="center">ID</div></th>
      <th rowspan="2"><div align="center">Name</div></th>
      <th rowspan="2" align="center"><div align="center">Designation</div></th>
      <th colspan="2" style=""><div align="center">Salary</div></th>
      <th rowspan="2"><div align="center">Joining Date</div></th>
      <th rowspan="2"><div align="center">Releiving Date</div></th>
      <th rowspan="2"><div align="center">Job Period</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2"><div align="center">Project/Job Location</div></th>
      <th rowspan="2"><div align="center">Mobile No</div></th>
      <th rowspan="2"><div align="center">Email No</div></th>
    </tr>
    <tr class="oe_list_header_columns" style="font-size:10px;padding:3px; border-top:#ccc; ">
      <th style="border:1px solid #000;">Gross</th>
      <th  style="border:1px solid #000;">Food Allowances</th>
    </tr>
  </thead>
  <tbody>
    <?































































      if($_POST['year']!="" && $_POST['mon']!=""){































































	   $join_con = ' and j.ESSENTIAL_RESIG_DATE between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-31"';}















































	  $basic_sql='select a.PBI_ID, a.PBI_CODE,a.PBI_NAME,j.ESSENTIAL_RESIG_DATE, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ,a.JOB_LOCATION, d.DESG_SHORT_NAME as Designation, e.DEPT_SHORT_NAME as Department,a.PBI_MOBILE as mobile,i.gross_salary,i.food_allowance,































































	 a.PBI_EMAIL as email































 from designation d, department e, personnel_basic_info a, salary_info i,essential_info j















































 where j.PBI_ID=a.PBI_ID and  a.PBI_DESIGNATION = d.DESG_ID and a.PBI_DEPARTMENT=e.DEPT_ID '.$join_con.' and i.PBI_ID = a.PBI_ID ';















































	 $basic_query = mysql_query($basic_sql);































	 $s3 = 1;















































	 while($r = mysql_fetch_object($basic_query)){































       $interval = date_diff(date_create($r->ESSENTIAL_RESIG_DATE), date_create($r->PBI_DOJ));































		$period = $interval->format("%Y Year, %M Months, %d Days");































































		 ?>
    <tr align="center">
      <td><?=$s3++;?></td>
      <td><?=$r->PBI_CODE?></td>
      <td><?=$r->PBI_NAME?></td>
      <td><?=$r->Designation?></td>
      <td><?=$r->gross_salary?></td>
      <td><?=$r->food_allowance?></td>
      <td><?=date('d-M-Y', strtotime($r->PBI_DOJ));?></td>
      <td><?=date('d-M-Y', strtotime($r->ESSENTIAL_RESIG_DATE))?></td>
      <td><?=$period?></td>
      <td><?=$r->Department?></td>
      <td><? echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$r->JOB_LOCATION);?></td>
      <td><?=$r->mobile?></td>
      <td><?=$r->email?></td>
    </tr>
    <?































		 }































































		 ?>
</table>
<table style="width: auto; margin: 0 auto; font-size: 20px;text-align:center;" border="1" bordercolor="#FFFFFF">
  <tr></tr>
  <tr>
    <p>&nbsp;</p>
    <td style="border:0px solid white;">Monthly Employee Requisition</td>
  </tr>
</table>
<table style="width: auto; margin: 0 auto;text-align:center;" cellpadding="0" cellspacing="0" class="oe_list_content">
  <thead>
    <tr class="oe_list_header_columns" style=" text-align:center; font-size:12px;" align="center">
      <th rowspan="2">S/L</th>
      <th rowspan="2">Ref No</th>
      <th rowspan="2"><div align="center">Designation</div></th>
      <th rowspan="2"><div align="center">Department</div></th>
      <th rowspan="2" align="center"><div align="center">Project/Job Location</div></th>
      <th rowspan="2" align="center"><div align="center">Requested By</div></th>
      <th rowspan="2" align="center"><div align="center">Expected Joining Date</div></th>
      <th rowspan="2" align="center"><div align="center">Salary Range</div></th>
      <th rowspan="2">Total Days</th>
    </tr>
  </thead>
  <tbody>
    <?































	     $emp ='SELECT r.*  FROM `employee_requisition` r where EXPECTED_DATE_TO between "'.$_POST['year'].'-'.$_POST['mon'].'-1" and "'.$_POST['year'].'-'.$_POST['mon'].'-30" ' ;































































		 $sqll = mysql_query($emp);















































		 while($em=mysql_fetch_object($sqll)){































































       if($em->JOINING_DATE!='0000-00-00'){































      $interval = date_diff(date_create($em->JOINING_DATE), date_create($em->SUBMISSION_DATE));































      $interval->format("%Y Year, %M Months, %d Days");































      $total_days_gone = $interval->format('%a');































































  }else{































































  	 $interval = date_diff(date_create(date('Y-m-d')), date_create($em->SUBMISSION_DATE));































      $interval->format("%Y Year, %M Months, %d Days");































      $total_days_gone = $interval->format('%a');































  }































































	 ?>
    <tr align="center">
      <td rowspan="4"><?=++$j;?></td>
      <td><?=$em->REF_NO?></td>
      <td><?=find_a_field('designation','DESG_SHORT_NAME','DESG_ID='.$em->DESIGNATION);?></td>
      <td><?=find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$em->DEPARTMENT);?></td>
      <td><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$em->JOB_LOCATION);?></td>
      <td><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$em->REQ_BY);?></td>
      <td><?=date('d-M-Y', strtotime($em->EXPECTED_DATE_TO))?>
        to
        <?=date('d-M-Y', strtotime($em->EXPECTED_DATE_FROM))?></td>
      <td><?=$em->SALARY_TO?>
        to
        <?=$em->SALARY_FROM?></td>
      <td rowspan="4"><?=$total_days_gone?>
        Days</td>
    </tr>
    <tr>
      <td>Requisition</td>
      <td>Management Approval</td>
      <td>Job Posting</td>
      <td>Cv Collection</td>
      <td>Cv Sorting</td>
      <td>Interview Process</td>
      <td>Joining</td>
    </tr>
    <tr>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#c4c2bb; height: 20px;"></td>
      <?































            if($em->MANAGEMENT_APPROVAL=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#a6a49d; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
      <?































            if($em->JOB_POST=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#878680; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
      <?































            if($em->CV_COLLECTION=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#7a7a74; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
      <?































            if($em->CV_SORTING=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#5c5c57; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
      <?































            if($em->INTERVIEW_PROCESS=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#363634; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
      <?































            if($em->JOINING=='Done'){































         ?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#121211; height: 20px;"></td>
      <? }else{?>
      <td style="padding: 0px; border-right: 0px solid #fff;border-left: 0px solid #fff;"><hr style="background:#fff; height: 20px;"></td>
      <? } ?>
    </tr>
    <tr>
      <td><?=($em->SUBMISSION_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->SUBMISSION_DATE))  :''?></td>
      <td><?=($em->MANAGEMENT_APPROVE_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->MANAGEMENT_APPROVE_DATE)) : '' ?></td>
      <td><?=($em->JOB_POST_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->JOB_POST_DATE)) : ''?></td>
      <td><?=($em->CV_COLLECTION_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->CV_COLLECTION_DATE)) : '' ?></td>
      <td><?=($em->CV_SORTING_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->CV_SORTING_DATE)) : ''?></td>
      <td><?=($em->INTERVIEW_PROCESS_DATE !='0000-00-00')? date('d-M-Y', strtotime($em->INTERVIEW_PROCESS_DATE)) : '' ?></td>
      <td><?=($em->JOINING_DATE!='0000-00-00')? date('d-M-Y', strtotime($em->JOINING_DATE)) : ''?></td>
    </tr>
    <tr>
      <td colspan="9" style="height: 20px;"></td>
    </tr>
    <? } ?>
</table>
<br/>
<p>&nbsp;</p>



<?



}


if($_POST['report']==4512)




{



if($_POST['JOB_LOCATION']!='')
$advice_con.=' and t.job_location ="'.$_POST['JOB_LOCATION'].'"';


if($_POST['department']!='')
$advice_con.=' and t.pbi_department ="'.$_POST['department'].'"';



?>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Advice</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white;"><?


$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
$_SESSION['year'] = $_POST['year'] ;
echo date_format($test, 'M-Y');

if($_POST['mon']==1){
$last_m = 12;


$last_y = $_POST['year']-1;
}else{



$last_m = $_POST['mon']-1;


$last_y = $_POST['year'];


}



?></td>
    </tr>
  </thead>
</table>
<table  width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">
  <thead>
    <tr>
      <th>Debit Account</th>
      <th>Voucher/E-mail</th>
      <th>BATCH</th>
      <th>Benificiary. Name</th>
      <th align="center"><div align="center">Credit Account/Card</div></th>
      <th>Txn Type</th>
      <th>Bank Name</th>
      <th>Routing No</th>
      <th><div align="center">Pay Amount</div></th>
      <th>Remarks/Narration</th>
    </tr>
  </thead>
  <tbody>
    <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');



 if($found==0){

if($_POST['mon']<10 && $_POST['year']<=2017){
  $sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,
 proj.PROJECT_DESC,dept.DEPT_DESC
from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj,department dept
where t.job_location=proj.PROJECT_ID and t.department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' and t.bank_or_cash in (2,3,4) order by proj.PROJECT_DESC asc ,dept.DEPT_DESC asc,t.total_payable desc';


	}else{
 $sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,proj.PROJECT_DESC

from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj

where t.job_location=proj.PROJECT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and

t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' and t.bank_or_cash in (2,3,4) order by proj.PROJECT_DESC asc,t.total_payable desc';


}



}else{

if($_POST['mon']<10 && $_POST['year']<=2017){
$sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank

from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i

where i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' and
t.bank_or_cash in (2,3,4) order by (t.total_payable - i.cash_amt) desc';




	}else{



$sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, t.designation , t.department, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,t.cash_amt, t.bank_amt, t.bank_or_cash as cash_bank
from salary_attendence_lock t,designation d, personnel_basic_info a,project proj
where t.job_location=proj.PROJECT_ID and  t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and t.designation = d.DESG_ID and t.mon='.$_POST['mon'].' and
 t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' and t.bank_or_cash in (2,3,4) order by proj.PROJECT_ID asc';































	}































































}































$queryd=mysql_query($sqld);















































ini_set('memory_limit', '-1');































while($data = mysql_fetch_object($queryd)){















































$entry_by=$data->entry_by;















































?>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
      <td></td>
      <td></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <?































if ($data->bank_or_cash==2) {































































































  ?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->cash>0)? $data->cash : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } else{?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->card_no>0)? $data->card_no : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } ?>
      <?















































         if ($data->bank_or_cash==2) {































































































  ?>
      <td><div align="center">EBLACT</div></td>
      <? } elseif($data->bank_or_cash==3){?>
      <td><div align="center">EBLCDP</div></td>
      <? }elseif($data->bank_or_cash==4){?>
      <td><div align="center">EBLACT</div></td>
      <td><div align="center">EBLCDP</div></td>
      <? } ?>
      <td><div align="center">EBL</div></td>
      <td></td>
      <td><div align="center">
          <?































  if($data->cash_bank == 2 || $data->cash_bank == 4 || $data->cash_bank == 5){































	$bank_amount = $data->total_payable;































	  }else{


			$bank_amount = $data->total_payable - $data->cash_amt;































			  }














			  echo $bank_amount;





















  $total_cash = $total_cash + $bank_amount;















  ?>
        </div></td>
      <td><div align="center">Salary</div></td>
    </tr>
    <?




}



?>
    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){


if($_POST['mon']<10 && $_POST['year']<=2017){
  $sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,dept.DEPT_DESC
from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj,department dept
where t.job_location=proj.PROJECT_ID and t.department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and t.bank_or_cash in (2,3,4,5) order by proj.PROJECT_ID asc ,dept.DEPT_DESC asc,t.total_payable desc';


	}else{

 $sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,dept.DEPT_DESC
from salary_attendence t,designation d, personnel_basic_info a, department dept
where t.department=dept.DEPT_ID and t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID and t.department not in (13) '.$con.' and t.bank_or_cash in (2,3,4,5) order by dept.DEPT_DESC asc,t.total_payable desc';


}


}else{



if($_POST['mon']<10 && $_POST['year']<=2017){

 $sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank
from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i
where i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and
t.bank_or_cash in (2,3,4,5) order by (t.total_payable - i.cash_amt) desc';



	}else{

 $sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,dept.DEPT_DESC
from salary_attendence_lock t,designation d, personnel_basic_info a, department dept
where t.department=dept.DEPT_ID and t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID and t.department not in (13) '.$con.' and t.bank_or_cash in (2,3,4,5) order by dept.DEPT_DESC asc,t.total_payable desc';



}





}































$queryd2=mysql_query($sqld2);















































ini_set('memory_limit', '-1');































while($data2 = mysql_fetch_object($queryd2)){















































$entry_by=$data2->entry_by;















































?>
    <tr>



      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white">&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td style="border:0px solid white">&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td>&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;" align="left"><?=$data2->PBI_NAME?></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;" align="left"><?=$data2->PBI_NAME?></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td nowrap="nowrap"><?=$data2->PBI_NAME?></td>
      <? } ?>
      <?















          if ($data2->bank_or_cash==2 || $data2->bank_or_cash==5 ) {















        ?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data2->cash>0)? $data2->cash : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } elseif($data2->bank_or_cash==3){?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data2->card_no>0)? $data2->card_no : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? }elseif($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;" align="right">&nbsp;&nbsp;&nbsp;
              <?=($data2->cash>0)? $data2->cash : '';?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td style="border: 0px solid white;" align="right">&nbsp;&nbsp;&nbsp;
              <?=($data2->card_no>0)? $data2->card_no : '';?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table></td>
      <? } ?>
      <?















































         if ($data2->bank_or_cash==2 || $data2->bank_or_cash==5) {































































































  ?>
      <td><div align="center">EBLACT</div></td>
      <? } elseif($data2->bank_or_cash==3){?>
      <td><div align="center">EBLCDP</div></td>
      <? }elseif($data2->bank_or_cash==4){?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBLACT</div></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBLCDP</div></td>
          </tr>
        </table></td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white;"><div align="center">EBL</div></td>
          </tr>
          <tr>
            <td style="border:0px solid white;"><div align="center">EBL</div></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td><div align="center">EBL</div></td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <? if($data2->bank_or_cash == 2){







 $bank_amount2 = $data2->total_payable;







 ?>
      <td><div align="center">
          <?=$data2->total_payable?>
        </div></td>
      <? } elseif($data2->bank_or_cash==5){







 $bank_amount2 = $data2->bank_amt-$data2->total_deduction;























  ?>
      <td><div align="center">
          <?=$data2->bank_amt-$data2->total_deduction;?>
        </div></td>
      <? }elseif($data2->bank_or_cash == 3){























$bank_amount2 = $data2->total_payable - $data2->cash_amt;















?>
      <td><div align="center">
          <?=$data2->total_payable - $data2->cash_amt;?>
        </div></td>
      <? }elseif($data2->bank_or_cash == 4){































          $bank_amount2 = $data2->total_payable;































         ?>
      <td><table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">
                <?=$data2->bank_amt-$data2->total_deduction;?>
              </div></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;"><div align="center">
                <?=$data2->cash_amt?>
              </div></td>
          </tr>
        </table></td>
      <? } ?>
      <? if($data2->bank_or_cash==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"><div align="center">Salary</div></td>
          </tr>
          <tr>
            <td style="border:0px solid white"><div align="center">Salary</div></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td><div align="center">Salary</div></td>
      <? } ?>
    </tr>
    <?































  $total_cash2 = $total_cash2 + $bank_amount2;































































}































































$total_cash2=$total_cash2+$total_cash;































































?>
    <tr>
      <td colspan="8" align="right"><b>Total:</b></td>
      <td colspan="2"><b>
        <?=number_format(($total_cash2>0)? $total_cash2 : '');?>
        </b></td>
    </tr>
  </tbody>
</table>
In Words:
<?































echo convertNumberMhafuz($total_cash2);































?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>




<!-- *********** BKASH SALARY ADVICE START ********************* -->



<?



}


if($_POST['report']==4513)




{



if($_POST['JOB_LOCATION']!='')
$advice_con.=' and t.job_location ="'.$_POST['JOB_LOCATION'].'"';


if($_POST['department']!='')
$advice_con.=' and t.pbi_department ="'.$_POST['department'].'"';



?>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;">
      	<strong>AKSID CORPORATION LIMITED</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Advice Bkash</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white;"><?


$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
$_SESSION['year'] = $_POST['year'] ;
echo date_format($test, 'M-Y');

if($_POST['mon']==1){
$last_m = 12;


$last_y = $_POST['year']-1;
}else{



$last_m = $_POST['mon']-1;


$last_y = $_POST['year'];


}



?></td>
    </tr>
  </thead>
</table>
<table  width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">
  <thead>
    <tr>
      <th style="text-align:center">SL</th>
			<th style="text-align:center">ID</th>
			<th style="text-align:center">Name</th>
	  <th style="text-align:center">Department</th>
	  <th style="text-align:center">Project</th>
      <th style="text-align:center">Wallet No</th>
      <th style="text-align:center">Principal Amount</th>
      <th style="text-align:center">Bkash Disbursement charge 1.3%</th>
      <th style="text-align:center">Total Amount</th>




    </tr>
  </thead>
  <tbody>



    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){


 $sqld2 = 'select t.*, a.PBI_ID, a.PBI_CODE,a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.job_location, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank
from salary_attendence t,designation d, personnel_basic_info a, salary_info i
where i.PBI_ID = t.PBI_ID and t.pay>0 and
a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and t.bank_or_cash in (6) order by t.department,t.job_location,t.total_payable desc';


}else{



 $sqld2 = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT,a.job_location, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation
from salary_attendence_lock t,designation d, personnel_basic_info a
where  t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID  '.$con.' and t.bank_or_cash in (6) order by t.department,t.job_location,t.total_payable desc';



}






$queryd2=mysql_query($sqld2);
ini_set('memory_limit', '-1');
while($data2 = mysql_fetch_object($queryd2)){
$entry_by=$data2->entry_by;

?>
    <tr>

     <td><div align="center"><?=++$sl;?></div></td>
		 <td><div align="center"><?=$data2->PBI_CODE?></div></td>
		 <td><div align="center"><?=$data2->PBI_NAME?></div></td>

	<td><div align="center"><? if($data2->PBI_DEPARTMENT!=13){
		echo find_a_field('department','DEPT_DESC','DEPT_ID='.$data2->PBI_DEPARTMENT);}?></div></td>

	<td><div align="center"><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$data2->job_location);?></div></td>

     <td><div align="center">&nbsp;&nbsp;&nbsp;<?=$data2->bkash_no?>&nbsp;&nbsp;&nbsp;</div></td>
     <td><div align="center"><?=$data2->bkash_amt?></div></td>
     <td><div align="center"><? $dis_amt=($data2->bkash_amt*1.3/100); echo number_format($dis_amt,2); $total_dis += $dis_amt;  ?></div></td>
     <td><div align="center"><? $total_amt = $data2->bkash_amt+$dis_amt; echo number_format($total_amt,2); $total_amount +=$total_amt;?></div></td>




    </tr>


<?

$total_bkash_amt = $data2->bkash_amt;
$total_cash2=$total_cash2+$total_bkash_amt;
}



?>
    <tr>
      <td colspan="6" align="right"><b>Total:</b></td>
      <td align="center"><b><?=number_format(($total_cash2>0)? $total_cash2 : '');?></b></td>
      <td align="center"><b><?=number_format($total_dis,2);?></b></td>
      <td align="center"><b><?=number_format($total_amount,2);?></b></td>
    </tr>
  </tbody>
</table>
In Words:
<?


echo convertNumberMhafuz(round($total_amount));

?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>





<!-- *********** SALARY ADVICE NAGAD ********************* -->





<!-- *********** BKASH SALARY ADVICE START ********************* -->



<?



}


if($_POST['report']==21216)




{



if($_POST['JOB_LOCATION']!='')
$advice_con.=' and t.job_location ="'.$_POST['JOB_LOCATION'].'"';


if($_POST['department']!='')
$advice_con.=' and t.pbi_department ="'.$_POST['department'].'"';



?>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>


    <tr><td style="border:0px; padding-right:100px" colspan="29" align="center"><?=$str?></td></tr>

 <?


$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
$_SESSION['year'] = $_POST['year'] ;
 date_format($test, 'M-Y');

if($_POST['mon']==1){
$last_m = 12;


$last_y = $_POST['year']-1;
}else{



$last_m = $_POST['mon']-1;


$last_y = $_POST['year'];


}



?>
  </thead>
</table>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <th style="text-align:center">SL</th>
			<th style="text-align:center">ID</th>
			<th style="text-align:center">Name</th>
	  <th style="text-align:center">Department</th>
	  <th style="text-align:center">Project</th>
      <th style="text-align:center">Wallet No</th>
      <th style="text-align:center">Total Amount</th>
      <th style="text-align:center">Bkash Disbursement charge 1.3%</th>
      <th style="text-align:center">Principal Amount</th>




    </tr>
  </thead>
  <tbody>



    <?


$found = find_a_field('salary_bonus','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){


  $sqld2 = 'select t.*, a.PBI_ID, a.PBI_CODE,a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.job_location, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.bkash_no
from salary_bonus t,designation d, personnel_basic_info a, salary_info i
where i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and
a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and t.bank_or_cash in (6) order by t.pbi_department,t.pbi_job_location,t.bonus_amt desc';


}else{



 $sqld2 = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT,a.job_location, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.bkash_no
from salary_bonus t,designation d, personnel_basic_info a,salary_info i
where i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID  '.$con.' and t.bank_or_cash in (6) order by t.pbi_department,t.pbi_job_location,t.bonus_amt desc';



}






$queryd2=mysql_query($sqld2);
ini_set('memory_limit', '-1');
while($data2 = mysql_fetch_object($queryd2)){
$entry_by=$data2->entry_by;

?>
    <tr>

     <td><div align="center"><?=++$sl;?></div></td>
		 <td><div align="center"><?=$data2->PBI_CODE?></div></td>
		 <td><div align="center"><?=$data2->PBI_NAME?></div></td>

	<td><div align="center"><? if($data2->PBI_DEPARTMENT!=13){
		echo find_a_field('department','DEPT_DESC','DEPT_ID='.$data2->PBI_DEPARTMENT);}?></div></td>

	<td><div align="center"><?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$data2->job_location);?></div></td>

     <td><div align="center">&nbsp;&nbsp;&nbsp;<?=$data2->bkash_no?>&nbsp;&nbsp;&nbsp;</div></td>
     <td><div align="center"><?=$data2->bonus_amt?></div></td>
     <td><div align="center"><? $dis_amt=($data2->bonus_amt*1.3/100); echo number_format($dis_amt,2); $total_dis += $dis_amt;  ?></div></td>
     <td><div align="center"><? $total_amt = $data2->bonus_amt+$dis_amt; echo number_format($total_amt,2); $total_amount +=$total_amt;?></div></td>




    </tr>


<?

$total_bkash_amt = $data2->bonus_amt;
$total_cash2=$total_cash2+$total_bkash_amt;
}



?>
    <tr>
      <td colspan="6" align="right"><b>Total:</b></td>
      <td align="center"><b><?=number_format(($total_cash2>0)? $total_cash2 : '');?></b></td>
      <td align="center"><b><?=number_format($total_dis,2);?></b></td>
      <td align="center"><b><?=number_format($total_amount,2);?></b></td>
    </tr>
  </tbody>
</table>
In Words:
<?


echo convertNumberMhafuz(round($total_amount));

?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>





<!-- *********** SALARY ADVICE NAGAD ********************* -->



<?



}


if($_POST['report']==4514)




{



if($_POST['JOB_LOCATION']!='')
$advice_con.=' and t.job_location ="'.$_POST['JOB_LOCATION'].'"';


if($_POST['department']!='')
$advice_con.=' and t.pbi_department ="'.$_POST['department'].'"';



?>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;">
      	<strong>AKSID CORPORATION LIMITED</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Advice Nagad</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;border:0px solid white;"><?


$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
$_SESSION['year'] = $_POST['year'] ;
echo date_format($test, 'M-Y');

if($_POST['mon']==1){
$last_m = 12;


$last_y = $_POST['year']-1;
}else{



$last_m = $_POST['mon']-1;


$last_y = $_POST['year'];


}



?></td>
    </tr>
  </thead>
</table>
<table  width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <th>SL</th>
      <th>Wallet No</th>
      <th>Principal Amount</th>

    </tr>
  </thead>
  <tbody>



    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){


$sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,dept.DEPT_DESC
from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj,department dept
where t.job_location=proj.PROJECT_ID and t.department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and t.bank_or_cash in (7) order by proj.PROJECT_ID asc ,dept.DEPT_DESC asc,t.total_payable desc';


}else{



$sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,dept.DEPT_DESC
from salary_attendence_lock t,designation d, personnel_basic_info a, department dept
where t.department=dept.DEPT_ID and t.pay>0 and t.total_payable>0 and t.remarks_details!="hold" and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and
t.PBI_ID=a.PBI_ID and t.department not in (13) '.$con.' and t.bank_or_cash in (7) order by dept.DEPT_DESC asc,t.total_payable desc';



}






$queryd2=mysql_query($sqld2);
ini_set('memory_limit', '-1');
while($data2 = mysql_fetch_object($queryd2)){
$entry_by=$data2->entry_by;

?>
    <tr>

     <td><div align="center"><?=++$sl;?></div></td>
     <td><div align="center">&nbsp;&nbsp;&nbsp;<?=$data2->nagad_no?>&nbsp;&nbsp;&nbsp;</div></td>
     <td><div align="center"><?=$data2->nagad_amt?></div></td>




    </tr>


<?

$total_nagad_amt = $data2->nagad_amt;

$total_cash2=$total_cash2+$total_nagad_amt;
}



?>
    <tr>
      <td colspan="2" align="right"><b>Total:</b></td>
      <td><b>
        <?=number_format(($total_cash2>0)? $total_cash2 : '');?>
        </b></td>
    </tr>
  </tbody>
</table>
In Words:
<?


echo convertNumberMhafuz($total_cash2);

?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>



<?

}

if($_POST['report']==778)































































{































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="7" align="center"><?=$str?></td>
    </tr>
    <tr>
      <th>S/L</th>
      <th>ACCOUNT NAME</th>
      <th align="center"><div align="center">ACCOUNT NO</div></th>
      <th>BRANCH CODE</th>
      <th><div align="center">AMOUNT</div></th>
      <th>Dr/Cr</th>
      <th>ADD TEXT</th>
    </tr>
  </thead>
  <tbody>
    <?































































if($_POST['branch']!='')































$cons.=' and a.PBI_BRANCH ="'.$_POST['branch'].'"';































































if($_POST['JOB_LOCATION']!='')































$cons.=' and t.pbi_job_location ="'.$_POST['JOB_LOCATION'].'"';































































if($_POST['department']!='')































$cons.=' and t.pbi_department ="'.$_POST['department'].'"';































































   $sqld = 'select t.*,i.cash, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt































































 from salary_bonus t,designation d, personnel_basic_info a, salary_info i































































 where i.PBI_ID = t.PBI_ID and t.pbi_designation = d.DESG_ID and t.bonus_amt>0 and t.bonus_type='.$_POST['bonus_type'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID and i.cash>0 '.$cons.' order by t.gross_salary desc';































$queryd=mysql_query($sqld);































while($data = mysql_fetch_object($queryd)){































































$entry_by=$data->entry_by;































































?>
    <tr>
      <td><?=++$s?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td align="right"><?=($data->cash>0)? $data->cash : '';?></td>
      <td>&nbsp;</td>
      <td><? echo ($data->bonus_amt>0)? ($data->bonus_amt) : '';        $total_cash = $total_cash + ($data->bonus_amt);































































































































  ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?































































}































































?>
    <tr>
      <td colspan="2" align="right">Total:</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td><?=($total_cash>0)? $total_cash : '';?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
In Words:
<?































echo convertNumberMhafuz($total_cash);































?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Chairman</div>
</div>



<?

}elseif($_POST['report']==21212){ ?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Festival Bonus of
      <?=$bonusName?>
      -
      <?=$_POST['year']?>
      <br />
      Summary Sheet</strong></td>
  </tr><tr>
    <td style="text-align: center;border:0px solid white;"><?

$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');

$_SESSION['year'] = $_POST['year'] ;
//echo date_format($test, 'M-Y');

?></td>
  </tr>
</table>
<table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:0px; ">
  <tr>
    <th width="60%" style="text-align:center">Job Location
      <input name="mon" value="<?=$_POST['mon']?>" type="hidden" />
      <input name="year" value="<?=$_POST['year']?>" type="hidden" /></th>
    <th width="40%" style="text-align:center; ">Bonus Amt</th>
  </tr>
  <?
$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');
if($found==0){

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.bonus_amt) as total_amt from salary_bonus a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and a.pbi_job_location = proj.PROJECT_ID
GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}else{

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.bonus_amt) as total_amt from salary_bonus_lock a, personnel_basic_info b, project proj where
a.PBI_ID = b.PBI_ID and bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
}


$jl_query1= mysql_query($jl_sql1 );
while($jl1_result1 = mysql_fetch_object($jl_query1)){

?>
  <tr style="margin:0px;">
    <td style="margin:0px;"><?=$jl1_result1->PROJECT_DESC?>
      <input type="hidden" name="job_location[]" value="<?=$jl1_result1->PROJECT_DESC?>" />
      <input type="hidden" name="tr_type[]" value="all_salary1" /></td>
    <td style="text-align:right"><?=number_format($jl1_result1->total_amt); $all_proj_salary =$all_proj_salary + $jl1_result1->total_amt;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl1_result1->total_amt?>" /></td>
  </tr>
  <?



}


?>
  <?

 $found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');
if($found==0){
$jl_sql = 'select dept.DEPT_DESC, sum(a.bonus_amt) as total_amt from salary_bonus a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and
a.pbi_department = dept.DEPT_ID  and dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.bonus_amt) as total_amt from salary_bonus_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and bonus_type='.$_POST['bonus_type'].'

and year='.$_POST['year'].' and  a.pbi_department = dept.DEPT_ID  and dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}
$jl_query= mysql_query($jl_sql );
while($jl_result = mysql_fetch_object($jl_query)){
?>
  <tr>
    <td style="text-align:left"><?=$jl_result->DEPT_DESC;?>
      <input name="job_location[]" value="<?=$jl_result->DEPT_DESC;?>" type="hidden" />
      <input type="hidden" name="tr_type[]" value="all_salary2" /></td>
    <td style="text-align: right"><?=number_format($jl_result->total_amt); $all_dept_salary = $all_dept_salary + $jl_result->total_amt;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl_result->total_amt?>" /></td>
  </tr>
  <?
}
?>
  <tr>
    <td align="left"><strong>Total</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($all_dept_salary+$all_proj_salary);?>
      </strong></td>
  </tr>
</table>





<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Cash Bonus</th>
  </tr>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="40%" style="text-align:center">Bonus Amt</th>
    </tr>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');
if($found==0){
$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.cash_paid) as total_amt from salary_bonus a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].'  and a.cash_paid!=0 and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
}else{


 $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.cash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.cash_paid!=0  and  a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

 }



$jl_query1= mysql_query($jl_sql1 );


while($jl_result1 = mysql_fetch_object($jl_query1)){



?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$jl_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=number_format($jl_result1->total_amt); $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?>
        <input name="salary_amount[]" value="<?=$jl_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}



?>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){


$jl_sql = 'select dept.DEPT_DESC, sum(a.cash_paid) as total_amt from salary_bonus a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.cash_paid!=0 and   dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{

$jl_sql = 'select dept.DEPT_DESC, sum(a.cash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.cash_paid!=0 and   dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';

        }



$jl_query= mysql_query($jl_sql );





while($jl_result = mysql_fetch_object($jl_query)){



?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$jl_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td style="text-align: right"><?=number_format($jl_result->total_amt); $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt;?>
        <input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" /></td>
    </tr>
    <?
}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>


<!-- Bkash Bonus Start -->


<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Bkash Bonus</th>
  </tr>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="40%" style="text-align:center">Bonus Amt</th>
    </tr>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');
if($found==0){
$bkash_sql1 = 'select proj.PROJECT_DESC , sum(a.bkash_paid) as total_amt from salary_bonus a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].'  and a.bkash_paid!=0 and a.bank_or_cash = 6 and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
}else{


 $bkash_sql1 = 'select proj.PROJECT_DESC , sum(a.bkash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.bkash_paid!=0  and a.bank_or_cash = 6 and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

 }



$bkash_query1= mysql_query($bkash_sql1 );


while($bkash_result1 = mysql_fetch_object($bkash_query1)){



?>
    <tr>
      <td><?=$bkash_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$bkash_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=number_format($bkash_result1->total_amt); $all_proj_bkash2 =$all_proj_bkash2 + $bkash_result1->total_amt;?>
        <input name="salary_amount[]" value="<?=$bkash_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}



?>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){


$bkash_sql = 'select dept.DEPT_DESC, sum(a.bkash_paid) as total_amt from salary_bonus a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.bkash_paid!=0 and a.bank_or_cash = 6 and   dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{

$bkash_sql = 'select dept.DEPT_DESC, sum(a.bkash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.bkash_paid!=0 and  a.bank_or_cash = 6 and  dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';

        }



$bkash_query= mysql_query($bkash_sql );





while($bkash_result = mysql_fetch_object($bkash_query)){



?>
    <tr>
      <td style="text-align:left"><?=$bkash_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$bkash_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td style="text-align: right"><?=number_format($bkash_result->total_amt); $all_dept_bkash2 = $all_dept_bkash2 + $bkash_result->total_amt;?>
        <input name="salary_amount[]" value="<?=$bkash_result->total_amt?>" type="hidden" /></td>
    </tr>
    <?
}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_bkash=($all_dept_bkash2+$all_proj_bkash2));?>
        </strong></td>
    </tr>
  </table>
</table>


<!-- Bkash bonus end   -->





<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr>
    <th width="100%" colspan="2" border="0" style="text-align:center">Bank Bonus</th>
  </tr>
</table>
<table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:0px;">
  <tr>
    <th width="60%" style="text-align:center">Job Location</th>
    <th width="40%" style="text-align:center">Bonus Amt</th>
  </tr>
  <?

 $found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.bank_paid) as total_amt,sum(a.payroll_card_paid) as total_amt_payroll from salary_bonus a,
personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].' and a.year='.$_POST['year'].'
and a.pbi_job_location = proj.PROJECT_ID and a.bank_or_cash != 6 GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
}else{

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.bank_paid) as total_amt,sum(a.payroll_card_paid) as total_amt_payroll from salary_bonus_lock a,
personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].' and a.year='.$_POST['year'].'
and a.pbi_job_location = proj.PROJECT_ID and a.bank_or_cash != 6  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

}



$jl_query1= mysql_query($jl_sql1 );
while($jl_result1 = mysql_fetch_object($jl_query1)){

?>
  <tr>
    <td style="padding:3px;"><?=$jl_result1->PROJECT_DESC?>
      <input name="job_location[]" value="<?=$jl_result1->PROJECT_DESC?>" type="hidden" />
      <span style="margin:0px;">
      <input name="tr_type[]" value="bank_salary1" type="hidden" />
      </span></td>
    <td style="text-align:right;"><?=number_format($jl_result1->total_amt+$jl_result1->total_amt_payroll); $all_proj_salary3 =$all_proj_salary3 + $jl_result1->total_amt+$jl_result1->total_amt_payroll;?>
      <input name="salary_amount[]" value="<?=$jl_result1->total_amt;?>" type="hidden" /></td>
  </tr>
  <?

}

?>
  <?





$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){



 $jl_sql = 'select dept.DEPT_DESC, sum(a.bank_paid) as total_amt,sum(a.payroll_card_paid) as total_amt_payroll from salary_bonus a, personnel_basic_info b, department dept where
a.PBI_ID = b.PBI_ID  and a.bonus_type='.$_POST['bonus_type'].' and
a.year='.$_POST['year'].'  and a.pbi_department = dept.DEPT_ID and dept.DEPT_ID not in (13) and a.bank_or_cash != 6 GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}else{




   $jl_sql = 'select dept.DEPT_DESC, sum(a.bank_paid) as total_amt,sum(a.payroll_card_paid) as total_amt_payroll from salary_bonus_lock a, personnel_basic_info b, department dept where
a.PBI_ID = b.PBI_ID  and a.bonus_type='.$_POST['bonus_type'].' and
a.year='.$_POST['year'].'  and a.pbi_department = dept.DEPT_ID  and dept.DEPT_ID not in (13) and a.bank_or_cash != 6  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC  ';



}





$jl_query= mysql_query($jl_sql );



while($jl_result = mysql_fetch_object($jl_query)){

?>

<? if($jl_result->total_amt>0){ ?>
  <tr>
    <td><?=$jl_result->DEPT_DESC;?>
      <input name="job_location[]" value="<?=$jl_result->DEPT_DESC?>" type="hidden" />
      <input type="hidden" name="tr_type[]" value="bank_salary2" /></td>
    <td style="text-align: right"><input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" />
      <?=number_format($jl_result->total_amt+$jl_result->total_amt_payroll); $all_dept_salary3 = $all_dept_salary3 + $jl_result->total_amt+$jl_result->total_amt_payroll;?></td>
  </tr>
	<? }?>
  <?

}




?>
  <tr>
    <td><strong>Total</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($tot_dept_proj3=($all_dept_salary3+$all_proj_salary3));?>
      </strong></td>
  </tr>
  <tr>
    <td><strong><span style="float:right; font-weight:bold;">Grand Total :</span></strong></td>
    <td><strong><span style="float:right; font-weight:bold;">
      <?=number_format($grandTotal=($tot_dept_proj3+$tot_dept_proj+$tot_dept_proj_bkash));?>
      </span></strong></td>
  </tr>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?

 echo convertNumberMhafuz($grandTotal);

?>
  </div>
</center>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="text-decoration:none; border-bottom:0px;"><div align="center" >
        <?php

$check_sql = 'select 1 from salary_lock where month='.$_POST['mon'].' and year='.$_POST['year'].' and tr_type="all_salary2"';
$check_query2 = mysql_query($check_sql2);
$last_check2 = mysql_num_rows($check_query2 );

if($last_check2 >0){ ?>
        <!--<input name="lock" id="lock" type="submit" value="LOCKED" />-->
        <?php }else{ ?>
        <!--	<input name="lock" id="lock" type="submit" value="LOCK" />-->
        <?php	}


?>
      </div></td>
  </tr>
</table>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>


<!-- Bonus summary sheet Bkash Start  -->


<?

}elseif($_POST['report']==21214){ ?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Festival Bonus of
      <?=$bonusName?>
      -
      <?=$_POST['year']?>
      <br />
      Summary Sheet</strong></td>
  </tr><tr>
    <td style="text-align: center;border:0px solid white;"><?

$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');

$_SESSION['year'] = $_POST['year'] ;
//echo date_format($test, 'M-Y');

?></td>
  </tr>
</table>




<!-- Bkash Bonus Start -->


<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Bkash Bonus</th>
  </tr>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="40%" style="text-align:center">Bonus Amt</th>
    </tr>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');
if($found==0){
$bkash_sql1 = 'select proj.PROJECT_DESC , sum(a.bkash_paid) as total_amt from salary_bonus a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].'  and a.bkash_paid!=0 and a.bank_or_cash = 6 and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
}else{


 $bkash_sql1 = 'select proj.PROJECT_DESC , sum(a.bkash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.bkash_paid!=0  and a.bank_or_cash = 6 and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

 }



$bkash_query1= mysql_query($bkash_sql1 );


while($bkash_result1 = mysql_fetch_object($bkash_query1)){



?>
    <tr>
      <td><?=$bkash_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$bkash_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=number_format($bkash_result1->total_amt); $all_proj_bkash2 =$all_proj_bkash2 + $bkash_result1->total_amt;?>
        <input name="salary_amount[]" value="<?=$bkash_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}



?>
    <?

$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');

if($found==0){


$bkash_sql = 'select dept.DEPT_DESC, sum(a.bkash_paid) as total_amt from salary_bonus a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.bkash_paid!=0 and a.bank_or_cash = 6 and   dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{

$bkash_sql = 'select dept.DEPT_DESC, sum(a.bkash_paid) as total_amt from salary_bonus_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].'
and a.year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and a.bkash_paid!=0 and  a.bank_or_cash = 6 and  dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';

        }



$bkash_query= mysql_query($bkash_sql );





while($bkash_result = mysql_fetch_object($bkash_query)){



?>
    <tr>
      <td style="text-align:left"><?=$bkash_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$bkash_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td style="text-align: right"><?=number_format($bkash_result->total_amt); $all_dept_bkash2 = $all_dept_bkash2 + $bkash_result->total_amt;?>
        <input name="salary_amount[]" value="<?=$bkash_result->total_amt?>" type="hidden" /></td>
    </tr>
    <?
}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_bkash=($all_dept_bkash2+$all_proj_bkash2));?>
        </strong></td>
    </tr>
  </table>
</table>


<!-- Bkash bonus end   -->



<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?

 echo convertNumberMhafuz($tot_dept_proj_bkash);

?>
  </div>
</center>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="text-decoration:none; border-bottom:0px;"><div align="center" >
        <?php

$check_sql = 'select 1 from salary_lock where month='.$_POST['mon'].' and year='.$_POST['year'].' and tr_type="all_salary2"';
$check_query2 = mysql_query($check_sql2);
$last_check2 = mysql_num_rows($check_query2 );

if($last_check2 >0){ ?>
        <!--<input name="lock" id="lock" type="submit" value="LOCKED" />-->
        <?php }else{ ?>
        <!--	<input name="lock" id="lock" type="submit" value="LOCK" />-->
        <?php	}


?>
      </div></td>
  </tr>
</table>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>


<!-- Bonus summary sheet Bkash end  -->


<?
}elseif($_POST['report']==9999){

?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?



$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
$_SESSION['year'] = $_POST['year'] ;
echo date_format($test, 'M-Y');
if($_POST['mon']==1){
$last_m = 12;
$last_y = $_POST['year']-1;
}else{
$last_m = $_POST['mon']-1;
$last_y = $_POST['year'];


}

?></td>
  </tr>
</table>


<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
<input name="mon" value="<?=$_POST['mon']?>" type="hidden" />
<input name="year" value="<?=$_POST['year']?>" type="hidden" />
<tr bordercolor="#FFFFFF">
  <th width="100%" colspan="5" style="text-align:center">Total Salary</th>
</tr>
<table width="70%" border="1" id="ExportTable" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr>
    <th width="40%" style="text-align:center">Job Location</th>
    <th width="15%" style="text-align:center">Net Salary</th>
		<th width="15%" style="text-align:center">Total Cost</th>
    <th width="15%" style="text-align:center">Net Payable Salary</th>

    <th width="15%" style="text-align:center">Last Month Net Salary</th>
    <th width="15%" style="text-align:center">Difference %</th>
  </tr>
  <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($_POST['mon']>8 && $_POST['year']>=2018){
if($found==0){


   $jl_sql1 = 'select proj.PROJECT_ID,proj.PROJECT_DESC , sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
	sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost

  from salary_attendence a,
	personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and
	a.remarks_details!="hold" and a.job_location = proj.PROJECT_ID and a.pay>0 GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';



}else{


     $jl_sql1 = 'select proj.PROJECT_ID,proj.PROJECT_DESC , sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
		sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost


		from salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.mon='.$_POST['mon'].' and
		a.year='.$_POST['year'].' and  a.job_location = proj.PROJECT_ID and a.remarks_details!="hold" and a.pay>0 GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

}


}else{


	if($found==0){


    $jl_sql1 = 'select proj.PROJECT_ID,proj.PROJECT_DESC , sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
	 sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost


	 from salary_attendence a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
	  and a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}else{


    $jl_sql1 = 'select proj.PROJECT_ID,proj.PROJECT_DESC , sum(a.total_payable) as total_amt,  sum(a.total_earning) as total_earning,
		sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost


		from salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
		a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';



}


}


$jl_query1= mysql_query($jl_sql1 );
while($jl1_result1 = mysql_fetch_object($jl_query1)){
$last_month_earning_proj = find_a_field('salary_attendence_lock','sum(total_earning)','mon="'.$last_m.'" and year="'.$last_y.'" and job_location="'.$jl1_result1->PROJECT_ID.'" and pay>0 and remarks_details!="hold"');


// $sqlll = 'select sum(total_earning) from salary_attendence_lock where mon="'.$last_m.'" and year="'.$last_y.'" and job_location="'.$jl1_result1->PROJECT_ID.'" and pay>0 and remarks_details!="hold"';
$last_month_earning_proj_total = $last_month_earning_proj_total+$last_month_earning_proj;
$last_proj_dff = $jl1_result1->total_earning-$last_month_earning_proj;
$dft = ($last_proj_dff*100)/$last_month_earning_proj;
?>
  <tr style="margin:0px;">
    <td style="margin:0px; width:40%"><?=$jl1_result1->PROJECT_DESC?>
      <input type="hidden" name="job_location[]" value="<?=$jl1_result1->PROJECT_DESC?>" />
      <input type="hidden" name="tr_type[]" value="all_salary1" /></td>



    <td align="right" style="width:15%"><?=(number_format($jl1_result1->total_earning)>0)? number_format($jl1_result1->total_earning):''; $all_proj_salary_earning =$all_proj_salary_earning + $jl1_result1->total_earning;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl1_result1_earning->total_earning?>" /></td>

			<td align="right" style="width:15%;"><?=(number_format($jl1_result1->total_cost)>0)? number_format($jl1_result1->total_cost):'' ;
			$all_proj_salary_cost = $all_proj_salary_cost + $jl1_result1->total_cost;?>
	      <input type="hidden" name="salary_amount[]" value="<?=$jl1_result1_earning->total_earning?>"></td>


    <td style="text-align:right; width:15%;"><?=(number_format($jl1_result1->total_amt)>0)? number_format($jl1_result1->total_amt):'' ; $all_proj_salary =$all_proj_salary + $jl1_result1->total_amt;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl1_result1->total_amt?>" /></td>
    <td style="text-align:right;width:15%;"><?=number_format($last_month_earning_proj,0)?></td>
    <td style="text-align:right;width:15%;"><?=number_format($dft,2)?></td>
  </tr>
  <?
  } ?>
  <?
  $found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');


if($_POST['mon']>9 && $_POST['year']>=2018){


 if($found==0){

  $jl_sql = 'select dept.DEPT_ID,dept.DEPT_DESC, sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
	sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost

	from salary_attendence a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
	b.PBI_JOB_STATUS="In Service" and a.job_location=0 and a.department = dept.DEPT_ID and  a.pay>0 and dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';




}else{



   $jl_sql = 'select dept.DEPT_ID,dept.DEPT_DESC, sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
	 sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost

	 from salary_attendence_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.mon='.$_POST['mon'].' and a.year='.$_POST['year'].'  and
	 a.department = dept.DEPT_ID and a.job_location=0 and  a.pay>0 and dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';



}





}else{


	if($found==0){



    $jl_sql = 'select dept.DEPT_ID,dept.DEPT_DESC, sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
	 sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost
   from salary_attendence a, personnel_basic_info b,
	 department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and a.remarks_details!="hold"
	 and a.department = dept.DEPT_ID and  a.pay>0 and dept.DEPT_ID not in (3,13,16)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';



}else{


    $jl_sql = 'select dept.DEPT_ID,dept.DEPT_DESC, sum(a.total_payable) as total_amt, sum(a.total_earning) as total_earning,
		sum((a.gross_salary+a.adjustment_amount)-(a.absent_deduction+a.joining_deduction+a.late_deduction+a.lwp_deduction+a.other_deductions+a.other_deductions)) as total_cost
    from salary_attendence_lock a,
		personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and a.remarks_details!="hold"  and
		a.department = dept.DEPT_ID and  a.pay>0 and dept.DEPT_ID not in (3,13,16)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';



}}


$jl_query= mysql_query($jl_sql );



while($jl_result = mysql_fetch_object($jl_query)){
$last_month_earning_dept = find_a_field('salary_attendence_lock','sum(total_earning)','mon="'.$last_m.'" and year="'.$last_y.'" and department="'.$jl_result->DEPT_ID.'" and
pay>0 and remarks_details!="hold" and department not in (3,13,16)');

$last_month_earning_dept_total = $last_month_earning_dept_total+$last_month_earning_dept;
$last_dept_dff = $jl_result->total_earning-$last_month_earning_dept;
$dft_dept = ($last_dept_dff*100)/$last_month_earning_dept;

?>
  <tr>
    <td style="text-align:left; width:40%;"><?=$jl_result->DEPT_DESC;?>
      <input name="job_location[]" value="<?=$jl_result->DEPT_DESC;?>" type="hidden" />
      <input type="hidden" name="tr_type[]" value="all_salary2" /></td>


    <td align="right" style="width:15%;"><?=(number_format($jl_result->total_earning)>0)? number_format($jl_result->total_earning):'' ; $all_dept_salary_earning = $all_dept_salary_earning + $jl_result->total_earning;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl_result->total_earning?>"></td>

			<td align="right" style="width:15%;"><?=(number_format($jl_result->total_cost)>0)? number_format($jl_result->total_cost):'' ;
			$all_dept_salary_cost = $all_dept_salary_cost + $jl_result->total_cost;?>
	      <input type="hidden" name="salary_amount[]" value="<?=$jl_result->total_earning?>"></td>


    <td style="text-align: right;width:15%;"><?=(number_format($jl_result->total_amt)>0)? number_format($jl_result->total_amt):'' ; $all_dept_salary = $all_dept_salary + $jl_result->total_amt;?>
      <input type="hidden" name="salary_amount[]" value="<?=$jl_result->total_amt?>" /></td>
    <td style="text-align:right;width:15%"><?=number_format($last_month_earning_dept,0)?></td>
    <td style="text-align:right;width:15%"><?=number_format($dft_dept,2)?></td>
  </tr>
  <?
}

?>
  <tr>
    <td align="left"><strong>Total</strong></td>
    <td style="text-align:right"><strong>
      <?=(number_format($total_earning_cash_bank=$all_dept_salary_earning+$all_proj_salary_earning)>0)? number_format($total_earning_cash_bank=$all_dept_salary_earning+$all_proj_salary_earning):'';?>
      </strong></td>

			<td style="text-align:right"><strong>
        <?=(number_format($all_proj_salary_cost+$all_dept_salary_cost)>0)? number_format($all_proj_salary_cost+$all_dept_salary_cost):'';?>
        </strong></td>


    <td style="text-align:right"><strong>
      <?=(number_format($all_dept_salary+$all_proj_salary)>0)? number_format($all_dept_salary+$all_proj_salary):'';?>
      </strong></td>



    <td style="text-align:right"><strong>
      <?=number_format($last_total = $last_month_earning_dept_total+$last_month_earning_proj_total,0) ?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?

   $last_dft_total = $total_earning_cash_bank-$last_total;
   $dft_total = ($last_dft_total*100)/$last_total;
   echo number_format($dft_total,2);
   ?>
   </strong></td>
  </tr>
</table>
<br>


 <!-- ************************** CASH SALARY STRAT ************************* -->
<table width="70%" border="0"  cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="3" style="text-align:center">Cash Salary</th>
  </tr>
  <table width="70%" border="1" cellspacing="0"  cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="20%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

 $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as cash_amt,a.job_location
from salary_attendence a,personnel_basic_info b,project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and

 a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(1,5) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}else{

  $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,sum(a.cash_amt) as cash_amt,a.job_location from
salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(1,5) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}

$jl_query1= mysql_query($jl_sql1 );
while($jl_result1 = mysql_fetch_object($jl_query1)){
if($jl_result->cash_amt>0){

$total_cash_earning1 =$jl_result1->cash_amt;
$total_cash_payable1 =$jl_result1->cash_amt;


}else{

$total_cash_earning1 = $jl_result1->cash_amt;
$total_cash_payable1 = $jl_result1->cash_amt;


}


 $cash_earning_total_project = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and job_location="'.$jl_result1->job_location.'" and year="'.$_POST['year'].'"');

?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$jl_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=(number_format($total_cash_earning1)>0)? number_format($total_cash_earning1+$cash_earning_total_project):'';  $total_cash_earning_proj = $total_cash_earning_proj + $total_cash_earning1+$cash_earning_total_project;?>
        <input name="salary_amount[]" value="<?=$jl_result1->total_earning?>" type="hidden" /></td>
      <td align="right"><?=(number_format($total_cash_payable1)>0)? number_format($total_cash_payable1):'' ; $total_cash_payable_proj = $total_cash_payable_proj + $total_cash_payable1;?>
        <input name="salary_amount[]" value="<?=$jl_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}


?>
    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($_POST['mon']>9 && $_POST['year']>=2018){

 if($found==0){


$jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.cash_amt) as total_earning_cash,a.department,
a.total_deduction as total_deduction,a.advance_install  from salary_attendence a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
 and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13) and a.bank_or_cash IN(1,5)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


$jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.cash_amt) as total_earning_cash,
a.department,a.total_deduction as total_deduction,a.advance_install

from salary_attendence_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
b.PBI_JOB_STATUS="In Service" and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash IN(1,5) GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}


}else{


if($found==0){

 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,a.total_deduction as total_deduction,
 a.advance_install,sum(a.cash_amt) as total_earning_cash
from salary_attendence a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
 and a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(1,5)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,
a.total_deduction as total_deduction,a.advance_install,sum(a.cash_amt) as total_earning_cash
from salary_attendence_lock a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(1,5)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}


}


$jl_query= mysql_query($jl_sql );


while($jl_result = mysql_fetch_object($jl_query)){


//for salary condition
$salary_given_status = $jl_result->bank_or_cash;


if($jl_result->total_earning_cash>0){
$total_cash_earning =($jl_result->total_earning_cash);
$total_cash_payable = ($jl_result->total_earning_cash);


}else{

$total_cash_earning = $jl_result->total_earning_cash;
$total_cash_payable = $jl_result->total_earning_cash;


}

$cash_earning_total_department = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and department="'.$jl_result->department.'" and year="'.$_POST['year'].'"');


?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$jl_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td align="right"><?=number_format($total_cash_earning+$cash_earning_total_department); $total_cash_earning_dept = $total_cash_earning_dept + $total_cash_earning+$cash_earning_total_department;?>
        <input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" /></td>
      <td style="text-align: right"><?=(number_format($total_cash_payable)>0)? number_format($total_cash_payable):''; $total_cash_payable_dept = $total_cash_payable_dept + $total_cash_payable;?>
        <input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" /></td>
    </tr>
    <? } ?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=(number_format($tot_dept_proj_cash_earning=($total_cash_earning_proj+$total_cash_earning_dept))>0)? number_format($total_cash_earning_proj+$total_cash_earning_dept):'';?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_cash_payable=($total_cash_payable_proj+$total_cash_payable_dept));?>
        </strong></td>
    </tr>
  </table>
</table>


<!-- ************************** BKASH SALARY START ************************* -->
<table width="70%" border="0"  cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="3" style="text-align:center">Bkash Salary</th>
  </tr>
  <table width="70%" border="1"  cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="20%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

 $sql_bks = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bkash_amt) as bkash_amt,a.job_location
from salary_attendence a,personnel_basic_info b,project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
 a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(6) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}else{

   $sql_bks = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,
  sum(a.bkash_amt) as bkash_amt,a.job_location from
salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(6) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}

$query_bks = mysql_query($sql_bks);
while($bks_result1 = mysql_fetch_object($query_bks)){
if($bks_result1->bkash_amt>0){

$total_bkash_earning1 =$bks_result1->bkash_amt;
$total_bkash_payable1 =$bks_result1->bkash_amt;


}else{

$total_bkash_earning1 = $bks_result1->bkash_amt;
$total_bkash_payable1 = $bks_result1->bkash_amt;


}


?>
    <tr>
      <td><?=$bks_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$bks_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=(number_format($total_bkash_earning1)>0)?
      number_format($total_bkash_earning1):'';  $total_bkash_earning_proj = $total_bkash_earning_proj + $total_bkash_earning1;?>
        <input name="salary_amount[]" value="<?=$bks_result1->total_earning?>" type="hidden" /></td>
      <td align="right"><?=(number_format($total_bkash_payable1)>0)?
      number_format($total_bkash_payable1):'' ; $total_bkash_payable_proj = $total_bkash_payable_proj + $total_bkash_payable1;?>
        <input name="salary_amount[]" value="<?=$bks_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}


?>
    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($_POST['mon']>9 && $_POST['year']>=2018){

 if($found==0){


$jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.bkash_amt) as total_earning_bks,a.department,
a.total_deduction as total_deduction,a.advance_install  from salary_attendence a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)
and a.bank_or_cash IN(6)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


 $jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.bkash_amt) as total_earning_bks,
a.department,a.total_deduction as total_deduction,a.advance_install

from salary_attendence_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and
 year='.$_POST['year'].'   and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)
and a.bank_or_cash IN(6) GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}


}else{


if($found==0){

 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,a.total_deduction as total_deduction,
 a.advance_install,sum(a.bkash_amt) as total_earning_bks
from salary_attendence a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
 and a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(6)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}else{


 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,
a.total_deduction as total_deduction,a.advance_install,sum(a.bkash_amt) as total_earning_bks
from salary_attendence_lock a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(6)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}


}


$bks_query= mysql_query($jl_sql );


while($bks_result = mysql_fetch_object($bks_query)){


//for salary condition
$salary_given_status = $bks_result->bank_or_cash;


if($bks_result->total_earning_bks>0){
$total_bkash_earning =($bks_result->total_earning_bks);
$total_bkash_payable = ($bks_result->total_earning_bks);


}else{

$total_bkash_earning = $bks_result->total_earning_bks;
$total_bkash_payable = $bks_result->total_earning_bks;


}




?>
    <tr>
      <td style="text-align:left"><?=$bks_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$bks_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td align="right"><?=number_format($total_bkash_earning);
      $total_bkash_earning_dept = $total_bkash_earning_dept + $total_bkash_earning;?>
        <input name="salary_amount[]" value="<?=$bks_result->total_amt?>" type="hidden" /></td>
      <td style="text-align: right"><?=(number_format($total_bkash_payable)>0)? number_format($total_bkash_payable):'';
      $total_bkash_payable_dept = $total_bkash_payable_dept + $total_bkash_payable;?>
        <input name="salary_amount[]" value="<?=$bks_result->total_amt?>" type="hidden" /></td>
    </tr>
    <? } ?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=(number_format($tot_dept_proj_bkash_earning=($total_bkash_earning_proj+$total_bkash_earning_dept))>0)?
        number_format($total_bkash_earning_proj+$total_bkash_earning_dept):'';?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_bkash_payable=($total_bkash_payable_proj+$total_bkash_payable_dept));?>
        </strong></td>
    </tr>
  </table>
</table>


 <!-- ************************** NAGAD SALARY START ************************* -->


 <?


 $exixting_checker = find_a_field('salary_attendence','sum(nagad_amt)','mon="'.$_POST['mon'].'"  and

 	bank_or_cash=7 and

 	year="'.$_POST['year'].'"');

 if($exixting_checker>0){

  ?>

<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="3" style="text-align:center">Nagad Salary</th>
  </tr>
  <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="20%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

 $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,
 sum(a.nagad_amt) as nagad_amt,a.job_location
from salary_attendence a,personnel_basic_info b,project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'   and
 a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(7) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}else{

  $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,sum(a.nagad_amt) as nagad_amt,a.job_location from
salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash IN(7) GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';


}

$jl_query1= mysql_query($jl_sql1 );
while($jl_result1 = mysql_fetch_object($jl_query1)){
if($jl_result->nagad_amt>0){

$total_nagad_earning1 =$jl_result1->nagad_amt;
$total_nagad_payable1 =$jl_result1->nagad_amt;


}else{

$total_nagad_earning1 = $jl_result1->nagad_amt;
$total_nagad_payable1 = $jl_result1->nagad_amt;


}


 $nagad_earning_total_project = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and
 	job_location="'.$jl_result1->job_location.'" and year="'.$_POST['year'].'"');

?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?>
        <input name="job_location[]" value="<?=$jl_result1->PROJECT_DESC?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary1" type="hidden" /></td>
      <td style="text-align:right"><?=(number_format($total_nagad_earning1)>0)?
       number_format($total_nagad_earning1+$nagad_earning_total_project):'';  $total_nagad_earning_proj = $total_nagad_earning_proj +
       $total_nagad_earning1+$nagad_earning_total_project;?>
        <input name="salary_amount[]" value="<?=$jl_result1->total_earning?>" type="hidden" /></td>
      <td align="right"><?=(number_format($total_nagad_payable1)>0)? number_format($total_nagad_payable1):'' ;
      $total_nagad_payable_proj = $total_nagad_payable_proj + $total_nagad_payable1;?>
        <input name="salary_amount[]" value="<?=$jl_result1->total_amt?>" type="hidden" /></td>
    </tr>
    <?




}


?>
    <?


$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($_POST['mon']>9 && $_POST['year']>=2018){

 if($found==0){


$jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.nagad_amt) as total_earning_cash,a.department,
a.total_deduction as total_deduction,a.advance_install  from salary_attendence a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)
and a.bank_or_cash IN(7)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


$jl_sql = 'select dept.DEPT_DESC,sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,sum(a.nagad_amt) as total_earning_cash,
a.department,a.total_deduction as total_deduction,a.advance_install

from salary_attendence_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' a
nd year='.$_POST['year'].'  and
b.PBI_JOB_STATUS="In Service" and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)
and a.bank_or_cash IN(7) GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}


}else{


if($found==0){

 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,a.total_deduction as total_deduction,
 a.advance_install,sum(a.nagad_amt) as total_earning_cash
from salary_attendence a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
 and a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(7)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bank_amt) as bank_amt,a.bank_or_cash,a.department,
a.total_deduction as total_deduction,a.advance_install,sum(a.nagad_amt) as total_earning_cash
from salary_attendence_lock a,personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
a.department = dept.DEPT_ID and a.pay>0 and a.remarks_details!="hold"  and dept.DEPT_ID not in (3,13,16) and a.bank_or_cash IN(7)  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';

}


}


$jl_query= mysql_query($jl_sql );


while($jl_result = mysql_fetch_object($jl_query)){


//for salary condition
$salary_given_status = $jl_result->bank_or_cash;


if($jl_result->total_earning_cash>0){
$total_nagad_earning =($jl_result->total_earning_cash);
$total_nagad_payable = ($jl_result->total_earning_cash);


}else{

$total_nagad_earning = $jl_result->total_earning_cash;
$total_nagad_payable = $jl_result->total_earning_cash;


}

$nagad_earning_total_department = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and
	department="'.$jl_result->department.'" and year="'.$_POST['year'].'"');


?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?>
        <input name="job_location[]" value="<?=$jl_result->DEPT_DESC;?>" type="hidden" />
        <input name="tr_type[]" value="cash_salary2" type="hidden" /></td>
      <td align="right"><?=number_format($total_nagad_earning+$nagad_earning_total_department);
      $total_nagad_earning_dept = $total_nagad_earning_dept + $total_nagad_earning+$nagad_earning_total_department;?>
        <input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" /></td>
      <td style="text-align: right">
      	<?=(number_format($total_nagad_payable)>0)? number_format($total_nagad_payable):'';
      $total_nagad_payable_dept = $total_nagad_payable_dept + $total_nagad_payable;?>
        <input name="salary_amount[]" value="<?=$jl_result->total_amt?>" type="hidden" /></td>
    </tr>
    <? } ?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=(number_format($tot_dept_proj_nagad_earning=($total_nagad_earning_proj+$total_nagad_earning_dept))>0)?
        number_format($total_nagad_earning_proj+$total_nagad_earning_dept):'';?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_nagad_payable=($total_nagad_payable_proj+$total_nagad_payable_dept));?>
        </strong></td>
    </tr>
  </table>
</table>

 <? } ?>
<!-- ************************** BANK SALARY START ************************* -->

<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr>
    <th width="100%" colspan="3" border="0" style="text-align:center">Bank Salary</th>
  </tr>
</table>
<table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:0px;">
  <tr>
    <th width="60%" style="text-align:center">Job Location</th>
    <th width="20%" style="text-align:center">Net Salary</th>
    <th width="20%" style="text-align:center">Net Payable Salary</th>
  </tr>
  <?



   $found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
   if($found==0){
   $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,a.bank_or_cash,sum(a.cash_amt) as total_cash_amt from
   salary_attendence a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and
   a.remarks_details!="hold"  and a.job_location = proj.PROJECT_ID and a.pay>0 and  a.bank_or_cash NOT IN ("1","6","7")   GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
   }else{

   $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_cash_amt from salary_attendence_lock a,
   personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and  a.job_location = proj.PROJECT_ID and
	  a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash NOT IN ("1","6","7")  GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';

}



$jl_query1= mysql_query($jl_sql1 );
while($jl_result1 = mysql_fetch_object($jl_query1)){

if($jl_result1->total_cash_amt>0){
$total_bank_payable = $jl_result1->total_amt-$jl_result1->total_cash_amt;
$total_bank_earning = $jl_result1->total_earning-$jl_result1->total_cash_amt;
}else{
$total_bank_payable = $jl_result1->total_amt;
$total_bank_earning = $jl_result1->total_earning;
}
?>
  <tr>
    <td style="padding:3px;"><?=$jl_result1->PROJECT_DESC?>
      <input name="job_location[]" value="<?=$jl_result1->PROJECT_DESC?>" type="hidden" />
      <span style="margin:0px;">
      <input name="tr_type[]" value="bank_salary1" type="hidden" />
      </span></td>
    <td align="right"><?=(number_format($total_bank_earning)>0)? number_format($total_bank_earning):''; $total_bank_earning_proj =$total_bank_earning_proj + $total_bank_earning;?>
      <input name="salary_amount[]" value="<?=$jl_result1->total_amt_bank;?>" type="hidden" /></td>
    <td style="text-align:right;"><?=(number_format($total_bank_payable)>0)? number_format($total_bank_payable):''; $total_bank_payable_proj =$total_bank_payable_proj + $total_bank_payable;?>
      <input name="salary_amount[]" value="<?=$jl_result1->total_amt_bank;?>" type="hidden" /></td>
  </tr>
  <?

  }?>
  <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($_POST['mon']>9 && $_POST['year']>=2018){
if($found==0){


   $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_cash_amt from salary_attendence a,
	 personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'
	 and a.job_location=0  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash NOT IN ("1","6","7") GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';

}else{

$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_cash_amt from salary_attendence_lock a,
personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and  a.department = dept.DEPT_ID and
a.job_location=0 and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash NOT IN ("1","6","7") GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}
}else{
if($found==0){

	 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_cash_amt from salary_attendence a,
	 personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and b.PBI_JOB_STATUS="In Service" and
	 a.remarks_details!="hold"  and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (3,13,16)  and a.bank_or_cash NOT IN ("1","6","7") GROUP BY dept.DEPT_ID order by dept.DEPT_DESC ';


}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_cash_amt from salary_attendence_lock a,
personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and  a.department = dept.DEPT_ID and a.pay>0 and
a.remarks_details!="hold" and dept.DEPT_ID not in (3,13,16)  and a.bank_or_cash NOT IN ("1","6","7") GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';


}}

$jl_query= mysql_query($jl_sql );
while($jl_result = mysql_fetch_object($jl_query)){

if($jl_result->total_cash_amt>0){
$total_bank_payable2 = $jl_result->total_amt-$jl_result->total_cash_amt;
$total_bank_earning2 = $jl_result->total_earning-$jl_result->total_cash_amt;

}else{
$total_bank_payable2 = $jl_result->total_amt;
$total_bank_earning2 = $jl_result->total_earning;

} ?>
  <tr>
    <td><?=$jl_result->DEPT_DESC;?>
      <input name="job_location[]" value="<?=$jl_result->DEPT_DESC?>" type="hidden" />
      <input type="hidden" name="tr_type[]" value="bank_salary2" /></td>
    <td align="right"><input name="salary_amount[]" value="<?=$jl_result->total_amt_bank?>" type="hidden" />
      <?=(number_format($total_bank_earning2)>0)? number_format($total_bank_earning2):''; $total_bank_earning_dept = $total_bank_earning_dept + $total_bank_earning2;?></td>
    <td style="text-align: right"><input name="salary_amount[]" value="<?=$jl_result->total_earning?>" type="hidden" />
      <?=(number_format($total_bank_payable2)>0)? number_format($total_bank_payable2):'' ; $total_bank_payable_dept = $total_bank_payable_dept + $total_bank_payable2;?></td>
  </tr>
  <?
 }?>
  <tr>
    <td><strong>Total</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($tot_bank_earning_dept=($total_bank_earning_dept+$total_bank_earning_proj));?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=(number_format($tot_bank_payable_dept_projj=($total_bank_payable_dept+$total_bank_payable_proj))>0)?
      number_format($total_bank_payable_dept+$total_bank_payable_proj):'';?>
      </strong></td>
  </tr>
  <tr>
    <td><strong><span style="float:right; font-weight:bold;">Grand Total :</span></strong></td>
    <td><strong><span style="float:right; font-weight:bold;">
      <?=number_format($grandTotal2=($tot_bank_earning_dept+$tot_dept_proj_cash_earning+
      	$tot_dept_proj_bkash_earning+$tot_dept_proj_nagad_earning));?>
      </span></strong></td>
    <td><strong><span style="float:right; font-weight:bold;">
      <? //echo $tot_bank_payable_dept_projj.'---'.$tot_dept_proj_cash_payable?>
      <?=(number_format($grandTotal=($tot_bank_payable_dept_projj+$tot_dept_proj_cash_payable+
      	                      $tot_dept_proj_bkash_payable+$tot_dept_proj_nagad_payable))>0)?
      number_format($grandTotal=($tot_bank_payable_dept_projj+$tot_dept_proj_cash_payable+$tot_dept_proj_bkash_payable+
      	$tot_dept_proj_nagad_payable)):'';?>
      </span></strong></td>
  </tr>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :<?=convertNumberMhafuz($grandTotal);?>
  </div>
</center>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="text-decoration:none; border-bottom:0px;"><div align="center" >
  <?php
$check_sql = 'select 1 from salary_lock where month='.$_POST['mon'].' and year='.$_POST['year'].' and tr_type="all_salary2"';

	$check_query2 = mysql_query($check_sql2);


	$last_check2 = mysql_num_rows($check_query2 );


	if($last_check2 >0){ ?>
        <!--<input name="lock" id="lock" type="submit" value="LOCKED" />-->
        <?php }else{ ?>
        <!--<input name="lock" id="lock" type="submit" value="LOCK" />-->
        <?php	}



  ?>
      </div></td>
  </tr>
</table>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <!-- <div style="float:left; width:20%; text-align:center; font-size:12px;">------------<br>Accounts</div> -->
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?








}



elseif($_POST['report']==552){

?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Festival Bonus of
      <?=$bonusName?>
      -
      <?=$_POST['year']?>
      <br />
      Summary Sheet</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?


$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');


  //echo date_format($test, 'M-Y');

?></td>
  </tr>
</table>
<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Cash Bonus</th>
  </tr>
  <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="40%" style="text-align:center">Bonus Amt</th>
    </tr>
    <?

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.cash_paid) as total_amt from salary_bonus a,salary_info s, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and a.PBI_ID=s.PBI_ID and
bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and a.pbi_job_location = proj.PROJECT_ID and a.cash_paid!=0 GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';
$jl_query1= mysql_query($jl_sql1 );

while($jl_result1 = mysql_fetch_object($jl_query1)){


?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=number_format($jl_result1->total_amt); $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?></td>
    </tr>
    <?

}


?>
    <?

$jl_sql = 'select dept.DEPT_DESC, sum(a.cash_paid) as total_amt from salary_bonus a,salary_info s, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and a.PBI_ID=s.PBI_ID and
bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID  and dept.DEPT_ID not in (13) and
a.cash_paid!=0 GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';
$jl_query= mysql_query($jl_sql );
while($jl_result = mysql_fetch_object($jl_query)){
?>
    <? if($jl_result->total_amt>0){?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=number_format($jl_result->total_amt); $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt;?></td>
    </tr>
    <? } ?>
    <? } ?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:70%;">In Word :
    <?
 echo convertNumberMhafuz($tot_dept_proj);

 ?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>


<?

}
elseif($_POST['report']==8888){

?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?
$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
echo date_format($test, 'M-Y');


?></td>
  </tr>
</table>
<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Cash Salary</th>
  </tr>
  <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="420%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_earning_cash from salary_attendence a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold"
and a.bank_or_cash ="1" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC ';



}else{




$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_earning_cash  from salary_attendence_lock a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and  a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash ="1" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';



}



$jl_query1= mysql_query($jl_sql1 );


while($jl_result1 = mysql_fetch_object($jl_query1)){

?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_earning)>0)? number_format($jl_result1->total_earning):'';; $all_proj_salary2_earning =$all_proj_salary2_earning + $jl_result1->total_earning;?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_amt)>0)? number_format($jl_result1->total_amt):''; $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?></td>
    </tr>
    <? } ?>
 <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');




 if($found==0){
 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_earning_cash,a.department
	from salary_attendence a, personnel_basic_info b, department dept
	where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and b.PBI_JOB_STATUS="In Service" and a.job_location=0 and a.remarks_details!="hold"
	and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash IN("1","5")  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.cash_amt) as total_earning_cash,a.department from salary_attendence_lock a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.department = dept.DEPT_ID and a.job_location=0 and a.remarks_details!="hold" and a.pay>0 and
 dept.DEPT_ID not in (13)  and a.bank_or_cash IN("1","5")  GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';




}

$jl_query= mysql_query($jl_sql );

while($jl_result = mysql_fetch_object($jl_query)){
$cash_earning_total_department = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and department="'.$jl_result->department.'" and year="'.$_POST['year'].'"');



?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash+$cash_earning_total_department):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning_cash+$cash_earning_total_department;?>
        <?//=(number_format($jl_result->total_earning)>0)? number_format($jl_result->total_earning):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_earning_cash;?>
        <? //=(number_format($jl_result->total_amt)>0)? number_format($jl_result->total_amt):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt; ?></td>
    </tr>
    <?




}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_earning=($all_dept_salary2_earning+$all_proj_salary2_earning));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?
 echo convertNumberMhafuz($tot_dept_proj);
?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>




  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>



<!-- ************************ Salary Summery Sheet (Bkash)    *********************** -->



<?

}
elseif($_POST['report']==8889){

?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?
$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
echo date_format($test, 'M-Y');


?></td>
  </tr>
</table>
<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Bkash Salary</th>
  </tr>
  <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="420%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bkash_amt) as total_earning_cash from salary_attendence a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold"
and a.bank_or_cash ="6" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC ';



}else{




$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bkash_amt) as total_earning_cash  from salary_attendence_lock a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and  a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash ="6" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';



}



$jl_query1= mysql_query($jl_sql1 );


while($jl_result1 = mysql_fetch_object($jl_query1)){

?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_earning)>0)? number_format($jl_result1->total_earning):'';; $all_proj_salary2_earning =$all_proj_salary2_earning + $jl_result1->total_earning;?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_amt)>0)? number_format($jl_result1->total_amt):''; $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?></td>
    </tr>
    <? } ?>
 <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');




 if($found==0){
 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bkash_amt) as total_earning_cash,a.department
	from salary_attendence a, personnel_basic_info b, department dept
	where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and b.PBI_JOB_STATUS="In Service" and a.job_location=0 and a.remarks_details!="hold"
	and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash IN("6")  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.bkash_amt) as total_earning_cash,a.department from salary_attendence_lock a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.department = dept.DEPT_ID and a.job_location=0 and a.remarks_details!="hold" and a.pay>0 and
 dept.DEPT_ID not in (13)  and a.bank_or_cash IN("6")  GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';




}

$jl_query= mysql_query($jl_sql );

while($jl_result = mysql_fetch_object($jl_query)){
$cash_earning_total_department = find_a_field('salary_attendence','sum(total_earning_cash)','mon="'.$_POST['mon'].'" and department="'.$jl_result->department.'" and year="'.$_POST['year'].'"');



?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash+$cash_earning_total_department):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning_cash+$cash_earning_total_department;?>
        <?//=(number_format($jl_result->total_earning)>0)? number_format($jl_result->total_earning):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_earning_cash;?>
        <? //=(number_format($jl_result->total_amt)>0)? number_format($jl_result->total_amt):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt; ?></td>
    </tr>
    <?




}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_earning=($all_dept_salary2_earning+$all_proj_salary2_earning));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?
 echo convertNumberMhafuz($tot_dept_proj);
?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>




  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>




<!-- ************************ Salary Summery Sheet (NAGAD)    *********************** -->



<?

}
elseif($_POST['report']==8890){

?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary Summary Sheet</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?
$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');
echo date_format($test, 'M-Y');


?></td>
  </tr>
</table>
<table width="70%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Nagad Salary</th>
  </tr>
  <table width="70%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">Net Salary</th>
      <th width="420%" style="text-align:center">Net Payable Salary</th>
    </tr>
    <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){

$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.nagad_amt) as total_earning_cash from salary_attendence a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.PBI_JOB_STATUS="In Service" and a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold"
and a.bank_or_cash ="7" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC ';



}else{




$jl_sql1 = 'select proj.PROJECT_DESC , sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.nagad_amt) as total_earning_cash  from salary_attendence_lock a, personnel_basic_info b, project proj
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and  a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" and a.bank_or_cash ="7" GROUP BY proj.PROJECT_ID order by proj.PROJECT_DESC';



}



$jl_query1= mysql_query($jl_sql1 );


while($jl_result1 = mysql_fetch_object($jl_query1)){

?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_earning)>0)? number_format($jl_result1->total_earning):'';; $all_proj_salary2_earning =$all_proj_salary2_earning + $jl_result1->total_earning;?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_amt)>0)? number_format($jl_result1->total_amt):''; $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?></td>
    </tr>
    <? } ?>
 <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');




 if($found==0){
 $jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.nagad_amt) as total_earning_cash,a.department
	from salary_attendence a, personnel_basic_info b, department dept
	where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and b.PBI_JOB_STATUS="In Service" and a.job_location=0 and a.remarks_details!="hold"
	and a.department = dept.DEPT_ID and a.pay>0 and dept.DEPT_ID not in (13)  and a.bank_or_cash IN("7")  GROUP BY dept.DEPT_ID order by dept.DEPT_DESC';


}else{


$jl_sql = 'select dept.DEPT_DESC, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(a.nagad_amt) as total_earning_cash,a.department from salary_attendence_lock a, personnel_basic_info b, department dept
where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and
a.department = dept.DEPT_ID and a.job_location=0 and a.remarks_details!="hold" and a.pay>0 and
 dept.DEPT_ID not in (13)  and a.bank_or_cash IN("7")  GROUP BY dept.DEPT_ID  order by dept.DEPT_DESC';




}

$jl_query= mysql_query($jl_sql );

while($jl_result = mysql_fetch_object($jl_query)){
$cash_earning_total_department = find_a_field('salary_attendence','sum(nagad_amt)','mon="'.$_POST['mon'].'" and
	department="'.$jl_result->department.'" and year="'.$_POST['year'].'"');



?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash+$cash_earning_total_department):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning_cash+$cash_earning_total_department;?>
        <?//=(number_format($jl_result->total_earning)>0)? number_format($jl_result->total_earning):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning_cash)>0)? number_format($jl_result->total_earning_cash):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_earning_cash;?>
        <? //=(number_format($jl_result->total_amt)>0)? number_format($jl_result->total_amt):''; $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt; ?></td>
    </tr>
    <?




}



?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_earning=($all_dept_salary2_earning+$all_proj_salary2_earning));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?
 echo convertNumberMhafuz($tot_dept_proj);
?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">------------<br>
    Audit</div>




  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>


<?
}

elseif($_POST['report']==3544){































































	$mon = $_POST['mon'];































	$new_mon =  $mon+1;































































    $tr_no = date($_POST['year'].$new_mon.'01');































































?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Salary cross check with account</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?































































































































$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');































































































  echo date_format($test, 'M-Y');















































































?></td>
  </tr>
</table>
<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Salary</th>
  </tr>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="20%" style="text-align:center">HR</th>
      <th width="420%" style="text-align:center">Accounts</th>
      <th width="420%" style="text-align:center">HR Deduction</th>
      <th width="420%" style="text-align:center">Accounts Deduction</th>
      <th width="420%" style="text-align:center">Compare</th>
    </tr>
    <?































































































 $jl_sql1 = 'select proj.PROJECT_DESC ,proj.account_ledger,a.job_location, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(total_deduction) as t_d from salary_attendence_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and  a.job_location = proj.PROJECT_ID and a.pay>0 and a.remarks_details!="hold" GROUP BY proj.PROJECT_ID';































































































$jl_query1= mysql_query($jl_sql1 );































































































while($jl_result1 = mysql_fetch_object($jl_query1)){































































?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->total_amt)>0)? number_format($jl_result1->total_amt):'';; $all_proj_salary2_earning =$all_proj_salary2_earning + $jl_result1->total_amt;?></td>
      <td style="text-align:right"><?































              //$sj = 'select dr_amt from secondary_journal where tr_no="'.$tr_no.'" and ledger_id="'.$jl_result1->account_ledger.'" ';































               $acc_total_p = find_a_field('secondary_journal','dr_amt','tr_no="'.$tr_no.'" and ledger_id="'.$jl_result1->account_ledger.'"');































































               echo number_format($acc_total_p );































































































               $all_proj_salary2 = $all_proj_salary2+$acc_total_p;































































        	?></td>
      <td style="text-align:right"><?=(number_format($jl_result1->t_d)>0)? number_format($jl_result1->t_d):'';; $all_proj_td_earning =$all_proj_td_earning + $jl_result1->t_d;?></td>
      <td style="text-align:right"><?































           $ssqq2 = 'select sum(absent_deduction) as absent,sum(late_deduction) as late,sum(lwp_deduction) as lwp,sum(hr_action_amt) as hr,sum(other_deduction) as other from salary_attendence where mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'" and job_location="'.$jl_result1->job_location.'"';































           $qrr2 = mysql_query($ssqq2);































          $cc2 = mysql_fetch_object($qrr2);































           	$total_ddd2 = $cc2->absent+$cc2->late+$cc2->lwp+$cc2->hr+$cc2->other;































           	$total_deduct2 =  $total_deduct2+$total_ddd2;































































           echo $total_ddd2;































           $total_ddd2 = 0;































         ?></td>
      <td style="text-align:right"><?=$compare1 = $acc_total_p-$jl_result1->total_amt;































          $tot_compare1 = $tot_compare1+$compare1;































         ?></td>
    </tr>
    <?































































}































































?>
    <?































































































































 $jl_sql = 'select dept.DEPT_DESC,dept.account_ledger,a.department, sum(a.total_payable) as total_amt,sum(a.total_earning) as total_earning,sum(total_deduction) as t_d  from salary_attendence_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].'  and  a.department = dept.DEPT_ID and a.job_location=0 and a.remarks_details!="hold" and a.pay>0 and dept.DEPT_ID not in (13)   GROUP BY dept.DEPT_ID  ';















































































$jl_query= mysql_query($jl_sql);































































while($jl_result = mysql_fetch_object($jl_query)){































































?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=(number_format($jl_result->total_earning)>0)? number_format($jl_result->total_earning):''; $all_dept_salary2_earning = $all_dept_salary2_earning + $jl_result->total_earning;?></td>
      <td style="text-align: right"><?































              //$sj = 'select dr_amt from secondary_journal where tr_no="'.$tr_no.'" and ledger_id="'.$jl_result1->account_ledger.'" ';































                $acc_total = find_a_field('secondary_journal','dr_amt','tr_no="'.$tr_no.'" and ledger_id="'.$jl_result->account_ledger.'"');































               echo number_format($acc_total,0);































































               $all_dept_salary2 = $all_dept_salary2+$acc_total;































        	?></td>
      <td style="text-align: right"><?=(number_format($jl_result->t_d)>0)? number_format($jl_result->t_d):''; $all_dept_td_earning = $all_dept_td_earning + $jl_result->t_d;?></td>
      <td style="text-align:right"><?































           $ssqq = 'select sum(absent_deduction) as absent,sum(late_deduction) as late,sum(lwp_deduction) as lwp,sum(hr_action_amt) as hr,sum(other_deduction) as other from salary_attendence where mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'" and department="'.$jl_result->department.'"';































           $qrr = mysql_query($ssqq);































          $cc = mysql_fetch_object($qrr);































           	$total_ddd = $cc->absent+$cc->late+$cc->lwp+$cc->hr+$cc->other;































           	$total_deduct1 =  $total_deduct1+$total_ddd;































































           echo $total_ddd;































           $total_ddd = 0;































         ?></td>
      <td style="text-align: right"><?=$compare2 = $acc_total-$jl_result->total_earning;































             $tot_compare2 = $tot_compare2+$compare2;































        	?></td>
    </tr>
    <?































































}































































































































?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj_earning=($all_dept_salary2_earning+$all_proj_salary2_earning));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($total_deduct_td=($all_dept_td_earning+$all_proj_td_earning));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($total_deduct_final=($total_deduct1+$total_deduct2));?>
        </strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_compare_dept_proj=($tot_compare1+$tot_compare2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?































































































































 echo convertNumberMhafuz($tot_dept_proj);































































































 ?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>
<?































































































































}































































































elseif($_POST['report']==21213){































































?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Bonus Summary</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?































$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');































  echo date_format($test, 'M-Y');































?></td>
  </tr>
</table>
<table width="50%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
  <tr bordercolor="#FFFFFF">
    <th width="100%" colspan="2" style="text-align:center">Festival Bonus Summary</th>
  </tr>
  <table width="50%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;">
    <tr>
      <th width="60%" style="text-align:center">Job Location</th>
      <th width="40%" style="text-align:center">Salary Amount</th>
    </tr>
    <?































































  $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.bonus_amt) as total_amt from salary_bonus a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and a.pbi_job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_ID';































$jl_query1= mysql_query($jl_sql1 );































































while($jl_result1 = mysql_fetch_object($jl_query1)){































































































?>
    <tr>
      <td><?=$jl_result1->PROJECT_DESC?></td>
      <td style="text-align:right"><?=number_format($jl_result1->total_amt); $all_proj_salary2 =$all_proj_salary2 + $jl_result1->total_amt;?></td>
    </tr>
    <?































}































?>
    <?































   $jl_sql = 'select dept.DEPT_DESC, sum(a.bonus_amt) as total_amt from salary_bonus a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and a.bonus_type='.$_POST['bonus_type'].' and year='.$_POST['year'].' and a.pbi_department = dept.DEPT_ID and dept.DEPT_ID not in (3,4,1,8,13,14,16)  GROUP BY dept.DEPT_ID  ';































































$jl_query= mysql_query($jl_sql );































































while($jl_result = mysql_fetch_object($jl_query)){































































































?>
    <tr>
      <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
      <td style="text-align: right"><?=number_format($jl_result->total_amt); $all_dept_salary2 = $all_dept_salary2 + $jl_result->total_amt;?></td>
    </tr>
    <?































}































?>
    <tr>
      <td align="left"><strong>Total</strong></td>
      <td style="text-align:right"><strong>
        <?=number_format($tot_dept_proj=($all_dept_salary2+$all_proj_salary2));?>
        </strong></td>
    </tr>
  </table>
</table>
<p></p>
<p></p>
<center>
  <div  style="font-size:10px; font-weight:bold; width:60%;">In Word :
    <?































 echo convertNumberMhafuz($tot_dept_proj);































 ?>
  </div>
</center>
<br>
</br>
<div style="width:70%; margin:0 auto">
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-----------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center; font-size:12px;">-----------<br>
    Chairman</div>
</div>



<?
}if($_POST['report']==779){?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="0" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px;"  /></td>
      <td style="border:0px; padding-right:100px" colspan="30" align="center"><?=$str?></td>
    </tr>
    <tr>
      <th>Debit Account</th>
      <th>Voucher/E-mail</th>
      <th>BATCH</th>
      <th>Benificiary. Name</th>
      <th align="center"><div align="center">Credit Account/Card</div></th>
      <th>Txn Type</th>
      <th>Bank Name</th>
      <th>Routing No</th>
      <th><div align="center">Pay Amount</div></th>
      <th>Remarks/Narration</th>
    </tr>
  </thead>
  <tbody>
    <?


if($_POST['JOB_LOCATION']!='')
$advice_con.=' and t.pbi_job_location ="'.$_POST['JOB_LOCATION'].'"';




if($_POST['department']!='')





$advice_con.=' and t.pbi_department ="'.$_POST['department'].'"';





$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');

if($found==0){
if($_POST['mon']<10 && $_POST['year']<=2017){

 $sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,
proj.PROJECT_DESC,dept.DEPT_DESC
from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj,department dept





where t.job_location=proj.PROJECT_ID and t.department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].'
and t.PBI_ID=a.PBI_ID '.$advice_con.' and t.bank_or_cash in (2,3,4) order by proj.PROJECT_DESC asc ,dept.DEPT_DESC asc,t.total_payable desc';







}else{


 $sqld = 'select t.*, a.PBI_NAME,t.bonus_amt,i.cash, i.card_no,i.cash_bank,proj.PROJECT_DESC


from salary_bonus t,designation d, personnel_basic_info a, salary_info i,project proj
where t.pbi_job_location=proj.PROJECT_ID and i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and t.bank_or_cash NOT IN (1,6) and t.pbi_designation = d.DESG_ID and
t.bonus_type='.$_POST['bonus_type'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' order by proj.PROJECT_DESC asc ,t.bonus_amt desc';




}







}else{





if($_POST['mon']<10 && $_POST['year']<=2017){



$sqld = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank
from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i

where i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' and
t.bank_or_cash in (2,3,4) order by (t.total_payable - i.cash_amt) desc';

}else{


$sqld = 'select t.*, a.PBI_NAME,t.bonus_amt,i.cash, i.card_no,i.cash_bank,proj.PROJECT_DESC
from salary_bonus_lock t,designation d, personnel_basic_info a, salary_info i,project proj
where t.pbi_job_location=proj.PROJECT_ID and i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and t.bank_or_cash NOT IN (1,6) and t.pbi_designation = d.DESG_ID and t.bonus_type='.$_POST['bonus_type'].' and
 t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$advice_con.' order by proj.PROJECT_DESC asc ,t.bonus_amt desc';


}
}


$queryd=mysql_query($sqld);
ini_set('memory_limit', '-1');

while($data = mysql_fetch_object($queryd)){
$entry_by=$data->entry_by;
$total_proj_credit = $total_proj_credit+$data->bonus_amt;
?>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
      <td></td>
      <td></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <?
if ($data->cash_bank==2) {
?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->cash>0)? $data->cash : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } elseif($data->cash_bank==3){?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->card_no>0)? $data->card_no : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? }elseif($data->cash_bank==4){ ?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->cash>0)? $data->cash : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data->card_no>0)? $data->card_no : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } ?>
      <?
 if ($data->cash_bank==2) {
?>
      <td><div align="center">EBLACT</div></td>
      <? } elseif($data->cash_bank==3){?>
      <td><div align="center">EBLCDP</div></td>
      <? }elseif($data->cash_bank==4){?>
      <td><div align="center">EBLACT</div></td>
      <td><div align="center">EBLCDP</div></td>
      <? } ?>
      <td><div align="center">EBL</div></td>
      <td></td>
      <td><div align="center">
          <?=number_format($data->bonus_amt,0)?>
        </div></td>
      <td><div align="center">Festival Bonus</div></td>
    </tr>
    <?

}

?>
    <?
$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($found==0){
if($_POST['mon']<10 && $_POST['year']<=2017){
$sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank,
 dept.DEPT_DESC,proj.PROJECT_DESC


from salary_attendence t,designation d, personnel_basic_info a, salary_info i,project proj,department dept
where t.job_location=proj.PROJECT_ID and t.department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and
t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and t.bank_or_cash in (2,3,4) order by proj.PROJECT_DESC asc ,dept.DEPT_DESC asc,t.total_payable desc';

}else{

$sqld2 = 'select t.*,  a.PBI_NAME, i.cash, i.card_no, i.cash_bank,i.cash_amt,i.bank_amt,i.gross_salary,dept.DEPT_DESC
from salary_bonus t,designation d, personnel_basic_info a, salary_info i, department dept
where t.pbi_department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and t.bank_or_cash NOT IN (1,6) and t.pbi_designation = d.DESG_ID and t.bonus_type='.$_POST['bonus_type'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID and t.pbi_department not in (13) '.$advice_con.'  order by dept.DEPT_DESC asc ,t.bonus_amt desc';


}

}else{

if($_POST['mon']<10 && $_POST['year']<=2017){
 $sqld2 = 'select t.*, a.PBI_ID, a.PBI_NAME, a.PBI_DESIGNATION , a.PBI_DEPARTMENT, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,i.cash_amt, i.bank_amt, i.cash_bank


from salary_attendence_lock t,designation d, personnel_basic_info a, salary_info i


where i.PBI_ID = t.PBI_ID and t.pay>0 and a.PBI_DESIGNATION = d.DESG_ID and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID '.$con.' and


t.bank_or_cash in (2,3,4,5) order by (t.total_payable - i.cash_amt) desc';


}else{

echo $sqld2 = 'select t.*,  a.PBI_NAME, i.cash, i.card_no, i.cash_bank,i.cash_amt,i.bank_amt,i.gross_salary
from salary_bonus t,designation d, personnel_basic_info a, salary_info i, department dept
where t.pbi_department=dept.DEPT_ID and i.PBI_ID = t.PBI_ID and t.bonus_amt>0 and t.bank_or_cash NOT IN (1,6) and t.pbi_designation = d.DESG_ID and t.bonus_type='.$_POST['bonus_type'].' and
t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID and t.pbi_department not in (13) '.$advice_con.'  order by dept.DEPT_ID asc ,t.bonus_amt desc';

}



}


$queryd2=mysql_query($sqld2);


ini_set('memory_limit', '-1');


while($data2 = mysql_fetch_object($queryd2)){


$entry_by=$data2->entry_by;


$total_dept_credit = $total_dept_credit+$data2->bank_paid+$data2->payroll_card_paid;


?>
    <tr>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white">&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td style="border:0px solid white">&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td>&nbsp;&nbsp;&nbsp;1141290217238&nbsp;&nbsp;&nbsp;</td>
      <? } ?>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;" align="left"><?=$data2->PBI_NAME?></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;" align="left"><?=$data2->PBI_NAME?></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td nowrap="nowrap"><?=$data2->PBI_NAME?></td>
      <? } ?>
      <?
if ($data2->cash_bank==2) {


?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data2->cash>0)? $data2->cash : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? } elseif($data2->cash_bank==3){?>
      <td align="right">&nbsp;&nbsp;&nbsp;
        <?=($data2->card_no>0)? $data2->card_no : '';?>
        &nbsp;&nbsp;&nbsp;</td>
      <? }elseif($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;" align="right">&nbsp;&nbsp;&nbsp;
              <?=($data2->cash>0)? $data2->cash : '';?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td style="border: 0px solid white;" align="right">&nbsp;&nbsp;&nbsp;
              <?=($data2->card_no>0)? $data2->card_no : '';?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table></td>
      <? }elseif($data2->cash_bank==5) {  ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;" align="right">&nbsp;&nbsp;&nbsp;
              <?=($data2->cash>0)? $data2->cash : '';?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table></td>
      <? } ?>
      <?

if ($data2->cash_bank==2) {
 ?>
      <td><div align="center">EBLACT</div></td>
      <? } elseif($data2->cash_bank==3){?>
      <td><div align="center">EBLCDP</div></td>
      <? }elseif($data2->cash_bank==4){?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBLACT</div></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBLCDP</div></td>
          </tr>
        </table></td>
      <? }elseif($data2->cash_bank==5){  ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBLACT</div></td>
          </tr>
        </table></td>
      <? } ?>
      <!-- End bank and cash no 5 -->
      <? if($data2->cash_bank==5){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">EBL</div></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td><div align="center">EBL</div></td>
      <? } ?>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }elseif($data2->cash_bank==5){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td></td>
      <? } ?>
      <?  if($data2->cash_bank == 2){ $bank_amount2 = $data2->bonus_amt;?>
      <td><div align="center">
          <?=number_format($data2->bonus_amt,0)?>
        </div></td>
      <?  }elseif($data2->cash_bank == 5){ $bank_amount3 = $data2->bank_paid; ?>
      <td><table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">
                <?=number_format($data2->bank_paid ,0) ?>
              </div></td>
          </tr>
        </table></td>
      <? }elseif($data2->cash_bank == 3){  $bank_amount2 = $data2->bonus_amt - $data2->cash_amt;?>
      <td><div align="center">
          <?=number_format($data2->bonus_amt,0);?>
        </div></td>
      <? }elseif($data2->cash_bank == 4){  $bank_amount2 = $data2->bonus_amt;
$payroll_percent = ($data2->cash_amt*100)/$data2->gross_salary;
$bank_percent = ($data2->bank_amt*100)/$data2->gross_salary;
$payroll_amt = ($data2->bonus_amt*$payroll_percent)/100;
$bank_ammt = ($data2->bonus_amt*$bank_percent)/100;

 ?>
      <td><table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border: 0px solid white;"><div align="center">
                <?=number_format($bank_ammt,0) ?>
              </div></td>
          </tr>
          <tr>
            <td style="border: 0px solid white;"><div align="center">
                <?=number_format($payroll_amt,0);?>
              </div></td>
          </tr>
        </table></td>
      <? } ?>
      <? if($data2->cash_bank==4){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"><div align="center">Festival Bonus</div></td>
          </tr>
          <tr>
            <td style="border:0px solid white"><div align="center">Festival Bonus</div></td>
          </tr>
        </table></td>
      <? }elseif($data2->cash_bank==5){ ?>
      <td><table border="0"  cellpadding="0" cellspacing="0" align="center" style="width: 100%; border: 0px solid white;">
          <tr>
            <td style="border:0px solid white"><div align="center">Festival Bonus</div></td>
          </tr>
        </table></td>
      <? }else{ ?>
      <td><div align="center">Festival Bonus</div></td>
      <? } ?>
    </tr>
    <?

$total_cash2 = $total_cash2 + $bank_amount2;

}






$total_cash2=$total_cash2+$total_cash;



$total_amount = $total_proj_credit+ $total_dept_credit;


?>
    <tr>
      <td colspan="8" align="right">Total:</td>
      <td colspan="2"><b>
        <?=($total_amount>0)? number_format($total_amount) : '';?>
        </b></td>
    </tr>
  </tbody>
</table>
In Words:
<?


echo convertNumberMhafuz($total_amount);


?>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:25%; text-align:center">-------------------<br>
    Chairman</div>
</div>
<?



}




if($_POST['report']==780)































































{































































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tr>
    <td style="border:0px; width:0px; "align="center"></td>
    <td style="border:0px;" colspan="0" align="left"><img src="../../img/company_logo.png" style="height:100px; width:65px; margin-left:-30px;"  /></td>
    <td style="border:0px; padding-right:120px" colspan="29" align="center"><?=$str?></td>
  </tr>
  <tr>
    <th rowspan="3"><div align="center">S/L</div></th>
    <th rowspan="3"><div align="center">ID</div></th>
    <th rowspan="3"><div align="center">Name</div></th>
    <th rowspan="3"><div align="center">Designation</div></th>
    <th rowspan="3" nowrap="nowrap"><div align="center">Joining Date</div></th>
    <th rowspan="3"><div align="center">Job Period</div></th>
    <th colspan="2" align="center"><div align="center">Salary</div></th>
    <th rowspan="3"><div align="center">Bonus (Basic) %</div></th>
    <th rowspan="3"><div align="center">Bonus Amount</div></th>
    <th rowspan="3"><div align="center">Remarks</div></th>
  </tr>
  <tr>
    <th><div align="center">Gross</div></th>
    <th><div align="center">Basic</div></th>
  </tr>
  <tr>
    <th><div align="center">100%</div></th>
    <th><div align="center">50%</div></th>
  </tr>
  </thead>
  <tbody>
    <?















































if($_POST['branch']!='')































































$cons.=' and a.PBI_BRANCH ="'.$_POST['branch'].'"';































































if($_POST['JOB_LOCATION']!='')






$cons.=' and b.pbi_job_location ="'.$_POST['JOB_LOCATION'].'"';
if($_POST['department']!='')

$cons.=' and b.pbi_department ="'.$_POST['department'].'"';
$found = find_a_field('salary_bonus','lock_status','bonus_type="'.$_POST['bonus_type'].'" and year="'.$_POST['year'].'"');







    if($found==0){


$sqld="select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, d.DESG_SHORT_NAME as designation, a.PBI_DOJ as joining_date,
b.job_period,b.gross_salary,b.basic_salary,b.bonus_percent,b.cash_paid as bonus_amt,if(s.cash_bank='Estern Bank Limited',s.cash,'') as bank_ac,
s.card_no,s.cash_amt,s.basic_salary_cash from personnel_basic_info a, salary_bonus b, salary_info s, designation d
where b.bonus_percent not like 0 and 1 and b.pbi_designation=d.DESG_ID and a.PBI_ID=b.PBI_ID and s.PBI_ID=b.PBI_ID and
b.cash_paid!=0 and b.bonus_type=".$_POST['bonus_type']." and


b.year=".$_POST['year']." ".$cons. " order by b.bonus_amt desc";
}else{


$sqld="select a.PBI_ID,a.PBI_CODE, a.PBI_NAME, d.DESG_SHORT_NAME as designation, a.PBI_DOJ as joining_date,b.job_period,
b.gross_salary,b.basic_salary,b.bonus_percent,b.cash_paid as bonus_amt from personnel_basic_info a, salary_bonus_lock b, designation d
where b.bonus_percent not like 0 and 1 and b.pbi_designation=d.DESG_ID and a.PBI_ID=b.PBI_ID
and b.cash_paid!=0 and b.bonus_type=".$_POST['bonus_type']." and b.year=".$_POST['year']." ".$cons. " order by b.bonus_amt desc";
}



$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
$salary_given_status=find_a_field('salary_info','cash_bank','PBI_ID="'.$data->PBI_ID.'"');
$entry_by=$data->entry_by;

$basic_salary_cash = $data->bonus_amt/$data->bonus_percent*100;
$gross_salary_cash = $data->bonus_amt/$data->bonus_percent*100*2;
//Total
$gross = $gross+$data->gross_salary+$gross_salary_cash;
$basis = $basis+$data->basic_salary+$basic_salary_cash;




?>
    <tr>
      <td align="center"><?=++$s?></td>
      <td align="center"><?=$data->PBI_CODE?></td>
      <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
      <td nowrap="nowrap"><?=$data->designation?></td>
      <td align="center"><?=date('d-M-Y',strtotime($data->joining_date));?></td>
      <td nowrap="nowrap" align="center"><?=$data->job_period?></td>
      <? if($salary_given_status=='5'){     ?>
      <td align="right"><?=(number_format($gross_salary_cash,0)>0)? number_format($gross_salary_cash,0) : '';   $total_gross_sal +=$gross_salary_cash; ?></td>
      <?   }else{   ?>
      <td align="right"><?=(number_format($data->gross_salary,0)>0)? number_format($data->gross_salary,0) : ''; $total_gross_sal +=$data->gross_salary; ?></td>

      <?     }   ?>
      <? if($salary_given_status=='5'){     ?>
      <td align="right"><?=(number_format($basic_salary_cash,0)>0)? number_format($basic_salary_cash,0) : '';   $total_basic_sal +=$basic_salary_cash;?></td>
      <?   }else{   ?>
      <td align="right"><?=(number_format($data->basic_salary,0)>0)? number_format($data->basic_salary,0) : ''; $total_basic_sal +=$data->basic_salary; ?></td>
      <?     }   ?>
      <td align="center"><?=$data->bonus_percent?></td>
      <td align="right"><?=(number_format($data->bonus_amt,0)>0)? number_format($data->bonus_amt,0) : '';      $totalBonus+=$data->bonus_amt;?></td>
      <td style="">&nbsp;</td>
    </tr>
    <? } ?>
    <tr>
      <td colspan="6" align="right">Total:</td>
      <td align="right"><strong><?=number_format($total_gross_sal,0)?></strong></td>
      <td align="right"><strong><?=number_format($total_basic_sal,0)?></strong></td>
      <td>&nbsp;</td>
      <td align="right"><strong><?=number_format($totalBonus,0)?></strong></td>
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
<?
}































if($_POST['report']==781)































































{















































?>
<table cellspacing="0" cellpadding="0"  border="0" align="center">
  <tr>
  <thead>
    <tr>
      <td colspan="9" style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
    </tr>
    <tr>
      <td colspan="9" style="text-align: center;border:0px solid white; font-size:18px;"><?php echo find_a_field('department','DEPT_SHORT_NAME','DEPT_ID='.$_POST['department']);?><?php echo find_a_field('project','PROJECT_DESC','PROJECT_ID='.$_POST['JOB_LOCATION']);?></td>
    </tr>
    <tr>
    <tr>
      <td style="border:0px; font-size:16px;" colspan="9" align="center">Billing Period
        <?















































$test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');















































$_SESSION['year'] = $_POST['year'] ;















































  echo date_format($test, 'M-Y');















































?>
        <div class="date"><?php echo "Reporting Time:". date("h:i A d-m-Y")?></div></td>
    </tr>
  <th><div align="center">SL</div></th>
    <th><div align="center">ID No</div></th>
    <th><div align="center">NAME</div></th>
    <th><div align="center" style="width:auto;">Designation</div></th>
    <th><div align="center">Mobile No</div></th>
    <th><div align="center">Limit</div></th>
    <th><div align="center">Billing Amount</div></th>
    <th><div align="center">Deduction from Salary</div></th>
    <th><div align="center">Remarks</div></th>
  </tr></thead>
  <tbody>
    <?

$found = find_a_field('salary_attendence','lock_status','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');
if($found==0){
if($_POST['PBI_ORG']!='')
$mobileCon =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';
if ($_POST['JOB_LOCATION'] !='')
$mobileCon .= ' and t.job_location='.$_POST['JOB_LOCATION'];


if ($_POST['department'] !='')
$mobileCon .= ' and t.department='.$_POST['department'];


if ($_POST['job_status'] !='')



$mobileCon .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';



$sqld = 'select t.*,t.mobile_bill_amt as billing_amount,t.mobile_deduction as deduction, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation,
	 a.PBI_MOBILE as mobile_no, i.cash_amt

	 from salary_attendence t,designation d, personnel_basic_info a, salary_info i


 where i.PBI_ID = t.PBI_ID and t.designation = d.DESG_ID  and t.mon='.$_POST['mon'].' and t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID and
 a.PBI_MOBILE>0 '.$mobileCon.' order by a.PBI_MOBILE asc';


}else{
if($_POST['PBI_ORG']!='')
$mobileCon =' and a.PBI_ORG = "'.$_POST['PBI_ORG'].'"';

if ($_POST['JOB_LOCATION'] !='')
$mobileCon .= ' and t.job_location='.$_POST['JOB_LOCATION'];



if ($_POST['department'] !='')
$mobileCon .= ' and t.department='.$_POST['department'];

if ($_POST['job_status'] !='')



$mobileCon .=' and a.PBI_JOB_STATUS="'.$_POST['job_status'].'"';


$sqld = 'select t.*, a.PBI_ID,a.PBI_CODE, a.PBI_NAME, a.PBI_DOJ, d.DESG_SHORT_NAME as Designation, i.cash_amt

 from mobile_bill_lock t,designation d, personnel_basic_info a, salary_info i
 where i.PBI_ID = t.PBI_ID  and t.designation = d.DESG_ID and t.billing_amount>0 and t.mon='.$_POST['mon'].' and
 t.year='.$_POST['year'].' and t.PBI_ID=a.PBI_ID  '.$mobileCon.' order by a.PBI_MOBILE asc';

}



$queryd=mysql_query($sqld);


while($data = mysql_fetch_object($queryd)){


$entry_by=$data->entry_by;






?>
  <td nowrap="nowrap"><?=++$j?></td>
    <td nowrap="nowrap"><?=$data->PBI_CODE?></td>
    <td nowrap="nowrap"><?=$data->PBI_NAME?></td>
    <td align="left"><?=$data->Designation?></td>
    <td><?=$data->mobile_no?></td>
    <td><div align="center"><? echo ($data->mobile_bill_limit>0)? $data->mobile_bill_limit : '';$total_mobile_bill_limit =$total_mobile_bill_limit + $data->mobile_bill_limit;?></div></td>
    <td><div align="center">
        <?=($data->billing_amount>0)? $data->billing_amount : ''; $total_mobile_bill =$total_mobile_bill+ $data->billing_amount;?>
      </div></td>
    <td><div align="center">
        <?=($data->deduction>0)? $data->deduction : '';$total_mobile_deduction=$total_mobile_deduction+$data->deduction;?>
      </div></td>
    <?php















































       if($data->deduction>0){ ?>
    <td>Deduction From Salary</td>
    <?php } else{ ?>
    <td>&nbsp;







      &nbsp;







      &nbsp;







      &nbsp;







      &nbsp;







      &nbsp;</td>
    <?php }  ?>
  </tr><?















































}































?>
  <tr>
    <td colspan="4" ></td>
    <!--<td align="right"><?=($total_cash>0)? $total_cash : '';?></td>-->
    <td align="right"><strong>Total:</strong></td>
    <td><strong>
      <div align="center">
        <?=$total_mobile_bill_limit;?>
      </div>
      </strong></td>
    <td><strong>
      <div align="center">
        <?= $total_mobile_bill;?>
      </div>
      </strong></td>
    <td><strong>
      <div align="center">
        <?=$total_mobile_deduction;?>
      </div>
      </strong></td>
    <td>&nbsp;</td>
  </tr>
  </tbody>
</table>
<br />
<div style="margin-left:300px; width:1170px" align="left">In Words:
  <?















































echo convertNumberMhafuz($total_mobile_bill);































?>
</div>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Chairman</div>
</div>
<?































































}















































if($_POST['report']==2244)































































{































































?>
<table  style="width:auto;margin: 0 auto; padding:0px;">
  <tr>
    <td style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:18px;"><strong>AKSID CORPORATION LIMITED</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white; font-size:15px;"><strong>Mobile Bill Summary</strong></td>
  </tr>
  <tr>
    <td style="text-align: center;border:0px solid white;"><?















   $test = new DateTime('01-'.$_POST['mon'].'-'.$_POST['year'].' ');







   echo date_format($test, 'F-Y');























   if($_POST['mon']==1){















    $last_m = 12;















    $last_y = $_POST['year']-1;















    }else{















    $last_m = $_POST['mon']-1;















    $last_y = $_POST['year'];















    }































   ?></td>
  </tr>
</table>
<table width="80%" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto; padding:0px; ">
  <tr>
    <th width="40%" style="text-align:center">Job Location</th>
    <th width="20%" style="text-align:center; ">Bill Amount</th>
    <th width="20%" style="text-align:center; ">Last Month Bill Amount</th>
    <th width="20%" style="text-align:center; ">Difference %</th>
  </tr>
  <?























 $found = find_a_field('salary_attendence','m_lock','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







 if($found==0){







 $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.mobile_bill_amt) as total_amt,a.job_location from salary_attendence a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and







 mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.JOB_LOCATION = proj.PROJECT_ID and b.PBI_JOB_STATUS="In Service" GROUP BY proj.PROJECT_DESC';







 }else{







 $jl_sql1 = 'select proj.PROJECT_DESC , sum(a.billing_amount) as total_amt,a.job_location from mobile_bill_lock a, personnel_basic_info b, project proj where a.PBI_ID = b.PBI_ID and







  mon='.$_POST['mon'].' and year='.$_POST['year'].' and a.job_location = proj.PROJECT_ID  GROUP BY proj.PROJECT_DESC';







 }























  $jl_query1= mysql_query($jl_sql1 );







  while($jl1_result1 = mysql_fetch_object($jl_query1)){















    if($found==0){















      $last_month_mobile_bill = find_a_field('salary_attendence','sum(mobile_bill_amt) as last_month_total_amt','mon="'.$last_m.'" and







      year="'.$last_y.'" and job_location="'.$jl1_result1->job_location.'" ');















    }else{















      $last_month_mobile_bill = find_a_field('mobile_bill_lock','sum(billing_amount) as last_month_total_amt','mon="'.$last_m.'" and







      year="'.$last_y.'" and job_location="'.$jl1_result1->job_location.'" ');















    }















   //Make Difference % between present and last month







    if($found==0){







      $dft_project = ($jl1_result1->total_amt/$last_month_mobile_bill-1)*100;















    }else{







      $dft_project = ($jl1_result1->total_amt/$last_month_mobile_bill-1)*100;















    }























     //condition for never show project that haved 0 figure















    if($jl1_result1->total_amt>0 || $last_month_mobile_bill>0){































  ?>
  <tr style="margin:0px;">
    <td style="margin:0px;"><?=$jl1_result1->PROJECT_DESC?></td>
    <td style="text-align:right"><?=number_format($jl1_result1->total_amt,2); $all_proj_salary =$all_proj_salary + $jl1_result1->total_amt;?></td>
    <td style="text-align:right"><?=number_format($last_month_mobile_bill,2); $all_last_month_proj_salary =$all_last_month_proj_salary + $last_month_mobile_bill;?></td>
    <td style="text-align: right"><?=number_format($dft_project,2);?></td>
  </tr>
  <?















     }}















     ?>
  <?















































   $found = find_a_field('salary_attendence','m_lock','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







   if($found==0){







   $jl_sql = 'select dept.DEPT_DESC, sum(a.mobile_bill_amt) as total_amt,a.department  from salary_attendence a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and b.PBI_DEPARTMENT = dept.DEPT_ID and dept.DEPT_ID not in (13) and a.job_location=0 and b.PBI_JOB_STATUS="In Service" GROUP BY dept.DEPT_DESC  ';







   }else{







   $jl_sql = 'select dept.DEPT_DESC, sum(a.billing_amount) as total_amt,a.department  from mobile_bill_lock a, personnel_basic_info b, department dept where a.PBI_ID = b.PBI_ID and mon='.$_POST['mon'].' and year='.$_POST['year'].' and a.department = dept.DEPT_ID and dept.DEPT_ID not in (13)  GROUP BY dept.DEPT_DESC  ';







   }















   $jl_query= mysql_query($jl_sql );







   while($jl_result = mysql_fetch_object($jl_query)){















    //for last month data start







    if($found==0){















      $last_month_mobile_bill_dept = find_a_field('salary_attendence','sum(mobile_bill_amt) as last_month_total_amt','mon="'.$last_m.'" and







      year="'.$last_y.'" and department="'.$jl_result->department.'" ');















    }else{















      $last_month_mobile_bill_dept = find_a_field('mobile_bill_lock','sum(billing_amount) as last_month_total_amt','mon="'.$last_m.'" and







      year="'.$last_y.'" and department="'.$jl_result->department.'" ');















    }















    //end last month data























    //Make Difference % between present and last month







    if($found==0){







      $dft_dept = ($jl_result->total_amt/$last_month_mobile_bill_dept-1)*100;















    }else{







      $dft_dept = ($jl_result->total_amt/$last_month_mobile_bill_dept-1)*100;















    }















    //condition for never show deparment that haved 0 figure















    if($jl_result->total_amt>0 || $last_month_mobile_bill_dept>0){















































   ?>
  <tr>
    <td style="text-align:left"><?=$jl_result->DEPT_DESC;?></td>
    <td style="text-align: right"><?=number_format($jl_result->total_amt,2); $all_dept_salary = $all_dept_salary + $jl_result->total_amt;?></td>
    <td style="text-align: right"><?=number_format($last_month_mobile_bill_dept,2); $all_last_dept_salary = $all_last_dept_salary + $last_month_mobile_bill_dept;?></td>
    <td style="text-align: right"><?=number_format($dft_dept,2);?></td>
  </tr>
  <? }}?>
  <tr>
    <td align="right"><strong>Total Paid Bill Amount</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($total=$all_dept_salary+$all_proj_salary,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($total_last_month=$all_last_dept_salary+$all_last_month_proj_salary,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($total_Difference=($total/$total_last_month-1)*100,2);?>
      </strong></td>
  </tr>
  <?php







     $found = find_a_field('salary_attendence','m_lock','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







     if($found==0){







     $deduction_query = "select sum(mobile_deduction) as mobile_deduction from salary_attendence where mon=".$_POST['mon']." and year=".$_POST['year']." ";







     }else{







     $deduction_query = "select sum(deduction) as mobile_deduction from mobile_bill_lock where mon=".$_POST['mon']." and year=".$_POST['year']." ";







     }































     $dd = mysql_query($deduction_query);







     $data = mysql_fetch_object($dd);















     //for last month salary deduction mobile bill















     $found = find_a_field('salary_attendence','m_lock','mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'"');







     if($found==0){







     $deduction_query2 = "select sum(mobile_deduction) as mobile_deduction_last from salary_attendence where mon=".$last_m." and year=".$last_y." ";







     }else{







     $deduction_query2 = "select sum(deduction) as mobile_deduction_last from mobile_bill_lock where mon=".$last_m." and year=".$last_y." ";







     }







     $dd2 = mysql_query($deduction_query2);







     $data2 = mysql_fetch_object($dd2);































     ?>
  <tr>
    <td align="right"><strong>Salary Deduction</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($tot_sal_ded=$data->mobile_deduction,2)?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($last_mo_tot_sal_ded=$data2->mobile_deduction_last,2)?>
      </strong></td>
    <td style="text-align:right"><strong>
      <? //=number_format($total_Difference_deduction=($tot_sal_ded/$last_mo_tot_sal_ded-1)*100,2);?>
      </strong></td>
  </tr>
  <tr>
  <tr>
    <td align="right"><strong>Company Actual Bill</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($Company_Actual_Bill=$total-$data->mobile_deduction,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($last_Company_Actual_Bill=$total_last_month-$data2->mobile_deduction_last,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <? //=number_format($total_Difference_actual=($Company_Actual_Bill/$last_Company_Actual_Bill-1)*100,2);?>
      </strong></td>
  </tr>
  <td align="right"><strong>Grand Total</strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($Grand_Total=$total_bill=$all_dept_salary+$all_proj_salary,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($Last_Grand_Total=$total_bill_last_month=$all_last_dept_salary+$all_last_month_proj_salary,2);?>
      </strong></td>
    <td style="text-align:right"><strong>
      <?=number_format($total_Difference_Grand_Total=($Grand_Total/$Last_Grand_Total-1)*100,2);?>
      </strong></td>
  </tr></table>
<br />
<div style=" margin-left:15%;" align="left">In Words:
  <?















































echo convertNumberMhafuz($total_bill);















































?>
</div>
<br>
<br>
<br>
<div style="width:100%; margin:0 auto">
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Prepared By</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Audit</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Accounts</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Managing Director</div>
  <div style="float:left; width:20%; text-align:center">-------------------<br>
    Chairman</div>
</div>
<?































}































































if($_POST['report']==8)































































{















































         $sql="select a.PBI_ID as CODE,a.PBI_NAME as Name,a.PBI_DESIGNATION as designation ,a.PBI_DEPARTMENT as department,a.PBI_GROUP as `Group`,a.PBI_DOJ as joining_date,a.PBI_DOJ_PP as PP_joining_date,(select AREA_NAME from area where AREA_CODE=a.PBI_AREA) as area,(select ZONE_NAME from zon where ZONE_CODE=a.PBI_ZONE) as zone,(select BRANCH_NAME from branch where BRANCH_ID=a.PBI_BRANCH) as Region,a.PBI_EDU_QUALIFICATION as qualification,a.PBI_MOBILE as mobile  from personnel_basic_info a where	1 ".$con." order by a.PBI_DOJ asc";















































$query = mysql_query($sql);































?>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <thead>
    <tr>
      <td style="border:0px;" colspan="11"><?=$str?></td>
    </tr>
    <tr>
      <th>S/L</th>
      <th>CODE</th>
      <th>Name</th>
      <th>Desg</th>
      <th>Dept</th>
      <th>Group</th>
      <th>Join_date</th>
      <th>PP_join_date</th>
      <th>Area</th>
      <th>Zone</th>
      <th>Region</th>
      <th>Qualification</th>
      <th>Mobile No</th>
      <th>Submit</th>
    </tr>
  </thead>
  <tbody>
    <?































































$ajax_page = "rd_issue_ajax.php";































































while($datas=mysql_fetch_row($query)){$s++;































































?>
    <tr>
      <td><?=$s?></td>
      <td><?=$datas[0]?></td>
      <td><?=$datas[1]?></td>
      <td><?=$datas[2]?></td>
      <td><?=$datas[3]?></td>
      <td><?=$datas[4]?></td>
      <td><?=$datas[5]?></td>
      <td><?=$datas[6]?></td>
      <td style="text-align:right"><?=$datas[7]?></td>
      <td style="text-align:right"><?=$datas[8]?></td>
      <td><?=$datas[9]?></td>
      <td><?=$datas[10]?></td>
      <td><input type="hidden" name="PBI_ID#<?=$datas[0]?>" id="PBI_ID#<?=$datas[0]?>" value="<?=$datas[0]?>" />
        <input name="mobile#<?=$datas[0]?>" type="hidden" id="mobile#<?=$datas[0]?>" value="<?=$datas[11]?>" /></td>
      <td><div id="po<?=$datas[0]?>">
          <input type="button" name="Change" value="Change" onclick="getData2('<?=$ajax_page?>', 'po<?=$datas[0]?>',document.getElementById('PBI_ID#<?=$datas[0]?>').value,document.getElementById('mobile#<?=$datas[0]?>').value);" />
        </div></td>
    </tr>
    <?































































}































































?>
  </tbody>
</table>
<?































































}































































elseif(isset($sql)&&$sql!='') {echo report_create($sql,1,$str);}































































?>
</div>
</form>
</body>
</html>
