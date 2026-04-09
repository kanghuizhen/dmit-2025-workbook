<?php

/* 
   We're initialising our variables first to avoid any error messages. Here, we're using the ternary operator.

   $var_name = (Condition) ? (Statement1) : (Statement2);

   If the user has submitted something, we'll try to get data from the form; otherwise, the variable will be initialised as blank.

   The message will always begin blank and then, if there's an error, be assigned an error message.
*/

// Account Creation
$name = (isset($_POST['name'])) ? trim($_POST['name']) : "";
$email = (isset($_POST['email'])) ? trim($_POST['email']) : "";
$phone = (isset($_POST['tel'])) ? trim($_POST['tel']) : "";
$dob = (isset($_POST['dob'])) ? $_POST['dob'] : "";
$password = (isset($_POST['password'])) ? trim($_POST['password']) : "";
$password_check = (isset($_POST['password-check'])) ? trim($_POST['password-check']) : "";

// Qualifications
$experience = (isset($_POST['experience'])) ? trim($_POST['experience']) : "";
$region = $_POST['region'] ?? '';
$department = (isset($_POST['department'])) ? $_POST['department'] : "";
$training = isset($_POST['training']) ? $_POST['training'] : [];
$loyalty = (isset($_POST['loyalty'])) ? $_POST['loyalty'] : "";
$referral = isset($_POST['referral']) ? $_POST['referral'] : "";

// Long Answer Question
$evil_plan = (isset($_POST['evil-plan'])) ? trim($_POST['evil-plan']) : "";

// We'll initialise our messages now, too. We'll have a unique message for each input. 
$message_name = "";
$message_email = "";
$message_phone = "";
$message_password = "";
$message_password_check = "";
$message_dob = "";

$message_experience = "";
$message_region = '';
$message_department = "";
$message_training = "";
$message_loyalty = "";
$message_referral = "";

$message_evil_plan = "";

// This boolean will keep track of our validation process. It will initially be FALSE; however, when the user submits the form, it will flip to TRUE.
$form_good = (isset($_POST['submit'])) ? TRUE : FALSE;
// If the user does not pass validation in any category, it will go right back to FALSE and they will not be redirected to the thank-you page. 

if (isset($_POST['submit'])) {

    /*  
        VALIDATION FOR FULL NAME

        Generally, we should always start validation with a presence check (i.e. did the user fill out this field?).

        For a full name, we'll also make sure that the user gave us letter and that there's a space somewhere in there (First Last).
    */

    if (is_blank($name)) {
        $message_name = "<p class=\"text-warning\">Please enter your name.</p>";
    } elseif (!is_letters($name)) {
        $message_name .= "<p class=\"text-warning\">Your name can only contain letters and spaces.</p>";
    } elseif (no_spaces($name)) {
        $message_name .= "<p class=\"text-warning\">Please enter both your first and last name.</p>";
    } elseif ($name == FALSE) {
        $message_name .= "<p class=\"text-warning\">Please enter a valid name.</p>";
    }

    if ($message_name != "") {
        $form_good = FALSE;
    }

    // Validation for Email

    /* 
        One approach to validating email might be loading up an array and comparing it against all of the possible top-level domains our user could possibly use; however, the list of legal top-level domains is massive (and ever-expanding)!

        http://data.iana.org/TLD/tlds-alpha-by-domain.txt
        
        Instead of spending all week typing these out, we'll use some built-in PHP functions. 

        filter_var() validates and sanitises our data. 
                
        filter_var(var, filtername, options)

        var : The variable you want to filter.

        filtername : It is used to specify the ID or name of the filter to use. Default is FILTER_DEFAULT, which results in no filtering. You can use _STRING, _URL, _EMAIL, _IP, _INT …

        options : It is used to specify one or more flags/options to use. Check each filter for possible options and flags. It is also optional field.
    */

    if (is_blank($email)) {
        $message_email = "<p class='text-warning'>Please enter your email address.</p>";
    }
    // We can't use is_letters() here because we need more than letters!
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_email .= "<p class='text-warning'>Please enter a valid email address.</p>";
    }
    // This achieves the same thing as above. 
    elseif (!has_valid_email_format($email)) {
        $message_email .= "<p class='text-warning'>Please enter a valid email address.</p>";
    }

    if ($message_email != "") {
        $form_good = FALSE;
    }

    /* 
        PHONE NUMBERS

        Phone numbers can come in a tonne of different formats!
        
        ex. +1 (780) 123 4567
            1 780 123 4567
            780.123.4567
            (780) 123-4567
            7801234567
        
        ... and on, and on! And do we really want to reject and frustrate our user over and over again if they use a different format?
        
        FILTER_SANITIZE_NUMBER_INT should get rid of any '.' characters, so let's keep going and strip away any other unecessary syntax. 
    */

    $phone = valid_phone_format($phone);

    if (is_blank($phone)) {
        $message_phone = "<p class='text-warning'>Please enter your phone number.</p>";
    } elseif (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $message_phone .= "<p class='text-warning'>Please enter a valid phone number, using numbers only.</p>";
    } elseif (!is_numeric($phone)) {
        $message_phone .= "<p class='text-warning'>Please enter a valid phone number, using numbers only.</p>";
    } elseif (!has_length_exactly($phone, 10)) {
        $message_phone .= "<p class='text-warning'>Please enter a 10 digit phone number.</p>";
    }

    if ($message_phone != "") {
        $form_good = FALSE;
    }

    /*
        DATES & DATE OF BIRTH

        We can check to see if a provided value is a date by creating a DateTime object from it. This is because it ensures the provided value is both:

        1. properly formatted (matches Y-m-d)
        2. a valid calendar date (e.g., it prevents 2024-02-30 from being accepted)

        Q: Why not just use strtotime()?

        While strtotime($dob) can convert a string into a timestamp, it silently fixes invalid dates instead of rejecting them.
    */

    if (!empty($dob)) {
        // Here, we'll attempt to create a DateTime object from the user input.
        $dob_object = DateTime::createFromFormat('Y-m-d', $dob);

        // We'll check to see if we were able to do that and that it follows our provided format.
        if ($dob_object && $dob_object->format('Y-m-d') === $dob) {
            // If the date is valid, we'll check the user's age by comparing today's date and time to their birthday.
            $today = new DateTime();
            $minimum_age = $today->modify('-18 years');

            if ($dob_object > $minimum_age) {
                $message_dob = "<p class='text-warning'>You must be at least 18 years old to apply.</p>";
            }
        } else {
            $message_dob .= "<p class='text-warning'>Please enter a valid date.</p>";
        }
    } else {
        $message_dob .= "<p class='text-warning'>Your date of birth is required.</p>";
    }

    if ($message_dob != "") {
        $form_good = FALSE;
    }


    /*
        PASSWORDS

        If we tell the user that we want certain things within a password (ex. minimum length, a special character, an uppercase letter, a lowercase letter, and a number), we should compare their input to a suitable regular expression (RegEx). 

        We could check all of this at once with a monstrously long Regular Expression, but if we do it piece-by-piece, we can give the user more explicit feedback on what they're missing. 
    */

    if (is_blank($password)) {
        $message_password = "<p class='text-warning'>Please provide a password.</p>";
    } elseif (strlen($password) < 8) {
        $message_password = "<p class='text-warning'>Password must be at least 8 characters long.</p>";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $message_password = "<p class='text-warning'>Password must include at least one uppercase letter.</p>";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $message_password = "<p class='text-warning'>Password must include at least one lowercase letter.</p>";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $message_password = "<p class='text-warning'>Password must include at least one number.</p>";
    } elseif (!preg_match('/[\W_]/', $password)) { // Checks for special characters
        $message_password = "<p class='text-warning'>Password must include at least one special character (!@#$%^&*).</p>";
    }

    if ($message_password != "") {
        $form_good = FALSE;
    }

    /* 
        PASSWORD COMPARISON

        This is relatively straightforward. Here, we want to see if the value that the user typed in the first field matches (or is equal to) whatever they typed in the second field.
    */

    if ($password != $password_check) {
        $message_password_check = "<p>This password does not match the response above. Please try typing your password again.</p>";
        $form_good = FALSE;
    }

    /*
        NUMBERS

        For this particular field, we want to make sure:

        1. It's a number
        2. It's a whole number (integer)
        3. It's within a reasonable range (0-60 years)

        The method ctype_digit() makes sure that a value is numerical and a whole number. If there is a comma (for formatting) or a period (for a floating point, or decimal), it will return FALSE.
    */

    if ($experience == "") {
        $message_experience = "<p class='text-warning'>This field is required. Please enter a  whole number.</p>";
    } elseif (!is_numeric($experience)) {
        $message_experience .= "<p class='text-warning'>Please enter a number.</p>";
    } elseif (!ctype_digit($experience)) {
        $message_experience .= "<p class='text-warning'>Please enter a valid whole number.</p>";
    } elseif ($experience < 0 || $experience > 60) {
        $message_experience .= "<p class='text-warning'>Experience must be between 0 and 60 years.</p>";
    }

    if ($message_experience != "") {
        $form_good = FALSE;
    }

    /*
        DATA LISTS

        For our "Preferred Global Region for Assignments", we're going to:

        1. Make sure that the user typed something (presence check).
        2. Make sure their answer isn't too long.
        3. Ensure it only contains valid characters (letters, numbers, spaces, and a few punctuation marks).
        
        This will help us avoid unexpected formatting issues or suspicious content while still giving our henchpeople creative freedom.

        If we wanted to *strictly limit* answers to a predefined list of values, we would use a <select> element instead.

    */

    // Optional: Accept blank input if it's not required
    if (trim($region) === '') {
        $message_region = "<p class='text-warning'>Please enter your preferred region for assignments.</p>";
    } elseif (strlen($region) > 100) {
        $message_region = "<p class='text-warning'>That region name is a bit too long—try something shorter.</p>";
    } elseif (!preg_match("/^[a-zA-Z0-9 .,'()&\-\/]+$/", $region)) {
        $message_region = "<p class='text-warning'>Region name contains invalid characters.</p>";
    }

    /*
        RADIO BUTTONS

        If we give the user radio buttons, checkboxes, a dropdown option (select element), or a range slider, all of the values should be good. 

        However, a bad actor may alter the values of these form controls before submission (or, if we're using the $_GET method, they might change things in the query string). We should still check to see if the value are what we're expecting before accepting it. 

        After our presence check, we're going to see if the value the user submitted is an allowed value.
    */

    // This is a list of all of our allowed values. 
    $valid_departments = ['traps', 'doomsday', 'monologue', 'it'];

    if (is_blank($department)) {
        $message_department = "<p class='text-warning'>Please select a department.</p>";
    } elseif (!in_array($department, $valid_departments)) {
        $message_department = "<p class='text-warning'>Invalid department selection.</p>";
    }

    if ($message_department != "") {
        $form_good = FALSE;
    }

    /*
        CHECKBOXES

        Checkboxes work largely in the same way that radio buttons do, with one key difference: instead of submitting a single value, a user may submit multiple. This means that any time we use checkboxes, we're creating an array. 

        To validate, we will be comparing each item inside of the array of submitted values against our list of allowed values. This means we need to have our needle/haystack search inside of a foreach loop.

        However, we'll throw yet another spanner into the works: this part of the form is optional. This means that if the user hasn't selected anything, they will not fail validation. 
    */

    $valid_training = ['lava', 'sharks', 'lifting', 'buttons', 'hostages', 'evacuation', 'retention'];

    if (!empty($training)) {
        // If the user chose something, we'll go ahead and validate.
        foreach ($training as $value) {
            if (!in_array($value, $valid_training)) {
                $message_training = "<p class='text-warning'>Your value is not allowed. As delightfully evil as that is, please select an answer from the list.</p>";
                $form_good = FALSE;
                break;
            }
        }
    }

    /*
        RANGE SLIDER

        A range slider can be very useful for things like surveys, reviews, or anything that might require a Likert Scale. 

        However, by default, the user will have no idea what value they've chosen. This is why we added a splash of JavaScript in our code.

        For this particular range, we're looking for any integer between 1-10 (which means our validation will be very similar to the number above).
    */

    if ($loyalty === "" || !is_numeric($loyalty) || $loyalty < 0 || $loyalty > 10) {
        $message_loyalty = "<p class='text-warning'>Please choose a whole number between 0 and 10.</p>";
        $form_good = FALSE;
    }

    /*
        DROPDOWN (<select> Element)

        This is functionally the same as radio buttons. We are looking to see if:

            1. The user chose an option.
            2. The value they submitted is in our list of allowed values.
    */

    $valid_referrals = ['classified-ad', 'social-media', 'word-of-mouth', 'mixer', 'kidnapping', 'family', 'announcement'];

    if ($referral === "") {
        $message_referral = "<p class='text-warning'>Please select a referral source.</p>";
    } elseif (!in_array($referral, $valid_referrals)) {
        $message_referral = "<p class='text-warning'>Invalid referral source.</p>";
    }

    if ($message_referral != "") {
        $form_good = FALSE;
    }

    // Evil Plan
    if (is_blank($evil_plan)) {
        $message_evil_plan = "<p class='text-warning'>Please write an evil plan.</p>";
    }
    // This strips out characters with an ASCII value below 32, which include things like system I/O. 
    elseif (!filter_var($evil_plan, FILTER_SANITIZE_SPECIAL_CHARS)) {
        $message_evil_plan .= "<p class='text-warning'>As delightfully diabolical as that was, please write another plan.</p>";
    } elseif (strlen($evil_plan) < 255) {
        $message_evil_plan = "<p class='text-warning'>Your plan must be 255 characters or fewer.</p>";
    }

    if ($message_evil_plan != "") {
        $form_good = FALSE;
    }
} // end of if submitted

// If the user input passes all of our validation, we'll reward the user with a success message to let them know that everything went through. At this point, we may also want to blank-out / reset our variables so that they can't submit the form multiple times. 

if ($form_good == TRUE) {
    header("Location: thank-you.php");
}
