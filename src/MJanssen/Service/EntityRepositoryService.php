<?php
namespace MJanssen\Service;

use Doctrine\ORM\EntityManager;

class EntityRepositoryService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $entityName
     * @return \Doctrine\ORM\EntityRepository
     */
    public function get($entityName)
    {
        return $this->entityManager->getRepository($entityName);
    }
} 