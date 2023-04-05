<?php



session_start();



include 'config/db.php';



include 'config/function.php';



include 'config/access.php';



$u_id= $_SESSION['user_id']; //$_SESSION['user']['id'];



$PBI_ID = find_a_field('user_activity_management','PBI_ID','user_id='.$u_id);



$user_id	= $PBI_ID; //$_SESSION['user_id'];



$page="report_list";



include "inc/header.php";

 date("Y-m-d H:i:s");
 
 
 
 	
		



?>







<style>

  .openerp img{

    width: 100%;

  }





  .mob.scrollbar{

  display:none;

  }



  /* Extra small devices (phones, 600px and down) */

@media(max-width: 600px) {

  .mob.scrollbar{

  	display:block;

  	margin-left: 30px;

	float: left;

	height: 300px;

	width: 555px;

	background: #F5F5F5;

	overflow-y: scroll;

	margin-bottom: 25px;





  }





}



</style>



















<div class="form-container_large">

  <div class="row m-0">







    <div class="col-md-12 p-0 mob">



      <p style=" text-align: center; font-weight: bold; background-color:aquamarine; padding: 5px 0px;  text-decoration: underline;">Attendance Report For :

        <?=date('Y')?>

       -

        <?=date('F')?>

      </p>





        <div style="padding-left: 5px; padding-right: 5px;">

<style>
span, .btn, td{
font-size: 10px !important;

}
</style>


            <table id="example" class="table1  table-striped table-bordered table-hover table-sm" style="font-size: 12px;">



                <thead class="thead1 bold">

                <tr class="bgc-info">

         

                    <th>Date</th>

                    <th>Day</th>

                    <th>In Time</th>

           

                    <th>Out Time</th>


					
					<th>Schedule</th>
					
					<th>Diff M</th>

                </tr>

                </thead>



                <tbody class="tbody1">



                <?



                $month_end = strtotime('last day of this month', time());

                //  $end_day =  date('d', $month_end).'<br/>';

                $end_day =  31;

                for($i=1;$i<=$end_day;$i++){

                    ?>



                    <tr>


                        <td><?=date('Y')?>-<?=date('m')?>-<?=$i?></td>

                        <td><?

                            $date = date('Y').'-'.date('m').'-'.$i;

                            $off_day =  date('D', strtotime($date));

                            if($off_day=='Fri'){ echo '<span class="btn btn-warning btn-xs font">'.date('D', strtotime($date)).'</span>';}else
							{ echo '<span class="btn btn-primary btn-xs">'.date('D', strtotime($date)).'</span>'; }

                            ?>

                        </td>



                        <td><? $in_time = find_a_field('hrm_attdump','min(xtime)','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" group by xdate');

                            $leave = find_a_field('hrm_att_summary','att_date','emp_id="'.$PBI_ID.'" and att_date="'.$date.'" and leave_id>0 group by att_date');



                            if($in_time!=''){ echo date("h:i a",strtotime($in_time));}else{ if($off_day=='Fri'){ echo '<span class="btn btn-success btn-xs">Day Off</span>';

                            }elseif($leave>0 ){ echo '<span class="btn btn-info btn-xs">Leave</span>'; }else{echo '<span class="btn btn-danger btn-xs">Absent</span>';}



                            }?>
							
							<br />
							
							<? $in_latitute =  find_a_field('hrm_attdump','latitude','bizid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); 
						       $in_longitude = find_a_field('hrm_attdump','longitude','bizid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); 
							   
							   if($in_latitute!='' && $in_longitude!=''){?>

                            <a href="https://www.latlong.net/c/?lat=<?=$in_latitute?>&long=<?=$in_longitude?>" target="_blank" class="btn btn-warning btn-xs">view</a>

                            <? } ?>
							
							
							</td>

              
                        <td><?



                            $out_time = find_a_field('hrm_attdump','max(xtime)','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" group by xdate');

                            if($out_time!=''){  echo date("h:i a",strtotime($out_time));}else{ if($off_day=='Fri'){ echo '<span class="btn btn-success btn-xs">Day Off</span>';

                            }elseif($leave>0 ){ echo '<span class="btn btn-info btn-xs">Leave</span>'; }else{ echo '<span class="btn btn-danger btn-xs">Absent</span>'; } }



                            ?>
                            
							<br />
							
							<?
					$out_latitute =  find_a_field('hrm_attdump','latitude','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$out_time.'"');
					$out_longitude = find_a_field('hrm_attdump','longitude','xenrollid="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$out_time.'"');
					if($out_latitute!='' && $out_longitude!=''){?>
					<a href="https://www.latlong.net/c/?lat=<?=$out_latitute?>&long=<?=$out_longitude?>" target="_blank" class="btn btn-warning btn-xs">View</a>
					<? } ?>


                        </td>





					
					
					
				<td><?=find_a_field('hrm_attdump','schedule_notes','EMP_CODE="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); ?></td>
				
				
				
				<td><? 
				
			
                $ins_latitute =  find_a_field('hrm_attdump','latitude','EMP_CODE="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); 
				$ins_longitude = find_a_field('hrm_attdump','longitude','EMP_CODE="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"'); 

             	$sac_lt =  find_a_field('hrm_attdump','sch_latitude_point','EMP_CODE="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"');
				$sac_lo =  find_a_field('hrm_attdump','sch_longitude_point','EMP_CODE="'.$PBI_ID.'" and xdate="'.$date.'" and xtime="'.$in_time.'"');  
				
				$lat1 = $sac_lt; 
				$lon1 = $sac_lo; 
				
				$lat2 = $in_latitute;
				$lon2 = $in_longitude;
				$unit = "M";
				
				$distance = distance($lat1, $lon1, $lat2, $lon2, $unit);
				
				echo number_format($distance,2);
				
				?></td>
			

                    </tr>







                <? } ?>







                </tbody>







                <tfoot class="thead1 bold">

                <tr class="bgc-info">

             

                    <th>Date</th>

                    <th>Day</th>

                    <th>In Time</th>


                    <th>Out Time</th>
					
			        <th>Schedule</th>
					
					<th>Diff K.M</th>



                </tr>

                </tfoot>

            </table>



        </div>



    </div>



  </div>



</div>








<?


		 function distance($lat1, $lon1, $lat2, $lon2, $unit) {
				  $theta = $lon1 - $lon2;
				  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				  $dist = acos($dist);
				  $dist = rad2deg($dist);
				  $miles = $dist * 60 * 1.1515;
				  $unit = strtoupper($unit);
				
				  if ($unit == "K") {
					return ($miles * 1.609344);
				  } else if ($unit == "N") {
					  return ($miles * 0.8684);
					} else {
						return $miles;
					  }
				}

?>






<?php include "inc/footer.php"; ?>