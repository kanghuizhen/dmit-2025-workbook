<?php
require_once '../private/authentication.php';
// if you are already logged in then send to admin page
if (is_logged_in()) :
    header("Location:admin.php");
endif;

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (authenticate($username, $password)) :
         header("Location:admin.php");
    else: 
        $error = "Invalid username or password";
    endif;
}

$title = 'Login Page';

$introduction = 'Please login to access your account. You will be redirected if you are successful.';

include 'includes/header.php';
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="border border-secondary-subtle shadow-sm rounded p-3">
    <?php if (!empty($error)) : ?>
        <p class="text-center text-danger"><?= $error; ?></p>
    <?php endif; ?>
    <h2 class="fw-light my-3">Login Form</h2>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" name="password" id="password">
    </div>
    <input type="submit" value="Log In" name="submit" class="btn btn-success my-3">
</form>



<?php include 'includes/footer.php'; ?>