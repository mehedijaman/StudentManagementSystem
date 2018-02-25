<?php 

	include('../lib/class.db.inc');
	include('../lib/class.student.inc');
	require('Barcode39.php');
	error_reporting(0);


	$objStudent = new student;

	$all_student = $objStudent->get_all();

	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == "Print Batchwise Barcode") {
			$batch_id = $_REQUEST['batch_id'];
			
			$student_list = $objStudent->get_batch_student($batch_id);

			if ($student_list <= 0) {
				echo "<h1>Sorry, No Student available in this batch.</h1>";
			}
		}
	}
	else if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == "print_all") {
			$student_list = $objStudent->get_all();
		}
		else if ($_REQUEST['action'] == "print_all_active") {
			$student_list = $objStudent->get_all_active();
		}
	}

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Computer.Edu :: Admin__[Developed by - Vision Studio Software]</title>
 	<link rel="stylesheet" href="../bootstrap-dist/css/bootstrap.min.css">
 	<link rel="stylesheet" href="../css/custom.css">
 </head>
 <body>

 	<?php 
 		if (isset($student_list)) {
 			foreach ($student_list as $value) {
 				$student_id = $value['computer_no'];

 				#Barcode39  Implemention
 				// set object 
				$bc = new Barcode39($student_id); 

				// set text size 
				$bc->barcode_text_size = 10; 

				// set barcode bar thickness (thick bars) 
				$bc->barcode_bar_thick = 4; 

				// set barcode bar thickness (thin bars) 
				$bc->barcode_bar_thin = 2; 

				// save barcode GIF file
				$file_name = $student_id.".gif";
				$bc->draw($file_name);
				#/Barcode39 Implemention
 	?>		
 		
 		<div class="col-sm-4">
 			<!-- <img class="img img-responsive img-thumbnail" alt="<?php echo $student_id; ?>" src="barcode.php?codetype=Code128&size=40&text=<?php echo $student_id; ?>" /><br> -->
 			<!-- <span class="barcode-id"><?php echo $student_id; ?></span><br><br> -->
 			<img  src="<?php echo $file_name; ?>"class="img img-responsive"><br>
 		</div>
		  
		
		

 	<?php }
 		} ?>
 </body>
 </html>