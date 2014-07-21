<?php
namespace MJanssen\Controller;

use RuntimeException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

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
    public function getAction(Request $request, Application $app, $id)
    {
        throw new RuntimeException('This method is not implemented');
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function getCollectionAction(Request $request, Application $app)
    {
        throw new RuntimeException('This method is not implemented');
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function postAction(Request $request, Application $app)
    {
        throw new RuntimeException('This method is not implemented');
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return bool
     */
    public function deleteAction(Request $request, Application $app, $id)
    {
        throw new RuntimeException('This method is not implemented');
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function putAction(Request $request, Application $app, $id)
    {
        throw new RuntimeException('This method is not implemented');
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    protected function get(Application $app, $id)
    {
        return $app['service.rest.entity']->getAction($id);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    protected function getCollection(Application $app)
    {
        return $app['service.rest.entity']->getCollectionAction();
    }


    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return bool
     */
    protected function delete(Application $app, $id)
    {
        $app['service.rest.entity']->deleteAction($id);
        return true;

    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    protected function post(Application $app)
    {
        return $app['service.rest.entity']->postAction();

    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $id
     * @return mixed
     */
    protected function put(Application $app, $id)
    {
        return $app['service.rest.entity']->putAction($id);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param null $id
     * @return bool|mixed
     * @throws RuntimeException
     */
    public function resolveAction(Request $request, Application $app, $id = null)
    {
        switch ($request->getMethod()) {
            case 'GET' :
                if(null === $id) {
                    return $this->getCollectionAction($request, $app);
                }
                return $this->getAction($request, $app, $id);
    
            case 'POST' :
                return $this->postAction($request, $app);
                
            case 'PUT' :
                return $this->putAction($request, $app, $id);
                
            case 'DELETE' :
                return $this->deleteAction($request, $app, $id);
                
            default :
                throw new RuntimeException('Invalid method specified');
        }
    }
}
