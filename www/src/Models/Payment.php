<?php

namespace App\Models;

use App\Core\DB;

class Payment extends DB
{
    public const STATUS_PENDING = 0;
    public const STATUS_PAID = 1;
    public const STATUS_CANCELED = 2;

    protected int $id;
    protected ?int $paymentmethodid = null;
    protected ?int $orderid = null;
    protected string $status;

    private ?PaymentMethod $paymentMethod = null;
    private ?Order $order = null;

    /**
     * Permet de faire le lien entre les objets
     * 
     * @return self
     */
    protected function populateRelations(): self
    {
        if (is_null($this->paymentMethod) && !is_null($this->paymentmethodid)) {
            $this->paymentMethod = (new PaymentMethod())->populate($this->paymentmethodid);
        }
        if (is_null($this->order) && !is_null($this->orderid)) {
            $this->order = (new Order())->populate($this->orderid);
        }
        return $this;
    }

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
     * Get the value of paymentmethodid
     */
    public function getPaymentMethodId(): int
    {
        return $this->paymentmethodid;
    }

    /**
     * Set the value of paymentmethodid
     *
     * @return  void
     */
    public function setPaymentMethodId(int $paymentmethodid): void
    {
        $this->paymentmethodid = $paymentmethodid;
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

    public function getOrder(): ?Order
    {
        return $this->order;
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
        $this->status = strip_tags($status);
    }

    /**
     * Get the value of paymentMethod
     * 
     * @return PaymentMethod
     */
    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * Set the value of paymentMethod
     * 
     * @return  void
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }
}
