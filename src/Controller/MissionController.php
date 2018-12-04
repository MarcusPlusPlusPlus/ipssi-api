<?php
/**
 * Created by PhpStorm.
 * User: amandinelesaint
 * Date: 04/12/2018
 * Time: 09:53
 */

namespace App\Controller;


use App\Entity\Mission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

class MissionController extends AbstractController
{

    /**
     * @Route(path="/mission", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function list()
    {
        //Dependency
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        $serailizer = $this->get('serializer');
        $missionContents = $missionRepository->findAll();

        //Send response
        return new JsonResponse($serailizer->normalize($missionContents), 200);
    }


    /**
     * @Route(path="/mission/{id}", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listById($id)
    {
        //Dependency
        $missionRepositoryId = $this->getDoctrine()->getRepository(Mission::class);

        $serailizer = $this->get('serializer');
        $missionContentsId = $missionRepositoryId ->find($id);

        //Send response
        return new JsonResponse($serailizer->normalize($missionContentsId), 200);

    }

    /**
     * @Route(path="/mission", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(Request $request)
    {
        /** @var Serailizer $serailizer */
        $serailizer = $this->get('serailizer');
        $doctrine = $this->getDoctrine();

        try {
            $mission = $serailizer->deserialize($request->getContent(), Mission::class, 'json');
            $mission->setId(Uuid::uuid4());
        } catch (NotEncodableValueException $exception) {
            return new JsonResponse([
                'code' => 400,
                'message' => 'Mal formatted Querry, Body is not valid JSON'
            ], 400);
        }

        $doctrine->getManagement()->persist($mission);
        $doctrine->getManager()->flush();

        return new JsonResponse($serailizer->normalize($mission), 201);
    }

    /**
     * @Route(path="/mission/{id}", methods={"DELETE"})
     * @return JsonResponse
     * @param int $id
     */
    public function delete($id)
    {
        $missionDeleteId = $this->getDoctrine()->getRepository(Mission::class);

        $existingMission = $this->findMissionById($id);

        $this->entityManager->remove($missionDeleteId);
        $this->entityManager->flush();

        //Send response
        return new JsonResponse(null,
            JsonResponse::HTTP_NO_CONTENT, 404);

    }
}