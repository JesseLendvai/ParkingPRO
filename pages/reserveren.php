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
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Reserveren</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <div class="col-md-12 text-center">
            <h1>Vrije plekken: <span id="spots"></span></h1>
        </div>
        <form action="./betalen.php" method="post" class="form">

            <div class="row">
                <div class="col-5 input-text">
                    Type parking
                </div>
                <div class="col-7 form-input">
                    <input type="radio" name="typeparking" value="valet" checked> Valet
                    <input type="radio" name="typeparking" value="long"> Long
                    <input type="radio" name="typeparking" value="economic"> Economic
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Aankomstdatum
                </div>
                <div class="col-7 form-input aankomst">
                    <div class="input-append date form_datetime">
                        <input onchange="getAvailableSpace(this.value);getPrice(this.value)" class="aankomst" id="datePicker" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5 input-text">
                    Vertrekdatum
                </div>
                <div class="col-7 form-input aankomst">
                    <div class="input-append date form_datetime">
                        <input onchange="getAvailableSpace(this.value);getPrice(this.value)" class="vertrek" id="datePicker" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 input-text">
                    Bagagehulp bij terugkomst
                </div>
                <div class="col-7 form-input aankomst">
                    <input type="checkbox" id="bagagehulp"> (+ €20,-)
                </div>
            </div>
            <div class="row">
                <div class="col-5 input-text">
                    Vluchtnummer (If bagagehulp is checked)
                </div>
                <div class="col-7 form-input">
                    <input onchange="" size="16" type="text" placeholder="XX-XX-XX">
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" value="RESERVEREN">
<!--                     <input type="submit" value="Prijs opvragen"> -->
                </div>
            </div>
        </form>
        <div class="col-md-12" style="margin-top: 50px;">
        </div>
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
function getAvailableSpace(date) {
    let d = new Date(date);
    let iso_date_string = d.toISOString();
    if (date == "") {
        document.getElementById("spots").innerHTML = "";
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
                document.getElementById("spots").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET","getSpots.php?q="+iso_date_string,true);
        xmlhttp.send();
    }
}

function getPrice(datum){
    var aankomst = $("#datePicker.aankomst").val();
    var vertrek = $("#datePicker.vertrek").val();

    if(aankomst && vertrek != ""){
        $.ajax({url: "calculate.php", success: function(result){
                alert("done");
            }});
    }
}

</script>
</body>
</html>
