<?php

$message = $message ?? "";

$title = $_POST['title'] ?? "";
$description = $_POST['description'] ?? "";

if (isset($title, $description, $_FILES['file'])) :
    $filename = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    // var_dump($_FILES['file']);
    // error 0 means no errors so proceed
    if ($_FILES['file']['error'] === 0) :
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed_extensions = array("avif", "jpg", "jpeg", "png", "webp");

        if (in_array($file_extension, $allowed_extensions)) :
            // check size
            if ($size < 2048000) :
                $new_filename = uniqid('', TRUE) . ".$file_extension";
                $destination = "images/full/$new_filename";

                if (!is_dir('images/full/')) :
                    mkdir('images/full/', 0777,TRUE);
                endif;

                if (!is_dir('images/thumb/')) :
                    mkdir('images/thumb/', 0777,TRUE);
                endif;

                move_uploaded_file($temp_name, $destination);

                switch ($file_extension) {
                    case 'avif':
                        $src_image = imagecreatefromavif($destination);
                        break;
                    case 'jpg':
                    case 'jpeg' :
                        $src_image = imagecreatefromjpeg($destination);
                        break;
                    case 'png' :
                        $src_image = imagecreatefrompng($destination);
                        break;
                    case 'webp':
                        $src_image = imagecreatefromwebp($destination);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, WEBP, or PNG");
                        break;
                }

                list($original_width, $original_height) = getimagesize($destination);

                if ($original_width > $original_height) :
                    // landscape
                    $target_width = 1280;
                    $target_height = 720;
                elseif ($original_height > $original_width) :
                    // portrait
                    $target_width = 720;
                    $target_height = 1280;
                else :
                    $target_height = $target_width = 720;
                endif;

                $scale_x = $target_width / $original_width;
                $scale_y = $target_height / $original_height;
                $scale = max($scale_x, $scale_y);

                $new_width = ceil($original_width * $scale);
                $new_height = ceil($original_height * $scale);

                $temp_image = imagecreatetruecolor($new_width, $new_height);

                imagecopyresampled($temp_image, $src_image, 0,0,0,0,$new_width, $new_height, $original_width, $original_height);

                $x_offset = ($new_width - $target_width) / 2;
                $y_offset = ($new_height - $target_height) / 2;

                $final_image = imagecreatetruecolor($target_width, $target_height);

                imagecopy($final_image, $temp_image, 0, 0, $x_offset, $y_offset, $target_width, $target_height);

                switch ($file_extension) {
                    case 'avif':
                        imageavif($final_image, $destination);
                        break;
                    case 'jpg':
                    case 'jpeg' :
                        imagejpeg($final_image, $destination);
                        break;
                    case 'png' :
                        imagepng($final_image, $destination);
                        break;
                    case 'webp':
                        imagewebp($final_image, $destination);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, WEBP, or PNG");
                        break;
                }

                // thumbnail sizing
                $thumb_size = 512;
                $thumb_img = imagecreatetruecolor($thumb_size, $thumb_size);

                $smaller_size = min($original_width, $original_height);

                $src_x = ($original_width - $smaller_size) / 2;
                $src_y = ($original_height - $smaller_size) / 2;

                imagecopyresampled($thumb_img, $src_image, 0,0, $src_x, $src_y, $thumb_size, $thumb_size, $smaller_size, $smaller_size);

                $thumb_path = 'images/thumb/'.$new_filename;

                switch ($file_extension) {
                    case 'avif':
                        imageavif($thumb_img, $thumb_path);
                        break;
                    case 'jpg':
                    case 'jpeg' :
                        imagejpeg($thumb_img, $thumb_path);
                        break;
                    case 'png' :
                        imagepng($thumb_img, $thumb_path);
                        break;
                    case 'webp':
                        imagewebp($thumb_img, $thumb_path);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, WEBP, or PNG");
                        break;
                }

                // now to enter into the database
                $sql = "INSERT INTO gallery_prep (title, description, filename, uploaded_on) VALUES (?,?,?, NOW())";

                $statement = $connection->prepare($sql);
                $statement->bind_param("sss", $title, $description, $new_filename);
                $statement->execute();

                $message = 'Your image was successfully uploaded.';
                $title = $description = "";

            else: 
                $message = 'There is a limit of 2Mb on file uploads.';

            endif; // end of size
        else :
            $message = 'Only avif, jpg, jpeg, png and webp files are allowed';
        endif; // end of in array
    else:
        $message = 'There was an error with your file. Please make sure it is not corrupt and try again.';
    endif;
else:
    $message = "Please choose an image file before submitting";
endif;

?>