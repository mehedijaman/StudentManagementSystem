<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}

	include('lib/class.db.inc');
	include('lib/class.income_source.inc');

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objIncomeSource = new income_source;

	if (isset($_SERVER['submit'])) {
		if ($_REQUEST['submit'] == 'Add Source') {

			$data = array('income_source_name' =>$_REQUEST['source_name']);

			$objIncomeSource->create($data);
			$action_msg = "Source Added Successfully !";
		}

		if ($_REQUEST['submit'] == 'Update Source') {
			$data = array(
				'incomeSourceID' => $_REQUEST['incomeSourceID'] , 
				'source_name' => $_REQUEST['source_name']
			);

			$objIncomeSource->update($data);
			$action_msg = 'Update Successfull !';
			$show_add_button = 1;
		}
	}

	$show_add_button = 1;

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'add_source') {
			$show_add_form = 1;
			$show_add_button = 0;
		}


		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];
			$source_details = $objIncomeSource->get_by_pk($id);

			$source_name_prev = $source_details[0]['income_source_name'];
			$show_edit_form = 1;
			$show_add_button = 0;
		}
	}


	$all_source = $objIncomeSource->get_all();

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
										<li>Income Source</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Income Source</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<!-- Page Main Content -->
						<div class="row">
							<div class="container">
								<div class="col-md-4 col-md-offset-4">
								<?php if (isset($action_msg)) {
									echo $action_msg;
								} ?>

									<?php if ($show_add_button == 1) { ?>
									<a href="index.php?page=accounting_income_source&action=add_source" class="btn btn-primary">Add</a>

									<?php } ?>

									<?php if ($show_add_form == 1) { ?>
										<form role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
											<div class="form-group">
												<input placeholder="Source Name" type="text" name="source_name" class="form-control">
											</div>
											<input type="submit" name="submit" value="Add Source" class="btn btn-primary">
											<a href="index.php?page=accounting_income_source" class="btn btn-danger">Cancel</a>
										</form>

									<?php } ?>


									<?php if ($show_edit_form == 1) { ?>
										<form role="form" enctype="multipart/form-data" method="POST" action="<?php echo $action_url; ?>">
											<div class="form-group">
												<input type="hidden" name="incomeSourceID" value="<?php echo $id; ?>">
												<input type="text" name="source_name" class="form-control" value="<?php if (isset($source_name_prev)) {
													echo $source_name_prev;
												} ?>">
											</div>

											<input type="submit" name="submit" value="Update Source" class="btn btn-success"> 
											<a href="index.php?page=accounting_income_source" class="btn btn-danger">Cancel</a>

										</form>
									<?php } ?>

									

									

								</div>
							</div>
						</div>

						<div class="row">
							<div class="container">
								<table class="table table-responsive">
									<tr>
										<td>IncomeSource Name</td>
										<td>Action</td>
									</tr>

									<?php foreach ($all_source as $source) { ?>
										<tr>
											<td><?php echo $source['income_source_name']; ?></td>
											<td>
												<a href="index.php?page=accounting_income_source&action=edit&id=<?php echo $source['incomeSourceID']; ?>">Edit</a>
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