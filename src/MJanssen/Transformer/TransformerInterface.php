<?php
namespace MJanssen\Transformer;

interface TransformerInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function transformHydrateData(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function transformExtractData(array $data);
} 