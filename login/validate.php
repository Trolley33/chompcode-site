<?php
setcookie('user_token', 'test', time()+(60*60*24), '/');

header("Location: " . ($_POST['url']));