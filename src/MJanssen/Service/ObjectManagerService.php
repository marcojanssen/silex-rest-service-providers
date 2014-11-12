<?php
namespace MJanssen\Service;

use Doctrine\Common\Persistence\ObjectManager;

class ObjectManagerService
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param $objectManager
     * @return mixed
     */
    public function getRepository($objectName)
    {
        return $this->objectManager->getRepository($objectName);
    }
} 