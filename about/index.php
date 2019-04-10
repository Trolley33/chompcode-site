<!DOCTYPE html>
<html lang="">
<head>
    <!-- -- PHP Scripts -- -->
    <?php
    require_once('/var/www/html/assets/dependencies.php');
    require_once('/var/www/html/assets/db.php');
    require_once('/var/www/html/assets/php_functions.php');
    authenticate($link);
    ?>
    <title>About Us</title>
    <!-- -- JS Scripts -- -->
    <script>
    </script>
</head>
<body>
<!-- Navbar section -->
<?php
make_public_navbar("About Us");
?>
<!-- Main Content -->
<div class="container">
    <div id="content" class="mt-4">
        <h1>About us page:</h1>
    </div>
</div>

</body>
</html>
