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
use MySara\Common\Models\Customer\Group as CustomerGroup;

class CustomerGroupSeeder extends Seeder
{
    public function run(): void
    {
        $items = $this->getCustomerGroups();
        if ($items) {
            // Keep only English translations
            $items = array_map(function ($group) {
                if (isset($group['translations']) && is_array($group['translations'])) {
                    $group['translations'] = array_values(array_filter($group['translations'], function ($t) {
                        return ($t['locale'] ?? '') === 'en';
                    }));
                }
                return $group;
            }, $items);

            CustomerGroup::query()->truncate();
            CustomerGroup\Translation::query()->truncate();
            foreach ($items as $item) {
                $translations  = array_pop($item);
                $customerGroup = CustomerGroup::query()->create($item);
                $customerGroup->translations()->createMany($translations);
            }
        }
    }

    private function getCustomerGroups(): array
    {
        return [
            [
                'level'         => 1,
                'mini_cost'     => 0,
                'discount_rate' => 100,
                'translations'  => [
                    ['locale' => 'en', 'name' => 'Account', 'description' => 'Account'],
                ],
            ],
            [
                'level'         => 2,
                'mini_cost'     => 1000,
                'discount_rate' => 95,
                'translations'  => [
                    ['locale' => 'en', 'name' => 'VIP', 'description' => 'VIP'],
                ],
            ],
        ];
    }
}
