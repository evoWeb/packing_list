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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Category extends AbstractEntity
{
    protected string $name = '';

    /**
     * @var Listing
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $listing;

    /**
     * @var ObjectStorage<Listitem>
     * @Lazy
     */
    protected ObjectStorage $listItems;

    public function initializeObject()
    {
        $this->listItems = $this->listItems ?? new ObjectStorage();
    }

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

    public function getListItems(): ObjectStorage
    {
        return $this->listItems;
    }

    public function setListItems(ObjectStorage $listItems)
    {
        $this->listItems = $listItems;
    }

    public function addListItem(Listitem $listItem)
    {
        $this->listItems->attach($listItem);
    }

    public function removeListItem(Listitem $listItem)
    {
        $this->listItems->detach($listItem);
    }
}
