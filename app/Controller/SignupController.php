<?php
namespace App\Controller;

use App\Services\Signup\SignupUserRequest;
use App\Services\Signup\SignupUserService;
use App\View;
use App\Redirect;
use App\Validation\Errors;
use App\Validation\SignupValidation;
use App\Exceptions\SignupValidationException;
use Psr\Container\ContainerInterface;


class SignupController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function signUp():View
    {
        return new View('/Users/signup', [
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);
    }

    public function signUpUser():Redirect
    {
        try {
            $validator = (new SignupValidation($_POST));
            $validator->passes();
        } catch (SignupValidationException $exception) {
            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;
            return new Redirect("/signup");
        }


        $hashedPwd = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $service = $this->container->get(SignupUserService::class);
        $service->execute(new SignupUserRequest(
            $_POST['email'],
            $hashedPwd,
            $_POST['name'],
            $_POST['surname'],
            $_POST['birthday'],
        ));
        
        
        return new Redirect("/");
    }
}
