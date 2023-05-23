<?php
	session_start();
	ob_start();
	require "../../config/inc.all.php";
	$title = 'Inventory Home Page';
?>

<table style="width: auto; margin: 0 auto; font-size:15px;text-align:center;" border="0" bordercolor="#FFFFFF">

	<tr>
		<td style="border:0px solid white;"><strong>AKSID CORPORATION LTD.</strong></td>
	</tr>

	<tr>
		<td style="border:0px solid white;"><strong>Employee Password Information</strong></td>
	</tr>

</table>

<table style="width:auto;margin:0 auto; text-align:center; background-color:#373733; color:#e75a4c" cellpadding="0" cellspacing="0" border="1">

	<thead>
		<tr style="background-color:#e75a4c; color:#373733">

			<td><strong>Sl</strong></td>
			<td><strong>EMP ID</strong></td>
			<td><strong>NAME</strong></td>
			<td><strong>DESIGNATION</strong></td>
			<td><strong>DEPARTMENT</strong></td>
			<td><strong>PROJECT</strong></td>
			<td><strong>Password</strong></td>
			<td><strong>MOBILE</strong></td>
			<td><strong>ATTENDENCE_TYPE</strong></td>
			<td><strong>ATTENDENCE_TYPE</strong></td>
			<td><strong>Image</strong></td>

		</tr>
	</thead>


<?
	$basic_sql = "select a.PBI_ID as Emp_ID,a.PBI_CODE,a.pass,a.PBI_NAME as Name,(select DESG_SHORT_NAME from designation where DESG_ID=a.PBI_DESIGNATION) as designation,(select if(DEPT_DESC='NO DEPARTMENT','',DEPT_DESC) from department where DEPT_ID=a.PBI_DEPARTMENT) as department,(select PROJECT_DESC from project where PROJECT_ID=a.JOB_LOCATION) as project_name,a.PBI_GROUP as `Group`, DATE_FORMAT(a.PBI_DOJ,'%d-%b-%Y') as joining_date,a.PBI_DOJ as total_service_length,a.PBI_MOBILE as mobile,b.ATTENDENCE_TYPE  from personnel_basic_info a,essential_info b  where b.`ESS_JOB_STATUS` LIKE 'In Service' and a.PBI_ID=b.PBI_ID " . $con . " order by a.PBI_DOJ asc";
	$basic_query = mysql_query($basic_sql);
	$sl = 1;
	while ($r = mysql_fetch_object($basic_query)) {
?>

		<tr>
			<td style="background-color:#e75a4c; color:#373733"><?= $sl++; ?></td>
			<td style="background-color:#e75a4c; color:#373733"><?= $r->PBI_CODE ?></td>
			<td><?= $r->Name ?></td>
			<td><?= $r->designation ?></td>
			<td><?= $r->department ?></td>
			<td><?= $r->project_name ?></td>
			<td style="background-color:#e75a4c; color:#373733"><?= $r->pass ?></td>
			<td><?= $r->mobile ?></td>
			<td><?= $r->ATTENDENCE_TYPE ?></td>
			<td><?= $r->ATTENDENCE_TYPE ?></td>
		<?
			//$directory = "../../pic/staff/".$r->Emp_ID.".jpeg";
			//Employee Pic

			$imgJPG = "../../pic/staff/" . $r->Emp_ID . ".JPG";
			$imgjpg = "../../pic/staff/" . $r->Emp_ID . ".jpg";
			$imgPNG = "../../pic/staff/" . $r->Emp_ID . ".PNG";
			$imgJPEG = "../../pic/staff/" . $r->Emp_ID . ".jpeg";
			$imgpng2 = "../../pic/staff/" . $r->Emp_ID . ".png";

			if (file_exists($imgJPEG)) {

				$link = $imgJPEG;
			} elseif (file_exists($imgJPG)) {

				$link = $imgJPG;
			} elseif (file_exists($imgjpg)) {

				$link = $imgjpg;
			} elseif (file_exists($imgJPEG)) {

				$link = $imgJPEG;
			} elseif (file_exists($imgpng2)) {

				$link = $imgpng2;
			} else $link = '';

			if (file_exists($link)) { ?>

				<td><img src="<?= $link ?>" width="60" height="60" /></td>

			<? } else { ?>

				<td><img src="../../pic/staff/default.png" width="60" height="60" /></td>

			<? } ?>


			<?php /*?>	
			<td><img src="../../pic/staff/<?=$r->Emp_ID?>.jpeg" width="60" height="60"/></td><?php */ ?>

		</tr>
	<?}?>
</table>