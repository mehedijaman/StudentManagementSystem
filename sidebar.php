<?php 
	session_start();
	if ($_SESSION['isThatOk'] != 'ok') {
		header("Location:logout.php");
		$_SESSION['isThatOk'] = 'dhandabaj';
	}
?>
	<!-- PAGE -->
	<section id="page">
				<!-- SIDEBAR -->
				<div id="sidebar" class="sidebar sidebar-fixed">
					<div class="sidebar-menu nav-collapse">
						<div class="divide-20"></div>
						<!-- SEARCH BAR -->
						<!-- <div id="search-bar">
							<input class="search" type="text" placeholder="Search"><i class="fa fa-search search-icon"></i>
						</div> -->
						<!-- /SEARCH BAR -->						
						<!-- SIDEBAR MENU -->
						<ul>
							<li>
								<a href="index.php">
								<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
								<span class="selected"></span>
								</a>					
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-user fa-user"></i> <span class="menu-text">Student</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a href="index.php?page=student_enrollment"><span class="sub-menu-text">Enrollment</span></a></li>									
									<li><a href="index.php?page=batch"><span class="sub-menu-text">Batch</span></a></li>									
									<li><a href="index.php?page=student_attendance"><span class="sub-menu-text">Attendance</span></a></li>
									<li><a href="index.php?page=student_payment"><span class="sub-menu-text">Payment</span></a></li>
									<li><a href="index.php?page=student_exam"><span class="sub-menu-text">Exam</span></a></li>
									<li><a href="index.php?page=student_result"><span class="sub-menu-text">Result</span></a></li>									
									<li><a href="index.php?page=barcode_student"><span class="sub-menu-text">Barcode</span></a></li>									
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-user fa-user"></i> <span class="menu-text">Question</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a href="index.php?page=question_list"><span class="sub-menu-text">Question List</span></a></li>						
									<li><a href="index.php?page=question_add"><span class="sub-menu-text">Add Question</span></a></li>	
									<li><a href="index.php?page=question_print"><span class="sub-menu-text">Print Question</span></a></li>								
									<li><a href="index.php?page=subject"><span class="sub-menu-text">Add Subject</span></a></li>									
									<li><a href="index.php?page=chapter"><span class="sub-menu-text">Add Chapter</span></a></li>
									<li><a href="index.php?page=set"><span class="sub-menu-text">Add Set</span></a></li>

																	
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-table fa-fw"></i> <span class="menu-text">Accounting</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="index.php?page=accounting_income"><span class="sub-menu-text">Income</span></a></li>
									<li><a class="" href="index.php?page=accounting_expense"><span class="sub-menu-text">Expense</span></a></li>									
									<li><a class="" href="index.php?page=accounting_report"><span class="sub-menu-text">Report</span></a></li>									
								</ul>
							</li>
						</ul>
						<!-- /SIDEBAR MENU -->
					</div>
				</div>
				<!-- /SIDEBAR -->