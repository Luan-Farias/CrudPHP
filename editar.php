<?php
require './config.php';
require './dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$id = filter_input(INPUT_GET, 'id');
$user = false;
if ($id) {
    $user = $userDao->findById($id);
}
if (!$user) {
    header("Location: index.php");
    exit;
}

?>
<h1>Editar Usuário</h1>
<form action="editar_action.php" method="post">
    <input type="hidden" name="id" value="<?= $user->getId() ?>">
    <label>
        Nome: <input type="text" name="name" value="<?= $user->getName(); ?>" />
    </label><br /><br />

    <label>
        Email: <input type="email" name="email" value="<?= $user->getEmail(); ?>">
    </label><br /><br />

    <input type="submit" value="Editar">
</form>