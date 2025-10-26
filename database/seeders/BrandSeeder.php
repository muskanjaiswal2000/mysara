<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MySara\Common\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $items = $this->getBrands();
        if ($items) {
            Brand::query()->truncate();
            foreach ($items as $item) {
                Brand::query()->create($item);
            }
        }
    }

    private function getBrands(): array
    {
        return [
            [
                'name'     => 'Adidas',
                'slug'     => 'adidas',
                'first'    => 'A',
                'logo'     => 'images/demo/brands/adidas.png',
                'position' => 0,
                'active'   => true,
            ],
            [
                'name'     => 'Nike',
                'slug'     => 'nike',
                'first'    => 'N',
                'logo'     => 'images/demo/brands/nike.png',
                'position' => 1,
                'active'   => true,
            ],
        ];
    }
}
