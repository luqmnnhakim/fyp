

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class=body-login>
    <div class="login-container">
        <h2 class=h2-login>Login</h2>
        <form method="POST" action="loginprocess.php">
            <div class="form-grouplogin">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-grouplogin">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-grouplogin">
                <button type="submit" name="login">Login</button>
            </div>
            
            <div class="form-grouplogin">
                <a href="#" class="forget-password">Forget Password?</a>
            </div>
        </form>
    </div>
    <?php
        if(@$_GET['invalid']=='yes'){
            ?>
    <script>
        alert("Username or Password incorrect ");
    </script>
        <?php
        }
        ?>
</body>
</html>