<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Product;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MySara\Common\Models\BaseModel;
use MySara\Common\Models\Product;

class Image extends BaseModel
{
    protected $table = 'product_images';

    protected $fillable = ['path', 'is_cover', 'belong_sku', 'position'];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
