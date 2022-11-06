<?php

namespace Shop\Products;

/**
 * Class Controller
 * @package Shop\Products
 */
class RemoteController extends Controller
{
    public function __construct(string $name, string $description, int $price)
    {
        parent::__construct($name, $description, $price, false);
    }
}
