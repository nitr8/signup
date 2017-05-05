<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];

	$statusY = "Y";
	$statusN = "N";

	$stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();

			$msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>WoW !</strong>  Your Account is Now Activated
			       </div>
						 <button class='btn btn-success btn-sm success'>success</button>
			       ";
		}
		else
		{
			$msg = "
		        	<div class='alert alert-error'>
				   			<button class='close' data-dismiss='alert'>&times;</button>
					 	 		<strong>sorry !</strong>  Your Account is allready Activated
			       	</div>
							<button class='btn btn-warning btn-sm warning'>warning</button>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-error'>
			   <button class='close' data-dismiss='alert'>&times;</button>
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   </div>
			   ";
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
    <title>cloudficient | confirm registration</title>
		<link rel="shortcut icon" type="assets" href="favicon.ico" />
    <!-- Bootstrap -->

		<!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="vendor/sweetalert/lib/sweet-alert.css" />

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
				<h1>cloudficient | confirm registration</h1>
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
    <div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Confirm registration</h3>
            </div>
						<div class="text-center m-b-md">
							<?php if(isset($msg)) { echo $msg; } ?>
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
                            <button class="btn btn-success btn-block" type="submit" name="btn-login">Login</button>
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
		<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
		<script src="vendor/toastr/build/toastr.min.js"></script>

		<!-- App scripts -->
		<script src="assets/homer.js"></script>
<script>

    $(function () {

        $('.demo1').click(function(){
            swal({
                title: "Welcome in Alerts",
                text: "Lorem Ipsum is simply dummy text of the printing and typesetting industry."
            });
        });

        $('.success').click(function(){
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success"
            });
        });

        $('.warning').click(function () {
            swal({
                        title: "Are you sure?",
                        text: "account already activated!",
                        type: "warning",
                        showCancelButton: false,

                    },
                    function () {
                        swal("Booyah!");
                    });
        });

        $('.warning-o').click(function () {
            swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
        });

    });

</script>
  </body>
</html>
