<?php
namespace App\Controller;

use App\View;
use App\Redirect;
use App\Validation\Errors;
use App\Validation\LoginValidation;
use App\Services\Login\LoginUserRequest;
use App\Services\Login\LoginUserService;
use App\Exceptions\LoginValidationException;
use Psr\Container\ContainerInterface;

class LoginController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function login():View
    {
        return new View('/Users/login', [
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);
    }

    public function loginUser():Redirect
    {
        try {
            $validator = (new LoginValidation($_POST));
            $validator->passes();
        } catch (loginValidationException $exception) {
            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;
            return new Redirect("/login");
        }

        $service = $this->container->get(LoginUserService::class);
        $service->execute(new LoginUserRequest(
            $_POST['email']
        ));



        return new Redirect("/");
    }
}