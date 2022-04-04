<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
    <title>Rent a car</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
    <script src="https://use.fontawesome.com/3ca95fdef9.js"></script>
</head>

<body>
    <div class="container">
        <div id="header">
            <div id="logo">
                <img src="images/logo.png" alt="Logo" width="100" height="50">
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php" class="active">Ballina</a></li>   

                    <?php if(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 1) { ?>

                        <li><a href="klientet.php">Klientet</a></li>
                        <li><a href="kategorite.php">Kategorite</a></li>
                        <li><a href="automjetet.php">Automjetet</a></li>
                        <li><a href="rezervimet.php">Rezervimet</a></li>            
                        <li><a href="logout.php">Logout</a></li>
                        <li style = "margin-left:100px;"><i class = "fa fa-user"></i><?php echo $_SESSION['emri'] . " " .$_SESSION['mbiemri']; ?></li>
                        <?php } elseif(isset($_SESSION['klientiid']) && $_SESSION['roli'] == 0){?>                
                            <li><a href="kategorite.php">Kategorite</a></li>
                            <li><a href="automjetet.php">Automjetet</a></li>
                            <li><a href="rezervimet.php">Rezervimet</a></li>            
                            <li><a href="logout.php">Logout</a></li>
                            <li style = "margin-left:100px;"><i class = "fa fa-user"></i><?php echo $_SESSION['emri'] . " " .$_SESSION['mbiemri']; ?></li>
                        <?php } else {?>
                            <li><a href="kategorite.php">Kategorite</a></li>
                            <li><a href="automjetet.php">Automjetet</a></li>
                            <li><a href="login.php">Login</a></li>                                            
                        <?php }?>

                </ul>
            </div>
            <p style="color: #009933;float:right;margin-right:50px;margin-top:40px"></p>
            <div style="clear: both;"></div>
        </div>

        <!-- ============================================== -->
