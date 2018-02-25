<?php 
	error_reporting(0);
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}
	
	error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.student.inc');
	include('lib/class.batch.inc');

	$objStudent = new student;
	$objBatch = new batch;
	$all_batch = $objBatch->get_all();

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_active_students') {
			$student_list = $objStudent->get_all_active();
		}
		elseif ($_REQUEST['action'] == 'show_inactive_students') {
			$student_list = $objStudent->get_all_inactive();
		}
		elseif ($_REQUEST['action'] == 'show_all_students') {
			$student_list = $objStudent->get_all();
		}
		elseif ($_REQUEST['action'] == 'show_batchwise_students') {
			$batchwise = 0;
		}

		if ($_REQUEST['action'] == 'delete') {
			$id = $_REQUEST['id'];
			$objStudent->delete($id);
			$action_msg = '<div  class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Student Deleted From Database !</strong></div>';
		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Show Batchwise Students') {
			$batch_id = $_REQUEST['batch_id'];
			$student_list = $objStudent->get_batch_student($batch_id);
		}
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Computer.Edu :: Student List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >
	<link rel="stylesheet" type="text/css"  href="css/themes/default.css" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="css/responsive.css" >
	
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- JQUERY UI-->
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css" />
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- DATA TABLES -->
	<link rel="stylesheet" type="text/css" href="js/datatables/media/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="js/datatables/media/assets/css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="js/datatables/extras/TableTools/media/css/TableTools.min.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<!-- SELECT PICKEr -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
</head>
<body>
	<!-- HEADER -->
	<header class="navbar clearfix" id="header">
		<div class="container navbar-brand">
			<a href="index.php"><i class="fa fa-home"></i></a>
		</div>
		<div class="sidebar-collapse btn" id="sidebar-collapse">
			<a href="index.php"><i class="fa fa-home"></i></a>
		</div>
	</header>
	<!--/HEADER -->
	
	<!-- PAGE -->
	<section id="page">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12">
								<div class="page-header">
									<div class="clearfix">
									<br>
										<a href="student_list.php?action=show_all_students" class="btn btn-info"><i class="fa fa-user"></i><br>Show All Student</a>
										<a href="student_list.php?action=show_active_students" class="btn btn-info"><i class="fa fa-user"></i><br>Show Active Students</a>
										<a href="student_list.php?action=show_inactive_students" class="btn btn-info"><i class="fa fa-user"></i><br>Show Inactive Students</a>
										<a href="student_list.php?action=show_batchwise_students" class="btn btn-info"><i class="fa fa-user"></i><br>Show Batchwise Student</a>
										<a href="print_student_list.php" class="btn btn-primary">Print Minimal List</a>
									</div>
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						<?php if (isset($action_msg)) {
							echo $action_msg;
						} ?>

						<!-- EXPORT TABLES -->
						<div class="row">
							<div class="col-md-12">
								<?php if (isset($batchwise)) { ?>
											<form action="student_list.php" method="post" role="form" enctype="multipart/form-data">
												<select name="batch_id" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
													<?php foreach ($all_batch as  $value) { ?>
													<option value="<?php echo $value['batch_id']; ?>"><?php echo $value['batch_name']." [".$value['batch_id']."]"; ?></option>
													<?php } ?>
												</select>
												<input type="submit" name="submit" value="Show Batchwise Students" class="btn btn-info">
											</form>
										<?php } ?>

								<?php if (isset($student_list)) { ?>
									<!-- BOX -->
									<div class="box border purple">
										<div class="box-title">
											<h4><i class="fa fa-table"></i>Student List</h4>
											<div class="tools hidden-xs">
												<a href="javascript:;" class="reload">
													<i class="fa fa-refresh"></i>
												</a>
												<a href="javascript:;" class="collapse">
													<i class="fa fa-chevron-up"></i>
												</a>
											</div>
										</div>
										<div class="box-body">
											<table id="datatable2" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>ID</th>
														<th>Name and Basic Info</th>
														<th class="hidden-xs">Mobile</th>
														<th>Image</th>
														<th class="hidden-xs">Action</th>
													</tr>

												</thead>
												<tbody>
													<?php foreach ($student_list as $value) { ?>
													<tr>
														<td><?php echo $value['student_id']; ?></td>
														<td>
															<?php 
																echo "<strong>Name: </strong>".$value['full_name']."<br><strong>Nick: </strong>".$value['nick_name']."<br><strong>Dept.: </strong> ".$value['department']."<br><strong>Batch: </strong>".$value['batch_id']."<br><strong>Institution: </strong>".$value['institution']."<br><strong>Computer No:".$value['computer_no']."</strong>"."<br><strong>Status: </strong>";
																if ($value['is_active'] == 1) {
																 	echo '<span class="label label-info">Active</span>';
																}
																else
																	echo '<span class="label label-danger">Inactive</span>';
															?>
														</td>
														<td><?php echo $value['mobile']; ?></td>
														<td><img class="img img-responsive img-thumbnail" width="70" src="<?php echo $value['image']; ?>" alt="Photo"></td>
														<td>
															<div class="btn-group" role="group">
																<a href="index.php?page=student_details&action=details&id=<?php echo $value['student_id']; ?>" class="btn btn-info" title="Details"><i class="fa fa-info"></i></a>
																<a href="index.php?page=student_edit&action=edit&id=<?php echo $value['student_id']; ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
																<!-- <a href="student_list.php?action=delete&id=<?php echo $value['student_id']; ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a> -->
															<hr>
															<div class="btn-group" role="group">
																<a href="#" class="btn btn-success" title="Send SMS"><i class="fa fa-mobile"></i></a>
																<a href="<?php echo "mailto:".$value['email']; ?>" class="btn btn-primary" title="Send Email"><i class="fa fa-envelope"></i></a>
																<a href="#" class="btn btn-info" title="Call Mobile"><i class="fa fa-phone"></i></a>
															</div>
															</div>
														</td>
													</tr>
													<?php } ?>
												</tbody>
												<tfoot>
													<tr>
														<td></td>
														<td>System Developed by - <strong>Vision Studio Software</strong>, Phone: 01960 023443, web: www.visionstudio.com.bd</td>
														<td></td>
														<td></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
									<!-- /BOX -->
								<?php } ?>
							</div>
						</div>
						<!-- /EXPORT TABLES -->
						<hr>
						<h5 align="center">System Developed by - <a href="http://www.visionstudio.com.bd" target="_blank">Vision Studio Software</a></h5>
						<div class="footer-tools">
							<span class="go-top">
								<i class="fa fa-chevron-up"></i> Top
							</span>
						</div>
					</div><!-- /CONTENT-->
				</div>
			</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script><script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
	<!-- DATA TABLES -->
	<script type="text/javascript" src="js/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/datatables/media/assets/js/datatables.min.js"></script>
	<script type="text/javascript" src="js/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
	<script type="text/javascript" src="js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="js/script.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("dynamic_table");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->

	<!-- SELECTPICKER -->
	<script src="js/bootstrap-select.js"></script>

</body>
</html>