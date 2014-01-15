<?php
namespace MJanssen\Service;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;

class ExtractorService
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
     * @param $entities
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
     * @return array
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