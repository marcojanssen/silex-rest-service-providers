<?php
namespace MJanssen\Service;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class TransformerService
{
    /**
     * @var string
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Application $app)
    {
        $this->request = $request;
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function getTransformer()
    {
        $transformerClassName = $this->request->attributes->get('transformer');

        if(null === $transformerClassName) {
            return;
        }

        try {
            $transformer = new $transformerClassName;
        } catch (Exception $e) {}

        return $transformer;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function transformHydrateData($data)
    {
        $transformer = $this->getTransformer();
        if(null !== $transformer) {
            return $this->getTransformer()->transformHydrateData($data, $this->app);
        }

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function transformExtractData($data)
    {
        $transformer = $this->getTransformer();
        if(null !== $transformer) {
            return $this->getTransformer()->transformExtractData($data, $this->app);
        }

        return $data;
    }
}