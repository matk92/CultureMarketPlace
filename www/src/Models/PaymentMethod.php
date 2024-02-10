<?php

namespace App\Models;

use App\Core\DB;

class PaymentMethod extends DB
{

    protected int $id;
    protected ?int $userid = null;
    protected ?int $paymentmethodtypeid = null;
    protected string $cardnumber;
    protected string $expirationdate;
    protected string $securitycode;
    protected string $cardholdername;
    protected string $cardholderaddress;
    protected string $cardholderzipcode;
    protected string $cardholdercity;
    protected string $cardholdercountry;
    protected string $updated;

    private ?User $user = null;
    private ?PaymentMethodType $paymentMethodType = null;

    /**
     * Permet de faire le lien entre les objets
     * 
     * @return self
     */
    protected function populateRelations(): self
    {
        if (is_null($this->paymentMethodType) && !is_null($this->paymentmethodtypeid)) {
            $this->paymentMethodType = (new PaymentMethodType())->populate($this->paymentmethodtypeid);
        }
        if (is_null($this->user) && !is_null($this->userid)) {
            $this->user = (new User())->populate($this->userid);
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
     * Get the value of userid
     */
    public function getUserId(): int
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  void
     */
    public function setUserId(int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * Get the value of paymentmethodtypeid
     */
    public function getPaymentMethodTypeId(): int
    {
        return $this->paymentmethodtypeid;
    }

    /**
     * Set the value of paymentmethodtypeid
     *
     * @return  void
     */
    public function setPaymentMethodTypeId(int $paymentmethodtypeid): void
    {
        $this->paymentmethodtypeid = $paymentmethodtypeid;
    }

    /**
     * Get the value of cardnumber
     */
    public function getCardNumber(): string
    {
        return trim(preg_replace('/(.{4})/', '$1 ', $this->cardnumber));
    }

    /**
     * Set the value of cardnumber
     *
     * @return  void
     */
    public function setCardNumber(string $cardnumber): void
    {
        $this->cardnumber = str_replace(" ", "", $cardnumber);
    }

    /**
     * Get the value of expirationdate
     */
    public function getExpirationDate(): string
    {
        return $this->expirationdate;
    }

    /**
     * Set the value of expirationdate
     *
     * @return  void
     */
    public function setExpirationDate(string $expirationdate): void
    {
        $this->expirationdate = $expirationdate;
    }

    /**
     * Get the value of securitycode
     */
    public function getSecurityCode(): string
    {
        return $this->securitycode;
    }

    /**
     * Set the value of securitycode
     *
     * @return  void
     */
    public function setSecurityCode(string $securitycode): void
    {
        $this->securitycode = $securitycode;
    }

    /**
     * Get the value of cardholdername
     */
    public function getCardHolderName(): string
    {
        return $this->cardholdername;
    }

    /**
     * Set the value of cardholdername
     *
     * @return  void
     */
    public function setCardHolderName(string $cardholdername): void
    {
        $this->cardholdername = $cardholdername;
    }

    /**
     * Get the value of cardholderaddress
     */
    public function getCardHolderAddress(): string
    {
        return $this->cardholderaddress;
    }

    /**
     * Set the value of cardholderaddress
     *
     * @return  void
     */
    public function setCardHolderAddress(string $cardholderaddress): void
    {
        $this->cardholderaddress = $cardholderaddress;
    }

    /**
     * Get the value of cardholderzipcode
     */
    public function getCardHolderZipCode(): string
    {
        return $this->cardholderzipcode;
    }

    /**
     * Set the value of cardholderzipcode
     *
     * @return  void
     */
    public function setCardHolderZipCode(string $cardholderzipcode): void
    {
        $this->cardholderzipcode = $cardholderzipcode;
    }

    /**
     * Get the value of cardholdercity
     */
    public function getCardHolderCity(): string
    {
        return $this->cardholdercity;
    }

    /**
     * Set the value of cardholdercity
     *
     * @return  void
     */
    public function setCardHolderCity(string $cardholdercity): void
    {
        $this->cardholdercity = $cardholdercity;
    }

    /**
     * Get the value of cardholdercountry
     */
    public function getCardHolderCountry(): string
    {
        return $this->cardholdercountry;
    }

    /**
     * Set the value of cardholdercountry
     *
     * @return  void
     */
    public function setCardHolderCountry(string $cardholdercountry): void
    {
        $this->cardholdercountry = $cardholdercountry;
    }

    /**
     * Get the value of updated
     */
    public function getUpdatedAt(): string
    {
        return $this->updated;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getPaymentMethodType(): ?PaymentMethodType
    {
        return $this->paymentMethodType;
    }
}
