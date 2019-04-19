<html lang="">
<head>
    <?php require_once('/var/www/html/assets/dependencies.php'); ?>
    <?php require_once('/var/www/html/assets/db.php'); ?>
    <?php require_once('/var/www/html/assets/php_functions.php'); ?>
    <title>Home</title>
</head>
<body class="bg-light">
<!-- Navbar section -->
<?php
authenticate($link);
make_public_navbar("Home");
?>

<!-- Main Content -->
<div class="container mt-3 mb-3 p-3 border rounded bg-white">
    <h2>Recent Projects</h2>
    <hr/>
        <?php
        $projects = get_projects($link, 'created_at', 'desc');

        foreach ($projects as $index => $project) {
            if ($index % 3 == 0) {
                echo "<div class='row'>";
            }
            make_project_card($project);
            if ($index % 3 == 2) {
                echo "</div>";
            }
        }
        ?>
</div>

<script>
</script>

</body>
</html>
