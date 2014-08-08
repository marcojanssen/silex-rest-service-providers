<?php
namespace MJanssen\Assets\Filter;

use Zend\Loader\PluginClassLoader;

class TestFilterLoader extends PluginClassLoader
{
    protected $plugins = array(
        'foo'  => 'Spray\PersistenceBundle\EntityFilter\Common\Like'
    );

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

}