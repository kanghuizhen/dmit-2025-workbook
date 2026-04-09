<?php


function can_you_enter($user_date)
{
    $converted_user_date = strtotime($user_date);
    $converted_today = strtotime(date("Y-m-d"));
    $seconds_in_a_year = 60 * 60 * 24 * 365;
    $number_of_years = abs($converted_today - $converted_user_date) / $seconds_in_a_year;
    $no_decimal = floor($number_of_years);
    $age_of_majority = 18;
    $result = "";
    if ($no_decimal >= $age_of_majority) {
        $result = "You can enter since you are an adult.";
    } else {
        $result =  "You are a baby you can not enter.";
    }
    return $result;
}
// $user_date = "2002-04-22";
// $converted_user_date = strtotime($user_date);
// $today = date('Y-m-d');
// $converted_today = strtotime($today);
// $defference = abs($converted_today - $converted_user_date);

$user_date = "2002-04-22";
$result = can_you_enter($user_date);

echo $result;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>