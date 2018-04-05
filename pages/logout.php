<?php

  setcookie ("email", "", time() - 3600);
//will reset the cookie
unset($_COOKIE["email"]);
// will destroy the cookie
    session_start();
    session_destroy();

    header('Location: http://localhost/parkingpro/pages/index.php');
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
			location.href = "http://localhost/parkingpro/pages/index.php";
		}
// test
	</script>
</body>
</html>
