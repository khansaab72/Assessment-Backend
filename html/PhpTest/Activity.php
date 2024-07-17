<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP TEST 1</title>
</head>
<body>
    <h1>PHP Test 1</h1>
    <?php
        // PHP Code Will Go Here
        $percentage = 60; // Change this value to test different percentages

        if ($percentage >= 70) {
            echo "<p>Degree Classification: First Class</p>";
        } elseif ($percentage >= 60) {
            echo "<p>Degree Classification: Upper Second Class</p>";
        } elseif ($percentage >= 50) {
            echo "<p>Degree Classification: Lower Second Class</p>";
        }elseif ($percentage >= 40) {
            echo "<p>Degree Classification: Third Class</p>";
        } else {
            
            echo "<p>Degree Classification: Fail</p>";
    }
    ?>
</body>
</html>

