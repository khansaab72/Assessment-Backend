<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Linking</title>
    <?php include ("db.php"); ?>

    <?php 
                if (!isset($_GET["first_name"])){
                        $_GET["first_name"] = "";
                }
                ?>

</head>
<body>
    <h1>Get Data From Database</h1>

    <form action = "Get2.php" method = "GET">
        <input name= "first_name" placeholder = "Search" type = type="text" value=" <?php echo ($_GET["first_name"]); ?>" />
        <input type="submit" />
    <table>
        <thead>
            <tr>
                <th>Employee Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM `employees` WHERE `first_name` LIKE '%" . $_GET["first_name"] . "%';";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach($rows as $row) {
                echo ("<tr>");
                echo("      <td>" . $row["employee_id"] . "</td>");
                echo("      <td>" . $row["first_name"] . "</td>");
                echo("      <td>" . $row["last_name"] . "</td>");
                echo("      <td>" . $row["email"] . "</td>");
                echo("</tr>");
            }
            ?>
        </tbody>
    </table>
</body>
</html>