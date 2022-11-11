<?php

namespace App\Controller\Admin;

use App\Entity\Trip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class TripCrudController extends AbstractCrudController
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /************************************************* CONSTRUCT **************************************************/

    /******************************************** GETTERS AND SETTERS *********************************************/

    /************************************************** ROUTING ***************************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Method to configure the base params of the CRUD.
     *
     * @return Crud Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Trip')
            ->setEntityLabelInPlural('Trips')
            ->setSearchFields(array('uuid', 'serviceLocator', 'vehicle'))
            ->setPageTitle(Crud::PAGE_EDIT, 'Ver Trip')
            ->setHelp(
                Crud::PAGE_EDIT,
                'En esta vista podrás ver la entidad Trip del aplicativo.'
            );
    }

    /**
     * @inheritDoc
     * @return iterable iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return array(
            FormField::addPanel('Información General'),
            IdField::new('id')->hideOnForm(),
            TextField::new('uuid', 'UUID')->setDisabled(TRUE),
            TextField::new('serviceLocator', 'Localizador de servicio')->setDisabled(TRUE),
            AssociationField::new('collectionPoint', 'Punto de recogida')->setDisabled(TRUE),
            AssociationField::new('destinationPoint', 'Punto de destino')->setDisabled(TRUE),
            TextField::new('vehicle', 'Vehículo')->setDisabled(TRUE),
        );
    }

    /**
     * Method to configure the Filters of the index.
     *
     * @return Filters Filters
     */
    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add(TextFilter::new('uuid', 'UUID'))
            ->add(TextFilter::new('serviceLocator', 'Localizador de servicio'));
    }

    /**
     * Method to configure the actions of the views.
     *
     * @param Actions $actions Actions to configure.
     *
     * @return Actions Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        parent::configureActions($actions);

        return $actions
            ->disable('new', 'detail');
    }

    /*********************************************** STATIC METHODS ***********************************************/

    /**
     * Method to get the entity FQCN of the Business. It returns the Business::class.
     *
     * @return string string
     */
    public static function getEntityFqcn(): string
    {
        return Trip::class;
    }

}
