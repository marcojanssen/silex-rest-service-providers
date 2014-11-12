<?php
namespace MJanssen\Event;



class GetEvent extends AbstractEvent
{
    /**
     * @var integer
     */
    protected $identifier;

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param int $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }
} 