<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Controllers;

class ProductSelectorController extends BaseController
{
    /**
     * Selector page
     *
     * @return mixed
     */
    public function selectorPage(): mixed
    {
        return view('panel::product_selector.index');
    }
}
