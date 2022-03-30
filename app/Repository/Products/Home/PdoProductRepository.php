<?php

namespace App\Repository\Products\Home;

use App\Database;

class PdoProductRepository implements ProductRepository
{
    public function productsQuery(string $type): array
    {
        if ($type == "All") {
            $productsQuery = Database::connection()
                ->createQueryBuilder()
                ->select('*')
                ->from('products')
                ->orderBy('created_at', 'desc')
                ->fetchAllAssociative();
        } else {
            $productsQuery = Database::connection()
                ->createQueryBuilder()
                ->select('*')
                ->from('products')
                ->where("type = ?")
                ->setParameter(0, $type)
                ->orderBy('created_at', 'desc')
                ->fetchAllAssociative();
        }

        return $productsQuery;
    }
}
