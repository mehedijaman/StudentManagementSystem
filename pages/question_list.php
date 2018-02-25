<?php 
	include('lib/class.db.inc');
	include('lib/class.subject.inc');
	include('lib/class.q_set.inc');
	include('lib/class.chapter.inc');
	include('lib/class.question.inc');

	$objSubject = new subject;
	$objSet = new q_set;
	$objChapter = new chapter;
	$objQuestion = new question;

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'show_all') {
			$all_question = $objQuestion->get_all();
		}

		if ($_REQUEST['action'] == 'show_subjectwise') {
			$all_subject = $objSubject->get_all();
		}

		if ($_REQUEST['action'] == 'show_chapterwise') {
			$all_subjects = $objSubject->get_all();			
			$all_chapter = $objChapter->get_all();
		}

		if ($_REQUEST['action'] == 'show_setwise') {

			$all_set = $objSet->get_all();
		}
	}


	if (isset($_REQUEST['submit'])) {

		if ($_REQUEST['submit'] == 'Show SubjectWise List') {
			$subjectID = $_REQUEST['subjectID'];

			$all_question = $objQuestion->get_all_by_subject($subjectID);
		}


		if ($_REQUEST['submit'] == 'Show ChapterWise List') {

			$chapterID = $_REQUEST['chapterID'];
			$subjectID = $_REQUEST['subjectID'];
			$all_question = $objQuestion->get_all_by_chapter($subjectID,$chapterID);
		}


		if ($_REQUEST['submit' == 'Show SetWise List']) {
			$setID = $_REQUEST['setID'];

			$all_question = $objQuestion->get_all_by_set($setID);
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
										<li>Question</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										
										<div class="col-md-6">
											<a href="index.php?page=question_list&action=show_all" class="btn btn-primary">All Questions</a>
											<a href="index.php?page=question_list&action=show_subjectwise" class="btn btn-primary">SubjectWise</a>
											<a href="index.php?page=question_list&action=show_chapterwise" class="btn btn-primary">ChapterWiese</a>
											<a href="index.php?page=question_list&action=show_setwise" class="btn btn-primary">SETWise</a>
										</div>

										<div class="col-md-6">
											<?php if (isset($all_subject)) { ?>										
											<form role='form' method="POST" encytype="multipart/form-data" action="<?php echo $action_url; ?>"  >
												<div class="col-md-4">
													<select name="subjectID" class="form-control">
													<?php foreach ($all_subject as $subject) { ?>
														<option value="<?php echo $subject['subjectID']; ?>"><?php echo $subject['subject_name']; ?></option>
													<?php } ?>												
												</select>
												</div>

												<div class="col-md-4">
													<input name="submit" type="submit" value="Show SubjectWise List" class="btn btn-primary"> 
												</div>
											</form>
											<?php } ?>

											<?php if (isset($all_chapter) && isset($all_subjects)) { ?>										
											<form role='form' method="POST" encytype="multipart/form-data" action="<?php echo $action_url; ?>"  >

												<div class="col-md-4">
													<select name="subjectID" class="form-control" >
													<?php foreach ($all_subjects as $subject) { ?>
														<option value="<?php echo $subject['subjectID']; ?>"><?php echo $subject['subject_name']; ?></option>
													<?php } ?>												
													</select>
												</div>

												<div class="col-md-4">
													<select name="chapterID" class="form-control" >
													<?php foreach ($all_chapter as $chapter) { ?>
														<option value="<?php echo $chapter['chapterID']; ?>"><?php echo $chapter['chapter_name']; ?></option>
													<?php } ?>												
													</select>
												</div>

												<div class="col-md-4">
													<input name="submit" type="submit" value="Show ChapterWise List" class="btn btn-primary">
												</div>
											</form>
											<?php } ?>

											<?php if (isset($all_set)) { ?>										
											<form role='form' method="POST" encytype="multipart/form-data" action="<?php echo $action_url; ?>"  >
												<div class="col-md-4">
													<select name="setID" class="form-control">
													<?php foreach ($all_set as $set) { ?>
														<option value="<?php echo $set['setID']; ?>"><?php echo $set['set_name']; ?></option>
													<?php } ?>												
													</select>
												</div>

												<div class="col-md-4">
													<input name="submit" type="submit" value="Show SetWise List" class="btn btn-primary"> 
												</div>
											</form>
											<?php } ?>
										</div>




									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<!-- Page Main Content -->

						<div class="row">
							<div class="container">								
								
								<table class="table table-responsive table-stripped">
									<tr class="success">
										<td>#</td>
										<td>Question</td>
										<td>Ans1</td>
										<td>Ans2</td>
										<td>Ans3</td>
										<td>Ans4</td>
										<td>True</td>
										<td>Action</td>
									</tr>
									<?php 
										$serial_number = 0;
										foreach ($all_question as $question) { 
											$serial_number++;
									?>
									<tr>
										<td><?php echo $serial_number; ?></td>
										<td><?php echo $question['question_description']; ?></td>
										<td><?php echo $question['ans_one']; ?></td>
										<td><?php echo $question['ans_two']; ?></td>
										<td><?php echo $question['ans_three']; ?></td>
										<td><?php echo $question['ans_four']; ?></td>
										<td><?php echo $question['true_ans']; ?></td>
										<td>
											<a href="index.php?page=question_edit&action=edit&id=<?php echo $question['questionID']; ?>">Edit</a>
											<a href="index.php?page=question_list&action=delete&id=<?php echo $question['questionID']; ?>">Delete</a>

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