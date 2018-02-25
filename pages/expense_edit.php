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


	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];

			$expense = $objExpenses->get_by_pk($id);

			$voucher_number = $expense[0]['voucher_number'];
			$receiver = $expense[0]['receiver'];
			$date = $expense[0]['date'];
			$month = $expense[0]['month'];
			$year = $expense[0]['year'];
			$description = $expense[0]['description'];
			$amount = $expense[0]['amount'];
			$remarks = $expense[0]['remarks'];
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
											<a href="index.html">Home</a>
										</li>
										<li>Edit Expense</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Edit Expense</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<div class="col-md-12" >	

							<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="index.php?page=accounting_expense_report">
									<div class="form-group">
										<label for="voucher_number" class="col-sm-2 control-label">Voucher Number :</label>
										<div class="col-sm-10">
											<input value="<?php if (isset($voucher_number)) {
												echo $voucher_number;
											} ?>" type="text" class="form-control" name="voucher_number" id="voucher_number" placeholder="Voucher_number" required>
										</div>
									</div>
									<div class="form-group">
										<label for="receiver" class="col-sm-2 control-label">Receiver :</label>
										<div class="col-sm-10">
											<input value="<?php if (isset($receiver)) {
												echo $receiver;
											} ?>" type="text" class="form-control" name="receiver" id="receiver" placeholder="Receiver" required>
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
											<input value="<?php if (isset($description)) {
												echo $description;
											} ?>" type="text" class="form-control" name="description" id="description" placeholder="Description">
										</div>
									</div>
									<div class="form-group">
										<label for="amount" class="col-sm-2 control-label">Amount :</label>
										<div class="col-sm-10">
											<input value="<?php if (isset($amount)) {
												echo $amount;
											} ?>" type="number" class="form-control" name="amount" id="amount" placeholder="Amount" required>
										</div>
									</div>
									<div class="form-group">
										<label for="remarks" class="col-sm-2 control-label">Remarks :</label>
										<div class="col-sm-10">
											<input value="<?php if (isset($remarks)) {
												echo $remarks;
											} ?>" type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input type="submit" name="submit" class="btn btn-block btn-primary" value="Update Expense">
											<!-- <input type="submit" name="submit"> -->
										</div>
									</div>
								</form>    
						</div>
					</div>
				</div>
			</div>
		</div>