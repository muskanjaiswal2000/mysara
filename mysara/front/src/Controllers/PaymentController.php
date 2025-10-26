<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Front\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MySara\Common\Repositories\OrderRepo;

class PaymentController extends Controller
{
    /**
     * Payment success page
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function success(Request $request)
    {
        $orderNumber = $request->get('order_number');
        $order       = $orderNumber ? OrderRepo::getInstance()->builder(['number' => $orderNumber])->first() : null;

        return inno_view('payment.success', ['order' => $order]);
    }

    /**
     * Payment fail page
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function fail(Request $request)
    {
        $orderNumber = $request->get('order_number');
        $order       = $orderNumber ? OrderRepo::getInstance()->builder(['number' => $orderNumber])->first() : null;

        return inno_view('payment.fail', ['order' => $order]);
    }

    /**
     * Payment cancel page
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function cancel(Request $request)
    {
        $orderNumber = $request->get('order_number');
        $order       = $orderNumber ? OrderRepo::getInstance()->builder(['number' => $orderNumber])->first() : null;

        return inno_view('payment.cancel', ['order' => $order]);
    }
}
