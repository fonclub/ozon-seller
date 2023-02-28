<?php

declare(strict_types=1);

namespace Gam6itko\OzonSeller\Service\V1;

use Gam6itko\OzonSeller\Service\AbstractService;
use Gam6itko\OzonSeller\Utils\ArrayHelper;

class WarehouseService extends AbstractService
{
    private $path = '/v1/warehouse';

    public function list(): array
    {
        return $this->request('POST', "{$this->path}/list");
    }

    /**
     * @see https://docs.ozon.ru/api/seller/#operation/WarehouseAPI_DeliveryMethodList
     *
     * @param array $requestData
     *
     * @return array
     */
    public function deliveryMethodList(array $requestData = []): array
    {
        $default = [
            'filter' => null,
            'offset' => 0,
            'limit'  => 50,
        ];

        $requestData = array_merge(
            $default,
            ArrayHelper::pick($requestData, array_keys($default))
        );

        return $this->request('POST', "/v1/delivery-method/list", $requestData);
    }
}
