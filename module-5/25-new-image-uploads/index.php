<!-- 

PROGRAM SPECS & FLOW: We're going to create a small website that has just two pages:

1. index.php: this is where the user will be given a form that prompts them to upload an image, along with a title and description. When the user submits the form, it will create two versions of the image (a 256x256 square thumbnail that retains the original aspect ratio and a 720p full version of the image).

2. gallery.php: this will fetch the thumbnails for each image and allow the user to view a larger version of each.

Our project directory will look like this:

/22-image-uploads
    /images
        /full
        /thumbs
    index.php
    gallery.php
    upload.php

... but the images/ folder and everything inside will only exist on the server.

We will also need a table (see `init.sql`) in order to store some metadata for each image.

 -->

 <?php
 $page_title = 'Upload Image Files';

 include 'includes/header.php';

 include 'includes/upload.php';
 ?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= $title; ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" id="description" name="description" class="form-control" value="<?= $description; ?>">
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">file</label>
        <input type="file" id="file" name="file" class="form-control" accept=".png, .jpg, .jpeg, .webp, .avif">
        <p class="form-text">The following file types are accepted: AVIF, JPG, JPEG, PNG, WEBP</p>
    </div>
    <input type="submit" value="Upload Image" class="btn btn-primary" name="submit">
</form>

<?php

 include 'includes/footer.php';

 ?>