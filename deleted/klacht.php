<!doctype html>
<html lang="nl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Own CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.nl.js"></script>    
    <title>Parking</title>
  </head>
  <body class="container-fluid">
<?php
    require_once("../initialize.php");

    if(!isset($_SESSION['logged_user'])) {
        header('Location: http://localhost/parkingpro/pages/login.php');
    }

    //Select user data
    $user = $_SESSION['gebruiker'];

    if(isset($_POST['klagen'])){
    $kenteken = $_POST['kenteken'];
    $stmt1 = $con->prepare("SELECT * FROM klant WHERE emailadres=?");
            $stmt1->bind_param("s", $user);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $array1=mysqli_fetch_array($result1);

    $stmt2 = $con->prepare("SELECT * FROM klant WHERE kenteken=?");
            $stmt2->bind_param("s", $kenteken);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $array2=mysqli_fetch_array($result2);

    //Check of de klant wel de klacht kan maken
    if($array1['kenteken'] == $kenteken && $array2['emailadres'] == $user){
        //Voer de klacht in
        $stmt = $con->prepare("INSERT INTO klachten (klant_id, factuur_id) VALUES (?, ?)");
            $stmt->bind_param("ssi", $gtauser, $username, $userId);
            $stmt->execute();
    }
}
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Klacht indienen</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>
    
    <div class="right-section col-9">
        <form action="" method="post" class="form"> 
            <div class="row">
                <div class="col-5 input-text">
                    Kenteken
                </div>
                <div class="col-7 form-input">
                    <input onchange="" size="16" type="text" placeholder="XX-XX-XX">
                </div>
            </div>
            
            <div class="row">
                <div class="col-5 input-text">
                    Ticket ID
                </div>
                <div class="col-7 form-input aankomst">
                    <input onchange="" size="16" type="text">
                </div>  
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Beschrijving
                </div>
                <div class="col-7 form-input aankomst">
                    <textarea style="resize: none;" onkeyup="countChar(this)" maxlength="280" rows="7" cols="50" wrap="hard" required></textarea>
                    <div id="charNum"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" name="klagen" value="Klagen">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function countChar(val) {
        let len = val.value.length;
        let maxVal = 280;
        if (len > maxVal) {
          val.value = val.value.substring(0, maxVal);
        } else {
          $('#charNum').text(`${maxVal - len} characters left...`);
        }
      };
</script>
</body>
</html>