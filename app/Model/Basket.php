<?php

namespace App\Model;

class Basket
{
    private string $name;
    private int $count;
    private string $price;

    public function __construct(string $name, int $count, string $price)
    {
        $this->name = $name;
        $this->count = $count;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}