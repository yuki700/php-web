<?php
session_start();
ob_start();

$module = isset($_GET['m']) ? $_GET['m'] : false;

if ($module == null) {
    $module = 'home';
}

require __DIR__ . '/config.php';
require __DIR__ . '/libs/db.php';

$mysql = new DB(
    $dbConfig['host'],
    $dbConfig['user'],
    $dbConfig['password'],
    $dbConfig['db_name'],
);


require __DIR__ . '/modules/partials/header.php';

require __DIR__ . "/modules/$module.php";

require __DIR__ . '/modules/partials/footer.php';
ob_end_flush();
