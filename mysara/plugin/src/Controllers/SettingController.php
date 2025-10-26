<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Plugin\Controllers;

use MySara\Common\Repositories\SettingRepo;
use MySara\Panel\Controllers\BaseController;

class SettingController extends BaseController
{
    public function index()
    {
        return view('plugin::panel.settings.index');
    }

    public function update()
    {
        try {
            SettingRepo::getInstance()->updateValues(request()->all());

            return back()->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
