<?php


function make_navbar($active)
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
    // Close navbar tags.
    echo '
            </ul>
        </div>
        <div class="navbar-collapse collapse order-3">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-info" href="/login">Log In</a>
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
