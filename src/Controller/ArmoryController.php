<?php

namespace App\Controller;

use http\Env\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Armory;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;

class ArmoryController extends AbstractController
{
    /**
     * @Route(path="/armory", methods={"GET"})
     * @return  JsonResponse
     */
    public function index()
    {
        $armoryRepository = $this->getDoctrine()->getRepository(Armory::class);
        return new JsonResponse($this->get('serializer')->normalize($armoryRepository->findAll()), 200);
    }
}
