<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Catalog;

use MySara\Common\Models\BaseModel;

class Translation extends BaseModel
{
    protected $table = 'catalog_translations';

    protected $fillable = [
        'title', 'summary', 'locale', 'meta_title', 'meta_description', 'meta_keywords',
    ];
}
