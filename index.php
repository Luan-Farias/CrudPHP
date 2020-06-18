<?php
require './config.php';
require './dao/userDAOMysql.php';

$userDao = new UserDAOMysql($pdo);
$users = $userDao->findAll();
?>
<a href="adicionar.php">Adicionar usuário</a>
<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($users as $user) : ?>
    <tr>
        <th><?= $user->getId(); ?></th>
        <th><?= $user->getName(); ?></th>
        <th><?= $user->getEmail(); ?></th>
        <th>
            <a href="editar.php?id=<?= $user->getId() ?>">[Editar]</a>
            <a href="excluir.php?id=<?= $user->getId() ?>"
                onclick="return confirm('Tem Certeza Que Deseja Excluir')">[Excluir]</a>
        </th>
    </tr>
    <?php endforeach; ?>
</table>