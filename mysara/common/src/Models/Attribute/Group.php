<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Attribute;

use MySara\Common\Models\BaseModel;
use MySara\Common\Traits\Translatable;

class Group extends BaseModel
{
    use Translatable;

    protected $table = 'attribute_groups';

    protected $fillable = [
        'position',
    ];

    public function getForeignKey(): string
    {
        return 'attribute_group_id';
    }
}
