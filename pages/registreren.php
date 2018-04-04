<?php
    require_once("../initialize.php");
    require_once("../parts/header.php");


    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $auth_key = generateId(19);
        $kenteken = $_POST['kenteken_een'] . '-' . $_POST['kenteken_twee'] . '-' . $_POST['kenteken_drie'];
        $aankomst = $_POST["jaar"] . "-" . $_POST["maand"] . "-" . $_POST["dag"] . " " . $_POST["aankomsttijd"] . ":00";

        $stmt = $con->prepare("INSERT INTO klant (kenteken, voornaam, tussenvoegsel, achternaam, straatnaam, huisnummer, postcode, woonplaats, emailadres, telefoonnummer, rekeningnummer, auth_key) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $kenteken, $_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['straatnaam'], $_POST['huisnummer'], $_POST['postcode'], $_POST['woonplaats'], $_POST['emailadres'], $_POST['telefoonnummer'], $_POST['rekeningnummer'], $auth_key);
        $stmt->execute();
        
        $stmt = $con->prepare("INSERT INTO reservering (kenteken, typeparking, aankomst)
        VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $kenteken, $_POST['typeparking'], $aankomst);
        $stmt->execute();

        if ($stmt) {
            header('Location: http://localhostparkingpro/pages/login.php');
        }

        $to = $_POST['emailadres'];
        $achternaam = $_POST['achternaam'];
        $subject = "Verifieer uw email";

$message = "
<html>
<head>
</head>
<body>
<p>Beste meneer/mevrouw ". $achternaam .", </p>
<p>Welkom bij Lelystad parkeren bedankt voor uw keuze!<br>U kunt <a href='http://localhostparkingpro/pages/login.php?token=". $auth_key ."'>hier</a> klikken om in te loggen.</p>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers cuz why not
$headers .= 'From: <no-reply@lelystadparking.nl>' . "\r\n";

mail($to,$subject,$message,$headers);
        
    } else {
        //Do nothing cuz he didn't post
    }

    if(isset($_SESSION['logged_user'])) {
        //User is already logged in so redirect him to the index page
        header('Location: http://localhostparkingpro/pages/index.php');
    }
    

?>

<div class="row">
    <div class="top-section col-12">
        <h2>Registreren</h2>
    </div>
</div>
<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <form action="./registreren.php" method="post" class="form"> 
            <div class="row">
                <div class="col-5 input-text">
                    Voornaam
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="voornaam" placeholder="Voornaam" maxlength="35" required >
                </div>
            </div>
            
            <div class="row">
                <div class="col-5 input-text">
                    Tussenvoegsel
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="tussenvoegsel" maxlength="11" placeholder="Tussenvoegsel">
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Achternaam
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="achternaam" maxlength="35" placeholder="Achternaam" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Straatnaam en huisnummer
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="straatnaam" placeholder="Straatnaam" maxlength="35" required>
                    <input type="text" name="huisnummer" class="huisnummer" maxlength="5" placeholder="Nr" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Postcode
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="postcode" placeholder="1234AB" maxlength="6" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Woonplaats
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="woonplaats" placeholder="Woonplaats" maxlength="35" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    E-mailadres
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="emailadres" placeholder="E-mailadres" maxlength="254" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Kenteken
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="kenteken_een" class="kenteken_een" placeholder="XX" maxlength="2" required>
                    <span class="oi oi-minus"></span>
                    <input type="text" name="kenteken_twee" class="kenteken_twee" placeholder="XX" maxlength="2" required>
                    <span class="oi oi-minus"></span>
                    <input type="text" name="kenteken_drie" class="kenteken_drie" placeholder="XX" maxlength="2" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Telefoonnummer
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="telefoonnummer" placeholder="Telefoonnummer" maxlength="10" required>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Rekeningnummer
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="rekeningnummer" placeholder="Rekeningnummer" maxlength="20" required>
                </div>
            </div>
            

            <div class="row">
                <div class="col-5 input-text">
                    Type parking
                </div>
                <div class="col-7 form-input">
                    <input type="radio" name="typeparking" value="v" checked> Valet
                    <input type="radio" name="typeparking" value="l"> Long
                    <input type="radio" name="typeparking" value="e"> Economic
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Aankomsttijd
                </div>
                <div class="col-7 form-input">
                    <span><input type="time" name="aankomsttijd" class="tijd" placeholder="hh:mm" maxlength="5" required></span>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Aankomstdatum
                </div>
                <div class="col-7 form-input aankomst">
                    <span><input type="number" name="dag" class="aankomst-dag" max="31" required></span>
                    <span><input type="number" name="maand" class="aankomst-maand" max="12" required></span>
                    <span><input type="number" name="jaar" class="aankomst-jaar" max="2019" required></span><br>
                    <span class="aankomst-dag">DAG</span>
                    <span class="aankomst-maand">MAAND</span>
                    <span class="aankomst-jaar">JAAR</span>
                </div>  
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" value="Registreer">
                    <input type="submit" value="Afbreken">
                </div>
            </div>
        </form>
    </div>
</div>


<?php
    require_once("../parts/footer.php");
?>