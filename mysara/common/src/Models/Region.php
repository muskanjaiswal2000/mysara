<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends BaseModel
{
    protected $table = 'regions';

    protected $fillable = [
        'name', 'description', 'position', 'active',
    ];

    /**
     * @return HasMany
     */
    public function regionStates(): HasMany
    {
        return $this->hasMany(\MySara\Common\Models\Region\State::class);
    }
}
