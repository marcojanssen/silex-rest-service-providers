<?php
namespace MJanssen\Controller;

use MJanssen\Assets\Controller\TestRestController;
use Silex\Application;

/**
 * Test case for a default controller setup without any implementation for each available method
 * @package MJanssen\Controller
 */
class RestControllerTest extends AbstractControllerTest
{
    /**
     * Test if the get action works
     * @expectedException RuntimeException
     */
    public function testGetAction()
    {
        $this->doGetAction();
    }

    /**
     * Test if the getCollection action works
     * @expectedException RuntimeException
     */
    public function testGetCollectionAction()
    {
        $this->doGetCollectionAction();
    }

    /**
     * Test if the delete action works
     * @expectedException RuntimeException
     */
    public function testDeleteAction()
    {
        $this->doDeleteAction();
    }

    /**
     * Test if the put action works
     * @expectedException RuntimeException
     */
    public function testPutAction()
    {
        $this->doPutAction();
    }

    /**
     * Test if the post action works
     * @expectedException RuntimeException
     */
    public function testPostAction()
    {
        $this->doPostAction();
    }

    /**
     * Test if a invalid method triggers an exception
     * @expectedException RuntimeException
     */
    public function testInvalidResolveAction()
    {
        $this->doResolveAction('FOO');
    }

    /**
     * @return TestController
     */
    protected function getTestController()
    {
        return new TestRestController();
    }
}