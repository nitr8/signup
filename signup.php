<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));

	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{
			$id = $reg_user->lasdID();
			$key = base64_encode($id);
			$id = $key;

			$message = "
						Hello $uname,
						<br /><br />
						Welcome to cloudficient!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://localhost/x/verify.php?id=$id&code=$code'>Click HERE to activate :)</a>
						<br /><br />
						Thanks,";

			$subject = "cloudficient activation";

			$reg_user->send_mail($email,$message,$subject);
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account.
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}
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
    <title>cloudficient | signup</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" type="assets" href="favicon.ico" />

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="assets/acs.css">

</head>
<body class="blank">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>cloudficient | signup</h1><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line"></div>
<div class="back-link">
    <a href="https://www.cloudficient.com" class="btn btn-primary">Back</a>
</div>
<div class="register-container">
	<?php if(isset($msg)) echo $msg;  ?>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
				<img src="assets/img/cf.png" alt="logo">
                <h3>Registration</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                        <form method="post" id="loginForm">
                            <div class="row">
                            <div class="form-group col-lg-6">
                                <label>First name</label>
                                <input type="" value="" id="" class="form-control" name="txtuname">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Email address</label>
                                <input type="" value="" id="" class="form-control" name="txtemail">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Password</label>
                                <input type="password" value="" id="" class="form-control" name="txtpass">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Repeat password</label>
                                <input type="password" value="" id="" class="form-control" name="">
                            </div>
                            <div class="checkbox col-lg-12">
                                <input type="checkbox" class="i-checks" checked>
                                Sigh up for our newsletter
                            </div>
                            </div>
                            <div class="text-center">
								<button class="btn btn-large btn-primary" type="submit" name="btn-signup">Sign Up</button>
                                <button class="btn btn-large">Cancel</button>
                            </div>
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
