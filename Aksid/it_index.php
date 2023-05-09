<?php /*?><?php

session_start();
require_once("../../config/default_values.php");
require_once('../../config/db_connect_scb_main.php');

if(isset($_POST['ibssignin'])){

	$uid  = $_POST['uid'];

	$passward = $_POST['pass'];

	if($_POST['uid']==$_POST['pass']){

	$uid=(int)$uid;

	$passward=(int)$passward;

	}else{

	$uid=(int)$uid;

	}

	$cid  = $_POST['cid'];

	$sql="SELECT b.db_user,b.db_pass,b.db_name,a.cid,a.id FROM company_info a,database_info b WHERE a.cid='$cid' and a.id=b.company_id and a.status='ON' limit 1";

	$sql=@mysql_query($sql);

	if($proj=@mysql_fetch_object($sql)){

					$_SESSION['proj_id']	= $proj->cid;

					$_SESSION['db_name']	= $proj->db_name;

					$_SESSION['db_user']	= $proj->db_user;

					$_SESSION['db_pass']	= $proj->db_pass;

		require_once "../../config/db_connect.php";		

		$user_sql="select * from personnel_basic_info where  PBI_ID='$uid' AND pass = '$passward' and PBI_JOB_STATUS='In Service'";

				$user_query=mysql_query($user_sql);

				if(mysql_num_rows($user_query)>0){

				$proj_sql="select * from project_info limit 1";

				$proj=@mysql_fetch_object(mysql_query($proj_sql));

				$info=@mysql_fetch_row($user_query);


					$_SESSION['user']['level']	= 1;

					$_SESSION['user']['id']	= $_SESSION['employee_selected'] = $info[0];

					$_SESSION['user']['fname']	= $info[4];

					$_SESSION['separator']='';

					$_SESSION['mhafuz']='Active';

					$_SESSION['voucher_type']=3;

					$_SESSION['user']['panel']='YES';

					//add_user_activity_log($_SESSION['user']['id'],1,1,'Login Page','Succ4essfully Logged In',$_SESSION['user']['level']);
	?>
	
	<?
				}
		}
}
else
session_destroy();
?>




	<?
 	$sq = 'select note from welcome_note where id=1';
	$qr = mysql_query($sq);
	$dt = mysql_fetch_object($qr);
	?>
	
	<?
	$select2 = 'select * from welcome_images where 1 and status="PUBLISHED" ';
	$qr2 = mysql_query($select2);
   	$image = mysql_fetch_object($qr2);
	?><?php */?>

<?php 

session_start();

ob_start();

require_once "../../../engine/configure/default_values.php";

require_once "../../../engine/configure/check_login.php";

$project = PROJECT;

if(isset($_POST['ibssignin']))

{

	$passward 	= $_POST['pass'];

	$uid  		= $_POST['uid'];

	$cid  		= $_POST['cid'];

if(check_for_login($cid,$uid,$passward,1)){

if($_SESSION['user']['level']==5||$_SESSION['user']['level']==3 || $_SESSION['user']['level']==4 )

header("Location:home.php");}

}else session_destroy();

?>



<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from storage.googleapis.com/themevessel-products/logdy/main/login-7.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Mar 2020 06:15:14 GMT -->
<head>
    <!-- Google Tag Manager -->
  
    <!-- End Google Tag Manager -->
    <title>IT MODULE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">
	
	
	<style>
  .bg {
    background-image: url('it_mod.png');
    background-size: cover;
    height: 100vh;
  }

  @media only screen and (min-width: 768px) {
    .bg {
      background-image: url('it_mod.png');
    }
  }
  
  
  
    .bg-login {
    background-image: url('it_login.jpg');
    background-size: cover;
    height: 100vh;
  }

  @media only screen and (min-width: 768px) {
    .bg-login {
      background-image: url('it_login.jpg');
    }
  }
		
@media only screen and (max-width: 767px) {
  .bg-login {
    background-color: transparent;
  }
}
  
</style>

</head>
<body id="top">

<div class="page_loader"></div>

<!-- Login 7 start -->
<div class="login-7 tab-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-12 col-pad-0 bg none-992">
                
                <div class="informeson">
                    <h3></h3>
                    <p></p>
                
                </div>
                <div class="social-box">
                    
                </div>
            </div>
			
			
            <div class="col-xl-4 col-lg-5 col-md-12 col-pad-0 bg-color-7 bg-login">
                <div class="login-inner-form">
                    <div class="details">
                        
                        <h3></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<h3></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<h3></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
						<h3></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
				
			
						
                        <form action="" method="post">
						
                            <div class="form-group">
                                <input type="hidden" name="cid" class="input-text" value="aksid" placeholder="Company Name">
                            </div>
							
							  <div class="form-group">
                                <input type="text" name="uid" class="input-text" placeholder="User Name">
                            </div>
							
                            <div class="form-group">
                                <input type="password" name="pass" class="input-text" placeholder="Password">
                            </div>
							
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" name="ibssignin" id="ibssignin" class="btn btn-primary btn-lg ">Login</button>
									
								
									
                                </div>
                                
                            </div>
							
						
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 7 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-2.2.0.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Custom JS Script -->

</body>

<!-- Mirrored from storage.googleapis.com/themevessel-products/logdy/main/login-7.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Mar 2020 06:15:24 GMT -->
</html>