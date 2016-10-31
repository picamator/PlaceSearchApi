<?php
namespace Picamator\PlaceSearchApi\App\Api;

/**
 * General abstraction fpr Service
 */
interface ServiceInterface
{
    /**
     * Execute
     *
     * @param array $data
     * @param array ...$arguments
     *
     * @return mixed
     */
    public function execute(array $data = [], ...$arguments);
}
