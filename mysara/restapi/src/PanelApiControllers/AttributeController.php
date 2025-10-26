<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\PanelApiControllers;

use Illuminate\Http\Request;
use MySara\Common\Repositories\AttributeRepo;
use MySara\Common\Resources\AttributeSimple;

class AttributeController extends BaseController
{
    /**
     * @param  Request  $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        $filters    = $request->all();
        $attributes = AttributeRepo::getInstance()->all($filters);
        $items      = AttributeSimple::collection($attributes);

        return read_json_success($items);
    }
}
