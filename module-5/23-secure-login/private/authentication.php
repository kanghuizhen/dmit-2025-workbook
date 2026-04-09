<?php

session_start();

require_once dirname(__DIR__, 3) . '/data/connect.php';
$connection = db_connect();

function require_login() {
    if (!is_logged_in()) :
        header ("Location: login.php");
    else: 
        $current_time = time();
        $last_page_accessed_time = $_SESSION['access_time'];
        $timeout = 60 * 2;

        if ($current_time > $last_page_accessed_time + $timeout):
            session_unset();
            session_destroy();
            header("Location: login.php");
        endif;
    endif;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function authenticate($user, $pswd) {
    global $connection;
    $statement = $connection->prepare("SELECT account_id, hashed_pass FROM users WHERE users = ?");

    if (!$statement):
        die("Prepare failed: " . $connection->error);
    endif;

    $statement->bind_param("s", $user);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows == 1) :
        $statement->bind_result($account_id, $hashed_pass);
        $statement->fetch();

        if (password_verify($pswd, $hashed_pass)) :
            $_SESSION['user_id'] = $account_id;
            $_SESSION['username'] = $user;
            $_SESSION['access_time'] = time();
            return true;
        else: 
            return false;
        endif;
    else :
        return false;
    endif;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location:index.php");
}

?>