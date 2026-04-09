<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comparison Operators, Logical Operators, Control Structures, & Loops</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h2 class="display-5 mb-4">Comparison Operators</h2>

            <?php

            // This is an assignment statement. We are assigning a value to something (in this case, a variable). It is a single = sign.
            $x = 6;

            // With an IF statement, we can check to see if an expression is evaluated as TRUE; if it is, we can execute some code inside of a block (i.e. between curly braces). If not, that code will be ignored.
            if ($x == 6) { // The double-equals sign (==) checks for equality.
                echo "<p>X is 6.</p>";
            }

            // This checks to see if these two things have the same values AND the same data type. It is stricter, but can help prevent weird data typing errors from happening.
            if ($x === 6) {
                echo "<p>X is 6 and it is the same data type.</p>";
            }

            // We can also check to see if two values are NOT equal with the negation operator.
            if ($x != 5) {
                echo "<p>X is not equal to 5.</p>";
            }

            // In PHP, != can also be written as: <>
            if ($x <> 4) {
                echo "<p>X is not equal to 4.</p>";
            }

            // Let's try a comparison operator! This is 'greater than'.
            if ($x > 5) {
                echo "<p>X is greater than 5.</p>";
            }

            // We can also see if a value is greater than or equal to another.
            if ($x >= 6) {
                echo "<p>X is greater than or equal to 6.</p>";
            }

            // Let's try 'less than' next!
            if ($x < 10) {
                echo "<p>X is less than 10.</p>";
            }

            // Now, 'less than or equal to'.
            if ($x <= 7) {
                echo "<p>X is less than or equal to 7.</p>";
            }

            ?>

            <h2 class="display-5 mb-4">Logical Operators</h2>

            <?php

            // With the AND operator, all parts of the statement must be TRUE.
            if ($x > 2 && $x < 10) {
                echo "<p>X is greater than 2 <strong>AND</strong> less than 10; both parts must be TRUE.</p>";
            }

            // With the OR operator, at least one part of the statement must be TRUE.
            if ($x > 2 || $x < 4) {
                echo "<p>X is greater than 2 <strong>OR</strong> less than 4; at least one part of this statement must be TRUE,</p>";
            }

            // With XOR (exclusive OR), exactly one part of the statement must be TRUE.
            if ($x > 2 xor $x < 10) {
                echo "<p>X is either greater than 2 <strong>OR<strong> less than 10; only one of these statements is allowed to be true.</p>";
            }

            ?>

            <h2 class="display-5 mb-4">Control Structures</h2>

            <h3 class="my-3">Nested If/Else Block</h3>

            <?php

            $x = "This variable is a string now.";

            if ($x === 5) {
                $message = "<p>X is 5.</p>";
            } elseif ($x === 6) {
                $message = "<p>X is 6.</p>";
            } elseif (is_numeric($x) && ($x < 10 || $x > 12)) {
                /**
                 * Because of PHPs type juggling (i.e. it mutates a variable's data type on the fly), PHP will convert a string to a numeric value when trying to evaluate using a comparison operator (< or >).
                 * 
                 * In this case, a non-numeric string is converted to the number 0. So:
                 * 
                 * $x = "This variable is a string now." -> is coerced to 0.
                 * 
                 * ($x < 10 || $x > 12) -> (0 < 10) is TRUE -> overall condition is TRUE
                 * 
                 * To fix this, we need to add an extra step: is this numeric? Then, we can compare our values.
                 * 
                 * is_numeric() -> This method returns TRUE or FALSE depending upon whether the argument passed into it is a number or not a number.
                 */
                $message = "<p>X is a number, and it is less than 10 or greater than 12.</p>";
            } else {
                $message = "<p>X is not equal to 5 or 6, and it is not less than 10 or greater than 12.</p>";
            }

            // isset() -> This method checks to see if a variable exists, is initialised, or assigned a value. It returns TRUE or FALSE.
            if (isset($message)) {
                echo $message;
            }

            ?>

            <h3 class="my-3">Switch Statement</h3>

            <?php

            // With switch statements, we start with some sort of condition that we're checking.
            switch (TRUE) {

                // Next, we present a case (i.e. a condition that we're checking).
                case $x === 5:
                    $message = "<p>X is 5.</p>";
                    // If the condition is met, we need to 'break' in order to exit the structure. If we do not break, then we do not exit the switch statement when we should and we keep evaluating subsequent cases.
                    break;

                case $x === 5:
                    $message = "<p>X is 6.</p>";
                    break;

                // Up above, we used an OR logical operator to check two conditions. We'll use a 'fall0-through' case to evaluate multiple things at once.
                case $x < 10:
                case $x > 12:
                    // This message will be used for either of our two possibilities. 
                    $message = "<p>X is less than 10 or greater than 12.</p>";
                    break;

                // If none of our cases are TRUE, we need a default case (equivalent to ELSE).
                default:
                    $message = "<p>X is not equal to 5, equal to 6, or a number.</p>";
                    break;
            }

            echo $message;

            ?>

            <h3 class="display-6">PHP 8+ Alternative: <code>match</code> Expression</h3>

            <?php

            /**
             * This is a match expression. It returns a value, uses strict comparisons, and has concise syntax; however, it is functionally the same as nested-ifs and switch statements. 
             * 
             * Whatever you put in the parenthesis is the thing you're 'matching' against each arm. It could be variable, the literal TRUE, or even a functional call. 
             * 
             * Each line inside of the braces is called an arm. An arm has two parts, separated by the arrow => : 
             * 
             * 1. condition (or pattern) on the left
             * 2. result expression on the right
             * 
             * As soon as PHP finds the first arm whose condition "matches", it returns that arm's result and exits the structure. 
             * 
             */

            // This match expression is identical to the switch case above.
            $message = match (TRUE) {
                $x === 5         => "<p>X is 5.</p>",
                $x === 6         => "<p>X is 6</p>",
                $x < 10, $x > 12 => "<p>X is less than 10 or less than 12.</p>",
                default          => "<p>X was not found.</p>",
            };

            echo $message;

            ?>

            <h2 class="display-5 mb-4">Loops</h2>

            <h3 class="mt-4">While Loop</h3>

            <?php

            /*
                Loops need at least three things to work properly (and not get stuck in an infinite loop):
    
                1. An initial value; this usually counts how many times we've gone through a loop.
    
                2. Some sort of exit condition; if this condition is met, the interpreter will exit the loop. 
                        
                3. Some sort of change where the condition can approach FALSE; this is usually an increment (++) or decrement (--).
            */

            $input = 1;

            // This is a test-first (or pre-test) loop.
            while ($input <= 5) {
                echo "<p>Times through the loop: $input</p>";
                $input++;
            }

            ?>

            <h3 class="mt-4">Do/While Loop</h3>

            <?php
            // This is a test-last (or post-test) loop.
            do {
                echo "<p>Times through the loop: $input</p>";
                $input++;
            } while ($input <= 10);

            ?>

            <h3 class="mt-4">For Loop</h3>

            <?php
            // This is a test-first (or pre-test) loop.
            for ($i = 5; $i < 10; $i++) {
                echo "<p>Counter value: $i</p>";
            }

            ?>

            <h3 class="mt-4">For Each Loop</h3>

            <?php
            // For Each loops are special: they're made to work specifically with arrays.

            // We're going to use a superglobal array today ($_SERVER). This array keeps tonnes of information about the server, its state, and other things related to PHP. While it should never be echoed out to the user, we will use some of it's values later on in the course.

            foreach ($_SERVER as $key => $value) {
                echo "<p>$key : $value</p>";
            }

            ?>
        </div>
    </section>
</body>

</html>