<?php
/**
 * Created by PhpStorm.
 * User: amandinelesaint
 * Date: 03/12/2018
 * Time: 16:05
 */

namespace App\Controller;

use App\Entity\Crs;
use App\Entity\InterventionGroup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InterventionGroupController extends AbstractController
{
    /**
     * @Route(path="/interventionGroup", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function list()
    {
        //Dependency
        $interventionGroupRepository = $this->getDoctrine()->getRepository(InterventionGroup::class);
        $serailizer = $this->get('serializer');
        $interventionGroups = $interventionGroupRepository->findAll();


        $interventionGroups = $serailizer->normalize($interventionGroups);

        $res = [];
        foreach ($interventionGroups as $group){
            $crsList = $this->getDoctrine()->getRepository(Crs::class)->findBy(
                ['group' => $group['id']]
            );
            $group['crs'] = $serailizer->normalize($crsList, null, ['group' => 'Default']);
            $res[] = $group;

        }

        //Send response
        return new JsonResponse($serailizer->normalize($interventionGroups), 200);
    }
}