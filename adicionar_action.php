<?php
require './config.php';
require './dao/userDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if ($name && $email) {
    if (!$userDao->findByEmail($email)) {
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setEmail($email);

        $userDao->add($newUser);
        header("Location: index.php");
        exit;
    }
}
header('Location: adicionar.php');
exit;