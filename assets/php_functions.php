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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        <img src="/assets/images/chompcode-small-circle.png" width="40" height="40" alt="" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
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
    echo '</ul></div></nav>';
}
?>
