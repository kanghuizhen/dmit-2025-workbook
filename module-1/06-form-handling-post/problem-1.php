<?php
$title = "Even or Odd";
include('includes/header.php');

/* 

    Write a program that takes a numerical value from the user and determines whether the number is even or odd.

    NOTE: An even number is a number that, when divded by two, has no remainder. We can use modulous to help us figure this out. However, when dealing with decimals, things get weird. We'll restrict things to whole numbers (integer). 

*/

// This is ternary statement. It says 'if the user already gave us a number, let's use its value for this variable; if they haven't, we'll initialise this variable with an empty value'.
$number = isset($_POST['number']) ? trim($_POST['number']) : '';
$message = '';

?>

<p class="lead mb-5">Enter a whole number below and hit "Submit" to see whether it is even or odd.</p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <label for="number" class="form-label">Enter a Number:</label>
        <!-- We are using some HTML attributes for basic front-end validation; however, these can be easily defeated, so we will learn how to double-check everything on the back end in Module 2 of this course. -->
        <input type="number" class="form-control" name="number" id="number" step="1" autocomplete="off" required>
    </div>

    <div class="mb-3 d-flex justify-content-center gap-2">
        <a href="problem-1.php" class="btn btn-outline-primary">Clear Form</a>
        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
    </div>
</form>

<?php 

if (isset($_POST['submit'])) {

    // First, let's see if the user gave us anything. 
    if ($number === '') {
        $message = '<p class="fs-2 text-danger">Please enter a value.</p>';
      } 
      
    // We're using elseif here because we don't want to continue if the user didn't give us a value (as checked in the last step).
    else if (filter_var($number, FILTER_VALIDATE_INT) !== false) {

        // Before we do any math, we're typecasting the user's number into an integer. If we don't do this, cases like '0' won't work.

        $number = (int) $number;

        if ($number % 2 == 0) {
            $message = "<p class=\"fs-2\">$number is an <strong>even</strong> number.</p>";
        } else {
            $message = "<p class=\"fs-2\">$number is an <strong>odd</strong> number.</p>";
        }
    } else { // If the number is not numberic, we'll tell the user this.s
        $message = "<p class=\"fs-2\">The value is not a numeric value.</p>";
    }
}

if ($message) {
    echo $message;
}

include('includes/footer.php'); 
?>
