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

    if(isset($_POST['add_pupil'])) {
          $name = $_POST['pupil_name'];
          $address = $_POST['pupil_address'];
          $medical_info = $_POST['pupil_medical'];
          $class_id = $_POST['class_id'];

     // Check if the pupil is already enrolled in a class
          $sql = "SELECT COUNT(*) AS enrollment_count FROM pupils WHERE name = '$name' AND address = '$address'";
          $result = $conn->query($sql);
          $rows = $result->fetch_assoc();

      if ($rows['enrollment_count'] == 0) {
            // Retrieve the current number of pupils in the class
               $sql = "SELECT COUNT(*) AS pupil_count, (SELECT capacity FROM classes WHERE id = $class_id) AS capacity FROM pupils WHERE class_id = $class_id";
               $result = $conn->query($sql);
               $rows = $result->fetch_assoc();

        if ($rows['pupil_count'] < $rows['capacity']) {
            // Proceed with insertion
            $sql = "INSERT INTO pupils (name, address, medical_info, class_id) VALUES ('$name', '$address', '$medical_info', '$class_id')";
          
            if ($conn->query($sql) === TRUE) {
                echo "New pupil added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
        else {
            echo "Class is full. Cannot add more pupils.";
        }
    } 
       else {
        echo "This pupil is already enrolled in a class.";
    }
}

//Here is function to retrieve all pupil data
function retrieve_pupil_data($conn) {
    $sql = "SELECT * FROM pupils";

    $result = $conn->query($sql);

    //  Creating tables for data
    echo "<h2 class='heading'>Pupil Data</h2>";
      if ($result->num_rows > 0) {
         echo "
           <div class='container'>
                <table border='1'>
                     <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Address</th>
                         <th>Medical Info</th>
                         <th>Class ID</th>
                      </tr>
            </div>";

        $pupilIds = [];

            //   fetching the data from the database
        while($rows = $result->fetch_assoc()) {
            if (!in_array($rows["id"], $pupilIds)) {
                $pupilIds[] = $rows["id"];
                echo "<tr>
                        <td>" . $rows["id"] . "</td>
                        <td>" . $rows["name"] . "</td>
                        <td>" . $rows["address"] . "</td>
                        <td>" . $rows["medical_info"] . "</td>
                        <td>" . $rows["class_id"] . "</td>
                    </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p class='heading'>0 results</p>";
    }
}
?>

<!-- HTML form for Pupil -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Manage Pupils</title>
</head>
<body>
    <h1 class="heading">Manage Pupils</h1>

    <!-- Links for other pages -->
    <div class="container">
    <a class="Linktag" href="dashboard.php">Back to Dashboard</a>
    </div>

    <h2 class="heading">Add Pupil</h2>

    <div class="container">

    <!-- Form for the pupil -->
    <form method="post">
        Name: <input type="text" name="pupil_name" required><br>
        Address: <input type="text" name="pupil_address" required><br>
        Medical Info: <textarea name="pupil_medical"></textarea><br>
        Class ID: <input type="number" name="class_id"><br>
        <input class="button" type="submit" name="add_pupil" value="Add Pupil">
    </form>

    </div>

     <!-- calling the function to display data -->
    <?php retrieve_pupil_data($conn); ?>
</body>
</html>

<?php $conn->close(); ?>
