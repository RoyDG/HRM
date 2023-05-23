<?php
session_start();
ob_start();
require "../../config/inc.all.php";
require "../../template/main_layout.php";

require "ip_address_function.php";


// ::::: Edit This Section ::::: 
//Use this to search id


/* FUNCTION FOR USER IP ADDRESS*/


 

/**/

if(isset($_POST['button'])){

$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);

$_SESSION['employee_selected'] = $pbi_new_code;

}
$title='Job Status';			// Page Name and Page Title
$page="employee_essential_information.php";		// PHP File Name
$input_page="employee_essential_information_input.php";
$root='hrm';
$table='essential_info';		// Database Table Name Mainly related to this page
$unique='ESSENTIAL_ID';			// Primary Key of this Database table
$shown='PBI_ID';				// For a New or Edit Data a must have data field
do_calander('#ESSENTIAL_ISSUE_DATE');
do_calander('#ESSENTIAL_APPOINT_DATE');
do_calander('#ESSENTIAL_JOINING_DATE');
do_calander('#ESSENTIAL_CONFIRM_DATE');
do_calander('#ESSENTIAL_RESIG_DATE');
// ::::: End Edit Section :::::
$crud      =new crud($table);
//$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);
$required_id=find_a_field('essential_info','ESSENTIAL_ID','PBI_ID='.$_SESSION['employee_selected']);

$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);

$new_required_id=find_a_field('essential_info','ESSENTIAL_ID','PBI_ID='.$_SESSION['employee_selected']);



if($required_id>0)

$$unique = $_GET[$unique] = $required_id;



else



$$unique = $_GET[$unique]=$new_required_id;





if(isset($_POST['insert']))

{



 



 



	  if($_FILES['cv']['tmp_name']!=''){















	   $file_name= $_FILES['cv']['name'];















	   $file_tmp= $_FILES['cv']['tmp_name'];















	   $ext=end(explode('.',$file_name));















	   $path='../../pic/cv/';















	   move_uploaded_file($file_tmp, $path.$_SESSION['employee_selected'].'.pdf');



}







	







	if($_FILES['confirmation_letter']['tmp_name']!=''){















	   $file_name= $_FILES['confirmation_letter']['name'];















	   $file_tmp= $_FILES['confirmation_letter']['tmp_name'];















	   $ext=end(explode('.',$file_name));















	   $path='../../pic/confirmation_letter/';















	   move_uploaded_file($file_tmp, $path.$_SESSION['employee_selected'].'.pdf');















	}





			$_POST['PBI_ID'] =  $_SESSION['employee_selected'];

                

		







				//$crud->insert();



				

   				 $insert = 'INSERT INTO `essential_info` (`PBI_ID`, `ESSENTIAL_REF_NO`, `personal_file_status`, `U_ID`, `USED_DT`, `EMPLOYMENT_TYPE`, `ESS_DEPARTMENT`, `ESS_DESIGNATION`, `rep_auth_appl`, `ESSENTIAL_REPORTING`, `ESSENTIAL_PROJECT`, `ESSENTIAL_APPOINT_DATE`, `ESSENTIAL_JOINING_DATE`, `ESSENTIAL_CONFIRM_DATE`, `ESSENTIAL_RESIG_DATE`, `RE_JOIN_DATE`, `ESS_JOB_STATUS`, `ESS_RESP`,`ATTENDENCE_TYPE`,

				 `cc_code_for_casual_staff`,`acledger_for_salary_casual_staff`,`territory`,`relieving_cause`) 

				 

				 VALUES ("'.$_SESSION['employee_selected'].'", "'.$_POST['ESSENTIAL_REF_NO'].'", "'.$_POST['personal_file_status'].'", "'.$_POST['U_ID'].'","'.$_POST['USED_DT'].'","'.$_POST['EMPLOYMENT_TYPE'].'","'.$_POST['ESS_DEPARTMENT'].'","'.$_POST['ESS_DESIGNATION'].'","'.$_POST['rep_auth_appl'].'","'.$_POST['ESSENTIAL_REPORTING'].'","'.$_POST['ESSENTIAL_PROJECT'].'","'.$_POST['ESSENTIAL_APPOINT_DATE'].'","'.$_POST['ESSENTIAL_JOINING_DATE'].'","'.$_POST['ESSENTIAL_CONFIRM_DATE'].'","'.$_POST['ESSENTIAL_RESIG_DATE'].'","'.$_POST['RE_JOIN_DATE'].'","'.$_POST['ESS_JOB_STATUS'].'","'.$_POST['ESS_RESP'].'","'.$_POST['ATTENDENCE_TYPE'].'","'.$_POST['cc_code_for_casual_staff'].'",

				 "'.$_POST['acledger_for_salary_casual_staff'].'","'.$_POST['territory'].'","'.$_POST['relieving_cause'].'")';







                mysql_query($insert);







				$type=1;







				$msg='New Entry Successfully Inserted.';






$edit_by=$_SESSION['user']['id'];

				

$usql='update personnel_basic_info set PBI_DESIGNATION="'.$_POST['ESS_DESIGNATION'].'", PBI_DEPARTMENT="'.$_POST['ESS_DEPARTMENT'].'", PBI_DOJ="'.$_POST['ESSENTIAL_JOINING_DATE'].'",PBI_DOC="'.$_POST['ESSENTIAL_CONFIRM_DATE'].'", PBI_DOJ_PP="'.$_POST['ESSENTIAL_APPOINT_DATE'].'", PBI_JOB_STATUS="'.$_POST['ESS_JOB_STATUS'].'", JOB_LOCATION="'.$_POST['ESSENTIAL_PROJECT'].'" ,
edit_by="'.$edit_by.'" where PBI_ID='.$_SESSION['employee_selected'];







				mysql_query($usql);















				unset($_POST);















				unset($$unique);













$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);





$pbi_new_code_2 =find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);



$new_required_idd=find_a_field($table,$unique,'PBI_ID='.$pbi_new_code_2);





if($required_id>0)

$$unique = $_GET[$unique] = $required_id;

else

$$unique = $_GET[$unique] = $new_required_idd;











		}

















	//for Modify..................................















	if(isset($_POST['update']))















	{







	 







	     if($_FILES['cv']['tmp_name']!=''){















	   $file_name= $_FILES['cv']['name'];















	   $file_tmp= $_FILES['cv']['tmp_name'];















	   $ext=end(explode('.',$file_name));















	   $path='../../pic/cv/';















	   move_uploaded_file($file_tmp, $path.$_SESSION['employee_selected'].'.pdf');















	}







	







	if($_FILES['confirmation_letter']['tmp_name']!=''){















	   $file_name= $_FILES['confirmation_letter']['name'];















	   $file_tmp= $_FILES['confirmation_letter']['tmp_name'];















	   $ext=end(explode('.',$file_name));















	   $path='../../pic/confirmation_letter/';















	   move_uploaded_file($file_tmp, $path.$_SESSION['employee_selected'].'.pdf');















	}















				//$crud->update($unique);







             $ess_res = mysql_real_escape_string($_POST['ESS_RESP']);







				$type=1;


				

$edit_by=$_SESSION['user']['id'];
$ip_information = mysql_real_escape_string("IP Address: " .UserInfo::get_ip()."My OS: " .UserInfo::get_os()."My Device: " .UserInfo::get_device()."My browser: " .UserInfo::get_browser());
		


 $usql='update essential_info set EMPLOYMENT_TYPE="'.$_POST['EMPLOYMENT_TYPE'].'" ,ESS_JOB_STATUS="'.$_POST['ESS_JOB_STATUS'].'",ESS_DESIGNATION="'.$_POST['ESS_DESIGNATION'].'",rep_auth_appl="'.$_POST['rep_auth_appl'].'",ESSENTIAL_REPORTING="'.$_POST['ESSENTIAL_REPORTING'].'",ESS_DEPARTMENT="'.$_POST['ESS_DEPARTMENT'].'",ESSENTIAL_PROJECT="'.$_POST['ESSENTIAL_PROJECT'].'",ESSENTIAL_REF_NO="'.$_POST['ESSENTIAL_REF_NO'].'",ESSENTIAL_APPOINT_DATE="'.$_POST['ESSENTIAL_APPOINT_DATE'].'",ESSENTIAL_JOINING_DATE="'.$_POST['ESSENTIAL_JOINING_DATE'].'",ESSENTIAL_RESIG_DATE="'.$_POST['ESSENTIAL_RESIG_DATE'].'",ESS_JOB_STATUS="'.$_POST['ESS_JOB_STATUS'].'",RE_JOIN_DATE="'.$_POST['RE_JOIN_DATE'].'", ESS_RESP="'.$ess_res.'",ESSENTIAL_CONFIRM_DATE="'.$_POST['ESSENTIAL_CONFIRM_DATE'].'",ATTENDENCE_TYPE="'.$_POST['ATTENDENCE_TYPE'].'",cc_code_for_casual_staff="'.$_POST['cc_code_for_casual_staff'].'",acledger_for_salary_casual_staff="'.$_POST['acledger_for_salary_casual_staff'].'",
 territory="'.$_POST['territory'].'", relieving_cause="'.$_POST['relieving_cause'].'",
edit_by="'.$edit_by.'",ip_information="'.$ip_information.'"
 where PBI_ID='.$_SESSION['employee_selected'];







				mysql_query($usql);







$usql2='update personnel_basic_info set PBI_DESIGNATION="'.$_POST['ESS_DESIGNATION'].'", PBI_DEPARTMENT="'.$_POST['ESS_DEPARTMENT'].'", PBI_DOJ="'.$_POST['ESSENTIAL_JOINING_DATE'].'",PBI_DOC="'.$_POST['ESSENTIAL_CONFIRM_DATE'].'", PBI_DOJ_PP="'.$_POST['ESSENTIAL_APPOINT_DATE'].'", PBI_JOB_STATUS="'.$_POST['ESS_JOB_STATUS'].'", JOB_LOCATION="'.$_POST['ESSENTIAL_PROJECT'].'",
edit_by="'.$edit_by.'"

where PBI_ID='.$_SESSION['employee_selected'];







				mysql_query($usql2);



$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);

if($required_id>0)

$$unique = $_GET[$unique] = $required_id;







	}















if(isset($$unique))















{















$condition=$unique."=".$$unique;















$data=db_fetch_object($table,$condition);















while (list($key, $value)=each($data))















{ $$key=$value;}















}























$path_view = '../../pic/cv/'.$_SESSION['employee_selected'].'.pdf';







$path_view2 = '../../pic/confirmation_letter/'.$_SESSION['employee_selected'].'.pdf';























?>



<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>



<script>







  tinymce.init({ selector:'textarea', menubar: false });







  







</script>



<script type="text/javascript"> function DoNav(lk){















	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)















	}







	







	







function reportingAuth()







	{







		var status = document.getElementById('rep_auth_appl').value;







		if(status!="YES")







		document.getElementById('ESSENTIAL_REPORTING').setAttribute("readonly", "readonly");







		







		if(status=="YES")







		document.getElementById('ESSENTIAL_REPORTING').removeAttribute("readonly", "readonly");







	}







	







	window.onload= reportingAuth;	







</script>







<div class="right_col" role="main">



  <!-- Must not delete it ,this is main design header-->



  <div class="">



    <div class="clearfix"></div>



    <div class="row">



      <div class="col-md-12 col-sm-12 col-xs-12">



        <div class="x_panel">



          <div class="x_title">



            <h2>Plain Page </h2>



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



                              <div class="oe_form_sheetbg">



                                <div class="">



                                  <h1>



                                    <label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right"> <a href="home2.php" rel = "gb_page_center[940, 600]">



                                    <? echo  $pbi_new_code_2; echo $title?>



									



                                    </a> </label>



                                  </h1>



                                  <table width="987" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



                                    <tbody>



                                      <tr class="oe_form_group_row">



                                        <td class="oe_form_group_cell"><table width="858" height="364" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



                                            <tbody>



                                              <tr class="oe_form_group_row">



                                                <td class="oe_form_group_cell"><table width="100%" height="279" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



                                                    <tbody>



                                                      <tr class="oe_form_group_row">



                                                        <td width="33%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><label>Employment Type  :</label></td>



                                                        <td width="33%" class="oe_form_group_cell"><input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />



														



                                                          <input name="PBI_ID" id="PBI_ID" value="<?=$_SESSION['employee_selected']?>" type="hidden" />



                                                          <select name="EMPLOYMENT_TYPE">



                                                            <option>



                                                            <?=$EMPLOYMENT_TYPE?>



                                                            </option>



                                                            <option>Contractual</option>



                                                            <option>Casual Staff</option>



                                                            <option>Probationary</option>



                                                            <option>Permanent</option>



                                                            <option>Temporary</option>



                                                          </select></td>



                                                        <td width="34%" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Designation :</span></td>



                                                        <td width="67%" class="oe_form_group_cell"><span class="oe_form_field oe_datepicker_root oe_form_field_date">



                                                          <select name="ESS_DESIGNATION" required>



                                                            <? foreign_relation('designation','DESG_ID','DESG_DESC',$ESS_DESIGNATION,'1 order by DESG_DESC');?>



                                                          </select>



                                                          </span></td>



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Reporting Authority :</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="rep_auth_appl" id="rep_auth_appl" onchange="reportingAuth()">



                                                            <option value="YES" <?=($rep_auth_appl=='YES')?'selected':''?>>YES</option>



                                                            <option value="NO" <?=($rep_auth_appl=='NO')?'selected':''?>>NO</option>



                                                          </select></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Reporting Authority  : </span></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="ESSENTIAL_REPORTING" id="ESSENTIAL_REPORTING" value="">



                                                            <? foreign_relation('personnel_basic_info p, designation d','p.PBI_ID','concat(p.PBI_NAME," - ",d.DESG_DESC)',$ESSENTIAL_REPORTING,'p.PBI_DESIGNATION=d.DESG_ID and p.PBI_JOB_STATUS="In Service" order by p.PBI_NAME');?>



                                                          </select></td>



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Department    :</td>



                                                        <td class="oe_form_group_cell"><select name="ESS_DEPARTMENT">



                                                            <? foreign_relation('department','DEPT_ID','DEPT_DESC',$ESS_DEPARTMENT,' 1 order by DEPT_DESC asc');?>



                                                          </select></td>



                                                        <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Job Location  :</span></td>



                                                        <td class="oe_form_group_cell"><select name="ESSENTIAL_PROJECT">



                                                            <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$ESSENTIAL_PROJECT,'1 order by PROJECT_DESC asc');?>



                                                          </select></td>



                                                      </tr>

													  

													  

													  

													  <tr class="oe_form_group_row">



                                                        <td width="33%" bgcolor="#E8E8E8"  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><label>Management Staff Cost Center  :</label></td>



                                                        <td width="33%" bgcolor="#E8E8E8"  class="oe_form_group_cell"> 

														

														<input type="text"  list='center_ids' name="cc_code_for_casual_staff" id="cc_code_for_casual_staff" value="<?=$cc_code_for_casual_staff?>" />

                                                        <datalist id='center_ids'>

                                                        <option></option>

                                                        <?

                                                        foreign_relation('cost_center','id','center_name',$cc_code_for_casual_staff,'1');

                                                        ?>

                                                        </datalist>

														

														

														

														 </td>

														

														

														



                                                        <td width="34%" bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Management Staff Acc Ledger:</span></td>



                                                        <td width="67%" bgcolor="#E8E8E8"  class="oe_form_group_cell">

														

						  <input type="text"  list='acc_ids' name="acledger_for_salary_casual_staff" id="acledger_for_salary_casual_staff" value="<?=$acledger_for_salary_casual_staff?>" />

                                                        <datalist id='acc_ids'>

                                                        <option></option>

                                                        <?

                                                        foreign_relation('accounts_ledger','ledger_id','ledger_name',$acledger_for_salary_casual_staff,'1');

                                                        ?>

                                                        </datalist>

														

														

														</td>



                                                      </tr>

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  



                                                      <tr class="oe_form_group_row">



                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Reference No   :</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="ESSENTIAL_REF_NO" type="text" id="ESSENTIAL_REF_NO" value="<?=$ESSENTIAL_REF_NO?>" /></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Appointment Date  :</span></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="ESSENTIAL_APPOINT_DATE" type="date" id="ESSENTIAL_APPOINT_DATE" value="<?=$ESSENTIAL_APPOINT_DATE?>" /></td>



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Joining Date   :</td>



                                                        <td  class="oe_form_group_cell"><input name="ESSENTIAL_JOINING_DATE" type="date" id="ESSENTIAL_JOINING_DATE" value="<?=$ESSENTIAL_JOINING_DATE?>" /></td>



                                                        <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Confirmation Date</span></td>



                                                        <td class="oe_form_group_cell"><input name="ESSENTIAL_CONFIRM_DATE" type="date" id="ESSENTIAL_CONFIRM_DATE" value="<?=$ESSENTIAL_CONFIRM_DATE?>" /></td>



                                                      </tr>
													  
													  
													  
													    <tr class="oe_form_group_row">
														
														
														<td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Service Length  :</td>
                                                          <td class="oe_form_group_cell"><?php
                                                         $interval = date_diff(date_create(date('Y-m-d')), date_create($ESSENTIAL_JOINING_DATE));
                                                         echo $interval->format("%Y Year, %M Months, %d Days"); ?></td>
														
														
														



                                                



                                                        <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Extension Date</span></td>



                                                        <td class="oe_form_group_cell">
														<? $extension_date = find_a_field('performance_appraisal','extension_date','status="Done" and PBI_ID='.$_SESSION['employee_selected']);?>
																		
														<input name="" type="text" id="" value="<? if($extension_date>0){echo date('d-M-Y',strtotime($extension_date));}?>" disabled/>
														</td>



                                                      </tr>
													  
													  
													  
													  
												



                                                      <tr class="oe_form_group_row">



                                                         <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Territory</span></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="territory" type="text" id="territory" value="<?=$territory?>" /></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Relieving Date  :</span></td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="ESSENTIAL_RESIG_DATE" type="date" id="ESSENTIAL_RESIG_DATE" value="<?=$ESSENTIAL_RESIG_DATE?>" /></td>



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Job Status: </td>



                                                        <td class="oe_form_group_cell"><select name="ESS_JOB_STATUS">



                                                            <option <?=($ESS_JOB_STATUS=='In Service')?'selected':'';?>>In Service</option>



                                                            <option <?=($ESS_JOB_STATUS=='Not In Service')?'selected':'';?>>Not In Service</option>



                                                          </select></td>


	
                                                 <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Relieving Cause</span></td>

											
												 <td class="oe_form_group_cell"><input name="relieving_cause" type="text" id="relieving_cause" value="<?=$relieving_cause?>" /></td>



                                                      </tr>



                                                       <tr class="oe_form_group_row">



                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"> Attendance Type  :</td>



                                                        <td  class="oe_form_group_cell"><select name="ATTENDENCE_TYPE" id="ATTENDENCE_TYPE">



                                                            



                                                            <option></option>



                                                            <option <?=($ATTENDENCE_TYPE=='Auto')? 'selected':''?>>Auto</option>



                                                            <option <?=($ATTENDENCE_TYPE=='Manual')? 'selected':''?>>Manual</option>



                                                        </select></td>
														
														
														
														
														 <td class="oe_form_group_cell">Re-Join Date </td>



                                                        <td class="oe_form_group_cell"><input name="RE_JOIN_DATE" type="date" id="RE_JOIN_DATE" value="<?=$RE_JOIN_DATE?>" /></td>

														

													

														

														



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Attach CV :</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input type="file" name="cv" id="cv" />



                                                          &nbsp;



                                                          <? if(file_exists($path_view)){?>



                                                          <a href="../../pic/cv/<?=$_SESSION['employee_selected']?>.pdf" class="btn btn-success">View File</a>



                                                          <? } ?></td>



                                                        <td bgcolor="#E8E8E8"  class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Appointment Letter :</span></td>



                                                        <td bgcolor="#E8E8E8"  class="oe_form_group_cell"><input type="file" name="confirmation_letter" id="confirmation_letter" />



                                                          &nbsp;



                                                          <? if(file_exists($path_view2)){?>



                                                          <a href="../../pic/confirmation_letter/<?=$_SESSION['employee_selected']?>.pdf" class="btn btn-success">View File</a>



                                                          <? } ?></td>



                                                      </tr>



                                                     



                                                      <tr class="oe_form_group_row">



                                                        <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"> Job Responsibility  :</td>



                                                        <td colspan="4" class="oe_form_group_cell"><textarea cols="4" name="ESS_RESP"><?=$ESS_RESP?>



</textarea></td>



                                                      </tr>



                                                      <tr class="oe_form_group_row">



                                                        <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>



                                                        <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>



                                                      </tr>

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  

													  



                                                    </tbody>



                                                  </table></td>



                                              </tr>



                                            </tbody>



                                          </table></td>



                                      </tr>



                                    </tbody>



                                  </table>



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



                </div>



              </form>



            </div>



          </div>



        </div>



      </div>



    </div>



  </div>



</div>



<!-- / End page content -->



<?







include_once("../../template/footer.php");







?>



