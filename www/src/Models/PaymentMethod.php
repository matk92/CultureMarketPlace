<?php

namespace App\Models;

use App\Core\DB;

class PaymentMethod extends DB
{
    private int $id;
    private int $idUser;
    private int $idPaymentMethodType;
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
     * Get the value of idUser
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  void
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * Get the value of idPaymentMethodType
     */
    public function getIdPaymentMethodType(): int
    {
        return $this->idPaymentMethodType;
    }

    /**
     * Set the value of idPaymentMethodType
     *
     * @return  void
     */
    public function setIdPaymentMethodType(int $idPaymentMethodType): void
    {
        $this->idPaymentMethodType = $idPaymentMethodType;
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
}
