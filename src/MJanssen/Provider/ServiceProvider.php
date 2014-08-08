<?php
namespace MJanssen\Provider;

use JMS\Serializer\Construction\DoctrineObjectConstructor;
use JMS\Serializer\Construction\UnserializeObjectConstructor;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use MJanssen\Filters\PropertyFilter;
use MJanssen\Service\ExtractorService;
use MJanssen\Service\HydratorService;
use MJanssen\Service\RequestFilterService;
use MJanssen\Service\ResolverService;
use MJanssen\Service\RestEntityService;
use MJanssen\Service\TransformerService;
use MJanssen\Service\ValidatorService;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package MJanssen\Provider
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     * @codeCoverageIgnore
     */
    public function boot(Application $app)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app['serializer'] = $app->share(function($app) {

            $createSerializer = SerializerBuilder::create();

            if(isset($app['serializer.cache.path'])) {
                $createSerializer->setCacheDir($app['serializer.cache.path']);
            }

            if (isset($app['serializer.handlers']) && is_array($app['serializer.handlers'])) {
                $createSerializer->addDefaultHandlers();
                $createSerializer->configureHandlers(
                    function(HandlerRegistry $handlerRegistry) use ($app) {
                        foreach ($app['serializer.handlers'] as $handlerClass) {
                            $handlerRegistry->registerSubscribingHandler(new $handlerClass);
                        }
                    }
                );
            }

            if(isset($app['debug'])) {
                $createSerializer->setDebug($app['debug']);
            }

            if(isset($app['doctrine'])) {
                $createSerializer->setObjectConstructor($app['serializer.object.constructor']);
            }

            return $createSerializer->build();
        });

        $app['serializer.object.constructor'] = $app->share(function($app) {

            $objectConstructor = new UnserializeObjectConstructor();

            if(isset($app['doctrine'])) {
                $objectConstructor = new DoctrineObjectConstructor($app['doctrine'], $objectConstructor);
            }

            return $objectConstructor;
        });

        $app['service.transformer'] = $app->share(function($app) {
            return new TransformerService($app['request'], $app);
        });

        $app['doctrine.extractor'] = $app->share(function($app) {
            return new ExtractorService($app['serializer'], $app['service.transformer']);
        });

        $app['doctrine.hydrator'] = $app->share(function($app) {
            return new HydratorService($app['serializer'], $app['service.transformer']);
        });

        $app['doctrine.resolver'] = $app->share(function($app) {
            return new ResolverService($app['orm.em']);
        });

        $app['service.request.filter'] = $app->share(function($app) {
            return new RequestFilterService($app['request']);
        });

        $app['service.validator'] = $app->share(function($app) {
            return new ValidatorService($app['service.validator'], $app['request']);
        });

        $app['service.rest.entity'] = $app->share(function($app) {
            return new RestEntityService($app['request'], $app);
        });
    }
}
