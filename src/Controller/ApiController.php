<?php
namespace App\Controller;

use App\Entity\Armory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ApiController extends Controller
{
    /**
     * @Route("/armory", name="data_json")
     */
    public function indexAction()
    {
        $armoryRepository = $this->getDoctrine()->getRepository(Armory::class);
        $serailizer = $this->get('serializer');

        $armoryContents = $armoryRepository->findAll();

        return new JsonResponse($serailizer->normalize($armoryContents), 200);
    }
}
