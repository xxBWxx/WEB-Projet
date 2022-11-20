<?php

// db connection
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");


// creation of variables
$data = $_POST;

$username = $data["username"];
$email = $data["email"];
$password = $data["password"];
$passwordConf = $data["password-conf"];

$usernameError = null;
$emailError = null;
$passwordError = null;
$matchError = null;


if (isset($data["submit"])){
  // username errors
  if (strlen($username) < 2){
      $usernameError = "Username must be at least 2 characters long!";
  }

  $searchUsername = "SELECT * FROM person WHERE username = '$username'";
  $resultUsername = mysqli_num_rows(mysqli_query($con, $searchUsername));

  if ($resultUsername == 1){
      $usernameError = "Username already taken!";
  }

  // email errors
  $searchEmail = "SELECT * FROM person WHERE email = '$email'";
  $resultEmail = mysqli_num_rows(mysqli_query($con, $searchEmail));

  if ($resultEmail == 1){
      $emailError = "User with this email exists!";
  }

  // password errors
  if (strlen($password) < 8){
      $passwordError = "Password must be at least 8 characters long!";
  }

  if ($password != $passwordConf){
      $matchError = "Passwords dont' match!";
  }

  // user registration
  if (empty($usernameError) && empty($emailError) && empty($passwordError) && empty($matchError)){
      $addUser = "INSERT INTO person(username, email, password) VALUES ('$username', '$email', '$password')";
      mysqli_query($con, $addUser);
      $_SESSION["username"] = $username;
      header("location: user-page.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become a Muse Member</title>

    <!-- css -->
    <link rel="stylesheet" href="style-reg.css" />

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <!-- box icons -->
    <link rel="stylesheet" href="boxicons.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />

    <!-- font awesome -->
    <script
      src="https://kit.fontawesome.com/07986597ae.js"
      crossorigin="anonymous"
    ></script>

    <!-- logo -->
    <link rel="icon" type="image/x-icon" href="bxs-music.svg" />

    <!-- typed js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <!-- custom js -->
    <script src="script.js"></script>
  </head>
  <body>
    <div class="body-cont">
      <a href="index.php" class="index-link"
        ><img src="img/png-logo.png" alt=""
      /></a>

      <form action="" class="reg-form" method="POST">
        <h2>Become a Muse Member</h2>

        <div class="form-cont">
          <div class="reginput-cont">
            <i class="fa-solid fa-user"></i>
            <input
              type="text"
              name="username"
              placeholder="Create a username"
              value="<?php echo $username ?>"
              required
            />
          </div>
          <?php if (isset($usernameError)) {?>
            <p class="error"><?php echo $usernameError ?></p>
          <?php }?>
        </div>

        <div class="form-cont">
          <div class="reginput-cont">
            <i class="fa-solid fa-envelope"></i>
            <input
              type="email"
              name="email"
              placeholder="Enter your email address"
              value="<?php echo $email ?>"
              required
            />
          </div>
          <?php if (isset($emailError)) {?>
            <p class="error"><?php echo $emailError ?></p>
          <?php }?>
        </div>

        <div class="form-cont">
          <div class="reginput-cont">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              name="password"
              placeholder="Create a password"
              value="<?php if (empty($passwordError) && empty($matchError)){echo $password;} ?>"
              required
            />
          </div>
          <?php if (isset($passwordError)) {?>
            <p class="error"><?php echo $passwordError ?></p>
          <?php }?>
          <?php if (isset($matchError)) {?>
            <p class="error"><?php echo $matchError ?></p>
          <?php }?>
        </div>

        <div class="form-cont">
          <div class="reginput-cont">
            <i class="fa-solid fa-check"></i>
            <input
              type="password"
              name="password-conf"
              placeholder="Confirm your password"
              value="<?php if (empty($passwordError) && empty($matchError)){echo $password;} ?>"
              required
            />
          </div>
        </div>

        <div class="btn-cont">
          <div class="underline">
            <input type="submit" class="reg-btn" value="Sign In" name="submit"/>
            <i class="fa-solid fa-right-to-bracket"></i>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
