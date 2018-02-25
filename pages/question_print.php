<?php 
	include('lib/class.db.inc');
	include('lib/class.subject.inc');
	include('lib/class.q_set.inc');
	include('lib/class.chapter.inc');

	$objSubject = new subject;
	$objSet = new q_set;
	$objChapter = new chapter;

	$all_subject = $objSubject->get_all();
	$all_set = $objSet->get_all();
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
										<li>Question</li>
									</ul>
									<!-- /BREADCRUMBS -->
									<div class="clearfix">
										<h3 class="content-title pull-left">Print Question</h3>
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
									<form target="_blank" role="form" enctype="multipart/form-data" method="POST" action="pages/print.php">
										<div class="form-group">
											<input type="text" class="form-control" id="exam_name" name="exam_name" placeholder="Exam Name">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" id="time" name="time" placeholder="Time e.g. 40 Mins">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" id="full-marks" name="full_marks" placeholder="Full Marks">
										</div>
										<div class="form-group">
											<input type="number" class="form-control" id="number_of_questions" name="number_of_questions" placeholder="Number of Questions">
										</div>
										<div class="form-group">
											<select name="subjectID" class="form-control">
												<option value="0">Subject</option>
												<?php foreach ($all_subject as $subject) { ?>
													<option value="<?php echo $subject['subjectID']; ?>"><?php echo $subject['subject_name']; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<select name="chapterID" class="form-control">
												<option value="0"> Chapter</option>
												<?php foreach ($all_chapter as $chapter) { ?>
													<option value="<?php echo $chapter['chapterID']; ?>"><?php echo $chapter['chapter_name']; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<select name="setID" class="form-control">
												<option value="0">SET</option>
												<?php foreach ($all_set as $set) { ?>
													<option value="<?php echo $set['setID']; ?>"><?php echo $set['set_name']; ?></option>
												<?php } ?>
											</select>
										</div>

										<input type="submit" name="submit" value="Print" class="btn btn-primary btn-block">
									</form>
								</div>
							</div>
						</div>

						<!-- /PageMain Content -->

					</div>
				</div>
			</div>
		</div>