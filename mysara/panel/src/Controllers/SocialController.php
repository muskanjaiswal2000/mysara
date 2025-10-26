<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Controllers;

use Illuminate\Http\Request;
use MySara\Common\Repositories\Customer\SocialRepo;
use MySara\Common\Repositories\SettingRepo;
use Throwable;

class SocialController extends BaseController
{
    public function index()
    {
        $data = [
            'providers' => SocialRepo::getInstance()->getProviders(),
            'socials'   => system_setting('social', []),
        ];

        return inno_view('panel::socials.index', $data);
    }

    /**
     * @param  Request  $request
     * @return mixed
     * @throws Throwable
     */
    public function store(Request $request): mixed
    {
        try {
            $data = $request->all();
            SettingRepo::getInstance()->updateSystemValue('social', $data);

            return update_json_success();
        } catch (\Exception $e) {
            return json_fail($e->getMessage());
        }
    }
}
