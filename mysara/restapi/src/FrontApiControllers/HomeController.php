<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\FrontApiControllers;

class HomeController extends BaseController
{
    /**
     * @return string
     */
    public function base(): string
    {
        return 'This is Frontend Restful APIs for '.mysara_version();
    }

    /**
     * Home page data.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        $content = file_get_contents(inno_path('restapi/src/Repositories/app_home_data.json'));
        $data    = json_decode($content, true);

        return read_json_success($data['data']);
    }
}
