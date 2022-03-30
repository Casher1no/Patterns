<?php
namespace App\Repository\Products\InsertProduct;

use App\Services\Products\InsertProduct\InsertRequest;

interface InsertRepository
{
    public function insertProduct(InsertRequest $request):void;
}
