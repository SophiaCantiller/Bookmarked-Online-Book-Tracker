<?php
    require_once("config.php");
    session_start();

    $error_msg = '';

    if(isset($_POST['loginAction'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($password == $row["password"]){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    header("Location: library.php");
                }else{
                    $error_msg = 'Incorrect password';
                }
            }
        }else{
            $error_msg = 'Invalid email address';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - Bookmarked</title>
</head>
<body>
    <div class="nav" id="nav">
        <h1><a href="index.php">Bookmarked</a></h1>
    </div>
    <section class="contact">
        <div class="side-img">
            <h1>Books Just <br>Within <br>Your <br>Reach</h1>
        </div>
        <div class="books2">
            <img src="images/Books.png" />
        </div>
        <form action="login.php" method="POST">
            <div class="text1">
                <h1>Welcome back to <b>Bookmarked.</b></h1>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="form-control-email" name="email"/>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="form-control-spassword" name="password" />

                    <p class="error-msg"><?php echo $error_msg ?></p>

                    <button class="btn btn-primary" name="loginAction" id="btn3" type="submit">Login</button>
                </div>
                <a href="login.php" target="_blanks" id="text2">Forgot your password?</a>
            </div>
        </form>
    </section>
</body>
</html>