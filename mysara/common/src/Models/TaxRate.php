<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxRate extends BaseModel
{
    protected $table = 'tax_rates';

    protected $fillable = [
        'region_id', 'name', 'type', 'rate',
    ];

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
