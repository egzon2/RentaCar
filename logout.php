<?php
    session_start();
    
    session_destroy();


    // unset($_SESSIONp['klientiid']);
    // unset($_SESSIONp['emri']);
    // unset($_SESSIONp['mbiemri']);
    // unset($_SESSIONp['roli']);
    
     header("Location: index.php");

?>