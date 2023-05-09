<?php





session_start();





ob_start();





require "../../config/inc.all.php";

// ::::: Edit This Section ::::: 





$title='Salary and Allowance Information';			// Page Name and Page Title



$page="salary_information.php";		// PHP File Name



$input_page="employee_essential_information_input.php";



$root='hrm';



$table='salary_info';		// Database Table Name Mainly related to this page



$unique='id';			// Primary Key of this Database table



$shown='salary_type';				// For a New or Edit Data a must have data field



//do_calander('#ESSENTIAL_ISSUE_DATE');



// ::::: End Edit Section :::::



if(isset($_POST['button'])){







//$_SESSION['employee_selected'] = find_a_field('personnel_basic_info','PBI_CODE','PBI_ID="'.$_POST['employee_selected'].'"');



$required_id=find_a_field('personnel_basic_info','PBI_ID','PBI_ID='.$_SESSION['employee_selected']);



$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);



if($required_id>0)



$$unique = $_GET[$unique] = $required_id; 



else



$$unique = $_SESSION['employee_selected']=$pbi_new_code;







}



$crud      =new crud($table);



$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected'],' order by id desc limit 1');





if($required_id>0)





$$unique = $_GET[$unique] = $required_id;







if(isset($_POST[$shown]))





{	if(isset($_POST['insert']))





		{		


            


			 $_REQUEST['PBI_ID']=$_POST['PBI_ID']=$_SESSION['employee_selected'];





				$crud->insert();





				$type=1;





				$msg='New Entry Successfully Inserted.';





				unset($_POST);





				unset($$unique);





$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected'],' order by id desc limit 1');





if($required_id>0)





$$unique = $_GET[$unique] = $required_id;





		}





		





	//for Modify..................................





	if(isset($_POST['update']))





	{





				$crud->update($unique);





				$type=1;





	}





	//for Delete..................................

if(isset($_POST['delete']))





{		$condition=$unique."=".$$unique;		$crud->delete($condition);





		unset($$unique);





		echo '<script type="text/javascript">





parent.parent.document.location.href = "../'.$root.'/'.$page.'";





</script>';





		$type=1;





		$msg='Successfully Deleted.';





}





}







if(isset($$unique))





{





$condition=$unique."=".$$unique;





$data=db_fetch_object($table,$condition);





while (list($key, $value)=each($data))





{ $$key=$value;}





}

?>
<script type="text/javascript"> 





function DoNav(lk){





	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)





	}







	







	







function count()





{





var num=((document.getElementById('gross_salary').value)*1);





document.getElementById('basic_salary').value = ((num*50)/100);







document.getElementById('house_rent').value = ((num*25)/100);







document.getElementById('medical_allowance').value = ((num*15)/100);







document.getElementById('special_allowance').value = ((num*10)/100);







}





function SalCash()



{



var num=((document.getElementById('cash_amt').value)*1);



document.getElementById('basic_salary_cash').value = ((num*50)/100);







document.getElementById('house_rent_cash').value = ((num*25)/100);







document.getElementById('medical_allowance_cash').value = ((num*15)/100);







document.getElementById('special_allowance_cash').value = ((num*10)/100);







}

function SalBank()



{



var num=((document.getElementById('bank_amt').value)*1);



document.getElementById('basic_salary_bank').value = ((num*50)/100);







document.getElementById('house_rent_bank').value = ((num*25)/100);







document.getElementById('medical_allowance_bank').value = ((num*15)/100);







document.getElementById('special_allowance_bank').value = ((num*10)/100);







}



function mobileAppl()







	{







		var status = document.getElementById('mob_alw_app').value;







		if(status!="YES"){







		document.getElementById('mobile_allowance').setAttribute("readonly", "readonly");







		document.getElementById('mobile_allowance').value='0.00';}







		if(status=="YES"){







		document.getElementById('mobile_allowance').removeAttribute("readonly", "readonly");}







	}







	







function extraAllwAppl()







	{







		var status = document.getElementById('extra_allowance').value;







		if(status!="YES"){







		document.getElementById('food_allowance').setAttribute("readonly", "readonly");







		document.getElementById('other_allowance').setAttribute("readonly", "readonly");







		document.getElementById('transport_allowance').setAttribute("readonly", "readonly");}







		if(status=="YES"){







		document.getElementById('food_allowance').removeAttribute("readonly", "readonly");







		document.getElementById('other_allowance').removeAttribute("readonly", "readonly");







		document.getElementById('transport_allowance').removeAttribute("readonly", "readonly");}







	}





function overtimeAllwAppl()







	{







		var status = document.getElementById('overtime_applicable').value;







		if(status!="YES"){







		document.getElementById('overtime_hr_rate').setAttribute("readonly", "readonly");}







		if(status=="YES"){







		document.getElementById('overtime_hr_rate').removeAttribute("readonly", "readonly");}







	}







		







	window.onload= mobileAppl, extraAllwAppl, overtimeAllwAppl;	







	







	window.onload = function(){







			applyBank();







			onCash();







			}


function onCash()
{
if(document.getElementById('cash_amt_applicable').value!="YES"){
document.getElementById('cash_amt').setAttribute("readonly", "readonly");
document.getElementById('cash_amt').value='0.00';
document.getElementById('bank_amt').value='0.00';}
if(document.getElementById('cash_amt_applicable').value=="YES"){
document.getElementById('cash_amt').removeAttribute("readonly", "readonly");}
}



function calBank(){
var cash_amt = ((document.getElementById('cash_amt').value)*1);
var gr_salary = ((document.getElementById('gross_salary').value)*1);
document.getElementById('bank_amt').value = gr_salary-cash_amt
}

</script>
<style type="text/css">





<!--





.style1 {font-weight: bold}





-->


.openerp .oe_form_sheet_width {
    min-width: 650px;
    max-width: 930px;
    margin: 0 auto;
}


    </style>
<div class="right_col" role="main">
  <!-- Must not delete it ,this is main design header-->
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Salary and Allowance Information</h2>
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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="oe_view_manager oe_view_manager_current">
                  <? include('../../common/title_bar.php');?>
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
                              <? include('../../common/input_bar.php');?>
                          
                                <div class="oe_form_sheet oe_form_sheet_width">
                               
                                  <table  border="0" width="900" cellpadding="0" cellspacing="0" class="table table-bordered table-sm">
                                    <tbody>
                                      <tr class="oe_form_group_row">
                                        <td class="oe_form_group_cell">
										
										<table align="center" cellpadding="0" cellspacing="0" class="oe_form_group ">
                                            <tbody>
                                              <tr class="oe_form_group_row">
                                                <td class="oe_form_group_cell">
												
												
												
												<table align="center" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-sm">
                                                    <tbody>
													
													
                                                      <tr>
                                                        <td>Gross:</td>
                                                        <td><input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />
                                                          <input name="PBI_ID" id="PBI_ID" value="<?=$_SESSION['employee_selected']?>" type="hidden" />
                                                          <input name="salary_type" id="salary_type" value="Non-Consolidated" type="hidden" />
                                                          <input name="gross_salary" type="text" id="gross_salary" value="<?=$gross_salary;?>" onkeyup="count()"/></td>
														  
														  
                                                         <td><strong>Mobile Alw. applicable?</strong></td>
														 
                                                        <td><select name="mob_alw_app" id="mob_alw_app" onchange="mobileAppl()">
                                                            <option value="YES" <?=($mob_alw_app=='YES')?'selected':''?>>YES</option>
                                                            <option value="NO" <?=($mob_alw_app=='NO')?'selected':''?>>NO</option>
                                                          </select></td>
														  
                                                      </tr>
													  
													  
                                                      <tr class="oe_form_group_row">
                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;<strong>Basic 50%: </strong></td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="basic_salary" type="text" id="basic_salary" value="<?=$basic_salary;?>" readonly /></td>
                                                      
													  <td bgcolor="#E8E8E8" class="oe_form_group_cell">Mobile Limit:</td>
                                                      <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="mobile_allowance" type="text" id="mobile_allowance" value="<?=$mobile_allowance?>" /></td>
														
														
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;<strong>&nbsp;</strong>House Rent 25%: </strong></td>
                                                        <td class="oe_form_group_cell"><input name="house_rent" type="text" id="house_rent" value="<?=$house_rent?>" readonly /></td>
                                                      
													  
													    <td class="oe_form_group_cell"> Income Tax : </td>
                                                        <td class="oe_form_group_cell"><input name="income_tax" type="text" id="income_tax" value="<?=$income_tax?>" /></td>
													  
													  
													  
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;<strong>&nbsp;</strong>Medical 15%:</strong></td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="medical_allowance" type="text" id="medical_allowance" value="<?=$medical_allowance?>" readonly /></td>
                                                        
								    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><p style="width:170px"> Salary Given by :</p></td>
                                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="cash_bank" onchange="show()" id="cash_bank" required/>
                                                          
                                                          <option></option>
                                                          <option <?=($cash_bank=="1"?"Selected":"")?> value="1">Cash</option>
                                                          <option <?=($cash_bank=="2"?"Selected":"")?> value="2">Estern Bank Limited (Bank Account)</option>
                                                          <option <?=($cash_bank=="3"?"Selected":"")?> value="3">Estern Bank Limited (Payroll Card)</option>
                                                          <option <?=($cash_bank=="4"?"Selected":"")?> value="4">Estern Bank Limited (Bank Account + Payroll Card)</option>
                                                          <option <?=($cash_bank=="5"?"Selected":"")?> value="5">Estern Bank Limited (Bank Account + Cash)</option>
                                                          <option <?=($cash_bank=="6"?"Selected":"")?> value="6">Bkash</option>
                                                          <option <?=($cash_bank=="7"?"Selected":"")?> value="7">Nagad</option>
                                                          </select></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Conveyance 10%: </strong> </td>
                                                        <td class="oe_form_group_cell"><input name="special_allowance" type="text" id="special_allowance" value="<?=$special_allowance?>" readonly /></td>
                                                     
													    <td class="oe_form_group_cell"> Account No :</td>
                                                        <td class="oe_form_group_cell"><input name="cash" type="text" id="cash" value="<?=$cash?>" /></td>
														
                                                      </tr>
                                                      <tr class="oe_form_group_row">
													  
                                                      <!--  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Extra Allowance  : </td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="extra_allowance" id="extra_allowance" onchange="extraAllwAppl()">
                                                            <? if($extra_allowance!='') echo '<option selected="selected">'.$extra_allowance.'</option>';?>
                                                            <option>YES</option>
                                                            <option>NO</option>
                                                          </select></td>-->
														  
														  <td width="34%" bgcolor="#E8E8E8" class="oe_form_group_cell">
														  Overtime Applicable? :</td>
                                                        <td width="67%" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="overtime_applicable" id="overtime_applicable" onchange="overtimeAllwAppl()">
                                                            <? if($overtime_applicable!='') echo '<option selected="selected">'.$overtime_applicable.'</option>';?>
                                                            <option>NO</option>
                                                            <option>YES</option>
                                                          </select></td>
														  
										 <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;</strong></span>Card No: </td>
                                         <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="card_no" type="text" id="card_no" value="<?=$card_no?>" /></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
													  
                                                       <!-- <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Food Allowance :</td>
                                                        <td class="oe_form_group_cell"><input name="food_allowance" type="text" id="food_allowance" value="<?=$food_allowance?>" /></td>-->
														
									<td  class="oe_form_group_cell"> Overtime Hourly Rate: </td>
                                    <td class="oe_form_group_cell"><input name="overtime_hr_rate" type="text" id="overtime_hr_rate" value="<?=$overtime_hr_rate?>" /></td>
														
                                     <td  class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;</strong></span>Bkash No: </td>
                                     <td  class="oe_form_group_cell"><input name="bkash_no" type="text" id="bkash_no" value="<?=$bkash_no?>" /></td>
					
                                                      </tr>
                                                      <tr class="oe_form_group_row">
													  
                                               <!-- <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Transport Allowance  :</td>
                                                <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="transport_allowance" type="text" id="transport_allowance" value="<?=$transport_allowance?>" /></td>-->
												
												
						   <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"> <strong>&nbsp;</strong> PF :</td>
                           <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="pf" type="text" id="pf" value="<?=$pf?>" /></td>  
							
							 <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;</strong></span>Nagad No: </td>
                             <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="nagad_no" type="text" id="nagad_no" value="<?=$nagad_no?>" /></td>
												
              
                                                      </tr>
                                                      <tr class="oe_form_group_row">
													    
                                     <td  class="oe_form_group_cell"><strong>&nbsp;</strong>Group Insurance :</td>
                                     <td  class="oe_form_group_cell"><input name="group_insurance" type="text" id="group_insurance" value="<?=$group_insurance?>" /></td>
                                                        <!--<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Others Allowance  :</td>
                                                        <td class="oe_form_group_cell"><input name="other_allowance" type="text" id="other_allowance" value="<?=$other_allowance?>" /></td>-->
                                                        
														<td></td><td></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                      <!--  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Bonus Applicable? :</td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="bonus_applicable">
                                                            <? if($bonus_applicable!='') echo '<option selected="selected">'.$bonus_applicable.'</option>';?>
                                                            <option>YES</option>
                                                            <option>NO</option>
                                                          </select></td>-->
														  
													
														  
                                                      
                                                      </tr>
                                               
                                               
                                         <?php /*?>             <tr class="oe_form_group_row">
													  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"></td><td></td>
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Bonus Amount :</td>
                                                        <td class="oe_form_group_cell"><input name="bonus_amount" type="text" id="bonus_amount" value="<?=$bonus_amount?>" /></td>
                                                        <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong></span>Branch Info :</td>
                                                        <td class="oe_form_group_cell"><input name="branch_info" type="text" id="branch_info" value="<?=$branch_info?>" /></td>
														
														<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"></td><td></td>
														
                                                      </tr><?php */?>
													  
													  
                                                      <!-- ````````````````  ``````````  Hiding tax section ``````````````````````````````````````````````````-->
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="4" class="oe_form_group_cell oe_form_group_cell_label" style="background-color:#5A738E; color:#FFFFFF"><h2 align="center">For TAX Exempted</h2></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row" bgcolor="#E8E8E8">
                                                        <td colspan="3" class="oe_form_group_cell oe_form_group_cell_label">&nbsp; Cash Salary Amount Applicable</td>
                                                        <td class="oe_form_group_cell"><select name="cash_amt_applicable" onchange="onCash()" id="cash_amt_applicable">
                                                            <? if($cash_amt_applicable!='') echo '<option selected="selected">'.$cash_amt_applicable.'</option>';?>
                                                            <option>NO</option>
                                                            <option>YES</option>
                                                          </select></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp; Cash Amount</td>
                                                        <td class="oe_form_group_cell"><input name="cash_amt" type="text" id="cash_amt" value="<?=$cash_amt?>" onkeyup="calBank(),SalCash(),SalBank()"/></td>
                                                        <td class="oe_form_group_cell">&nbsp; Bank Amount</td>
                                                        <td class="oe_form_group_cell"><label>
                                                          <input name="bank_amt" type="text" id="bank_amt" value="<?=$bank_amt?>" onkeyup="SalBank()" readonly="" />
                                                          </label></td>
                                                      </tr>
                                                      <!--new section-->
                                                      <tr class="oe_form_group_row" bgcolor="#E8E8E8">
                                                        <td width="" colspan="1" class="oe_form_group_cell"><strong>&nbsp;</strong>Basic 50% :</td>
                                                        <td width="" class="oe_form_group_cell"><input name="basic_salary_cash" type="text" id="basic_salary_cash" value="<?=$basic_salary_cash;?>" readonly /></td>
                                                        <td width="" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Basic 50% :</span></td>
                                                        <td width="" class="oe_form_group_cell"><input name="basic_salary_bank" type="text" id="basic_salary_bank" value="<?=$basic_salary_bank;?>"  readonly /></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>House Rent 25%:</td>
                                                        <td class="oe_form_group_cell"><input name="house_rent_cash" type="text" id="house_rent_cash" value="<?=$house_rent_cash?>" readonly/></td>
                                                        <td  class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>House Rent 25%:</td>
                                                        <td class="oe_form_group_cell"><input name="house_rent_bank" type="text" id="house_rent_bank" value="<?=$house_rent_bank?>" readonly /></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Medical  15%:</td>
                                                        <td class="oe_form_group_cell"><input name="medical_allowance_cash" type="text" id="medical_allowance_cash" value="<?=$medical_allowance_cash?>" readonly /></td>
                                                        <td   class="oe_form_group_cell oe_form_group_cell_label">&nbsp;<strong>&nbsp;</strong>Medical  15%:</td>
                                                        <td class="oe_form_group_cell"><input name="medical_allowance_bank" type="text" id="medical_allowance_bank" value="<?=$medical_allowance_bank?>" readonly /></td>
                                                      </tr>
                                                      <tr class="oe_form_group_row">
                                                        <td colspan="1" bgcolor="#E8E8E8"  class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Conveyance  10%:</td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="special_allowance_cash" type="text" id="special_allowance_cash" value="<?=$special_allowance_cash?>" readonly /></td>
                                                        <td colspan="1" bgcolor="#E8E8E8"  class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Conveyance  10%:</td>
                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="special_allowance_bank" type="text" id="special_allowance_bank" value="<?=$special_allowance_bank?>" readonly /></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
												  
												  </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                  
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <script>

function show(){
var x = document.getElementById("cash_bank").value;
if(x=="1"){
document.getElementById("cash").setAttribute("readonly", "readonly");
document.getElementById("card_no").setAttribute("readonly", "readonly");
document.getElementById("bkash_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").setAttribute("readonly", "readonly");

}else if(x=="2"){
document.getElementById("cash").removeAttribute("readonly", "readonly");
document.getElementById("card_no").setAttribute("readonly", "readonly");
document.getElementById("bkash_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").setAttribute("readonly", "readonly");


}else if(x=="3"){
document.getElementById("cash").setAttribute("readonly", "readonly");
document.getElementById("card_no").removeAttribute("readonly", "readonly");
document.getElementById("bkash_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").setAttribute("readonly", "readonly");

}

else if(x=="4"){
document.getElementById("cash").removeAttribute("readonly", "readonly");
document.getElementById("card_no").removeAttribute("readonly", "readonly");
document.getElementById("bkash_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").setAttribute("readonly", "readonly");
}


else if(x=="6"){
document.getElementById("cash").setAttribute("readonly", "readonly");
document.getElementById("card_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").setAttribute("readonly", "readonly");
document.getElementById("bkash_no").removeAttribute("readonly", "readonly");
}


else if(x=="7"){
document.getElementById("cash").setAttribute("readonly", "readonly");
document.getElementById("card_no").setAttribute("readonly", "readonly");
document.getElementById("bkash_no").setAttribute("readonly", "readonly");
document.getElementById("nagad_no").removeAttribute("readonly", "readonly");
}


else{
document.getElementById("cash").removeAttribute("readonly", "readonly");
document.getElementById("card_no").removeAttribute("readonly", "readonly");


}}

window.onload = show;



</script>
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
