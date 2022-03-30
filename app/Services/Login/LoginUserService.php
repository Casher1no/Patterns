<?php
namespace App\Services\Login;


use App\Repository\Login\LoginRepository;
use App\Repository\Login\PdoLoginRepository;

class LoginUserService
{
    private LoginRepository $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new PdoLoginRepository();
    }

    public function execute(LoginUserRequest $request):void
    {
        $user = $this->loginRepository->findUser($request->getEmail());
        $userProfile = $this->loginRepository->userProfile($user[0]['id']);
                
        session_start();
        $_SESSION["userid"] = htmlentities($user[0]["id"]);
        $_SESSION["name"] = htmlentities($userProfile[0]["name"]);
        $_SESSION["surname"] = htmlentities($userProfile[0]["surname"]);
    }
}
