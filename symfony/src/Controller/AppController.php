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
    public function validateRequestNumericFields(array $requestFields): array
    {
        $validationErrors = array();
        foreach ($requestFields as $fieldName => $value):
            if ($value !== NULL && !is_numeric($value)):
                $validationErrors[] = array(
                    'field' => $fieldName,
                    'message' => sprintf('The %s field must be numeric', $fieldName)
                );
            endif;
        endforeach;

        return $validationErrors;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function validateRequiredRequestFields(array $requestFields): array
    {
        $validationErrors = array();
        foreach ($requestFields as $fieldName => $value):
            if ($value === NULL):
                $validationErrors[] = array(
                    'field' => $fieldName,
                    'message' => sprintf('The %s field cannot be empty', $fieldName)
                );
            endif;
        endforeach;

        return $validationErrors;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function validateRequestStatusField($status, array $statusChoices): array
    {
        $validationErrors = array();
        if (
            $status !== NULL
            && ((is_numeric($status) && !in_array((int)$status, $statusChoices))
                || (
                    !is_numeric($status)
                    && !in_array(strtolower($status), array_keys(array_change_key_case($statusChoices)))
                ))
        ):
            $validationErrors[] = array(
                'field' => 'status',
                'message' => sprintf('The status %s does not exist', $status)
            );
        endif;

        return $validationErrors;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function validateRequestDateFields(array $dates): array
    {
        $validationErrors = array();
        foreach ($dates as $fieldName => $date):
            if ($date !== NULL && !is_numeric($date)):
                $validationErrors[] = array(
                    'field' => $fieldName,
                    'message' => sprintf(
                        'El campo %s debe de ser de tipo entero (timestamp) o nulo',
                        $fieldName
                    )
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
    public function createJsonResponse_Put(mixed $data, array $validationErrors): JsonResponse
    {
        return $this->createJsonResponse($data, $validationErrors, Response::HTTP_ACCEPTED);
    }

    /**
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function createJsonResponse($data, array $validationErrors, int $code = 200): JsonResponse
    {
        $response['data'] = NULL;
        $response['result'] = empty($validationErrors);
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