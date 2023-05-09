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
    <title>CM MODULE</title>
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
    background-image: url('cm_mod.jpg');
    background-size: cover;
    height: 100vh;
  }

  @media only screen and (min-width: 768px) {
    .bg {
      background-image: url('cm_mod.jpg');
    }
  }
  
  
  
    .bg-login {
    background-image: url('cm_login.jpg');
    background-size: cover;
    height: 100vh;
  }

  @media only screen and (min-width: 768px) {
    .bg-login {
      background-image: url('cm_login.jpg');
    }
  }
  
		

	@media only screen and (max-width: 767px) {
    .bg-login {
            background-color: rgb(0 0 0 / 20%);
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


</html>




<?php /*?>
<!DOCTYPE html>

<html style="height: 100%">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        

        <title>ERP</title>

		<link rel="icon" type="image/png" sizes="16x16" href="favicon-32x32.png">

        

        

        

        

    

<link rel="stylesheet" type="text/css" href="index.css" media="all">



<script>

(function titleScroller(text) {

    document.title = text;

    setTimeout(function () {

        titleScroller(text.substr(1) + text.substr(0, 1));

    }, 500);

}("|| ERP.COM.BD || PROJECT MANAGEMENT "));



</script>

</head>

<body>

<img style="position:fixed; bottom: 10px; left: 10px; z-index: 10;" src="http://erp.com.bd/web/images/icn/logo.png">

<div class="openerp openerp_webclient_container">

    <table class="oe_webclient">

        <tbody><tr style="display: none;">

            <td class="oe_topbar" colspan="2">

                <div class="oe_menu_placeholder"></div>

                <div class="oe_user_menu_placeholder"></div>

                <div class="oe_systray"></div>

            </td>

        </tr>

        <tr>

            <td style="display: none;" class="oe_leftbar" valign="top">&nbsp;</td>

            <td class="oe_application">

            <div><div class="oe_enterprise oe_login_signup">

            

            <div class="oe_enterprise_content">

                <div class="oe_enterprise_background_header"></div>

                <div class="oe_login_pane oe_enterprise_pane">

                    <form action="" method="post">

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                            <h2>Inventory Sign In</h2>

                        </div>

                        <div style="opacity: 1; display: block;" class="oe_enterprise_signup">

                            <h2><?=$project?> Project Management</h2>

                        </div>

                        <div class="oe_login_error_message oe_enterprise_error_message"></div>



                        

                        <p>Please provide access information to enter in.</p>

                        <div style="display: none;" class="oe_login_dbpane">

                            <fieldset>

                                <label>Database</label>

                                

   



                            </fieldset>

                        </div>

                      <fieldset>

                          <label>Your Company ID</label>

                          <input autofocus="autofocus" class="oe_enterprise_login_input" name="cid" value="" type="text" width="95%">

                        </fieldset>

                        <fieldset>

                          <label>Your Email Address</label>

                          <input autofocus="autofocus" class="oe_enterprise_login_input" name="uid" value="" type="text" width="95%">

                          <input autofocus="autofocus" class="oe_enterprise_login_input" name="ibssignin" value="" type="hidden" width="95%">

                        </fieldset>

                        <div style="opacity: 0; display: none;" class="oe_enterprise_signin">

                        <div style="display: block;" class="oe_enterprise_checker_message">An account with this email address already exists.</div>

                      </div>



                      <div style="opacity: 1; display: block;" class="oe_enterprise_signup"></div>

                        <fieldset>

                          <label>Your Password</label>

                          <input name="pass" value="" type="password" width="95%">

                          <div style="opacity: 0; display: none;" class="oe_enterprise_signin"> <span class="contextual_message"> <a style="display: inline;" class="oe_signup_reset_password" href="#">Forgotten your password?</a> </span> </div>

                        </fieldset>

                        <div style="opacity: 1; display: block;" class="oe_enterprise_signup">

                          <fieldset class="oe_enterprise_submit"> 

						  <a href="../../../"><img src="images.png" height="50"></a>                                

                            <button name="submit">Sign In</button>

							

                          </fieldset>

						  

						  

                      </div>

                        

                    </form>

                </div>

            </div>

        </div></div></td>

        </tr>

    </tbody></table>

<div class="oe_notification ui-notify"></div><div style="display: none;" class="oe_loading">Loading</div></div></body>

</html><?php */?>

