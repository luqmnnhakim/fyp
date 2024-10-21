

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
                <label for="username">Nama Pengguna</label>
                <input type="text" name="username" placeholder="Masukkan Nama Anda" required>
            </div>
            <div class="form-grouplogin">
                <label for="password">KataLaluan</label>
                <input type="password" name="password" placeholder="Masukkan KataLaluan Anda" required>
            </div>
            <div class="form-grouplogin">
                <button type="submit" name="login">Masuk</button>
            </div>
            
            <div class="form-grouplogin">
                <a href="#" class="forget-password">Lupa KataLaluan?</a>
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