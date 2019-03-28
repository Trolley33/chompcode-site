<?php


if (!isset($_POST['username']) || !isset($_POST['password']))
{
    header("Location: " . '/login?error=unset');
}

global $current_user;
if (!is_null($current_user))
{
    header("Location: " . '/login?error=loggedin');
}
else {
    require_once "/var/www/html/assets/db.php";
    require_once('/var/www/html/assets/php_functions.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $correct_hash = find_hash($link, $username);

    if (!password_verify($password, $correct_hash)) {
        header("Location: " . '/login?error=notfound');
    } else {

        $token = bin2hex(random_bytes(32));
        set_user_token($link, $username, $token);
        setcookie('user_token', $token, time() + (60 * 60 * 24 * 7), '/');

        header("Location: " . $_POST['url']);
    }
}