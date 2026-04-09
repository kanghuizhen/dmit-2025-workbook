<?php
require_once '../private/authentication.php';

require_login();

$title = 'Private Insert Page';

$introduction = 'This page is accessible to logged in users only. If you are here, you were successful in logging in and have access to insert a record.';

include 'includes/header.php';

echo "<p>Add a form here</p>";

include 'includes/footer.php';

?>