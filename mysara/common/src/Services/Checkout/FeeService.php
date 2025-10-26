<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Common\Services\Checkout;

use MySara\Common\Services\Fee\BalanceService;
use MySara\Common\Services\Fee\Shipping;
use MySara\Common\Services\Fee\Subtotal;
use MySara\Common\Services\Fee\Tax;

class FeeService extends BaseService
{
    /**
     * @return void
     */
    public function calculate(): void
    {
        $classes = $this->getFeeMethodClasses();
        foreach ($classes as $class) {
            (new $class($this->checkoutService))->addFee();
        }
    }

    /**
     * Get order fee method classes
     * @return mixed
     */
    public function getFeeMethodClasses(): mixed
    {
        $classes = [
            Subtotal::class,
            Tax::class,
            Shipping::class,
            BalanceService::class,
        ];

        return fire_hook_filter('service.checkout.fee.methods', $classes);
    }
}
