<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\InterventionGroup;
use Doctrine\ORM\EntityRepository;

class InterventionGroupRepository extends EntityRepository
{
    /**
     * Find All InterventionGroup With location and Crs
     *
     * @return InterventionGroup[]
     */
    public function findAllWithFullInterventionGroup(): array
    {
        return  $this->createQueryBuilder('i')
            ->addSelect('crs, barrack_location')
            ->join('i.crs', 'crs')
            ->join('i.barrackLocation', 'barrack_location')

            ->getQuery()
            ->getResult();
    }
}
