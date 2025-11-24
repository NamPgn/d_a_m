<?php
class CartDetail
{
  protected $pdo;
  public function __construct()
  {
    $database = new BaseModel();
    $this->pdo = $database->getConnection();
  }

  public function findCartDetailByCartIdAndProductId($cart_id, $product_id)
  {
    $sql = "SELECT * FROM cart_detail WHERE cart_id = ? AND product_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$cart_id, $product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createCartDetail($cart_id, $product_id, $quantity)
  {
    $sql = "INSERT INTO cart_detail (cart_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$cart_id, $product_id, $quantity]);
  }

  public function updateCartDetail($cart_id, $product_id, $quantity)
  {
    $sql = "UPDATE cart_detail SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$quantity, $cart_id, $product_id]);
  }

  public function findCartDetailByCartId($cart_id)
  {
    $sql = "SELECT cart_detail.*, products.name, products.image, products.price FROM cart_detail JOIN products ON cart_detail.product_id = products.id WHERE cart_detail.cart_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$cart_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteCartDetail($product_id, $cart_id)
  {
    $sql = "DELETE FROM cart_detail WHERE product_id = ? AND cart_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$product_id, $cart_id]);
  }
}
