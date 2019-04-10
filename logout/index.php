<?php
setcookie('user_token', null, time()-1, '/');

$back_link = '/';

if (isset($_GET['url']))
{
    $back_link = urldecode($_GET['url']);
}

header("Location: " . $back_link);