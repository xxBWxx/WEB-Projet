<?php

// connection to db
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");

// username check
$username = $_SESSION["username"];

if (!isset($username)){
  header("location: index.php");
}

// admin check
$queryUser = mysqli_query($con, "SELECT * FROM person WHERE username = '$username'");
$fetchUser = mysqli_fetch_assoc($queryUser);
$role = $fetchUser["role"];

// redirection to admin page
if (isset($_POST["admin"])){
  $_SESSION["role"] = $role;
  header("location: admin-page.php");
}

// logging out
if (isset($_GET["logout"])){
  unset($username);
  session_destroy();
  header("location: index.php");
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
    <script src="script-user.js"></script>
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
          <span class="user logged-user">
            <?php echo $username; ?>
          </span>
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
                    <a href="user-collection.php">
                      <i class="bx bx-cart cart cart-login"></i>
                    </a>
                    <img src="img/<?php echo $fetchProduct["image"]; ?>" alt="" class="collection-img">
                    <h3 class="product-name"><?php echo $fetchProduct["name"]; ?></h3>
                    <a href="user-collection.php">
                      <i class="bx bx-right-arrow-alt arrow arrow-login"></i>
                    </a>
                </div>
            <?php };
            };

          ?>

        </div>
      </section>

      <!-- collection -->
      <section class="collection" id="collection">
        <div class="img-cont">
          <a href="user-collection.php" class="collection-link">Get Your Muse</a>
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

    <!-- user popup -->
    <div class="popup popup2" id="popup2">
      <div class="x">
        <i class="fa-solid fa-xmark x-mark2"></i>
      </div>

      <div class="popup-user">
        <span>
          <?php echo $username; ?>
        </span>
      </div>

      <?php
        if ($role == 1){ ?>
                <div class="admin-link">
                  <form action="" method="POST">
                    <input type="submit" name="admin" value="Go to Admin Page">
                  </form>
                </div>
      <?php } ?>

      <div class="user-popup-cont">
        <a href="user-collection.php#cart" class="basket">
            <div>
                <i class="bx bx-cart"></i>
                <h4>Go to Cart</h4>
            </div>
        </a>
        <a href="index.php" class="logout" onclick="return confirm('Are you sure you want to log out?')" >
            <div>
                <i class="bx bx-log-out"></i>
                <h4>Log Out</h4>
            </div>
        </a>
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
