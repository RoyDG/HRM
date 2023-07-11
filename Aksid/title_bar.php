<table class="oe_view_manager_header">



          <colgroup>



		  <col width="20%">



          <col width="35%">



          <col width="15%">



          <col width="30%">



          </colgroup><tbody>



		  



		 



		 



		 <td colspan="2">



			



			







			<table width="80%" border="0" align="left" cellpadding="0" cellspacing="0" style="height:25px; float:left" class="modal-content">







            







              <tr>



			  



                <td width="80" align="center" valign="middle"><strong style="color:#FFF; font-size:16px;"><em>



				



				



				<?



				



				 $directory = "../../pic/staff/".$_SESSION['employee_selected'].".jpeg";



				 //Employee Pic



								$imgJPG = "../../pic/staff/".$_SESSION['employee_selected'].".JPG";



								$imgjpg = "../../pic/staff/".$_SESSION['employee_selected'].".jpg";



								$imgPNG = "../../pic/staff/".$_SESSION['employee_selected'].".PNG";



								$imgJPEG = "../../pic/staff/".$_SESSION['employee_selected'].".jpeg";



								$imgpng2 = "../../pic/staff/".$_SESSION['employee_selected'].".png";



								if(file_exists($imgJPEG)){



								  $link = $imgJPEG;



								}elseif(file_exists($imgJPG)){



								  $link = $imgJPG;



								}elseif(file_exists($imgjpg)){



								  $link = $imgjpg;



								}elseif(file_exists($imgJPEG)){



								  $link = $imgJPEG;



								}elseif(file_exists($imgpng2)){



								  $link = $imgpng2;



								}



				 



				 



				



				



				if(file_exists($link)) {?>



				<img src="<?=$link?>" class="img-circle profile_img modal-content" style="border-radius: 100%; width: 100px; margin:10px; margin-top: 7px; margin-left:7px;" width="120" vspace="0" hspace="5" height="100">



				<? }else{?>



					<img src="../../pic/staff/default.png" class="img-circle profile_img modal-content" style="border-radius: 100%; width: 100px; margin:10px; margin-top: 7px; margin-left:7px;" width="120" vspace="0" hspace="5" height="100">



				



				<? } ?>



				



				



				</em></strong></td>







                <td width="400" align="left" style="color:#000; font-family:Tahoma; background: #17a2b8; color: white;" >







				







                    <?php







			 $sql =  @mysql_query("select PBI_NAME,PBI_MOBILE,PBI_DEPARTMENT,JOB_LOCATION, PBI_DESIGNATION, PBI_CODE from personnel_basic_info where PBI_ID = ".$_SESSION['employee_selected']."");







				  $row = @mysql_fetch_object($sql);



				  $dept = find_a_field('personnel_basic_info','PBI_DEPARTMENT','PBI_ID='.$_SESSION['employee_selected']);







				  if($row->PBI_NAME!='') 



				  



				  echo "<span style='font-size:16px;padding-left:13px'><b>ID : </b>".$row->PBI_CODE."</span>";



				  



				  echo "<br>";



				  



				  echo "<span style='font-size:15px;padding-left:13px'><b>Name : </b>".$row->PBI_NAME."<br></span>";



				  echo "<span style='font-size:15px;padding-left:13px'><b>Mobile No : </b>".$row->PBI_MOBILE."<br><hr style='margin: 0px;'></span>";



				  



				  







				   echo "<span style='font-size:13px; margin-top:10px;padding-left:13px'>".find_a_field('designation','DESG_DESC','DESG_ID='.$row->PBI_DESIGNATION)."<br/></span><span style='height:10px;'></span>";



				   



				   if($dept==13){



				   



				   echo "<span style='font-size:13px; margin-top:10px;padding-left:13px'>".find_a_field('project','PROJECT_DESC','PROJECT_ID='.$row->JOB_LOCATION)."</span>";



				   



				   }else{







				  echo "<span style='font-size:13px; margin-top:10px;padding-left:13px'>".find_a_field('department','DEPT_DESC','DEPT_ID='.$row->PBI_DEPARTMENT)."</span>";



				  }







				 



				 



				 



				











				?>







                </td>







              </tr>















            </table>







			                







</td>



		 



		 



		 



            <td colspan="2">



               <div class="title_right">



                <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="margin-left: 55%;">



                  <div class="input-group">



            <input type="text" name="employee_selected" style="border-radius: 0px; border: 1px solid #17a2b8; " id="employee_selected" class="form-control" placeholder="Search ID..." 

			value="<?=find_a_field($table,'PBI_CODE','PBI_ID='.$_SESSION['employee_selected']);?>"/>



                    <span class="input-group-btn">



					   <button class="btn btn-danger" name="button" id="button" style="height:34px; border-radius: 0px; background: #17a2b8; color: white; " value="Find"  type="submit">Go!</button>



					



                     



                    </span>



                  </div>



                </div>



              </div>



                



            </td>



			



			



			



			



			







            







            </tr>







  </tbody>



			



			</table>