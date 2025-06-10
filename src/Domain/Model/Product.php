<?php
class Product
{
    private int $id;

    private string $type;

    private string $name;

    private string $description;

    private string $image;

    private float $price;

    public function __construct(int $id, string $type, string $name, string $description, string $image, float $price)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }
}
