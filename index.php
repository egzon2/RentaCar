<?php 
    include_once 'includes/header.php';
    include_once 'includes/sqlFunctions.php';

?>


<div id="main">
    <div id="slide-bar">
        <div id="img">

        </div>
    </div>
    <div id="permbajtja">
        <div class="dhenie_me_qera box">
            <img src="images/div1image.png">
            <h3>Dhenie me qera dhe shitje</h3>
            <p>Veprimtaria kryesore e kompanise sonë, është ofrimi i shërbimeve të veturave(marrje me
                qera dhe shitje), si dhe servisim i tyre. </p>
        </div>
        <div class="misioni box">
            <img src="images/div2image.png">
            <h3>Misioni i kompanise</h3>
            <p>Misioni i kompanise Rent a Car është të ofroj shërbime kualitative të shitjes dhe
                distribuimit
                për të gjithë klientët dhe krijimi i marrëdhenive afatgjate me partnerët tanë.</p>
        </div>
        <div class="visioni box">
            <img src="images/div3image.png">
            <h3>Vizioni</h3>
            <p>Të bëhemi kompania më e madhe në Kosovë, e specializuar për shitje dhe distribuim.</p>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div id="rrethnesh">
        <div id="rrethneshh">
            <div id="fotoja">
                <img src="images/rrethnesh.png">
            </div>
            <div id="rrethneshPermbajtja">
                <h3>Rreth Nesh</h3>
                <p>Rent a Car është kompani e themeluar në vitin 2022.</p>
                <p>Veprimtaria kryesore është ofrimi me qera i automjeteve dhe shitja e tyre ne
                    gjithë territorin e Republikës së Kosovës.</p>
                <p>Posedojme te gjitha llojet e automjeteve, cmime te volitshme, ne menyre qe vozitja te jete sa
                    me e rehatshme.
                </p>
            </div>
            <div style="clear: both;"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book. It has survived not only five centuries
            </p>
        </div>
        <div id="klientet">
            <h3>Klientet tane</h3>
            <?php
                $klientet = merr5KlientetEFundit();
                while ( $klienti = mysqli_fetch_assoc($klientet)) {
                    ?>
                    <h4><?php echo $klienti['emri']. " " . $klienti['mbiemri']; ?></h4>
                    <p><?php echo $klienti['email'];?></p>
                            
            <?php } ?>
            

        </div>
    </div>
    <div id="prefooter">
        <p><q>We believe everyone should have a memorable and enjoyable experience with their car rental.</q>
        </p>
    </div>
</div>


<?php include_once 'includes/footer.php' ?>