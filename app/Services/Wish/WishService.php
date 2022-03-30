<?php

namespace App\Services\Wish;

use App\Repository\Wish\WishRepository;

class WishService
{

    private WishRepository $repository;

    public function __construct(WishRepository $Repository)
    {
        $this->repository = $Repository;
    }

    public function execute(WishRequest $request): void
    {
        $this->repository->addToBasket($request);
    }
}