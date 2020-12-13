<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Evoweb\PackingList\Pagination;

use TYPO3\CMS\Core\Pagination\AbstractPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

final class QueryPaginator extends AbstractPaginator
{
    private QueryResultInterface $queryResult;

    private int $totalAmountOfItems = 0;

    private array $paginatedItems = [];

    public function __construct(
        QueryResultInterface $queryResult,
        int $currentPageNumber = 1,
        int $itemsPerPage = 10
    ) {
        $this->queryResult = $queryResult;
        $this->setCurrentPageNumber($currentPageNumber);
        $this->setItemsPerPage($itemsPerPage);

        $this->fetchTotalAmountOfQuery();
        $this->updateInternalState();
    }

    private function fetchTotalAmountOfQuery()
    {
        $query = $this->queryResult->getQuery();
        $query->setLimit(PHP_INT_MAX);
        $query->setOffset(0);

        $this->totalAmountOfItems = $query->count();
    }

    public function getPaginatedItems(): iterable
    {
        return $this->paginatedItems;
    }

    protected function updatePaginatedItems(int $itemsPerPage, int $offset): void
    {
        $query = $this->queryResult->getQuery();
        $query->setLimit($itemsPerPage);
        $query->setOffset($offset);

        $this->paginatedItems = $query->execute()->toArray();
    }

    protected function getTotalAmountOfItems(): int
    {
        return $this->totalAmountOfItems;
    }

    protected function getAmountOfItemsOnCurrentPage(): int
    {
        return count($this->paginatedItems);
    }
}
