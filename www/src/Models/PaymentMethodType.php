<?php

namespace App\Models;

use App\Core\DB;

class PaymentMethodType extends DB
{
    protected int $id;
    protected string $name;
    protected string $description;

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
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     * 
     * @return  void
     */
    public function setDescription(string $description): void
    {
        $description = strip_tags(ucfirst(strtolower(trim($description))));
        $this->description = $description;
    }
}
