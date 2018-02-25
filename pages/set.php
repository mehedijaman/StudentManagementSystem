<?php 

	include("lib/class.db.inc");
	include("lib/class.q_set.inc");

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objSet = new q_set;


	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_set_add') {
			$show_set_add = 1;
		}


		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];
			$set_details = $objSet->get_by_pk($id);
			$set_name_prev = $set_details[0]['set_name'];

			$show_set_edit = 1;
		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Chapter') {
			$data = array('set_name' =>$_REQUEST['set_name']);

			$objSet->create($data);
			$action_msg = "SET added successfully!";
			$show_set_add = 0;
		}


		if ($_REQUEST['submit'] == 'Update') {
			$data = array(
				'setID' => $_REQUEST['setID'] ,
				'set_name'=> $_REQUEST['set_name']
			);

			$objSet->update($data);
			$action_msg = "Update Successful !";
			$show_set_edit = 0;
		}
	}


	$all_set = $objSet->get_all();


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
										<li>Set</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Set</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<!-- Page Main Content -->
						<?php if (isset($action_msg)) {
							echo $action_msg;
						} ?>

						<?php if ($show_set_add == 1) { ?>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
									<div class="form-group">
										<div class="col-sm-10">
											<input name="set_name" type="text" class="form-control" id="set_name" placeholder="Set_name">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input value="Add Chapter" type="submit" name="submit" class="btn btn-primary">
											<a href="index.php?page=set" class="btn btn-danger">Cancel</a>
										</div>
									</div>
								</form>  
							</div>
						<?php }else{ ?>
							<div class="col-md-6 col-md-offset-3">
								<a href="index.php?page=set&action=show_set_add" class="btn btn-primary">Add Set</a>
							</div>
						<?php }?>


						<?php if ($show_set_edit == 1) { ?>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
									<div class="form-group">
										<div class="col-sm-10">
										<input type="hidden" name="setID" value="<?php echo $id; ?>">
											<input name="set_name" type="text" class="form-control" id="set_name" placeholder="Set_name" value="<?php if (isset($set_name_prev)) {
												echo $set_name_prev;
											} ?>">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<input value="Update" type="submit" name="submit" class="btn btn-primary">
											<a href="index.php?page=set" class="btn btn-danger">Cancel</a>
										</div>
									</div>
								</form>  
							</div>
						<?php } ?>

						<hr>
						<div class="row">
							<div class="container">
								<table class="table table-responsive table-stripped">
									<tr class="success">
										<td>SET Name</td>
										<td>Action</td>
									</tr>
									<?php foreach ($all_set as $set) {?>
									<tr>
										<td><?php echo $set['set_name']; ?></td>
										<td>
											<a href="index.php?page=set&action=edit&id=<?php echo $set['setID']; ?>">Edit</a>
										</td>
									</tr>
									<?php } ?>

								</table>
							</div>
						</div>


						<!-- /PageMain Content -->

					</div>
				</div>
			</div>
		</div>