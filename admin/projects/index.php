<html lang="">
<head>
    <?php
    require_once('/var/www/html/assets/dependencies.php');
    require_once('/var/www/html/assets/db.php');
    require_once('/var/www/html/assets/php_functions.php');
    authenticate($link);

    global $current_user;
    if (is_null($current_user))
    {
        header("Location: " . '/');
    }
    ?>
    <title>Projects</title>
</head>
<body>
<!-- Navbar section -->
<?php
make_admin_navbar("Manage Projects");
?>
<!-- Main Content -->
<div class="container">
    <div class="row mt-4">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">Project Name</th>
                <th scope="col">Description</th>
                <th scope="col">Manage</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $projects = mysqli_query($link, 'SELECT * FROM projects');
            while ($row = mysqli_fetch_assoc($projects)) {
                $id = $row['id'];
                $name = $row['name'];
                $desc = $row['description'];
                $plink = $row['project_link'];
                echo "<tr scope='row'>";
                echo "<td><a class='btn-link' href='$plink'>$name</td>";
                echo "<td>$desc</td>";

                echo "<td><a href='/admin/projects/edit.php?id=". $id ."' role='button' class='btn btn-outline-info btn-rounded' style='border-radius: 12px;width: 100%;height: 100%;;'><i class='fas fa-pencil-alt'></i></a></td>";

                echo "</tr>";
            }
            ?>
            </tbody>
    </div>
</div>
<script>
</script>

</body>
</html>
