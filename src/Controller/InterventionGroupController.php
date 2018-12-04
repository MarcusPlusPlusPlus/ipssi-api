<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 03/12/2018
 * Time: 16:02
 */

namespace App\Controller;

use Nette\Utils\Json;
use Symfony\Component\Serializer\Serializer;
use App\Entity\InterventionGroup;
use App\Entity\Crs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class InterventionGroupController extends AbstractController
{
    /**
     * @return JsonResponse
     * @route(path="/intervention-group", methods={"GET"})
     */
    public function index()
    {
        $interventionGroupRepository = $this->getDoctrine()->getRepository(InterventionGroup::class);
        $interventionGroups = $interventionGroupRepository->findAll();
        foreach ($interventionGroups as $group) {
            $crsRepository = $this->getDoctrine()->getRepository(Crs::class)->findBy(
                ['group' => $group['id']]
            );
            $group['crs'] = $this->get('serializer')->normalize($crsRepository, null, ['group' => 'Default']);
            $response[] = $group;
        }
        return new JsonResponse($response, 200);
    }
}
