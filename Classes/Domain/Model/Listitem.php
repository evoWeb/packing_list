<?php

declare(strict_types=1);

namespace Evoweb\PackingList\Domain\Model;

/*
 * This file is developed by evoWeb.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Listitem extends AbstractEntity
{
    protected string $name = '';

    /**
     * @var Listing
     * @Lazy
     */
    protected $listing;

    /**
     * @var Category
     * @Lazy
     */
    protected $category;

    /**
     * @var Shelf
     * @Lazy
     */
    protected $shelf;

    protected string $description = '';

    protected string $url = '';

    protected float $weight = 0.0;

    protected string $unit = 'g';

    protected int $quantity = 0;

    protected float $price = 0.0;

    protected bool $worn = false;

    protected bool $consumable = false;

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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Listing
     */
    public function getListing(): ?Listing
    {
        if ($this->listing instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
            $this->listing = $this->listing->_loadRealInstance();
        }
        return $this->listing;
    }

    /**
     * @param Listing $listing
     */
    public function setListing(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        if ($this->category instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
            $this->category = $this->category->_loadRealInstance();
        }
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Shelf
     */
    public function getShelf(): ?Shelf
    {
        if ($this->shelf instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
            $this->shelf = $this->shelf->_loadRealInstance();
        }
        return $this->shelf;
    }

    /**
     * @param Shelf $shelf
     */
    public function setShelf(Shelf $shelf)
    {
        $this->shelf = $shelf;
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
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isWorn(): bool
    {
        return $this->worn;
    }

    /**
     * @param bool $worn
     */
    public function setWorn(bool $worn)
    {
        $this->worn = $worn;
    }

    /**
     * @return bool
     */
    public function isConsumable(): bool
    {
        return $this->consumable;
    }

    /**
     * @param bool $consumable
     */
    public function setConsumable(bool $consumable)
    {
        $this->consumable = $consumable;
    }
}
