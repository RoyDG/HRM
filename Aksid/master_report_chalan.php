<?



session_start();



require "../../../engine/tools/check.php";



require "../../../engine/configure/db_connect.php";



require "../../../engine/tools/my.php";



require "../../../engine/tools/report.class.php";

require "../../../engine/tools/inc.exporttable.php";







date_default_timezone_set('Asia/Dhaka');







if(isset($_POST['submit'])&&isset($_POST['report'])&&$_POST['report']>0)



{



	if((strlen($_POST['t_date'])==10)&&(strlen($_POST['f_date'])==10))



	{



		$t_date=$_POST['t_date'];



		$f_date=$_POST['f_date'];



	}







if($_POST['product_group']!='') $product_group=$_POST['product_group'];



if($_POST['item_brand']!='') 	$item_brand=$_POST['item_brand'];



if($_POST['item_id']>0) 		$item_id=$_POST['item_id'];



if($_POST['dealer_code']>0) 	$dealer_code=$_POST['dealer_code'];


if($_POST['marketing_person']>0) 	$marketing_person=$_POST['marketing_person'];



if($_POST['dealer_type']!='') 	$dealer_type=$_POST['dealer_type'];







if($_POST['status']!='') 		$status=$_POST['status'];



if($_POST['do_no']!='') 		$do_no=$_POST['do_no'];



if($_POST['area_id']!='') 		$area_id=$_POST['area_id'];



if($_POST['zone_id']!='') 		$zone_id=$_POST['zone_id'];



if($_POST['region_id']>0) 		$region_id=$_POST['region_id'];



if($_POST['depot_id']!='') 		$depot_id=$_POST['depot_id'];







if(isset($item_brand)) 			{$item_brand_con=' and i.item_brand="'.$item_brand.'"';}



if(isset($dealer_code)) 		{$dealer_con=' and m.dealer_code="'.$dealer_code.'"';}



if(isset($t_date)) 				{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}







if(isset($dealer_type)) 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'"';}



if(isset($dealer_type)) 		{$dealer_type_con=' and d.dealer_type="'.$dealer_type.'"';}







if(isset($item_id))				{$item_con=' and i.item_id='.$item_id;}



if(isset($depot_id)) 			{$depot_con=' and m.depot_id="'.$depot_id.'"';}







//if(isset($dealer_code)) 		{$dealer_con=' and a.dealer_code="'.$dealer_code.'"';}



//if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';}



//if(isset($zone_id)) 			{$zone_con=' and a.buyer_id='.$zone_id;}



//if(isset($region_id)) 		{$region_con=' and d.id='.$region_id;}



//if(isset($item_id)) 			{$item_con=' and b.item_id='.$item_id;}



//if(isset($status)) 			{$status_con=' and a.status="'.$status.'"';}



//if(isset($do_no)) 			{$do_no_con=' and a.do_no="'.$do_no.'"';}



//if(isset($t_date)) 			{$to_date=$t_date; $fr_date=$f_date; $order_con=' and o.order_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



//if(isset($t_date)) 			{$to_date=$t_date; $fr_date=$f_date; $chalan_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}







switch ($_POST['report']) {



         case 1:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		$report="Delivery Chalan Summary Brief";



		break;

		case 15:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		$report="Delivery Chalan Summary Brief";



		break;


		   case 16:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		$report="Delivery Chalan Summary Brief With Tax & Vat";



		break;





case 102:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		$report="Delivery Chalan Summary Brief";



		break;







case 101:



		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and  m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



		$report="Delivery Order wise Chalan Summary Brief";



		break;



case 2:



		$report="Item Wise Chalan Details Report";

		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		if(isset($depot_id)) 			{$con.=' and d.depot="'.$depot_id.'"';}

		if(isset($dealer_code)) 		{$con.=' and d.dealer_code="'.$dealer_code.'"';}

		if(isset($dealer_type)) 		{$con.=' and d.dealer_type="'.$dealer_type.'"';}



		$sql='select i.finish_goods_code as fg, i.item_name, i.unit_name as unit, sum(a.total_unit) as total_qty, sum(a.total_amt) as Total_Amt from dealer_info d, sale_do_master m,sale_do_chalan a, item_info i, user_activity_management c where d.dealer_code=m.dealer_code and m.do_no=a.do_no and

		 c.user_id=a.entry_by and a.item_id=i.item_id'.$con.$date_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.' group by  a.item_id order by i.finish_goods_code';

	break;









	case 3:



$report="Delivered Chalan Report (Chalan Wise)";



if(isset($dealer_type)) 		{$dtype_con=' and d.dealer_type="'.$dealer_type.'"';}



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($dealer_code)) {$dealer_con=' and m.dealer_code='.$dealer_code;}



if(isset($item_id)){$item_con=' and i.item_id='.$item_id;}



if(isset($depot_id)) {$depot_con=' and m.depot_id="'.$depot_id.'"';}



	break;



	case 6:



	if($_REQUEST['chalan_no']>0)



header("Location:chalan_view.php?v_no=".$_REQUEST['chalan_no']);



	break;



	case 5:



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';}



$report="Delivery Order Brief Report (Region Wise)";



	break;



	    case 7:



		$report="Item wise DO Report";



if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}







$sql = "select concat(i.finish_goods_code,'- ',item_name) as item_name,i.item_brand,i.sales_item_type as `group`,



floor(sum(o.total_unit)/o.pkt_size) as crt,



mod(sum(o.total_unit),o.pkt_size) as pcs,



sum(o.total_amt)as dP,



sum(o.total_unit*o.t_price)as tP



from



sale_do_master m,sale_do_details o, item_info i,dealer_info d



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and i.item_id=o.item_id  and m.status in ('CHECKED','COMPLETED') ".$date_con.$item_con.$item_brand_con.$pg_con.' group by i.finish_goods_code';



	break;



		case 8:



if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 	{$pg_con=' and d.product_group="'.$product_group.'"';}



$report="Dealer Performance Report";



	    case 9:



		$report="Item Report (Region Wise)";



if(isset($t_date)) 	{$to_date=$t_date; $fr_date=$f_date; $date_con=' and m.do_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



if(isset($product_group)) 		{$pg_con=' and d.product_group="'.$product_group.'"';}



		break;



case 104:
$report="Free sample Report";
break;


		case 10:



		$report="Daily Collection Summary";







$sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name,m.branch as branch_name,m.payment_by as payment_mode, m.rcv_amt as amount,m.remarks,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as Varification_Sign,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as DO_Section_sign from



sale_do_master m,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$date_con.$pg_con." order by m.entry_at";



		break;







		case 11:



		$report="Daily Collection &amp; Order Summary";







$sql="select m.do_no, m.do_date, concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name, m.payment_by as payment_mode,m.remarks, m.rcv_amt as collection_amount,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' from



sale_do_master m,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$date_con.$pg_con." order by m.entry_at";



		break;



				case 13:



		$report="Daily Collection Summary(EXT)";







$sql="select m.do_no,m.do_date,m.entry_at,concat(d.dealer_code,'- ',d.dealer_name_e)  as party_name,(SELECT AREA_NAME FROM area where AREA_CODE=d.area_code) as area  ,d.product_group as grp, m.bank as bank_name,m.branch as branch_name,m.payment_by as payment_mode, m.rcv_amt as amount,m.remarks,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as Varification_Sign,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' as DO_Section_sign from



sale_do_master m,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$date_con.$pg_con." order by m.entry_at";



		break;



    case 111:



	if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



$report="Corporate Chalan Summary Brief";



	break;



	    case 112:



	if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and c.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



$report="SuperShop Chalan Summary Brief";



	break;







	    case 1004:



		$report="Warehouse Stock Position Report(Closing)";







		break;



}



}



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="content-type" content="text/html; charset=utf-8" />



<title><?=$report?></title>



<link href="../../css/report.css" type="text/css" rel="stylesheet" />



<script language="javascript">



function hide()



{



document.getElementById('pr').style.display='none';



}



</script>



    <style type="text/css" media="print">



      div.page



      {



        page-break-after: always;



        page-break-inside: avoid;



      }



    </style>



</head>



<body>



<div align="center" id="pr" style="text-align:justify">



<!--<input type="button" value="Print" onclick="hide();window.print();"/>-->



</div>



<div class="main">



<?



		$str 	.= '<div class="header">';



		if(isset($_SESSION['company_name']))



		$str 	.= '<h1>'.$_SESSION['company_name'].'</h1>';



		if(isset($report))



		$str 	.= '<h2>'.$report.'</h2>';



		if(isset($dealer_code))



		$str 	.= '<h2>Dealer Name : '.$dealer_code.' - '.find_a_field('dealer_info','dealer_name_e','dealer_code='.$dealer_code).'</h2>';



		if(isset($to_date))



		$str 	.= '<h2>Date Interval : '.$fr_date.' To '.$to_date.'</h2>';



		if(isset($product_group))



		$str 	.= '<h2>Product Group : '.$product_group.'</h2>';



		if(isset($dealer_type))



		$str 	.= '<h2>Dealer Type : '.$dealer_type.'</h2>';



		$str 	.= '</div>';



		$str 	.= '<div class="left" style="width:100%">';







//		if(isset($allotment_no))



//		$str 	.= '<p>Allotment No.: '.$allotment_no.'</p>';



//		$str 	.= '</div><div class="right">';



//		if(isset($client_name))



//		$str 	.= '<p>Dealer Name: '.$dealer_name.'</p>';



//		$str 	.= '</div><div class="date">Reporting Time: '.date("h:i A d-m-Y").'</div>';





if($_POST['report']==1004)



{



			if(isset($sub_group_id)) 			{$item_sub_con=' and i.sub_group_id='.$sub_group_id;}







			elseif(isset($item_id)) 			{$item_sub_con=' and i.item_id='.$item_id;}







			if(isset($product_group)) 			{$product_group_con=' and i.sales_item_type="'.$product_group.'"';}







			if(isset($t_date))



			{$to_date=$t_date; $fr_date=$f_date; $date_con=' and ji_date <="'.$to_date.'"';}











		$sql='select distinct i.item_id,i.unit_name,i.brand_category_type,i.item_name,"Finished Goods",i.finish_goods_code,i.sales_item_type,i.item_brand,i.pack_size



		   from item_info i where i.finish_goods_code!=2000 and i.finish_goods_code!=2001 and i.finish_goods_code!=2002 and i.finish_goods_code>0 and i.finish_goods_code not between 5000 and 6000 and i.sub_group_id="1096000100010000" '.$item_sub_con.$product_group_con.' and i.item_brand != "" and i.status="Active" order by i.brand_category_type,i.brand_category,i.item_brand';







		$query =mysql_query($sql);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0"><thead><tr><td style="border:0px;" colspan="10"><div class="header"><h1>Sajeeb Group</h1><h2><?=$report?></h2>



<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>



<th>S/L</th>



<th>Brand</th>



<th>Item Type </th>



<th>FG</th>



<th>Item Name</th>



<th>Group</th>



<th>Unit</th>



<th>Dhaka</th>



<th>Gazipur</th>



<th>Chittagong</th>



<th>Borisal</th>



<th>Bogura</th>



<th>Sylhet</th>



<th>Jessore</th>



<th>Total</th>



</tr>



</thead><tbody>



<?



while($data=mysql_fetch_object($query)){











	$dhaka = 	(int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "3"')/$data->pack_size);



	$ctg = 		(int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "6"')/$data->pack_size);



	$sylhet =   (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "9"')/$data->pack_size);



	$bogura =   (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "7"')/$data->pack_size);



	$borisal =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "8"')/$data->pack_size);



	$jessore =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "10"')/$data->pack_size);



	$gajipur =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id = "54"')/$data->pack_size);



	$total = 	$dhaka + $ctg + $sylhet + $bogura + $borisal + $jessore + $gajipur;







	//echo $sql = 'select sum(item_in-item_ex) from journal_item where item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="9"';







?>



<tr>



	<td><?=++$j?></td>



	<td><?=$data->item_brand?></td>



	<td><?=$data->brand_category_type?></td>



	<td><?=$data->finish_goods_code?></td>



	<td><?=$data->item_name?></td>



	<td><?=$data->sales_item_type?></td>



	<td><?=$data->unit_name?></td>



	<td style="text-align:right"><?=(int)$dhaka?></td>



	<td style="text-align:right"><?=(int)$gajipur?></td>



	<td style="text-align:right"><?=(int)$ctg?></td>



	<td style="text-align:right"><?=(int)$borisal?></td>



	<td style="text-align:right"><?=(int)$bogura?></td>



	<td style="text-align:right"><?=(int)$sylhet?></td>



	<td style="text-align:right"><?=(int)$jessore?></td>



	<td style="text-align:right"><?=(int)$total?>&nbsp;</td>



</tr>



<?



}







?>



</tbody></table>



<?







}



if($_POST['report']==100245)



{

             if(isset($_POST['sub_group_id'])) 			{$item_sub_con.=' and i.sub_group_id='.$_POST['sub_group_id'];}





			 if(isset($t_date))



		{$date_con_f=' and a.ji_date <="'.$t_date.'" ';}











		 $sql='select distinct i.item_id,i.unit_name,i.item_name,s.sub_group_name,i.finish_goods_code,i.d_price



		   from item_info i, item_sub_group s where



		   i.sub_group_id=s.sub_group_id '.$item_sub_con.' order by i.finish_goods_code,s.sub_group_name,i.item_name';







		$query =mysql_query($sql);



		$warehouse_name = find_a_field('warehouse','warehouse_name','warehouse_id='.$_SESSION['user']['depot']);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0"><thead><tr><td style="border:0px;" colspan="9"><div class="header">

  <h1>Aksid Corporation Limited </h1>

  <h2><?=$report?></h2>







<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>



<th>S/L</th>



<th>Warehouse Name</th>



<th>Item Code</th>



<th>Item Group</th>



<th>FG</th>



<th>Item Name</th>



<th>Unit</th>



<th>Final Stock</th>



<th>Rate</th>



<th>Stock Price</th>



</tr>



</thead><tbody>



<?



while($data=mysql_fetch_object($query)){



  $s='select FORMAT(sum(a.item_in-a.item_ex),2) as final_stock,sum((a.item_in-a.item_ex)*(a.item_price)) as Stock_price



from journal_item a where  a.item_id="'.$data->item_id.'" '.$date_con_f.' and a.warehouse_id="'.$_SESSION['user']['depot'].'" order by a.id desc limit 1';



$q = mysql_query($s);



$i=mysql_fetch_object($q);$j++;



$amt = $i->final_stock*$data->d_price;



$total_amt = $total_amt + $amt;



		   ?>



<tr>



<td><?=$j?></td>



<td><?=$warehouse_name?></td>



<td><?=$data->item_id?></td>



<td><?=$data->sub_group_name?></td>



<td><?=$data->finish_goods_code?></td>



<td><?=$data->item_name?></td>



<td><?=$data->unit_name?></td>



<td style="text-align:right"><?=$i->final_stock?></td>



<td style="text-align:right"><?=@number_format($data->d_price,2)?></td>



<td style="text-align:right"><?=number_format(($amt),2)?></td>



</tr>



<?



}







?>



<tr>



<td></td>



<td></td>



<td></td>



<td></td>



<td></td>



<td></td>



<td></td>



<td></td>



<td>Total: </td>



<td style="text-align:right"><?=number_format(($total_amt),2)?></td>



</tr>



</table>







<?

}





elseif($_POST['report']==101)



{



if(isset($product_group))	{$pg_con=' and d.product_group="'.$product_group.'"';}



$sqld="select c.chalan_no,m.do_no,m.do_date,c.driver_name as serial_no,c.chalan_date,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,w.warehouse_name as depot,d.product_group as grp,sum(total_amt) as total_amt from



sale_do_master m,sale_do_chalan c,dealer_info d  , warehouse w



where  m.do_no=c.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id ".$depot_con.$date_con.$pg_con.$dealer_con.$dealer_type_con." group by chalan_no order by c.chalan_no";



$query = mysql_query($sqld);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="8"><?=$str?></td></tr><tr><th>S/L</th><th>Do Date</th>



  <th>Do No</th>



  <th>Chalan Date</th><th>Chalan No</th><th>Serial No</th><th>Dealer Name</th><th>Depot</th><th>Grp</th><th>DP Total</th><th>Discount</th><th>Sale Total</th></tr></thead>



<tbody>



<?







while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));







$sqld1 = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and total_amt>0';



$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info1[0];



?>



	<tr>



<td><?=$s?></td><td><?=$data->do_date?></td>



<td><?=$data->do_no?></td>



<td><?=$data->chalan_date?></td>



<td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>



<td><?=$data->serial_no?></td>



<td><?=$data->dealer_name?></td><td><?=$data->depot?></td><td><?=$data->grp?></td><td><?=number_format($info1[0],2);?></td><td><?=number_format(($info[0]-$info1[0]),2);?></td><td><?=number_format($info[0],2)?></td>



  	</tr>



<?



}



?>





<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td>



  <td>&nbsp;</td>



  <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format($dp_t,2)?></td><td><?=number_format(($dp_t-$tp_t),2)?></td><td><?=number_format(($tp_t),2)?></td></tr></tbody></table>









  <!--item wise delaer report Dealer wise -->



<?

}





elseif($_POST['report']==66) {





        if(isset($product_group))	{$pg_con=' and d.product_group="'.$product_group.'"';}



        $report="Item Wise Chalan Details Report";

		if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}

		if(isset($depot_id)) 			{$con.=' and d.depot="'.$depot_id.'"';}

		if(isset($dealer_code)) 		{$con.=' and d.dealer_code="'.$dealer_code.'"';}

		if(isset($dealer_type)) 		{$con.=' and d.dealer_type="'.$dealer_type.'"';}



 $sql66='select i.finish_goods_code as fg, i.item_name, i.unit_name as unit, sum(a.total_unit) as total_qty, sum(a.total_amt) as Total_Amt,a.unit_price,
concat(d.dealer_name_e ,"-", d.dealer_code) as dealer_name,

m.marketing_person

from dealer_info d, sale_do_master m,sale_do_chalan a, item_info i, user_activity_management c where d.dealer_code=m.dealer_code and m.do_no=a.do_no and

c.user_id=a.entry_by and a.item_id=i.item_id'.$con.$date_con.$warehouse_con.$item_con.$item_brand_con.$dtype_con.' group by  d.dealer_name_e order by d.dealer_name_e  ';



$query = mysql_query($sql66);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0">

<thead>

<tr>

<td style="border:0px;" colspan="5"><?=$str?></td>

</tr>



<tr><th>S/L</th>

<th>Dealer Name</th>

<th>Item Name</th>

<th>Unit Name</th>

<th>Total Qty</th>

<th>Unit Price</th>

<th>DP Total</th>

<th>Marketing Person</th>

</tr></thead><tbody>



<?

while($data=mysql_fetch_object($query)){$s++;



$total_qty +=$data->total_qty;

$total_amt +=$data->Total_Amt;



?>



<tr>

<td><?=$s?></td>

<td><?=$data->dealer_name?></td>

<td><?=$data->item_name?></td>

<td><?=$data->unit?></td>

<td><?=$data->total_qty?></td>

<td><?=$data->unit_price?></td>

<td><?=$data->Total_Amt?></td>

<td><?=find_a_field('personnel_basic_info','concat(PBI_NAME," - ",PBI_ID)','PBI_ID='.$data->marketing_person);?></td>



</tr>

<? } ?>

<tr class="footer"><td>&nbsp;</td>

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format($total_qty,2)?></td><td>&nbsp;</td><td><?=number_format($total_amt,2)?></td><td></td></tr></tbody></table>











<!--end report section-->















  <!--aging start -->



<?

}elseif($_POST['report']==68) {









        $report="Aging Report";



		  // date('d-M-Y',strtotime($variable));



		 $to_date=date('Y-m-d',strtotime($t_date));

		 $fr_date=date('Y-m-d',strtotime($f_date));

		 $default_date = '2016-01-01';



		//if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $date_con=' and a.chalan_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



  if(isset($dealer_code)) 		{$con.=' and d.dealer_code="'.$dealer_code.'"';}
   if(isset($marketing_person)) 		{$con.=' and d.marketing_person="'.$marketing_person.'"';}

 $sql66='select d.dealer_name_e,d.marketing_person,d.account_code,sum(j.dr_amt-j.cr_amt) as closing_amount,j.tr_id
 from  dealer_info d,journal j

 where j.ledger_id=d.account_code and d.account_code>0'.$con.' and j.jv_date between "'.strtotime($default_date).'" and "'.strtotime($t_date).'" and j.tr_from="Sales"
 and d.dealer_code NOT IN("1529","1398","1305","1885","1938","2187","2288","2289","2613","1414")  group by  d.account_code';



$query = mysql_query($sql66);







?>



<table width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">

<thead>

<tr>

<td style="border:0px;" colspan="7"><?=$str?></td>

</tr>



<tr>

<th>S/L</th>

<th>Customer Name</th>
<th>Sales person</th>

<th>Department</th>
<th>Closing</th>



<th>1-30 Days Dues</th>

<th>31-60 Days Dues</th>

<th>61-90 Days Dues</th>

<th>91-120 Days Dues</th>

<th> Over 120 Days Dues</th>



</tr></thead><tbody>

<?

while($data=mysql_fetch_object($query)){



$closing =find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'"');

//////////////**************  Check Dues **************/////////////////////////////
//old Format
    $today_days= strtotime($t_date);
    $days_30= $today_days-(86400*30);

	 $days_31= $days_30-86400;
     $days_60= $days_31-(86400*30);

	 $days_61= $days_60-86400;
     $days_90= $days_61-(86400*30);

     $days_91= $days_90-86400;
	 $days_120= $days_91-(86400*30);

	 $days_121= $days_120-86400;

    /*$days_31= $days_30-86400;
    $days_45= $days_31-(86400*15);

	 $days_46= $days_45-86400;
     $days_60= $days_46-(86400*15);

    $days_61= $days_60-86400;
	$days_75= $days_61-(86400*15);

    $days_76= $days_75-86400;
    $days_90= $days_76-(86400*15);

    $days_91= $days_90-86400;
    $days_105= $days_91-(86400*15);

	$days_106= $days_105-86400;*/

    $aging_fixed_back_date = strtotime('01-06-2016');











//old Format

//New date check

   $do_date = find_a_field('sale_do_master','do_date','do_no='.$data->tr_id);

   $start = strtotime($do_date);
   $end =strtotime($t_date);

   $days_count= ceil(abs($start - $end) / 86400);

   $rceived = find_a_field('journal','sum(cr_amt)', 'tr_from IN ("Receipt","journal_info") and ledger_id="'.$data->account_code.'" and ref_no='.$data->tr_id);





if($closing>0){


$s++;



?>



<tr>

<td><?=$s?></td>

<td><?=$data->dealer_name_e?></td>
<td><?=find_a_field('personnel_basic_info','concat(PBI_CODE," - ",PBI_NAME)','PBI_ID='.$data->marketing_person); 
       $dep=find_a_field('personnel_basic_info','PBI_DEPARTMENT','PBI_ID='.$data->marketing_person);  ?></td>
<td><?=find_a_field('department','DEPT_DESC','DEPT_ID='.$dep);?></td>
<td align="right"><?=number_format($closing); $total_closing_amount = $total_closing_amount+$closing;?></td>



<td align="right"><?

// _______SALES : 30 days past DO NO ______*
 $sql = 'select tr_id from journal
where ledger_id = "'.$data->account_code.'" and tr_from="Sales" and jv_date between "'.$days_30.'" and "'.$today_days.'" group by tr_id ';
$queryy = mysql_query($sql);
$ii=0;
$ddi ='';
while($sales_data = mysql_fetch_object($queryy)){

if($ii==0){  $ddi = $sales_data->tr_id;}
else{
$ddi .=','.$sales_data->tr_id;
}
++$ii;

}
$ddi;

//_________ 30 days past dues ____________
$sales_30   = find_a_field('journal','sum(dr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="Sales" and tr_id in ('.$ddi.')');
$rceived_30 = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from IN ("Receipt","journal_info") and ref_no in ('.$ddi.')');
$return_30  = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="SalesReturn" and ref_no in ('.$ddi.')');
$expense_30 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="Expense" and ref_no in ('.$ddi.')');

 $check_dues_30 = ($sales_30-($rceived_30+$return_30+$expense_30));  $total_30_days_dues +=$check_dues_30;

echo ($check_dues_30>0)?  number_format($check_dues_30,0) : '';




//$day30=find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'" and jv_date between "'.$days_30.'" and "'.$today_days.'"');



?></td>

<td align="right"><?
// _______SALES : 31-60 Days  past dues DO NO ______*
 $sql2 = 'select tr_id  from journal
where ledger_id = "'.$data->account_code.'" and tr_from="Sales" and jv_date between "'.$days_60.'" and "'.$days_31.'" group by tr_id ';
$query2 = mysql_query($sql2);
$iii=0;
$ddi2 ='';
while($sales_data = mysql_fetch_object($query2)){

if($iii==0){  $ddi2 = $sales_data->tr_id;}
else{
$ddi2 .=','.$sales_data->tr_id;
}
++$iii;

}
$ddi2;

//_________ 31-60 Days  past  ____________
  $sales_60   = find_a_field('journal','sum(dr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="Sales" and tr_id in ('.$ddi2.')');
  $rceived_60 = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from IN ("Receipt","journal_info") and ref_no in ('.$ddi2.')');
  $return_60  = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="SalesReturn" and ref_no in ('.$ddi2.')');
  $expense_60 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="Expense" and ref_no in ('.$ddi2.')');

 $check_dues_60 = $sales_60-($rceived_60+$return_60+$expense_60); $total_60_days_dues +=$check_dues_60;

echo ($check_dues_60>0)?  number_format($check_dues_60,0) : '';

//$day45=find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'" and jv_date between "'.$days_45.'" and "'.$days_31.'"');
?></td>

<td align="right"><?


// _______SALES : 60 to 90 days past dues DO NO ______*
 $sql = 'select tr_id from journal
where ledger_id = "'.$data->account_code.'" and tr_from="Sales" and jv_date between "'.$days_90.'" and "'.$days_61.'" group by tr_id ';
$queryy = mysql_query($sql);
$ii=0;
$ddi3 ='';
while($sales_data = mysql_fetch_object($queryy)){

if($ii==0){  $ddi3 = $sales_data->tr_id;}
else{
$ddi3 .=','.$sales_data->tr_id;
}
++$ii;

}
$ddi3;

//_________ 60 to 90 days past dues ____________
$sales_90   = find_a_field('journal','sum(dr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="Sales" and tr_id in ('.$ddi3.')');
$rceived_90 = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from IN ("Receipt","journal_info") and ref_no in ('.$ddi3.')');
$return_90  = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="SalesReturn" and ref_no in ('.$ddi3.')');
$expense_90 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="Expense" and ref_no in ('.$ddi3.')');

$check_dues_90 = ($sales_90-($rceived_90+$return_90+$expense_90)); $total_90_days_dues +=$check_dues_90;
echo ($check_dues_90>0)?  number_format($check_dues_90,0) : '';




//=$day60=find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'" and jv_date between "'.$days_60.'" and "'.$days_45.'"');



?></td>

<td align="right"><?

// _______SALES : 90 to 120 days past dues DO NO ______*
$sql = 'select tr_id from journal
where ledger_id = "'.$data->account_code.'" and tr_from="Sales" and jv_date between "'.$days_120.'" and "'.$days_91.'" group by tr_id ';
$queryy = mysql_query($sql);
$ii=0;
$ddi4 ='';
while($sales_data = mysql_fetch_object($queryy)){

if($ii==0){  $ddi4 = $sales_data->tr_id;}
else{
$ddi4 .=','.$sales_data->tr_id;
}
++$ii;

}
$ddi4;

//_________ 90 to 120 days past dues  days past dues ____________
$sales_120   = find_a_field('journal','sum(dr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="Sales" and tr_id in ('.$ddi4.')');
$rceived_120 = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from IN ("Receipt","journal_info") and ref_no in ('.$ddi4.')');
$return_120  = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="SalesReturn" and ref_no in ('.$ddi4.')');
$expense_120 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="Expense" and ref_no in ('.$ddi4.')');
$check_dues_120 = ($sales_120-($rceived_120+$return_120+$expense_120)); $total_120_days_dues +=$check_dues_120;

echo ($check_dues_120>0)?  number_format($check_dues_120,0) : '';


//$day75=find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'" and jv_date between "'.$days_75.'" and "'.$days_60.'"');?></td>




<td align="right">

<?

// _______SALES : Above 120 days past dues DO NO ______*
 $sql7 = 'select tr_id from journal
where ledger_id = "'.$data->account_code.'" and tr_from="Sales" and jv_date between "'.$aging_fixed_back_date.'" and "'.$days_121.'" group by tr_id ';
$queryy7 = mysql_query($sql7);
$ii7=0;
$ddi7 ='';
while($sales_data7 = mysql_fetch_object($queryy7)){

if($ii7==0){  $ddi7 = $sales_data7->tr_id;}
else{
$ddi7 .=','.$sales_data7->tr_id;
}
++$ii7;

}
 $ddi7;

//_________ Avobe 120 days past dues____________
 $sales_avobe_120   = find_a_field('journal','sum(dr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from="Sales" and tr_id in ('.$ddi7.')');
 $rceived_avobe_120 = find_a_field('journal','sum(cr_amt)', 'ledger_id = "'.$data->account_code.'" and tr_from IN ("Receipt","journal_info") and ref_no in ('.$ddi7.')');
 $return_avobe_120 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="SalesReturn" and ref_no in ('.$ddi7.')');
 $expense_avobe_120 = find_a_field('journal','sum(cr_amt)',  'ledger_id = "'.$data->account_code.'" and tr_from="Expense" and ref_no in ('.$ddi7.')');
 $check_dues_avobe_120 = ($sales_avobe_120-($rceived_avobe_120+$return_avobe_120+$expense_avobe_120)); $total_dues_avobe_120 +=$check_dues_avobe_120;

echo ($check_dues_avobe_120>0)?  number_format($check_dues_avobe_120,0) : '';

//$day105=find_a_field('journal','sum(dr_amt-cr_amt)','ledger_id="'.$data->account_code.'" and jv_date<"'.$days_105.'"  ');




?></td>



</tr>

<? } } ?>

<tr class="footer"><td>&nbsp;</td>

<td>&nbsp;</td><td>&nbsp;</td><td>TOTAL:</td>
<td><?=number_format($total_closing_amount)?></td>
<td align="right"><?=number_format($total_30_days_dues)?></td>
<td align="right"><?=number_format($total_60_days_dues)?></td>
<td align="right"><?=number_format($total_90_days_dues)?></td>
<td align="right"><?=number_format($total_120_days_dues)?></td>
<td align="right"><?=number_format($total_dues_avobe_120)?></td>
</tr>
</tbody>
</table>











<!--end agning report section-->














<?







}



elseif($_POST['report']==1)



{





 $sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,c.total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,c.total_unit,c.unit_price from
sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";







$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" id="ExportTable" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="7">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th><th>Serial No</th><th>Chalan Date</th><th>Dealer Name</th><th>Item Name</th>
<th>Unit Price</th><th>Total Unit</th><th>Sales Total</th>  <th>Dis</th><th>Actual Sales</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));



//$tax = ($data->total_amt/100)* $data->ait;




$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';
$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;
$rcv_t = $rcv_t+$data->rcv_amt;
$dp_t = $dp_t+$info[0];
$tp_t = $tp_t+$info1[0];
$tu_t = $tu_t+$info1[2];










?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td><td><?=$data->do_no?></td><td><?=$data->do_date?></td><td><?=$data->serial_no?></td><td><?=$data->chalan_date?></td><td><?=$data->dealer_name?></td><td><?=$data->item_name?></td><td><?=$data->unit_price?></td><td><?=$data->total_unit?></td>

<td><?=number_format(($info[0]-$info1[0]),2);?></td>
<td><?=number_format(($info1[0]*(-1)),2);?></td>
<td><?=number_format(($info[0]),2);?></td>

</tr>



<?



}



?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td>


<td><?=number_format(($dp_t-$tp_t),2)?></td>
<td></td>



<td><?=number_format(((-1)*$tp_t),2)?></td>

</tr></tbody></table>






<!--Chalan report with tax vat-->












<?







}



elseif($_POST['report']==15)



{





 $sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,SUM(c.total_amt) as total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,m.vat,m.ait,c.total_unit,c.unit_price,m.vat_cal_type from
sale_do_master m,sale_do_chalan c,dealer_info d ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con."
group by c.chalan_no order by c.chalan_no";







$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th><th>Serial No</th><th>Chalan Date</th>
<th>Dealer Name</th>
<th>Item Name</th>
<th>Unit Price</th>
<th>Total Unit</th>
<th>Sales Total</th>
<th>Tax %</th>
<th>Tax Amount</th>
<th>Vat %</th>
<th>Vat Amount</th>
<th>Total Invoice Values</th>
</tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));



//$tax = ($data->total_amt/100)* $data->ait;




$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';
$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;
$rcv_t = $rcv_t+$data->rcv_amt;
$dp_t = $dp_t+$info[0];
$tp_t = $tp_t+$info1[0];
$tu_t = $tu_t+$info1[2];





$sqld2 = 'select sum(cr_amt) from journal  where tr_no='.$data->chalan_no.' and tr_from="Sales" and ledger_id IN(1089000100000000,1089001000000000)';
$info2 = mysql_fetch_row(mysql_query($sqld2));
$tax =  $info2[0]-$info[0];


$sqld3 = 'select sum(cr_amt) from journal  where tr_no='.$data->chalan_no.' and tr_from="Sales" and ledger_id=2063001700000000';
$info3 = mysql_fetch_row(mysql_query($sqld3));
$vat =  $info3[0];





?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<td><?=$data->do_no?></td>
<td><?=$data->do_date?></td>
<td><?=$data->serial_no?></td>
<td><?=$data->chalan_date?></td>
<td><?=$data->dealer_name?></td>
<td><?=$data->item_name?></td>


<td align="right"><?
if($data->vat_cal_type == 'inclusive'){
echo find_a_field('sale_do_details','net_rate','do_no="'.$data->do_no.'"');
}else{
echo $data->unit_price;
}

?></td>


<td align="right"><?=$data->total_unit?></td>
<td align="right">

<?
if($data->vat_cal_type == 'inclusive'){
echo number_format($tot_amt= find_a_field('sale_do_details','sum(net_value)','do_no="'.$data->do_no.'"'));
$total_sales_amount_new +=$tot_amt;
}else{
echo number_format(($tot_amt=$info[0]-$info1[0]),2);
$total_sales_amount_new +=$tot_amt;
}



?>

</td>
<td align="right"><?=($data->ait>0)? $data->ait : ''; ?></td>


<td align="right"><?
if($data->vat_cal_type == 'inclusive' && $data->ait!=0){
echo $taxes=number_format(find_a_field('sale_do_details','sum(ait_amt)','do_no="'.$data->do_no.'"'));
$total_tax += $taxes;
}else{
if($data->ait!=0){
echo number_format($tax);
$total_tax += $tax;
}

}


?></td>



<td align="right">
<?

if($data->vat==0 && $data->vat!=''){
	echo " Vat Exempted ";
}elseif($data->vat>0){

	echo $data->vat;
}


 ?>



  </td>
<td align="right"><?
if($data->vat!=0){
echo number_format($vat);
$total_vat += $vat;
}
?></td>


<td align="right">
<?
if($data->ait!=0 || $data->vat!=0){ ?>
<?=number_format(($info[0]+$vat+$tax));?>
<? }else{  ?>
<?=number_format(($info[0]));?>
<?  }?>

</td>

</tr>



<?



}



?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td>


<td align="right"><?=number_format($total_sales_amount_new);?></td>
<td>&nbsp;</td>
<td align="right"><?=number_format($total_tax)?></td>
<td></td>
<td align="right"><?=number_format($total_vat)?></td>


<td align="right"><?=number_format(($total_sales_amount_new+$total_tax+$total_vat))?></td>



</tr></tbody></table>









<!--Cogs with chalan -->




<!--Chalan report with tax vat-->












<?







}



elseif($_POST['report']==16)



{





/* $sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,SUM(c.total_amt) as total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,m.vat,m.ait,c.total_unit,c.unit_price,m.vat_cal_type from
sale_do_master m,sale_do_chalan c,dealer_info d ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";*/



$sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,c.total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,c.total_unit,c.unit_price,c.item_id,m.vat,m.ait,m.vat_cal_type,m.cost_center,m.type,d.account_code
from
sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";




$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" id="ExportTable" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th>
<th>Cost Center</th>
<th>Marketing Person</th>
<th>Ledger ID</th>
<th>Type</th>
<th>Chalan Date</th>
<th>Dealer Name</th>
<th>Item Name</th>
<th>Unit Price</th>
<th>Total Unit</th>
<th>Sales Total</th>
<th>Tax %</th>
<th>Tax Amount</th>
<th>Vat %</th>
<th>Vat Amount</th>
<th>Total Invoice Values</th>
</tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;
$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';
$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;
$rcv_t = $rcv_t+$data->rcv_amt;
$dp_t = $dp_t+$info[0];
$tp_t = $tp_t+$info1[0];
$tu_t = $tu_t+$info1[2];


$sqld2 = 'select * from sale_do_details  where item_id='.$data->item_id.' and do_no='.$data->do_no.'';
$info2 = mysql_fetch_object(mysql_query($sqld2));
//$tax =  $info2[0]-$info[0];
$net_ret = $info2->net_rate;
$ait_amount = $info2->ait_amt;
$vat_amount = $info2->vat_amt;
$net_vaules = $info2->net_value;

$total_pro_amt_incl = $net_vaules +$vat_amount+$ait_amount;



?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<td><?=$data->do_no?></td>
<td><?=$data->do_date?></td>
<td><?=find_a_field('cost_center','concat(center_name," - ",id)',"id=".$data->cost_center);?></td>
<td><?=find_a_field('personnel_basic_info','concat(PBI_NAME," - ",PBI_CODE)',"PBI_ID=".$data->marketing_person);?></td>
<td><?=find_a_field('accounts_ledger','concat(ledger_name," - ",ledger_id)',"ledger_id=".$data->account_code);?></td>
<td><?=$data->type;?></td>
<td><?=$data->chalan_date?></td>
<td><?=$data->dealer_name?></td>
<td><?=$data->item_name?></td>

<td align="right"><? if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){echo $net_ret;}else{echo $data->unit_price;}?></td>
<td align="right"><?=$data->total_unit?></td>

<td align="right"><? //if($data->vat>0 || $data->ait>0){echo $total_sales_amount=($net_vaules);}else{echo $total_sales_amount=$info[0]; $tot_sales_item +=$total_sales_amount;}



if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){
echo number_format($tot_amt=$net_vaules);
$total_sales_amount_new +=$tot_amt;
}else{
echo number_format(($tot_amt=$info[0]-$info1[0]),2);
$total_sales_amount_new +=$tot_amt;
}


?></td>


<td align="right"><?=($data->ait>0)? $data->ait : ''; ?></td>
<td align="right"><?=($ait_amount>0)? number_format($ait_amount): ''; $total_ait_amount +=$ait_amount;?></td>
<td align="right"><? if($data->vat==0 && $data->vat!=''){ echo " Vat Exempted ";}elseif($data->vat>0){ echo $data->vat;}?></td>
<td align="right"><? if($data->vat!=0 && $data->unit_price>0){ echo number_format($vat_amount); $total_vat += $vat_amount;}?></td>


<td align="right">
<?
if($data->vat_cal_type == 'exclusive' && $data->unit_price>0 ){ ?>
<?=number_format(($invoice_values = $info[0]+$vat_amount+$ait_amount));
  $total_invoice_values +=$invoice_values;?>
<? }elseif($data->vat_cal_type == 'inclusive' && $data->unit_price>0){  ?>

<?=number_format(($invoice_values = $total_pro_amt_incl));
$total_invoice_values +=$invoice_values;
}else{?>

<?=number_format(($invoice_values = $info[0]));
$total_invoice_values +=$invoice_values;?>
<?  }?>

</td>


</tr>
<? } ?>
<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>


<td align="right"><?=number_format($total_sales_amount_new);?></td>
<td>&nbsp;</td>
<td align="right"><?=number_format($total_ait_amount)?></td>
<td></td>
<td align="right"><?=number_format($total_vat)?></td>


<td align="right"><?=number_format(($total_invoice_values))?></td>





</tr></tbody></table>











<!--New Start from here-->







<!--Chalan report with tax vat-->












<?







}



elseif($_POST['report']==551)



{





/* $sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,SUM(c.total_amt) as total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,m.vat,m.ait,c.total_unit,c.unit_price,m.vat_cal_type from
sale_do_master m,sale_do_chalan c,dealer_info d ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";*/



$sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,c.total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,c.total_unit,c.unit_price,c.item_id,m.vat,m.ait,m.vat_cal_type,m.cost_center,m.type,d.account_code
from
sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";




$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" id="ExportTable" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th>
<th>Cost Center</th>
<th>Marketing Person</th>
<th>Commission Amount</th>
<th>Type</th>
<th>Chalan Date</th>
<th>Dealer Name</th>
<th>Item Name</th>
<th>Unit Price</th>
<th>Total Unit</th>
<th>Sales Total</th>
<th>Tax %</th>
<th>Tax Amount</th>
<th>Vat %</th>
<th>Vat Amount</th>
<th>Total Invoice Values</th>
</tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;
$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';
$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;
$rcv_t = $rcv_t+$data->rcv_amt;
$dp_t = $dp_t+$info[0];
$tp_t = $tp_t+$info1[0];
$tu_t = $tu_t+$info1[2];


$sqld2 = 'select * from sale_do_details  where item_id='.$data->item_id.' and do_no='.$data->do_no.'';
$info2 = mysql_fetch_object(mysql_query($sqld2));
//$tax =  $info2[0]-$info[0];
$net_ret = $info2->net_rate;
$ait_amount = $info2->ait_amt;
$vat_amount = $info2->vat_amt;
$net_vaules = $info2->net_value;

$total_pro_amt_incl = $net_vaules +$vat_amount+$ait_amount;

$total_commission = $total_commission+$info2->incentive_amt;

?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<td><?=$data->do_no?></td>
<td><?=$data->do_date?></td>
<td><?=find_a_field('cost_center','concat(center_name," - ",id)',"id=".$data->cost_center);?></td>
<td><?=find_a_field('personnel_basic_info','concat(PBI_NAME," - ",PBI_CODE)',"PBI_ID=".$data->marketing_person);?></td>
<td align="right"><? if($info2->incentive_amt>0) echo $info2->incentive_amt;?></td>
<td><?=$data->type;?></td>
<td><?=$data->chalan_date?></td>
<td><?=$data->dealer_name?></td>
<td><?=$data->item_name?></td>

<td align="right"><? if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){echo $net_ret;}else{echo $data->unit_price;}?></td>
<td align="right"><?=$data->total_unit?></td>

<td align="right"><? //if($data->vat>0 || $data->ait>0){echo $total_sales_amount=($net_vaules);}else{echo $total_sales_amount=$info[0]; $tot_sales_item +=$total_sales_amount;}



if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){
echo number_format($tot_amt=$net_vaules);
$total_sales_amount_new +=$tot_amt;
}else{
echo number_format(($tot_amt=$info[0]-$info1[0]),2);
$total_sales_amount_new +=$tot_amt;
}


?></td>


<td align="right"><?=($data->ait>0)? $data->ait : ''; ?></td>
<td align="right"><?=($ait_amount>0)? number_format($ait_amount): ''; $total_ait_amount +=$ait_amount;?></td>
<td align="right"><? if($data->vat==0 && $data->vat!=''){ echo " Vat Exempted ";}elseif($data->vat>0){ echo $data->vat;}?></td>
<td align="right"><? if($data->vat!=0 && $data->unit_price>0){ echo number_format($vat_amount); $total_vat += $vat_amount;}?></td>


<td align="right">
<?
if($data->vat_cal_type == 'exclusive' && $data->unit_price>0 ){ ?>
<?=number_format(($invoice_values = $info[0]+$vat_amount+$ait_amount));
  $total_invoice_values +=$invoice_values;?>
<? }elseif($data->vat_cal_type == 'inclusive' && $data->unit_price>0){  ?>

<?=number_format(($invoice_values = $total_pro_amt_incl));
$total_invoice_values +=$invoice_values;
}else{?>

<?=number_format(($invoice_values = $info[0]));
$total_invoice_values +=$invoice_values;?>
<?  }?>

</td>


</tr>
<? } ?>
<tr class="footer"><td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td>&nbsp;</td>
<td align="right"><?=number_format($total_commission);?></td>

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>


<td align="right"><?=number_format($total_sales_amount_new);?></td>
<td>&nbsp;</td>
<td align="right"><?=number_format($total_ait_amount)?></td>
<td></td>
<td align="right"><?=number_format($total_vat)?></td>


<td align="right"><?=number_format(($total_invoice_values))?></td>





</tr></tbody></table>











<!--New Start from here-->




<?






}



elseif($_POST['report']==160)



{





/* $sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,SUM(c.total_amt) as total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,m.vat,m.ait,c.total_unit,c.unit_price,m.vat_cal_type from
sale_do_master m,sale_do_chalan c,dealer_info d ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";*/



$sql="select



distinct c.chalan_no,
c.chalan_date,item.item_name,c.total_amt, m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,
d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission,c.total_unit,c.unit_price,c.item_id,m.vat,m.ait,m.vat_cal_type,m.cost_center,m.type,d.account_code
from
sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where c.item_id=item.item_id and  m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no and  m.dealer_code=d.dealer_code and
m.vat IN ('5','0') and
w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";




$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th>
<th>Cost Center</th>
<th>Ledger ID</th>
<th>Type</th>
<th>Chalan Date</th>
<th>Dealer Name</th>
<th>Item Name</th>
<th>Unit Price</th>
<th>Total Unit</th>
<th>Sales Total</th>
<th>Tax %</th>
<th>Tax Amount</th>
<th>Vat %</th>
<th>Vat Amount</th>
<th>Total Invoice Values</th>
</tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;
$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';
$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;
$rcv_t = $rcv_t+$data->rcv_amt;
$dp_t = $dp_t+$info[0];
$tp_t = $tp_t+$info1[0];
$tu_t = $tu_t+$info1[2];


$sqld2 = 'select * from sale_do_details  where item_id='.$data->item_id.' and do_no='.$data->do_no.'';
$info2 = mysql_fetch_object(mysql_query($sqld2));
//$tax =  $info2[0]-$info[0];
$net_ret = $info2->net_rate;
$ait_amount = $info2->ait_amt;
$vat_amount = $info2->vat_amt;
$net_vaules = $info2->net_value;





?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>
<td><?=$data->do_no?></td>
<td><?=$data->do_date?></td>
<td><?=find_a_field('cost_center','concat(center_name," - ",id)',"id=".$data->cost_center);?></td>
<td><?=find_a_field('accounts_ledger','concat(ledger_name," - ",ledger_id)',"ledger_id=".$data->account_code);?></td>
<td><?=$data->type;?></td>
<td><?=$data->chalan_date?></td>
<td><?=$data->dealer_name?></td>
<td><?=$data->item_name?></td>

<td align="right"><? if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){echo $net_ret;}else{echo $data->unit_price;}?></td>
<td align="right"><?=$data->total_unit?></td>

<td align="right"><? //if($data->vat>0 || $data->ait>0){echo $total_sales_amount=($net_vaules);}else{echo $total_sales_amount=$info[0]; $tot_sales_item +=$total_sales_amount;}



if($data->vat_cal_type == 'inclusive' && $data->unit_price>0){
echo number_format($tot_amt=$net_vaules);
$total_sales_amount_new +=$tot_amt;
}else{
echo number_format(($tot_amt=$info[0]-$info1[0]),2);
$total_sales_amount_new +=$tot_amt;
}


?></td>


<td align="right"><?=($data->ait>0)? $data->ait : ''; ?></td>
<td align="right"><?=($ait_amount>0)? number_format($ait_amount): ''; $total_ait_amount +=$ait_amount;?></td>
<td align="right"><? if($data->vat==0 && $data->vat!=''){ echo " Vat Exempted ";}elseif($data->vat>0){ echo $data->vat;}?></td>
<td align="right"><? if($data->vat!=0 && $data->unit_price>0){ echo number_format($vat_amount); $total_vat += $vat_amount;}?></td>


<td align="right">
<?
if($data->vat_cal_type == 'exclusive' && $data->unit_price>0 ){ ?>
<?=number_format(($invoice_values = $info[0]+$vat_amount+$ait_amount));
  $total_invoice_values +=$invoice_values;?>
<? }else{  ?>
<?=number_format(($invoice_values = $info[0]));
$total_invoice_values +=$invoice_values;?>
<?  }?>

</td>


</tr>
<? } ?>
<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>


<td align="right"><?=number_format($total_sales_amount_new);?></td>
<td>&nbsp;</td>
<td align="right"><?=number_format($total_ait_amount)?></td>
<td></td>
<td align="right"><?=number_format($total_vat)?></td>


<td align="right"><?=number_format(($total_invoice_values))?></td>





</tr></tbody></table>











<!--New Start from here-->

<?





}



elseif($_POST['report']==102)



{





 $sql="select



distinct c.chalan_no,



c.chalan_date,item.item_name,item.unit_name,c.total_amt,c.unit_price,c.purchase_price,c.cogs_amount,m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,

d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission from



sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where

c.item_id=item.item_id and

m.status in ('CHECKED','COMPLETED') and m.type!='Sample' and

m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";

$query = mysql_query($sql);

echo '<table width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="7">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th><th>Chalan Date</th><th>Dealer Name</th><th>Item Name</th>

<th>Unit Name</th>

<th>Unit Price</th>

<th>Cost Price</th>

<th>Price Differentiation</th>

<th>Total Sales Value</th>

<th>Total Cost Value</th>

<th>Value Differentiation</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));



$total_cost_amount = $data->cogs_amount;

$total_sales_amount = $data->total_amt;



$differentiation= ($total_sales_amount-$total_cost_amount);



$differentiation_total = $differentiation;



$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';



$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info1[0];

$tu_t = $tu_t+$info1[2];







?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>

<td><?=$data->do_no?></td><td><?=$data->do_date?></td><td><?=$data->chalan_date?></td>

<td><?=$data->dealer_name?></td>

<td><?=$data->item_name?></td>

<td><?=$data->unit_name?></td>

<td align="right"><?=$data->unit_price?></td>

<td align="right"><?=$data->purchase_price?></td>

<td align="right"><?=number_format($data->unit_price-$data->purchase_price,2)?></td>

<td align="right"><?=number_format($total_sales_amount); $gross_sales+=$total_sales_amount;?></td>

<td align="right"><?=number_format($data->cogs_amount,2); $total_cosg_amount +=$data->cogs_amount;?></td>

<td align="right"><?=number_format($differentiation_total,2); $total_differentiation +=$differentiation_total;?></td></tr>



<?



}



?>

<tr class="footer">

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>

<td align="right"><?=number_format($gross_sales);?></td>

<td align="right"><?=number_format($total_cosg_amount);?></td>

<td align="right"><?=number_format($total_differentiation);?></td>

</tr></tbody>



</table>







<!--Import REceive start -->









<?







}



elseif($_POST['report']==103)



{





if(isset($t_date)) {$to_date=$t_date; $fr_date=$f_date; $or_date_con=' and a.or_date between \''.$fr_date.'\' and \''.$to_date.'\'';}



 if($_POST['item_id']!='')
 $item_conn .= ' and item.item_id= "'.$_POST['item_id'].'"';



 $sql="select distinct a.or_no,a.or_date,a.vendor_name,item.item_name,b.rate,b.qty,b.amount,item.pack_unit,b.unit_name,b.labour_cost,b.transport_cost,b.cost_price,

b.material_price,b.vat,b.vat_amount,b.mfg_date,b.expire_date

from warehouse_other_receive a,warehouse_other_receive_detail b,item_info item

where



a.or_no=b.or_no and

b.item_id=item.item_id and

a.receive_type='Import' and

a.status='CHECKED'".$or_date_con.$item_conn."



order by a.or_no";



$query = mysql_query($sql);

echo '<table width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">



<thead>

<tr>

<td style="border:0px;" colspan="10">'.$str.'</td>

</tr>



<tr>

<td style="border:0px;font-size:16px;" align="center" colspan="16">Sika Materials Purchase Report</td>

</tr>





<tr>

<th>S/L</th>

<th>Import No</th>

<th>Port Name</th>

<th>Import Date</th>

<th>Item Name</th>



<th>Uom</th>

<th>Pack Size(in ms/gm/ml)</th>



<th>Rec Qty</th>

<th>Sika Price</th>

<th>Materials Value</th>

<th>Vat%</th>

<th>Vat Amount</th>

<th>Materials Value (with VAT)</th>

<th>Labour Cost</th>

<th>Transport Cost</th>

<th>Total Landed Cost</th>

<th>Per Unit Landed Cost</th>

<th>Mfg. Date</th>
<th>Expiry Date</th>

<th>Remarks</th>

</tr>



</thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;









?>



<tr><td><?=$s?></td>

<td><a href="https://aksiderp.com/144133/warehouse_mod/pages/other_receive/import_report.php?v_no=<?=$data->or_no?>" target="_blank"><?=$data->or_no?></a></td>

<td><?=$data->vendor_name?></td>

<td><?=$data->or_date?></td>

<td><?=$data->item_name?></td>



<td><?=$data->unit_name?></td>

<td><?=$data->pack_unit?></td>



<td align="right"><?=number_format($data->qty,2)?></td>

<td align="right"><?=number_format($data->cost_price,2)?></td>

<td align="right"><?=number_format($data->material_price,2)?></td>

<td align="right"><?=($data->vat>0)?  $data->vat : '';?></td>

<td align="right"><?=($data->vat_amount>0)? number_format($data->vat_amount,2) : '';   ?></td>

<td align="right"><?=($data->vat_amount>0)? number_format($data->vat_amount+$data->material_price,2) : '';   ?></td>

<td align="right"><?=number_format($data->labour_cost,2)?></td>

<td align="right"><?=number_format($data->transport_cost,2)?></td>

<td align="right"><?=number_format($data->amount,2)?></td>

<td align="right"><?=number_format($data->rate,2)?></td>

<td><?=$data->mfg_date?></td>
<td><?=$data->expire_date?></td>
<td></td>




<?





$tot_cost_price     = $tot_cost_price+$data->cost_price;

$tot_material_price = $tot_material_price+$data->material_price;

$tot_labour_cost    = $tot_labour_cost+$data->labour_cost;

$tot_transport_cost = $tot_transport_cost+$data->transport_cost;

$total_material_cost = $total_material_cost+$data->amount;

$total_vat_cost = $total_vat_cost+$data->vat_amount;

$total_vat_with_material_cost = $total_vat_with_material_cost+$data->vat_amount+$data->material_price;

$total_Per_unit_cost = $total_Per_unit_cost+$data->rate;





}



?>



<tr class="footer">

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

<td align="right"></td>

<td align="right"></td>

<td align="right"></td>

<td align="right"><?=number_format($tot_material_price,2)?></td>

<td align="right"></td>

<td align="right"><?=number_format($total_vat_cost,2)?></td>

<td align="right"><?=number_format($total_vat_with_material_cost,2)?></td>



<td align="right"><?=number_format($tot_labour_cost,2)?></td>

<td align="right"><?=number_format($tot_transport_cost,2)?></td>

<td align="right"><?=number_format($total_material_cost,2)?></td>

<td align="right"></td>

<td align="right"></td>







</tr>

</tbody>

</table>











<!--Import REceive End  -->









<!--free Sample REceive start -->







<?







}



elseif($_POST['report']==104)



{





  $sql="select



distinct c.chalan_no,



c.chalan_date,item.item_name,item.unit_name,c.total_amt,c.unit_price,c.purchase_price,c.cogs_amount,m.do_no,m.do_date,m.marketing_person,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,c.vehicle_no,m.cr_start_date,m.cr_end_date,

d.team_name as team,w.warehouse_name as depot,d.product_group as grp,c.driver_name,d.commission from



sale_do_master m,sale_do_chalan c,dealer_info d  ,item_info item, warehouse w

where

c.item_id=item.item_id and

m.status in ('CHECKED','COMPLETED') and

m.type='Sample' and

m.do_no=c.do_no and  m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id".$depot_con.$date_con.$dealer_con.$item_con." order by c.chalan_no";

$query = mysql_query($sql);

echo '<table width="100%" cellspacing="0" id="ExportTable"  cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="7">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th><th>Chalan Date</th><th>Dealer Name</th><th>Item Name</th>

<th>Unit Name</th>

<th>Unit Price</th>

<th>Cost Price</th>

<th>Price Differentiation</th>

<th>Total Sales Value</th>

<th>Total Cost Value</th>

<th>Value Differentiation</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));



$total_cost_amount = $data->cogs_amount;

$total_sales_amount = $data->total_amt;



$differentiation= ($total_cost_amount-$total_sales_amount);



$differentiation_total = $differentiation;



$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';



$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info1[0];

$tu_t = $tu_t+$info1[2];







?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td>

<td><?=$data->do_no?></td><td><?=$data->do_date?></td><td><?=$data->chalan_date?></td>

<td ><?=$data->dealer_name?></td>

<td><?=$data->item_name?></td>

<td><?=$data->unit_name?></td>

<td align="right"><?=$data->unit_price?></td>

<td align="right"><?=($data->purchase_price>0)? number_format($data->purchase_price,0) : '<p style="color:#EB8524;  text-align:center";>Pending</p>';   ?></td>


<td align="right"><?=number_format($data->purchase_price-$data->unit_price,2)?></td>

<td align="right"><?=number_format(($info[0]-$info1[0]),2);?></td>

<td align="right"><?=number_format($data->cogs_amount,2)?></td>

<td align="right"><?=number_format($differentiation_total,2);?></td></tr>



<?

$total_cogs_amt = $total_cogs_amt+ $data->cogs_amount;

}



?>

<tr class="footer">

<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>

<td align="right"><?=number_format(($dp_t-$tp_t),2)?></td>

<td align="right"><?=number_format($total_cogs_amt,2)?></td>

<td align="right"><?=number_format($dp_t,2)?></td>

</tr></tbody>



</table>












<!--Import REceive End  -->











<?







}



elseif($_POST['report']==9)



{





echo $sqls="select c.chalan_no,m.do_no,m.do_date,c.driver_name as serial_no,c.chalan_date,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,w.warehouse_name as depot,d.product_group as grp,sum(total_amt) as total_amt,c.total_unit,c.unit_price,j.tr_from as status

from



sale_do_master m,sale_do_chalan c,dealer_info d  ,warehouse w,journal j



where  c.chalan_no=j.tr_no and j.tr_from IN ('SalesReturn','sales') and m.do_no=c.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id ".$depot_con.$date_con.$pg_con.$dealer_con.$dealer_type_con." group by chalan_no order by c.chalan_no";







$query = mysql_query($sqls);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Do Date</th><th>status</th><th>Serial No</th><th>Chalan Date</th><th>Dealer Name</th><th>Unit Price</th><th>Kg/Ltr</th><th>Grp</th><th>Sales Total</th><th>Dis</th><th>Actual Sales</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



//$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



//$info = mysql_fetch_row(mysql_query($sqld));







$sqld1 = 'select sum(total_amt),sum(total_unit) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and unit_price<0 ';



$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;



$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info1[0];

$tu_t = $tu_t+$info1[2];







?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td><td><?=$data->do_no?></td><td><?=$data->do_date?></td><td><?=$data->status?></td><td><?=$data->serial_no?></td><td><?=$data->chalan_date?></td><td><?=$data->dealer_name?></td><td><?=$data->unit_price?></td><td><?=$data->total_unit?></td><td><?=$data->grp?></td><td><?=number_format(($info[0]-$info1[0]),2);?></td><td><?=number_format(($info1[0]*(-1)),2);?></td><td><?=number_format(($info[0]),2);?></td></tr>



<?



}



?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td></td><td>&nbsp;</td><td>&nbsp;</td>







<td><?=number_format(($dp_t-$tp_t),2)?></td>



<td><?=number_format(((-1)*$tp_t),2)?></td>







<td><?=number_format($dp_t,2)?></td>



</tr></tbody></table>









<?



}



elseif($_POST['report']==1005)



{



			if(isset($sub_group_id)) 			{$item_sub_con=' and i.sub_group_id='.$sub_group_id;}



			elseif(isset($item_id)) 			{$item_sub_con=' and i.item_id='.$item_id;}







			if(isset($product_group)) 			{$product_group_con=' and i.sales_item_type="'.$product_group.'"';}







			if(isset($t_date))



			{$to_date=$t_date; $fr_date=$f_date; $date_con=' and ji_date <="'.$to_date.'"';}











		$sql='select distinct i.item_id,i.unit_name,i.item_name,"Finished Goods",i.finish_goods_code,i.sales_item_type,i.item_brand,i.pack_size



		   from item_info i where i.finish_goods_code!=2000 and i.sub_group_id="1096000100010000" '.$item_sub_con.$product_group_con.' and i.item_brand = "Promotional" order by i.sales_item_type';







		$query =mysql_query($sql);



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0"><thead><tr><td style="border:0px;" colspan="9"><div class="header"><h1>Sajeeb Group</h1><h2><?=$report?></h2>



<h2>Closing Stock of Date-<?=$to_date?></h2></div><div class="left"></div><div class="right"></div><div class="date">Reporting Time: <?=date("h:i A d-m-Y")?></div></td></tr><tr>



<th>S/L</th>



<th>Brand</th>



<th>FG</th>



<th>Item Name</th>



<th>Group</th>



<th>Unit</th>



<th>Dhaka</th>



<th>Gazipur</th>



<th>Chittagong</th>



<th>Borisal</th>



<th>Bogura</th>



<th>Sylhet</th>



<th>Jessore</th>



<th>Total</th>



</tr>



</thead><tbody>



<?



while($data=mysql_fetch_object($query)){











	$dhaka = 	(int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="3"')/$data->pack_size);



	$ctg = 		(int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="6"')/$data->pack_size);



	$sylhet =   (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="9"')/$data->pack_size);



	$bogura =   (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="7"')/$data->pack_size);



	$borisal =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="8"')/$data->pack_size);



	$jessore =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="10"')/$data->pack_size);



	$gajipur =  (int)(find_a_field('journal_item','sum(item_in-item_ex)','item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="54"')/$data->pack_size);



	$total = 	$dhaka + $ctg + $sylhet + $bogura + $borisal + $jessore + $gajipur;







	//echo $sql = 'select sum(item_in-item_ex) from journal_item where item_id="'.$data->item_id.'"'.$date_con.' and warehouse_id="9"';







?>



<tr>



	<td><?=++$j?></td>



	<td><?=$data->item_brand?></td>



	<td><?=$data->finish_goods_code?></td>



	<td><?=$data->item_name?></td>



	<td><?=$data->sales_item_type?></td>



	<td><?=$data->unit_name?></td>



	<td style="text-align:right"><?=(int)$dhaka?></td>



	<td style="text-align:right"><?=(int)$gajipur?></td>



	<td style="text-align:right"><?=(int)$ctg?></td>



	<td style="text-align:right"><?=(int)$borisal?></td>



	<td style="text-align:right"><?=(int)$bogura?></td>



	<td style="text-align:right"><?=(int)$sylhet?></td>



	<td style="text-align:right"><?=(int)$jessore?></td>



	<td style="text-align:right"><?=(int)$total?>&nbsp;</td>



</tr>



<?



}







?>



</tbody></table>



<?







}







elseif($_POST['report']==111)



{



$sql="select distinct c.chalan_no , m.do_no,c.chalan_date,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,w.warehouse_name as depot from



sale_do_master m,sale_do_chalan c,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no  and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and d.dealer_type = 'Corporate'".$depot_con.$date_con.$pg_con.$dealer_con." order by m.do_date,m.do_no";



$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Chalan Date</th><th>Dealer Name</th><th>Depot</th><th>Total</th><th>Discount</th><th>Net Total</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



$sqld = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no;



$info = mysql_fetch_row(mysql_query($sqld));



$dp_t = $dp_t+$info[0];



$dis = find_a_field('sale_do_master','sp_discount','do_no="'.$data->do_no.'"');



$tod = ($info[0]*$dis)/100;



$tot = $info[0]-($info[0]*$dis)/100;



$tod_t = $tod_t + $tod;



$tot_t = $tot_t + $tot;



?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td><td><?=$data->do_no?></td><td><?=$data->chalan_date?></td><td><?=$data->dealer_name?></td><td><?=$data->depot?></td><td><?=$info[0]?></td><td><?=$tod?></td><td><?=$tot?></td></tr>



<?



}



echo '<tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>'.number_format($dp_t,2).'</td><td>'.number_format($tod_t,2).'</td><td>'.number_format($tot_t,2).'</td></tr></tbody></table>';







}



elseif($_POST['report']==112)



{



$sql="select c.chalan_no , m.do_no,c.chalan_date,concat(d.dealer_code,'- ',d.dealer_name_e) as dealer_name,w.warehouse_name as depot,sum(total_amt) as total_amt from



sale_do_master m,sale_do_chalan c,dealer_info d  , warehouse w



where m.status in ('CHECKED','COMPLETED') and m.do_no=c.do_no  and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and d.dealer_type = 'SuperShop'".$depot_con.$date_con.$pg_con.$dealer_con." group by chalan_no order by chalan_no";



$query = mysql_query($sql);



echo '<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;" colspan="9">'.$str.'</td></tr><tr><th>S/L</th><th>Chalan No</th><th>Do No</th><th>Chalan Date</th><th>Dealer Name</th><th>Depot</th><th>Total</th><th>Discount</th><th>Net Total</th></tr></thead>



<tbody>';



while($data=mysql_fetch_object($query)){$s++;



$sqld1 = 'select sum(total_amt) from sale_do_chalan  where chalan_no='.$data->chalan_no.' and total_amt>0';



$info1 = mysql_fetch_row(mysql_query($sqld1));



$info[0] = $data->total_amt;







$rcv_t = $rcv_t+$data->rcv_amt;



$dp_t = $dp_t+$info[0];



$tp_t = $tp_t+$info1[0];



?>



<tr><td><?=$s?></td><td><a href="chalan_view.php?v_no=<?=$data->chalan_no?>" target="_blank"><?=$data->chalan_no?></a></td><td><?=$data->do_no?></td><td><?=$data->chalan_date?></td><td><?=$data->dealer_name?></td><td><?=$data->depot?></td><td><?=number_format(($info1[0]),2)?></td><td><?=number_format(($info[0]-$info1[0]),2)?></td><td><?=number_format($info[0],2)?></td></tr>



<?



}



?><tr class="footer"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><?=number_format(($tp_t),2)?></td><td><?=number_format(($dp_t-$tp_t),2)?></td><td><?=number_format($dp_t,2)?></td></tr></tbody></table><?







}



elseif($_POST['report']==3)



{



$sql2 	= "select distinct o.do_no,c.chalan_no as chalan_no, d.dealer_code,d.dealer_name_e,w.warehouse_name,c.chalan_date as do_date,d.address_e,d.mobile_no,d.product_group from



sale_do_master m,sale_do_details o,sale_do_chalan c, item_info i,dealer_info d , warehouse w



where m.do_no=o.do_no and i.item_id=o.item_id and m.dealer_code=d.dealer_code and c.order_no = o.id and m.status in ('CHECKED','COMPLETED') and

w.warehouse_id=m.depot_id ".$date_con.$item_con.$depot_con.$dtype_con.$pg_con.$dealer_con;



$query2 = mysql_query($sql2);







while($data=mysql_fetch_object($query2)){



echo '<div style="position:relative;display:block; width:100%; page-break-after:always; page-break-inside:avoid">';



	$dealer_code = $data->dealer_code;



	$chalan_no = $data->chalan_no;



	$dealer_name = $data->dealer_name_e;



	$warehouse_name = $data->warehouse_name;



	$do_date = $data->do_date;



	$do_no = $data->do_no;



		if($dealer_code>0)



{



$str 	.= '<p style="width:100%">Dealer Name: '.$dealer_name.' - '.$dealer_code.'('.$data->product_group.')</p>';



$str 	.= '<p style="width:100%">Chalan NO: '.$chalan_no.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:'.$do_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DO NO: '.$do_no.'



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Depot:'.$warehouse_name.'</p>



<p style="width:100%">Destination:'.$data->address_e.'('.$data->mobile_no.')</p>';







$dealer_con = ' and m.dealer_code='.$dealer_code;



$do_con = ' and m.do_no='.$do_no;



$sql = "select concat(i.finish_goods_code,'- ',item_name) as item_name,c.pkt_unit as crt,c.dist_unit as pcs,c.total_amt as DP_Total,(o.t_price*c.total_unit) as TP_Total from



sale_do_master m,sale_do_details o,sale_do_chalan c, item_info i,dealer_info d , warehouse w



where c.chalan_no='".$chalan_no."' and c.order_no = o.id and m.do_no=o.do_no and i.item_id=o.item_id and m.dealer_code=d.dealer_code and m.status in ('CHECKED','COMPLETED') and w.warehouse_id=m.depot_id ".$date_con.$item_con.$depot_con.$dtype_con.$do_con." order by m.do_date desc";



}







	echo report_create($sql,1,$str);



		$str = '';



		echo '</div>';



}



}



elseif($_POST['report']==5)



{



if(isset($region_id))



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id))



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if($area_id>0)



$area_con = "and a.AREA_CODE=".$area_id;



$sql="select m.do_no,m.do_date,concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con.$area_con;







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; $str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';







			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}







			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;"></td></tr></thead>



<tbody>



  <tr class="footer">



    <td align="right"><?=$branch->BRANCH_NAME?> Region  DP Total: <?=number_format($dp_total,2)?> ||| TP Total: <?=number_format($reg_total,2)?></td></tr></tbody>



</table><br /><br /><br />



<?  }



	echo '</div>';



}















}



elseif($_POST['report']==9)



{



if(isset($region_id))



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



$rp=0;



echo '<div>';



if(isset($zone_id))



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if($area_id>0)



$area_con = "and a.AREA_CODE=".$area_id;







$sql = "select i.finish_goods_code as code,i.item_name,i.item_brand,i.sales_item_type as `group`,



floor(sum(o.total_unit)/o.pkt_size) as crt,



mod(sum(o.total_unit),o.pkt_size) as pcs,



sum(o.total_amt) as DP,



sum(o.total_unit*o.t_price) as TP



from



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.' group by i.finish_goods_code';







$sqlt="select sum(o.t_price*o.total_unit) as total,sum(total_amt) as dp_total



from



sale_do_master m,sale_do_details o, item_info i, warehouse w, dealer_info d, area a



where m.do_no=o.do_no and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and i.item_id=o.item_id and a.AREA_CODE=d.area_code  and m.status in ('CHECKED','COMPLETED') and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$item_con.$item_brand_con.$pg_con.$area_con.'';







		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0;



			$str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';







			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}







			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;"></td></tr></thead>



<tbody>



  <tr class="footer">



    <td align="right"><?=$branch->BRANCH_NAME?> Region  DP Total: <?=number_format($dp_total,2)?> ||| TP Total: <?=number_format($reg_total,2)?></td></tr></tbody>



</table><br /><br /><br />



<?  }



	echo '</div>';



}















}



elseif($_POST['report']==8)



{



if(isset($region_id))



$sqlbranch 	= "select * from branch where BRANCH_ID=".$region_id;



else



$sqlbranch 	= "select * from branch";



$querybranch = mysql_query($sqlbranch);



while($branch=mysql_fetch_object($querybranch)){



	$rp=0;



	echo '<div>';



if(isset($zone_id))



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID." and ZONE_CODE=".$zone_id;



else



$sqlzone 	= "select * from zon where REGION_ID=".$branch->BRANCH_ID;







	$queryzone = mysql_query($sqlzone);



	while($zone=mysql_fetch_object($queryzone)){



if(isset($area_id))



{



$sql="select concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." and a.AREA_CODE=".$area_id." ".$date_con.$pg_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.AREA_CODE=".$area_id." and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con;



}



else



{



$sql="select concat(d.dealer_code,'- ',d.dealer_name_e)  as dealer_name,w.warehouse_name as depot,a.AREA_NAME as area,d.product_group as grp,(select sum(total_amt) from sale_do_details where do_no=m.do_no) as DP_Total,(select sum(t_price*total_unit) from sale_do_details where do_no=m.do_no)  as TP_Total from



sale_do_master m,dealer_info d  , warehouse w,area a



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con." order by do_no";



$sqlt="select sum(s.t_price*s.total_unit) as total,sum(total_amt) as dp_total from



sale_do_master m,dealer_info d  , warehouse w,area a,sale_do_details s



where  m.status in ('CHECKED','COMPLETED') and m.dealer_code=d.dealer_code and w.warehouse_id=m.depot_id and a.AREA_CODE=d.area_code and s.do_no=m.do_no and a.ZONE_ID=".$zone->ZONE_CODE." ".$date_con.$pg_con;



}



		$queryt = mysql_query($sqlt);



		$t= mysql_fetch_object($queryt);



		if($t->total>0)



		{



			if($rp==0) {$reg_total=0;$dp_total=0; $str .= '<p style="width:100%">Region Name: '.$branch->BRANCH_NAME.' Region</p>';$rp++;}



			$str .= '<p style="width:100%">Zone Name: '.$zone->ZONE_NAME.' Zone</p>';



			echo report_create($sql,1,$str);



			$str = '';







			$reg_total= $reg_total+$t->total;



			$dp_total= $dp_total+$t->dp_total;



		}







	}







			if($rp>0){



?>



<table width="100%" cellspacing="0" cellpadding="2" border="0">



<thead><tr><td style="border:0px;"></td></tr></thead>



<tbody>



  <tr class="footer">



    <td align="right"><?=$branch->BRANCH_NAME?> Region  DP Total: <?=number_format($dp_total,2)?> ||| TP Total: <?=number_format($reg_total,2)?></td>



  </tr>



</tbody>



</table><br /><br /><br />



<?  }



	echo '</div>';



}















}



elseif(isset($sql)&&$sql!='') {echo report_create($sql,1,$str);}



?></div>



</body>



</html>
