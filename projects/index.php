<html lang="">
<head>
    <?php
    require_once('/var/www/html/assets/dependencies.php');
    require_once('/var/www/html/assets/db.php');
    require_once('/var/www/html/assets/php_functions.php');
    authenticate($link);
    ?>
    <title>Projects</title>
</head>
<body>
<!-- Navbar section -->
<?php
make_public_navbar("Projects");
?>
<!-- Main Content -->
<div class="container">
<div class="row mt-4">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Project Name</th>
        <th scope="col">Description</th>
        <th scope="col">Link</th>
        <th scope="col">Mirror</th>
        <th scope="col">Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $projects = mysqli_query($link, 'SELECT * FROM projects');
      while ($row = mysqli_fetch_assoc($projects)) {
        $id = $row['id'];
        $name = $row['name'];
        $desc = $row['description'];
        $link1 = $row['link_1'];
        $link2 = $row['link_2'];

        $created_date = date_create($row['created_at']);
        $created = date_format($created_date, "Y/m/d");

        echo "<tr scope='row'>";
        echo "<td><a class='btn-link' href='/projects/view.php?id=$id'>$name</td>";
        echo "<td>$desc</td>";

        if (empty($link1))
          echo "<td><a class='btn-link'>N/A</a></td>";
        else
          echo "<td><a class='btn-link' href='$link1'>Main Link</a></td>";
        if (empty($link2))
          echo "<td><a class='btn-link'>N/A</a></td>";
        else
          echo "<td><a class='btn-link' href='$link2'>Mirror</a></td>";

        echo "<td>$created</td>";
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
