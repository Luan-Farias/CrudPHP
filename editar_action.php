<?php
require './config.php';
require './dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($id && $name && $email) {
    $user = new User();
    $user->setId($id);
    $user->setName($name);
    $user->setEmail($email);

    $userDao->update($user);
    header("Location: index.php");
    exit;
} else {
    header('Location: editar.php?id=' . $id);
    exit;
}