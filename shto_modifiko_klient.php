<?php include_once 'includes/sqlFunctions.php';?>
<!DOCTYPE html>
<html>

<head>
    <title>Rent a car</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
    <script src="https://use.fontawesome.com/3ca95fdef9.js"></script>
    <style>
        #shtoForma {
            width: 90%;
            margin: 50px 40px;
        }

        #hi {
            color: #009933;
            padding: 20px 0px 10px 10px;
            margin: 0px 15px;
            font-size: 25px;
            border-bottom: 2px solid #009933;
        }

        label,
        input {
            width: 100%;
            padding: 10px;
        }

        label {
            color: #009933;
            font-weight: bold;
            margin-left: -10px;
        }

        input {
            outline: none;
            margin: 10px 0px;
        }

        input[type='submit'] {
            width: 150px;
            float: right;
            margin: 30px 0px;
            margin-right: -25px;
            color: #fff;
            background-color: #009933;
            border: none;
        }

        input[type='submit']:hover {
            transform: scale(1.1);
        }
    </style>
</head>
 <?php
    if (isset($_GET['klientiid'])){
    
        $klienti = mysqli_fetch_assoc(merrKlientiId($_GET['klientiid']));
    }

    if(isset($_POST['modifikoKlient'])){
        $id = $_GET['klientiid'];
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $email = $_POST['email'];
        $telefoni = $_POST['telefoni'];
        $nr_personal = $_POST['nr_personal'];
        $adresa = $_POST['adresa'];

        modifikoKlient( $id, $emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa );

    }


    if(isset($_POST['shtoKlient'])){
        $check = true;

        if( $_POST['emri'] != null )
        {
            $emri = $_POST['emri'];
        }else {
            $check = false;
        }

        if( $_POST['mbiemri'] != null )
        {
            $mbiemri = $_POST['mbiemri'];
        }else {
            $check = false;
        }

        if( $_POST['email'] != null )
        {
            $email = $_POST['email'];
        }else {
            $check = false;
        }

        if( $_POST['telefoni'] != null )
        {
            $telefoni = $_POST['telefoni'];
        }else {
            $check = false;
        }
        
        if( $_POST['nr_personal'] != null )
        {
            $nr_personal = $_POST['nr_personal'];
        }else {
            $check = false;
        }
        
        if( $_POST['adresa'] != null )
        {
            $adresa = $_POST['adresa'];
        }else {
            $check = false;
        }
        
        if($check){
            shtoKlient($emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa);
        } else {
            echo "<script>alert('Nuk lejohen fusha te zbrazta!')</script>";
        }

    }




 ?>
<body>
    <div class="container">
        <div id="header">
            <div id="logo">
                <img src="images/logo.png" alt="Logo" width="100" height="50">
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="active">Ballina</a></li>
                    <li><a href="klientet.php">Klientet</a></li>
                    <li><a href="automjetet.php">Automjetet</a></li>
                    <li><a href="rezervimet.php">Rezervimet</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <p style="color: #009933;float:right;margin-right:50px;margin-top:40px"></p>
            <div style="clear: both;"></div>
        </div>
        <div id="main">
            <div id="slide-bar">
                <div class="image">  
                    <?php                
                    if(isset($_GET['klientiid'])) {
                        echo '<h1>Modifikimi i klientit</h1>';   
                        } else {             
                          echo '<h1>Shtimi i klientit</h1>';         
                        } 
                    ?>           
                </div>
            </div>      

            <?php                
                    if(isset($_GET['klientiid'])) {
                        echo '<h1 id="hi">Forma per modifikimin e klientit</h1> ';   
                        } else {             
                          echo '<h1 id="hi">Forma per shtimin e klientit</h1>            ';         
                        } 
                    ?>                   
            <form method="post" id="shtoForma">
                <label for="emri">Emri</label>
                <input type="text" name="emri" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['emri']; endif ?>">
                <label for="mbiemri">Mbiemri</label>
                <input type="text" name="mbiemri" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['mbiemri']; endif ?>">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['email']; endif ?>">
                <label for="telefoni">Telefoni</label>
                <input type="text" name="telefoni" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['telefoni']; endif ?>">
                <label for="nr_personal">Numri Personal</label>
                <input type="text" name="nr_personal" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['nr_personal']; endif ?>">
                <label for="adresa">Adresa</label>
                <input type="text" name="adresa" value="<?php if (isset($_GET['klientiid'])) : echo $klienti['adresa']; endif ?>">      
                <?php                
                    if(isset($_GET['klientiid'])) {
                        echo '<input type="submit" name="modifikoKlient" value="Modifiko klient">';   
                        } else {             
                          echo '<input type="submit" name="shtoKlient" value="Shto klient">';         
                        } 
                    ?>                                 
            </form>
            <div style="clear: both;"></div>
        </div>
        <hr>
        <div id="footer">
            <p>&copy; Rent a Car 2022. All rights reserved.</p>
            <ul>
                <li><a href="#"><img src="images/insta.png" alt="Instagram"></a></li>
                <li><a href="#"><img src="images/facebook.png" alt="Facebook"></a></li>
                <li><a href="#"><img src="images/snap.png" alt="Snapchat"></a></li>
            </ul>
        </div>
    </div>
</body>

</html>