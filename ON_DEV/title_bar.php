<table class="oe_view_manager_header" >

          <colgroup>

		  <col width="20%">

          <col width="35%">

          <col width="15%">

          <col width="30%">

          </colgroup>

		  

	  <tbody>

		  



	<? $unique_id =  $_GET['id'];?>

	

			

			

			

		<tr>

		

		

		

		

		

		

		

		<?

			  if($unique_id>0){

			  $unique_pbi_id = find_a_field('hrm_leave_info','PBI_ID','id='.$unique_id);

			?>

			<td colspan="2">

		

		

		

	

			



			<table width="70%" border="0" align="right" cellpadding="0" cellspacing="0" style="height:25px; margin-right:100px; width:400px;" class="modal-content table">



           <? if( $unique_pbi_id>0){

								$imgJPEG = "../../../hrm_mod/pic/staff/" . $unique_pbi_id.".jpeg";

		                        $imgJPG = "../../../hrm_mod/pic/staff/".$unique_pbi_id.".png";

								$imgJPGG = "../../../hrm_mod/pic/staff/" . $unique_pbi_id.".JPG";

								$imgjpg = "../../../hrm_mod/pic/staff/".$unique_pbi_id.".jpg";
								
								$imgPNG = "../../../hrm_mod/pic/staff/".$unique_pbi_id.".PNG";

								

								if(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								}elseif(file_exists($imgJPG)){

								  $link = $imgJPG;
								  
								}elseif(file_exists($imgJPGG)){

								  $link = $imgJPGG;

								}elseif(file_exists($imgjpg)){

								  $link = $imgjpg;

								}elseif(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								}else{
								
								 $link = "../../../hrm_mod/pic/staff/sr.jpg";
								
								}

		   

		   ?>



              <tr>

			  

		   <td  align="center" valign="middle" width="80"><strong style="color:#FFF; font-size:16px;"><em><img src="<?=$link?>" style="border-radius: 100%; width: 100px; margin:0px; margin-top: 7px; " class="img-circle profile_img modal-content" width="120" height="100" hspace="5" vspace="0" /></em></strong></td>



                <td  align="left" style="color:#000; font-family:Tahoma; background: #17a2b8; color: white; width:400px;" >



				



                     <?php



				$sql =  @mysql_query("select PBI_NAME, PBI_DEPARTMENT, PBI_DESIGNATION,JOB_LOCATION,PBI_ID,PBI_CODE from personnel_basic_info where PBI_ID = ".$unique_pbi_id."");



				  $row = @mysql_fetch_object($sql);

				$dept = find_a_field('department','DEPT_DESC','DEPT_ID='.$row->PBI_DEPARTMENT);

				

				   if($row->PBI_DEPARTMENT == 13){

				   $proj_dept = find_a_field('project','PROJECT_DESC','PROJECT_ID='.$row->JOB_LOCATION);

				   }else{

				   $proj_dept = find_a_field('department','DEPT_DESC','DEPT_ID='.$row->PBI_DEPARTMENT);

				   }



				  if($row->PBI_NAME!='') 

				  

				   echo "<span style='font-size:16px;'>ID - ".$row->PBI_CODE."<br/></span>";

				  

				  echo "<span style='font-size:15px;'>".$row->PBI_NAME."<br/></span>";

				  

				  echo "<hr style='margin:0'>";

				  

				 



				   echo "<span style='font-size:13px; margin-top:10px;'>".find_a_field('designation','DESG_DESC','DESG_ID='.$row->PBI_DESIGNATION)."<br/></span><span style='height:10px;'></span>";



				  echo "<span style='font-size:13px; margin-top:10px;'>".$proj_dept."</span>";



				 



				?>



                </td>



              </tr>

			  <? }?>

          </table>



	   </td>







  <? } else{?>

  



	<td colspan="2">

		

		

		

	

			



			<table width="70%" border="0" cellpadding="0" cellspacing="0" style="height:25px; width:400px;" class="modal-content table">



           <? if($_SESSION['employee_selected']>0){


				
			                    $imgJPG = "../../../hrm_mod/pic/staff/".$_SESSION['employee_selected'].".png";

								$imgJPGG = "../../../hrm_mod/pic/staff/".$_SESSION['employee_selected'].".JPG";

								$imgjpg = "../../../hrm_mod/pic/staff/".$_SESSION['employee_selected'].".jpg";

								$imgPNG = "../../../hrm_mod/pic/staff/".$_SESSION['employee_selected'].".PNG";

								$imgJPEG = "../../../hrm_mod/pic/staff/".$_SESSION['employee_selected'].".jpeg";

								if(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								} elseif (file_exists($imgJPGG)){

									$link = $imgJPGG;

								}elseif(file_exists($imgJPG)){

								  $link = $imgJPG;

								}elseif(file_exists($imgjpg)){

								  $link = $imgjpg;

								}elseif(file_exists($imgJPEG)){

								  $link = $imgJPEG;

								}else{
								
								 $link = "../../../hrm_mod/pic/staff/sr.jpg";
								
								} 

		   

		   ?>



              <tr>

			  

		   <td  align="center" valign="middle" width="80"><strong style="color:#FFF; font-size:16px;"><em><img src="<?=$link?>" style="border-radius: 100%; width: 100px; margin:0px; margin-top: 7px; " class="img-circle profile_img modal-content" width="120" height="100" hspace="5" vspace="0" /></em></strong></td>



                <td  align="left" style="color:#000; font-family:Tahoma; background: #17a2b8; color: white; width:400px;" >



				



                     <?php



				$sql =  @mysql_query("select PBI_NAME, PBI_DEPARTMENT, PBI_DESIGNATION,JOB_LOCATION,PBI_ID,PBI_CODE from personnel_basic_info where PBI_ID = ".$_SESSION['employee_selected']."");



				  $row = @mysql_fetch_object($sql);

				$dept = find_a_field('department','DEPT_DESC','DEPT_ID='.$row->PBI_DEPARTMENT);

				

				   if($row->PBI_DEPARTMENT == 13){

				   $proj_dept = find_a_field('project','PROJECT_DESC','PROJECT_ID='.$row->JOB_LOCATION);

				   }else{

				   $proj_dept = find_a_field('department','DEPT_DESC','DEPT_ID='.$row->PBI_DEPARTMENT);

				   }



				  if($row->PBI_NAME!='') 

				  

				   echo "<span style='font-size:16px;'>ID - ".$row->PBI_CODE."<br/></span>";

				  

				  echo "<span style='font-size:15px;'>".$row->PBI_NAME."<br/></span>";

				  

				  echo "<hr style='margin:0'>";

				  

				 



				   echo "<span style='font-size:13px; margin-top:10px;'>".find_a_field('designation','DESG_DESC','DESG_ID='.$row->PBI_DESIGNATION)."<br/></span><span style='height:10px;'></span>";



				  echo "<span style='font-size:13px; margin-top:10px;'>".$proj_dept."</span>";



				 



				?>



                </td>



              </tr>

			  <? }?>

          </table>



	   </td> 

	   

	   <? } ?>



		

		

		

		  </tr>



  </tbody>

			

			</table>	

			

		