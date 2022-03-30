<?php
namespace App\Repository\Products\InsertProduct;

use App\Database;
use App\Services\Products\InsertProduct\InsertRequest;

class PdoInsertRepository implements InsertRepository
{
    public function insertProduct(InsertRequest $request):void
    {
        Database::connection()->insert('products', [
            "name"=>$request->getName(),
            "price"=>$request->getPrice(),
            "count"=>$request->getCount(),
            "type"=>$request->getType()
        ]);
    }
}
