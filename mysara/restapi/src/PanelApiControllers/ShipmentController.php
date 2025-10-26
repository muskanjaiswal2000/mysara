<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\RestAPI\PanelApiControllers;

use Exception;
use MySara\Common\Models\Order;
use MySara\Common\Services\ShippingTraceService;
use MySara\RestAPI\Requests\ShipmentRequest;

class ShipmentController extends BaseController
{
    /**
     * @param  Order  $order
     * @param  ShipmentRequest  $request
     * @return mixed
     */
    public function store(Order $order, ShipmentRequest $request): mixed
    {
        try {
            $shipment = $order->shipments()->create($request->all());

            return create_json_success($shipment);
        } catch (Exception $e) {
            return json_fail($e->getMessage());
        }
    }

    /**
     * @param  Order\Shipment  $shipment
     * @return mixed
     */
    public function destroy(Order\Shipment $shipment): mixed
    {
        try {
            $shipment->delete();

            return delete_json_success();
        } catch (Exception $e) {
            return json_fail($e->getMessage());
        }
    }

    /**
     * @param  Order\Shipment  $shipment
     * @return mixed
     */
    public function getTraces(Order\Shipment $shipment): mixed
    {
        try {
            $traces = ShippingTraceService::getInstance($shipment)->getTraces();

            return read_json_success($traces);
        } catch (Exception $e) {
            return json_fail($e->getMessage());
        }
    }
}
