<?php

$date = isset($_POST['date']) ? $_POST['date'] : '';

// This function validates a date format. It will return TRUE or FALSE.
function validate_date($date) {
    // When comparing dates, we need both of them to be in the same format. This is the format we will use.
    $date_format = 'Y-m-d';

    // Even if the user didn't enter their date in this format, we'll see if we have the correct information and if we can arrange it in this format. 
    $parsed_date = date_parse_from_format($date_format, $date);

    return $parsed_date['error_count'] === 0 && checkdate($parsed_date['month'], $parsed_date['day'], $parsed_date['year']);
}

// This function calculates the difference (in days) between two dates (today and the user's provided date).
function calculate_days_difference($date) {
    // Let's start by asking the server what the current date is.
    $current_date = date('Y-m-d');

    // Dates are technically strings! However, unix time is an integer. So, we need to convert our strings to unix time in order to do any calculations. 
    $difference = strtotime($current_date) - strtotime($date);

    // Alright, now we have the difference between our two dates — but it's in seconds (unix time)! So, we need to convert this to days. 
    return round($difference / (60 * 60 * 24));
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Date Checker</title>
    
    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h1 class="text-center fw-light">Date Checker</h1>
                <p class="text-center lead text-muted">Want to know how many days it's been since something happened? What about a countdown until a day in the future? Enter a date down below to check how many days are between then and now.</p>
                <hr class="my-5">

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-5">
                    <div class="mb-3">
                        <label for="date" class="form-label">Enter a date:</label>
                        <input type="date" id="date" name="date" value="<?= $date; ?>" class="form-control">
                    </div>

                    <input type="submit" id="submit" name="submit" value="Check Date" class="btn btn-primary">
                </form>

                <?php
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo "<hr class=\"my-5\">";

                    // Let's start by validating the date that the user provided. 
                    if (validate_date($date)) {

                        // If the date is valid, we can go ahead and compare today's date with the user's provided date.
                        $days_difference = calculate_days_difference($date);

                        if ($days_difference < 0) { // If the date is negative, it's in the future.
                            // We are using the absolute value here so that the user doesn't get a negative number of days shown to them.
                            echo "<p>The date is in the future. There are " . abs($days_difference) . " days left.</p>";
                        } elseif ($days_difference > 0) { // If the date is positive, it's in the past.
                            echo "<p>The date is in the past. It was " . abs($days_difference) . " days ago.</p>";
                        } else { // If the date is 0, it's today.
                            echo "<p>The date is today!</p>";
                        }

                    } else {
                        echo "<p class=\"text-danger\">Invalid date format.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </section>
  </body>
</html>
