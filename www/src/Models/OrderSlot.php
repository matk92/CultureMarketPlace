<?php

namespace App\Models;

use App\Core\DB;

class OrderSlot extends DB
{
    protected int $id;
    protected int $orderid;
    protected int $productid;
    protected int $quantity;


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * @return  void
     */
    public function setId(int $id): void
    {
        if ($id < 0) {
            throw new \Exception("L'id ne peut pas etre negatif");
        }
        $this->id = $id;
    }

    /**
     * Get the value of orderid
     */
    public function getOrderId(): int
    {
        return $this->orderid;
    }

    /**
     * Set the value of orderid
     *
     * @return  void
     */
    public function setOrderId(int $orderid): void
    {
        $this->orderid = $orderid;
    }

    /**
     * Get the value of productid
     */
    public function getProductId(): int
    {
        return $this->productid;
    }

    /**
     * Set the value of productid
     *
     * @return  void
     */
    public function setProductId(int $productid): void
    {
        $this->productid = $productid;
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
