<?php
namespace MJanssen\Service;

use Doctrine\Common\Persistence\ObjectRepository;

class ObjectService
{
    /**
     * @var ObjectRepository
     */
    protected $objectRepository;

    /**
     * @param ObjectRepository $objectRepository
     */
    public function __construct(ObjectRepository $objectRepository)
    {
        $this->objectRepository = $objectRepository;
    }

    /**
     * @param $identifier
     * @return null|object
     */
    public function find($identifier)
    {
        return $this->objectRepository->find($identifier);
    }
} 