<?php
    require_once("../initialize.php");
    require_once("../parts/header.php");

    if(!isset($_SESSION['logged_user']) && !isset($_SESSION['logged_admin'])) {
        header('Location: http://localhostparkingpro/pages/login.php');
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Info</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <div class="row">
            <div style="margin-top:20px;" class="col-md-12 text-center">
                <h3>Gebruiker: <?php echo $_SESSION['gebruiker']; ?></h3>
                <h3>Rol: <?php echo $_SESSION['rol'] == "u" ? "User" : "Admin"; ?></h3>
            </div>
        </div>
    </div>
</div>




<?php
    require_once("../parts/footer.php")
?>