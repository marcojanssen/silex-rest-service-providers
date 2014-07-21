<?php
namespace MJanssen\Service;

use Exception;
use Spray\PersistenceBundle\Repository\RepositoryFilter;
use Spray\PersistenceBundle\Repository\RepositoryFilterInterface;
use Symfony\Component\HttpFoundation\Request;
use Zend\Loader\PluginClassLoader;

/**
 * Class RequestFilterService
 * @package MJanssen\Service
 */
class RequestFilterService
{
    protected $filterLoaderClass;
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param PluginClassLoader $validatorClassName
     */
    public function setFilterLoaderClass(PluginClassLoader $filterLoaderClass)
    {
        try {
            $this->filterLoaderClass = new $filterLoaderClass;
        } catch (Exception $e) {

        }
    }

    /**
     * @return mixed
     */
    public function getFilterLoaderClass()
    {
        return $this->filterLoaderClass;
    }

    /**
     * @param RepositoryFilterInterface $repository
     * @return RepositoryFilterInterface
     */
    public function filter($repository)
    {
        return $this->applyFilters(
            new RepositoryFilter($repository)
        );
    }

    /**
     * @param RepositoryFilterInterface $repository
     * @return RepositoryFilterInterface
     */
    public function applyFilters(RepositoryFilterInterface $repository)
    {
        $filterLoaderClassName = $this->request->attributes->get('filter');
        if(empty($filterLoaderClassName)) {
            return $repository;
        }

        $filterLoader = new $filterLoaderClassName;

        foreach ($filterLoader->getIterator() as $pluginName => $pluginNamespace) {
            $filterParams = $this->request->query->get($pluginName);

            if (null !== $filterParams) {
                $repository->filter(new $pluginNamespace($filterParams));
            }
        }

        return $repository;
    }
}
