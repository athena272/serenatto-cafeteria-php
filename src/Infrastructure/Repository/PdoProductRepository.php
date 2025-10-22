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
        $sql = "SELECT id, type, name, description, price, image FROM products WHERE type = :category ORDER BY price";
        $statement = $this->connection->prepare($sql);
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
        $sql = "SELECT id, type, name, description, price, image FROM products ORDER BY price";
        $statement = $this->connection->query($sql);
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

    public function deleteProductById(int $id): void
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function insertProduct(Product $product): void
    {
        $sql = "INSERT INTO products (type, name, description, price, image) VALUES (:type, :name, :description, :price, :image)";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':type', $product->getType());
        $statement->bindValue(':name', $product->getName());
        $statement->bindValue(':description', $product->getDescription());
        $statement->bindValue(':price', $product->getPrice());
        $statement->bindValue(':image', $product->getImage());
        $statement->execute();
    }

    public function fetchProductById(int $id): ?Product
    {
        $sql = "SELECT id, type, name, description, price, image FROM products WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Product(
            $row['id'],
            $row['type'],
            $row['name'],
            $row['description'],
            $row['image'],
            $row['price']
        );
    }

    public function updateProduct(Product $product): void
    {
        $sql = "UPDATE products SET type = :type, name = :name, description = :description, price = :price, image = :image WHERE id = :id";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':type', $product->getType());
        $statement->bindValue(':name', $product->getName());
        $statement->bindValue(':description', $product->getDescription());
        $statement->bindValue(':price', $product->getPrice());
        $statement->bindValue(':image', $product->getImage());
        $statement->bindValue(':id', $product->getId(), PDO::PARAM_INT);
        $statement->execute();
    }
}