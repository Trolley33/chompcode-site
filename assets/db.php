<?php

if (!file_exists('/var/www/html/config.ini')):
    echo "Couldn't find config.ini, check the repository for a template.";
    die;
endif;

$config = parse_ini_file('/var/www/html/config.ini', true);

$username = $config['mysql_credentials']['username'];
$password = $config['mysql_credentials']['password'];

$link = mysqli_connect("localhost", $username, $password, "chompcode");

if (!$link):
    echo "Error: Can't connect to database.";
    die;
endif;



