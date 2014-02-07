<?php
namespace MJanssen\Service;

use JMS\Serializer\SerializerBuilder;
use MJanssen\Fixtures\Entity\Test;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class TransformerServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test transforming hydrated data
     */
    public function testTransformData()
    {
        $request = new Request;
        $request->attributes->set('transformer', 'MJanssen\Fixtures\Transformer\TestTransformer');

        $app = new Application();

        $service = new TransformerService($request, $app);

        $data = array('foo' => 'baz');

        $this->assertEquals($data, $service->transformHydrateData($data));
        $this->assertEquals($data, $service->transformExtractData($data));
    }
}