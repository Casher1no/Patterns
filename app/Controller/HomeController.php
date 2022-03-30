<?php

namespace App\Controller;


use App\Services\Basket\BasketRequest;
use App\Services\Basket\BasketService;
use App\Services\Products\Home\ProductRequest;
use App\Services\Products\Home\ProductService;
use App\Services\Wish\WishRequest;
use App\Services\Wish\WishService;
use App\View;
use App\Redirect;
use App\Services\Products\InsertProduct\InsertRequest;
use App\Services\Products\InsertProduct\InsertService;
use Psr\Container\ContainerInterface;

class HomeController
{

    private ContainerInterface $container;

    public function __construct(ContainerInterface $productService)
    {
        $this->container = $productService;
    }

    public function home(array $productType): View
    {
        $service = $this->container->get(ProductService::class);
        $products = $service->execute(new ProductRequest(
            $productType['product']
        ));

        return new View("/Home/index", [
            "products" => $products,
            'userName' => $_SESSION['name'],
            'userSurname' => $_SESSION['surname'],
            'userId' => $_SESSION['userid']
        ]);
    }

    public function addProduct(): View
    {
        return new View("/Home/add");
    }

    public function insertProduct(): Redirect
    {
        $service = $this->container->get(InsertService::class);
        $service->execute(new InsertRequest(
            $_POST["product"],
            $_POST["price"],
            $_POST["count"],
            $_POST["flexRadioDefault"]
        ));
        return new Redirect("/");
    }

    public function wish(array $vars): Redirect
    {

        $service = $this->container->get(WishService::class);
        $service->execute(new WishRequest(
            (int)$vars['id'],
            (int)$_SESSION['userid'],
            (int)$_POST['count'],

        ));

        return new Redirect("/");
    }

    public function basket(): View
    {

        $service = $this->container->get(BasketService::class);
        $basket = $service->execute(new BasketRequest(
            $_SESSION['userid']
        ));

        return new View("/Home/basket", [
            "baskets"=>$basket
        ]);
    }

    public function redirect(): Redirect
    {
        return new Redirect("/home/All");
    }
}
