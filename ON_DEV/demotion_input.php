<?php

session_start();



require "../../config/inc.all.php";



// ::::: Edit This Section ::::: 

$title='Demotion Management';			// Page Name and Page Title

$page="demotion.php";		// PHP File Name

$input_page="demotion_input.php";

$root='hrm';



$table='demotion_detail';		// Database Table Name Mainly related to this page

$unique='DEMOTION_D_ID';			// Primary Key of this Database table

$shown='DEMOTION_REF';				// For a New or Edit Data a must have data field



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


if($_FILES['DEMOTION_DOC_FILE']['tmp_name']!=''){
	$file_name= $_FILES['DEMOTION_DOC_FILE']['name'];
	$file_tmp= $_FILES['DEMOTION_DOC_FILE']['tmp_name'];
	$ext=end(explode('.',$file_name));
	$path='../../pic/demotion_doc/';
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


if($_FILES['DEMOTION_DOC_FILE']['tmp_name']!=''){
	$file_name= $_FILES['DEMOTION_DOC_FILE']['name'];
	$file_tmp= $_FILES['DEMOTION_DOC_FILE']['tmp_name'];
	$ext=end(explode('.',$file_name));
	$path='../../pic/demotion_doc/';
	move_uploaded_file($file_tmp, $path.$$unique.'.pdf');
	}
	
	
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

<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>

<script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  tinymce.init({ selector:'textarea', menubar: false });
</script>

<? do_calander('#DEMOTION_DATE');?><? do_calander('#DEMOTION_EFF_DATE');?>
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

            <td class="oe_form_group_cell"><table width="228" height="98" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">

              <tbody>

                <tr class="oe_form_group_row">

                  <td width="18%" colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Reference No:</td>

                  <td bgcolor="#E8E8E8" width="32%" colspan="1" class="oe_form_group_cell">

                  <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />

                  <input name="DEMOTION_REF" type="text" id="DEMOTION_REF" value="<?=$DEMOTION_REF?>" /></td>

                  <td width="20%" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell">&nbsp;</td>

                  <td bgcolor="#E8E8E8" width="30%" class="oe_form_group_cell">&nbsp;</td>
                </tr>

                <tr class="oe_form_group_row">
                  <td colspan="1" nowrap class="oe_form_group_cell oe_form_group_cell_label">Issue Date :</td>
                  <td class="oe_form_group_cell"><input name="DEMOTION_DATE" type="text" id="DEMOTION_DATE" value="<?=$DEMOTION_DATE?>" /></td>
                  <td nowrap class="oe_form_group_cell">Effective Date : </td>
                  <td class="oe_form_group_cell"><input name="DEMOTION_EFF_DATE" type="text" id="DEMOTION_EFF_DATE" value="<?=$DEMOTION_EFF_DATE?>" /></td>
                </tr>
                <tr class="oe_form_group_row">

                  <td colspan="1" nowrap class="oe_form_group_cell oe_form_group_cell_label"><label>Designation :</label></td>

                  <td class="oe_form_group_cell"><select name="DEMOTION_PAST_DESG">

                    <? foreign_relation('designation','DESG_ID','DESG_DESC',$DEMOTION_PAST_DESG);?>

                  </select></td>

                  <td nowrap class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Reporting Authority </span></td>

                  <td class="oe_form_group_cell"><select name="DEMOTION_REPORTING_AUTH">
                    <? foreign_relation('personnel_basic_info p, designation d','p.PBI_ID','concat(p.PBI_NAME," - ",d.DESG_DESC)',$DEMOTION_REPORTING_AUTH,'p.PBI_DESIGNATION=d.DESG_ID and p.PBI_JOB_STATUS="In Service" order by p.PBI_NAME');?>
                  </select></td>
                </tr>

                <tr class="oe_form_group_row">

                  <td colspan="1" nowrap bgcolor="#E8E8E8" class="oe_form_group_cell oe_form_group_cell_label">Job Responsibility  :</td>

                  <td colspan="3" bgcolor="#E8E8E8" class="oe_form_group_cell"><textarea name="DEMOTION_NOTES" id="DEMOTION_NOTES"><?=$DEMOTION_NOTES?></textarea></td>
                  </tr>
				
				<tr class="oe_form_group_row">
					<td height="33" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Document : </td>
					<td class="oe_form_group_cell"><input name="DEMOTION_DOC_FILE" type="file" id="DEMOTION_DOC_FILE" /></td>
					<td class="oe_form_group_cell">&nbsp;</td>
					<?
					$path = '../../pic/demotion_doc/'.$$unique.'.pdf';
					if(is_file($path)){
					?>
					<td class="oe_form_group_cell"><a href="<?php echo $path?>" target="_blank">VIEW DOC</a>
					<iframe src="<?php echo $path?>" title="PDF" align="top" height="600" width="400" frameborder="0" scrolling="auto" target="Message"></iframe></td>
					<? }?>
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

