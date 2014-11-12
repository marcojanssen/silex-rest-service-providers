<?php
namespace MJanssen\Transformer;

use Silex\Application;

interface TransformerInterface
{
    /**
     * @param $object
     * @return object
     */
    public function transform($object);
} 