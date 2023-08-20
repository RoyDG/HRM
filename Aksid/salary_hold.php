<?php
session_start();
ob_start();
require "../../config/inc.all.php";
$head='<link href="../../css/report_selection.css" type="text/css" rel="stylesheet"/>';
do_calander('#ijdb');
do_calander('#ijda');
do_calander('#ppjdb');
do_calander('#cut_off_date');
if($_POST['mon']!=''){
$mon=$_POST['mon'];}
else{
$mon=date('n');
}

if($_POST['year']!=''){
$year=$_POST['year'];}
else{
$year=date('Y');

}




?>


<style>


#country-list{float:left;list-style:none;margin-top:-3px;padding:0;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#PBI_ID{padding: 10px;}
</style>

<div class="right_col" role="main">   <!-- Must not delete it ,this is main design header-->
          <div class="">
		  
		  
           
        <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
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
				  
				  
				  

<form action="" method="post">
  <div class="oe_view_manager oe_view_manager_current">
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
                <div class="oe_form_sheetbg">
                  
                    <div  class="oe_view_manager_view_list">
                      <div  class="oe_list oe_view">
					  
                        <table width="100%" border="0" class="oe_list_content">
                          <thead>
                            <tr class="oe_list_header_columns">
                              <th colspan="4"><span style="text-align: center; font-size:18px; color:#09F">Salary Hold/Unhold</span></th>
                            </tr>
                          </thead>
                          <tfoot>
                          </tfoot>
                          <tbody>
                            <tr>
                              <td width="24%" align="right" class="alt"><strong>Emp ID : </strong></td>
                              <td width="35%" align="left" class="alt"><strong>
                                <div class="frmSearch">
<input type="text" id="PBI_ID" name="PBI_ID" value="<?=$_POST['PBI_ID']?>" placeholder="Employee Name..." />
<div id="suggesstion-box"></div>
</div>
                              </strong></td>
                              
     <td width="29%" align="right" class="alt"><strong>&nbsp;</strong> </td>
                              <td width="12%">&nbsp;</td>
                            </tr>
                            <tr>
							 
                              <td align="left" class="alt">Mon  :</td>
                              <td align="left" class="alt"><select name="mon" style="width:160px;" id="mon" required="required">
							  
                <option value="1" <?=($mon=='1')?'selected':''?>>Jan</option>
                <option value="2" <?=($mon=='2')?'selected':''?>>Feb</option>
                <option value="3" <?=($mon=='3')?'selected':''?>>Mar</option>
                <option value="4" <?=($mon=='4')?'selected':''?>>Apr</option>
                <option value="5" <?=($mon=='5')?'selected':''?>>May</option>
                <option value="6" <?=($mon=='6')?'selected':''?>>Jun</option>
                <option value="7" <?=($mon=='7')?'selected':''?>>Jul</option>
                <option value="8" <?=($mon=='8')?'selected':''?>>Aug</option>
                <option value="9" <?=($mon=='9')?'selected':''?>>Sep</option>
                <option value="10" <?=($mon=='10')?'selected':''?>>Oct</option>
                <option value="11" <?=($mon=='11')?'selected':''?>>Nov</option>
                <option value="12" <?=($mon=='12')?'selected':''?>>Dec</option>
</select></td>
								 <td align="right" class="alt">Year  :</td>
                              <td align="right" class="alt"><select name="year" style="width:160px;" id="year" required="required">
                                  <option <?=($year=='2017')?'selected':''?>>2017</option>
                                  <option <?=($year=='2018')?'selected':''?>>2018</option>
                                  <option <?=($year=='2019')?'selected':''?>>2019</option>
                                  <option <?=($year=='2020')?'selected':''?>>2020</option>
                                </select></td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
                        <br />
                        <div style="text-align:center">
						         <input name="show" type="submit" id="show" value="SHOW" />
                         </div>
  
  <table width="100%" class="oe_list_content">
		  <thead align="center"><tr class="oe_list_header_columns" align="center" style="font-size:10px;padding:3px; background:#2ECCFA;">
        <th width="7%" >ID</th>
        <th width="17%">Full Name</th>
        <th width="14%">Salary</th>
        <th width="20%">Action</th>
        </tr>
		</thead>
        <tbody>


<?		
		
		if(isset($_POST['show'])){
		
		if($_POST['year']!='')	$con .= " and s.year = '".$_POST['year']."'";
		if($_POST['mon']!='')	$con .= " and s.mon = '".$_POST['mon']."'";
		if($_POST['PBI_ID']!='')  $con .= " and s.PBI_ID = '".$_POST['PBI_ID']."'";
		
		
		 $sqli = 'select s.PBI_ID,s.mon,s.year,s.total_payable,p.PBI_NAME from salary_attendence s, personnel_basic_info p where s.PBI_ID=p.PBI_ID '.$con.'';
		$query = mysql_query($sqli);
		

   while($info = mysql_fetch_object($query)){
   $pbi_remarks = find_a_field('salary_attendence_lock','remarks_details','PBI_ID="'.$info->PBI_ID.'" and mon="'.$info->mon.'" and year="'.$info->year.'"');
   if($pbi_remarks =='hold'){
     $check = $pbi_remarks;
   }else{
   $check = find_a_field('salary_attendence','remarks_details','PBI_ID="'.$info->PBI_ID.'" and mon="'.$info->mon.'" and year="'.$info->year.'"');
   
   }
?>
        <tr style="font-size:10px; padding:3px; ">
		  
		  <td><?=$info->PBI_ID?></td>
          <td><?=$info->PBI_NAME?></td>
		  <td><?=$info->total_payable?><input type="hidden" name="PBI_ID_<?=$info->PBI_ID?>" id="PBI_ID_<?=$info->PBI_ID?>" value="<?=$info->PBI_ID?>" /><input type="hidden" name="mon_<?=$info->PBI_ID?>" id="mon_<?=$info->PBI_ID?>" value="<?=$info->mon?>" /><input type="hidden" name="year_<?=$info->PBI_ID?>" id="year_<?=$info->PBI_ID?>" value="<?=$info->year?>" /></td>
		  <td><? if($check!='hold'){?> <input type="hidden" name="status_<?=$info->PBI_ID?>" id="status_<?=$info->PBI_ID?>" value="hold" />
		    <span id="bonus_<?=$info->PBI_ID?>">  <input type="button" name="edit" value="Hold" style="width:100px;"  onclick="getData2('salary_hold_ajax.php', 'bonus_<?=$info->PBI_ID?>', document.getElementById('PBI_ID_<?=$info->PBI_ID?>').value,document.getElementById('mon_<?=$info->PBI_ID?>').value+'<#>'+document.getElementById('year_<?=$info->PBI_ID?>').value+'<#>'+document.getElementById('status_<?=$info->PBI_ID?>').value)" /></span> <? } else{ ?>
			
			<input type="hidden" name="status1_<?=$info->PBI_ID?>" id="status1_<?=$info->PBI_ID?>" value="" />
		    <span id="bonus_<?=$info->PBI_ID?>">  <input type="button" name="edit" value="Unhold" style="width:100px;"  onclick="getData2('salary_hold_ajax.php', 'bonus_<?=$info->PBI_ID?>', document.getElementById('PBI_ID_<?=$info->PBI_ID?>').value,document.getElementById('mon_<?=$info->PBI_ID?>').value+'<#>'+document.getElementById('year_<?=$info->PBI_ID?>').value+'<#>'+document.getElementById('status1_<?=$info->PBI_ID?>').value)" /></span> <? } ?>
			  
			  
			  
			  </td>
			 
         </tr>
		 
		<? } } ?>
        </table>
		
		
		
                      </div>
                    </div>
                
                </div>
                <div class="oe_chatter" style="padding:0px;">
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



 </tr>
         </tbody>
          </table> 
		   </div>
		   
		   
		   </div>
		    </div>
            </div>
			</div>
			</div>
			
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$("#PBI_ID").keyup(function(){
		$.ajax({
		type: "POST",
		url: "auto_com.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#PBI_ID").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#PBI_ID").css("background","#FFF");
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
$main_content=ob_get_contents();
ob_end_clean();
include ("../../template/main_layout.php");

include_once("../../template/footer.php");
?>
