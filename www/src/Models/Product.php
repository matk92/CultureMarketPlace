<?php

namespace App\Models;

use App\Core\DB;

class Product extends DB
{
    private int $id;
    private string $name;
    private string $image;
    private string $description;
    private float $price;
    private int $stock;
    private int $idCategory;

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
        $name = ucwords(strtolower(trim($name)));
        $this->name = $name;
    }

    /**
     * Get the value of image
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  void
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
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
        $description = ucfirst(strtolower(trim($description)));
        $this->description = $description;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Get the value of stock
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  void
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * Get the value of idCategory
     */
    public function getIdCategory(): int
    {
        return $this->idCategory;
    }

    /**
     * Set the value of idCategory
     *
     * @return  void
     */
    public function setIdCategory(int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }
}
