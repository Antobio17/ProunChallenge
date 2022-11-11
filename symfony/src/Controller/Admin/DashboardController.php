<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Interfaces\DashboardControllerInterface;
use App\Entity\Point;
use App\Entity\Trip;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController implements DashboardControllerInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /******************************************** GETTERS AND SETTERS *********************************************/

    /************************************************** ROUTING ***************************************************/

    /**
     * @Route("/", name="index")
     *
     * @inheritDoc
     * @return Response Response
     */
    public function index(): Response
    {
        return $this->redirectToRoute('admin', array(
            '_locale' => 'es'
        ));
    }

    /**
     * @Route("/{_locale}/admin", name="admin")
     *
     * @inheritDoc
     * @return Response Response
     */
    public function admin(): Response
    {
        if ($this->getUser() === NULL || (!in_array(User::ROLE_USER, $this->getUser()->getRoles()))):
            $response = $this->redirectToRoute('login', array(
                '_locale' => 'es'
            ));
        else:
            $response = $this->render('admin/index.html.twig');
        endif;

        return $response;
    }

    /**
     * @Route("/{_locale}/admin/login", name="login")
     *
     * @inheritDoc
     * @return Response Response
     */
    public function loginAction(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     *
     * @inheritDoc
     * @return Response Response
     */
    public function logoutAction(): Response
    {
        throw new RuntimeException('Esta ruta no debe ser llamada directamente.');
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return Dashboard Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proun Challenge');
    }

    /**
     * @inheritDoc
     * @return iterable iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Trip', 'fas fa-truck', Trip::class);
        yield MenuItem::linkToCrud('Point', 'fas fa-location', Point::class);
        yield MenuItem::linkToCrud('Usuario', 'fas fa-user', User::class);
    }

    /*********************************************** STATIC METHODS ***********************************************/

}
