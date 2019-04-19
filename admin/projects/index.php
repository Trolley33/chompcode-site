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
    <script>
        $(document).ready(function () {
            var token = <?php echo json_encode($current_user['token']); ?>;

            $('#submit-button').click(function() {
                let title = $('#project-title-input').val();
                data = {
                    name: title,
                    token: token,
                }
                $.post({
                    url: '/admin/projects/ajax_create.php',
                    data: data,
                    success: function(data) {window.location.href = "/admin/projects/edit.php?id="+data;},
                    error: function(data) {},
                });   
            });
        });
    </script>
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
        </table>
        <div style="margin: auto;">
            <button type="button" class="btn btn-circle btn-lg btn-info" data-toggle="modal" data-target="#new-project-modal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="new-project-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter New Project Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="project-title" class="col-form-label">Title:</label>
        <input type="text" class="form-control" id="project-title-input">
      </div>
      <div class="modal-footer">
        <button type="button" id="submit-button" class="btn btn-info">Submit</button>  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
