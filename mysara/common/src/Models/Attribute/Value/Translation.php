<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Attribute\Value;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MySara\Common\Models\Attribute\Value;
use MySara\Common\Models\BaseModel;

class Translation extends BaseModel
{
    protected $table = 'attribute_value_translations';

    protected $fillable = [
        'attribute_value_id', 'locale', 'name',
    ];

    /**
     * @return BelongsTo
     */
    public function value(): BelongsTo
    {
        return $this->belongsTo(Value::class, 'attribute_value_id', 'id');
    }
}
