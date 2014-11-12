<?php
namespace MJanssen\Event;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\Event;

class RestGetEvent extends Event
{
    /**
     * @var object
     */
    protected $entity;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @param $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param EntityRepository $repository
     */
    public function setRepository(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

} 