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
 * @param int $per_page - the number of records we want on each page.
 * @param int $offset - how far into the table we need to start grabbing things.
 * @return bool|mysqli_result - the records retrieved for the page.
 */
function find_records($per_page = 12, $offset = 0) {
    global $connection;

    /*
        We could use the following code for programmatic MySQLi:

            $sql = "SELECT rank, country FROM happiness_index";

            if ($limit > 0) {
                $sql .= " LIMIT " . $limit;
            }
            if ($offset > 0) {
                $sql .= " OFFSET " . $offset;
            }
            return $connection->query($sql);

        ... but this is super dangerous because $limit and $offset are values in our query string.
        
        Instead, we'll need write this as a prepared statement with one of two possibilities:

            1. There is a limit, but no offset (ex. page 1)
            2. There is both a limit and an offset
    */

    $sql = "SELECT `rank`, `country` FROM happiness_index LIMIT ?"; // Make sure you don't terminate this statement!

    if ($offset > 0) {
        // If there is an offset, we'll add it too.
        $sql .= " OFFSET ?;";

        // In this case, we have two parameters (both integers).
        $statement = $connection->prepare($sql);
        $statement->bind_param("ii", $per_page, $offset);
    } else {
        // If there is no offset, we have just one parameter (the limit).
        $statement = $connection->prepare($sql);
        $statement->bind_param("i", $per_page);
    }

    $statement->execute();
    return $statement->get_result();
}

?>
