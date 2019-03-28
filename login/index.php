<html lang="">
<head>
    <?php require_once('/var/www/html/assets/dependencies.php'); ?>
    <?php require_once('/var/www/html/assets/db.php'); ?>
    <?php require_once('/var/www/html/assets/php_functions.php'); ?>
    <title>Log In Now</title>
    <?php
    authenticate($link);
    $back_link = '/';

    if (isset($_GET['url']))
    {
        $back_link = urldecode($_GET['url']);
    }
    ?>

</head>
<body>
<div class="container mt-5 w-50">
    <div class="card">
        <h3 class="card-header">Login</h3>
        <div class="card-body">
            <form action="validate.php" method="post">
                <input type="hidden" name="url" value="<?= $back_link ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Your Username *" value="" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" required/>
                </div>
                <div class="form-group">
                    <a href="<?= $back_link ?>" class="btn btn-link float-left"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                    <input type="submit" class="btn btn-outline-primary float-right" value="Login" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>