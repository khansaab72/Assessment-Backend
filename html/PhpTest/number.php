<!DOCTYPE html>
<html lang="en">
<head>
    <title>NUMBER MACHINE</title>
</head>
<body>

    <h1>NUMBER MACHINE</h1>
    
    <?php
function number_machine($start_number) {
    // Add 4 to start_number
    $result = $start_number + 65;

    // Multiply the result by 3
    $result *= 3;

    // Subtract 1 from the result
    $result -= 1;

    // Multiply the result by 6
    $result *= 6;

    // Divide the result by 4
    $result /= 4;

    return $result;
}

// Example usage:
$start_number = 4;
$result = number_machine($start_number);
echo $result;  // This will print the final result after all operations
?>

</body>
</html>