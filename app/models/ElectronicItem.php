<?php

namespace Shop\Products;

use ElectronicItemType;

/**
 * Class ElectronicItem
 * @package Shop\Categories
 */
abstract class ElectronicItem
{
    private int $id;
    private string $name;
    private ElectronicItemType $type;
    private string $description;
    private int $price;
    private array $extras;
    private int $maxExtras;

    /**
     * ElectronicItem constructor.
     * @param ElectronicItemType $type
     * @param string $name
     * @param string $description
     * @param int $price
     * @param array $extras
     */
    public function __construct(ElectronicItemType $type, string $name, string $description, int $price, array $extras = array())
    {
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->extras = $extras;
    }

    /**
     * @return int
     */
    public function getMaxExtras(): int
    {
        return $this->maxExtras;
    }

    /**
     * @param int $maxExtras
     */
    public function setMaxExtras(int $maxExtras): void
    {
        $this->maxExtras = $maxExtras;
    }

    /**
     * Add an extra to the current item
     * @param array $extrasToAdd
     * @return void
     */
    public function addExtras(array $extrasToAdd): void
    {
        if (!$this->canAddExtras(count($extrasToAdd))) {
            return;
        }

        foreach ($extrasToAdd as $extra) {
            if ($extra instanceof ElectronicItem) {
                $this->extras[] = $extra;
            }
        }
    }

    /**
     * Returns true if is possible to add extras, otherwise returns false
     * @param int $quantity
     * @return bool
     */
    private function canAddExtras(int $quantity): bool
    {
        if ((count($this->extras) + $quantity) > $this->maxExtras) {
            return false;
        }
        return true;
    }

    /**
     * Removes an extra associated with the current object
     * @param string $extraId
     * @return void
     */
    public function removeExtraById(string $extraId): void
    {
        $this->extras = array_filter($this->extras, function ($extra) use ($extraId) {
            return $extra->id == $extraId ? $extra : false;
        });
    }

    /**
     * Returns true if the object has any extras, otherwise returns false
     * @return bool
     */
    public function hasExtras(): bool
    {
        return !empty($this->extras);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ElectronicItemType
     */
    public function getType(): ElectronicItemType
    {
        return $this->type;
    }

    /**
     * @param ElectronicItemType $type
     */
    public function setType(ElectronicItemType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @param array $extras
     */
    public function setExtras(array $extras): void
    {
        $this->extras = $extras;
    }

    public function printExtras(): void
    {
        foreach ($this->extras as $extra) {
            $extra->print();
        }
    }

    /**
     * Returns the sum of the price of all extras
     * @return int
     */
    private function getTotalExtras(): int
    {
        $currentExtras = $this->extras;
        $totalExtras = 0;

        foreach ($currentExtras as $extra) {
            $totalExtras += $extra->getPrice();
        }

        return $totalExtras;
    }

    /**
     * Returns the total value of the product, including the extras
     * @return int
     */
    public function getTotal(): int
    {
        return $this->getPrice() + $this->getTotalExtras();
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price ?? 0;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
