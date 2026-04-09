<?php

$pal = isset($_POST['pal']) ? $_POST['pal'] : '';

// To define our function, we need a semantic name and a list of parameters that it needs. When we use (call) this function later, we'll need to pass in (provide) values for these parameters (arguments).
function palindrome_check($string) {
    // First, data normalisation! Comparisons are case-sensitive and can be thrown off by spaces. So, let's convert everything to lowercase and remove the spaces first. 
    $string = strtolower($string);

     // This accepts a search character, the characters we're replacing it with, and the string we're looking at.
    $string = str_replace(' ', '', $string);

    $pal_check = ($string == strrev($string));

    return $pal_check;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Palindrome Checker</title>
    
    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h1 class="text-center fw-light">Palindrome Checker</h1>
                <p class="text-center lead text-muted">Use the form below to check to see whether or not your word or phrase is a palindrome.</p>

                <hr class="my-5">

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-5">
                    <div class="mb-3">
                        <label for="pal" class="form-label">Your word or phrase:</label>
                        <input type="text" id="pal" name="pal" value="<?= $pal; ?>" class="form-control">
                    </div>

                    <input type="submit" id="submit" name="submit" value="Is this a palindrome?" class="btn btn-primary">
                </form>

                <?php
                
                if (isset($_POST['submit'])) {
                    echo "<p>Your phrase was: $pal.</p>";

                    if (palindrome_check($pal)) { // if the function returns TRUE
                        echo "<p class=\"text-success\">Your phrase is a palindrome!</p>";
                    } else { // else, if the function returns FALSE
                        echo "<p class=\"text-danger\">Your phrase is not a palindrome.</p>";
                    }
                }

                ?>

                <hr class="my-5">

                <h2>What is a palindrome?</h2>
                <p>A palindrome is a word, phrase, or sequence that reads the same backwards as forwards. Some examples include: madam; racecar; level; civic; nurses run; noon; radar ...</p>
                <p>... and many more!</p>
            </div>
        </div>
    </section>
  </body>
</html>
