<?php

namespace Shop\Products;

use ElectronicItemType;

/**
 * Class Controller
 * @package Shop\Products
 */
abstract class Controller extends ElectronicItem
{
    private bool $isWired;

    public function __construct(string $name, string $description, string $price, bool $isWired)
    {
        parent::__construct(ElectronicItemType::Controller, $name, $description, $price, []);
        $this->setIsWired($isWired);
        $this->setMaxExtras(0);
    }

    private function setIsWired(bool $isWired) {
        $this->isWired = $isWired;
    }

    public function getIsWired(): bool {
        return $this->isWired;
    }
}
