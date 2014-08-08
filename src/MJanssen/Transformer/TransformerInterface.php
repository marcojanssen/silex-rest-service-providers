<?php
namespace MJanssen\Transformer;

use Silex\Application;

interface TransformerInterface
{
    /**
     * @param Application $app
     * @param array $data
     * @return array
     */
    public function transformHydrateData(Application $app, array $data);

    /**
     * @param Application $app
     * @param array $data
     * @return array
     */
    public function transformExtractData(Application $app, array $data);
} 