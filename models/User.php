<?php

class User
{
  protected $pdo;
  public function  __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function findByEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function checkLogin($email, $password)
  {
    $user = $this->findByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return false;
  }

  public function register($email, $password, $name, $phone, $address)
  {
    $sql = "INSERT INTO users (email, password, name, phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      $email,
      password_hash($password, PASSWORD_DEFAULT),
      $name,
      $phone,
      $address
    ]);
  }


  public function getAll()
  {
    $sql = "SELECT * FROM users";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete($id)
  {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function edit($id, $email, $password, $name, $phone, $address)
  {
    $sql = "UPDATE users SET email = ?, password = ?, name = ?, phone = ?, address = ? WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email, $password, $name, $phone, $address, $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function add($email, $password, $name, $phone, $address)
  {
    $sql = "INSERT INTO users (email, password, name, phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email, $password, $name, $phone, $address]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
