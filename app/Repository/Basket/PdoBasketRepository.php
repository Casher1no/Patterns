<?php

namespace App\Repository\Basket;

use App\Database;
use App\Services\Basket\BasketRequest;

class PdoBasketRepository implements BasketRepository
{
    public function basket(BasketRequest $request): array
    {

        $basket = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_basket')
            ->where("user_id = ?")
            ->setParameter(0, $request->getUserId())
            ->fetchAllAssociative();

        return $basket;
    }

    public function productInfo(int $productId): array
    {
        $info = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->where("id = ?")
            ->setParameter(0, $productId)
            ->fetchAllAssociative();

        return $info;
    }
}