<?php

session_start();

ob_start();

require "../../config/inc.all.php";
require "../../template/main_layout.php";


//Use this to search id

if(isset($_POST['button'])){

$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);

$_SESSION['employee_selected'] = $pbi_new_code;

}


// ::::: Edit This Section ::::: 

$title='Personal File Check Status';			// Page Name and Page Title

$page="pf_status.php";		// PHP File Name

$input_page="pf_status_input.php";

$root='hrm';



$table='pf_status';		// Database Table Name Mainly related to this page

$unique='PF_STATUS_ID';			// Primary Key of this Database table

$shown='PF_STATUS_CV';				// For a New or Edit Data a must have data field



// ::::: End Edit Section :::::





$crud      =new crud($table);





$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);

if($required_id>0)

$$unique = $_GET[$unique] = $required_id;

if(isset($_POST[$shown]))

{	if(isset($_POST['insert']))

		{		

				$_POST['PBI_ID']=$_SESSION['employee_selected'];

				$crud->insert();

				$type=1;

				$msg='New Entry Successfully Inserted.';

				unset($_POST);

				unset($$unique);

$required_id=find_a_field($table,$unique,'PBI_ID='.$_SESSION['employee_selected']);

if($required_id>0)

$$unique = $_GET[$unique] = $required_id;

		}

	//for Modify..................................

	if(isset($_POST['update']))

	{

				$crud->update($unique);

				$type=1;

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

				  
				  

<script type="text/javascript"> function DoNav(lk){

	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)

	}</script>


<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->
          <div class="">
		  
		  
           
        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>PF Status</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  
				  	 <div class="openerp openerp_webclient_container">
                    <table class="oe_webclient">
                    <tbody>
   
                      <tr>
			
				  
				  
                  <div class="x_content">
				  


<form action="" method="post" enctype="multipart/form-data">

<div class="oe_view_manager oe_view_manager_current">

        

    <? include('../../common/title_bar.php');?>

        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

                      <? include('../../common/input_bar.php');?>

                      <div class="oe_form_sheetbg">

                        <div class="oe_form_sheet oe_form_sheet_width">

        <h1><label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right">

        <a href="home2.php" rel = "gb_page_center[940, 600]"><?=$title?></a>

    </label>

          </h1><table width="801" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">

            <tbody><tr class="oe_form_group_row">

            <td class="oe_form_group_cell"><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">

              <tbody>

                <tr class="oe_form_group_row">

                  <td colspan="1" class="oe_form_group_cell" width="100%">&nbsp;</td>

                </tr>

              </tbody>

            </table>            

              <table width="100%" height="294" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">

                <tbody>

                  <tr class="oe_form_group_row">

                    <td width="21%" height="24" colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;CV :</td>

                    <td bgcolor="#E8E8E8" width="27%" colspan="1" class="oe_form_group_cell">

                    <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />

					<input name="PBI_ID" id="PBI_ID" value="<?=$_SESSION['employee_selected']?>" type="hidden" />

                        <select name="PF_STATUS_CV" id="PF_STATUS_CV">

                         <option selected="selected"><?=$PF_STATUS_CV?></option>

                          <option>Yes</option>

                          <option>No</option>
                      </select></td>

                    <td bgcolor="#E8E8E8" width="23%" class="oe_form_group_cell">Offer Letter : </td>

                    <td bgcolor="#E8E8E8" width="29%" class="oe_form_group_cell">
                      <select name="PF_OFFER_LTR" id="PF_OFFER_LTR">
                        <option selected="selected">
                        <?=$PF_OFFER_LTR?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>                    </td>
                  </tr>

                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><label>&nbsp;&nbsp;Appointment Letter :</label></td>
                    <td class="oe_form_group_cell"><select name="PF_STATUS_APPOINTMENT_LETTER" id="PF_STATUS_APPOINTMENT_LETTER">
                      <option selected="selected">
                        <?=$PF_STATUS_APPOINTMENT_LETTER?>
                      </option>
                      <option>Yes</option>
                      <option>No</option>
                    </select></td>
                    <td class="oe_form_group_cell">Resignation Letter from Prev Employer : </td>
                    <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_STATUS_RESIGNATION_LETTER" id="PF_STATUS_RESIGNATION_LETTER">
                        <option selected="selected">
                        <?=$EPF_STATUS_MC?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Education Certification Copy : </td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_EDU_CERTIFICATE" id="PF_EDU_CERTIFICATE">
                        <option selected="selected">
                        <?=$PF_EDU_CERTIFICATE?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell">Experience Certification Copy : </td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_EXP_CERTIFICATE" id="PF_EXP_CERTIFICATE">
                        <option selected="selected">
                        <?=$PF_EXP_CERTIFICATE?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">NID/ Birth Certificate/ Passport Copy </td>
                    <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_NID_BIRTH_PASS" id="PF_NID_BIRTH_PASS">
                        <option selected="selected">
                        <?=$PF_NID_BIRTH_PASS?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                    <td class="oe_form_group_cell">TIN Certificate Copy : </td>
                    <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_TIN_CERTIFICATE" id="PF_TIN_CERTIFICATE">
                        <option selected="selected">
                        <?=$PF_TIN_CERTIFICATE?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                  </tr>
                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Personal History Form : </td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_HISTORY_FORM" id="PF_HISTORY_FORM">
                        <option selected="selected">
                        <?=$PF_HISTORY_FORM?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Joining Letter:</span></td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PF_STATUS_JOINING_LETTER" id="PF_STATUS_JOINING_LETTER">
                      <option selected="selected">
                      <?=$PF_STATUS_JOINING_LETTER?>
                      </option>
                      <option>Yes</option>
                      <option>No</option>
                    </select></td>
                  </tr>
                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Release Letter from Prev Employer : </td>
                    <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_RELEASE_PREV_LETTER" id="PF_RELEASE_PREV_LETTER">
                        <option selected="selected">
                        <?=$PF_RELEASE_PREV_LETTER?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                    <td class="oe_form_group_cell">Salary Certification from Prev Employer : </td>
                    <td class="oe_form_group_cell"><select name="PF_SALARY_PREV_LETTER" id="PF_SALARY_PREV_LETTER">
                      <option selected="selected">
                      <?=$PF_SALARY_PREV_LETTER?>
                      </option>
                      <option>Yes</option>
                      <option>No</option>
                    </select></td>
                  </tr>
                  <tr class="oe_form_group_row">
                    <td height="22" colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Pay Slip from Prev Employer </td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">
                      <select name="PF_PAYSLIP_PREV_LETTER" id="PF_PAYSLIP_PREV_LETTER">
                        <option selected="selected">
                        <?=$PF_PAYSLIP_PREV_LETTER?>
                        </option>
                        <option>Yes</option>
                        <option>No</option>
                      </select>
                    </span></td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell">Passport Size Picture : </td>
                    <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="PF_PP_SIZE_PIC" id="PF_PP_SIZE_PIC">
                      <option selected="selected">
                      <?=$PF_PP_SIZE_PIC?>
                      </option>
                      <option>Yes</option>
                      <option>No</option>
                    </select></td>
                  </tr>
                </tbody>
              </table></td>

            </tr></tbody></table>

                        </div>

                      </div>

    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div></div></div></div>

    </div></div>

            

        </div>

    </div>

</form>

</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->



<?






include_once("../../template/footer.php");



?>