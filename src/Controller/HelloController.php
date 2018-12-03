<?php

declare(strict_types=1);


namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route(path="/hello")
     *
     * @return JsonResponse
     */
    public function helloAction()
    {
        return new JsonResponse(['hello' => 'world']);
    }
}
