<?php

namespace Shop\Products;

/**
 * Class Controller
 * @package Shop\Products
 */
class WiredController extends Controller
{
    public function __construct(string $name, string $description, int $price)
    {
        parent::__construct("Wired Control", $description, $price, true);
    }
}
