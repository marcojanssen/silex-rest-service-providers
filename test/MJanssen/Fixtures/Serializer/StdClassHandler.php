<?php

namespace MJanssen\Fixtures\Serializer;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;
use stdClass;

/**
 * StdClassHandler
 */
class StdClassHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'type'      => 'stdClass',
                'format'    => 'json',
                'method'    => 'serialize',
            ),
        );
    }
    
    public function serialize(VisitorInterface $visitor, stdClass $data, array $type, Context $context)
    {
        $data->serialized = true;
    }
}
