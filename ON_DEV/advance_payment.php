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

$title='Advance Payments';			// Page Name and Page Title

$page="advance_payment.php";		// PHP File Name

$input_page="advance_payment.php";

$root='payroll';



$table='salary_advance';		// Database Table Name Mainly related to this page

$unique='id';			// Primary Key of this Database table

$shown='advance_amt';				// For a New or Edit Data a must have data field



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



if($_POST['advance_type']=='Advance Cash'){
	//For Accounts

  // $date = $_POST['start_year'].'-'.$_POST['start_mon'].'-'.'30';

  $date = date('Y-m-d');

//$month_num = $smon;
//$month_name = date("F", mktime(0, 0, 0, $month_num, 10));

$startdate = $_POST['start_year'].'-'.$_POST['start_mon'].'-'.'01';

//$enddate = $syear.'-'.$smon.'-'.'01';

$enddate = $_REQUEST['current_year'].'-'.$_REQUEST['current_mon'].'-'.'01';





   $jv_date = strtotime($date);
   $narration_dr = 'Advance salary for  '.date('d-M-Y',strtotime($date)).' And It will be adjusted from  '.date('d-M-Y',strtotime($startdate)).' To '.date('d-M-Y',strtotime($enddate));
   $narration_cr = 'Advance salary for  '.date('d-M-Y',strtotime($date)).' And It will be adjusted from  '.date('d-M-Y',strtotime($startdate)).' To '.date('d-M-Y',strtotime($enddate));
   $tr_from = 'Salary_advance';
   $tr_no = $_SESSION['employee_selected'].$_POST['start_mon'].$_POST['start_year'];
   $tr_id = $_SESSION['employee_selected'];
   $jv_no = next_journal_sec_voucher_id();
   $emp_cc_code = find_a_field('personnel_basic_info','emp_cc_code','PBI_ID="'.$_POST['PBI_ID'].'"');
  //old

   //$ledger_id_dr = 4067000700000000;


   $ledger_id_cr = 1086000500000000;

   $advance_ledgerid_dr =find_a_field('personnel_basic_info','advance_ledger_id','PBI_ID="'.$tr_id.'"');

   $total_payable = $_POST['advance_amt'];








  add_to_sec_journal('Aksid', $jv_no, $jv_date, $advance_ledgerid_dr,$narration_dr, $total_payable, '0', $tr_from, $tr_no,$sub_ledger='',$tr_id,$emp_cc_code);

  add_to_sec_journal('Aksid', $jv_no, $jv_date, $ledger_id_cr,$narration_cr, '0', $total_payable, $tr_from, $tr_no,$sub_ledger='',$tr_id,$emp_cc_code);
  



  $update = 'update secondary_journal set PBI_ID="'.$tr_id.'" where jv_no="'.$jv_no.'" and tr_from="'.$tr_from.'"';

   $upqr = mysql_query($update);



  //End Accounts portion

  }


  ////////////////////// SQL FOR ACCOUNTS AUTO JOURNAL //////////////////////////////






  //////////////////// END SQL FOR ACCOUNTS AUTO JOURNAL ///////////////////////////




















$type=1;

$msg='New Entry Successfully Inserted.';



unset($_POST);

unset($$unique);

}





//for Modify..................................



if(isset($_POST['update']))

{

       unset($_POST);
	   unset($$unique);

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
var totlAmt=document.getElementById('advance_amt').value;
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
                    <h2><?=$title?></h2>
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

        <h2>

		<label for="oe-field-input-27" title="" class="oe_form_label oe_align_center"><?=$title?></label> </h2>




                    <ul class="stats-overview">

											<li>
												<span class="name"> Advance Salary Ledger </span>
												<span class="value text-success"> <? $salary_ledger=find_a_field('personnel_basic_info','advance_ledger_id','PBI_ID="'.$_SESSION['employee_selected'].'"');
												if($salary_ledger>0){
												echo $salary_ledger;
												}else{echo "<p class='text-danger'>Missing</p>";}
												?> </span>
											</li>
											<li>
												<span class="name"> Advance IOU Ledger  </span>
												<span class="value text-success"> 	<? $iou_ledger=find_a_field('personnel_basic_info','advance_iou_ledger_id','PBI_ID="'.$_SESSION['employee_selected'].'"');
													if($iou_ledger>0){
													echo $iou_ledger;
												}else{echo "<p class='text-danger'>Missing</p>";}
													?> </span>
											</li>
											<li class="hidden-phone">
												<span class="name"> Cost Center </span>
												<span class="value text-success"> <? $cost=find_a_field('personnel_basic_info','emp_cc_code','PBI_ID="'.$_SESSION['employee_selected'].'"');
												if($cost>0){
												echo $cost;
												}else{echo "<p class='text-danger'>Missing</p>";}
												?></span>
											</li>
										</ul>




		  <table class="oe_form_group " border="0" cellpadding="0" cellspacing="0"><tbody><tr class="oe_form_group_row">

            <td class="oe_form_group_cell"><table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">

              <tbody>

                <tr class="oe_form_group_row">

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Advance Amount :</strong></td>

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell"><input name="advance_amt" type="text" id="advance_amt" value="<?=$advance_amt?>" required />

                    <input type="hidden" name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" />

                    <label for="textfield"></label>

                    <input type="hidden" name="PBI_ID" id="PBI_ID" value="<?=$_SESSION['employee_selected']?>" /></td>

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Number of installment:</strong></td>

                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><input name="total_installment" type="text" id="total_installment" value="<?=$total_installment?>" onkeyup="perMonAmount()" maxlength="3" /></td>

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
<? for($i=(date('Y')-1); $i<=(date('Y')+1); $i+=1){?>
<option <?=($start_year==$i)?'selected':''?>><?=$i?></option>
<? }?>
</select>

                  </td>

                </tr>

<? if($$unique>0){?>

<!--<tr class="oe_form_group_row">

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
<? for($i=(date('Y')-1); $i<=(date('Y')+1); $i+=1){?>
<option <?=($start_year==$i)?'selected':''?>><?=$i?></option>
<? }?>
</select>



</td>

</tr>-->

<? }?>

                <tr class="oe_form_group_row">

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Monthly Payable Amt :</strong></td>

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell"><input name="payable_amt" type="text" id="payable_amt" value="<?=$payable_amt?>" required /></td>

                  <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Install Type:</strong></td>

                  <td bgcolor="#E8E8E8" class="oe_form_group_cell"><label for="advance_type"></label>

                    <select name="advance_type" id="advance_type" required>

                    <option></option>

                    <option <?=($advance_type=='Advance Cash')?'selected':'';?> value="Advance Cash" >Advance Salary</option>

                    <option <?=($advance_type=='Other Advance')?'selected':'';?> value="Other Advance">Advance IOU Adjusment</option>

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

          <? 	$res='select id, (case when advance_type="Advance Cash" then "Advance Salary" when advance_type="Other Advance" then "Advance IOU Adjusment" end) as advance_type ,payable_amt, installment_no,concat(current_mon,"-",current_year) as payable_month,total_installment ,	 concat(start_mon,"-",start_year) as start_month,advance_amt as total_advance_amt  from salary_advance where PBI_ID="'.$_SESSION['employee_selected'].'" order by id desc';

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
        <!-- /page content -->

    </div>







<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../../template/main_layout.php");
include_once("../../template/footer.php");

?>
