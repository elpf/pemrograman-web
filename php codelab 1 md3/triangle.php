<?php
// Number of rows
$n = 5;

for ($i = 1; $i <= $n; $i++) {
    // Print leading spaces
    for ($j = $i; $j < $n; $j++) {
        echo "&nbsp;&nbsp;";
    }

    // Print stars
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    
    // Move to the next line
    echo "<br>";
}
?>
