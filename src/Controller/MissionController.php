<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Mission;
use App\Form\MissionType;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;


class MissionController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @Route("/mission", name="mission_json", methods={"GET"})
     */
    public function indexAction()
    {
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        $serializer = $this->get('serializer');

        $missionContents = $missionRepository->findAll();

        return new JsonResponse($serializer->normalize($missionContents), 200);
    }

    /**
     * @Route("/mission/{id}", name="view_mission", methods={"GET"})
     * @param $uuid
     * @return Response
     */
    public function viewAction($id): Response
    {
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        $serializer = $this->get('serializer');

        $missionContents = $missionRepository->find($id);

        return new JsonResponse($serializer->normalize($missionContents), 200);
    }

    /**
     * @Route("/mission/add", name="add_mission", methods={"POST"})
     * @return Response
     * @param Request $request
     */
    public function addAction(Request $request): Response
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        $locationRepository = $this->entityManager->getRepository(Location::class);
        /** @var \Symfony\Component\Serializer\Serializer $serializer */
        $serializer = $this->get('serializer');


        $mission = new Mission();

        $form = $this->createForm(MissionType::class);
        $form->submit($serializer->decode($request->getContent(), "json"));

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $location = $locationRepository->find($data['location_id']);

            $mission->setName($data['name'])
                ->setDate($data['date'])
                ->setLocation($location)
                ->setId(Uuid::uuid4());

            $this->entityManager->persist($mission);
            $this->entityManager->flush();

            return new JsonResponse($serializer->normalize($mission), 201);
        }

        //dump($form->getErrors());
        //die();

        return new JsonResponse(["code" => 400, "type" => "Bad request", "message" => "L'entrée n'est pas valide."], 400);
    }
}
