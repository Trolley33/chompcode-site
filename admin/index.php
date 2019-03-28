<!DOCTYPE html>
<html lang="">
<head>
    <!-- -- PHP Scripts -- -->
    <?php
    require_once('/var/www/html/assets/dependencies.php');
    require_once('/var/www/html/assets/db.php');
    require_once('/var/www/html/assets/php_functions.php');
    authenticate();
    ?>
    <title>Admin</title>
    <!-- -- JS Scripts -- -->
    <script>
    </script>
</head>
<body>
<!-- Navbar section -->
<?php
make_admin_navbar("Home");
?>
<!-- Main Content -->
<div class="container">
    <div id="content" class="mt-4">
        <h1>Admin home</h1>
    </div>
</div>

</body>
</html>
