<?php

namespace App\Controller\Interfaces;

use App\Service\Interfaces\AppServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface AppControllerInterface
{

    /************************************************** ROUTING ***************************************************/

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Validates the fields of the request passed by parameters as an array of key => value.
     *
     *      return array(
     *          array(
     *              'field' => $key,
     *              'message' => sprintf('The %s field must be integer', $key)
     *          )
     *      )
     *
     * @param array $requestFields The array of fields to validate.
     * @param string $additionalMessage Additional message to the response.
     *
     * @return array array
     */
    public function validateRequestNumericFields(array $requestFields, string $additionalMessage = ''): array;

    /**
     * Validates the fields of the request passed by parameters as an array of key => value.
     *
     *      return array(
     *          array(
     *              'field' => $key,
     *              'message' => sprintf('The %s field cannot be empty', $key)
     *          )
     *      )
     *
     * @param array $requestFields The array of fields to validate.
     * @param string $additionalMessage Additional message to the response.
     *
     * @return array array
     */
    public function validateRequiredRequestFields(array $requestFields, string $additionalMessage = ''): array;

    /**
     * Gets the param value from the request passed or null if it not exists.
     *
     * @param Request $request Request of the route.
     * @param string $paramKey Key to search the param value.
     *
     * @return mixed|null mixed|null
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getParamFromRequest(Request $request, string $paramKey);

    /**
     * Creates a Json response for the WebService.
     * If the process is successful it will return the creation code 201.
     *
     * @param mixed $data The data of the response.
     * @param array $validationErrors The validation errors to add to the response.
     *
     * @return JsonResponse JsonResponse
     */
    public function createJsonResponse_Creation(mixed $data, array $validationErrors): JsonResponse;

    /**
     * Creates a Json response for the WebService.
     * It will return the code passed.
     *
     * @param mixed $data The data of the response.
     * @param array $validationErrors The validation errors to add to the response.
     * @param int $code The code to return.
     *
     * @return JsonResponse JsonResponse
     */
    public function createJsonResponse(mixed $data, array $validationErrors, int $code = 200): JsonResponse;

    /*********************************************** STATIC METHODS ***********************************************/

}