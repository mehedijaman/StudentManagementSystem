<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.student.inc');
	// include('lib/class.attendance.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objStudent = new student;
	// $objAttendance = new attendance;

	// if (isset($_REQUEST['action'])) {
	// 	if ($_REQUEST['action'] == 'attendance') {
	// 		$id = $_REQUEST['id'];

	// 		$batch_student = $objStudent->get_batch_student($id);
	// 	}
	// }

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Attendance') {

			$_SESSION['date'] = $_REQUEST['date'];
			$_SESSION['batch_id'] =  $batch_id = $_REQUEST['batch_id'];			
		}



		if ($_REQUEST['submit'] == 'Submit Attendance') {
			

			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <a href="index.php?page=attendance_action" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>
  <strong>Attendace Rocorded for the Date - '.$_SESSION['date'].' !</strong></div>';


		}
	}

	$batch_student = $objStudent->get_batch_student($_SESSION['batch_id']);


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
										<li>Attendance</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Attendance</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<?php if (isset($action_msg)) {
							echo $action_msg;
						} ?>

						<div class="col-md-6 col-md-offset-3">													

							<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="post" class="form-inline">
								
									<table class="table table-responsive table-stripped">
										<tr>
											<td><strong>Student [ID] [ComputerNumber]</strong></td>
											<td><strong>Is Present</strong></td>											
										</tr>
										<?php 
											$row_counter = 0;
											foreach ($batch_student as $value) { 
											$row_counter++;
										?>
										<tr>
											<td><?php echo $value['full_name']." [".$value['student_id']."] [".$value['computer_no']."]"; ?></td>											
											<td>
												<input type="hidden" name="student_id" value="<?php echo $value['student_id']; ?>">
												<input type="checkbox" name="is_present" value="1" >
											</td>
										</tr>
										<?php } ?>
									</table>							
								
								<input type="submit" name="submit" value="Submit Attendance" class="btn btn-success">
							</form>

							
						</div>
					</div>
				</div>
			</div>
		</div>