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

class ImagePure extends Component
{
    public string $name;

    public string $title;

    public string $type;

    public string $value;

    public string $description;

    public function __construct(string $name, ?string $title, ?string $value, ?string $description = '', string $type = 'common')
    {
        $this->name        = $name;
        $this->title       = $title ?? '';
        $this->value       = $value ?? '';
        $this->description = $description ?? '';
        $this->type        = $type;
    }

    public function render()
    {
        return view('common::components.form.imagep');
    }
}
