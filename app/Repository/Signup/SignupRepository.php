<?php
namespace App\Repository\Signup;

use App\Services\Signup\SignupUserRequest;

interface SignupRepository
{
    public function signUser(SignupUserRequest $request):void;
}
