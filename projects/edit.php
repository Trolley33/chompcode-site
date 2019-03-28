<?php

if (!isset($_GET['id']) || empty($_GET['id']))
    header('location: /projects');

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="" style="height: 100%;">
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
    <title>Editing - <?php echo $project['name'] ?></title>
</head>
<body style="height: 100%;">
<!-- Navbar section -->
<?php
make_navbar("Projects");
?>

<!-- Popup section -->
<div id="project-meta-form" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?php $project['name'];?> Meta Tags</h5>
                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                Test!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info"><i class="fas fa-save"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="standalone-container">
    <!-- Post title form area -->
    <div class="p-2">
        <div class="p-2 float-left">
            <form class="form-inline">
                <label class="font-weight-bold pr-3" for="title-input">Post Title: </label>
                <input type="text" class="form-control" id="title-input" placeholder="Enter Title" value="<?php echo $project['name']; ?>"/>
            </form>
        </div>
        <div class="p-2 float-right">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#project-meta-form"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>
    <br />
    <br />
    <!-- Fancy editor -->
    <?php make_editor_toolbar(); ?>
    <div id="editor-container"></div>
    <button id="save-button" type="button" class="btn btn-lg btn-info" style="border-radius: 35px;">
        <i class="fas fa-save"></i>
    </button>
    <div id="save-success" class="alert alert-success" role="alert" hidden>
        Saved project successfully, view <a href="" class="alert-link">here</a>.
        &nbsp;
        <button type="button" class="close" onclick="$('#save-success').fadeOut();">
            <span>&times;</span>
        </button>
    </div>
</div>


<script>
    $(document).ready(function () {
        var options = {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Start a project!',
            theme: 'snow'
        };

        var quill = new Quill('#editor-container', options);
        quill.root.innerHTML = <?php echo json_encode($project['body']); ?>;
        var project_id = <?php echo $project['id']; ?>;

        var saveAlert = $('#save-success');
        saveAlert.attr('hidden', null);
        saveAlert.fadeOut(0);

        $('#save-button').click(function () {
            var body = quill.root.innerHTML;
            var name = $('#title-input').val();
            $.post("/projects/update.php", {id: project_id, name: name, body: body},
                function (data) {
                    $('#save-success a').attr('href', '/projects/view.php?id='+project_id);
                    saveAlert.fadeIn();
                    setTimeout(function () {saveAlert.fadeOut()}, 4000);
                });
        });
    });

</script>

</body>
</html>
