<?php
 session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <title>Hostel Manage</title>
    <style>
        body{
            background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(images/image-asset\ \(1\).jpeg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="bg-dark">
<?php
require("./php/connection.php");
require("./php/admin_login.php");
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand brand" href="./index.php" style="font-size: 1.5rem;">HostelerZ</a>
    </nav>
    <div class="container-fluid">
        
        <div class="container signup mt-5 p-3 bg-light py-5">
            <h1 class="text-center">Login As Admin</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"> <?php echo "<div class='err'>$emailerr</div>" ?>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password"> <?php echo "<div class='err'>$passworderr</div>" ?>
                </div>
                <button type="submit" class="btn btn-primary px-5" style="margin-left: 35%;" name="login">Login</button>
                </form>
                <p class="lead mt-3 ml-5" style="margin-left: 100px !important;">Not a Member, Register ?<a href="./register.php" class="btn btn-sm btn-success px-4 ml-3">Signup</a></p>
        </div>
    </div>
    <?php
  $conn->close();
 ?> 
</body>
</html>