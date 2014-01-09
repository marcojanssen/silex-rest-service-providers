<?php
namespace MJanssen\Service;

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
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getTransformer()
    {
        $transformerClassName = $this->request->attributes->get('transformer');
        try {
            $transformer = new $transformerClassName;
        } catch (Exception $e) {}

        return $transformer;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function transformRequestData($data)
    {
        return $this->getTransformer()->transformRequestData($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function transformResponseData($data)
    {
        return $this->getTransformer()->transformRequestData($data);
    }
}