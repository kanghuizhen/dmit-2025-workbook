<?php
/**
 * This counts the number of records we currently have in our table (in case any have been added or removed).
 */
function count_records()
{
    global $connection;
    $sql = "SELECT COUNT(*) FROM happiness_index;";
    $results = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_row($results);
    return $fetch[0];
}

/**
 * This function lets us grab only the records we need for one page of paginated results.
 * @param int $limit
 * @param int $offset
 * @return bool|mysqli_result
 */
function find_records($limit = 0, $offset = 0)
{
    global $connection;

    $sql = "SELECT `rank`, `country` FROM happiness_index";  // Make sure you don't terminate this statement!

    if ($limit > 0) {
        // If there is a limit, we'll tack this onto the end of our SQL statement. 
        $sql .= " LIMIT ?";

        if ($offset > 0) {
            // If there is an offset, we'll add it too.
            $sql .= " OFFSET ?";

            // In this case, we have two parameters (both integers).
            $statement = $connection->prepare($sql);
            $statement->bind_param("ii", $limit, $offset);
        } else {
            // If there is no offset, we just have one parameter (the limit).
            $statement = $connection->prepare($sql);
            $statement->bind_param("i", $limit);   
        }
    }

    $statement->execute();
    return $statement->get_result();
}

?>