<?php
namespace App\Models;

use App\Core\DB;

class OrderSlot extends DB
{
    private int $id;
    private int $idOrder;
    private int $idProduct;
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
     * Get the value of idOrder
     */
    public function getIdOrder(): int
    {
        return $this->idOrder;
    }

    /**
     * Set the value of idOrder
     *
     * @return  void
     */
    public function setIdOrder(int $idOrder): void
    {
        $this->idOrder = $idOrder;
    }

    /**
     * Get the value of idProduct
     */
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * Set the value of idProduct
     *
     * @return  void
     */
    public function setIdProduct(int $idProduct): void
    {
        $this->idProduct = $idProduct;
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