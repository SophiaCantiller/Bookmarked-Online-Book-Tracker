<?php
  require_once("config.php");

  $error_msg = '';

  if(isset($_POST['submitBtn'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password1 = md5($_POST['password1']);
    $password2 = md5($_POST['password2']);

    if($password1 == $password2){

      $sql = "SELECT * FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $error_msg = "Email is already registered";
      }else{
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password1')";

        if (mysqli_query($conn, $sql)) {
          header("Location: login.php");
        }
      }

    }else{
      $error_msg = "Password does not match";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign up - Bookmarked</title>
</head>
<body>
    <div class="nav" id="nav">
        <h1><a href="index.php">Bookmarked</a></h1>
    </div>

        <!---------Sign-up page---------->
        <section class="contact">
            <div class="side-img">
                <h1>Keep track <br>of what <br>you read.</h1>
            </div>
        <div class="books2">
            <img src="images/Books.png" />
        </div>
        <form action="signup.php" method="POST">
          <div class="signup-container">
            <h1>Welcome to <b>Bookmarked.</b><br>Tell us about you!</h1>
            <div class="row row-columns">
              <div class="row-left">
                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstName"/>
              </div>
              <div class="row-right">
                <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastName"/>
              </div>
            </div>
            <div class="row">
              <div>
                <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email"/>
              </div>
            </div>
            <div class="row row-columns">
              <div>
                <label for="exampleFormControlInput1" class="form-label">Set your password</label>
                <input type="password" class="form-control" name="password1"/>
              </div>
              <div>
                <label for="exampleFormControlInput1" class="form-label">Repeat password</label>
                <input type="password" class="form-control" name="password2"/>
              </div>
            </div>
            <div class="row">
              <p class="error-msg"><?php echo $error_msg; ?></p>
              <button type="submit" class="btn btn-primary" id="btn3" name="submitBtn" type="button">Sign up</button>
            </div>
          </div>
        </form>
        </section>
</body>
</html>