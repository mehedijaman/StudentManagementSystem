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

	$all_subject = $objSubject->get_all();
	$all_set = $objSet->get_all();
	$all_chapter = $objChapter->get_all();

	$action_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == 'edit') {
			$id = $_REQUEST['id'];

			$question_details = $objQuestion->get_by_pk($id);

			$question_description_prev = $question_details[0]['question_description'];
			$ans_one_prev = $question_details[0]['ans_one'];
			$ans_two_prev = $question_details[0]['ans_two'];
			$ans_three_prev = $question_details[0]['ans_three'];
			$ans_four_prev = $question_details[0]['ans_four'];
		}
	}

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Update') {
			$data = array(
				'questionID' => $_REQUEST['questionID'],
				'subjectID' => $_REQUEST['subjectID'], 
				'chapterID' => $_REQUEST['chapterID'], 
				'setID' => $_REQUEST['setID'], 
				'question_description' => $_REQUEST['question_description'], 
				'ans_one' => $_REQUEST['ans_one'], 
				'ans_two' => $_REQUEST['ans_two'], 
				'ans_three' => $_REQUEST['ans_three'], 
				'ans_four' => $_REQUEST['ans_four'], 
				'true_ans' => $_REQUEST['true_ans'] 
			);

			$objQuestion->update($data);
			$action_msg = "Question Updated Successfully !";
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
										<h3 class="content-title pull-left">Edit Question</h3>
									</div>
									<!-- <div class="description">Blank Page</div> -->
								</div>
							</div>
						</div>
						<!-- /PAGE HEADER -->

						<!-- Page Main Content -->
						<div class="row">
						
							<div class="col-md-8 col-md-offset-2">
								<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
									<input type="hidden" name="questionID" value="<?php if (isset($id)) {
										echo $id;
									} ?>">
										<div class="form-group">
											<label for="subjectID" class="col-sm-2 control-label">Subject :</label>
											<div class="col-sm-10">
												<select name="subjectID" class="form-control" id="subjectID">
													<?php foreach ($all_subject as $value) { ?>
													<option value="<?php echo $value['subjectID']; ?>"><?php echo $value['subject_name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="chapterID" class="col-sm-2 control-label">Chapter :</label>
											<div class="col-sm-10">
												<select name="chapterID" id="chapterID" class="form-control">
												<?php foreach ($all_chapter as $chapter) { ?>
													
													<option value="<?php echo $chapter['chapterID']; ?>"><?php echo $chapter['chapter_name'] ;?></option>
												<?php } ?>

												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="setID" class="col-sm-2 control-label">SET :</label>
											<div class="col-sm-10">
												<select name="setID"  id="setID" class="form-control">
													<?php foreach ($all_set as $set) { ?>
													<option value="<?php echo $set['setID']; ?>"><?php echo $set['set_name']; ?></option>
													<?php } ?>											
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="question_description" class="col-sm-2 control-label">Question :</label>
											<div class="col-sm-10">
												<input name="question_description" type="text" class="form-control" id="question_description" placeholder="Question_description" value="<?php if (isset($question_description_prev)) {
													echo $question_description_prev;
												} ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="ans_one" class="col-sm-2 control-label">Ans_one :</label>
											<div class="col-sm-10">
												<input name="ans_one" type="text" class="form-control" id="ans_one" placeholder="Ans_one" value="<?php if (isset($ans_one_prev)) {
													echo $ans_one_prev;
												} ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="ans_two" class="col-sm-2 control-label">Ans_two :</label>
											<div class="col-sm-10">
												<input name="ans_two" type="text" class="form-control" id="ans_two" placeholder="Ans_two" value="<?php if (isset($ans_two_prev)) {
													echo $ans_two_prev;
												} ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="ans_three" class="col-sm-2 control-label">Ans_three :</label>
											<div class="col-sm-10">
												<input name="ans_three" type="text" class="form-control" id="ans_three" placeholder="Ans_three" value="<?php if (isset($ans_three_prev)) {
													echo $ans_three_prev;
												} ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="ans_four" class="col-sm-2 control-label">Ans_four :</label>
											<div class="col-sm-10">
												<input name="ans_four" type="text" class="form-control" id="ans_four" placeholder="Ans_four" value="<?php if (isset($ans_four_prev)) {
													echo $ans_four_prev;
												} ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="true_ans" class="col-sm-2 control-label">True_ans :</label>
											<div class="col-sm-10">
												<select class="form-control" name="true_ans" id="true_ans">
													<option value="a">1</option>
													<option value="b">2</option>
													<option value="c">3</option>
													<option value="d">4</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-danger">Cancel</button>
											</div>
										</div>
								</form>   
							</div>
						</div>

						<!-- /PageMain Content -->

					</div>
				</div>
			</div>
		</div>