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







 //auto_complete_from_db('personnel_basic_info','concat(PBI_NAME,"-",PBI_JOB_STATUS)','PBI_ID','1','PBI_ID');







?>







<style>







.frmSearch {border: 1px solid #a8d4b1;}



#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}



#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}



#country-list li:hover{background:#ece3d2;cursor: pointer;}



#id_no{padding: 10px;border: #a8d4b1 1px solid;}



</style>







<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->



          <div class="">



		  



		  



           



        <div class="clearfix"></div>







            <div class="row">



              <div class="col-md-12 col-sm-12 col-xs-12">



                <div class="x_panel">



                  <div class="x_title">



                    <h2><span style="text-align: center; font-size:19px; color:#089c84"><center>COMPENSATION MANAGEMENT</center></span></h2>



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



                        <table width="100%" border="0" class="table table-bordered table-sm">



                          <thead>



                            <!--<tr class="oe_list_header_columns">



                              <th colspan="4"><span style="text-align: center; font-size:19px; color:#089c84"><center>COMPENSATION MANAGEMENT</center></span></th>



                            </tr>-->



                            <!--<tr class="oe_list_header_columns">



                              <th colspan="4"><span style="text-align: center; font-size:; color:#C00">Select Options</span></th>



                            </tr>-->



                          </thead>



                          <tfoot>



                          </tfoot>



                          <tbody>



                            <tr>



                              <td align="right" style="font-size:" class="alt"><strong>Company :</strong></td>



                              <td align="left" class="alt"><span class="oe_form_group_cell">



                                <select name="PBI_ORG" style="width:160px;" id="PBI_ORG">



                                  <? //foreign_relation('user_group','id','group_name',$PBI_ORG);?>



								  <option selected value="2">Aksid Corporation Limited</option>



                                </select>



                                </span></td>



                              <td  align="right" class="alt" style="font-size:;"><strong>Department :</strong></td>



                              <td width="10%"><span class="oe_form_group_cell">



                                <select name="department" style="width:160px;" id="department">



                                  <? foreign_relation('department','DEPT_ID','DEPT_DESC',$PBI_DEPARTMENT,'1 order by DEPT_DESC');?>



                                </select>



                                </span></td>



                            </tr>
							
							
							




                            <tr  class="alt">



                              <td align="right" style="font-size:"><strong>Designation :</strong></td>



                              <td align="left"><span class="oe_form_group_cell">



                                <select name="designation" style="width:160px;" id="designation">



                                 <? foreign_relation('designation','DESG_ID','DESG_DESC',$ESS_DESIGNATION,'1 order by DESG_DESC');?>



                                </select>



                                </span></td>



                              <td align="right" style="font-size:"><strong>Project / Job Location:</strong></td>



                              <td><span class="oe_form_group_cell">



                                <select name="JOB_LOCATION" id="JOB_LOCATION" style="width:160px;">



                                  <? foreign_relation('project','PROJECT_ID','PROJECT_DESC',$_POST['JOB_LOCATION'],'1 order by PROJECT_DESC');?>



                                </select>



                                </span></td>



                            </tr>



                            <tr >



                              <td align="right" style="font-size:"><strong>Gender :</strong></td>



                              <td align="left"><span class="oe_form_group_cell">



                                <select name="gender" style="width:160px;">



                                  <option selected="selected"></option>



                                  <option>Male</option>



                                  <option>Female</option>



                                </select>



                                </span></td>



                              <td align="right" style="font-size:"><strong>Job Status :</strong></td>



                              <td><span class="oe_form_group_cell">



                                <select name="job_status" style="width:160px;">



                                  <option selected="selected"></option>



                                  <option>IN SERVICE</option>



                                  <option>NOT IN SERVICE</option>



                                </select>



                                </span></td>



                            </tr>



                           



                       



                            <tr >



                              <td align="right" style="font-size:"><span class="alt"><strong>Bonus Type  : </strong></span></td>



							  



                              <td align="left"><strong>



                                <select name="bonus_type" required = "required" style="width:160px;">



                                  <option value="2">Eid-Ul-Adha</option>



                                  <option value="1">Eid-Ul-Fitre</option>



                                </select>



                              </strong></td>



							  



							  



                             <td align="right" style="font-size:"><strong>ID NO:</strong></td>



                              <td align="center"><span class="oe_form_group_cell">



                               <div class="frmSearch">



<input type="text" id="id_no" name="id_no" placeholder="Employee Name..." />



<div id="suggesstion-box"></div>



</div>



                                 <? //foreign_relation('personnel_basic_info','PBI_ID','CONCAT("",PBI_ID,"","-", " ",PBI_NAME )',$PBI_ID);?>



								 



                                



                                </span></td>



							  



							  



                            </tr>

							

							<tr >



                              <td align="right" style="font-size:"><span class="alt"><strong>Assesment Year  : </strong></span></td>



							  



                              <td align="left"><strong>



                               <select name="financial_year" style="width:160px;" id="financial_year"  class="form-control">

      <option></option>

      <option>2021-2022</option>

      <option>2022-2023</option>

      <option>2023-2024</option>

      <option>2024-2025</option>

      <option>2025-2026</option>

	  <option>2026-2027</option>

	  <option>2027-2028</option>

	  <option>2028-2029</option>

	  <option>2029-2030</option>

    </select>



                              </strong></td>



							  



							  



                             <td align="right" style="font-size:"><strong>Tax Calculated With:</strong></td>



                              <td align="center"><span class="oe_form_group_cell">



                               <div class="frmSearch">



<select name="tax_calculate_type" style="width:160px;" id="tax_calculate_type">

  <option>Assessment Year</option>

  <option>Date</option>

</select>



<div id="suggesstion-box"></div>



</div>



                                 <? //foreign_relation('personnel_basic_info','PBI_ID','CONCAT("",PBI_ID,"","-", " ",PBI_NAME )',$PBI_ID);?>



								 



                                



                                </span></td>



							  



							  



                            </tr>
							
							
							
							
							
							
							
							<tr>



<td align="right" style="font-size:" class="alt"><strong>Salary Given by :</strong></td>
<td align="left" class="alt">                         <select name="cash_bank" style="width:160px;"  id="cash_bank"/>
                                                          
                                                          <option></option>
                                                          <option <?=($cash_bank=="1"?"Selected":"")?> value="1">Cash</option>
                                                          <option <?=($cash_bank=="2"?"Selected":"")?> value="2">Estern Bank Limited (Bank Account)</option>
                                                          <option <?=($cash_bank=="3"?"Selected":"")?> value="3">Estern Bank Limited (Payroll Card)</option>
                                                          <option <?=($cash_bank=="4"?"Selected":"")?> value="4">Estern Bank Limited (Bank Account + Payroll Card)</option>
                                                          <option <?=($cash_bank=="5"?"Selected":"")?> value="5">Estern Bank Limited (Bank Account + Cash)</option>
                                                          <option <?=($cash_bank=="6"?"Selected":"")?> value="6">Bkash</option>
                                                          <option <?=($cash_bank=="7"?"Selected":"")?> value="7">Nagad</option>
                                                          </select></td>
 <td width="40%" align="right" class="alt" style="font-size:"><strong></strong></td>
<td width="10%"><span class="oe_form_group_cell"></span></td>

</tr>



                            <tr>



                              <td align="right" style="background-color:#089c84; color:#FFFFFF; font-size:"><span>Month:</span> </td>



                              <td align="left" style="background-color:#089c84; color:#FFFFFF; font-size:"><span class="oe_form_group_cell">



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



                              <td align="right" style="background-color:#089c84; color:#FFFFFF; font-size:; "><span style="float:right">Year  :</span></td>



                              <td style="background-color:#089c84; font-size:;padding-top:4px"><select name="year" style="width:160px;" id="year" required="required">



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



                 



                        <div style="text-align:center">



                          <table width="100%" class="table table-bordered table-sm">



                            <thead>



                              <tr class="oe_list_header_columns">



                                <th colspan="4">
								
								<span style="text-align: center; font-size:; color:#C00">Select Report</span></th>



                              </tr>



                            </thead>



                            <tfoot>



                            </tfoot>



                            <tbody>



                             



                            



                              



							  <tr  class="alt">



                                <td align="center"><input name="report" type="radio" class="radio" value="202" /></td>



                                <td><strong>Salary </strong> <strong>Information</strong></td>



                                 <td align="left" class="alt"><input name="report" type="radio" class="radio" value="78" /></td>



                                <td class="alt"><strong>Salary Report </strong></td>



                              </tr>
							  
							  
							  <tr>



                            <td align="center" class="alt"><input name="report" type="radio" class="radio" value="233332" /></td>   



                                <td class="alt"><strong>Yearly Individual Salary Statement</strong></td>



							    <td align="left" class="alt"><input name="report" type="radio" class="radio" value="776" /></td>



							    <td class="alt"><strong>Salary Report (Cash Portion)</strong></td>



                              </tr>



                              
                            <tr>



                              <td align="center" class="alt"><input name="report" type="radio" class="radio" value="21211212" /></td>   



                                <td class="alt"><strong>Individual Fiscal Salary Statement</strong></td>


                                <td align="left" class="alt"><input name="report" type="radio" class="radio" value="782" /></td>



							    <td class="alt"><strong>Salary Report (Bkash)</strong></td>



                              </tr>
							  
							  
							  
							  <tr>


								<td align="center" class="alt"><input name="report" type="radio" class="radio" value="21231212" /></td>   
                              <td class="alt"><strong>Individual Fiscal Salary Statement (Tax purpose)</strong></td>
							   


                                <td align="left" class="alt"><input name="report" type="radio" class="radio" value="783" /></td>
                                <td class="alt"><strong>Salary Report (Nagad)</strong></td>



						      </tr>
							  
							  
							  <tr >
								<td align="center" class="alt"><input name="report" type="radio" class="radio" value="45963214" />
								</td>
                                <td class="alt"><strong>Pay Slip</strong></td>


							    



                               <td align="left" class="alt"><input name="report" type="radio" class="radio" value="9999" /></td>



                                <td class="alt"><strong>Salary Summary Sheet (All</strong>)</td>



						      </tr>
							  
							  
							  
							  <tr>
							<td align="center" class="alt"><input name="report" type="radio" class="radio" value="5312021" /></td>



							    <td class="alt"><strong>Salary Certificate</strong></td>	


							    




                              <td align="left" class="alt"><input name="report" type="radio" class="radio" value="8888" /></td>



                                <td class="alt"><strong>Salary Summary Sheet (Cash Portion)</strong></td>



						      </tr>
							  
							  
							  <tr>
							<td align="center" class="alt"><input name="report" type="radio" class="radio" value="5312029" /></td>



							    <td class="alt"><strong>Salary Certificate Tax</strong></td>
 								

                            

                            <td align="left" class="alt"><input name="report" type="radio" class="radio" value="8889" /></td>
                            <td class="alt"><strong>Salary Summary Sheet (Bkash)</strong></td>



                              </tr>
							  
							  
							  
							  
						 <tr>
							
						<td align="center" class="alt"><input name="report" type="radio" class="radio" value="4763" /></td>   
                            <td class="alt"><strong>Advance Salary Report</strong></td>	 
							 
				
				
				 <td align="left" class="alt"><input name="report" type="radio" class="radio" value="8890" /></td>
                 <td class="alt"><strong>Salary Summary Sheet (Nagad)</strong></td>




                           </tr>
						   
						   
						   
						   	  <tr>
								  
							<td align="center" class="alt"><input name="report" type="radio" class="radio" value="551010" /></td>   
				<td class="alt"><strong>Yearly Department Wise Salary Statement</strong></td>	  
								  
								 
                                
                                
							    <td align="left" class="alt"><input name="report" type="radio" class="radio" value="4512" /></td>
                                <td class="alt"><strong>Salary Advice (Bank)</strong></td>
                              </tr>
							  
							  
							  
							  
							  <tr>
								<td align="center" class="alt"><input name="report" type="radio" class="radio" value="144441" /></td>
                                <td class="alt"><strong>Salary Comparison Report</strong><strong></strong></td>


                            
								  
								  
								
								  
								  

                                <td align="center" class="alt"><input name="report" type="radio" class="radio" value="4513" /></td>



							    <td class="alt"><strong>Salary Advice (Bkash)</strong></td>



                              </tr>


                               <tr>



                       <!--          <td align="center" class="alt"><input name="report" type="radio" class="radio" value="3544" /></td>   



                                <td class="alt"><strong>Salary Cross Check(Accounts)</strong></td>-->
								
							 <td align="center" class="alt"><input name="report" type="radio" class="radio" value="283544" /></td>   



                                <td class="alt"><strong>Salary Report (Tax purpose)</strong></td>
								   
								   
								   
								
                              



                                 <td align="left" class="alt"><input name="report" type="radio" class="radio" value="4514" /></td>



							    <td class="alt"><strong>Salary Advice (Nagad)</strong></td>



                              </tr>
							
			



                              </tr>



					

                            </tbody>



                          </table>



                          <input name="submit" type="submit" id="submit" value="SHOW" />



                        </div>



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



</form>



</td></td></td>



</div>



                </div>



              </div>



            </div>



          </div>



        </div>



        <!-- /page content -->



		



<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>



<script>



$(document).ready(function(){



	$("#id_no").keyup(function(){



		$.ajax({



		type: "POST",



		url: "auto_com.php",



		data:'keyword='+$(this).val(),



		beforeSend: function(){



			$("#id_no").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");



		},



		success: function(data){



			$("#suggesstion-box").show();



			$("#suggesstion-box").html(data);



			$("#id_no").css("background","#FFF");



		}



		});



	});



});







function selectCountry(val) {



$("#id_no").val(val);



$("#suggesstion-box").hide();



}



</script>



<?



$main_content=ob_get_contents();



ob_end_clean();



include ("../../template/main_layout.php");



include_once("../../template/footer.php");



?>



