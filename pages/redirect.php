<?php
    require_once("../initialize.php");
//get the asked things
$aankomst = $_GET['aankomst'];
$vertrek = $_GET['vertrek'];
$type = $_GET['type'];
  //select the asked things
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $query = "SELECT voornaam, emailadres, rol FROM klant WHERE emailadres = '" . $_POST['emailadres'] . "' AND wachtwoord = '" . $_POST['wachtwoord'] . "'";
        $result = $con->query($query);
        //if the num_rows inside the result is bigger then 0. then display the result
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            $_SESSION['gebruiker'] = $row['emailadres'];
            $_SESSION['rol'] = $row['rol'];

            if ($_SESSION['rol'] == "u") {
                $_SESSION['logged_user'] = TRUE;
            } elseif ($_SESSION['rol'] == "a") {
                $_SESSION['logged_admin'] = TRUE;
            }
            $email = $_POST['emailadres'];
            var_dump($_SESSION);
            echo "U wordt geredirect";

$to = $email;
$subject = "";

$message = "
<html>
<head>
<title>Drive in, Drive out ticket</title>
</head>
<body>
<p>Dit is je drive-in ticket.</p>
<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://www.google.com/&choe=UTF-8'/>
<p>Dit is je drive-out ticket</p>
<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://www.youtubbe.com/&choe=UTF-8'/>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <airport@lelystad.nl>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
	echo "done";
}

            header('Location: http://localhost/parkingpro/pages/index.php?mail=true');

            }
        }else{
            header("Location: http://localhost/parkingpro/pages/login.php?aankomst=$aankomst&vertrek=$vertrek&type=$type");
        }
    }






?>

<?php
// $to = "email@gmail.com";
// $subject = "";

// $message = "
// <html>
// <head>
// <title>Drive in, Drive out ticket</title>
// </head>
// <body>
// <img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http://www.google.com/&choe=UTF-8'/>
// </body>
// </html>
// ";

// // Always set content-type when sending HTML email
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From: <webmaster@example.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

// if(mail($to,$subject,$message,$headers)){
// 	echo "done";
// }
?>
