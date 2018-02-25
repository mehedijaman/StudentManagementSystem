<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.expenses.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Expense') {
			
			$objExpenses = new expenses;

			$data = array(
				'voucher_number' => $_REQUEST['voucher_number'], 
				'receiver' => $_REQUEST['receiver'], 
				'date' => $_REQUEST['date'], 
				'month'=> $_REQUEST['month'],
				'year'=> $_REQUEST['year'],
				'description' => $_REQUEST['description'], 
				'amount' => $_REQUEST['amount'], 
				'remarks' => $_REQUEST['remarks']
			);

			$objExpenses->create($data);
		}


		if ($_REQUEST['submit'] == 'Import From CSV') {
			$hostname = "localhost";
			$username = "root";
			$password = "";
			$database = "ict_coaching";


			$conn = mysql_connect("$hostname","$username","$password") or die(mysql_error());
			mysql_select_db("$database", $conn) or die(mysql_error());

			$file = $_FILES['file']['tmp_name'];
			$handle = fopen($file, "r");
			$counter = 0;
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				if ($counter >= 1) {
					$voucher_number = $filesop[0];
					$receiver = $filesop[1];
					$date = $filesop[2];
					$month = $filesop[3];
					$year = $filesop[4];
					$description = $filesop[5];
					$amount = $filesop[6];
					$remarks = $filesop[7];
					
					$sql = mysql_query("INSERT INTO expenses (voucher_number, receiver,date,month,year,description,amount,remarks) VALUES ($voucher_number,'$receiver',$date,'$month',$year,'$description',$amount,'$remarks')");
					
				}
				$counter++;
			}
			
				$counter = $counter-1;
				
				if($sql){
					$import_msg =  "You database has imported successfully. You have inserted ".$counter." recoreds";
				}else{
					$import_msg =  "Sorry! There is some problem.";
				}

		}
	}

 ?>

		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<!-- STYLER -->
									
									<!-- /STYLER -->
									<!-- BREADCRUMBS -->
									<ul class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a href="index.php">Home</a>
										</li>
										<li>Expense Management</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Expense Management	</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->						
						<div class="col-md-12">
							<div class="col-md-4">
								<a href="index.php?page=accounting_expense_report" class="btn btn-primary"><i class="fa fa-table"></i><br>View Expense Report</a>
							</div>
							<div class="col-md-8">
								<div class="box border green">
									<div class="box-title">
										<strong>Bulk Insert Expense</strong>
									</div>
									<div class="box-body">
										<?php if (isset($import_msg)) {
											echo $import_msg;
										} ?>
										<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="post" class="form-inline">
											<div class="form-group">
												<input type="file" name="file" class="form-control">
											</div>
											<div class="form-group">
												<input type="submit" name="submit" class="btn" value="Import From CSV">
											</div>
											<div class="form-group">
												<a href="Download/expense.csv">Download CSV</a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>


						<div class="box border primary"> 
							<div class="box-title">New Expense Entry</div>
							<div class="box-body">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
									<div class="form-group">
										<label for="voucher_number" class="col-sm-2 control-label">Voucher Number :</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="voucher_number" id="voucher_number" placeholder="Voucher_number" required>
										</div>
									</div>
									<div class="form-group">
										<label for="receiver" class="col-sm-2 control-label">Receiver :</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="receiver" id="receiver" placeholder="Receiver" required>
										</div>
									</div>
									<div class="form-group">
										<label for="date" class="col-sm-2 control-label">Date :</label>
										<div class="col-sm-10">
											<select name="date" class="selectpicker" data-style="btn-info" >
												<?php
												 for($date = 1;$date<=31;$date++){
												?>
												<option value="<?php echo $date; ?>"><?php echo $date; ?></option>
												<?php } ?>
											</select>
											<select name="month" class="selectpicker" data-style="btn-info" >
												<option value="January">January</option>
												<option value="February">February</option>
												<option value="March">March</option>
												<option value="April">April</option>
												<option value="May">May</option>
												<option value="June">June</option>
												<option value="July">July</option>
												<option value="August">August</option>
												<option value="September">September</option>
												<option value="October">October</option>
												<option value="November">November</option>
												<option value="December">December</option>
											</select>
											<select name="year" class="selectpicker" data-live-search="true" data-style="btn-info">
												<?php 
													for($year=2015;$year<=2050;$year++){
												?>	
												<option value="<?php echo $year; ?>"><?php echo $year; ?></option>											
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="description" class="col-sm-2 control-label">Description :</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="description" id="description" placeholder="Description">
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="col-sm-2 control-label">Amount :</label>
										<div class="col-sm-10">
											<input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
										</div>
									</div>
									<div class="form-group">
										<label for="remarks" class="col-sm-2 control-label">Remarks :</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" name="submit" class="btn btn-block btn-primary" value="Add Expense">
										</div>
									</div>
								</form>    
							</div>
						</div>
						<hr>
						<h5 align="center">System Developed by - <a href="http://www.visionstudio.com.bd" target="_blank">Vision Studio Software</a></h5>
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>   
      
  


						<!-- /Main Content -->
					</div>
				</div>
			</div>
		</div>