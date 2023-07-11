<?php
	session_start();
	ob_start();
	require "../support/inc.all.php";
	$title = 'Monthly Notice Board';
	$proj_id = $_SESSION['proj_id'];
	$now = time();
?>



<!DOCTYPE html>
<html>
<head>

  <title>Accounts Dashboard</title>

  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 30px;
    }
	  
	 
	.row {
	  display: flex;
	  flex-wrap: wrap;
	  justify-content: space-between;
	  margin-bottom: 20px;
	}

	.column {
	  flex-basis: calc(40% - 10px);
	  display: flex;
	  flex-direction: column;
	}

	.column-content {
	  flex: 1;
	}

	  
    .card {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card-body {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-body .value {
      font-size: 15px;
      padding-bottom: 5px;
    }

    /* Colorful design */
    .card.expenses {
      background-color: #f88e72;
    }

    .card.bank-balance {
      background-color: #70d6ff;
    }

    .card.loan-position {
      background-color: #ffeb6b;
    }

    .card.payable {
      background-color: #99ddc8;
    }

    .progress-bar {
      width: 100%;
      height: 5px;
      background-color: #f2f2f2;
      border-radius: 10px;
      overflow: hidden;
    }

    .progress {
      height: 100%;
      background-color: #ffc166;
    }

    /* Animations */
    @keyframes slideIn {
      0% {
        opacity: 0;
        transform: translateY(100px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card.animation {
      animation: slideIn 0.5s ease-out;
    }

    .account {
      margin-bottom: 20px;
    }

    .account:last-child {
      margin-bottom: 0;
    }

    .account::before {
      content: "";
      position: absolute;
      top: -30px;
      left: 50%;
      width: 2px;
      height: 30px;
      background-color: #ccc;
    }

    .account-name {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 10px;

    }

    .account-info {

      font-size: 16px;

    }
  </style>

</head>




<body>

  <div class="container">

    <!--  Assets  -->

    <div class="row">

      <div class="column3 account">
        <div class="card expenses">
          <div class="account-name">Bank Balance</div>
          <div class="account-info">Total :
            <?php
				$query = "SELECT FORMAT(SUM(dr_amt) - SUM(cr_amt), 0) AS remaining_amount 
							FROM journal 
							WHERE ledger_id IN (1086001700000000, 1086001900000000, 1086001800000000,1086001600000000,1086001400000000,1086001300000000,1086000800000000,1086000900000000,1086001200000000,1086000700000000,1086000500000000,1086000400000000,1086000200000000)";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				$remainingAmount = $row['remaining_amount'];
				echo $remainingAmount;
            ?> Tk
          </div>
        </div>
      </div>

      <div class=" column3 account">
        <div class="card bank-balance">
          <div class="account-name">Cash Balance</div>

          <div class="account-info">Total :
            <?php
				$query = "SELECT FORMAT(SUM(dr_amt) - SUM(cr_amt), 0) AS remaining_amount FROM journal WHERE ledger_id = 1086000100000000";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				$remainingAmount = $row['remaining_amount'];
				echo $remainingAmount;
            ?> Tk
          </div>
        </div>
      </div>

      <div class="column3 account">
        <div class="card loan-position">
          <div class="account-name"> Trade Receivable</div>

          	<div class="account-info">Total : 
			 <?php
                $query = "SELECT FORMAT(SUM(j.dr_amt) - SUM(j.cr_amt), 0) AS remaining_amount FROM journal j JOIN accounts_ledger al ON j.ledger_id = al.ledger_id WHERE al.ledger_group_id IN (1051,1093,1094,1095,1096)";
			  
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                $remainingAmount = $row['remaining_amount'];
                echo $remainingAmount;
             ?> Tk
			</div>
        </div>
      </div>

      <div class="column3 account">
        <div class="card payable">
          <div class="account-name">Inventory</div>

          <div class="account-info">Total : 
            <?php
                $query = "SELECT FORMAT(SUM(j.dr_amt) - SUM(j.cr_amt), 0) AS remaining_amount FROM journal j JOIN accounts_ledger al ON j.ledger_id = al.ledger_id WHERE al.ledger_group_id = 1078";
			  
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                $remainingAmount = $row['remaining_amount'];
                echo $remainingAmount;
             ?> Tk
          </div>
        </div>
      </div>
    </div>


    <!--  Liabilities -->

    <div class="row">


      <div class="column3 account">
        <div class="card bank-balance">
          <div class="account-name">OD Balance</div>

          <div class="account-info">Total : 
			  <?php
				$query = "SELECT FORMAT(SUM(dr_amt) - SUM(cr_amt), 0) AS remaining_amount 
							FROM journal 
							WHERE ledger_id IN (1086001100000000,1086000300000000,1086001500000000,1086001000000000)";
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result);
				$remainingAmount = $row['remaining_amount'];
				echo $remainingAmount;
            ?> Tk</div>
        </div>
      </div>

      <div class=" column3 account">
        <div class="card expenses">
          <div class="account-name">Loan Position</div>

          <div class="account-info">Total : 
			<?php
                $query = "SELECT FORMAT(SUM(j.dr_amt) - SUM(j.cr_amt), 0) AS remaining_amount
						FROM journal j
						JOIN accounts_ledger al ON j.ledger_id = al.ledger_id
  						AND j.ledger_id NOT IN (1086001100000000,1086000300000000,1086001500000000,1086001000000000)
						WHERE al.ledger_group_id = 2025";
			  
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                $remainingAmount = $row['remaining_amount'];
                echo $remainingAmount;
             ?> Tk
		 </div>
        </div>
      </div>

      <div class="column3 account">
        <div class="card payable">
          <div class="account-name">Sika Balance</div>

          <div class="account-info">Total :
			<?php
                $query = "SELECT FORMAT(SUM(j.dr_amt) - SUM(j.cr_amt), 0) AS remaining_amount
						FROM journal j
						JOIN accounts_ledger al ON j.ledger_id = al.ledger_id
						WHERE al.ledger_group_id = 2069";
			  
                $result = mysql_query($query);
                $row = mysql_fetch_assoc($result);
                $remainingAmount = $row['remaining_amount'];
                echo $remainingAmount;
             ?> Tk</div>
        </div>
      </div>

      <div class="column3 account">
        <div class="card loan-position">
          <div class="account-name">Expanse</div>

          <div class="account-info">Total : Tk. 10,000</div>
        </div>
      </div>

    </div>


		<!--  pi chart and sales table -->
	  
		<div class="row">
			
		  <div class="column">
			<div class="card animation">
			  <div class="card-header">Accounts Yearly Chart</div>
			  <div id="piechart"></div>
			</div>
		  </div>
			
		  <div class="column">
			<div class="column-content">
			  <h2>SALES</h2>
			  <table class="table table-bordered" style="margin: 0px; margin-bottom: 3px;">
				  
				<thead>
				  <tr bgcolor="#51cda0">
					<th align="center">Chemical Sales</th>
					<th align="center">Current Month</th>
					<th align="center">Last Month</th>
					<th align="center">Year To Date</th>
					<th align="center">% Percentage</th>
				  </tr>
				</thead>
						
				<tbody>
					<?php
						$query = "SELECT FORMAT(SUM(dr_amt) - SUM(cr_amt), 0) AS remaining_amount FROM journal WHERE ledger_id = 1086000100000000";
					
					
					
						$result = mysql_query($query);
						
						
											
						
							
					?>
					
							<tr>
								<td>
									
									<h2>Corporate</h2>
									<h2>Project</h2>
									<h2>Retail</h2>
								</td>

								
									<td>
										<?=find_a_field('project','PROJECT_DESC','PROJECT_ID='.$data->JOB_LOCATION);?>
									</td>

								

									<td>
										<?=find_a_field('department','DEPT_DESC','DEPT_ID='.$data->DEPARTMENT);?>
									</td>								
								
								<td>
									<?=$data->JOB_POST?>
								</td>
								
								<td>
									<?=$data->CV_COLLECTION?>
								</td>
								
								<td>
									<?=$data->CV_SORTING?>
								</td>
								
							</tr>
					</tbody>
				</table>
		  </div>
		  
		  
		  
		  
		  
		  
		  

        <?php /*?><div class="column3 account">
          <div class="card expenses">
            <div class="account-name">Payable</div>

            <div class="account-info">Total : Tk. 555,000000</div>
          </div>
        </div>

        <div class=" column3 account">
          <div class="card bank-balance">
            <div class="account-name">Receiveable</div>

            <div class="account-info">Total : Tk. 50,000</div>
          </div>
        </div>

        <div class="column3 account">
          <div class="card loan-position">
            <div class="account-name">Payment</div>

            <div class="account-info">Total : Tk. 20,000</div>
          </div>
        </div>

        <div class="column3 account">
          <div class="card payable">
            <div class="account-name">Receive</div>

            <div class="account-info">Total : Tk. 10,000</div>
          </div>
        </div>
<?php */?>
      </div>
    </div>
  </div>
  </div>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
  </script>



  <script type="text/javascript">
    // Load google charts

    google.charts.load('current', {
      'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawChart);


    // Draw the chart and set the chart values

    function drawChart() {

      var data = google.visualization.arrayToDataTable([

        ['', ''],
        ['Asset', 8],
        ['Revenue', <? echo 40; ?>],
        ['Liabilitie', 2],
        ['Expense', 4]

      ]);


      // Optional; add a title and set the width and height of the chart

      var options = {
        'width': 550,
        'height': 300
      };


      // Display the chart inside the <div> element with id="piechart"

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);

    }
  </script>



</body>

</html>

<?
$main_content = ob_get_contents();
ob_end_clean();
include("../template/main_layout.php");
?>