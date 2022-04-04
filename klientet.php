<?php 
include_once 'includes/header.php';
include_once 'includes/sqlFunctions.php';
?>

<div id="main">
    <div id="slide-bar">
        <div class="image">
            <h1>Klientet</h1>
        </div>
    </div>
    <div class="tabela">
        <h1 style="margin-bottom: 50px;">Klientet</h1>
        <div style="clear: both;"></div>
        <table id="klientet_table">
            <thead>
                <tr>
                    <th>Emri</th>
                    <th>Mbiemri</th>
                    <th>Nr personal</th>
                    <th>Email</th>
                    <th>Nr telefonit</th>
                    <th>Adresa</th>
                    <th>Modifiko</th>
                    <th>Fshiej</th>
                </tr>
            </thead>
            <tbody>    
            <?php
                $klientet = merrKlientet(); 
                while ($klienti = mysqli_fetch_assoc($klientet)) {
            ?>        
                    <tr>
                        <td><?php echo $klienti['emri']?></td>
                        <td><?php echo $klienti['mbiemri']?></td>
                        <td><?php echo $klienti['nr_personal']?></td>
                        <td><?php echo $klienti['email']?></td>
                        <td><?php echo $klienti['telefoni']?></td>
                        <td><?php echo $klienti['adresa']?></td>
                        <td id="modifiko">
                            <a href="shto_modifiko_klient.php?klientiid=<?php echo $klienti['klientiid'] ?>">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </td>
                        <td id="fshiej">
                            <form action="fshijKlientin.php" method="post">
                                <input type="text" name="klientiid" hidden value="<?php echo $klienti['klientiid'] ?>">
                                <button type="submit" style="border: none;background-color:transparent;cursor:pointer;" name="deleteKlient" onclick="return fshijKlientin()">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <script>
                                function fshijKlientin() {
                                    $confirm = confirm('A jeni te sigurt qe doni ta fshini klientin ?');
                                    if ($confirm) {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
                        </td>
                    </tr>


                <?php } ?>
            </tbody>
        </table>
        <button onclick="window.location.href='shto_modifiko_klient.php'" id="shto_klient"><i class="fa fa-plus" aria-hidden="true"></i> Shto klient</button>
        <div style="clear: both;"></div>
    </div>
</div>
<hr>


<?php include_once 'includes/footer.php' ?>
