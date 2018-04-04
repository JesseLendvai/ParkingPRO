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
        header('Location: http://localhostparkingpro/pages/login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {

    }
?>

<div class="row">
    <div class="top-section col-12">
        <h2>Overzicht reserveringen</h2>
    </div>
</div>

<div class="row">
    <?php
    require_once("../parts/sidebar.php");
    ?>

    <div class="right-section col-9">
        <div class="row">
            <div class="col-2 input-text">
            </div>
            <div class="col-10 form-input">
                <table>
                    <thead>
                            <!-- $result_set = query("SELECT * FROM reservering, klant WHERE klant.kenteken = reservering.kenteken AND klant.emailadres = '" . $_SESSION['gebruiker'] . "'"); -->
                        <th class="table-header">Kenteken</th>
                        <th class="table-header">Datum</th>
                        <th class="table-header">Tijd</th>
                        <th class="table-header">Type</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM reservering, klant WHERE klant.kenteken = reservering.kenteken AND klant.emailadres = '" . $_SESSION['gebruiker'] . "'";

                            $result = $con->query($sql);

                            if($result->num_rows > 0){    
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                    <tr>
                                        <td class="table-data">' . $row["kenteken"] . '</td>
                                        <td class="table-data">' . substr($row["aankomst"], 0, 10) . '</td>
                                        <td class="table-data">' . substr($row["aankomst"], 11, 8) . '</td>
                                        <td class="table-data">' . $row["typeparking"] . '</td>
                                        <td class="table-betalen"><a href="./betalen.php">Betalen</a></td>
                                    </tr>
                                ';
                            }
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html