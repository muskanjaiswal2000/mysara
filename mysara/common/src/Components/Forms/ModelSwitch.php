<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Components\Forms;

use Illuminate\View\Component;

class ModelSwitch extends Component
{
    public string $name;

    public bool $value;

    public string $label;

    public string $id;

    public function __construct(string $name, ?bool $value = false, string $label = '', string $id = '')
    {
        $this->name  = $name;
        $this->value = (bool) $value;
        $this->label = $label;
        $this->id    = $id ?: $name;
    }

    /**
     * @return mixed
     */
    public function render(): mixed
    {
        return view('common::components.form.model-switch');
    }
}
