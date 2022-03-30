<?php

require 'vendor/autoload.php';

session_start();

use App\Controller\LoginController;
use App\Controller\LogoutController;
use App\Controller\SignupController;
use App\Repository\Login\LoginRepository;
use App\Repository\Login\PdoLoginRepository;
use App\Repository\Products\InsertProduct\InsertRepository;
use App\Repository\Products\InsertProduct\PdoInsertRepository;
use App\Repository\Signup\PdoSignupRepository;
use App\Repository\Signup\SignupRepository;
use App\View;
use App\Redirect;
use App\Controller\HomeController;
use App\Repository\Products\Home\ProductRepository;
use App\Repository\Products\Home\PdoProductRepository;


$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    //HomeController
    ProductRepository::class => DI\create(PdoProductRepository::class),
    InsertRepository::class => DI\create(PdoInsertRepository::class),

    //LoginController
    LoginRepository::class => DI\create(PdoLoginRepository::class),

    //SignupController
    SignupRepository::class => DI\create(PdoSignupRepository::class),
]);
$container = $builder->build();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // Home page
    $r->addRoute('GET', '/', [HomeController::class, 'redirect']);
    $r->addRoute('GET', '/home/{product}', [HomeController::class, 'home']);
    $r->addRoute('GET', '/add', [HomeController::class, 'addProduct']);
    $r->addRoute('POST', '/add', [HomeController::class, 'insertProduct']);

    //Login
    $r->addRoute('GET', '/login', [LoginController::class, 'login']);
    $r->addRoute('POST', '/login', [LoginController::class, 'loginUser']);

    // Sign up
    $r->addRoute('GET', '/signup', [SignupController::class, 'signUp']);
    $r->addRoute('POST', '/signup', [SignupController::class, 'signUpUser']);

    // Logout
    $r->addRoute('GET', '/logout', [LogoutController::class, 'logout']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "404 Not Found";
        break;
        if ($response instanceof Redirect) {
            header("Location: " . $response->getPath());
            exit;
        }
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo "405 Method Not Allowed";

        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];

        $response = ($container->get($controller))->$method($routeInfo[2]);

        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('app/View'));

        if ($response instanceof View) {
            echo $twig->render($response->getPath() . ".html", $response->getVariables());
        }
        if ($response instanceof Redirect) {
            header("Location: " . $response->getPath());
            exit;
        }
        break;
}
