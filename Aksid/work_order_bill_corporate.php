<?php































































session_start();































































//====================== EOF ===================































































//var_dump($_SESSION);































































require "../../support/inc.all.php";















































require_once ('../../../acc_mod/common/class.numbertoword.php');















































































$do_no 		= $_REQUEST['v_no'];































































$sql1="select d.* from sale_do_details d where d.do_no = '".$do_no."' and (d.item_id!=1096000100010239 and d.item_id!=1096000100010312)";







$data1=mysql_query($sql1);

$pi=0;

$total=0;

while($info=mysql_fetch_object($data1)){ 

$pi++;

$chalan_date=$info->chalan_date;

$do_no=$info->do_no;

$order_no[]=$info->id;

$driver_name=$info->driver_name;

$vehicle_no=$info->vehicle_no;

$delivery_man=$info->delivery_man;

$cash_discount=$info->cash_discount;

$marketing_person = find_a_field('sale_do_master','marketing_person','do_no='.$info->do_no);

$item_id[] = $info->item_id;

//$unit_price[] = $info->unit_price;

$pkt_size[] = $info->pkt_size;

$sps = find_a_field('item_info','sub_pack_size','item_id='.$info->item_id);

$sub_pkt_size[] = (($sps>1)?$sps:1);

$pkt_unit[] = $info->pkt_unit;

$dist_unit[] = $info->dist_unit;

$total_unit[] = $info->total_unit;

$total_amt[] = $info->total_amt;

$discount_by_prd[] = $info->discount_by_prd;

$undel[] = $info->undel;

$pkt_size[] = $info->pkt_size;



if($info->net_rate>0){

$unit_price[] = $info->net_rate;

}else{

$unit_price[] = $info->unit_price;

}





$net_value[] = $info->net_value;









}





$ssql = 'select a.* from dealer_info a, sale_do_master b where a.dealer_code=b.dealer_code and b.do_no='.$do_no;

$dealer = find_all_field_sql($ssql);

$ssql = 'select b.* from dealer_info a, sale_do_master b where a.dealer_code=b.dealer_code and b.do_no='.$do_no;

$do = find_all_field_sql($ssql);





$vat_amount = find_a_field('sale_do_details','sum(vat_amt)','do_no="'.$do_no.'"');

$ait_amount = find_a_field('sale_do_details','sum(ait_amt)','do_no="'.$do_no.'"');



?>



























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>.: Cash Memo :.</title>



<link href="../css/invoice.css" type="text/css" rel="stylesheet"/>



<script type="text/javascript">











function hide()































































{































































    document.getElementById("pr").style.display="none";































































}































































</script>



<style type="text/css">































<!--































































.style1 {color: #000000}































































.style5 {font-size: 14px; }































































.style7 {font-size: 14px; font-weight: bold; }































































-->































@page {































  size: A4;































}































































#footer {







position: fixed;



width:800px;



margin:auto;



bottom:0px;



}























































































</style>



</head>



<body style="font-family:Tahoma, Geneva, sans-serif">



<br />



<br />



<br />



<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" style="">



<tr>



  <td><div class="header">



      <table width="100%" border="0" cellspacing="0" cellpadding="0">



        <tr>



          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



              <tr>



                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



                    <tr>



                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">



                          <tr>



                            <td width="40%" align="left"><img src="../../../logo/aksidlogo.png" width="300px" style="padding-bottom:40px"/>



                            <td width="20%">&nbsp;</td>



                            <td align="left" width="40%" colspan="2"><span style="font-size:19px;"><u>Payment Information</u></span>  <br /><br />



                              <span style="text-align:center; color:#000000; font-size:12px;line-height:1.5;"> <b>Cheque Payable to:</b> AKSID Corporation Limited<br />



                              <b>Bank Name:</b> Dhaka Bank Limited<br />



                              <b>Account No:</b> 2061000027362<br />



                              <b>Branch Name:</b> Banani<br />



                              <b>Beneficiary Name:</b> AKSID Corporation Limited<br />



                              <b>Local Clearing Code:</b> (Routing No): 085260436<br />



                              <b>Merchant A/C (bkash & Nagad):</b> +8801844541212<br />



							  <b>Telephone No:</b> +8802-8432198 <br />



                              <b>Contact No:</b> +8801700761419 <br />



							  <b>TIN :</b> 114759815833, <b>BIN :</b> 000167677-0203</span> 



							  



							  



							  </td>



                          </tr>



                        </table></td>



                    </tr>



                  </table></td>



              </tr>



              <tr>



                <td><br />



                  <br />



                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">



                    <tr>



                      <td width="30%" align="left">&nbsp;</td>



                      <td width="40%" align="center" style="font-size:20px;"><strong>INVOICE </strong></td>



                      <td align="left" width="30%" colspan="2">&nbsp;</td>



                    </tr>



                  </table></td>



              </tr>



            </table></td>



        </tr>



        <tr>



          <td><br />



            <br />



            <table width="100%" border="0" cellspacing="0" cellpadding="0">



              <tr>



                <td width="63%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">



                    <tr>



                      <td width="20%" align="left" valign="middle">Customer Name</td>



                      <td>:</td>



                      <td width="80%"><?php echo $dealer->dealer_code.'-'.$dealer->dealer_name_e;?></td>



                    </tr>



                    <tr>



                      <td align="left" valign="top"> Head Office</td>



                      <td>:</td>



                      <td><?php echo $dealer->address_e?></td>



                    </tr>



                    <tr>



                      <td align="left" valign="middle">Delivery Address</td>



                      <td>:</td>



                      <td><?php if($do->new_delivery_address !=''){ echo $do->new_delivery_address;}else{ echo $dealer->propritor_name_e;}?></td>



                    </tr>



                    <tr>



                      <td align="left" valign="middle">Contact Person</td>



                      <td>:</td>



                      <td><?php if($do->new_contact_person !=''){ echo $do->new_contact_person;}else{ echo $dealer->propritor_name_b;}?>



                        , Mobile :



                        <?php if($do->new_contact_number !=''){ echo $do->new_contact_number;}else { echo $dealer->mobile_no;}?></td>



                    </tr>



                    <tr>



                      <td align="left" valign="middle">Mode of payment </td>



                      <td>:</td>



                      <td><?php echo $do->payment_by;?></td>



                    </tr>



                    



                    <tr>



                      <td align="left" valign="middle">Sales Person</td>



                      <td>:</td>



                      <td><?=find_a_field('personnel_basic_info','PBI_NAME','PBI_ID='.$marketing_person).', ID: '.find_a_field('personnel_basic_info','PBI_CODE','PBI_ID='.$marketing_person);?></td>



                    </tr>



					



					<tr>



                      <td align="left" valign="middle">Remarks</td>



                      <td>:</td>



                      <td><?php echo $do->remarks;?></td>



                    </tr>



					



                  </table></td>



                <td width="37%"><table width="100%" border="0" cellspacing="0" cellpadding="3"  style="font-size:13px">



                    <tr>



                      <td align="left" valign="middle">Invoice Date </td>



                      <td>:</td>



                      <td><? $invo_date=find_a_field('sale_do_master','do_date','do_no='.$do->do_no);  echo date('d-M-Y',strtotime($invo_date));?></td>



                    </tr>



                    <tr>



                      <td align="right" valign="middle"><div align="left">Invoice No </div></td>



                      <td>:</td>



                      <td><?=$do->invoice_no;?></td>



                    </tr>



                    <tr>



                      <?php































					   $ref = 'select ref_no from sale_do_master where do_no='.$do_no;































					   $refq = mysql_query($ref);































					   $refdata = mysql_fetch_object($refq);































					  ?>



                      <td align="right" valign="middle"><div align="left">DO No</div></td>



                      <td>:</td>



                      <td><?php echo $do_no;?></td>



                    </tr>



                    <tr>



                      <td width="48%" align="right" valign="middle"><div align="left">PO NO</div></td>



                      <td>:</td>



                      <td width="52%"><?=$refdata->ref_no?></td>



                    </tr>



                    <tr>



                      <td width="48%" align="right" valign="middle"><div align="left">Challan No</div></td>



                      <td>:</td>



                      <td width="52%"><?=find_a_field('sale_do_chalan','chalan_no','do_no='.$do->do_no);?></td>



                    </tr>



                    <? if($do->cash_recv>0){?>



                    <tr>



                      <td align="left" valign="middle">Cash Received</td>



                      <td>:</td>



                      <td><?=number_format($do->cash_recv)?></td>



                    </tr>



                    <? }?>



                    <? if($do->credit_amnt>0){?>



                    <tr>



                      <td align="left" valign="middle">Credit Amnt</td>



                      <td>:</td>



                      <td><?=number_format($do->credit_amnt)?></td>



                    </tr>



                    <? }?>



                    <tr>



                      <td align="left" valign="middle">Credit Start Date</td>



                      <td>:</td>



                      <td><? $credit_st=$do->cr_start_date; echo date('d-M-Y',strtotime($credit_st));?></td>



                    </tr>



                    <tr>



                      <td align="right" valign="middle"><div align="left">Credit End Date</div></td>



                      <td>:</td>



                      <td><? $credit_end_dt=$do->cr_end_date; echo date('d-M-Y',strtotime($credit_end_dt));?></td>



                    </tr>



                  </table></td>



              </tr>



            </table></td>



        </tr>



      </table>



    </div></td>



</tr>



<tr>



  <td></td>



</tr>



<tr>



  <td><div id="pr">



      <div align="left">



        <form id="form1" name="form1" method="post" action="">



          <table width="50%" border="0" cellspacing="0" cellpadding="0">



            <tr>



              <td><input name="button" type="button" onclick="hide();window.print();" value="Print" /></td>



            </tr>



          </table>



        </form>



      </div>



    </div>



    <table width="100%" class="tabledesign" border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" style="font-size:11px;">



      <tr>



        <td align="center" bgcolor="#FFFFFF"><strong>SL</strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Product Name</strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>UOM</strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Pack Size</strong> </td>



        <td align="center" bgcolor="#FFFFFF"><strong>MRP </strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Discount</strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Net MRP </strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Order Qty. </strong><strong></strong></td>



        <td align="center" bgcolor="#FFFFFF"><strong>Payable Amt </strong></td>



      </tr>



<? for($i=0;$i<$pi;$i++){ 

$gift_o = find_all_field('sale_do_details','','gift_on_order="'.$order_no[$i].'" and (item_id=1096000100010239 or item_id=1096000100010312)');

$gift_order  = $gift_o->id;



if($gift_order>0){



$gift = find_all_field('sale_do_details','','id="'.$gift_order.'" and do_no = "'.$do_no.'"');



$per_pcs =  @((-1)*((($gift->unit_price)/($total_unit[$i]/$gift->total_unit))));









}





else







{



$gift = 0;

$per_pcs = 0;



}





$items = find_all_field('item_info','item_name','item_id='.$item_id[$i]);

$set = find_all_field('sales_corporate_price','discount','dealer_code="'.$dealer->dealer_code.'" and item_id="'.$item_id[$i].'"');

$fit_size = ($items->sub_pack_size>0)?$items->sub_pack_size:1;













?>



      <tr>



        <td align="center" valign="top"><?=$i+1?></td>



        <td align="left" valign="top"><?=$items->finish_goods_code?>



          -



          <?=$items->item_name;?>



          <? if($gift_o->gift_id>0) echo '[D/O-'.find_a_field('sale_gift_offer','offer_name','id='.$gift_o->gift_id).']';?></td>



        <td align="left" valign="top"><div align="center">



            <?=$items->unit_name;?>



          </div></td>



        <td align="left" valign="top"><div align="center"> <? if($undel[$i]>0){ echo $undel[$i];}else{ echo $items->pack_size.$items->unit_name;}?> </div></td>



        <td align="right" valign="top"><?=number_format(($unit_price[$i]*$fit_size),2)?></td>



        <td align="right" valign="top"><? $dis=($unit_price[$i]*$discount_by_prd[$i])/100; echo floatval($dis); ?></td>



        <td align="right" valign="top"><? $n_mrp=($unit_price[$i]-$dis); echo number_format($n_mrp,2)?></td>



        <td align="right" valign="top"><? echo floatval(($dist_unit[$i]/$sub_pkt_size[$i])); $tdpc = $tdpc + ($dist_unit[$i]/$sub_pkt_size[$i]);?></td>



        <td align="right" valign="top"><? $ttt = ($unit_price[$i]-$dis)*($dist_unit[$i]/$sub_pkt_size[$i]); echo number_format($ttt,0,'.',''); $tot = $tot + $ttt; ?></td>



      </tr>



      <? }?>



      <tr style="border-bottom:#FFFFFF">



        <td colspan="7" align="center" valign="top"><div align="right"><strong>Total:</strong></div></td>



        <td align="center" valign="top"><div align="right"><strong>



            <?=number_format($tdpc)?>



            </strong></div></td>



        <td align="right" valign="top"><strong>



          <?=number_format($tot)?>



          </strong></td>



      </tr>



      <?











 $sd = $tot*$do->sp_discount;



 if($sd>0){



  ?>



      <div align="right"><strong>Special Discount



        <?=$do->sp_discount?>



        %: </strong></div>



      <tr>



        <td colspan="8" align="center" valign="top"><div align="right"><strong> Discount Amount



            <?=$do->sp_discount?>



            %: </strong></div></td>



        <td align="right" valign="top"><strong> <? echo $spd=floatval($sd/100);?> </strong></td>



      </tr>



      <? }if($cash_discount>0){?>



      <!--<tr>































          <td colspan="8" align="center" valign="top"><div align="right"><strong>Cash Discount  : </strong></div></td>































          <td align="right" valign="top"><strong>































            <?=floatval($cash_discount);?>































            </strong></td>































        </tr>-->



      <? } if($do->ait>0){ ?>



      <tr>



        <td colspan="8" align="right" valign="top"><strong>AIT <?=$do->ait;?> % :</strong> </td>

		

		<?  if($do->vat_cal_type == 'inclusive' || $do->vat_cal_type == 'exclusive'){ ?>

	   

	   <td align="right" valign="top"><strong><? $ait=$ait_amount; echo number_format(round($ait));?></strong></td>

	   

	

	   <? }else{ ?> 

	   

	   <td align="right" valign="top"><strong><? $ait=(($tot-$spd)/(1-$do->ait/100))-($tot-$spd); echo number_format(round($ait));?></strong></td>

	   

	  <?  } ?>

	  

	  



       



      </tr>



      <? } if($do->vat>0 || $do->vat==0 && $do->vat!=''){ ?>



      <tr>



       <td colspan="8" align="right" valign="top"><strong>Vat <?=$do->vat?> % :</strong><br /><? if($do->vat==0 && $do->vat!=''){  echo "VAT Exempted";} ?></td>



       <?  if($do->vat_cal_type == 'inclusive' || $do->vat_cal_type == 'exclusive' ){ ?>

	   

	   <td align="right" valign="top"><strong><? $vat=$vat_amount; echo number_format(round($vat));?></strong></td>

	   

	

	   <? }else{ ?> 

	   

	   <td align="right" valign="top"><strong><? $vat=(($tot+$ait-$spd)*$do->vat/100); echo number_format(round($vat));?></strong></td>

	   

	  <?  } ?>

	   

	   

	   

	   

	    



      </tr>

	  



	  

	

      <? } if($do->cash_recv){ ?>



      <tr>



        <td colspan="8" align="right" valign="top"><strong>Advance Payment :</strong> </td>



        <td align="right" valign="top"><strong>



          <?=$do->cash_recv?>



          </strong></td>



      </tr>



      <? } ?>



      <? if($do->tov_cost>0){ ?>



      <tr>



        <td colspan="8" align="right" valign="top"><strong>Transport Cost :</strong> </td>



        <td align="right" valign="top"><strong>



          <?=$do->tov_cost?>



          </strong></td>



      </tr>



      <? } ?>



      <tr>



        <td colspan="8" align="center" valign="top"><div align="right"><strong>Total Payable Amount BDT : </strong></div></td>



        <td align="right" valign="top"><strong> <? echo $total=number_format(round($tot-$spd-$do->cash_recv-$cash_discount+$vat+$ait+$do->tov_cost)); 



		 $total_number=round($tot-$spd-$do->cash_recv-$cash_discount+$vat+$ait+$do->tov_cost);  ?> </strong></td>



		                                            



      </tr>



    </table></td>



</tr>



<tr>



<td align="center">



<table width="100%" border="0" cellspacing="0" cellpadding="0">



  <tr>



    <td colspan="2" style="font-size:12px">&nbsp;</td>



  </tr>



  <tr>



    <td width="50%">&nbsp;</td>



    <td>&nbsp;</td>



  </tr>



  <tr>



    <td colspan="2"><span style="text-align:center; color:#000000; font-size:14px;">Amount (In Word): <?php echo convertNumberMhafuz($total_number);?></span></td>



  </tr>



  <tr>



    <td>&nbsp;</td>



    <td>&nbsp;</td>



  </tr>



  



   <!--<tr>



    <td>&nbsp;</td>



    <td>&nbsp;</td>



  </tr>-->



  



  <tr>



  



  <td colspan="2" align="left">



  <br /><br />



  



  <div class="footer_left">



  



  <table width="100%" border="0" cellspacing="0" cellpadding="0">



    <tr>



      <td><div align="center"><span style="font-size:15px"><u>



          <?=find_a_field('user_activity_management','fname','user_id='.$do->entry_by);?>



          </u></span> </div></td>



      <td><div align="center"><span style="font-size:15px"><u>



          <?=find_a_field('user_activity_management','fname','user_id='.$do->checked_by);?>



          </u></span> </div></td>



      <td><div align="center"><span style="font-size:15px"><u>



          <?=find_a_field('user_activity_management','fname','user_id='.$do->approved_by);?>



          </u></span> </div></td>



    </tr>



    <tr>



      <td width="24%"><div align="center" class="style5"><b>Prepared By</b></div></td>



      <td width="23%"><div align="center" class="style5"><b>Checked By </b></div></td>



      <td width="31%"><div align="center" class="style5"><b>Authorized By</b> </div></td>



    </tr>



  </table>



  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">



    <tr>



      <td colspan="2" align="center"><strong><br />



        <br />



        <br />



        <br />



        </strong>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">



          <tr>



            <td width="30%"><div align="center">--------------------------</div></td>



            <td width="30%"><div align="left">&nbsp; </div></td>



            <td width="30%"><div align="left">&nbsp; </div></td>



          </tr>



        </table></td>



    </tr>



    <tr>



      <td colspan="2" align="center"><strong> </strong>



        <table width="100%" border="0" cellspacing="0" cellpadding="0">



          <tr>



            <td width="30%"><div align="center" style="margin-top:-18px;font-size:15px;"><b>Customer Signature</b></div></td>



            <td width="30%"><div align="left">&nbsp; </div></td>



            <td width="30%"><div align="left">&nbsp; </div></td>



          </tr>



        </table>



    </div>



    



    <strong>



	



	<br />



    </strong>



    </td>



    



    </tr>



	



	



    



    <tr>



      <td>&nbsp;</td>



      <td align="center"><div align="center" class="style5"><b>Note: Sorry We Don't Receive Any Cash</b></div></td>



	



	



	 



    </tr>



	



  </table>



  



  



  



  



  <div class="footer1"> </div>



  </td>



  



  </tr>



  



</table><br />



<div id="footer">



  <p align="right">&nbsp;</p>



  <p align="right">&nbsp;</p>



  <div align="center"><img src="../../images/watermark.png" alt="aksid corporation" style="width:500px; position:relative; opacity: 0.05; margin-top:-650px" align="center"></div><br /><br /><br />



  <p style=""><img src="../../../logo/footerlogo.png" width="98%"/>



  



   <!--<span style="font-size:19px; font-family:BankGothic; float:left">AKSID CORPORATION LIMITED</span><br/>



   <span style="float:left; font-size:14px">12th Floor, Rupayan Shopping Square, Plot: C-2, Block: G, Bashundhara, Dhaka-1229, R/A</span><br/>



   <span style="float:left; font-size:14px">Hotline: +8801700761400, Email: info@aksidcorp.com</span>-->



   



  



  </p>



 



<!--<i>Note : All prices are including <strong>AIT & Vat</strong></i>-->



 



</div>



  











</body>



</html>



