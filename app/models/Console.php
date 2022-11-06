<?php

namespace Shop\Products;

use ElectronicItemType;

/**
 * Class Console
 */
final class Console extends ElectronicItem
{
    public function __construct(string $name, string $description, int $price, array $extras)
    {
        parent::__construct(ElectronicItemType::Console, $name, $description, $price, $extras);
        $this->setMaxExtras(1);
    }
}
