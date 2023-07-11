<?php



session_start();







require "../../config/inc.all.php";







// ::::: Edit This Section ::::: 



$title='Tax Challan Input';			// Page Name and Page Title



$page="tax_chalan.php";		// PHP File Name



$input_page="tax_chalan_input.php";



$root='hrm';







$table='emp_taxchalan_no';		// Database Table Name Mainly related to this page



$unique='id';			// Primary Key of this Database table



$shown='tax_chalan_no';				// For a New or Edit Data a must have data field







// ::::: End Edit Section :::::











$crud      =new crud($table);







$$unique = $_GET[$unique];



if(isset($_POST[$shown]))



{



$$unique = $_POST[$unique];







if(isset($_POST['insert'])||isset($_POST['insertn']))



{		



$now				= time();

unset($_REQUEST['id']);


$_REQUEST['PBI_ID']=$_SESSION['employee_selected'];

$_REQUEST['s_mon']=date('n',strtotime($_POST['chalan_start_date']));

$_REQUEST['s_year']= $_POST['s_year']; //date('Y',strtotime($_POST['chalan_start_date']));

$_REQUEST['e_mon']=date('n',strtotime($_POST['chalan_end_date']));

$_REQUEST['e_year']= $_POST['e_year'];  //date('Y',strtotime($_POST['chalan_end_date']));


$_REQUEST['assesment_s_year']= $_POST['assesment_s_year'];

$_REQUEST['assesment_e_year']= $_POST['assesment_e_year'];



$_REQUEST['chalan_start_date']=date('Y-m-d',strtotime($_POST['chalan_start_date']));

$_REQUEST['chalan_end_date']=date('Y-m-d',strtotime($_POST['chalan_start_date']));





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



$_REQUEST['s_mon']=date('n',strtotime($_POST['chalan_start_date']));

$_REQUEST['s_year']= $_POST['s_year']; // date('Y',strtotime($_POST['chalan_start_date']));

$_REQUEST['e_mon']=date('n',strtotime($_POST['chalan_end_date']));

$_REQUEST['e_year']= $_POST['e_year']; //date('Y',strtotime($_POST['chalan_end_date']));

$_REQUEST['chalan_start_date']=date('Y-m-d',strtotime($_POST['chalan_start_date']));

$_REQUEST['chalan_end_date']=date('Y-m-d',strtotime($_POST['chalan_start_date']));

$_REQUEST['assesment_s_year']= $_POST['assesment_s_year'];

$_REQUEST['assesment_e_year']= $_POST['assesment_e_year'];



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

                      <label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right"> 
                        <a href="home2.php" rel = "gb_page_center[940, 600]">

                      <?=$title?>

                      </a> </label>

                    </h1>

                    <table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">

                      <tbody>

                        <tr class="oe_form_group_row">

                          <td class="oe_form_group_cell"><table width="274" height="156" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">

                              <tbody>

                                <tr class="oe_form_group_row">

                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Tax Challan No :</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">

								  <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />

								  

								  <input name="tax_chalan_no" id="tax_chalan_no" value="<?=$tax_chalan_no?>" type="text" />

								  

                                  </td>

									

									

                              

                                  

                                </tr>

								

								<tr class="oe_form_group_row">

                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Tax Challan  Date:</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">

								 

								  <input name="chalan_start_date"  id="chalan_start_date" value="<?=$chalan_start_date?>" type="date" />
								  
								   <input name="chalan_end_date"  id="chalan_end_date" value="<?=$_POST['chalan_start_date'];?>" type="hidden"/>
                                  </td></tr>
								  
								  
								  
								  <tr class="oe_form_group_row">
									
                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Tax Start Year:</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
                                  <input name="s_year"  id="s_year" value="<?=$s_year?>" type="number" min="2021" max="2099" step="1"  />
                                   </td> 
									
								 </tr>
								  
								  
								  
								  
								<tr class="oe_form_group_row">
									
									<td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Tax End Year:</td>
									
									<td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
										<input name="e_year"  id="e_year" value="<?=$e_year?>" type="number" min="2021" max="2099" step="1"  />
									</td>
									
								 </tr>

								  
								  
							<?php /*?>	  <tr class="oe_form_group_row">

                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Tax Chalan End Date:</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">

								 

								  <input name="chalan_end_date"  id="chalan_end_date" value="<?=$chalan_end_date?>" type="date" />

								  

                                  </td> </tr><?php */?>
								  
								  
								  
								  
								  <tr class="oe_form_group_row">

                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Assessment Start Year:</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="assesment_s_year"  id="assesment_s_year" value="<?=$assesment_s_year?>" type="number" min="2021" max="2099" step="1" />
                                  </td>

								   </tr>

                                

								

								<tr class="oe_form_group_row">

                                  <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Assessment End Year:</td>

                                  <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">

								 

								  <input name="assesment_e_year"  id="assesment_e_year" value="<?=$assesment_e_year?>" type="number" min="2021" max="2099" step="1"  />

								  

                                  </td> </tr>
								  
								  
								  
								
								

								<tr class="oe_form_group_row">
                                <td bgcolor="#E8E8E8" width="19%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Challan Amount:</td>
                                <td width="29%" colspan="2" bgcolor="#E8E8E8" class="oe_form_group_cell">
                                <input name="chalan_amt"  id="chalan_amt" value="<?=$chalan_amt?>" type="text" />
                                </td>

									

									

                              

                                  

                                </tr>

                                

                                

                                

                                

                                

                                

				

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

