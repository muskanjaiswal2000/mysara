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
use MySara\Common\Models\Setting;
use MySara\Common\Repositories\SettingRepo;
use Throwable;

class SettingSeeder extends Seeder
{
    /**
     * @return void
     * @throws Throwable
     */
    public function run(): void
    {
        $items = $this->getSettings();
        if ($items) {
            Setting::query()->truncate();
            foreach ($items as $item) {
                SettingRepo::getInstance()->updateSystemValue($item['name'], $item['value']);
            }
        }
    }

    /**
     * @return array[]
     */
    private function getSettings(): array
    {
        return [
            ['space' => 'system', 'name' => 'front_logo', 'value' => 'images/logo.png'],
            ['space' => 'system', 'name' => 'panel_logo', 'value' => 'images/logo-panel.svg'],
            ['space' => 'system', 'name' => 'placeholder', 'value' => 'images/placeholder.png'],
            ['space' => 'system', 'name' => 'favicon', 'value' => 'images/favicon.png'],
            ['space' => 'system', 'name' => 'country_code', 'value' => 'US'],
            ['space' => 'system', 'name' => 'state_code', 'value' => 'CA'],
            ['space' => 'system', 'name' => 'front_locale', 'value' => 'en'],
            ['space' => 'system', 'name' => 'expand', 'value' => '0'],
            ['space' => 'system', 'name' => 'address', 'value' => 'TF Software Park'],
            ['space' => 'system', 'name' => 'telephone', 'value' => '13688886666'],
            ['space' => 'system', 'name' => 'email', 'value' => 'team@mysara.com'],
            ['space' => 'system', 'name' => 'currency', 'value' => 'usd'],
            ['space' => 'system', 'name' => 'menu_header_categories', 'value' => ['1', '4', '7', '10', '13']],
            ['space' => 'system', 'name' => 'menu_header_pages', 'value' => ['3']],
            ['space' => 'system', 'name' => 'menu_footer_categories', 'value' => ['1', '4', '7']],
            ['space' => 'system', 'name' => 'menu_footer_catalogs', 'value' => ['1', '2']],
            ['space' => 'system', 'name' => 'menu_footer_pages', 'value' => ['1', '2', '3']],
            [
                'space' => 'system',
                'name'  => 'meta_title',
                'value' => [
                    'en' => 'MySara - Innovative Open Source E-commerce System - Built on Laravel 11, with multi-language and multi-currency support, a powerful e-commerce system based on a Hook-based plugin architecture.',
                ],
            ],
            [
                'space' => 'system',
                'name'  => 'meta_keywords',
                'value' => [
                    'en' => 'MySara, Innovation, Open Source, E-commerce, Laravel 11, Multi-language, Multi-currency, Hook, Plugin architecture, Flexible, Powerful',
                ],
            ],
            [
                'space' => 'system',
                'name'  => 'meta_description',
                'value' => [
                    'en' => 'MySara is an innovative open-source e-commerce platform based on Laravel 11 featuring multi-language and multi-currency support, and a powerful hook-based plugin architecture for customization and extension.',
                ],
            ],
            [
                'space' => 'system',
                'name'  => 'slideshow',
                'value' => [
                    [
                        'image' => [
                            'en' => 'images/demo/banner/banner-1-en.jpg',
                        ],
                        'link' => '/en/category-women-clothing',
                    ],
                    [
                        'image' => [
                            'en' => 'images/demo/banner/banner-2-en.jpg',
                        ],
                        'link' => '/en/category-women-clothing',
                    ],
                ],
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_article_seo_description',
                'value' => 'Generate an optimized SEO description for the article based on the given keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_article_seo_keywords',
                'value' => 'Generate optimized SEO keywords for the article based on the given keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_article_seo_title',
                'value' => 'Generate an effective SEO title for the article based on the given keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_article_slug',
                'value' => 'Generate a concise and clear article slug based on the given keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_article_summary',
                'value' => 'Write a concise and compelling article summary based on the given keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_selling_point',
                'value' => 'Generate a concise and powerful product selling points description highlighting core advantages and unique features. Emphasize benefits to users, use clear and engaging language, and output as numbered points.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_seo_description',
                'value' => 'Generate an optimized product SEO description including main keywords, core features, and benefits. Keep it concise and compelling (150-160 characters).',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_seo_keywords',
                'value' => 'Generate optimized product SEO keywords covering core features and advantages.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_seo_title',
                'value' => 'Generate an effective product SEO title including main keywords (<= 60 characters).',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_slug',
                'value' => 'Generate a concise, clear product slug with lowercase letters and hyphens including main keywords.',
            ],
            [
                'space' => 'system',
                'name'  => 'ai_prompt_product_summary',
                'value' => 'Write a concise and compelling product summary highlighting core features and unique selling points in 1-2 sentences.',
            ],
        ];
    }
}
