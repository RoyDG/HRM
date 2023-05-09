<?php







session_start();







ob_start();







require "../../support/inc.all.php";





function next_ledger_ids($group_id)

{

$max=($group_id*1000000000000)+1000000000000;

$min=($group_id*1000000000000)-1;

$s='select max(ledger_id) from accounts_ledger where ledger_id>'.$min.' and ledger_id<'.$max;

$sql=mysql_query($s);

if(mysql_num_rows($sql)>0)

$data=mysql_fetch_row($sql);

else

$acc_no=$min;

if(!isset($acc_no)&&(is_null($data[0]))) 

$acc_no=$cls;

else

$acc_no=$data[0]+100000000;

return $acc_no;

}









// ::::: Edit This Section ::::: 















$title='Customer Information';			// Page Name and Page Title







$page="create_customer.php";		// PHP File Name















$table='dealer_info';		// Database Table Name Mainly related to this page







$unique='dealer_code';			// Primary Key of this Database table







$shown='dealer_name_e';				// For a New or Edit Data a must have data field















// ::::: End Edit Section :::::















//if(isset($_GET['proj_code'])) $proj_code=$_GET[$proj_code];







$crud      =new crud($table);















$$unique = $_GET[$unique];







if(isset($_POST[$shown]))







{







$$unique = $_POST[$unique];















if(isset($_POST['insert']))







{		







$proj_id			= $_SESSION['proj_id'];

 $_POST['entry_by']=$_SESSION['user']['id'];

 $_POST['entry_at']=date('Y-m-d h:i:s');





$now				= time();























$crud->insert();







$acc_query='INSERT INTO accounts_ledger(ledger_id, ledger_name, ledger_group_id, opening_balance, balance_type, depreciation_rate, credit_limit, opening_balance_on, proj_id, budget_enable, group_for, parent, acc_code, ledger_type) 







VALUES ("'.$_POST['account_code'].'","'.trim($_POST['dealer_name_e']).'","'.$_POST['customer_group_id'].'",0.00,"Both", 0.00, 0.00,'.strtotime(date("Y-m-d H:i:s")).',"aksid","NO", 2, 0, 0, 0)';



echo $acc_query;



mysql_query($acc_query);



$type=1;







$msg='New Entry Successfully Inserted.';







unset($_POST);







unset($$unique);







}























//for Modify..................................















if(isset($_POST['update']))







{















		$crud->update($unique);



		



		$ledg_up='UPDATE accounts_ledger SET ledger_name="'.trim($_POST['dealer_name_e']).'" WHERE ledger_id='.$_POST['account_code'];



		mysql_query($ledg_up);







		$type=1;







		$msg='Successfully Updated.';







}







//for Delete..................................















if(isset($_POST['delete']))







{$del_ledg='DELETE FROM accounts_ledger WHERE ledger_id='.$_POST['account_code'];



mysql_query($del_ledg);		







$condition=$unique."=".$$unique;		$crud->delete($condition);







		unset($$unique);







		$type=1;







		$msg='Successfully Deleted.';







}







}















if(isset($$unique))







{







$condition=$unique."=".$$unique;







$data=db_fetch_object($table,$condition);







while (list($key, $value)=each($data))







{ $$key=$value;}







}







if(!isset($$unique)) $$unique=db_last_insert_id($table,$unique);



//auto_complete_from_db('personnel_basic_info','PBI_NAME','PBI_ID','PBI_JOB_STATUS="In Service"','marketing_person'); 

auto_complete_from_db('personnel_basic_info a,designation d','concat(a.PBI_NAME, "-" ,d.DESG_DESC)','a.PBI_ID','a.PBI_DESIGNATION=d.DESG_ID and a.PBI_JOB_STATUS="In Service"','marketing_person');


auto_complete_from_db('cost_center','center_name','id','1','cc_code'); 



?>



<script type="text/javascript"> function DoNav(lk){document.location.href = '<?=$page?>?<?=$unique?>='+lk;}















function popUp(URL) 







{







day = new Date();







id = day.getTime();







eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=800,height=800,left = 383,top = -16');");







}







</script>







<div class="form-container_large">



  <table width="100%" border="0" cellspacing="0" cellpadding="0">



    <tr>



      <td valign="top"><div class="left">



          <table width="100%" border="0" cellspacing="0" cellpadding="0">



            <tr>



              <td>

              <form method="post" action="">

              <input name="dealer_name_e2" id="dealer_name_e2" value="<?=$_POST['dealer_name_e2']?>" style="width:80px" placeholder="Name" />

                <select name="dealer_type2" id="dealer_type2" style="width:80px">

                  <option value="">- Type -</option>

                  <option value="Corporate" <?=($_POST['dealer_type2']=='Corporate')?'selected':'';?>>Corporate Client</option>

                  <option <?=($_POST['dealer_type2']=='Project')?'selected':'';?>>Project</option>

                  <option <?=($_POST['dealer_type2']=='Sales Channel Parter(SCP)')?'selected':'';?>>Sales Channel Parter(SCP)</option>

                  <option <?=($_POST['dealer_type2']=='Direct Sales(DS)')?'selected':'';?>>Direct Sales(DS)</option>

                  <option <?=($_POST['dealer_type2']=='Retailer Partner(RP)')?'selected':'';?>>Retailer Partner(RP)</option>

                  <option <?=($_POST['dealer_type2']=='RMC')?'selected':'';?>>RMC</option>

                </select>

              <input name="search" id="search" value="Search" type="submit" style="height:0.1%" />

              </form>

              </td>



            </tr>



            <tr>



              <td><div class="tabledesign">



                  <? 	

				  $d_name = mysql_real_escape_string($_POST['dealer_name_e2']);

				  $t_s = strip_tags($_POST['dealer_type2']);

				  

				  if($d_name != "" && $t_s ==""){

					  $con.=' and dealer_name_e like "%'.$d_name.'%"';

					  } elseif($t_s !="" && $d_name == ""){

						  $con.=' and dealer_type like "%'.  $t_s .'%"';

						  } elseif( $t_s !="" && $d_name != ""){

							   $con.=' and dealer_type like "%'.  $t_s .'%" and dealer_name_e like "%'.$d_name.'%" ';

							 $data_show = true;

							  }

				  $res='select '.$unique.','.$unique.' as code,'.$shown.' as customer_name, dealer_type as type from '.$table.' where 1 '.$con.' ';



					



											echo $crud->link_report($res,$link);?>



                <span style="background-color: #000000; color: black;margin:12%;font-size: 12px;">

                <?

                if($data_show == true){

						$data_check = mysql_query($res);

						

						$data_result = mysql_num_rows($data_check);

						if($data_result == 0){

							echo "Customer name and Customer Type didn't match";

							}

						

						}

				?>

                </span>

                

                </div>



                <?=paging(250);?>

                

                </td>



            </tr>



          </table>



        </div></td>



      <td valign="top"><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">



          <table width="100%" border="0" cellspacing="0" cellpadding="0">



            <tr>



              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



                  <tr>

                    <td>&nbsp;</td>

                  </tr>

                  <tr>



                    <td><fieldset>



                      <legend>



                      <span style="color:#666666;"><?=$title?></span>

                      </legend>



                      <div> </div>



                      <div class="buttonrow"></div>



                      <div>



                        <label>Company Name :</label>



                        <input name="<?=$unique?>" id="<?=$unique?>" value="<?=$$unique?>" type="hidden" />



                        <input name="dealer_name_e" type="text" id="dealer_name_e" value="<?=$dealer_name_e?>" />

                      </div>
					  
					  
					  
					  <div>
                        <label>Head Office Address:</label>

                        <input name="address_e" type="text" id="address_e" value="<?=$address_e?>" />
						</div>
						
						
						
						   <div>



                        <label>Project Address :</label>

                        <input name="propritor_name_e" type="text" id="propritor_name_e" value="<?=$propritor_name_e?>" />

                      </div>
					  
					  
					   <div>



                        <label>Contact Person :</label>



                        <input name="propritor_name_b" type="text" id="propritor_name_b" value="<?=$propritor_name_b?>" />

                      </div>



                      <div>



                        <label>Designation:</label>



                        <input name="dealer_name_b" type="text" id="dealer_name_b" value="<?=$dealer_name_b?>" />

                      </div>



                   

                 <div>



                        <label>Mobile No:</label>



                        <input name="mobile_no" type="text" id="mobile_no" value="<?=$mobile_no?>" />

                      </div>

                     



                        



                      <div>



                        <label>Email:</label>



                        <input name="address_b" type="text" id="address_b" value="<?=$address_b?>" />

                      </div>


                      <div>



                        <label>Marketing Person</label>



                      <?php /*?>  <select name="marketing_person" id="marketing_person" style="width:150px;">
						         <option></option>
                                  <? foreign_relation('personnel_basic_info','PBI_ID','PBI_NAME',$marketing_person,'PBI_DEPARTMENT IN (2,17)');?>


                                    </select><?php */?>
									
									
									
									<input name="marketing_person" type="text"  id="marketing_person" value="<?=$marketing_person?>" required/>  

                      </div>
					  



					  



					  <div>



                        <label>Customer Type:</label>



                        <select name="dealer_type" id="dealer_type" style="width:200px;">



                                      <option value="Corporate" <?=($dealer_type=='Corporate')?'selected':'';?>>Corporate & Application</option>



									  <option <?=($dealer_type=='Project')?'selected':'';?>>Project</option>



                                      <option <?=($dealer_type=='Sales Channel Parter(SCP)')?'selected':'';?>>Sales Channel Parter(SCP)</option>



                                      <option <?=($dealer_type=='Direct Sales(DS)')?'selected':'';?>>Direct Sales(DS)</option>



                                      <option <?=($dealer_type=='Retailer Partner(RP)')?'selected':'';?>>Retailer Partner(RP)</option>



									  <option <?=($dealer_type=='RMC')?'selected':'';?>>RMC</option>

                                    </select>

                      </div>
					  
					  
					  <div>

                       <label>Customer Group Id</label>
					   
                       <select name="customer_group_id" id="customer_group_id" style="width:200px;">
					   <option> </option>
					   <?=foreign_relation('ledger_group','group_id','concat(group_id," - ",group_name)',$customer_group_id,'group_name LIKE "%Trade%"');?>

                      </select>

                      </div>
					  
					  
					  
					<?php /*?>  <div>

                       <label>Sales Accounts</label>
					   
                       <select name="sales_account" id="sales_account" style="width:200px;">
					   <option> </option>
					   <?=foreign_relation('accounts_ledger','ledger_id','concat(ledger_id," - ",ledger_name)',$sales_account,'ledger_group_id=1089');?>

                      </select>

                      </div><?php */?>
					  
					  
					  
					  
					  
					  <div>

                       <label>Cost center</label>
                       <input name="cc_code" type="text"  id="cc_code" value="<?=$cc_code?>"/>  

                      </div>
					  
					  



				<div>
                   <label>Account Code:</label>
						<?php $last_id=find_a_field('dealer_info','max(dealer_code)','1')+1;
						?>

                        <input name="account_code" type="text" id="account_code" value="<?php if($$unique==$last_id){
						echo $ledger_id=next_ledger_ids('1051');
						} else {
						echo $account_code;}?>" />

                </div>
						
						
				<div>
                   <label>ETIN:</label>
						<input name="etin" type="text" id="etin" value="<?=$etin?>" />

                </div>
						
						
						
				<div>
                   <label>BIN:</label>
						<input name="bin" type="text" id="bin" value="<?=$bin?>" />

                </div>



                      </fieldset></td>

                  </tr>



                </table></td>



            </tr>



            <tr>



              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



                  <tr>
				  
				  
				  <?  
				      
$sqld = 'select user_id from user_activity_management 
where user_id IN (10046,10064,10074,10062,10077,10076,10081,10082,10007,10090)';
$queryd=mysql_query($sqld);
while($data = mysql_fetch_object($queryd)){
$id_top=$data->user_id;






				  
				 // $id_top = find_a_field('user_activity_management','user_id','user_id IN (10046,10064)'); 
				  $user_id=$_SESSION['user']['id']; 
					
					
				  
				   if($id_top==$user_id){
				  
				  
				   ?>



                    <td><div class="button">



                        <? if(!isset($_GET[$unique])){?>



                        <input name="insert" type="submit" id="insert" value="Save" class="" />



                        <? }}}?>



                      </div></td>



                    <td><div class="button">



                        <? if(isset($_GET[$unique])){?>



                        <input name="update" type="submit" id="update" value="Update" class="" />



                        <? }?>



                      </div></td>



                    <td><div class="button">



                        <input name="reset" type="button" class="" id="reset" value="Reset" onclick="parent.location='<?=$page?>'" />



                      </div></td>



                    <td><div class="button">



                        <!--<input class="btn" name="delete" type="submit" id="delete" value="Delete"/>-->



                      </div></td>



                  </tr>



                </table></td>



            </tr>



          </table>



        </form></td>



    </tr>



  </table>



</div>



<?







$main_content=ob_get_contents();







ob_end_clean();







include ("../../template/main_layout.php");







?>



