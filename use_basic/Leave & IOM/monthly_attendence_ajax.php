<?



session_start();



require_once "../../../assets/template/layout.top.php";







$crud = new crud('salary_attendence');



$unique = 'id';



 $mon=$_GET['mon'];



 $_POST['PBI_ID'] = $_GET['PBI_ID'];



$_POST['mon'] 	 = $_GET['mon'];



$_POST['year']   = $_GET['year'];



$_POST['td']     = $_GET['td'];



$_POST['od']     = $_GET['od'];



$_POST['hd']     = $_GET['hd'];



$_POST['lt']     = $_GET['lt'];



$_POST['ab']     = $_GET['ab'];



$_POST['lv']     = $_GET['lv'];



$_POST['pre']    = $_GET['pre'];



$_POST['pay']    = $_GET['pay'];



$_POST['ot']     = $_GET['ot'];



$_POST['salary_arrear']     = $_GET['benefits'];















$year=$_GET['year'];







if($mon == 1)



{



$syear = $year - 1;



$smon = 12;



}



else



{



$syear = $year;



$smon =  $mon - 1;



}











$datetime = date('Y-m-d H:i:s');



$s_date = $syear.'-'.($mon).'-01';



$startTime = $days1 = strtotime($s_date);



//$days_mon = date('t',$s_date);



$days_mon = 31;    // ------------------------------- Total Days of Month



//$days_mon = find_a_field('hrm_payroll_setup','value','type="daysofmonth"');



$da =  find_all_field('hrm_payroll_setup','',' `year` = "'.$year.'" and `mon` = "'.$mon.'" ');



$days_mon = date('t',strtotime($s_date));



//echo $days_mon;



$e_date   = $year.'-'.($mon).'-'.$days_mon;



$endTime = $days2=mktime(0,0,0,$mon,26,$year);











$basic_info = find_all_field('personnel_basic_info','','PBI_ID='.$_GET['PBI_ID']);





$joining_data = find_all_field_sql("SELECT PBI_ID, PBI_DOJ FROM personnel_basic_info WHERE PBI_ID='".$_GET['PBI_ID']."' and PBI_DOJ BETWEEN '".$s_date."' AND '".$e_date."' ");









//$_POST['fd'] = 5; // -----------------------------------TOTAL FRIDAY



//$_POST['fd'] = find_a_field('hrm_payroll_setup','value','type="friday"');



$_POST['fd'] = $da->friday_of_month;











$_POST['department'] = $basic_info->DEPT_ID;



$_POST['designation'] = $basic_info->DESG_ID;



$_POST['pbi_organization'] = $basic_info->PBI_ORG;



$_POST['branch'] = $basic_info->PBI_BRANCH;



$_POST['dept_group']=find_a_field('department_group','group_id','department="'.$basic_info->PBI_DEPARTMENT.'"');







//echo 'PBI_ID="'.$_POST['PBI_ID'].'" and mon="'.$_POST['mon'].'" and year="'.$_POST['year'].'" ';



$_POST[$unique] = $$unique = find_a_field('salary_attendence','id','PBI_ID="'.$_GET['PBI_ID'].'" and mon="'.$_GET['mon'].'" and year="'.$_GET['year'].'" ');







$salary = find_all_field('salary_info','','PBI_ID='.$_GET['PBI_ID']);



$_POST['basic_salary'] = $salary->basic_salary;



$_POST['basic_salary_payable'] = round((($salary->gross_salary/$days_mon)*$_GET['pay']));



$_POST['ta_da_data'] = $salary->ta;



$_POST['pf'] = $salary->pf;



$_POST['cpf'] = $salary->cpf;











//$salary_date=date('Y-m-d',mktime(0,0,0,$_POST['mon'],1,$_POST['year']));







$_POST['house_rent']=$salary->house_rent;







if($_POST['td']<$days_mon)



$_POST['house_rent']=$salary->house_rent = ($salary->house_rent/$days_mon)*$_GET['pay'];



else



$_POST['house_rent']=$salary->house_rent;







$_POST['medical_allowance']=$salary->medical_allowance;



$_POST['other_allowance']=$salary->others;



$_POST['mobile_allowance']=$salary->mobile_allowance;







$nnjoin_date  = strtotime($basic_info->PBI_DOJ);



$nnstart_date = strtotime($s_date);



$nnend_date = strtotime($e_date);



$datediff =  $nnjoin_date - $nnstart_date;















// ----------------------------------------------------- extra 2000 taka



$join_days = round($datediff / (60 * 60 * 24));



$ins_days = 90 + round($datediff / (60 * 60 * 24));















// ---------------------------------------------END Extra 2000 taka















$_POST['ta_da']=$salary->ta;







$_POST['food_allowance']=$salary->food_allowance;



$_POST['income_tax']=$salary->income_tax;



$_POST['gross_salary']=$salary->gross_salary;



$_POST['account_no']=$salary->cash;



$_POST['entertainment']=$salary->entertainment;





// JOINING DEDUCTION



if ($joining_data->PBI_ID>0) {



$joining_date = strtotime($joining_data->PBI_DOJ);

$month_first_date = strtotime($s_date);

$datediff = $joining_date - $month_first_date;

$joining_ab_days =  round($datediff / (60 * 60 * 24));



$_POST['joining_ab']=$joining_ab_days;

$_POST['joining_deduction']=((($salary->gross_salary)/(30))*($_POST['joining_ab']));

// OLD SYSTEM BEFORE AUDIT $_POST['joining_ab_deduction']=((($salary->basic_salary)/(30))*($_POST['joining_ab']));

}





$late_deduct_days = ((int) $_GET['lt'] /3);







//$_POST['over_time_amount']=round(((($salary->gross_salary)/240)*($_GET['ot'])));



$_POST['absent_deduction']=round(((($salary->gross_salary)/($days_mon))*(($_GET['lwp']+$_GET['ab']))+$_POST['joining_deduction']));



$_POST['late_deduction']=round(((($salary->basic_salary)/($days_mon))*($late_deduct_days)));







if($salary->food_allowance>0)



$_POST['food_allowance'] = $salary->food_allowance;



















$_POST['advance_install'] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$_GET['PBI_ID'].'" and current_mon="'.$_GET['mon'].'" and  	current_year="'.$_GET['year'].'" and  	advance_type="Advance Cash" ');







$_POST['motorcycle_install'] = find_a_field('motorcycle_install','sum(payable_amt)','PBI_ID="'.$_GET['PBI_ID'].'" and current_mon="'.$_GET['mon'].'" and  	current_year="'.$_GET['year'].'" and  	advance_type="Advance Cash" ');







$_POST['other_install'] = find_a_field('salary_advance','sum(payable_amt)','PBI_ID="'.$_GET['PBI_ID'].'" and current_mon="'.$_GET['mon'].'" and  	current_year="'.$_GET['year'].'" and  	advance_type="Other Advance" ');











if($_POST['bonus']=='No')



$_POST['bonus_amount']=0;



else



$_POST['bonus_amount'] = ($salary->consolidated_salary/2);
$_POST['administrative_deduction'] = find_a_field('hrm_admin_action_detail','sum(ADMIN_ACTION_AMT)','ADMIN_ACTION_DATE between "'.$s_date.'" and "'.$e_date.'" and PBI_ID="'.$_GET['PBI_ID'].'" ');
$_POST['total_salary'] = $_POST['gross_salary']+$_POST['salary_arrear'];
$_POST['total_deduction'] = $_POST['advance_install']+$_POST['other_install']+$_POST['deduction']+$_POST['income_tax']+$_POST['late_deduction']+$_POST['absent_deduction']+$_POST['pf'];
$_POST['total_benefits'] = $_POST['salary_arrear']+$_POST['over_time_amount'];
$_POST['total_payable'] = round((($_POST['gross_salary']) - $_POST['total_deduction']))+$_POST['total_benefits'];;











if($$unique>0)



{



$_POST['edit_by']=$_SESSION['user']['id'];



$_POST['edit_at']=date('Y-m-d H:i:s');



echo 'Updated!';



$crud->update($unique);



}



else



{



$_POST['entry_by']=$_SESSION['user']['id'];



$_POST['entry_at']=date('Y-m-d H:i:s');



echo 'Saved!';



$crud->insert();



}



?>