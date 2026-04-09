<?php

include 'includes/header.php';

$sql = "SELECT * FROM gallery_prep ORDER BY uploaded_on DESC";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) :
    echo "<section class='row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4'>";
        while ($row = mysqli_fetch_assoc($result)) :
            $id = $row['image_id'];
            $title = $row['title'];
            $description = $row['description'];
            $filename = $row['filename'];
            $uploaded_on = $row['uploaded_on'];
            ?>
            <div class="col">
                <div class="card p-0 shadow-sm">
                    <img class="card-img-top" src="images/thumb/<?= $filename ?>" alt="<?= $description ?>">
                    <div class="card-body">
                        <h2 class="fs-5"><?= $title; ?></h2>
                        <p class="card-text">Added on: <?= $uploaded_on; ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?= $id; ?>">View</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-<?= $id; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title display-6"><?= $title; ?></h3>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <img class="card-img-top" src="images/full/<?= $filename ?>" alt="<?= $description ?>">
                            </div>
                            <p class="mt-4"><?= $description; ?></p>
                            <p>Added on <?= $uploaded_on; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


    <?php  endwhile;

    echo "</section>";
else :
    echo '<h2>Oops</h2>';
    echo '<p>We weren\'t able to find any images in our gallery. Go add some.</p>';

endif;



?>



<?php
include 'includes/footer.php';
?>