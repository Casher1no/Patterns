<?php
namespace App\Services\Products\Home;

use App\Model\Product;
use App\Repository\Products\Home\ProductRepository;

class ProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function execute(ProductRequest $request):array
    {

        $productsQuery = $this->repository->productsQuery($request->getType());

        $products=[];

        foreach ($productsQuery as $product) {
            $products[] = new Product(
                $product['id'],
                $product['name'],
                $product['price'],
                $product['count'],
                $product['created_at'],
                $product['type']
            );
        }

        return $products;
    }
}
