<?php


namespace Athena272\SerenattoCafeteria\Domain\Repository;

use Athena272\SerenattoCafeteria\Domain\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * Returns all products from a given category.
     *
     * @param string $category
     * @return Product[]
     */
    public function fetchProductsByCategory(string $category): array;
}
