<?php

// connection to db
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");

// creation of variables
$data = $_POST;

$username = $data["username"];
$password = $data["password"];

$usernameError = null;
$passwordError = null;

if (isset($data["submit"])){
  // username check
  $searchUsername = "SELECT * FROM person WHERE username = '$username'";
  $isSigned = mysqli_num_rows(mysqli_query($con, $searchUsername));

  if ($isSigned != 1){
      $usernameError = "Username does not exist!";
  }


  // password check
  $getPassword = mysqli_fetch_assoc(mysqli_query($con, $searchUsername));

  if ($getPassword["password"] != $password){
      $passwordError = "Wrong password!";
  }

  // user login
  if (empty($usernameError) && empty($passwordError)){
      $_SESSION["username"] = $username;
      header("location: user-collection.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en" class="html">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muse: Become a Musician</title>

    <!-- css -->
    <link rel="stylesheet" href="style-collection.css" />

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
      <!-- header -->
      <header>
        <a href="#" class="logo"
          ><img src="img/png-logo.png" alt="muse logo"
        /></a>

        <ul class="nav-list open">
          <li><a href="index.php" class="nav-item">Home</a></li>

          <li>
            <a href="#collection" class="nav-item"
              ><span class="nav-span">Muse</span>Collection</a
            >
          </li>
        </ul>

        <div class="icons">
          <i class="fa-solid fa-user user" id="user-icon"></i>
          <div class="hamburger">
            <div class="menu-bar"></div>
          </div>
        </div>
      </header>

      <h2 class="collection-title">Get Your Muse From Our Exclusive Collection</h2>

      <!-- collection -->
      <section class="collection" id="collection">
      
            <?php

                $selectProduct = "SELECT * FROM product";
                $queryProduct = mysqli_query($con, $selectProduct);
        
                if (mysqli_num_rows($queryProduct) > 0){
                    while($fetchProduct = mysqli_fetch_assoc($queryProduct)){ ?>
                        <form action="" method="POST" class="collection-item">
                            <img src="img/<?php echo $fetchProduct["image"]; ?>" alt="" class="collection-img">
                            <h2 class="product-name"><?php echo $fetchProduct["name"]; ?></h2>
                            <h4 class="product-price">€<?php echo $fetchProduct["price"]; ?></h4>
                            <input type="hidden" name="product-id" value="<?php echo $fetchProduct["id"]; ?>">
                            <input type="hidden" name="product-name" value="<?php echo $fetchProduct["name"]; ?>">
                            <input type="hidden" name="product-price" value="<?php echo $fetchProduct["price"]; ?>">
                            <input type="hidden" name="product-image" value="<?php echo $fetchProduct["image"]; ?>">
                            <input type="hidden" name="product-quantity" value="<?php echo $fetchProduct["quantity"]; ?>">
                            <span class="add-btn cart-login">Add to Cart</span>
                        </form>
                <?php };
                };

            ?>

      </section>

      <section></section>
    </div>

    <!-- login form -->
    <div class="popup" id="popup">
      <div class="x">
        <i class="fa-solid fa-xmark x-mark"></i>
      </div>

      <div class="form-box">
        <form action="" class="inputs" id="login" method="POST">
          <h2>Welcome</h2>

          <div class="input-cont">
            <i class="fa-solid fa-user"></i>
            <input
              type="text"
              name="username"
              class="input-field"
              placeholder="Username"
              value="<?php echo $username ?>"
              required
            />
            <?php if (isset($usernameError)) {?>
              <p class="error"><?php echo $usernameError ?></p>
            <?php }?>
          </div>

          <div class="input-cont">
            <i class="fa-solid fa-lock"></i>
            <input
              type="password"
              name="password"
              class="input-field"
              placeholder="Password"
              required
            />
            <?php if (isset($passwordError)) {?>
              <p class="error"><?php echo $passwordError ?></p>
            <?php }?>
          </div>

          <input class="form-btn" type="submit" value="Log In" name="submit"> 
        </input>

          <div class="signup-cont">
            <h5 class="signup">Don't have an account?</h5>
            <a href="register.php" class="signup-link">Sign up now</a>
          </div>
        </form>
      </div>
    </div>

  </body>
</html>
