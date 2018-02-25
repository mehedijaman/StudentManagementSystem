<?php 

	include('lib/class.db.inc');
	include('lib/class.subject.inc');


	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objSubject = new subject;
	
	$show_add_form = 0;
	$show_edit_form = 0;

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_add_form') {
			$show_add_form = 1;
		}
		else
			$show_add_form = 0;



		if ($_REQUEST['action'] == 'edit') {
			$show_edit_form = 1;
			$id = $_REQUEST['id'];
			$subject_details = $objSubject->get_by_pk($id);
			$subject_name_prev = $subject_details[0]['subject_name'];
		}
		else
			$show_edit_form = 0;
	}




	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Subject') {

			$data = array(
				'subject_name'=>$_REQUEST['subject_name']
			);

			$objSubject->create($data);
			$action_msg = " Subject Added Successfully !";
		}


		if ($_REQUEST['submit'] == 'Update') {
			
			$data = array(
				'subjectID' => $_REQUEST['subjectID'], 
				'subject_name'=> $_REQUEST['subject_name']
			);

			$objSubject->update($data);
			$action_msg = "Update Successful !";
		}
	}


	$all_subject = $objSubject->get_all();

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
										<li>Subject</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Subject</h3>
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

						<?php if ($show_add_form == 1) { ?>
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<form class="form-inline" role="form" method="Post" enctype="multipart/form-data" action="<?php echo $action_url; ?>">
									<input type="text" class="form-control" id="subject_name" placeholder="Subject_name" name="subject_name">
									<input type="submit" name="submit" value="Add Subject" class="btn btn-primary">
									<a href="index.php?page=subject" class="btn btn-danger">Cancel</a>
								</form>
							</div>
						</div>
						<?php }else{ ?>
						<a href="index.php?page=subject&action=show_add_form" class="btn btn-primary">Add Subject</a>
							

						<?php }?>


						<?php if ($show_edit_form == 1) { ?>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<form class="form-inline" role="form" method="Post" enctype="multipart/form-data" action="<?php echo $action_url; ?>">
										<input type="hidden" name="subjectID" value="<?php if (isset($id)) {
											echo $id;
										} ?>">
										<input type="text" class="form-control" id="subject_name" placeholder="Subject_name" name="subject_name" value="<?php if (isset($subject_name_prev)) {
											echo $subject_name_prev;
										} ?>">
										<input type="submit" name="submit" value="Update" class="btn btn-primary">
									<a href="index.php?page=subject" class="btn btn-danger">Cancel</a>

									</form>
								</div>
							</div>
						<?php } ?>


						<div class="row">
							<div class="container">	
									<table class="table table-responsive table-stripped">
										<tr class="success">
											<td>Subject Name</td>
											<td>Action</td>
										</tr>
										<?php foreach ($all_subject as $value) { ?>
										<tr>
											<td><?php echo $value['subject_name']; ?></td>
											<td><a href="index.php?page=subject&action=edit&id=<?php echo $value['subjectID']; ?>" class="btn btn-warning">Edit</a></td>
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