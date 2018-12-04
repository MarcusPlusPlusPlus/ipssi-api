<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 03/12/2018
 * Time: 11:59
 */

namespace App\Repository;

use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MissionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mission::class);
    }
}
