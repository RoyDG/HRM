<?php

require_once "../../../assets/template/layout.top.php";



if (isset($_POST['button'])) {

    //$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');

    $_SESSION['employee_selected'] = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="' . $_POST['employee_selected'] . '"');
}



if (isset($_POST['reset'])) {

    //$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');

    unset($_SESSION['employee_selected']);
}



// ::::: Edit This Section ::::: 



$title = 'Salary and Allowance Information';

$page = "salary_information.php";

$input_page = "employee_essential_information_input.php";

$root = 'hrm';

$table = 'salary_info';    // Database Table Name Mainly related to this page

$unique = 'id';            // Primary Key of this Database table

$shown = 'basic_salary';    // For a New or Edit Data a must have data field

$crud = new crud($table);

$image_path = find_all_field('personnel_basic_info', '', 'PBI_ID="' . $_SESSION['employee_selected'] . '"');

$required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected'], ' order by id desc limit 1');
if ($required_id > 0)
    $$unique = $_GET[$unique] = $required_id;





if (isset($_POST[$shown])) {

    if (isset($_POST['insert'])) {


        $_POST['PBI_ID'] = $_SESSION['employee_selected'];

        $crud->insert();

        $type = 1;

        $msg = 'New Entry Successfully Inserted.';

        unset($_POST);

        unset($$unique);



        $required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected'], ' order by id desc limit 1');

        if ($required_id > 0)

            $$unique = $_GET[$unique] = $required_id;
    }

    //for Modify..................................



    if (isset($_POST['update'])) {

        $crud->update($unique);

        $type = 1;
    }

    //for Delete..................................

    if (isset($_POST['delete'])) {

        $condition = $unique . "=" . $$unique;

        $crud->delete($condition);

        unset($$unique);

        echo '<script type="text/javascript">

		parent.parent.document.location.href = "../' . $root . '/' . $page . '";

		</script>';

        $type = 1;

        $msg = 'Successfully Deleted.';
    }
}





if (isset($$unique)) {

    $condition = $unique . "=" . $$unique;

    $data = db_fetch_object($table, $condition);

    while (list($key, $value) = each($data)) {

        $$key = $value;
    }
}

?>





<script type="text/javascript">
    function DoNav(lk) {

        return GB_show('ggg', '../pages/<?= $root ?>/<?= $input_page ?>?<?= $unique ?>=' + lk, 600, 940)

    }
</script>





<script>
    $(document).ready(function() {

        $('#vehicle_allowance_rules').click(function() {

            var rBtnVal = $(this).val();

            if (rBtnVal == "Fixed") {

                $("#vehicle_allowance").attr("readonly", false);

            } else {

                $("#vehicle_allowance").attr("readonly", true);

                $("#vehicle_allowance").val("0.00");

            }

        });

    });





    function fixed_comm() {

        var rBtnVal = document.getElementById('commission_type').value;

        if (rBtnVal == "Conditional") {

            document.getElementById('view').style.display = 'block';

        } else {

            document.getElementById('view').style.display = 'none';

        }

    }
</script>





<? do_calander('#security_amnt_till_date');

//do_calander('#action_complete_date');

?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-container_large">


        <? include('../../common/title_bar.php');
        do_calander('#comm_till_date'); ?>

        <? include('../../common/input_bar.php'); ?>



        <h4 class="text-center bg-titel bold pt-2 pb-2"> Select Options </h4>

        <div class="container-fluid bg-form-titel">

            <div class="row">



                <!--left form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="container n-form2">

                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Salary Type :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" class="form-control" />

                                <input name="PBI_ID" id="PBI_ID" value="<?= $_SESSION['employee_selected'] ?>" type="hidden" />



                                <select name="salary_type" class="form-control">

                                    <option></option>

                                    <option <?= ($salary_type == 'Consolidated') ? 'selected' : '' ?>>Consolidated</option>

                                    <option <?= ($salary_type == 'Non-Consolidated') ? 'selected' : '' ?>>Non-Consolidated</option>

                                </select>

                            </div>

                        </div>
											
						
						
						<div class="form-group row m-0 pb-1">
							
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Gross Salary :</label>
						

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">	
                                <input name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />
								           
                                <input name="gross_salary" type="text" id="gross-salary" class="form-control" oninput="calculateSalary()" value="<?= $gross_salary ?>" />								
                            </div>
							
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Basic :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />

                                <input type="hidden" id="gender" value="<?= find_a_field('personnel_basic_info', 'PBI_SEX', 'PBI_ID=' . $_SESSION['employee_selected']); ?>" />

                                <input type="text" name="basic_salary" id="basic-salary" class="form-control" readonly="" value="<?= $basic_salary ?>" />
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">House Rent :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="house_rent" type="text" id="house_rent" class="form-control" readonly="" value="<?= $house_rent ?>" />

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Medical Allowance :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="medical_allowance" type="text" id="medical_allowance" readonly="" value="<?= $medical_allowance ?>" class="form-control" />

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Conveyance Allowance :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="ta" type="text" id="convenience" class="form-control" readonly="" value="<?= $ta; ?>" />

                            </div>

                        </div>

                    </div>

                </div>





                <!--Right form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="container n-form2">





                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Consolidated Salary :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="consolidated_salary" type="text" id="consolidated_salary" value="<?= $consolidated_salary ?>" class="form-control" />

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Overtime Applicable? :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <select name="overtime_applicable" class="form-control">

                                    <option></option>

                                    <option <?= ($overtime_applicable == 'YES') ? 'selected' : '' ?>>YES</option>

                                    <option <?= ($overtime_applicable == 'NO') ? 'selected' : '' ?>>NO</option>

                                </select>

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Monthly Income Tax :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="income_tax" type="text" id="monthly_tax" min="0" value="<?= $income_tax; ?>" class="form-control console" /><span id="salary-after-tax"></span>

                            </div>

                        </div>









                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Account No :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="cash" type="text" id="cash" value="<?= $cash ?>" class="form-control" />

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Salary Given by :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <select name="cash_bank" id="cash_bank" class="form-control" onchange="calculateAmount()">

                                    <option></option>
										  <option <?=($cash_bank=='Bank')?'selected':'';?> value="Bank">Bank</option>

										  <option <?=($cash_bank=='Cash')?'selected':'';?> value="Cash">Cash</option>

										  <option <?=($cash_bank=='Both')?'selected':'';?> value="Both">Bank+Cash</option>

                                </select>

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Cash Paid :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="cash_amt" type="text" id="cash_amt" onkeyup="calculateAmount()" value="<?= $cash_amt ?>" />

                            </div>

                        </div>



                        <div class="form-group row m-0 pb-1">

                            <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Bank Paid :</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input name="bank_amt" type="text" id="bank_amt" value="<?= $bank_amt ?>" />

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>

        <br />



        <br>





        <div class="container-fluid bg-form-titel">

            <div class="row">



                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="form-group row m-0">

                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">Total Salary :</label>

                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">

                            <input name="total_salary" type="text" id="total_salary" class="form-control" readonly="" value="<?= $total_salary ?>" />

                        </div>

                    </div>

                </div>



                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

                    <div class="form-group row m-0">

                        <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> Total Payable :</label>
                        <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">

                            <input name="total_payable" type="text" id="total-payable" value="<?= $total_payable ?>" readonly="" class="form-control" />



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>





<script>
    function calculateSalary() {
        var grossSalary = parseFloat(document.getElementById("gross-salary").value);

        var basicSalary = grossSalary * 0.571425;

        var houseRent = basicSalary * 0.5;

        var medicalAllowance = basicSalary * 0.1;

        var convenience = basicSalary * 0.15;

        var tax;



        var genders = document.getElementById('gender').value;

        var male_tax_income = (basicSalary * 14) - 300000;

        var female_tax_income = (basicSalary * 14) - 350000;
		

        if (genders == 'Male') {
            if (grossSalary < 80000 && male_tax_income > 0) {

                tax = male_tax_income * 0.05;

            } else if (grossSalary < 150000 && male_tax_income > 0) {

                tax = male_tax_income * 0.075;

            } else if (grossSalary >= 150000 && male_tax_income > 0) {

                tax = male_tax_income * 0.1;

            } else {

                tax = 0;

            }

        } else if (genders == 'Female') {



            if (grossSalary < 80000 && female_tax_income > 0) {

                tax = female_tax_income * 0.05;

            } else if (grossSalary < 150000 && female_tax_income > 0) {

                tax = female_tax_income * 0.075;

            } else if (grossSalary >= 150000 && female_tax_income > 0) {

                tax = female_tax_income * 0.1;

            } else {

                tax = 0;

            }

        } else {

            tax = 0;

        }


        var monthly_tax = tax / 12;
		var totalSalary = grossSalary;
        var totalPayable = grossSalary - (tax / 12);
		

        document.getElementById("house_rent").value = Math.round(houseRent);

        document.getElementById("medical_allowance").value = Math.round(medicalAllowance);

        document.getElementById("convenience").value = Math.round(convenience);

        document.getElementById("basic-salary").value = Math.round(basicSalary);

        document.getElementById("monthly_tax").value = Math.round(monthly_tax);
		
		document.getElementById("total_salary").value = Math.round(totalSalary);

        document.getElementById("total-payable").value = Math.round(totalPayable);


        /*document.getElementById("house-rent").value = houseRent.toFixed(2);

        document.getElementById("medical-allowance").value = medicalAllowance.toFixed(2);

        document.getElementById("convenience").value = convenience.toFixed(2);

        document.getElementById("gross-salary").value = grossSalary.toFixed(2);

        document.getElementById("tax").value = tax.toFixed(2);

        document.getElementById("total-payable").value = totalPayable.toFixed(2);*/

    }
	
	
	
	
function calculateAmount() {
  var grossSalary = ((document.getElementById("gross-salary").value)*1);

  
  var paymentType = document.getElementById("cash_bank").value;
  //var totalAmount = document.getElementById("totalAmount");
  var cashAmount = document.getElementById("cash_amt");
  var bankAmount = document.getElementById("bank_amt");
  
  if (paymentType === "Cash") {
    cashAmount.value = grossSalary;
    bankAmount.value = "";

	
   
  } else if (paymentType === "Bank") {
    cashAmount.value = "";
	
    bankAmount.value = grossSalary;
  
  } else if (paymentType === "Both") {
   

        var cashInput = document.getElementById("cash_amt").value*1; // get the user input for cash amount
        
		var cashAmt = Number(cashInput); // convert user input to a number
        var bankAmt = grossSalary - cashAmt; // calculate bank amount
        
        cashAmount.value = cashAmt;
        bankAmount.value = bankAmt;
     
		
		
      
 
  } else {
    cashAmount.value = "";
    bankAmount.value = "";
	
   
  }
}

	
	
	
	
</script>



<? require_once "../../../assets/template/layout.bottom.php"; ?>