<?php
namespace MJanssen\Assets\Transformer;

use MJanssen\Transformer\TransformerInterface;

class TestTransformer implements TransformerInterface
{
    /**
     * @param $object
     * @return object
     */
    public function transform($object)
    {
        $object->name = 'Transformed';

        return $object;
    }
}