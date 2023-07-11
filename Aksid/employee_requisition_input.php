<?php
session_start();
require "../../config/inc.all.php";
// ::::: Edit This Section ::::: 
$title='Employee Requisition';			// Page Name and Page Title
$page="employee_requisition.php";		// PHP File Name
$input_page="employee_requisition_input.php";
$root='hrm';

do_calander('#EXPECTED_DATE_TO');

do_calander('#MANAGEMENT_APPROVE_DATE');

do_calander('#JOB_POST_DATE');

do_calander('#CV_SORTING_DATE');

do_calander('#INTERVIEW_PROCESS_DATE');

do_calander('#JOINING_DATE');

do_calander('#CV_COLLECTION_DATE');

do_calander('#SUBMISSION_DATE');









$table='employee_requisition';		// Database Table Name Mainly related to this page



$unique='REQUISITION_ID';			// Primary Key of this Database table



$shown='REMARKS';				// For a New or Edit Data a must have data field







// ::::: End Edit Section :::::











$crud=new crud($table);







$$unique = $_GET[$unique];



if(isset($_POST[$shown]))



{



$$unique = $_POST[$unique];







if(isset($_POST['insert'])||isset($_POST['insertn']))



{		



$now				= time();







$crud->insert();



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



?>



<html style="height: 100%;"><head>



        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">



        <meta content="text/html; charset=UTF-8" http-equiv="content-type">



        <link href="../../css/css.css" rel="stylesheet">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="/resources/demos/style.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>

  $( function() {

    $( "#EXPECTED_DATE_TO" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

    $( "#EXPECTED_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	$( "#MANAGEMENT_APPROVE_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	$( "#JOB_POST_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	$( "#CV_SORTING_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	$( "#INTERVIEW_PROCESS_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	$( "#JOINING_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	

	$( "#CV_COLLECTION_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

	

	$( "#SUBMISSION_DATE" ).datepicker({

      changeMonth: true,

      changeYear: true,

	  dateFormat: "yy-mm-dd"

    });

  

  } );

  </script>

		</head>



<body>



        <!--[if lte IE 8]>



        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>



        <script>CFInstall.check({mode: "overlay"});</script>



        <![endif]-->



       <form action="" method="post"> <div class="ui-dialog ui-widget ui-widget-content ui-corner-all oe_act_window ui-draggable ui-resizable openerp" style="outline: 0px none; z-index: 1002; position: absolute; height: auto; width: 900px; display: block; /* [disabled]left: 217.5px; */ left: 16px; top: 21px;" tabindex="-1" role="dialog" aria-labelledby="ui-id-19">



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



          </h1><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr class="oe_form_group_row">



            <td class="oe_form_group_cell"><table width="100%" height="66" border="0" cellpadding="2" cellspacing="2" class="oe_form_group ">



              <tbody>



                <tr class="oe_form_group_row">



   <td>

     <div align="center">

      <table width="100%" border="0" cellpadding="2" cellspacing="2" style="padding:10px;">

	   

	   

	    <tr>

           <td>Ref No : </td>

           <td><input type="text" name="REF_NO" id="REF_NO" value="<?=$REF_NO?>"><input type="hidden" name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>"> <input type="hidden" name="REQUISITION_SUBMIT_DATE" id="REQUISITION_SUBMIT_DATE" value="<?=date('Y-m-d')?>"></td>

           </tr>

		   

		   <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

		   

		   

         <tr>

           <td width="49%">

             Designation:

            </td>

        <td width="51%"><select name="DESIGNATION">

               <? foreign_relation('designation', 'DESG_ID', 'DESG_SHORT_NAME', $DESIGNATION, ' 1 order by DESG_SHORT_NAME asc')?>

             </select></td>

        </tr>

		 <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Job Location / Project : </td>

           <td><select name="JOB_LOCATION">

			 <? foreign_relation('project', 'PROJECT_ID', 'PROJECT_DESC', $JOB_LOCATION, ' 1 order by PROJECT_DESC asc')?>

             </select></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Expected Joing Date From: </td>

           <td> <input type="text" id="EXPECTED_DATE_TO" name="EXPECTED_DATE_TO" value="<?=$EXPECTED_DATE_TO?>"/></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Salary Range From:</td>

           <td><input type="text" name="SALARY_TO" value="<?=$SALARY_TO?>"/></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

        

         <tr>

           <td>Vacancy:</td>

           <td><input type="text" name="VACANCY" value="<?=$VACANCY?>"/></td>

           </tr>

         

	      <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		<tr bgcolor="#CCCCCC">

			<br>

           <td colspan="2"><div align="center">Line Graph Status</div></td>

          	<br>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

        

		

		 <tr>

           <td>Management Approval:</td>

           <td><select name="MANAGEMENT_APPROVAL">

			  <option><?=$MANAGEMENT_APPROVAL?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

        

		

		 <tr>

           <td>Job Post:</td>

           <td><select name="JOB_POST">

			  <option><?=$JOB_POST?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

		

		 <tr>

           <td>Cv Collection:</td>

           <td><select name="CV_COLLECTION">

			  <option><?=$CV_COLLECTION?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

		

		 <tr>

           <td>Cv Sorting:</td>

           <td> <select name="CV_SORTING">

			  <option><?=$CV_SORTING?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

		

		 <tr>

           <td><div align="left">Interview Process</div></td>

           <td><select name="INTERVIEW_PROCESS">

			  <option><?=$INTERVIEW_PROCESS?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td><div align="left">Joining</div></td>

           <td> <select name="JOINING">

			  <option><?=$JOINING?></option>

			   <option>Pending</option>

			    <option>Done</option>

			 </select></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

       </table>

      

     </div></td><td>

     <div align="center">

      <table width="100%" border="0" cellpadding="2" cellspacing="2" style="padding:10px;">

	   

	   

	      <tr>

           <td>Submission Date : </td>

           <td><input type="text" name="SUBMISSION_DATE" id="SUBMISSION_DATE" value="<?=$SUBMISSION_DATE?>"></td>

           </tr>

         

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		   

         <tr>

           <td width="49%">

             Department:

            </td>

        <td width="51%"><select name="DEPARTMENT">

             <? foreign_relation('department', 'DEPT_ID', 'DEPT_SHORT_NAME', $DEPARTMENT, ' 1 order by DEPT_SHORT_NAME asc')?>

           </select></td>

        </tr>

		 <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Requested By : </td>

           <td><select name="REQ_BY">

             <? foreign_relation('personnel_basic_info p, designation d','p.PBI_ID','concat(p.PBI_NAME," - ",d.DESG_DESC)',$req_by,'p.PBI_DESIGNATION=d.DESG_ID and p.PBI_JOB_STATUS="In Service" order by p.PBI_NAME');?>

           </select></td>

           </tr>

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Expected Joing Date To:</td>

           <td><input type="text" id="EXPECTED_DATE" name="EXPECTED_DATE_FROM" value="<?=$EXPECTED_DATE_FROM?>"></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Salary Range To:</td>

           <td> <input type="text" name="SALARY_FROM" value="<?=$SALARY_FROM?>"/></td>

           </tr>

		   

		    <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

         

         <tr>

           <td>Remarks:</td>

           <td><input type="text" name="REMARKS" value="<?=$REMARKS?>"/></td>

           </tr>

         

	 <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		<tr bgcolor="#CCCCCC">

			<br>

           <td colspan="2"><div align="center">Line Graph Status</div></td>

          	<br>

           </tr>

         

		 <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		 <tr>

           <td>Management Approval Date:</td>

           <td><input type="text" name="MANAGEMENT_APPROVE_DATE" id="MANAGEMENT_APPROVE_DATE" value="<?=$MANAGEMENT_APPROVE_DATE?>"></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td>Job Post Date:</td>

           <td><input type="text" name="JOB_POST_DATE" id="JOB_POST_DATE" value="<?=$JOB_POST_DATE?>"></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td>Cv Collection Date:</td>

           <td><input type="text" name="CV_COLLECTION_DATE" id="CV_COLLECTION_DATE" value="<?=$CV_COLLECTION_DATE?>"></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td>Cv Sorting Date:</td>

           <td><input type="text" name="CV_SORTING_DATE" id="CV_SORTING_DATE" value="<?=$CV_SORTING_DATE?>"></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td>Interview Process Date:</td>

           <td><input type="text" name="INTERVIEW_PROCESS_DATE" id="INTERVIEW_PROCESS_DATE" value="<?=$INTERVIEW_PROCESS_DATE?>"></td>

           </tr>

          <tr>

		     <td>&nbsp;</td>

			 <td>&nbsp;</td>

		   </tr>

		

		 <tr>

           <td>Joining Date:</td>

           <td><input type="text" name="JOINING_DATE" id="JOINING_DATE" value="<?=$JOINING_DATE?>"></td>

           </tr>

         

		

       </table>

      

     </div></td>



                  </tr>

                </tbody></table>



              <p>&nbsp;</p></td>



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



