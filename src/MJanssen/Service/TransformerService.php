<?php
namespace MJanssen\Service;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class TransformerService
{
    /**
     * @var \Silex\Application
     */
    protected $app;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @param Request $request
     * @param Application $app
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
            return $this->getTransformer()->transformHydrateData($this->app, $data);
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
            return $this->getTransformer()->transformExtractData($this->app, $data);
        }

        return $data;
    }
}