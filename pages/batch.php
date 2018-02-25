<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}
	// error_reporting(0);
	include('lib/class.db.inc');
	include('lib/class.batch.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objBatch =  new batch;

	if (isset($_REQUEST['action'])) {
		$id = $_REQUEST['id'];

		if ($_REQUEST['action'] == 'edit') {
			$batch = $objBatch->get_by_pk($id);

			$batch_name_prev = (($_REQUEST['action'] == 'edit')?$objBatch->__get('batch_name'):'');


		}


		if ($_REQUEST['action'] == 'delete') {
			$objBatch->delete($id);
		}
	}
	

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add New Batch') {

			$data = array(
				'batch_name' => $_REQUEST['batch_name'] , 
				'is_active' => $_REQUEST['is_active']
			);

			$objBatch->create($data);
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>New Batch Created Successfully !</strong></div>';
		}

		if ($_REQUEST['submit'] == 'Update') {
			$batch_name = $_REQUEST['batch_name'];
			$is_active = $_REQUEST['is_active'];

			$objBatch->__set('batch_name',$batch_name);
			$objBatch->__set('is_active',$is_active);

			$objBatch->update();
			$action_msg = '<div  class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Batch Updated Successfully !</strong></div>';
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
										<li>Batch</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Batch Management</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->
						
						<!-- Main Content -->
						<?php if (isset($action_msg)) {
							echo $action_msg;
						} ?>
							<div class="box border green">
								<div class="box-title"><i class="fa fa-users"></i> Create New Batch</div>
								<div class="box-body">
									<form class="form-horizontal" role="form" enctype="multipart/form-data" action="<?php echo $action_url; ?>" method="post" >
										<div class="form-group">
											<label for="batch_name" class="col-sm-2 control-label">Batch Name :</label>
											<div class="col-sm-10">
												<input type="text" class="form-control"name="batch_name" id="batch_name" placeholder="Batch_name" required>
											</div>
										</div>
										<div class="form-group">
											<label for="is_active" class="col-sm-2 control-label">Status :</label>
											<div class="col-sm-10">
												<select name="is_active" class="selectpicker" data-style="btn-info" id="">
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" class="btn btn-primary btn-block " name="submit" value="Add New Batch">							
											</div>
										</div>
									</form>
								</div>
							</div>
							<hr>
							<div class="box border pink">
								<div class="box-title"><i class="fa fa-users"></i> Existing Batch</div>
								<div class="box-body">
									<?php if (isset($batch_name_prev)) { ?>
										<form action="<?php echo $action_url; ?>" role="form" enctype="multipart/form-data" method="post" class="form-inline">
											<div class="form-group">
												<input type="text" name="batch_name" value="<?php if (isset($batch_name_prev)) {
													echo $batch_name_prev;
												} ?>" class="form-control" >
											</div>
											<div class="form-group">
												<select name="is_active" class="selectpicker" data-style="btn-info">
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>
											<div class="form-group">
												<input type="submit" name="submit" value="Update" class="btn btn-success" >
												<a href="index.php?page=batch" class="btn btn-danger">Cancel</a>
											</div>
										</form>
										<hr>
									<?php } ?>
									<table class="table table-responsive table-stripped">
										<tr>
											<td>Batch ID</td>
											<td>Batch Name</td>
											<td>Status</td>
											<td>Action</td>
										</tr>
										<?php $all_batch = $objBatch->get_all(); foreach ($all_batch as $value) { ?>
										<tr>
											<td><?php echo $value['batch_id']; ?></td>
											<td><?php echo $value['batch_name']; ?></td>
											<td><?php if($value['is_active'] == 1) echo '<span class="label label-info arrow-out arrow-out-right">Active</span>';else echo '<span class="label label-danger arrow-out arrow-out-right">Inactive</span>'; ?></td>
											<td>
												<a href="index.php?page=batch&action=edit&id=<?php echo $value['batch_id']; ?>" class="btn btn-warning">Edit</a>												
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