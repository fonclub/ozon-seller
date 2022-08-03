<?php

declare(strict_types=1);

namespace Gam6itko\OzonSeller\Service\V3;

use Gam6itko\OzonSeller\Service\AbstractService;
use Gam6itko\OzonSeller\Utils\ArrayHelper;

/**
 * @author Alexander Strizhak <gam6itko@gmail.com>
 */
class ProductService extends AbstractService
{
    private $path = '/v3/product';


    /**
     * @see https://docs.ozon.ru/api/seller/#operation/ProductAPI_GetProductAttributesV3
     */
    public function infoAttributes(array $filter, int $limit = 1000, string $last_id = ''): array
    {
        $keys   = ['offer_id', 'product_id'];
        $filter = ArrayHelper::pick($filter, $keys);

        foreach ($keys as $k) {
            if (isset($filter[$k]) && ! is_array($filter[$k])) {
                $filter[$k] = [$filter[$k]];
            }
        }

        if (isset($filter['offer_id'])) {
            $filter['offer_id'] = array_map('strval', $filter['offer_id']);
        }

        $query = [
            'filter'  => $filter,
            'last_id' => $last_id,
            'limit'   => $limit,
        ];

        return $this->request('POST', "{$this->path}s/info/attributes", $query);
    }
}
