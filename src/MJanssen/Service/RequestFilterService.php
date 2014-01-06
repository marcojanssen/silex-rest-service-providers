<?php
namespace MJanssen\Service;

use Spray\PersistenceBundle\Repository\RepositoryFilter;
use Spray\PersistenceBundle\Repository\RepositoryFilterInterface;
use Symfony\Component\HttpFoundation\Request;
use Zend\Loader\PluginClassLoader;

use MJanssen\Filters\FilterLoader;

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
     * @param $repository
     * @param Request $request
     * @return RepositoryFilterInterface
     */
    public function applyFilters(RepositoryFilterInterface $repository)
    {
        $filterLoader = new FilterLoader();

        foreach ($filterLoader->getPlugins() as $pluginName => $pluginNamespace) {
            $filterParams = $this->request->get($pluginName);

            if (null !== $filterParams && is_array($filterParams)) {
                $repository->filter(new $pluginNamespace($filterParams));
            }
        }

        return $repository;
    }
}
