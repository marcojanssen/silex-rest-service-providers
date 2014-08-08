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
        return $this->serializer->deserialize(
            $this->transformer->transformHydrateData($data),
            $entityName,
            'json'
        );
    }
}