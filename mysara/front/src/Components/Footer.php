<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Components;

use Illuminate\View\Component;
use MySara\Front\Repositories\FooterMenuRepo;

/**
 * Footer component class
 * Responsible for rendering the website footer, including link menus, copyright information, payment icons, etc.
 */
class Footer extends Component
{
    public array $footerMenus;

    /**
     * Constructor - Initialize data required for Footer component
     *
     * @throws \Exception
     */
    public function __construct()
    {
        // Get footer menu data
        $this->footerMenus = FooterMenuRepo::getInstance()->getMenus();
    }

    /**
     * Render Footer component view
     *
     * @return mixed
     */
    public function render(): mixed
    {
        return view('components.footer');
    }
}
