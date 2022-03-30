<?php
namespace App\Services\Products\InsertProduct;

use App\Repository\Products\InsertProduct\InsertRepository;


class InsertService
{
    private InsertRepository $repository;

    public function __construct(InsertRepository $insertRepository)
    {
        $this->repository = $insertRepository;
    }

    public function execute(InsertRequest $request):void
    {
        $this->repository->insertProduct($request);
    }
}
