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


   if(isset($_POST['add_teacher'])) {

        $name = $_POST['teacher_name'];
        $address = $_POST['teacher_address'];
        $phone_number = $_POST['teacher_phone'];
        $annual_salary = $_POST['teacher_salary'];
        $background_check = isset($_POST['background_check']) ? 1 : 0;
        $class_id = $_POST['class_id'];

    //  Check if the class already has a teacher assigned
        $sql = "SELECT COUNT(*) AS teacher_count FROM teachers WHERE class_id = $class_id";
        $result = $conn->query($sql);
        $rows = $result->fetch_assoc();

    if ($rows['teacher_count'] == 0) {
        //  Data insertion in database

        $sql = "INSERT INTO teachers (name, address, phone_number, annual_salary, background_check, class_id) VALUES ('$name', '$address', '$phone_number', '$annual_salary', '$background_check', '$class_id')"; // Inserting the data into database
       
        // Checking connection 
        if ($conn->query($sql) === TRUE) {
            echo "New teacher added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } 
    else {
        echo "This class already has a teacher assigned.";
    }
}

         //Here is function to retrieve all teacher data
                function retrieve_teacher_data($conn) {
                        $sql = "SELECT * FROM teachers";

                        $result = $conn->query($sql);

                       echo "<h2 class='heading'>Teacher Data</h2>";
                          if ($result->num_rows > 0) {
                                echo "<div class='container'>
                                          <table border='1'>
                                              <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Address</th>
                                                  <th>Phone Number</th>
                                                  <th>Annual Salary</th>
                                                  <th>Background Check</th>
                                                  <th>Class ID</th>
                                               </tr>
                                     </div>";

                //    Fetching the data from database                  
        while($rows = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $rows["id"] . "</td>
                    <td>" . $rows["name"] . "</td>
                    <td>" . $rows["address"] . "</td>
                    <td>" . $rows["phone_number"] . "</td>
                    <td>" . $rows["annual_salary"] . "</td>
                    <td>" . ($rows["background_check"] ? 'Yes' : 'No') . "</td>
                    <td>" . $rows["class_id"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='heading'>0 results</p>";
    }
}
?>

<!-- HTML Form for Teacher -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
    <title>Manage Teachers</title>
</head>
<body>
   
<h1 class="heading">Manage Teachers</h1>

    <div class="container">
    <a class="Linktag" href="dashboard.php">Back to Dashboard</a>
    </div>

    <h2 class="heading">Add Teacher</h2>

    <div class="container">

       <form method="post">
        <!-- Form for teacher -->
           Name: <input type="text" name="teacher_name" required><br>
           Address: <input type="text" name="teacher_address" required><br>
           Phone Number: <input type="text" name="teacher_phone" required><br>
           Annual Salary: <input type="number" step="0.01" name="teacher_salary" required><br>
           Background Check: <input type="checkbox" name="background_check" value="1"><br>
           Class ID: <input type="number" name="class_id"><br>
           <input class="button" type="submit" name="add_teacher" value="AddTeacher">
        </form>

    </div>

    <!-- calling function to display data  -->
    <?php retrieve_teacher_data($conn); ?>
</body>
</html>

<?php $conn->close(); ?>
