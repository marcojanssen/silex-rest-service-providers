<?php
namespace MJanssen\Service;

use Doctrine\ORM\EntityRepository;

class EntityService
{
    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param $identifier
     * @return null|object
     */
    public function getEntity($identifier)
    {
        return $this->entityRepository->find($identifier);
    }
} 