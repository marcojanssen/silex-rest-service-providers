<?php
namespace MJanssen\Service;

use Doctrine\Common\Persistence\ObjectManager;

class ObjectRepositoryService
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