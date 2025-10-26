<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Repositories\Product;

use MySara\Common\Models\Product;
use MySara\Common\Models\Product\Relation;
use MySara\Common\Repositories\BaseRepo;

class RelationRepo extends BaseRepo
{
    /**
     * Handle bidirectional relations between products
     *
     * @param  Product  $product
     * @param  array  $relationIDs
     * @return void
     */
    public function handleBidirectionalRelations(Product $product, array $relationIDs): void
    {
        // Clear all existing relations
        $product->relations()->delete();

        // Clear reverse relations
        Relation::where('relation_id', $product->id)->delete();

        if (empty($relationIDs)) {
            return;
        }

        // Remove duplicates and self-reference
        $relationIDs = array_unique($relationIDs);
        $relationIDs = array_filter($relationIDs, function ($id) use ($product) {
            return $id != $product->id;
        });

        if (empty($relationIDs)) {
            return;
        }

        // Prepare both forward and reverse relations
        $forwardRelations = [];
        $reverseRelations = [];
        $now              = now();

        foreach ($relationIDs as $id) {
            // Forward relation (product -> related)
            $forwardRelations[] = [
                'product_id'  => $product->id,
                'relation_id' => $id,
                'created_at'  => $now,
                'updated_at'  => $now,
            ];

            // Reverse relation (related -> product)
            $reverseRelations[] = [
                'product_id'  => $id,
                'relation_id' => $product->id,
                'created_at'  => $now,
                'updated_at'  => $now,
            ];
        }

        // Save relations using model
        Relation::insert($forwardRelations);
        Relation::insert($reverseRelations);
    }
}
