<?php
$title = "Times Tables";
include('includes/header.php');

// Write a program that takes a numerical value and prints its multiplication table.

$num = 5;

echo "<h2>Multiplication Table for $num</h2>";

// First, set up the table.
echo "<table class=\"table table-striped\">";
echo "<tbody>";

for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<td>$num x $i</td>";
    echo "<td>" . ($num * $i) . "</td>";
    echo "</tr>";
}

// Next, finish the table.
echo "</tbody>";
echo "</table>";

include('includes/footer.php'); 

?>