	<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.student.inc');
	include('lib/class.payment.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Recieve Payment') {
			$objPayment = new payment;

			$data = array(
				'student_id' => $_REQUEST['student_id'] , 
				'month' => $_REQUEST['month'] , 
				'year' => $_REQUEST['year'] , 
				'payment_date' => $_REQUEST['payment_date'] , 
				'amound_paid' => $_REQUEST['amound_paid'] , 
				'remarks' => $_REQUEST['remarks']
			);

			$objPayment->create($data);
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Payment Added successfully !</strong></div>';

		}


		if ($_REQUEST['submit'] == 'Import Bulk Payment') {

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
					$student_id = $filesop[0];
					$month = $filesop[1];
					$year = $filesop[2];
					$payment_date = $filesop[3];
					$amound_paid = $filesop[4];
					$remarks = $filesop[5];
					
					$sql = mysql_query("INSERT INTO payment (student_id, month, year, payment_date, amound_paid, remarks) VALUES ('$student_id','$month','$year',$payment_date,$amound_paid,'$remakrs')");
					
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
										<li>Payment</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Student Payment</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<?php if (isset($action_msg)) {
							echo $action_msg;
						} ?>
						
						<div class="col-md-12">
							<div class="col-md-8 col-md-offset-2">
								<div class="box border green">
									<div class="box-title"><strong>Bulk Insert Payment</strong></div>
									<div class="box-body">
										<?php if (isset($import_msg)) {
											echo $import_msg;
										} ?>
										<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="post" class="form-inline">
											<div class="form-group">
												<input type="file" name="file" class="form-control">
											</div>
											<div class="form-group">
												<input type="submit" class="btn" name="submit" value="Import Bulk Payment">
											</div>
											<div class="form-group">
												<a href="Download/payment.csv">Download CSV</a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						

						<div class="box border green">
							<div class="box-title">Receive Payments from Student</div>
							<div class="box-body">
								<form class="form-horizontal" role="form" action="<?php echo $action_url; ?>" enctype="multipart/form-data" method="post">
									<div class="form-group">
										<label for="student_id" class="col-sm-2 control-label">Student Name :</label>
										<div class="col-sm-10">
											<select name="student_id" id="" class="selectpicker form-control" data-style="btn-primary" data-live-search="true">
												<?php
													$objStudent = new student;
													$all_student = $objStudent->get_all_active();
													foreach ($all_student as $value) {
												?>
												<option value="<?php echo $value['student_id']; ?>"><?php echo $value['full_name']." [".$value['student_id']."] [".$value['computer_no']."]"; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="year" class="col-sm-2 control-label">Year :</label>
										<div class="col-sm-10">
											<select name="year" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
												<?php for($i=2015;$i<=2050;$i++){ ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="month" class="col-sm-2 control-label">Month :</label>
										<div class="col-sm-10">
											<select name="month" id="" class="selectpicker" data-style="btn-success" data-live-search="true">
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
										</div>
									</div>
									<div class="form-group">
										<label for="payment_date" class="col-sm-2 control-label">Payment Date :</label>
										<div class="col-sm-10">
											<input type="date" class="form-control" name="payment_date" id="payment_date" placeholder="Payment_date" required>
										</div>
									</div>
									<div class="form-group">
										<label for="amound_paid" class="col-sm-2 control-label">Amound :</label>
										<div class="col-sm-10">
											<input type="number" class="form-control" name="amound_paid" id="amound_paid" placeholder="Amound_paid" required>
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
											<input type="submit" name="submit" class="btn btn-primary btn-block" value="Recieve Payment">
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

		
		