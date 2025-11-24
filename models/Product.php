<?php
class Product
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function getAll()
  {
    $sql = "SELECT * FROM products";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAllCategories()
  {
    $sql = "SELECT * FROM categories";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function add($name, $price, $quantity, $category_id, $image, $descriptions)
  {
    $sql = "INSERT INTO products (name, price, quantity, category_id, image, descriptions) VALUES (?, ?, ?, ?, ?, ?)";  
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$name, $price, $quantity, $category_id, $image, $descriptions]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function edit($id, $name, $price, $quantity, $category_id, $image, $descriptions)
  {
    $sql = "UPDATE products SET name = ?, price = ?, quantity = ?, category_id = ?, image = ?, descriptions = ? WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$name, $price, $quantity, $category_id, $image, $descriptions, $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete($id)
  {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
} 