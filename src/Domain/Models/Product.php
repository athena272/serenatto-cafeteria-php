<?php

namespace Athena272\SerenattoCafeteria\Domain\Models;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function getFormattedPrice(): string
    {
        return "R$ " . number_format($this->price, 2);
    }

    public function getImagePath(): string
    {
        return "img/" . $this->image;
    }
}