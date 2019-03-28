<html lang="">
<head>
    <?php require_once('/var/www/html/assets/dependencies.php'); ?>
    <?php require_once('/var/www/html/assets/php_functions.php'); ?>
    <title>Home</title>
</head>
<body>
<!-- Navbar section -->
<?php
authenticate();
make_public_navbar("Home");
?>

<!-- Main Content -->
<div class="container">
    <h1>
        Index page!
    </h1>
</div>
<script>
</script>

</body>
</html>
