<?php

namespace App\Models;

use App\Core\DB;
use DateTime;

class Review extends DB
{
    private int $id;
    private int $idUser;
    private int $idProduct;
    private DateTime $date;
    private string $comment;
    private int $rating;
    private bool $isApproved;

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
     * Get the value of idProduct
     */
    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    /**
     * Set the value of idProduct
     *
     * @return  void
     */
    public function setIdProduct(int $idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    /**
     * Get the value of date
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  void
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
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

}
