<!DOCTYPE html>
<html lang="en">
<head>
<title>User Register</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div>
        <form action="validate_user.php" method="post" id="register_form">
        <input type="hidden" name="form_type" value="register">
            <div class="demo-table">

                <div class="form-head">Register</div>
                <?php
                session_start(); 
                if(isset($_SESSION["error_msg"]) && $_GET['msg']!='registered') {
                ?>
                <div class="error-message"><?php echo $_SESSION["error_msg"]; ?></div>
                <?php
                    unset($_SESSION["error_msg"]); 
                }if(isset($_SESSION["error_msg"]) && $_GET['msg']=='registered') {
                ?>
                <div class="success-message"><?php echo $_SESSION["error_msg"]; ?></div>
                <?php 
                    unset($_SESSION["error_msg"]);
                } 
                ?>
                <div class="field-column">
                    <div>
                        <label for="username">Username</label><span id="username_msg" class="error-info"></span>
                    </div>
                    <div>
                        <input name="username" id="username" type="text" class="demo-input-box">
                    </div>
                </div>
                <div class="field-column">
                    <div>
                        <label for="email">Email</label><span id="email_msg" class="error-info"></span>
                    </div>
                    <div>
                        <input name="email" id="email" type="text" class="demo-input-box">
                    </div>
                </div>
                <div class="field-column">
                    <div>
                        <label for="password">Password</label><span id="pass_msg" class="error-info"></span>
                    </div>
                    <div>
                        <input name="passwd" id="passwd" type="password" class="demo-input-box">
                    </div>
                </div>
                <div class=field-column>
                    <div>
                        <input type="button" name="register" value="Register" class="btnLogin" onClick="validateRegister();"></span>
                    </div>
                </div>
                <div align="center">
                    <p><a href="sign-in.php">Sign-in</a></p>    
                </div>
            </div>
        </form>
    </div>
    <script>
    function validateRegister() {
        
        document.getElementById("username_msg").innerHTML = "";
        document.getElementById("email_msg").innerHTML = "";
        document.getElementById("pass_msg").innerHTML = "";
        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
        
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var passwd = document.getElementById("passwd").value;
        
        if(username == "") 
        {
            document.getElementById("username_msg").innerHTML = "Username is mandatory!";
            document.getElementById("user_name").focus();
            return false;
        }

        if(!email_regex.test(email)){
            document.getElementById("email_msg").innerHTML = "Invalid Email address!";
            document.getElementById("email").focus();
            return false;
        }
        if(passwd == "") 
        {
            document.getElementById("pass_msg").innerHTML = "Password required!";
            document.getElementById("passwd").focus();
            return false;
        }else{
            document.getElementById("register_form").submit();
            return true;
        }

        return false;
        
    }
    </script>
</body>
</html>