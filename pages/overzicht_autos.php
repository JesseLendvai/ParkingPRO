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

    if(!isset($_SESSION['logged_admin'])) {
        header('Location: http://localhostparkingpro/pages/index.php');
    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Overzicht auto's</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <div class="form"> 
            <div class="row">
                <div class="col-5 input-text">
                    Kenteken
                </div>
                <div class="col-7 form-input">
                    <input type="text" name="kenteken_een" class="kenteken_een" placeholder="XX">
                    <span class="oi oi-minus"></span>
                    <input type="text" name="kenteken_twee" class="kenteken_twee" placeholder="XX">
                    <span class="oi oi-minus"></span>
                    <input type="text" name="kenteken_drie" class="kenteken_drie" placeholder="XX">
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Eind datum
                </div>
                <div class="col-7 form-input">
                    <div class="input-append date form_datetime">
                        <input onchange="getAvailableSpace(this.value)" id="till" name="till" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Type parking
                </div>
                <div class="col-7 form-input">
                    <input type="radio" class="typeparking" name="typeparking" value="all" checked> All<br>
                    <input type="radio" name="typeparking" value="v"> Valet<br>
                    <input type="radio" name="typeparking" value="l"> Long<br>
                    <input type="radio" name="typeparking" value="e"> Economic
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                </div>
                <div class="col-7 form-input">
                    <input id="zoek" type="submit" value="ZOEK">
                </div>
            </div>
        </div>

        <span id="cars"></span>
    </div>
</div>
<script>
$(function() {
    $('#zoek').click(function(){
        getAvailableSpace();
    });

    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        minuteStep: 15,
        startDate: new Date(),
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
    });
});
function getAvailableSpace() {
    let til = $('#till').val() ? $('#till').val() : new Date();
    let d = new Date(til);
    let iso_date_string = d.toISOString();
    let kenteken = $('.kenteken_een').val() ? `${$('.kenteken_een').val()}-${$('.kenteken_twee').val()}-${$('.kenteken_drie').val()}` : "";
    let typeParking = $('input[name=typeparking]:checked').val();
    if (til == "") {
        document.getElementById("cars").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cars").innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET",`getCars.php?kenteken=${kenteken}&date=${iso_date_string}&typeparking=${typeParking}`, true);
        xmlhttp.send();
    }
}
</script>
</body>
</html>