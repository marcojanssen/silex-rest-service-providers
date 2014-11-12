<?php
namespace MJanssen\Service;

use JMS\Serializer\Serializer;

class HydratorService
{
    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @param $entityName
     * @return mixed
     */
    public function hydrateEntity($data, $entityName)
    {
        if(is_string($data)) {
            $data = json_decode($data, true);
        }
        return $this->serializer->deserialize(
            json_encode($data),
            $entityName,
            'json'
        );
    }
}