<?php

namespace App\Models;

use App\Core\DB;

class Payment extends DB
{
    protected int $id;
    protected int $paymentMethodId;
    protected int $orderid;
    protected int $amount;
    protected string $status;

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
     * Get the value of paymentMethodId
     */
    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }

    /**
     * Set the value of paymentMethodId
     *
     * @return  void
     */
    public function setPaymentMethodId(int $paymentMethodId): void
    {
        $this->paymentMethodId = $paymentMethodId;
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
