<?php 
	include('../lib/class.db.inc');
	include('../lib/class.subject.inc');
	include('../lib/class.q_set.inc');
	include('../lib/class.chapter.inc');
	include('../lib/class.question.inc');

	$objSubject = new subject;
	$objSet = new q_set;
	$objChapter = new chapter;
	$objQuestion = new question;

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Print') {
			$exam_name = $_REQUEST['exam_name'];
			$time = $_REQUEST['time'];
			$full_marks = @$_REQUEST['full_marks'];
			$number_of_questions = @$_REQUEST['number_of_questions'];
			$subjectID = @$_REQUEST['subjectID'];
			$chapterID = @$_REQUEST['chapterID'];
			$setID = @$_REQUEST['setID'];

			if (@$subjectID == 0 && $chapterID == 0 && $setID == 0) {
				$all_question = $objQuestion->print_000($number_of_questions);
			}

			if ($subjectID == 0 && $chapterID == 0 && $setID != 0) {
				$all_question = $objQuestion->print_001($number_of_questions, $setID);
			}

			if ($subjectID == 0 && $chapterID != 0 && $setID == 0) {
				$all_question = $objQuestion->print_010($number_of_questions, $chapterID);
			}

			if($subjectID == 0 && $chapterID != 0 && $setID !=0){
				$all_question = $objQuestion->print_011($number_of_questions, $chapterID, $setID);
			}

			if ($subjectID != 0 && $chapterID == 0 && $setID ==0) {
				$all_question = $objQuestion->print_100($number_of_questions, $subjectID);
			}

			if ($subjectID != 0 && $chapterID == 0 && $setID !=0) {
				$all_question = $objQuestion->print_101($number_of_questions, $subjectID, $setID );
			}

			if ($subjectID != 0 && $chapterID != 0 && $setID == 0) {
				$all_question = $objQuestion->print_110($number_of_questions, $subjectID, $chapterID);
			}

			if ($subjectID != 0 && $chapterID != 0 && $setID != 0) {
				$all_question = $objQuestion->print_111($number_of_questions, $subjectID, $chapterID, $setID);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title><?php echo $exam_name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="An Automatic Coaching Management System Developed by Vision Studio Software">
	<meta name="author" content="Vision Studio Software">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="../css/cloud-admin.css" >
	<link rel="stylesheet" type="text/css"  href="../css/themes/default.css" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="../css/responsive.css" >
	
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="../js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- SELECT2 -->
	<link rel="stylesheet" type="text/css" href="../js/select2/select2.min.css" />
	<!-- UNIFORM -->
	<link rel="stylesheet" type="text/css" href="../js/uniform/css/uniform.default.min.css" />
	<!-- WIZARD -->
	<link rel="stylesheet" type="text/css" href="../js/bootstrap-wizard/wizard.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<!-- SELECT PICKEr -->
	<link rel="stylesheet" href="../css/bootstrap-select.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h3 class="center">Computer.Edu</h3>
		</div>

		<div class="row">
			<div class="col-md-6">
				<table class="table table-responsive">
					<tr>
						<td>Time: <?php echo $time; ?></td>
						<td>Exam Name: <?php echo $exam_name; ?></td>
						<td>Full Marks: <?php echo $full_marks; ?></td>
					</tr>
					<tr>
						<td>Name:________________________</td>
						<td>Batch:________________</td>
						<td>Roll:________________</td>
					</tr>
				</table>
			</div>
			<!-- <div class="col-md-2">
				
			</div>
			<div class="col-md-2">
				
			</div>
			<div class="col-md-2">
				
			</div> -->
		</div>

		<div class="row">
			<?php 
				$counter = 0;
				foreach ($all_question as $question) { 
					$counter++;
					echo "<br><strong>".$counter."</strong>. ".$question['question_description']."<br>";
					echo "A. ".$question['ans_one']." B. ".$question['ans_two']." ";
					echo "C. ".$question['ans_three']." D.".$question['ans_four'];

			?>


			<?php } ?>
		</div>
	</div>
</body>
</html>