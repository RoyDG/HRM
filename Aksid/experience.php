<?php

session_start();

ob_start();

require "../../config/inc.all.php";
require "../../template/main_layout.php";

//Use this to search id

if(isset($_POST['button'])){

$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);

$_SESSION['employee_selected'] = $pbi_new_code;

}

// ::::: Edit This Section ::::: 

$title='Experience Management';			// Page Name and Page Title

$page="experience.php";		// PHP File Name

$input_page="experience_input.php";

$root='hrm';



$table='experience_detail';		// Database Table Name Mainly related to this page

$unique='EXPERIENCE_DETAIL_ID';			// Primary Key of this Database table

$shown='EXPERIENCE_NOO';				// For a New or Edit Data a must have data field



// ::::: End Edit Section :::::

do_calander('#EXPERIENCE_FROM');



$crud      =new crud($table);



$$unique = $_GET[$unique];



?>

<script type="text/javascript"> function DoNav(lk){

	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)

	}</script>


	<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->
          <div class="">
		  
		  
           
        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Experience</h2>
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
	



<form action="" method="post" enctype="multipart/form-data">

<div class="oe_view_manager oe_view_manager_current">

        

    <? include('../../common/title_bar.php');?>

        <div class="oe_view_manager_body">

            

                <div  class="oe_view_manager_view_list"></div>

            

                <div class="oe_view_manager_view_form"><div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">

        <div class="oe_form_buttons"></div>

        <div class="oe_form_sidebar"></div>

        <div class="oe_form_pager"></div>

        <div class="oe_form_container"><div class="oe_form">

          <div class="">

    <? include('../../common/report_bar.php');?>

<div class="oe_form_sheetbg">

        <div class="oe_form_sheet">



          <div  class="oe_view_manager_view_list"><div  class="oe_list oe_view">

          <? $res='select '.$unique.',EXPERIENCE_NOO as COMPANY_NAME,
		  EXPERIENCE_POSITION as POSITION,
		  EXPERIENCE_DEPARTMENT as DEPARTMENT,
		  EXPERIENCE_LENGTH as LENGTH,
		  EXPERIENCE_DOCUMENT as DOCUMENT, 
		  EXPERIENCE_FROM as START_DATE,
		  EXPERIENCE_TO as END_DATE
		  from '.$table.' where PBI_ID='.$_SESSION['employee_selected'].' order by EXPERIENCE_FROM DESC';

			echo $crud->link_report($res,$link);?>

          </div></div>

          </div>

    </div>

    <div class="oe_chatter"><div class="oe_followers oe_form_invisible">

      <div class="oe_follower_list"></div>

    </div></div></div></div></div>

    </div></div>

            

        </div>

    </div>

</form>

</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->



<?






include_once("../../template/footer.php");



?>