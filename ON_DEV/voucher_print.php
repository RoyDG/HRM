<?php































session_start();































require "../support/inc.voucher.php";































require_once ('../common/class.numbertoword.php');































$proj_id=$_SESSION['proj_id'];































$vtype= strtolower($_REQUEST['v_type']);































































if($vtype=='receipt'){$voucher_name='RECEIPT VOUCHER';$vtypes='receipt';}































elseif($vtype=='payment'){$voucher_name='PAYMENT VOUCHER';$vtypes='payment';}































elseif($vtype=='journal_info'){$voucher_name='JOURNAL VOUCHER';$vtypes='journal_info';}































elseif($vtype=='contra'){$voucher_name='CONTRA VOUCHER';$vtype='coutra';$vtypes='contra';}































elseif($vtype=='expense'){$voucher_name='EXPENSE VOUCHER';$vtype='expense';$vtypes='expense';}































elseif($vtype=='sales'){$voucher_name='SALES VOUCHER';$vtype='sales';$vtypes='sales';}































else{$vtype=='coutra';$voucher_name='CONTRA VOUCHER';$vtypes='contra';}































































































$no=$vtype."_no";































$vdate=$vtype."_date";































































$vo_no = find_a_field('journal','tr_no','jv_no='.$_REQUEST['vo_no'].' and tr_from = "'.ucwords($vtypes).'"');































$address=find_a_field('project_info','proj_address',"1");































































if(isset($_REQUEST['vo_no']))































{















if($vtypes == 'journal_info' || $vtypes == 'expense' || $vtypes == 'sales' ){















      $sql1="select j.jv_date,j.cc_code,j.user_id,j.PBI_ID,j.narration,j.entry_at,j.cheq_no,j.cheq_date from journal j where j.tr_no=$vo_no and j.tr_from = '".$vtypes."' limit 1";































$data1=mysql_fetch_array(mysql_query($sql1));















































$user_name = find_a_field('user_activity_management','fname',"user_id=".$data1['user_id']);































$emp_name = find_a_field('coutra','received_from','coutra_no='.$vo_no);















































$vo_date=$data1[0];



$ck_date=$data1[7];



































$cccode=$data1[1];















}else{































$sql1="select j.jv_date,j.cc_code,j.user_id,j.PBI_ID,j.narration,j.entry_at,j.cheq_no,j.cheq_date from journal j where j.tr_no=$vo_no and j.tr_from = '".$vtypes."' limit 1";















$sql11="select j.jv_date,j.cc_code,j.user_id,j.PBI_ID,j.narration,j.entry_at from secondary_journal j where j.tr_no=$vo_no and j.tr_from = '".$vtypes."' limit 1";































$data1=mysql_fetch_array(mysql_query($sql1));















$data11=mysql_fetch_array(mysql_query($sql11));































$user_name = find_a_field('user_activity_management','fname',"user_id=".$data11['user_id']);































$emp_name = find_a_field('coutra','received_from','coutra_no='.$vo_no);































$app_user_name = find_a_field('user_activity_management','fname',"user_id=".$data1['user_id']);















$vo_date=$data1[0];































$cccode=$data1[1];















}















}































































$pi=0;































$cr_amt=0;































$dr_amt=0;































































if($_SESSION['user']['group']==3)































$sql2="SELECT a.ledger_name,a.ledger_group_id,  b.* FROM accounts_ledger a, $vtype b where b.$no='$vo_no' and a.ledger_id=b.ledger_id order by b.id";































else































 $sql2="SELECT a.ledger_name,a.ledger_group_id,  b.* FROM accounts_ledger a, $vtype b where b.$no='$vo_no' and a.ledger_id=b.ledger_id order by b.dr_amt desc";































































  $ddd = date('Y-m-d');















  















$in = 'insert into document_print_count (`voucher_no`,`user_id`,`print_date`) values("'.$vo_no.'","'.$_SESSION['user']['id'].'","'.$ddd.'")';















  $ar = mysql_query($in);































?>































































<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">































<html xmlns="http://www.w3.org/1999/xhtml">































<head>































<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />































<title>.: Voucher :.</title>































<link href="../css/voucher_print.css" type="text/css" rel="stylesheet"/>































<script type="text/javascript">































function hide()































{































    document.getElementById("pr").style.display="none";































}































</script></head>































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































                      <td width="325"><div align="center"><?=$voucher_name?></div></td>































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































<div align="left">































<input name="print" type="submit" onclick="hide();window.print();" value="Print" /> 































<a href="voucher_print_view.php?v_type=<?=$_REQUEST['v_type']?>&vo_no=<?=$_REQUEST['vo_no']?>">Client Copy</a></div>



</div></td>















<td align="right">















                               















								<?php















								  















		                         if($vtype=='receipt' || $vtype=='expense' || $vtype=='sales'  || $vtype=='payment' || $vtype=='journal_info' ){















		















								  if($vtype=='receipt'){















								$path    = "../../../files/receipt_attch/".$vo_no.".jpg";















								$pathpdf = "../../../files/receipt_attch/".$vo_no.".pdf";















								$pathpng = "../../../files/receipt_attch/".$vo_no.".png";















								}







								







								







								







								







								 elseif ($vtype=='expense'){







								 







								 $new_vo_no = $vo_no+1000000;







								 







								















								$ex_path1    = "../../../files/expense_attach/".$new_vo_no.".jpg";







								 if(file_exists($ex_path1)){







								 $ex_path    = "../../../files/expense_attach/".$new_vo_no.".jpg";







								 }else{







								 $ex_path    = "../../../files/expense_attach/".$vo_no.".jpg";







								 }















								$ex_pathpdf1= "../../../files/expense_attach/".$new_vo_no.".pdf";







								if(file_exists($ex_pathpdf1)){







								 $ex_pathpdf    = "../../../files/expense_attach/".$new_vo_no.".pdf";







								 }else{







								 $ex_pathpdf    = "../../../files/expense_attach/".$vo_no.".pdf";







								 }















								$ex_pathpng1 = "../../../files/expense_attach/".$new_vo_no.".png";







								if(file_exists($ex_pathpng1)){







								 $ex_pathpng   = "../../../files/expense_attach/".$new_vo_no.".png";







								 }else{







								 $ex_pathpng   = "../../../files/expense_attach/".$vo_no.".png";







								 }







								















								}







								







								







								







								







								elseif($vtype=='payment'){















								$paypath    = "../../../files/payment_attch/".$vo_no.".jpg";















								$paypathpdf = "../../../files/payment_attch/".$vo_no.".pdf";















								$paypathpng = "../../../files/payment_attch/".$vo_no.".png";















								}

								

								elseif($vtype=='sales'){

                                $s_paypath    = "../../../files/sales_attach/".$vo_no.".jpg";

                                $s_paypathpdf = "../../../files/sales_attach/".$vo_no.".pdf";

                                $s_paypathpng = "../../../files/sales_attach/".$vo_no.".png";

                                }

								

								

								

								elseif($vtype=='journal_info'){

                                $j_paypath    = "../../../files/journal_attach/".$vo_no.".jpg";

                                $j_paypathpdf = "../../../files/journal_attach/".$vo_no.".pdf";

                                $j_paypathpng = "../../../files/journal_attach/".$vo_no.".png";

                                }



                                if(is_file($paypath))



                                { 

								

								?>

<a href="../../../files/payment_attch/<?=$vo_no?>.jpg" target="_blank">Show Attachment</a><?php

}





elseif (is_file($ex_path))

{



?>





<a href="<?php echo $ex_path;?>" target="_blank">Show Attachment</a>



<?php  }elseif (is_file($ex_pathpdf)){ ?>

<a href="<?php echo $ex_pathpdf;?>" target="_blank">Show Attachment</a>

<?php }elseif (is_file($ex_pathpng)){?>

<a href="<?php echo $ex_pathpng;?>" target="_blank">Show Attachment	</a>



<?php }elseif(is_file($paypathpdf)){?>

<a href="../../../files/payment_attch/<?=$vo_no?>.pdf" target="_blank">Show Attachment</a>

<?php }elseif(is_file($path)){?>

<a href="../../../files/receipt_attch/<?=$vo_no?>.jpg" target="_blank">Show Attachment</a>

<?php }elseif(is_file($pathpdf)){?>

<a href="../../../files/receipt_attch/<?=$vo_no?>.pdf" target="_blank">Show Attachment</a>

<?php }elseif(is_file($paypathpng)){?>

<a href="../../../files/payment_attch/<?=$vo_no?>.png" target="_blank">Show Attachment</a>

<?php } elseif(is_file($pathpng)){?>

<a href="../../../files/receipt_attch/<?=$vo_no?>.png" target="_blank">Show Attachment</a>



<? }elseif(is_file($s_paypathpdf)){?>

<a href="../../../files/sales_attach/<?=$vo_no?>.pdf" target="_blank">Show Attachment</a>





<? }elseif(is_file($j_paypathpdf)){?>

<a href="../../../files/journal_attach/<?=$vo_no?>.pdf" target="_blank">Show Attachment</a>

<?php }elseif(is_file($j_paypath)){?>

<a href="../../../files/journal_attach/<?=$vo_no?>.jpg" target="_blank">Show Attachment</a>

<?php } elseif(is_file($j_paypathpng)){?>

<a href="../../../files/journal_attach/<?=$vo_no?>.png" target="_blank">Show Attachment</a>

<? } } ?>





</td>

</tr>































      <tr>































        <td class="tabledesign_text"> Voucher No  : <?=$vo_no?></td>































        <td class="tabledesign_text">Voucher Date : <?=date('d-m-Y',$vo_date)?></td>



      </tr>































    </table></td>



  </tr>































  































  <tr>































    <td>
		<? if($data1[3]>0){?>
			Transaction By: <b>
		<?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data1[3]).' [ID:'.find_a_field('personnel_basic_info','PBI_CODE',"PBI_ID=".$data1[3]).']';?></b>
		
		
		<? //echo find_a_field('cost_center','center_name',"id='$cccode'")?>
		<? }?>&nbsp;
		<span style="float:right;">
			Reporting Time 
			<?=date('Y-M-d, h:i:s')?>
		</span>
	</td>



  </tr>















  <? if($data1[3]>0){?>















  <?php /*?><tr>















    <td>















      Transaction By: <b><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data1[3]).' [ID:'.$data1[3].']';?></b></td>



  </tr><?php */?>







  







  







<? }?>















<tr>







     <?php







	  







	    $check_date = date('Y-m-d',strtotime($data1['entry_at']));







	   $t_date = '2019-11-16';







	  







	   if($check_date>=$t_date){ 







	 ?>







    <td>















      Particulars: <b> <?=$data1['narration'];?>



      <?php



		$ch_no = $data1['cheq_no'];



		$ch_dt = date('d-m-Y',$ck_date);



		



		



		



		 if(!empty($ch_no && $ch_dt)){



		  echo"#Check-NO-$ch_no";



		  echo"#Check-Dt-$ch_dt";



	



		 



		 } 



		 



	



		 



		 ?>



    </b></td>



  </tr>























  <tr>







  







  <?php } ?>































    <td>







	 <?php







	  







	   if($check_date>=$t_date){







	 ?>







	<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabledesign">































      <tr>





























        <td width="30%" rowspan="2" align="center">CC CODE/PROJECT NAME</td>

        <td width="25%" rowspan="2" align="center">Control Heads</td>































        <td width="30%" rowspan="2" align="center">A/C Ledger Head</td>































       































        <td colspan="2">Amount (Taka) </td>



      </tr>































      <tr>































        <td width="9%">Debit </td>































        <td width="9%">Credit</td>



      </tr>































	  <?































































$data2=mysql_query($sql2);































			  while($info=mysql_fetch_object($data2)){ $pi++;































			  $cr_amt=$cr_amt+$info->cr_amt;































			  $dr_amt=$dr_amt+$info->dr_amt;































			  if($info->bank==''&&$info->cheq_no!='')































			  $narration=$info->narration.':: CheqNo # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date);































			  elseif($info->cheq_no=='')































			  $narration=$info->narration;































			  else































			  $narration=$info->narration.':: CheqNo # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date).'; Bank # '.$info->bank;































			  































	  ?>































      <tr>





























        <td align="left"><? echo find_a_field('cost_center','center_name','id='.$info->cc_code)?></td>

        <td align="left"><?















		















		if($info->ledger_group_id>0){















        echo $grp_name=find_a_field('ledger_group','group_name','group_id='.$info->ledger_group_id);}















		















		elseif($info->acc_ledger_id>0){















		//echo 'OK '.$info->acc_ledger_id;















        echo $grp_namee=find_a_field('accounts_ledger','ledger_name','ledger_id='.$info->acc_ledger_id);}















		















		elseif($info->sub_ledger_id>0)















        echo $grp_nameee=find_a_field('sub_ledger','sub_ledger','sub_ledger_id='.$info->sub_ledger_id);































		//$ggrp = explode('>',$grp_name );































		//echo $ggrp[1];































		?></td>































        <td align="left"><?=$info->ledger_name?> : <?=$info->ledger_id?></td>































        































        <td align="right"><?=number_format($info->dr_amt,2)?></td>































        <td align="right"><?=number_format($info->cr_amt,2)?></td>



      </tr>































<?php }?>































      <tr>































        <td colspan="3" align="right">Total Taka: </td>































        <td align="right"><?=number_format($dr_amt,2)?></td>































        <td align="right"><?=number_format($cr_amt,2)?></td>



      </tr>



    </table>







	 <?php } else{?>







	 







	<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tabledesign">































      <tr>































        <td width="25%" rowspan="2" align="center">Control Head</td>































        <td width="30%" rowspan="2" align="center">A/C Ledger Head</td>































        <td width="30%" rowspan="2" align="center">Particulars</td>































        <td colspan="2">Amount (Taka) </td>



      </tr>































      <tr>































        <td width="9%">Debit </td>































        <td width="9%">Credit</td>



      </tr>































	  <?































































$data2=mysql_query($sql2);































			  while($info=mysql_fetch_object($data2)){ $pi++;































			  $cr_amt=$cr_amt+$info->cr_amt;































			  $dr_amt=$dr_amt+$info->dr_amt;































			  if($info->bank==''&&$info->cheq_no!='')































			  $narration=$info->narration.':: CheqNO # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date);































			  elseif($info->cheq_no=='')































			  $narration=$info->narration;































			  else































			  $narration=$info->narration.':: CheqNo # '.$info->cheq_no.'; dt= '.date("d.m.Y",$info->cheq_date).'; Bank # '.$info->bank;































			  































	  ?>































      <tr>































        <td align="left"><?















		















		if($info->ledger_group_id>0){















        echo $grp_name=find_a_field('ledger_group','group_name','group_id='.$info->ledger_group_id);}















		















		elseif($info->acc_ledger_id>0){















		//echo 'OK '.$info->acc_ledger_id;















        echo $grp_namee=find_a_field('accounts_ledger','ledger_name','ledger_id='.$info->acc_ledger_id);}















		















		elseif($info->sub_ledger_id>0)















        echo $grp_nameee=find_a_field('sub_ledger','sub_ledger','sub_ledger_id='.$info->sub_ledger_id);































		//$ggrp = explode('>',$grp_name );































		//echo $ggrp[1];































		?></td>































        <td align="left"><?=$info->ledger_name?> : <?=$info->ledger_id?></td>































        <td align="left"><?=$narration?></td>































        <td align="right"><?=number_format($info->dr_amt,2)?></td>































        <td align="right"><?=number_format($info->cr_amt,2)?></td>



      </tr>































<?php }?>































      <tr>































        <td colspan="3" align="right">Total Taka: </td>































        <td align="right"><?=number_format($dr_amt,2)?></td>































        <td align="right"><?=number_format($cr_amt,2)?></td>



      </tr>



    </table>







	 <?php } ?>	</td>



  </tr>































  <tr>































    <td>&nbsp;</td>



  </tr>































  <tr>































    <td>Amount in Word : 	 (<?































	 echo convertNumberMhafuz($cr_amt);































	 ?>)	 </td>



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































        































        <td align="center" valign="bottom"><b>































          <?=$user_name?>































        </b></td>































        































        <td align="center" valign="bottom"><b>















		















		















          















        </b></td>































        <td align="center" valign="bottom">















		   















		   <?















		  //if($vtype=='journal_info'){















		?>















		<? //=$app_user_name?>















		<? //} else{?>















		















		















		<? //} ?>		</td>































        <td align="center" valign="bottom">&nbsp;</td>



      </tr>































      <tr>































        <td><div align="center">.......................</div></td>















		















		















		















		<td><div align="center">......................</div></td>















		















		















		















		































        <!--<td><div align="center">......................</div></td>-->































        <td><div align="center">.........................</div></td>































        <td><div align="center">.........................</div></td>































        <td><div align="center">......................</div></td>



      </tr>































      <tr>































        































        <td><div align="center">Prepared by </div></td>















		















		<?















		 // if($vtype=='journal_info'){















		?>















		















		<td><div align="center">Audit</div></td>































       <? //} else{?>















		<? //} ?>















		















		<?















		  //if($vtype=='journal_info'){















		?>































        <!--<td><div align="center">Administration</div></td>-->















		















		<? //} else{?>















		















		<!--<td><div align="center">Audit</div></td>-->















		















		<? //} ?>















		















		<? 















		//if($vtype=='payment'){















		?>















		















		<!--<td><div align="center">Received By</div></td>-->















		















		<? //} else{?>















		<? //} ?>















		































        <td><div align="center">Head of Accounts</div></td>































        <td><div align="center">Managing Director</div></td>































        <td><div align="center">Chairman</div></td>



      </tr>































    </table></td>



  </tr>































  <tr>































    <td><br /><br /><br />















	 <?















		  if($vtype=='payment' || $vtype=='expense'){















		?>















	<table width="20%" border="0" cellspacing="0" cellpadding="0">































      <tr>































        































        <td align="center"><b>































          <? //=$user_name?>































        </b></td>



      </tr>































      <tr>































      















        <td align="center"><div align="center">.........................</div></td>



      </tr>































      <tr>































        















































        <td align="center"><div align="center" style="font-size:14px;">Received By</div></td>



      </tr>



    </table>















	 <? } if($vtype=='receipt'){ ?>	



	 <table width="20%" border="0" cellspacing="0" cellpadding="0">































      <tr>































        































        <td align="center"><b>































          <? //=$user_name?>































        </b></td>



      </tr>































      <tr>































      















        <td align="center"><div align="center">.........................</div></td>



      </tr>































      <tr>































        















































        <td align="center"><div align="center" style="font-size:14px;">Received By<br />Accounts Department</div></td>



      </tr>



    </table>



	<? } ?>



	 </td>



  </tr>















  















  <tr>















    <td>&nbsp;</td>



  </tr>



</table>































</body>































</html>






























