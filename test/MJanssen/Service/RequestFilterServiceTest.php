<?php
namespace MJanssen\Service;

use MJanssen\Service\RequestValidatorService;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\HttpFoundation\Request;

class RequestFilterServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test if filtering works
     */
    public function testFilter()
    {
        $app = $this->getMockApplication();

        $request = $this->getMock('Symfony\Component\HttpFoundation\Request', array());
        //$request->attributes->set('filter', 'MJanssen\Assets\Filter\TestFilterLoader');
    }

    /**
     * Get a mock silex application
     * @return Application
     */
    protected function getMockApplication()
    {
        return new Application();
    }

}