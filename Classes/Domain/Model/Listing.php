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

class Listing extends AbstractEntity
{
    protected string $name = '';

    protected bool $public = false;

    protected bool $shared = false;

    /**
     * @var FrontendUser
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $owner;

    /**
     * @var ObjectStorage<Category>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $categories;

    /**
     * @var ObjectStorage<Listitem>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected ObjectStorage $listItems;

    public function initializeObject()
    {
        $this->categories = $this->categories ?? new ObjectStorage();
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

    public function getPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }

    public function getShared(): bool
    {
        return $this->shared;
    }

    public function setShared(bool $shared): void
    {
        $this->shared = $shared;
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
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * @param ObjectStorage $categories
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * @param Category $category
     */
    public function removeCategory(Category $category)
    {
        $this->categories->detach($category);
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
