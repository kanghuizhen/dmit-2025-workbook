<?php

$title = "Swapping Variable Values";
include('includes/header.php');

/*
    Write a program that prompts the user for the lengths of the two shorter sides of a right triangle. It then calculates and displays the length of the longer side (i.e. hypotenuse).
*/

// We need to use a method for square roots [sqrt()], but we can either use a method [pow()] or an arithmetic operator [**] to do exponents.

$adjacent = 5;
$opposite = 8;

// Remember that when PHP evaluates an arithmetic expression, the order of operations applied (i.e. PEMDAS)

$hypotenuse = sqrt($adjacent ** 2 + $opposite ** 2);

// The number that PHP gives us is very long and not terribly user-friendly. We can round the value to two decimal places before we echo it out to them.

$hypotenuse = round($hypotenuse, 2);

echo "<p>The hypotenuse of a right triangle with an adjacent length of $adjacent and an opposite length of $opposite is $hypotenuse.</p>";
?>

<!-- We're outside of the PHP block, so we can use straight HTML here. -->
<a href="index.php" class="btn btn-outline-primary mt-5">Return to Table of Contents</a>

<?php
  include('includes/footer.php');
?>