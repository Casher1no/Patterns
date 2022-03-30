<?php
namespace App\Repository\Login;

interface LoginRepository
{
    public function findUser(string $email):array;
    public function userProfile(int $userId):array;
}
