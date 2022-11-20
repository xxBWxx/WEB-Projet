<?php 

$data = $_POST;

// connection to db
session_start();
$con = mysqli_connect("localhost", "root", "root");
mysqli_select_db($con, "muse");

// admin check
$role = $_SESSION["role"];
if ($role != 1){
    header("location: index.php");
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en" class="html">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>

    <!-- css -->
    <link rel="stylesheet" href="style-admin.css" />

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
  </head>

  <body>
    <a href="user-page.php" class="exit-link">Exit Admin Page</a>

    <form action="" method="POST">
      <input type="submit" name="create-user" value="Create New User" class="create-btn">
    </form>

    <?php
      
      if (isset($data["create-user"])){ ?>
        <form action="" method="POST" class="create-form">
          <div class="input-cont">
            <div class="input-item">
              <label>Username:</label>
              <input type="text" name="create-username">
            </div>
            <div class="input-item">
              <label>Email:</label>
              <input type="email" name="create-email">
            </div>
            <div class="input-item">
              <label>Password:</label>
              <input type="text" name="create-password">
            </div>
            <div class="input-item">
              <label>Role:</label>
              <input type="text" name="create-role">
            </div>

            <input type="submit" name="create-btn" value="Create User" class="apply" id="create-user">
            <input type="submit" name="quit-creating" value="Quit" class="quit">
          </div>

          
        </form>
      <?php }

        if (isset($data["create-btn"])){
          $username = $data["create-username"];
          $email = $data["create-email"];
          $password = $data["create-password"];
          $role = $data["create-role"];

          if (empty($username) || empty($email) || empty($password) || ($role == null)){ ?>
            <div class="error" onclick="this.remove()">Please fill all fields when creating a user! Click here to dismiss.</div>
          <?php }
          
          else{
            mysqli_query($con, "INSERT INTO person(username, email, password, role) VALUES('$username', '$email', '$password', '$role')");
            header("location: admin-page.php");    
          }
        }

        if (isset($data["quit-creating"])){
          header("location: admin-page.php");
        }
    ?>


    <?php 

        $queryUsers = mysqli_query($con, "SELECT * FROM person");
        
        if (mysqli_num_rows($queryUsers) > 0){ ?>
    <table>
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
        </tr>
      </thead>

      <?php while ($fetchUsers = mysqli_fetch_assoc($queryUsers)){ ?>
      <tbody>
        <tr>
          <td><?php echo $fetchUsers["username"]; ?></td>
          <td><?php echo $fetchUsers["email"]; ?></td>
          <td><?php echo $fetchUsers["password"]; ?></td>
          <td><?php echo $fetchUsers["role"]; ?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="id" value="<?php echo $fetchUsers["id"]; ?>">
              
              <input
                type="hidden"
                name="username"
                value="<?php echo $fetchUsers["username"]; ?>"
              />
              <input
                type="hidden"
                name="email"
                value="<?php echo $fetchUsers["email"]; ?>"
              />
              <input
                type="hidden"
                name="password"
                value="<?php echo $fetchUsers["password"]; ?>"
              />
              <input
                type="hidden"
                name="role"
                value="<?php echo $fetchUsers["role"]; ?>"
              />
              <input type="submit" name="edit" value="Edit User" class="edit"/>
              <input type="submit" name="delete" value="Delete User" onclick="return confirm('Are you sure you want to delete this user?')" class="delete"/>
            </form>
          </td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <?php }        
    ?>


    <?php

        if (isset($data["delete"])){
          $id = $data["id"];
          mysqli_query($con, "DELETE FROM person WHERE id = '$id'");
          header("location: admin-page.php");
        }

        if (isset($data["edit"])){
            $id = $data["id"];
            $username = $data["username"];
            $email = $data["email"];
            $password = $data["password"];
            $role = $data["role"];
        ?>
            <div class="edit-form">
                <form action="" method="POST" class="edit-form">
                    <input type="hidden" name="id2" value="<?php echo $id; ?>">
                    <input type="hidden" name="username2" value="<?php echo $username; ?>">
                    <input type="hidden" name="email2" value="<?php echo $email; ?>">
                    <input type="hidden" name="password2" value="<?php echo $password; ?>">
                    <input type="hidden" name="role2" value="<?php echo $role; ?>">

                    <div class="input-cont">
                      <div class="input-item">
                        <label>Username:</label>
                        <input type="text" name="new-username" placeholder="<?php echo $username; ?>">
                      </div>
                      
                      <div class="input-item">
                        <label>Email:</label>
                        <input type="email" name="new-email" placeholder="<?php echo $email; ?>">
                      </div>
                      
                      <div class="input-item">
                        <label>Password:</label>
                        <input type="text" name="new-password" placeholder="<?php echo $password; ?>">
                      </div>
                      
                      <div class="input-item">
                        <label>Role:</label>
                        <input type="text" name="new-role" placeholder="<?php echo $role; ?>">  
                      </div>
                    </div>
                    
                    <div class="btn-cont">
                      <input type="submit" name="apply-edit" value="Apply Changes" class="apply">
                      <input type="reset" name="reset" value="Reset" class="reset">
                      <input type="submit" name="close-edit" value="Quit Editing" class="quit">
                    </div>

                    <div class="space"></div>
                </form>
            </div>
        
        <?php }

            if (isset($data["close-edit"])){
              header("location: admin-page.php");
            }

            if (isset($data["apply-edit"])){
                $id2 = $data["id2"];
                $username2 = $data["username2"];
                $email2 = $data["email2"];
                $password2 = $data["password2"];
                $role2 = $data["role2"];
                
                $newUsername = $data["new-username"];
                if ($newUsername == null){
                  $newUsername = $username2;
                }

                $newEmail = $data["new-email"];
                if ($newEmail == null){
                  $newEmail = $email2;
                }

                $newPassword = $data["new-password"];
                if ($newPassword == null){
                  $newPassword = $password2;
                }

                $newRole = $data["new-role"];
                if ($newRole == null){
                  $newRole = $role2;
                }

                mysqli_query($con, "UPDATE person SET username = '$newUsername' WHERE id = '$id2'");
                mysqli_query($con, "UPDATE person SET email = '$newEmail' WHERE id = '$id2'");
                mysqli_query($con, "UPDATE person SET password = '$newPassword' WHERE id = '$id2'");
                mysqli_query($con, "UPDATE person SET role = '$newRole' WHERE id = '$id2'");
                
                header("location: admin-page.php");
            }
        ?>


  </body>
</html>
