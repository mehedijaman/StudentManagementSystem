<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.exam.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objExam = new exam;

	if (isset($_REQUEST['action'])) {
		$id = $_REQUEST['id'];

		if ($_REQUEST['submit'] == 'edit') {
			$exam = $objExam->get_by_pk($id);

			$exam_name_prev = (($_REQUEST['action'] == 'edit')?$objExam->__get('exam_name'):'');
			$date_prev = (($_REQUEST['action'] == 'edit')?$objExam->__get('date'):'');
			$marks_prev = (($_REQUEST['action'] == 'edit')?$objExam->__get('marks'):'');
			$duration_prev = (($_REQUEST['action'] == 'edit')?$objExam->__get('duration'):'');
		}


		if ($_REQUEST['action'] == 'delete') {
			$objExam->delete($id);
			$action_msg = '<div  class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Exam Deleted !</strong></div>';
		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Exam') {
			
			$data = array(
				'exam_name' => $_REQUEST['exam_name'] , 
				'date' => $_REQUEST['date'] , 
				'marks' => $_REQUEST['marks'] , 
				'duration' => $_REQUEST['duration']
			);

			$objExam->create($data);
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>New Exam Created Successfully !</strong></div>';
		}

		if ($_REQUEST['submit'] == 'Update') {
			$exam_name = $_REQUEST['exam_name'];
			$date = $_REQUEST['date'];
			$marks = $_REQUEST['marks'];
			$duration = $_REQUEST['duration'];

			$objExam->__set('exam_name',$exam_name);
			$objExam->__set('date',$date);
			$objExam->__set('marks', $marks);
			$objExam->__set('duration', $duration);

			$objExam->update();
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Exam Updated Successfully !</strong></div>';

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
										<li>Dashboard</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Exam</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="box border pink">
							<div class="box-title"><strong>New Exam Entry</strong></div>
							<div class="box-body">
								<form class="form-inline" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
									<div class="form-group">
										<input type="text" class="form-control" name="exam_name" id="exam_name" placeholder="Exam_name" required>										
									</div>
									<div class="form-group">
											<input type="date" class="form-control" name="date" id="date" placeholder="Date" required>										
									</div>
									<div class="form-group">
										<input type="number" class="form-control" name="marks" id="marks" placeholder="Marks" required>										
									</div>
									<div class="form-group">
											<input type="text" class="form-control" name="duration" id="duration" placeholder="Duration">										
									</div>
									<div class="form-group">
										<input type="submit" name="submit" value="Add Exam" class="btn btn-primary">
									</div>
								</form>
							</div>
						</div>
						<div class="box border green">
							<div class="box-title"><strong>Existing Exams</strong></div>
							<div class="box-body">
							<?php if (isset($_REQUEST['action'])) {
								if ($_REQUEST['action'] == 'edit') { ?>

									<form class="form-inline" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
										<div class="form-group">
											<input type="text" class="form-control" value="<?php if (isset($exam_name_prev)) {
												echo $exam_name_prev;
											} ?>" name="exam_name" id="exam_name" placeholder="Exam_name" required>										
										</div>
										<div class="form-group">
												<input type="date" class="form-control" value="<?php if (isset($date_prev)) {
													echo $date_prev;
												} ?>" name="date" id="date" placeholder="Date" required>										
										</div>
										<div class="form-group">
											<input type="number" class="form-control" value="<?php if (isset($marks_prev)) {
												echo $marks_prev;
											} ?>" name="marks" id="marks" placeholder="Marks" required>										
										</div>
										<div class="form-group">
												<input type="text" class="form-control" value="<?php if (isset($duration_prev)) {
													echo $duration_prev;
												} ?>" name="duration" id="duration" placeholder="Duration">										
										</div>
										<div class="form-group">
											<input type="submit" name="submit" value="Update" class="btn btn-primary">
										</div>
									</form>
									<hr>

							<?php	}
							} ?>
								<table class="table table-responsive table-stripped">
									<tr>
										<td><strong>Exam ID</strong></td>
										<td><strong>Exam Name</strong></td>
										<td><strong>Date</strong></td>
										<td><strong>Marks</strong></td>
										<td><strong>Duration</strong></td>
										<td><strong>Action</strong></td>
									</tr>
									<?php 
										$all_exam = $objExam->get_all();
										foreach ($all_exam as $value) {
									 ?>
									<tr>
										<td><?php echo  $value['exam_id']; ?></td>
										<td><?php echo $value['exam_name']; ?></td>
										<td><?php echo $value['date']; ?></td>
										<td><?php echo $value['marks']; ?></td>
										<td><?php echo $value['duration']; ?></td>
										<td>
											<a href="index.php?page=student_exam&action=edit&id=<?php echo $value['exam_id']; ?>" class="btn btn-warning">Edit</a>											
										</td>
									</tr>
									<?php } ?>
								</table>
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