<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Di\Guzzle;

use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Picamator\PlaceSearchApi\Search\Api\ConfigInterface;
use GuzzleHttp\ClientInterface;

/**
 * Build client
 *
 * @todo simplify factory
 *
 * @codeCoverageIgnore
 */
class ClientFactory
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $configSection = 'http_client_place';

    /**
     * @param ConfigInterface           $config
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     *
     * @return ClientInterface
     */
    public static function create(
        ConfigInterface         $config,
        ObjectManagerInterface  $objectManager,
        string                  $className = 'GuzzleHttp\Client'
    ) : ClientInterface {

        $options['base_uri'] = self::getBaseUri($config);

        // defaults
        $verify = $config->search(self::$configSection, 'verify');
        if (!is_null($verify)) {
            $options['verify'] = $verify;
        }

        // proxy
        $proxy  = $config->search(self::$configSection, 'proxy');
        if (!is_null($proxy)) {
            $options['proxy'] = $proxy;
        }

        return $objectManager->create($className, [$options]);
    }

    /**
     * Retrieve base url
     *
     * @param ConfigInterface $config
     *
     * @return string
     */
    private static function getBaseUri(ConfigInterface $config) : string
    {
        $uriPartList = [
            $config->search(self::$configSection, 'endpoint'),
            $config->search(self::$configSection, 'service'),
            $config->search(self::$configSection, 'operation'),
            $config->search(self::$configSection, 'format')
        ];

        $uri = array_map(function($item) {
            return trim($item, '/\\');
        }, $uriPartList);

        return implode('/', $uri);
    }
}
