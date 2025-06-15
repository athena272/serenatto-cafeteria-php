<?php

namespace Athena272\SerenattoCafeteria\Infrastructure\Repository;

use PDO;
use Athena272\SerenattoCafeteria\Domain\Repository\ProductRepositoryInterface;
use Athena272\SerenattoCafeteria\Domain\Models\Product;

class PdoProductRepository implements ProductRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function fetchProductsByCategory(string $category): array
    {
        $statement = $this->connection->prepare('SELECT id, type, name, description, price, image FROM products WHERE type = :category ORDER BY price');
        $statement->bindValue(':category', $category);
        $statement->execute();

        $products = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['type'],
                $row['name'],
                $row['description'],
                $row['image'],
                $row['price'],
            );
        }

        return $products;
    }

    public function fetchAllProducts(): array
    {
        $statement = $this->connection->query('SELECT id, type, name, description, price, image FROM products ORDER BY price');
        $products = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['type'],
                $row['name'],
                $row['description'],
                $row['image'],
                $row['price']
            );
        }

        return $products;
    }
}