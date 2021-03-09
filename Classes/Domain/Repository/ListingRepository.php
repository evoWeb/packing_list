<?php

declare(strict_types=1);

namespace Evoweb\PackingList\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ListingRepository extends Repository
{
    use PersistenceTrait;

    public function findByPublic()
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $query->matching(
            $query->equals('public', 1)
        );
        return $query->execute();
    }

    public function findByOwner(int $owner)
    {
        /** @var Query $query */
        $query = $this->createQuery();
        $query->matching(
            $query->equals('owner', $owner)
        );
        return $query->execute();
    }
}
