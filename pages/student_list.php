<?php 
	include('lib/class.db.inc');
	include('lib/class.student.inc');

	$objStudent = new student;

	// if (isset($_REQUEST['action'])) {
	// 	if ($_REQUEST['action'] == 'show_active') {
	// 		$student_list = $objStudent->get_all_active();
	// 	}
	// 	elseif ($_REQUEST['action'] == 'show_inactive') {
	// 		$student_list = $objStudent->get_all_inactive();
	// 	}
	// }


	// if (isset($_REQUEST['submit'])) {
	// 	if ($_REQUEST['submit'] == 'Show All Students') {			
	// 		// $student_list = $objStudent->get_all();
	// 	}
	// }
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
										<li>Student List</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Student List</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<div class="box border red">
							<div class="box-title">Student List</div>
							<div class="box-body">
								<table class="table table-responsive table-stripped">
									<tr>
										<td>ID</td>
										<td>Name</td>
										<td>Institution</td>
										<td>Mobile</td>
										<td>Image</td>
										<td>Action</td>
									</tr>
									<?php foreach ($student_list as $value) { ?>
									<tr>
										<td><?php echo $value['student_id']; ?></td>
										<td><?php echo $value['full_name']."<br>Nick: ".$value['nick_name']."<br>Dept.: ".$value['department']."<br>Batch: ".$value['batch_id']; ?></td>
										<td><?php echo $value['institution']; ?></td>
										<td><?php echo $value['mobile']; ?></td>
										<td><img class="img img-responsive img-thumbnail" width="70" src="<?php echo $value['image']; ?>" alt="Photo"></td>
										<td>
											<a href="index.php?page=student_details&action=details&id=<?php echo $value['student_id']; ?>" class="btn btn-info">Details</a>
											<a href="index.php?page=student_details&action=edit&id=<?php echo $value['student_id']; ?>" class="btn btn-warning">Edit</a>
											<a href="index.php?page=student_list&action=delete&id=<?php echo $value['student_id']; ?>" class="btn btn-danger">Delete</a>
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