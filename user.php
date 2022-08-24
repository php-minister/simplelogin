<?php

session_start();
//print_r($_SESSION);
if (!empty($_SESSION["jb_userid"])) {
    header("Location: index.php");
	exit;
}

?>

<html>
<head>
<title>User Dashboard</title>
<link href="./assests/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div>
        <div class="dashboard">
            <div class="member-dashboard">Welcome <b><?php echo $_SESSION['jb_username']; ?></b>, You have successfully logged in!<br>
                Click to <a href="./change-password.php" class="logout-button">Change Password</a> || <a href="./sign-out.php" class="logout-button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>