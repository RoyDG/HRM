<?php
	require_once "../../../assets/template/layout.top.php";

	$title = 'Salary and Allowance Information';

	$page = "salary_information.php";

	$input_page = "employee_essential_information_input.php";

	$root = 'payroll';

	$table = 'salary_info';    // Database Table Name Mainly related to this page

	$unique = 'id';            // Primary Key of this Database table

	$shown = 'basic_salary';    // For a New or Edit Data a must have data field

	$crud = new crud($table);

	$image_path = find_all_field('personnel_basic_info', '', 'PBI_ID="' . $_SESSION['employee_selected'] . '"');

	$required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected'], ' order by id desc limit 1');
	



	if ($required_id > 0)
		$$unique = $_GET[$unique] = $required_id;


	if (isset($_POST['button'])) {
		//$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');
		$_SESSION['employee_selected'] = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE="' . $_POST['employee_selected'] . '"');
	}


	if (isset($_POST['reset'])) {
		//$pbi = find_a_field('personnel_basic_info','PBI_ID','PBI_CODE="'.$_POST['employee_selected'].'"');
		unset($_SESSION['employee_selected']);
	}	


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





<!--	Body Starts From Here	-->



<form action="" method="post" id="form" enctype="multipart/form-data">
	<div class="form-container_large">

        <? include('../../common/title_bar.php');
        do_calander('#comm_till_date'); ?>

		
		
        <header class="pb-4">

			<? if(!isset($_GET[$unique])){?>
				<span class="oe_form_buttons_edit" style="display: inline;">
					<button 
							name="insert" accesskey="S" class="btn1 btn1-bg-submit" type="submit">
						Save
					</button>
				</span>
			<? }?>



			<? if(isset($_GET[$unique])){?>
				<span class="oe_form_buttons_edit" style="display: inline;">
			  		<button 
							name="update" accesskey="S" class=" btn1 btn1-bg-submit" type="submit">
						Update
					</button>
				</span>
			<? }?>

			<!--<span class="oe_form_buttons_edit" style="display: inline;">
				<button 
						name="reset" style="background-color: #aa5629 !important;" class="btn1 btn1-bg-cancel" type="submit" onclick="parent.parent.GB_hide();">
					Reset
				</button>
			</span>-->

			

			<? if(isset($_GET[$unique])){?>
				<span class="oe_form_buttons_edit" style="display: inline;">
					<button 
							name="delete" accesskey="S" class="btn1 btn1-bg-cancel" type="submit">
						Delete
					</button>
				</span>
			<? }?>
		   	<div class="oe_clear"></div>
			
		</header>
		
		
		

        <h4 class="text-center bg-titel bold pt-2 pb-2">
			Payroll Info Setup
		</h4>
		
        <div class="container-fluid bg-form-titel">
            <div class="row">


                <!--left form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">
						
						

                       <div class="form-group row m-0 pb-1">
							<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Salary Type :
						   	</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<input 
									   name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" class="form-control" />
								
								<input 
									   name="PBI_ID" id="PBI_ID" value="<?= $_SESSION['employee_selected'] ?>" type="hidden" />
								
								<select 
										name="salary_type" class="form-control" onchange="toggleSalary(this)" required>
									
										<option <?= ($salary_type == 'Non-Consolidated') ? 'selected' : '' ?>>
											Non-Consolidated
										</option>
									
										<option <?= ($salary_type == 'Consolidated') ? 'selected' : '' ?>>
											Consolidated
										</option>
								</select>
							</div>
						</div>
						
						
						
						
						<div class="form-group row m-0 pb-1">
							  <label 
									 class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Tax Applicable :
							  </label>
							  <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
									<select 
											name="tax_status" id="tax_status" class="form-control" onchange="toggleTax(this)">
											<option <?= ($tax_status == 'YES') ? 'selected' : '' ?>>YES</option>
											<option <?= ($tax_status == 'NO') ? 'selected' : '' ?>>NO</option>
										  	
									</select>
							 </div>
						</div>
						
						
						
						
						<div class="form-group row m-0 pb-1">
							<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								PF Applicable :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
								 <select 
										  name="pf_status" id="pf_status" class="form-control" onchange="togglePF(this)">
										<option <?= ($pf_status == 'NO') ? 'selected' : '' ?>>NO</option>
										<option <?= ($pf_status == 'YES') ? 'selected' : '' ?>>YES</option>
								</select>
							</div>
						</div>
						
						
						
						
						<div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Consolidated Salary :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">

                                <input 
									   name="consolidated_salary" type="text" id="consolidated_salary" oninput="updateTotalSalary()" value="<?= $consolidated_salary ?>" class="form-control" />
                            </div>
                      	</div>
						
						
						
						
						
																							

						<div class="form-group row m-0 pb-1">
							<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Gross Salary :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">	
								<input 
									   name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />
								
								<input 
									   name="gross_salary" type="text" id="gross-salary" class="form-control" oninput="calculateSalary()" value="<?= $gross_salary ?>" />	
							</div>
						</div>

						
						
						

                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Basic Salary :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />

                                <input 
									   type="hidden" id="gender" 
									   value="<?= find_a_field('personnel_basic_info', 'PBI_SEX', 'PBI_ID=' . $_SESSION['employee_selected']); ?>" />

                                <input 
									   type="text" name="basic_salary" id="basic-salary" class="form-control" readonly="" value="<?= $basic_salary ?>" />
                            </div>
                        </div>
						



                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								House Rent :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="house_rent" type="text" id="house_rent" class="form-control" readonly="" value="<?= $house_rent ?>" />
                            </div>
                        </div>
						



                      	<div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Medical Allowance :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="medical_allowance" type="text" id="medical_allowance" readonly="" value="<?= $medical_allowance ?>" class="form-control" />
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Conveyance Allowance:
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="ta" type="text" id="convenience" class="form-control" readonly="" value="<?= $ta ?>" />
                            </div>
                        </div>
						
						
						
						

						
						
						
						
						<div class="form-group row m-0 pb-1">
							<label 
									class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Monthly Income Tax :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
								<input 
										name="income_tax" type="text" id="monthly_tax" min="0" value="<?= $income_tax; ?>" class="form-control console" disabled />
								<span id="salary-after-tax"></span>
							</div>
						</div>
						
						
						
						
						<div class="form-group row m-0 pb-1">
							<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Personal PF :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
							  <input 
									 name="pf" type="text" id="personal-pf" value="<?=$pf?>"  class="form-control" disabled/>
							</div>
						</div>
						

						<div class="form-group row m-0 pb-1">
							<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Company PF :
							</label>
							<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2">
							  <input 
									 name="pf_company" type="text" id="company-pf" value="<?=$pf_company?>" class="form-control" disabled/>
							</div>
						</div>				
						
                    </div>
                </div>




						
				

                <!--Right form-->

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="container n-form2">


                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Overtime Applicable :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select 
										name="overtime_applicable" id="overtime_applicable" class="form-control">
                                    <option <?= ($overtime_applicable == 'NO') ? 'selected' : '' ?>>NO</option>

                                    <option <?= ($overtime_applicable == 'YES') ? 'selected' : '' ?>>YES</option>        
                                </select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                        	<label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Bank Name :
							</label>
                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
								<select 
										name="bank_name" id="bank_name" class="form-control">
										<option></option>
										<? 
										foreign_relation('bank','BANK_CODE','BANK_NAME',$bank_name,' 1 order by BANK_NAME');
										?>
								</select>
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Account No :
							</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="ac_no" type="text" id="ac_no" value="<?= $ac_no ?>" class="form-control" />
                            </div>
                        </div>



                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Salary Given by :
							</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <select 
										name="cash_bank" id="cash_bank" class="form-control" onchange="calculateAmount()">

                                    	<option <?=($cash_bank=='Cash')?'selected':'';?> value="Cash">Cash</option>
										<option <?=($cash_bank=='Both')?'selected':'';?> value="Both">Bank & Cash</option>
										<option <?=($cash_bank=='Bank')?'selected':'';?> value="Bank">Bank</option>	  
                                </select>
                            </div>
                        </div>


                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Cash Paid :
							</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="cash_amt" type="text" id="cash_amt" onkeyup="calculateAmount()" value="<?= $cash_amt ?>" />
                            </div>
                        </div>


                        <div class="form-group row m-0 pb-1">
                            <label 
								   class="col-sm-4 col-md-4 col-lg-4 col-xl-4 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
								Bank Paid :
							</label>

                            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 p-0 pr-2 ">
                                <input 
									   name="bank_amt" type="text" id="bank_amt" value="<?= $bank_amt ?>" />
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>

     <br>
     <br>



		
        <div class="container-fluid bg-form-titel">
            <div class="row">

   	           	<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group row m-0">
						<label 
							   class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text">
							Total Salary :
						</label>
						<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
							 <input 
									name="total_salary" type="text" id="total_salary" class="form-control" value="<?= $total_salary ?>" readonly />
						</div>
					</div>
				</div>



				<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="form-group row m-0">
						<label 
							   class="col-sm-3 col-md-3 col-lg-3 col-xl-3 m-0 p-0 d-flex justify-content-end align-items-center pr-1 bg-form-titel-text"> 
							Total Payable :
						</label>
						<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 p-0">
							<input 
								   name="total_payable" type="text" id="total-payable" value="<?= $total_payable ?>" readonly class="form-control" />
						</div>
					</div>
				</div>

            </div>
        </div>
    </div>
</form>

<!--	Body Ends Here	-->











<!--	All Script Files Starts From Here	-->



<script>
	
	// Salary type selecting Function
	
	function toggleSalary(selectElement) {
		
	  var grossSalaryInput = document.getElementById('gross-salary');
	  var consolidatedSalaryInput = document.getElementById('consolidated_salary');

	  if (selectElement.value === 'Consolidated') {
			grossSalaryInput.disabled = true;
			consolidatedSalaryInput.disabled = false;
	  } 
		else {
			grossSalaryInput.disabled = false;
			consolidatedSalaryInput.disabled = true;
	  }
	}
	
	window.addEventListener('DOMContentLoaded', function() {
		
	  	var salaryTypeSelect = document.getElementsByName('salary_type')[0];
	  	toggleSalary(salaryTypeSelect);
		
	});
	

	
	
	
	// PF selectionToggle Function
	
	function togglePF(selectElement) {
		
		var personalPFInput = document.getElementById('personal-pf');
		var companyPFInput = document.getElementById('company-pf');

		if (selectElement.value === 'YES') {
		  	personalPFInput.disabled = false;
		  	companyPFInput.disabled = false;
		} 
		  else {
			personalPFInput.disabled = true;
		  	companyPFInput.disabled = true;
		  	personalPFInput.value = '0';
		  	companyPFInput.value = '0';
		}
	}
	
	
	
	
	// TAX selectionToggle Function	
	
	function toggleTax(selectElement) {
		
	  var monthlyTaxInput = document.getElementById('monthly_tax');

	  if (selectElement.value === 'YES') {
			monthlyTaxInput.disabled = false;
	  } 
		else {
			monthlyTaxInput.disabled = true;
			monthlyTaxInput.value = '0';
	  }
	}	
	
</script>






<script>
	
	// Bank paid and Cash paid Calculations are here
	
	function calculateAmount() {

	  var payable = ((document.getElementById("total-payable").value)*1);
	  var paymentType = document.getElementById("cash_bank").value;
	  var cashAmount = document.getElementById("cash_amt");
	  var bankAmount = document.getElementById("bank_amt");

	  if (paymentType === "Cash") {
			cashAmount.value = payable;
			bankAmount.value = "";
	  } 
		else if (paymentType === "Bank") {
			cashAmount.value = "";
			bankAmount.value = payable;
	  }
		else if (paymentType === "Both") {

			var cashInput = document.getElementById("cash_amt").value*1;
			var cashAmt = Number(cashInput); 
			var bankAmt = payable - cashAmt; 

			cashAmount.value = cashAmt;
			bankAmount.value = bankAmt;
	  } 
		else {
			cashAmount.value = "";
			bankAmount.value = "";
	  }
	}
	
	window.addEventListener("load", function() {
	  calculateAmount();
	});
	
</script>










<script>
	
// Tax, TotalPayable and other payable For GrossSalary
	
	function calculateSalary() {
		
		var grossSalary = parseFloat(document.getElementById("gross-salary").value);
		
		var basicSalary = grossSalary * 0.571425;
		var houseRent = basicSalary * 0.5;
		var medicalAllowance = basicSalary * 0.1;
		var convenience = basicSalary * 0.15;
		
		var tax = 0;
		var personalPf = 0;
		var companyPf = 0;
		var pf = 0;

		var taxStatus = document.getElementById('tax_status').value;
		var pfStatus = document.getElementById('pf_status').value;
		var genders = document.getElementById('gender').value;
		
		
		if (pfStatus === 'YES') {
			personalPf = grossSalary * 0.05;
			companyPf = grossSalary * 0.05;
			pf = grossSalary * 0.1;
		}
		else if (pfStatus === 'NO'){
			pf = 0;
		}
		
		
		var maleTaxIncome = (basicSalary * 14) - 300000;
		var femaleTaxIncome = (basicSalary * 14) - 350000;

		if (taxStatus === 'YES') {
			if (genders === 'Male') {
				
				if (grossSalary < 80000 && maleTaxIncome > 0) {
					tax = maleTaxIncome * 0.05;
				} 
				else if (grossSalary < 150000 && maleTaxIncome > 0) {
					tax = maleTaxIncome * 0.075;
				} 
				else if (grossSalary >= 150000 && maleTaxIncome > 0) {
					tax = maleTaxIncome * 0.1;
				}
			} 
			
			else if (genders === 'Female') {
				
				if (grossSalary < 80000 && femaleTaxIncome > 0) {
					tax = femaleTaxIncome * 0.05;
				} 
				else if (grossSalary < 150000 && femaleTaxIncome > 0) {
					tax = femaleTaxIncome * 0.075;
				} 
				else if (grossSalary >= 150000 && femaleTaxIncome > 0) {
					tax = femaleTaxIncome * 0.1;
				}
			}
		}

		var monthlyTax = tax / 12;
		var totalSalary = grossSalary;
		var totalPayable = grossSalary - (pf + (tax / 12));

		document.getElementById("house_rent").value = Math.round(houseRent);
		document.getElementById("medical_allowance").value = Math.round(medicalAllowance);
		document.getElementById("convenience").value = Math.round(convenience);
		document.getElementById("basic-salary").value = Math.round(basicSalary);
		document.getElementById("monthly_tax").value = Math.round(monthlyTax);
		
		document.getElementById("personal-pf").value = Math.round(personalPf);
		document.getElementById("company-pf").value = Math.round(companyPf);
		
		document.getElementById("total_salary").value = Math.round(totalSalary);
		document.getElementById("total-payable").value = Math.round(totalPayable);
	}
	
	
</script>








<script>
	
	// Tax, TotalPayable and other payable For ConsolidatedSalary
	
	function updateTotalSalary() {
		
    var consolidatedSalary = parseFloat(document.getElementById("consolidated_salary").value);
		
    var tax = 0;
	var personalPf = 0;
	var companyPf = 0;
    var pf = 0;
		
    var taxStatus = document.getElementById('tax_status').value;
    var genders = document.getElementById('gender').value;
    var pfStatus = document.getElementById('pf_status').value;
		
    var maleTaxIncome = (consolidatedSalary * 12) - 300000;
    var femaleTaxIncome = (consolidatedSalary * 12) - 350000;
		
			
	if (pfStatus === 'YES') {
		personalPf = consolidatedSalary * 0.05;
		companyPf = consolidatedSalary * 0.05;
		pf = consolidatedSalary * 0.1;
		}
		else if(pfStatus === 'NO'){
			pf = 0;
		}	
	
		
    if (taxStatus === 'YES') {
        if (genders === 'Male') {
            if (consolidatedSalary < 80000 && maleTaxIncome > 0) {
                tax = maleTaxIncome * 0.05;
            } 
			else if (consolidatedSalary < 150000 && maleTaxIncome > 0) {
                tax = maleTaxIncome * 0.075;
            } 
			else if (consolidatedSalary >= 150000 && maleTaxIncome > 0) {
                tax = maleTaxIncome * 0.1;
            }
        } 
		
		else if (genders === 'Female') {
            if (consolidatedSalary < 80000 && femaleTaxIncome > 0) {
                tax = femaleTaxIncome * 0.05;
            } 
			else if (consolidatedSalary < 150000 && femaleTaxIncome > 0) {
                tax = femaleTaxIncome * 0.075;
            } 
			else if (consolidatedSalary >= 150000 && femaleTaxIncome > 0) {
                tax = femaleTaxIncome * 0.1;
            }
        }
    }
		
		

    var monthlyTax = tax / 12;
    var totalSalary = consolidatedSalary;
    var totalPayable = consolidatedSalary - (pf + (tax / 12));
		
    
    document.getElementById("monthly_tax").value = Math.round(monthlyTax);
    document.getElementById("total_salary").value = Math.round(totalSalary);
		
	document.getElementById("personal-pf").value = Math.round(personalPf);
	document.getElementById("company-pf").value = Math.round(companyPf);
		
    document.getElementById("total-payable").value = Math.round(totalPayable);
}


</script>


<? require_once "../../../assets/template/layout.bottom.php"; ?>


<!--	Thanks for visiting my codes `RAHUL`	-->



