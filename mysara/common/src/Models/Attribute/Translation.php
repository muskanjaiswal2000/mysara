<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Attribute;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MySara\Common\Models\Attribute;
use MySara\Common\Models\BaseModel;

class Translation extends BaseModel
{
    protected $table = 'attribute_translations';

    protected $fillable = [
        'locale', 'name',
    ];

    /**
     * @return BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
