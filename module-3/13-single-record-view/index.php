<?php

$title = "Home";
include('includes/header.php');

?>

<h2 class="display-5 my-3">Welcome to the Happy Planet Index</h2>
<p class="lead mb-5">The Happy Planet Index is a measure of sustainable wellbeing, ranking countries by how efficiently they deliver long, happy lives using our limited environmental resources.</p>

<?php

// Summer 2025 Note: This Docker container uses the latest version of MySQL. It's real touchy when it comes to putting backticks around column names. Sometimes it needs them, sometimes it doesn't care.
$sql = "SELECT `rank`, `country` FROM happiness_index;";
$result = $connection->query($sql);

if ($connection->error): ?>

    <!-- If there's an issue, we'll display an error message to the user. -->
    <p>Oh no! There was an issue retrieving the data.</p>

<?php elseif ($result->num_rows > 0): ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">HPI Rank</th>
                <th scope="col">Country Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php

            while ($row = $result->fetch_assoc()) {
                extract($row);

                echo "<tr> \n
                    <td>$rank</td> \n
                    <td>$country</td> \n
                    <td><a href=\"country.php?rank=" . urlencode($rank) . "&country=" . urlencode($country) . "\" class=\"link-success\">View Stats</a></td> \n
                    </tr> \n ";
            }

            ?>
        </tbody>
    </table>
<?php endif;

include('includes/footer.php'); ?>