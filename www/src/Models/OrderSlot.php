<?php
namespace App\Models;

use App\Core\DB;

class OrderSlot extends DB
{
    private int $id;
    private int $orderId;
    private int $productId;
    private int $quantity;

    // Permets a la class DB de recuperer les attributs
    protected function getAttributes(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of orderId
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * Set the value of orderId
     *
     * @return  void
     */
    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * Get the value of productId
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  void
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

}