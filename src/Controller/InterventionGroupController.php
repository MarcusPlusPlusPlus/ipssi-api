<?php

namespace App\Controller;

use App\Entity\InterventionGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InterventionGroupController extends Controller
{
    /**
     * @Route("/intervention", name="intervention_json")
     */
    public function indexAction()
    {
        $interventionGroupRepository = $this->getDoctrine()->getRepository(InterventionGroup::class);
        $serializer = $this->get('serializer');

        $interventionGroupContents = $interventionGroupRepository->findAll();

        return new JsonResponse($serializer->normalize($interventionGroupContents), 200);
    }
}
