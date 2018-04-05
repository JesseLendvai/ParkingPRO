<div class="left-section col-3">
<?php
    if (isset($_SESSION['logged_admin'])) {
        // ingelogde admin
        ?>
            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="log-uit"><a  onclick="del()">Log uit</a></button>
            <button type="button" class="overzicht-auto"><a href="./overzicht_autos.php">Overzicht auto's</a></button>
            <button type="button" class="info"><a href="./info.php">Info</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <button type="button" class="contact"><a href="./logout.php">logout</a></button>

    <?php
    } elseif(!isset($_SESSION['logged_user'])) {
        // niet ingelogde mensen?>

            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="registeren"><a href="./registreren.php">Registreren</a></button>
            <button type="button" class="inloggen"><a href="./login.php">Inloggen</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <button type="button" class="contact"><a href="./prijs-opvragen.php">Prijs opvragen</a></button>

    <?php
    }elseif(isset($_SESSION['logged_baliemederwerker'])) {
        // niet ingelogde mensen?>

            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="registeren"><a href="./registreren.php">Registreren</a></button>
            <button type="button" class="inloggen"><a href="./login.php">Inloggen</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <button type="button" class="contact"><a href="./logout.php">logout</a></button>
            <h1>test</h1>



    <?php
    }
    elseif(isset($_SESSION['logged_garagemedewerker'])) {
      ?>

            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="registeren"><a href="./registreren.php">Registreren</a></button>
            <button type="button" class="inloggen"><a href="./login.php">Inloggen</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <h1>test</h1>

    <?php
    }
    elseif(!isset($_SESSION['logged_garagemanager'])) {
        // niet ingelogde mensen?>

            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="registeren"><a href="./registreren.php">Registreren</a></button>
            <button type="button" class="inloggen"><a href="./login.php">Inloggen</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
    <?php
    }  else {
        // normale mensen
        ?>
            <button type="button" class="first-button home"><a href="./index.php">Home</a></button>
            <button type="button" class="log-uit"><a onclick="del()">Log uit</a></button>
            <button type="button" class="reserveringen"><a href="./reserveren.php">Reserveren</a></button>
            <button type="button" class="reserveringen"><a href="./overzicht_reserveringen.php">Reserveringen</a></button>
            <button type="button" class="contact"><a href="./klacht.php">Klacht</a></button>
            <button type="button" class="contact"><a href="./schoonmaken.php">Schoonmaken</a></button>
            <button type="button" class="info"><a href="./info.php">Info</a></button>
            <button type="button" class="contact"><a href="./contact.php">Contact</a></button>
            <button type="button" class="contact"><a href="./prijs-opvragen.php">Prijs opvragen</a></button>
        <?php
    }
?>
</div>
    <script type="text/javascript">

        function del(){
            document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            location.href = "http://localhost/parkingpro/pages/logout.php";
        }

    </script>
