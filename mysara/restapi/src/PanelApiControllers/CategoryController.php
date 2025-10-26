<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\PanelApiControllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use MySara\Common\Repositories\CategoryRepo;
use MySara\Common\Resources\CategoryName;
use MySara\Common\Resources\CategorySimple;
use MySara\RestAPI\FrontApiControllers\BaseController;

class CategoryController extends BaseController
{
    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->all();
        $perPage = $request->get('per_page', 15);

        $categories = CategoryRepo::getInstance()->builder($filters)->paginate($perPage);

        return CategorySimple::collection($categories);
    }

    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function names(Request $request): AnonymousResourceCollection
    {
        $products = CategoryRepo::getInstance()->getListByCategoryIDs($request->get('ids'));

        return CategoryName::collection($products);
    }

    /**
     * Fuzzy search for auto complete.
     * /api/panel/categories/autocomplete?keyword=xxx
     *
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function autocomplete(Request $request): AnonymousResourceCollection
    {
        $categories = CategoryRepo::getInstance()->autocomplete($request->get('keyword') ?? '');

        return CategoryName::collection($categories);
    }
}
