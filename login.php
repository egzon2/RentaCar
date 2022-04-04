<?php include_once 'includes/sqlFunctions.php' ?>
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

<body style="background-color: #e8e8e8;">
    <div class="login-page">
        <h1>Login</h1>
        
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
            <a style="color: #009933; text-decoration:none;padding-left:10px" href="forgotPassword.php">Keni harruar Passwordin</a></span></p>
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

</html>