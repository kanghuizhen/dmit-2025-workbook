<?php
require_once '../private/authentication.php';

require_login();

$title = 'Private Home Page';

$introduction = 'This page is accessible to logged in users only. If you are here, you were successful in logging in.';

include 'includes/header.php'; ?>
<a href="insert.php">Insert</a>
<?php 
include 'includes/footer.php';
?>