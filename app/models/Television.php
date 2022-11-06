<?php

namespace Shop\Products;

use ElectronicItemType;

/**
 * Class Television
 * @package Shop\Products
 */
final class Television extends ElectronicItem
{
    public function __construct(string $name, string $description, int $price, array $extras)
    {
        parent::__construct(ElectronicItemType::Television, $name, $description, $price, $extras);
        $this->setMaxExtras(PHP_INT_MAX);
    }
}
