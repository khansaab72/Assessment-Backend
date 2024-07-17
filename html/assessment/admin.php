<?php
session_start();

if (isset($_POST['login'])) {

       $Username = $_POST['username'];
       $Password = $_POST['password'];

            // here is admin credentials and authenticate either user is valid
           if ($Username == 'admin' && $Password == 'admin') {

                 $_SESSION['admin'] = true;
                 header('Location: dashboard.php'); //Leading to dashboard if user is valid
                   exit;
  } 
  else {
        $error = "Invalid username or password"; //error handing in case of invalid user
    }
}
?>

<!-- HTML form -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Admin Login</title>
</head>
<body>

         <h1 class="heading">Admin Login</h1>
          
         <div class="container">
         <a class="Linktag" href="index.php">Home</a> 
         <br>
         <p>For Demo Purpose Credentials Are Given Below</p>
         <p>Username: admin</p>
         <p>Password: admin</p>
         </div>

         <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

  <div class="container">
        <!-- Form for the admin portal -->
         <form method="post">
                Username: <input type="text" name="username" required>
                <br>
                Password: <input type="password" name="password" required>
                <br>
               <input class="button" type="submit" name="login" value="Login">
    </form>

  </div>
</body>
</html>
