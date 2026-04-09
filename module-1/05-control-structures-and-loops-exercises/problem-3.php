<?php
$title = "Old Norse Calendar";
include('includes/header.php');

/* 

Write a program that checks the day of the week and, based upon a switch statement, 
prints a message telling the user what day it would be in the Old Norse calendar.

*/

/* 

Dates and times are a common thing to keep track of in any application or database.
In PHP, whenever we request the date or time, we're asking the server for that information
(based upon the server's timezone).

If we want an answer in another timezone, we need to specify which one.

This argument (a lowercase L, not a 1) requests the longform version of the 
name of the day of the week (ex. Monday).
 
 */

date_default_timezone_set("America/Edmonton");
$day = date("l"); 

echo "<p>Today is $day.</p>";

echo "<p>In the Old Norse calendar, today was named ";

switch($day) {
    case "Monday":
        echo "Moon's Day (Mánadagr), after the god Máni.</p>";
        break;
    case "Tuesday":
        echo "Tyr's Day (Týsdagr), after the god Tyr.</p>";
        break;
    case "Wednesday":
        echo "Odin's Day (Óðinsdagr), after the god Odin.</p>";
        break;
    case "Thursday":
        echo "Thor's Day (Þórsdagr), after the god Thor.</p>";
        break;
    case "Friday":
        echo "Freyja's Day (Freyjudagr), after the goddess Freyja.</p>";
        break;
    case "Saturday":
        echo "Saturn's Day (Laugardagr), after the planet Saturn.</p>";
        break;
    case "Sunday":
        echo "Sun's Day (Sunnudagr), after the goddess Sunna.</p>";
        break;
    default:
        echo "... actually, I'm not sure what day it is!</p>";
}

include('includes/footer.php'); 

?>