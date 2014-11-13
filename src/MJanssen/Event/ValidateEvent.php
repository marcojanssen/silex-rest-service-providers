<?php
namespace MJanssen\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

class ValidateEvent extends GenericEvent
{

    /**
     * @var array
     */
    protected $result;

    /**
     * @param $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

} 