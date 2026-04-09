<?php

$sql = "SELECT * FROM happiness_index WHERE 1=1";
$types = ""; // This is a string for the data types, in order of their appearance in the query.
$parameters = []; // This holds all of the ?s we need for our prepared statement. We're using an array so that we can use array-based methods.

foreach ($active_filters as $filter => $filter_values) {
    
    // Queries that use a range (i.e. looks for something BETWEEN two values) are handled differently than the condition to look at specific continents. We'll store all of them in their own little array. Again, we're using arrays so that we can use array methods and do not accidentally overwrite anything (things will automatically be appended to the end of the array as we loop through the values). 

    $range_queries = [];

    if (in_array($filter, ["life_expectancy", "wellbeing", "eco_footprint"])) {
        foreach ($filter_values as $value) {
            // We're going to use a regular expression here to make sure we're looking for something in the following format: 50-60

            // Although we originally wrote these values this way ourselves, we are using the $_GET method, which can be tampered with by the user. 
            if (!preg_match('/^\d+(\.\d+)?-\d+(\.\d+)?$/', $value)) {
                continue;
            }

            // This makes a list (a type of array) out of our range. It parses everything before the hyphen and after the hyphen to create a $min and $max value.
            list($min, $max) = explode("-", $value, 2);
            
            $range_queries[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (!empty($range_queries)) {
            $sql .= " AND (" . implode(" OR ", $range_queries) . ")";
        }
    } elseif (array_key_exists($filter, $filters)) {
        $placeholders = str_repeat("?,", count($filter_values) - 1) . "?";
        $sql .= " AND $filter IN ($placeholders)";
        $types .= str_repeat("s", count($filter_values));
        $parameters = array_merge($parameters, $filter_values);
    }
}

// When the user intially loads the page, we don't want to show them any results. We're only going to run a query if the user has selected a filter (i.e. has anything in the $active_filters array).
if (!empty($active_filters)) {
    $statement = $connection->prepare($sql);
if ($statement === false) {
    echo "<p>Error retrieving data. Please try again later.</p>";
    exit();
}

$statement->bind_param($types, ...$parameters);
if (!$statement->execute()) {
    error_log("SQL Execution Error: " . $statement->error);
    echo "<p>Error retrieving data. Please try again later.</p>";
    exit();
}

$result = $statement->get_result();

echo '<h2 class="display-4 mt-5 mb-3">Results</h2>';

// Now, let's generate our cards.

if ($result->num_rows > 0) {
    // If we find anything, we'll let the user know with a message. 
    echo '<p class="mb-5">Here\'s what we were able to find:</p>';
    echo '<div class="row">';

    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"col-md-6 col-xl-4 mb-4\">";
        include('includes/country-card.php');
        echo "</div>";
    }

    echo '</div>'; // Close the row
} else {
    echo "<p class=\"mb-5\">We weren't able to find anything matching your selected filters.</p>";
}

$statement->close();

}

?>
