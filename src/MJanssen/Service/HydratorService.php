<?php
namespace MJanssen\Service;

use JMS\Serializer\Serializer;

class HydratorService
{
    protected $serializer;
    protected $transformer;

    /**
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer, TransformerService $transformer)
    {
        $this->serializer = $serializer;
        $this->transformer = $transformer;
    }

    /**
     * @param $data
     * @param $entity
     * @return object
     */
    public function hydrateEntity($data, $entityName)
    {
        return $this->serializer->deserialize(
            $this->transformer->transformHydrateData($data),
            $entityName,
            'json'
        );
    }
}