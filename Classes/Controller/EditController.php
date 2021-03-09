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
use Evoweb\PackingList\Domain\Repository\ListingRepository;
use Evoweb\PackingList\Domain\Repository\ShelfRepository;
use Evoweb\PackingList\Utility\Cache;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\UserAspect;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class EditController extends ActionController
{
    protected Context $context;

    protected ListingRepository $listingRepository;

    protected ShelfRepository $shelfRepository;

    public function __construct(
        Context $context,
        ListingRepository $listingRepository,
        ShelfRepository $shelfRepository
    ) {
        $this->context = $context;
        $this->listingRepository = $listingRepository;
        $this->shelfRepository = $shelfRepository;
    }

    protected function resolveActionMethodName(): string
    {
        /** @var UserAspect $userAspect */
        $userAspect = $this->context->getAspect('frontend.user');

        $result = 'loginRequiredAction';
        if ($userAspect->isLoggedIn()) {
            $result = parent::resolveActionMethodName();
        }
        return $result;
    }

    public function initializeAction()
    {
        Cache::addCacheTags(['packing_list_edit']);
    }

    public function loginRequiredAction(): string
    {
        return $this->view->render();
    }

    public function listAction(int $currentPage = 1): string
    {
        /** @var UserAspect $userAspect */
        $userAspect = $this->context->getAspect('frontend.user');
        Cache::addCacheTags(['packing_edit_list_' . $userAspect->get('id')]);

        $listings = $this->listingRepository->findByOwner($userAspect->get('id'));
        $shelf = $this->shelfRepository->findOneByOwner($userAspect->get('id'));

        $this->view->assignMultiple($this->preparePagination($listings, 'listings', $currentPage));
        $this->view->assign('shelf', $shelf);

        return $this->view->render();
    }

    public function editAction(Listing $listing): string
    {
        $this->view->assign('listing', $listing);
        return $this->view->render();
    }

    public function shareAction(Listing $listing)
    {
        $listing->setShared(true);
        $this->listingRepository->update($listing);
        $this->listingRepository->persistAll();

        /** @var UserAspect $userAspect */
        $userAspect = $this->context->getAspect('frontend.user');
        Cache::flushByTags([
            'packing_edit_list_' . $userAspect->get('id'),
            'tx_packinglist_domain_model_listing_' . $listing->getUid()
        ]);

        $uri = $this->uriBuilder
            ->setCreateAbsoluteUri(true)
            ->uriFor(
                'shared',
                ['listing' => $listing->getUid()],
                'Display',
                'PackingList',
                'Display'
            );

        echo \json_encode([
            'href' => $uri,
            'message' => LocalizationUtility::translate('copy_message', 'packing_list', [0 => $listing->getName()]),
            'ok' => LocalizationUtility::translate('share', 'packing_list'),
        ]);
        die();
    }

    protected function preparePagination(QueryResultInterface $query, string $variableName, int $currentPage = 1): array
    {
        $arrayPaginator = new QueryResultPaginator($query, $currentPage, (int)($this->settings['itemsPerPage'] ?? 8));
        $pagination = new SimplePagination($arrayPaginator);

        return [
            $variableName => $query,
            'paginator' => $arrayPaginator,
            'pagination' => $pagination,
            'pages' => range(1, $pagination->getLastPageNumber()),
        ];
    }
}
