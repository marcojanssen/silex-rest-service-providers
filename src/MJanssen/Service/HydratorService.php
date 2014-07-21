<?php
namespace MJanssen\Service;

use JMS\Serializer\Serializer;

class HydratorService
{
    
    /**
     * @var Serializer 
     */
    protected $serializer;
    
    /**
     * @var TransformerService
     */
    protected $transformer;

    /**
     * @param Serializer $serializer
     * @param TransformerService $transformer
     */
    public function __construct(Serializer $serializer, TransformerService $transformer)
    {
        $this->serializer = $serializer;
        $this->transformer = $transformer;
    }

    /**
     * @param $data
     * @param $entityName
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