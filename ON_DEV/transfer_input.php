<?php







session_start();















require "../../config/inc.all.php";















// ::::: Edit This Section ::::: 







$title='Transfer Management';			// Page Name and Page Title







$page="transfer.php";		// PHP File Name







$input_page="transfer_input.php";







$root='hrm';















$table='transfer_detail';		// Database Table Name Mainly related to this page







$unique='TRANSFER_D_ID';			// Primary Key of this Database table







$shown='TRANSFER_ORDER_NO';				// For a New or Edit Data a must have data field















// ::::: End Edit Section :::::























$crud      =new crud($table);















$$unique = $_GET[$unique];















if(isset($_POST[$shown]))







{







$$unique = $_POST[$unique];















if(isset($_POST['insert'])||isset($_POST['insertn']))
{		
$now				= time();

unset($_REQUEST['TRANSFER_D_ID']);
$_POST['PBI_ID']=$_REQUEST['PBI_ID']=$_SESSION['employee_selected'];























$vars['PBI_ID']=$_SESSION['employee_selected'];







//$vars['PBI_DESIGNATION']=$_POST['TRANSFER_DESIGNATION'];







$vars['PBI_DEPARTMENT']=$_POST['TRANSFER_NEW_DEPT'];  







$vars['JOB_LOCATION']=$_POST['TRANSFER_NEW_PROJECT'];







//db_update('personnel_basic_info', $vars['PBI_ID'], $vars, 'PBI_ID');



unset($vars);











$vars['PBI_ID']=$_SESSION['employee_selected'];







//$vars['ESS_DESIGNATION']=$_POST['TRANSFER_DESIGNATION'];







$vars['ESS_DEPARTMENT']=$_POST['TRANSFER_NEW_DEPT'];







$vars['ESSENTIAL_PROJECT']=$_POST['TRANSFER_NEW_PROJECT'];



$vars['ESSENTIAL_REPORTING']=$_POST['TRANSFER_NEW_REPORTING_AUTH'];







//db_update('essential_info', $vars['PBI_ID'], $vars, 'PBI_ID');











	$crud->insert();



	



	



if($_FILES['TRANSFER_DOC_FILE']['tmp_name']!=''){



	$file_name= $_FILES['TRANSFER_DOC_FILE']['name'];



	$file_tmp= $_FILES['TRANSFER_DOC_FILE']['tmp_name'];



	$ext=end(explode('.',$file_name));



	$path='../../pic/transfer_doc/';



	move_uploaded_file($file_tmp, $path.$$unique.'.pdf');



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







$vars['PBI_ID']=$_SESSION['employee_selected'];







$vars['PBI_DESIGNATION']=$_POST['TRANSFER_DESIGNATION'];







$vars['PBI_DEPARTMENT']=$_POST['TRANSFER_PRESENT_DEPT'];







$vars['JOB_LOCATION']=$_POST['TRANSFER_PRESENT_PROJECT'];











//db_update('personnel_basic_info', $vars['PBI_ID'], $vars, 'PBI_ID');



unset($vars);











$vars['PBI_ID']=$_SESSION['employee_selected'];







$vars['ESS_DESIGNATION']=$_POST['TRANSFER_DESIGNATION'];







$vars['ESS_DEPARTMENT']=$_POST['TRANSFER_PRESENT_DEPT'];







$vars['ESSENTIAL_PROJECT']=$_POST['TRANSFER_PRESENT_PROJECT'];







$vars['ESSENTIAL_REPORTING']=$_POST['ESSENTIAL_REPORTING'];







//db_update('essential_info', $vars['PBI_ID'], $vars, 'PBI_ID');



$crud->update($unique);







//echo $update_sql = 'update essential_info set ESS_DEPARTMENT='.$_POST['TRANSFER_PRESENT_DEPT'].' where PBI_ID='.$_SESSION['employee_selected'];







//mysql_query($update_sql);







//echo $update_sql2 = 'update personnel_basic_info set PBI_DEPARTMENT='.$_POST['TRANSFER_PRESENT_DEPT'].' where PBI_ID='.$_SESSION['employee_selected'];







//mysql_query($update_sql2);







if($_FILES['TRANSFER_DOC_FILE']['tmp_name']!=''){



	$file_name= $_FILES['TRANSFER_DOC_FILE']['name'];



	$file_tmp= $_FILES['TRANSFER_DOC_FILE']['tmp_name'];



	$ext=end(explode('.',$file_name));



	$path='../../pic/transfer_doc/';



	move_uploaded_file($file_tmp, $path.$$unique.'.pdf');



	}



	



	



		$type=1;







		$msg='Successfully Updated.';







		echo '<script type="text/javascript">parent.parent.document.location.href = "../'.$root.'/'.$page.'";</script>';







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







else







{







	$past=find_all_field('personnel_basic_info','','PBI_ID='.$_SESSION['employee_selected']);







//var_dump($past);















$TRANSFER_PAST_DOMAIN=$TRANSFER_PRESENT_DOMAIN=$past->PBI_DOMAIN;







$TRANSFER_PAST_DEPT=$TRANSFER_PRESENT_DEPT=$past->PBI_DEPARTMENT;

$TRANSFER_PAST_PROJECT=$TRANSFER_PRESENT_PROJECT=$past->JOB_LOCATION;









$TRANSFER_PAST_GROUP=$TRANSFER_PRESENT_GROUP=$past->PBI_GROUP;







$TRANSFER_PAST_ZONE=$TRANSFER_PRESENT_ZONE=$past->PBI_ZONE;







$TRANSFER_PAST_AREA=$TRANSFER_PRESENT_AREA=$past->PBI_AREA;







$TRANSFER_PAST_BRANCH=$TRANSFER_PRESENT_BRANCH=$past->PBI_BRANCH;







}







if(!isset($$unique)) {$$unique=db_last_insert_id($table,$unique);}







//var_dump($past);







?>







<html style="height: 100%;"><head>







        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">







        <meta content="text/html; charset=UTF-8" http-equiv="content-type">







        <link href="../../css/css.css" rel="stylesheet">







<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>







<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>







<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>







<script type="text/javascript" src="../../js/pg.js"></script>







<? do_calander('#TRANSFER_ORDER_DATE');?>







<? do_calander('#TRANSFER_AFFECT_DATE');?>







</head>







<body>







        <!--[if lte IE 8]>







        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>







        <script>CFInstall.check({mode: "overlay"});</script>







        <![endif]-->







       <form action="" method="post" enctype="multipart/form-data"> <div class="ui-dialog ui-widget ui-widget-content ui-corner-all oe_act_window ui-draggable ui-resizable openerp" style="outline: 0px none; z-index: 1002; position: absolute; height: auto; width: 900px; display: block; /* [disabled]left: 217.5px; */" tabindex="-1" role="dialog" aria-labelledby="ui-id-19">







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







        <h1><label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right">







        <a href="home2.php" rel = "gb_page_center[940, 600]"><?=$title?></a>







    </label>







          </h1><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0"><tbody><tr class="oe_form_group_row">







            <td class="oe_form_group_cell"><table width="100%" height="140" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">







              <tbody>







                <tr class="oe_form_group_row">

               <td width="40%" colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Reference No: </td>

             <td bgcolor="#E8E8E8" width="20%" colspan="1" class="oe_form_group_cell">







                  <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />







                    <input name="TRANSFER_ORDER_NO" type="text" id="TRANSFER_ORDER_NO" value="<?=$TRANSFER_ORDER_NO?>" /></td>



                     <td bgcolor="#E8E8E8">&nbsp;</td>

					 <td bgcolor="#E8E8E8">&nbsp;</td>



                 



                </tr>

				

				

				

				

				

				

				

				

				

				

				

				

				

				

				

				<tr class="oe_form_group_row">

                    

					 <td width="40%" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell">Issue Date :</td>







                  <td bgcolor="#E8E8E8" width="20%" class="oe_form_group_cell"><input name="TRANSFER_ORDER_DATE" type="text" id="TRANSFER_ORDER_DATE" value="<?=$TRANSFER_ORDER_DATE?>" /></td>





                  <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label"><label>Effective Date : </label></td>







                  <td width="20%" class="oe_form_group_cell" bgcolor="#E8E8E8"><input name="TRANSFER_AFFECT_DATE" type="text" id="TRANSFER_AFFECT_DATE" value="<?=$TRANSFER_AFFECT_DATE?>" /></td>







                </tr>





                <tr class="oe_form_group_row">

				

				

				

				

				

				 







                 <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Present Department :</td>







                  <td width="20%" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="TRANSFER_PRESENT_DEPT">







                    <? foreign_relation('department','DEPT_ID','DEPT_DESC',$TRANSFER_PRESENT_DEPT);?>







                    </select></td>

					

					

					 <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">New Department :</td>







                  <td width="20%" bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="TRANSFER_NEW_DEPT">







                    <? foreign_relation('department','DEPT_ID','DEPT_DESC',$TRANSFER_NEW_DEPT);?>

					

					







                    </select></td>

				

				  

				 </tr>

				 

				 

				 

				 

				

				

				

				

				

				

				

 <tr class="oe_form_group_row">

  

								  <td colspan="1" style="background-color:#E8E8E8" nowrap class="oe_form_group_cell oe_form_group_cell_label">Present Job Location :</td>







                                  <td class="oe_form_group_cell" style="background-color:#E8E8E8"><select name="TRANSFER_PRESENT_PROJECT">



                    <?php /*?>  <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$TRANSFER_PAST_PROJECT,'1');?><?php */?>
					  
					  
					  <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$TRANSFER_PRESENT_PROJECT);?>



                    </select></td>

				  

				  

				   <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">New Job Location :</td>







                  <td class="oe_form_group_cell" bgcolor="#E8E8E8"><select name="TRANSFER_NEW_PROJECT">



                       <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$TRANSFER_NEW_PROJECT,'1');?>



                    </select></td>

				  

						

				  

				</tr>

				

				

				

				

				  

				

				

				

				

				

				

				

				

				

				

				

		 <tr class="oe_form_group_row">







                  <td colspan="1" bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Reporting Authority  :</td>







                  <td width="20%" bgcolor="#E8E8E8" class="oe_form_group_cell">

				    <? $past_auth=find_a_field('essential_info','ESSENTIAL_REPORTING','PBI_ID='.$_SESSION['employee_selected']);?>

					<input type="hidden" name="TRANSFER_PAST_REPORTING_AUTH" id="TRANSFER_PAST_REPORTING_AUTH" value="<?=$past_auth?>">

				  <select name="TRANSFER_NEW_REPORTING_AUTH" id="TRANSFER_NEW_REPORTING_AUTH">



                    <? foreign_relation('personnel_basic_info p, designation d','p.PBI_ID','concat(p.PBI_NAME," - ",d.DESG_DESC)',$TRANSFER_NEW_REPORTING_AUTH,'p.PBI_DESIGNATION=d.DESG_ID and p.PBI_JOB_STATUS="In Service" order by p.PBI_NAME');?>



                  </select></td>







                  <td nowrap class="oe_form_group_cell" style="background-color:#E8E8E8"><span class="oe_form_group_cell oe_form_group_cell_label">Document :</span></td>







                  <td class="oe_form_group_cell" bgcolor="#E8E8E8"><input name="TRANSFER_DOC_FILE" type="file" id="TRANSFER_DOC_FILE" /></td>



                </tr>



				<?



				$path = '../../pic/transfer_doc/'.$$unique.'.pdf';



				if(is_file($path)){



				?>



                <tr class="oe_form_group_row">



                  <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><a href="<?php echo $path?>" target="_blank">VIEW DOC</a>



                    <iframe src="<?php echo $path?>" title="PDF" align="top" height="600" width="400" frameborder="0" scrolling="auto" target="Message"></iframe></td>



                  <td nowrap bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>



                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>



                </tr>



				<? }?>



				



				



                </tbody></table>







</td>







            </tr></tbody></table>







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







          <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">















          </div>







        </div>







        </form>







</body></html>







