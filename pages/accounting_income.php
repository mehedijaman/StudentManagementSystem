<?php 
	require 'lib/class.db.inc';
	require 'lib/class.income.inc';

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Balance') {
			
			$objDB = new db;
			$objIncome = new income;

			$data = array(
				'description' => $_REQUEST['description'],
				'income_source' => $_REQUEST['income_source'],
				'day' => $_REQUEST['day'],
				'month' => $_REQUEST['month'],
				'year' => $_REQUEST['year'],
				'amount' => $_REQUEST['amount']
			);

			// echo $_REQUEST['amount'];

			$objIncome->create($data);
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Data Added Successfully !</strong></div>';
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
										<li>Income</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Income</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="row">
							<div class="container">
							<?php if (isset($action_msg)) { ?>
								<script>	
									alert("Data Addded Successfully !");
								</script>								
							<?php } ?>
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
										<div class="panel panel-primary">
											<div class="panel-heading">Input Manual Income</div>
											<div class="panel-body">
												<form role="form" action="<?php echo $action_url; ?>" enctype="multipart/form-data" method="POST" class="form-horizontal">
														<div class="form-group">
															<label for="description" class="col-sm-3 control-label">Description:</label>
															<div class="col-sm-9">
																<input name="description" type="text" class="form-control" id="description" placeholder="Description">
															</div>
														</div>
														<div class="form-group">
															<label for="description" class="col-sm-3 control-label">Source:</label>
															<div class="col-sm-9">
																<select name="income_source" class="form-control">
																	<option value="car">Car</option>
																	<option value="coaching">Coaching</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="Date" class="col-sm-3 control-label">Date:</label>

															<div class="col-sm-3">
																<select name="day" id="" class="form-control">
																	<?php for ($date = 1; $date <= 31 ; $date++) { ?>
																	<option value="<?php echo $date; ?>"><?php echo $date; ?></option>																		
																	<?php } ?>
																</select>
															</div>
															<div class="col-sm-3">
																<select name="month" id="" class="form-control">
																	<option value="January">01-Jan</option>
																	<option value="February">02-Feb</option>
																	<option value="March">03-Mar</option>
																	<option value="April">04-Apr</option>
																	<option value="May">05-May</option>
																	<option value="June">06-Jun</option>
																	<option value="July">07-Jul</option>
																	<option value="August">08-Aug</option>
																	<option value="September">09-Sep</option>
																	<option value="October">10-Oct</option>
																	<option value="November">11-Nov</option>
																	<option value="December">12-Dec</option>
																</select>
															</div>
															<div class="col-sm-3">
																<select name="year" id="" class="form-control">
																	<?php for ($year = 2015; $year <= 2050 ; $year++) { ?>
																	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>																		
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="amount" class="col-sm-3 control-label">Amount :</label>
															<div class="col-sm-9">
																<input name="amount" type="text" class="form-control" id="amount" placeholder="Amount">
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-3 col-sm-9">
																<input type="submit" name="submit" class="btn btn-primary" value="Add Balance">
																<button type="button" class="btn btn-danger">Cancel</button>
															</div>
														</div>
												</form>
    
											</div>
										</div>					
									</div>
								</div>

								<a href="index.php?page=accounting_income_statement" class="btn btn-primary">
									<i class="fa fa-calculator "></i>
									Income Statement
								</a>

								<a href="index.php?page=accounting_income_report" class="btn btn-primary">
									<i class="fa fa-calculator "></i>
									Student Payment Statement
								</a>
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