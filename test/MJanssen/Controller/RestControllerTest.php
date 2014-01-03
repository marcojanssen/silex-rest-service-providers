<?php
namespace MJanssen\Controller;

use MJanssen\Fixtures\Controller\TestRestController;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test case for a default controller setup without any implementation for each available method
 * @package MJanssen\Controller
 */
class RestControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the get action works
     * @expectedException RuntimeException
     */
    public function testGetAction()
    {
        $this->getTestController()->getAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );
    }

    /**
     * Test if the getCollection action works
     * @expectedException RuntimeException
     */
    public function testGetCollectionAction()
    {
        $this->getTestController()->getCollectionAction(
            $this->getMockRequest(),
            $this->getMockApplication()
        );
    }

    /**
     * Test if the delete action works
     * @expectedException RuntimeException
     */
    public function testDeleteAction()
    {
        $this->getTestController()->deleteAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );
    }

    /**
     * Test if the put action works
     * @expectedException RuntimeException
     */
    public function testPutAction()
    {
        $this->getTestController()->putAction(
            $this->getMockRequest(),
            $this->getMockApplication(),
            1
        );
    }

    /**
     * Test if the post action works
     * @expectedException RuntimeException
     */
    public function testPostAction()
    {
        $this->getTestController()->postAction(
            $this->getMockRequest(),
            $this->getMockApplication()
        );
    }

    /**
     * Test if a invalid method triggers an exception
     * @expectedException RuntimeException
     */
    public function testInvalidResolveAction()
    {
        $this->getTestController()->resolveAction(
            $this->getMockRequest('FOO'),
            $this->getMockApplication(),
            1
        );
    }

    /**
     * @return TestController
     */
    protected function getTestController()
    {
        return new TestRestController();
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
        return new Application;
    }

}