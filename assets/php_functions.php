<?php

$current_user = null;

function authenticate($link)
{
    global $current_user;
    if (isset($_COOKIE['user_token']))
    {
        $token = mysqli_escape_string($link, $_COOKIE['user_token']);
        $result = mysqli_query($link, "SELECT * FROM users WHERE token='$token'");
        if (mysqli_num_rows($result) == 0)
        {
            $current_user = null;
            return;
        }
        $current_user = mysqli_fetch_assoc($result);
    }
    else
    {
        $current_user = null;
    }
}

function find_hash($link, $name)
{
    $name = mysqli_escape_string($link, $name);
    $result = mysqli_query($link, "SELECT id, pass FROM users WHERE username='$name'");

    if (mysqli_num_rows($result) != 1) {
        header('location: /login?error=notfound');
        return '';
    }
    else {

        return mysqli_fetch_assoc($result)['pass'];
    }
}

function set_user_token ($link, $name, $token)
{
    $name = mysqli_escape_string($link, $name);
    mysqli_query($link, "UPDATE users SET token='$token' WHERE username='$name'");
}

function make_public_navbar($active)
{
    // Data for navigation bar.
    $links =
        [
            '/'=>'Home',
            '/projects'=>'Projects',
            '/about'=>'About Us'
        ];
    // Start open navbar tags.
    echo '
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/chompcode-big-circle.png" width="60" height="60" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-1" id="navbarNav">
            <ul class="navbar-nav">';

    // Output navbar info.
    foreach ($links as $href=>$text)
    {
        if ($text == $active) {
            echo "<li class='nav-item active'>";
            echo "<a class='nav-link' href='$href'>$text</a>";
            echo "</li>";
        }
        else {
            echo "<li class='nav-item'>";
            echo "<a class='nav-link' href='$href'>$text</a>";
            echo "</li>";
        }
    }
    // Close tags.
    echo '
            </ul>
        </div>';
    // Display Login button?
    global $current_user;
    if (is_null($current_user))
    {
        echo '
        <div class="navbar-collapse collapse order-3">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-info m-1" href="/login?url='. urlencode($_SERVER['REQUEST_URI']) . '">Log In</a>
                </li>
            </ul>
        </div>';
    }
    else
    {
        echo '
        <div class="navbar-collapse collapse order-3">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-success m-1" href="/admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger m-1" href="/logout?url='. urlencode($_SERVER['REQUEST_URI']) . '">Log Out</a>
                </li>
            </ul>
        </div>';

    }
    echo '</nav>';
}

function make_admin_navbar($active)
{
    // Data for navigation bar.
    $links =
        [
            '/admin'=>'Home',
            '/admin/projects'=>'Manage Projects',
        ];
    // Start open navbar tags.
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/chompcode-big-circle.png" width="60" height="60" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-1" id="navbarNav">
            <ul class="navbar-nav">
    <?php

    // Output navbar info.
    foreach ($links as $href=>$text)
    {
        if ($text == $active) {
            echo "<li class='nav-item active'>";
            echo "<a class='nav-link' href='$href'>$text</a>";
            echo "</li>";
        }
        else {
            echo "<li class='nav-item'>";
            echo "<a class='nav-link' href='$href'>$text</a>";
            echo "</li>";
        }
    }
    // Close tags.
    ?>
            </ul>
        </div>

        <div class="navbar-collapse collapse order-3">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-success m-1" href="/">Public</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger m-1" href="/logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>';
}

function make_editor_toolbar() {
    echo '<div id="toolbar-container">
    <span class="ql-formats">
    <select class="ql-font"></select>
    <select class="ql-size"></select>
    </span>
    <span class="ql-formats">
    <button class="ql-bold"></button>
    <button class="ql-italic"></button>
    <button class="ql-underline"></button>
    <button class="ql-strike"></button>
    </span>
    <span class="ql-formats">
    <select class="ql-color"></select>
    <select class="ql-background"></select>
    </span>
    <span class="ql-formats">
    <button class="ql-script" value="sub"></button>
    <button class="ql-script" value="super"></button>
    </span>
    <span class="ql-formats">
    <button class="ql-header" value="1"></button>
    <button class="ql-header" value="2"></button>
    <button class="ql-blockquote"></button>
    <button class="ql-code-block"></button>
    </span>
    <span class="ql-formats">
    <button class="ql-list" value="ordered"></button>
    <button class="ql-list" value="bullet"></button>
    <button class="ql-indent" value="-1"></button>
    <button class="ql-indent" value="+1"></button>
    </span>
    <span class="ql-formats">
    <button class="ql-direction" value="rtl"></button>
    <select class="ql-align"></select>
    </span>
    <span class="ql-formats">
    <button class="ql-link"></button>
    <button class="ql-image"></button>
    <button class="ql-video"></button>
    <button class="ql-formula"></button>
    </span>
    <span class="ql-formats">
    <button class="ql-clean"></button>
    </span>
    </div>';
}

?>
