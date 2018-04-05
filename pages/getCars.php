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


    $kentekenSearch = "";
    $achternaamSearch = "";
    $typeParkingSearch = "";
    //search for the kenteken
    if( isset($_GET['kenteken'])){
        $kentekenSearch = $_GET['kenteken'];
    }
    // search for the date
    if( isset($_GET['date'])){
        $tillSearch = $_GET['date'];
    }


    //the date that is today
    //the date that has been added
    $now = date('Y/m/d h:i:s ', time());
    $dateTill = date( "Y-m-d H:i:s", strtotime($tillSearch) );
    //get type parking
    if( isset($_GET['typeparking']) ){
        if($_GET['typeparking'] == "all"){
            $query = "SELECT * FROM factuur WHERE kenteken LIKE '$kentekenSearch' OR typeparking LIKE '%' OR vertrek between '$now' and '$dateTill'";
        }else{
            $typeParkingSearch = $_GET['typeparking'];
            //get the cars that are in the garage in the timestamp
            $query = "SELECT * FROM factuur WHERE kenteken LIKE '$kentekenSearch' OR typeparking LIKE '$typeParkingSearch' OR vertrek between '$now' and '$dateTill'";
        }
    }


    //the result is put into a query
    $result_set = mysqli_query($con, $query);
    echo '
        <div class="row">
            <div class="col-5 input-text">
            </div>
            <div class="col-9 form-input">
                <table class="table table-condensed">
                    <thead>
                        <th>Kenteken</th>
                        <th>Uitrij tijd</th>
                        <th>Aankomst Tijd</th>
                        <th>Vertrek Tijd</th>
                        <th>Type</th>
                    </thead>
                    <tbody>
        ';
                while ($result = mysqli_fetch_assoc($result_set)) {
                    echo '
                        <tr>
                            <td>' . $result["kenteken"] . '</td>
                            <td>' . $result["uitrijtijd"] . '</td>
                            <td>' . $result["aankomst"] . '</td>
                            <td>' . $result["vertrek"] . '</td>
                            <td>' . $result["typeparking"] . '</td>
                        </tr>
                    ';
                }
                echo '
                    </tbody>
                </table>
            </div>
        </div>
    ';

    $result = mysqli_query($con, $query);
    $num_rows = mysqli_num_rows($result);
    $places=200;
    echo $num_rows."/200";
    echo "<h6>Searching between:<br>$now || $dateTill</h6>";
    require_once("../parts/footer.php")
?>
</body>
</html>
