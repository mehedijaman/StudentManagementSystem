<?php 
	require('lib/class.db.inc');
	require('lib/class.income.inc');
	require('lib/class.expenses.inc');
	require('lib/class.payment.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


	$objIncome = new income;
	$objExpenses = new expenses;
	$objPayment = new payment;

	

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_all') {
			$all_expenses = $objExpenses->get_all();
			$all_income = $objIncome->get_all();
			$all_payment = $objPayment->get_all();

			$total_student_payment = 0;
			foreach ($all_payment as $value) {
				$total_student_payment += $value['amound_paid'];
			}
			
		}
	}

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Show Yearly Report') {
			$year = $_REQUEST['year'];

			$all_income = $objIncome->get_yearly_report($year);
			$all_expenses = $objExpenses->get_yearly_report($year);
			$all_payment = $objPayment->get_yearly_report($year);

			$total_student_payment = 0;			
			foreach ($all_payment as $value) {
				$total_student_payment += $value['amound_paid'];
			}
		}




		if ($_REQUEST['submit'] == 'Show Monthly Report') {
			$data = array(
				'year' => $_REQUEST['year'], 
				'month' => $_REQUEST['month']
			);

			$all_income = $objIncome->get_monthly_report($data);
			$all_expenses = $objExpenses->get_monthly_report($data);
			$all_payment = $objPayment->get_monthly_report($data);

			$total_student_payment = 0;			
			foreach ($all_payment as $value) {
				$total_student_payment += $value['amound_paid'];
			}
		}
	}
?>
	
		<!-- PAge Content -->

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
											<a href="index.html">Home</a>
										</li>
										<li>Account</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Report</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<!-- Page Main Content -->
						<a href="index.php?page=accounting_report&action=show_all" class="btn btn-primary">Show All</a>

						<!-- Yearly Report -->
						<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">Show Yearly Report</div>
								<div class="panel-body">
									<form action="<?php echo $action_url; ?>" enctype="multipart/form-data" role="form" method="POST">
										<select name="year" id="" class="form-control">
											<?php for($year_counter = 2015; $year_counter <= 2050; $year_counter++){ ?>
											<option value="<?php echo $year_counter; ?>"><?php echo $year_counter; ?></option>
											<?php } ?>
										</select>
										<br>
										<input type="submit" class="btn btn-primary" name="submit" value="Show Yearly Report">
									</form>
								</div>
							</div>
						</div>
						<!-- /Yearly Report -->

						<!-- Monthly Report -->
						<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">Show Monthly Report</div>
								<div class="panel-body">
									<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="POST">
										<select name="month" id="" class="form-control">
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
										<br>

										<select name="year" id="" class="form-control">
											<?php for($year_counter = 2015; $year_counter <= 2050; $year_counter++){ ?>
											<option value="<?php echo $year_counter; ?>"><?php echo $year_counter; ?></option>
											<?php } ?>
										</select>
										<br>
										<input type="submit" name="submit" class="btn btn-primary" value="Show Monthly Report">
									</form>
								</div>
							</div>
						</div>
						<!-- /Monthly Report -->

						<!-- Raport Box -->
						<div class="box border green" >
							<div class="box-title"><i class="fa fa-users"></i> 
								Accounts Report
								<button onclick="return print('print_area')"><i class="fa fa-print"></i></button>
							</div>
							<div class="box-body" id="print_area">
								<div class="row">
									<h4 align="center"><strong>Computer.Edu</strong></h4>
									<p align="center">Accounts Report</p>
									<?php 
										if (isset($year)) {
											echo '<p align="center">Year: '.$year.'</p>';
										} 

										if (isset($month)) {
											echo '<p align="center">Month: '.$month.', Year: '.$year.'</p>';
										}

									?>
								</div>
								<hr>
							
								<table class="table table-responsive table-condenced table-bordered">
									<tr>
										<td>Income</td>
										<td>Expenses</td>
									</tr>
									<tr>
										<!-- Debit -->
										<td>
											<table class="table table-responsive table-bordered" border="1" cellspacing="0" cellpadding="5">
												<tr>
													<td>Date</td>
													<td>Description</td>
													<td>Source</td>
													<td>Amount</td>
												</tr>
												<?php 
													$total_income = 0;
													foreach ($all_income as $value) {
														$total_income += $value['amount'];
												?>
												<tr>
													<td><?php echo $value['day']."/".$value['month']."/".$value['year']; ?></td>
													<td><?php echo $value['description']; ?></td>
													<td>
														<?php echo $value['income_source']; ?>
													</td>
													<td><?php echo $value['amount']; ?></td>
												</tr>
												<?php
												}
												 ?>

												 <tr>
												 	<td><strong>Student Payment</strong></td>
												 	<td></td>
												 	<td></td>
												 	<td><strong><?php echo $total_student_payment; ?></strong></td>
												 </tr>
												 <tr>
												 	<td><strong>Total Income</strong></td>
												 	<td></td>
												 	<td></td>
												 	<td><strong><?php echo $total_income + $total_student_payment; ?></strong></td>
												 </tr>
											</table>
										</td>
										<!-- /Debit -->

										<!-- Credit -->
										<td>
											<table class="table table-responsive table-bordered" border="1" cellspacing="0" cellpadding="5">
												<tr>
													<td>Date</td>
													<td>Description</td>
													<td>Amount</td>
												</tr>
												<?php 
													$total_expense = 0;
													foreach ($all_expenses as $value) {
														$total_expense = $total_expense + $value['amount'];
												?>

												<tr>
													<td><?php echo $value['date']."/".$value['month']."/".$value['year']; ?></td>
													<td><?php echo $value['description']; ?></td>
													<td><?php echo $value['amount'] ?></td>
												</tr>
												<?php

												}
												?>
												<tr>
													<td><strong>Total Expenses</strong></td>
													<td></td>
													<td><?php echo "<strong>".$total_expense."</strong>"; ?></td>
												</tr>
											</table>
										</td>
										<!-- /Credit -->
									</tr>
								</table>

								<br>
								
								<hr>
								Computer.Edu,   &copy; Vision Studio Software
							</div>
						</div>
						<!-- Report Box -->
						<!-- /PageMain Content -->

					</div>
				</div>
			</div>
		</div>

		<!-- Page Content -->


<script type="text/javascript">

	function print(strid)
	{
	if(confirm("Do you want to print?"))
	{
	var values = document.getElementById(strid);
	var printing =
	window.open();
	printing.document.write(values.innerHTML);
	printing.document.close();
	printing.focus();
	printing.print();
	printing.close();
	}
	}
</script>