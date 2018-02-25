<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.batch.inc');

	$objBatch = new batch;
	$all_batch = $objBatch->get_all_active();
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
										<h3 class="content-title pull-left">Attendance</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<form action="index.php?page=attendance_action" class="form-inline" role="form" enctype="multipart/form-data" method="post">
							<div class="form-group">
								<input type="date" name="date" class="form-control btn-info"  >

							</div>
							<div class="form-group">
								<select name="batch_id" id="" class="selectpicker" data-style="btn-info" data-live-search="true">
									<?php foreach ($all_batch as $value) { ?>
									<option value="<?php echo $value['batch_id'] ; ?>"><?php echo $value['batch_name']." [".$value['batch_id']."]"; ?></option>
									<?php } ?>
								</select>
							</div>
							<input type="submit" name="submit" class="btn btn-primary" value="Attendance">
						</form>
						
						<!-- Main Content -->


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