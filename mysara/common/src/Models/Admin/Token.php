<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MySara\Common\Models\Admin;
use MySara\Common\Models\BaseModel;

class Token extends BaseModel
{
    protected $table = 'admin_tokens';

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
