<?php



session_start();







require "../../config/inc.all.php";







// ::::: Edit This Section ::::: 



$title='Promotion/Designation Change Management';			// Page Name and Page Title



$page="promotion.php";		// PHP File Name



$input_page="promotion_input.php";



$root='hrm';



$table='promotion_detail';		// Database Table Name Mainly related to this page



$unique='PROMOTION_D_ID';			// Primary Key of this Database table



$shown='PROMOTION_REF';				// For a New or Edit Data a must have data field





// ::::: End Edit Section :::::











$crud      =new crud($table);





$PROMOTION_PAST_DESG=find_a_field('personnel_basic_info','PBI_DESIGNATION','PBI_ID='.$_SESSION['employee_selected']);

$$unique = $_GET[$unique];



if(isset($_POST[$shown]))



{







$$unique = $_POST[$unique];







if(isset($_POST['insert'])||isset($_POST['insertn']))



{		



$now				= time();







$_REQUEST['PBI_ID']=$_SESSION['employee_selected'];







$crud->insert();





if($_FILES['PROMOTION_DOC_FILE']['tmp_name']!=''){

	$file_name= $_FILES['PROMOTION_DOC_FILE']['name'];

	$file_tmp= $_FILES['PROMOTION_DOC_FILE']['tmp_name'];

	$ext=end(explode('.',$file_name));

	$path='../../pic/promotion_doc/';

	move_uploaded_file($file_tmp, $path.$$unique.'.pdf');

	}

	

	$updd = 'update personnel_basic_info set PBI_DESIGNATION="'.$_POST['PROMOTION_PRESENT_DESG'].'" where PBI_ID="'.$_SESSION['employee_selected'].'"';

	$upqr = mysql_query($updd);

	

	$upddd = 'update essential_info set ESS_DESIGNATION="'.$_POST['PROMOTION_PRESENT_DESG'].'" where PBI_ID="'.$_SESSION['employee_selected'].'"';

	$upqrr = mysql_query($upddd);

	  

	  

	

	

	

	if($_POST['increment_amt']>0){

	

	 $increment = 'INSERT INTO `increment_detail`(`INCREMENT_REF`, `PRESENT_SALARY`, `INCREMENT_TYPE`, `INCREMENT_ISSUE_DATE`, `INCREMENT_EFFECT_DATE`, `INCREMENT_AMT`, `INCREMENT_DESG`, `PBI_ID`) VALUES ("'.$_POST['PROMOTION_REF'].'","'.$_POST['previous_salary'].'","Performance Based","'.$_POST['PROMOTION_ISSUE_DATE'].'","'.$_POST['PROMOTION_DATE'].'","'.$_POST['increment_amt'].'","'.$_POST['PROMOTION_PAST_DESG'].'","'.$_SESSION['employee_selected'].'")';

	$upqrrr = mysql_query($increment);

	  

	 $total_salary = $_POST['previous_salary'] + $_POST['increment_amt'];

	 

	 $basic = $total_salary*50/100;

     $house_rent = $total_salary*25/100;

     $conveyance = $total_salary*10/100;

     $medical = $total_salary*15/100;

	  

	$updddd = 'update salary_info set gross_salary="'.$total_salary.'", basic_salary="'.$basic.'", house_rent="'.$house_rent.'", special_allowance="'.$conveyance.'", medical_allowance="'.$medical.'"

	 where PBI_ID="'.$_SESSION['employee_selected'].'"';

	$upqrr1 = mysql_query($updddd);

	

	





	

	}

	

	

$type=1;



$msg='New Entry Successfully Inserted.';







if(isset($_POST['insert']))



{



echo '<script type="text/javascript">



parent.parent.document.location.href = "../'.$root.'/'.$page.'";



</script>';



}



unset($_POST);



unset($$unique);











}











//for Modify..................................







if(isset($_POST['update']))



{





		$crud->update($unique);

		

	if($_FILES['PROMOTION_DOC_FILE']['tmp_name']!=''){

	$file_name= $_FILES['PROMOTION_DOC_FILE']['name'];

	$file_tmp= $_FILES['PROMOTION_DOC_FILE']['tmp_name'];

	$ext=end(explode('.',$file_name));

	$path='../../pic/promotion_doc/';

	move_uploaded_file($file_tmp, $path.$$unique.'.pdf');

	}





    $updd = 'update personnel_basic_info set PBI_DESIGNATION="'.$_POST['PROMOTION_PRESENT_DESG'].'" where PBI_ID="'.$_SESSION['employee_selected'].'"';

	$upqr = mysql_query($updd);

	

	$upddd = 'update essential_info set ESS_DESIGNATION="'.$_POST['PROMOTION_PRESENT_DESG'].'" where PBI_ID="'.$_SESSION['employee_selected'].'"';

	$upqrr = mysql_query($upddd);



		$type=1;

          

		   

				

		$msg='Successfully Updated.';



				echo '<script type="text/javascript">



parent.parent.document.location.href = "../'.$root.'/'.$page.'";



</script>';



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



if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);















$PROMOTION_REPORTING_AUTH=find_a_field('essential_info','ESSENTIAL_REPORTING','PBI_ID='.$_SESSION['employee_selected']);











?>

<html style="height: 100%;">

<head>

<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

<meta content="text/html; charset=UTF-8" http-equiv="content-type">

<link href="../../css/css.css" rel="stylesheet">

<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>

<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

<script>

  tinymce.init({ selector:'textarea', menubar: false });

</script>

<? do_calander('#PROMOTION_DATE');?>

<? do_calander('#PROMOTION_ISSUE_DATE');?>

</head>

<body>

<!--[if lte IE 8]>



        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>



        <script>CFInstall.check({mode: "overlay"});</script>



        <![endif]-->

<form action="" method="post" enctype="multipart/form-data">

  <div class="ui-dialog ui-widget ui-widget-content ui-corner-all oe_act_window ui-draggable ui-resizable openerp" style="outline: 0px none; z-index: 1002; position: absolute; height: auto; width: 900px; display: block; /* [disabled]left: 217.5px; */" tabindex="-1" role="dialog" aria-labelledby="ui-id-19">

    <? include('../../common/title_bar_popup.php');?>

    <div style="display: block; max-height: 464px; overflow-y: auto; width: auto; min-height: 82px; height: auto;" class="ui-dialog-content ui-widget-content" scrolltop="0" scrollleft="0">

      <div style="width:100%" class="oe_popup_form">

        <div class="oe_formview oe_view oe_form_editable" style="opacity: 1;">

          <div class="oe_form_buttons"></div>

          <div class="oe_form_sidebar" style="display: none;"></div>

          <div class="oe_form_container">

            <div class="oe_form">

              <div class="">

                <? include('../../common/input_bar.php');?>

                <div class="oe_form_sheetbg">

                  <div class="oe_form_sheet oe_form_sheet_width">

                    <h1>

                      <label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right"> <a href="home2.php" rel = "gb_page_center[940, 600]">

                      <?=$title?>

                      </a> </label>

                    </h1>

                    <table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">

                      <tbody>

                        <tr class="oe_form_group_row">

                          <td class="oe_form_group_cell"><table width="100%" height="128" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">

                              <tbody>

                                <tr class="oe_form_group_row">

                                  <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Reference No:</td>

                                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell"><input name="PROMOTION_REF" type="text" id="PROMOTION_REF" value="<?=$PROMOTION_REF?>" />

                                    <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" /></td>

                                  <td nowrap bgcolor="#E8E8E8" class="oe_form_group_cell">Issue Date : </td>

                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="PROMOTION_ISSUE_DATE" type="text" id="PROMOTION_ISSUE_DATE" value="<?=$PROMOTION_ISSUE_DATE?>" /></td>

                                </tr>

								

                                <tr class="oe_form_group_row">

								

								

								

								<td width="18%" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Effect Date :</span></td>

                 <td bgcolor="#E8E8E8" width="37%" class="oe_form_group_cell"><input name="PROMOTION_DATE" type="text" id="PROMOTION_DATE" value="<?=$PROMOTION_DATE?>" /></td>

								

                  <td width="17%" colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><label>New Designation :</label></td>

                          <td bgcolor="#E8E8E8" width="28%" colspan="1" class="oe_form_group_cell"><select name="PROMOTION_PRESENT_DESG">

						<? foreign_relation('designation','DESG_ID','DESG_DESC',$PROMOTION_PRESENT_DESG,'1 order by DESG_DESC');?>

                                  </select><span style="color:#FF0000;">**</span></td>

									

									

                                  

			

                                </tr>

								

								

								<tr class="oe_form_group_row">

                                  <td width="17%" colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><label>Previous Designation :</label></td>

                                  <td bgcolor="#E8E8E8" width="28%" colspan="1" class="oe_form_group_cell">

								  

								  <select name="PROMOTION_PAST_DESG">

								     <? foreign_relation('designation','DESG_ID','DESG_DESC',$PROMOTION_PAST_DESG,'1 order by DESG_DESC');?>

                                    </select>

									

									

									<span style="color:#FF0000;">**</span></td>

                                  <td width="18%" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span></td>

                                  <td bgcolor="#E8E8E8" width="37%" class="oe_form_group_cell">&nbsp;</td>

                                </tr>

								

								

								<tr class="oe_form_group_row">

                                  <td width="17%" colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><label> Present Salary</label></td>

                                  <td bgcolor="#E8E8E8" width="28%" colspan="1" class="oe_form_group_cell"><input name="previous_salary" type="text" id="previous_salary" value="<?=find_a_field('salary_info','gross_salary','PBI_ID='.$_SESSION['employee_selected'])?>" /></td>

                                  <td width="18%" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Increment Amount :</span></td>

                                  <td bgcolor="#E8E8E8" width="37%" class="oe_form_group_cell"><input name="increment_amt" type="text" id="increment_amt" value="<?=$increment_amt?>" /></td>

								  

                                </tr>

								

								

                                <tr class="oe_form_group_row">

                                  <td colspan="1" nowrap class="oe_form_group_cell oe_form_group_cell_label">Reporting Authority  :</td>

                                  <td class="oe_form_group_cell"><select name="PROMOTION_REPORTING_AUTH">

                                      <? foreign_relation('personnel_basic_info p, designation d','p.PBI_ID','concat(p.PBI_NAME," - ",d.DESG_DESC)',$PROMOTION_REPORTING_AUTH,'p.PBI_DESIGNATION=d.DESG_ID order by p.PBI_NAME');?>

                                    </select></td>

                                  <td nowrap class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Document : </span></td>

                                  <td class="oe_form_group_cell"><input name="PROMOTION_DOC_FILE" type="file" id="PROMOTION_DOC_FILE" /></td>

                                </tr>

								

								

								 

								

								

                                <tr class="oe_form_group_row">

                                  <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Job Responsibility : </td>

                                  <td colspan="3" bgcolor="#E8E8E8" class="oe_form_group_cell"><textarea name="PROMOTION_NOTES" id="PROMOTION_NOTES"><?=$PROMOTION_NOTES?></textarea></td>

                                </tr>

                                <tr class="oe_form_group_row">

                                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>

                                  <td class="oe_form_group_cell">&nbsp;</td>

                                  <td class="oe_form_group_cell">&nbsp;</td>

                                  <?

				$path = '../../pic/promotion_doc/'.$$unique.'.pdf';

				if(is_file($path)){

				?>

                                  <td class="oe_form_group_cell"><div align="center" style="margin-left:-240px;">

                                    <iframe src="<?php echo $path?>" title="PDF" align="top" height="600" width="600" frameborder="0" scrolling="auto" target="Message"></iframe></div></td>

                                  <? }?>

                                </tr>

                              </tbody>

                            </table>

                          <br></td>

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

    <div class="ui-resizable-handle ui-resizable-n" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-e" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-s" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-w" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se ui-icon-grip-diagonal-se" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-sw" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-ne" style="z-index: 1000;"></div>

    <div class="ui-resizable-handle ui-resizable-nw" style="z-index: 1000;"></div>

    <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"> </div>

  </div>

</form>

</body>

</html>

