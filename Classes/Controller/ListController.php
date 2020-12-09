<?php

declare(strict_types=1);

namespace Evoweb\PackingList\Controller;

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

use Evoweb\PackingList\Domain\Model\Listing;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Evoweb\PackingList\Domain\Repository\ListingRepository;

class ListController extends ActionController
{
    protected ListingRepository $listingRepository;

    public function __construct(
        ListingRepository $listingRepository
    ) {
        $this->listingRepository = $listingRepository;
    }

    public function listAction(): string
    {
        $listings = $this->listingRepository->findAll();

        $this->view->assign('listings', $listings);
        return $this->view->render();
    }

    public function shareAction(Listing $listing): string
    {
        $this->view->assign('listing', $listing);
        return $this->view->render();
    }
}
