<?php

namespace App\Controller\Interfaces;

use App\Service\Traits\Interfaces\HasUserServiceInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface UserControllerInterface extends HasUserServiceInterface
{

    /************************************************** ROUTING ***************************************************/

    /**
     * Route to access user registration in the application.
     *
     * @param Request $request Request of the route.
     *
     * @return JsonResponse JsonResponse
     */
    public function signup(Request $request): JsonResponse;

    /**
     * Route to access user login in the application.
     *
     * @param Request $request Request of the route.
     *
     * @return JsonResponse JsonResponse
     */
    public function signin(Request $request, ParameterBagInterface $parameterBag): JsonResponse;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}