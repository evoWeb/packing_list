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
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Shelf extends AbstractEntity
{
    /**
     * @var FrontendUser
     * @Lazy
     */
    protected $owner;

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
     * @return FrontendUser
     */
    public function getOwner(): ?FrontendUser
    {
        if ($this->owner instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
            $this->owner = $this->owner->_loadRealInstance();
        }
        return $this->owner;
    }

    /**
     * @param FrontendUser $owner
     */
    public function setOwner(FrontendUser $owner)
    {
        $this->owner = $owner;
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
