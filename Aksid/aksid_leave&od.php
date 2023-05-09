<!DOCTYPE html>

<html lang="en">

<head>

<title>AKSID Leave Module</title>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->

<link rel="icon" type="image/png" href="log_panel/images/icons/favicon.ico"/>

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/bootstrap/css/bootstrap.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/animate/animate.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/css-hamburgers/hamburgers.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/animsition/css/animsition.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/select2/select2.min.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/vendor/daterangepicker/daterangepicker.css">

<!--===============================================================================================-->

<link rel="stylesheet" type="text/css" href="log_panel/css/util.css">

<link rel="stylesheet" type="text/css" href="log_panel/css/main.css">

<!--===============================================================================================-->

<?php



session_start();//@mysql_connect('localhost','aksiderp_dash','clouderppassword224424');



//mysql_select_db('aksiderp_dbacc');



require_once("../../config/default_values.php");



require_once('../../config/db_connect_scb_main.php');

if(isset($_POST['ibssignin']))



{



	



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



	if($proj=@mysql_fetch_object($sql))



	{



					$_SESSION['proj_id']	= $proj->cid;



					$_SESSION['db_name']	= $proj->db_name;



					$_SESSION['db_user']	= $proj->db_user;



					$_SESSION['db_pass']	= $proj->db_pass;



					



require_once "../../config/db_connect.php";		



$user_sql="select * from personnel_basic_info where PBI_CODE='".$uid."' AND pass = '".$passward."' and PBI_JOB_STATUS='In Service'";



		



				$user_query=mysql_query($user_sql);



				if(mysql_num_rows($user_query)>0)



				{



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

<style>





</style>

<script>





    window.location.assign("../inventory/home.php")





</script>

<?



					



				}else{

				$msg= '<span style="color:red; font-weight:bold;">Sorry! Invalid Information</span>';

				}



		}





}



else{



session_destroy();

}



?>

<? $sq = 'select note from welcome_note where id=1';



$qr = mysql_query($sq);





$dt = mysql_fetch_object($qr);



?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?



	  $select2 = 'select * from welcome_images where 1 and status="PUBLISHED" ';



   $qr2 = mysql_query($select2);



   $image = mysql_fetch_object($qr2);





	?>

</head>

<body style="background-color: #666666;">

<div class="limiter">

<div class="container-login100">

<div class="wrap-login100">

  <form action="" method="post" class="login100-form validate-form">

    <span class="login100-form-title p-b-43">

    <tr>

      <td>&nbsp;</td>

    </tr>

    </span> <span class="login100-form-title p-b-43">

    <tr>

      <td>&nbsp;</td>

    </tr>

    </span>

    <div class="flex-sb-m w-full p-t-3 p-b-32"> <span class="">

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      </span> </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32"> <span class="">

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      </span> </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32"> </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32"> </div>

    <?=$msg?>

      <input class="input100" type="hidden" style="color:#000000" placeholder="Company Name" name="cid" value="aksid">

     

    <div class="wrap-input100 validate-input" data-validate="ID NO is required">

      <input class="input100" style="color:#000000" name="uid" placeholder="ID No" type="text" >

      <input type="hidden"  name="ibssignin"   />

      <span class="focus-input100"></span> <span class="label-input100"></span> </div>

    <div class="wrap-input100 validate-input" data-validate="Password is required">

      <input class="input100" type="password" style="color:#000000" placeholder="Password"  name="pass">

      <span class="focus-input100"></span> <span class="label-input100"></span> </div>

    <div class="container-login100-form-btn">

      <button name="submit" class="login100-form-btn"> Login </button>

    </div>

    <br>

    <div class="login100-form-social flex-c-m">

      <!--	<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">







							<i class="fa fa-facebook-f" aria-hidden="true"></i>







						</a>-->

      <a href="log.php" target="_blank" class="login100-form-social-item flex-c-m bg2 m-r-5"> <i class="fa fa-gear fa-spin" style="color:red; font-size:15px"></i> </a> </div>

  </form>

  <div class="login100-more" style="background-image: url('<?php echo $image->att_file;?>');">

    <div class="container">

      <div class="row">

        <div class="col-md-12" style="height:0px">

          <?php







 if($dt->note !=''){



?>

          <marquee width="81%" style="font-family:bankgothic;color: #666666; font-weight:bold; font-size:18px" direction="left" height="100px">

          <?=$dt->note;?>

          </marquee>

          <?php } ?>

        </div>

		

		

		

		

		

        <!--<div class="col-md-1"></div>-->

		

		

		

        <div class="col-md-2">

        <div class="dropdown" style="margin-top:80px; float: left; padding-left:60px">

        <button class="btn btn-default dropdown-toggle"type="button" style="background-color:#395954; width:160px; color:#FFFFFF" data-toggle="dropdown" data-hover="dropdown" data-animations="bounceInRight fadeInLeft fadeInUp fadeInRight" onClick="myfunction()"> POLICY</span> </button>

            <div style="display:none;" id="show">

              <div class="dropdown-content">

                <?

$select2 = 'select * from policy where 1 and type="policy" order by file_name asc';

$qr2 = mysql_query($select2);

while($data2 = mysql_fetch_object($qr2)){

?>

          <a href="<?php echo $data2->att_file?>" class="btn btn-warning" style="width:160px; font-size:10px; color:black;" target="_blank">

                <?=$data2->file_name?>

                </a><br>

                <? } ?>

              </div>

            </div>

          </div>

        </div>

		

		

		

        <div class="col-md-2">

          <div class="dropdown" style="margin-top:80px; float: left; padding-left:50px;">

            <button class="btn btn-default dropdown-toggle"type="button" style="background-color:#395954; color:#FFFFFF" data-toggle="dropdown" data-hover="dropdown" data-animations="bounceInRight fadeInLeft fadeInUp fadeInRight" onClick="myfunction2()"> NOTICE BOARD</span> </button>

            <div style="display:none;" id="show1">

              <div class="dropdown-content" align="center">

                <?

$select2 = 'select * from policy where 1 and type="notice" order by file_name asc';

$qr2 = mysql_query($select2);

while($data2 = mysql_fetch_object($qr2)){



?>

                <a href="<?php echo $data2->att_file?>" class="btn btn-warning" style="width:143px; font-size:10px; color:black;" target="_blank">

                <?=$data2->file_name?>

                </a><br>

                <? } ?>

              </div>

            </div>

          </div>

        </div>

		

		

		

		

        <div class="col-md-2">

          <div class="dropdown" style="margin-top:80px; float: left; padding-left:40px">

            <button class="btn btn-default dropdown-toggle"type="button" style="background-color:#395954; color:#FFFFFF" data-toggle="dropdown" data-hover="dropdown" data-animations="bounceInRight fadeInLeft fadeInUp fadeInRight" onClick="myfunction3()"> <span style="padding:50px 38px 50px 38px">FORMS</span> </span> </button>

            <div style="display:none;" id="show2">

              <div class="dropdown-content" align="center">

                <?

$select2 = 'select * from policy where 1 and type="form" order by file_name asc';

$qr2 = mysql_query($select2);

while($data2 = mysql_fetch_object($qr2)){



?>

                <a href="<?php echo $data2->att_file?>" class="btn btn-warning" style="width:163px; font-size:10px; color:black;" target="_blank">

                <?=$data2->file_name?>

                </a><br>

                <?php } ?>

              </div>

            </div>

          </div>

        </div>

		

		

		

		

		

		 <div class="col-md-2">

          <div class="dropdown" style="margin-top:80px; float: left; padding-left:40px">

          <button class="btn btn-default dropdown-toggle"type="button" style="background-color:#395954; color:#FFFFFF" data-toggle="dropdown" data-hover="dropdown" data-animations="bounceInRight fadeInLeft fadeInUp fadeInRight" onClick="myfunction4()"> <span style="padding:42px 0px 39px 7px">FRINGE BENEFITS</span> </span> </button>

            <div style="display:none;" id="show3">

              <div class="dropdown-content" align="center">

                <?

$select2 = 'select * from policy where 1 and type="fringe_benefits" order by file_name asc';

$qr2 = mysql_query($select2);

while($data2 = mysql_fetch_object($qr2)){



?>

                <a href="<?php echo $data2->att_file?>" class="btn btn-warning" style="width:170px; font-size:10px; color:black;" target="_blank">

                <?=$data2->file_name?>

                </a><br>

                <?php } ?>

              </div>

            </div>

          </div>

        </div>

		

		

		

		

		

		

      </div>

    </div>

  </div>

</div>

<script>



function myfunction() {



  var x = document.getElementById("show");



  if (x.style.display === "none") {



    x.style.display = "";



  }else{



     x.style.display = "none";



  }



  





}



function myfunction2() {

var x = document.getElementById("show1");

if (x.style.display === "none") {

x.style.display = "";

}else{

x.style.display = "none";



}}









function myfunction3() {



var x = document.getElementById("show2");

if (x.style.display === "none") {x.style.display = "";

}else{

x.style.display = "none";

}}







function myfunction4() {



var x = document.getElementById("show3");

if (x.style.display === "none") {x.style.display = "";

}else{

x.style.display = "none";

}}



</script>

<!--===============================================================================================-->

<script src="log_panel/vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->

<script src="log_panel/vendor/animsition/js/animsition.min.js"></script>

<!--===============================================================================================-->

<script src="log_panel/vendor/bootstrap/js/popper.js"></script>

<script src="log_panel/vendor/bootstrap/js/bootstrap.min.js"></script>

<!--===============================================================================================-->

<script src="log_panel/vendor/select2/select2.min.js"></script>

<!--===============================================================================================-->

<script src="log_panel/vendor/daterangepicker/moment.min.js"></script>

<script src="log_panel/vendor/daterangepicker/daterangepicker.js"></script>

<!--===============================================================================================-->

<script src="log_panel/vendor/countdowntime/countdowntime.js"></script>

<!--===============================================================================================-->

<script src="log_panel/js/main.js"></script>

</body>

</html>

