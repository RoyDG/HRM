<?php



session_start();



ob_start();



require "../../config/inc.all.php";



//Use this to search id

if(isset($_POST['button'])){

$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);

$_SESSION['employee_selected'] = $pbi_new_code;

}








// ::::: Edit This Section ::::: 



$title='Other Deduction';			// Page Name and Page Title



$page="other_deductions.php";		// PHP File Name



//$input_page="advance_payment.php";



$root='payroll';







$table='salary_other_deductions';		// Database Table Name Mainly related to this page



$unique='id';			// Primary Key of this Database table



$shown='deduction_amt';				// For a New or Edit Data a must have data field







// ::::: End Edit Section :::::



// ::::: End Edit Section :::::


  
if($_POST['start_mon']!=''){

$start_mon=$_POST['start_mon'];}

else{

$start_mon=date('n');

}



if($_POST['start_year']!=''){

$start_year=$_POST['start_year'];}

else{

$start_year=date('Y');

}




$crud      =new crud($table);







$$unique = $_GET[$unique];



if(isset($_POST[$shown]))



{



	



$$unique = $_POST[$unique];







if(isset($_POST['insert'])||isset($_POST['insertn']))



{		



$now				= time();







$_POST['PBI_ID']=$_SESSION['employee_selected'];



for($i=0;$i<$_POST['total_installment'];$i++)



{



$smon=$_POST['start_mon']+$i;



$syear=$_POST['start_year'];



$_REQUEST['current_mon'] = date('m',mktime(1,1,1,$smon,1,$syear));



$_REQUEST['current_year'] = date('Y',mktime(1,1,1,$smon,1,$syear));



$_REQUEST['installment_no'] = $i+1;



$crud->insert();



}







$type=1;



$msg='New Entry Successfully Inserted.';







unset($_POST);



unset($$unique);



}











//for Modify..................................







if(isset($_POST['update']))



{







		$crud->update($unique);



		$type=1;



		$msg='Successfully Updated.';







}



//for Delete..................................







if(isset($_POST['delete']))



{		$condition=$unique."=".$$unique;		$crud->delete($condition);



		unset($$unique);







		$type=1;



		$msg='Successfully Deleted.';



}



}







if(isset($$unique))



{



$condition=$unique."=".$$unique;



$data=db_fetch_object($table,$condition);



while (list($key, $value)=@each($data))



{ $$key=$value;}



}



if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);







$$unique = $_GET[$unique];







?>



<script type="text/javascript"> 

function DoNav(lk){



	document.location.href = '<?=$page?>?<?=$unique?>='+lk;



	}

	

function perMonAmount(){

var totlAmt=document.getElementById('deduction_amt').value;

var totInst=document.getElementById('total_installment').value;

var perMonth=totlAmt/totInst;

document.getElementById('payable_amt').value=perMonth;

}	

	</script>



<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->

          <div class="">

		  

		  

           

        <div class="clearfix"></div>



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>Plain Page</h2>

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

                    

                    

              

			

				  

				  

                  <div class="x_content">	









<div class="oe_view_manager oe_view_manager_current">



      <form action="" method="post" enctype="multipart/form-data">  



    <? include('../../common/title_bar.php');?>



    </form>



    <form action="" method="post" enctype="multipart/form-data">



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



                        <div class="oe_form_sheet oe_form_sheet_width" style="min-height:100px;">



        <h1><label for="oe-field-input-27" title="" class=" oe_form_label oe_align_right">



        <a href="home2.php" rel = "gb_page_center[940, 600]"><?=$title?></a>



    </label>



          </h1><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0"><tbody><tr class="oe_form_group_row">



            <td class="oe_form_group_cell"><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">



              <tbody>



                <tr class="oe_form_group_row">



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Deduction Amount :</strong></td>



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell"><input name="deduction_amt" type="text" id="deduction_amt" value="<?=$deduction_amt?>" required />



                    <input type="hidden" name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" />



                    <label for="textfield"></label>



                    <input type="hidden" name="PBI_ID" id="PBI_ID" value="<?=$_SESSION['employee_selected']?>" /></td>



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Total Install :</strong></td>



                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="total_installment" type="text" id="total_installment" value="<?=$total_installment?>" onkeyup="perMonAmount()" /></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Start Month :</strong></td>



                  <td colspan="1" class="oe_form_group_cell">      <select name="start_mon" style="width:160px;" id="start_mon" required>



        <option value="1" <?=($start_mon=='1')?'selected':''?>>Jan</option>



        <option value="2" <?=($start_mon=='2')?'selected':''?>>Feb</option>



        <option value="3" <?=($start_mon=='3')?'selected':''?>>Mar</option>



        <option value="4" <?=($start_mon=='4')?'selected':''?>>Apr</option>



        <option value="5" <?=($start_mon=='5')?'selected':''?>>May</option>



        <option value="6" <?=($start_mon=='6')?'selected':''?>>Jun</option>



        <option value="7" <?=($start_mon=='7')?'selected':''?>>Jul</option>



        <option value="8" <?=($start_mon=='8')?'selected':''?>>Aug</option>



        <option value="9" <?=($start_mon=='9')?'selected':''?>>Sep</option>



        <option value="10" <?=($start_mon=='10')?'selected':''?>>Oct</option>



        <option value="11" <?=($start_mon=='11')?'selected':''?>>Nov</option>



        <option value="12" <?=($start_mon=='12')?'selected':''?>>Dec</option>



      </select></td>



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Start Year :</strong></td>



                  <td class="oe_form_group_cell">



<select name="start_year" style="width:160px;" id="start_year" required>

<? for($i=(date('Y')-1); $i<=(date('Y')+10); $i+=1){?>

<option <?=($start_year==$i)?'selected':''?>><?=$i?></option>

<? }?>

</select>



                  </td>



                </tr>



<? if($$unique>0){?>



<tr class="oe_form_group_row">



<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Current Month :</strong></td>



<td colspan="1" class="oe_form_group_cell">      <select name="current_mon" style="width:160px;" id="current_mon" required>



        <option value="1" <?=($current_mon=='1')?'selected':''?>>Jan</option>



        <option value="2" <?=($current_mon=='2')?'selected':''?>>Feb</option>



        <option value="3" <?=($current_mon=='3')?'selected':''?>>Mar</option>



        <option value="4" <?=($current_mon=='4')?'selected':''?>>Apr</option>



        <option value="5" <?=($current_mon=='5')?'selected':''?>>May</option>



        <option value="6" <?=($current_mon=='6')?'selected':''?>>Jun</option>



        <option value="7" <?=($current_mon=='7')?'selected':''?>>Jul</option>



        <option value="8" <?=($current_mon=='8')?'selected':''?>>Aug</option>



        <option value="9" <?=($current_mon=='9')?'selected':''?>>Sep</option>



        <option value="10" <?=($current_mon=='10')?'selected':''?>>Oct</option>



        <option value="11" <?=($current_mon=='11')?'selected':''?>>Nov</option>



        <option value="12" <?=($current_mon=='12')?'selected':''?>>Dec</option>



      </select></td>



<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Current Year :</strong></td>



<td class="oe_form_group_cell">







<select name="current_year" style="width:160px;" id="current_year" required>

<? for($i=(date('Y')-1); $i<=(date('Y')+10); $i+=1){?>

<option <?=($start_year==$i)?'selected':''?>><?=$i?></option>

<? }?>

</select>







</td>



</tr>



<? }?>



                <tr class="oe_form_group_row">



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Monthly Payable Amt :</strong></td>



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell"><input name="payable_amt" type="text" id="payable_amt" value="<?=$payable_amt?>" required /></td>



                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Deduction Type:</strong></td>



                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><label for="deduction_type"></label>



                    <select name="deduction_type" id="deduction_type" required>

                  <option <?=($deduction_type=='Others')?'selected':'';?>>Others</option>

            



                   <?php /*?> <option <?=($deduction_type=='IOU Adjustment')?'selected':'';?>>IOU Adjustment</option><?php */?>



                   



                    </select></td>



                </tr>

				

				 <tr class="oe_form_group_row">



                  <td class="oe_form_group_cell"><strong>&nbsp;&nbsp;Deduction Remarks</strong></td>

				   <td colspan="3" class="oe_form_group_cell"><textarea name="deduction_remarks" id="deduction_remarks" style="width:93%;"><?=$deduction_remarks?></textarea></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="4" class="oe_form_group_cell">&nbsp;</td>



                </tr>



                </tbody></table>



</td>



          </tr></tbody></table>



                        </div>



                      </div>



<div class="oe_form_sheetbg">



        <div class="oe_form_sheet oe_form_sheet_width">







          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">



          <? $res = 'SELECT id,
        deduction_type,
        payable_amt,
        installment_no,
        CONCAT(MONTHNAME(STR_TO_DATE(current_mon, "%m")), "-", current_year) AS payable_month,
        total_installment,
        CONCAT(MONTHNAME(STR_TO_DATE(start_mon, "%m")), "-", start_year) AS start_month,
        deduction_amt AS total_deduction_amt
    FROM ' . $table . '
    WHERE PBI_ID = "' . $_SESSION['employee_selected'] . '"
    ORDER BY id DESC';



				echo $crud->link_report($res,$link);?>



          </div></div>



          </div>



    </div>



    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">



      <div class="oe_follower_list"></div>



    </div></div></div></div></div>



    </div></div>



            



        </div>



        </form>



    </div>

	

	

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