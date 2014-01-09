<?php
namespace MJanssen\Transformer;

interface TransformerInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function transformRequestData(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function transformResponseData(array $data);
} 