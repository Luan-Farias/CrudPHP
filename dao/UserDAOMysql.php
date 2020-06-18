<?php
require_once 'models/User.php';

class UserDAOMysql implements UserDAO
{

    private PDO $pdo;

    public function __construct(PDO $engine)
    {
        $this->pdo = $engine;
    }

    public function add(User $user)
    {
        $sql = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->execute();

        $user->setId($this->pdo->lastInsertId());
        return $user;
    }
    public function findAll()
    {
        $users = [];

        $sql = $this->pdo->query("SELECT * FROM users");
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $item) {
                $user = new User();
                $user->setId($item['id']);
                $user->setName($item['name']);
                $user->setEmail($item['email']);

                $users[] = $user;
            }
        }

        return $users;
    }
    public function findByEmail(string $email)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            return $user;
        } else {
            return false;
        }
    }
    public function findById(int $id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $user = new User();
            $user->setId($data['id']);
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            return $user;
        } else {
            return false;
        }
    }
    public function update(User $user)
    {
        $sql = $this->pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(':id', $user->getId());
        $sql->bindValue(':name', $user->getName());
        $sql->bindValue(':email', $user->getEmail());
        $sql->execute();

        return true;
    }
    public function delete(int $id)
    {
        $sql = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}