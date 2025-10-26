<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Components;

use Illuminate\View\Component;

class Review extends Component
{
    public int $rating;

    /**
     * @param  $rating
     */
    public function __construct($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function render(): mixed
    {
        return view('components.review');
    }
}
