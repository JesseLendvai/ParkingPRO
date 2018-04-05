<?php
      require_once("../initialize.php");
    require_once("../parts/header.php");
    $result_set = query("SELECT * FROM klant WHERE auth_key = '" . $_GET['auth_key'] . "'");
    if (!mysqli_fetch_assoc($result_set)) {
        header('Location: http://localhost/parkingpro/pages/registreren.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if (strlen($_POST['wachtwoord']) < 6 ) {
            echo "<script>alert('Wachtwoord moet minimaal 6 tekens lang zijn!')</script>";
        }
        elseif ($_POST['wachtwoord'] === $_POST['bevestig_wachtwoord']) {
            query("UPDATE klant SET wachtwoord = '" . $_POST['wachtwoord'] . "' WHERE auth_key = '" . $_GET['auth_key'] . "'");
            header('Location: http://localhost/parkingpro/pages/login.php');
        } else {
            echo "<script>alert('Wachtwoorden komen niet overeen!')</script>";
        }
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Wachtwoord aanmaken</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <form action="./create_password.php?auth_key=<?php echo $_GET['auth_key']; ?>" method="post" class="form">
            <div class="row">
                <div class="col-5 input-text">
                    Nieuw wachtwoord
                </div>
                <div class="col-7 form-input">
                    <input type="password" name="wachtwoord" placeholder="●●●●●●●●●●●●" minlength="6"required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Bevestig wachtwoord
                </div>
                <div class="col-7 form-input">
                    <input type="password" name="bevestig_wachtwoord" placeholder="●●●●●●●●●●●●" minlength="6" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" value="Aanmaken">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    require_once("../parts/footer.php");
?>
