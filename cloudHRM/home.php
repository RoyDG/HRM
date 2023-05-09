<?php
    session_start();
    require_once "../../../assets/support/inc.all.php";
    $cid = explode('.', $_SERVER['HTTP_HOST'])[0];
?>

<!DOCTYPE html>
<html class="no-js no-touch no-touch">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Clouderp Demo Concern||ERP Software</title>

    <!-- <script src="../../../home/files/ga.js" async="" type="text/javascript"></script>-->
    <script src="../../../home/files/jquery-1.js"></script>

    <link href="../../../home/files/stylesheet.css" rel="stylesheet" type="text/css">
    <link href="../../../home/files/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../home/files/normalize.css">
    <link rel="stylesheet" href="../../../home/files/common.css">
    <link rel="stylesheet" href="../../../home/files/website.css">
    <link rel="stylesheet" href="../../../home/files/font-awesome.css">

</head>

<style>
    .oe_slide.oe_website_builder_slide {
        background-color: #f0f0f0;
        background: url(../../../files/front_img3.png) !important;
        color: #404040;
    }

    .oe_slide.oe_home_slide {
        background-color: #f0f0f0;
        background: url(../../../files/front_img1.png) !important;
        color: #404040;
    }

    .download_text {
        font-size: 16px !important;
        font-weight: 600 !important;
        margin-bottom: 5px;
    }

    .download_a {
        padding: 28px 16px;
    }

    .download_apk {
        width: 100%;
        background: #39991a;
        color: white;
        font-weight: bold;
        padding: 5px 5px;
        border: 1px solid #39991a;
    }
</style>

<body class="oe_styling_v8">
    <div class="oe_website_contents">
        <header class="oe_website_header">
            <div class="oe_row oe_fit">

                <div align="left" style="float:left">
                    <?
                        $cloud_logo = "../../../logo/clouderplogo.png";
                        $project_logo = "../../../logo/" . $cid . ".png";
                        if (is_file($project_logo)) {
                            $show_logo = $project_logo;
                        } else {
                            $show_logo = $cloud_logo;
                        }
                    ?>
                    <img src="<?= $show_logo ?>" width="100%" height="100px">
                </div>

                <div align="right" style="float:right">
                    <img src="../../../logo/erp1.png" width="80%">
                </div>

            </div>
        </header>
    <? 
/*>  
<section class="oe_hero oe_home_hero oe_container">
    <div class="oe_slider">
       <!--<div class='oe_slide oe_indiegogo_pos_campaign'>
            <div class='oe_row'>
                <div class='oe_titlebox'>
                    <div class='oe_title oe_title_font'>Affordable POS Hardware?</div>
                     <div class='oe_subtitle'>Support our Campaign for an Affordable POS Hardware Kit<br /><a class='oe_button' href='http://www.indiegogo.com/projects/opensource-your-shop/x/5121155'>More Info</a></div>
                </div>
            </div>
        </div> -->
        <a href="../../../files/slide3.png"><div class="oe_slide oe_website_builder_slide">
            <!--<div class="oe_row">
                <div class="oe_slide_title oe_title_font"><span class="oe_erp">ERP</span><span class="oe_version">.COM.BD</span></div>
                <div class="oe_slide_subtitle">
                  World Class Manufacturing ERP <br> Live, Cloud Office from ANYWHERE<br>
                    <a href="http://erp.com.bd/" class="oe_button oe_medium oe_tacky ab_banner_freetrial"     >Discover <span class="oe_emph">now</span> <i class="icon-arrow-right"></i></a>
                </div>
            </div>-->
        </div></a>
        <a href="../../../files/slide4.png"    ><div class="oe_slide oe_home_slide oe_invisible">
            <!--<div class="oe_row">
                <div class="oe_slide_title oe_title_font"><span class="oe_version">v3.01</span><span class="oe_erp">&nbsp;ERP.COM.BD</span></div>
                <div class="oe_slide_subtitle">
                    Warehouse, Sales, Purchase, HRM, MIS,<br>
					Production on Online &amp; Mobile LIVE<br>
                    <a href="#" class="oe_button oe_medium oe_tacky ab_banner_freetrial"    >Welcome at <span class="oe_emph">ERP.COM.BD&nbsp;</span><i class="icon-arrow-right"></i></a>
                </div>
            </div>-->
        </div></a>
    </div>
    <span class="oe_slider_arrow oe_left"><i class="icon-chevron-left"></i></span>
    <span class="oe_slider_arrow oe_right"><i class="icon-chevron-right"></i></span>
    <script> 
        $(function(){
            var cur_slide = 0;
            var slides = $('.oe_hero .oe_slider .oe_slide');
            var slide_interval = null;
            slides.each(function(index){
                if(index === cur_slide){
                    $(this).removeClass('oe_invisible');
                }else{
                    $(this).addClass('oe_invisible');
                }
            });
            function show_slide(index){
                index = index % slides.length;
                index = index < 0 ? slides.length + index : index;
                var $cur = $(slides.get(cur_slide));
                var $nxt = $(slides.get(index));
                $nxt.removeClass('oe_invisible');
                if(cur_slide !== index){
                    $cur.addClass('oe_invisible');
                }
                cur_slide = index;
                slideshow();
            }
            $('.oe_slider_arrow.oe_left').click(function(){
                show_slide(cur_slide-1);
            });
            $('.oe_slider_arrow.oe_right').click(function(){
                show_slide(cur_slide+1);
            });
            // (re)starts the slideshow with 10000 secs between slides 
            function slideshow(){
                clearInterval(slide_interval);
                slide_interval = setInterval(function(){
                    show_slide(cur_slide+1);
                },10000);
            }
            // prevent the slide to disappear just as the user wants to click it
            $('.oe_slider').mouseover(function(){ slideshow(); });
            slideshow();
        });
    </script>
</section>
<*/ 
?>

        <article class="oe_page">
            <section class="oe_container">
                <h4 class="oe_slogan">Choose Your Department</h4>
                <div class="oe_row oe_appstore">


                    <?php
                        $u_id = $_SESSION['user']['id'];
                        $sql22 = "select a.module_name,a.module_link,a.module_icon_img,a.module_description,a.id,b.user_id,b.module_id ,b.status from user_module_manage a,user_module_define b where b.module_id=a.id and b.user_id='" . $u_id . "' and b.status='enable' ";
                        $query22 = mysql_query($sql22);
                        while ($data22 = mysql_fetch_object($query22)) {
                    ?>

                        <a href="../../../<?= $data22->module_link ?>?mod_id=<?= $data22->id ?>" title="<?= $data22->module_name ?>" class="oe_app ab_app_descr">
                            <div class="oe_app_icon"><img src="../../../home/<?= $data22->module_icon_img ?>"></div>
                            <div class="oe_app_name"><?= $data22->module_name ?> </div>
                            <div class="oe_app_descr"><?= $data22->module_description ?></div>
                        </a>

                    <?php } ?>
                </div>

                <h4 class="oe_slogan">Download Our Apps</h4>
                <div class="oe_row oe_appstore">

                    <!--<a href="../../../all_module_apk/SecondarySales.apk" title="Secondary Sales.apk" class="oe_app ab_app_descr download_a">
                        <div class="oe_app_icon"><img src="../../../home/SecondarySales.png"></div>
                        <div class="oe_app_name download_text ">Secondary Sales Apps </div>
                        <div class="oe_app_descr" align="center"><button class="download_apk">Download</button></div>
                    </a>-->

                    <a href="../../../ERPAppsAPK/Employee_Portal.apk" title="EmployeePortal.apk" class="oe_app ab_app_descr download_a">
                        <div class="oe_app_icon"><img src="../../../home/user_portal.png"></div>
                        <div class="oe_app_name download_text ">Employee Portal Apps </div>
                        <div class="oe_app_descr" align="center"><button class="download_apk">Download</button></div>
                    </a>
                </div>
            </section>

            <section class="oe_container">
                <div class="oe_row oe_centeralign oe_more_spaced">
                    <a id="app-bottom" href="http://www.erp.com.bd" class="ab_footer_freetrial oe_button oe_big">Powered By <span class="oe_emph">ERP.COM.BD</span> </a>
                </div>
            </section>

        </article>
    </div>
    <div class="openerp_style oe_chat_button">
        Have a Question? Call: 01815224424.
    </div>
</body>
</html>