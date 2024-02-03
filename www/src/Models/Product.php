<?php

namespace App\Models;

use App\Core\DB;

class Product extends DB
{
    protected int $id;
    protected string $name;
    protected string $image;
    protected string $description;
    protected float $price;
    protected int $stock;
    protected int $categoryid;
    protected string $updated;
    protected float $rating;

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
     * Get the value of categoryid
     */
    public function getCategoryId(): int
    {
        return $this->categoryid;
    }

    /**
     * Set the value of categoryid
     *
     * @return  void
     */
    public function setCategoryId(int $categoryid): void
    {
        $this->categoryid = $categoryid;
    }

    /**
     * Get the value of updated
     */
    public function getUpdatedAt(): string
    {
        return $this->updated;
    }

    /**
     * Get the value of rating
     * 
     * @return  int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     * 
     * @return  void
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }
}
