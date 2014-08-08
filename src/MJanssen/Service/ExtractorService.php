<?php
namespace MJanssen\Service;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;

class ExtractorService
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
     * @param $entities
     * @param $group
     * @return array
     */
    public function extractEntities($entities, $group)
    {
        $extractedItems = array();

        foreach($entities AS $entity) {
            $extractedItems[] = $this->extractEntity($entity, $group);
        }

        return $extractedItems;

    }

    /**
     * @param $entity
     * @param $group
     * @return mixed
     */
    public function extractEntity($entity, $group)
    {
        $serializedContext = SerializationContext::create()->setGroups(array($group))
                                                           ->setSerializeNull(true);
        return $this->transformer->transformExtractData(
            json_decode($this->serializer->serialize($entity, 'json', $serializedContext), true)
        );
    }
}