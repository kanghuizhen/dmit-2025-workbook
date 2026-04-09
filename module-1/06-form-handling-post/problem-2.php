<?php
$title = "Temperature Converter";
include('includes/header.php');

/*
    Write a program that converts a temperature from Celsius to Fahrenheit or Fahrenheit to Celsius based on user input.
*/

$temperature = isset($_POST['temperature']) ? trim($_POST['temperature']) : '';
$direction = isset($_POST['direction']) ? $_POST['direction'] : '';
$message = '';

?>

<p class="lead mb-5">Use the form below to convert temperatures between Celsius and Fahrenheit.</p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-5">
    <!-- Temperature (Number) -->
    <div class="mb-4">
        <label for="temperature" class="form-label">Temperature:</label>
        <input type="number" class="form-control" name="temperature" id="temperature" placeholder="Enter a number" value="<?php echo $temperature; ?>">
    </div>

    <!-- Direction (C to F || F to C) -->
    <fieldset class="mb-4">
        <legend class="fw-normal fs-6">Conversion Type</legend>

        <div class="form-check">
            <input type="radio" name="direction" id="c-to-f" value="c-to-f" class="form-check-input" <?php echo $direction === 'c-to-f' ? 'checked' : '' ?>>
            <label for="c-to-f" class="form-label">Celcius to Fahrenheit</label>
        </div>

        <div class="form-check">
            <input type="radio" name="direction" id="f-to-c" value="f-to-c" class="form-check-input" <?php echo $direction === 'f-to-c' ? 'checked' : '' ?>>
            <label for="f-to-c" class="form-label">Fahrenheit Celcius</label>
        </div>
    </fieldset>

    <!-- Submit -->
    <div class="mb-3">
        <input type="submit" name="submit" id="submit" value="Convert" class="btn btn-primary">
    </div>
</form>

<?php
if (isset($_POST['submit'])) {

    // We'll do some super basic validation here again.
    if ($temperature === '') {
        $message = '<p class="fs-2 text-danger">Please enter a temperature value.</p>';
    } elseif (!is_numeric($temperature)) {
        $message = '<p class="fs-2 text-danger">Please enter a valid number.</p>';
    }

    // Next, let's make sure tha Validate conversion direction
    elseif (!in_array($direction, ['c-to-f', 'f-to-c'], true)) {
        $message = '<p class="fs-2 text-danger">Please select a conversion type.</p>';
    } else {
        $temp = (float)$temperature;
        if ($direction === 'c-to-f') {
            $result  = ($temp * 9 / 5) + 32;
            $message = "<p class=\"fs-2\">{$temp}°C is <strong>" . round($result, 2) . "°F</strong>.</p>";
        } else {
            $result  = ($temp - 32) * 5 / 9;
            $message = "<p class=\"fs-2\">{$temp}°F is <strong>" . round($result, 2) . "°C</strong>.</p>";
        }
    }
}

if ($message) {
    echo $message;
}

include('includes/footer.php');
?>