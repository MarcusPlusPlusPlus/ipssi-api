<?php

declare(strict_types=1);


namespace App\Controller;


use App\Entity\Armory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArmoryController extends AbstractController
{
    /**
     * @Route(path="/armory", methods={"GET"})
     *
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

}
