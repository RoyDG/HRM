<?php

session_start();

require "../support/inc.voucher.php";

require_once ('../common/class.numbertoword.php');



$jv_no=$_REQUEST['jv_no'];

if(prevent_multi_submit()){

if($_POST['check']=='CHECK')

{

	$time_now = date('Y-m-d H:s:i');

	$voucher_date = strtotime($_POST['voucher_date']);

	$jv=next_journal_voucher_id();

	

	$ssql='update secondary_journal set jv_date="'.$voucher_date.'",  checked_at="'.$time_now.'", checked_by="'.$_SESSION['user']['id'].'", checked="YES" , 	final_jv_no="'.$jv.'" where jv_no="'.$jv_no.'"';

	mysql_query($ssql);

	

	sec_journal_journal($jv_no,$jv,'Salary_advance');

}

}



$address=find_a_field('project_info','proj_address',"1");

$jv = find_all_field('secondary_journal','jv_date','jv_no='.$jv_no);

$ch = find_all_field('sale_do_chalan','pr_no','chalan_no='.$jv->tr_no);


$do_commission=find_a_field('sale_do_master','cash_discount',"do_no=".$ch->do_no);



?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>.: Voucher :.</title>

<link href="../css/voucher_print.css" type="text/css" rel="stylesheet"/>



<link href="../../warehouse_mod/css/pagination.css" rel="stylesheet" type="text/css" />

<link href="../../warehouse_mod/css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />

<link href="../../warehouse_mod/css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="../../warehouse_mod/js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/jquery-ui-1.8.2.custom.min.js"></script>



<script type="text/javascript" src="../../warehouse_mod/js/jquery.autocomplete.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/jquery.validate.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/paging.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/ddaccordion.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/js.js"></script>

<script type="text/javascript" src="../../warehouse_mod/js/jquery.ui.datepicker.js"></script>

<script type="text/javascript">

function hide()

{

    document.getElementById("pr").style.display="none";

}

</script>

<? do_calander('#voucher_date');?>

<style type="text/css">

<!--

.style1 {

	color: #FFFFFF;

	font-weight: bold;

}

-->

</style>

</head>

<body>

<table width="820" border="0" cellspacing="0" cellpadding="0" align="center">

  <tr>

    <td><div class="header">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	  <tr>

	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="1%">

			<? $path='../logo/'.$_SESSION['proj_id'].'.jpg';

			if(is_file($path)) echo '<img src="'.$path.'" height="80" />';?>			</td>

            <td width="83%"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

           
				
				<td align="center" class="title" style="text-align: center;border:0px solid white; font-family:bankgothic; font-weight:bold; font-size:29px;">



				<?

if($_SESSION['user']['group']>1)

echo find_a_field('user_group','group_name',"id=".$_SESSION['user']['group']);

else

echo $_SESSION['proj_name'];

				?>                </td>

              </tr>

              <tr>

                <td align="center"><?=$address?></td>

              </tr>

              <tr>

                <td align="center"><table  class="debit_box" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td>&nbsp;</td>

                      <td width="355"><div align="center">Advance Salary Voucher</div></td>

                      <td>&nbsp;</td>

                    </tr>

                  </table></td>

              </tr>

            </table></td>

          </tr>



        </table></td>

	    </tr>

	  <tr>

	    <td>&nbsp;</td>

	  </tr>

    </table>

    </div></td>

  </tr>

  <tr>

    

	<td>	</td>

  </tr>

  

  <tr>



    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td colspan="2" class="tabledesign_text">



<div id="pr">

<? if($jv->checked!='YES'){?>

<div align="left">

<form action="" method="post">

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">

  <tr>

    <td width="1"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>

    <td width="180" align="right"></td>

    <td width="120" align="right">Voucher Date :</td>

    <td width="0">



<input name="jv_no" type="hidden" value="<?=$jv_no?>" />

<input name="voucher_date" type="text" id="voucher_date" value="<?=date('Y-m-d',$jv->jv_date);?>" />    </td>

    <td><? if($jv->checked=='NO'){?><input name="check" type="submit" id="check" value="CHECK" style="font-size:12px; color:#990000" /><? }?>

        <input type="hidden" name="req_no" id="req_no" value="<?=$jv->jv_on?>" /></td>

  </tr>

</table>

</form>

<a target="_blank" href="../../warehouse_mod/pages/do/chalan_bill_corporate_acc.php?v_no=<?=$ch->chalan_no?>"></a></div><? }else{?>

<div align="left">

<form action="" method="post">

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#339900">

  <tr>

    <td width="1"><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>

    <td width="200" align="right"></td>

    <td width="150" align="right">&nbsp;</td>

    <td width="0"><div align="center"><span class="style1">CHECKED</span></div></td>

    <td width="120">&nbsp;</td>

    <td width="1">&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

</table>

</form>

<a target="_blank" href="../../warehouse_mod/pages/pr/chalan_view2.php?v_no=<?=$ch->pr_no?>"></a></div><? }?>

</div></td>

        </tr>

      <tr>

        <td width="50%" class="tabledesign_text">Voucher Date : <?=date('d-m-Y',$jv->jv_date);?></td>

        <td class="tabledesign_text">
			Employee Name:<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$jv->PBI_ID);?> 
			(<?=find_a_field('personnel_basic_info','PBI_CODE','PBI_ID='.$jv->PBI_ID);?>)</td>

      </tr>

      <tr>

        <td class="tabledesign_text"> Voucher No  : <?=$jv_no?></td>

        <td class="tabledesign_text">Checked By :

          <? if($jv->checked=='YES') echo find_a_field('user_activity_management','username','user_id='.$jv->checked_by); else echo 'Not Checked';?></td>

      </tr>

    </table></td>

  </tr>

  

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td><? if($jv->cc_code>0){?>CC CODE/PROJECT NAME: <? echo find_a_field('cost_center','center_name','id='.$jv->cc_code);?> <? }?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabledesign" style="font-size:12px">

      <tr>

        <td align="center"><div align="center">SL</div></td>

        <td align="center">Accounts Head </td>

        <td align="center">Particulars</td>

        <td>Debit</td>

        <td>Credit</td>

      </tr>

      

	  <?

$sql2="SELECT a.ledger_id,a.ledger_name,cr_amt,dr_amt,b.narration,b.PBI_ID FROM accounts_ledger a, secondary_journal b where b.jv_no='$jv_no' and a.ledger_id=b.ledger_id";

$data2=mysql_query($sql2);

while($info=mysql_fetch_object($data2)){

$EMPID = $info->PBI_ID;
		  

	  ?>

      <tr>

        <td align="left"><div align="center">

          <?=++$s;?>

        </div></td>

        <td align="left"><?=$info->ledger_id?>-<?=$info->ledger_name?> <?php if($info->ledger_id=="4014000300000000"){echo " - [ ".$do_commission."% ]";}?></td>

        <td align="left"><?=$info->narration?></td>

        <td align="right"><? echo number_format($info->dr_amt,2); $ttd = $ttd + $info->dr_amt;?></td>

        <td align="right"><? echo number_format($info->cr_amt,2); $ttc = $ttc + $info->cr_amt;?></td>

        </tr>

<?php }?>

      <tr>

        <td colspan="3" align="right">Total Taka: </td>

        <td align="right"><?=number_format($ttd,2)?></td>

        <td align="right"><?=number_format($ttc,2)?></td>

        </tr>

      

    </table></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>Amount in Word : 



	 (<? echo convertNumberMhafuz($ttc)?>)	 </td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>



<tr>
<td class="tabledesign_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" valign="bottom">Mohammad Tanvir Gias</td>
<td align="center" valign="bottom"><b></b></td>
<td align="center" valign="bottom">
</td>
<td align="center" valign="bottom">&nbsp;</td>
</tr>
 <tr>

 <td><div align="center">.......................</div></td>
        <td><div align="center">......................</div></td>
        <td><div align="center">.........................</div></td>
        <td><div align="center">.........................</div></td>
        <td><div align="center">......................</div></td>



</tr>


<tr>
<td><div align="center"><b>Prepared by</b></div></td>
<td><div align="center"><b>Audit</b></div></td>
<td><div align="center"><b>Head of Accounts</b></div></td>
<td><div align="center"><b>Managing Director</b></div></td>
<td><div align="center"><b>Chairman</b></div></td>
</tr>
</table></td>
</tr>





<tr>
<td><br /><br /><br />
<table width="20%" border="0" cellspacing="0" cellpadding="0">
<tr><td align="center"><b></b></td>
</tr>
<tr>
<td align="center"><div align="center">.........................</div></td>
</tr>
<tr>
<td align="center"><div align="center" style="font-size:14px;">Received By</div></td>
</tr>
</table>
</td>
</tr>
  
  
  
  
  
  
  
  
<tr>
<td>&nbsp;</td>
</tr>
</table>


</body>
</html>







