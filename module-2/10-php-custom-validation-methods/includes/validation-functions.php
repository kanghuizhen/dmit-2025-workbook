<?php 

/**
 * This file contains a collection of reusable validation helper functions.
 *
 * BLANKS / PRESENCE: Check whether or not a value is set or exists.
 * EXCLUSION / INCLUSIONS: Verify that a value is among a set of allowed values.
 * DATA TYPE: EMAIL: Validate email formatting.
 * DATA TYPE: PHONE NUMBER: Normalize phone inputs by stripping syntax.
 * DATA TYPE: STRINGS: Validate string length and character constraints.
 */


/**
 * Determines if a value is blank (unset or empty after trimming whitespace).
 * Uses === to avoid false positives (unlike empty() which treats "0" as blank).
 * Note: trim() only works on strings.
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is not set or is an empty string after trim().
 */
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

/* 
    EXCLUSION / INCLUSIONS
*/

/**
 * Checks if a given value exists in a set of allowed values.
 * Useful for validating dropdowns, radio buttons, or any discrete list.
 *
 * @param mixed $value The value to test.
 * @param array $set   An array of allowed values.
 * @return bool True if $value is found in $set; false otherwise.
 */
function has_allowed_value($value, $set) {
    return in_array($value, $set);
}

/*
    DATA TYPE: EMAIL
*/

/**
 * Validates that a string matches a basic email format.
 * Note: filter_var() with FILTER_VALIDATE_EMAIL is often sufficient as an alternative.
 *
 * @param string $value The email address to validate.
 * @return bool True if $value matches the email regex; false otherwise.
 */
function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9._]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

/* 
    DATA TYPE: PHONE NUBER
*/

/**
 * Normalizes a phone number string by stripping out common formatting characters.
 * Removes: +, -, ., (, ), and spaces.
 *
 * @param string $value The raw phone number input.
 * @return string The cleaned numeric phone string.
 */
function valid_phone_format($value) {
    // We want to remove: + - . ( )
    $value = str_replace("+", "", $value);
    $value = str_replace("-", "", $value);
    $value = str_replace(".", "", $value);
    $value = str_replace("(", "", $value);
    $value = str_replace(")", "", $value);
    $value = str_replace(" ", "", $value);

    return $value;
}

/* 
    DATA TYPE: STRINGS
*/


/**
 * Checks if the length of a string is less than a maximum value.
 *
 * @param string $value The string to measure.
 * @param int    $max   The maximum length allowed.
 * @return bool True if length($value) < $max; false otherwise.
 */
function has_length_less_than($value, $max) {
  $length = strlen($value);
  return $length < $max;
}

/**
 * Validates that a string contains only letters (a-z, case-insensitive) and spaces.
 *
 * @param string $value The string to check.
 * @return bool True if $value contains only letters and spaces; false otherwise.
 */
function is_letters($value) {
  return preg_match("/^[a-zA-Z\s]*$/", $value);
}

/**
 * Determines whether a string contains no space characters.
 *
 * @param string $value The string to inspect.
 * @return bool True if no spaces are found; false otherwise.
 */
function no_spaces($value) {
  return strpos($value, " ") == FALSE;
}

/**
 * Validates that a string has exactly the specified length.
 *
 * @param string $value           The value to check.
 * @param int    $required_length The exact length required.
 * @return bool  True if $value is exactly $required_length characters long.
 */
function has_length_exactly(string $value, int $required_length): bool {
    return strlen($value) === $required_length;
}

?>