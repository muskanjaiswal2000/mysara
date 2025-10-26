<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Models\Article;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MySara\Common\Models\Article;
use MySara\Common\Models\BaseModel;

class Relation extends BaseModel
{
    protected $table = 'article_relations';

    protected $fillable = [
        'article_id', 'relation_id',
    ];

    /**
     * Get the main article
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Get the related article
     * @return BelongsTo
     */
    public function relatedArticle(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'relation_id');
    }
}
