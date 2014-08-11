<?php
namespace MJanssen\Transformer;

use Silex\Application;

interface TransformerInterface
{
    /**
     * @param Application $app
     * @param $data
     * @return array
     */
    public function transformHydrateData(Application $app, $data);

    /**
     * @param Application $app
     * @param $data
     * @return array
     */
    public function transformExtractData(Application $app, $data);
} 