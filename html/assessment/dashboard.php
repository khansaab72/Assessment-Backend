<?php

session_start();

// If user is invalid then it will lead to admin portal again
    if (!isset($_SESSION['admin'])) {
        header('Location: admin.php');
        exit;
}
?>

<!-- HTML Dashboard -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1 class="heading">Admin Dashboard</h1>
    
    <!-- Links for all the forms -->
    <div class="container">
    
          <a class="Linktag" href="class.php">Manage Classes</a>
          <br>
          <a class="Linktag" href="teacher.php">Manage Teachers</a>
          <br>
          <a class="Linktag" href="pupil.php">Manage Pupils</a>
          <br>
          <a class="Linktag" href="parent.php">Manage Parents/Guardians</a>
          <br>
          <a class="Linktag" href="logout.php">Logout</a>
    
    </div>
</body>
</html>
