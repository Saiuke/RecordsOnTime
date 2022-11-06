<?php

namespace Shop;

use Shop\Products\ElectronicItem;

/**
 * Class Shop
 * @package Shop
 */
class ShopController
{
    private array $cart;
    private int $total;

    /**
     * @return array
     */
    public function getCart(): array
    {
        return $this->cart;
    }

    /**
     * Adds items to the shopping cart
     * @param array $productsToAdd
     */
    public function addItems(array $productsToAdd): void
    {
        foreach ($productsToAdd as $product) {
            if ($product instanceof ElectronicItem) {
                $this->cart[] = $product;
            }
        }
    }

    /**
     * Returns an array containing the cart's items, its extras, and its totals
     * @return array
     */
    public function checkout(): array
    {
        $this->sortCart();
        $this->getTotal();
        $cartReceipt = [];

        foreach ($this->cart as $item) {
            $cartReceipt[] = [
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'extras' => $this->processExtras($item),
                'subTotal' => $this->getSubTotal($item)
            ];
        }

        return $cartReceipt;
    }

    private function processExtras(ElectronicItem $item): array
    {
        $itemExtras = [];
        foreach ($item->getExtras() as $extra) {
            $itemExtras[] = ["name" => $extra->getName(), "price" => $extra->getPrice()];
        }

        return $itemExtras;
    }

    public function sortCart(): void
    {
        usort($this->cart, fn($a, $b) => $a->getTotal() <=> $b->getTotal());
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        if (!isset($this->total)) {
            $this->setTotal();
        }

        return $this->total;
    }

    private function getSubTotal(ElectronicItem $item): int
    {
        $subTotal = $item->getPrice();
        foreach ($item->getExtras() as $extra) {
            $subTotal += $extra->getPrice();
        }

        return $subTotal;
    }


    private function setTotal(): void
    {
        $this->total = 0;
        foreach ($this->cart as $item) {
            $this->total += $item->getPrice();

            foreach ($item->getExtras() as $extra) {
                $this->total += $extra->getPrice();
            }
        }
    }
}
