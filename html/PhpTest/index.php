<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body
<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];
 
    if ($input1 === $input2) {
        echo "It's the same.";
    } else {
        echo "It's not the same.";
    }
// }
?>
    ?>
</body>
</html>