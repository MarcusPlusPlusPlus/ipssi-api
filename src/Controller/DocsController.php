<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Armory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocsController extends AbstractController
{
    /**
     * @Route(path="/", methods={"GET"})
     *
     * @return Response
     */
    public function __invoke()
    {
        return $this->render('docs.html.twig');
    }
}
