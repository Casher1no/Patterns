<?php
namespace App\Model;

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private int $count;
    private string $createdAt;
    private string $type;

    public function __construct(int $id, string $name, float $price, int $count, string $createdAt, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
        $this->createdAt = $createdAt;
        $this->type = $type;
    }
    public function getId():int
    {
        return $this->id;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function getPrice():float
    {
        return $this->price;
    }
    public function getCount():int
    {
        return $this->count;
    }
    public function getCreatedAt():string
    {
        return $this->createdAt;
    }
    public function getType(): string
    {
        return $this->type;
    }
}
