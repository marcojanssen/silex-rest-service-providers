<?php
namespace MJanssen\Event;

use Symfony\Component\EventDispatcher\Event;

class RestGetEvent extends Event
{
    protected $entity;

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

} 