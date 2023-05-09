


<?php 
require_once('assets/db/db_connect.php');
include('header.php');

   	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['client_message'];
		$designation=$_POST['client_designation'];
     	$phone=$_POST['phone'];
    	$company=$_POST['client_company'];
		$human = intval($_POST['human']);
		
		$from = 'Enquery From ERP COM BD Contact Form'; 
		$to = "ceo@erp.com.bd,sohorowordy@erp.com.bd,faruk@erp.com.bd,info@erp.com.bd"; 
		//$to = "bimol@erp.com.bd"; 
		$subject = 'Message from Contact ERP Info ';
		
		$body ="From: $name\n E-Mail: $email\n Designation: $designation \n Company: $company \n Phone: $phone \n Address: $address\n Message:\n $message";;
		
		$check=0;
		
    if ($_POST['name']=="") {
			$msg ='Please enter your name';
			$msg .='<br>';
			$check++;
		}
		
		// Check if email has been entered and is valid
		if ($_POST['email']=="" || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		    $msg .='Please enter a valid email';
		    $msg .='<br>';
			$check++;
		}
		
		//Check if message has been entered
		if ($message=="") {
			$msg .='Please enter your message';
			$msg .='<br>';
			$check++;
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$msg .='Your anti-spam is incorrect';
			$msg .='<br>';
			$check++;
		}
		if ($check==0) {
	if (mail ($to, $subject, $body, $from)) {
		echo "<h3 style='color:black'> <strong>Thank You! We will be in touch </strong></h3>";
	} else {
		echo "<h3 style='color:black'><strong>Sorry there was an error sending your message. Please try again later. </strong></h3>";
	}
	
	
	
	 function sms($dest_addr,$sms_text){
	  $msg1 = urlencode($sms_text);
	 $sms_receiver = '01617224424';
$mobileno = $sms_receiver;
$password='BDSMS@512';
$profile_id = 20101483;
$senderid = 'BDSMS';
           $url="http://www.mshastra.com/sendurlcomma.aspx?user='".$profile_id."'&pwd='".$password."'&senderid='".$senderid."'&mobileno='".$mobileno."'&msgtext='".$msg1."'&CountryCode=+880";
           $sms_text="&SMSText=".$sms_text;
           $gsm="&gsm=".$dest_addr;
            $postdata=$url.$sms_text.$gsm;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
}
            
		 
			$recipients=8801617224424;
			
			$massage  = "Enquery From ERP COM BD Contact Form \r\n ";
			$massage.="Name : ".$name.", \r\n";
			$massage.="Designation : ".$designation.", \r\n";
			$massage.="Company : ".$company.", \r\n";
			$massage.="E-Mail : ".$email." , \r\n";
			$massage.="Phone : ".$phone." , \r\n";
			$massage.="Message : ".$message.". \r\n";
            $sms_result=sms($recipients,$massage); 
			
			
$conn    = Connect();
$client_name    = $conn->real_escape_string($name);
$client_email   = $conn->real_escape_string($_POST['email']);
$client_designation = $conn->real_escape_string($_POST['client_designation']);
$client_message = $conn->real_escape_string($_POST['client_message']);
$client_phone = $conn->real_escape_string($_POST['phone']);
$client_company = $conn->real_escape_string($_POST['client_company']);

 $query   = "INSERT into contact_page (`client_name`, `client_designation`, `client_company`, `client_address`, `client_phone`, `client_message`, `client_email`) VALUES('" . strip_tags($client_name) . "','" . strip_tags($client_designation) . "','" . strip_tags($client_company) . "','" . strip_tags($client_address). "','".strip_tags($client_phone)."','".strip_tags($client_message)."','".strip_tags($client_email)." ')";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}
		
		$conn->close();
   }else{
       
       $msg = 'Thank You! We will be in touch';
   }
   
   
	
    }  
?>


<!--==============================
    Breadcumb
============================== -->
<div data-bg-src="assets/img/breadcumb/contact.png">
    <div class="breadcumb-wrapper">
        <div class="container z-index-common">
            <div class=" container breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1> 
                <div class="breadcumb-menu-wrap">
                    <ul class=" breadcumb-menu">
                        <li><a href="index.php">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

	
	
	<!--==============================
    Appointment Area  
    ==============================-->
    <section data-bg-src="assets/img/bg/process-bg-2-1.jpg">
        <div class="container py-3 pt-5">
            <div class="row gx-60">
                <div class="col-xl-6 align-self-center space  wow fadeInUp" data-wow-delay="0.2s">
                    <span class="sec-subtitle text-primary">Make An Appointment</span>
                    <h2 class="sec-title3 h1">We Provide Best ERP Solution</h2>
                    <hr class="hr-style1">
                    <p>
                        ERP.COM.BD BANGLADESH Software solution to enhance our client overall operation process efficiency
                        & accountability. In view of the overall analysis ERP.COM.BD has envisioned the following modular
                        Institute Management level solution pack to streamline their operational activities Development
                        of a Cloud based aspects of operations. Compact financial accounting, warehouse, administration,
                        human resource, payroll and each section with single synchronized cloud based CES system. Training
                        and support for all kinds of requirement of the CES software.

                    </p>

                    <p>
                        If you thinking about ERP, have any question or inquery you can talk to one of our experts.
                        ERP.COM.BD provide 24/7 support for your business. Feel free to consult with our experts.
                    </p>

                    <div class="row gy-30">
                        <div class="col-md-6">
                            <div class="contact-media">
                                <div class="contact-media__icon"><i class="fal fa-phone-alt"></i></div>
                                <div class="media-body">
                                    <span class="contact-media__info  text-primary">24/7 Call Available</span>
                                    <p class="contact-media__info " style="font-weight:600"><a href="tel:+880 1815224424">+880 1815224424</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-media">
                                <div class="contact-media__icon"><i class="fal fa-envelope"></i></div>
                                <div class="media-body">
                                    <span class="contact-media__info  text-primary">Write a Quick mail</span>
                                    <p class="contact-media__info " style="font-weight:600"><a href="mailto:ceo@erp.com.bd">ceo@erp.com.bd</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-media">
                                <div class="contact-media__icon"><i class="fal fa-map-marker-alt"></i></div>
                                <div class="media-body">
                                    <span class="contact-media__info  text-primary">Visite Head Office</span>
                                    <p class="contact-media__info " style="font-weight:600">Plot-985, Road-16, Avenue-02, Mirpur DOHS, Dhaka-1216</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-media">
                                <div class="contact-media__icon"><i class="fal fa-map-marker-alt"></i></div>
                                <div class="media-body">
                                    <span class="contact-media__info  text-primary">Visite Farmgate Office</span>
                                    <p class="contact-media__info " style="font-weight:600">Sazan point(level 5th) 2, indira road, farmgate, Dhaka</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
				<div class="col-xl-6 form-wrap1 pt-5">
                    <form action="" method="post" class="form-style2" enctype="multipart/form-data">
                        <h2 class="form-title h4">Make An Appointment</h2>
                        <?php if($msg!=''){?>
                        <h3 class="form-title h4"><?=$msg?></h3>
                        <? } ?>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input type="text" name="client_designation" placeholder="Designation">
                        </div>
                        <div class="form-group">
                            <input type="text" name="client_company" placeholder="Company">
                        </div>
                        
                        <div class="form-group">
                            <textarea name="client_message" placeholder="Write a short message..."></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="human" placeholder="Enter 5 For Human Verify">
                        </div>
                        <div class="form-btn">
                            <button class="vs-btn style5" type="submit" name="submit" id="submit">SUBMIT REQUEST<i class="far fa-arrow-right"></i></button>
                        </div>
                        
                    </form>
                </div>
				
				
            </div>
        </div>
    </section>



    <!-- ==============================
         Our Branches Area
     ============================== -->
    <section class=" space-top space-extra-bottom bg-white">
        <div class="container">
            <div class="title-area text-center">
                <!--              <span class="sec-subtitle">Great Team Members</span>-->
                <h2 class="sec-title3 h1">Our Branches list</h2>
            </div>

            <div class="nav contact-tab-menu" id="nav-contactTab" role="tablist">
                <button class="nav-link cssg" id="nav-GermanyAddress-tab" data-bs-toggle="tab" data-bs-target="#nav-GermanyAddress" type="button" role="tab" aria-controls="nav-GermanyAddress" aria-selected="true">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">Head Office</span>
                    <span class="btn-text">Plot-985, Road-16, Avenue-02, Mirpur DOHS, Dhaka-1216, Bangladesh</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel:+880 1815224424">+880 1815224424</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:ceo@erp.com.bd">ceo@erp.com.bd</a></span>

                </button>
                <button class="nav-link cssg" id="nav-AustraliaAddress-tab" data-bs-toggle="tab" data-bs-target="#nav-AustraliaAddress" type="button" role="tab" aria-controls="nav-AustraliaAddress" aria-selected="false">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">Farmgate</span>
                    <span class="btn-text">Sazan Point(level 5th) 2 Indira Road, Farmgate, Dhaka ,Bangladesh</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel:+880 1617224424">+880 1617224424</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:ceo@erp.com.bd">ceo@erp.com.bd</a></span>
                </button>

                <button class="nav-link cssg" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">Chittagong</span>
                    <span class="btn-text">Karnafuly Tower 63, S,S, Khaled Road, West Askordighi, Chittagong</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel:+880 1815224424">+880 1815224424</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:ceo@erp.com.bd">ceo@erp.com.bd</a></span>
                </button>


            </div>

            <div class="nav contact-tab-menu" id="nav-contactTab" role="tablist">

                <button class="nav-link cssg" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">Sylhet</span>
                    <span class="btn-text">RB Complex (2nd floor). East Zindabazar, Sylhet-3100, Bangladesh</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel:+880 1815224424">+880 1815224424</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:ceo@erp.com.bd">ceo@erp.com.bd</a></span>
                </button>


                <button class="nav-link cssg" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">Malaysia</span>
                    <span class="btn-text">G-21,Maxim Citylights, No:25, Jalan Sentul Pardana Sentul 51000, Wp, Kuala lumpur, Malaysia</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel: +966507846581"> +966507846581</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:country.director.my@erp.com.bd">country.director.my@erp.com.bd</a></span>
                </button>



                <button class="nav-link cssg" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
<!--                    <span class="btn-img"><img src="assets/img/contact/ERP-New-logo.png" alt="contact"></span>-->
                    <span class="btn-title">KAS</span>
                    <span class="btn-text">P.O.Box 11515, As Shathi Dist, Jaddah 21463,KSA.</span>
                    <br>
                    <span class="btn-text ps-2"><i class="fal fa-phone-alt"></i> <a href="tel: +966507846581"> +966507846581</a></span>
                    <span class="btn-text ps-2"><i class="fal fa-envelope"></i> <a href="mailto:country.director.my@erp.com.bd">country.director.my@erp.com.bd</a></span>
                </button>


            </div>

        </div>
    </section>









<?php include('footer.php');?>