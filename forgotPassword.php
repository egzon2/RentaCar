<?php 
include_once 'includes/sqlFunctions.php';
session_start();
$error = array();

require "mail.php";

	if(!$dbconn = mysqli_connect("localhost","root","","rentacardb")){

		die("could not connect");
	}

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: forgotPassword.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgotPassword.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgotPassword.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: login.php");
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $dbconn;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($dbconn,$query);

		//send email here
		send_mail($email,'Password reset',"Your code is " . $code);
	}
	
	function save_password($password){
		
		global $dbconn;

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$sql = "update klientet set password = '$password' where email = '$email' limit 1";
		mysqli_query($dbconn,$sql);

	}
	
	function valid_email($email){
		global $dbconn;

		$email = addslashes($email);

		$query = "select * from klientet where email = '$email' limit 1";		
		$result = mysqli_query($dbconn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($code){
		global $dbconn;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($dbconn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "the code is correct";
				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot</title>
</head>
<body>
<style type="text/css">
	
	*{
		font-family: tahoma;
		font-size: 13px;

	}

	form{
		width: 250px;
        height: auto;
        background-color: #fff;
        position: absolute;
        text-align: center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 3px 3px 15px #fff;
		border: solid thin #ccc;
        padding-bottom: 10px;
	}

	.textbox{
		padding: 5px;
		width: 180px;
	}
</style>

		<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
						<form method="post" action="forgotPassword.php?mode=enter_email"> 
							<h1>Keni harruar passwordin</h1>
							<h3>Shkruj email tuaj</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<input class="textbox" type="email" name="email" placeholder="Email"><br>
							<br style="clear: both;">
							<input type="submit" value="Enter">
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php				
					break;

				case 'enter_code':
					// code...
					?>
						<form method="post" action="forgotPassword.php?mode=enter_code"> 
							<h1>Keni harruar passwordin</h1>
							<h3>Shkruaj kodin i cili eshte derguar ne imellen tuaj</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="textbox" type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="forgotPassword.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						<form method="post" action="forgotPassword.php?mode=enter_password"> 
							<h1>Forgot Password</h1>
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="textbox" type="text" name="password" placeholder="Password"><br>
							<input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="forgotPassword.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>


</body>
</html>


<!-- <?php include_once 'includes/sqlFunctions.php' ?>
<!DOCTYPE html>
<html>

<head>
    <title>Rent a car</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://use.fontawesome.com/3ca95fdef9.js"></script>
    <style>
        .errors{
            color: red;
            font-size: 12px;
            float: left;
            margin-left: 30px;
            margin: -12px 0px -12px 30px;
        }
    </style>
</head>

<?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username, $password);
    }
?>

<body style="background-color: #009933;">
    <div class="login-page">
        <h1>Forgot Password</h1>
        
        <p class="errors" style="margin-bottom: 5px;"></p>
        <form class="login-form" id="loginForm" method="post">
            <input type="text" placeholder="username" id="username" name="username"/>
            <p id="usernameMessage" class="errors"></p>
            <div style="clear: both;"></div>
            <input type="password" placeholder="password" id="password" name="password"/>
            <p id="passwordMessage" class="errors"></p>
            <div style="clear: both;"></div>
            <p style="margin-right: 15px; float:right">Nuk keni akoma account?<span><a style="color: #009933;text-decoration:none;padding-left:10px" href="register.php">Regjstrohu</a></span></p>
            <input type="submit" value="Login" name="login">
            <a style="color: #009933; text-decoration:none;padding-left:10px" href="register.php">Keni harruar Passwordin</a></span></p>
        </form>
    </div>

    <script src="js/jQuery.js"></script>
    <script>
        $(document).ready(function(){
            $("#loginForm").submit(function(){
                var username = $("#username").val();
                var password = $("#password").val();
                var errors = false;
                if(username == ""){
                    $("#usernameMessage").html("Ju lutem shkruani username-in!");
                    errors = true;
                }else{
                    $("#usernameMessage").html("");
                    errors = false;
                }
                if(password == ""){
                    $("#passwordMessage").html("Ju lutem shkruani password-in!");
                    errors = true;
                }else{
                    $("#passwordMessage").html("");
                    errors = false;
                }
                if(errors){
                    return false;
                }else{
                    return true;
                }
            });
        });
    </script>
</body>

</html> -->