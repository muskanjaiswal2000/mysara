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
use MySara\Common\Models\Option;
use MySara\Common\Models\OptionValue;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        OptionValue::query()->truncate();
        Option::query()->truncate();

        $options = $this->getOptions();

        // Keep only English in names/descriptions/values
        $options = array_map(function ($opt) {
            if (isset($opt['name']) && is_array($opt['name'])) {
                $opt['name'] = ['en' => $opt['name']['en'] ?? ''];
            }
            if (isset($opt['description']) && is_array($opt['description'])) {
                $opt['description'] = ['en' => $opt['description']['en'] ?? ''];
            }
            if (isset($opt['values']) && is_array($opt['values'])) {
                $opt['values'] = array_map(function ($val) {
                    if (isset($val['name']) && is_array($val['name'])) {
                        $val['name'] = ['en' => $val['name']['en'] ?? ''];
                    }
                    return $val;
                }, $opt['values']);
            }

            return $opt;
        }, $options);

        foreach ($options as $index => $opt) {
            $option = Option::query()->create([
                'name'        => $opt['name'],
                'description' => $opt['description'],
                'type'        => $opt['type'],
                'position'    => $index,
                'active'      => true,
                'required'    => $opt['required'] ?? false,
            ]);

            $position = 0;
            foreach ($opt['values'] as $value) {
                OptionValue::query()->create([
                    'option_id' => $option->id,
                    'name'      => $value['name'],
                    'image'     => $value['image'] ?? '',
                    'position'  => $position++,
                    'active'    => true,
                ]);
            }
        }
    }

    private function getOptions(): array
    {
        return [
            [
                'name' => [
                    'en' => 'Gift Wrap',
                ],
                'description' => [
                    'en' => 'Provide standard or premium gift wrapping',
                ],
                'type'     => 'radio',
                'required' => true,
                'values'   => [
                    [
                        'name'  => ['en' => 'Standard Wrap'],
                        'image' => '',
                    ],
                    [
                        'name'  => ['en' => 'Premium Gift Box'],
                        'image' => '',
                    ],
                ],
            ],
            [
                'name' => [
                    'en' => 'Accessories',
                ],
                'description' => [
                    'en' => 'Optional accessories to enhance the product',
                ],
                'type'     => 'checkbox',
                'required' => false,
                'values'   => [
                    [
                        'name'  => ['en' => 'Brooch'],
                        'image' => 'images/demo/product/7.png',
                    ],
                    [
                        'name'  => ['en' => 'Belt'],
                        'image' => 'images/demo/product/8.png',
                    ],
                ],
            ],
            [
                'name' => [
                    'en' => 'Express Customization',
                ],
                'description' => [
                    'en' => 'Choose rush service option',
                ],
                'type'     => 'radio',
                'required' => false,
                'values'   => [
                    [
                        'name'  => ['en' => 'No Rush'],
                        'image' => '',
                    ],
                    [
                        'name'  => ['en' => 'Next-day Shipping'],
                        'image' => '',
                    ],
                ],
            ],
        ];
    }
}
