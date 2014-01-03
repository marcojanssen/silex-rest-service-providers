<?php
namespace MJanssen\Controller;

use MJanssen\Fixtures\Controller\TestDefaultController;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the get action works
     */
    public function testGetAction()
    {
        $response = $this->getTestController()->getAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);

    }

    /**
     * Test if the getCollection action works
     */
    public function testGetCollectionAction()
    {
        $response = $this->getTestController()->getCollectionAction(
            $this->getMockRequest(),
            $this->getMockApplication()
        );

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }

    /**
     * Test if the delete action works
     */
    public function testDeleteAction()
    {
        $response = $this->getTestController()->deleteAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }

    /**
     * Test if the put action works
     */
    public function testPutAction()
    {
        $response = $this->getTestController()->putAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }

    /**
     * Test if the post action works
     */
    public function testPostAction()
    {
        $response = $this->getTestController()->postAction(
            $this->getMockRequest(),
            $this->getMockApplication()
        );

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
    }

    /**
     * Test if every method returns a response
     */
    public function testResolveAction()
    {
        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $this->executeResolveActionController('GET')
        );

        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $this->executeResolveActionController('GET', 1)
        );

        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $this->executeResolveActionController('POST')
        );

        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $this->executeResolveActionController('DELETE')
        );

        $this->assertInstanceOf(
            'Symfony\Component\HttpFoundation\Response',
            $this->executeResolveActionController('PUT')
        );
    }

    /**
     * @param $method
     * @param null $identifier
     * @return mixed
     */
    protected function executeResolveActionController($method, $identifier = null)
    {
        return $this->getTestController()->resolveAction(
            $this->getMockRequest($method),
            $this->getMockApplication(),
            $identifier
        );
    }

    /**
     * @return TestController
     */
    protected function getTestController()
    {
        return new TestDefaultController();
    }

    /**
     * @return Request
     */
    protected function getMockRequest($method = '')
    {
        $request = new Request;

        if(!empty($method)) {
            $request->setMethod($method);
        }

        return $request;
    }

    /**
     * @return Application
     */
    protected function getMockApplication()
    {
        $app = new Application();

        $serviceRestEntity = $this->getMock('MJanssen\Service\RestEntityService', array(), array($this->getMockRequest(), $app));

        $serviceRestEntity->expects($this->any())
                          ->method('get')
                          ->will($this->returnValue(array('getAction')));

        $serviceRestEntity->expects($this->any())
                          ->method('getCollection')
                          ->will($this->returnValue(array('getCollectionAction')));

        $serviceRestEntity->expects($this->any())
                          ->method('delete')
                          ->will($this->returnValue(array('deleteAction')));

        $serviceRestEntity->expects($this->any())
                          ->method('put')
                          ->will($this->returnValue(array('putAction')));

        $serviceRestEntity->expects($this->any())
                          ->method('post')
                          ->will($this->returnValue(array('postAction')));

        $app['service.rest.entity'] = $serviceRestEntity;

        return $app;
    }

}