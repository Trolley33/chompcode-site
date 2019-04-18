<html lang="">
<head>
    <?php require_once('/var/www/html/assets/dependencies.php'); ?>
    <?php require_once('/var/www/html/assets/db.php'); ?>
    <?php require_once('/var/www/html/assets/php_functions.php'); ?>
    <title>Home</title>
</head>
<body>
<!-- Navbar section -->
<?php
authenticate($link);
make_public_navbar("Home");
?>

<!-- Main Content -->
<div class="container">
    <?php
    $projects = get_projects($link, 'updated_at', 'desc');

    foreach ($projects as $project) {
        make_card($project['id'], $project['name'], $project['body']);
    }
    ?>
</div>

<script>
</script>

</body>
</html>
