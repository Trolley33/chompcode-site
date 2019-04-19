<?php

if (!isset($_GET['id']) || empty($_GET['id']))
    header('location: /admin/projects');

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="" style="height: 100%;">
<head>
    <!-- -- PHP Scripts -- -->
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

    $result = mysqli_query($link, "SELECT * FROM projects WHERE id=$id");

    if (mysqli_num_rows($result) != 1)
    header('location: /projects');
    $project = mysqli_fetch_assoc($result);

    ?>
    <title>Editing - <?php echo $project['name'] ?></title>
    <!-- -- JS Scripts -- -->
    <script>
        var quill;
        var project_id;
        var user_token = <?= json_encode($current_user['token']); ?>;

        $(document).ready(function () {
            let options = {
                modules: {
                    syntax: true,
                    toolbar: '#toolbar-container',
                },
                placeholder: 'Start a project!',
                theme: 'snow'
            };

            quill = new Quill('#editor-container', options);
            quill.root.innerHTML = <?php echo json_encode($project['body']); ?>;
            project_id = <?php echo $project['id']; ?>;

            let saveAlert = $('#save-success');
            saveAlert.attr('hidden', null);
            saveAlert.fadeOut(0);

            $('.save-button').click(ajax_save);
            $('#delete-button').click(ajax_delete);
        });

        function ajax_save() {
            let name = $('#title-input').val();
            let body = quill.root.innerHTML;
            let desc = $('#description-input').val();
            let link_1 = $('#link1-input').val();
            let link_2 = $('#link2-input').val();

            data = {
                id: project_id,
                name: name,
                body: body,
                desc: desc,
                link_1: link_1,
                link_2: link_2,
                token: user_token,
            };

            $.post({
                url: "/admin/projects/ajax_update.php",
                data: data,
                success: function (data) {
                    let save_anchor = $('#save-success a');
                    save_anchor.attr('href', '/projects/view.php?id=' + project_id);
                    save_anchor.attr('target', '_blank');

                    let save_modal = $('#save-success');
                    save_modal.fadeIn();
                    setTimeout(function () {
                        save_modal.fadeOut()
                    }, 4000);
                },
            });
        }

        function ajax_delete() {

            data = {
                id: project_id,
                token: user_token,
            };

            $.post({
                url: "/admin/projects/ajax_delete.php",
                data: data,
                success: function (data) {
                    window.location.replace('/admin/projects?deleted=1');
                },
            });
        }
    </script>
</head>
<body style="height: 100%;">
<!-- Navbar section -->
<?php make_admin_navbar("Manage Projects"); ?>


<!-- Main Content -->
<div id="standalone-container">
    <!-- Post title form area -->
    <div class="p-2">
        <div class="p-2 float-left">
            <form class="form-inline">
                <label class="font-weight-bold pr-3" for="title-input">Project Title: </label>
                <input type="text" class="form-control" id="title-input" placeholder="Enter Title" value="<?php echo $project['name']; ?>"/>
            </form>
        </div>
        <div class="p-2 float-right">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#project-meta-form"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#project-delete-form"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>
    <br />
    <br />
    <!-- Fancy editor -->
    <?php make_editor_toolbar(); ?>
    <div id="editor-container"></div>
    <button type="button" class="btn btn-lg btn-info save-button floating-bottom-right" style="border-radius: 35px;">
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

<!-- Edit modal-->
<div id="project-meta-form" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project Meta Tags</h5>
                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <label class="font-weight-bold pr-3" for="description-input">Project Description: </label><br/>
                    <textarea class="form-control" id="description-input" placeholder="A short description"><?php echo $project['description']; ?></textarea>
                    <br/>
                    <label class="font-weight-bold pr-3" for="link1-input">Project Link #1: </label><br/>
                    <input type="url" class="form-control" id="link1-input" placeholder="A link to the project web page/download." value="<?php echo $project['link_1']; ?>"/>
                    <br/>
                    <label class="font-weight-bold pr-3" for="link2-input">Project Link #2: </label><br/>
                    <input type="url" class="form-control" id="link2-input" placeholder="A mirror link to the project web page/download." value="<?php echo $project['link_2']; ?>"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info save-button" data-dismiss="modal"><i class="fas fa-save"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal-->
<div id="project-delete-form" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Really Delete this Project?</h5>
                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button id="delete-button" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
