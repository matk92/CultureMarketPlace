<?php

namespace App\Models;

use App\Core\DB;

class PaymentMethod extends DB
{
    private int $id;
    private int $userId;
    private int $paymentMethodTypeId;
    private string $cardNumber;
    private string $expirationDate;
    private string $securityCode;
    private string $cardHolderName;
    private string $cardHolderAddress;
    private string $cardHolderZipCode;
    private string $cardHolderCity;
    private string $cardHolderCountry;
    private string $cardHolderPhone;
    private string $cardHolderEmail;
    private string $updatedAt;

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
     * Get the value of userId
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  void
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * Get the value of paymentMethodTypeId
     */
    public function getPaymentMethodTypeId(): int
    {
        return $this->paymentMethodTypeId;
    }

    /**
     * Set the value of paymentMethodTypeId
     *
     * @return  void
     */
    public function setPaymentMethodTypeId(int $paymentMethodTypeId): void
    {
        $this->paymentMethodTypeId = $paymentMethodTypeId;
    }

    /**
     * Get the value of cardNumber
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * Set the value of cardNumber
     *
     * @return  void
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * Get the value of expirationDate
     */
    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    /**
     * Set the value of expirationDate
     *
     * @return  void
     */
    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * Get the value of securityCode
     */
    public function getSecurityCode(): string
    {
        return $this->securityCode;
    }

    /**
     * Set the value of securityCode
     *
     * @return  void
     */
    public function setSecurityCode(string $securityCode): void
    {
        $this->securityCode = $securityCode;
    }

    /**
     * Get the value of cardHolderName
     */
    public function getCardHolderName(): string
    {
        return $this->cardHolderName;
    }

    /**
     * Set the value of cardHolderName
     *
     * @return  void
     */
    public function setCardHolderName(string $cardHolderName): void
    {
        $this->cardHolderName = $cardHolderName;
    }

    /**
     * Get the value of cardHolderAddress
     */
    public function getCardHolderAddress(): string
    {
        return $this->cardHolderAddress;
    }

    /**
     * Set the value of cardHolderAddress
     *
     * @return  void
     */
    public function setCardHolderAddress(string $cardHolderAddress): void
    {
        $this->cardHolderAddress = $cardHolderAddress;
    }

    /**
     * Get the value of cardHolderZipCode
     */
    public function getCardHolderZipCode(): string
    {
        return $this->cardHolderZipCode;
    }

    /**
     * Set the value of cardHolderZipCode
     *
     * @return  void
     */
    public function setCardHolderZipCode(string $cardHolderZipCode): void
    {
        $this->cardHolderZipCode = $cardHolderZipCode;
    }

    /**
     * Get the value of cardHolderCity
     */
    public function getCardHolderCity(): string
    {
        return $this->cardHolderCity;
    }

    /**
     * Set the value of cardHolderCity
     *
     * @return  void
     */
    public function setCardHolderCity(string $cardHolderCity): void
    {
        $this->cardHolderCity = $cardHolderCity;
    }

    /**
     * Get the value of cardHolderCountry
     */
    public function getCardHolderCountry(): string
    {
        return $this->cardHolderCountry;
    }

    /**
     * Set the value of cardHolderCountry
     *
     * @return  void
     */
    public function setCardHolderCountry(string $cardHolderCountry): void
    {
        $this->cardHolderCountry = $cardHolderCountry;
    }

    /**
     * Get the value of cardHolderPhone
     */
    public function getCardHolderPhone(): string
    {
        return $this->cardHolderPhone;
    }

    /**
     * Set the value of cardHolderPhone
     *
     * @return  void
     */
    public function setCardHolderPhone(string $cardHolderPhone): void
    {
        $this->cardHolderPhone = $cardHolderPhone;
    }

    /**
     * Get the value of cardHolderEmail
     */
    public function getCardHolderEmail(): string
    {
        return $this->cardHolderEmail;
    }

    /**
     * Set the value of cardHolderEmail
     *
     * @return  void
     */
    public function setCardHolderEmail(string $cardHolderEmail): void
    {
        $this->cardHolderEmail = $cardHolderEmail;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
