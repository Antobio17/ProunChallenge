<?php /** @noinspection DuplicatedCode */

namespace App\Controller;

use App\Controller\Interfaces\TripControllerInterface;
use App\Entity\Trip;
use App\Service\Interfaces\TripServiceInterface;
use App\Service\Traits\TripServiceTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AppController implements TripControllerInterface
{

    /************************************************* CONSTANTS **************************************************/

    public const REQUEST_FIELD_SERVICE_LOCATOR = 'serviceLocator';
    public const REQUEST_FIELD_VEHICLE = 'vehicle';
    public const REQUEST_FIELD_UUID = 'uuid';
    public const REQUEST_FIELD_COLLECTION_POINT = 'collectionPoint';
    public const REQUEST_FIELD_DESTINATION_POINT = 'destinationPoint';
    public const REQUEST_FIELD_POINT_NAME = 'name';
    public const REQUEST_FIELD_POINT_LATITUDE = 'latitude';
    public const REQUEST_FIELD_POINT_LONGITUDE = 'longitude';

    /************************************************* PROPERTIES *************************************************/

    use TripServiceTrait;

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  TripController constructor.
     *
     * @param TripServiceInterface $tripService Service of User.
     *
     */
    public function __construct(TripServiceInterface $tripService)
    {
        $this->setTripService($tripService);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /************************************************** ROUTING ***************************************************/

    /**
     * @Route("/api/trip/create", methods={"POST", "PUT", "PATCH"})
     *
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function createTrip(Request $request): JsonResponse
    {
        $collectionPoint = $this->getParamFromRequest($request, static::REQUEST_FIELD_COLLECTION_POINT);
        $destinationPoint = $this->getParamFromRequest($request, static::REQUEST_FIELD_DESTINATION_POINT);
        $serviceLocator = $this->getParamFromRequest($request, static::REQUEST_FIELD_SERVICE_LOCATOR);
        $vehicle = $this->getParamFromRequest($request, static::REQUEST_FIELD_VEHICLE);

        # Params validation
        $validationErrors = array_merge(
            $this->validateRequiredRequestFields(array(
                static::REQUEST_FIELD_SERVICE_LOCATOR => $serviceLocator,
            )),
            # Collection Point
            $this->validateRequiredRequestFields(array(
                static::REQUEST_FIELD_POINT_NAME => $collectionPoint[static::REQUEST_FIELD_POINT_NAME] ?? NULL,
            ), ' (from collectionPoint)'),
            $this->validateRequestNumericFields(array(
                static::REQUEST_FIELD_POINT_LATITUDE => $collectionPoint[static::REQUEST_FIELD_POINT_LATITUDE] ?? NULL,
                static::REQUEST_FIELD_POINT_LONGITUDE => $collectionPoint[static::REQUEST_FIELD_POINT_LONGITUDE] ?? NULL,
            ), ' (from collectionPoint)'),
            # Destination Point
            $this->validateRequiredRequestFields(array(
                static::REQUEST_FIELD_POINT_NAME => $destinationPoint[static::REQUEST_FIELD_POINT_NAME] ?? NULL,
            ), ' (from collectionPoint)'),
            $this->validateRequestNumericFields(array(
                static::REQUEST_FIELD_POINT_LATITUDE => $destinationPoint[static::REQUEST_FIELD_POINT_LATITUDE] ?? NULL,
                static::REQUEST_FIELD_POINT_LONGITUDE => $destinationPoint[static::REQUEST_FIELD_POINT_LONGITUDE] ?? NULL,
            ), ' (from collectionPoint)'),
            $this->_validateVehicleField($vehicle)
        );

        if (empty($validationErrors)):
            $UUID = $this->getTripService()->createTrip($serviceLocator, $collectionPoint, $destinationPoint, $vehicle);
            if ($UUID !== NULL):
                $data = array('created' => TRUE, 'uuid' => $UUID);
            else:
                $validationErrors[] = array('message' => 'An error occurred creating the new trip.');
            endif;
        endif;

        return $this->createJsonResponse_Creation($data ?? NULL, $validationErrors);
    }

    /**
     * @Route("/api/trip/get")
     *
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function getTrips(Request $request): JsonResponse
    {
        $collectionPoint = $this->getParamFromRequest($request, static::REQUEST_FIELD_COLLECTION_POINT);
        $destinationPoint = $this->getParamFromRequest($request, static::REQUEST_FIELD_DESTINATION_POINT);
        $serviceLocator = $this->getParamFromRequest($request, static::REQUEST_FIELD_SERVICE_LOCATOR);
        $UUID = $this->getParamFromRequest($request, static::REQUEST_FIELD_UUID);

        # Params validation
        $validationErrors = array();
        if ($UUID === NULL && $serviceLocator === NULL && $collectionPoint === NULL && $destinationPoint === NULL):
            $validationErrors[] = array('message' => 'No search parameters specified');
        else:
            if ($collectionPoint !== NULL):
                $validationErrors = array_merge(
                # Collection Point
                    $this->validateRequiredRequestFields(array(
                        static::REQUEST_FIELD_POINT_NAME =>
                            $collectionPoint[static::REQUEST_FIELD_POINT_NAME] ?? NULL,
                    ), ' (from collectionPoint)'),
                    $this->validateRequestNumericFields(array(
                        static::REQUEST_FIELD_POINT_LATITUDE =>
                            $collectionPoint[static::REQUEST_FIELD_POINT_LATITUDE] ?? NULL,
                        static::REQUEST_FIELD_POINT_LONGITUDE =>
                            $collectionPoint[static::REQUEST_FIELD_POINT_LONGITUDE] ?? NULL,
                    ), ' (from collectionPoint)'),
                );
            endif;
            if ($destinationPoint !== NULL):
                $validationErrors = array_merge(
                    $validationErrors,
                    # Destination Point
                    $this->validateRequiredRequestFields(array(
                        static::REQUEST_FIELD_POINT_NAME =>
                            $destinationPoint[static::REQUEST_FIELD_POINT_NAME] ?? NULL,
                    ), ' (from collectionPoint)'),
                    $this->validateRequestNumericFields(array(
                        static::REQUEST_FIELD_POINT_LATITUDE =>
                            $destinationPoint[static::REQUEST_FIELD_POINT_LATITUDE] ?? NULL,
                        static::REQUEST_FIELD_POINT_LONGITUDE =>
                            $destinationPoint[static::REQUEST_FIELD_POINT_LONGITUDE] ?? NULL,
                    ), ' (from collectionPoint)'),
                );
            endif;
        endif;

        if (empty($validationErrors)):
            $data = $this->getTripService()->getTrips($UUID, $serviceLocator, $collectionPoint, $destinationPoint);
        endif;

        return $this->createJsonResponse($data ?? NULL, $validationErrors);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /********************************************** PROTECTED METHODS *********************************************/

    /**
     * Validates the vehicle field passed.
     *
     * @param string|null $vehicle The vehicle to validate.
     *
     * @return array array
     */
    protected function _validateVehicleField(?string $vehicle): array
    {
        $validationErrors = array();
        if ($vehicle === NULL || !Trip::allowVehicle($vehicle)):
            $validationErrors[] = array(
                'field' => static::REQUEST_FIELD_VEHICLE,
                'message' => sprintf('The value for %s is not allowed', static::REQUEST_FIELD_VEHICLE)
            );
        endif;

        return $validationErrors;
    }

    /*********************************************** STATIC METHODS ***********************************************/

}