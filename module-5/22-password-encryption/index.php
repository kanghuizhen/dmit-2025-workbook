<?

$first_password = $_POST['first-password'] ?? '';
$second_password = $_POST['second-password'] ?? '';
$is_match = NULL;

if (isset($_POST['submit'])) :

    $first_hash = password_hash($first_password, PASSWORD_DEFAULT);
    $second_hash = password_hash($second_password, PASSWORD_DEFAULT); 

    $is_match = password_verify($second_password, $first_hash);
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hashing Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="border border-secondary rounded p-3">
        <?php if (!is_null($is_match)) : ?>
            <div class="my-3 text-center">
                <p class="fs-4">When compared, PHP determined that <?php echo $is_match ? 'yes, these passwords match!' : 'no, these password do not match';  ?></p>
            </div>

        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label" for="first-password">First Password</label>
            <input type="text" name="first-password" id="first-password">
            <?php if ($first_password  != "") : ?>
                <p class="form-text">For the first password, you entered <b><?= $first_password; ?></b></p>
                <p class="form-text">When encrypted, it produced the follow hash <b><?= $first_hash; ?></b></p>
             <?php endif; ?>

        </div>
        <div class="mb-3">
            <label class="form-label" for="second-password">Second Password</label>
            <input type="text" name="second-password" id="second-password">

            <?php if ($second_password  != "") : ?>
                <p class="form-text">For the first password, you entered <b><?= $second_password; ?></b></p>
                <p class="form-text">When encrypted, it produced the follow hash <b><?= $second_hash; ?></b></p>
             <?php endif; ?>
        </div>
        <input type="submit" value="Hash & Compare" name="submit" class="btn btn-primary">
    </form>
</body>
</html>