<?php include_once('includes/header.php'); ?>
<?php include_once('includes/sqlFunctions.php'); ?>

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

<?php
if(isset($_POST['shtoKategori'])){
    $emri = $_POST['emri'];
    $pershkrimi = $_POST['pershkrimi'];
    shtoKategori($emri, $pershkrimi);
}
?>
<div id="main">
    <div id="slide-bar">
        <div class="image">

            <h1>Shtimi i kategorise</h1>

        </div>
    </div>

    <h1 id="hi">Forma per shtimin e kategorise</h1>
    <form method="post" id="shtoForma">
        <label for="emri">Emri</label>
        <input type="text" name="emri" value="">
        <label for="pershkrimi">Pershkrimi</label>
        <input type="text" name="pershkrimi" value="">
        <input type="submit" name="shtoKategori" value="Shto kategori">
    </form>
    <div style="clear: both;"></div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>