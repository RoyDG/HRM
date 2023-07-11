<?php

session_start();

ob_start();



require "../support/inc.report.php";







$title='Transaction Statement (Ledger)';







$proj_id=$_SESSION['proj_id'];















if(isset($_REQUEST['show']))







{







$tdate=$_REQUEST['tdate'];







//fdate-------------------







$fdate=$_REQUEST["fdate"];







$ledger_id=$_REQUEST["ledger_id"];















if(isset($_REQUEST['tdate'])&&$_REQUEST['tdate']!='')







$report_detail.='<br>Period: '.$_REQUEST['fdate'].' to '.$_REQUEST['tdate'];







if(isset($_REQUEST['ledger_id'])&&$_REQUEST['ledger_id']!=''&&$_REQUEST['ledger_id']!='%')







$report_detail.='<br>Ledger Name : '.find_a_field('accounts_ledger','ledger_name','ledger_id='.$_REQUEST["ledger_id"].' and group_for='.$_SESSION['user']['group']);







if(isset($_REQUEST['cc_code'])&&$_REQUEST['cc_code']!='')







$report_detail.='<br>Cost Center: '.find_a_field('cost_center','center_name','id='.$_REQUEST["cc_code"]);















$j=0;







for($i=0;$i<strlen($fdate);$i++)







{







if(is_numeric($fdate[$i]))







$time1[$j]=$time1[$j].$fdate[$i];















else $j++;







}















$fdate=mktime(0,0,-1,$time1[1],$time1[0],$time1[2]);















//tdate-------------------























$j=0;







for($i=0;$i<strlen($tdate);$i++)







{







if(is_numeric($tdate[$i]))







$time[$j]=$time[$j].$tdate[$i];







else $j++;







}







$tdate=mktime(23,59,59,$time[1],$time[0],$time[2]);























}







?>
<?php $led=mysql_query("select ledger_id,ledger_name from accounts_ledger where group_for=".$_SESSION['user']['group']." order by ledger_name");







      $data = '[';







      $data .= '{ name: "All", id: "%" },';







	  while($ledg = mysql_fetch_row($led)){







          $data .= '{ name: "'.$ledg[1].'", id: "'.$ledg[0].'" },';







	  }







      $data = substr($data, 0, -1);







      $data .= ']';







	//echo $data;







	







	$led1=mysql_query("SELECT id, center_name FROM cost_center WHERE 1 ORDER BY center_name");







	  if(mysql_num_rows($led1) > 0)







	  {	







		  $data1 = '[';







		  while($ledg1 = mysql_fetch_row($led1)){







			  $data1 .= '{ name: "'.$ledg1[1].'", id: "'.$ledg1[0].'" },';







		  }







		  $data1 = substr($data1, 0, -1);







		  $data1 .= ']';







	  }







	  else







	  {







		$data1 = '[{ name: "empty", id: "" }]';







	  }



	  



	  $pbi_id = "select PBI_ID, PBI_NAME FROM personnel_basic_info WHERE PBI_JOB_STATUS='In Service' ORDER BY PBI_NAME ASC";



		$led3=mysql_query($pbi_id);



		if(mysql_num_rows($led3) > 0)



		{



		$pbi_id3 = '[';



		while($ledg3 = mysql_fetch_row($led3)){



		$pbi_id3 .= '{ name: "'.$ledg3[1].'", id: "'.$ledg3[0].'" },';



		}



		$pbi_id3 = substr($pbi_id3, 0, -1);



		$pbi_id3 .= ']';



		}



		else



		{



		$pbi_id3 = '[{name:"empty", id:""}]';



		}















?>
<script type="text/javascript">















$(document).ready(function(){















    function formatItem(row) {







		//return row[0] + " " + row[1] + " ";







	}







	function formatResult(row) {







		return row[0].replace(/(<.+?>)/gi, '');







	}















    var data = <?php echo $data; ?>;







    $("#ledger_id").autocomplete(data, {







		matchContains: true,







		minChars: 0,







		scroll: true,







		scrollHeight: 300,







        formatItem: function(row, i, max, term) {







			//return row.name.replace(new RegExp("(" + term + ")", "gi"), "<strong>$1</strong>") + "<br><span style='font-size: 80%;'>ID: " + row.id + "</span>";







            return row.name + " [" + row.id + "]";







		},







		formatResult: function(row) {







			return row.id;







		}







	});







	







		var data = <?php echo $data1; ?>;







    $("#cc_code").autocomplete(data, {







		matchContains: true,







		minChars: 0,        







		scroll: true,







		scrollHeight: 300,







        formatItem: function(row, i, max, term) {







			//return row.name.replace(new RegExp("(" + term + ")", "gi"), "<strong>$1</strong>") + "<br><span style='font-size: 80%;'>ID: " + row.id + "</span>";







            return row.name + " : [" + row.id + "]";







		},







		formatResult: function(row) {            







			return row.id;







		}







	});	







var pbi_id1 = <?php echo $pbi_id3; ?>;



		$("#emp_id").autocomplete(pbi_id1, {



		matchContains: true,



		minChars: 0,



		scroll: true,



		scrollHeight: 300,



		formatItem: function(row, i, max, term) {



		return row.name; // + " [" + row.id + "]";



		},



		formatResult: function(row) {



		return row.id;



		}



		});	















  });







</script>
<script type="text/javascript">







$(document).ready(function(){







	







	$(function() {







		$("#fdate").datepicker({







			changeMonth: true,







			changeYear: true,







			dateFormat: 'dd-mm-y'







		});







	});







		$(function() {







		$("#tdate").datepicker({







			changeMonth: true,







			changeYear: true,







			dateFormat: 'dd-mm-y'







		});







	});















});







</script>
<title></title>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="left_report">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><div class="box_report">
                <form id="form1" name="form1" method="post" action="">
                  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                      <td width="22%" align="right"> Period : </td>
                      <td colspan="2" align="left"><input name="fdate" autocomplete="off" type="text" id="fdate" size="12" maxlength="12" value="<?php echo $_REQUEST['fdate'];?>" />
                        ---
                        <input name="tdate" type="text" autocomplete="off" id="tdate" size="12" maxlength="12" value="<?php echo $_REQUEST['tdate'];?>"/></td>
                    </tr>
                    <tr>
                      <td align="right">Ledger Head :</td>
                      <td width="28%" align="left"><input type="text" name="ledger_id" id="ledger_id" value="<?php echo $_REQUEST['ledger_id'];?>" size="50" /></td>
                      <td width="50%" align="left"><? if($_REQUEST['ledger_id']>0) echo find_a_field('accounts_ledger','ledger_name','ledger_id='.$_REQUEST['ledger_id']);?>
                        &nbsp; LGN:
                        <?  $groupid=find_a_field('accounts_ledger','ledger_group_id','ledger_id='.$_REQUEST['ledger_id']); 
										
										   if($_REQUEST['ledger_id']>0) echo find_a_field('ledger_group','group_name','group_id="'.$groupid.'"');
										
										   
										
										?>
                      </td>
                    </tr>
                    <tr>
                      <td align="right">Employee ID: </td>
                      <td align="left"><input type="text" name="emp_id" id="emp_id" value="<?php echo $_REQUEST['emp_id'];?>" size="50" /></td>
                      <td align="left"><? if($_REQUEST['emp_id']>0) echo find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$_REQUEST['emp_id']);?></td>
                    </tr>
                    <tr>
                      <td align="right">Sub CC 1: </td>
                      <td align="left"><input type="text" name="cc_code" id="cc_code" value="<?php echo $_REQUEST['cc_code'];?>" size="50" /></td>
                      <td align="left"><? if($_REQUEST['cc_code']>0) echo find_a_field('cost_center','center_name','id='.$_REQUEST['cc_code']);?></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center"><input class="btn" name="show" type="submit" id="show" value="Show" /></td>
                    </tr>
                  </table>
                </form>
              </div></td>
          </tr>
          <tr>
            <td align="right"><? include('PrintFormat.php');?></td>
          </tr>
          <tr>
            <td><div id="reporting">
                <table id="grp"  class="tabledesign" width="100%" cellspacing="0" cellpadding="2" border="0">
                  <thead>
                    <tr>
                      <th width="3%" height="20" align="center">S/N</th>
                      <th width="6%" align="center">Voucher</th>
                      <th width="10%" align="center">Employee ID</th>
                      <th width="10%" align="center">Cost Center </th>
                      <th width="10%" align="center">Sub CC 1 </th>
                      <th width="8%" align="center">Acc Name </th>
                      <th width="6%" height="20" align="center">Tr Date</th>
                      <th width="12%" align="center">Particulars</th>
                      <th width="4%" align="center">Source</th>
                      <th width="4%" align="center">Do No</th>
                      <th width="6%" align="center">Entry at </th>
                      <th width="7%" align="center">Approved By </th>
                      <th width="6%" height="20" align="center">Dr Amt </th>
                      <th width="6%" align="center">Cr Amt </th>
                      <th width="16%" align="center">Balance</th>
                    </tr>
                  <thead>
                    <?php







if(isset($_REQUEST['show']))







{







	$cc_code = (int) $_REQUEST['cc_code'];



/*$psql		= "select distinct a.jv_no from journal a, accounts_ledger l where l.ledger_id=a.ledger_id and l.ledger_type='Bank' and jv_date between '$fdate' and '$tdate' and tr_from!='Collection' order by a.jv_date,a.tr_no";

	$pquery		= mysql_query($psql);

	$pcount     = mysql_num_rows($pquery);

	if($pcount>0)

	{

	while($info=mysql_fetch_object($pquery)){

	++$c;

	if($c==1){$jvs .= $info->jv_no;}

	else{$jvs .= ','.$info->jv_no;}

	}

	}*/



	if($cc_code > 0)







	{



	if($_REQUEST['emp_id']!=''){



	$emp_id=" and a.PBI_ID=".$_REQUEST['emp_id'];}



$total_sql = "select sum(a.dr_amt),sum(a.cr_amt) from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date between '$fdate' AND '$tdate' and a.ledger_id like '$ledger_id' and b.group_for=".$_SESSION['user']['group']." AND a.cc_code=$cc_code ".$emp_id;

$total=mysql_fetch_row(mysql_query($total_sql));

$c="select sum(a.dr_amt),sum(a.cr_amt) from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date<'$fdate' and a.ledger_id like '$ledger_id' and b.group_for=".$_SESSION['user']['group']." AND a.cc_code=$cc_code".$emp_id;

echo $p="select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_from,a.narration,a.jv_no,a.tr_no,a.jv_no,a.cheq_no,a.cheq_date,a.user_id,a.PBI_ID,a.cc_code,a.entry_at from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date between '$fdate' AND '$tdate' and a.ledger_id like '$ledger_id' and 1 AND a.cc_code=$cc_code and b.group_for=".$_SESSION['user']['group'].$emp_id." order by a.jv_date,a.id";



}







	else







	{



	if($_REQUEST['emp_id']!=''){



	$emp_id=" and a.PBI_ID=".$_REQUEST['emp_id'];}



$total_sql = "select sum(a.dr_amt),sum(a.cr_amt) from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date between '$fdate' AND '$tdate' and a.ledger_id like '$ledger_id' and b.group_for=".$_SESSION['user']['group'].$emp_id;



$total=mysql_fetch_row(mysql_query($total_sql));



$c="select sum(a.dr_amt)-sum(a.cr_amt) from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date<'$fdate' and a.ledger_id like '$ledger_id' and b.group_for=".$_SESSION['user']['group'].$emp_id;







//echo $c;


 $p="select a.jv_date,b.ledger_name,a.dr_amt,a.cr_amt,a.tr_from,a.narration,a.jv_no,a.tr_no,a.jv_no,a.cheq_no,a.cheq_date, a.user_id,a.PBI_ID , a.cc_code,a.entry_at,a.jv_special,a.vat_chalan_no,a.ref_no,a.tr_id
		 from journal a,accounts_ledger b where a.ledger_id=b.ledger_id and a.jv_date between '$fdate' AND '$tdate' and a.ledger_id like '$ledger_id' and b.group_for=".$_SESSION['user']['group'].$emp_id." order by a.jv_date,a.id";







		  



//echo $p;









	}







	















	if($total[0]>$total[1])







	{







		$t_type="(Dr)";







		$t_total=$total[0]-$total[1];

		







	}







	else







	{







		$t_type="(Cr)";





         

		 

		$t_total=$total[1]-$total[0];

		







	}







	/* ===== Opening Balance =======*/

    $psql=mysql_query($c);
    $pl = mysql_fetch_row($psql);
    $blance=$pl[0]-$pl[1];


  ?>
                    <tr>
                      <td align="center" bgcolor="#FFCCFF">#</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF"><?php echo $_REQUEST["fdate"];?></td>
                      <td align="left" bgcolor="#FFCCFF">Opening Balance </td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="center" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFCCFF">&nbsp;</td>
                      <td align="right" bgcolor="#FFCCFF"><?php if($blance>0) echo '(Dr)'.number_format($blance,0,'.',''); elseif($blance<0) echo '(Cr) '.number_format(((-1)*$blance),0,'.','');else echo "0.00"; ?></td>
                    </tr>
                    <?php


////////////////////////////////////


 //echo $p;
$sql=mysql_query($p);
while($data=mysql_fetch_row($sql))
{

// $sales_do_no = find_a_field('sale_do_chalan','do_no','chalan_no="'.$data[4].'"');

$pi++;
?>
                    <tr>
                      <td align="center"><?php echo $pi;?></td>
                      <td align="center"><?php







	if($data[4]=='Receipt'||$data[4]=='Payment')
  {


	$link="voucher_print_receipt_new.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&vo_no=".$data[8];
	echo "<a href='$link' target='_blank'>".$data[7]."</a>";

  }
  
  
  
  	elseif($data[4]=='Contra')
  {


	$link="voucher_print_contra.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&vo_no=".$data[8];
	echo "<a href='$link' target='_blank'>".$data[7]."</a>";

  }
  
  
  	elseif($data[4]=='Special Receipt')
  {


	$link="voucher_print_receipt_special_new.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&vo_no=".$data[8];
	echo "<a href='$link' target='_blank'>".$data[7]."</a>";

  }

	

	

	

	elseif($data[4]=='Journal_info'&$data[15]=='1')

	{

		$link="voucher_print_receipt_special.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&vo_no=".$data[8];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}







	elseif($data[4]=='Journal_info'&$data[15]=='0')

	{

		$link="voucher_print.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&vo_no=".$data[8];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}

	

	elseif($data[4]=='Expense'&$data[15]=='0')

	{

		$link="voucher_print_expense.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&tr_no=".$data[7];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}
	
	
	
	
	elseif($data[4]=='COGS')

	{
	    

		$link="voucher_print_cogs.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&tr_no=".$data[7];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	} elseif($data[4]=='Payroll' || $data[4]=='advance_salary' || $data[4]=='Mobile_bill' || $data[4]=='Food_bill' || $data[4]=='Tax_bill')

	{

		$link="auto_journal_print_view.php?jv_no=".$data[8];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}
	
	
	elseif($data[4]=='Allowance Expense' || $data[4]=='Allowance Payment')

	{

		//$link="Allowance_print_view.php?jv_no=".$data[8];
		
		$link="Allowance_print_view.php?jv_no=".$data[8]."&v_date=".$data[0]."&v_type=".$data[4];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}
	
	
	
	
	elseif($data[4]=='Sales'&$data[15]=='0')

	{
	    

		$link="voucher_print_sales.php?v_type=".$data[4]."&v_date=".$data[0]."&view=1&tr_no=".$data[7];

		echo "<a href='$link' target='_blank'>".$data[7]."</a>";

	}





	else {







		echo $data[7];







	}

$cat_id = find_a_field('cost_center','category_id','id='.$data[13]);
$cat_name = find_a_field('cost_category','category_name','id='.$cat_id);
//echo 'OK '.$data[12];?>
                      </td>
                      <td align="center"><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$data[12]);?></td>
                      <td align="center"><?=$cat_name?></td>
                      <td align="center"><?=find_a_field('cost_center','center_name','id='.$data[13]);?></td>
                      <td align="center"><?=$data[1];?></td>
                      <td align="center"><?php echo date("d-M-Y",$data[0]);?> </td>
                      <td align="left"><?=$data[5];?>
                        <?=(($data[9]!='')?'-Cq#'.$data[9]:'');?>
                        <?=(($data[10]>943898400)?'-Cq-Date#'.date('d-m-Y',$data[10]):'');?>
                        <? if($import>0){echo 'VC NO='.$vatchalanno; }?>
                        <? $vatchalanno =find_a_field('secondary_journal','vat_challan_no','tr_no='.$data[7]);?>
                        <? $import = find_a_field('journal','tr_no','tr_from="ImportReceive" and tr_no='.$data[7]);?>
                      </td>
                      <td align="center"><?php echo $data[4];?></td>
					  
					  <?php /*?><?php if($data[4]=='Receipt' && $data[17]=='0'){ ?>
					  
					   <td><?=find_a_field('journal','ref_no','tr_no="'.$data[7].'" and tr_from="Receipt"');?></td><?php */?>
					  
					  <? if($data[4]=='Receipt' || $data[4]=='SalesReturn' || $data[4]=='Expense')  { ?> 
					  
					  <td align="center"><?php echo $data[17];?></td>
					  
					  <?   }elseif($data[4]=='Sales'){   ?> 
					  <td align="center"><?=$data[18];?></td>
					  
					  <? }else{ ?>
					  <td></td>
					  
					  <? } ?>
					  
                      
					  
                      <td align="center"><?php echo date("d-M-Y h:i:sa",strtotime($data[14]));?></td>
                      <td align="center"><?=find_a_field('user_activity_management','fname','user_id='.$data[11]);?></td>
                      <td align="right"><?php echo number_format($data[2],0,'.',',');?></td>
                      <td align="right"><?php echo number_format($data[3],0,'.',',');?></td>
                      <td align="right" bgcolor="#FFCCFF"><?php $blance = $blance+($data[2]-$data[3]); if($blance>0) echo '(Dr)'.number_format($blance,0,'.',','); elseif($blance<0) echo '(Cr) '.number_format(((-1)*$blance),0,'.',',');else echo "0.00"; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <th colspan="9" align="center">Amount Difference : <?php echo number_format($t_total,0,'.','')." ".$t_type?> </th>
                      <th colspan="3" align="right"><strong>Total : </strong></th>
                      <th align="right"><strong><?php echo number_format($total[0],0,'.','');?></strong></th>
                      <th align="right"><strong><?php echo number_format($total[1],0,'.','');?></strong></th>
                      <th align="right">Closing Balance:
                        <?php $blance = $blance+($data[2]-$data[3]); if($blance>0) echo number_format($blance,0,'.',','); elseif($blance<0) echo '(Cr) '.number_format(((-1)*$blance),0,'.',',');else echo "0.00"; ?></th>
                    </tr>
                    <?php }?>
                </table>
              </div>
              <div id="pageNavPosition"></div></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
<?

$main_content=ob_get_contents();

ob_end_clean();

include ("../template/main_layout.php");

?>
