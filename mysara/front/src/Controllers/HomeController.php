<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Controllers;

use App\Http\Controllers\Controller;
use MySara\Common\Repositories\ArticleRepo;
use MySara\Common\Repositories\ProductRepo;
use MySara\Front\Repositories\HomeRepo;

class HomeController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function index(): mixed
    {
        $bestSeller  = ProductRepo::getInstance()->getBestSellerProducts();
        $newArrivals = ProductRepo::getInstance()->getLatestProducts();
        $tabProducts = [
            ['tab_title' => trans('front/home.bestseller'), 'products' => $bestSeller],
            ['tab_title' => trans('front/home.new_arrival'), 'products' => $newArrivals],
        ];

        $news = ArticleRepo::getInstance()->getLatestArticles();
        $data = [
            'slideshow'    => HomeRepo::getInstance()->getSlideShow(),
            'tab_products' => $tabProducts,
            'news'         => $news,
        ];

        $data = fire_hook_filter('home.index.data', $data);

        return inno_view('home', $data);
    }
}
