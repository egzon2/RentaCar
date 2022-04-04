
<!DOCTYPE html>
<html>

<head>
    <title>Rent a car</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://use.fontawesome.com/3ca95fdef9.js"></script>
    <style>
        .errors {
            color: red;
            font-size: 14px;
            float: left;
            margin-left: 30px;
            margin: -12px 0px -12px 30px;
        }
    </style>
</head>
<?php
    include_once 'includes/sqlFunctions.php';
    if(isset($_POST['register'])){
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $email = $_POST['email'];
        $telefoni = $_POST['telefoni'];
        $nr_personal = $_POST['nr_personal'];
        $adresa = $_POST['adresa'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $result = register($emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa, $username, $password);

        if($result){
            header('Location: login.php');
        }

    }
?>
<body style="background-color: #009933;">
    <div class="login-page" style="width: 600px;">
        <h1>Register</h1>

        <p class="errors"></p>
        <form class="login-form" id="loginForm" method="post">
            <input type="text" placeholder="Emri..." name="emri">
            <input type="text" placeholder="Mbiemri..." name="mbiemri">
            <input type="email" placeholder="Email..." name="email">
            <input type="text" placeholder="Telefoni..." name="telefoni">
            <input type="text" placeholder="Numri personal..." name="nr_personal">
            <input type="text" placeholder="Adresa..." name="adresa">
            <input type="text" placeholder="Username..." id="username" name="username" />
            <input type="password" placeholder="Password..." id="password" name="password" />
            <p style="margin-right: 33px;float:right">Keni account?<span style="color: #009933;"><a
                        style="color: #009933;text-decoration:none; padding-left:10px"
                        href="login.php">Login</a></span></p>
            <input type="submit" value="Register" name="register">
        </form>
    </div>
</body>

</html>