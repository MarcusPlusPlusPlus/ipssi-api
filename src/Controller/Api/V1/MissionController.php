<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Controller\Api\ApiErrorsTrait;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Database\Fixtures\RamseyUuid;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Mission;
use FOS\RestBundle\Controller\Annotations as Rest;



use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MissionController
 */
class MissionController extends FOSRestBundle
{
    use ApiErrorsTrait;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var MissionRepository
     */
    private $missionRepository;

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
        MissionRepository $missionRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $doctrine
    )
    {
        $this->missionRepository = $missionRepository;
        $this->serializer = $serializer;
        $this->formFactory = $formFactory;
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/mission", methods="GET")
     */
    public function getMission()
    {
        return $this->missionRepository->findAll();
    }

    /**
     * @Rest\Post("/mission")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     */
    public function createMission(Request $request)
    {
        $mission = new Mission();

        return $this->handleMission($mission, $request);
    }


    private function handleMission(Mission $mission, Request $request, bool $clearMissing = true)
    {
        $form = $this->formFactory->create(MissionType::class, $mission);
        $form->submit($request->request->all(), $clearMissing);

        if (!$form->isValid()) {
            $readableErrors = $this->getFormErrors($form);

            return new JsonResponse(['message' => 'Invalid data sent', 'errors' => $readableErrors], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->doctrine->persist($mission);
        $this->doctrine->flush();

        return $mission;
    }


}
