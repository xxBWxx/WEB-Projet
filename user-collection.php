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

//username-id match
$selectUsername = "SELECT * FROM person WHERE username = '$username'";
$queryUsername = mysqli_query($con, $selectUsername);
$fetchUsername = mysqli_fetch_assoc($queryUsername);

$userId = $fetchUsername["id"];

// admin check
$role = $fetchUsername["role"];

// redirection to admin page
if (isset($data["admin"])){
  $_SESSION["role"] = $role;
  header("location: admin-page.php");
}

//adding item to cart
if (isset($data["add-to-cart"])){
    $message = null;

    $productId = $data["product-id"];
    $productName = $data["product-name"];
    $productPrice = $data["product-price"];
    $productImage = $data["product-image"];
    $productQuantity = $data["product-quantity"];

    if ($productQuantity > 0){
        $addItem = mysqli_query($con, "INSERT INTO cart(personId, productId, productName, productPrice, productImage) VALUES ('$userId', '$productId', '$productName', '$productPrice', '$productImage')");

        $updateQuantity = mysqli_query($con, "UPDATE product SET quantity = '$productQuantity' - 1 WHERE id = '$productId'");

        header("location: #cart");
    }

    else{
        $message = "Item out of stock! Click here to dismiss.";
    }
}

// removing item from cart
$remove = $data["remove-cart"];

if (isset($remove)){
  $removeId = $data["remove-id"];
  $removeName = $data["remove-name"];
  $getQuantity = mysqli_query($con, "SELECT * FROM product WHERE name = '$removeName'");
  $fetchQuantity = mysqli_fetch_assoc($getQuantity);
  $removeQuantity = $fetchQuantity["quantity"];
  $removeItem = mysqli_query($con, "DELETE FROM cart WHERE personId = $userId AND id = $removeId");
  $updateQuantity2 = mysqli_query($con, "UPDATE product SET quantity = '$removeQuantity' + 1 WHERE name = '$removeName'");

  header("location: #cart");
}

// calculating subtotal
$selectCart2 = mysqli_query($con, "SELECT * FROM cart WHERE personId = '$userId'");
$totalAmount = 0;

if (mysqli_num_rows($selectCart2) > 0){
  while ($fetchCart2 = mysqli_fetch_assoc($selectCart2)){
    $totalAmount = $totalAmount + $fetchCart2["productPrice"];
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
          <li><a href="user-page.php" class="nav-item">Home</a></li>

          <li>
            <a href="#collection" class="nav-item"
              ><span class="nav-span">Muse</span>Collection</a
            >
          </li>
          <li><a href="#cart" class="nav-item">Cart</a></li>
        </ul>

        <div class="icons">
          <span class="user">
            <?php echo $username; ?>
          </span>
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
                            
                            <?php if ($fetchProduct["quantity"] > 0) {?>
                            <input type="submit" name="add-to-cart" class="add-btn" value="Add to Cart">
                            <?php }
                            else { ?> 
                                <p class="message2">Item out of stock!</p>
                            <?php } ?>

                        </form>
                <?php };
                };

            ?>
      </section>

      <?php
        if (isset($message)){ ?>
          <div class="message" onclick="this.remove();">
            <?php echo $message; ?>
          </div>
        <?php }
      ?>

      <!-- cart -->
      <section class="cart" id="cart">

        <!-- getting user cart -->
        <?php

            $selectCart = mysqli_query($con, "SELECT * FROM cart WHERE personId = '$userId'");
            
            if (mysqli_num_rows($selectCart) > 0){ ?>
                <h2>
                <i class="bx bx-cart cart-begin"></i>
                </h2>
            <?php
                while ($fetchCart = mysqli_fetch_assoc($selectCart)){ ?>
                    <div class="cart-item">
                      
                        <img src="img/<?php echo $fetchCart["productImage"]; ?>" alt="" class="cart-img">
                        <h3 class="cart-item-name"><?php echo $fetchCart["productName"]; ?></h3>
                        <h3 class="cart-item-price">€<?php echo $fetchCart["productPrice"]; ?></h3>
                        <form action="" method="post" class="remove-form">
                          <button type="submit" name="remove-cart" class="remove-cart-btn">
                            <i class="fa-solid fa-xmark remove-cart"></i>
                          </button>
                          <input type="hidden" name="remove-id" value="<?php echo $fetchCart["id"]; ?>">
                          <input type="hidden" name="remove-name" value="<?php echo $fetchCart["productName"]; ?>">
                      </form>
                    </div>
                <?php } ?>
                    <div class="checkout-cont">
                      <div class="subtotal-cont">
                        <h3 class="subtotal">Subtotal: <span class="total-amount">€<?php echo $totalAmount; ?></span></h3>
                      </div>
                      <div class="checkout-btn-cont"></div>
                      <form action="" method="post">
                        <input class="checkout-btn" type="submit" value="Proceed to Checkout" name="checkout" onclick="return confirm('Are you sure you want to buy these items?')">
                      </form>
                      <?php

                        if (isset($data["checkout"])){
                          mysqli_query($con, "DELETE FROM cart WHERE personId = '$userId'");
                          header("location: checkout.php");
                        }

                      ?>
                    </div>
            <?php }

            else{ ?>
                <h2 class="no-item-cart">
                <i class="bx bx-cart cart-begin"></i>
                </h2>
                <h3 class="collection-title no-item">There is no item in your cart!</h3>
            <?php }
        ?>
      </section>
    </div>

    <!-- user popup -->
    <div class="popup popup2" id="popup2">
      <div class="x">
        <i class="fa-solid fa-xmark x-mark2"></i>
      </div>

      <div class="popup-user">
        <span>
          <?php echo $username ?>
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
        <a href="#cart" class="basket">
          <div>
            <i class="bx bx-cart"></i>
            <h4>Go to Cart</h4>
          </div>
        </a>
        <a
          href="index.php"
          class="logout"
          onclick="return confirm('Are you sure you want to log out?')"
        >
          <div>
            <i class="bx bx-log-out"></i>
            <h4>Log Out</h4>
          </div>
        </a>
      </div>
    </div>
  </body>
</html>
