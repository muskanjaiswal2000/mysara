<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController extends BaseController
{
    /**
     * @return mixed
     */
    public function index(): mixed
    {
        $admin = Auth::guard('admin')->user();
        Auth::guard('admin')->logout();
        session()->forget('panel_api_token');

        return redirect(panel_route('login.index'))
            ->with('instance', $admin);
    }
}
