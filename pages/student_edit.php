<?php 
	include('lib/class.db.inc');
	include('lib/class.batch.inc');
	include('lib/class.student.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objBatch = new batch;
	$objStudent = new student;

	$all_batch = $objBatch->get_all_active();

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];

			$student = $objStudent->get_by_pk($id);
			// echo $student[0]['full_name'];

			$full_name_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('full_name'):'');
			// $batch_id_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('batch_id'):'');
			$nick_name_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('nick_name'):'');
			$institution_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('institution'):'');
			$department_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('department'):'');
			$date_of_birth_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('date_of_birth'):'');
			$gender_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('gender'):'');
			$mobile_prev  = (($_REQUEST['action'] == 'edit')?$objStudent->__get('mobile'):'');
			$viber_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('viber'):'');
			$whats_app_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('whats_app'):'');
			$email_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('email'):'');
			$address_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('address'):'');
			$remarks_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('remarks'):'');
			$father_name_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('father_name'):'');
			$Father_profession_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('father_profession'):'');
			$father_mobile_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('father_mobile'):'');
			$mother_name_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('mother_name'):'');
			$mother_profession_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('mother_profession'):'');
			$mother_mobile_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('mother_mobile'):'');
			$blood_group_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('blood_group'):'');
			$computer_no_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('computer_no'):'');
			$exam1_name_prev  = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam1_name'):'');
			$exam1_board_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam1_board'):'');
			$exam1_institution_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam1_institution'):'');
			$exam1_group_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam1_group'):'');
			$exam1_gpa_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam1_gpa'):'');
			$exam2_name_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam2_name'):'');
			$exam2_board_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam2_board'):'');
			$exam2_institution_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam2_institution'):'');
			$exam2_group_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam2_group'):'');
			$exam2_gpa_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('exam2_gpa'):'');
			$image_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('image'):'');
			$course_fee_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('course_fee'):'');
			$is_active_prev = (($_REQUEST['action'] == 'edit')?$objStudent->__get('is_active'):'');

		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Update') {

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
	              $img_msg = "<a style='color:red;'>File Already Exist</a>";
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
	              $image_path = $image_prev;
	              // echo $image_path;
	          // if everything is ok, try to upload file
	          } 
	          else {
	              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	                  $image_path = $target_dir.basename( $_FILES["image"]["name"]);

	              } 
	              else {
	                  $upload_msg =  "File was not uploaded"." [".$img_msg."]";
	                  $image_path = $image_prev;
	                  // echo $image_path;
	              }
	          }
	          // End of File Upload.



			$full_name = $_REQUEST['full_name'];
			$nick_name = $_REQUEST['nick_name'];
			$institution = $_REQUEST['institution'];
			$department = $_REQUEST['department'];

			if ($_REQUEST['date_of_birth'] == "") {
				$date_of_birth = "";
			}
			else{
				$date_of_birth = $_REQUEST['date_of_birth'];
			}		
			
			$gender = $_REQUEST['gender'];
			$mobile = $_REQUEST['mobile'];
			$viber = $_REQUEST['viber'];
			$whats_app = $_REQUEST['whats_app'];
			$email = $_REQUEST['email'];
			$address = $_REQUEST['address'];
			$remarks = $_REQUEST['remarks'];
			$father_name = $_REQUEST['father_name'];
			$father_profession = $_REQUEST['father_profession'];
			$father_mobile = $_REQUEST['father_mobile'];
			$mother_name = $_REQUEST['mother_name'];
			$mother_profession = $_REQUEST['mother_profession'];
			$mother_mobile = $_REQUEST['mother_mobile'];
			$blood_group = $_REQUEST['blood_group'];
			$computer_no = $_REQUEST['computer_no'];
			$exam1_name = $_REQUEST['exam1_name'];
			$exam1_board = $_REQUEST['exam1_board'];
			$exam1_institution = $_REQUEST['exam1_institution'];
			$exam1_group = $_REQUEST['exam1_group'];
			$exam1_gpa = $_REQUEST['exam1_gpa'];
			$exam2_name = $_REQUEST['exam2_name'];
			$exam2_board = $_REQUEST['exam2_board'];
			$exam2_institution = $_REQUEST['exam2_institution'];
			$exam2_group = $_REQUEST['exam2_group'];
			$exam2_gpa = $_REQUEST['exam2_gpa'];
			$image = $image_path;
			$course_fee = $_REQUEST['course_fee'];
			$is_active = $_REQUEST['is_active'];


			$objStudent->__set('full_name',$full_name);
			$objStudent->__set('nick_name',$nick_name);
			$objStudent->__set('institution',$institution);
			$objStudent->__set('department',$department);
			$objStudent->__set('date_of_birth',$date_of_birth);
			$objStudent->__set('gender',$gender);
			$objStudent->__set('mobile',$mobile);
			$objStudent->__set('viber',$viber);
			$objStudent->__set('whats_app',$whats_app);
			$objStudent->__set('email',$email);
			$objStudent->__set('address',$address);
			$objStudent->__set('remarks',$remarks);
			$objStudent->__set('father_name',$father_name);
			$objStudent->__set('father_profession',$father_profession);
			$objStudent->__set('father_mobile',$father_mobile);
			$objStudent->__set('mother_name',$mother_name);
			$objStudent->__set('mother_profession',$mother_profession);
			$objStudent->__set('mother_mobile',$mother_mobile);
			$objStudent->__set('blood_group',$blood_group);
			$objStudent->__set('computer_no',$computer_no);
			$objStudent->__set('exam1_name',$exam1_name);
			$objStudent->__set('exam1_board',$exam1_board);
			$objStudent->__set('exam1_institution',$exam1_institution);
			$objStudent->__set('exam1_group',$exam1_group);
			$objStudent->__set('exam1_gpa',$exam1_gpa);
			$objStudent->__set('exam2_name',$exam2_name);
			$objStudent->__set('exam2_board',$exam2_board);
			$objStudent->__set('exam2_institution',$exam2_institution);
			$objStudent->__set('exam2_group',$exam2_group);
			$objStudent->__set('exam2_gpa',$exam2_gpa);
			$objStudent->__set('image',$image);
			$objStudent->__set('course_fee',$course_fee);
			$objStudent->__set('is_active',$is_active);

			$objStudent->update();
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Student Updated Successfully !</strong></div>';


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
										<li>
											<a href="#">Other Pages</a>
										</li>
										<li>Edit Student/li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Edit Student</h3>
									</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<?php if (isset($action_msg)) {
							echo $action_msg.$upload_msg;
						}?>


						<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
							<div class="form-group">
								<label for="batch_id" class="col-sm-2 control-label">Batch_id :</label>
								<div class="col-sm-10">
									<select name="batch_id"  class="selectpicker" data-style="btn-info" data-live-search="true">
										<?php foreach ($all_batch as $value) { ?>
										<option value="<?php echo $value['batch_id']; ?>"><?php echo $value['batch_name']." [".$value['batch_id']."]"; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="full_name" class="col-sm-2 control-label">Full_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($full_name_prev)) {
										echo $full_name_prev;
									} ?>" name="full_name" id="full_name" placeholder="Full_name">
								</div>
							</div>
							<div class="form-group">
								<label for="nick_name" class="col-sm-2 control-label">Nick_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($nick_name_prev)) {
										echo $nick_name_prev;
									} ?>" name="nick_name" id="nick_name" placeholder="Nick_name">
								</div>
							</div>
							<div class="form-group">
								<label for="institution" class="col-sm-2 control-label">Institution :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($institution_prev)) {
										echo $institution_prev;
									} ?>" name="institution" id="institution" placeholder="Institution">
								</div>
							</div>
							<div class="form-group">
								<label for="department" class="col-sm-2 control-label">Department :</label>
								<div class="col-sm-10">
									<select name="department" class="selectpicker" data-style="btn-info">
										<option value="science">Science</option>
										<option value="humanity">Humanity</option>
										<option value="business_studies">Business Studeis</option>
										<option value="general">General</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="date_of_birth" class="col-sm-2 control-label">Date_of_birth :</label>
								<div class="col-sm-10">
									<input type="date" class="form-control" value="<?php if (isset($date_of_birth_prev)) {
										echo $date_of_birth_prev;
									} ?>" name="date_of_birth" id="date_of_birth" placeholder="Date_of_birth">
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-sm-2 control-label">Gender :</label>
								<div class="col-sm-10">
									<select name="gender" class="selectpicker" data-style="btn-info" >
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="mobile" class="col-sm-2 control-label">Mobile :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($mobile_prev)) {
										echo $mobile_prev;
									} ?>" name="mobile" id="mobile" placeholder="Mobile">
								</div>
							</div>
							<div class="form-group">
								<label for="viber" class="col-sm-2 control-label">Viber :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($viber_prev)) {
										echo $viber_prev;
									} ?>" name="viber" id="viber" placeholder="Viber">
								</div>
							</div>
							<div class="form-group">
								<label for="whats_app" class="col-sm-2 control-label">Whats_app :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($whats_app_prev)) {
										echo $whats_app_prev;
									} ?>" name="whats_app" id="whats_app" placeholder="Whats_app">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($email_prev)) {
										echo $email_prev;
									} ?>" name="email" id="email" placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-2 control-label">Address :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($address_prev)) {
										echo $address_prev;
									} ?>" name="address" id="address" placeholder="Address">
								</div>
							</div>
							<div class="form-group">
								<label for="remarks" class="col-sm-2 control-label">Remarks :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($remarks_prev)) {
										echo $remarks_prev;
									} ?>" name="remarks" id="remarks" placeholder="Remarks">
								</div>
							</div>
							<div class="form-group">
								<label for="father_name" class="col-sm-2 control-label">Father_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($father_name_prev)) {
										echo $father_name_prev;
									} ?>" name="father_name" id="father_name" placeholder="Father_name">
								</div>
							</div>
							<div class="form-group">
								<label for="father_profession" class="col-sm-2 control-label">Father_profession :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($Father_profession_prev)) {
										echo $Father_profession_prev;
									} ?>" name="father_profession" id="father_profession" placeholder="Father_profession">
								</div>
							</div>
							<div class="form-group">
								<label for="father_mobile" class="col-sm-2 control-label">Father_mobile :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($father_mobile_prev)) {
										echo $father_mobile_prev;
									} ?>" name="father_mobile" id="father_mobile" placeholder="Father_mobile">
								</div>
							</div>
							<div class="form-group">
								<label for="mother_name" class="col-sm-2 control-label">Mother_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($mother_name_prev)) {
										echo $mother_name_prev;
									} ?>" name="mother_name" id="mother_name" placeholder="Mother_name">
								</div>
							</div>
							<div class="form-group">
								<label for="mother_profession" class="col-sm-2 control-label">Mother_profession :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($mother_profession_prev)) {
										echo $mother_profession_prev;
									} ?>" name="mother_profession" id="mother_profession" placeholder="Mother_profession">
								</div>
							</div>
							<div class="form-group">
								<label for="mother_mobile" class="col-sm-2 control-label">Mother_mobile :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($mother_mobile_prev)) {
										echo $mother_mobile_prev;
									} ?>" name="mother_mobile" id="mother_mobile" placeholder="Mother_mobile">
								</div>
							</div><div class="form-group">
								<label for="blood_group" class="col-sm-2 control-label">Blood_group :</label>
								<div class="col-sm-10">
									<select name="blood_group" id="" class="selectpicker" data-style="btn-primary">
										<option value="a+">A+</option>
										<option value="a-">A-</option>
										<option value="b+">B+</option>
										<option value="b-">B-</option>
										<option value="ab+">AB+</option>
										<option value="ab-">AB-</option>
										<option value="o+">O+</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="computer_no" class="col-sm-2 control-label">Computer_no :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($computer_no_prev)) {
										echo $computer_no_prev;
									} ?>" name="computer_no" id="computer_no" placeholder="Computer_no">
								</div>
							</div>
							<div class="form-group">
								<label for="exam1_name" class="col-sm-2 control-label">Exam1_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam1_name_prev)) {
										echo $exam1_name_prev;
									} ?>" name="exam1_name" id="exam1_name" placeholder="Exam1_name">
								</div>
							</div>
							<div class="form-group">
								<label for="exam1_board" class="col-sm-2 control-label">Exam1_board :</label>
								<div class="col-sm-10">
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
								</div>
							</div>
							<div class="form-group">
								<label for="exam1_institution" class="col-sm-2 control-label">Exam1_institution :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam1_institution_prev)) {
										echo $exam1_institution_prev;
									} ?>" name="exam1_institution" id="exam1_institution" placeholder="Exam1_institution">
								</div>
							</div>
							<div class="form-group">
								<label for="exam1_group" class="col-sm-2 control-label">Exam1_group :</label>
								<div class="col-sm-10">
									<select name="exam1_group" id=""  class="selectpicker form-control" data-style="btn-primary">
										<option value="science">Science</option>
										<option value="humanity">Humanity</option>
										<option value="business_studies">Business</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exam1_gpa" class="col-sm-2 control-label">Exam1_gpa :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam1_gpa_prev)) {
										echo $exam1_gpa_prev;
									} ?>" name="exam1_gpa" id="exam1_gpa" placeholder="Exam1_gpa">
								</div>
							</div>
							<div class="form-group">
								<label for="exam2_name" class="col-sm-2 control-label">Exam2_name :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam2_name_prev)) {
										echo $exam2_name_prev;
									} ?>" name="exam2_name" id="exam2_name" placeholder="Exam2_name">
								</div>
							</div>
							<div class="form-group">
								<label for="exam2_board" class="col-sm-2 control-label">Exam2_board :</label>
								<div class="col-sm-10">
									<select name="exam2_board" id="" class="selectpicker form-control" data-style="btn-success">
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
								</div>
							</div>
							<div class="form-group">
								<label for="exam2_institution" class="col-sm-2 control-label">Exam2_institution :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam2_institution_prev)) {
										echo $exam2_institution_prev;
									} ?>" name="exam2_institution" id="exam2_institution" placeholder="Exam2_institution">
								</div>
							</div>
							
							<div class="form-group">
								<label for="exam2_group" class="col-sm-2 control-label">Exam2_group :</label>
								<div class="col-sm-10">
									<select name="exam2_group" id=""  class="selectpicker form-control" data-style="btn-primary">
										<option value="science">Science</option>
										<option value="humanity">Humanity</option>
										<option value="business_studies">Business</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exam2_gpa" class="col-sm-2 control-label">Exam2_gpa :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" value="<?php if (isset($exam2_gpa_prev)) {
										echo $exam2_gpa_prev;
									} ?>" name="exam2_gpa" id="exam2_gpa" placeholder="Exam2_gpa">
								</div>
							</div>
							<div class="form-group">
								<label for="image" class="col-sm-2 control-label">Image :</label>
								<div class="col-sm-10">
									<input type="file" value="<?php if (isset($image_prev)) {
										echo $image_prev;
									} ?>" class="form-control" name="image" id="image" placeholder="Image">
								</div>
							</div>
							<div class="form-group">
								<label for="course_fee" class="col-sm-2 control-label">Course_fee :</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" value="<?php if (isset($course_fee_prev)) {
										echo $course_fee_prev;
									} ?>" name="course_fee" id="course_fee" placeholder="Course_fee">
								</div>
							</div>
							<div class="form-group">
								<label for="is_active" class="col-sm-2 control-label">Is_active :</label>
								<div class="col-sm-10">
									<select name="is_active" class="selectpicker" data-style="btn-info">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" name="submit" value="Update" class="btn btn-info">
									<a href="" class="btn btn-danger">Cancel</a>
									<a href="student_list.php?action=show_all_students" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>