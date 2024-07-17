<?php

session_start();

   if (!isset($_SESSION['admin'])) {
         header('Location: admin.php');
    exit;
    }

   $servername = "localhost";
   $username = "root";
   $password = "password";
   $dbname = "RishtonAcademy";

          //Here is to Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

         //Here is to Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error); 
     }

      if(isset($_POST['add_parent'])) {
          $name = $_POST['parent_name'];
          $address = $_POST['parent_address'];
          $email = $_POST['parent_email'];
          $phone_number = $_POST['parent_phone'];
          $pupil_id = $_POST['pupil_id'];

    // Inserting the data into database
    $sql = "INSERT INTO parentsguardians (name, address, email, phone_number, pupil_id) VALUES ('$name', '$address', '$email', '$phone_number', '$pupil_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New parent/guardian added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Here is function to retrieve all parent/guardian data
function retrieve_parent_data($conn) {

    //Check repeating rows
    $sql = "SELECT DISTINCT id, name, address, email, phone_number, pupil_id FROM parentsguardians";

    $result = $conn->query($sql);

    echo "<h2 class='heading'>Parent/Guardian Data</h2>";
    if ($result->num_rows > 0) {
        echo "<div class='container'>
        <table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Pupil ID</th>
                </tr>
                </div>";

        $parentIds = [];

        // fetching the data from database
        while($rows = $result->fetch_assoc()) {
            if (!in_array($rows["id"], $parentIds)) {
                $parentIds[] = $rows["id"];
                echo "<tr>
                        <td>" . $rows["id"] . "</td>
                        <td>" . $rows["name"] . "</td>
                        <td>" . $rows["address"] . "</td>
                        <td>" . $rows["email"] . "</td>
                        <td>" . $rows["phone_number"] . "</td>
                        <td>" . $rows["pupil_id"] . "</td>
                    </tr>";
            }
        }

        echo "</table>";
        } 
    else {
        echo "<p class='heading'>0 results</p>";
    }
}
?>

<!-- HTML form for Parents  -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Manage Parents/Guardians</title>
</head>
<body>
    
<h1 class="heading">Manage Parents/Guardians</h1>

        <!-- Links for other pages -->
    <div class="container">
    <a class="Linktag" href="dashboard.php">Back to Dashboard</a>
    </div>

    <h2 class="heading">Add Parent/Guardian</h2>

    <div class="container">

           <!-- Forms for the parents -->
      <form method="post">
            Name: <input type="text" name="parent_name" required><br>
            Address: <input type="text" name="parent_address" required><br>
           Email: <input type="email" name="parent_email" required><br>
           Phone Number: <input type="text" name="parent_phone" required><br>
           Pupil ID: <input type="number" name="pupil_id"><br>
           <input class="button" type="submit" name="add_parent" value="Add Parent">
      </form>

    </div>

            <!-- Calling functions to display data -->
      <?php retrieve_parent_data($conn); ?>
</body>
</html>

<?php $conn->close(); ?>
