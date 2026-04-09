<?php
session_start();

if (isset($_POST['form-submit']) && isset($_POST['username'])) :
    $_SESSION['username'] = $_POST['username'];
endif;

if (isset($_POST['forget'])) :
    forget_me();
endif;

function forget_me() {
    session_unset();
    session_destroy();
    header("Refresh:0");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello 
        <?php 
        if (isset($_SESSION['username'])) :
            echo $_SESSION['username'];
        else :
            echo "friend";
        endif;
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-secondary">
    <main class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        <section class="row">
            <div class="col bg-white p-5 rounded">
                <?php if (!isset($_SESSION['username'])) : ?>
                    <!-- form will show when not logged in -->
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <h1 class="h3 mb-3 fw-normal">This could be the start of something wonderful!</h1>
                    <div class="my-5">
                        <label for="username" class="form-label">What's your name?</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Jack Pott" required>
                    </div>
                    <div>
                        <input type="submit" value="Let's do it!" name="form-submit" class="btn btn-primary">
                    </div>
                    </form>
                <?php else : ?>
                    <h1 class="h3 mb-3 fw-normal">Hello <?= $_SESSION['username']; ?> </h1>
                    <p class="text-muted lead">It's good to see you.</p>

                    <p>It is currently <?= date('l') ?> at <?= date('h:i:sa') ?></p>

                    <?php 
                    if (isset($_SESSION['last-time'])) :
                        echo "<p>The last time we saw each other was " . $_SESSION['last-time'] ."</p>";
                    else: 
                        $_SESSION['last-time'] = date("Y/m/d h:i:sa");
                    endif; ?>

                    <!-- log out button -->
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <input type="submit" value="Forget me" name="forget" class="btn btn-danger mt-5">
                    </form>


                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>