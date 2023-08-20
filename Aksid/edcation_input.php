<?php

session_start();



require "../../config/inc.all.php";



// ::::: Edit This Section ::::: 

$title='Education Management';			// Page Name and Page Title

$page="edcation.php";		// PHP File Name

$input_page="edcation_input.php";

$root='hrm';



$table='education_detail';		// Database Table Name Mainly related to this page

$unique='EDUCATION_D_ID';			// Primary Key of this Database table

$shown='EDUCATION_NOE';				// For a New or Edit Data a must have data field



// ::::: End Edit Section :::::





$crud      =new crud($table);



$$unique = $_GET[$unique];

if(isset($_POST[$shown]))

{

$$unique = $_POST[$unique];



if(isset($_POST['insert'])||isset($_POST['insertn']))

{		

$now				= time();

$_REQUEST['PBI_ID']=$_SESSION['employee_selected'];



$crud->insert();

if($_FILES['EDUCATION_DOCUMENT']['tmp_name']!=''){
	$file_name= $_FILES['EDUCATION_DOCUMENT']['name'];
	$file_tmp= $_FILES['EDUCATION_DOCUMENT']['tmp_name'];
	$ext=end(explode('.',$file_name));
	$path='../../pic/edu_certificate/';
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



		$crud->update($unique);

if($_FILES['EDUCATION_DOCUMENT']['tmp_name']!=''){
	$file_name= $_FILES['EDUCATION_DOCUMENT']['name'];
	$file_tmp= $_FILES['EDUCATION_DOCUMENT']['tmp_name'];
	$ext=end(explode('.',$file_name));
	$path='../../pic/edu_certificate/';
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

if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);

?>
<html style="height: 100%;">
<head>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link href="../../css/css.css" rel="stylesheet">
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>




$(document).ready(function(){

   $('#EDUCATION_BU').click(function(){

     var rBtnVal = $(this).val();

     if(rBtnVal == "Foreign Institute / University"){
         $("#foreign_inst").attr("readonly", false); 
     }
     else{ 
         $("#foreign_inst").attr("readonly", true); 
     }
   });
});


$(document).ready(function(){

   $('#EDUCATION_GRADE_CLASS').click(function(){

     var rBtnVal = $(this).val();

     if(rBtnVal!="" && rBtnVal!= "Grade/CGPA"){
         $("#EDUCATION_TOTAL_MARK").attr("readonly", false);
		 $("#EDUCATION_GPA, #out_of").attr("readonly", true);
		 $("#EDUCATION_GPA, #out_of").val(''); 
     }
     if(rBtnVal!="" && rBtnVal== "Grade/CGPA"){ 
         $("#EDUCATION_GPA, #out_of").attr("readonly", false); 
		 $("#EDUCATION_TOTAL_MARK").attr("readonly", true);
		 $("#EDUCATION_TOTAL_MARK").val('');
     }
	 
	 if(rBtnVal=="Enrolled" || rBtnVal==""){ 
         $("#EDUCATION_GPA, #out_of").attr("readonly", true);
		 $("#EDUCATION_GPA, #out_of").val(''); 
		 $("#EDUCATION_TOTAL_MARK").attr("readonly", true);
     }
	 
   });
});


$(document).ready(function(){

   $('#EDUCATION_NOE').click(function(){

     var rBtnVal = $(this).val();

     if(rBtnVal== "Doctoral"){
         $("#EDUCATION_THESIS_TOPIC").attr("readonly", false); 
     }
     else{
		 $("#EDUCATION_THESIS_TOPIC").attr("readonly", true);
     }
	 

   });
});


</script>
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
                          <td class="oe_form_group_cell"><table width="274" height="156" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">
                              <tbody>
                                <tr class="oe_form_group_row">
                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Level of Education  :</td>
                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />
                                    <select name="EDUCATION_NOE" id="EDUCATION_NOE">
										
                                      <? foreign_relation('edu_qua','EDU_QUA_DESC','EDU_QUA_DESC','EDUCATION_NOE',$EDUCATION_NOE,'1 order by EDUCATION_NOE');?>
										
										
										
                                    </select></td>
                                  <td width="15%" bgcolor="#E8E8E8" class="oe_form_group_cell">Exam / Degree Title  :</td>
                                  <td bgcolor="#E8E8E8" width="37%" class="oe_form_group_cell"><select name="EDUCATION_EXAM" id="EDUCATION_EXAM">
									  
                                    <? foreign_relation('edu_exam_title','EXAM_CODE','EXAM_NAME',$EDUCATION_EXAM,'1 order by EXAM_NAME');?>
									  
                                  </select></td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><label>Concentration / Major / Group :</label></td>
                                  <td colspan="2" class="oe_form_group_cell">
									  
									  <select name="EDUCATION_SUBJECT" id="EDUCATION_SUBJECT">
										  
                                      <? foreign_relation('edu_subject','SUBJECT_NAME','SUBJECT_NAME',$EDUCATION_SUBJECT,'1 order by SUBJECT_NAME');?>
									  
									 								  
                                    </select></td>
                                  <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Thesis Topic :</span></td>
                                  <td class="oe_form_group_cell"><input readonly="readonly" name="EDUCATION_THESIS_TOPIC" type="text" id="EDUCATION_THESIS_TOPIC" value="<?=$EDUCATION_THESIS_TOPIC?>" /></td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Name of Institute :</td>
                                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="EDUCATION_NOI" type="text" id="" value="<?=$EDUCATION_NOI?>"  />
                                  </td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Board / University :</span></td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="EDUCATION_BU" id="EDUCATION_BU">
                                      <? foreign_relation('university','UNIVERSITY_NAME','UNIVERSITY_NAME',$EDUCATION_BU,'1 order by UNIVERSITY_NAME');?>
                                    </select></td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Foreign Institute / University </td>
                                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input readonly="readonly" name="foreign_inst" type="text" id="foreign_inst" value="<?=$foreign_inst?>" /></td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Result :</span></td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><select name="EDUCATION_GRADE_CLASS" id="EDUCATION_GRADE_CLASS">
                                      <option selected>
                                      <?=$EDUCATION_GRADE_CLASS?>
                                      </option>
                                      <option>1st Division / Class</option>
                                      <option>2nd Division / Class</option>
                                      <option>3rd Division / Class</option>
                                      <option value="Grade/CGPA">Grade/CGPA</option>
                                      <option value="Appeared">Appeared</option>
                                      <option value="Enrolled">Enrolled</option>
                                      <option value="Awarded">Awarded</option>
                                    </select></td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td colspan="2" align="left" bgcolor="#E8E8E8" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">CGPA / GPA :</span></td>
                                  <td align="left" bgcolor="#E8E8E8" class="oe_form_group_cell"><input readonly="readonly"  style="width: 30px;" name="EDUCATION_GPA" type="text" id="EDUCATION_GPA" value="<?=$EDUCATION_GPA?>" />
                                    &nbsp;&nbsp;Out Of:&nbsp;&nbsp;
                                    <input readonly="readonly"  style="width: 30px;" name="out_of" type="text" id="out_of" value="<?=$out_of?>" /></td>
                                  <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Total Marks :</span></td>
                                  <td class="oe_form_group_cell"><span class="oe_form_field oe_datepicker_root oe_form_field_date">
                                    <input name="EDUCATION_TOTAL_MARK" type="text" id="EDUCATION_TOTAL_MARK" value="<?=$EDUCATION_TOTAL_MARK?>" readonly="readonly" />
                                    </span></td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Passing Year :</td>
                                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="EDUCATION_YEAR" type="text" id="EDUCATION_YEAR" value="<?=$EDUCATION_YEAR?>"/>
                                  </td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell">Duration (Year):</td>
                                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="duration" type="text" id="duration" value="<?=$duration?>" />
                                  </td>
                                </tr>
                                <tr class="oe_form_group_row">
                                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Achievement :</td>
                                  <td colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="achievement" type="text" id="achievement" value="<?=$achievement?>" />
                                  </td>
                                  <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Document (JPG/PDF):</span></td>
                                  <td class="oe_form_group_cell"><span class="EDUCATION_DOCUMENT">
                                    <input  style="height: 30px;" name="EDUCATION_DOCUMENT" type="file" id="EDUCATION_DOCUMENT" value="<?=$EDUCATION_DOCUMENT?>" />
                                    </span></td>
                                </tr>
								<?
				$path = '../../pic/edu_certificate/'.$$unique.'.pdf';
				if(is_file($path)){
				?>
				<tr class="oe_form_group_row">
					<td height="33" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>
					<td class="oe_form_group_cell"><a href="<?php echo $path?>" target="_blank">VIEW DOC</a>
					<iframe src="<?php echo $path?>" title="PDF" align="top" height="600" width="400" frameborder="0" scrolling="auto" target="Message"></iframe>
					</td>
					<td class="oe_form_group_cell">&nbsp;</td>
					<td class="oe_form_group_cell">&nbsp;</td>
				</tr>
				<? }?>
                              </tbody>
                            </table></td>
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
