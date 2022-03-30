<?php

namespace App\Repository\Wish;

use App\Database;
use App\Services\Wish\WishRequest;

class PdoWishRepository implements WishRepository
{
    public function addToBasket(WishRequest $request): void
    {
        Database::connection()->insert('user_basket', [
            "user_id" => $request->getUserId(),
            "count"=> $request->getCount(),
            "product_id"=> $request->getProductId()
        ]);
    }
}