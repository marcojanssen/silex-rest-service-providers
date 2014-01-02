<?php
namespace MJanssen\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Process\Exception\RuntimeException;

/**
 * Class RestController
 * @package MJanssen\Controller
 */
abstract class RestController
{
    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    protected function get(Request $request, Application $app, $id)
    {
        return $app['service.rest.entity']->getAction($id);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    protected function getCollection(Request $request, Application $app)
    {
        return $app['service.rest.entity']->getCollectionAction();
    }


    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return bool
     */
    protected function delete(Request $request, Application $app, $id)
    {
        $app['service.rest.entity']->deleteAction($id);
        return true;

    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    protected function post(Request $request, Application $app)
    {
        return $app['service.rest.entity']->postAction();

    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    protected function put(Request $request, Application $app, $id)
    {
        return $app['service.rest.entity']->putAction($id);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param null $id
     * @return bool|mixed
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public function resolveAction(Request $request, Application $app, $id = null)
    {
        $method = $request->getMethod();

        if('GET' === $method) {
            if(null === $id) {
                return $this->getCollectionAction($request, $app);
            }

            return $this->getAction($request, $app, $id);
        }

        if('POST' === $method) {
            return $this->postAction($request, $app);
        }

        if('PUT' === $method) {
            return $this->putAction($request, $app, $id);
        }

        if('DELETE' === $method) {
            return $this->deleteAction($request, $app, $id);
        }

        throw new RuntimeException('Invalid method specified');
    }
}
