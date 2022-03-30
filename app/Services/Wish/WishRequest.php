<?php

namespace App\Services\Wish;

class WishRequest
{


    private int $productId;
    private int $userId;
    private int $count;

    public function __construct(int $productId, int $userId, int $count)
    {
        $this->productId = $productId;
        $this->userId = $userId;
        $this->count = $count;
    }
    

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}