<?php
declare(strict_types = 1);

namespace Picamator\PlaceSearchApi\Search;

use Picamator\PlaceSearchApi\Search\Api\ConfigInterface;

/**
 * Config
 */
class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $container = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
       $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function search(...$arguments)
    {
        if (empty($arguments)) {
            return $this->data;
        }

        // cache data inside container
        $containerKey = implode('_', $arguments);
        if (!array_key_exists($containerKey, $this->container)) {
            $this->container[$containerKey] = $this->getData($arguments, $this->data);
        }

        return $this->container[$containerKey];
    }

    /**
     * Retrieve data
     *
     * @param array $keyPool
     * @param array $data
     *
     * @return mixed
     */
    private function getData(array $keyPool, array $data)
    {
        $key = array_shift($keyPool);
        if (empty($keyPool)) {
            return $data[$key] ?? null;
        }

        // no data for key
        if (!isset($data[$key])) {
            return null;
        }

        return $this->getData($keyPool, $data[$key]);
    }
}
