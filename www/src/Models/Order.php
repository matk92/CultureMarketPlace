<?php

namespace App\Models;

use App\Core\DB;

class Order extends DB
{
    protected int $id;
    protected int $userid;
    protected int $status;
    protected string $updated;

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
     * Get the value of status
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Get the value of updated
     */
    public function getUpdatedAt(): string
    {
        return $this->updated;
    }
}
