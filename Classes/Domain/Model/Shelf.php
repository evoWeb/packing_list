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

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Shelf extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ?FrontendUser $owner;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\PackingList\Domain\Model\Listitem>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $listItems;

    /**
     * Constructs a new Shelf
     *
     * @param FrontendUser|null $owner
     */
    public function __construct(?FrontendUser $owner = null)
    {
        $this->owner = $owner;
        $this->listItems = new ObjectStorage();
    }

    public function initializeObject()
    {
        $this->listItems = $this->listItems ?? new ObjectStorage();
    }

    /**
     * @return FrontendUser
     */
    public function getOwner(): ?FrontendUser
    {
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
