<?php

namespace App\Services\Products\InsertProduct;

class InsertRequest
{
    private string $name;
    private float $price;
    private int $count;
    private string $type;

    public function __construct(string $name, float $price, int $count, string $type)
    {
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
