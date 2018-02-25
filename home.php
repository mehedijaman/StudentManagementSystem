<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}
	
	include('lib/class.db.inc');
	include('lib/class.student.inc');
	include('lib/class.batch.inc');
	include('lib/class.payment.inc');
	include('lib/class.expenses.inc');

	$objStudent = new student;
	$objBatch = new batch;
	$objPayment = new payment;
	$objExpenses = new expenses;

	$all_active_student = $objStudent->get_all_active();
	$active_student_counter = 0;
	foreach ($all_active_student as $value) {
		$active_student_counter ++;
	}

	$all_student = $objStudent->get_all();
	$all_student_counter = 0;
	foreach ($all_student as $value) {
		$all_student_counter++;
	}

	$all_inactive_student = $objStudent->get_all_inactive();
	$inactive_counter = 0;
	foreach ($all_inactive_student as $value) {
		$inactive_counter++;
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
										<li>Dashboard</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Dashboard</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="panel-left blue">
												<i class="fa fa-user fa-3x"></i>
										   </div>
										   <div class="panel-right">
												<div class="number"><?php echo $all_student_counter; ?></div>
												<div class="title">All Students</div>
										   </div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="panel-left blue">
												<i class="fa fa-user fa-3x"></i>
										   </div>
										   <div class="panel-right">
												<div class="number"><?php echo $active_student_counter; ?></div>
												<span class="label label-info">Active</span>
												<div class="title">Active Students</div>
										   </div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="dashbox panel panel-default">
										<div class="panel-body">
										   <div class="panel-left blue">
												<i class="fa fa-user fa-3x"></i>
										   </div>
										   <div class="panel-right">
												<div class="number"><?php echo $inactive_counter; ?></div>
												<span class="label label-danger">Inactive</span>
												<div class="title">Inactive Students</div>
										   </div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<a href="index.php?page=student_enrollment" class="btn btn-info"><h5><i class="fa fa-plus fa-3x"></i><br>Enroll New Student</h5></a>																			
								<a href="student_list.php" class="btn btn-info"><h5><i class="fa fa-users fa-3x" ></i><br>Show Student List</h5></a>
								<a href="index.php?page=barcode_student" class="btn btn-info"><h5><i class="fa fa-barcode fa-3x"></i><br>Print Student Barcode</h5></a>										
								<a href="index.php?page=batch" class="btn btn-info"><h5><i class="fa fa-plus fa-3x"></i><br>Create New Batch</h5></a>																			
								<a href="index.php?page=student_attendance" class="btn btn-info"><h5><i class="fa fa-calendar fa-3x"></i><br>Attendance</h5></a>																			
								<a href="index.php?page=student_payment" class="btn btn-info"><h5><i class="fa fa-dollar fa-3x"></i><br>Student Payment</h5></a>																			
								<a href="index.php?page=accounting_expense" class="btn btn-info"><h5><i class="fa fa-book fa-3x"></i><br>Add Expense</h5></a>																			
							</div>
						</div>

						<div class="row">
							<br>
							<hr>
							<h5 align="center">System Developed by - <a href="http://www.visionstudio.com.bd" target="_blank">Vision Studio Software</a></h5>

						</div>
						</div>

						<!-- /Main Content -->
					</div>
				</div>
			</div>
		</div>