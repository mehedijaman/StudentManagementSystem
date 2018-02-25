<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.income.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objIncome = new income;

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'total_income_statement') {
			$all_income = $objIncome->get_all();
		}

		if ($_REQUEST['action'] == 'delete') {
			$id = $_REQUEST['id'];
			$objIncome->delete($id);
		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'View Yearly Report') {
			$year = $_REQUEST['year'];
			$yearly_report = $objIncome->get_yearly_report($year);
		}
		elseif ($_REQUEST['submit'] == 'View Monthly Report') {
			$data = array(
				'year' => $_REQUEST['year'], 
				'month' => $_REQUEST['month']
			);

			$monthly_report = $objIncome->get_monthly_report($data);
		}	
		else if ($_REQUEST['submit'] == 'SourceWise Statement'){
			$data = array(
				'income_source' => $_REQUEST['income_source'],
				'year' => $_REQUEST['year'] , 
				'month' => $_REQUEST['month']
			);

			$source_wise_statement = $objIncome->get_sourcewise_statemnt($data);
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
										<li>
											<a href="index.php?page=accounting_income">Income</a>
										</li>
										<li>Income Statement</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Income Statement</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->

						<row>
							<div class="col-md-3">
								<a href="index.php?page=accounting_income_statement&action=total_income_statement" class="btn btn-primary"><i class="fa fa-table"></i><br>View Total Income Statement</a>	
							</div>
							<div class="col-md-3">
								<a href="index.php?page=accounting_income_statement&action=yearly_income_statement" class="btn btn-primary"><i class="fa fa-table"></i><br>View Yearly Income Statement</a>
								
							</div>
							<div class="col-md-3">
								<a href="index.php?page=accounting_income_statement&action=monthly_income_statement" class="btn btn-primary"><i class="fa fa-table"></i><br>View Monthly Income Statement</a>
								
							</div>
							<div class="col-md-3">
								<a href="index.php?page=accounting_income_statement&action=source_wise_statement" class="btn btn-primary"><i class="fa fa-table"></i><br>View SourceWise Statement</a>
								
							</div>
						</row>
						<hr>

						<hr>
						

						<?php 
							if (isset($_REQUEST['action'])) {
								if ($_REQUEST['action'] == 'yearly_income_statement') {
						?>

							<div class="col-md-4 col-md-offset-3">
								<div class="box border green">
									<div class="box-title">Select Year</div>
									<div class="box-body">
										<form role="form" enctype="multipart/form-data" method="post"  action="<?php echo $action_url; ?>" >
											<div class="form-group">
												<select name="year" id="" class="form-control selectpicker " data-style="btn-info" data-live-search="true">
													<?php for($i=2015;$i<=2050;$i++){ ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="form-group">
												<input type="submit"  name="submit" class=" btn btn-block btn-primary" value="View Yearly Report">
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php
							}
							elseif ($_REQUEST['action'] == 'monthly_income_statement') {
						?>
							<div class="col-md-4 col-md-offset-3">
								<div class="box border green">
									<div class="box-title">Select Month and Year</div>
									<div class="box-body">
										<form role="form" enctype="multipart/form-data" method="post"  action="<?php echo $action_url; ?>" >
											<div class="form-group">
												<select name="month" id="" class="selectpicker form-control" data-style="btn-info" data-live-search="true">
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
												<select name="year" id="" class="form-control selectpicker " data-style="btn-info" data-live-search="true">
													<?php for($i=2015;$i<=2050;$i++){ ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="form-group">
												<input type="submit"  name="submit" class=" btn btn-block btn-primary" value="View Monthly Report">
											</div>
										</form>
									</div>
								</div>
							</div>

						<?php
								
							}
							elseif ($_REQUEST['action'] == 'source_wise_statement') {
						?>
							<div class="col-md-4 col-md-offset-3">
								<div class="box border green">
									<div class="box-title">Select Month, Year and Source</div>
									<div class="box-body">
										<form role="form" enctype="multipart/form-data" method="post"  action="<?php echo $action_url; ?>" >

											<div class="form-group">
												<select name="income_source" id="" class="selectpicker form-control" data-style="btn-info" data-live-search="false">
													<option value="car">Car</option>
													<option value="coaching">Coaching</option>
												</select>
											</div>

											<div class="form-group">
												<select name="month" id="" class="selectpicker form-control" data-style="btn-info" data-live-search="true">
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
												<select name="year" id="" class="form-control selectpicker " data-style="btn-info" data-live-search="true">
													<?php for($i=2015;$i<=2050;$i++){ ?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="form-group">
												<input type="submit"  name="submit" class=" btn btn-block btn-primary" value="SourceWise Statement">
											</div>
										</form>
									</div>
								</div>
							</div>

						<?php 
						}
							} 
						?>
						<hr>
						<?php if (isset($all_income)) { ?>
						<div class="box border green">
							<div class="box-title">All Income Statement</div>
							<div class="box-body">
								<table class="table table-responsive table-stripped">
									<tr>
										<td>Source</td>
										<td>Date</td>
										<td>Description</td>
										<td>Amount</td>
										<td>Action</td>
									</tr>
									<?php 
										$total_income = 0;
										foreach ($all_income as $value) { 
										$total_income += $value['amount'];
									?>
									<tr>
										<td><?php echo $value['income_source']; ?></td>
										<td><?php echo $value['day'].'/'.$value['month'].'/'.$value['year']; ?></td>
										<td><?php echo $value['description']; ?></td>
										<td><?php echo $value['amount']; ?></td>
										<td>
											
											<a href="index.php?page=accounting_income_report&action=delete&id=<?php echo $value['incomeID']; ?>" class="btn btn-danger">Delete</a>
										</td>
									</tr>									
									<?php } ?>
								</table>
								<hr>
								<table class="table table-responsive table-stripped">
									<tr>
										<td></td>
										<td><strong>Total Income</strong></td>
										<td><strong><?php echo $total_income; ?></strong> BDT</td>
									</tr>
								</table>
							</div>
						</div>
						<?php } ?>

						<?php if (isset($yearly_report)) { ?>
							<div class="box border green">
								<div class="box-title">Yearly Income Report in <?php echo $year; ?></div>
								<div class="box-body">
									<table class="table table-responsive table-stripped">
										<tr>
											<td>Source</td>
											<td>Date</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_income = 0;
											foreach ($yearly_report as $value) { 
											$total_income += $value['amount'];
										?>
										<tr>
											<td><?php echo $value['income_source']; ?></td>
											<td><?php echo $value['day'].'/'.$value['month'].'/'.$value['year']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_income_report&action=delete&id=<?php echo $value['incomeID']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>	
										<?php } ?>
									</table>
									<hr>
									<table class="table table-reponsive table stripped">
										<tr>
											<td><strong>Total income</strong></td>	
											<td></td>
											<td><strong><?php echo $total_income; ?> </strong>BDT</td>
										</tr>
									</table>
								</div>
							</div>
						<?php } ?>

						<?php if (isset($monthly_report)) { ?>
							<div class="box border green">
								<div class="box-title">Monthly Income Report of <strong><?php echo $data['month'].", ".$data['year']; ?></strong></div>
								<div class="box-body">
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>Source</td>
											<td>Date</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_income = 0;
											foreach ($monthly_report as  $value) {
											$total_income += $value['amount']; 
										?>
										<tr>
											<td><?php echo $value['income_source']; ?></td>
											<td><?php echo $value['day'].'/'.$value['month'].'/'.$value['year']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_income_report&action=delete&id=<?php echo $value['incomeID']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>	
										<?php } ?>
									</table>
									<hr>
									<table class="table table-responsive table-stripped">
										<tr>
											<td><strong>Total = </strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td><strong><?php echo $total_income; ?></strong> BDT</td>
										</tr>
									</table>
								</div>
							</div>

						<?php } ?>

						<?php if (isset($source_wise_statement)) { ?>
							<div class="box border green">
								<div class="box-title">SourceWise Income Statement of <strong><?php echo $data['month'].", ".$data['year']; ?></strong></div>
								<div class="box-body">
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>Source</td>
											<td>Date</td>
											<td>Description</td>
											<td>Amount</td>
											<td>Action</td>
										</tr>
										<?php 
											$total_income = 0;
											foreach ($source_wise_statement as  $value) {
											$total_income += $value['amount']; 
										?>
										<tr>
											<td><?php echo $value['income_source']; ?></td>
											<td><?php echo $value['day'].'/'.$value['month'].'/'.$value['year']; ?></td>
											<td><?php echo $value['description']; ?></td>
											<td><?php echo $value['amount']; ?></td>
											<td>
												
												<a href="index.php?page=accounting_income_report&action=delete&id=<?php echo $value['incomeID']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>	
										<?php } ?>
									</table>
									<hr>
									<table class="table table-responsive table-stripped">
										<tr>
											<td><strong>Total = </strong></td>
											<td></td>
											<td></td>
											<td></td>
											<td><strong><?php echo $total_income; ?></strong> BDT</td>
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