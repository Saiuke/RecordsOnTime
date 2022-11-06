<?php

namespace Shop\Products;

/**
 * Class Controller
 * @package Shop\Products
 */
final class WiredController extends Controller
{
    public function __construct(string $name, string $description, int $price)
    {
        parent::__construct($name, $description, $price, true);
    }
}
