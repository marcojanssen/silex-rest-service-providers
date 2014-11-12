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
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
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

        return json_decode($this->serializer->serialize($entity, 'json', $serializedContext), true);
    }
}