<?php

namespace App\Controller\Admin\Interfaces;


use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\HttpFoundation\Response;

interface DashboardControllerInterface
{

    /************************************************** ROUTING ***************************************************/

    /**
     * Route to redirect to the admin page.
     *
     * @return Response Response
     */
    public function index(): Response;

    /**
     * Route to access to the admin page.
     *
     * @return Response Response
     */
    public function admin(): Response;

    /**
     * Route to access to the login page of the admin.
     *
     * @return Response Response
     */
    public function loginAction(): Response;

    /**
     * Route to logout from de admin.
     *
     * @return Response Response
     */
    public function logoutAction(): Response;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Method that configure the metadata of the Dashboard in the admin.
     *
     * @return Dashboard Dashboard
     */
    public function configureDashboard(): Dashboard;

    /*********************************************** STATIC METHODS ***********************************************/

}