<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.student.inc');
	include('lib/class.exam.inc');
	include('lib/class.result.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objDB = new db;
	$objResult = new result;
	$objStudent = new student;

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Result') {
			
			$data = array(
				'student_id' => $_REQUEST['student_id'] , 
				'exam_id' => $_REQUEST['exam_id'] , 
				'marks' => $_REQUEST['marks']
			);

			$objResult->create($data);
		}


		if ($_REQUEST['submit'] == 'View Student Result') {
			$student_id = $_REQUEST['student_id'];
			$student_result = $objResult->get_student_result($student_id);
			$student_details = $objStudent->get_by_pk($student_id);
		}


		if ($_REQUEST['submit'] == 'View Exam Result') {

			$exam_id = $_REQUEST['exam_id'];
			$exam_result = $objResult->get_exam_result($exam_id);
			$objExam = new exam;
			$exam_details = $objExam->get_by_pk($exam_id);			
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
					$student_id = $filesop[0];
					$exam_id = $filesop[1];
					$marks = $filesop[2];
					
					$sql = mysql_query("INSERT INTO result (student_id, exam_id, marks) VALUES ('$student_id','$exam_id','$marks')");
					
				}
				$counter++;
			}
			
			$counter = $counter-1;
				if($sql){
					$import_msg = "You database has imported successfully. You have inserted ".$counter." recoreds";
				}else{
					$import_msg = "Sorry! There is some problem.";
				}
		}
	}


	if (isset($_REQUEST['action'])) {
		$result_id = $_REQUEST['id'];
		if ($_REQUEST['action'] == 'delete_student_result') {
			$objResult->delete($result_id);
		}

		if ($_REQUEST['action'] == 'delete_exam_result') {
			$objResult->delete($result_id);
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
										<li>Result</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Result</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="col-md-12">
							<div class="col-md-10 col-md-offset-1">
								<div class="box border pink">
									<div class="box-title">Result Entry Form</div>
									<div class="box-body">
										<form class="form-inline" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
											<div class="form-group">
												<select name="student_id" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
													<?php 
														$objStudent = new student;
														$all_active_student = $objStudent->get_all_active();
														foreach ($all_active_student as $value) {
													?>
													<option value="<?php echo $value['student_id']; ?>"><?php echo $value['full_name']." [".$value['student_id']."]"; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<select name="exam_id" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
													<?php 
														$objExam = new exam;
														$all_exam = $objExam->get_all();
														foreach ($all_exam as $value) {
													?>
													<option value="<?php echo $value['exam_id']; ?>"><?php echo $value['exam_name']." [".$value['exam_id']."]"; ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<input type="number" class="form-control" name="marks" id="marks" placeholder="Marks" required>
											</div>
											<div class="form-group">
												<input type="submit" name="submit" value="Add Result" class="btn btn-primary">
											</div>
										</form>
										<hr>
										<div class="box border green">
											<div class="box-title"><strong>Bulk Insert Result</strong></div>
											<div class="box-body">
												<?php if (isset($import_msg)) {
													echo $import_msg;
												} ?>
												
												<form action="<?php echo $action_url; ?>" role="form" method="post" enctype="multipart/form-data" class="form-inline">
													<div class="form-group">
														<input type="file" name="file" class="form-control"> 
													</div>
													<div class="form-group">
														<input type="submit" name="submit"  class="btn" value="Import From CSV">
													</div>
													<div class="form-group">
														<a href="Download/result.csv">Download CSV Format</a>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="box border green">
								<div class="box-title">View Student-wise Result</div>
								<div class="box-body">
									<form role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>" class="form-inline">
										<div class="form-group">
											<select name="student_id" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
												<?php foreach ($all_active_student as $value) { ?>
												<option value="<?php echo $value['student_id']; ?>"><?php echo $value['full_name']." [".$value['student_id']."]"; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-primary" value="View Student Result">
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="box border green">
								<div class="box-title">View Exam-wise Result</div>
								<div class="box-body">
									<form role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>" class="form-inline">
										<div class="form-group">
											<select name="exam_id" id="" class="selectpicker" data-style="btn-warning" data-live-search="true">
												<?php foreach ($all_exam as  $value) { ?>
												<option value="<?php echo $value['exam_id']; ?>"><?php echo $value['exam_name']." [".$value['exam_id']."]"; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<input type="submit" name="submit" value="View Exam Result" class="btn btn-warning">
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="box border red">
							<div class="box-title">Result Viewer</div>
							<div class="box-body">
								<?php if (isset($student_result)) { ?>
									<table class="table table-reponsive table-stripped">
										<tr>
											<td>Exam Name</td>
											<td>Exam Date</td>
											<td>Marks Obtained</td>
											<td>Action</td>
										</tr>
										<tr>
											<div class="jumbotron">	
												<h3 align="center"><img class="img img-reponsive img-circle" height="100" width="100" src="<?php echo $student_details[0]['image']; ?>" alt="Student Image"></h3>											
												<h2 align="center"><?php echo $student_details[0]['full_name']." [".$student_details[0]['student_id']."]"; ?></h2>
												<h4 align="center"><?php echo $student_details[0]['institution']; ?></h4>
												<h4 align="center">Mobile No. : <?php echo $student_details[0]['mobile']; ?> , Email : <?php echo $student_details[0]['email']; ?></h4>											

											</div>
										</tr>
										<?php foreach ($student_result as  $value) { ?>		
										<tr>
											<td>
												<?php 
													$exam_id = $value['exam_id'];
													$exam_details = $objExam->get_by_pk($exam_id);
													echo $exam_details[0]['exam_name']." [".$exam_details[0]['exam_id']."]";
												?>
											</td>
											<td>
												<?php echo $exam_details[0]['date']; ?>
											</td>
											<td><?php echo $value['marks']; ?></td>
											<td>
												<a href="index.php?page=student_resul&action=edit_student_result&id=<?php echo $value['result_id']; ?>" class="btn btn-warning">Edit</a>
												<a href="index.php?page=student_result&action=delete_student_result&id=<?php echo $value['result_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php } ?>
									</table>
								<?php } elseif(isset($exam_result)) { ?>

									<table class="table table-reponsive table-stripped">
										<tr>
											<td>StudentID</td>
											<td>Student Name</td>
											<td>Marks</td>
											<td>Action</td>
										</tr>
										<tr>
											<div class="jumbotron">
												<h2 align="center">Exam Name : <?php echo $exam_details[0]['exam_name']." [".$exam_details[0]['exam_id']."]"; ?></h2>
												<h3 align="center">Exam Date : <?php echo $exam_details[0]['date']; ?></h3>
											</div>
										</tr>
										<?php foreach ($exam_result as $value) { ?>
										<tr>
											<td><?php echo $value['student_id']; ?></td>
											<td>
												<?php 
													$student_id = $value['student_id'];
													$student_details = $objStudent->get_by_pk($student_id);
													echo $student_details[0]['full_name']." [".$student_details[0]['student_id']."]";
												?>
											</td>
											<td><?php echo $value['marks']; ?></td>
											<td>
												<a href="index.php?page=student_result&action=edit_exam_result&id=<?php echo $value['result_id']; ?>" class="btn btn-warning">Edit</a>
												<a href="index.php?page=student_result&action=delete_exam_result&id=<?php echo $value['result_id']; ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
										<?php } ?>
									</table>


								<?php } ?>


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