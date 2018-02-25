<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.expenses.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objExpenses = new expenses;


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'View Yearly Report') {
			$year = $_REQUEST['yearly_year'];
			$yearly_report = $objExpenses->get_yearly_report($year);
		}
		elseif ($_REQUEST['submit'] == 'View Monthly Report') {
			$year = $_REQUEST['monthly_year'];
			$month = $_REQUEST['monthly_month'];

			$monthly_report = $objExpenses->get_monthly_report($year,$month);
		}
		else if ($_REQUEST['submit'] == 'Update Expense'){

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

			
			$objExpenses->update($data);
		
		}
	}

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_all_expense_report') {
			$all_expense_report = $objExpenses->get_all();
		}

		if ($_REQUEST['action'] == 'delete') {
			$id = $_REQUEST['id'];

			$objExpenses->delete($id);
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
										<li>Expense</li>


									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Expense Report</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="col-md-12">
							<div class="box">
								<a href="index.php?page=accounting_expense_report&action=show_all_expense_report" class="btn btn-block btn-primary">View All Expense Report</a>
							</div>
						</div>


						<div class="col-md-12">
							<div class="col-md-4">
								<div class="box border pink">
									<div class="box-title">View Yearly Report</div>
									<div class="box-body">
										<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="post" >
											<div class="form-group">
												<select name="yearly_year" id="" class="selectpicker form-control" data-style="btn-info" data-live-search="true">
													<?php for($i=2015;$i<=2050;$i++){ ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<input type="submit"  name="submit" value="View Yearly Report" class=" btn-block btn btn-primary">
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="col-md-8">
								<div class="box border green">
									<div class="box-title">View Monthly Report</div>
										<div class="box-body">
											<form action="<?php echo $action_url; ?>" role="form" encytype="multipart/form-data" method="post" >
												
													<div class="form-group">
														<select name="monthly_year" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
														<?php for($i=2015;$i<=2050;$i++){ ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php } ?>
													</select>
												
												
													<select name="monthly_month" id="" class="selectpicker"  data-style="btn-info">
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
												
												<div class="form-group">
													<input type="submit" name="submit" value="View Monthly Report" class=" btn-block btn btn-primary"  >
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<hr>
						
						<!-- <div class="box border red">
							<div class="box-title"></div>
							<div class="box-body">
								<form action="">
									<div class="col-md-6">
										<input type="date" name="from-date" class="form-control">
									
								
										<input type="date" name="to-date" class="form-control">
									
								</div>
										<input type="submit" name="submit" value="View Datewise Report" class="btn btn-primary">
									
								</form>
							</div>
						</div> -->

						<hr>
						<?php if (isset($yearly_report)) { ?>
							<div class="box border red">
								<div class="box-title">Yearly Expense Report of- <strong><?php echo $year; ?></strong></div>
								<div class="box-body">
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>VoucherID</td>
											<td>Date</td>
											<td>Receiver</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_expense = 0;
											foreach ($yearly_report as $value) { 
											$total_expense += $value['amount'];

										?>
										<tr>
											<td><?php echo $value['voucher_id']; ?></td>
											<td><?php echo $value['date']." ".$value['month']." ".$value['year']; ?></td>
											<td><?php echo $value['receiver']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_expense_report&action=delete&id=<?php echo $value['expense_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<td><strong>Total Expenses : </strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td><?php echo $total_expense; ?> BDT</td>
										</tr>
									</table>
									
								</div>
							</div>

						<?php }elseif (isset($monthly_report)) { ?>

							<div class="box border red">
								<div class="box-title">Monthly  Expense Report of- <strong><?php echo $month." ".$year; ?></strong></div>
								<div class="box-body">
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>VoucherID</td>
											<td>Date</td>
											<td>Receiver</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_monthly_expense = 0;
											foreach ($monthly_report as $value) { 
											$total_monthly_expense += $value['amount'];

										?>
										<tr>
											<td><?php echo $value['voucher_id']; ?></td>
											<td><?php echo $value['date']." ".$value['month']." ".$value['year']; ?></td>
											<td><?php echo $value['receiver']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_expense_report&action=delete&id=<?php echo $value['expense_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<td><strong>Total Expenses : </strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td><?php echo $total_monthly_expense; ?> BDT</td>
										</tr>
									</table>									
								</div>
							</div>
						<?php }elseif (isset($all_expense_report)) { ?>
							<div class="box border red">
								<div class="box-title">All Expense Report</div>
								<div class="box-body">
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>VoucherID</td>
											<td>Date</td>
											<td>Receiver</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_expense = 0;
											foreach ($all_expense_report as $value) { 
											$total_expense += $value['amount'];

										?>
										<tr>
											<td><?php echo $value['voucher_id']; ?></td>
											<td><?php echo $value['date']." ".$value['month']." ".$value['year']; ?></td>
											<td><?php echo $value['receiver']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_expense_report&action=delete&id=<?php echo $value['expense_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<td><strong>Total Expenses : </strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td><?php echo $total_expense; ?> BDT</td>
										</tr>
									</table>									
								</div>
							</div>
						<?php } ?>
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