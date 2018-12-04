<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Armory;
use http\Env\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ArmoryController extends AbstractController
{
    /**
     * @Route(path="/armory", methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        //Dependency
        $armoryRepository = $this->getDoctrine()->getRepository(Armory::class);
        $serailizer = $this->get('serializer');

        //My Logic
        $armoryContents = $armoryRepository->findAll();

        //Send response
        return new JsonResponse($serailizer->normalize($armoryContents), 200);
    }

    /**
     * @Route(path="/armory", methods={"POST"})
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
            $armory = $serailizer->deserialize($request->getContent(), Armory::class, 'json');
            $armory->setId(Uuid::uuid4());
        } catch (NotEncodableValueException $exception) {
            return new JsonResponse([
                'code' => 400,
                'message' => 'Mal formatted Querry, Body is not valid JSON'
            ], 400);
        }

        $doctrine->getManagement()->persist($armory);
        $doctrine->getManager()->flush();

        return new JsonResponse($serailizer->normalize($armory), 201);
    }
}
