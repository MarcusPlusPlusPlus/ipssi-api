<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 03/12/2018
 * Time: 16:14
 */

namespace App\Repository;

use App\Entity\InterventionGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InterventionGroup::class);
    }
}
