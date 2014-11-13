<?php
namespace MJanssen\Event;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Validator\Constraint;

class ValidateEvent extends GenericEvent
{

    /**
     * @var array
     */
    protected $result;

    protected $constraints;

    protected $groups;

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return array
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param $constraints
     */
    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
    }

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