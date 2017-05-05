<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);

	if($user_login->login($email,$upass))
	{
		$user_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>cloudficient | login</title>
		<link rel="shortcut icon" type="assets" href="favicon.ico" />
    <!-- Bootstrap -->

		<!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="assets/acs.css">
		<!--
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen"> -->

     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body class="blank" id="login">
		<!-- Simple splash screen-->
		<div class="splash">
			<div class="color-line"></div>
			<div class="splash-title">
				<h1>cloudficient | signup</h1>
				<div class="spinner">
					<div class="rect1"></div>
					<div class="rect2"></div>
					<div class="rect3"></div>
					<div class="rect4"></div>
					<div class="rect5"></div>
				</div>
			</div>
		</div>
		<!--[if lt IE 7]>
		<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div class="color-line"></div>

		<div class="back-link">
				<a href="index.html" class="btn btn-primary">Back</a>
		</div>

    <div class="login-container">
		<?php
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Details!</strong>
			</div>
            <?php
		}
		?>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>PLEASE LOGIN</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="user@contoso.com" title="Please enter you username" required="" value="" name="txtemail" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="txtupass" id="password" class="form-control">
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" class="i-checks" checked>
                                     Remember login
                                <p class="help-block small">(if this is a private computer)</p>
                            </div>
                            <button class="btn btn-success btn-block" type="submit" name="btn-login">Login</button>
                            <a class="btn btn-default btn-block" href="signup.php">Register</a>
                            <a class="btn btn-default btn-block" href="fpass.php">Lost your password?</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            &copy; cloudficient software AG i.G. - 2017- All Rights Reserved
        </div>
    </div>
</div>
<!-- /container -->
		<!-- Vendor scripts -->
		<script src="vendor/jquery/dist/jquery.min.js"></script>
		<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
		<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
		<script src="vendor/iCheck/icheck.min.js"></script>
		<script src="vendor/sparkline/index.js"></script>

		<!-- App scripts -->
		<script src="assets/homer.js"></script>
  </body>
</html>
