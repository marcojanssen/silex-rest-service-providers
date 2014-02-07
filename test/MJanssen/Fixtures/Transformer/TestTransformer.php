<?php
namespace MJanssen\Fixtures\Transformer;

use Silex\Application;

class TestTransformer implements \MJanssen\Transformer\TransformerInterface
{
    /**
     * @param array $data
     * @return array|mixed
     */
    public function transformHydrateData($data, Application $app)
    {
        return $data;
    }

    /**
     * @param array $data
     * @return array|mixed
     */
    public function transformExtractData($data, Application $app)
    {
        return $data;
    }
}