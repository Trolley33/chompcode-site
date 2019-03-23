<!DOCTYPE html>
<?php

if (!isset($_GET['id']) || empty($_GET['id']))
    header('location: /projects');

$id = $_GET['id'];
?>

<html lang="">
<head>
    <?php require_once('/var/www/html/assets/dependencies.php'); ?>
    <?php require_once('/var/www/html/assets/db.php'); ?>
    <?php require_once('/var/www/html/assets/php_functions.php'); ?>

    <?php
    $result = mysqli_query($link, "SELECT * FROM projects WHERE id=$id");

    if (mysqli_num_rows($result) != 1)
        header('location: /projects');
    $project = mysqli_fetch_assoc($result);

    ?>
    <title>Viewing - <?php echo $project['name'] ?></title>
</head>
<body>
<!-- Navbar section -->
<?php
make_navbar("Projects");
?>
<!-- Main Content -->
<div class="container">
    <div id="content" class="mt-4">
        <?php echo $project['body']; ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('pre').each(function (i) {
            hljs.highlightBlock(this);
        });
    });
</script>

</body>
</html>
