<?php 
    global $dbconn;

    function connection()
    {
        $dbconn = mysqli_connect('localhost', 'root', '', 'rentacardb');
        if(!$dbconn){
            die(mysqli_error($dbconn));
        }
        return $dbconn;
    }

    connection();

    function register($emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa, $username, $password)
    {
        $dbconn = connection();
        $sql = "INSERT INTO klientet (emri, mbiemri, nr_personal, email, telefoni, adresa, username, password)
        VALUE ('$emri', '$mbiemri', '$nr_personal', '$email', '$telefoni', '$adresa', '$username', '$password')";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function login($username, $password)
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            if(mysqli_num_rows($result)==1){
                $res = mysqli_fetch_assoc($result);
                if(password_verify($password, $res['password'])){
                    header("Location: index.php");
                    session_start();
                    $_SESSION['klientiid'] = $res['klientiid'];
                    $_SESSION['emri'] = $res['emri'];
                    $_SESSION['mbiemri'] = $res['mbiemri'];
                    $_SESSION['roli'] = $res['roli'];
                } else {
                    echo "<script>alert('Username ose password nuk jane ne rregull!');</script>";
                }
            }
        }
    }

    function merr5KlientetEFundit()
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet ORDER BY klientiid DESC LIMIT 5";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrKlientet()
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet Where roli = 0";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

    function merrKlientiId($id)
    {
        $dbconn = connection();
        $sql = "SELECT * FROM klientet Where klientiid = ".$id;
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }


    function modifikoKlient( $id, $emri, $mbiemri, $email, $telefoni ,$nr_personal, $adresa )
    {
        $dbconn = connection();
        $sql = "UPDATE klientet SET emri = '$emri', mbiemri = '$mbiemri', nr_personal = '$nr_personal', email = '$email', telefoni = '$telefoni', adresa = '$adresa' WHERE klientiid = $id";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: klientet.php');
        }   
    }

    function shtoKlient($emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa)
    {
        $dbconn = connection();
        $sql = "INSERT INTO klientet (emri, mbiemri, nr_personal, email, telefoni, adresa)
        VALUE ('$emri', '$mbiemri', '$nr_personal', '$email', '$telefoni', '$adresa')";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: klientet.php');
        }   
    }

    function merrKategorit(){
        $dbconn = connection();
        $sql = "SELECT * FROM kategorite";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function shtoKategori($emri, $pershkrimi){
        $dbconn = connection();
        $sql = "INSERT INTO kategorite(emri, pershkrimi) VALUES('$emri', '$pershkrimi')";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: kategorite.php');
        }
    }

    function merrAutomjetet(){
        $dbconn = connection();
        $sql = "SELECT a.*, k.emri as kategoria FROM automjetet a LEFT JOIN kategorite k ON a.kategoriaid = k.kategoriaid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function shtoAutomjet($emri, $kategoriaid, $nr_regjistrimit, $pershkrimi, $kostoja){
        $dbconn = connection();
        $sql = "INSERT INTO automjetet(emri, kategoriaid, nr_regjistrimit, pershkrimi, kostoja) VALUES('$emri', $kategoriaid, '$nr_regjistrimit', '$pershkrimi', $kostoja)";
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: automjetet.php');
        }
    }
    
    function merrAutomjetinId($automjetiid){
        $dbconn = connection();
        $sql = "SELECT * FROM automjetet WHERE automjetiid = $automjetiid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function modifikoAutomjet($automjetiid, $emri, $kategoriaid, $nr_regjistrimit, $pershkrimi, $kostoja){
        $dbconn = connection();
        $sql = "UPDATE automjetet SET emri = '$emri', kategoriaid = $kategoriaid, nr_regjistrimit = '$nr_regjistrimit', pershkrimi = '$pershkrimi', kostoja = $kostoja where automjetiid = $automjetiid" ;
        $result = mysqli_query($dbconn, $sql);
        if($result){
            header('Location: automjetet.php');
        }
    }

    function merrRezervimetId($klientiid){
        $dbconn = connection();
        $sql = "SELECT r.*, a.emri FROM rezervimet r INNER JOIN automjetet a ON r.automjetiid = a.automjetiid WHERE klientiid = $klientiid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }
    
    function merrRezervimet(){
        $dbconn = connection();
        $sql = "SELECT r.*, k.emri AS emriklienti, k.mbiemri AS mbiemriklienti, a.emri AS emriautomjeti  
        FROM rezervimet r 
        LEFT JOIN klientet k ON r.klientiid = k.klientiid
        LEFT JOIN automjetet a ON r.automjetiid = a.automjetiid";
        $result = mysqli_query($dbconn, $sql);
        return $result;
    }

?>