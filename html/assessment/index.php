<?php
   $servername = "localhost";
   $username = "root";
   $password = "password";
   $dbname = "RishtonAcademy";

        // here is to Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

// here is to Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

        // here is function to retrieve all data
   function retrieve_data($conn) {
        $sql = "
          SELECT 
              Classes.class_name, 
              Classes.capacity,
              Pupils.name AS pupil_name, 
              Teachers.name AS teacher_name, 
              ParentsGuardians.name AS parent_name,
              Pupils.address AS pupil_address
         FROM Classes 
              LEFT JOIN Pupils ON Classes.id = Pupils.class_id 
              LEFT JOIN Teachers ON Classes.id = Teachers.class_id 
              LEFT JOIN ParentsGuardians ON Pupils.id = ParentsGuardians.pupil_id
    ";

    $result = $conn->query($sql);

    
    echo "<h2 class='heading'>School Data</h2>";
    
    // checking the database is empty
    if ($result->num_rows > 0) {

        // creating tables
        echo "<div class='container'>
                    <table border='1'>
                         <tr>
                               <th>Class</th>
                               <th>Capacity</th>
                               <th>Pupil Name</th>
                               <th>Teacher Name</th>
                               <th>Parent Name</th>
                               <th>Address</th>
                         </tr>
                </div>";

        $classData = [];

        while($row = $result->fetch_assoc()) {
            //  using loop fetching the data from database

            if (!isset($classData[$row["class_name"]])) {
                $classData[$row["class_name"]] = [
                    "capacity" => $row["capacity"],
                    "teacher_name" => $row["teacher_name"],
                    "pupils" => [],
                    "parents" => [],
                    "addresses" => []
                ];
            }
          
            // Here is to check repeating rows
            if ($row["pupil_name"]) {
                $classData[$row["class_name"]]["pupils"][] = $row["pupil_name"];
            }
            if ($row["parent_name"]) {
                $classData[$row["class_name"]]["parents"][] = $row["parent_name"];
            }
            if ($row["pupil_address"]) {
                $classData[$row["class_name"]]["addresses"][] = $row["pupil_address"];
            }
        }

        foreach ($classData as $class_name => $class) {
            echo "<tr>
                    <td>" . $class_name . "</td>
                    <td>" . $class["capacity"] . "</td>
                    <td>" . implode(", ", $class["pupils"]) . "</td>
                    <td>" . ($class["teacher_name"] ?? 'N/A') . "</td>
                    <td>" . implode(", ", $class["parents"]) . "</td>
                    <td>" . implode(", ", $class["addresses"]) . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1 class="heading">School Management System</h1>
      
    <!-- Links for the pages -->
    
    <div class="container"> 
           <a class="Linktag" href="admin.php">Admin Portal</a>
    
    </div>

     <!-- calling the function to render data when connection is build -->
    <?php retrieve_data($conn); ?> 
</body>
</html>

<?php $conn->close(); ?>
