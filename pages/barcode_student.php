<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.batch.inc');

	$objBatch = new batch;
	$all_batch = $objBatch ->get_all();
 ?>

		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<!-- PAGE HEADER-->
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
								<div class="page-header">
									<!-- STYLER -->
									
									<!-- /STYLER -->
									<!-- BREADCRUMBS -->
									<ul class="breadcrumb">
										<li>
											<i class="fa fa-home"></i>
											<a href="index.php">Home</a>
										</li>
										<li>
											<i class="fa fa-user"></i>
											<a href="#">Student</a>
										</li>
										<li><i class="fa fa-barcode"></i> Barcode</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Barcode for Students</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->

						<div class="row">
							<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class="fa fa-barcode fa-lg"></i>
										Print All Student Barcode
									</div>
									<div class="panel-body">
			 							<a class="btn btn-primary" href="pages/barcode_print.php?action=print_all" target="_blank">
			 								<i class="fa fa-print fa-3x"></i> 
			 								<br>
			 								Print All Barcode 																
			 							</a>								
									</div>
								</div>
							</div>

							<div class="col-sm-5 col-md-5 col-lg-5 col-xs-5">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class="fa fa-barcode fa-lg"></i>
										Print Batchwise Barcode
									</div>
									<div class="panel-body">
										<form action="pages/barcode_print.php" method="post" role="form" enctype="multipart/form-data" target="_blank">
											<select name="batch_id" class="btn btn-info">								
											<?php 	foreach ($all_batch as $value) { ?>
												<option value="<?php echo $value['batch_id']; ?>"><?php echo $value['batch_name']; ?></option>
											<?php } ?>
											</select>
											<button type="submit" name="submit" class="btn btn-primary"  value="Print Batchwise Barcode">
				 								<i class="fa fa-print fa-3x"></i> 
				 								<br>
				 								Print Batchwise 																
				 							</button>
										</form>							
									</div>
								</div>
							</div>

							<div class="col-sm-4 col-md-4">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class="fa fa-barcode fa-lg"></i>
										All Active Students
									</div>
									<div class="panel-body">
										<a class="btn btn-primary" href="pages/barcode_print.php?action=print_all_active" target="_blank">
			 								<i class="fa fa-print fa-3x"></i> 
			 								<br>
			 								Print All Active Barcode 																
			 							</a>
									</div>
								</div>
							</div>
						</div>

						

						
 							
							

						
							
						<div class="row">
							<hr>
							<h5 align="center">System Developed by - <a href="http://www.visionstudio.com.bd" target="_blank">Vision Studio Software</a></h5>
							<div class="footer-tools">
								<span class="go-top">
									<i class="fa fa-chevron-up"></i> Top
								</span>
							</div>
						</div>
						<!-- /Main Content -->
					</div>
				</div>
			</div>
		</div>