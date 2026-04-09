<?php

   $title = "Swapping Variable Values";
   include('includes/header.php');

 /* 
    Write a program to swap 2 numbers.

    Note: This doesn't just take in 2 numbers and display them in reverse order. It needs to take the value inside $number1 and get it into $number2 and vice versa without erasing one.
 */

$number_1 = 25;
$number_2 = 7;

echo "<p>The first number is $number_1; the second number is $number_2.</p>";

$number_3 = $number_1;
$number_1 = $number_2;
$number_2 = $number_3;

echo "<p>The first number is $number_1; the second number is $number_2.</p>";

?>

<!-- We're outside of the PHP block, so we can use straight HTML here. -->
<a href="index.php" class="btn btn-outline-primary mt-5">Return to Table of Contents</a>

<?php
  include('includes/footer.php');
?>