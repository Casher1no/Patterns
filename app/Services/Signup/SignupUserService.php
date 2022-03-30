<?php
namespace App\Services\Signup;

use App\Repository\Signup\PdoSignupRepository;
use App\Repository\Signup\SignupRepository;

class SignupUserService
{
    private SignupRepository $signupRepository;

    public function __construct()
    {
        $this->signupRepository = new PdoSignupRepository();
    }

    public function execute(SignupUserRequest $request)
    {
        $this->signupRepository->signUser($request);
    }
}
