<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 03/12/2018
 * Time: 16:11
 */

namespace App\Controller\Api\V1;

use App\Controller\Api\ApiErrorsTrait;
use App\Repository\InterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;


class InterventionController extends FOSRestBundle
{
    use ApiErrorsTrait;


    /**
     * @var InterventionRepository
     */
    private $interventionRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    public function __construct(
        SerializerInterface $serializer,
        InterventionRepository $interventionRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $doctrine
    )
    {
        $this->interventionRepository = $interventionRepository;
        $this->serializer = $serializer;
        $this->formFactory = $formFactory;
        $this->doctrine = $doctrine;
    }

    /**
     * @Rest\Get("/interventions")
     * @Rest\View()
     */
    public function getMission()
    {
        $interventions = $this->interventionRepository->findAll();


        return $interventions;
    }
}
