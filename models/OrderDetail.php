<?php
class OrderDetail
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function createOrderDetail($order_id, $product_id, $quantity, $price)
  {
    $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$order_id, $product_id, $quantity, $price]);
  }

  public function getOrderDetailsByOrderId($order_id)
  {
    $sql = "SELECT order_details.*, products.name, products.image 
            FROM order_details 
            JOIN products ON order_details.product_id = products.id 
            WHERE order_details.order_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$order_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

