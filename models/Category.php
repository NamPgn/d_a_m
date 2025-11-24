<?php
class Category
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function getAll()
  {
    $sql = "SELECT * FROM categories";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM categories WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function add($name)
  {
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$name]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function edit($id, $name)
  {
    $sql = "UPDATE categories SET name = ? WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$name, $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete($id)
  {
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
