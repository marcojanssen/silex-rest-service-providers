<?php
namespace MJanssen\Service;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class TransformerServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $request = new Request;
        $request->attributes->set('transformer', 'MJanssen\Assets\Transformer\TestTransformer');

        $service = new TransformerService($request, new Application());

        $data = array('foo' => 'baz');

        $this->assertEquals($data, $service->transformHydrateData($data));
        $this->assertEquals($data, $service->transformExtractData($data));
    }
}