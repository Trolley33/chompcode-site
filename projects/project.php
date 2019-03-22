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
    <title><?php echo $project['name'] ?></title>
</head>
<body>
<!-- Navbar section -->
<?php
make_navbar("Projects");
?>
<!-- Main Content -->
<div class="container">
    <div class="row mt-4">

    </div>
</div>
<script>
</script>

</body>
</html>
