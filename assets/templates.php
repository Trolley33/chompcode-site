<?php
$navbar = "
<div class='navbar'>
  <ul>
    <li><a href='/'>Home</a></li>
    <li><a href='/projects/'>Projects</a></li>
  </ul>
</div>
";

$header = "
<div class='header w3-container w3-dark-grey'>
  <div class='w3-center'>
    <h1>Chompcode</h1>
    <h4>Bite my CSS</h4>
  </div>
</div>
";
?>

<script>
    $(document).ready(function () {
        // Set selected navbar element to current path, temporary workaround.
        $('.navbar li').each(function (i) {
            var item = $(this);

            if (item.find('a').attr("href") === window.location.pathname) {
                item.addClass("active");
            }
        });
    });
</script>
