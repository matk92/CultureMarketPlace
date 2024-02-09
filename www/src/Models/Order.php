<?php

namespace App\Models;

use App\Core\DB;
use DateTime;

class Order extends DB
{
    protected int $id;
    protected int $userid;
    protected int $status;
    protected ?string $updated;
    protected array $orderSlots = [];

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

    public function getOrderSlots(): array
    {
        return $this->orderSlots;
    }

    public function addOrderSlot(Product $product, int $quantity): OrderSlot
    {
        $newOrderSlot = (new OrderSlot());
        $newOrderSlot->setOrderId($this->getId());
        $newOrderSlot->setProductId($product->getId());
        $newOrderSlot->setQuantity($quantity);
        $newOrderSlot->save();

        $this->orderSlots[] = $newOrderSlot;
        $this->updated = (new DateTime())->format('Y-m-d H:i:s');
        $this->save();
        return $newOrderSlot;
    }

    public function removeOrderSlot(OrderSlot $orderSlot): void
    {
        $this->orderSlots = array_filter($this->orderSlots, function ($slot) use ($orderSlot) {
            return $slot->getId() !== $orderSlot->getId();
        });
        $orderSlot->delete(true);
    }
}
