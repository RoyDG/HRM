<?php
session_start();
include 'config/db.php';
include 'config/function.php';
include 'config/access.php';
$user_id	=$_SESSION['user_id'];

$page="vehicle_req_status.php";

include "inc/header.php";

?>
<!-- main page content -->
<div class="main-container container">
           
<!-- User list items  -->
<div class="row">
<div class="row text-center mb-2"><h4>Pending Vehicle Request<br /><?=$_SESSION['msg'];unset($_SESSION['msg']);?></h4></div>    
    
<!--<div class="row">
	<div class="card">
		<form action="" method="post" style="padding:10px">
			<div class="form-group" >
				<label for="date">From Date</label>
				<input type="date" name="fdate" class="form-control" value="<?=$_POST['fdate'];?>" />
				<label for="date">To Date</label>
				<input type="date" name="tdate" class="form-control"  value="<?=$_POST['tdate'];?>" />
			</div>
			
			<div class="form-group" >
				<input type="submit" name="show" class="btn btn-info" style="margin-left:20%" value="Show" />
			</div>
		</form>
	</div>
</div>-->

<? 
if(isset($_POST['show'])){
	if($_POST['fdate'] !='' && $_POST['tdate'] !='') $con = ' and m.req_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'" ' ;
}
$sql = "select m.* from vehicle_requisition m where 1 and m.status='PENDING' ".$con." order by m.req_no asc";
$query=mysqli_query($conn, $sql);
while($data=mysqli_fetch_object($query)){
?>                            
<div class="col-12">
    <div class="card shadow-sm mb-2">        
            <ul class="list-group list-group-flush bg-none">
        <a href="vehicle_req_checking.php?req_no=<?=$data->req_no?>">
            <li class="list-group-item border-0">
                <div class="row">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-body p-0">
                                <figure class="avatar avatar-50 rounded-15">
                                    <img src="assets/img/user1.jpg" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col px-0">
                        <p>Request No: <?=$data->req_no?><br><small class="text-secondary"><?=find_a_field('user_activity_management','fname','user_id="'.$data->entry_by.'"')?><br />Request Date: <?=$data->req_date?><br />Total Person: <?=$data->person?><br />Status: <?=$data->status?></small></p>
                    </div>
                    
                </div>
            </li></a>
    
        </ul>
         
    </div>
</div>
           <? } ?> 
           </div>         
            <!--<div class="col-md-8 text-end">
					<table align="center">
						<tr class="col-auto text-end">
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Entry Date.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Claim No.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center; padding-left:20px; padding-right:20px;"><strong>Entry By.</strong></td>
							
							<td class="text-primary text-muted size-12 mb-0" style="text-align:center"><strong>Action</strong></td>
						</tr>
			<? 
if(isset($_POST['show'])){
	if($_POST['fdate'] !='' && $_POST['tdate'] !='') $con = ' and m.expense_date between "'.$_POST['fdate'].'" and "'.$_POST['tdate'].'" ' ;
}			
			
   $sql1 = "select   m.expense_date,  m.expense_no, m.status, m.entry_by,m.entry_at from fuel_expense m
where 1 and m.status='MANUAL' ".$con." order by m.expense_date asc";
//and m.do_date='".date('Y-m-d')."'
//and m.entry_by = '".$data->entry_by."'
$query1=mysqli_query($conn, $sql1);
while($data1=mysqli_fetch_object($query1)){
?>  			
						<tr class="col-auto text-end">
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->expense_date;?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->expense_no;?></td>
							
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=find_a_field('user_activity_management','fname','user_id="'.$data1->entry_by.'"');?></td>
							<td class="text-primary text-muted size-12 mb-0 " style="text-align:center"><?=$data1->PBI_NAME;?></td>
						</tr>
		<? } ?>				
					</table>
					</div>-->
            


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

<?php include "inc/footer.php"; ?>