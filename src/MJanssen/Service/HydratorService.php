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
     * @return mixed
     */
    public function hydrateEntity($data, $entityName)
    {
        if(is_string($data)) {
            $data = json_decode($data, true);
        }
        return $this->serializer->deserialize(
            json_encode($this->transformer->transformHydrateData($data)),
            $entityName,
            'json'
        );
    }
}