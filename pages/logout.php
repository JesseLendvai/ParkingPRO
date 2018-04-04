<?php
setcookie ("email", "", time() - 3600);
//will reset cookie(client,browser)
unset($_COOKIE["email"]);
// will destroy cookie(server)
    session_start();
    session_destroy();

    header('Location: http://localhostparkingpro/pages/index.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<button onclick="del()">delete</button>

	<script type="text/javascript">

		function del(){
			document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
			location.href = "http://localhostparkingpro/pages/index.php";
		}
// test
	</script>
</body>
</html>
