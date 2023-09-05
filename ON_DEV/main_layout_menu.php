<div class="menu_bg">

  <table width="260" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr>

      <td>
        <div class="smartmenu">

          <? if ($_SESSION['user']['level'] == 5) { ?>

            <div class="silverheader"><a href="#"><i class="fa fa-object-group" aria-hidden="true"></i> Super Admin</a></div>

            <div class="submenu">

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td><a href="../do/cancel_approved_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Cancel Approved Demand Order</a></td>

                </tr>

              </table>

            </div>

          <? } ?>

          <div class="silverheader"><a href="#"><i class="fa fa-transgender" aria-hidden="true"></i> Customer Info</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../admin/create_customer.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Add Customer Info</a></td>

              </tr>

              <tr>

                <td><a href="../report/customer_info_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Customer Info Report</a></td>

              </tr>

              <!--<tr><td><a href="../admin/create_user.php">Write Massage</a></td></tr>

                            <tr><td><a href="../admin/create_user.php">Received Massage</a></td></tr>

                            <tr><td><a href="../admin/create_user.php">Sent Massage</a></td></tr>-->

            </table>

          </div>

          <!--<div class="silverheader"><a href="#" >Demand Order (Distributor)</a></div>

					  <div class="submenu">

						  <table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr><td><a href="../do/select_dealer_do.php">New Demand Order</a></td></tr>

								<tr><td><br /><br /></td></tr>

								<tr><td><a href="../do/select_unfinished_do.php">Unfinished Demand Order</a></td></tr>		

								<tr><td><a href="../do/select_uncheck_do.php">Unapproved Demand Order</a></td></tr>

						  </table>

					  </div>

					  

					  

					  <div class="silverheader"><a href="#" >Secondary Sales</a></div>

					  <div class="submenu">

						  <table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr><td><a href="../ims/ims.php">New Secondary Sales</a></td></tr>

								<tr><td><a href="../ims/ims_status.php">IMS Report</a></td></tr>

								

								

						  </table>

					  </div>-->

          <div class="silverheader"><a href="#"><i class="fa fa-ticket" aria-hidden="true"></i> Delivery Order Format </a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../cdo/select_dealer_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../cdo/select_dealer_do_bill_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Bill Submit Info</a></td>

              </tr>


              <? if ($_SESSION['user']['level'] == 5 || $_SESSION['user']['id'] == 10007 || $_SESSION['user']['id'] == 10046) { ?>

                <tr>

                  <td><a href="../cdo/select_dealer_remarks_info.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Remarks Submit Info</a></td>

                </tr>

              <? } ?>


              <tr>

                <td><a href="../cdo/select_unfinished_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unfinished Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../cdo/item_price.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Corporate Price</a></td>

              </tr>

            </table>

          </div>

          <!--<div class="silverheader"><a href="#" >Demand Order (Project)</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../ido/select_dealer_do.php">New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../ido/select_unfinished_do.php">Unfinished Demand Order</a></td>

              </tr>

              

            </table>

          </div>

          <div class="silverheader"><a href="#" >Demand Order (SCP)</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../spc/select_dealer_do.php">New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../spc/select_unfinished_do.php">Unfinished Demand Order</a></td>

              </tr>

              

            </table>

          </div>

          <div class="silverheader"><a href="#" >Demand Order (DS)</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../ds/select_dealer_do.php">New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../ds/select_unfinished_do.php">Unfinished Demand Order</a></td>

              </tr>

              

            </table>

          </div>

          <div class="silverheader"><a href="#" >Demand Order (RP)</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../rp/select_dealer_do.php">New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../rp/select_unfinished_do.php">Unfinished Demand Order</a></td>

              </tr>

              

            </table>

          </div>

          <div class="silverheader"><a href="#" >Demand Order (RMC)</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../rmc/select_dealer_do.php">New Demand Order</a></td>

              </tr>

              <tr>

                <td><a href="../rmc/select_unfinished_do.php">Unfinished Demand Order</a></td>

              </tr>

              

            </table>

          </div>-->

          <? if ($_SESSION['user']['level'] == 5 || $_SESSION['user']['id'] == 10012 || $_SESSION['user']['id'] == 10046 || $_SESSION['user']['id'] == 10062 || $_SESSION['user']['id'] == 10081 || $_SESSION['user']['id'] == 10076) { ?>

            <div class="silverheader"><a href="#"><i class="fa fa-server" aria-hidden="true"></i> Check Unchecked DO</a></div>

            <div class="submenu">

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td><a href="../do/select_uncheck_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unchecked Demand Order</a></td>

                </tr>

              </table>

            </div>
          <? } ?>

          <? if ($_SESSION['user']['level'] == 5 || $_SESSION['user']['id'] == 10012 || $_SESSION['user']['id'] == 10046 || $_SESSION['user']['id'] == 10062 || $_SESSION['user']['id'] == 10076) { ?>

            <div class="silverheader"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i> Approve Unapproved DO</a></div>

            <div class="submenu">

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td><a href="../do/select_unapprove_do.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Unapproved Demand Order</a></td>

                </tr>

              </table>

            </div>

          <? } ?>

          <!--<div class="silverheader"><a href="#" >Promotional Offer</a></div>

					  <div class="submenu">

						  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr><td><a href="../do/gift_offer.php">Gift Offer</a></td></tr>		

                <tr>

                  <td><a href="../cdo/gift_offer.php">Gift Offer(SuperShop)</a></td>

                </tr>	

				<tr>

                  <td><a href="../do/gift_offer_report.php">Gift Offer Report</a></td>

                </tr>				

						  </table>

					  </div>-->

          <!--<div class="silverheader"><a href="#" >Envelope Print</a></div>

					  <div class="submenu">

						  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr><td><a href="../report/work_order_report_envelop.php">Envelope Print</a></td></tr>

						</table>

					  </div>-->









          <div class="silverheader"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Sample/Gift Issues</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td><a href="../other_issue/sample_issue.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sample Issue</a></td>
              </tr>

              <tr>
                <td><a href="../other_issue/gift_issue.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Gift Issue</a></td>
              </tr>



              <tr>
                <td><a href="../other_issue/other_issue_status.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> All Issue Report</a></td>
              </tr>

            </table>

          </div>



          <div class="silverheader"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Sample Issue Approval</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td><a href="../other_issue/sample_approve.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sample Approve</a></td>
              </tr>


              <tr>

                <td><a href="../All_Issue_Report/issue_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>All Issue Reports</a></td>

              </tr>



            </table>

          </div>




          <div class="silverheader"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Sale Return Approval <span class="sr-notify-danger" style="background-color:#FF0000">
                <?= find_a_field('warehouse_other_receive', 'count(or_no)', 'receive_type="return" and status="UNCHECKED"'); ?>


              </span> </a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td><a href="../other_issue/sale_return_approve.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Sale Return Approve</a></td>
              </tr>


              <tr>

                <td><a href="../report/sales_return_list.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Sale Return Reports</a></td>

              </tr>



            </table>

          </div>
















          <div class="silverheader"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Report</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../report/work_order_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Delivery Order Reports</a></td>

              </tr>

              <tr>

                <td><a href="../report/work_chalan_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Delivery Chalan Reports</a></td>

              </tr>

              <tr>

                <td><a href="../report/sales_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Store to Store Chalan Reports</a></td>

              </tr>

              <tr>

                <td><a href="../report/sales_return_list.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sales Return Reports</a></td>

              </tr>

              <tr>

                <td><a href="../damage_report/damage_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Damage Reports</a></td>

              </tr>

              <tr>

                <td><a href="../report/comprehensive_sales_report.php" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Comprehensive Sales Report</a></td>

              </tr>

              <tr>

                <td><a href="../product/product_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Report</a></td>

              </tr>

              <tr>

                <td><a href="../report/commission_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Commission Report</a></td>

              </tr>


              <tr>

                <td><a href="../report/do_tracking_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> DO-Tracking Report</a></td>

              </tr>

              <!--<tr><td><a href="../report/bill_create.php">Bill Create</a></td></tr>-->

            </table>

          </div>

          <div class="silverheader"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Management Report</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../report/comparison_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Comparison Report</a></td>

              </tr>

            </table>

          </div>

          <div class="silverheader"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Management</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../product/product_report.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Product Advance Reports</a></td>

              </tr>

            </table>

          </div>

          <div class="silverheader"><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Exit Program</a></div>

          <div class="submenu">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><a href="../main/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a></td>

              </tr>

            </table>

          </div>

        </div>
      </td>

    </tr>

  </table>

</div>