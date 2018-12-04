<?php

declare(strict_types=1);


namespace App\Controller;


use App\Entity\Armory;
use App\Entity\Crs;
use App\Entity\InterventionGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InterventionGroupController extends AbstractController
{
    /**
     * @Route(path="/intervention_group", methods={"GET"})
     * @return JsonResponse
     */
    public function list()
    {
        //Dependency
        $interventionGroupRepository = $this->getDoctrine()->getRepository(InterventionGroup::class);
        $serializer = $this->get('serializer');
        $interventionGroups = $interventionGroupRepository->findAll();
        $interventionGroups = $serializer->normalizie($interventionGroups);

        $res = [];
        foreach ($interventionGroups as $group) {
            $crsList = $this->getDoctrine()->getRepository(Crs::class)->findBy(
                ['group' => $group['id']]
            );
            $group['crs'] = $serializer->normalize($crsList, null, ['group' => 'Default']);
            $res[] = $group;
        }

        //Send response
        return new JsonResponse($res, 200);
    }
}
