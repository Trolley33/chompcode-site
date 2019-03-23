<?php
if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['body'])):
    //header('location: /projects');
    echo "fuck off";
endif;

require_once('/var/www/html/assets/db.php');

$id = mysqli_escape_string($link, $_POST['id']);
$name = mysqli_escape_string($link, $_POST['name']);
$body = mysqli_escape_string($link, $_POST['body']);

$query = "
UPDATE projects
SET name='$name', body='$body'
WHERE id=$id;
";

mysqli_query($link, $query);