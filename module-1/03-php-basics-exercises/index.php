<!-- You can begin today by copying and pasting the index from 02-php-basics and repurposing the body; however, this is a very clunky way of writing PHP because we need to sort out so much of the same HTML before we can actually address our problem. The bottom of today's README.md goes into how to use includes. -->

<?php
  // Here, we're bringing in our header. Because this file uses a variable called $title, we need to define this variable before including the file.
  $title = "Table of Contents";
  include('includes/header.php');
?>

            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="problem-1.php" class="nav-link">Problem 1</a>
                </li>
                <li class="nav-item">
                    <a href="problem-2.php" class="nav-link">Problem 2</a>
                </li>
                <li class="nav-item">
                    <a href="problem-3.php" class="nav-link">Problem 3</a>
                </li>
            </ul>

<?php
  include('includes/footer.php');
?>