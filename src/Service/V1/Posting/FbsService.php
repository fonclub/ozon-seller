<?php

declare(strict_types=1);

namespace Gam6itko\OzonSeller\Service\V1\Posting;

use Gam6itko\OzonSeller\Service\AbstractService;
use Gam6itko\OzonSeller\TypeCaster;
use Gam6itko\OzonSeller\Utils\ArrayHelper;

class FbsService extends AbstractService
{
    private $path = '/v1/posting/fbs';

    /**
     * @see https://docs.ozon.ru/api/seller/#operation/PostingAPI_GetCarriageAvailableList
     *
     * @param array $params [containers_count, delivery_method_id, departure_date]
     */
    public function carriageAvailableList(array $params): array
    {
        $config = [
            'delivery_method_id' => 'int',
            'departure_date'     => 'string',
        ];

        $params = ArrayHelper::pick($params, array_keys($config));
        $params = TypeCaster::castArr($params, $config);
        $result = $this->request('POST', "/v1/posting/carriage-available/list", $params);

        return $result;
    }
}
