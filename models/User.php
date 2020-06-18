<?php

class User
{
    private int $id;
    private string $name;
    private string $email;

    // Getters e Setters
    // Id
    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = trim($id);
    }
    // Nome
    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = ucwords(trim($name));
    }
    // Email
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = strtolower(trim($email));
    }
}

interface UserDAO
{
    public function add(User $user);
    public function findAll();
    public function findByEmail(string $email);
    public function findById(int $id);
    public function update(User $user);
    public function delete(int $id);
}