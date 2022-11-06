<?php

namespace Shop\Products;

use ElectronicItemType;

/**
 * Class Microwave
 * @package Shop\Products
 */
final class Microwave extends ElectronicItem
{
    public function __construct(string $name, string $description, int $price)
    {
        parent::__construct(ElectronicItemType::Microwave, $name, $description, $price);
        $this->setMaxExtras(0);
    }
}
