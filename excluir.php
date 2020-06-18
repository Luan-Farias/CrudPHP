<?php
require './config.php';
require './dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if ($id) {
    $userDao->delete($id);
}
header("Location: index.php");
exit;