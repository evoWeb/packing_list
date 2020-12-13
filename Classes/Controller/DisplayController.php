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
use Evoweb\PackingList\Utility\Cache;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Evoweb\PackingList\Domain\Repository\ListingRepository;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class DisplayController extends ActionController
{
    protected ListingRepository $listingRepository;

    public function __construct(
        ListingRepository $listingRepository
    ) {
        $this->listingRepository = $listingRepository;
    }

    public function initializeAction()
    {
        Cache::addCacheTagByControllerAction(['packing_display']);
    }

    public function listAction(int $currentPage = 1): string
    {
        $listings = $this->listingRepository->findAllPublic();

        $this->view->assignMultiple($this->preparePagination($listings, 'listings', $currentPage));

        return $this->view->render();
    }

    public function showAction(Listing $listing): string
    {
        $this->view->assign('listing', $listing);
        return $this->view->render();
    }

    public function sharedAction(Listing $listing): string
    {
        $this->view->assign('listing', $listing);
        return $this->view->render();
    }

    protected function preparePagination(QueryResultInterface $query, string $variableName, int $currentPage = 1): array
    {
        $arrayPaginator = new QueryResultPaginator($query, $currentPage, intval($this->settings['itemsPerPage'] ?? 10));
        $pagination = new SimplePagination($arrayPaginator);

        return [
            $variableName => $query,
            'paginator' => $arrayPaginator,
            'pagination' => $pagination,
            'pages' => range(1, $pagination->getLastPageNumber()),
        ];
    }
}
