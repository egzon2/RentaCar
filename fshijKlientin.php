<?php
 include_once 'includes/sqlFunctions.php';

 function fshijKlientin(){
     $klientiid = $_POST['klientiid'];
     $dbconn = connection();
     $sql = "DELETE FROM klientet Where klientiid = $klientiid";
     $result = mysqli_query($dbconn, $sql);
     
     if($result){
         header('Location: klientet.php');
     }
 }

    fshijKlientin();

?>