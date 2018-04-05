<?php
    require_once("../initialize.php");
    require_once("../parts/header.php");

    if(isset($_POST['createPassword'])){
        $conn = new mysqli("localhost", "root", "", "parking");

        $sql = "UPDATE klant SET wachtwoord='". $_POST['wachtwoord'] ."', passwordCreated='1' WHERE auth_key='". $_POST['token'] ."' ";
        echo $sql."<br>";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $query = "SELECT voornaam, emailadres, rol FROM klant WHERE emailadres = '" . $_POST['emailadres'] . "' AND wachtwoord = '" . $_POST['wachtwoord'] . "'";
        $result = $con->query($query);

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $_SESSION['gebruiker'] = $row['emailadres'];
            $_SESSION['rol'] = $row['rol'];

            if ($_SESSION['rol'] == "u") {
                $_SESSION['logged_user'] = TRUE;
            } elseif ($_SESSION['rol'] == "a") {
                $_SESSION['logged_admin'] = TRUE;
            } elseif ($_SESSION['rol'] == "b") {
                $_SESSION['Logged_baliemederwerker'] = TRUE;
            } elseif ($SESSION['rol'] == "g") {
                $_SESSION['Logged_garagemedewerker'] = TRUE;
            } elseif ($SESSION['rol'] == "m") {
                $_SESSION['Logged_garagemanager'] = TRUE;
            }
            var_dump($_SESSION);
            

            $cookie_name = "email";
            $cookie_value = $_POST['emailadres'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

            echo "fucking cookie set";
            header('Location: http://localhost/ProjectParkeren/pages/index.php');

            }
        }
    }

    if(isset($_SESSION['logged_user'])) {
        // header('Location: http://localhost/ProjectParkeren/pages/index.php');
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Inloggen</h2>
    </div>
</div>

<div class="row">
    
    <?php
        require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <?php 
            if(isset($_GET['token'])){
                $conn = new mysqli("localhost", "root", "", "parking");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT emailadres, passwordCreated FROM klant WHERE auth_key='".$_GET['token']."'";
                // echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $ding = $row['passwordCreated'];
                        if($ding == "1"){
                            header('Location: login.php');
                        }
                        $email = $row['emailadres'];
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();

                echo "
        <form action='login.php' method='post' class='form'> 
            <div class='row'>
                <div class='col-md-12 input-text'>
                    <p>Dit is voor het eerst dat u inlogd, maak eerst een wachtwoord aan.</p>
                </div>
            </div>
            <div class='row'>
                <div class='col-5 input-text'>
                    E-mailadres
                </div>
                <div class='col-7 form-input'>
                    <input type='text' name='emailadres' placeholder='". $email ."' value='". $email ."'  readonly required>
                    <input type='hidden' value='". $_GET['token'] ."' name='token'>
                </div>
            </div>

            <div class='row'>
                <div class='col-5 input-text'>
                    Wachtwoord
                </div>
                <div class='col-7 form-input'>
                    <input type='password' name='wachtwoord' placeholder='●●●●●●●●●●●●' id='password' pattern='.{5,}' title='Uw wachtwoord moet uit 5 tekens of meer bestaan' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5 input-text'>
                    Herhaal wachtwoord
                </div>
                <div class='col-7 form-input'>
                    <input type='password' name='wachtwoord2' placeholder='●●●●●●●●●●●●' id='password2' pattern='.{5,}' title='Uw wachtwoord moet uit 5 tekens of meer bestaan' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5'>
                </div>
                <div class='col-7 form-input'>
                    <input type='submit' value='Verzend' name='createPassword'>
                </div>
            </div>
        </form>
                ";
            }else if(isset($_GET['aankomst'])){
            $aankomst = $_GET['aankomst'];
            $vertrek = $_GET['vertrek'];
            $type = $_GET['type'];
                echo "
        <form action='redirect.php?aankomst=". $aankomst ."&vertrek=". $vertrek ."&type=". $type ."' method='post' class='form'> 
            <div class='row'>
                <div class='col-5 input-text'>
                    E-mailadres
                </div>
                <div class='col-7 form-input'>
                    <input type='text' name='emailadres' placeholder='E-mailadres' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5 input-text'>
                    Wachtwoord
                </div>
                <div class='col-7 form-input'>
                    <input type='password' name='wachtwoord' placeholder='●●●●●●●●●●●●' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5'>
                </div>
                <div class='col-7 form-input'>
                    <input type='submit' value='LOGIN'>
                </div>
            </div>
        </form>
                ";
            }else{
                echo "
        <form action='./login.php' method='post' class='form'> 
            <div class='row'>
                <div class='col-5 input-text'>
                    E-mailadres
                </div>
                <div class='col-7 form-input'>
                    <input type='text' name='emailadres' placeholder='E-mailadres' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5 input-text'>
                    Wachtwoord
                </div>
                <div class='col-7 form-input'>
                    <input type='password' name='wachtwoord' placeholder='●●●●●●●●●●●●' required>
                </div>
            </div>

            <div class='row'>
                <div class='col-5'>
                </div>
                <div class='col-7 form-input'>
                    <input type='submit' value='LOGIN'>
                </div>
            </div>
        </form>
                ";
            }
        ?>
    </div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $("form").submit(function(e){
            var password = $("#password").val();
            var password2 = $("#password2").val();

            if(password == password2){
                // alert("Ze matchen");
            }else{
                e.preventDefault();
                alert("De wachtwoorden komen niet overeen");
            }
        })
    </script>
  </body>
</html>
