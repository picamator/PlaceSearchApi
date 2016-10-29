<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Engine\GoogleSearchPlace\Http;

use Picamator\PlaceSearchApi\Model\Api\ConfigInterface;
use Picamator\PlaceSearchApi\Model\Api\Http\ClientFactoryInterface;
use Picamator\PlaceSearchApi\Model\Api\Http\ClientInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;

/**
 * Create client
 */
class ClientFactory implements ClientFactoryInterface
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $configSection = 'http_client_place';

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var string
     */
    private $className;

    /**
     * @var ClientInterface
     */
    private $instance;

    /**
     * @param ObjectManagerInterface    $objectManager
     * @param ConfigInterface           $config
     * @param string                    $className
     */
    public function __construct(
        ObjectManagerInterface  $objectManager,
        ConfigInterface         $config,
        string                  $className = 'Picamator\PlaceSearchApi\Model\Client'
    ) {
        $this->objectManager    = $objectManager;
        $this->config           = $config;
        $this->className        = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create() : ClientInterface
    {
        if (!is_null($this->instance)) {
            return $this->instance;
        }

        $options['base_uri'] = $this->getBaseUri();

        // proxy
        $proxy  = $this->config->search(self::$configSection, 'proxy');
        if (!is_null($proxy)) {
            $options['proxy'] = $proxy;
        }

        $this->instance = $this->objectManager->create($this->className, $options);

        return $this->instance;
    }

    /**
     * Retrieve base url
     *
     * @return string
     */
    private function getBaseUri() : string
    {
        $uriPartList = [
            $this->config->search(self::$configSection, 'endpoint'),
            $this->config->search(self::$configSection, 'service'),
            $this->config->search(self::$configSection, 'operation'),
            $this->config->search(self::$configSection, 'format')
        ];

        $uri = array_map(function($item) {
            return trim($item, '/\\');
        }, $uriPartList);

        return implode('/', $uri);
    }
}
