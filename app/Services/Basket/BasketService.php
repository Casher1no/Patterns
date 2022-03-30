<?php

namespace App\Services\Basket;


use App\Database;
use App\Model\Basket;
use App\Repository\Basket\BasketRepository;

class BasketService
{

    private BasketRepository $repository;

    public function __construct(BasketRepository $Repository)
    {
        $this->repository = $Repository;
    }

    public function execute(BasketRequest $request): array
    {
        $items = $this->repository->basket($request);

        $basket = [];
        foreach ($items as $item){
            $info = $this->repository->productInfo($item['product_id']);
            $basket[] = new Basket(
                $info[0]['name'],
                $item['count'],
                $info[0]['price'],
            );
        }
        return $basket;
    }

}