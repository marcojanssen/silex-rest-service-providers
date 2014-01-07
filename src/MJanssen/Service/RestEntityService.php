<?php
namespace MJanssen\Service;

use MJanssen\Filters\FilterLoader;
use Silex\Application;
use Spray\PersistenceBundle\EntityFilter\Common\Ascending;
use Spray\PersistenceBundle\Repository\RepositoryFilter;
use Spray\PersistenceBundle\Repository\RepositoryFilterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RestEntityService
{
    protected $request;
    protected $app;

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
        $limit = $this->request->query->get('limit');

        if(null !== $page) {
            if(null === $limit || !is_numeric($limit)) {
                $limit = 20;
            }

            $repository = $repository->paginate($page, $limit);
        }

        return $this->app['doctrine.extractor']->extractEntities(
            $repository,
            'list'
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
     * @param string $field
     * @return mixed
     */
    public function getEntityFromRepository($id, $field = 'id')
    {
        $repository = $this->getEntityRepository();

        $entity = $repository->findOneBy(
            array($field => $id)
        );

        return $entity;
    }

    /**
     * @param $entity
     * @param $app
     * @param $id
     */
    public function isValidEntity($entity, $id)
    {
        if(null === $entity) {
            $this->app->abort(404, "$id does not exist.");
        }
    }

    /**
     * @param Request $request
     * @param Application $app
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
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function getEntityRepository()
    {
        return $this->app['orm.em']->getRepository(
            $this->getEntityName()
        );
    }
}