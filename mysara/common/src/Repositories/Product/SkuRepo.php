<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Repositories\Product;

use Illuminate\Database\Eloquent\Builder;
use MySara\Common\Models\Product;
use MySara\Common\Models\Product\Sku;
use MySara\Common\Repositories\BaseRepo;

class SkuRepo extends BaseRepo
{
    /**
     * @param  $code
     * @return Sku|null
     */
    public function getSkuByCode($code): ?Sku
    {
        return Sku::query()->where('code', $code)->first();
    }

    /**
     * @param  $code
     * @return mixed|null
     */
    public function getProductByCode($code): ?Product
    {
        return Sku::query()->where('code', $code)->first()->product ?? null;
    }

    /**
     * Create a query builder for SKUs.
     *
     * @param  array  $filters
     * @return Builder
     */
    public function builder(array $filters = []): Builder
    {
        $builder = Sku::query()->with('product.translation');

        $keyword = $filters['keyword'] ?? '';
        if ($keyword) {
            $builder->where(function ($query) use ($keyword) {
                $query->where('code', 'like', "%{$keyword}%")
                    ->orWhereHas('product.translation', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        return $builder;
    }

    /**
     * Search SKUs by keyword.
     *
     * @param  ?string  $keyword
     * @return \Illuminate\Support\Collection
     */
    public function searchByKeyword(?string $keyword, $limit = 10)
    {
        return $this->builder(['keyword' => $keyword])
            ->limit($limit)
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}
