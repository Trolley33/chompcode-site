<?php
if (!isset($_POST['name']) || !isset($_POST['token'])):
    header('location: /projects');
    exit(1);
endif;

require_once('/var/www/html/assets/db.php');

$name = mysqli_escape_string($link, $_POST['name']);
$token = mysqli_escape_string($link, $_POST['token']);

$token_query = "SELECT id FROM users WHERE token='$token'";
$token_result = mysqli_query($link, $token_query);

if ($token_result->num_rows == 0):
    header('location: /projects');
    exit(1);
endif;

$create_query = "
INSERT INTO projects (`name`, `created_at`, `updated_at`) VALUES ('$name', CURRENT_DATE(), CURRENT_DATE());
";

mysqli_query($link, $create_query);

$new_id_query = "SELECT LAST_INSERT_ID() as id FROM projects";
$result = mysqli_query($link, $new_id_query);

if ($result->num_rows > 0) {
    echo $result->fetch_assoc()['id'];
}
else {
    exit(1);
}
