<?php

$data = $_POST;

// connection to db
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");

// username check
$username = $_SESSION["username"];

if (!isset($username)){
  header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muse: Become a Musician</title>

    <!-- css -->
    <link rel="stylesheet" href="style-checkout.css" />

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
  </head>
<body>
    <div class="body-cont">
      <div class="h-cont">
        <h1>Thanks for shopping with us <?php echo $username; ?>!</h1>
        <h2>Enjoy your Muse</h2>
        <div class="a-cont">
          <a href="user-page.php">
            User Page
            <i class="bx bx-right-arrow-alt arrow"></i>
          </a>
        </div>
      </div>
    </div>
</body>
</html>