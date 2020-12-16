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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Category extends AbstractEntity
{
    protected string $name = '';

    /**
     * @var Listing
     * @Lazy
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
     * @return ObjectStorage
     */
    public function getListItems(): ObjectStorage
    {
        return $this->listItems;
    }

    /**
     * @param ObjectStorage $listItems
     */
    public function setListItems(ObjectStorage $listItems)
    {
        $this->listItems = $listItems;
    }

    /**
     * @param Listitem $listItems
     */
    public function addListItem(Listitem $listItems)
    {
        $this->listItems->attach($listItems);
    }

    /**
     * @param Listitem $listItems
     */
    public function removeListItem(Listitem $listItems)
    {
        $this->listItems->detach($listItems);
    }
}
