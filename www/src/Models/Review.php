<?php

namespace App\Models;

use App\Core\DB;

class Review extends DB
{
    protected int $id;
    protected int $userid;
    protected int $productid;
    protected string $comment;
    protected int $rating;
    protected ?bool $isapproved;
    protected ?string $updated;

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
     * Get the value of userid
     */
    public function getUserID(): int
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
     * Get the value of productid
     */
    public function getProductId(): int
    {
        return $this->productid;
    }

    /**
     * Set the value of productid
     *
     * @return  void
     */
    public function setProductId(int $productid): void
    {
        $this->productid = $productid;
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
        $this->comment = strip_tags(trim($comment));
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
     * Get the value of isapproved
     */
    public function getIsApproved(): bool
    {

        return $this->isapproved;
    }

    /**
     * Set the value of isapproved
     *
     * @return  void
     */
    public function setIsApproved(bool $isapproved): void
    {
        var_dump($isapproved);
        $this->isapproved = $isapproved;
    }

    /**
     * Get the value of updated
     */
    public function getUpdatedAt(): string
    {
        return $this->updated;
    }
}
