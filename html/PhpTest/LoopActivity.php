<!DOCTYPE html>
<html lang="en">
<head>
    <title>Loops</title>
</head>
<body>

    <h1>LOOP TEST</h1>
    
    <?php
// Using foreach loop
echo "Using foreach loop:\n";
$numbers = range(92, 100);
foreach ($numbers as $number) {
    echo $number . "\n";
}
echo ("<br />");
echo "\n";

// Using for loop
echo "Using for loop:\n";
for ($i = 92; $i <= 100; $i++) {
    echo $i . "\n";
}

echo "\n";
echo ("<br />");

// Using while loop
echo "Using while loop:\n";
$i = 92;
while ($i <= 100) {
    echo $i . "\n";
    $i++; 
}
?>
</body>
</html>

