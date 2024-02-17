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
    protected ?int $categoryid = null;
    protected bool $isdeleted;
    protected ?string $updated;
    protected float $rating;

    private ?Category $category = null;

     /**
     * Permet de faire le lien entre les objets
     * 
     * @return self
     */
    protected function populateRelations(): self
    {
        if (is_null($this->category) && !is_null($this->categoryid)) {
            $this->category = (new Category())->populate($this->categoryid);
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
    public function getCategoryid(): int
    {
        return $this->categoryid;
    }

    /**
     * Get the value of category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Set the value of categoryid
     *
     * @return  void
     */
    public function setCategoryid(int $categoryid): void
    {
        $this->categoryid = $categoryid;
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
