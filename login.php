<?php 
	session_start();

	include('lib/class.db.inc');
	include('lib/class.credentials.inc');

	$objCredentials = new credentials;	
	
	if (isset($_REQUEST['submit'])) {
		if ($_REQUEST['submit'] == 'Login') {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			// $result = $objCredentials->check_credentials($username,$password);
			// if ($result == 0 ) {
			// 	$action_msg = "Wrong Credentials !";
			// }
			// else
			// {
			// 	$_SESSION['isThatOk'] = 'ok';
			// 	header("Location:index.php");
			//}
			if ($username == 'mehedi@visionstudio.com.bd' && $password == 'admin') {
				$_SESSION['isThatOk'] = 'ok';
				header("Location:index.php");
			}
			else
				$action_msg = "Wrong Credentials !";
			
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Computer.Edu | Login____[Developed by - Vision Studio Software]</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="An Automatic Coaching Management System Developed by Vision Studio Software">
	<meta name="author" content="Vision Studio Software">
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >
	
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- UNIFORM -->
	<link rel="stylesheet" type="text/css" href="js/uniform/css/uniform.default.min.css" />
	<!-- ANIMATE -->
	<link rel="stylesheet" type="text/css" href="css/animatecss/animate.min.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body class="login">	
	<!-- PAGE -->
	<section id="page">
			<!-- HEADER -->
			<header>
				<!-- NAV-BAR -->
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div id="logo">
								<a href="index.php"><img src="img/logo/logo.png" height="40" alt="logo name" /></a>
							</div>
						</div>
					</div>
				</div>
				<!--/NAV-BAR -->
			</header>
			<!--/HEADER -->
			<!-- LOGIN -->
			<section id="login_bg" class="visible">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="login-box">
								<h2 class="bigintro">Sign In</h2>
								<div class="divide-40"></div>
								<form role="form" enctype="multipart/form-data" action="login.php" method="post" >
								  <div class="form-group">
									<label for="exampleInputEmail1">Email address</label>
									<i class="fa fa-envelope"></i>
									<input type="text" name="username" class="form-control" id="exampleInputEmail1" required >
								  </div>
								  <div class="form-group"> 
									<label for="exampleInputPassword1">Password</label>
									<i class="fa fa-lock"></i>
									<input type="password" name="password" class="form-control" id="exampleInputPassword1" required >
								  </div>
								  <div>
									<button type="submit" name="submit" class="btn btn-danger" value="Login">Submit</button>
								  </div>
								  <?php if (isset($action_msg)) {
								  	echo $action_msg;
								  } ?>
								</form>								
							</div>
							<hr>
							<?php 
								echo '<h5 align="center">Developed by - <strong><a href="http://www.visionstudio.com.bd" target="_blank"><img height="70" width="150" src="img/logo/developer-logo.png" alt=""></a></strong></h5>';
							?>

						</div>
					</div>
				</div>
			</section>
			<!--/LOGIN -->
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="bootstrap-dist/js/bootstrap.min.js"></script>
	
	
	<!-- UNIFORM -->
	<script type="text/javascript" src="js/uniform/jquery.uniform.min.js"></script>
	<!-- BACKSTRETCH -->
	<script type="text/javascript" src="js/backstretch/jquery.backstretch.min.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="js/script.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("login_bg");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<script type="text/javascript">
		function swapScreen(id) {
			jQuery('.visible').removeClass('visible animated fadeInUp');
			jQuery('#'+id).addClass('visible animated fadeInUp');
		}
	</script>
	<!-- /JAVASCRIPTS -->
</body>
</html>