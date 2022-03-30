<?php
namespace App\Controller;


use App\Services\Products\Home\ProductRequest;
use App\Services\Products\Home\ProductService;
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

    public function home(array $productType):View
    {
        $service = $this->container->get(ProductService::class);
        $products = $service->execute(new ProductRequest(
            $productType['product']
        ));

        return new View("/Home/index", [
            "products"=>$products,
            'userName' => $_SESSION['name'],
            'userSurname' => $_SESSION['surname'],
            'userId' => $_SESSION['userid']
        ]);
    }
    public function addProduct():View
    {
        return new View("/Home/add");
    }
    public function insertProduct():Redirect
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
    public function redirect():Redirect{
        return new Redirect("/home/All");
    }
}
