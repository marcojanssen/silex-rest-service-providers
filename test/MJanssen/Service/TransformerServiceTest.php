<?php
namespace MJanssen\Service;

use JMS\Serializer\SerializerBuilder;
use MJanssen\Fixtures\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

class TransformerServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test transforming hydrated data
     */
    public function testTransformData()
    {
        $request = new Request;
        $request->attributes->set('transformer', 'MJanssen\Fixtures\Transformer\TestTransformer');

        $service = new TransformerService($request);

        $data = array('foo' => 'baz');

        $this->assertEquals($data, $service->transformHydrateData($data));
        $this->assertEquals($data, $service->transformExtractData($data));
    }
}