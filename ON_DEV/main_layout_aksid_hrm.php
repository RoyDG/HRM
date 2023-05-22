<? $user_id = $_SESSION['user']['id']; ?>



<!DOCTYPE html>



<html lang="en">



<head>



  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



  <!-- Meta, title, CSS, favicons, etc. -->



  <meta charset="utf-8">



  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">



  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">















  <title>AKSID HR Module </title>



  <link rel="shortcut icon" href="../../pic/icon.png" type="image/png" />











  <!-- ERP MAIN DESIGN LINK -->



  <script type="text/javascript">

    var GB_ROOT_DIR = "../../GBox/";

  </script>



  <script type="text/javascript" src="../../GBox/AJS.js"></script>



  <script type="text/javascript" src="../../GBox/AJS_fx.js"></script>



  <script type="text/javascript" src="../../GBox/gb_scripts.js"></script>



  <link href="../../GBox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />



  <!--<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>-->



  <script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>



  <script type="text/javascript" src="../../js/jquery.ui.datepicker.js"></script>



  <script type="text/javascript" src="../../js/jquery.autocomplete.js"></script>



  <script type="text/javascript" src="../../js/jquery.validate.js"></script>



  <script type="text/javascript" src="../../js/paging.js"></script>



  <script type="text/javascript" src="../../js/ddaccordion.js"></script>



  <script type="text/javascript" src="../../js/js.js"></script>



  <script type="text/javascript" src="../../js/pg.js"></script>







  <!--DataTables-->



  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />



  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>



  <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.js"></script>



  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>



  <!--DataTables-->







  <link href="../../css/css.css" type="text/css" rel="stylesheet" />



  <link href="../../css/menu.css" type="text/css" rel="stylesheet" />



  <link href="../../css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />



  <link href="../../css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />







  <!--  ERP DESIGN LINK END -->



  <?= $head ?>



  <script type="text/javascript">

    $(document).ready(function() {



      $("#codz").validate();



    });

  </script>



  <script type="text/javascript">

    $(document).ready(function() {







      $(function() {



        $("#date_birth").datepicker({



          changeMonth: true,



          changeYear: true,



          dateFormat: "yy-mm-dd"



        });







      });







    });

  </script>















  <!-- Bootstrap -->



  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">



  <!-- Font Awesome -->



  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">



  <!-- NProgress -->



  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">







  <!-- jQuery custom content scroller -->



  <link href="../../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />







  <!-- Custom Theme Style -->



  <link href="../../build/css/custom.min.css" rel="stylesheet">



</head>







<body class="nav-md">



  <div class="container body">



    <div class="main_container">



      <div class="col-md-3 left_col menu_fixed">



        <div class="left_col scroll-view">



          <div class="navbar nav_title" style="border: 0;">



            <a href="../inventory/home.php" class="site_title"><img src="../../pic/sr/img3.jpg" style=" width:150px; padding-left:10px; height:45px"></a>



          </div>







          <div class="clearfix"></div>







          <!-- menu profile quick info -->



          <div class="profile clearfix">



            <div class="profile_pic">











              <img src="../../pic/sr/<?= $_SESSION['user']['id'] ?>.jpg" alt="..." class="img-circle profile_img">























            </div>











            <div class="profile_info">



              <span>Welcome</span>



              <h2><?= find_a_field('user_activity_management', 'fname', 'user_id=' . $_SESSION['user']['id']); ?></h2>



            </div>



            <div class="clearfix"></div>



          </div>



          <!-- /menu profile quick info -->







          <br />











<!--          <i class="fas fa-address-card"></i>-->











          <!-- sidebar menu -->



          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">



            <div class="menu_section">



              <h3></h3>







              <ul class="nav side-menu">



                <? if ($_SESSION['user']['level'] == 7) { ?>



                  <li><a><i class="fa fa-user"></i>User Panel <span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">







                      <li><a href="../admin/user_manage.php"> Create User </a></li>











                    </ul>



                  </li><? } ?>





                <!-- <li><a><i class="fa fa-user"></i> MIS Sync System<span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                     



					  

						

						



                   



                     



                    </ul>



                  </li>-->















                <li><a><i class="fa fa-users"></i>HR Management<span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">



                    <li><a href="../hrm/employee_basic_information.php">Basic Info</a></li>



                    <li><a href="../hrm/employee_essential_information.php">Job Status</a></li>



                    <li><a href="../hrm/edcation.php">Education</a></li>



                    <li><a href="../hrm/course_diploma.php">Course/Diploma</a></li>



                    <li><a href="../hrm/experience.php">Experience</a></li>



                    <li><a href="../hrm/training.php">Training</a></li>



                    <li><a href="../hrm/transfer.php">Transfer</a></li>



                    <li><a href="../hrm/promotion.php">Promotion/Designation Change</a></li>



                    <li><a href="../hrm/demotion.php">Demotion</a></li>



                    <li><a href="../hrm/increment_entry.php">Increment</a></li>



                    <li><a href="../hrm/employee_requisition.php">Employee Requisition</a></li>



                    <!-- <li><a href="../hrm/administration_action.php">HR Action</a></li>-->



                    <li><a href="../payroll/hr_action_new.php">HR Action</a></li>



                    <li><a href="../hrm/pf_status.php">Personal File Check List</a></li>











                  </ul>



                </li>







                <li><a><i class="fa fa-edit"></i>Attendance Management <span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">



                    <li><a href="../payroll/monthly_attendence.php">Monthly Attendance (Dept)</a></li>



                    <li><a href="../payroll/monthly_attendence_upload.php">Monthly Attendance Upload</a></li>



                    <li><a href="../attendence/roster_view_sync_ho.php"> IN OUT Sync</a></li>

                    <li><a href="../attendence/leave_od_sync.php">Leave Od Sync</a></li>

                    <li><a href="../attendence/roster_sync_late_early.php">Late/Early Calculation </a></li>

                    <li><a href="../attendence/upload_attendence_final_roster.php">Attendance Final Process</a></li>



                    <li><a href="../attendence/manual_attendance.php">Manual Attendance</a></li>



                    <li><a href="../attendence/individual_attendance_report_edit.php">Attendance Edit</a></li>



                    <li><a href="../attendence/individual_attendance_report.php">Individual Attendance Report</a></li>



                    <!--<li><a href="../admin/attendence_update.php">Monthly Attendance Update</a></li>-->





                  </ul>



                </li>







                <li><a><i class="fa fa-edit"></i>Compensation Management <span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">



                    <? if ($_SESSION['user']['level'] == 7) { ?>



                      <li><a href="../payroll/salary_information.php">Salary & Allowance</a></li>



                    <? } ?>







                    <li><a href="../payroll/advance_payment.php">Advance Salary / Iou</a></li>



                    <li><a href="../payroll/other_deductions.php">Other Deductions</a></li>



                  <!--  <li><a href="../payroll/mobile_food_other_deduction.php">Monthly Mobile and Food Deduction</a></li>-->



                    <li><a href="../payroll/monthly_deduction_upload.php">Monthly Deduction Upload</a></li>







                    <!-- <li><a href="../payroll/monthly_food_bill_upload.php">Monthly Food Bill Upload</a></li>-->



                    <? if ($_SESSION['user']['level'] == 7) { ?>



                      <li><a href="../admin/salary_bonus.php">Bonus Calculation</a></li>



                      <li><a href="../report/salary_lock.php">Compensation Lock</a></li>



                      <li><a href="../report/sms_generate.php">Salary Payslip Generate</a></li>



                      <li><a href="../payroll/salary_hold.php">Salary Hold/Unhold</a></li>



                    <? } ?>











                  </ul>



                </li>







                <li><a><i class="fa fa-edit"></i>Tax Management<span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">







                    <li><a href="../hrm/tax_chalan.php">Employee Challan No</a></li>



                    <li><a href="../hrm/tax_investment.php">Tax Investment</a></li>



                  </ul>



                </li>



















                <!--  <li><a><i class="fa fa-cab"></i> Leave Management <span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                      <li><a href="../leave/leave_entry.php">Leave Entry</a></li>



                



                       <li><a href="../leave/leave_entry_half.php">Short Leave Entry</a></li>



					   <li><a href="../leave/tour_entry.php">Official Tour Entry</a></li>



					   <li><a href="../leave/leave_report.php">Leave Report</a></li>



					  



                    </ul>



                  </li>-->











                <!--  <li><a><i class="fa fa-bar-chart-o"></i>APR and Promotion<span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                      <li><a href="../hrm/apr.php">APR</a></li>



                    </ul>



                  </li>-->























                <li><a><i class="fa fa-cogs"></i>Setup<span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">



                    <li><a href="../setup/action_type.php">Action Type</a></li>







                    <li><a href="../setup/bank_type.php">Bank Type</a></li>



                    <li><a href="../setup/leave_type.php">Leave Type</a></li>



                    <li><a href="../setup/department_type.php">Department Type</a></li>



                    <li><a href="../setup/designation_type.php">Designation Type</a></li>



                    <li><a href="../setup/edu_subject_type.php">Education Subject Type</a></li>



                    <li><a href="../setup/edu_qua_type.php">Education Qualification Type</a></li>



                    <li><a href="../setup/edu_exam_type.php">Education Exam Type</a></li>



                    <li><a href="../setup/project_type.php">Project Type</a></li>



                    <li><a href="../setup/university_type.php">University Type</a></li>



                    <!-- <li><a href="../setup/demotion_reason.php">Demotion Reason</a></li>



					  <li><a href="../setup/profession_type.php">Profession Type</a></li>-->

                    <li><a href="../setup/division.php">Division Info</a></li>



                    <li><a href="../setup/district.php">District Info</a></li>



                    <li><a href="../setup/thana.php">Thana Info</a></li>



                    <li><a href="../setup/holy_day.php">Holiday</a></li>



                    <!--<li><a href="../setup/friday.php">Friday</a></li>



                        <li><a href="../setup/dayoff.php">Day Off</a></li>-->



                    <li><a href="../setup/office_timing.php">Office Time</a></li>















                  </ul>



                </li>











                <!-- <li><a><i class="fa fa-lock"></i> Compensation Lock<span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                      <li><a href="../report/salary_lock.php">Compensation Lock</a></li>



                      <li><a href="../report/salary_journal.php">Journal</a></li>



					



					  



                    </ul>



                  </li>-->



















                <!-- <li><a><i class="fa fa-file-text"></i> Report<span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



					 <li><a href="../report/hr_management.php">HR Management</a></li>



				<?php /*?>	<? if($_SESSION['user']['level']==7){?>



                     



                      <li><a href="../report/compensation_report.php">Compensation Management</a></li>



					  <? } ?><?php */ ?>



					  



					   <li><a href="../report/leaveOd_report.php">Leave & OD Management</a></li>



					   <li><a href="../report/mobileBilling_report.php">Mobile Billing Report</a></li>



					  



                    </ul>



                  </li>-->























                <li><a><i class="fa fa-file-text"></i>Reports <span class="fa fa-chevron-down"></span></a>



                  <ul class="nav child_menu">



                    <li><a href="../report/hr_management.php">HR Management</a>

                    <li><a href="../report/AttendenceManagementReport.php">Attendance Management</a> </li>





                    <li><a href="../report/delail_report_selection.php">Detail Staff Information</a>







                      <? if ($_SESSION['user']['level'] == 7) { ?>



                    <li><a>Compensation Management<span class="fa fa-chevron-down"></span></a>







                      <ul class="nav child_menu">



                        <li class="sub_menu"><a href="../report/salary_report.php">Salary Reports</a> </li>



                        <li><a href="../report/festival_bonus_report.php">Festival Bonus Report</a> </li>



                        <li><a href="../report/increment_promotion_report.php">Increment & Promotion Report</a> </li>







                        <li><a href="../report/download_xl.php">Download xl Report</a> </li>



                      </ul>



                    </li>





                    <li><a>TAX Management<span class="fa fa-chevron-down"></span></a>







                      <ul class="nav child_menu">



                        <li><a href="../report/tax_report.php">TAX Report</a> </li>



                      </ul>



                    </li>



                  <? } ?>















                  <li><a href="../report/leaveOd_report.php">Leave & OD Management</a> </li>















                  <li><a href="../report/mobileBilling_report.php">Mobile Billing Report</a> </li>



















                  </ul>



                </li>







              </ul>



















              </ul>



            </div>







            <div class="menu_section">



              <!--<h3>Live On</h3>-->



              <ul class="nav side-menu">



                <!--<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                      <li><a href="new.php">new</a></li>



                   



                      <li><a href="profile.html">Profile</a></li>



                    </ul>



                  </li>-->







                <!--<li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>



                    <ul class="nav child_menu">



                        <li><a href="#level1_1">Level One</a>



                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>



                          <ul class="nav child_menu">



                            <li class="sub_menu"><a href="level2.html">Level Two</a>



                            </li>



                            <li><a href="#level2_1">Level Two</a>



                            </li>



                            <li><a href="#level2_2">Level Two</a>



                            </li>



                          </ul>



                        </li>



                        <li><a href="#level1_2">Level One</a>



                        </li>



                    </ul>



                  </li> -->







              </ul>











            </div>







          </div>



          <!-- /sidebar menu -->







          <!-- /menu footer buttons -->



          <div class="sidebar-footer hidden-small">



            <a data-toggle="tooltip" data-placement="top" title="Settings">



              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="FullScreen">



              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="Lock">



              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>



            </a>



            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../main/logout.php">



              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>



            </a>



          </div>



          <!-- /menu footer buttons -->



        </div>



      </div>







      <!-- top navigation -->



      <div class="top_nav">



        <div class="nav_menu">



          <nav>



            <div class="nav toggle">



              <a id="menu_toggle"><i class="fa fa-bars"></i></a>



            </div>







            <ul class="nav navbar-nav navbar-right">



              <li class="">



                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">



                  <img src="../../pic/sr/<?= $_SESSION['user']['id'] ?>.jpg" alt="">Welcome..Aksid Corporation



                  <span class=" fa fa-angle-down"></span>



                </a>



                <ul class="dropdown-menu dropdown-usermenu pull-right">



                  <li><a href="javascript:;"> Profile</a></li>











                  <li><a href="../main/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>



                </ul>



              </li>











            </ul>



          </nav>



        </div>



      </div>



      <!-- /top navigation -->







      <td class="oe_application">

        <div>



          <?= $main_content; ?>



        </div>

      </td>