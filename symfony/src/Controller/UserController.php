<?php /** @noinspection DuplicatedCode */

namespace App\Controller;

use App\Controller\Interfaces\UserControllerInterface;
use App\Service\Interfaces\UserServiceInterface;
use App\Service\Traits\UserServiceTrait;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AppController implements UserControllerInterface
{

    /************************************************* CONSTANTS **************************************************/

    public const REQUEST_FIELD_USERNAME = 'username';
    public const REQUEST_FIELD_PASSWORD = 'password';

    /************************************************* PROPERTIES *************************************************/

    use UserServiceTrait;

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  UserController constructor.
     *
     * @param UserServiceInterface $userService Service of User.
     *
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->setUserService($userService);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /************************************************** ROUTING ***************************************************/

    /**
     * @Route("/api/signup")
     *
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function signup(Request $request): JsonResponse
    {
        $username = $this->getParamFromRequest($request, static::REQUEST_FIELD_USERNAME);
        $password = $this->getParamFromRequest($request, static::REQUEST_FIELD_PASSWORD);

        # Data Validation
        $validationErrors = $this->validateRequiredRequestFields(array(
            static::REQUEST_FIELD_USERNAME => $username,
            static::REQUEST_FIELD_PASSWORD => $password,
        ));

        $data = NULL;
        if (empty($validationErrors)):
            $result = $this->getUserService()->signup($username, $password);

            if ($result):
                $data = array('created' => TRUE);
            else:
                $validationErrors[] = array(
                    'message' => sprintf('El usuario %s ya existe actualmente.', $username)
                );
            endif;
        endif;

        return $this->createJsonResponse_Creation($data, $validationErrors);
    }

    /**
     * @Route("/api/signin")
     *
     * @inheritDoc
     * @return JsonResponse JsonResponse
     */
    public function signin(Request $request, ParameterBagInterface $parameterBag): JsonResponse
    {
        $username = $this->getParamFromRequest($request, static::REQUEST_FIELD_USERNAME);
        $password = $this->getParamFromRequest($request, static::REQUEST_FIELD_PASSWORD);

        # Data Validation
        $validationErrors = $this->validateRequiredRequestFields(array(
            static::REQUEST_FIELD_USERNAME => $username,
            static::REQUEST_FIELD_PASSWORD => $password,
        ));

        $data = NULL;
        if (empty($validationErrors)):
            $data = $this->getUserService()->signin($username, $password);
        endif;

        return $this->createJsonResponse($data, $validationErrors);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}