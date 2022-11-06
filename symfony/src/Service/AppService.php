<?php

namespace App\Service;

use Exception;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Interfaces\ORMInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Interfaces\AppServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\throwException;

class AppService extends AbstractController implements AppServiceInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /**
     * @var bool
     */
    protected bool $testMode;

    /**
     * @var ObjectManager
     */
    protected ObjectManager $entityManager;

    /************************************************* CONSTRUCT **************************************************/

    /**
     * AppService construct.
     *
     * @param ManagerRegistry $doctrine Doctrine to manage the ORM.
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->setEntityManager($doctrine->getManager());
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return ObjectManager ObjectManager
     */
    public function getEntityManager(): ObjectManager
    {
        return $this->entityManager;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setEntityManager(ObjectManager $entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return bool bool
     */
    public function persistAndFlush(ORMInterface $object): bool
    {
        $persisted = FALSE;
        try {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($object);
            $entityManager->flush();
            $persisted = TRUE;
        } catch (Exception $e) {
            throwException($e);
        }

        return $persisted;
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}