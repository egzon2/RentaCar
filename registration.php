<?php include_once ("controller.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form In PHP</title>
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
    <div id="container">
        <h2>Sign Up</h2>
        <p>It's quick and easy.</p>
        <div id="line"></div>
        <form action="registration.php" method="POST" autocomplete="off">
        <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?> 
            <input type="text" name="fname" class="name" placeholder="First Name" required>
            <input type="text" name="lname" class="name" placeholder="Last Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" required><br>
            <input type="radio" name="gender" id="male" value="male" required><label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="female" required><label for="female">Female</label>
            <input type="radio" name="gender" id="other" value="other" required><label for="other">Other</label><br>
            <h5>By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS
                notifications from us and can opt out at any time.</h5>
            <input type="submit" name="signup" value="Sign Up">
        </form>
        <h3>Already have a account? <a href="login.php">Login</a></h3>
    </div>
</body>
</html>