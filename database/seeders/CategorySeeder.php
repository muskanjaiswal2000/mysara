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
use MySara\Common\Models\Category;
use MySara\Common\Repositories\CategoryRepo;
use Throwable;

class CategorySeeder extends Seeder
{
    /**
     * @throws Throwable
     */
    public function run(): void
    {
        $items = $this->getCategories();
        // Recursively keep only English translations
        $filter = function ($category) use (&$filter) {
            if (isset($category['translations']) && is_array($category['translations'])) {
                $category['translations'] = array_values(array_filter($category['translations'], function ($t) {
                    return ($t['locale'] ?? '') === 'en';
                }));
            }
            if (isset($category['children']) && is_array($category['children'])) {
                $category['children'] = array_map($filter, $category['children']);
            }

            return $category;
        };

        $items = array_map($filter, $items);
        if ($items) {
            Category::query()->truncate();
            foreach ($items as $item) {
                CategoryRepo::getInstance()->create($item);
            }
        }
    }

    /**
     * @return array[]
     */
    private function getCategories(): array
    {
        return [
            [
                'slug'         => 'women-clothing',
                'position'     => 1,
                'active'       => 1,
                'image'        => 'images/demo/categories/women-cate.png',
                'translations' => [
                    [
                        'locale'  => 'en',
                        'name'    => 'Women',
                        'summary' => 'Elegant fashion for modern women, showcasing unique charm',
                        'content' => '<div class="category-description">
                            <h3>Curated Women\'s Fashion Collection</h3>
                            <p>We carefully select fashionable clothing for modern women, featuring:</p>
                            <ul>
                                <li><strong>Casual Wear Collection</strong> - Comfortable and natural, perfect for everyday styling</li>
                                <li><strong>Formal Attire Collection</strong> - Elegant and sophisticated, ideal for workplace and formal occasions</li>
                                <li><strong>Dress Collection</strong> - Romantic and charming, showcasing feminine grace</li>
                                <li><strong>Fashion Outerwear</strong> - Versatile and practical, essential pieces for all seasons</li>
                            </ul>
                            <p>We are committed to using <em>premium fabrics</em> and paying attention to every <em>tailoring detail</em>, creating comfortable, fashionable, and elegant clothing experiences for you. Whether for daily life or special occasions, you can showcase your unique feminine charm.</p>
                            <blockquote>
                                <p>"Fashion is not just about appearance, but the embodiment of inner confidence"</p>
                            </blockquote>
                        </div>',
                    ],
                ],
                'children' => [
                    [
                        'slug'         => 'casual-wear',
                        'position'     => 1,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Casual Wear',
                                'content' => 'Casual style women\'s clothing',
                            ],
                        ],
                    ],
                    [
                        'slug'         => 'formal-wear',
                        'position'     => 2,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Formal Wear',
                                'content' => 'Formal women\'s clothing for special occasions',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug'         => 'men-clothing',
                'position'     => 2,
                'active'       => 1,
                'translations' => [
                    [
                        'locale'  => 'en',
                        'name'    => 'Men',
                        'content' => 'Fashion clothing for men',
                    ],
                ],
                'children' => [
                    [
                        'slug'         => 'casual-wear-men',
                        'position'     => 1,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Casual Wear',
                                'content' => 'Casual style men\'s clothing',
                            ],
                        ],
                    ],
                    [
                        'slug'         => 'business-wear',
                        'position'     => 2,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Business Wear',
                                'content' => 'Business men\'s clothing for professional occasions',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug'         => 'children-clothing',
                'position'     => 3,
                'active'       => 1,
                'translations' => [
                    [
                        'locale'  => 'en',
                        'name'    => 'Children',
                        'content' => 'Fashion clothing for children',
                    ],
                ],
                'children' => [
                    [
                        'slug'         => 'boys-clothing',
                        'position'     => 1,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Boys',
                                'content' => 'Fashion clothing for boys',
                            ],
                        ],
                    ],
                    [
                        'slug'         => 'girls-clothing',
                        'position'     => 2,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Girls',
                                'content' => 'Fashion clothing for girls',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug'         => 'sportswear',
                'position'     => 4,
                'active'       => 1,
                'translations' => [
                    [
                        'locale'  => 'en',
                        'name'    => 'Sports',
                        'content' => 'Clothing for sports activities',
                    ],
                ],
                'children' => [
                    [
                        'slug'         => 'sports-clothing',
                        'position'     => 1,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Sports Clothing',
                                'content' => 'Clothing designed for sports',
                            ],
                        ],
                    ],
                    [
                        'slug'         => 'sports-accessories',
                        'position'     => 2,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Sports Accessories',
                                'content' => 'Accessories needed for sports',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug'         => 'accessories',
                'position'     => 5,
                'active'       => 1,
                'translations' => [
                    [
                        'locale'  => 'en',
                        'name'    => 'Accessories',
                        'content' => 'Accessories for clothing',
                    ],
                ],
                'children' => [
                    [
                        'slug'         => 'hats',
                        'position'     => 1,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Hats',
                                'content' => 'Various styles of hats',
                            ],
                        ],
                    ],
                    [
                        'slug'         => 'scarves',
                        'position'     => 2,
                        'active'       => 1,
                        'translations' => [
                            [
                                'locale'  => 'en',
                                'name'    => 'Scarves',
                                'content' => 'Various styles of scarves',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
