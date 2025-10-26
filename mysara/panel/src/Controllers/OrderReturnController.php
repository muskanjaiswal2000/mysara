<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MySara\Panel\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MySara\Common\Models\OrderReturn;
use MySara\Common\Repositories\CatalogRepo;
use MySara\Common\Repositories\OrderReturnRepo;
use MySara\Common\Resources\CatalogSimple;
use MySara\Common\Services\ReturnStateService;
use Throwable;

class OrderReturnController extends BaseController
{
    /**
     * @param  Request  $request
     * @return mixed
     * @throws Exception
     */
    public function index(Request $request): mixed
    {
        $filters = $request->all();
        $data    = [
            'criteria'      => OrderReturnRepo::getCriteria(),
            'order_returns' => OrderReturnRepo::getInstance()->list($filters),
        ];

        return inno_view('panel::order_returns.index', $data);
    }

    /**
     * OrderReturn creation page.
     *
     * @return mixed
     * @throws Exception
     */
    public function create(): mixed
    {
        return $this->form(new OrderReturn);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data        = $request->all();
            $orderReturn = OrderReturnRepo::getInstance()->create($data);

            return redirect(panel_route('order_returns.index'))
                ->with('instance', $orderReturn)
                ->with('success', panel_trans('common.updated_success'));
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param  OrderReturn  $order_return
     * @return mixed
     * @throws Exception
     */
    public function edit(OrderReturn $order_return): mixed
    {
        return $this->form($order_return);
    }

    /**
     * @param  $orderReturn
     * @return mixed
     * @throws Exception
     */
    public function form($orderReturn): mixed
    {
        $catalogs = CatalogSimple::collection(CatalogRepo::getInstance()->all(['active' => 1]))->jsonSerialize();
        $data     = [
            'next_statuses' => ReturnStateService::getInstance($orderReturn)->nextBackendStatuses(),
            'order_return'  => $orderReturn,
            'catalogs'      => $catalogs,
        ];

        return inno_view('panel::order_returns.form', $data);
    }

    /**
     * @param  Request  $request
     * @param  OrderReturn  $orderReturn
     * @return RedirectResponse
     */
    public function update(Request $request, OrderReturn $orderReturn): RedirectResponse
    {
        try {
            $data        = $request->all();
            $orderReturn = OrderReturnRepo::getInstance()->update($orderReturn, $data);

            return redirect(panel_route('order_returns.index'))
                ->with('instance', $orderReturn)
                ->with('success', panel_trans('common.updated_success'));
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param  OrderReturn  $order_return
     * @return RedirectResponse
     */
    public function destroy(OrderReturn $order_return): RedirectResponse
    {
        try {
            OrderReturnRepo::getInstance()->destroy($order_return);

            return back()->with('success', panel_trans('common.deleted_success'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * @param  Request  $request
     * @param  OrderReturn  $orderReturn
     * @return mixed
     */
    public function changeStatus(Request $request, OrderReturn $orderReturn): mixed
    {
        $status  = $request->get('status');
        $comment = $request->get('comment');
        try {
            ReturnStateService::getInstance($orderReturn)->changeStatus($status, $comment, true);

            return json_success(panel_trans('common.updated_success'));
        } catch (Exception $e) {
            return json_fail($e->getMessage());
        }
    }
}
