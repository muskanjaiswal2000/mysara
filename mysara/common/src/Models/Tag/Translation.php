<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Tag;

use MySara\Common\Models\BaseModel;

class Translation extends BaseModel
{
    protected $table = 'tag_translations';

    protected $fillable = [
        'tag_id', 'locale', 'name',
    ];
}
