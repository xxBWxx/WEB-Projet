<?php 

// connection to db
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");

// creation of variables
$username = null;
$_SESSION["username"] = null;
$role = 0;
$_SESSION["role"] = $role;
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
      header("location: user-page.php");
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
    <link rel="stylesheet" href="style.css" />

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
          <li><a href="#home" class="nav-item">Home</a></li>
          <li><a href="#new" class="nav-item">New</a></li>
          <li>
            <a href="#collection" class="nav-item"
              ><span class="nav-span">Muse</span>Collection</a
            >
          </li>
          <li><a href="#contact" class="nav-item">Contact</a></li>
        </ul>

        <div class="icons">
          <i class="fa-solid fa-user user" id="user-icon"></i>
          <div class="hamburger">
            <div class="menu-bar"></div>
          </div>
        </div>
      </header>

      <!-- home -->
      <section class="home" id="home">
        <div class="home-img">
          <img src="img/png-logo-icon.png" alt="muse icon" />
        </div>

        <div class="home-text">
          <h1>Own Your Muse</h1>
          <h2>
            Become a
            <div class="space"></div>
            <span class="input"></span>
          </h2>
          <a href="#collection" class="btn">Let's Rock!</a>
        </div>
      </section>

      <!-- new -->
      <section class="new" id="new">
        <div class="new-text">
          <h2>
            Create Your Muse With Our Brand New Instruments and Equipments!
          </h2>
        </div>

        <div class="new-content">

          <?php

            $selectProduct = "SELECT * FROM product WHERE status = 'new'";
            $queryProduct = mysqli_query($con, $selectProduct);

            if (mysqli_num_rows($queryProduct) > 0){
                while($fetchProduct = mysqli_fetch_assoc($queryProduct)){ ?>
                
                <div class="new-item">
                    <i class="bx bx-cart cart cart-login"></i>
                    <img src="img/<?php echo $fetchProduct["image"]; ?>" alt="" class="collection-img">
                    <h3 class="product-name"><?php echo $fetchProduct["name"]; ?></h3>
                    <i class="bx bx-right-arrow-alt arrow arrow-login"></i>
                </div>
            <?php };
            };

          ?>

        </div>
      </section>

      <!-- collection -->
      <section class="collection" id="collection">
        <div class="img-cont">
          <a href="collection.php" class="collection-link">Get Your Muse</a>
        </div>

        <div class="marks">
          <div class="mark-item">
            <img src="img/marks/gibson.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img
              src="img/marks/steinway-and-sons.png"
              alt=""
              class="mark-img"
            />
          </div>
          <div class="mark-item">
            <img src="img/marks/höfner.png" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/jackson.png" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/focusrite.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/ibanez.png" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/marshall.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/kawai.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/ernie-ball.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/yamaha.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/schecter.jpg" alt="" class="mark-img" />
          </div>
          <div class="mark-item">
            <img src="img/marks/fender.png" alt="" class="mark-img" />
          </div>
        </div>
      </section>

      <!-- contact -->
      <section class="contact" id="contact">
        <div class="footer-cont">
          <div class="footer-row">
            <div class="footer-col">
              <h4>Company</h4>
              <ul>
                <li><a href="" class="foot-link">About Muse</a></li>
                <li><a href="" class="foot-link">Services</a></li>
                <li><a href="" class="foot-link">Privacy Policy</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h4>Get Help</h4>
              <ul>
                <li><a href="" class="foot-link">FAQ</a></li>
                <li><a href="" class="foot-link">Shipping</a></li>
                <li><a href="" class="foot-link">Payment Options</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h4>Follow Muse</h4>
              <div class="social-links">
                <a href="tel:003349196653"
                  ><i class=" fa-solid fa-phone"></i>
                </a>
                <a href="mailto:wbaranacikelw@gmail.com" target="_blank"
                  ><i class="fa-solid fa-envelope"></i>
                </a>
                <a
                  href="https://tr-tr.facebook.com/baran.acikel"
                  target="_blank"
                  ><i class="fa-brands fa-facebook"></i
                ></a>
                <a href="https://www.instagram.com/baran_acikel/" target="_blank">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://twitter.com/_xBWx_" target="_blank"
                  ><i class="fa-brands fa-twitter"></i
                ></a>
                <a
                  href="https://fr.linkedin.com/in/baran-a%C3%A7%C4%B1kel-8a8852220"
                  target="_blank"
                  ><i class="fa-brands fa-linkedin"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
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

<script>
  var typed = new Typed(".input", {
    strings: ["Musician!", "Pianist!", "Guitarist!", "Drummer!"],
    typeSpeed: 90,
    backSpeed: 60,
    loop: true,
    showCursor: true,
  });
</script>
