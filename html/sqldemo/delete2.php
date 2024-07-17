<?php
    include("db.php");

    $query = " DELETE FROM `employees` WHERE `employee_id` = " . $_GET ['delete_id'] . ";";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        echo("Failed to execute query: " . mysqli_error($conn));
        die();
    }

    $number_of_rows_deleted = mysqli_affected_rows($conn);
    if($number_of_rows_deleted == 0) {
        echo("No records deleted.");
        die();
    }

    header("Location: delete.php");
    die();

    ?>