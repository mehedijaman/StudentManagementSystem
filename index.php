<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}
	error_reporting(0);
	$page = $_REQUEST['page'];
	
	include("header.php");
	include("sidebar.php");


	switch ($page) {
		case 'student_enrollment':
			include("pages/".$page.".php");
			break;
		// case 'student_list':
		// 	// include("pages/".$page.".php");
		// 	header("Location:student_list.php");
		// 	break;
		case 'student_all':
			include("pages/".$page.".php");
			break;
		case 'student_details':
			include("pages/".$page.".php");
			break;
		case 'student_edit':
			include("pages/".$page.".php");
			break;
		case 'batch':
			include("pages/".$page.".php");
			break;
		case 'student_attendance':
			include("pages/".$page.".php");
			break;
		case 'attendance_action':
			include("pages/".$page.".php");
			break;
		case 'student_payment':
			include("pages/".$page.".php");
			break;
		case 'student_exam':
			include("pages/".$page.".php");
			break;
		case 'student_result':
			include("pages/".$page.".php");
			break;
		case 'accounting_income':
			include("pages/".$page.".php");
			break;
		case 'accounting_income_add':
			include("pages/".$page.".php");
			break;
		case 'accounting_income_source':
			include("pages/".$page.".php");
			break;
		case 'accounting_income_report':
			include("pages/".$page.".php");			
			break;
		case 'accounting_income_statement':
			include("pages/".$page.".php");			
			break;

		case 'accounting_expense':
			include("pages/".$page.".php");
			break;
		case 'accounting_expense_report':
			include("pages/".$page.".php");
			break;
		case 'accounting_report':
			include("pages/".$page.".php");			
			break;
		case 'barcode_student':
			include("pages/".$page.".php");
			break;

		case 'question':
			include("Pages/".$page.".php");
			break;
		case 'subject':
			include("Pages/".$page.".php");
			break;
		case 'chapter':
			include("Pages/".$page.".php");
			break;
		case 'set':
			include("Pages/".$page.".php");
			break;
		case 'question_add':
			include("Pages/".$page.".php");
			break;
		case 'question_print':
			include("Pages/".$page.".php");
			break;
		case 'question_edit':
			include("Pages/".$page.".php");
			break;
		case 'question_list':
			include("Pages/".$page.".php");
			break;

		


		default:
			include("home.php");
			break;
	}
	
	
	include("footer.php");

 ?>