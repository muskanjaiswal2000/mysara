<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\FrontApiControllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use MySara\Common\Models\Country;
use MySara\Common\Repositories\CountryRepo;
use MySara\Common\Repositories\StateRepo;
use MySara\Common\Resources\CountrySimple;
use MySara\Common\Resources\StateItem;

class CountryController extends BaseController
{
    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $countries = CountryRepo::getInstance()->builder($request->all())->get();

        return CountrySimple::collection($countries);
    }

    /**
     * @param  Country  $country
     * @return AnonymousResourceCollection
     */
    public function states(Country $country): AnonymousResourceCollection
    {
        $filters = [
            'country_id' => $country->id,
        ];
        $states = StateRepo::getInstance()->builder($filters)->get();

        return StateItem::collection($states);
    }
}
