<?php 
	include('lib/class.db.inc');;
	include('lib/class.student.inc');
	include('lib/class.batch.inc');

	$objStudent = new student;
	$objBatch = new batch;


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
										<li>Students List</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Retrive Students List</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<a href="student_list.php" class="btn btn-info"><i class="fa fa-user"></i><br>Show Current Students</a>
						<a href="student_list.php&action=show_inactive" class="btn btn-info"><i class="fa fa-user"></i><br> Show Passed Students</a>
						<a href="index.php?page=student_list&action=show_all" class="btn btn-info"><i class="fa fa-users"></i> <br>Show All Students</a>
						<a href="index.php?page=student_all&action=show_batch" class="btn btn-info"><i class="fa fa-user" ></i> <br>Show Batchwise Students</a>
						

						<hr>
						<?php 
							if (isset($_REQUEST['action'])) {
								if ($_REQUEST['action'] == 'show_batch') {
						?>
									<div class="col-md-4 col-md-offset-4">
										<div class="box border green">
											<div class="box-title"><strong>Select Batch</strong></div>
											<div class="box-body">
												<form action="student_list.php" role="form" enctype="multipart/form-data" method="post">
													<div class="form-group col-md-12">
														<select name="batch_id" id="" class=" form-control selectpicker" data-style="btn-primary" data-live-search="true">
															<?php 
																$all_batch = $objBatch->get_all();
																foreach ($all_batch as $value) {
															?>
															<option value="<?php echo $value['batch_id']; ?>"><?php echo $value['batch_name']." [".$value['batch_id']."]"; ?></option>
															<?php 
																}
															?>
														</select>
													</div>
													<div class="form-group">
														<input type="submit" name="submit" value="Show List" class=" btn btn-block btn-primary">
													</div>
												</form>
												

												
											</div>
										</div>
									</div>
						<?php
								}
							}
						?>
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