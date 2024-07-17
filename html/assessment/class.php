<?php
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

//Here is to Insert data 
if(isset($_POST['add_class'])) {

    $class_name = $_POST['class_name'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO classes (class_name, capacity) VALUES ('$class_name', '$capacity')"; // Query to inter data into database

    //  Checking if connect successfully during inserting data

      if ($conn->query($sql) === TRUE) {
           echo "New class added successfully";
    } 
       else {
           echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


               //Here is function to retrieve all class data
      function retrieve_class_data($conn) {
        // Query to fetch data from tables and also from other tables using Joins and Aliases
              $sql = "
              SELECT 
                    classes.id,
                    classes.class_name, 
                    classes.capacity,
                    pupils.name AS pupil_name, 
                    teachers.name AS teacher_name, 
                    parentsguardians.name AS parent_name
               FROM classes 
                    LEFT JOIN pupils ON classes.id = pupils.class_id 
                    LEFT JOIN teachers ON classes.id = teachers.class_id 
                    LEFT JOIN parentsguardians ON pupils.id = parentsguardians.pupil_id
    ";

    $result = $conn->query($sql);

    // Here is to check repeating rows
    echo "<h2 class='heading'>Class Data</h2>";

    // If row is empty
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
                                  </tr>
                        </div>";

               $classData = [];

            //    fetching the data from database
                   while($rows = $result->fetch_assoc()) {
                         if (!isset($classData[$rows["id"]])) {
                            $classData[$rows["id"]] = [
                                "class_name" => $rows["class_name"],
                                "capacity" => $rows["capacity"],
                                "teacher_name" => $rows["teacher_name"],
                                "pupils" => [],
                                "parents" => []
                ];
            }
            // Checking any repeated rows
            if ($rows["pupil_name"]) {
                $classData[$rows["id"]]["pupils"][] = $rows["pupil_name"];
            }
            if ($rows["parent_name"]) {
                $classData[$rows["id"]]["parents"][] = $rows["parent_name"];
            }
        }
         
        foreach ($classData as $class) {

            echo "<tr>
                    <td>" . $class["class_name"] . "</td>
                    <td>" . $class["capacity"] . "</td>
                    <td>" . implode(", ", $class["pupils"]) . "</td>
                    <td>" . ($class["teacher_name"] ?? 'N/A') . "</td>
                    <td>" . implode(", ", $class["parents"]) . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='heading'>0 results</p>";
    }
}
?>

<!-- HTML Form for Class -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
    <title>Class Management</title>
</head>
<body>

    <h1 class="heading">Class Management</h1>
   
    <!-- Links for the other pages -->
    <div class="container">
    
             <a class="Linktag" href="index.php">Home</a>
             <a class="Linktag" href="dashboard.php">Back to Dashboard</a>
    
    </div>
   
    <h2 class="heading">Add Class</h2>

    <div class="container">
    
    <!-- Form to enter class data -->
        <form method="post">
        Class Name: 
        <select name="class_name" required>
            <option value="Reception Class">Reception Class</option>
            <option value="Class 1">Class 1</option>
            <option value="Class 2">Class 2</option>
            <option value="Class 3">Class 3</option>
            <option value="Class 4">Class 4</option>
            <option value="Class 5">Class 5</option>
            <option value="Class 6">Class 6</option>
            <option value="Class 7">Class 7</option>
        </select><br>
        Capacity: <input type="number" name="capacity" required><br>
        <input class="button" type="submit" name="add_class" value="Add Class">
        </form>
    
    </div>
  
    <!-- Calling the function to display the data from database -->
    <?php retrieve_class_data($conn); ?>
</body>
</html>

<?php $conn->close(); ?>