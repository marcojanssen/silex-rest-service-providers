<?php
namespace MJanssen\Transformer;

use Silex\Application;

interface TransformerInterface
{
    /**
     * @param array $data
     * @param Application $app
     * @return mixed
     */
    public function transformHydrateData($data, Application $app);

    /**
     * @param array $data
     * @param Application $app
     * @return mixed
     */
    public function transformExtractData($data, Application $app);
} 