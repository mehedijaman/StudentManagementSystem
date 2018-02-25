<?php 
	include('lib/class.db.inc');
	include('lib/class.student.inc');

	$objStudent = new student;	

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'details') {
			$id = $_REQUEST['id'];

			$student = $objStudent->get_by_pk($id);

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
										<li>Student Details</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Student Details</h3>
									</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<div class="col-md-offset-5">
							<img src="<?php echo $student[0]['image']; ?>" width="150" alt="Student Image" class="img img-responsive img-thumbnail">
						</div>

						<table class="table table-responsive table-stripped">
							<tr>
								<td><strong>Attribute</strong></td>
								<td><strong>Value</strong></td>
							</tr>
							<tr>
								<td>StudentID</td>
								<td><?php echo $student[0]['student_id']; ?></td>
							</tr>
							<tr>
								<td>Batch</td>
								<td><?php echo $student[0]['batch_id']; ?></td>
							</tr>
							<tr>
								<td>Full Name</td>
								<td><?php echo $student[0]['full_name']; ?></td>
							</tr>
							<tr>
								<td>Nick Name</td>
								<td><?php echo $student[0]['nick_name']; ?></td>
							</tr>
							<tr>
								<td>Institution</td>
								<td><?php echo $student[0]['institution']; ?></td>
							</tr>
							<tr>
								<td>Department</td>
								<td><?php echo $student[0]['department']; ?></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td><?php echo $student[0]['date_of_birth']; ?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?php echo $student[0]['gender']; ?></td>
							</tr>
							<tr>
								<td>Viber</td>
								<td><?php echo $student[0]['viber']; ?></td>
							</tr>
							<tr>
								<td>Whats App</td>
								<td><?php echo $student[0]['whats_app']; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $student[0]['email']; ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?php echo $student[0]['address']; ?></td>
							</tr>
							<tr>
								<td>Father's Name</td>
								<td><?php echo $student[0]['father_name']; ?></td>
							</tr>
							<tr>
								<td>Father's Profession</td>
								<td><?php echo $student[0]['father_profession']; ?></td>
							</tr>
							<tr>
								<td>Father's Mobile</td>
								<td><?php echo $student[0]['father_mobile']; ?></td>
							</tr>
							<tr>
								<td>Mother's Name</td>
								<td><?php echo $student[0]['mother_name']; ?></td>
							</tr>
							<tr>
								<td>Mother's Profession</td>
								<td><?php echo $student[0]['mother_profession']; ?></td>
							</tr>
							<tr>
								<td>Mother's Mobile</td>
								<td><?php echo $student[0]['mother_mobile']; ?></td>
							</tr>
							<tr>
								<td>Blood Group</td>
								<td><?php echo $student[0]['blood_group']; ?></td>
							</tr>
							<tr>
								<td>Computer No</td>
								<td><?php echo $student[0]['computer_no']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam1_name']; ?> Institution</td>
								<td><?php echo $student[0]['exam1_institution']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam1_name']; ?> Board</td>
								<td><?php echo $student[0]['exam1_board']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam1_name']; ?> Group</td>
								<td><?php echo $student[0]['exam1_group']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam1_name']; ?> GPA</td>
								<td><?php echo $student[0]['exam1_gpa']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam2_name']; ?> Institution</td>
								<td><?php echo $student[0]['exam2_institution']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam2_name']; ?> Board</td>
								<td><?php echo $student[0]['exam2_board']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam2_name']; ?> Group</td>
								<td><?php echo $student[0]['exam2_group']; ?></td>
							</tr>
							<tr>
								<td><?php echo $student[0]['exam2_name']; ?> GPA</td>
								<td><?php echo $student[0]['exam2_gpa']; ?></td>
							</tr>
							<tr>
								<td>Course Fee</td>
								<td><?php echo $student[0]['course_fee']; ?></td>
							</tr>
							
							<tr>
								<td>Remarks</td>
								<td>
									<?php 
										$status = $student[0]['is_active'];
										if($status == 1)
											echo "Active" ;
										else 
											echo "Inactive"; 
									?>
								</td>
							</tr>
							<tr>
								<td>Remarks</td>
								<td><?php echo $student[0]['remakrs']; ?></td>
							</tr>
						</table>

						<hr>
						<a href="index.php?page=student_edit&action=edit&id=<?php echo $id; ?>" class="btn btn-warning">Edit</a>
						<a href="student_list.php?action=show_all_students" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Back</a>

					</div>
				</div>
			</div>
		</div>