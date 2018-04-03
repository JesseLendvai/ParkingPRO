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
        header('Location: http://localhost/ProjectParkeren/pages/login.php');
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Schoonmaken</h2>
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
                    Type behandeling
                </div>
                <div class="col-7 form-input">
                    <input type="radio" name="typeparking" value="schoonmaken" checked> schoonmaken
                    <input type="radio" name="typeparking" value="wassen"> Wassen
                    <input type="radio" name="typeparking" value="bijvullen"> Bijvullen
                </div>
            </div>
            
            <div class="row">
                <div class="col-5 input-text">
                    Tijd van ophalen
                </div>
                <div class="col-7 form-input aankomst">
                    <div class="input-append date form_datetime">
                        <input id="datePicker" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" value="AANMELDEN">
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(function() {
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        minuteStep: 15,
        startDate: new Date(),
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
    });
});
</script>
</body>
</html>