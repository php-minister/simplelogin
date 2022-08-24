<?php

//print_r($_SESSION);
if (!empty($_SESSION["jb_userid"])) {
    header("Location: index.php");
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Password</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div>
        <form action="validate_user.php" method="post" id="chngpass_form">
        <input type="hidden" name="form_type" value="change_pass">
            <div class="demo-table">

                <div class="form-head">Change Password</div>
                <?php
                session_start(); 
                if(isset($_SESSION["error_msg"])) {
                ?>
                <div class="error-message"><?php echo $_SESSION["error_msg"]; ?></div>
                <?php
                    unset($_SESSION["error_msg"]); 
                } 
                ?>
                
                <div class="field-column">
                    <div>
                        <label for="password">Current Password</label><span id="currpass_msg" class="error-info"></span>
                    </div>
                    <div>
                        <input name="current_passw" id="curpasswd" type="password" class="demo-input-box">
                    </div>
                </div>
                <div class="field-column">
                    <div>
                        <label for="password">New Password</label><span id="newpass_msg" class="error-info"></span>
                    </div>
                    <div>
                        <input name="new_passw" id="newpasswd" type="password" class="demo-input-box">
                    </div>
                </div>
                <div class=field-column>
                    <div>
                        <input type="button" name="login" value="Update" class="btnLogin" onClick="updatePassword();"></span>
                    </div>
                </div>
                <div align="center">
                    <p><a href="dashboard.php">Back</a></p>    
                </div>
            </div>
        </form>
    </div>
    <script>
    function updatePassword() {
        
        document.getElementById("currpass_msg").innerHTML = "";
        document.getElementById("newpass_msg").innerHTML = "";
        
        var curpasswd = document.getElementById("curpasswd").value;
        var newpasswd = document.getElementById("newpasswd").value;
        
        if(curpasswd == "") 
        {
            document.getElementById("currpass_msg").innerHTML = "Current Password required!";
            document.getElementById("curpasswd").focus();
            return false;
        }

        if(newpasswd == "") 
        {
            document.getElementById("newpass_msg").innerHTML = "New Password required!";
            document.getElementById("newpasswd").focus();
            return false;
        }else{
            document.getElementById("chngpass_form").submit();
            return true;
        }

        return false;
        
    }
    </script>
</body>
</html>