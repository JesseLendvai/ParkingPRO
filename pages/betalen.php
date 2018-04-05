<?php
    require_once("../initialize.php");
    require_once("../parts/header.php");

    if(!isset($_SESSION['logged_user'])) {
        header('Location: http://localhost/ProjectParkeren/pages/login.php');
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Betalen</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <form action="./betalen.php" method="post" class="form"> 

            <div class="row">
                <div class="col-5 input-text">
                    Aankomst
                </div>
                <div class="col-7 form-input">
                    <span><input type="text" name="aankomst-datum" class="datum"></span>
                    <span><input type="text" name="aankomst-tijd" class="tijd"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Vertrek
                </div>
                <div class="col-7 form-input">
                    <span><input type="text" name="vertrek-datum" min="0" class="datum"></span>
                    <span><input type="text" name="vertrek-tijd" min="0" class="tijd"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Maximale uitrijtijd
                </div>
                <div class="col-7 form-input">
                    <span><input type="number" name="uren" class="uitrijtijd" placeholder="hh" max="4" required></span>
                    <span><input type="number" name="minuten" class="uitrijtijd" placeholder="mm" max="59" required></span>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Prijs
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="prijs" class="prijs">
                </div>
            </div>
            

            <div class="row">
                <div class="col-5 input-text">
                    Type parking
                </div>
                <div class="col-7 form-input">
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" value="Betalen">
                    <input type="submit" value="Afbreken">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    require_once("../parts/footer.php")
?>