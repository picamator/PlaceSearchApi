<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\App\Di;

use Picamator\PlaceSearchApi\App\Exception\RuntimeException;
use Picamator\PlaceSearchApi\Search\Api\ConfigInterface;
use Picamator\PlaceSearchApi\Model\Api\ObjectManagerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Create Config
 *
 * @codeCoverageIgnore
 */
class ConfigFactory
{
    /**
     * @todo use private constant ofter migration to PHP7.1
     * @var string
     */
    private static $path = __DIR__ . '/../../../config/parameters.yml';

    /**
     * Create
     *
     * @param ObjectManagerInterface    $objectManager
     * @param string                    $className
     *
     * @return ConfigInterface
     */
    public static function create(
        ObjectManagerInterface $objectManager,
        $className = 'Picamator\PlaceSearchApi\Search\Config'
    ) : ConfigInterface {

        if (!file_exists(self::$path)) {
            throw new RuntimeException(
                sprintf('Configuration file "%s" does not exist', self::$path)
            );
        }

        $data = Yaml::parse(file_get_contents(self::$path));

        return $objectManager->create($className, [$data]);
    }
}
