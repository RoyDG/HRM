<?php



session_start();



ob_start();



require "../../config/inc.all.php";



require "../../template/main_layout.php";







// ::::: Edit This Section ::::: 



$title = 'Employee Basic Info';    // Page Name and Page Title



$page = "employee_basic_information.php";    // PHP File Name



$input_page = "employee_basic_information_input.php";



$root = 'hrm';







$table = 'personnel_basic_info';    // Database Table Name Mainly related to this page



$unique = 'PBI_ID';      // Primary Key of this Database table



$shown = 'PBI_FATHER_NAME';







do_calander('#PBI_DOB');



do_calander('#PBI_REAl_DOB');



do_calander('#PBI_DOJ_PP');



do_calander('#PBI_DOC');



do_calander('#PBI_DOC2');



do_calander('#PBI_DOJ');



do_calander('#PBI_APPOINTMENT_LETTER_DATE');



do_calander('#JOB_STATUS_DATE');



do_calander('#PBI_REAl_DOB');



do_calander('#PBI_1ST_CHILD_DOB');







// ::::: End Edit Section :::::



//echo var_dump($_POST);

$crud      = new crud($table);

$required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected']);


//$required_id=$max_pbi;

if ($required_id > 0)
  $$unique = $_GET[$unique] = $required_id;



if (isset($_POST[$shown])) {
	
  if (isset($_POST['insert'])) {

    $path = '../../pic/staff';

    $_POST['pic'] = image_upload($path, $_FILES['pic']);



      // Check if password field is empty
      if (empty($_POST['pass'])) {
        $error = "Password field is required";
      } 
        else {

          if ($_FILES['emp_pic']['tmp_name'] != '') {

            $file_name = $_FILES['emp_pic']['name'];

            $file_tmp = $_FILES['emp_pic']['tmp_name'];

            $ext = end(explode('.', $file_name));

            $path = '../../pic/staff/';

            move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
          }



          if ($_FILES['nid_pic']['tmp_name'] != '') {

            $file_name = $_FILES['nid_pic']['name'];

            $file_tmp = $_FILES['nid_pic']['tmp_name'];

            $ext = end(explode('.', $file_name));

            $path = '../../pic/nid/';

            move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
          }



          if ($_FILES['pass_pic']['tmp_name'] != '') {

            $file_name = $_FILES['pass_pic']['name'];

            $file_tmp = $_FILES['pass_pic']['tmp_name'];

            $ext = end(explode('.', $file_name));

            $path = '../../pic/passport/';

            move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
          }


          $_POST['PBI_ID'] = $_SESSION['employee_selected'];

          $_REQUEST['PBI_PRESENT_THANA_ADD'] = $_POST['PBI_PRESENT_THANA_ADD'];

          $_REQUEST['PBI_PARM_THANA_ADD'] = $_POST['PBI_PARM_THANA_ADD'];

          $new_id = $crud->insert();

          $_SESSION['employee_selected'] = mysql_insert_id();

          $type = 1;
    }
          $msg = 'New Entry Successfully Inserted.';

          unset($_POST);

          unset($$unique);
    

  }

  $required_id = find_a_field($table, $unique, 'PBI_ID=' . $_SESSION['employee_selected']);

  $pbi_new_code = find_a_field($table, $unique, 'PBI_CODE=' . $_POST['employee_selected']);

  if ($required_id > 0)

    $$unique = $_GET[$unique] = $required_id;

  else

    $$unique = $_GET[$unique] = $_SESSION['employee_selected'] = $pbi_new_code;







  //for Modify..................................



  if (isset($_POST['update'])) {

    $path = '../../pic/staff';

    $_POST['pic'] = image_upload($path, $_FILES['pic']);
	  
	  

	// Check if password field is empty
	if (empty($_POST['pass'])) {
		$error = "Password field is required";
	} 
	  else {
			  
    if ($_FILES['emp_pic']['tmp_name'] != '') {

      $del_file = unlink('../../pic/staff/' . $_SESSION['employee_selected'] . '.jpeg');


      $del_file = unlink('../../pic/staff/' . $_SESSION['employee_selected'] . '.jpg');


      $del_file = unlink('../../pic/staff/' . $_SESSION['employee_selected'] . '.png');


      $del_file = unlink('../../pic/staff/' . $_SESSION['employee_selected'] . '.JPG');


      $file_name = $_FILES['emp_pic']['name'];

      $file_tmp = $_FILES['emp_pic']['tmp_name'];

      $ext = end(explode('.', $file_name));

      $path = '../../pic/staff/';

      move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
    }



    if ($_FILES['nid_pic']['tmp_name'] != '') {

      $del_file = unlink('../../pic/nid/' . $_SESSION['employee_selected'] . '.jpeg');



      $del_file = unlink('../../pic/nid/' . $_SESSION['employee_selected'] . '.jpg');



      $del_file = unlink('../../pic/nid/' . $_SESSION['employee_selected'] . '.png');



      $del_file = unlink('../../pic/nid/' . $_SESSION['employee_selected'] . '.JPG');



      $del_file = unlink('../../pic/nid/' . $_SESSION['employee_selected'] . '.pdf');



      $file_name = $_FILES['nid_pic']['name'];



      $file_tmp = $_FILES['nid_pic']['tmp_name'];



      $ext = end(explode('.', $file_name));



      $path = '../../pic/nid/';



      move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
    }







    if ($_FILES['pass_pic']['tmp_name'] != '') {



      $del_file = unlink('../../pic/passport/' . $_SESSION['employee_selected'] . '.jpeg');



      $del_file = unlink('../../pic/passport/' . $_SESSION['employee_selected'] . '.jpg');



      $del_file = unlink('../../pic/passport/' . $_SESSION['employee_selected'] . '.png');



      $del_file = unlink('../../pic/passport/' . $_SESSION['employee_selected'] . '.JPG');



      $del_file = unlink('../../pic/passport/' . $_SESSION['employee_selected'] . '.pdf');



      $file_name = $_FILES['pass_pic']['name'];



      $file_tmp = $_FILES['pass_pic']['tmp_name'];



      $ext = end(explode('.', $file_name));



      $path = '../../pic/passport/';



      move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
    }



    if ($_FILES['tin_pic']['tmp_name'] != '') {



      $del_file = unlink('../../pic/tin/' . $_SESSION['employee_selected'] . '.jpeg');



      $del_file = unlink('../../pic/tin/' . $_SESSION['employee_selected'] . '.jpg');



      $del_file = unlink('../../pic/tin/' . $_SESSION['employee_selected'] . '.png');



      $del_file = unlink('../../pic/tin/' . $_SESSION['employee_selected'] . '.JPG');



      $del_file = unlink('../../pic/tin/' . $_SESSION['employee_selected'] . '.pdf');



      $file_name = $_FILES['tin_pic']['name'];



      $file_tmp = $_FILES['tin_pic']['tmp_name'];



      $ext = end(explode('.', $file_name));



      $path = '../../pic/tin/';



      move_uploaded_file($file_tmp, $path . $_SESSION['employee_selected'] . '.' . $ext);
    }


    $_REQUEST['PBI_PRESENT_THANA_ADD'] = $_POST['PBI_PRESENT_THANA_ADD'];

    $_REQUEST['PBI_PARM_THANA_ADD'] = $_POST['PBI_PARM_THANA_ADD'];

    $crud->update($unique);
	  
    $type = 1;
	  }
  }
}







if ($_GET['del'] > 0) {







  $del = 'delete from child_detail where FAMILY_D_ID="' . $_GET['del'] . '"';



  $child_del = mysql_query($del);
}







if (isset($$unique)) {



  $condition = $unique . "=" . $$unique;



  $data = db_fetch_object($table, $condition);



  while (list($key, $value) = each($data)) {
    $$key = $value;
  }
}



?>







<script type="text/javascript">
	
	
  function DoNav(lk) {



    return GB_show('ggg', '../pages/<?= $root ?>/<?= $input_page ?>?<?= $unique ?>=' + lk, 600, 940)



  }



  function add_date(cd)



  {



    var arr = cd.split('-');



    var mon = (arr[1] * 1) + 6;



    var day = (arr[2] * 1);



    var yr = (arr[0] * 1);



    if (mon > 12)



    {



      mon = mon - 12;



      yr = yr + 1;



    }



    var con_date = yr + '-' + mon + '-' + day;



    document.getElementById('PBI_DOC').value = con_date;



  }











  /*$(document).ready(function(){







     $('#PBI_MARITAL_STA').click(function(){







       var rBtnVal = $(this).val();







       if(rBtnVal != "" && rBtnVal == "Married"){



           $("#PBI_SPOUSE").attr("readonly", false); 



       }



       else{ 



           $("#PBI_SPOUSE").attr("readonly", true); 



       }



     });



  });*/







  function marr_sta()



  {



    var status = document.getElementById('PBI_MARITAL_STA').value;



    if (status != "Married")



      document.getElementById('PBI_SPOUSE').setAttribute("readonly", "readonly");







    if (status == "Married")



      document.getElementById('PBI_SPOUSE').removeAttribute("readonly", "readonly");



  }



  window.onload = marr_sta;
</script>



<style>
  #country-list {
    float: left;
    list-style: none;
    margin-top: -3px;
    padding: 0;
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



  #PBI_ID {
    padding: 10px;
  }
</style>







<style type="text/css">
  <!--
  .style1 {
    font-weight: bold
  }
  -->



</style>



<div class="right_col" role="main"> <!-- Must not delete it ,this is main design header-->



  <div class="">




    <div class="clearfix"></div>


    <div class="row">



      <div class="col-md-12 col-sm-12 col-xs-12">



        <div class="x_panel">



          <div class="x_title">



            <h2>Basic Information</h2>



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























              <form  action="" method="post" style="text-align:center" enctype="multipart/form-data">



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



                              <? include('../../common/input_bar.php'); ?>



                              <div class="oe_form_sheetbg">











                                <table width="750" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



                                  <tbody>



                                    <tr class="oe_form_group_row">



                                      <td class="oe_form_group_cell" width="100%">
                                        <table width="90%" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



                                          <tbody>



                                            <tr class="oe_form_group_row">



                                              <td style="text-align:center;font-size:16px; background-color:#2a3f54; color:#1abb9c;  font-weight:bold" colspan="5" class="oe_form_group_cell oe_form_group_cell_label"><strong>:: Employee Basic Information :: </strong></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" bgcolor="#1abb9c" class="oe_form_group_cell oe_form_group_cell_label"><strong>Employee ID :</strong></td>



                                              <td colspan="2" bgcolor="#1abb9c" class="oe_form_group_cell"><input name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />

                                                <input name="PBI_ID" type="hidden" id="PBI_ID" value="<?= $PBI_ID ?>" />

                                                <input name="PBI_CODE" type="text" id="PBI_CODE" value="<?= $PBI_CODE ?>" />
                                              </td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell"><strong>



                                                  <label>&nbsp; Name :</label>



                                                </strong></td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell"><input name="PBI_NAME" type="text" class="style1" id="PBI_NAME" value="<?= $PBI_NAME ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Father's Name : </td>



                                              <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><input name="PBI_FATHER_NAME" type="text" id="PBI_FATHER_NAME" value="<?= $PBI_FATHER_NAME ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong>&nbsp; </strong>Mother's Name :</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_MOTHER_NAME" type="text" id="PBI_MOTHER_NAME" value="<?= $PBI_MOTHER_NAME ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Date of Birth (Certificate):</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_DOB" type="date" id="PBI_DOB" value="<?= $PBI_DOB ?>" /> <span> <?php























                                                                                                                                                                        $dateOfBirth = date("Y-m-d", strtotime($PBI_DOB));



                                                                                                                                                                        $today = date("Y-m-d");



                                                                                                                                                                        $diff = date_diff(date_create($dateOfBirth), date_create($today));



                                                                                                                                                                        echo $diff->format('%y');







                                                                                                                                                                        ?> </span> </td>















                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong>&nbsp; </strong>Date of birth (Orginal):</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input type="date" name="PBI_REAL_BIRTH" id="PBI_REAL_BIRTH" value="<?= $PBI_REAL_BIRTH ?>" /></td>



























                                            </tr>



                                            <tr class="oe_form_group_row">







                                              <td colspan="1" class="oe_form_group_cell"><strong>&nbsp;&nbsp;</strong>Place of Birth (District) :</td>



                                              <td colspan="2" class="oe_form_group_cell"><select name="PBI_POB">



                                                  <option value="<?= $PBI_POB ?>">



                                                    <?= $PBI_POB ?>



                                                  </option>



                                                  <? foreign_relation('district_list', 'district_name', 'district_name', $PBI_POB, ' 1 order by district_name'); ?>



                                                </select></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;&nbsp;Country of Birth : </td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_COB" type="text" id="PBI_COB" value="<?= $PBI_COB ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">







                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;</strong>&nbsp;Nationality :</td>



                                              <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><select name="PBI_NATIONALITY">



                                                  <option selected="selected">



                                                    <?= $PBI_NATIONALITY ?>



                                                  </option>



                                                  <option>Bangladeshi</option>



                                                  <option>Canadian</option>



                                                  <option>English</option>



                                                  <option>Indian</option>



                                                  <option>Pakistani</option>



                                                  <option>Nepali</option>



                                                </select></td>



                                              <td class="oe_form_group_cell"><strong>&nbsp;&nbsp;</strong>Religion :</td>



                                              <td class="oe_form_group_cell"><select name="PBI_RELIGION">



                                                  <option selected="selected">



                                                    <?= $PBI_RELIGION ?>



                                                  </option>



                                                  <option>Islam</option>



                                                  <option>Bahai</option>



                                                  <option>Buddhism</option>



                                                  <option>Christianity</option>



                                                  <option>Confucianism </option>



                                                  <option>Druze</option>



                                                  <option>Hinduism</option>



                                                  <option>Jainism</option>



                                                  <option>Judaism</option>



                                                  <option>Shinto</option>



                                                  <option>Sikhism</option>



                                                  <option>Taoism</option>



                                                  <option>Zoroastrianism</option>



                                                  <option>Others</option>



                                                </select></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Blood Group:</td>



                                              <td colspan="2" class="oe_form_group_cell"><select name="ESSENTIAL_BLOOD_GROUP">



                                                  <option selected="selected">



                                                    <?= $ESSENTIAL_BLOOD_GROUP ?>



                                                  </option>



                                                  <option></option>



                                                  <option>A(+ve)</option>



                                                  <option>A(-ve)</option>



                                                  <option>AB(+ve)</option>



                                                  <option>AB(-ve)</option>



                                                  <option>B(+ve)</option>



                                                  <option>B(-ve)</option>



                                                  <option>O(+ve)</option>



                                                  <option>O(-ve)</option>







                                                </select></td>



                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Gender : </td>



                                              <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><select name="PBI_SEX">



                                                  <option selected="selected">



                                                    <?= $PBI_SEX ?>



                                                  </option>



                                                  <option>Male</option>



                                                  <option>Female</option>



                                                </select></td>







                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Marital Status :</td>



                                              <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><select name="PBI_MARITAL_STA" id="PBI_MARITAL_STA" onchange="marr_sta()">



                                                  <option selected="selected">



                                                    <?= $PBI_MARITAL_STA ?>



                                                  </option>



                                                  <option value="Married">Married</option>



                                                  <option value="Unmarried">Unmarried</option>



                                                </select></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong>&nbsp;&nbsp;</strong>Spouse Name</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_SPOUSE" type="text" id="PBI_SPOUSE" value="<?= $PBI_SPOUSE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Office Mobile :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_MOBILE" type="text" id="PBI_MOBILE" value="<?= $PBI_MOBILE ?>" /></td>



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp; Alternative&nbsp;Mobile :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_MOBILE_ALTR" type="text" id="PBI_MOBILE_ALTR" value="<?= $PBI_MOBILE_ALTR ?>" /></td>







                                            </tr>



                                            <tr class="oe_form_group_row">



















                                            </tr>



                                            <td colspan="1" class="oe_form_group_cell">&nbsp;&nbsp;Office E-mail ID:</td>



                                            <td colspan="2" class="oe_form_group_cell"><input name="PBI_EMAIL" type="text" id="PBI_EMAIL" value="<?= $PBI_EMAIL ?>" /></td>



                                            <td bgcolor="#FFFFFF" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; </strong>Alternative Email ID:</td>



                                            <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><input name="PBI_EMAIL_ALT" type="text" id="PBI_EMAIL_ALT" value="<?= $PBI_EMAIL_ALT ?>" /></td>



                                            <tr class="oe_form_group_row">







                                              <td bgcolor="#FFFFFF" colspan="1" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;National ID</span></td>



                                              <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><input name="ESSENTIAL_VOTER_ID" type="text" id="ESSENTIAL_VOTER_ID" value="<?= $ESSENTIAL_VOTER_ID ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Passport No :</span></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="ESSENTIAL_PASSPORT" type="text" id="ESSENTIAL_PASSPORT" value="<?= $ESSENTIAL_PASSPORT ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              
												
												
												<td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp; Birth Certificate No</td>



                                              <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="BIRTH_CERTIFICATE" type="text" id="BIRTH_CERTIFICATE" value="<?= $BIRTH_CERTIFICATE ?>" /></td>
												
										
											


                                              <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Driving License : </span></td>



                                              <td class="oe_form_group_cell"><input name="ESSENTIAL_DRIVING_LICENSE_NO" type="text" id="ESSENTIAL_DRIVING_LICENSE_NO" value="<?= $ESSENTIAL_DRIVING_LICENSE_NO ?>" /></td>
												
											</tr>
											  
											  
											  
											  
											  	
												
											

                                            <tr class="oe_form_group_row">



                                              



                                              <td class="oe_form_group_cell" >&nbsp; User Password</td>



                                              <td class="oe_form_group_cell"><input name="pass" type="text" id="pass" value="<?= $pass ?>" pattern=".{1,}"/></td>



                                            </tr>











                                            <tr class="oe_form_group_row">



                                              <td colspan="5" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                            </tr>











                                            <tr class="oe_form_group_row">



                                              <td colspan="5" bgcolor="#1abb9c" style="text-align:center;font-size:14px; font-weight:bold" class="oe_form_group_cell oe_form_group_cell_label"><strong>:: Family Related Person(Children) :: </strong></td>



                                            </tr>



                                            <?



                                            $ss = 'select * from child_detail where PBI_ID=' . $_SESSION['employee_selected'];



                                            $query = mysql_query($ss);



                                            while ($data = mysql_fetch_object($query)) {







                                            ?>







                                              <tr class="oe_form_group_row">



                                                <td colspan="5" bgcolor="#CCCCCC" class="oe_form_group_cell oe_form_group_cell_label"><strong>:: Children(<?= ++$i ?>) :: </strong></td>



                                              </tr>



                                              <tr class="oe_form_group_row">



                                                <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Full Name :</td>



                                                <td bgcolor="#FFFFFF" colspan="2" class="oe_form_group_cell"><input type="text" name="PBI_1ST_CHILD_NAME" id="PBI_1ST_CHILD_NAME" value="<?= $data->FAMILY_CHILD_NAME ?>" /></td>



                                                <td bgcolor="#FFFFFF" class="oe_form_group_cell">Date of Birth :</td>



                                                <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="FAMILY_CHILD_DOB" type="text" id="FAMILY_CHILD_DOB" value="<?= $data->FAMILY_CHILD_DOB ?>" /></td>



                                              </tr>







                                              <tr class="oe_form_group_row">



                                                <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Birth Place :</td>



                                                <td colspan="2" class="oe_form_group_cell"><input name="child_education" type="text" id="child_education" value="<?= $data->BIRTH_PLACE ?>" /></td>



                                                <td class="oe_form_group_cell">Country of Birth</td>



                                                <td class="oe_form_group_cell"><input name="" type="text" id="" value="<?= $data->COUNTRY_OF_BIRTH ?>" /></td>



                                              </tr>



                                              <tr class="oe_form_group_row">



                                                <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Nationality</td>



                                                <td colspan="2" class="oe_form_group_cell"><input name="child_education" type="text" id="child_education" value="<?= $data->NATIONALITY ?>" /></td>



                                                <td class="oe_form_group_cell">NID/Birth Certificate/Passport No:</td>



                                                <td class="oe_form_group_cell"><input name="child_education" type="text" id="child_education" value="<?= $data->NID_OR_OTHERS ?>" /></td>



                                              </tr>



                                              <tr class="oe_form_group_row">



                                                <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Gender :</td>



                                                <td colspan="2" class="oe_form_group_cell"><select>
                                                    <option><?= $data->FAMILY_CHILD_SEX ?></option>
                                                  </select></td>



                                                <td class="oe_form_group_cell">&nbsp;</td>



                                                <td class="oe_form_group_cell"><a href="?del=<?= $data->FAMILY_D_ID ?>"><input type="button" value="Delete" style="background:red; color:#FFFFFF; width:100px" onclick="if(!confirm('Are You Sure Delete this?')){return false;}" /></a><a href="emp_child_inputt.php?FAMILY_D_ID=<?= $data->FAMILY_D_ID ?>"><input type="button" value="Update" style="background:red; color:#FFFFFF; width:100px" onclick="if(!confirm('Are You Sure Update this?')){return false;}" /></a></td>



                                              </tr>







                                            <? } ?>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" class="oe_form_group_cell oe_form_group_cell_label"><a href="emp_child_inputt.php" target="_self"><input type="button" value="Add New" style="background:green; color:#FFFFFF; width:100px" onclick="if(!confirm('Are You Sure Execute this?')){return false;}" /></a></td>























                                            <tr class="oe_form_group_row">



                                              <td colspan="5" bgcolor="#1abb9c" style="text-align:center;font-size:14px; font-weight:bold" class="oe_form_group_cell oe_form_group_cell_label"><strong>:: Present Address :: </strong></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Village/House No :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_PRESENT_STREET_ADD" type="text" id="PBI_PRESENT_STREET_ADD" value="<?= $PBI_PRESENT_STREET_ADD ?>" /></td>



                                              <td width="23%" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Road/Block/Area/Sector :</span></td>



                                              <td width="31%" class="oe_form_group_cell"><input name="PBI_PRESENT_APRT_ADD" type="text" id="PBI_PRESENT_APRT_ADD" value="<?= $PBI_PRESENT_APRT_ADD ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Post Office:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_POST_OFFICE" type="text" id="PBI_POST_OFFICE" value="<?= $PBI_POST_OFFICE ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">Post Code :</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_POST_CODE" type="text" id="PBI_POST_CODE" value="<?= $PBI_POST_CODE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">District:</td>



                                              <td colspan="2" class="oe_form_group_cell">



                                                <select name="PBI_PRESENT_DIST_ADD" id="PBI_PRESENT_DIST_ADD" onchange="getData2('thana_ajax.php', 'dist', document.getElementById('PBI_PRESENT_DIST_ADD').value)">







                                                  <? foreign_relation('district_thana', 'district', 'district', $PBI_PRESENT_DIST_ADD, ' 1 group by district order by district'); ?>



                                                </select>
                                              </td>



                                              <td class="oe_form_group_cell">Police Station :</td>



                                              <td class="oe_form_group_cell"><span id="dist"><select name="PBI_PRESENT_THANA_ADD" id="PBI_PRESENT_THANA_ADD">





                                                    <option value="<?= $PBI_PRESENT_THANA_ADD ?>"><?= find_a_field('district_thana', 'thana', 'id=' . $PBI_PRESENT_THANA_ADD); ?> </option>



                                                    <? foreign_relation('district_thana', 'id', 'thana', $PBI_PRESENT_THANA_ADD, ' 1 and dist_code="' . $PBI_PRESENT_DIST_ADD . '"  order by thana'); ?>



                                                  </select></span></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" style="text-align:center;font-size:14px; font-weight:bold" bgcolor="#1abb9c" class="oe_form_group_cell oe_form_group_cell_label"><strong>:: Parmanant Address :: </strong></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Village/House No :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_PARM_STREET_ADD" type="text" id="PBI_PARM_STREET_ADD" value="<?= $PBI_PARM_STREET_ADD ?>" /></td>



                                              <td width="23%" class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Road/Block/Area/Sector : </span></td>



                                              <td width="31%" class="oe_form_group_cell"><input name="PBI_PARM_APRT_ADD" type="text" id="PBI_PARM_APRT_ADD" value="<?= $PBI_PARM_APRT_ADD ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Post Office :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PERMA_PBI_POST_OFFICE" type="text" id="PERMA_PBI_POST_OFFICE" value="<?= $PERMA_PBI_POST_OFFICE ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">Postal Code :</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PERMA_PBI_POST_CODE" type="text" id="PERMA_PBI_POST_CODE" value="<?= $PERMA_PBI_POST_CODE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">District:</td>



                                              <td colspan="2" class="oe_form_group_cell"><select name="PBI_PARM_DIST_ADD" id="PBI_PARM_DIST_ADD" onchange="getData2('thana_ajax2.php', 'dist2', document.getElementById('PBI_PARM_DIST_ADD').value)">







                                                  <? foreign_relation('district_thana', 'district', 'district', $PBI_PARM_DIST_ADD, ' 1 group by district order by district'); ?>



                                                </select></td>



                                              <td class="oe_form_group_cell">Police Station :</td>



                                              <td class="oe_form_group_cell"><span id="dist2"><select name="PBI_PARM_THANA_ADD" id="PBI_PARM_THANA_ADD">



                                                    <option value="<?= $PBI_PARM_THANA_ADD ?>"><?= find_a_field('district_thana', 'thana', 'id=' . $PBI_PARM_THANA_ADD); ?> </option>



                                                    <? foreign_relation('district_thana', 'id', 'thana', $PBI_PARM_THANA_ADD, ' 1 and dist_code="' . $PBI_PARM_DIST_ADD . '"  order by thana'); ?>



                                                  </select></span></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" bgcolor="#FFFFFF" class="oe_form_group_cell_label oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr bgcolor="#1abb9c" class="oe_form_group_row">



                                              <td colspan="5" style="text-align:center;font-size:14px; font-weight:bold" class="oe_form_group_cell_label oe_form_group_cell"><strong>:: Emergency Contact :: </strong></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">Full Name <strong>:</strong></td>



                                              <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="EMR_FULL_NAME" type="text" id="EMR_FULL_NAME" value="<?= $EMR_FULL_NAME ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">Relationship <strong><span class="oe_form_group_cell oe_form_group_cell_label">:</span></strong></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="EMR_RELATION" type="text" id="EMR_RELATION" value="<?= $EMR_RELATION ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"> Address :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="EMR_ADDRESS" type="text" id="EMR_ADDRESS" value="<?= $EMR_ADDRESS ?>" /></td>



                                              <td class="oe_form_group_cell">Mobile Number<strong><span class="oe_form_group_cell oe_form_group_cell_label">:</span></strong></td>



                                              <td class="oe_form_group_cell"><input name="EMR_MOBILE" type="text" id="EMR_MOBILE" value="<?= $EMR_MOBILE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label">Email :</td>



                                              <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="EMR_EMAIL" type="text" id="EMR_EMAIL" value="<?= $EMR_EMAIL ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" class="oe_form_group_cell_label oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" style="text-align:center;font-size:14px; font-weight:bold" bgcolor="#1abb9c" class="oe_form_group_cell_label oe_form_group_cell"><strong>:: Tax Information :: </strong></td>



                                            </tr>


											  
											  <tr class="oe_form_group_row">
												  
												  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>TIN No:</td>



                                             <td colspan="2" class="oe_form_group_cell"><input name="ESSENTIAL_TIN_NO" type="text" id="ESSENTIAL_TIN_NO" value="<?= $ESSENTIAL_TIN_NO ?>" /></td>



                                              
												
												
												
												
										



                                              <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Tax Circle: </span></td>



                                              <td class="oe_form_group_cell"><input name="tax_circle" type="text" id="tax_circle" value="<?= $tax_circle ?>" /></td>
												
											</tr>
											  
											  
											  

                                            <tr class="oe_form_group_row">



												<td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;</strong>Tax Zone:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="tax_zone" type="text" id="tax_zone" value="<?= $tax_zone ?>" /></td>
											
												
                                              <?php /*?><td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Bank Name : </td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_BANK" type="text" id="PBI_BANK" value="<?= $PBI_BANK ?>" /></td><?php 



                                              <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Branch:</span></td>



                                              <td class="oe_form_group_cell"><input name="PBI_BANK_BRANCH" type="text" id="PBI_BANK_BRANCH" value="<?= $PBI_BANK_BRANCH ?>" /></td>*/?>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                             <?php /*?> <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Swift Code : </td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_BANK_SWIFT" type="text" id="PBI_BANK_SWIFT" value="<?= $PBI_BANK_SWIFT ?>" /></td>



                                              <td class="oe_form_group_cell"><span class="oe_form_group_cell oe_form_group_cell_label">Account Name: </span></td>



                                              <td class="oe_form_group_cell"><input name="PBI_BANK_ACC_NAME" type="text" id="PBI_BANK_ACC_NAME" value="<?= $PBI_BANK_ACC_NAME ?>" /></td><?php */?>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <?php /*?><td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Account Number : </td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_BANK_ACC_NO" type="text" id="PBI_BANK_ACC_NO" value="<?= $PBI_BANK_ACC_NO ?>" /></td>



                                              <td class="oe_form_group_cell">&nbsp;</td>



                                              <td class="oe_form_group_cell">&nbsp;</td><?php */?>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row" style="text-align:center;font-size:14px; font-weight:bold">



                                              <td colspan="1" bgcolor="#1abb9c" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                              <td colspan="2" bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell"><strong>:: Referance 1 ::</strong></td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Full Name: </td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF1_NAME" type="text" id="PBI_REF1_NAME" value="<?= $PBI_REF1_NAME ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Designation:</td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF1_DESG" type="text" id="PBI_REF1_DESG" value="<?= $PBI_REF1_DESG ?>" /></td>



                                            </tr>







                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Organization:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF1_ORG" type="text" id="PBI_REF1_ORG" value="<?= $PBI_REF1_ORG ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Relationship:</td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF1_RELATION" type="text" id="PBI_REF1_RELATION" value="<?= $PBI_REF1_RELATION ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell_label oe_form_group_cell">Address:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF1_ADDRESS" type="text" id="PBI_REF1_ADDRESS" value="<?= $PBI_REF1_ADDRESS ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Mobile Number: </td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF1_MOBILE" type="text" id="PBI_REF1_MOBILE" value="<?= $PBI_REF1_MOBILE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Email:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF1_EMAIL" type="text" id="PBI_REF1_EMAIL" value="<?= $PBI_REF1_EMAIL ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">
                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row" style="text-align:center;font-size:14px; font-weight:bold">



                                              <td colspan="1" bgcolor="#1abb9c" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                              <td colspan="2" bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell"><strong>:: Referance 2 ::</strong></td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Full Name: </td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF2_NAME" type="text" id="PBI_REF2_NAME" value="<?= $PBI_REF2_NAME ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Designation:</td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF2_DESG" type="text" id="PBI_REF2_DESG" value="<?= $PBI_REF2_DESG ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Organization:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF2_ORG" type="text" id="PBI_REF2_ORG" value="<?= $PBI_REF2_ORG ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Relationship:</td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF2_RELATION" type="text" id="PBI_REF2_RELATION" value="<?= $PBI_REF2_RELATION ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell_label oe_form_group_cell">Address:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF2_ADDRESS" type="text" id="PBI_REF2_ADDRESS" value="<?= $PBI_REF2_ADDRESS ?>" /></td>



                                              <td class="oe_form_group_cell oe_form_group_cell_label">Mobile Number: </td>



                                              <td class="oe_form_group_cell"><input name="PBI_REF2_MOBILE" type="text" id="PBI_REF2_MOBILE" value="<?= $PBI_REF2_MOBILE ?>" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">Email:</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="PBI_REF2_EMAIL" type="text" id="PBI_REF2_EMAIL" value="<?= $PBI_REF2_EMAIL ?>" /></td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#FFFFFF" class="oe_form_group_cell">
                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="5" class="oe_form_group_cell_label oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row" style="text-align:center;font-size:14px; font-weight:bold">



                                              <td colspan="1" bgcolor="#1abb9c" class="oe_form_group_cell_label oe_form_group_cell">&nbsp;</td>



                                              <td colspan="2" bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell"><strong>:: Documentation :: </strong></td>



                                              <td bgcolor="#1abb9c" class="oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell_label oe_form_group_cell">National ID :</td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="nid_pic" type="file" id="nid_pic" accept="image/jpeg" /></td>



                                              <td class="oe_form_group_cell">Passport : </td>



                                              <td class="oe_form_group_cell"><input name="pass_pic" type="file" id="pass_pic" accept="image/jpeg" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">











                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>TIN Picture :</strong></td>



                                              <td colspan="2" class="oe_form_group_cell"><input name="tin_pic" type="file" id="tin_pic" /></td>











                                              <td class="oe_form_group_cell oe_form_group_cell_label"><strong>Staff Picture :</strong></td>



                                              <td class="oe_form_group_cell"><input name="emp_pic" id="emp_pic" type="file" id="emp_pic" /></td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</td>



                                              <td colspan="2" class="oe_form_group_cell">&nbsp;</td>



                                              <td class="oe_form_group_cell_label oe_form_group_cell">&nbsp;</td>



                                              <td class="oe_form_group_cell">&nbsp;</td>



                                            </tr>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" align="center" class="oe_form_group_cell_label oe_form_group_cell"><strong>Employee</strong></td>



                                              <td colspan="2" align="center" class="oe_form_group_cell">TIN</td>







                                              <td align="center" class="oe_form_group_cell oe_form_group_cell_label"><strong>National ID </strong></td>



                                              <td align="center" class="oe_form_group_cell"><strong>Passport</strong></td>



                                            </tr>



                                            <?



                                            //Employee Pic



                                            $imgJPG = "../../pic/staff/" . $_SESSION['employee_selected'] . ".JPG";



                                            $imgjpg = "../../pic/staff/" . $_SESSION['employee_selected'] . ".jpg";



                                            $imgPNG = "../../pic/staff/" . $_SESSION['employee_selected'] . ".PNG";



                                            $imgJPEG = "../../pic/staff/" . $_SESSION['employee_selected'] . ".jpeg";



                                            if (file_exists($imgJPEG)) {



                                              $link = $imgJPEG;
                                            } elseif (file_exists($imgJPG)) {



                                              $link = $imgJPG;
                                            } elseif (file_exists($imgjpg)) {



                                              $link = $imgjpg;
                                            } elseif (file_exists($imgJPEG)) {



                                              $link = $imgJPEG;
                                            }







                                            //Employee Nid



                                            $nidJPG = "../../pic/nid/" . $_SESSION['employee_selected'] . ".JPG";



                                            $nidjpg = "../../pic/nid/" . $_SESSION['employee_selected'] . ".jpg";



                                            $nidPNG = "../../pic/nid/" . $_SESSION['employee_selected'] . ".PNG";



                                            $nidJPEG = "../../pic/nid/" . $_SESSION['employee_selected'] . ".jpeg";



                                            $nidPDF = "../../pic/nid/" . $_SESSION['employee_selected'] . ".pdf";



                                            if (file_exists($nidJPG)) {



                                              $nid_link = $nidJPG;
                                            } elseif (file_exists($nidjpg)) {



                                              $nid_link = $nidjpg;
                                            } elseif (file_exists($nidPNG)) {



                                              $nid_link = $nidPNG;
                                            } elseif (file_exists($nidJPEG)) {



                                              $nid_link = $nidJPEG;
                                            } elseif (file_exists($nidPDF)) {



                                              $nid_link = $nidPDF;
                                            }







                                            //Employee Tin



                                            $tinJPG = "../../pic/tin/" . $_SESSION['employee_selected'] . ".JPG";



                                            $tinjpg = "../../pic/tin/" . $_SESSION['employee_selected'] . ".jpg";



                                            $tinPNG = "../../pic/tin/" . $_SESSION['employee_selected'] . ".PNG";



                                            $tinJPEG = "../../pic/tin/" . $_SESSION['employee_selected'] . ".jpeg";



                                            $tinPDF = "../../pic/tin/" . $_SESSION['employee_selected'] . ".pdf";



                                            if (file_exists($tinJPG)) {



                                              $tin_link = $tinJPG;
                                            } elseif (file_exists($tinjpg)) {



                                              $tin_link = $tinjpg;
                                            } elseif (file_exists($tinPNG)) {



                                              $tin_link = $tinPNG;
                                            } elseif (file_exists($tinJPEG)) {



                                              $tin_link = $tinJPEG;
                                            } elseif (file_exists($tinPDF)) {



                                              $tin_link = $tinPDF;
                                            }







                                            //Employee Passport



                                            $passportJPG = "../../pic/passport/" . $_SESSION['employee_selected'] . ".JPG";



                                            $passportjpg = "../../pic/passport/" . $_SESSION['employee_selected'] . ".jpg";



                                            $passportPNG = "../../pic/passport/" . $_SESSION['employee_selected'] . ".PNG";



                                            $passportJPEG = "../../pic/passport/" . $_SESSION['employee_selected'] . ".jpeg";



                                            $passportPDF = "../../pic/passport/" . $_SESSION['employee_selected'] . ".pdf";



                                            if (file_exists($passportJPG)) {



                                              $passport_link = $passportJPG;
                                            } elseif (file_exists($passportjpg)) {



                                              $passport_link = $passportjpg;
                                            } elseif (file_exists($passportPNG)) {



                                              $passport_link = $passportPNG;
                                            } elseif (file_exists($passportJPEG)) {



                                              $passport_link = $passportJPEG;
                                            } elseif (file_exists($passportPDF)) {



                                              $passport_link = $passportPDF;
                                            }











                                            ?>



                                            <tr class="oe_form_group_row">



                                              <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><a href="<?php echo $link ?>" target="_blank"><img src="<?php echo $link ?>" width="120" height="152" /></a></td>







                                              <td colspan="2" class="oe_form_group_cell oe_form_group_cell_label"><a href="<?= $tin_link ?>" target="_blank"><img src="<?= $tin_link ?>" width="120" height="152" /></a></td>















                                              <td class="oe_form_group_cell oe_form_group_cell_label"><a href="<?= $nid_link ?>" target="_blank"><img src="<?= $nid_link ?>" width="120" height="152" /></a></td>







                                              <td class="oe_form_group_cell oe_form_group_cell_label"><a href="<?= $passport_link ?>" target="_blank"><img src="<?= $passport_link ?>" width="120" height="152" /></a></td>



                                            </tr>



                                          </tbody>



                                        </table>
                                      </td>



                                    </tr>



                                  </tbody>



                                </table>



                                <br>



                                <br>



                                <br>



                                <br>



                                <!--<table width="801" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



            <tbody><tr class="oe_form_group_row">



            <td class="oe_form_group_cell" width="100%"><table width="794" border="0" cellpadding="0" cellspacing="0" class="oe_form_group ">



              <tbody>



                <tr class="oe_form_group_row">



                  <td  width="23%" colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Code :</strong></td>



                  <td  width="23" colspan="2" class="oe_form_group_cell">



                    <input name="<?= $unique ?>" id="<?= $unique ?>" value="<?= $$unique ?>" type="hidden" />



                    <input name="PBI_ID" type="text" id="PBI_ID" value="<?= $PBI_ID ?>"/></td>



                  <td  width="23%" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Organization :</span></strong></td>



                  <td  width="31%" class="oe_form_group_cell"><select name="PBI_ORG">



                    <? foreign_relation('user_group', 'id', 'group_name', $PBI_ORG, ' 1'); ?>



                    </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>



                    <label>&nbsp; Name :</label>



                  </strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_NAME" type="text" id="PBI_NAME" value="<?= $PBI_NAME ?>"/></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Department :</span></strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><select name="PBI_DEPARTMENT">



                    <? foreign_relation('department', 'DEPT_ID', 'DEPT_DESC', $PBI_DEPARTMENT, ' 1 order by DEPT_DESC'); ?>



                    </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Father's Name : </strong></td>



                  <td colspan="2"  class="oe_form_group_cell">



                    



                    <input name="PBI_FATHER_NAME" type="text" id="PBI_FATHER_NAME" value="<?= $PBI_FATHER_NAME ?>"/>                  </td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Section :</span></strong></td>



                  <td  class="oe_form_group_cell"><select name="PBI_DOMAIN">



                    <? foreign_relation('PBI_Section', 'sec_id', 'sec_name', $PBI_PROJECT, ' 1 order by sec_id'); ?>



                  </select></td>



                  </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Mother's Name :</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_MOTHER_NAME" type="text" id="PBI_MOTHER_NAME" value="<?= $PBI_MOTHER_NAME ?>"/></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Region : </span></strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><select name="PBI_BRANCH" id="PBI_BRANCH" onchange="getData2('ajax_zone.php', 'zone', this.value,  this.value)">



                    <? foreign_relation('branch', 'BRANCH_ID', 'BRANCH_NAME', $PBI_BRANCH, ' 1 order by BRANCH_NAME'); ?>



                    </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1"  class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Designation :</strong> 



				  </td>



                  <td colspan="2"  class="oe_form_group_cell"><select name="PBI_DESIGNATION">



                    <? foreign_relation('designation', 'DESG_ID', 'DESG_DESC', $PBI_DESIGNATION, '1 order by DESG_DESC'); ?>



                  </select></td>



                  



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Sub Region : </span></strong></td>



                  <td  class="oe_form_group_cell"><select name="PBI_SUB_REGION" id="PBI_SUB_REGION" onchange="getData2('ajax_zone.php', 'zone', this.value,  this.value)">



                      <? foreign_relation('sub_region', 'SUB_REGION_CODE', 'SUB_REGION_NAME', $PBI_SUB_REGION, ' 1 order by SUB_REGION_NAME'); ?>



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Date of Birth :</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_DOB" type="text" id="PBI_DOB" value="<?= $PBI_DOB ?>"/></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Zone : <br />



                  </span></strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><span id="zone">



                    <select name="PBI_ZONE" id="PBI_ZONE"  onchange="getData2('ajax_area.php', 'area', this.value,  this.value)">



                      <? foreign_relation('zon', 'ZONE_CODE', 'ZONE_NAME', $PBI_ZONE, ' 1 order by ZONE_NAME'); ?>



                    </select>



                  </span></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1"  class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Place of Birth (District) :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><select name="PBI_POB">



                    <option value="<?= $PBI_POB ?>">



                      <?= $PBI_POB ?>



                      </option>



                    <? foreign_relation('district_list', 'district_name', 'district_name', $PBI_POB, ' 1 order by district_name'); ?>



                  </select></td>



                  <td class="oe_form_group_cell" ><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Area : </span></strong></td>



                  <td class="oe_form_group_cell" ><span id="area">



                    <select name="PBI_AREA" id="PBI_AREA">



                      <? foreign_relation('area', 'AREA_CODE', 'AREA_NAME', $PBI_AREA, ' 1 order by AREA_NAME'); ?>



                    </select>



                  </span></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Initial Joining Date :</strong></td>



                  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_DOJ" type="text" id="PBI_DOJ" value="<?= $PBI_DOJ ?>"  onchange="add_date(this.value)"/></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Group : </span></strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><select name="PBI_GROUP" id="PBI_GROUP">



                      <? foreign_relation('product_group', 'group_name', 'group_name', $PBI_GROUP); ?>



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1"  class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Due Confirmation Date :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_DOC" type="text" id="PBI_DOC" value="<?= $PBI_DOC ?>" /></td>



                  <td  class="oe_form_group_cell">&nbsp;</td>



                  <td  class="oe_form_group_cell">&nbsp;</td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" bgcolor="#FFFFFF" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Extended Upto :</strong></td>



                  <td colspan="2" bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="extended_upto" type="text" id="extended_upto" value="<?= $extended_upto ?>" />



                    Days</td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Total Service Length:</span></strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><input name="PBI_SERVICE_LENGTH" type="text" id="PBI_SERVICE_LENGTH" value="<?= $PBI_SERVICE_LENGTH ?>" /></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1"  class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Confirmation Date :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_DOC2" type="text" id="PBI_DOC2" value="<?= $PBI_DOC2 ?>" /></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Edu Qualification :</span></strong></td>



                  <td  class="oe_form_group_cell"><select name="PBI_EDU_QUALIFICATION">



                    <? foreign_relation('edu_qua', 'EDU_QUA_SHORT_NAME', 'EDU_QUA_SHORT_NAME', $PBI_EDU_QUALIFICATION, ' 1 order by EDU_QUA_SHORT_NAME'); ?>



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Joining Date(PP):</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_DOJ_PP" type="text" id="PBI_DOJ_PP" value="<?= $PBI_DOJ_PP ?>" /></td>



                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Service Length (PP) :</span></strong></td>



                  <td class="oe_form_group_cell"><input name="PBI_SERVICE_LENGTH_PP" type="text" id="PBI_SERVICE_LENGTH_PP" value="<?= $PBI_SERVICE_LENGTH_PP ?>" /></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Appointment Letter :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_APPOINTMENT_LETTER_NO" type="text" id="PBI_APPOINTMENT_LETTER_NO" value="<?= $PBI_APPOINTMENT_LETTER_NO ?>" /></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp; Appointment Date :</span></strong></td>



                  <td  class="oe_form_group_cell"><input name="PBI_APPOINTMENT_LETTER_DATE" type="text" id="PBI_APPOINTMENT_LETTER_DATE" value="<?= $PBI_APPOINTMENT_LETTER_DATE ?>" /></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp; Gender :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><select name="PBI_SEX">



                    <option selected><?= $PBI_SEX ?></option>



                    <option>Male</option>



                    <option>Female</option>



                    </select></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Marital Status :</span></strong></td>



                  <td  class="oe_form_group_cell"><select name="PBI_MARITAL_STA">







                    <option selected="selected">



                      <?= $PBI_MARITAL_STA ?>



                      </option>



                    <option>Married</option>



                    <option>Unmarried</option>



                    </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Religion : </strong></td>



                  <td colspan="2" class="oe_form_group_cell"><select name="PBI_RELIGION">



                    <option selected>



                      <?= $PBI_RELIGION ?>



                      </option>



                    <option>Islam</option>



                    <option>Bahai</option>



                    <option>Buddhism</option>



                    <option>Christianity</option>



                    <option>Confucianism </option>



                    <option>Druze</option>



                    <option>Hinduism</option>



                    <option>Jainism</option>



                    <option>Judaism</option>



                    <option>Shinto</option>



                    <option>Sikhism</option>



                    <option>Taoism</option>



                    <option>Zoroastrianism</option>



                    <option>Others</option>



                  </select></td>



                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Nationality : </span></strong></td>



                  <td class="oe_form_group_cell"><select name="PBI_NATIONALITY">



                    <option selected="selected">



                    <?= $PBI_NATIONALITY ?>



                    </option>



                    <option>Bangladeshi</option>



                    <option>Canadian</option>



                    <option>English</option>



                    <option>Indian</option>



                    <option>Pakistani</option>



                    <option>Nepali</option>



                    



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Permanent Add :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_PERMANENT_ADD" type="text" id="PBI_PERMANENT_ADD" value="<?= $PBI_PERMANENT_ADD ?>"/></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Area of expertise :</span></strong></td>



                  <td  class="oe_form_group_cell"><span class="oe_form_field oe_datepicker_root oe_form_field_date">



                    <input name="PBI_SPECIALTY" type="text" id="PBI_SPECIALTY" value="<?= $PBI_SPECIALTY ?>" />



                  </span></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Present Add :</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_PRESENT_ADD" type="text" id="PBI_PRESENT_ADD" value="<?= $PBI_PRESENT_ADD ?>"/></td>



                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span>



                      <span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span>Institutes :</strong></td>



                  <td class="oe_form_group_cell"><select name="institute_id" id="institute_id">



                    <? foreign_relation('institute', 'institute_id', 'institute_name', $institute_id); ?>



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Mobile :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_MOBILE" type="text" id="PBI_MOBILE" value="<?= $PBI_MOBILE ?>"/></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span> <span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span>Present file Status :</strong></td>



                  <td  class="oe_form_group_cell"><select name="personal_file_status" id="personal_file_status">



                    <option selected="selected">



                      <?= $personal_file_status ?>



                      </option>



                      <option></option>



                    <option>Disciplinary Action</option>



                    <option>Separation</option>



                  </select></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Phone :</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="PBI_PHONE" type="text" id="PBI_PHONE" value="<?= $PBI_PHONE ?>" /></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span> <span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;</span>Job Location :</strong></td>



                  <td bgcolor="#FFFFFF" class="oe_form_group_cell">



				  <select name="JOB_LOCATION" id="JOB_LOCATION">



				  <? foreign_relation('warehouse', 'warehouse_name', 'warehouse_name', $JOB_LOCATION, 'use_type!="PL"'); ?>



                  </select>                  </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;E-mail :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><input name="PBI_EMAIL" type="text" id="PBI_EMAIL" value="<?= $PBI_EMAIL ?>" /></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Job Status :</span></strong></td>



                  <td  class="oe_form_group_cell">



                  <select name="PBI_JOB_STATUS">



                    <option <?= ($PBI_JOB_STATUS == 'In Service') ? 'selected' : ''; ?>>In Service</option>



                    <option <?= ($PBI_JOB_STATUS == 'Not In Service') ? 'selected' : ''; ?>>Not In Service</option>



                  </select></td>



                  </tr>



                <tr class="oe_form_group_row">



                  <td colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;National ID :</strong></td>



                  <td colspan="2" class="oe_form_group_cell"><input name="nid" type="text" id="nid" value="<?= $nid ?>" /></td>



                  <td class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Job Status Date :</span></strong></td>



                  <td class="oe_form_group_cell"><input name="JOB_STATUS_DATE" type="text" id="JOB_STATUS_DATE" value="<?= $JOB_STATUS_DATE ?>" /></td>



                </tr>



                <tr class="oe_form_group_row">



                  <td  colspan="1" class="oe_form_group_cell oe_form_group_cell_label"><strong>&nbsp;&nbsp;Initial Job Type :</strong></td>



                  <td colspan="2"  class="oe_form_group_cell"><select name="PBI_PRIMARY_JOB_STATUS">



                    <option selected><?= $PBI_PRIMARY_JOB_STATUS ?></option>



						<option>Permanent</option>



                        <option>Project Staff</option>



						<option>Contract Based</option>



                        <option>Work Based</option>



                        <option>Bigenner</option>



                        <option>Entry Level</option>



						<option>Mid Level</option>



                        <option>Top Level</option>



                        



                  </select></td>



                  <td  class="oe_form_group_cell"><strong><span class="oe_form_group_cell oe_form_group_cell_label">&nbsp;&nbsp;Staff Picture :</span></strong></td>



                  <td  class="oe_form_group_cell"><input type="file" name="pic" id="pic" accept="image/jpeg" /></td>



                </tr>



                </tbody></table> </td>



           </tr></tbody></table>-->



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