<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Repositories;

use MySara\Common\Models\Category;
use MySara\Common\Models\Product;

class HomeRepo
{
    /**
     * @return static
     */
    public static function getInstance(): static
    {
        return new static;
    }

    /**
     * @return array
     */
    public function getSlideShow(): array
    {
        $slideShow = system_setting('slideshow');
        if (empty($slideShow)) {
            return [];
        }

        $result = [];
        foreach ($slideShow as $item) {
            if (str_starts_with($item['link'], 'category:')) {
                $categoryID = str_replace('category:', '', $item['link']);
                $category   = Category::query()->find($categoryID);
                if (empty($category)) {
                    $category = Category::query()->where('slug', $categoryID)->first();
                }
                $item['link'] = $category->url;
            } elseif (str_starts_with($item['link'], 'product:')) {
                $productID = str_replace('product:', '', $item['link']);
                $product   = Product::query()->find($productID);
                if (empty($product)) {
                    $product = Product::query()->where('slug', $productID)->first();
                }
                $item['link'] = $product->url;
            }
            $result[] = $item;
        }

        return $result;
    }
}
