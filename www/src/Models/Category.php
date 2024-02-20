<?php

namespace App\Models;

use App\Core\DB;

class Category extends DB
{
    protected int $id;
    protected string $name;
    protected int $amount;
    protected string $unit;
    protected bool $isdeleted;

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
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  void
     */
    public function setName(string $name): void
    {
        $name = strip_tags(ucwords(strtolower(trim($name))));
        $this->name = $name;
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
     * Get the value of unit
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set the value of unit
     *
     * @return  void
     */
    public function setUnit(string $unit): void
    {
        $unit = strip_tags(ucfirst(strtolower(trim($unit))));
        $this->unit = $unit;
    }

    /**
     * Get the value of isdeleted
     */
    public function getIsdeleted(): bool
    {
        return $this->isdeleted;
    }

    /**
     * Set the value of isdeleted
     *
     * @return  void
     */
    public function setIsdeleted(bool $isdeleted): void
    {
        $this->isdeleted = $isdeleted;
    }
}
