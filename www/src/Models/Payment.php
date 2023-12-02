<?php
namespace App\Models;

use App\Core\DB;

class Payment extends DB
{
    private int $id;
    private int $idPaymentMethod;
    private int $idOrder;
    private int $amount;
    private string $date;
    private string $status;

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
     * Get the value of idPaymentMethod
     */
    public function getIdPaymentMethod(): int
    {
        return $this->idPaymentMethod;
    }

    /**
     * Set the value of idPaymentMethod
     *
     * @return  void
     */
    public function setIdPaymentMethod(int $idPaymentMethod): void
    {
        $this->idPaymentMethod = $idPaymentMethod;
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
     * Get the value of amount
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  void
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get the value of date
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  void
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

}