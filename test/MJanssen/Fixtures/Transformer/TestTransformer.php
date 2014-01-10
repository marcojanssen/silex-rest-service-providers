<?php
namespace MJanssen\Fixtures\Transformer;

class TestTransformer implements \MJanssen\Transformer\TransformerInterface
{
    /**
     * @param array $data
     * @return array|mixed
     */
    public function transformHydrateData(array $data)
    {
        return $data;
    }

    /**
     * @param array $data
     * @return array|mixed
     */
    public function transformExtractData(array $data)
    {
        return $data;
    }
}