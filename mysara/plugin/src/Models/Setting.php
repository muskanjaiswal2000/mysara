<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Plugin\Models;

use MySara\Common\Models\BaseModel;

class Setting extends BaseModel
{
    protected $fillable = [
        'space', 'name', 'value', 'json',
    ];
}
