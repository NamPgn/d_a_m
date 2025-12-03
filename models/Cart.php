<?php
class Cart
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function findCartByUserId($user_id)
  {
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createCart($user_id)
  {
    $sql = "INSERT INTO cart (user_id) VALUES (?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user_id]);

    $cart_id = $this->pdo->lastInsertId();

    return [
      'id' => $cart_id,
      'user_id' => $user_id
    ];
  }

  public function findCartDetailByCartId($cart_id)
  {
    $sql = "SELECT * FROM cart_detail WHERE cart_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$cart_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getConnection()
  {
    return $this->pdo;
  }
}
