<?php
session_start();
if(!empty($_SESSION["jb_user_id"])) {
    require_once ('./view/users/user.php');
}
?>
<html>
<head>
<title>JobBrands</title>	
</head>
<body>

<div align="center">
	<p><a href="sign-in.php">Sign-in</a> | <a href="sign-up.php">Sign-up</a></p>	
</div>

</body>
</html>
