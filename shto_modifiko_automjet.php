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
    input, select {
        width: 100%;
        padding: 10px;
    }

    label {
        color: #009933;
        font-weight: bold;
        margin-left: -10px;
    }
    select{
        width: 102%;
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
if(isset($_POST['shtoAutomjet'])){
    shtoAutomjet( $_POST['emri'], $_POST['kategoriaid'], $_POST['nr_regjistrimit'], $_POST['pershkrimi'], $_POST['kostoja']);
}

if(isset($_GET['automjetiid'])){
   $automjeti = mysqli_fetch_assoc(merrAutomjetinId($_GET['automjetiid']));
}

if(isset($_POST['modifikoAutomjet'])){
    modifikoAutomjet($_GET['automjetiid'], $_POST['emri'], $_POST['kategoriaid'], $_POST['nr_regjistrimit'], $_POST['pershkrimi'], $_POST['kostoja']);
}

?>
<div id="main">
    <div id="slide-bar">
        <div class="image">

            <h1>Shtimi i automjetit</h1>

        </div>
    </div>

    <h1 id="hi">Forma per shtimin e automjetit</h1>
    <form method="post" id="shtoForma">

        <label for="emri">Emri</label>
        <input type="text" name="emri" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['emri']; ?>">

        <label for="kategoria">Kategoria</label>
        <select name="kategoriaid" id="">
            <?php $kategorite = merrKategorit();
            while ($kategoria = mysqli_fetch_assoc($kategorite)) : ?>
                <option value="<?php echo $kategoria['kategoriaid']; ?>" <?php if(isset($_GET['automjetiid']))if($kategoria['kategoriaid'] == $automjeti['kategoriaid']) echo 'selected' ; ?> ><?php echo $kategoria['emri']; ?></option>
            <?php
            endwhile;
            ?>
        </select>

        <label for="nr_regjistrimit">Nr. i regjistrimit</label>
        <input type="text" name="nr_regjistrimit" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['nr_regjistrimit']; ?>">

        <label for="pershkrimi">Pershkrimi</label>
        <input type="text" name="pershkrimi" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['pershkrimi']; ?>">

        <label for="kostoja">Kostoja</label>
        <input type="text" name="kostoja" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['kostoja']; ?>">

        <?php if(isset($_GET['automjetiid'])) : ?>
            <input type="submit" name="modifikoAutomjet" value="Modifiko automjet">
        <?php else : ?>
            <input type="submit" name="shtoAutomjet" value="Shto automjet">
        <?php endif; ?>

    </form>
    <div style="clear: both;"></div>
</div>
<hr>
<?php include_once('includes/footer.php'); ?>