﻿<?php
@session_start();
ob_start();
require_once "../../config/inc.all.php";
require "../../template/main_layout.php";

// ::::: Edit This Section ::::: 
$title = 'User Access Control';      // Page Name and Page Title
$page = "user_access_control.php";    // PHP File Name
$root = 'setup';
$table = 'hrm_user_access';    // Database Table Name Mainly related to this page
$unique = 'id';      // Primary Key of this Database table
$shown = 'PBI_ID';        // For a New or Edit Data a must have data field






$crud      = new crud($table);
$$unique = $_GET[$unique];



$$unique = $_POST[$unique];







if (isset($_POST['insert'])) {







  $now = time();







  //$_REQUEST['entry_by'] = $_SESSION['employee_selected'];



  $PBI_ID_CON = find_a_field('personnel_basic_info', 'PBI_ID', 'PBI_CODE=' . $_POST['PBI_CODE']);



  $found = find_a_field('hrm_user_access', 'PBI_ID', 'PBI_ID=' . $PBI_ID_CON);



  if ($found > 0) {



    $msggg = "Already Exist";
  } else {





    //$_REQUEST['PBI_ID'] = $PBI_ID_CON;





    $sql = "INSERT INTO hrm_user_access (PBI_ID,kpi_module) VALUES ('" . $PBI_ID_CON . "','1')";



    $query = mysql_query($sql);





    //$crud->insert();



    $type = 1;



    $msg = 'New Entry Successfully Inserted.';
  }







  unset($_POST);



  unset($$unique);
}











//for Modify..................................







if (isset($_POST['update'])) {



  $crud->update($unique);



  $type = 1;
}







if ($_GET['del'] > 0) {







  mysql_query('delete from  hrm_user_access where id=' . $_GET['del']);







  $type = 1;







  $msg = 'Successfully Deleted.';
}







//for Delete..................................







/*if(isset($_POST['delete']))



{		$condition=$unique."=".$$unique;		$crud->delete($condition);



		unset($$unique);



		echo '<script type="text/javascript">



parent.parent.document.location.href = "../inventory/home_leave.php?notify=12";



</script>';



		$type=1;



		$msg='Successfully Deleted.';



}*/







$$unique = $_SESSION['employee_selected'];



if (isset($$unique)) {



  $condition = $unique . "=" . $$unique;



  $data = db_fetch_object($table, $condition);



  while (list($key, $value) = each($data)) {
    $$key = $value;
  }
}



if (!isset($$unique)) $$unique = db_last_insert_id($table, $unique);



?>



<style type="text/css">
  .MATERNITY_LEAVE {
    display: none;
  }
  input[type="radio"],
  input[type="checkbox"] {
    line-height: normal;
    margin: 4px 0 0;
    width: 20px;
  }
  .radio,
  .checkbox {
    min-height: 20px;
    padding-left: 20px;
  }
  .checkbox {
    margin-right: 4px !important;
  }
  .radio.inline,
  .checkbox.inline {
    display: inline-block;
    margin-bottom: 0;
    padding-top: 5px;
    vertical-align: middle;
  }
  .radio.inline,
  .checkbox.inline {
    display: inline-block;
    margin-bottom: 0;
    padding-top: 5px;
    vertical-align: middle;
  }
  .radio.inline+.radio.inline,
  .checkbox.inline+.checkbox.inline {
    margin-left: 10px;
  }
</style>


<style>
  .frmSearch {
    border: 1px solid #a8d4b1;
  }

  #country-list {
    float: left;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    width: 190px;
    position: absolute;
  }

  #country-list li {
    padding: 10px;
    background: #f0f0f0;
    border-bottom: #bbb9b9 1px solid;
  }

  #country-list li:hover {
    background: #ece3d2;
    cursor: pointer;
  }

  #id_no {
    padding: 10px;
    border: #a8d4b1 1px solid;
  }
</style>



<div class="right_col" role="main"> <!-- Must not delete it, this is main design header -->
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> User Access Control </h2>
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
            <table class="oe_webclient">
              <tbody>
                <tr>
                  <div class="x_content">

                    <style>
                      .red-cell {
                        color: red;
                      }
                    </style>


                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="oe_view_manager oe_view_manager_current">

                        <? include('../../common/title_bar.php'); ?>

                        <div class="oe_view_manager_body">
                          <div class="oe_view_manager_view_list"></div>
                          <div class="oe_view_manager_view_form">
                            <div style="opacity: 1;" class="oe_formview oe_view oe_form_editable">
                              <div class="oe_form_buttons"></div>
                              <div class="oe_form_sidebar"></div>
                              <div class="oe_form_pager"></div>
                              <div class="oe_form_container">
                                <div class="oe_form">
                                  <div class="">
                                    <div class="oe_form_sheetbg">
                                      <div class="oe_form_sheet oe_form_sheet_width">

                                        <?php echo $msggg; ?>

                                        <table class="oe_form_group " border="0" cellpadding="0" cellspacing="0">
                                          <tbody>

                                            <tr class="oe_form_group_row">
                                              <td colspan="1" class="oe_form_group_cell" width="100%">
                                                <table width="100%" border="0" cellpadding="2" cellspacing="0" class="oe_form_group ">
                                                  <tbody>

                                                    <tr class="oe_form_group_row">
                                                      <td bgcolor="#E8E8E8" colspan="1" class="oe_form_group_cell oe_form_group_cell_label">
                                                        &nbsp;&nbsp;Employee ID:
                                                      </td>

                                                      <td bgcolor="#E8E8E8" colspan="4" class="oe_form_group_cell">
                                                        <input name="kpi_module" type="hidden" id="kpi_module" value="1" style="width:420px;" />
                                                        <div class="frmSearch">
                                                          <input name="PBI_CODE" type="text" id="PBI_CODE" value="" style="width:420px;" />
                                                          <div id="suggesstion-box"></div>
                                                        </div>
                                                      </td>
                                                    </tr>

                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>

                                            <tr>
                                              <td>
                                                <div align="center">
                                                  <span class="oe_form_buttons_edit" style="display: inline;">
                                                    <button name="insert" accesskey="S" class="oe_button oe_form_button_save oe_highlight" type="submit">
                                                      ADD
                                                    </button>
                                                  </span>
                                                </div>
                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>

                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <thead>
                                              <th>Serial</th>
                                              <th>Employee ID</th>
                                              <th>Employee Name</th>
                                              <th>Designation</th>
                                              <th>Department/Project</th>
                                              <th>Action</th>
                                            </thead>
                                          </tr>
                                          <tbody>

                                            <?
                                            $res = 'select p.*,k.PBI_ID,k.id as kid from  hrm_user_access k, personnel_basic_info p 
                                              where 1 and k.kpi_module=1 and k.PBI_ID=p.PBI_ID order by p.PBI_DEPARTMENT';
                                            $qeury = mysql_query($res);
                                            while ($basic = mysql_fetch_object($qeury)) {
                                              //$basic = find_all_field('personnel_basic_info','','PBI_ID='.$data->PBI_ID);
                                              $s++;
                                            ?>

                                              <tr <? if ($s % 2 == 0) { ?> bgcolor="#E8E8E8" <? } ?>>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $basic->PBI_CODE; ?></td>
                                                <td><?= $basic->PBI_NAME; ?></td>
                                                <td><?= find_a_field('designation', 'DESG_DESC', 'DESG_ID=' . $basic->PBI_DESIGNATION); ?></td>
                                                <? if ($basic->PBI_DEPARTMENT == 13) { ?>
                                                  <td><?= find_a_field('project', 'PROJECT_DESC', 'PROJECT_ID=' . $basic->JOB_LOCATION); ?></td>
                                                <? } else { ?>
                                                  <td><?= find_a_field('department', 'DEPT_DESC', 'DEPT_ID=' . $basic->PBI_DEPARTMENT); ?></td>
                                                <? } ?>
                                                <? $checker = find_a_field('personnel_basic_info', 'PBI_JOB_STATUS', 'PBI_ID=' . $basic->PBI_ID); ?>
                                                <? // if ($checker === 'Not In Service') echo 'class="red-cell"'; 
                                                ?>
                                                <? //php if ($checker === 'Not In Service') echo 'style="color: red;"'; 
                                                ?>
                                                <td>
                                                  <button <? if ($checker === 'Not In Service') echo 'style="background: red; color:white"'; ?>>
                                                    <a href="user_access_control.php?del=<?= $basic->kid ?>">
                                                      Delete
                                                    </a>
                                                  </button>
                                                </td>
                                              </tr>
                                            <? } ?>
                                          </tbody>
                                        </table>
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


                    <!-- /page content -->
                    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                    <script>
                      $(document).ready(function() {
                        $("#PBI_ID").keyup(function() {
                          $.ajax({
                            type: "POST",
                            url: "auto_com.php",
                            data: 'keyword=' + $(this).val(),
                            beforeSend: function() {
                              $("#PBI_ID").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                            },
                            success: function(data) {
                              $("#suggesstion-box").show();
                              $("#suggesstion-box").html(data);
                              $("#PBI_ID").css("background", "#FFF");
                            }
                          });
                        });
                      });

                      function selectCountry(val) {
                        $("#PBI_ID").val(val);
                        $("#suggesstion-box").hide();
                      }
                    </script>

                    <?
                    include_once("../../template/footer.php");
                    ?>