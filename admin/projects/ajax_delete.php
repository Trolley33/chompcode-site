<?php
if (!isset($_POST['id']) || !isset($_POST['token'])):
    header('location: /projects');
    exit(1);
endif;

require_once('/var/www/html/assets/db.php');

$id = mysqli_escape_string($link, $_POST['id']);
$token = mysqli_escape_string($link, $_POST['token']);

$token_query = "SELECT id FROM users WHERE token='$token'";
$token_result = mysqli_query($link, $token_query);

if ($token_result->num_rows == 0):
    header('location: /projects');
    exit(1);
endif;

$delete_query = "
    DELETE FROM projects
    WHERE id='$id';
";

mysqli_query($link, $delete_query);
