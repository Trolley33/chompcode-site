<?php
if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['body']) || !isset($_POST['desc']) || !isset($_POST['link_1']) || !isset($_POST['link_2']) || !isset($_POST['token'])):
    header('location: /projects');
    die;
endif;

require_once('/var/www/html/assets/db.php');

$id = mysqli_escape_string($link, $_POST['id']);
$name = mysqli_escape_string($link, $_POST['name']);
$body = mysqli_escape_string($link, $_POST['body']);
$desc = mysqli_escape_string($link, $_POST['desc']);
$url_1 = mysqli_escape_string($link, $_POST['link_1']);
$url_2 = mysqli_escape_string($link, $_POST['link_2']);

$url_1 = get_url($url_1);
$url_2 = get_url($url_2);

$token = mysqli_escape_string($link, $_POST['token']);

$token_query = "SELECT id FROM users WHERE token='$token'";
$token_result = mysqli_query($link, $token_query);

if ($token_result->num_rows == 0):
    header('location: /projects');
    die;
endif;

$update_query = "
    UPDATE projects
    SET name='$name', body='$body', description='$desc', link_1='$url_1', link_2='$url_2'
    WHERE id=$id;
";

mysqli_query($link, $update_query);


function get_url ($url) {
    if (empty($url))
        return $url;
    if (strstr($url, 'http:') || strstr($url, '//'))
        return $url;

    return '//' . $url;
}