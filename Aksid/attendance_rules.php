<?php
session_start();
ob_start();
require "../../config/inc.all.php";
require "../../template/main_layout.php";

$title = 'Attandence Rules';   // Page Name and Page Title

?>


<div class="right_col" role="main">
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2 style="color: green;"> Attandence Rules </h2>
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


                     <h3 style="text-align: center; text-decoration: underline;">
                        Attendance Rules
                     </h3>

                     <h2><strong>For Mobile Bill:</strong></h2>
                     <ol>
                        <li>1st click the attendance save button to start Mobile Bill then upload prescribed Excel format (1844541234).</li>
						<li>Find those IDs that will not make any salary (Internet, Bkash, Vehicle Tracker and Ahmed Ali Yousuf) and click 30 days absenteeism.</li> 
                     </ol>

                     <h2><strong>For Food Subsidy Deduction:</strong></h2>
                     <ol>
                        <li>Upload prescribe excel format.</li>
                     </ol>

                     <h2><strong>Attendance (Device Based):</strong></h2>
                     <ol>
                        <li>Upload prescribe excel format.</li>
                        <li>If any employee leaves our company and don’t want to disburse his/her salary, then remove his/her attendance from the attendance sheet.</li>
						 <li>If any employee leaves our company and don’t want to disburse his/her salary then click 30 days absenteeism.</li>
                     </ol>

                     <h2><strong>Attendance (Manual Based):</strong></h2>
                     <ol>
                        <li>Upload prescribe excel format.</li>
                        <li>If any employee leaves our company and don’t want to disburse his/her salary, then remove his/her attendance from the attendance sheet.</li>
						<li>If any employee leaves our company and don’t want to disburse his/her salary then click 30 days absenteeism.</li>
                     </ol>

                     <h2><strong>Attendance (SFA):</strong></h2>
                     <ol>
                        <li>Upload prescribe excel format.</li>
                        <li>If any employee leaves our company and don’t want to disburse his/her salary, then remove his/her attendance from the attendance sheet.</li>
						<li>If any employee leaves our company and don’t want to disburse his/her salary then click 30 days absenteeism.</li>
                     </ol>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?

   include_once("../../template/footer.php");

   ?>