<?php

namespace App\Repository\Wish;

use App\Services\Wish\WishRequest;

interface WishRepository
{
    public function addToBasket(WishRequest $request): void;
}