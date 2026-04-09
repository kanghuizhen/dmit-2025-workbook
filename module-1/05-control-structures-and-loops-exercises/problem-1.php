<?php
$title = "Value Checker";
include('includes/header.php');

/* 

Write a program that takes a numerical value and checks to see whether it's 
positive, negative, zero, or not a number.

*/

$number = 42;

// The following solution uses 'else if', but it can be converted into a nested 'if' structure.

if ($number > 0) { // Let's start by seeing if it's a positive number.
    echo "<p>$number is a positive number.</p>";
} else if ($number < 0) { // If it's not a positive number, let's see if it's negative.
    echo "<p>$number is a negative number.</p>";
} else if ($number == 0) { // If it's not positive or negative, let's see if it's zero.
    echo "<p>The value of the provided number is 0.</p>";
} else { // If it's none of the above, it's not a number.
    echo "<p>The value is not a numeric value.</p>";
}

include('includes/footer.php'); 

?>