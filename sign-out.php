<?php

session_start();
$_SESSION["jb_user_id"] = "";
session_destroy();
header("Location: index.php");

?>