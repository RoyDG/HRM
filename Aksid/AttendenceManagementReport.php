<?php



session_start();



ob_start();



require "../../config/inc.all.php";



$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';



do_calander('#ijdb');



do_calander('#ijda');



do_calander('#ppjdb');



do_calander('#ppjda');



if($_POST['mon']!=''){

$mon=$_POST['mon'];}

else{

$mon=date('n');

}



if($_POST['year']!=''){

$year=$_POST['year'];}

else{

$year=date('Y');

}



if(isset($_POST['lock'])){

	$check_sql = 'select 1 from salary_lock where month='.$_POST['mon'].' and year='.$_POST['year'].'';

	

	$check_query = mysql_query($check_sql);

	$last_check = mysql_num_rows($check_query );

	

	if($last_check >0){

		echo "<h3 style='text-align:center;background-color:red;color:white;'>This month and Year Salary Exist. Lock down is not possible</h3>";

		}else{

	for($i=0;$i<count($_POST['tr_type']);$i++){

		 $sql = 'INSERT INTO `salary_lock`( `month`, `year`, `job_location`, `salary_amount`, `tr_type`) 

		VALUES ("'.$_POST['mon'].'","'.$_POST['year'].'","'.$_POST['job_location'][$i].'" , "'.$_POST['salary_amount'][$i].'" ,"'.$_POST['tr_type'][$i].'" )';

		

		mysql_query($sql);

	}

		echo "<h3 style='text-align:center;background-color:green;color:white;'>Salary is been Locked</h3>";

		}

		

		

		



}



?>





<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->

          <div class="">

		  

		  

           

        <div class="clearfix"></div>



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>Advance Reporting</h2>

                    <ul class="nav navbar-right panel_toolbox">

                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                      </li>

                      <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                        <ul class="dropdown-menu" role="menu">

                          <li><a href="#">Settings 1</a>

                          </li>

                          <li><a href="#">Settings 2</a>

                          </li>

                        </ul>

                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>

                      </li>

                    </ul>

                    <div class="clearfix"></div>

                  </div>

				  

				  	 <div class="openerp openerp_webclient_container">

                  

                   

			

				  

				  

                  <div class="x_content">







<form action="../report/master_report.php" target="_blank" method="post">

  <div class="oe_view_manager oe_view_manager_current">

    <div class="oe_view_manager_body">

      <div  class="oe_view_manager_view_list"></div>

      <div class="oe_view_manager_view_form">

        <div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

          <div class="oe_form_buttons"></div>

          <div class="oe_form_sidebar"></div>

          <div class="oe_form_pager"></div>

          <div class="oe_form_container">

            <div class="oe_form">

              <div class="">

              

                  

                    <div  class="oe_view_manager_view_list">

                      <div  class="oe_list oe_view">

                        <table width="100%" border="0" class="oe_list_content">

                          <thead>

                            <tr class="oe_list_header_columns">

                              <th colspan="4"><span style="text-align: center;font-size:19px; color:#7c5fc8"><center>HR MANAGEMENT</center></span></th>

                            </tr>

                            <tr class="oe_list_header_columns">

                              <th colspan="4"><span style="text-align: center; font-size:14px; color:#C00"><center>Select Options</center></span></th>

                            </tr>

                          </thead>

                          <tfoot>

                          </tfoot>

                          <tbody>

                            <tr>

                              <td align="right" style="font-size:16px" class="alt"><strong>Company :</strong></td>

                              <td align="left" class="alt"><span class="oe_form_group_cell">

                                <select name="PBI_ORG" style="width:160px;" id="PBI_ORG">

                                  <? //foreign_relation('user_group','id','group_name',$PBI_ORG);?>

								  <option selected value="2">Aksid Corporation Limited</option>

                                </select>

                                </span></td>

                              <td width="40%" style="font-size:16px" align="right" class="alt"><strong>Department :</strong></td>

                              <td width="10%"><span class="oe_form_group_cell">

                                <select name="department" style="width:160px;" id="department">

                                  <? foreign_relation('department','DEPT_ID','DEPT_DESC',$PBI_DEPARTMENT,'1 order by DEPT_DESC');?>

                                </select>

                                </span></td>

                            </tr>

                            <tr  class="alt">

                              <td align="right" style="font-size:16px"><strong>Designation :</strong></td>

                              <td align="left"><span class="oe_form_group_cell">

                                <select name="designation" style="width:160px;" id="designation">

                                  <? foreign_relation('designation','DESG_ID','DESG_DESC',$ESS_DESIGNATION,'1 order by DESG_DESC');?>

                                </select>

                                </span></td>

                              <td align="right" style="font-size:16px"><strong>Project / Job Location:</strong></td>

                              <td><span class="oe_form_group_cell">

                                <select name="JOB_LOCATION" id="JOB_LOCATION" style="width:160px;">

                                  <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$_POST['JOB_LOCATION'],'1 order by PROJECT_DESC');?>

                                </select>

                                </span></td>

                            </tr>

                            <tr >

                              <td align="right" style="font-size:16px"><strong>Gender :</strong></td>

                              <td align="left"><span class="oe_form_group_cell">

                                <select name="gender" style="width:160px;">

                                  <option selected="selected"></option>

                                  <option>Male</option>

                                  <option>Female</option>

                                </select>

                                </span></td>

                              <td align="right" style="font-size:16px"><strong>Job Status :</strong></td>

                              <td><span class="oe_form_group_cell">

                                <select name="job_status" style="width:160px;">

                                  <option selected="selected"></option>

                                  <option>IN SERVICE</option>

                                  <option>NOT IN SERVICE</option>

                                </select>

                                </span></td>

                            </tr>

                         

                           

                            <tr >

                              <td align="right" style="font-size:16px"><span class="alt"><strong>Bonus Type  : </strong></span></td>

                              <td align="left"><strong>

                                <select name="bonus_type" required = "required" style="width:160px;">

                                  <option value="2">Eid-Ul-Adha</option>

                                  <option value="1">Eid-Ul-Fitre</option>

                                </select>

                              </strong></td>

                              <td align="right"><strong>Job Status :</strong></td>

                              <td><span class="oe_form_group_cell">

                                <select name="PBI_ID" style="width:160px;">

                                 <? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$_POST['PBI_ID'],'PBI_JOB_STATUS="In Service"')?>

                                </select>

                              </span></td>

                            </tr>

                            <tr>

                              <td align="right" bgcolor="#7c5fc8" style="color:#FFFFFF; font-weight:bold; font-size:15px"><span>Month:</span> </td>

                              <td align="left" bgcolor="#7c5fc8" style="color:#FFFFFF; font-weight:bold; font-size:15px"><span class="oe_form_group_cell">

                                <select name="mon" style="width:160px;" id="mon" required="required">

                                  <option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>

                                  <option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>

                                  <option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>

                                  <option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>

                                  <option value="5" <?=($mon=='5')?'selected':''?>>May</option>

                                  <option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>

                                  <option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>

                                  <option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>

                                  <option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>

                                  <option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>

                                  <option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>

                                  <option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>

                                </select>

                                </span></td>

                              <td align="right" bgcolor="#7c5fc8" style="color:#FFFFFF; text-align:center; font-weight:bold;font-size:15px; padding-top:2;"><span style="float:right">Year:</span></td>

                              <td bgcolor="#7c5fc8" style="color:#FFFFFF; text-align:center; font-weight:bold; padding-top:7px; font-size:15px" ><select name="year" style="width:160px;" id="year" required="required">

                                  <option <?=($year=='2013')?'selected':''?>>2013</option>

                                  <option <?=($year=='2014')?'selected':''?>>2014</option>

                                  <option <?=($year=='2015')?'selected':''?>>2015</option>

                                  <option <?=($year=='2016')?'selected':''?>>2016</option>

                                  <option <?=($year=='2017')?'selected':''?>>2017</option>

                                  <option <?=($year=='2018')?'selected':''?>>2018</option>

                                  <option <?=($year=='2019')?'selected':''?>>2019</option>

                                  <option <?=($year=='2020')?'selected':''?>>2020</option>

                                  <option <?=($year=='2021')?'selected':''?>>2021</option>
								  
								    <option <?=($year=='2022')?'selected':''?>>2022</option>



                                  <option <?=($year=='2023')?'selected':''?>>2023</option>



                                  <option <?=($year=='2024')?'selected':''?>>2024</option>



                                  <option <?=($year=='2025')?'selected':''?>>2025</option>
								   <option <?=($year=='2026')?'selected':''?>>2026</option>



                                  <option <?=($year=='2027')?'selected':''?>>2027</option>
								  
								  
								  <option <?=($year=='2028')?'selected':''?>>2028</option>



                                  <option <?=($year=='2029')?'selected':''?>>2029</option>



                                  <option <?=($year=='2030')?'selected':''?>>2030</option>

                                </select></td>

                            </tr>

                          </tbody>

                        </table>

                        <br />

                        <div style="text-align:center">

                          <table width="100%" class="oe_list_content">

                            <thead>

                              <tr class="oe_list_header_columns">

                                <th colspan="4"><span style="text-align: center; font-size:16px; color:#C00">Select Report</span></th>

                              </tr>

                            </thead>

                            <tfoot>

                            </tfoot>

                            <tbody>

                            <!--<tr  class="alt">

                                <td align="center"><input name="report" type="radio" class="radio" value="10001"  /></td>

                                <td><strong>Employee Details Information</strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr  class="alt">

                                <td align="center"><input name="report" type="radio" class="radio" value="8" /></td>

                                <td><strong>Staff Mobile Information(Changable)</strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr  class="alt">

                                <td align="center"><input name="report" type="radio" class="radio" value="7" /></td>

                                <td><strong>Payroll </strong> <strong>Information (New)</strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>-->

                               

                              <!--<tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="3" /></td>

                                <td class="alt"><strong>Monthly Attendence Report</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>-->
							  
							     <tr>

                                <td width="4%" align="center"><input name="report" type="radio" class="radio" value="21" checked="checked" /></td>

                                <td width="44%"><strong>Late Present </strong> <strong>Report</strong></td>

                                <td width="4%" align="center">&nbsp;</td>

                                <td width="44%">&nbsp;</td>

                              </tr>
							  
							  
							    <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="22" /></td>

                                <td class="alt"><strong>Absenteeism Report</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>
							  
							  
							   <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="39" /></td>

                                <td class="alt"><strong>Monthly Attendance Report</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

							  
							  

                              <!--<tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="4" /></td>

                                <td class="alt"><strong>Over Time Amount Report</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="5" /></td>

                                <td class="alt"><strong>Salary Payroll Report (Detail)</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="6" /></td>

                                <td class="alt"><strong>Salary Payroll Report (Summary)</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="66" /></td>

                                <td class="alt"><strong>Salary Payroll Report (Final)</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>

                              <tr >

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="77" /></td>

                                <td class="alt"><strong>Salary Payroll Report Final (Field)</strong><strong></strong></td>

                                <td align="center">&nbsp;</td>

                                <td>&nbsp;</td>

                              </tr>-->

                             

							 

                             

                              

							

                              

                              

                              

                             

                              

                              

                            </tbody>

                          </table>

                          <input name="submit" type="submit" id="submit" value="SHOW" />

                        </div>

                      </div>

                    </div>

              

                </div>

                <div class="oe_chatter">

                  <div class="oe_followers oe_form_invisible">

                    <div class="oe_follower_list"></div>

                  </div>

                </div>

              </div>

            </div>

         

        </div>

      </div>

    </div>

  </div>

</form>





</div>







 </tr>

         </tbody>

          </table> 

		   </div>

		   

		   

		   </div>

		    </div>

            </div>

			</div>

			</div>

			

<?



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



include_once("../../template/footer.php");



?>

