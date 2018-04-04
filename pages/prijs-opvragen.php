<?php 
require_once 'dateDiff.php';

	// echo $aankomst." - ".$vertrek;

	// $interval = $aankomst->diff($vertrek);
	// echo $interval->format('%R%a days');

	// $prijs = 0;
	// $date1 = new DateTime($result['aankomst']);
	// $date2 = new DateTime(date('Y-m-d h:i:s'));
	// $interval = $date1->diff($date2);
	// $uren = $interval->h;
	// if ($interval->i > 0) {
	//     $uren++;
	// }
	// $dagen = $interval->days;

	// if($typeparking == 'v') {
	//     if($dagen > 0) {
	//         $prijs += $dagen*12;
	//     }
	//     if ($uren > 0 && $dagen == 0) {
	//         $prijs += 2;
	//         $uren -= 2;
	//     }
	//     if ($uren > 0) {
	//         $prijs += $uren*1;
	//     }
	//     echo "€ " . $prijs;
	// }

	// elseif ($typeparking == 'l') {
	//     if($dagen > 6) {
	//         $dagen--;
	//     }
	//     if($dagen > 0) {
	//         $prijs += $dagen*10;
	//     }
	//     if ($uren > 0 && $dagen == 0) {
	//         $prijs += 2;
	//         $uren -= 3;
	//     }
	//     if ($uren > 0) {
	//             $uren /= 2;
	//             $uren = ceil($uren);
	//             $prijs += $uren*1;
	//     }
	//     echo "€ " . $prijs;
	// }

	// else {
	//     if($dagen > 6) {
	//         $dagen--;
	//     }
	//     if($dagen > 0) {
	//         $prijs += $dagen*6;
	//     }
	//     if ($uren > 0 && $dagen == 0) {
	//         $prijs += 2;
	//         $uren -= 4;
	//     }
	//     if ($uren > 0) {
	//             $uren /= 3;
	//             $uren = ceil($uren);
	//             $prijs += $uren*1;
	//     }
	//     echo "€ " . $prijs;
	// }

?>
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
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Prijs opvragen</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>
    
    <div class="right-section col-9">
        <div class="col-md-12 text-center">
        </div>
        <form action="" method="post" class="form"> 
			<div class="row">
				<div class="col-md-12">
					<?php 
if(isset($_POST['post'])){	

	$prijs = 0;
	$aankomst = $_POST['aankomst'];
	$vertrek = $_POST['vertrek'];

	$tijd = dateDiff($aankomst, $vertrek);
	echo $tijd;

if(strpos($tijd, 'days')){
	//use explode to set days
	$container = explode(', ', $tijd);
	$dagen = $container[0];
	if(isset($container[1])){
		$uren = $container[1];
	}else{
		$uren = "0";
	}
	if(isset($container[2])){
		$minuten = $container[2];
	}else{
		$minuten = "0";
	}
	if(isset($container[3])){
		$seconden = $container[3];
	}else{
		$seconden = "0";
	}
	echo "<br>Days: ".$dagen;
	echo "<br>hours: ".$uren;
	echo "<br>Minutes: ".$minuten;
	echo "<br>seconds: ".$seconden;
}else if(strpos($tijd, 'hours')){
	//use explode to set hours
	$container = explode(', ', $tijd);
	if(isset($container[0])){
		$uren = $container[0];
	}else{
		$uren = "0";
	}

	if(isset($container[1])){
		$minuten = $container[1];
	}else{
		$minuten = "0";
	}
	echo "<br>hours: ".$uren;
	echo "<br>Minutes: ".$minuten;
}else if(strpos($tijd, 'minutes')){
	$container = explode(', ', $tijd);
	$minuten = $container[0];
	echo "<br>Minutes: ".$minuten;
}else if(strpos($tijd, 'seconds')){
	//use explode to set seconds
}

	if($_POST['typeparking'] == "valet"){
		$prijs = 1;
	}elseif($_POST['typeparking'] == "long"){
		$prijs = 2;
	}elseif($_POST['typeparking'] == "economic"){
		$prijs = 4;
	}

$type = $_POST['typeparking'];

	echo "<p>De prijs voor de periode van: <b>". $aankomst ."</b> - <b>". $vertrek ."</b> kost u: €<b>". $prijs ."</b></p>
		  <p><a href='http://localhostparkingpro/pages/login.php?aankomst=".$aankomst."&vertrek=". $vertrek ."&type=". $type ."' style='color:red !important'>akkoord</a></p>
";
}
					?>
				</div>
			</div>
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
                        <input class="aankomst" name="aankomst" id="datePicker" size="16" type="text" value="" readonly>
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
                        <input class="vertrek" name="vertrek" id="datePicker" size="16" type="text" value="" readonly>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 form-input">
                    <input type="submit" name="post" value="Prijs opvragen">
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

</script>
</body>
</html>