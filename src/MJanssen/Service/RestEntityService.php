<?php
namespace MJanssen\Service;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class RestEntityService
{
    /**
     * @var type Request
     */
    protected $request;
    
    /**
     * @var Application 
     */
    protected $app;
    
    /**
     * @var string
     */
    protected $fieldNameIdentifier = 'id';

    /**
     * @param Request $request
     * @param Application $app
     */
    public function __construct(Request $request, Application $app)
    {
        $this->request = $request;
        $this->app = $app;
    }

    /**
     * @param $identifier
     * @return mixed
     */
    public function getAction($identifier)
    {
        $entity = $this->getEntityFromRepository($identifier);
        $this->isValidEntity($entity, $identifier);

        return $this->app['doctrine.extractor']->extractEntity(
            $entity,
            'detail'
        );
    }

    /**
     * @return array
     */
    public function getCollectionAction()
    {
        $repository = $this->app['service.request.filter']->filter(
            $this->getEntityRepository()
        );

        $page = $this->request->query->get('page');
        if(null === $page) {
            $page = 1;
        }

        $limit = $this->request->query->get('limit');
        if(null === $limit || !is_numeric($limit)) {
            $limit = 20;
        }

        $repository = $repository->paginate($page, $limit);

        return array(
            'data' => $this->app['doctrine.extractor']->extractEntities(
                $repository,
                'list'
            ),
            'pagination' => array(
                'page' => $page,
                'limit' => $limit,
                'total' => $repository->count()
            )
        );
    }

    /**
     * @param $identifier
     * @return array
     */
    public function deleteAction($identifier)
    {
        $entity = $this->getEntityFromRepository($identifier);
        $this->isValidEntity($entity, $identifier);

        $this->app['orm.em']->remove($entity);
        $this->app['orm.em']->flush();

        return true;
    }

    /**
     * @return array
     */
    public function postAction()
    {
        $response = $this->app['service.request.validator']->validateRequest();
        if(null !== $response) {
            return $response;
        }

        $entity = $this->app['doctrine.hydrator']->hydrateEntity(
            $this->request->getContent(),
            $this->getEntityName()
        );

        $this->app['orm.em']->persist($entity);
        $this->app['orm.em']->flush();

        return $this->app['doctrine.extractor']->extractEntity(
            $entity,
            'detail'
        );
    }

    /**
     * @param $identifier
     * @return array
     */
    public function putAction($identifier)
    {
        $response = $this->app['service.request.validator']->validateRequest();
        if(null !== $response) {
            return $response;
        }

        $entity = $this->getEntityFromRepository($identifier);
        $this->isValidEntity($entity, $identifier);

        $updatedEntity = $this->app['doctrine.hydrator']->hydrateEntity(
            $this->request->getContent(),
            $this->getEntityName()
        );

        $this->app['orm.em']->merge($updatedEntity);
        $this->app['orm.em']->flush();

        return $this->app['doctrine.extractor']->extractEntity(
            $updatedEntity,
            'detail'
        );
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getEntityFromRepository($id)
    {
        $repository = $this->getEntityRepository();

        $entity = $repository->findOneBy(
            array($this->getFieldNameIdentifier() => $id)
        );

        return $entity;
    }

    /**
     * @param $entity
     * @param $id
     */
    public function isValidEntity($entity, $id)
    {
        if(null === $entity) {
            $this->app->abort(404, "$id does not exist.");
        }
    }

    /**
     * @return mixed
     */
    public function getEntityName()
    {
        return $this->app['doctrine.resolver']->getEntityClassName(
            $this->request->attributes->get('namespace'),
            $this->request->attributes->get('entity')
        );
    }

    /**
     * @return mixed
     */
    public function getEntityRepository()
    {
        return $this->app['orm.em']->getRepository(
            $this->getEntityName()
        );
    }
    
    /**
     * @return string
     */
    public function getFieldNameIdentifier()
    {
        return $this->fieldNameIdentifier;
    }

    /**
     * @param string $fieldNameIdentifier
     */
    public function setFieldNameIdentifier($fieldNameIdentifier)
    {
        $this->fieldNameIdentifier = $fieldNameIdentifier;
    }
}