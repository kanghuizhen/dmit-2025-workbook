<?php
require_once dirname(__DIR__, 2) . '/data/connect.php';
$conn = db_connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <section>
        <h2>First 5 cities</h2>
        <!-- SELECT city_name, province FROM cities LIMIT 5; -->

        <?php
        $sql = "SELECT city_name, province FROM cities LIMIT 5";

        $result = mysqli_query($conn, $sql);

        // var_dump($result);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // var_dump($row);
                $city_name = $row['city_name'];
                $province = $row["province"];

                echo "<p>$city_name, $province</p>";
            }
        }
        ?>
    </section>

    <section>
        <h2>Alberta Cities</h2>
        <!-- SELECT city_name from cities where province = 'ab'; -->

        <?php
        $ab_cities_sql = "SELECT city_name from cities where province = 'ab'";
        $ab_cities_result = mysqli_query($conn, $ab_cities_sql);

        if (mysqli_num_rows($ab_cities_result) > 0) {
            echo "<ol>";
            while ($ab_cities_row = mysqli_fetch_assoc($ab_cities_result)) {
                echo "<li>";
                echo $ab_cities_row['city_name'];
                echo "</li>";
            }
            echo "</ol>";
        } else {
            echo "<p>Unable to find cities in Alberta</p>";
        }
        ?>
    </section>
    <section>
        <h2> The smallest city.</h2>
        <?php

        ?>
    </section>
</body>

</html>