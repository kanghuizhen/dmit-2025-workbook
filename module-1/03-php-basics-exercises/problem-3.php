<?php

$title = "Four-Digit Adding";
include('includes/header.php');

echo "<h3 class=\"fw-light fs-3 mt-3\">Programmatic Method</h3>";

/*  
    We can easily figure this out programmatically (as we might in a maths class). 

    Because we know we have a four-digit number with a thousands, hundredths, tens, and ones place value, we can do the following:

    1. Extract the last digit using modulus (% 10). This will give us the remainder when divided by 10, which is the last digit.
    
    2. Remove the last digit with integer division, which looks like the following: 
    
        intdiv($number, 10)
    
       This will bring it to the next digit (going backwards).

    3. Add the extracted digit to the $sum variable.
    
    4. Repeat the process until all digits are extracted.

*/

$initial_number = 1234;
$working_number = 1234;
$sum = 0;

$sum += $working_number % 10;                  // Extract the last digit
$working_number = intdiv($working_number, 10); // Remove the last digit

$sum += $working_number % 10;                  // Extract the next-to-last digit
$working_number = intdiv($working_number, 10); // Remove the next-to-last digit

$sum += $working_number % 10;                  // Extract the third digit
$working_number = intdiv($working_number, 10); // Remove the third digit

$sum += $working_number % 10;                  // Extract the fourth digit

echo "<p> The sum of each number in $initial_number is $sum.</p>";

/* 
    But PHP is a weak-typed language. Do we have to do maths? We could get away with treating our user input as a string. And since PHP treats a string like an array of characters, we can actually just grab each character from that array and add them. 

    Note that if you try to concatenate each character, they'll be treated as characters, not numbers.
*/

echo "<h3 class=\"fw-light fs-3 mt-3\">String to Array to Number Method</h3>";

$string = '5297';

$total = $string[0] + $string[1] + $string[2] + $string[3];

echo "<p>The sum of each number in $string is $total.</p>";

?>

<!-- We're outside of the PHP block, so we can use straight HTML here. -->
<a href="index.php" class="btn btn-outline-primary mt-5">Return to Table of Contents</a>

<?php
  include('includes/footer.php');
?>