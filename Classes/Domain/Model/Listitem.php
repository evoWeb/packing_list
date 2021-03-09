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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

class Listitem extends AbstractEntity
{
    protected string $name = '';

    /**
     * @var Listing
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $listing;

    /**
     * @var Category
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $category;

    /**
     * @var Shelf
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getListing(): ?Listing
    {
        if ($this->listing instanceof LazyLoadingProxy) {
            $this->listing = $this->listing->_loadRealInstance();
        }
        return $this->listing;
    }

    public function setListing(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function getCategory(): ?Category
    {
        if ($this->category instanceof LazyLoadingProxy) {
            $this->category = $this->category->_loadRealInstance();
        }
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    public function getShelf(): ?Shelf
    {
        if ($this->shelf instanceof LazyLoadingProxy) {
            $this->shelf = $this->shelf->_loadRealInstance();
        }
        return $this->shelf;
    }

    public function setShelf(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit)
    {
        $this->unit = $unit;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function isWorn(): bool
    {
        return $this->worn;
    }

    public function setWorn(bool $worn)
    {
        $this->worn = $worn;
    }

    public function isConsumable(): bool
    {
        return $this->consumable;
    }

    public function setConsumable(bool $consumable)
    {
        $this->consumable = $consumable;
    }
}
