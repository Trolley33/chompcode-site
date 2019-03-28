<!DOCTYPE html>
<?php

if (!isset($_GET['id']) || empty($_GET['id']))
    header('location: /projects');

$id = $_GET['id'];
?>

<html lang="">
<head>
    <!-- -- PHP Scripts -- -->
    <?php
    require_once('/var/www/html/assets/dependencies.php');
    require_once('/var/www/html/assets/db.php');
    require_once('/var/www/html/assets/php_functions.php');
    authenticate($link);

    $result = mysqli_query($link, "SELECT * FROM projects WHERE id=$id");

    if (mysqli_num_rows($result) != 1)
        header('location: /projects');
    $project = mysqli_fetch_assoc($result);
    ?>
    <title>Viewing - <?php echo $project['name'] ?></title>
    <!-- -- JS Scripts -- -->
    <script>
        $(document).ready(function () {
            $('pre').each(function (i) {
                hljs.highlightBlock(this);
            });
        });
    </script>
</head>
<body>
<!-- Navbar section -->
<?php
make_public_navbar("Projects");
?>
<!-- Main Content -->
<div class="container">
    <div id="content" class="mt-4">
        <?php echo $project['body']; ?>
    </div>
</div>

</body>
</html>
