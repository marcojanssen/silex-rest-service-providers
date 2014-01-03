<?php
namespace MJanssen\Fixtures\Controller;

use MJanssen\Controller\RestController;
use MJanssen\Controller\RestControllerInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TestDefaultController extends RestController implements RestControllerInterface
{

    /**
     * @SWG\Api(
     *     path="/items/{itemId}.{format}",
     *     @SWG\Operations(
     *         @SWG\Operation(httpMethod="GET", responseClass="Item")
     *     )
     * )
     * @SWG\ErrorResponse(code="404", reason="Item not found")
     */
    public function getAction(Request $request, Application $app, $id)
    {
        return new Response(
            $this->get($app, $id)
        );
    }

    /**
     * @SWG\Api(
     *     path="/items.{format}",
     *     @SWG\Operations(
     *         @SWG\Operation(httpMethod="GET", responseClass="Item")
     *     )
     * )
     */
    public function getCollectionAction(Request $request, Application $app)
    {
        return new Response(
            $this->getCollection($app)
        );
    }

    /**
     * @SWG\Api(
     *     path="/items/{itemId}",
     *     @SWG\Operations(
     *         @SWG\Operation(httpMethod="DELETE", responseClass="Item")
     *     )
     * )
     * @SWG\ErrorResponse(code="404", reason="Item not found")
     */
    public function deleteAction(Request $request, Application $app, $id)
    {
        if($this->delete($app, $id)) {
            return new Response('',204);
        }
    }

    /**
     * @SWG\Api(
     *     path="/items",
     *     @SWG\Operations(
     *         @SWG\Operation(httpMethod="POST", responseClass="Item")
     *     )
     * )
     */
    public function postAction(Request $request, Application $app)
    {
        return new Response(
            $this->post($app)
        );
    }

    /**
     * @SWG\Api(
     *     path="/items/{itemId}.{format}",
     *     @SWG\Operations(
     *         @SWG\Operation(httpMethod="PUT", responseClass="Item")
     *     )
     * )
     * @SWG\ErrorResponse(code="404", reason="Item not found")
     */
    public function putAction(Request $request, Application $app, $id)
    {
        return new Response(
            $this->put($app, $id)
        );
    }

}