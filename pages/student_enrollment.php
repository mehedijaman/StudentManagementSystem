<?php 
	error_reporting(0);
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.batch.inc');
	include('lib/class.student.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objBatch = new batch;
	$objStudent = new student;

	// $all_batch = $objBatch->get_all();

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Submit') {

			$target_dir = "img/students/";
	        $target_file = $target_dir . basename($_FILES["image"]["name"]);
	        $upload_status = 1;
	        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	        // Check if image file is a actual image or fake image
	        $check = getimagesize($_FILES["image"]["tmp_name"]);
	            if($check !== false) {          
	                $upload_status = 1;
	            } 
	            else {
	                $img_msg = "<a style='color:red;'>This is not a valid image File!</a>";
	                $upload_status = 0;
	            }


	            // Check if file already exists
	          if (file_exists($target_file)) {
	              $$img_msg = "<a style='color:red;'>File Already Exist</a>";
	              $upload_status = 0;
	          }

	          // Check file size
	          if ($_FILES["image"]["size"] > 500000) {
	              $img_msg = "<a style='color:red;'>Your File size cann't be more that 500kb</a>";
	              $upload_status = 0;
	          }

	          // Allow certain file formats
	          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	          && $imageFileType != "gif" ) {
	              $img_msg = "<a style='color:red;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed</a>";
	              $upload_status = 0;
	          }

	          // Check if $upload_status is set to 0 by an error
	          if ($upload_status == 0) {
	              $upload_msg = "File was not uploaded"." [".$img_msg."]";
	              $image_path = "";
	          // if everything is ok, try to upload file
	          } 
	          else {
	              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	                  $image_path = $target_dir.basename( $_FILES["image"]["name"]);

	              } 
	              else {
	                  $upload_msg = "File was not uploaded"." [".$img_msg."]";
	                  $image_path = "";
	              }
	          }
	          // End of File Upload.


	          if ($_REQUEST['exam1_institution'] == "") {
	          	$exam1_institution = "";
	          }

	          if ($_REQUEST['exam2_institution'] == "") {
	          	$exam2_institution = "";
	          }

	          if ($_REQUEST['exam1_gpa'] == "") {
	          	$exam1_gpa = "";
	          }

	          if ($_REQUEST['email_address'] == "") {
	          	$email = "";
	          }

	          if ($_REQUEST['date_of_birth'] == "") {
	          	$date_of_birth = "";
	          }

	          if ($_REQUEST['mobile'] == "") {
	          	$mobile = "";
	          }

	          if ($_REQUEST['father_mobile'] == "") {
	          	$father_mobile = "";
	          }







	          $data = array(
	          	'batch_id' => $_REQUEST['batch_id'] , 
	          	'full_name' => $_REQUEST['full_name'] , 
	          	'nick_name' => $_REQUEST['nick_name'] , 
	          	'institution' => $_REQUEST['institution'] , 
	          	'department' => $_REQUEST['department'] , 
	          	'date_of_birth' => $date_of_birth , 
	          	'gender' => $_REQUEST['gender'] , 
	          	'mobile' => $mobile , 
	          	'viber' => $_REQUEST['viber'] , 
	          	'whats_app' => $_REQUEST['whats_app'] , 
	          	'email' => $email , 
	          	'address' => $_REQUEST['address'] , 
	          	'remarks' => $_REQUEST['remarks'] , 
	          	'father_name' => $_REQUEST['father_name'] , 
	          	'father_profession' => $_REQUEST['father_profession'] , 
	          	'father_mobile' => $father_mobile , 
	          	'mother_name' => $_REQUEST['mother_name'] , 
	          	'mother_profession' => $_REQUEST['mother_profession'] , 
	          	'mother_mobile' => $_REQUEST['mother_mobile'] , 
	          	'blood_group' => $_REQUEST['blood_group'] , 
	          	'computer_no' => $_REQUEST['computer_no'] , 
	          	'exam1_name' => $_REQUEST['exam1_name'] , 
	          	'exam1_board' => $_REQUEST['exam1_board'] , 
	          	'exam1_institution' => $exam1_institution , 
	          	'exam1_group' => $_REQUEST['exam1_group'] , 
	          	'exam1_gpa' => $exam1_gpa , 
	          	'exam2_name' => $_REQUEST['exam2_name'] , 
	          	'exam2_board' => $_REQUEST['exam2_board'] , 
	          	'exam2_institution' => $exam2_institution , 
	          	'exam2_group' => $_REQUEST['exam2_group'] , 
	          	'exam2_gpa' => $exam2_gpa , 
	          	'image' => $image_path , 
	          	'course_fee' => $_REQUEST['course_fee'] , 
	          	'is_active' => $_REQUEST['is_active'] 
	        );
			
			$objStudent->create($data);
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Student Enrollement Completed Successfully !</strong></div>';
			
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
										<li>Student Enrollment</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Student Enrollment</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<!-- SAMPLE -->
						<div class="row">
							<div class="col-md-12">
							<?php if (isset($action_msg)) {
								echo $action_msg.$upload_msg;
							} ?>
								<!-- BOX -->
								<div class="box border purple" id="formWizard">
									<div class="box-title">
										<h4><i class="fa fa-user"></i>Enrollment Form - <span class="stepHeader">Step 1 of 3</h4>
										<div class="tools hidden-xs">
											<!-- <a href="#box-config" data-toggle="modal" class="config">
												<i class="fa fa-cog"></i>
											</a> -->
											<a href="javascript:;" class="reload">
												<i class="fa fa-refresh"></i>
											</a>
											<a href="javascript:;" class="collapse">
												<i class="fa fa-chevron-up"></i>
											</a>
											<!-- <a href="javascript:;" class="remove">
												<i class="fa fa-times"></i>
											</a> -->
										</div>
									</div>
									<div class="box-body form">
										<form id="wizForm" action="<?php echo $action_url; ?>" method="post" enctype="multipart/form-data" class="form-horizontal " >
											<div class="wizard-form">
											   <div class="wizard-content">
												  <ul class="nav nav-pills nav-justified steps">
													 <li>
														<a href="#account" data-toggle="tab" class="wiz-step">
														<span class="step-number">1</span>
														<span class="step-name"><i class="fa fa-check"></i>Basic Information</span>   
														</a>
													 </li>

													 <li>
														<a href="#payment" data-toggle="tab" class="wiz-step active">
														<span class="step-number">2</span>
														<span class="step-name"><i class="fa fa-check"></i>Contact Information</span>   
														</a>
													 </li>
													 <li>
														<a href="#confirm" data-toggle="tab" class="wiz-step">
														<span class="step-number">3</span>
														<span class="step-name"><i class="fa fa-check"></i> Submit </span>   
														</a> 
													 </li>
												  </ul>
												  <div id="bar" class="progress progress-striped progress-sm active" role="progressbar">
													 <div class="progress-bar progress-bar-warning"></div>
												  </div>
												  <div class="tab-content">
													 <div class="alert alert-danger display-none">
														<a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
														Your form has errors. Please correct them to proceed.
													 </div>
													 <div class="alert alert-success display-none">
														<a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
														Your form validation is successful!
													 </div>
													 <div class="tab-pane active" id="account">
													 	<div class="form-group">
														   <label class="control-label col-md-3">Batch</label>
														   <div class="col-md-4">
															  <select name="batch_id" id="country_select" class="col-md-12 full-width-fix">
																  <?php 
																  	$all_active_batch = $objBatch->get_all_active();
																  	foreach ($all_active_batch as $value) {
																  ?>
																 <option value="<?php echo $value['batch_id']; ?>"><?php echo $value['batch_name']." [".$value['batch_id']."]"; ?></option>
																 <?php } ?>
															  </select>
														   </div>													
														</div>
														<div class="form-group">
															<label for="full_name" class="col-md-3 control-label">Full Name <span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full_name" required>
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="nick_name" class="col-md-3 control-label">Nick Name</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="nick_name" id="nick_name" placeholder="Nick_name">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="institution" class="col-md-3 control-label">Institution</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="institution" id="institution" placeholder="Institution">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="department" class="col-md-3 control-label">Department</label>
															<div class="col-md-7">
																<select name="department" id=""  class="selectpicker" data-style="btn-success">
																	<option value="science">Science</option>
																	<option value="humanity">Humanity</option>
																	<option value="business_studies">Business Studies</option>
																	<option value="general">General</option>
																</select>
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="date_of_birth" class="col-md-3 control-label">Date of Birth<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="date" class="form-control btn-primary" name="date_of_birth" id="date_of_birth" placeholder="Date_of_birth">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="gender" class="col-md-3 control-label">Gender</label>
															<div class="col-md-7">
																<select name="gender" id="" class="selectpicker" data-style="btn-primary">
																	<option value="male">Male</option>
																	<option value="female">Female</option>
																	<option value="other">Other</option>
																</select>
																<span class="error-span"></span>
															</div>
														</div>
														
														<div class="form-group">
															<label for="remarks" class="col-md-3 control-label">Remarks</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="father_name" class="col-md-3 control-label">Father's Name<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father_name" >
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="father_profession" class="col-md-3 control-label">Profession<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="father_profession" id="father_profession" placeholder="Father_profession" >
																<span class="error-span"></span>
															</div>
														</div>
														
														<div class="form-group">
															<label for="mother_name" class="col-md-3 control-label">Mother's Name<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother_name" >
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="mother_profession" class="col-md-3 control-label">Profession<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="mother_profession" id="mother_profession" placeholder="Mother_profession" >
																<span class="error-span"></span>
															</div>
														</div>
														
														<div class="form-group">
															<label for="blood_group" class="col-md-3 control-label">Blood Group<span class="required">*</span></label>
															<div class="col-md-7">
																<select name="blood_group" id="" class="selectpicker" data-style="btn-primary">
																	<option value="a+">A+</option>
																	<option value="a-">A-</option>
																	<option value="b+">B+</option>
																	<option value="b-">B-</option>
																	<option value="ab+">AB+</option>
																	<option value="ab-">AB-</option>
																	<option value="o+">O+</option>
																</select>
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="computer_no" class="col-md-3 control-label">Computer No</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="computer_no" id="computer_no" placeholder="Computer_no" required>
																<span class="error-span"></span>
															</div>
														</div>
														<div class="box border pink">
															<div class="box-title">
																Education Information
															</div>
															<div class="box-body">
																<table class="table table-responsive table-stripped">
																	<tr>
																		<td>Exam Name</td>
																		<td>Board</td>
																		<td>Institution</td>
																		<td>Group</td>
																		<td>GPA</td>
																	</tr>
																	<tr>
																		<td>
																			<select name="exam1_name" id="" class="form-control selectpicker" data-style="btn-info">
																				<option value="ssc">SSC</option>
																				<option value="hsc">HSC</option>
																				<option value="other">Other</option>
																			</select>
																		</td>
																		<td>
																			<select name="exam1_board" id="" class="selectpicker form-control" data-style="btn-success">
																				<option value="jessore">Jessore</option>
																				<option value="dhaka">Dhaka</option>
																				<option value="comilla">Comilla</option>
																				<option value="chittagonj">Chittagonj</option>
																				<option value="barishal">Barishal</option>
																				<option value="dinajpur">Dinajpur</option>
																				<option value="rajshahi">Rajshahi</option>
																				<option value="sylhet">Sylhet</option>
																				<option value="madrasa">Madrasa</option>
																				<option value="bteb">BTEB</option>
																				<option value="dibs(dhaka)">DIBS(Dhaka)</option>
																			</select>
																		</td>
																		<td><input type="text" class="form-control" name="exam1_institution" id="exam1_institution" placeholder="Exam1_institution" > </td>
																		<td>
																			<select name="exam1_group" id=""  class="selectpicker form-control" data-style="btn-primary">
																				<option value="science">Science</option>
																				<option value="humanity">Humanity</option>
																				<option value="business_studies">Business</option>
																				<option value="other">Other</option>
																			</select>
																		</td>
																		<td><input type="text" class="form-control" name="exam1_gpa" id="exam1_gpa" placeholder="GPA" ></td>
																	</tr>
																	<tr>
																		<td>
																			<select name="exam2_name" id=""  class="selectpicker form-control" data-style="btn-info">
																				<option value="ssc">SSC</option>
																				<option value="hsc">HSC</option>
																				<option value="other">Other</option>
																			</select>
																		</td>
																		<td>
																			<select name="exam2_board" id=""  class="selectpicker form-control" data-style="btn-success">
																				<option value="jessore">Jessore</option>
																				<option value="dhaka">Dhaka</option>
																				<option value="comilla">Comilla</option>
																				<option value="chittagonj">Chittagonj</option>
																				<option value="barishal">Barishal</option>
																				<option value="dinajpur">Dinajpur</option>
																				<option value="rajshahi">Rajshahi</option>
																				<option value="sylhet">Sylhet</option>
																				<option value="madrasa">Madrasa</option>
																				<option value="bteb">BTEB</option>
																				<option value="dibs(dhaka)">DIBS(Dhaka)</option>
																			</select>
																		</td>
																		<td><input type="text" class="form-control" name="exam2_institution" id="exam2_institution" placeholder="exam2_institution" > </td>
																		<td>
																			<select name="exam2_group" id=""  class="selectpicker form-control" data-style="btn-primary">
																				<option value="science">Science</option>
																				<option value="humanity">Humanity</option>
																				<option value="business_studies">Business</option>
																				<option value="other">Other</option>
																			</select>
																		</td>
																		<td><input type="text" class="form-control" name="exam2_gpa" id="exam2_gpa" placeholder="GPA" ></td>
																	</tr>
																</table>
															</div>
														</div>
														<div class="form-group">
															<label for="image" class="col-md-3 control-label">Image<span class="required">*</span></label>
															<div class="col-md-7" >
																<input type="file" class="form-control btn-info" name="image" id="image" placeholder="Image">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="course_fee" class="col-md-3 control-label">Course_fee<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="number" class="form-control" name="course_fee" id="course_fee" placeholder="Course_fee" required>
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="is_active" class="col-md-3 control-label">Status</label>
															<div class="col-md-7">
																<select name="is_active" id=""  class="selectpicker" data-style="btn-primary">
																	<option value="1">Active</option>
																	<option value="0">Deactive</option>
																</select>
																<span class="error-span"></span>
															</div>
														</div>
													 </div>

													 <div class="tab-pane" id="payment">
														<div class="form-group">
															<label for="mobile" class="col-md-3 control-label">Mobile<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="viber" class="col-md-3 control-label">Viber</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="viber" id="viber" placeholder="Viber">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="whats_app" class="col-md-3 control-label">Whats app</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="whats_app" id="whats_app" placeholder="Whats_app">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="email" class="col-md-3 control-label">Email</label>
															<div class="col-md-7">
																<input type="email" class="form-control" name="email_address" id="email" placeholder="Email">
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="address" class="col-md-3 control-label">Address</label>
															<div class="col-md-7">
																<textarea name="address" id="" class="form-control" cols="30" rows="10"></textarea>
																<span class="error-span"></span>
															</div>
														</div>	
														<div class="form-group">
															<label for="father_mobile" class="col-md-3 control-label">Father's Mobile<span class="required">*</span></label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="father_mobile" id="father_mobile" placeholder="Father_mobile"> 
																<span class="error-span"></span>
															</div>
														</div>
														<div class="form-group">
															<label for="mother_mobile" class="col-md-3 control-label">Mother's Mobile</label>
															<div class="col-md-7">
																<input type="text" class="form-control" name="mother_mobile" id="mother_mobile" placeholder="Mother_mobile">
																<span class="error-span"></span>
															</div>
														</div>												
													 </div>

													 <!-- REVIEW INFORMATION -->
													 <div class="tab-pane" id="confirm">
														<h3 class="block">Review before Enroll new student</h3>
														<h4 class="form-section">Basic Information</h4>
														<div class="well">
															<div class="form-group">
															   <label class="control-label col-md-3">Email:</label>
															   <div class="col-md-4">
																  <p class="form-control-static" data-display="email"></p>
															   </div>
															</div>
														</div>
														<h4 class="form-section">Contact Information</h4>
														<div class="well">														
															<div class="form-group">
															   <label class="control-label col-md-3">Card Number:</label>
															   <div class="col-md-4">
																  <p class="form-control-static" data-display="card_number"></p>
															   </div>
															</div>
														</div>
													 </div>
												  </div>
											   </div>
											   <div class="wizard-buttons">
												  <div class="row">
													 <div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
														   <a href="javascript:;" class="btn btn-default prevBtn">
															<i class="fa fa-arrow-circle-left"></i> Back 
														   </a>
														   <a href="javascript:;" class="btn btn-primary nextBtn">
															Continue <i class="fa fa-arrow-circle-right"></i>
														   </a>
														   <input type="submit" class="btn btn-success submitBtn" name="submit" value="Submit">                           
														</div>
													 </div>
												  </div>
											   </div>
											</div>
										</form>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /SAMPLE -->
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
		