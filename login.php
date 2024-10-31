<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="body-login">
    <div class="login-container">
        <h2 class="h2-login">Login</h2>
        <form method="POST" action="loginprocess.php">
            <div class="form-group-login">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Your Name" required>
            </div><br>
            <div class="form-group-login">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password" required>
            </div><br>
            <div class="form-group-login">
                <button type="submit" name="login">Login</button>
            </div>
            
            <div class="form-group-login">
                <a href="#" class="forget-password">Forgot Password?</a>
            </div>
        </form>
    </div>
    <?php
        if (@$_GET['invalid'] == 'yes') {
            ?>
    <script>
        alert("Please Enter Valid Username or Password");
    </script>
            <?php
        }
    ?>
</body>
</html>
