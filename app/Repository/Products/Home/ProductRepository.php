<?php
namespace App\Repository\Products\Home;

interface ProductRepository
{
    public function productsQuery(string $type):array;
}
