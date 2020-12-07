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
    /**
     * @var string
     */
    protected string $name = '';

    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $owner;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\PackingList\Domain\Model\Category>
     */
    protected ObjectStorage $categories;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Evoweb\PackingList\Domain\Model\Listitem>
     */
    protected ObjectStorage $listItems;

    /**
     * Constructs a new Listing
     *
     * @param string $name
     * @param FrontendUser|null $owner
     */
    public function __construct(string $name = '', FrontendUser $owner = null)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->categories = new ObjectStorage();
        $this->listItems = new ObjectStorage();
    }

    public function initializeObject()
    {
        $this->categories = $this->categories ?? new ObjectStorage();
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
