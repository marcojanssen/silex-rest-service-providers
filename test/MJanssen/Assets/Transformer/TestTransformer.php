<?php
namespace MJanssen\Assets\Transformer;

use Silex\Application;
use MJanssen\Transformer\TransformerInterface;

class TestTransformer implements TransformerInterface
{
    /**
     * @param Application $app
     * @param array $data
     * @return array
     */
    public function transformHydrateData(Application $app, $data)
    {
        return $data;
    }

    /**
     * @param Application $app
     * @param array $data
     * @return array
     */
    public function transformExtractData(Application $app, $data)
    {
        return $data;
    }
}