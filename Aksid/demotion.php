<?php
	session_start();
	ob_start();
	require "../../config/inc.all.php";
	require "../../template/main_layout.php";
	if(isset($_POST['button'])){
	$pbi_new_code=find_a_field('personnel_basic_info','PBI_ID','PBI_CODE='.$_POST['employee_selected']);
	$_SESSION['employee_selected'] = $pbi_new_code;
	}
	$title='Demotion Management';	// Page Name and Page Title
	$page="demotion.php";
	$input_page="demotion_input.php";
	$root='hrm';
	$table='demotion_detail';		// Database Table Name Mainly related to this page
	$unique='DEMOTION_D_ID';		// Primary Key of this Database table
	$shown='DEMOTION_REF';			// For a New or Edit Data a must have data field
	$crud =new crud($table);
	$$unique = $_GET[$unique];
?>



<script type="text/javascript"> 
	function DoNav(lk){
	return GB_show('ggg', '../pages/<?=$root?>/<?=$input_page?>?<?=$unique?>='+lk,600,940)
	}
</script>


<!-- Body starts from here-->

<div class="right_col" role="main">   
	<div class="">   
    	<div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
					
                	<div class="x_title">
                    	<h2>Demotion / Salary Reduction</h2>
                    	<ul class="nav navbar-right panel_toolbox">
							<li>
							  	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						  	</li>
						  	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
								  	<li>
										<a href="#">Setting I</a>
								  	</li>
								  	<li>
										<a href="#">Setting II</a>
								  	</li>
								</ul>
						  	</li>
						  	<li>
							  	<a class="close-link"><i class="fa fa-close"></i></a>
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
									<div class="oe_view_manager_view_form">
										<div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
											<div class="oe_form_buttons"></div>
											<div class="oe_form_sidebar"></div>
											<div class="oe_form_pager"></div>
											<div class="oe_form_container">
												<div class="oe_form">
													
													<div class="">
														
    													<? include('../../common/report_bar.php');?>
														
														<div class="oe_form_sheetbg">
															<div class="oe_form_sheet oe_form_sheet_width">
																<div class="oe_view_manager_view_list">
																	<div class="oe_list oe_view">
																		
																		<? 
																		  $res='select d.'.$unique.', d.'.$shown.' as REFERENCE,
																		  
																		  DATE_FORMAT(d.DEMOTION_DATE, "%d-%b-%Y") AS ISSUE_DATE,
																		  
               															  DATE_FORMAT(d.DEMOTION_EFF_DATE, "%d-%b-%Y") AS EFFECTIVE_DATE,
																		  
																		  IFNULL(d2.DESG_SHORT_NAME, "")AS PREVIOUS_DESIGNATION,
					
																		IFNULL(d1.DESG_SHORT_NAME, "") AS NEW_DESIGNATION,

																		a.PBI_NAME AS REPORTING_AUTH
																		FROM demotion_detail d
																		JOIN personnel_basic_info a ON d.DEMOTION_REPORTING_AUTH = a.PBI_ID
																		JOIN designation d1 ON d.DEMOTION_PRESENT_DESG = d1.DESG_ID
																		JOIN designation d2 ON d.DEMOTION_PAST_DESG = d2.DESG_ID
																		WHERE d.PBI_ID = ' . $_SESSION['employee_selected'];

																		echo $crud->link_report($res,$link);
																		  
																		  
																		  
																		?>
																		
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
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
       

<?
include_once("../../template/footer.php");
?>
	
	