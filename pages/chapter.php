<?php 

	include("lib/class.db.inc");
	include("lib/class.chapter.inc");

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$objChapter = new chapter;

	$show_chapter_add = 0;

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_chapter_add') {
			$show_chapter_add = 1;
		}

		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];

			$chapter_details = $objChapter->get_by_pk($id);
			$chapter_name_prev = $chapter_details[0]['chapter_name'];

			$chapter_edit_show = 1;
		}
	}


	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Add Chapter') {
			$data = array('chapter_name' => $_REQUEST['chapter_name'] );

			$objChapter->create($data);
			$action_msg = "Chapter Added Successfully!";
			$show_chapter_add = 0;
		}


		if ($_REQUEST['submit'] == 'Update') {
			$data = array(
				'chapterID' => $_REQUEST['chapterID'] ,
				'chapter_name' =>$_REQUEST['chapter_name']
			);

			$objChapter->update($data);
			$action_msg = "Update Successful!";
			$chapter_edit_show = 0;
		}
	}



	$all_chapter = $objChapter->get_all();

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
										<li>Chapter</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Chapter</h3>
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
						<?php if ($show_chapter_add == 1) { ?>							
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>"> 
										<div class="form-group">
											<div class="col-sm-10">
												<input name="chapter_name" type="text" class="form-control" id="chapter_name" placeholder="Chapter_name">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="submit" value="Add Chapter" class="btn btn-primary">
												<a href="index.php?page=chapter" class="btn btn-danger">Cancel</a>
											</div>
										</div>
								</form> 
							</div>
						</div>

						<?php }else{ ?>	
							<div class="col-md-6 col-md-offset-3">
								<a href="index.php?page=chapter&action=show_chapter_add" class="btn btn-primary">Add Chapter</a>							
							</div>	
						<?php } ?>



						<?php if ($chapter_edit_show == 1) { ?>
							<div class="col-md-6 col-md-offset-3">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>"> 
										<div class="form-group">
											<div class="col-sm-10">
												<input type="hidden" name="chapterID" value="<?php echo $id; ?>">
												<input name="chapter_name" type="text" class="form-control" value="<?php if (isset($chapter_name_prev)) {
													echo $chapter_name_prev;
												} ?>" id="chapter_name" placeholder="Chapter_name">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="submit" value="Update" class="btn btn-primary">
												<a href="index.php?page=chapter" class="btn btn-danger">Cancel</a>
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
										<td>Chapter Name</td>
										<td>Action</td>
									</tr>
									<?php foreach ($all_chapter as $chapter) { ?>
									<tr>
										<td><?php echo $chapter['chapter_name']; ?></td>
										<td>
											<a href="index.php?page=chapter&action=edit&id=<?php echo $chapter['chapterID']; ?>">Edit</a>
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