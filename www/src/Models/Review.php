<?php

namespace App\Models;

use App\Core\DB;

class Review extends DB
{
    private int $id;
    private int $userId;
    private int $productId;
    private string $comment;
    private int $rating;
    private bool $isApproved;
    private string $updatedAt;

    // Permets a la class DB de recuperer les attributs
    protected function getAttributes(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
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
    public function getUserID(): int
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
     * Get the value of productId
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  void
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * Get the value of comment
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  void
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * Get the value of rating
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

    /**
     * Get the value of isApproved
     */
    public function getIsApproved(): bool
    {
        return $this->isApproved;
    }

    /**
     * Set the value of isApproved
     *
     * @return  void
     */
    public function setIsApproved(bool $isApproved): void
    {
        $this->isApproved = $isApproved;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
