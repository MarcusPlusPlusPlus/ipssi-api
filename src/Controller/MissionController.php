<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 04/12/2018
 * Time: 11:44
 */

namespace App\Controller;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Mission;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class MissionController extends AbstractController
{
    /**
     * @return JsonResponse
     * @route(path="/mission", methods={"GET"})
     */
    public function index()
    {
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        return new JsonResponse($this->get('serializer')->normalize($missionRepository->findAll()), 200);
    }

    /**
     * @Route(path="/mission", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function add(Request $request)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');
        $doctrine = $this->getDoctrine();

        try {
            $mission = $serializer->deserialize($request->getContent(), Mission::class, 'json');
            $mission->setId(Uuid::uuid4());
        } catch (NotEncodableValueException $exception) {
            return new JsonResponse([
                'code' => 400,
                'message' => 'Mal formatted Query, Body is not valid JSON'
            ], 400);
        }

        $doctrine->getManager()->persist($mission);
        $doctrine->getManager()->flush();

        return new JsonResponse($serializer->normalize($mission), 201);
    }

    /**
     * @return JsonResponse
     * @route(path="/mission/{id}", methods={"GET"})
     */
    public function getMissionById($id)
    {
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        return new JsonResponse($this->get('serializer')->normalize($missionRepository->findBy(["id" => $id])), 200);
    }

    /**
     * @return JsonResponse
     * @route(path="/mission/{id}", methods={"DELETE"})
     */
    public function deleteMissionById($id)
    {
        $missionRepository = $this->getDoctrine()->getRepository(Mission::class);
        return new JsonResponse($this->get('serializer')->normalize($missionRepository->findBy(["id" => $id])), 200);
    }
}
