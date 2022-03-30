<?php

namespace App\Repository\Basket;

use App\Services\Basket\BasketRequest;

interface BasketRepository
{
    public function basket(BasketRequest $request):array;
    public function productInfo(int $productId): array;
}