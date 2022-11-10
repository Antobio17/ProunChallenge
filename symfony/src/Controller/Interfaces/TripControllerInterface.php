<?php

namespace App\Controller\Interfaces;

use App\Service\Traits\Interfaces\HasTripServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface TripControllerInterface extends HasTripServiceInterface
{

    /************************************************** ROUTING ***************************************************/

    /**
     * Route to create a new trip.
     *
     * @param Request $request Request of the route.
     *
     * @return JsonResponse JsonResponse
     */
    public function createTrip(Request $request): JsonResponse;

    /**
     * Route to get the trips of the app.
     *
     * @param Request $request Request of the route.
     *
     * @return JsonResponse JsonResponse
     */
    public function getTrips(Request $request): JsonResponse;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}