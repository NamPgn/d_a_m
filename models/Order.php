<?php
class Order
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function createOrder($user_id, $total_amount, $customer_name, $customer_phone, $customer_address)
  {
    $sql = "INSERT INTO orders (user_id, total_amount, customer_name, customer_phone, customer_address, status, created_at) 
            VALUES (?, ?, ?, ?, ?, 'pending', NOW())";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user_id, $total_amount, $customer_name, $customer_phone, $customer_address]);
    
    return $this->pdo->lastInsertId();
  }

  public function getOrdersByUserId($user_id)
  {
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOrderById($order_id)
  {
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$order_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getAllOrders()
  {
    $sql = "SELECT orders.*, users.email, users.name as user_name 
            FROM orders 
            LEFT JOIN users ON orders.user_id = users.id 
            ORDER BY orders.created_at DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}

