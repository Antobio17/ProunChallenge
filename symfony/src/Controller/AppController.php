<?php

namespace App\Controller;

use App\Controller\Interfaces\AppControllerInterface;
use App\Service\Interfaces\AppServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends AbstractController implements AppControllerInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /************************************************** ROUTING ***************************************************/

    /************************************************* CONSTRUCT **************************************************/

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function validateRequestNumericFields(array $requestFields, string $additionalMessage = ''): array
    {
        $validationErrors = array();
        foreach ($requestFields as $fieldName => $value):
            if ($value !== NULL && !is_numeric($value)):
                $validationErrors[] = array(
                    'field' => $fieldName,
                    'message' => sprintf('The %s%s field must be numeric', $fieldName, $additionalMessage)
                );
            endif;
        endforeach;

        return $validationErrors;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function validateRequiredRequestFields(array $requestFields, string $additionalMessage = ''): array
    {
        $validationErrors = array();
        foreach ($requestFields as $fieldName => $value):
            if ($value === NULL):
                $validationErrors[] = array(
                    'field' => $fieldName,
                    'message' => sprintf('The %s %s field cannot be empty', $fieldName, $additionalMessage)
                );
            endif;
        endforeach;

        return $validationErrors;
    }

    /**
     * @inheritDoc
     * @return mixed|null mixed|null
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getParamFromRequest(Request $request, string $paramKey)
    {
        $content = json_decode($request->getContent(), true);
        $content = isset($content[0]) && is_array($content[0]) ? $content[0] : $content;

        return $content[$paramKey] ?? $request->request->get($paramKey) ?? $request->query->get($paramKey) ?? NULL;
    }

    /**
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function createJsonResponse_Creation($data, array $validationErrors): JsonResponse
    {
        return $this->createJsonResponse($data, $validationErrors, Response::HTTP_CREATED);
    }

    /**
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function createJsonResponse($data, array $validationErrors, int $code = 200): JsonResponse
    {
        $response['data'] = NULL;
        if (empty($validationErrors)):
            $response['data'] = $data;
        else:
            $code = Response::HTTP_BAD_REQUEST;
            $response['errors'] = $validationErrors;
        endif;

        return new JsonResponse($response, $code);
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}